<?php

use App\Routing\RouteDispatcher;

$router = new AltoRouter();

$router->map("GET","/","App\Controllers\IndexController@show","Home Route");

//admin route
$router->map('GET','/admin',"App\Controllers\AdminController@index","Admin Home");
$router->map("GET","/admin/category/create","App\Controllers\CategoryController@create","Category Create");
$router->map("POST","/admin/category","App\Controllers\CategoryController@store","Category Store");

new RouteDispatcher($router);