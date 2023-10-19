<?php

use App\Classes\Mail;

require_once "../bootstrap/init.php";

$mailer = new Mail();

$content = "While installing the entire package manually or with Composer is simple, convenient, and reliable, you may want to include only vital files in your project.";
$data = [
    'to' => "scm.chanheinkyaw@gmail.com",
    'to_name' => "Chan Hein Kyaw",
    'content' => $content,
    'subject' => "New Mail Testing For E-Commerce Project",
    'filename' => "welcome",
];

if($mailer->send($data))
    echo "<br><h1>Mail Send Successfully!</h1></br>";
else
    echo "<br><h1>Mail Send Fail!</h1></br>";
    