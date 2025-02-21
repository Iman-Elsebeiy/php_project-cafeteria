CREATE DATABASE  IF NOT EXISTS `cafe` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE c */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cafe`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: cafe
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (5,'Cold Beverages'),(6,'Hot Drink'),(2,'Ice Cream'),(4,'Sandwiches');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `customer_total_orders`
--

DROP TABLE IF EXISTS `customer_total_orders`;
/*!50001 DROP VIEW IF EXISTS `customer_total_orders`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `customer_total_orders` AS SELECT 
 1 AS `user_id`,
 1 AS `name`,
 1 AS `total_spent`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
/*!50001 DROP VIEW IF EXISTS `order_detail`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `order_detail` AS SELECT 
 1 AS `order_id`,
 1 AS `product_id`,
 1 AS `image`,
 1 AS `product_name`,
 1 AS `price`,
 1 AS `status`,
 1 AS `date`,
 1 AS `user_id`,
 1 AS `quantity`,
 1 AS `total`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_products` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `order_products_product_id_fk` (`product_id`),
  CONSTRAINT `order_products_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  CONSTRAINT `order_products_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products`
--

LOCK TABLES `order_products` WRITE;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` VALUES (1,3,1),(1,6,1),(2,4,1),(2,5,1),(2,7,1),(4,3,1),(5,3,2),(6,3,1),(7,3,1),(8,4,1),(8,5,1),(8,12,1),(9,4,1),(9,5,1),(9,6,1),(9,7,1),(9,12,1),(11,5,1),(11,12,1);
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `order_total_price`
--

DROP TABLE IF EXISTS `order_total_price`;
/*!50001 DROP VIEW IF EXISTS `order_total_price`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `order_total_price` AS SELECT 
 1 AS `order_id`,
 1 AS `total_price`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `status` enum('pending','completed','canceled') DEFAULT 'pending',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`order_id`),
  KEY `orders_user_id_fk` (`user_id`),
  CONSTRAINT `orders_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'completed','2025-02-18 23:58:15',NULL,NULL),(2,'completed','2025-02-19 15:22:39',26,NULL),(4,'completed','2025-02-19 16:01:35',26,NULL),(5,'completed','2025-02-19 16:54:27',NULL,NULL),(6,'completed','2025-02-19 17:23:16',26,NULL),(7,'completed','2025-02-19 18:30:58',9,NULL),(8,'completed','2025-02-19 22:08:15',9,NULL),(9,'pending','2025-02-19 22:10:09',32,NULL),(11,'pending','2025-02-19 22:23:04',9,NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `orders_total`
--

DROP TABLE IF EXISTS `orders_total`;
/*!50001 DROP VIEW IF EXISTS `orders_total`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `orders_total` AS SELECT 
 1 AS `order_id`,
 1 AS `status`,
 1 AS `date`,
 1 AS `user_id`,
 1 AS `total`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `pending_order_details`
--

DROP TABLE IF EXISTS `pending_order_details`;
/*!50001 DROP VIEW IF EXISTS `pending_order_details`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `pending_order_details` AS SELECT 
 1 AS `image`,
 1 AS `product_name`,
 1 AS `price`,
 1 AS `order_id`,
 1 AS `quantity`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `pending_orders`
--

DROP TABLE IF EXISTS `pending_orders`;
/*!50001 DROP VIEW IF EXISTS `pending_orders`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `pending_orders` AS SELECT 
 1 AS `order_id`,
 1 AS `date`,
 1 AS `name`,
 1 AS `room_no`,
 1 AS `ext`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `product_with_category`
--

DROP TABLE IF EXISTS `product_with_category`;
/*!50001 DROP VIEW IF EXISTS `product_with_category`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `product_with_category` AS SELECT 
 1 AS `product_id`,
 1 AS `product_name`,
 1 AS `image`,
 1 AS `price`,
 1 AS `quantity`,
 1 AS `category_name`,
 1 AS `category_id`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_name` (`product_name`),
  KEY `product_category_id_fk` (`category_id`),
  CONSTRAINT `product_category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,'Latte','latte.png',45.00,0,NULL),(4,'Green Tea','green_tea.png',25.00,7,6),(5,'Chocolate Ice Cream','chocolate_ice_cream.png',25.00,1,2),(6,'Vanilla Ice Cream','vanilla_ice_cream.png',22.00,9,2),(7,'Strawberry Ice Cream','strawberry_ice_cream.png',28.00,9,2),(8,'Cheesecake','cheesecake.png',50.00,10,NULL),(9,'Chocolate Cake','chocolate_cake.png',55.00,10,NULL),(10,'Mocha','../imgs/cappuccino.png',42.00,10,NULL),(11,'Milkshake Chocolate','milkshake_chocolate.png',42.00,10,NULL),(12,'roasted chestnuts','roasted chestnuts.png',25.00,6,5);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!50001 DROP VIEW IF EXISTS `user_details`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `user_details` AS SELECT 
 1 AS `user_id`,
 1 AS `image`,
 1 AS `name`,
 1 AS `room_no`,
 1 AS `ext`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `user_total_spent`
--

DROP TABLE IF EXISTS `user_total_spent`;
/*!50001 DROP VIEW IF EXISTS `user_total_spent`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `user_total_spent` AS SELECT 
 1 AS `user_id`,
 1 AS `name`,
 1 AS `total_spent`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `ext` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL,
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,'Alice Johnson','alicejohnson@example.com','123456','Cloud','9101','../imgs/alicejohnson@example.com.png','user','2025-02-19 01:57:32'),(10,'Bob Williams','bobwilliams@example.com','123456','104D','1121','default.jpg','user','2025-02-19 01:57:32'),(11,'Charlie Brown','charliebrown@example.com','123456','105E','3141','default.jpg','user','2025-02-19 01:57:32'),(26,'Alaa Elsayed Saber','alaaelsayedsaber246@gmail.com','$2y$12$Py3sUkJ9vjOlpAn3Xzo.wuXsoyaW2TuvW0YQJIzdsX9nlkLtIK0Hq','application2','1024','alaa.png','user','2025-02-19 15:57:54'),(32,'Ahmed','ahmed@email.com','$2y$12$crk3jXCs1tn8ov5Bvbyf3ObwfBHQX/CluKqIuA6AEu81cpffeRE5C','application1','1024','ahmed@email.compng','user','2025-02-19 18:16:49');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `customer_total_orders`
--

/*!50001 DROP VIEW IF EXISTS `customer_total_orders`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `customer_total_orders` AS select `users`.`user_id` AS `user_id`,`users`.`name` AS `name`,sum((`order_products`.`quantity` * `products`.`price`)) AS `total_spent` from (((`orders` join `users` on((`orders`.`user_id` = `users`.`user_id`))) join `order_products` on((`orders`.`order_id` = `order_products`.`order_id`))) join `products` on((`order_products`.`product_id` = `products`.`product_id`))) group by `users`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `order_detail`
--

/*!50001 DROP VIEW IF EXISTS `order_detail`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `order_detail` AS select `orders`.`order_id` AS `order_id`,`products`.`product_id` AS `product_id`,`products`.`image` AS `image`,`products`.`product_name` AS `product_name`,`products`.`price` AS `price`,`orders`.`status` AS `status`,`orders`.`date` AS `date`,`orders`.`user_id` AS `user_id`,`order_products`.`quantity` AS `quantity`,(`products`.`price` * `order_products`.`quantity`) AS `total` from ((`order_products` join `orders` on((`orders`.`order_id` = `order_products`.`order_id`))) join `products` on((`products`.`product_id` = `order_products`.`product_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `order_total_price`
--

/*!50001 DROP VIEW IF EXISTS `order_total_price`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `order_total_price` AS select `orders`.`order_id` AS `order_id`,sum((`order_products`.`quantity` * `products`.`price`)) AS `total_price` from ((`orders` join `order_products` on((`orders`.`order_id` = `order_products`.`order_id`))) join `products` on((`order_products`.`product_id` = `products`.`product_id`))) group by `orders`.`order_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `orders_total`
--

/*!50001 DROP VIEW IF EXISTS `orders_total`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `orders_total` AS select `orders`.`order_id` AS `order_id`,`orders`.`status` AS `status`,`orders`.`date` AS `date`,`orders`.`user_id` AS `user_id`,sum((`products`.`price` * `order_products`.`quantity`)) AS `total` from ((`order_products` join `orders` on((`orders`.`order_id` = `order_products`.`order_id`))) join `products` on((`products`.`product_id` = `order_products`.`product_id`))) group by `orders`.`order_id`,`orders`.`date`,`orders`.`status` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `pending_order_details`
--

/*!50001 DROP VIEW IF EXISTS `pending_order_details`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pending_order_details` AS select `products`.`image` AS `image`,`products`.`product_name` AS `product_name`,`products`.`price` AS `price`,`orders`.`order_id` AS `order_id`,`order_products`.`quantity` AS `quantity` from ((`orders` join `order_products` on((`orders`.`order_id` = `order_products`.`order_id`))) join `products` on((`order_products`.`product_id` = `products`.`product_id`))) where (`orders`.`status` = 'pending') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `pending_orders`
--

/*!50001 DROP VIEW IF EXISTS `pending_orders`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pending_orders` AS select `orders`.`order_id` AS `order_id`,`orders`.`date` AS `date`,`users`.`name` AS `name`,`users`.`room_no` AS `room_no`,`users`.`ext` AS `ext` from (`orders` join `users` on((`orders`.`user_id` = `users`.`user_id`))) where (`orders`.`status` = 'pending') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `product_with_category`
--

/*!50001 DROP VIEW IF EXISTS `product_with_category`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `product_with_category` AS select `products`.`product_id` AS `product_id`,`products`.`product_name` AS `product_name`,`products`.`image` AS `image`,`products`.`price` AS `price`,`products`.`quantity` AS `quantity`,`categories`.`name` AS `category_name`,`products`.`category_id` AS `category_id` from (`products` join `categories`) where (`categories`.`category_id` = `products`.`category_id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `user_details`
--

/*!50001 DROP VIEW IF EXISTS `user_details`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `user_details` AS select `users`.`user_id` AS `user_id`,`users`.`image` AS `image`,`users`.`name` AS `name`,`users`.`room_no` AS `room_no`,`users`.`ext` AS `ext` from `users` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `user_total_spent`
--

/*!50001 DROP VIEW IF EXISTS `user_total_spent`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `user_total_spent` AS select `users`.`user_id` AS `user_id`,`users`.`name` AS `name`,sum(`order_total_price`.`total_price`) AS `total_spent` from ((`users` join `orders` on((`users`.`user_id` = `orders`.`user_id`))) join `order_total_price` on((`orders`.`order_id` = `order_total_price`.`order_id`))) group by `users`.`user_id`,`users`.`name` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-20  2:49:33
