<?php
namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Session;
use App\Models\Category;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class CategoryController
{
    public function create(){
        $datas = Category::all()->count();
        list($categories, $pages) = paginate(2, $datas, new Category());
        $categories = json_decode(json_encode($categories));
        view('admin/category/create',compact('categories', 'pages'));
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

    public function delete($id){
        $con = Category::destroy($id);

        if($con){
            Session::flash('delete_success', 'Category Delete Successfully!');
            Redirect::to('/admin/category/create');
        }else{
            Session::flash('delete_fail', 'Category Delete Fail!');
            Redirect::to('/admin/category/create');
        }
    }
    
    public function update(){
        $post = Request::get('post');

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name" => ["required" => true, "minLength" => "5", "unique" => "categories"]
            ];

            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if($validator->hasError()){
                http_response_code(422);
                echo json_encode($validator->getErrors());
            }else{
                Category::where("id", $post->id)->update(['name' => $post->name]);
                echo json_encode(["success" => "Category Created Successfully!"]);
            }
        }else{
            http_response_code(422);
            echo json_encode(["error" => "Token Miss Match Exception"]);
        }
    }
}