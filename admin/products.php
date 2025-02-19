<?php

require_once "../includes/utils.php";
require_once "../includes/connect_to_db.php";

try {
    $pdo = connectToDB();
    $select_query ="SELECT * FROM `categories`, `products` WHERE products.`category_id` = `categories`.`category_id`;";

    $stmt = $pdo->prepare($select_query);
    $stmt->execute();

    $products = $stmt->fetchAll();
    // var_dump($products);

}catch (PDOException $e){
    displayError($e->getMessage());
    return false;
}
?>
          <table class="table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Availability</th>
                <th>Category</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php
              foreach ($products as $product) {
              ?>
              <tr>
                 <td><?php echo $product['product_name'] ?></td>
                 <th><?php echo $product['price']?> EL</th>
                 <td> <img src="<?php echo $product['image'] ?>" width="100px" height="100px" alt=""></td>
                 <th><?php echo $product['quantity']?></th>
                 <td><?php if($product['quantity']>0){
                            echo 'Available';
                  	      } else {
                           echo 'Unvailable';
                     	}?></td>
                 <td><?php echo $product['name'] ?></td>
                <td><a href="edit_product.php?id=<?php echo $product['product_id'] ?>" class="text-decoration-none"><i><img src="../imgs/edit(1).png" style="max-width: 30px" alt=""></i></a></td>
                <td><a href="delete_product.php?id=<?php echo $product['product_id'] ?>" onclick="return confirm('Are you sure you want to delete <?php echo $product['product_name'] ?>?')"class="text-decoration-none"><img src="../imgs/images.png" alt="" style="max-width: 30px"></a></td>
              </tr>
              <?php
                 }
                ?>
            </tbody>
          </table>