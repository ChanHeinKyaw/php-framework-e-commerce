<?php

use App\Routing\RouteDispatcher;

$router = new AltoRouter();

$router->map("GET","/","BaseController@index","Home Route");

new RouteDispatcher($router);