<?php
session_start();
$loginStatus=$_SESSION["login"];
if($loginStatus==false)
{
    header("Location: /PHP-Project/php_project-cafeteria/users/views/login.php");
    exit();

}
// validation 


if (!isset($_SESSION['login']) || $_SESSION['login'] == false || !isset($_SESSION['cart']['user_id'])){   

    // header("Location: ../views/login.php");
    // exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    // header("Location: ../views/cart.php?error1=Invalid product ID");
    // exit();
}


$id=$_GET['id'];



unset($_SESSION['cart']['products'][$id]);
header("Location: ../views/cart.php?succ=Product removed successfully")

?>