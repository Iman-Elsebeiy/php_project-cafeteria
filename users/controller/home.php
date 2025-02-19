<?php
 require_once "../../includes/classDB.php";
 require_once "../../includes/config.php";
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
       if($product["quantity"]>0)
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
    }
    else{
        echo '<h4 class="p-3 mt-2 col-10 mx-auto fs-5"> No Products in Founded !</h4>';
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