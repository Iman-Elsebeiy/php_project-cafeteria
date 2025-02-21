<?php
// require_once "../includes/utils.php";
require_once "../../includes/utils.php";
require_once "../../includes/connect_to_db.php";

$pdo = connectToDB();

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Get the product image path before deleting the product
    $stmt = $pdo->prepare("SELECT image FROM products WHERE product_id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Delete the product from the database
        $delete_stmt = $pdo->prepare("DELETE FROM products WHERE product_id = ?");
        $delete_stmt->execute([$product_id]);

        // Delete the image file if it exists
        if (!empty($product['image']) && file_exists($product['image'])) {
            unlink($product['image']); // Remove image from server
        }

        // Redirect back to the products list with a success message
        header("Location: products.php?success=deleted");
        exit();
    } else {
        echo "Product not found!";
    }
} else {
    echo "Invalid request!";
}
?>