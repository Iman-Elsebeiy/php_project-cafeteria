<?php
require_once '../../includes/utils.php';
require_once '../../includes/classDB.php';
require_once "../controller/home.php";
$role=$_SESSION["role"];
if($role=="user")
{
    header("Location: ./user-home.php");
}
$loginStatus=$_SESSION["login"];
if($loginStatus==false)
{
    header("Location: ./login.php");
}

if (isset($_GET['errors'])) {
    $errors = json_decode($_GET['errors'],true);
}
if (isset($_GET['old'])) {
    $old = json_decode($_GET['old'],true);
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
}
else{
    $email = '';

}

if (isset($_GET['ext'])) {
    $ext = $_GET['ext'];
}
else{
    $ext = '';

}
$cafe=new dataBase();
$cafe->connectToDB(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$data=$cafe->selectRowData('users','user_id',$_GET['id']);

if (!count($data)) {   
    header("Location: allUsers.php"); // No space after "Location:"
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit-User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/navbar.css">

</head>


<body>

    <?php 
     displayAdminNavbar($_SESSION["image"]);

    ?>
    <div class="container mt-4 mb-2 col-6 p-5  form  ">
        <div class="text-end">
            <a href="allUsers.php" class="btn ad ">Users List</a>
        </div>
        <h2>Edit User</h2>
        <form action="../controller/edit2db.php?id=<?php echo $_GET['id'] ?>" method="post"
            enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input class="form-control" value="<?php echo $old['name'] ?? $data[0]['name'] ?>" type="name" name="name">
            <p class="text-danger"> <?php echo $errors['name'] ?? '' ?> </p>

            <label for="email">Email:</label>
            <input class="form-control" value="<?php echo $old['email'] ?? $data[0]['email'] ?>" type="text"
                name="email">
            <p class="text-danger"> <?php echo $errors['email'] ?? '' ?> </p>
            <p class="text-danger"> <?php echo $email ?? '' ?> </p>

            <label for="ext">ext:</label>
            <input class="form-control" value="<?php echo $old['ext'] ?? $data[0]['ext'] ?>" type="text" name="ext">
            <p class="text-danger"> <?php echo $errors['ext'] ?? '' ?> </p>
            <p class="text-danger"> <?php echo $ext ?? '' ?> </p>
            <?php
        if($data[0]['room_no']=='Application1')
        {

echo'

<div class="col-3">
    <label for="room" class="form-label">Room Number:</label>
    <select name="room" class="form-select form-control mb-3">
        <option value="Application1" selected>Application1</option>
        <option value="Application2">Application2</option>
        <option value="Cloud">Cloud</option>
    </select>
</div>

        
';

        }else if($data[0]['room_no']=='Application2'){
            echo'

            <div class="col-3">
            <label for="room" class="form-label">Room Number:</label>
            <select name="room" class="form-select form-control mb-3">
                <option value="Application1" >Application1</option>
                <option value="Application2"selected>Application2</option>
                <option value="Cloud">Cloud</option>
            </select>
        </div>
';

        }
        else{
            echo'

            <div class="col-3">
            <label for="room" class="form-label">Room Number:</label>
            <select name="room" class="form-select form-control mb-3">
                <option value="Application1" >Application1</option>
                <option value="Application2">Application2</option>
                <option value="Cloud" selected >Cloud</option>
            </select>
        </div>
        
';

        }


        ?>



            <label for="profile_picture">Profile Picture:</label>
            <input class="form-control" type="file" name="image" accept="image/*">
            <br>
            <button type="submit" value="Submit" class="btn ad  ">Submit</button>
            <button type="reset" value="reset" class="btn res ">Reset</button>


        </form>
    </div>

</body>
<?php include '../../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="../../javascript/index.js"></script>

</html>