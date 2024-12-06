<?php

function create_routes($router){

    create_get_routes($router);
    create_post_routes($router);
}

function create_get_routes($router){
    $router->map("GET", "/", 'PublicController::index', 'home');
    $router->map("GET", "/itemview/[i:itemId]", "PublicController::itemView", 'item_view');
    $router->map("GET", "/create-account", 'AuthController::create_account', 'create_account');
    $router->map("GET", "/login", "AuthController::login", "login");
    $router->map("GET", "/logout", "AuthController::logout", "logout");
}

function create_post_routes($router){
    $router->map("POST", "/create-account", 'AuthController::process_create_account', 'process_create_account');
    $router->map("POST", "/login", "AuthController::process_login", "process_login");
}