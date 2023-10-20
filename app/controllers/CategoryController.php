<?php
namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Classes\UploadFile;

class CategoryController
{

    public function create(){
        view('admin/category/create');
    }

    public function store(){
        $post = Request::get("post");
        if(CSRFToken::checkToken($post->token)){
            beautify(Request::get('file'));
            echo "<hr>";
            $uploadFile = new UploadFile();
            var_dump($uploadFile->move(Request::get('file')));
        }else{
            Session::flash("error","CSRF Field Error!");
            Redirect::back();
        }
    }
}