<?php
require_once "../../includes/classDB.php";
require_once "../../includes/config.php";
require_once "../../includes/Validtion.php";
$validation = validate_Category($_POST);
extract($validation);
if(!empty($errors)){
    $errors_str= json_encode($errors);
    if($old_data)
    {
        $old_str= json_encode($old_data);
    }
    header("Location: ../views/add_category.php?errors=$errors_str&old=$old_str");
}
else{
    $db_conn = new DataBase();
    $db_conn->connectToDB(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    $result =  $db_conn->select_category($_POST["c_name"]);
    if(!$result)
    {
        $db_conn->insert_category($_POST["c_name"]) ;
        $db_conn->closeConnection();
        header("Location: ../views/add_product.php");


    }
    else{
        $db_conn->closeConnection();
        $errors["c_name"] ="this Category is already Exist"; 
            $errors_str = json_encode($errors); 
            $old_data["o_cname"] = $_POST["c_name"];
            $old_str = json_encode($old_data);
            
            header("Location: ../views/add_category.php?errors=$errors_str&old=$old_str");
    }

}
 
 
 




?>