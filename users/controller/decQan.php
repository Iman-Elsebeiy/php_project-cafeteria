<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
session_start();
$id=$_GET['id'];
$loginStatus=$_SESSION["login"];
if($loginStatus==false)
{
    header("Location: /PHP-Project/php_project-cafeteria/users/views/login.php");
    exit();

}

$cafe=new dataBase();
$cafe->connectToDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$quan=$cafe->selectCell('products','quantity','product_id',$id);
if ($_SESSION['cart']['products'][$id]> 1)
{
    // header("Location: ./login.php");
    // exit();

}

$cafe=new dataBase();
$cafe->connectToDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$quan=$cafe->selectCell('products','quantity','product_id',$id);
if ($_SESSION['cart']['products'][$id] > 1) {
    // Decrease quantity if greater than 1
    $_SESSION['cart']['products'][$id]--;
    header("Location: ../views/cart.php");
    exit();
} else {
    // Remove product if quantity reaches 1 and user tries to decrease it
    header("Location: remove_from_cart.php?id=$id");
    exit();
}
?>