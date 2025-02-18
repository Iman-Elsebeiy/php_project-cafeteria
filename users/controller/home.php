<?php
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
        echo ' <a class="btn w-100 " href="./cart.php"> Go To Cart</a>';
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