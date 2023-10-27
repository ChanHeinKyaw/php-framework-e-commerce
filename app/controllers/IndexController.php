<?php

namespace App\Controllers;

use App\Models\Product;

class IndexController extends BaseController
{
    public function show(){
        $products = Product::all()->count();
        list($products, $pages) = Paginate(8, $products, new Product());
        $products = json_decode(json_encode($products));
        $feature_products = Product::where('features', 2)->get();
        view("home", compact('products', 'pages', 'feature_products'));
    }
}