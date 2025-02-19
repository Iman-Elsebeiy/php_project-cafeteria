<?php
   require_once "../../includes/utils.php";
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
    <link rel="stylesheet" href="../../style/style.css">

    <title>Cafertia</title>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2">
    <?php 
     displayAdminNavbar($_SESSION['image']);
    ?>


    <main id="products" class="mt-5">
        <div class="d-flex justify-content-end ">
            <h1 class="fs-2 mx-4 col-6 text-center "> Your Shop </h1>
            <form class="d-flex mb-3 col-4 px-5 " role="search">
                <input class="form-control me-1 me-md-2 ms-auto p-0 px-2 py-md-2 w-100" type="search"
                    placeholder="Search Product" aria-label="Search" name="search" value=<?php
                    if(!empty($_GET["search"])){ echo $_GET["search"]; } ?>>
                <button class=" btn search" type="submit">Search</button>
            </form>
        </div>
        <div class="container-fluid p-3">
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
                    <form action="" method="post" class="px-5">
                        <select id="user" name="cart_user_id" class=" col-9 p-2 my-2 rounded"
                            aria-label="Default select example" onchange="this.form.submit()">
                            <option value="" selected disabled>Select User</option>
                            <?php 
                              if(!empty($_POST["cart_user_id"]))
                              {
                                getAllUserForSelect($_POST["cart_user_id"]);
                              }
                              else if(!empty($_GET["cart_user_id"]))
                              {
                                getAllUserForSelect($_GET["cart_user_id"]);
                              }
                              else{
                                getAllUserForSelect(); 
                              }
                           ?>
                        </select>
                        <div class="text-danger col-9 p-0 b-danger">
                            <?php if(!empty($_GET["error"])){echo $_GET["error"] ;}?>
                        </div>
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
    <script src="../../javascript/home-main.js"></script>
    <script src="../../javascript/index.js"></script>

</body>

</html>