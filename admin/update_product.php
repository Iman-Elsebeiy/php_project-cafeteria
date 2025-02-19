<?php
require_once "../includes/utils.php";
require_once "../includes/connect_to_db.php";

$pdo = connectToDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category_id = $_POST['category_id'];
    
    // Handle file upload if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../imgs/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image = $target_file;
    } else {
        // Keep the existing image if no new file is uploaded
        $stmt = $pdo->prepare("SELECT image FROM products WHERE product_id = ?");
        $stmt->execute([$id]);
        $image = $stmt->fetchColumn();
    }

    // Update the product in the database
    $stmt = $pdo->prepare("UPDATE products SET product_name = ?, price = ?, quantity = ?, category_id = ?, image = ? WHERE product_id = ?");
    $stmt->execute([$product_name, $price, $quantity, $category_id, $image, $id]);

    // Redirect to product list
    header("Location: products.php?success=updated");
    exit();
}
?>
