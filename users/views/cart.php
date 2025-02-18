<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
$cafe = new dataBase();
$cafe->connectToDB("localhost", "cafe", "abdo", "abdo");
session_start();
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
    <div class="container">
        <div class="row p-1 m-5">
            <h1 class="my-4">Your Cart</h1>
            <div class="row col-6">
                <?php
            $totalprice = 0;
            // Handle error messages
            if (isset($_GET['error'])) {
                $errors = json_decode($_GET['error']);
                foreach ($errors as $key => $error) {
                    $productData = $cafe->selectRowData('products', 'product_id', $key);           
                    echo '<div class="alert alert-danger mb-3 mt-1" role="alert" style="font-weight: bold;">'
                        . $error . ' of ' . $productData[0]["product_name"]
                        . ' The Maximum Quantity that we can provide is '
                        . $productData[0]['quantity'] . ' cup</div>';
                }
            }

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
            <?php else: ?>
            <div class="col-6">
                <div class="card p-4">
                    <h3 class="mb-4">Cart Summary</h3>

                    <!-- Loop through each product in the cart -->
                    <?php foreach ($_SESSION['cart']['products'] as $product_id => $quantity){

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
                            <a href="../controller/placeOrder.php" class="btn btn-success btn-lg">Place Order</a>
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