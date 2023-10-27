<?php

use App\Routing\RouteDispatcher;

$router = new AltoRouter();

$router->map("GET","/","App\Controllers\IndexController@show","Home Route");

//admin route
$router->map('GET','/admin',"App\Controllers\AdminController@index","Admin Home");
$router->map("GET","/admin/category/create","App\Controllers\CategoryController@create","Category Create");
$router->map("POST","/admin/category/create","App\Controllers\CategoryController@store","Category Store");
$router->map("GET","/admin/category/[i:id]/delete","App\Controllers\CategoryController@delete","Category Delete");
$router->map("POST","/admin/category/update","App\Controllers\CategoryController@update","Category Update");
$router->map("POST","/admin/subcategory/create","App\Controllers\SubCategoryController@create","Sub Category Create");
$router->map("POST","/admin/subcategory/update","App\Controllers\SubCategoryController@update","Sub Category Update");
$router->map("GET","/admin/subcategory/[i:id]/delete","App\Controllers\SubCategoryController@delete","Sub Category Delete");
$router->map("GET","/admin/product","App\Controllers\ProductController@index","Product Index");
$router->map("GET","/admin/product/create","App\Controllers\ProductController@create","Product Create");
$router->map("GET","/admin/product/[i:id]/edit","App\Controllers\ProductController@edit","Product Edit");
$router->map("POST","/admin/product","App\Controllers\ProductController@store","Product Store");
$router->map("POST","/admin/product/[i:id]/edit","App\Controllers\ProductController@update","Product Update");

new RouteDispatcher($router);