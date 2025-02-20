<?php
require_once "../../includes/utils.php";
require_once "../../includes/connect_to_db.php";
$pdo = connectToDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['category_id'];
    $name = $_POST['name'];

    // Update the category in the database
    $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE category_id = ?");
    $stmt->execute([$name, $id]);

    // Redirect to category list
    header("Location: categories.php?success=updated");
    exit();
}
?>