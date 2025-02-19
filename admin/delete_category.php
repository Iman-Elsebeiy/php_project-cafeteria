<?php
require_once "../includes/utils.php";
require_once "../includes/connect_to_db.php";

$pdo = connectToDB();

if (isset($_GET['id'])) {
    $category_id = intval($_GET['id']);

    // Check if category exists
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE category_id = ?");
    $stmt->execute([$category_id]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($category) {
        // Delete the category
        $delete_stmt = $pdo->prepare("DELETE FROM categories WHERE category_id = ?");
        $delete_stmt->execute([$category_id]);

        // Redirect back to the category list with a success message
        header("Location: categories.php?success=deleted");
        exit();
    } else {
        echo "Category not found!";
    }
} else {
    echo "Invalid request!";
}
?>
