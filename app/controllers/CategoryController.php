<?php
namespace App\Controllers;

class CategoryController
{

    public function create(){
        view('admin/category/create');
    }

    public function store(){
        beautify($_POST);
        echo "I am store methods of " . __CLASS__ . " class";
    }
}