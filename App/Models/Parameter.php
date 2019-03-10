<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Parameter extends Model {

    protected $table = 'parameters';
    protected $fillable = ['param_key', 'param_value'];

    public function setValue($value) {
        $this->attributes['param_value'] = $value;
    }

    public function getValue() {
        return $this->attributes['param_value'];
    }

    public function scopeKey($query, $key) {
        $result = $query->where('param_key', $key)->first();
        if($result != null) {
            return $result->getValue();
        }

        return null;
    }

}
