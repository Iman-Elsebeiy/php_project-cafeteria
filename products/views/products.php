<?php
require_once "../../includes/navbar.php";
require_once "../../includes/utils.php";
require_once "../../includes/connect_to_db.php";
require_once "../../includes/functions.php";

if($_SESSION['role']=='user'){
  header('Location:/PHP-Project/php_project-cafeteria/users/views/user-home.php');
}
NotAuthRedirectToLogin();

try {
    $pdo = connectToDB();
    $select_query ="SELECT * FROM `categories`, `products` WHERE products.`category_id` = `categories`.`category_id`;";

    $stmt = $pdo->prepare($select_query);
    $stmt->execute();

    $products = $stmt->fetchAll();
    // var_dump($products);

}catch (PDOException $e){
    displayError($e->getMessage());
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../../style/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../../style/navbar.css">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/allProducts.css">
</head>

<body>
    <?php 
     displayAdminNavbar()?>
    <div class="container mt-5 col-10 mx-auto  allproducts">
        <div class="d-flex justify-content-between ">
            <h1>All Products</h1>
            <div class="mt-1 text-end my-4  justify-content-end d-flex gap-2">
                <a href="add_product.php" class="btn add text-white  px-4 fs-6 ">+ Add Product</a>
                <a href="categories.php" class="btn add text-white  px-4 fs-6 ">All Categories>></a>
            </div>
        </div>

        <table class="table col-lg-7 mx-auto">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Availability</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
              foreach ($products as $product) {
              ?>
                <tr>
                    <td data-label="Product"><?php echo $product['product_name'] ?></td>
                    <td data-label="Price"><?php echo $product['price']?> L.E</td>
                    <td data-label="Image">
                        <img src="../imgs/<?php echo $product['image'] ?>" width="100px" height="100px"
                            style="object-fit:contain;object-position:center;"
                            alt="<?php echo $product['product_name'] ?>">
                    </td>
                    <td data-label="Quantity"><?php echo $product['quantity']?></td>
                    <td data-label="Availability"><?php 
                        if($product['quantity']>0){
                            echo 'Available';
                        } else {
                            echo 'Unavailable';
                        }?>
                    </td>
                    <td data-label="Category"><?php echo $product['name'] ?></td>
                    <td data-label="Actions" class="actions">
                        <a href="edit_product.php?id=<?php echo $product['product_id'] ?>" class="action-btn btn-edit">
                            Edit
                        </a>
                        <a href="delete_product.php?id=<?php echo $product['product_id'] ?>"
                            class="action-btn btn-delete">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php
                 }
                ?>

            </tbody>
        </table>
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