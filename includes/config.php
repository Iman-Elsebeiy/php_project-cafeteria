<?php

$DB_USER = 'root';
$DB_PASSWORD = '';
$BD_HOST = 'localhost';
$DB_NAME = 'cafe';

try {

    $pdo = new PDO("mysql:host={$BD_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASSWORD);
} catch (PDOException $e) {

    echo $e->getMessage();
}
