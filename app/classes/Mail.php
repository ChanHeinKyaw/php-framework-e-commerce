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

    public function send($data){
        $this->mail->addAddress($data['to'],$data['to_name']);
        $this->mail->Subject = $data['subject'];
        $this->mail->Body = make($data['filename'], $data);

        return $this->mail->send();
    }

}