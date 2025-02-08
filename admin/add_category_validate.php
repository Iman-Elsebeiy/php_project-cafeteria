<?php
require_once "db_product_operation.php";
 
 if(!isset($_POST["c_name"]))
 {
    $errors["c_name"] = "Category Name is required";
 }
 else if(isset($_POST["c_name"]) and ! preg_match("/^[a-zA-Z ]{4,}$/",$_POST["c_name"]))
 {
    $errors["c_name"] = "Category Name is Not Vaild"; 
    $old_data["o_cname"] = $_POST["c_name"];
 }
if(isset($errors)){
    $errors_str= json_encode($errors);
    if($old_data)
    {
        $old_str= json_encode($old_data);
    }
    header("Location: add_category.php?errors=$errors_str&old=$old_str");
}
else{
    $result = select_category($_POST["c_name"]);
    if(!$result)
    {
        insert_category($_POST["c_name"]) ;
        header("Location: add_product.php");
    }
    else{
        $error["c_name"] ="this Category is already Exist"; 
            $errors_str = json_encode($error); 
            $old_data["o_cname"] = $_POST["c_name"];
            $old_str = json_encode($old_data);
            
            header("Location: add_category.php?errors=$errors_str&old=$old_str");
    }
   

}
 
 
 




?>