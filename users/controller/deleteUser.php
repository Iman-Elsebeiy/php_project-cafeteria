<?php
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
session_start();
$loginStatus=$_SESSION["login"];
if($loginStatus==false)
{
    header("Location: /PHP-Project/php_project-cafeteria/users/views/login.php");
    exit();

$loginStatus=$_SESSION["login"];
if($loginStatus==false)
{  header("Location: /PHP-Project/php_project-cafeteria/users/views/login.php");
    exit();
}

}
if(isset($_GET["id"])){
    $id = $_GET["id"];
$cafe=new dataBase();
$cafe->connectToDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $cafe->delete_data('users','user_id',$id);
    if(isset($_GET['image'])){
        try{
            unlink('../imgs/'.$_GET['image']);
        }catch (Exception $e){
            displayError($e->getMessage());
        }
    }
    $cafe->closeConnection();
    header("Location: ../views/allUsers.php");
}else{
    displayError("----- You did not enter an ID -----");
}