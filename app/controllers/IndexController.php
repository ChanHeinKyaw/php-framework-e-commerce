<?php

namespace App\Controllers;

use App\Models\Product;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Redirect;

class IndexController extends BaseController
{
    public function show(){
        $products = Product::all()->count();
        list($products, $pages) = Paginate(8, $products, new Product());
        $products = json_decode(json_encode($products));
        $feature_products = Product::where('features', 2)->get();
        view("home", compact('products', 'pages', 'feature_products'));
    }

    public function cart(){
        $post = Request::get('post');
        Session::replace("cart-items", $post->cart);
    }

    public function showCart(){
        $items = Session::get("cart-items");
        if($items){
            $carts = [];
            foreach($items as $item){
                $carts[] = Product::where('id', $item)->first();
            }
            $products = json_decode(json_encode($carts));
            view("cart", compact('products'));
        }else{
            Redirect::to('/');
        }
    }
}