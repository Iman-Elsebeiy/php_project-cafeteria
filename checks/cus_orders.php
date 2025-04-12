<?php
require_once '../includes/navbar.php';
require_once '../includes/connect_to_db.php';
require_once '../includes/utils.php';
require_once "../includes/functions.php";

if($_SESSION['role']=='user'){
  header('Location:/PHP-Project/php_project-cafeteria/users/views/user-home.php');
}
NotAuthRedirectToLogin();
$pdo = connectToDB();
 
if (!isset($_GET['user_id'])) {
    die("User ID is missing.");
}
 
$userId = $_GET['user_id'];
 
// Fetch user data and total spent
$userStmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);
 
$totalSpentStmt = $pdo->prepare("SELECT total_spent FROM user_total_spent WHERE user_id = ?");
$totalSpentStmt->execute([$userId]);
$totalSpent = $totalSpentStmt->fetchColumn();
 
// Fetch all orders for the user
$ordersStmt = $pdo->prepare("
    SELECT orders.order_id, orders.date, order_total_price.total_price
    FROM orders
    JOIN order_total_price ON orders.order_id = order_total_price.order_id
    WHERE orders.user_id = ? And orders.status = 'completed'
    ORDER BY orders.date DESC
");
$ordersStmt->execute([$userId]);
$orders = $ordersStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../style/navbar.css">

    <link rel="stylesheet" href="../style/style.css">

    <style>
    .card {
        margin-top: 2rem;
        color: var(--text-600);
        background-color: var(--bage-nav)
    }

    .table>thead>tr>th {
        background-color: var(--bage-300);
        color: var(--bage-100);
    }

    /* Table row hover animation */
    tbody tr {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    tbody tr:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    a {
        text-decoration: none;
        color: var(--bage-500)
    }
    </style>
</head>

<body>
    <?php
     displayAdminNavbar() 
    ?>
    <!-- Navigation Bar -->

    <div class="container">
        <div class="card shadow-sm animate__animated animate__fadeInUp">
            <div class="card-header">
                <h2 class="mb-0">Orders of <?= htmlspecialchars($user['name']) ?></h2>
            </div>
            <div class="card-body">
                <p><strong>Total Spent:</strong> LE<?= number_format($totalSpent, 2) ?></p>
                <?php if (count($orders) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Total Price (LE)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                            <tr class="animate__animated animate__fadeIn">
                                <td>
                                    <a href="detail_order.php?order_id=<?= $order['order_id'] ?>">
                                        <?= htmlspecialchars($order['date']) ?>
                                    </a>
                                </td>
                                <td><?= number_format($order['total_price'], 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <p class="mb-0">No orders found for this user.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <!-- Bootstrap Bundle JS -->
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