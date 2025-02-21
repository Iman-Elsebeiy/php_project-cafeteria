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
    <title>About</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/navbar.css">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .section-bg {
        padding: 80px 0;
        background: linear-gradient(to right, rgb(145, 135, 130), rgb(110, 83, 71));
        color: white;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
    }

    .about-heading {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .about-text {
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
    }

    .about-image {
        width: 100%;
        border-radius: 10px;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
    }

    .about-image:hover {
        transform: scale(1.05);
    }

    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 1s forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2">
    <?php displayUserNavbar($_SESSION['image']);?>
    <main class="mx-auto mb-5 mt-100 col-8">
        <section class="section-bg text-center ">
            <div class="container fade-in">
                <h2 class="about-heading">About Café Luxe</h2>
                <p class="about-text">Café Luxe is more than just a coffee shop; it's an experience. We are dedicated to
                    crafting the finest coffee using high-quality beans sourced from around the world. Whether you're
                    here for a quick espresso, a relaxing afternoon with friends, or a cozy corner to work, our café
                    offers a warm and inviting atmosphere.</p>
                    <img src="/PHP-Project/php_project-cafeteria/app-images/logo.png" alt="logo" width="85" height="50">            </div>
        </section>
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