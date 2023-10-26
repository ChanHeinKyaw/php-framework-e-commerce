<?php

namespace App\Controllers;

class ProductController
{
    public function index(){
        view('admin/product/index');
    }

    public function create(){
        view('admin/product/create');
    }

    public function edit(){
        view('admin/product/edit');
    }
}