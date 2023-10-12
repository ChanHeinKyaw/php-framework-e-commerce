<?php

namespace App\Controllers;

class BaseController
{
    public function show(){
        echo "I am show method of " . __CLASS__ . " class!";
    }
}