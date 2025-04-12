<?php
 require_once "../../includes/classDB.php";
 require_once "../../includes/config.php";
function displayCategoriesLinks(){
    $db_conn= new DataBase();
    $db_conn->connectToDB(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    $categories=$db_conn->select_data("categories");
    $categories_list ="<li class='p-2'>
                                    <a href='?category=all' data-category-id='all' class='text-decoration-none active-category'>All</a>
                                 </li>";
    
        foreach ($categories as $category) {
            $categories_list .= "<li class='p-2'>
                                    <a href='?category=" . $category['category_id'] . "' class='text-decoration-none' data-category-id='". $category['category_id'] . "'>" . $category['name'] . "</a>
                                 </li>";
        }
        $db_conn->closeConnection();
    
     echo $categories_list;  
  }
  function getProducts($category_id="all",$search="",$slideCount=0){
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
     displayProduct($products,$slideCount);
    $db_conn->closeConnection();
  }
  function displayProduct($products, $slideCount) {
    if (!empty($products)) {
        $productsPerSlide = 8; // 8 products per slide (4 per row)
        $count = 0;
        foreach (array_chunk($products, $productsPerSlide) as $productGroup) {
            $activeClass = ( (int)$slideCount == $count) ? 'active' : '';
            echo '<div class="carousel-item ' . $activeClass . '" >';
            echo '<div class="container">';

            // Splitting each slide into two rows (each with 4 products)
            foreach (array_chunk($productGroup, 4) as $rowProducts) {
                echo '<div class="row row-cols-1 row-cols-md-4 g-3 mb-3">';
                
                foreach ($rowProducts as $product) {
                    $stock_flag=false;
                    if($product["quantity"]==0)
                    {
                         $stock_flag=true;
                    }
                    echo '<div class="col">
                            <div class="product-card  ">
                                <img src="../../products/imgs/' . $product['image'] . '" alt="cafe image" class="img-fluid">';
                                echo ($stock_flag ? "<div class='outstock'>out of stock</div>" : "");
                                
                               echo  '<h3 class="my-2 text-center">' . $product['product_name'] . '</h3>
                                <p class="text-center mb-2">
                                    <span>Price:</span> ' . $product['price'] . ' EG
                                </p>
                                <form action="../controller/add_to_cart.php" method="post" class="text-center d-flex justify-content-center" ">
                                    <input type="hidden" value="' . $product['product_id'] . '" name="product_id">';

                                    echo ($stock_flag ? '<button class="btn" disabled="' .$stock_flag .'" >Coming Soon</button>' :  '<button class="btn" data-product-id="' . $product['product_id'] . '" >+ Add To Cart</button>');
                                   
                             echo ' </form>
                            </div>
                          </div>';
                }
                
                echo '</div>'; // Close row
            }
            
            echo '</div></div>'; // Close container and carousel-item
            $count++;
        }
    } else {
        echo '<h4 class="p-3 mt-2 col-10 mx-auto fs-5">No Products Found!</h4>';
    }
}


function displayTopProduct()
{
    $db_conn = new DataBase();
    $db_conn->connectToDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $products = $db_conn->select_data("product_with_category");
    $db_conn->closeConnection();
    
    $hasProducts = false;
    foreach ($products as $product) {
        if ($product["quantity"] > 0 && $product["quantity"] <= 10) {
            $hasProducts = true;
            echo '
            <div class="col ">
                <div class="d-flex gap-2 align-items-center">
                    <div class="img">
                        <img src="../../products/imgs/' . $product["image"] . '" alt="' . $product["product_name"] . '" class="rounded">
                    </div>
                    <div class="d-flex justify-content-between col-9 align-items-center">
                        <div>
                            <h3>' . $product["product_name"] . '</h3>
                            <p>' . $product["price"] . ' EG</p>
                        </div>
                        <form action="../controller/add_to_cart.php" method="post">
                            <input type="hidden" value="' . $product["product_id"] . '" name="product_id">
                            <button type="submit" class="btn">Get It</button>
                        </form>
                    </div>
                </div>
            </div>';
        }
    }
    
    if (!$hasProducts) {
        echo '<div class="col-12 text-center"><p class="text-muted">No products running low on stock.</p></div>';
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