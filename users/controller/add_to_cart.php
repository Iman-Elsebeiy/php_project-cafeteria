<?php

 session_start();
 if ($_SESSION["role"] == "user") {
    if (isset($_SESSION["cart"])) {
        if (isset($_SESSION["cart"]["products"])) {
            $_SESSION["cart"]["products"][$_POST['product_id']] = 1;
        } else {
            $_SESSION["cart"]["products"] = [
                $_POST['product_id'] => 1
            ];
        }
    } else {
        $_SESSION["cart"] = [
            "products" => [
                $_POST["product_id"] => 1
            ],
            "user_id" => $_SESSION["id"]
        ];
    }
    header("Location: ../views/user-home.php?message=Product Add Successfully&product=" . $_POST['product_id']);
    exit();
} else if ($_SESSION["role"] == "admin") {
    if (!empty($_SESSION["cart"]["user_id"])) {
        if (!empty($_SESSION["cart"]["products"])) {
            $_SESSION["cart"]["products"][$_POST['product_id']] = 1;
        } else {
            $_SESSION["cart"]["products"] = [
                $_POST['product_id'] => 1
            ];
        }
        header("Location: ../views/admin-home.php?message=Product Add Successfully&product=" . $_POST['product_id'] . "&cart_user_id=" . $_SESSION["cart"]["user_id"]);
        exit();
    } else {
        
        header("Location: ../views/admin-home.php?error=Must select user");
        exit();
    }


}
else{
    session_unset();
    session_destroy();
    header("Location:/PHP-Project/php_project-cafeteria/users/views/login.php");
    
}

?>