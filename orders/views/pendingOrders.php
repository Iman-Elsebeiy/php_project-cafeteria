<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
$cafe=new dataBase();
$cafe->connectToDB("localhost", "cafe", "abdo", "abdo");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending-Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style/style.css">

</head>

<body>
    <div class="container  ">


        <?php


            // this is page for all pending orders 
            // i will create view for pending orders at my Database then i will select the view and display it 
            $pendingOrdersIds = $cafe->getPendingOrderIds();
            if (count($pendingOrdersIds)==0)
            {
                echo '<div class="alert alert-success m-3 "> Welldone ! There is no pending orders.</div>';
            }
            else{

            foreach ($pendingOrdersIds as $orderId) {
                // Fetch order details
                $orderData = $cafe->selectRowData('pending_orders', 'order_id', $orderId);                
                // Display order details table
                drawActiveOrder($orderData);
                // Fetch products within the order
                $orderProducts = $cafe->selectRowData('pending_order_details', 'order_id', $orderId);
                // Display products for this order
                drawActiveOrderDetails($orderProducts);
            }
        }     

            $cafe->closeConnection();
            
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>