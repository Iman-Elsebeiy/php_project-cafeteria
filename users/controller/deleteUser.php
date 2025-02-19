<?php
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';

// var_dump($_GET);

if(isset($_GET["id"])){
    $id = $_GET["id"];
$cafe=new dataBase();
$cafe->connectToDB("localhost", "cafe", "root", "root");
    $cafe->delete_data('users','user_id',$id);
    if(isset($_GET['image'])){
        try{
            unlink($_GET['image']);
        }catch (Exception $e){
            displayError($e->getMessage());
        }
    }
    $cafe->closeConnection();
    header("Location: ../views/allUsers.php");
}else{
    displayError("----- You did not enter an ID -----");
}