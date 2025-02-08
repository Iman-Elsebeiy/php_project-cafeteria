<?php

require "../includes/utils.php";
require_once "../pdo/classDB.php";

var_dump($_GET);

if(isset($_GET["id"])){
    $id = $_GET["id"];
$cafe=new dataBase();
$cafe->connectToDB("localhost", "cafe", "abdo", "abdo");
    $cafe->delete_data('users',$id);
    if(isset($_GET['image'])){
        try{
            unlink($_GET['image']);
        }catch (Exception $e){
            displayError($e->getMessage());
        }
    }
    $cafe->closeConnection();
    header("Location: allUsers.php");
}else{
    displayError("----- You did not enter an ID -----");
}