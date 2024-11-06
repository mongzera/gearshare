<?php

session_start();

include '../vendor/autoload.php';
require_once '../src/routes.php';

$router = new AltoRouter();

create_routes($router);

$match = $router->match();

if($match){
    list($controller, $controllerMethod) = explode('::', $match['target']);
    $controller = "Src\Controller\\$controller";
    $controller = new $controller();

    call_user_func_array([$controller, $controllerMethod], $match['params']);

}