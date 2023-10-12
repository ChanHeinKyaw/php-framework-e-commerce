<?php

use Dotenv\Dotenv;

define("APP_ROOT", realpath(__DIR__."/../../"));

require_once APP_ROOT . "/vendor/autoload.php";

$dotEnv = Dotenv::createImmutable(APP_ROOT);

$dotEnv->load();
