<?php
require_once "../DB/db_product_operation.php";
require_once "../includes/Validtion.php";
  $valid_exten=["png","jpeg","jpg"];
  $validation =form_validate($_POST);
   extract($validation);
  $errors=vaildate_unEmpty_ProductField($_POST,$errors);
  $imge_error=image_validation($_FILES["p_image"],$valid_exten,200000);
   if($imge_error){
        $errors["image"]=$imge_error; }
    if($errors){
        $errors_str= json_encode($errors);
        if($old)
        {
            $old_str= json_encode($old);
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

 
?>