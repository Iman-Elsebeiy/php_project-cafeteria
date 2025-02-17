<?php

function filtervalidation($inputvalue){
$inputvalue=trim($inputvalue);
$inputvalue= htmlspecialchars($inputvalue);
$inputvalue=strip_tags($inputvalue);
$inputvalue=stripslashes($inputvalue);

return $inputvalue;

}

function strvalid($inputvalue){
    $empty=empty($inputvalue);

    $lenght=strlen($inputvalue)<3;

     if($empty==true || $lenght ==true){
        return true;
     
    }
    else{
        return false;
    }

}

function numvalid($inputvalue){
    $empty=empty($inputvalue);
    $isnumber= filter_var($inputvalue,FILTER_VALIDATE_INT)==false ;
    $isnegative= $inputvalue<0 ;

 

     if($empty==true || $isnumber==true || $isnegative==true ){
        return true;
     
    }
    else{
        return false;
    }

}
function validemail($email){

 
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
     return true;
    }
    else{
        return false;
    }
}
// check file size
function validfilesize($filesize ,$size){
    $file_validation_size=($filesize/1024)/1024;


if($file_validation_size>$size){
    return true;
}
else{
    return false;
}
}
// check file type
function validimgtype($imginput){
if($imginput=="image/jpeg"||$imginput=="image/jpg"||$imginput=="image/png"||$imginput=="image/jif")
return false;

else{
    return true;
}
}

function uniqueemail($pdo, $email) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $count = $stmt->fetchColumn();
    
    return $count == 0; 
}
// auth pages 
// must add in all pages
function AdminOnlyPage(){
    if($_SESSION['role']=='user'){
        header('Location:/cafeteria/users/views/home.php');
    }
}

function NotAuthRedirectToLogin(){
    if($_SESSION['login']== false){
        header('Location:/cafeteria/users/views/login.php');
    }
}

function LogOut()
{
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("Location:/cafeteria/users/views/login.php");
    
    }
}
