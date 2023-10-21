<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest
{
    private $errors = [];

    private $error_messages = [
        'unique' => 'The :attribute field is already in use!',
        'required' => 'The :attribute field must be filled!',
        'minLength' => 'The :attribute field must be at least :policy characters!',
        'maxLength' => 'The :attribute field must not be more than :policy characters!',
        'email' => 'The email validation error occur!',
        'string' => 'The :attribute field can only fill string values!',
        'number' => 'The :attribute field can only fill number values!',
        'mixed' => 'The :attribute field only accept [A-Za-z0-9.$@] characters',
    ];

    public function unique($column, $value, $policy){
        if($value != null && !empty(trim($value))){
            return Capsule::table($policy)->where($column, $value)->exists();
        }
    }

    public function required($column, $value, $policy){
        return $value != null && !empty(trim($value)) ? true : false;
    }

    public function minLength($column, $value, $policy){
        if($value != null && !empty(trim($value))){
            return strlen(trim($value)) >= $policy;
        }
    }

    public function maxLength($column, $value, $policy){
        if($value != null && !empty(trim($value))){
            return strlen(trim($value)) <= $policy;
        }
    }

    public function email($column, $value, $policy){
        if($value != null && !empty(trim($value))){
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        }
        return false;
    }

    public function string($column, $value, $policy){
        if($value != null && !empty(trim($value))){
            return preg_match("/^[A-Za-z ]+$/",$value);
        }
        return false;
    }

    public function number($column, $value, $policy){
        if($value != null && !empty(trim($value))){
            return preg_match("/^[0-9]+$/",$value);
        }
        return false;
    }

    public function mixed($column, $value, $policy){
        if($value != null && !empty(trim($value))){
            return preg_match("/^[A-Za-z0-9 \.$@]+$/",$value);
        }
        return false;
    }

    public function setError($error, $key = null){
        if($key){
            $this->errors[$key] = $error;
        }else{
            $this->errors[] = $error;
        }
    }

    public function hasError(){
        return count($this->errors) > 0 ? true : false;
    }
    
    public function getErros(){
        return $this->errors;
    }

}