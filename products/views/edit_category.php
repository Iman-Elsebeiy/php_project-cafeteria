<?php
// require_once "../includes/utils.php";
require_once "../../includes/utils.php";
require_once "../../includes/connect_to_db.php";
$pdo = connectToDB();


// Get category ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch category details
$stmt = $pdo->prepare("SELECT * FROM categories WHERE category_id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($category);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="../../style/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../../style/navbar.css">
</head>

<body>
    <?php 
     displayAdminNavbar($_SESSION["image"])?>
    <div class="container p-4 mt-5">

        <!-- Edit Category Form -->
        <div class="col-12 col-md-8 mx-auto  p-md-5 p-3 rounded form">
            <h1 class="fs-4 mb-4">Edit Category</h1>

            <form action="update_category.php" method="post">
                <input type="hidden" name="category_id" value="<?= htmlspecialchars($category['category_id']); ?>">

                <!-- Category Name Input -->
                <div class="mb-4">
                    <label for="name" class="form-label">Category Name:</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?= htmlspecialchars($category['name']); ?>" required>
                        <p class="text-danger"><?php echo $errors['category_name'] ?? ''; ?></p>


                </div>

                <!-- Buttons -->
                <div class="mb-4">
                    <button class="btn add col-3" type="submit">Update</button>
                    <button class="btn reset" type="reset">Reset</button>
                </div>
            </form>
        </div>

    </div>
    <?php include '../../includes/footer.php'; ?>
<<<<<<< HEAD

=======
>>>>>>> 597d909990e370e8ea06b6823aa801fd2e0b270d
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