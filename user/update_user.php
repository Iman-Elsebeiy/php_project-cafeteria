<?php
include '../app/config.php';
include '../app/functions.php';

try {
    if (isset($_POST['send'])) {
        $name = filtervalidation($_POST['name']);
        $email = filtervalidation($_POST['email']);
        $password = filtervalidation($_POST['password']);
        // $conpassword = filtervalidation($_POST['conpassword']);
        $room_no = filtervalidation($_POST['room']);
        $ext = filtervalidation($_POST['ext']);
        $image = $_FILES['img']['name'];
        $image_type = $_FILES['img']['type'];
        $image_size = $_FILES['img']['size'];

        $img_location = "uploads/" . time() . "_" . $image;
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
        }

   
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/cafeteria/css/main.css">
    <title>task1</title>
</head>

<body>
    <div class="container adduser col-lg-5">
        <h1 class="text-center">add user</h1>
        <form class="pd-3" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">name</label>
                <input type="text" class="form-control" name="name">
                <p class="error"><?php if (isset($errors['name'])) echo $errors['name'] ?></p>

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">email</label>
                <input type="text" class="form-control" name="email">
                <p class="error"><?php if (isset($errors['email'])) echo $errors['email'] ?></p>
                <?php if (!isset($errors['email'])): ?>
                    <p class="error"><?php if (isset($errors['validemail'])) echo $errors['validemail'] ?></p>
                <?php endif; ?>

            </div>


            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                <p class="error"><?php if (isset($errors['password'])) echo $errors['password'] ?></p>

            </div>
            <!-- <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">confirm Password</label>
                <input type="password" class="form-control" name="conpassword" id="exampleInputPassword1">


            </div> -->

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
                <input type="text" class="form-control" name="ext">
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





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>