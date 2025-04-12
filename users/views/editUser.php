<?php
require_once '../../includes/navbar.php';
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
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/navbar.css">
</head>

<body>
    <?php displayAdminNavbar(); ?>

    <div class="container adduser col-lg-6 mt-4">
        <div class="text-end d-flex">

            <h1 class="col-10">Edit User</h1>
            <a href="allUsers.php" class="btn btn-primary  h-75  ">
                UserList</a>
        </div>


        <form action="../controller/edit2db.php?id=<?php echo $_GET['id'] ?>" method="post"
            enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" value="<?php echo $old['name'] ?? $data[0]['name'] ?>" type="text"
                    name="name" placeholder="Enter name">
                <p class="error text-danger"> <?php echo $errors['name'] ?? '' ?> </p>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" value="<?php echo $old['email'] ?? $data[0]['email'] ?>" type="email"
                    name="email" placeholder="Enter email">
                <p class="error text-danger"> <?php echo $errors['email'] ?? '' ?> </p>
                <p class="error text-danger"> <?php echo $email ?? '' ?> </p>
            </div>

            <div class="mb-3">
                <label for="ext" class="form-label">Ext</label>
                <input class="form-control" value="<?php echo $old['ext'] ?? $data[0]['ext'] ?>" type="text" name="ext"
                    placeholder="Enter extension">
                <p class="error text-danger"> <?php echo $errors['ext'] ?? '' ?> </p>
                <p class="error text-danger"> <?php echo $ext ?? '' ?> </p>
            </div>

            <div class="mb-3">
                <label for="room" class="form-label">Room Number</label>
                <select name="room" class="form-select">
                    <option value="Application1" <?php if($data[0]['room_no']=='Application1') echo 'selected'; ?>>
                        Application1</option>
                    <option value="Application2" <?php if($data[0]['room_no']=='Application2') echo 'selected'; ?>>
                        Application2</option>
                    <option value="Cloud" <?php if($data[0]['room_no']=='Cloud') echo 'selected'; ?>>Cloud</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input class="form-control" type="file" name="image" accept="image/*">
            </div>

            <div class="d-flex gap-3 mt-4">
                <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                <button type="reset" value="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../javascript/index.js"></script>
</body>

</html>