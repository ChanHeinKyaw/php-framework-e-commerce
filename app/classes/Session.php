<?php

namespace App\Classes;

class Session
{
    public static function add($key,$value){
        if(!self::has($key)){
            $_SESSION[$key] = $value;
        }else{
            echo "Session with that " . $key . " have already define!";
        }
    }

    public static function has($key){
        return isset($_SESSION[$key]) ? true : false;
    }

    public static function remove($key){
        if(self::has($key)){
            unset($_SESSION[$key]);
        }
    }
}