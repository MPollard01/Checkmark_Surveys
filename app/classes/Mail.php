<?php

namespace App\Classes;
use PHPMailer\PHPMailer;

class Mail
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer\PHPMailer;
        $this->setup();
    }

    private function setup()
    {
        $this->mail->isSMTP();
        $this->mail->Mailer = 'smtp';
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Host = $_ENV['SMTP_HOST'];
        $this->mail->Port = $_ENV['SMTP_PORT'];

        $environment = $_ENV['APP_ENV'];

        if($environment === 'local') $this->mail->SMTPDebug = 2;

        $this->mail->Username = $_ENV['EMAIL_USERNAME'];
        $this->mail->Password = $_ENV['EMAIL_PASSWORD'];

        $this->mail->isHTML(true);
        //$this->mail->SingleTo = true;

        $this->mail->From = $_ENV['EMAIL_USERNAME'];
        $this->mail->FromName = $_ENV['APP_NAME'];
    }

    public function send($data)
    {
        $this->mail->addAddress($data['to'], $data['name']);
        $this->mail->Subject = $data['subject'];
        $this->mail->Body = '';
    }

    public function getMail()
    {
        return $this->mail;
    }
}