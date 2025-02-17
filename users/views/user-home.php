<?php
   require_once "../../includes/utils.php";
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
    <nav class="navbar navbar-expand-lg  bg-dark border-bottom border-body fixed-top left-0 right-0 "
        id="navbar-example2" data-bs-theme="dark">
        <div class="container-fluid  px-5  ">
            <a class="navbar-brand " href="#">
                <img src="../../app-images/logo.png" alt="logo" width="85" height="50">
            </a>
            <button class="navbar-toggler  justify-content-center" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation" style="width: 50px; height:40px ;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto  mb-2 mb-lg-0">

                    <li class="nav-item mx-2">
                        <a class="nav-link " aria-current="page" href="#home">Home</a>
                    </li>
                    <li class='nav-item mx-2'>
                        <a class='nav-link' href='#products'>Products</a>
                    </li>
                    <li class='nav-item mx-2'>
                        <a class='nav-link' href='#about'>About</a>
                    </li>
                    <li class='nav-item mx-2'>
                        <a class='nav-link' href='#'>My Orders</a>
                    </li>
                    <li class='nav-item mx-2'>
                        <a class='nav-link' href='#contact'>Contact</a>
                    </li>

                </ul>
                <div class="d-flex align-items-center  gap-2">
                    <div class="image border rounded-circle" style="width:40px;height:40px">
                        <img src="" alt="" class="rounded-circle  w-100 h-100">
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-white icon" width="25" height="50">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-white  icon" width="25" height="50">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>

            </div>
        </div>
    </nav>
    <header id="home">
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
                            placeholder="Search" aria-label="Search" name="search" value=<?php if(!empty($_GET["search"])){ echo
                            $_GET["search"]; } ?>>
                        <button class=" btn search" type="submit">Search</button>
                    </form>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 px-4 px-md-0 g-md-3 g-2 mt-3">
                        <?php
                     if(isset($_GET["category"])&&!isset($_GET["search"]))
                     {
                     displayProduct($_GET["category"]);
                     }
                     elseif(isset($_GET["search"])){
                        displayProduct("all",$_GET["search"]);
                     }
                      else{
                      displayProduct();
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
    <script src="../../javascript/home.js"></script>
</body>

</html>