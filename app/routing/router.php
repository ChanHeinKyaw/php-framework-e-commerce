<?php

use App\Routing\RouteDispatcher;

$router = new AltoRouter();

$router->map("GET","/","App\Controllers\IndexController@show","Home Route");

new RouteDispatcher($router);