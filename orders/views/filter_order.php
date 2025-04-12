<?php
    include '../../includes/functions.php';
    include '../../includes/config.php';
     include '../../includes/utils.php';
     include '../../includes/navbar.php';

    // session_start();
    if($_SESSION['role']=='admin'){
        header('Location:/PHP-Project/php_project-cafeteria/users/views/admin-home.php');
    }
    LogOut();

    NotAuthRedirectToLogin();

    // order detail
    try{
    $user_id = $_SESSION['id'];
    $from= $_POST['from'];
    $to=$_POST['to'];

    $select_order_detail = "SELECT * FROM `order_detail` WHERE (user_id=$user_id) and date between '$from' and '$to' order by order_id ";
    $stm1 = $pdo->prepare($select_order_detail);
    $stm1->execute();
    $order_detail = $stm1->fetchAll(PDO::FETCH_ASSOC);


    // order total
    $select_orders_total = "SELECT * FROM `orders_total` WHERE (user_id=$user_id) and date between '$from' and '$to'";
    $stm2 = $pdo->prepare($select_orders_total);
    $stm2->execute();
    $order_total = $stm2->fetchAll(PDO::FETCH_ASSOC);


    // all order total
    $select_all_orders_total = "SELECT sum(total) as total FROM `orders_total` WHERE (user_id=$user_id) and date between '$from' and '$to'";
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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/navbar.css">
    <link rel="stylesheet" href="../../style/myorder.css"> <!-- Add myorder.css -->
</head>

<body>

    <?php
 displayUserNavbar();
 ?>
    <?php if ($order_total):  ?>

    <div class="container-fluid  col-11 mx-auto myorder mt-5 p-5 animate__animated  animate__fadeInUp ">

        <div class="row">
            <div class="col-12 mb-4 ">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">My Orders</h2>
                    <?php foreach ($all_order_total as $total): ?>
                    <h4 class="total mb-0">Total: <?php echo number_format($total['total'], 2) ?> EGP</h4>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Filter Form -->
            <div class="col-12 mb-4">
                <form action="filter_order.php" class="filter-form" method="POST">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">From</label>
                            <input type="date" name="from" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">To</label>
                            <input type="date" name="to" class="form-control">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn filter-btn w-100">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Orders Table -->
            <div class="col-12 mb-4">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order </th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_total as $order): ?>
                            <tr>
                                <td><?php echo $order['order_id'] ?></td>
                                <td><?php echo $order['date'] ?></td>
                                <td><span
                                        class="status-badge <?php echo strtolower($order['status']) ?>"><?php echo $order['status'] ?></span>
                                </td>
                                <td><?php echo number_format($order['total'], 2) ?> EGP</td>
                                <td>
                                    <?php if ($order['status'] == 'pending'): ?>
                                    <a href="?cancel=<?php echo $order['order_id'] ?>" class="btn cancel-btn">Cancel</a>
                                    <?php else: ?>
                                    <button disabled class="btn cancel-btn disabled">Cancel</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <!-- Order Products -->
                            <tr class="order-products">
                                <td colspan="5">
                                    <div class="row g-3">
                                        <?php 
                                                foreach ($order_detail as $product): 
                                                    if ($product['order_id'] == $order['order_id']):
                                                ?>
                                        <div class="col-md-4">
                                            <div class="product-card d-flex">
                                                <div class="col-2 p-2">
                                                    <img src="../../products/imgs/<?php echo $product['image'] ?>"
                                                        alt="<?php echo $product['product_name'] ?>">
                                                </div>
                                                <div class="product-details">
                                                    <h5><?php echo $product['product_name'] ?></h5>
                                                    <p class="price">
                                                        <?php echo number_format($product['price'], 2) ?>
                                                        EGP</p>
                                                    <p class="quantity">Quantity:
                                                        <?php echo $product['quantity'] ?></p>

                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                                    endif;
                                                endforeach; 
                                                ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="empty-state text-center py-5">
            <p class="fs-5 mb-4">You Don't Have Any Orders Yet</p>
            <a href="/PHP-Project/php_project-cafeteria/users/views/user-home.php" class="btn shop-btn">Go To Shop</a>
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