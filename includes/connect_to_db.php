<?php

     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     ini_set('SMTP', 'smtp.mailtrap.io');
     ini_set('smtp_port', '2525');
     error_reporting(E_ALL);

    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';

    # I will add the commonly used parts
    

    # 1- define function generate title
    function generate_title($message, $size=1, $color='black'){
        echo '<hr>';
        echo "<h{$size}  style='color:{$color}' class='text-center'>{$message}</h{$size}>";

    }
    function displayError($errorMessage){
        echo "<h5 style='color: red'> {$errorMessage} </h5>";
        
    }
// .env
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_PORT  = 3306;
const DB_NAME = "cafe";

function connectToDB() {
    $dbname= DB_NAME;
    $db_host= DB_HOST;
    # use pdo
    try{
        $pdo = new PDO("mysql:dbname={$dbname};host={$db_host}",DB_USER,DB_PASS);
//        var_dump($pdo);
        return $pdo; 

    }catch (PDOException $e){
        displayError($e->getMessage());
    }
}
