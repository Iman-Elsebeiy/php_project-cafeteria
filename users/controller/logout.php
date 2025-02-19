<?php
    session_start();
    session_unset();
    session_destroy();
    header("Location:/PHP-Project/php_project-cafeteria/users/views/login.php");



?>