<?php
 require_once "classDB.php";
 require_once "config.php";
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
  function displayProduct($category_id="all",$search=""){
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
                        <a href="#" class="btn w-100 p-2 fs-6">Add To Cart</a>

                    </div>
             </div>';
     }
    }
    else{
         echo '<h4 class="p-3 mt-2 col-10 mx-auto fs-5"> No Products in Founded !</h4>';
    }
     $db_conn->closeConnection();
  }
  
?>