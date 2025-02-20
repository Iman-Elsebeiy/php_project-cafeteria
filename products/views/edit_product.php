<?php
// require_once "../includes/utils.php";
require_once "../../includes/utils.php";
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
    <link rel="stylesheet" href="../../style/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../../style/navbar.css">
    <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("input[type='number']").forEach(input => {
        input.addEventListener("input", function () {
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
     displayAdminNavbar($_SESSION["image"])?>
    <div class="container p-4 mt-2">
        <div class="row">
            <div class="col-12 col-md-8 mx-auto p-md-5 p-3 rounded form">
                <h1 class="fs-4 mb-4">Edit Product</h1>

                <form action="update_product.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']); ?>">

                    <!-- Product Name -->
                    <div class="mb-3 d-flex col-12 gap-2 flex-wrap">
                        <div class="d-flex align-items-baseline col-12 col-md-7">
                            <label for="product_name" class='form-label col-3'>Product:</label>
                            <div>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    value="<?= htmlspecialchars($product['product_name']); ?>" >
                                    <p class="text-danger"><?php echo $errors['product_name'] ?? ''; ?></p>

                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="d-flex align-items-baseline gap-md-4 col-12 col-md-4">
                            <label for="quantity" class="form-label col-4">Quantity:</label>
                            <div>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    value="<?= htmlspecialchars($product['quantity']); ?>" >
                                     <p class="text-danger"><?php echo $errors['quantity']?? ''; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="form-label">Price:</label>
                        <div>
                            <input type="number" class="form-control col-12" id="price" name="price" step="0.01"
                                value="<?= htmlspecialchars($product['price']); ?>" >
                                 <p class="text-danger"><?php echo $errors['price']?? ''; ?></p>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="mb-4 col-12">
                        <label for="category_id" class="form-label col-2">Category:</label>
                        <div class="input-group align-items-baseline">
                            <select class="form-select rounded-start" id="category_id" name="category_id">
                                <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['category_id']; ?>"
                                    <?= ($category['category_id'] == $product['category_id']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($category['name']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>

                    <!-- Product Image -->
                    <div class="mb-5 mt-3">
                        <label class="form-label">Current Image:</label><br>
                        <img src="../imgs/<?= htmlspecialchars($product['image']); ?>" width="100" height="100"
                            class="rounded"><br>

                        <label for="image" class="form-label mt-3">Change Image:</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <p class="text-danger"><?php echo $errors['image']?? '';?></p>
                    </div>

                    <!-- Buttons -->
                    <div class="mb-4">
                        <button class="btn add col-3" type="submit">Update</button>
                        <button class="btn reset " type="reset">Reset</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
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