<?php
// make some validate using if conditions not fineshed yet :D :D 

require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
// start connection

$cafe=new dataBase();
$cafe->connectToDB("localhost", "cafe", "abdo", "abdo");
$date = date('Y-m-d H:i:s');
session_start();
$order_details='';
$order_data='';
$order_data=['status'=>'pending','date'=>$date,'user_id'=>$_SESSION['cart']['user_id'],];
// place  pending order with user_id  at table orders and return with order id 
$order_id=$cafe->insert('orders',$order_data);
print_r($order_id);
echo'<br>';
print_r($order_data);
echo'<br>';


// place products at table order_products with the order_id
foreach($_SESSION['cart']['products'] as $product_id=>$quantity){
$order_details=[
    'order_id'=>$order_id,
    'product_id'=>$product_id,
    'quantity'=>$quantity
];

print_r($order_details);
echo'<br>';
$cafe->insert('order_products',$order_details);
}


// close connection 

$cafe->closeConnection();
//clear cart
unset($_SESSION['cart']);


// مؤقتا هنروح علي ال pending orders to check 


header("Location: ../../orders/views/pendingOrders.php"); // No space after "Location:"