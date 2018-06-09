<?php

namespace App\Core\Libraries;

use PDO;
use App\Core\{Database, Config};

class DB {

    protected static $pdo = null;
    protected static $instance = null;

    protected function __construct() {
        
    }

    protected function __clone() {
        
    }

    public static function pdo() {
        if (self::$pdo === null) {
            self::$pdo = Database::getPDO();
        }

        return self::$pdo;
    }

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args) {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function _prepare($sql, $bind = array()) {
        $stmt = self::pdo()->prepare($sql);

        if (!$stmt) {
            $errorInfo = self::pdo()->errorInfo();
            throw new PDOException("Database error [{$errorInfo[0]}]: {$errorInfo[2]}, driver error code is $errorInfo[1]");
        }
        if (!is_array($bind)) {
            $bind = empty($bind) ? array() : array($bind);
        }
        if (!$stmt->execute($bind) || $stmt->errorCode() != '00000') {
            $errorInfo = $stmt->errorInfo();
            throw new PDOException("Database error [{$errorInfo[0]}]: {$errorInfo[2]}, driver error code is $errorInfo[1]");
        }

        return $stmt;
    }

    public function run($sql, $bind = array()) {
        $stmt = self::_prepare($sql, $bind);
        return $stmt->rowCount();
    }

    public function where($where, $andOr = 'AND') {
        if (is_array($where)) {
            $tmp = array();
            foreach ($where as $k => $v) {
                $tmp[] = $k . '=' . self::pdo()->quote($v);
            }
            return '(' . implode(" $andOr ", $tmp) . ')';
        }
        return $where;
    }

    public static function select($table, $fields = "*", $where = "", $bind = array(), $order = NULL, $limit = NULL) {

        $sql = "SELECT " . $fields . " FROM " . $table;
        if (!empty($where)) {
            $where = self::where($where);
            $sql .= " WHERE " . $where;
        }
        if (!empty($order)) {
            $sql .= " ORDER BY " . $order;
        }
        if (!empty($limit)) {
            $sql .= " LIMIT " . $limit;
        }
        $stmt = self::_prepare($sql, $bind);
        return $stmt->fetchAll(Config::get('default_pdo_fetch_mode'));
    }

    public static function query($sql, $bind = array()) {
        $stmt = self::_prepare($sql, $bind);
        return $stmt->fetchAll(Config::get('default_pdo_fetch_mode'));
    }

    public static function find($table, $id) {
        $stmt = self::_prepare('select * from ' . $table . ' where id = :id', [':id' => $id]);
        return $stmt->fetch(Config::get('default_pdo_fetch_mode'));
    }

    public static function insert($table, $data) {
        $fieldNames = array_keys($data);
        $sql = "INSERT INTO `$table` (" . implode($fieldNames, ", ") . ") VALUES (:" . implode($fieldNames, ", :") . ");";
        $bind = array();
        foreach ($fieldNames as $field) {
            $bind[":$field"] = $data[$field];
        }

        return self::run($sql, $bind);
    }

    public static function bulkInsert($table, $fieldNames, $data, $replace = false) {
        if (empty($table) || empty($fieldNames) || empty($data)) {
            return 0;
        }
        $fieldCount = count($fieldNames);
        $valueList = '';
        foreach ($data as $values) {
            $dataCount = count($values);
            if ($dataCount != $fieldCount) {
                if ($dataCount > $fieldCount) {
                    $values = array_slice($values, 0, $fieldCount);
                } else {
                    throw new PDOException("Number of columns and values not match!");
                }
            }
            foreach ($values as &$val) {
                if (is_null($val)) {
                    $val = 'NULL';
                } elseif (is_string($val)) {
                    $val = self::quote($val);
                } elseif (is_object($val) || is_array($val)) {
                    $val = self::quote(json_encode($val));
                }
            }
            $valueList .= '(' . implode(',', $values) . '),';
        }
        $valueList = rtrim($valueList, ',');

        $insert = $replace ? 'REPLACE' : 'INSERT';
        $sql = "$insert INTO `$table` (" . implode(', ', $fieldNames) . ") VALUES " . $valueList . ";";
        return self::run($sql);
    }

    public static function update($table, $data, $where = "", $bind = array()) {
        $sql = "UPDATE `$table` SET ";
        $comma = '';
        if (!is_array($bind)) {
            $bind = empty($bind) ? array() : array($bind);
        }
        foreach ($data as $k => $v) {
            $sql .= $comma . $k . " = :upd_" . $k;
            $comma = ', ';
            $bind[":upd_" . $k] = $v;
        }
        if (!empty($where)) {
            $where = self::where($where);
            $sql .= " WHERE " . $where;
        }
        return self::run($sql, $bind);
    }

    public static function delete($table, $where, $bind = array()) {
        $sql = "DELETE FROM `$table`";
        if (!empty($where)) {
            $where = self::where($where);
            $sql .= " WHERE " . $where;
        }
        return self::run($sql, $bind);
    }

    public static function truncate($table) {
        $sql = "TRUNCATE TABLE `$table`";
        return self::run($sql);
    }

    public static function save($table, $data, $where = "", $bind = array()) {
        $count = 0;
        if (!empty($where)) {
            $where = self::where($where);
            $count = self::fetchOne("SELECT COUNT(1) FROM $table WHERE $where", $bind);
        }
        if ($count == 0) {
            return self::insert($table, $data);
        } else {
            return self::update($table, $data, $where, $bind);
        }
    }

    public function fetchOne($sql, $bind = array()) {
        $stmt = self::_prepare($sql, $bind);
        return $stmt->fetchColumn(0);
    }

    public function fetchRow($sql, $bind = array()) {
        $stmt = self::_prepare($sql, $bind);
        return $stmt->fetch(self::_fetchMode);
    }

    public function fetchAll($sql, $bind = array()) {
        $stmt = self::_prepare($sql, $bind);
        return $stmt->fetchAll(self::_fetchMode);
    }

    public function fetchAssoc($sql, $bind = array()) {
        $stmt = self::_prepare($sql, $bind);
        $records = $stmt->fetchAll(Config::get('default_pdo_fetch_mode'));
        $result = array();
        if (!empty($records)) {
            $k0 = key($records[0]);
            foreach ($records as $rec) {
                $result[$rec[$k0]] = $rec;
            }
        }
        return $result;
    }

    public function fetchAssocArr($sql, $bind = array()) {
        $stmt = self::_prepare($sql, $bind);
        $records = $stmt->fetchAll(Config::get('default_pdo_fetch_mode'));
        $result = array();
        if (!empty($records)) {
            $k0 = key($records[0]);
            foreach ($records as $rec) {
                $result[$rec[$k0]][] = $rec;
            }
        }
        return $result;
    }

    public function fetchPairs($sql, $bind = array()) {
        $stmt = self::_prepare($sql, $bind);
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function fetchCol($sql, $bind = array()) {
        $stmt = self::_prepare($sql, $bind);
        $records = $stmt->fetchAll(Config::get('default_pdo_fetch_mode'));
        $result = array();
        if (!empty($records)) {
            $k0 = key($records[0]);
            foreach ($records as $rec) {
                $result[] = $rec[$k0];
            }
        }
        return $result;
    }

}
