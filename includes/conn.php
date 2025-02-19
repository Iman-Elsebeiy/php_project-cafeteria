<?php

require_once "utils.php";

// .env
const DB_HOST = "localhost";
const DB_USER = "iman";
const DB_PASS = "iman";
const DB_PORT  = 3306;
const DB_NAME = "cafe";

function connectToDB() {
    $dbname= DB_NAME;
    $db_host= DB_HOST;
    # use pdo
    try{
        $pdo = new PDO("mysql:dbname={$dbname};host={$db_host}",DB_USER,DB_PASS);
    //    var_dump($pdo);
        return $pdo; 

    }catch (PDOException $e){
        displayError($e->getMessage());
    }
}

// connectToDB();