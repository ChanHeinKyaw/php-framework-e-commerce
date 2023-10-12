<?php

use App\Routing\RouteDispatcher;

$router = new AltoRouter();

$router->map("GET","/","app\controllers\BaseController@show","Home Route");

new RouteDispatcher($router);