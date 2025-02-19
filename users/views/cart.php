<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
require_once "../controller/home.php";

$cafe = new dataBase();
$cafe->connectToDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
session_start();
$_SESSION["user_id"]=37;
extract(getUserData($_SESSION["user_id"]));
$_SESSION["role"]=$role;
$loginStatus=$_SESSION["login"];

if($loginStatus==false)
{
    // header("Location: ./login.php");
    // exit();

}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <?php
    
if($role=="user")
{
    displayUserNavbar($image,$cart);}
if($role=="admin")
{
    displayAdminNavbar($image,$cart,$cart_userName);
}

if (isset($_GET['error'])){
    $errors = json_decode($_GET['error']);
    foreach ($errors as $key => $error) {
    $productData = $cafe->selectRowData('products', 'product_id', $key);           
    echo '<div class="alert alert-danger mb-3 mt-1" role="alert" style="font-weight: bold;">'
    . $error . ' of ' . $productData[0]["product_name"]
    . ' The Maximum Quantity that we can provide is '
    . $productData[0]['quantity'] . ' cup</div>';
    }
}

    if (isset($_GET['error1'])){
    $errors = json_decode($_GET['error1']);
    echo'
    <div class="alert alert-danger">'
        . htmlspecialchars($_GET['error1'])
        . '</div>
    ';
    }
    if (isset($_GET['succ'])){
    $errors = json_decode($_GET['succ']);
    echo'
    <div class="alert alert-success">'
        . htmlspecialchars($_GET['succ'])
        . '</div>
    ';
    }

    ?>

    <div class="container">
        <div class="row p-1 m-5">
            <h1 class="my-4">Your Cart</h1>
            <div class="row col-6">

                <?php
            $totalprice = 0;
            // Display cart items
            if (!empty($_SESSION['cart']['products'])) {
                echo '<div class="card p-2">';
                echo '<div class="row justify-content-center ">';
                foreach ($_SESSION['cart']['products'] as $product_id => $quantity) {
                    $productData = $cafe->selectRowData('products', 'product_id', $product_id);
                    cartItem($productData, $quantity);
                }
                echo '</div>';
                echo '</div>';
            }
            ?>
            </div>

            <!-- 2nd half of the cart cart summary -->
            <!-- Display total price if cart is not empty -->
            <?php if (empty($_SESSION['cart']['products'])): ?>
            <div class="alert alert-info">Your cart is empty.</div>
            <a href="user-home.php" class="btn btn-info ad">Go to Home Page to Place Order</a>
            <?php else: ?>
            <div class="col-6">
                <div class="card p-4">
                    <h3 class="mb-4">Cart Summary</h3>

                    <!-- Loop through each product in the cart -->
                    <?php 
                    foreach ($_SESSION['cart']['products'] as $product_id => $quantity){
                    $productData = $cafe->selectRowData('products', 'product_id', $product_id);
                    $productTotalPrice = $productData[0]['price'] * $quantity;
                    $totalprice=$productTotalPrice+$totalprice;
                    itemSummary($productData,$productTotalPrice);
                    }
                    ?>


                    <div class="row mt-4">
                        <div class="col-8 text-end">
                            <h5><strong>Total Price: <?php echo number_format($totalprice, 1); ?> L.E</strong></h5>
                        </div>
                    </div>
                    <div class="row mt-4">

                        <div class="col-12 text-center">
                            <?php
                        
                        if (isset($_GET['error']) || isset($_GET['error1'])){
                            // echo '<a class="btn btn-danger btn-lg ">Place Order</a>';
                            echo '<a  href="../controller/placeOrder.php" class="btn ad  btn-lg ">Place Order</a>';


                        }else{
                            echo '<a  href="../controller/placeOrder.php" class="btn ad  btn-lg ">Place Order</a>';

                        }
                        ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php endif ?>
            <?php $cafe->closeConnection() ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>