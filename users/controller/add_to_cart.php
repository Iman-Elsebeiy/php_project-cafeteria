<?php
 session_start();
 if($_SESSION["role"]=="user")
 {
    if(isset($_SESSION["cart"]))
    {
       if(isset($_SESSION["cart"]["products"][$_POST['product_id']]))
       {
           $_SESSION["cart"]["products"][$_POST['product_id']]=++$_SESSION["cart"]["products"][$_POST['product_id']] ;
           
       }
       else
       {
           $_SESSION["cart"]["products"][$_POST['product_id']]=1;
       }
    }
    else{
       $_SESSION["cart"]=[
           "products"=>[
               $_POST["product_id"]=>1
           ],
        "user_id"=> $_SESSION["user_id"],
       ];
    }
  header("Location: ../views/user-home.php?message=Product Add Sucessfully&product=".$_POST['product_id']);
 } 
 else if($_SESSION["role"]=="admin"){
 }
var_dump($_SESSION["cart"]);
  

?>