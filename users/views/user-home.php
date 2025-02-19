<?php
   require_once "../../includes/utils.php";
   require_once "../controller/home.php";
   require_once "../../includes/functions.php";
   NotAuthRedirectToLogin();
    if( $_SESSION["role"]=="admin")
    {
        header("Location: ./admin-home.php");
    }
    // unset($_SESSION);
   ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Cafertia</title>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2">
    <?php displayUserNavbar($_SESSION['image']);?>
    <header id=" home">
        <div class="container-fluid h-100 ">
            <div class="row border h-100 align-items-center px-5">
                <div class=" col-12  col-md-6  px-5 ">
                    <h1 class="my-2 "> Start Your Day with the Perfect Coffee!</h1>
                    <p class="mb-4">Experience the rich aroma and taste of freshly brewed coffee.</p>
                    <a href="#products" class="btn px-5">Shop Now</a>
                </div>
                <div class="d-none d-md-block  col-md-6 header-silde h-100  visible">
                </div>
            </div>

    </header>
    <main id="products" class="mt-5">
        <h1 class="fs-2 text-center">All Products </h1>

        <div class="container">
            <div class="row g-1 g-md-3 mt-2">
                <div class="col-4 col-md-3">
                    <div class="categories w-100">
                        <button class="btn font-bold  text-white w-100 category-btn ">All Categories
                            &#9776;</button>
                        <ul class="border navbar-nav category-list ">
                            <?php
                            displayCategoriesLinks();
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-8 col-md-9  ">
                    <form class="d-flex  w-100 mb-3" role="search">
                        <input class="form-control me-1 me-md-2 ms-auto p-0 px-2 py-md-2" type="search"
                            placeholder="Search" aria-label="Search" name="search" value=<?php
                            if(!empty($_GET["search"])){ echo $_GET["search"]; } ?>>
                        <button class=" btn search" type="submit">Search</button>
                    </form>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 px-4 px-md-0 g-md-3 g-2 mt-3">

                        <?php
                     if(isset($_GET["category"])&&!isset($_GET["search"]))
                     {
                        getProducts($_GET["category"]);
                     }
                     elseif(isset($_GET["search"])){
                        getProducts("all",$_GET["search"]);
                     }
                      else{
                        getProducts();
                      }
                     
                     ?>
                    </div>

                </div>
            </div>



        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../javascript/user-home.js"></script>
    <script src="../../javascript/home-main.js"></script>
    <script src="../../javascript/index.js"></script>

</body>

</html>