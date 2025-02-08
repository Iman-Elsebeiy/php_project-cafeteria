<?php
const DB_USER='root';
const DB_PASSWORD='root';
const DB_HOST='localhost';
const DB_NAME='cafe';
const DB_PORT=3306;
function connectToDB()
{
    try{
        $db_name= DB_NAME;
        $db_host= DB_HOST;
        $pdo = new PDO("mysql:host={$db_host};dbname={$db_name}", DB_USER, DB_PASSWORD);
        return $pdo;
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}
function insert_product($product_name ,$image,  $price ,$quantity, $category_id ) {
    try{
    $pdo = connectToDB();
    $inst_query =  "INSERT INTO `products`(`product_name`,`image`,`price`,`quantity`,`category_id`) 
    values (:productname, :productimage, :price, :quan, :catid ) ";
    $stmt = $pdo->prepare($inst_query);
    $stmt->bindParam(':productname', $product_name); 
    $stmt->bindParam(':productimage', $image); 
    $stmt->bindParam(':price', $price); 
    $stmt->bindParam(':quan', $quantity); 
    $stmt->bindParam(':catid', $category_id); 
   
    $stmt->execute();

    }
    catch (PDOException $e){
        throw new Exception($e->getMessage());
    }

 }
 function select_data($table)
 {
    $pdo = connectToDB();
    $select_query =  "SELECT * FROM `$table`";
    $stmt = $pdo->prepare($select_query);
    $stmt->execute();
    $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result_set;
 }
 function select_product($product_name)
 {
    $pdo = connectToDB();
    $query = "SELECT * FROM `products` where product_name = :p_name";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':p_name', $product_name);
    $res =$statement->execute();
    $result_set = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result_set;

 }
 function select_category($category_name)
 {
    $pdo = connectToDB();
    $query = "SELECT * FROM `categories` where name = :c_name";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':c_name', $category_name);
    $res =$statement->execute();
    $result_set = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result_set;

 }
 function insert_category($category_name) {
    try{
    $pdo = connectToDB();
    $inst_query =  "INSERT INTO `categories`(`name`) 
    values (:cat_name) ";
    $stmt = $pdo->prepare($inst_query);
    $stmt->bindParam(':cat_name', $category_name); 
    $stmt->execute();

    }
    catch (PDOException $e){
        throw new Exception($e->getMessage());
    }

 }

?>