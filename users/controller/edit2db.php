<?php
require_once '../../includes/helper.php';
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
$url='Location: ../views/editUser.php';
// users/views/editUser.php
session_start();
$loginStatus=$_SESSION["login"];
if($loginStatus==false)
{
    header("Location: /PHP-Project/php_project-cafeteria/users/views/login.php");
    exit();

}
$url=$url.'?id='.$_GET['id'];
session_start();
$loginStatus=$_SESSION["login"];
if($loginStatus==false)
{
    // header("Location: ./login.php");
    // exit();

}

$postErrorsOld=validatePostedData($_POST);
$img=$_FILES['image'];
$cafe=new dataBase();
$cafe->connectToDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$data=$cafe->selectRowData('users','user_id',$_GET['id']);
$oldImage=$data[0]['image'];
var_dump($oldImage);
$file_errors=validateOnfile($img,["png","jpg","jpeg"],2000000);
if(!$postErrorsOld["errors"])
{
            $email = $_POST['email'];
            $name = $_POST['name'];
            $room = $_POST['room'];
            $ext = $_POST['ext'];
            $emailCheck=validateOnMail($email);
            if($emailCheck==$email)
            {


                if($img['tmp_name']!='')
                        {
                            $fileExt = explode(".", $img['name']);
                            $fileExt=strtolower(end($fileExt));
                            $imageName="" . $email.'.'.$fileExt;
                            $data = ["name"=>$name,"email"=>$email,"room_no"=>$room,"ext"=>$ext,"image"=>$imageName];

                        }
                        else
                        {
                            // print_r($data);

                            $data = ["name"=>$name,"email"=>$email,"room_no"=>$room,"ext"=>$ext,"image"=>$data[0]['image']];

                        }
 

                        
                        $returnd =$cafe->update('users',$_GET['id'],$data);
                        $cafe->closeConnection();
                        if($returnd==1)
                        {
                            $url=$url."&email= Email is Duplicated ";
                            header($url);
                        }
                        else
                        {
                            if($img['tmp_name']!='')
                            {
                                unlink('../imgs/'.$oldImage);
                                move_uploaded_file($img['tmp_name'], "../imgs/" . $email.'.'.$fileExt);

                            }
                            header("Location: ../views/allUsers.php");
                            
                        }
                                          
            }
            else
            {
                $url=$url."&email= please enter right email";
        $url=$url.'&old='.json_encode( $postErrorsOld['old']);

                header($url);

            }
            
}
else
{
    $url=$url.'&errors='.json_encode( $postErrorsOld['errors']);
    if ($postErrorsOld['old'])
    {
        $url=$url.'&old='.json_encode( $postErrorsOld['old']);
    }
    header($url);

}


?>