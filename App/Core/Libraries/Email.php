<?php

namespace App\Core\Libraries;

use PHPMailer\PHPMailer\PHPMailer;

class Email extends PHPMailer {

    public function __construct($exceptions = NULL) {
        parent::__construct($exceptions);

        global $config;

        $this->SMTPDebug = $config['mail_debug'];

        if ($config['mail_smtp']) {
            $this->isSMTP();
            $this->SMTPAuth = $config['mail_smtp_auth'];
            $this->Host = $config['mail_smtp_host'];
            $this->Username = $config['mail_smtp_user'];
            $this->Password = $config['mail_smtp_pass'];
            $this->Port = $config['mail_smtp_port'];
            $this->SMTPSecure = $config['mail_smtp_secure'];
        }

        if ($config['mail_smtp_type'] == 'html') {
            $this->isHTML(true);
        }
    }

    public function from($email, $name = '') {
        $this->setFrom($email, $name);
    }

    public function to($email, $name = '') {
        $this->addAddress($email, $name);
    }

    public function cc($email) {
        $this->addCC($email);
    }

    public function bcc($email) {
        $this->addBCC($email);
    }

    public function reply($email, $name = '') {
        $this->addReplyTo($email, $name);
    }

    public function subject($subject) {
        $this->Subject = $subject;
    }

    public function message($body, $altbody = '') {
        $this->Body = $body;
        $this->AltBody = $altbody;
    }

}
