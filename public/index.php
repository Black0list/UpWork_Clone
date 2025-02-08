<?php

use App\core\Application;

require_once dirname(__DIR__, 1)."\\vendor\\autoload.php";

session_start();

$app = new Application(dirname(__DIR__, 1));

//$routes = require_once __DIR__ . "/routes.php";
//var_dump($routes);
//foreach ($routes as $method => $routeList) {
//    foreach ($routeList as $path => $handler) {
//        $app->Router->{strtolower($method)}($path, $handler);
//    }
//}

$app->run();



