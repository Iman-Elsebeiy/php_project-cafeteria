<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/navbar.php';
require_once '../../includes/classDB.php';
require_once "../../includes/functions.php";
   NotAuthRedirectToLogin();
   if( $_SESSION["role"]=="user")
    {
        header("Location: ./user-home.php");
    }

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
    <link rel="stylesheet" href="../../style/navbar.css">
    <link rel="stylesheet" href="../../style/alluser.css">

</head>

<body>
    <?php displayAdminNavbar(); ?>
    <div class="container mt-5">

        <?php

            $cafe=new dataBase();
            $cafe->connectToDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
            // this is page for all users 
            // i  created view for users details Except passwords 
            //  i only created view with desierd data details 
            //  at my Database then i will select the view and display it 
           
            drawUsersTable($cafe->select_data('user_details'));
            $cafe->closeConnection();

        ?>
    </div>

    <?php include '../../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../javascript/index.js"></script>

</body>