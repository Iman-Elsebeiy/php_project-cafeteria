<?php

require_once "../../includes/utils.php";
require_once "../../includes/navbar.php";
require_once "../../includes/connect_to_db.php";
require_once "../../includes/functions.php";

if($_SESSION['role']=='user'){
  header('Location:/PHP-Project/php_project-cafeteria/users/views/user-home.php');
}
NotAuthRedirectToLogin();
try {
    $pdo = connectToDB();
    $sql="SELECT * FROM `categories`";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $categories = $stmt->fetchAll();
    // var_dump($categories);

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
    <title>Categories</title>
    <link rel="stylesheet" href="../../style/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../../style/navbar.css">
    <link rel="stylesheet" href="../../style/allProducts.css"> <!-- Add allProducts.css -->
    <link rel="stylesheet" href="../../style/style.css"> <!-- Add allProducts.css -->
</head>

<body>
    <?php 
     displayAdminNavbar()?>
    <main>
        <div class="container allproducts mt-5 col-10 mx-auto">
            <!-- Add allproducts class -->
            <div class="d-flex justify-content-between ">
                <h1>All Categories</h1>
                <div class="mt-1 text-end my-4  justify-content-end d-flex gap-2">
                    <a href="add_product.php" class="btn add text-white  px-4 fs-6 ">+ Add Category</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table  mx-auto">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" class="text-center">Category</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
              foreach ($categories as $category) {
              ?>
                        <tr>
                            <th scope="row" data-label="ID"><?php echo $category['category_id']?></th>
                            <td data-label="Category"><?php echo $category['name'] ?></td>
                            <td data-label="Actions" class="actions ">
                                <a href="edit_category.php?id=<?php echo $category['category_id'] ?>"
                                    class="action-btn btn-edit">
                                    Edit
                                </a>
                                <a href="delete_category.php?id=<?php echo $category['category_id'] ?>"
                                    onclick="return confirm('Are you sure you want to delete?')"
                                    class="action-btn btn-delete">Delete</a>
                            </td>
                        </tr>
                        <?php
                 }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
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