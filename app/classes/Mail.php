<?php

namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    private $mail;
    
    public function __construct(){
        $this->mail = new PHPMailer();
        $this->setUp();
    }

    public function setUp(){
        $this->mail->SMTPDebug = $_ENV["APP_ENV"] == 'local' ? 2 : "";
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV["SMTP_HOST"];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $_ENV["EMAIL_USERNAME"];
        $this->mail->Password = $_ENV["EMAIL_PASSWORD"];
        $this->mail->Port = $_ENV["SMTP_PORT"];

        $this->mail->isHTML(true);
        $this->mail->SingleTo = true;

        $this->mail->From = $_ENV["ADMIN_EMAIL"];
        $this->mail->FromName = "Brighter Myanmar";
    }

    public function send(){
        $body = "While installing the entire package manually or with Composer is simple, convenient, and reliable, you may want to include only vital files in your project.";
        $this->mail->addAddress("scm.chanheinkyaw@gmail.com","Chan Hein Kyaw");
        $this->mail->Subject = "New Mail Testing For E-Commerce Project";
        $this->mail->Body = $body;

        return $this->mail->send();
    }

}