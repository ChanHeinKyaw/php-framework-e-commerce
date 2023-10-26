<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class SubCategoryController
{
    public function create(){
        $post = Request::get('post');

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name" => ["minLength" => "5", "unique" => "sub_categories"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if($validator->getErrors()){
                http_response_code(422);
                echo json_encode($validator->getErrors());
                exit;
            }else{
                echo json_encode($post);
                exit;
            }
        }else{
            http_response_code(422);
            echo json_encode(["error" => "Token Miss Match Exception"]);
            exit;
        }
    }
}