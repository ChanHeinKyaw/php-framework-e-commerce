<?php
namespace App\Controllers;

use App\Classes\Request;

class CategoryController
{

    public function create(){
        view('admin/category/create');
    }

    public function store(){
        beautify(Request::old('post','name'));
        echo "I am store methods of " . __CLASS__ . " class";
    }
}