
--

CREATE  VIEW `order_detail`  AS SELECT `orders`.`order_id` AS `order_id`, `products`.`product_id` AS `product_id`, `products`.`image` AS `image`, `products`.`product_name` AS `product_name`, `products`.`price` AS `price`, `orders`.`status` AS `status`, `orders`.`date` AS `date`, `orders`.`user_id` AS `user_id`, `order_products`.`quantity` AS `quantity`, `products`.`price`* `order_products`.`quantity` AS `total` FROM ((`order_products` join `orders` on(`orders`.`order_id` = `order_products`.`order_id`)) join `products` on(`products`.`product_id` = `order_products`.`product_id`)) ;



CREATE  VIEW `orders_total`  AS SELECT `orders`.`order_id` AS `order_id`, `orders`.`status` AS `status`, `orders`.`date` AS `date`, `orders`.`user_id` AS `user_id`, sum(`products`.`price` * `order_products`.`quantity`) AS `total` FROM ((`order_products` join `orders` on(`orders`.`order_id` = `order_products`.`order_id`)) join `products` on(`products`.`product_id` = `order_products`.`product_id`)) GROUP BY `orders`.`order_id`, `orders`.`date`, `orders`.`status` ;

