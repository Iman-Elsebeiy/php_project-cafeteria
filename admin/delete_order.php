<?php
require_once '../includes/connect_to_db.php';

$pdo = connectToDB();

if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}

$orderId = $_GET['order_id'];

// Delete order items first (to maintain foreign key integrity)
$itemStmt = $pdo->prepare("DELETE FROM order_products WHERE order_id = ?");
$itemStmt->execute([$orderId]);

// Delete the order
$orderStmt = $pdo->prepare("DELETE FROM orders WHERE order_id = ?");
$orderStmt->execute([$orderId]);

header("Location: checks.php?message=Order Deleted Successfully");
exit;
