<?php

require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';

session_start();
$id=$_GET['id'];

$cafe=new dataBase();
$cafe->connectToDB("localhost", "cafe", "abdo", "abdo");
$quan=$cafe->selectCell('products','quantity','product_id',$id);
if ( $quan >$_SESSION['cart']['products'][$id])
{
    $_SESSION['cart']['products'][$id]++;
    // $_SESSION['cart'][$id]=119;
    header("Location: ../views/cart.php");


}else
{
    $error = [$id=>'*You have reached the maximum quantity limit'];
    $error = json_encode($error); 
    header("Location: ../views/cart.php?error=" . $error);
}


?>