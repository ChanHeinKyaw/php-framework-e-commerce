<?php

use App\Classes\Mail;

require_once "../bootstrap/init.php";

$mailer = new Mail();

if($mailer->send())
    echo "<br><h1>Mail Send Successfully!</h1></br>";
else
    echo "<br><h1>Mail Send Fail!</h1></br>";
    