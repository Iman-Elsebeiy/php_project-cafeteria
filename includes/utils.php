<?php
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
<<<<<<< HEAD
     ini_set('SMTP', 'smtp.mailtrap.io');
     ini_set('smtp_port', '2525');
=======
>>>>>>> 209fa927db9eae09195ea702b946066decaf42bd
     error_reporting(E_ALL);

    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';

    # I will add the commonly used parts
    echo "<div class='container'><pre>";

<<<<<<< HEAD
    # 1- define function generate title
    function generate_title($message, $size=1, $color='black'){
        echo '<hr>';
        echo "<h{$size}  style='color:{$color}' class='text-center'>{$message}</h{$size}>";

    }
=======
    
>>>>>>> 209fa927db9eae09195ea702b946066decaf42bd
    function displayError($errorMessage){
        echo "<h5 style='color: red'> {$errorMessage} </h5>";
        
    }
    
<<<<<<< HEAD
function displaySuccess($message)
{
    echo "<h4 style='color: green'>{$message}</h4>";

}


function drawTable($products){
    echo "<table class='table'>";
    echo "<tr><th> Id</th> <th> Product</th> <th> Price</th><th> Image</th> <th>Edit</th> <th>Delete</th> </tr>";
    foreach($products as $product) {
        echo "<tr>";
        foreach ($product as $key=>$value) {

            if ($key != "image") {
                echo "<td>{$value}</td>";
            }else{
                echo "<td><img src='{$value}' width='100' height='100'></td>";
            }
        }
        echo "<td><a class='btn btn-secondary' href='edit.php?id={$product['id']}'>Edit</a></td>";
        // echo "<td><a class='btn btn-info' href='show.php?id={$user['id']}'>Show</a></td>";
        echo "<td><a class='btn btn-danger' href='delete.php?id={$product['id']}&image={$product['image']}'>Delete</a></td>";
        echo "</tr>";

    }

    echo "</table>";


}

function drawTable2($categories){
    echo "<table class='table'>";
    echo "<tr><th> Id</th> <th> category</th> <th>Edit</th> <th>Delete</th> </tr>";
    foreach($categories as $category) {
        echo "<tr>";
        foreach ($category as $key=>$value) {

            if ($key != "image") {
                echo "<td>{$value}</td>";
            }else{
                echo "<td><img src='{$value}' width='100' height='100'></td>";
            }
        }
        echo "<td><a class='btn btn-secondary' href='edit.php?id={$category['id']}'>Edit</a></td>";
        // echo "<td><a class='btn btn-info' href='show.php?id={$user['id']}'>Show</a></td>";
        echo "<td><a class='btn btn-danger' href='delete.php?id={$category['id']}&image={$category['image']}'>Delete</a></td>";
        echo "</tr>";

    }
    echo "</table>";
}



//
//    generate_title("iti", 1, 'red');
//    generate_title("iti", 2, 'blue');
//    generate_title("iti", 3, 'green');
=======
    function displaySuccess($message)
    {
        echo "<h4 style='color: green'>{$message}</h4>";

    }
>>>>>>> 209fa927db9eae09195ea702b946066decaf42bd
