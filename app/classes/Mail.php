<?php

namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->setUp();
    }

    public function setUp()
    {
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = getenv('MAIL_ENCRYPTION');

        $this->mail->Host = getenv('MAIL_HOST');
        $this->mail->Port = getenv('MAIL_PORT');

        $environment = getenv('APP_ENV');
        if ($environment === 'local') {
            $this->mail->SMTPDebug = 2;
        }

        // auth info
        $this->mail->Username = getenv('MAIL_USERNAME');
        $this->mail->Password = getenv('MAIL_PASSWORD');

        $this->mail->isHTML(true);

        // sender info
        $this->mail->setFrom(getenv('MAIL_ADMIN'), getenv('APP_NAME'));
    }

    public function send($data)
    {
        $this->mail->addAddress($data['to'], $data['name']);
        $this->mail->Subject = $data['subject'];
        $this->mail->Body = make($data['view'], ['data' => $data['body']]);
        $this->mail->send();
    }
}
