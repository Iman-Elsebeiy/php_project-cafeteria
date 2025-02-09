<?php
require_once "../DB/db_product_operation.php";
require_once "../includes/Validtion.php";
$validation = validate_Category($_POST);
extract($validation);
if(!empty($errors)){
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
        $errors["c_name"] ="this Category is already Exist"; 
            $errors_str = json_encode($errors); 
            $old_data["o_cname"] = $_POST["c_name"];
            $old_str = json_encode($old_data);
            
            header("Location: add_category.php?errors=$errors_str&old=$old_str");
    }

}
 
 
 




?>