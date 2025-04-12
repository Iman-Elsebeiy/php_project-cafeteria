<?php
// require_once "../includes/utils.php";
require_once "../../includes/utils.php";
require_once "../../includes/navbar.php";
require_once "../../includes/connect_to_db.php";
require_once "../../includes/functions.php";

if($_SESSION['role']=='user'){
  header('Location:/PHP-Project/php_project-cafeteria/users/views/user-home.php');
}
NotAuthRedirectToLogin();
$pdo = connectToDB();


$errors = [];

if (isset($_GET['errors'])) {
    $errors = json_decode($_GET['errors'], true);
}


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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/allProducts.css">
    <link rel="stylesheet" href="../../style/navbar.css">
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("input[type='number']").forEach(input => {
            input.addEventListener("input", function() {
                if (this.value < 0) {
                    this.value = "";
                    alert("Negative values are not allowed!");
                }
            });
        });
    });
    </script>

</head>

<body>
    <?php 
     displayAdminNavbar()?>
    <div class="container addproduct col-lg-6 mt-4 p-5">
        <h1 class="fs-4 p-2 col-9">Edit Product</h1>

        <form action="update_product.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']); ?>">

            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class='form-control <?php if(isset($errors['product_name'])) echo "is-invalid"; ?>'
                    id="product_name" placeholder="Product Name" name="product_name"
                    value="<?= htmlspecialchars($product['product_name']); ?>">
                <?php if(isset($errors['product_name'])) echo "<p class='text-danger txt-sm'>{$errors['product_name']}</p>"; ?>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class='form-control <?php if(isset($errors['quantity'])) echo "is-invalid"; ?>'
                    id="quantity" placeholder="Quantity" name="quantity"
                    value="<?= htmlspecialchars($product['quantity']); ?>">
                <?php if(isset($errors['quantity'])) echo "<p class='text-danger txt-sm'>{$errors['quantity']}</p>"; ?>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class='form-control <?php if(isset($errors['price'])) echo "is-invalid"; ?>'
                    id="price" placeholder="Price" name="price" step="0.01"
                    value="<?= htmlspecialchars($product['price']); ?>">
                <?php if(isset($errors['price'])) echo "<p class='text-danger txt-sm'>{$errors['price']}</p>"; ?>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class='form-select <?php if (isset($errors['category_id'])) echo "is-invalid"; ?>'
                    id="category_id" name="category_id">
                    <option value="" selected>Choose...</option>
                    <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['category_id']; ?>"
                        <?= ($category['category_id'] == $product['category_id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($category['name']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if(isset($errors['category_id'])) echo "<p class='text-danger txt-sm'>{$errors['category_id']}</p>"; ?>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input class='form-control <?php if(isset($errors['image'])) echo "is-invalid"; ?>' type="file"
                    id="image" name="image">
                <?php if(isset($errors['image'])) echo "<p class='text-danger txt-sm'>{$errors['image']}</p>"; ?>
                <label class="form-label">Current Image:</label><br>
                <img src="../imgs/<?= htmlspecialchars($product['image']); ?>" width="100" height="100"
                    class="rounded"><br>
            </div>

            <div class="d-flex  gap-2 mt-4">
                <button class="btn btn-primary px-5" type="submit">Update</button>
                <button class="btn btn-secondary px-5" type="reset">Reset</button>
            </div>
        </form>
    </div>
    <?php include '../../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../javascript/index.js"></script>
</body>

</html>