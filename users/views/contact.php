<?php
  require_once "../../includes/utils.php";
  require_once "../../includes/functions.php";
  NotAuthRedirectToLogin();
   if( $_SESSION["role"]=="admin")
   {
       header("Location: ./admin-home.php");
       exit();
   }  
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/navbar.css">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: whitesmoke;
    }

    .section-bg {
        padding: 50px 0;
    }

    .form-container,
    .map-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 3px 3px 5px #8f5f49;
    }


    .btn-sub {
        background-color: rgb(29, 27, 26);
        border: none;
        color: whitesmoke;
    }

    .btn-sub:hover {
        background-color: #8f5f49;
    }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2">
    <?php displayUserNavbar($_SESSION['image']);?>
    <main class="mt-5">

    </main>

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

</html>