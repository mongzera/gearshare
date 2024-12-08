<?php

namespace Src\Controller;

use Src\Middleware\Auth;

class AuthController{
    public function create_account($create_account_error = null){
        Auth::redirectIfLoggedIn();

        $content = [
            'css' => ['/static/css/auth.css'],
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

        $create_account_error = null;

        $username_pattern = "/^[a-zA-Z0-9_-]{3,15}$/";
        $email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+={}\[\]:;<>,.?~\\/-]{8,}$/";

        if(isAllSet($_POST, $form_names)){
            $values = cleanValues($_POST, $form_names);

            //form validation
            if($values['password'] != $values['confirm_password']) $create_account_error = "Password does not match!";
            if(!preg_match($password_pattern, $values['password'])) $create_account_error = "Incorrect password value!";
            if(!preg_match($email_pattern, $values['email'])) $create_account_error = "Incorrect email value!";
            if(!preg_match($username_pattern, $values['username'])) $create_account_error = "Incorrect username value!";
            

            if($create_account_error != null){
                return self::create_account($create_account_error);
            }

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
            'css' => ['/static/css/auth.css'],
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