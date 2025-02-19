<?php
include '../../includes/config.php';
include '../../includes/functions.php';

try {
    if (isset($_POST['send'])) {

        $email = filtervalidation($_POST['email']);
        $password = filtervalidation($_POST['password']);
    

        $errors = [];

        if (strvalid($email)) {
            $errors['email'] = "please enter email";
        }
        if (validemail($email)) {
            $errors['validemail'] = "please enter a valid email";
        }
        if (strvalid($password)) {
            $errors['password'] = "please enter password";
        }


        if (empty($errors)) {
            $select_query = "SELECT * FROM `users` WHERE `email`='$email' ";
            $stm = $pdo->prepare($select_query);
            $stm->execute();
            $users = $stm->fetchAll(PDO::FETCH_ASSOC);
            $numofrows = $stm->rowCount();
            $pdo = null;


       

           
            if ($numofrows == 1) {

                if (password_verify($password, $users[0]['password'])) {
                session_start();
                $_SESSION['id'] = $users[0]['user_id'];
                $_SESSION['name'] = $users[0]['name'];
                $_SESSION['image'] = $users[0]['image'];
                $_SESSION['role'] = $users[0]['role'];
                $_SESSION['login'] = true;
                header('Location: home.php');
                exit;
            } else {
                $errors['invalid'] = "invalid email or password";
            }
            } else {
                $errors['invalid'] = "invalid email or password";
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header('Location:/cafeteria/users/views/home.php');
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/cafeteria/style/style.css">
    <title>task1</title>
</head>

<body>

    <div class="container adduser login col-lg-5">
        <h1 class="text-center">log in</h1>
        <form class="pd-3" method="POST">
            <p class="error text-center"><?php if (isset($errors['invalid'])) echo $errors['invalid']  ?></p>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">email</label>
                <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
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







            <div class="d-flex justify-content-center">
                <button type="submit" name="send">Submit</button>
            </div>
            <div class="d-flex justify-content-center mt-3 forget">
                <a href="./forgetpassword.php">forget password ?</a>
            </div>

        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>