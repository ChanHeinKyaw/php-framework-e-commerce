<?php
namespace App\Controllers;

use App\Classes\Request;
use App\Classes\CSRFToken;

class CategoryController
{

    public function create(){
        view('admin/category/create');
    }

    public function store(){
        $post = Request::get("post");
        if(CSRFToken::checkToken($post->token)){
            echo "Authenticated Token";
        }else{
            echo "CSRF Attack Occur";
        }
    }
}