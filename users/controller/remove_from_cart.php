<?php
session_start();
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