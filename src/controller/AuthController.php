<?php

namespace Src\Controller;

use Src\Middleware\Auth;

class AuthController{
    public function create_account(){
        Auth::redirectIfLoggedIn();

        $content = [
            'css' => ['/static/css/create-account.css'],
            'header' => '../src/templates/header.php',
            'body' => '../src/content/create_account.php'
        ];

        include '../src/templates/base.php';
    }

    public function process_create_account(){
        
        include_once '../src/helpers/helper.php';

        $form_names = [
            'username',
            'email',
            'password',
            'confirm_password'
        ];

        if(isAllSet($_POST, $form_names)){
            $values = cleanValues($_POST, $form_names);

            //check if passwords match
            if($values['password'] === $values['confirm_password']){
                $hashedPassword = password_hash($values['password'], PASSWORD_DEFAULT);

                include_once '../src/db/db.php';

                create_user_account($values['username'], $values['email'], $hashedPassword);

                echo 'Account Created Succesfully!';
                self::process_login();
                return;
            }

            
        }
        

        //if theres an error
        self::create_account();
    }

    public function login(){
        Auth::redirectIfLoggedIn();

        $content = [
            'css' => ['/static/css/login.css'],
            'header' => '../src/templates/header.php',
            'body' => '../src/content/login.php'
        ];

        include '../src/templates/base.php';
    }

    public function process_login(){
        include_once '../src/helpers/helper.php';

        $form_names = [
            'username',
            'password',
        ];

        if(isAllSet($_POST, $form_names)){
            $values = cleanValues($_POST, $form_names);

            include_once '../src/db/db.php';

            if(login_user($values)) header("Location: /");
            else header("Location: /login?wrongCredentials=true");
            
        }
    }

    public function logout(){
        $_SESSION = [];
        session_destroy();

        header("Location: /");
        exit();
    }
}