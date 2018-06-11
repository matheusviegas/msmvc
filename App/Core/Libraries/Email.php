<?php

namespace App\Core\Libraries;

use PHPMailer\PHPMailer\PHPMailer;

class Email extends PHPMailer {

    public function __construct($exceptions = NULL) {
        parent::__construct($exceptions);

        $this->SMTPDebug = env('MAIL_DEBUG', 3);

        if (env('MAIL_SMTP', FALSE)) {
            $this->isSMTP();
            $this->SMTPAuth = env('MAIL_STMP_AUTH');
            $this->Host = env('MAIL_SMTP_HOST');
            $this->Username = env('MAIL_SMTP_USER');
            $this->Password = env('MAIL_SMTP_PASS');
            $this->Port = env('MAIL_SMTP_PORT');
            $this->SMTPSecure = env('MAIL_SMTP_SECURE', 'ssl');
        }

        if (env('MAIL_SMTP_TYPE', 'html') == 'html') {
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
