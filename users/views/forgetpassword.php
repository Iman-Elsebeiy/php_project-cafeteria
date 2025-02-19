<?php
include '../../includes/config.php';
include '../../includes/functions.php';

try {
    if (isset($_POST['send'])) {

        $email = filtervalidation($_POST['email']);
        $oldpassword = filtervalidation($_POST['oldpassword']);
        $newpassword = filtervalidation($_POST['newpassword']);
        $newpasswordhashed = password_hash($newpassword, PASSWORD_DEFAULT);

        $errors = [];




        if (strvalid($email)) {
            $errors['email'] = "please enter email";
        }
        if (validemail($email)) {
            $errors['validemail'] = "please enter a valid email";
        }
        if (strvalid($oldpassword)) {
            $errors['oldpassword'] = "please enter old password";
        }
        if (strvalid($newpassword)) {
            $errors['newpassword'] = "please enter new password";
        }


        if (empty($errors)) {
            $select_query = "SELECT * FROM `users` WHERE `email` = :email ";
            $stm = $pdo->prepare($select_query);


            $stm->bindParam(':email', $email, PDO::PARAM_STR);


            $stm->execute();
            $users = $stm->fetchAll(PDO::FETCH_ASSOC);
            $numofrows = $stm->rowCount();





            if ($numofrows == 1) {
                if (password_verify($oldpassword, $users[0]['password'])) {
                    $update = "UPDATE `users` SET `password` = :newpassword WHERE `email` = :email ";
                    $stm2 = $pdo->prepare($update);


                    $stm2->bindParam(':newpassword',  $newpasswordhashed, PDO::PARAM_STR);
                    $stm2->bindParam(':email', $email, PDO::PARAM_STR);


                    $stm2->execute();

                    $pdo = null;
                    header('Location:login.php');
                    exit;
                } else {
                    $errors['dontmatch'] = "the old password is wrong";
                }
            } else {
                $errors['dontmatch'] = "the old password is wrong";
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
        <h1 class="text-center">forget password</h1>
        <form class="pd-3" method="POST">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">email</label>
                <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <p class="error"><?php if (isset($errors['email'])) echo $errors['email'] ?></p>
                <?php if (!isset($errors['email'])): ?>
                    <p class="error"><?php if (isset($errors['validemail'])) echo $errors['validemail'] ?></p>
                <?php endif; ?>

            </div>


            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">old Password</label>
                <input type="password" class="form-control" name="oldpassword">
                <p class="error"><?php if (isset($errors['oldpassword'])) echo $errors['oldpassword'] ?></p>
                <?php if (!isset($errors['oldpassword'])): ?>
                    <p class="error"><?php if (isset($errors['dontmatch'])) echo $errors['dontmatch'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">new password</label>
                <input type="password" class="form-control" name="newpassword">
                <p class="error"><?php if (isset($errors['newpassword'])) echo $errors['newpassword'] ?></p>

            </div>






            <div class="d-flex justify-content-center">
                <button type="submit" name="send">Submit</button>
            </div>


        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>