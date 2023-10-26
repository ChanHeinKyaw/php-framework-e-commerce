<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Models\SubCategory;
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
                $sub_categorie = new SubCategory();
                $sub_categorie->name = $post->name;
                $sub_categorie->cat_id = $post->parent_cat_id;
                if($sub_categorie->save()){
                    echo json_encode(["success" => "Sub Category Created Successfully!"]);
                    exit;
                }else{
                    http_response_code(422);
                    echo json_encode(["error" => "Sub Category Created Fail!"]);
                    exit;
                }
                exit;
            }
        }else{
            http_response_code(422);
            echo json_encode(["error" => "Token Miss Match Exception"]);
            exit;
        }
    }
}