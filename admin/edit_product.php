<?php
require_once "../includes/utils.php";
require_once "../includes/connect_to_db.php";

$pdo = connectToDB();

// Get product ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product details
$stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found!";
    exit;
}

// Fetch all categories for the dropdown
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>

<h2>Edit Product</h2>

<form action="update_product.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']); ?>">

    <label>Product Name:</label>
    <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']); ?>" ><br>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']); ?>" ><br>

    <label>Quantity:</label>
    <input type="number" name="quantity" value="<?= htmlspecialchars($product['quantity']); ?>" ><br>

    <label>Category:</label>
    <select name="category_id" >
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['category_id']; ?>" <?= ($category['category_id'] == $product['category_id']) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($category['name']); ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Current Image:</label><br>
    <img src="<?= htmlspecialchars($product['image']); ?>" width="100" height="100"><br>

    <label>Change Image:</label>
    <input type="file" name="image"><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
