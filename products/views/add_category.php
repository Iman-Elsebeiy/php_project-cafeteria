<?php
require_once "../../includes/classDB.php";
require_once "../../includes/utils.php";
if(isset($_GET))
{
   if(isset($_GET["errors"]))
   {
    $errors = json_decode($_GET["errors"], true);
    if(is_array($errors))
    {
         extract($errors);
    }
  
   }
   if(isset($_GET["old"]))
   {
    $old = json_decode($_GET["old"], true);
    if(is_array($old))
    {
         extract($old);
    }
   }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/navbar.css">
</head>

<body>
    <?php
     displayAdminNavbar($_SESSION["image"]);
    
    ?>
    <div class="container  p-4  mt-2">
        <div class="row">
            <div class="col-12 col-md-8  mx-auto p-md-5 p-3  rounded  form ">
                <h1 class="fs-5 mb-4">Add New Category</h1>
                <form action="../controller/add_category_Logic.php" method="POST" enctype="multipart/form-data"
                    class="p-2">
                    <div class="mb-4  col-12 gap-2 flex-wrap ">
                        <label for="category" class='form-label '>Category Name:</label>
                        <div>
                            <input type="text" class='form-control 
                              <?php
                             if(isset($c_name))
                             {
                                 echo "is-invalid";
                             }
                            
                            ?>
                              ' id="category" placeholder="Category Name" name="c_name" value=<?php if(isset($o_cname))
                                    { echo "$o_cname" ; } ?>>
                            <?php
                             if(isset($c_name))
                             {
                                 echo "<p class='text-danger txt-sm'>$c_name</p>";
                             }
                            
                            ?>
                        </div>
                    </div>

                    <div class="">
                        <button class="btn add col-3  " type="submit">Add</button>
                        <button class="btn reset ">
                            <a href="./add_product.php" class="text-decoration-none text-dark">
                                Back
                            </a>

                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <?php include '../../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../javascript/index.js"></script>
</body>

</html>