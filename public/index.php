<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once "../bootstrap/init.php";

$user = Capsule::table("users")->where('id',1)->get();
echo "<pre>" . print_r($user,true). "</pre>";