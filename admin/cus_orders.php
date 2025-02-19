<?php
require_once '../includes/connect_to_db.php';
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
    WHERE orders.user_id = ?
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      margin-top: 2rem;
    }
    .table thead {
      background-color: #343a40;
      color: #fff;
    }
    /* Table row hover animation */
    tbody tr {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    tbody tr:hover {
      transform: scale(1.02);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    a {
      text-decoration: none;
    }
</style>
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark animate__animated animate__fadeInDown">
<div class="container">
<a class="navbar-brand" href="#">Order Management</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" aria-controls="navbarNav" 
              aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ms-auto">
<li class="nav-item">
<a class="nav-link" href="checks.php">Back</a>
</li>
</ul>
</div>
</div>
</nav>
<div class="container">
<div class="card shadow-sm animate__animated animate__fadeInUp">
<div class="card-header">
<h2 class="mb-0">Orders of <?= htmlspecialchars($user['name']) ?></h2>
</div>
<div class="card-body">
<p><strong>Total Spent:</strong> $<?= number_format($totalSpent, 2) ?></p>
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
 
  <!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
