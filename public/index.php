<?php

use App\Classes\Mail;
use App\Classes\Session;
use App\Classes\ValidateRequest;

require_once "../bootstrap/init.php";

// $post = [
//     "name" => "Mg mg",
//     "age"  => 2,
//     "email" => "mgmg@gmail.com",
// ];

// $policies = [
//     "name" => ["string" => true, "minLength" => "5"],
//     "age"  => ["email" => true, "minLength" => "2"],
//     "email" => ["email" => true, "maxLength" => "25"],
// ];

// $validator = new ValidateRequest();
// $validator->checkValidate($post,$policies);

// if($validator->hasError()){
//     beautify($validator->getErrors());
// }else{
//     echo "Good to go!";
// }


// Session::remove('token');
// Session::flash('create_success','Category Created Successfully!');
// Session::flash('create_success');

// $mailer = new Mail();

// $content = "While installing the entire package manually or with Composer is simple, convenient, and reliable, you may want to include only vital files in your project.";
// $data = [
//     'to' => "scm.chanheinkyaw@gmail.com",
//     'to_name' => "Chan Hein Kyaw",
//     'content' => $content,
//     'subject' => "New Mail Testing For E-Commerce Project",
//     'filename' => "welcome",
//     'img_link' => "https://scontent.frgn12-1.fna.fbcdn.net/v/t39.30808-6/327120071_668374561746063_2743338393680582325_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=5f2048&_nc_ohc=F3lMcyzbQWQAX8Ed4J-&_nc_ht=scontent.frgn12-1.fna&oh=00_AfDcAJCgLkEkNA4G64PJhP4B9BY0CEkNCDGZJ_QtxDPboQ&oe=6536627D",
// ];

// if($mailer->send($data))
//     echo "<br><h1>Mail Send Successfully!</h1></br>";
// else
//     echo "<br><h1>Mail Send Fail!</h1></br>";
    