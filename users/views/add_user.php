<?php
include '../../includes/config.php';
include '../../includes/functions.php';


try {
    if (isset($_POST['send'])) {
        $name = filtervalidation($_POST['name']);
        $email = filtervalidation($_POST['email']);
        $password = filtervalidation($_POST['password']);
        $room_no = filtervalidation($_POST['room']);
        $ext = filtervalidation($_POST['ext']);
        $image = $_FILES['img']['name'];
        $image_type = $_FILES['img']['type'];
        $image_size = $_FILES['img']['size'];

        $img_location = "../imgs/" . time() . "_" . $image;
        $errors = [];
        if (strvalid($name)) {
            $errors['name'] = "please enter a name and must be grater than 3 char";
        }
        if (strvalid($email)) {
            $errors['email'] = "please enter email";
        }
        if (validemail($email)) {
            $errors['validemail'] = "please enter a valid email";
        }

        if (!uniqueemail($pdo, $email)) {
            $errors['uniqueemail'] = "this email already exsist";
        }
        if (strvalid($password)) {
            $errors['password'] = "please enter password";
        }
        if (strvalid($ext)) {
            $errors['ext'] = "please enter ext";
        }
        if (validfilesize($image_size, 2)) {
            $errors["imagesize"] = "file oversize 2 mega";
        }



        if (validimgtype($image_type)) {
            $errors["imagetype"] = "img must be jbg,jpeg,png,jif";
        }


        if (strvalid($image)) {
            $errors['image'] = "please enter a img ";
        }

        if (empty($errors)) {
            move_uploaded_file($_FILES['img']['tmp_name'], $img_location);
            $insert = "INSERT INTO `users`( `name`, `email`, `password`, `room_no`, `ext`, `image`, `role`) VALUES ('$name', '$email', '$password', '$room_no', '$ext', '$image', 'user')";
            $stm = $pdo->prepare($insert);
            $stm->execute();
            $pdo = null;
            // header("Location:allUsers");
        }
       
      
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
session_start();


LogOut();


NotAuthRedirectToLogin();

AdminOnlyPage();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/cafeteria/style/style.css">
    <title>task1</title>
</head>

<body>
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
                            <form >
                            <button name="logout" class="dropdown-item">logout</button>
                            </form>
                          
                        </li>

                    </ul>
                </li>
            </div>
        </div>
    </nav>

    <div class="container adduser col-lg-5">
        <h1 class="text-center">add user</h1>
        <form class="pd-3" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">name</label>
                <input type="text" class="form-control" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                <p class="error"><?php if (isset($errors['name'])) echo $errors['name'] ?></p>

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">email</label>
                <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <p class="error"><?php if (isset($errors['email'])) echo $errors['email'] ?></p>
                <?php if (!isset($errors['email'])): ?>
                    <p class="error"><?php if (isset($errors['validemail'])) echo $errors['validemail'] ?></p>
                <?php endif; ?>
                <?php if (!isset($errors['validemail'])): ?>
                    <p class="error"><?php if (isset($errors['uniqueemail'])) echo $errors['uniqueemail'] ?></p>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                <p class="error"><?php if (isset($errors['password'])) echo $errors['password'] ?></p>

            </div>
           

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">room no</label>

                <select class="form-select" aria-label="Default select example" name="room" value="">



                    <option value="application1" selected>application1</option>
                    <option value="application2">application2</option>
                    <option value="cloud">cloud</option>
                </select>


            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ext.</label>
                <input type="text" class="form-control" name="ext" value="<?php echo isset($_POST['ext']) ? htmlspecialchars($_POST['ext']) : ''; ?>">
                <p class="error"><?php if (isset($errors['ext'])) echo $errors['ext'] ?></p>


            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">profile picture</label>
                <input type="file" class="form-control" name="img">
                <p class="error"><?php if (isset($errors['image'])) echo $errors['image'] ?></p>
                <?php if (!isset($errors['image'])): ?>
                    <?php if (!isset($errors['imagetype'])): ?>
                        <p class="error"><?php if (isset($errors['imagesize'])) echo $errors['imagesize'] ?></p>

                    <?php endif; ?>

                    <p class="error"><?php if (isset($errors['imagetype'])) echo $errors['imagetype'] ?></p>
                <?php endif; ?>





            </div>




            <div class="d-flex justify-content-evenly">
                <button type="submit" name="send">Submit</button>
                <input type="reset" value="Reset" class="btn btn-secondary">
            </div>


        </form>
    </div>


    <footer>
    <h3>copyright &copy cafeteria All rights reserved</h3>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>