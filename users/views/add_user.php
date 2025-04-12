<?php
include '../../includes/navbar.php';
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
      displayAdminNavbar();
    ?>

<body>



    <div class="container adduser col-lg-6 mt-4">
        <h1>ADD USER</h1>
        <form class="pd-3" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                    value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                <p class="error txt-sm p-0 text-danger"><?php if (isset($errors['name'])) echo $errors['name'] ?></p>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
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
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                <p class="error txt-sm p-0 text-danger">
                    <?php if (isset($errors['password'])) echo $errors['password'] ?></p>
            </div>

            <div class="mb-3">
                <label for="room" class="form-label">Room No</label>
                <select class="form-select" id="room" name="room">
                    <option value="application1"
                        <?php if(isset($_POST['room']) && $_POST['room'] == 'application1') echo 'selected'; ?>>
                        Application 1</option>
                    <option value="application2"
                        <?php if(isset($_POST['room']) && $_POST['room'] == 'application2') echo 'selected'; ?>>
                        Application 2</option>
                    <option value="cloud"
                        <?php if(isset($_POST['room']) && $_POST['room'] == 'cloud') echo 'selected'; ?>>Cloud</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="ext" class="form-label">Ext</label>
                <input type="text" class="form-control" id="ext" name="ext" placeholder="Enter extension"
                    value="<?php echo isset($_POST['ext']) ? htmlspecialchars($_POST['ext']) : ''; ?>">
                <p class="error txt-sm p-0 text-danger"><?php if (isset($errors['ext'])) echo $errors['ext'] ?></p>
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="img" name="img">
                <p class="error txt-sm p-0 text-danger"><?php if (isset($errors['image'])) echo $errors['image'] ?></p>
                <?php if (!isset($errors['image'])): ?>
                <?php if (!isset($errors['imagetype'])): ?>
                <p class="error txt-sm p-0 text-danger">
                    <?php if (isset($errors['imagesize'])) echo $errors['imagesize'] ?></p>
                <?php endif; ?>
                <p class="error txt-sm p-0 text-danger">
                    <?php if (isset($errors['imagetype'])) echo $errors['imagetype'] ?></p>
                <?php endif; ?>
            </div>

            <div class="d-flex gap-3 mt-4">
                <button type="submit" name="send" class="btn btn-primary">Submit</button>
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

</body>

</html>