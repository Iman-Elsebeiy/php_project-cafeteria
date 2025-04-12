<?php
session_start();

function displayUserNavbar(){
    if(isset($_SESSION["cart"])){
        $cart = $_SESSION["cart"];
    }
    else{
        $cart=null;
    }
        echo '
        <nav class="navbar navbar-expand-lg  py-4 shadow border-bottom border-body   " id="navbar-example2" >
            <div class="container px-5">
                <a class="navbar-brand fs-4 fw-Semibold " href="/PHP-Project/php_project-cafeteria/users/views/user-home.php">
                    Cafeteria
                </a>
                <div class="d-flex align-items-center gap-2 d-block d-lg-none">
                    
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 cart-icon" width="25" height="50">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <ul class="cart-items p-0 d-none">';
                        if (!empty($cart) && !empty($cart["products"])) {
                            echo '<div class="cart-items-list">';
                            getCartProducts($cart["products"]);
                            echo '</div>';
                            echo '<div class="cart-actions">
                                <a href="/PHP-Project/php_project-cafeteria/users/views/cart.php" class="btn">View Cart</a>
                            </div>';
                        } else {
                            echo '<div class="cart-empty">
                                <h4>Cart Is Empty</h4>
                                <a href="/PHP-Project/php_project-cafeteria/users/views/user-home.php" class="btn">Shop Now</a>
                            </div>';
                        }
                        echo '</ul>
                        <div class="dropdown">
                            <button class="btn btn-transparent dropdown-toggle text-white border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/PHP-Project/php_project-cafeteria/users/imgs/'. $_SESSION["image"]. '" class="rounded-circle" width="32" height="32">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="dropdown-item">'.$_SESSION['name'].'</li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/PHP-Project/php_project-cafeteria/users/controller/logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <div>
                        <button class="navbar-toggler justify-content-center" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="width: 50px; height:40px;">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    </div>
                </div>
    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-1">
                            <a class="nav-link" aria-current="page" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php">Home</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php#products">Products</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php#about">About</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php#gallery">Gallery</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="/PHP-Project/php_project-cafeteria/orders/views/myorder.php">My Orders</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="/PHP-Project/php_project-cafeteria/users/views/contact.php">Contact</a>
                        </li>
                        <li class="nav-item mx-2 d-none d-lg-block">
                            <a class="nav-link order-btn" onclick="handleOrderNowClick(event)" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php#products">Order Now >></a>
                        </li>
                    </ul>
                    <div class="align-items-center gap-2 d-none d-lg-flex">
                      
                        <div class="cart-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6  " width="25" height="50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <ul class="cart-items p-0 d-none">';
                            if (!empty($cart) && !empty($cart["products"])) {
                                echo '<div class="cart-items-list">';
                                getCartProducts($cart["products"]);
                                echo '</div>';
                             
                            } else {
                                echo '<div class="cart-empty">
                                    <h4>Cart Is Empty</h4>
                                    <a href="/PHP-Project/php_project-cafeteria/users/views/user-home.php" class="btn">Shop Now</a>
                                </div>';
                            }
                            echo '</ul>
                           </div>
                        <div class="dropdown">
                            <button class="btn btn-transparent dropdown-toggle text-white border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/PHP-Project/php_project-cafeteria/users/imgs/'. $_SESSION["image"]. '" class="rounded-circle" width="32" height="32">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="dropdown-item">'.$_SESSION['name'].'</li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item logout-btn" href="/PHP-Project/php_project-cafeteria/users/controller/logout.php">Logout</a></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>';
   }
  
function displayAdminNavbar(){
    if(!empty($_SESSION["cart"])){
        $cart = $_SESSION["cart"];
        if(!empty($cart["user_id"]))
        {
            $cart_userName= getUserData($cart["user_id"]);
            $userName= $cart_userName["name"];
            $_GET["error"]='';
        }
        else{
            $userName= null; 
        } 
    }
    else{
        $cart=null;
        $userName= null;
    }
    echo '
    <nav class="navbar navbar-expand-lg border-bottom border-body" id="navbar-example2">
        <div class="container px-5">
            <a class="navbar-brand fs-4 fw-Semibold" href="/PHP-Project/php_project-cafeteria/users/views/admin-home.php#products">
                Cafeteria
            </a>
            <div class="d-flex align-items-center gap-2 d-block d-lg-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4 cart-icon" width="25" height="50">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <ul class="cart-items p-0 d-none">';
                if (!empty($cart)&&!empty($cart["products"])) {
                    if(!empty($userName)) {
                        echo '<div class="cart-user">
                            <h4>Cart for: ' . $userName . '</h4>
                        </div>';
                    }
                    echo '<div class="cart-items-list">';
                    getCartProducts($cart["products"]);
                    echo '</div>';
                    echo '<div class="cart-actions">
                        <a href="/PHP-Project/php_project-cafeteria/users/views/cart.php" class="btn">View Cart</a>
                    </div>';
                } else {
                    echo '<div class="cart-empty">
                        <h4>Cart Is Empty</h4>
                        <a href="/PHP-Project/php_project-cafeteria/users/views/admin-home.php#products" class="btn">Add Product</a>
                    </div>';
                }
                echo '</ul>
                <div class="dropdown">
                    <button class="btn btn-transparent dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/PHP-Project/php_project-cafeteria/users/imgs/'. $_SESSION["image"]. '" class="rounded-circle" width="32" height="32">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-item">'.$_SESSION['name'].'</li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/PHP-Project/php_project-cafeteria/users/controller/logout.php">Logout</a></li>
                    </ul>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/PHP-Project/php_project-cafeteria/users/views/admin-home.php">Shop</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/PHP-Project/php_project-cafeteria/products/views/products.php">Products</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/PHP-Project/php_project-cafeteria/users/views/allUsers.php">Users</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/PHP-Project/php_project-cafeteria/orders/views/pendingOrders.php">Orders</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/PHP-Project/php_project-cafeteria/checks/checks.php">Checks</a>
                    </li>
                </ul>
                <div class="align-items-center gap-2 d-none d-lg-flex">
                    <div class="cart-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6" width="25" height="50">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <ul class="cart-items p-0 d-none">';
                        if (!empty($cart)&&!empty($cart["products"])) {
                            if(!empty($userName)) {
                                echo '<div class="cart-user">
                                    <h4>Cart for: ' . $userName . '</h4>
                                </div>';
                            }
                            echo '<div class="cart-items-list">';
                            getCartProducts($cart["products"]);
                            echo '</div>';
                          
                        } else {
                            echo '<div class="cart-empty">
                                <h4>Cart Is Empty</h4>
                                <a href="/PHP-Project/php_project-cafeteria/users/views/user-home.php" class="btn">Add Product</a>
                            </div>';
                        }
                        echo '</ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/PHP-Project/php_project-cafeteria/users/imgs/'. $_SESSION["image"]. '" class="rounded-circle" width="32" height="32">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item">'.$_SESSION['name'].'</li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/PHP-Project/php_project-cafeteria/users/controller/logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>';
}




?>