<?php

use Dotenv\Dotenv;

$dotEnv = Dotenv::createImmutable(APP_ROOT);
$dotEnv->load();
