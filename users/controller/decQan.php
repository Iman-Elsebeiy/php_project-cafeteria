<?php

require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';



session_start();
$id=$_GET['id'];

$cafe=new dataBase();
$cafe->connectToDB("localhost", "cafe", "abdo", "abdo");
$quan=$cafe->selectCell('products','quantity','product_id',$id);
if ($_SESSION['cart']['products'][$id]> 1)
{
    $_SESSION['cart']['products'][$id]--;
    header("Location: ../views/cart.php");


}else
{
    header("Location: remove_from_cart.php?id=$id");
}


?>