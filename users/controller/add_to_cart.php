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
        if(!empty($_SESSION["cart"]["user_id"])) 
        {
            if(isset($_SESSION["cart"]["products"]))
            {
                if(isset($_SESSION["cart"]["products"][$_POST['product_id']])){
                    $_SESSION["cart"]["products"][$_POST['product_id']]=++$_SESSION["cart"]["products"][$_POST['product_id']] ; 
                }
                else{
                    $_SESSION["cart"]["products"][$_POST['product_id']]=1;
                }
            }
            else{
                $_SESSION["cart"]["products"]=[[$_POST['product_id']]=>1];
            }
            header("Location: ../views/admin-home.php?message=Product Add Sucessfully&product=".$_POST['product_id']."&cart_user_id=".$_SESSION["cart"]["user_id"]); 
        }
        else{
            header("Location: ../views/admin-home.php?error=Must select user");
        }
 }
var_dump($_SESSION["cart"]);
  

?>