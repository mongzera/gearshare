<?php

namespace Src\Middleware;

class Auth{
    public static function verify(){
        return isset($_SESSION['user_id']);
    }

    public static function redirectIfLoggedIn(){
        if(self::verify()) header("Location: /");
    }
}