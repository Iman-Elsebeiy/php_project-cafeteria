<?php
require_once "db_product_operation.php";
  $old_data=[];
  $valid_exten=["png","jpeg","jpg"];
  $errors=form_validate($_POST);
  $imge_error=image_validation($_FILES["p_image"],$valid_exten,200000);
if($imge_error)
  {
     $errors["image"]=$imge_error;
  }
if($errors){
    $errors_str= json_encode($errors);
    if($old_data)
    {
        $old_str= json_encode($old_data);
    }
    header("Location: add_product.php?errors=$errors_str&old=$old_str");
}
else{
    $imge_name=$_POST['p_name'].".".pathinfo($_FILES["p_image"]["name"], PATHINFO_EXTENSION);
    /**check for product if exist  */
    $result = select_product($_POST["p_name"]);
    if(!$result)
    {
         insert_product($_POST["p_name"] ,$imge_name, $_POST["p_price"]  ,(int)$_POST["p_quantity"] , (int)$_POST["p_category"]  );
         move_uploaded_file($_FILES["p_image"]['tmp_name'],"../imgs/".$imge_name);
    }
    else{
        $error["db"] ="this product is already Exist"; 
            $errors_str = json_encode($error); 
            foreach($_POST as $key=>$value)
            {
                $old_data["o_$key"] =$value;
            }
            $old_str = json_encode($old_data);
            
            header("Location: add_product.php?errors=$errors_str&old=$old_str");
    }
   

}

  function form_validate($form_data){
    $errors=[];
    global $old_data;
    foreach($form_data as $key=>$value)
    {
        if(!$value)
        {
        $errors[$key]="this field is requried";
        }
        else{
            $old_data["o_$key"]=$value;
        }
    }
    if($form_data["p_price"]!="" and $form_data["p_price"]<=10)
    {
        $errors["p_price"]="not valid Price";
    }
    if($form_data["p_quantity"]!="" and $form_data["p_quantity"]<=0)
    {
        $errors["p_quantity"]="not valid Quantity";
    }
    if($form_data["p_name"]!="" and ! preg_match("/^[a-zA-Z ]{4,}$/",$form_data["p_name"]))
    {
        $errors["p_name"]= "Product Name must contain only letters and be at least 4 characters";
    }

    return $errors;
  }
  function image_validation($image,$valiation_exten,$size){
    if($image["name"])
    {
        $imge_exten = pathinfo($image["name"], PATHINFO_EXTENSION);
        if(!in_array( $imge_exten,$valiation_exten))
        {
            return "Not Valid Extenstion";
        }
        if($image['size']>$size)
        {
            return "Too Big File";
        }

    }
    else{
        return "Product picture is required";
    }
  
}
?>