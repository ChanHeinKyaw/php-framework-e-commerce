<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Models\SubCategory;
use App\Classes\ValidateRequest;

class SubCategoryController
{
    public function create(){
        $post = Request::get('post');

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name" => ["minLength" => "5", "unique" => "sub_categories"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if($validator->getErrors()){
                http_response_code(422);
                echo json_encode($validator->getErrors());
                exit;
            }else{
                $sub_categorie = new SubCategory();
                $sub_categorie->name = $post->name;
                $sub_categorie->cat_id = $post->parent_cat_id;
                if($sub_categorie->save()){
                    echo json_encode(["success" => "Sub Category Created Successfully!"]);
                    exit;
                }else{
                    http_response_code(422);
                    echo json_encode(["error" => "Sub Category Created Fail!"]);
                    exit;
                }
                exit;
            }
        }else{
            http_response_code(422);
            echo json_encode(["error" => "Token Miss Match Exception"]);
            exit;
        }
    }

    public function update(){
        $post = Request::get('post');

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name" => ["minLength" => "5", "unique" => "sub_categories"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if($validator->getErrors()){
                http_response_code(422);
                echo json_encode($validator->getErrors());
                exit;
            }else{
                SubCategory::where('id', $post->id)->update(['name' => $post->name]);
                echo json_encode(["update" => "Sub Category Updated Successfully!"]);
                exit;
            }
        }else{
            http_response_code(422);
            echo json_encode(["error" => "Token Miss Match Exception"]);
            exit;
        }
    }

    public function delete($id){
        $con = SubCategory::destroy($id);

        if($con){
            Session::flash('delete_success', 'Sub Category Delete Successfully!');
            Redirect::to('/admin/category/create');
        }else{
            Session::flash('delete_fail', 'Sub Category Delete Fail!');
            Redirect::to('/admin/category/create');
        }
    }
}