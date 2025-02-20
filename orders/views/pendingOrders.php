<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
$cafe=new dataBase();
$cafe->connectToDB("localhost", "cafe", "root", "root");
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
    <link rel="stylesheet" href="../../style/navbar.css">

</head>

<body>
    <?php 
    displayAdminNavbar($_SESSION["image"]);
    ?>
    <div class="container mt-100 ">


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


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../javascript/index.js"></script>

</body>