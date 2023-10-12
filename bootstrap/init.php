<?php

use App\Classes\Database;

if(!isset($_SESSION)) session_start();

define("APP_ROOT", realpath(__DIR__."/../"));
define("URL_ROOT", "http://localhost:800/");

require_once APP_ROOT . "/vendor/autoload.php";
require_once APP_ROOT . "/app/config/_env.php";
new Database();
require_once APP_ROOT . "/app/routing/router.php";