<?php
include '../../includes/functions.php';
include '../../includes/config.php';
include '../../includes/utils.php';
// session_start();
if($_SESSION['role']=='admin'){
    header('Location:/PHP-Project/php_project-cafeteria/users/views/admin-home.php');
}
LogOut();

NotAuthRedirectToLogin();
try {
    // order detail
    $user_id = $_SESSION['id'];
    $select_order_detail = "SELECT * FROM `order_detail` WHERE user_id=$user_id order by order_id";
    $stm1 = $pdo->prepare($select_order_detail);
    $stm1->execute();
    $order_detail = $stm1->fetchAll(PDO::FETCH_ASSOC);


    // order total
    $select_orders_total = "SELECT * FROM `orders_total` WHERE user_id=$user_id";
    $stm2 = $pdo->prepare($select_orders_total);
    $stm2->execute();
    $order_total = $stm2->fetchAll(PDO::FETCH_ASSOC);


    // all order total
    $select_all_orders_total = "SELECT sum(total) as total FROM `orders_total` WHERE user_id=$user_id";
    $stm3 = $pdo->prepare($select_all_orders_total);
    $stm3->execute();
    $all_order_total = $stm3->fetchAll(PDO::FETCH_ASSOC);



    // cancel order

    if (isset($_GET['cancel'])) {
        $order_id = $_GET['cancel'];
        $delete_order = "DELETE FROM orders WHERE orders.order_id=$order_id";
        $stm = $pdo->prepare($delete_order);
        $stm->execute();
        $pdo = null;
        header("Location:/PHP-Project/php_project-cafeteria/orders/views/myorder.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/PHP-Project/php_project-cafeteria/style/style.css">
    <link rel="stylesheet" href="../../style/navbar.css">
</head>

<body>

    <?php
    // var_dump($_SESSION["image"]);
    // exit;
     displayUserNavbar($_SESSION["image"]);
             ?>
    <?php if ($order_total):  ?>
    <div class="container myorder tablebx mt-100">
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-end">
                <h1>My Orders</h1>
                <?php foreach ($all_order_total as $total):  ?>

                <h2 class="text-center total ">TOTAL : EGP
                    <?php echo $total['total']  ?>
                </h2>
            </div>
            <?php endforeach;  ?>
            <form action="filter_order.php" class="filterdate col-lg-12" method="POST">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-end gap-3 w-100">
                        <div class="col-4">
                            <label for="exampleFormControlInput1" class="form-label">from</label>
                            <input type="date" name="from" class="form-control w-100">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1" class="form-label">to</label>
                            <input type="date" name="to" class="form-control w-100">
                        </div>
                        <button>filter</button>
                    </div>

                </div>




            </form>



            <table class="table tablee">
                <thead>
                    <tr>
                        <th scope="col">order #</th>
                        <th scope="col">order date</th>
                        <th scope="col">status</th>
                        <th scope="col">amount</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($order_total as $order):  ?>

                    <tr>
                        <th>
                            <?php echo $order['order_id'] ?>
                        </th>
                        <th>
                            <?php echo $order['date'] ?>
                        </th>
                        <th>
                            <?php echo $order['status'] ?>
                        </th>
                        <th>
                            <?php echo $order['total'] ?>
                        </th>
                        <?php if ($order['status'] == 'pending'): ?>

                        <th><a href="/PHP-Project/php_project-cafeteria/orders/views/myorder.php?cancel=<?php echo $order['order_id'] ?> "
                                class="btn ">cancel</a> </th>


                        <?php else: ?>
                        <th><button disabled class="btn ">cancel</button> </th>

                        <?php endif; ?>

                    </tr>
                    <?php endforeach;  ?>


                </tbody>
            </table>
        </div>
        <div class="productbx col-lg-10 mx-auto">
            <div class="container">
                <div class="row g-2">

                    <?php foreach ($order_detail as $product): ?>

                    <div class=" col-3 ">
                        <div class="product">


                            <p class="price">
                                <?php echo $product['price'] ?>
                            </p>
                            <img src="../../products/imgs/<?php echo $product['image'] ?>" alt="">

                            <p class="name">
                                <?php echo $product['product_name'] ?>
                            </p>
                            <p class="amount">
                                <span>quantity:</span>
                                <?php echo $product['quantity'] ?>
                            </p>
                            <p class="order">order #
                                <?php echo $product['order_id'] ?>
                            </p>

                        </div>
                    </div>

                    <?php endforeach;  ?>
                </div>
            </div>





        </div>
        <?php else: ?>

        <div class="alert alert-danger  container mt-100 col-lg-6 text-center ">
            <p> <i class="fa-solid fa-face-sad-tear ms-3"></i> You Dont Have Any Orders Yet </p>
            <a class="btn add" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php">Go To Shop</a>
        </div>

        <?php endif; ?>

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