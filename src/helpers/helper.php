<?php



function isAllSet($arr, $params){
    foreach($params as $param){
        if(!isset($arr[$param])) return false;
    }

    return true;
}

function cleanValues($arr, $params){
    $valued_arr = [];

    foreach($params as $param){
        //echo htmlspecialchars($arr[$param]);
        $valued_arr[$param] = htmlspecialchars($arr[$param]);
    }

    return $valued_arr;
}

function login_user($values){
    $user = get_user($values['username']);

    //check password
    if(!$user){
        return false;
    }

    if(!password_verify($values['password'], $user['password'])){
        return false;
    }
    
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];

    return true;
}

function redirect($uri){
    header("Location: " . $uri);
}