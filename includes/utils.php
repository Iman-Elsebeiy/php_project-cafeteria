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
    echo "<tr> <th>Picture</th><th>Name</th><th>Room</th> <th>Ext.</th> <th>Action</th>  </tr>";
    foreach($users as $user) {  
        echo "<tr>";
        $data = array("name", "room_no", "ext", "image");
        foreach ($user as $key=>$value) {

            if (in_array($key, $data) && $key != "image") {
                echo "<td>{$value}</td>";
            }else if($key == "image"){
                echo "<td><img src='{$value}'  height='50'></td>";
            }

        }
        echo "<td>
        <a class='btn sub   col-4 ' href='editUser.php?id={$user['user_id']}'>Edit</a>
        <a class='btn res   col-4 ' href='deleteUser.php?id={$user['user_id']}&image={$user['image']}'>Delete</a>
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


//
//    generate_title("iti", 1, 'red');
//    generate_title("iti", 2, 'blue');
//    generate_title("iti", 3, 'green');