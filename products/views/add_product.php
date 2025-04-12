<?php
require_once "../../includes/classDB.php";
require_once "../../includes/utils.php";
require_once "../../includes/navbar.php";

try{
    $db_conn = new DataBase();
    $db_conn->connectToDB(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    $catgories =$db_conn->select_data("categories");
    $db_conn->closeConnection();
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
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/allProducts.css">
    <link rel="stylesheet" href="../../style/navbar.css">
</head>

<body>
    <?php
     displayAdminNavbar();
    
    ?>
    <div class="container addproduct col-lg-6 mt-4 p-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fs-4 p-2 col-9">Add New Product</h1>
            <a href="add_category.php" class="add-category-btn px-3 py-2">Add Category</a>
        </div>
        <?php
            if(isset($db_err)) {
                echo "<p class='text-danger txt-sm' > this product is already exist </p>";
            }
        ?>

        <form action="../controller/add_product_Logic.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product" class="form-label">Product Name</label>
                <input type="text" class='form-control <?php if(isset($p_name)) echo "is-invalid"; ?>' id="product"
                    placeholder="Product Name" name="p_name" value="<?php if(isset($o_p_name)) echo $o_p_name; ?>">
                <?php if(isset($p_name)) echo "<p class='text-danger txt-sm'>$p_name</p>"; ?>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class='form-control <?php if(isset($p_quantity)) echo "is-invalid"; ?>'
                    id="quantity" placeholder="Quantity" name="p_quantity"
                    value="<?php if(isset($o_p_quantity)) echo $o_p_quantity; ?>">
                <?php if(isset($p_quantity)) echo "<p class='text-danger txt-sm'>$p_quantity</p>"; ?>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class='form-control <?php if(isset($p_price)) echo "is-invalid"; ?>' id="price"
                    placeholder="Price" name="p_price" value="<?php if(isset($o_p_price)) echo $o_p_price; ?>">
                <?php if(isset($p_price)) echo "<p class='text-danger txt-sm'>$p_price</p>"; ?>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class='form-select <?php if (isset($p_category)) echo "is-invalid"; ?>' id="category"
                    name="p_category">
                    <option value="" selected>Choose...</option>
                    <?php
                        if (isset($catgories)) {
                            foreach ($catgories as $value) {
                                $selected = (isset($o_p_category) && $o_p_category == $value['category_id']) ? 'selected' : '';
                                echo "<option value='{$value['category_id']}' $selected>{$value['name']}</option>";
                            }
                        }
                    ?>
                </select>
                <?php if(isset($p_category)) echo "<p class='text-danger txt-sm'>$p_category</p>"; ?>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Product Image</label>
                <input class='form-control <?php if(isset($image)) echo "is-invalid"; ?>' type="file" id="formFile"
                    name="p_image">
                <?php if(isset($image)) echo "<p class='text-danger txt-sm'>$image</p>"; ?>
            </div>

            <div class="d-flex  gap-2 mt-4">
                <button class="btn btn-primary px-5" type="submit">Add</button>
                <button class="btn btn-secondary px-5" type="reset">Reset</button>
            </div>
        </form>
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