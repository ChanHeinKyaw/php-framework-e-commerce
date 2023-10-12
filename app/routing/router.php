<?php

$router = new AltoRouter();

$router->map("GET","/public","","Home Route");

$match = $router->match();

if($match){
    echo "Match";
}else{
    echo "Not Match";
}