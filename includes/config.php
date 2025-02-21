<?php
const DB_USER='root';
const DB_PASSWORD='';
const DB_HOST='localhost';
const DB_NAME='cafe';
const DB_PORT=3306;
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_PASSWORD = 'root';
$BD_HOST = 'localhost';
$DB_NAME = 'cafe';

try {

    $pdo = new PDO("mysql:host={$BD_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASSWORD);
} catch (PDOException $e) {

    echo $e->getMessage();
}

?>