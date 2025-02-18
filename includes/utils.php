<?php
 require_once "classDB.php";
 require_once "config.php";
  

  function displayUserNavbar($userImage,$cart){
        echo '
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body fixed-top left-0 right-0" id="navbar-example2" data-bs-theme="dark">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="#">
                    <img src="../../app-images/logo.png" alt="logo" width="85" height="50">
                </a>
                <div class="d-flex align-items-center gap-2 d-block d-lg-none">
                    <button class="navbar-toggler justify-content-center" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="width: 50px; height:40px;">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="image border rounded-circle" style="width:40px;height:40px">
                        <img src="../imgs/' . $userImage . '" alt="" class="rounded-circle w-100 h-100">
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-white cart-icon" width="25" height="50">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <ul class="cart-items p-3 d-none">';
                        if (!empty($cart)) {
                            getCartProducts($cart["products"]);
                        } else {
                            echo '
                            <li class="d-flex gap-2 p-5 w-100">
                                <h4> Cart Is Empty</h4>
                            </li>
                            <a class="btn w-100" href="#products"> Shop Now </a>';
                        }
                        echo '</ul>
                    </div>
                </div>
    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-2">
                            <a class="nav-link" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#products">Products</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">My Orders</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                    <div class="align-items-center gap-2 d-none d-lg-flex">
                        <div class="image border rounded-circle" style="width:40px;height:40px">
                            <img src="../imgs/' . $userImage . '" alt="" class="rounded-circle w-100 h-100">
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-white cart-icon" width="25" height="50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <ul class="cart-items p-3 d-none">';
                            if (!empty($cart)) {
                                getCartProducts($cart["products"]);
                            } else {
                                echo '
                                <li class="d-flex gap-2 p-5 w-100">
                                    <h4> Cart Is Empty</h4>
                                </li>
                                <a class="btn w-100" href="#products"> Shop Now </a>';
                            }
                            echo '</ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>';
   }
 function displayAdminNavbar($userImage,$cart,$userName){
        echo '
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body " id="navbar-example2" data-bs-theme="dark">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="#">
                    <img src="../../app-images/logo.png" alt="logo" width="85" height="50">
                </a>
                <div class="d-flex align-items-center gap-2 d-block d-lg-none">
                    <button class="navbar-toggler justify-content-center" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="width: 50px; height:40px;">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="image border rounded-circle" style="width:40px;height:40px">
                        <img src="../imgs/' . $userImage . '" alt="" class="rounded-circle w-100 h-100">
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
                            <a class="btn w-100" href="#products"> Shop Now </a>';
                        }
                        echo '</ul>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#products">Shop</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#about">Products</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Uesrs</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Orders</a>
                        </li>
                        
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#contact">Checks</a>
                        </li>
                    </ul>
                    <div class="align-items-center gap-2 d-none d-lg-flex">
                        <div class="image border rounded-circle" style="width:40px;height:40px">
                            <img src="../imgs/' . $userImage . '" alt="" class="rounded-circle w-100 h-100">
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
                                <a class="btn w-100" href="#products"> Add Product </a>';
                            }
                            echo '</ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>';
  }
  function displayCategoriesLinks(){
    $db_conn= new DataBase();
    $db_conn->connectToDB(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    $categories=$db_conn->select_data("categories");
    $categories_list ="<li class='p-2'>
                                    <a href='?category=all' class='text-decoration-none'>All</a>
                                 </li>";
    
        foreach ($categories as $category) {
            $categories_list .= "<li class='p-2'>
                                    <a href='?category=" . $category['category_id'] . "' class='text-decoration-none'>" . $category['name'] . "</a>
                                 </li>";
        }
        $db_conn->closeConnection();
    
     echo $categories_list;  
  }
  function getProducts($category_id="all",$search=""){
    $db_conn= new DataBase();
    $db_conn->connectToDB(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    if($category_id!="all"){
       $products= $db_conn->select_product_of_catgory($category_id);
    }
    elseif(trim($search)!="" ){
        $products= $db_conn->select_searched_product($search);    
    }
    else{
        $products= $db_conn->select_data("product_with_category");
    }
     displayProduct($products);
    $db_conn->closeConnection();
  }
  function displayProduct($products){
    if(!empty($products)){ 
        foreach($products as $product)
    {
       echo'<div class="col">
                   <div class="product-card p-3 rounded">
                       <img src="../../products/imgs/'."{$product['image']}".  '
                       "  alt="cafe image">
                       <h5 class=" my-2 text-center">'."{$product['product_name']}".'</h5>
                       <p class="text-center mb-2">
                           <span>Price:</span>'
                           ."{$product['price']}".'</p>
                       <p class="text-center mb-2">
                           <span>Category:</span>'."{$product['category_name']}".'
                           
                       </p>
                      <form action="../controller/add_to_cart.php" method="post">
                                    <input type="text" value="'."{$product['product_id']}".'" name="product_id" hidden>
                       <button class="btn w-100 p-2 " data-product-id="'."{$product['product_id']}".'" >Add To Cart</button>
                         </form>
                   </div>
            </div>';
    }
    }
    else{
        echo '<h4 class="p-3 mt-2 col-10 mx-auto fs-5"> No Products in Founded !</h4>';
   }
  }
  function getUserData($user_id) { 
    $db_conn= new DataBase();
    $db_conn->connectToDB(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    $user_data= $db_conn->selectRowData("users",$user_id);
    $user_data=reset($user_data);
    $db_conn->closeConnection();
    return ["name"=>$user_data["name"],"email"=>$user_data["email"],"image"=>$user_data["image"],"role"=>$user_data["role"]];
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
        echo ' <a class="btn w-100 " href="#cart.php"> Go To Cart</a>';
     }
     else{
      echo  '
      <li class="d-flex  gap-2  p-5  w-100">
          <h4> Cart Is Empty</h4>
      </li>';
      echo ' <a class="btn w-100 " href="#products"> Shop Now </a>';
     }
  }
  function getAllUserForSelect ($value="")
  {
    $db_conn= new DataBase();
    $db_conn->connectToDB(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    $users= $db_conn->selectAllUser(); 
    displayUser($users,$value);
    $db_conn->closeConnection(); 
  }
  function displayUser($users,$value){
    if(sizeof($users)>0)
    {
      foreach($users as $user)
      {
        echo '<option value="' . $user["user_id"] . '" ' . 
             ($value == $user["user_id"] ? 'selected' :'') . 
              '>' . $user["name"] . '</option>';
      }
     
    }
    else{
      echo '<option disabled> No User Found </option>';

    }
  }
?>