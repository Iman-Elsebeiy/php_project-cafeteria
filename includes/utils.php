<?php
 require_once "classDB.php";
 require_once "config.php";
  session_start();
  function displayUserNavbar($userImage){
    if(isset($_SESSION["cart"])){
        $cart = $_SESSION["cart"];
    }
    else{
        $cart=null;
    }
        echo '
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body  fixed-top left-0 right-0" id="navbar-example2" data-bs-theme="dark">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="#">
                    <img src="/PHP-Project/php_project-cafeteria/app-images/logo.png" alt="logo" width="85" height="50">
                </a>
                <div class="d-flex align-items-center gap-2 d-block d-lg-none">
                    <button class="navbar-toggler justify-content-center" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="width: 50px; height:40px;">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="image border rounded-circle" style="width:40px;height:40px">
                        <img src="/PHP-Project/php_project-cafeteria/users/imgs/'. $userImage . '" alt="" class="rounded-circle w-100 h-100">
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-white cart-icon" width="25" height="50">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <ul class="cart-items p-3 d-none">';
                        if (!empty($cart) && !empty($cart["products"])) {
                            
                            getCartProducts($cart["products"]);
                        } else {
                            echo '
                            <li class="d-flex gap-2 p-5 w-100">
                                <h4> Cart Is Empty</h4>
                            </li>
                            <a class="btn w-100" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php"> Shop Now </a>';
                        }
                        echo '</ul>
                    </div>
                </div>
    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-2">
                            <a class="nav-link" aria-current="page" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php">Products</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="/PHP-Project/php_project-cafeteria/orders/views/myorder.php">My Orders</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                    <div class="align-items-center gap-2 d-none d-lg-flex">
                        <div class="image border rounded-circle" style="width:40px;height:40px">
                            <img src="/PHP-Project/php_project-cafeteria/users/imgs/'. $userImage. ' " alt="" class="rounded-circle w-100 h-100">
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-white cart-icon" width="25" height="50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <ul class="cart-items p-3 d-none">';
                            if (!empty($cart) && !empty($cart["products"])) {
                            
                                getCartProducts($cart["products"]);
                            } else {
                                echo '
                                <li class="d-flex gap-2 p-5 w-100">
                                    <h4> Cart Is Empty</h4>
                                </li>
                                <a class="btn w-100" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php"> Shop Now </a>';
                            }
                            echo '</ul>
                             <a href="/PHP-Project/php_project-cafeteria/users/controller/logout.php" class="btn text-white border border-white">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>';
   }
  function displayAdminNavbar($userImage){
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
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body z-3 position-relative" id="navbar-example2" data-bs-theme="dark">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="/PHP-Project/php_project-cafeteria/users/views/admin-home.php">
                    <img src="/PHP-Project/php_project-cafeteria/app-images/logo.png" alt="logo" width="85" height="50">
                </a>
                <div class="d-flex align-items-center gap-2 d-block d-lg-none">
                    <button class="navbar-toggler justify-content-center" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="width: 50px; height:40px;">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="image border rounded-circle" style="width:40px;height:40px">
                        <img src="/PHP-Project/php_project-cafeteria/users/imgs/'. $userImage. '" class="rounded-circle w-100 h-100">
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-white cart-icon" width="25" height="50">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <ul class="cart-items p-3 d-none">';
                        if (!empty($cart)&&!empty($cart["products"])) {
                          {
                            if(!empty($userName))
                              {
                               echo "
                              <li class='w-100 my-2 fs-6 d-flex gap-2' >
                                  <p>User:</p>
                                  <h4 class='fs-6'>$userName </h4>
                              </li>";
                              }
                            getCartProducts($cart["products"]);
                          }
                            
                        } else {
                            echo '
                            <li class="d-flex gap-2 p-5 w-100">
                                <h4> Cart Is Empty</h4>
                            </li>
                            <a class="btn w-100" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php"> Shop Now </a>';
                        }
                        echo '</ul>
                    </div>
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
                            <a class="nav-link" href="/PHP-Project/php_project-cafeteria/users/views/allUsers.php">Uesrs</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="/PHP-Project/php_project-cafeteria/orders/views/pendingOrders.php">Orders</a>
                        </li>
                        
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="/PHP-Project/php_project-cafeteria/checks/checks.php">Checks</a>
                        </li>
                    </ul>
                    <div class="align-items-center gap-2 d-none d-lg-flex">
                        <div class="image border rounded-circle" style="width:40px;height:40px">
                            <img src="/PHP-Project/php_project-cafeteria/users/imgs/'. $userImage. '"  class="rounded-circle w-100 h-100">
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-white cart-icon" width="25" height="50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <ul class="cart-items p-3 d-none">';
                            if (!empty($cart)&&!empty($cart["products"])) {
                              if(!empty($userName))
                              {
                               echo "
                              <li class='w-100 my-2 fs-6 d-flex gap-2' >
                                  <p>User:</p>
                                  <h4 class='fs-6'>$userName </h4>
                              </li>";
                              }
                                getCartProducts($cart["products"]);
                            } else {
                                echo '
                                <li class="d-flex gap-2 p-5 w-100">
                                    <h4> Cart Is Empty</h4>
                                </li>
                                <a class="btn w-100" href="/PHP-Project/php_project-cafeteria/users/views/user-home.php"> Add Product </a>';
                            }
                            echo '</ul>
                            <a href="/PHP-Project/php_project-cafeteria/users/controller/logout.php" class="btn text-white border border-white">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>';
  }
  
  function getUserData($user_id) { 
    $db_conn= new DataBase();
    $db_conn->connectToDB(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    $user_data= $db_conn->selectRowData("users","user_id",$user_id);
    $user_data=reset($user_data);
    $db_conn->closeConnection();
    return [
        "name"=>$user_data["name"],"email"=>$user_data["email"],"image"=>$user_data["image"],"role"=>$user_data["role"]
    ];
  }
  function getCartProducts($cart_product_id){
    $products_ids = array_keys($cart_product_id);
    $db_conn= new DataBase();
    $db_conn->connectToDB(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    $cart_product_data= $db_conn->select_cart_product($products_ids);
    displayCartList($cart_product_data);
    $db_conn->closeConnection();
   
  }
  function displayCartList($products){
     if(sizeof($products)>0)
     {
        foreach($products as $product)
        {
            echo  '
             <li class="d-flex  gap-2  p-2  w-100">
                <div>
                    <img src="../../products/imgs/'."{$product["image"]}".'" alt="product-imge">
                </div>
                <span>
                    <h6>'."{$product["product_name"]}".'</h6>
                    <p>'."{$product["price"]}".'</p>
                </span>
            </li>';
        }
        echo ' <a class="btn w-100 " href="/PHP-Project/php_project-cafeteria/users/views/cart.php"> Go To Cart</a>';
     }
     else{
      echo  '
      <li class="d-flex  gap-2  p-5  w-100">
          <h4> Cart Is Empty</h4>
      </li>';
      echo ' <a class="btn w-100 " href="#products"> Shop Now </a>';
     }
  }

    function generate_title($message, $size=1, $color='black'){
        echo '<hr>';
        echo "<h{$size}  style='color:{$color}' class='text-center'>{$message}</h{$size}>";
    }

    function displayError($errormessage){
        echo "<br>";
        echo "<h4 style='color: red'>{$errormessage}</h4>";
    }


    function draw_empty_lines(){
        echo str_repeat("<br>", 10);
    }


    function drawlines()
    {
        echo "<hr>";
    }

    function displaySuccess($message)
    {
        echo "<h4 style='color: green'>{$message}</h4>";

    }


function drawUsersTable($users){
    echo "<table class='table mt-1 border '>";
    echo "<tr> <th class=' d-none d-md-block' >Profile Picture</th><th>Name</th><th>Room</th> <th>Ext.</th> <th>Action</th>  </tr>";
    foreach($users as $user) {  
        echo "<tr>";
        $data = array("name", "room_no", "ext", "image");
        foreach ($user as $key=>$value) {

            if (in_array($key, $data) && $key != "image") {
                echo "<td>{$value}</td>";
            }else if($key == "image"){
                echo "<td class=' d-none d-md-block' ><img  class='rounded-circle border border-dark '  src='../imgs/{$value}'  width='70' height='70'></td>";
            }

        }
        echo "<td  >
        <a class='btn ad   col-4 ' href='editUser.php?id={$user['user_id']}'>Edit</a>
        <a class='btn res   col-4 ' href='../controller/deleteUser.php?id={$user['user_id']}&image={$user['image']}'>Delete</a>
      </td>";

        echo "</tr>";

    }

    echo "</table>";


}

function drawDescTable($users){
    echo "<table class='table'>";
    echo "<tr> <th> Field</th> <th> Type</th> <th> Null</th>   
        <th>Key</th><th>Default</th><th>Extra</th>  </tr>";
    foreach($users as $user) {   #EACH student is array of values
        echo "<tr>";
        foreach ($user as $key=>$value) {

                echo "<td>{$value}</td>";
            
        }
        echo "</tr>";

    }

    echo "</table>";


}

function drawActiveOrder($orders){
    echo "<table class='table  mt-1 border '>";
    echo "<tr> <th class=' d-none d-md-block' >order id</th><th>Date</th>  <th>Name</th>  <th>Room</th> <th>Ext.</th> <th>Action</th>  </tr>";
    foreach($orders as $order) {  
        echo "<tr>";
        foreach ($order as$value) {
            
            echo "<td>{$value}</td>";
            
        }
        echo "<td  >
        <a class='btn ad   col-12 ' href='../controller/deliverOrder.php?id={$order['order_id']}'>Deliver</a>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
}

function drawActiveOrderDetails($orderProducts) {
    $totalPrice = 0;

    echo '<div class="row gap-4 justify-content-start">';
    

    foreach ($orderProducts as $product) {
        // Calculate total price for this order
        $orderTotal = (isset($product["price"]) ? $product["price"] : 0) * (isset($product["quantity"]) ? $product["quantity"] : 0);
        $totalPrice += $orderTotal;
       

        // Display product card
        echo '
            <div class="card  active-order m-1 p-2" style="width: 10rem;">
                <img src="../../products/imgs/'. $product["image"] . '" class="card img-fluid rounded fixed-image " alt="Drink Image" style="height: 150px; width: 200px; object-fit:contain; object-position:center;">
                <div class="card-body text-center p-1">
                    <h5 class="card-title fs-6">' . $product["product_name"] . '</h5>
                    <p class="card-text text-muted">L.E ' . number_format($product["price"], 2) . '</p>
                    <p class="card-text text-muted">' . (isset($product["quantity"]) ? $product["quantity"] : 'N/A') . ' X</p>
                </div>
            </div>';
    }
    echo '<div class="text-end total-price ">
     <button>
       Total Price: L.E ' . number_format($totalPrice, 2)
    
   . '  </button></div>';
    // Display total price at the end
    echo '<div class="w-100"></div>';
  

    echo '</div>';
}

function cartItem($productsData,$quantity){
    foreach($productsData as $productData)
    {
    echo '
            <div class="card cart-iproduct m-1 p-2 " style="width: 10rem;">
                <img src="../../products/imgs/' . $productData["image"] . '" class="card img-fluid rounded fixed-image " alt="Drink Image" style="height: 150px; width: 200px; object-fit:contain;object-poistion:center;">
                <div class="card-body text-center p-2">
                    <h5 class="card-title fs-6"style="min-height:60px;">' . $productData["product_name"] . '</h5>
                    <p class="card-text text-muted ">L.E ' . number_format($productData["price"], 2) . '</p>
                   <span><a href="../controller/incQan.php?id=' . $productData['product_id'] . '" type="button" class="btn btn-sm m-2 res ">+</a></span>
                    <span class="card-text text-muted">' . (isset($quantity) ? $quantity: 'N/A') . '</span>
                    <span><a href="../controller/decQan.php?id=' . $productData['product_id']. '" type="button" class="btn res m-2 btn-sm">-</a></span>
                </div>
            <a href="../controller/remove_from_cart.php?id='.$productData['product_id'] .'" class="btn res m-2 fw-bold">
            <i class="bi bi-trash"></i></a>

                </div>
            ';

        }
        
}
function itemSummary($productData,$productTotalPrice){
        echo '
            <div class="row mb-3">
                <div class="col-8">
                    <p><strong>'. $productData[0]['product_name'] .'</strong></p>
                </div>

                <div class="col-4 text-end">
                    <p><strong>'. number_format($productTotalPrice, 1).'L.E</strong></p>
                </div>

            </div>
        ';

}
?>