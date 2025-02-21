<?php
require_once "../../includes/utils.php";
require_once "../../includes/connect_to_db.php";

$pdo = connectToDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category_id = $_POST['category_id'];
    $image = $_POST['image'];

    
    $errors = [];
    
    if (!$product_name) $errors['product_name'] = "Product name is required.";
    if (!is_numeric($price)) {
        $errors['price'] = "Price must be a valid number.";
    } elseif ($price < 0) {
        $errors['price'] = "Price cannot be negative.";
    }
   if (!is_numeric($quantity)) {
            $errors['quantity'] = "quantity must be a valid number.";
        } elseif ($quantity < 0) {
            $errors['quantity'] = "quantity cannot be negative.";              
        } 
  

    if (!empty($errors)) {
        $errors = json_encode($errors);
        header("location: edit_product.php?id={$id}&errors={$errors}");
        exit();
    }

    
    // Handle file upload if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $target_file = basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"],"../imgs/".$target_file);
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