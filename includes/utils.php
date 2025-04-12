<?php
 require_once "classDB.php";
 require_once "config.php";
  
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
                <div class="cart-item-image">
                    <img src="../../products/imgs/'."{$product["image"]}".'" alt="product-imge">
                </div>
                <span>
                    <h6>'."{$product["product_name"]}".'</h6>
                    <p>'."{$product["price"]}".'</p>
                </span>
            </li>';
        }
        echo ' <a class="btn w-75 my-2 mx-auto " href="/PHP-Project/php_project-cafeteria/users/views/cart.php"> Go To Cart</a>';
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
    echo '<div class="users-container">
        <div class="users-header">
            <h2>Manage Users</h2>
            <a href="add_user.php" class="add-user-btn">Add User</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Profile Picture</th>
                        <th>Name</th>
                        <th>Room</th>
                        <th>Ext.</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
    
    foreach($users as $user) {  
        echo "<tr>";
        $data = array("name", "room_no", "ext", "image");
        foreach ($user as $key=>$value) {
            if (in_array($key, $data) && $key != "image") {
                echo "<td>{$value}</td>";
            } else if($key == "image"){
                echo '<td class="d-none d-md-block">
                    <img class="user-image" src="../imgs/' . $value . '" >
                </td>';
            }
        }
        echo '<td>
            <div class="action-buttons">
                <a class="btn ad" href="editUser.php?id=' . $user['user_id'] . '">Edit</a>
                <a class="btn res" href="../controller/deleteUser.php?id=' . $user['user_id'] . '&image=' . $user['image'] . '">Delete</a>
            </div>
        </td>';
        echo "</tr>";
    }
    
    echo '</tbody></table></div></div>';
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
    echo '<div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th >Order ID</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Ext.</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
    
    foreach($orders as $order) {  
        echo "<tr>";
        foreach ($order as $value) {
            echo "<td>{$value}</td>";
        }
        echo '<td>
            <a class="btn ad" href="../controller/deliverOrder.php?id='.$order['order_id'].'">
                Deliver
            </a>
        </td>';
        echo "</tr>";
    }
    
    echo '</tbody></table></div>';
}

function drawActiveOrderDetails($orderProducts) {
    $totalPrice = 0;
    
    // Calculate total price first
    foreach ($orderProducts as $product) {
        $orderTotal = (isset($product["price"]) ? $product["price"] : 0) * 
                     (isset($product["quantity"]) ? $product["quantity"] : 0);
        $totalPrice += $orderTotal;
    }

    // Display total price at the top
    echo '<div class="order-header d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Order Details</h4>
            <div class="total-price">
                <button>Total Price: L.E ' . number_format($totalPrice, 2) . '</button>
            </div>
          </div>';

    
   

    echo '<div class="products-grid">';
    foreach ($orderProducts as $product) {
        echo '<div class="card active-order">
                <div class="quantity-badge">' . $product["quantity"] . 'x</div>
                <img src="../../products/imgs/'. $product["image"] . '" 
                     alt="' . $product["product_name"] . '">
                <div class="card-body">
                    <h5 class="card-title">' . $product["product_name"] . '</h5>
                    <p class="card-text">L.E ' . number_format($product["price"], 2) . '</p>
                </div>
            </div>';
    }
    echo '</div>';
}

function cartItem($productsData,$quantity){
    foreach($productsData as $productData)
    {
    echo '
            <div class=" cart-iproduct p-2  ">
                <img src="../../products/imgs/' . $productData["image"] . '" class="card-image" alt="Drink Image" >
                <div class=" p-2 col-9">
                    <h5 >' . $productData["product_name"] . '</h5>
                     <p >L.E ' . number_format($productData["price"], 2) . '</p>
                </div>
                <div class="plus-mins  col-2">
                   <span><a href="../controller/incQan.php?id=' . $productData['product_id'] . '" type="button" class="plus">+</a></span>
                    <span>' . (isset($quantity) ? $quantity: 'N/A') . '</span>
                    <span><a href="../controller/decQan.php?id=' . $productData['product_id']. '" type="button" class="mins">-</a></span>
                      <a href="../controller/remove_from_cart.php?id='.$productData['product_id'] .'" class="btn  fw-bold">
                    <i class="bi bi-trash  fs-5"></i></a>
                </div>
               
          

                </div>
            ';

        }
        
}
function itemSummary($productData,$productTotalPrice){
        echo '
            <div class="row mb-3">
                <div class="col-8">
                    <p>'. $productData[0]['product_name'] .'</p>
                </div>

                <div class="col-4 text-end price">
                    <p>'. number_format($productTotalPrice, 1).'L.E</p>
                </div>

            </div>
        ';

}
?>