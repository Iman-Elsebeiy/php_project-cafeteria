<?php
include '../../includes/config.php';
include '../../includes/functions.php';
include '../../includes/utils.php';

try {
    if (isset($_POST['send'])) {
        $name = filtervalidation($_POST['name']);
        $email = filtervalidation($_POST['email']);
        $password = filtervalidation($_POST['password']);
        $hashpassword= password_hash( $password, PASSWORD_DEFAULT);
        $room_no = filtervalidation($_POST['room']);
        $ext = filtervalidation($_POST['ext']);
        $fileExt = explode(".", $_FILES['img']['name']);
        $fileExt=strtolower(end($fileExt));
        $image_name= $email.$fileExt;
        $img_location="../imgs/" .$image_name;
        $image_type = $_FILES['img']['type'];
        $image_size = $_FILES['img']['size'];
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
        if (strvalid($image_name)) {
            $errors['image'] = "please enter a img ";
        }

        if (empty($errors)) {
            move_uploaded_file($_FILES['img']['tmp_name'], $img_location);
            $insert = "INSERT INTO `users` (`name`, `email`, `password`, `room_no`, `ext`, `image`, `role`) 
            VALUES (:name, :email, :password, :room_no, :ext, :image, 'user')";

           
            $stm = $pdo->prepare($insert);

        
            $stm->bindParam(':name', $name);
            $stm->bindParam(':email', $email);
            $stm->bindParam(':password', $hashpassword);
            $stm->bindParam(':room_no', $room_no);
            $stm->bindParam(':ext', $ext);
            $stm->bindParam(':image', $image_name);

        
            $stm->execute();

    
            $pdo = null;
            header("Location:./allUsers.php");
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}



LogOut();


NotAuthRedirectToLogin();

AdminOnlyPage();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/navbar.css">
    <title>Add User</title>
</head>
<?php
      displayAdminNavbar($_SESSION["image"]);
    ?>

<body>



    <div class="container adduser col-lg-6 mt-4">
        <div class="text-end">
            <a href="allUsers.php" class="btn ad ">Users List</a>
        </div>
        <h1 class=" fs-4 p-2">Add user</h1>
        <form class="pd-3" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">name</label>
                <input type="text" class="form-control" name="name"
                    value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                <p class="error txt-sm p-0 text-danger"><?php if (isset($errors['name'])) echo $errors['name'] ?></p>

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">email</label>
                <input type="text" class="form-control" name="email"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <p class="error txt-sm p-0 text-danger"><?php if (isset($errors['email'])) echo $errors['email'] ?></p>
                <?php if (!isset($errors['email'])): ?>
                <p class="error txt-sm p-0 text-danger">
                    <?php if (isset($errors['validemail'])) echo $errors['validemail'] ?></p>
                <?php endif; ?>
                <?php if (!isset($errors['validemail'])): ?>
                <p class="error txt-sm p-0 text-danger">
                    <?php if (isset($errors['uniqueemail'])) echo $errors['uniqueemail'] ?></p>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                <p class="error txt-sm p-0 text-danger">
                    <?php if (isset($errors['password'])) echo $errors['password'] ?></p>

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
                <input type="text" class="form-control" name="ext"
                    value="<?php echo isset($_POST['ext']) ? htmlspecialchars($_POST['ext']) : ''; ?>">
                <p class="error"><?php if (isset($errors['ext'])) echo $errors['ext'] ?></p>


            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">profile picture</label>
                <input type="file" class="form-control" name="img">
                <p class="error txt-sm"><?php if (isset($errors['image'])) echo $errors['image'] ?></p>
                <?php if (!isset($errors['image'])): ?>
                <?php if (!isset($errors['imagetype'])): ?>
                <p class="error txt-sm"><?php if (isset($errors['imagesize'])) echo $errors['imagesize'] ?></p>

                <?php endif; ?>

                <p class="error txt-sm"><?php if (isset($errors['imagetype'])) echo $errors['imagetype'] ?></p>
                <?php endif; ?>





            </div>




            <div class="d-flex justify-content-evenly">
                <button type="submit" name="send">Submit</button>
                <input type="reset" value="Reset" class="btn btn-secondary">
            </div>


        </form>
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
    <script src="../../javascript/add-user-validation.js"></script>

</body>

</html>