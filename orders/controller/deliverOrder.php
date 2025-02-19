<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
session_start();
$loginStatus=$_SESSION["login"];
if($loginStatus==false)
{
    // header("Location: ./login.php");
    // exit();

}
$fineshOrderId=$_GET['id'];

$cafe=new dataBase();
$cafe->connectToDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$cafe->updateCell('orders','status','completed','order_id',$fineshOrderId);
$cafe->closeConnection();
header("Location: ../views/pendingOrders.php")
?>