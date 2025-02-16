<?php
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);

    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';

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
                echo "<td class=' d-none d-md-block' ><img  class='rounded-circle border border-dark '  src='{$value}'  width='70' height='70'></td>";
            }

        }
        echo "<td  >
        <a class='btn add   col-4 ' href='editUser.php?id={$user['user_id']}'>Edit</a>
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
        foreach ($order as $key=>$value) {
            $id=$order['order_id'];
            echo "<td>{$value}</td>";
            
        }
        echo "<td  >
        <a class='btn add   col-12 ' href='../controller/deliverOrder.php?id={$order['order_id']}'>Deliver</a>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
}

function drawActiveOrderDetails($orderProducts) {
    $totalPrice = 0;

    echo '<div class="row gap-5 justify-content-start">';

    foreach ($orderProducts as $product) {
        // Calculate total price for this order
        $orderTotal = (isset($product["price"]) ? $product["price"] : 0) * (isset($product["quantity"]) ? $product["quantity"] : 0);
        $totalPrice += $orderTotal;

        // Display product card
        echo '
            <div class="card shadow-lg m-1 p-2" style="width: 10rem;">
                <img src="' . $product["image"] . '" class="card img-fluid rounded fixed-image " alt="Drink Image" style="height: 150px; width: 200px; object-fit: cover;">
                <div class="card-body text-center p-1">
                    <h5 class="card-title">' . $product["product_name"] . '</h5>
                    <p class="card-text text-muted">L.E ' . number_format($product["price"], 2) . '</p>
                    <p class="card-text text-muted">' . (isset($product["quantity"]) ? $product["quantity"] : 'N/A') . ' X</p>
                </div>
            </div>';
    }

    // Display total price at the end
    echo '<div class="w-100"></div>';
    echo '<h5 class="text-end w-100">Total Price: L.E ' . number_format($totalPrice, 2) . '</h5>';

    echo '</div>';
}

//
//    generate_title("iti", 1, 'red');
//    generate_title("iti", 2, 'blue');
//    generate_title("iti", 3, 'green');