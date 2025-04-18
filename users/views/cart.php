<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/navbar.php';
require_once '../../includes/classDB.php';
require_once "../../includes/functions.php";
NotAuthRedirectToLogin();
$cafe = new dataBase();
$cafe->connectToDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);


    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/navbar.css">
    <link rel="stylesheet" href="../../style/cart.css">
</head>

<body>
    <?php
    
    if($_SESSION["role"]=="user")
    {
        displayUserNavbar();
    }
    if($_SESSION["role"]=="admin")
    {
        displayAdminNavbar();
    }
        ?>
    <div class="container-fluid   mt-3 animate__animated  animate__fadeInUp">
        <div class="row p-2  mt-3 ">
            <h1 class="my-2 ">Your Cart</h1>
            <?php
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
                if (isset($_GET['error2'])&& !empty($_GET['error2'])){
                    $errors = json_decode($_GET['error2'],true);
                    foreach ($errors as $key => $error) {
                    $productData = $cafe->selectRowData('products', 'product_id', $key);           
                    echo '<div class="alert alert-danger" role="alert" style="font-weight: bold;">'
                    . $error . ' of ' . $productData[0]["product_name"]
                    . ' The Maximum Quantity that we can provide is '
                    . $productData[0]['quantity'] . ' cup</div>';
                    }
                }
            ?>
            <div class="col-9 px-3">

                <?php
            $totalprice = 0;
            // Display cart items
            if (!empty($_SESSION['cart']['products'])) {
                echo '<div class="row  justify-content-start product-container ">';
               
                foreach ($_SESSION['cart']['products'] as $product_id => $quantity) {
                    $productData = $cafe->selectRowData('products', 'product_id', $product_id);
                    echo '<div class="col-12 p-2">';
                    cartItem($productData, $quantity);
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>
            </div>

            <!-- 2nd half of the cart cart summary -->
            <!-- Display total price if cart is not empty -->
            <?php if (empty($_SESSION['cart']['products'])): ?>
            <div class="alert alert-info">Your cart is empty.</div>
            <a href="user-home.php" class="to-home">Go to Home Page to Place Order</a>
            <?php else: ?>
            <div class="col-3">
                <div class="card  cart-details p-3">
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
                        <div class="col-12 text-end">
                            <h5><strong>Total Price: <?php echo number_format($totalprice, 1); ?> L.E</strong></h5>
                        </div>
                    </div>
                    <div class="row my-2">

                        <div class="col-6 mx-auto text-center d-flex justify-content-center ">
                            <a href="../controller/placeOrder.php">Place Order</a>

                        </div>

                    </div>
                </div>
            </div>
            <?php endif ?>
            <?php $cafe->closeConnection() ?>

        </div>
    </div>
    <?php include '../../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../javascript/index.js"></script>
</body>

</html>