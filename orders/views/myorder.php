<?php
include '../../includes/functions.php';
include '../../includes/config.php';

session_start();

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
        header("Location:/cafeteria/orders/views/myorder.php");
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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/cafeteria/style/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">cafeteria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/cafeteria/users/views/home.php">Home</a>
                    </li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="#">products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">manual orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">checks</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/cafeteria/orders/views/myorder.php">my orders</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="d-flex person">
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">


                        <?php echo $_SESSION['name'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <form>
                                <button name="logout" class="dropdown-item">logout</button>
                            </form>

                        </li>

                    </ul>
                </li>
            </div>
        </div>
    </nav>

    <?php if ($order_total):  ?>
    <div class="col-lg-6 container tablebx">

        <h1>my orders</h1>
        <form action="filter_order.php" class="filterdate col-lg-8" method="POST">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">from</label>
                        <input type="date" name="from" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">to</label>
                        <input type="date" name="to" class="form-control">
                    </div>
                </div>
            </div>

            <button>filter</button>


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
                            <th><?php echo $order['order_id'] ?></th>
                            <th><?php echo $order['date'] ?></th>
                            <th><?php echo $order['status'] ?></th>
                            <th><?php echo $order['total'] ?></th>
                            <?php if ($order['status'] == 'pending'): ?>

                                <th><a href="/cafeteria/orders/views/myorder.php?cancel=<?php echo $order['order_id'] ?> " class="btn btn-danger">cancel</a> </th>


                            <?php else: ?>
                                <th><button disabled class="btn btn-danger">cancel</button> </th>

                            <?php endif; ?>

                        </tr>
                    <?php endforeach;  ?>


                </tbody>
            </table>

            <div class="productbx col-lg-12">
                <div class="container">
                    <div class="row">
                        <?php foreach ($order_detail as $product): ?>
                            <div class="product col-lg-3">


                                <p class="price"><?php echo $product['price'] ?></p>
                                <img src="../../users/imgs/1738958254_green.jpeg" alt="">

                                <p class="name"><?php echo $product['product_name'] ?></p>
                                <p class="amount"><?php echo $product['quantity'] ?></p>
                                <p class="order">order # <?php echo $product['order_id'] ?></p>

                            </div>

                        <?php endforeach;  ?>
                    </div>
                </div>


                <?php foreach ($all_order_total as $total):  ?>

                    <h2 class="text-center total">TOTAL : EGP <?php echo $total['total']  ?></h2>
                <?php endforeach;  ?>


            </div>
        <?php else: ?>

            <div class="alert alert-danger mt-5 container  col-lg-6 text-center">
                <p> <i class="fa-solid fa-face-sad-tear ms-3"></i>no orders</p>
            </div>
        <?php endif; ?>

    </div>


    <footer>
    <h3>copyright &copy cafeteria All rights reserved</h3>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>