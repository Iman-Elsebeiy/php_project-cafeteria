<?php
require_once "../../includes/utils.php";
require_once "../../includes/connect_to_db.php";
$pdo = connectToDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a valid PDO connection ($pdo)
    $category_id = $_POST['category_id']; // Get category ID from form
    $category_name = trim($_POST['name']); // Get new category name
    
    $errors = [];

    // Check if the category name already exists (excluding current category)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories WHERE name = ? AND category_id != ?");
    $stmt->execute([$category_name, $category_id]);
    $categoryExists = $stmt->fetchColumn();

    if ($categoryExists > 0) {
        $errors['category_name'] = "This category name already exists. Please enter another one.";
    }


    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE category_id = ?");
        $stmt->execute([$category_name, $category_id]);
    }

    // Redirect to category list
    header("Location: categories.php?success=updated");
    exit();
}
?>