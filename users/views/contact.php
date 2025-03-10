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
        <section class="section-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-container">
                            <h3 class=" mb-4 fs-4">We'd love to hear from you</h3>
                            <form action="#" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea id="message" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-sub w-20">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="map-container">
                            <iframe class="w-100" height="250" src="https://www.google.com/maps/embed?..."
                                style="border:0;" allowfullscreen></iframe>
                            <h5 class="mt-3">Cafe Center</h5>
                            <p>Downtown, Cairo, Egypt</p>
                        </div>
                    </div>
                </div>
            </div>
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