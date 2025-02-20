<?php
 function form_validate($form_data){
    $errors=[];
    $old_data=[];
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
    return [
        "errors"=>$errors,
         "old"=> $old_data
         ];
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
function vaildate_unEmpty_ProductField($form_data,$p_errors)
{
    $errors=$p_errors;
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
function validate_Category($data)
{
    $errors = [];
    $old_data = [];
    if (empty($data["c_name"])) {
        $errors["c_name"] = "Category Name is required";
    } 
    else{
        $category_name = trim($data["c_name"]);

        if (!preg_match("/^[a-zA-Z ]{4,}$/", $category_name)) {
            $errors["c_name"] = "Category Name is Not Valid";
            $old_data["o_cname"] = $data["c_name"];
        }
    }

    return [
        "errors" => $errors,
        "old_data" => $old_data
    ];
}






?>