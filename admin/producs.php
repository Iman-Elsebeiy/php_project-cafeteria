<?php
require_once '../includes/db.php';
require_once "../includes/utils.php";

generate_title("All Products");

$products= $db->select('products');

$db->drawTable($products);

$db->close();

echo "<a href='add_product.php' class='btn btn-primary'>Add new Product</a>";

?>

