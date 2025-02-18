<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
?>

<?php

$fineshOrderId=$_GET['id'];

$cafe=new dataBase();
$cafe->connectToDB("localhost", "cafe", "root", "root");
$cafe->updateCell('orders','status','completed','order_id',$fineshOrderId);
$cafe->closeConnection();
header("Location: ../views/pendingOrders.php")
?>