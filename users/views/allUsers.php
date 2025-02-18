<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
session_start();

$_SESSION['cart'] = [
    // 'product_id'=>'quantity'
    'products'=>[
        '2' => 102,
        '5' => 9,
        '6' => 3,
        '7' => 4,
        '8' => 5,
        '9' => 7
    ],
    "user_id"=>'19'

];
$_SESSION['login'] = true ;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All-Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style/style.css">

</head>

<body>
    <div class="container">
        <div class="mt-1 text-end">
            <a href="add_user.php" class="btn add ">Add User</a>
        </div>

        <?php

            $cafe=new dataBase();
            $cafe->connectToDB("localhost", "cafe", "root", "root");
             // this is page for all users 
            // i  created view for users details Except passwords 
            //  i only created view with desierd data details 
            //  at my Database then i will select the view and display it 
           
            drawUsersTable($cafe->select_data('user_details'));
            $cafe->closeConnection();

        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>