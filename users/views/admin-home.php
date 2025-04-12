<?php
   require_once "../../includes/utils.php";
    require_once "../../includes/navbar.php";
   require_once "../controller/home.php";
   require_once "../../includes/functions.php";
   NotAuthRedirectToLogin();
    if($_SESSION["role"]=="user")
    {
        header("Location: ./user-home.php");
    }
    if(!empty($_POST["cart_user_id"])){
        if(!empty($_SESSION["cart"])){
           $_SESSION["cart"]["user_id"]=$_POST["cart_user_id"];
        } 
        else{
          $_SESSION["cart"]  =["products"=>[],"user_id"=>$_POST["cart_user_id"]]; 
        }
    }
   
   ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/navbar.css">
    <link rel="stylesheet" href="../../style/main.css">
    <link rel="stylesheet" href="../../style/header.css">
    <title>Cafeteria Admin</title>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2">
    <div class="container-fluid navmenu d-none d-lg-block">
        <div class="col-10 row mx-auto p-2 align-items-center">
            <div class="col-4">
                <p>Admin Dashboard - Manage Your Cafeteria</p>
            </div>
            <div class="col-4 contact-info d-flex justify-content-center gap-3">
                <p><i class="fas fa-envelope me-1"></i>cafteria@email.com</p>
                <p><i class="fas fa-phone-alt me-1"></i> +20 114 802 8020</p>
            </div>
            <ul class="col-4 socialmedia-icons d-flex gap-3 justify-content-end">
                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
            </ul>
        </div>
    </div>
    <?php displayAdminNavbar(); ?>
    <header id="home">
        <div class="container-fluid d-flex justify-content-center align-items-center ">
            <div class=" col-5 text-center hedaer-content ">

                <p>Enjoy delicious, freshly prepared meals and the finest coffee in town. Whether you're here for a
                    quick
                    bite or a relaxing break, we've got something special for you!</p>
                <h1> Fresh Bites Café,Just For You</h1>
                <p>Explore our diverse menu filled with tasty treats, refreshing beverages, and mouthwatering
                    desserts.
                </p>
                <a class="mx-auto animate__animated  animate__pulse  animate__infinite" href="#products">View Menu</a>

            </div>
        </div>
    </header>
    <main class="mt-5">
        <section class="container" id="products">
            <h2 class="fs-2 text-center mb-4">Manage Products
                <i class="fa-solid fa-mug-hot"></i>
            </h2>
            <div class="row align-items-start g-3 justify-content-evenly">
                <!-- Select User and Search Section -->
                <div class=" col-6 mb-4">
                    <form action="" method="post">
                        <div class="d-flex align-items-baseline">
                            <label for="cart_user_id" class="col-3">select user: </label>
                            <select id="user" name="cart_user_id" class="form-select " onchange="this.form.submit()">
                                <option value="" selected disabled>Select User</option>
                                <?php 
                              if(!empty($_POST["cart_user_id"])) {
                                getAllUserForSelect($_POST["cart_user_id"]);
                              } else if(!empty($_GET["cart_user_id"])) {
                                getAllUserForSelect($_GET["cart_user_id"]);
                              } else {
                                getAllUserForSelect(); 
                              }
                           ?>
                            </select>
                        </div>
                        <div class="text-danger">
                            <?php if(!empty($_GET["error"])) echo $_GET["error"]; ?>
                        </div>
                    </form>

                    <!-- Categories Section -->
                </div>

                <!-- Products Section -->
                <div class="col-6">
                    <form class="d-flex mb-4" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search Product" name="search"
                            value="<?php if(!empty($_GET["search"])) echo $_GET["search"]; ?>">
                        <button class="btn search" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <ul class="category-list col-8  mx-auto d-flex justify-content-center">
                <?php
                    displayCategoriesLinks();
                    ?>
            </ul>
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner row">
                    <?php
        if(isset($_GET["category"]) && !isset($_GET["search"])) {
            getProducts($_GET["category"]);
        } elseif(isset($_GET["search"])) {
            getProducts("all", $_GET["search"]);
        } else {
            getProducts();
        }
        ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </section>
    </main>

    <?php include '../../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../javascript/home-main.js"></script>
    <script src="../../javascript/index.js"></script>
</body>

</html>