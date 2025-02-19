<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/cafeteria/style/style.css">
</head>

<body>
    <?php
include '../../includes/functions.php';

session_start();

LogOut();
NotAuthRedirectToLogin();


    ?>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">cafeteria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/cafeteria/users/views/home.php">Home</a>
                    </li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="#">products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">manual orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">checks</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/cafeteria/orders/views/myorder.php">my orders</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="d-flex person">
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">


                        <?php echo $_SESSION['name'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <form>
                                <button name="logout" class="dropdown-item">logout</button>
                            </form>

                        </li>

                    </ul>
                </li>
            </div>
        </div>
    </nav>

    <footer>
    <h3>copyright &copy cafeteria All rights reserved</h3>
</footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>