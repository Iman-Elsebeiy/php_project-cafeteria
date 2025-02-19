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

    // FILTER_VALIDATE_INT
    // trueبcondation يبقي الfalse ده طلع ب
    //  سواء علي رقم او دونمين او ايميل او فلوت والمزيد هناfilterتقوم بعمل 
    // https://www.php.net/manual/en/filter.filters.validate.php
    // تقوم بأرسال عدد الاحرف التي كتبتهاstrlen

     if($empty==true || $isnumber==true || $isnegative==true ){
        return true;
     
    }
    else{
        return false;
    }

}
function validemail($email){
    // $filter_email=filter_var($email,FILTER_VALIDATE_EMAIL)==false;
 
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
// megabyteهكذا ينتج الحجم بال

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
// لو الحاجات دي تمام اخرج
else{
    return true;
}
}