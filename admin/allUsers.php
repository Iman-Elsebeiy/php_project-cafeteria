<?php
require_once '../includes/helper.php';
require_once '../includes/utils.php';
require_once '../pdo/classDB.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All-Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <div class="container">

        <?php
        $cafe=new dataBase();
        $cafe->connectToDB("localhost", "cafe", "abdo", "abdo");
        $cafe->select_data('users');
        drawUsersTable($cafe->select_data('users'));
        $cafe->closeConnection();
    ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>


<!-- <a href="addUser.php" class="btn btn-primary"><B>Add Customer</B></a> -->