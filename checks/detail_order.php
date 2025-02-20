<?php
require_once '../includes/connect_to_db.php';
require_once '../includes/utils.php';
require_once "../includes/functions.php";

if($_SESSION['role']=='user'){
  header('Location:/PHP-Project/php_project-cafeteria/users/views/user-home.php');
}
NotAuthRedirectToLogin();
 
$pdo = connectToDB();
 
if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}
 
$orderId = $_GET['order_id'];
 
$orderStmt = $pdo->prepare("
    SELECT orders.*, users.name, users.room_no
    FROM orders
    JOIN users ON orders.user_id = users.user_id
    WHERE orders.order_id = ?
");
$orderStmt->execute([$orderId]);
$order = $orderStmt->fetch(PDO::FETCH_ASSOC);
 
if (!$order) {
    die("Order not found.");
}
//  product details in order
$itemStmt = $pdo->prepare("
    SELECT order_products.*,
           products.product_name,
           products.price,
           products.image,
           (order_products.quantity * products.price) AS total_price
    FROM order_products
    JOIN products ON order_products.product_id = products.product_id
    WHERE order_products.order_id = ?
");
$itemStmt->execute([$orderId]);
$items = $itemStmt->fetchAll(PDO::FETCH_ASSOC);
 
//  VIEW
$orderTotalStmt = $pdo->prepare("SELECT total_price FROM order_total_price WHERE order_id = ?");
$orderTotalStmt->execute([$orderId]);
$totalOrderPrice = $orderTotalStmt->fetchColumn();
 
// VIEW
$customerTotalStmt = $pdo->prepare("SELECT total_spent FROM customer_total_orders WHERE user_id = ?");
$customerTotalStmt->execute([$order['user_id']]);
$customerTotalSpent = $customerTotalStmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/navbar.css">

    <style>
    :root {
        --primary-color: #2c3e50;
        --accent-color: #e74c3c;
        --light-bg: #f8f9fa;
        --text-color: #333;
        --border-radius: 8px;
        --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    body {
        background-color: var(--light-bg);
        color: var(--text-color);
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    .container {
        margin-top: 2rem;
        max-width: 1200px;
    }

    h2,
    h3,
    h4 {
        color: var(--primary-color);
    }

    .card {
        background-color: white;
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .table {
        background-color: white;
        color: var(--text-color);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--box-shadow);
    }

    .table thead {
        background-color: var(--primary-color);
        color: white;
    }

    .table th,
    .table td {
        padding: 1rem;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .productbx .product {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 1rem;
        margin-bottom: 1rem;
        text-align: center;
        transition: transform 0.2s ease;
    }

    .productbx .product:hover {
        transform: translateY(-5px);
    }

    .productbx .product img {
        object-fit: cover;
        border-radius: var(--border-radius);
        margin-bottom: 1rem;
    }

    .productbx .product .price {
        background-color: var(--accent-color);
        color: white;
        padding: 0.5rem;
        border-radius: 50%;
        display: inline-block;
        width: 55px;
        height: 50px;
        line-height: 40px;
        font-weight: bold;
        margin-bottom: 2rem;
    }

    .productbx .product .name {
        font-weight: bold;
        text-transform: uppercase;
        color: var(--primary-color);
    }

    .btn-secondary {
        background-color: var(--primary-color);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: rgb(43, 60, 77);
    }
    </style>
</head>

<body>
    <?php
      displayAdminNavbar($_SESSION["image"])  
    ?>
    <div class="container">
        <div class="card">
            <h2 class="mb-4">Order Details</h2>
            <p><strong>Customer Name:</strong> <?= htmlspecialchars($order['name']) ?></p>
            <p><strong>Room No:</strong> <?= htmlspecialchars($order['room_no']) ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($order['date']) ?></p>
        </div>

        <!-- products table-->
        <div class="card">
            <h3>Ordered Items</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price (Each)</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['product_name']) ?></td>
                            <td><?= htmlspecialchars($product['quantity']) ?></td>
                            <td><?= htmlspecialchars(number_format($product['price'], 2)) ?> LE</td>
                            <td><?= htmlspecialchars(number_format($product['total_price'], 2)) ?> LE</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- all products-->
        <div class="productbx">
            <div class="row">
                <?php foreach ($items as $product): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product">
                        <p class="price"><?= htmlspecialchars(number_format($product['price']))?> <small>LE</small></p>
                        <img src="../products/imgs/<?= htmlspecialchars($product['image']) ?>" width="160px"
                            height="160px" style="object-fit:contain;object-position:center;"
                            alt="<?= htmlspecialchars($product['product_name']) ?>">
                        <p class="name"><?= htmlspecialchars($product['product_name']) ?></p>
                        <p class="amount">Quantity: <?= htmlspecialchars($product['quantity']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Total -->
        <div class="card">
            <h5>Total Order Price: <strong><?= htmlspecialchars(number_format($totalOrderPrice, 2)) ?> </strong>LE</h5>
            <h5>Total Spent by Customer: <strong><?= htmlspecialchars(number_format($customerTotalSpent, 2)) ?>
                </strong>LE</h5>
        </div>

        <a href="checks.php" class="btn btn-secondary mt-3">🔙 Back to Orders</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../javascript/index.js"></script>
</body>

</html>