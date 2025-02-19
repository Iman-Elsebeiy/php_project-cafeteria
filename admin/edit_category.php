<?php
require_once "../includes/utils.php";
require_once "../includes/connect_to_db.php";

$pdo = connectToDB();

// Get category ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch category details
$stmt = $pdo->prepare("SELECT * FROM categories WHERE category_id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    echo "Category not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
</head>
<body>

<h2>Edit Category</h2>

<form action="update_category.php" method="post">
    <input type="hidden" name="category_id" value="<?= htmlspecialchars($category['category_id']); ?>">

    <label>Category Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($category['name']); ?>" required><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
