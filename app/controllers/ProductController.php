<?php

namespace App\Controllers;

use App\Models\Product;
use App\Classes\Request;
use App\Classes\Session;
use App\Models\Category;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Classes\UploadFile;
use App\Models\SubCategory;
use App\Classes\ValidateRequest;

class ProductController
{
    protected $path;
    public function index(){
        $datas = Product::all()->count();
        list($products, $pages) = paginate(4, $datas, new Product());
        $products = json_decode(json_encode($products));
        view('admin/product/index', compact('products', 'pages'));
    }

    public function create(){
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        view('admin/product/create',compact('categories','sub_categories'));
    }

    public function edit($id){
        $product = Product::where('id',$id)->first();
        $categories = Category::all();
        $sub_categories = SubCategory::all();

        view('admin/product/edit',compact('product','categories','sub_categories'));
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
                if(!empty($file->file->name)){
                    $uploadFile = new UploadFile();
                    if($uploadFile->move($file)){
                        $path = $uploadFile->getPath();
                        $product = new Product();
                        $product->name = $post->name;
                        $product->price = $post->price;
                        $product->cat_id = $post->cat_id;
                        $product->sub_cat_id = $post->sub_cat_id;
                        $product->image = $path;
                        $product->description = $post->description;

                        if($product->save()){
                            $products = Product::all();
                            Session::flash("product_insert_success","Product Successfully Created!");
                            Redirect::to('/admin/product',compact('products'));
                        }else{
                            $errors = ["Problem Insert Product To Database"];
                            $categories = Category::all();
                            $sub_categories = SubCategory::all();
                            view('admin/product/create',compact('categories','sub_categories','errors'));
                        }
                    }else{
                        $errors = ["Token Miss Match Error!"];
                        $categories = Category::all();
                        $sub_categories = SubCategory::all();
                        view('admin/product/create',compact('categories','sub_categories','errors'));
                    }
                }else{
                    $errors = ["Please Check Picture Size And Type!"];
                    $categories = Category::all();
                    $sub_categories = SubCategory::all();
                    view('admin/product/create',compact('categories','sub_categories','errors'));
                }
            }
        }else{
            $errors = ["Please Support Image File!"];
            $categories = Category::all();
            $sub_categories = SubCategory::all();
            view('admin/product/create',compact('categories','sub_categories','errors'));
        }
    }

    public function update($id){
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
                $product = Product::where('id',$id)->first();
                view("admin/product/edit", compact("categories","sub_categories","errors","product"));
            }else{
                if(!empty($file->file->name)){
                    $uploadFile = new UploadFile();
                    $uploadFile->move($file);
                    $this->path = $uploadFile->getPath();
                }else{
                    $this->path = $post->old_image;
                }
                $product = Product::where('id',$id)->first();
                $product->name = $post->name;
                $product->price = $post->price;
                $product->cat_id = $post->cat_id;
                $product->sub_cat_id = $post->sub_cat_id;
                $product->image = $this->path;
                $product->description = $post->description;

                if($product->update()){
                    Session::flash("product_update_success","Product Successfully Updated!");
                    $categories = Category::all();
                    $sub_categories = SubCategory::all();
                    $product = Product::where('id',$id)->first();
                    view("admin/product/edit", compact("categories","sub_categories","product"));
                }else{
                    $errors = ["Problem Update Product To Database"];
                    $categories = Category::all();
                    $sub_categories = SubCategory::all();
                    $product = Product::where('id',$id)->first();
                    view('admin/product/edit',compact('categories','sub_categories','errors','product'));
                }

            }
        }else{
            $errors = ["Please Support Image File!"];
            $categories = Category::all();
            $sub_categories = SubCategory::all();
            $product = Product::where('id',$id)->first();
            view('admin/product/edit',compact('categories','sub_categories','errors','product'));
        }
    }

    public function delete($id){
        $con = Product::destroy($id);

        if($con){
            Session::flash('delete_success', 'Product Delete Successfully!');
            Redirect::to('/admin/product');
        }else{
            Session::flash('delete_fail', 'Product Delete Fail!');
            Redirect::to('/admin/product');
        }
    }

}

    
