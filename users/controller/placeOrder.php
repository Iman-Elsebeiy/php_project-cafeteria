<?php

// case of the is error at any this of cart so we will delete order and return to empty

// make some validate using if conditions not fineshed yet :D :D 

require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
session_start();

// validation 
if (!isset($_SESSION['login']) || $_SESSION['login'] == false || !isset($_SESSION['cart']['user_id'])){   

    header("Location:LOGIN"); 
    exit();
}

if (!isset($_SESSION['cart']['products']) || empty($_SESSION['cart']['products']))  {
    // Redirect the user back to the cart
    header("Location: ../views/cart.php");
    exit();
}

// start connection

$cafe=new dataBase();
$cafe->connectToDB("localhost", "cafe", "abdo", "abdo");
$date = date('Y-m-d H:i:s');
// $order_details='';
// $order_data='';
// $oldquantity=0;
// $newQuantity=0;
$order_data=['status'=>'pending','date'=>$date,'user_id'=>$_SESSION['cart']['user_id'],];
// place  pending order with user_id  at table orders and return with order id 
$order_id=$cafe->insert('orders',$order_data);


// place products at table order_products with the order_id
foreach($_SESSION['cart']['products'] as $product_id=>$quantity){

    if ($quantity <= 0) {
        continue; // Ignore invalid quantities
        header("Location: ../views/cart.php?error1=Problem In Quantity");
        unset($_SESSION['cart']);
        $cafe->delete_data('orders','order_id',$order_id);
        exit();
    }

    $order_details=[
        'order_id'=>$order_id,
        'product_id'=>$product_id,
        'quantity'=>$quantity
    ];

    $cafe->insert('order_products',$order_details);

}
// this first loop to check for error and vlaidations 
// case of not exit so every thing is fine 
// so code will continue to 2nd loop to confirm order and chnage the quantity of products 
// case of exit so there is errors 
// and order will delete automaticaly 
foreach ($_SESSION['cart']['products'] as $product_id => $quantity) {

    // Check if the product exists and get its quantity
    $oldquantity = $cafe->selectCell('products', 'quantity', 'product_id', $product_id);
    
    if ($oldquantity === null || $oldquantity === false || $oldquantity == 0  ) {
        // Redirect or show error if product does not exist
        header("Location: ../views/cart.php?error1=Product not found");
        unset($_SESSION['cart']);
        $cafe->delete_data('orders','order_id',$order_id);
        exit();
    }

    // Ensure sufficient stock is available
    if ($oldquantity < $quantity)
    {
        header("Location: ../views/cart.php?error1=Not enough stock");
        unset($_SESSION['cart']);
        $cafe->delete_data('orders','order_id',$order_id);
        exit();

    }

}

foreach ($_SESSION['cart']['products'] as $product_id => $quantity) {
$oldquantity = $cafe->selectCell('products', 'quantity', 'product_id', $product_id);
$newQuantity = $oldquantity - $quantity;
$cafe->updateCell('products', 'quantity', $newQuantity, 'product_id', $product_id);
}



// close connection 

$cafe->closeConnection();
//clear cart
unset($_SESSION['cart']);


// مؤقتا هنروح علي ال pending orders to check 

// No space after "Location:"

header("Location: ../../orders/views/pendingOrders.php"); 