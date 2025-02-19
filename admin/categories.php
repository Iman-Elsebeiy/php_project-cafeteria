<?php

require_once '../includes/db.php';
require_once "../includes/utils.php";

$categories= $db->select('categories');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
  </head>
  <body>
    <main>
    <?php
     require_once "../includes/nav.php";
     ?>
      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">All categories</h2>
          <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Category</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php
              foreach ($categories as $category) {
              ?>
              <tr>
                <th scope="row"><?php echo $category['category_id']?></th>
                 <td><?php echo $category['name'] ?></td>
                <td><a href="edit_category.php?id=<?php echo $category['category_id'] ?>" class="text-decoration-none"><i>✒️</i></a></td>
                <td><a href="deletetech.php?id=<?php echo $category['category_id'] ?>" onclick="return confirm('Are you sure you want to delete?')" class="text-decoration-none"><img src="../imgs/trash-bin.png" alt="" style="max-width: 35px"></a></td>
              </tr>
              <?php
                 }
                  $db->close();
                ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
