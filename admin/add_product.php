<?php
require_once "db_product_operation.php";
try{
    $catgories =select_data("categories");
}
catch(  Exception $e)
{
    $db_error= $e;
}
if(isset($_GET)) {
    if(isset($_GET["errors"])) {
        $errors = json_decode($_GET["errors"], true);
        if (is_array($errors)) {
            extract($errors);
        }
    }
if(isset($_GET["old"])) {
   
        $old = json_decode($_GET["old"], true);
        if (is_array($old)) {
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
    <title>add-product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <div class="container  p-4  mt-5">
        <div class="row">
            <div class="col-12 col-md-8  p-md-5 p-3 rounded form">
                <h1 class="fs-4 mb-4">Add New Product</h1>
                <?php
            if(isset($db))
                             {
                                 echo "<p class='text-danger ' style='font-size:12px' > this product is already exist </p>";
                             }?>
                <form action="add_product_validation.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3 d-flex col-12 gap-2 flex-wrap ">
                        <div class="d-flex align-items-baseline col-12 col-md-7">
                            <label for="product" class='form-label col-3'>Product:</label>
                            <div>
                                <input type="text" class='form-control 
                                <?php
                             if(isset($p_name))
                             {
                                 echo "is-invalid";
                             }
                            
                            ?>' id="product" placeholder="Product Name" name="p_name" value=<?php if(isset($o_p_name))
                                    { echo "$o_p_name" ; } ?>>
                                <?php
                             if(isset($p_name))
                             {
                                 echo "<p class='text-danger txt-sm'>$p_name</p>";
                             }
                            
                            ?>
                            </div>

                        </div>
                        <div class="d-flex align-items-baseline  gap-md-4 col-12 col-md-4 ">
                            <label for="quantity" class="form-label col-4">Quantity:</label>
                            <div>
                                <input type="number" class='form-control
                                 <?php
                             if(isset($p_quantity))
                             {
                                 echo "is-invalid";
                             }
                            
                            ?> ' id="quantity" placeholder="quantity" name="p_quantity" value=<?php
                                    if(isset($o_p_quantity)) { echo $o_p_quantity; } ?>>
                                <?php
                             if(isset($p_quantity))
                             {
                                 echo "<p class='text-danger txt-sm'>$p_quantity</p>";
                             }
                            
                            ?>
                            </div>
                        </div>

                    </div>
                    <div class="mb-4">
                        <label for="price" class="form-label ">Price:</label>
                        <div>
                            <input type="number" class='form-control col-12
                                 <?php
                             if(isset($p_price))
                             {
                                 echo "is-invalid";
                             }
                            
                            ?> ' id="price" placeholder="Price" name="p_price" value=<?php if(isset($o_p_price)) { echo
                                $o_p_price; } ?>>
                            <?php
                             if(isset($p_price))
                             {
                                 echo "<p class='text-danger txt-sm'>$p_price</p>";
                             }
                            
                            ?>
                        </div>
                    </div>

                    <div class="mb-4  col-12  ">
                        <label for="category" class="form-label col-2 ">Category:</label>
                        <div class="input-group  align-items-baseline">
                            <select class='form-select rounded-start
                                <?php if (isset($p_category)) { echo "is-invalid"; } ?>' id="category"
                                aria-label="Example select with button addon" name="p_category">

                                <option value="" selected>Choose...</option>

                                <?php
                                if (isset($catgories)) {
                                    foreach ($catgories as $value) {
                                        // Ensure correct HTML attribute syntax
                                        $selected = (isset($o_p_category) && $o_p_category == $value['category_id']) ? 'selected' : '';
                                        echo "<option value='{$value['category_id']}' $selected>{$value['name']}</option>";
                                    }
                                }
                                ?> 
                            </select>


                            <button class="btn  add-cat" type="button"> <a href="./add_category.php" class="text-decoration-none text-primary">Add New Category >></a></button>
                        </div>
                        <?php
                             if(isset($p_category))
                             {
                                 echo "<p class='text-danger txt-sm'>$p_category</p>";
                             }
                            
                            ?>

                    </div>
                    <div class="mb-5 mt-3">
                        <label for="formFile" class="form-label ">Product Image</label>
                        <input class='form-control
                          <?php
                             if(isset($image))
                             {
                                 echo "is-invalid";
                             }
                            
                            ?> 
                        ' type="file" id="formFile" name="p_image">
                        <?php
                             if(isset($image))
                             {
                                 echo "<p class='text-danger txt-sm'>$image</p>";
                             }
                            
                            ?>
                    </div>
                    <div class="mb-4">
                        <button class="btn add col-3  " type="submit">Add</button>
                        <button class="btn reset " type="reset">Reset</button>
                    </div>

                </form>
                <?php
                             if(isset($db_error))
                             {
                                 echo "<p class='text-danger txt-sm'>there an error in connect to database</p>";
                             }
                            
                            ?>
            </div>
            <div class="col-4 d-none d-md-block image">
                <img src="../image/addproduct.jpg" alt="add product">
                <h2>Seamless Product Management</h2>
                <p>Easily add new products to your store with our user-friendly form. Manage your inventory efficiently
                    and provide customers with accurate product details to enhance their shopping experience. Stay
                    organized, update listings effortlessly, and grow your business with ease!</p>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>