<?php
session_start();
$id=$_GET['id'];
unset($_SESSION['cart']['products'][$id]);
header("Location: ../views/cart.php")

?>