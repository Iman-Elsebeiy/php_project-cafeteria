<?php
   require_once "../../includes/utils.php";
   require_once "../../includes/navbar.php";
   require_once "../controller/home.php";
   require_once "../../includes/functions.php";
   NotAuthRedirectToLogin();
    if( $_SESSION["role"]=="admin")
    {
        header("Location: ./admin-home.php");
        exit();
    }
   ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="../../style/style.css">

    <link rel="stylesheet" href="../../style/main.css">
    <link rel="stylesheet" href="../../style/header.css">
    <link rel="stylesheet" href="../../style/navbar.css">
    <title>Cafertia</title>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2">
    <div class="container-fluid navmenu d-none d-lg-block">
        <div class="col-10 row mx-auto p-2 align-items-center">
            <div class="col-4 	 ">
                <p>Freshly brewed coffee & delicious bites</p>
            </div>
            <div class="col-4 contact-info d-flex justify-content-center  gap-3">
                <p><i class="fas fa-envelope me-1"></i>cafteria@email.com</p>
                <p><i class="fas fa-phone-alt me-1"></i> +20 114 802 8020</p>
            </div>
            <ul class="col-4 socialmedia-icons d-flex gap-3 justify-content-end">
                <li><a href="#"><i class="fa-brands fa-facebook "></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram "></i></a></li>
                <li><a href="#"><i class="fa-brands fa-twitter "></i></a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin "></i></a></li>
            </ul>
        </div>
    </div>
    <?php displayUserNavbar();?>
    <header id="home">
        <div class="container-fluid d-flex justify-content-center align-items-center ">
            <div class=" col-5 text-center hedaer-content  ">

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
    <main class="mt-5 ">
        <div class="toastfy position-fixed d-none  p-3">
            <div class="toast-header">
                <strong class="me-auto"> Product Added Sucessfuly To Your Cart</strong>
            </div>

        </div>
        </div>

        <section id="products" class="container px-3">
            <h2 class="fs-2 text-center">View Our Product
                <i class="fa-solid fa-mug-hot"></i>
            </h2>
            <!-- <p>Freshly brewed coffee, handcrafted sandwiches, and delicious pastries made with the finest ingredients.
                Enjoy every bite with rich flavors and a warm, inviting experience.</p> -->
            <div class="row mt-3">
                <div class="col-12 col-md-6 mx-auto">
                    <form class="d-flex  w-100 mb-3" role="search">
                        <input class="form-control me-1 me-md-2 ms-auto p-0 px-2 py-md-2" type="search"
                            placeholder="Search" aria-label="Search" name="search" value=<?php
                    if(!empty($_GET["search"])){ echo $_GET["search"]; } ?>>
                        <button class=" btn search" type="submit">Search</button>
                    </form>

                </div>

            </div>
            <ul class="category-list col-6  mx-auto d-flex justify-content-start">
                <?php
                    displayCategoriesLinks();
                    ?>
            </ul>

            <div id="productCarousel" class="carousel slide">
                <div class="carousel-inner row">
                    <?php
        if(isset($_GET["category"]) && !isset($_GET["search"]) && !isset($_GET["slide_number"]) ){
            getProducts($_GET["category"],);
        } elseif(isset($_GET["search"])) {
            getProducts("all", $_GET["search"]);
        } else {
            if(isset($_GET["slide_number"])&& isset($_GET["category"])){
                getProducts($_GET["category"],'',(int)$_GET["slide_number"]);
            }
            else{
                getProducts();
            }
            
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
        <section id="about" class="container-fluid aboutus py-3 text-start mt-5 animate-section">
            <div class="container">
                <div class="row g-2 ">
                    <div class="col-6">
                        <h2 class="fs-2 fst-italic">Visit Us Today</h2>
                        <p>Fresh Bites Café is a cozy spot where you can enjoy a variety of
                            delicious
                            meals, refreshing beverages, and mouthwatering desserts. Our menu is filled with fresh,
                            high-quality
                            ingredients that are sure to satisfy your cravings. Whether you're here for a quick bite or
                            a
                            relaxing
                            break, we've got something special for you!</p>
                        <button class="mx-auto">Visit Us Today </button>
                    </div>
                    <div class="col-6 d-flex gap-4 p-2">
                        <div class="col-6"><img src="../../app-images/about1.jpg" alt=""></div>
                        <div class="col-6"><img src="../../app-images/about2.jpg" alt=""></div>

                    </div>

                </div>
            </div>

        </section>
        <section id="gallery" class="container mt-5 animate-section">
            <div class="row g-3">
                <div class="col-3">
                    <img src="../../app-images/g1.jpg" alt="">
                </div>
                <div class="col-3">
                    <img src="../../app-images/g2.jpg" alt="">
                </div>
                <div class="col-6">
                    <img src="../../app-images/g3.jpg" alt="">
                </div>
                <div class="col-3">
                    <img src="../../app-images/g4.jpg" alt="">
                </div>
                <div class="col-3 p-3">
                    <h4>Fresh Ingredients</h4>
                    <p>We use only the finest, freshest ingredients to create delicious meals and drinks.</p>
                </div>
                <div class="col-5 p-3">
                    <h4>Cozy Ambiance</h4>
                    <p>Enjoy a warm and inviting atmosphere, perfect for relaxing or catching up with friends.</p>
                </div>
            </div>
        </section>
        <section id="bestseller" class="container mt-5 animate-section">
            <h2 class="fs-2 text-center">Best Seller
                <i class="fa-solid fa-mug-hot"></i>
            </h2>
            <div class="row mt-3 row-cols-3 g-3">
                <?php 
              displayTopProduct();?>

            </div>
        </section>
        <section id="contact" class="mt-5">
            <div class="container p-5">
                <div class="row g-5 align-items-end ">
                    <div class="col-lg-6">
                        <div class="form-container">
                            <h2 class=" mb-4 fs-2">Contact Us</h2>
                            <form action="#" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Enter your name"
                                        required>

                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" placeholder="Enter your email"
                                        required>

                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea id="message" class="form-control" rows="20"
                                        placeholder="Enter your message" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-sub w-20">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="map-container">
                            <iframe class="w-100" height="250" src="https://www.google.com/maps/embed?..."
                                style="border:0;" allowfullscreen></iframe>
                            <h5 class="mt-3">Cafe Center</h5>
                            <p>Downtown, Cairo, Egypt</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <?php include '../../includes/footer.php'; ?>
    <script src=" https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
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