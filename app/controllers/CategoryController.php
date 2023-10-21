<?php
namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Session;
use App\Models\Category;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Classes\UploadFile;
use App\Classes\ValidateRequest;

class CategoryController
{

    public function create(){
        $categories = Category::all();
        view('admin/category/create',compact('categories'));
    }

    public function store(){
        $post = Request::get("post");
        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name" => ["required" => true, "minLength" => "5", "unique" => "categories"]
            ];

            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if($validator->hasError()){
                $categories = Category::all();
                $errors = $validator->getErrors();
                view('admin/category/create',compact('categories', 'errors'));
            }else{
                $slug = slug($post->name);
                $con = Category::create([
                'name' => $post->name,
                    'slug' => $slug,
                ]);

                if($con){
                    $categories = Category::all();
                    $success = "Category Created Successfully!";
                    view('admin/category/create',compact('categories','success'));
                }else{
                    echo "Category Created Fail!";
                }
            }
        }else{
            Session::flash("error","CSRF Field Error!");
            Redirect::back();
        }
    }
}