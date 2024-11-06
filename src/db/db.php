<?php

function db_connect(){
    $host = "localhost";        
    $db_name = "ecommerce_db";  // Database name
    $username = "root";      // Database username
    $password = "";      // Database password

    try{
        $conn = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch(PDOException $e){
        echo 'cannot connect to database! <br>' . $e->getMessage();
    }

    return null;
}

function run_query($query, $params = []){
    $conn = db_connect();

    try{
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }catch(PDOException $e){
        echo 'cannot perform query <br>' . $e->getMessage();
    }

    return null;
}

function retrieve_items(  ){
    $result = run_query("SELECT * FROM tb_items");

    if($result) {
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    return null;
}

function create_user_account($username, $email, $hashed_password){
    $query = "
        INSERT INTO tb_user (username, email, password) VALUES (?, ?, ?);
    ";

    $result = run_query($query, [$username, $email, $hashed_password]);
}

function get_user($username){
    $query = "
        SELECT * FROM tb_user WHERE username = ?;
    ";

    $result = run_query($query, [$username]);

    if($result) {
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        if(count($data) > 1){
            echo 'Data error! Multiple Accounts detected!';
            return null;
        }

        return $data[0];
    }

    return null;
}