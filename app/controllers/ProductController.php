<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Models\Category;
use App\Classes\CSRFToken;
use App\Models\SubCategory;
use App\Classes\ValidateRequest;

class ProductController
{
    public function index(){
        view('admin/product/index');
    }

    public function create(){
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        view('admin/product/create',compact('categories','sub_categories'));
    }

    public function edit(){
        view('admin/product/edit');
    }

    public function store(){
        $post = Request::get('post');
        $file = Request::get('file');

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name" => ["required" => true, "unique" => "products", "minLength" => "5"],
                "description" => ["required" => true, "minLength" => "20"]
            ];

            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if($validator->hasError()){
                $errors = $validator->getErrors();
                $categories = Category::all();
                $sub_categories = SubCategory::all();
                view("admin/product/create", compact("categories","sub_categories","errors"));
            }else{
                $success = "Good To Go";
                $categories = Category::all();
                $sub_categories = SubCategory::all();
                view("admin/product/create", compact("categories","sub_categories","success"));
            }
        }else{
            $errors = ["Token Miss Match Error!"];
            $categories = Category::all();
            $sub_categories = SubCategory::all();
            view('admin/product/create',compact('categories','sub_categories','errors'));
        }
    }
}