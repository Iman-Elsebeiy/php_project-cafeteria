-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 04:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'mahrobatttt');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `status` enum('pending','completed','canceled') DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `status`, `date`, `user_id`) VALUES
(3, 'pending', '2025-02-17 14:16:44', 18),
(4, 'completed', '2024-12-31 22:00:00', 18);

-- --------------------------------------------------------

--
-- Stand-in structure for view `orders_total`
-- (See below for the actual view)
--
CREATE TABLE `orders_total` (
`order_id` int(11)
,`status` enum('pending','completed','canceled')
,`date` timestamp
,`user_id` int(11)
,`total` decimal(42,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_detail`
-- (See below for the actual view)
--
CREATE TABLE `order_detail` (
`order_id` int(11)
,`product_id` int(11)
,`image` varchar(255)
,`product_name` varchar(255)
,`price` decimal(10,2)
,`status` enum('pending','completed','canceled')
,`date` timestamp
,`user_id` int(11)
,`quantity` int(11)
,`total` decimal(20,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_id`, `product_id`, `quantity`) VALUES
(3, 5, 5),
(3, 6, 6),
(4, 5, 8),
(4, 6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `image`, `price`, `quantity`, `category_id`) VALUES
(4, 'TEA', 'img1.png', 100.00, 1, 1),
(5, 'yanson', 'img2.png', 200.00, 1, 1),
(6, 'cafe', 'img3.png', 300.00, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `ext` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `room_no`, `ext`, `image`, `role`, `reg_date`) VALUES
(1, 'Pearl Woods', 'nyvoqo@mailinator.com', 'Pa$$w0rd!', 'application1', 'Dolores officia dist', 'photo.jpg', 'user', '2025-02-07 15:49:13'),
(3, 'Salvador Farmer', 'wijofecefu@mailinator.com', 'Pa$$w0rd!', 'application1', 'Saepe ut elit quis ', 'photo.jpg', 'user', '2025-02-07 15:50:33'),
(4, 'Charles Brown', 'zomytamolu@mailinator.com', 'Pa$$w0rd!', 'application2', 'Aspernatur ullam qui', 'photo1.jpg', 'user', '2025-02-07 15:51:13'),
(5, 'george', 'georgeid20@gmail.com', '1234', 'application1', 'xcvbn', 'green.jpeg', 'user', '2025-02-07 19:57:34'),
(6, 'Nolan Kelley', 'xadypija@mailinator.com', 'Pa$$w0rd!', 'application1', 'Aliquip natus corpor', 'Untitled.png', 'user', '2025-02-16 10:55:50'),
(7, 'Kaseem Clark', 'guhiju@mailinator.com', 'Pa$$w0rd!', 'application2', 'Officia fugiat esse', 'Untitled.png', 'user', '2025-02-16 10:59:54'),
(8, 'Piper Osborn', 'xihe@mailinator.com', 'Pa$$w0rd!', 'application1', 'Dolor magni necessit', 'Untitled.png', 'user', '2025-02-16 11:13:35'),
(9, 'Xyla Shepherd', 'loqu@mailinator.com', 'Pa$$w0rd!', 'application1', 'Perferendis consequa', 'IMG-20250122-WA0028 (1).jpg', 'user', '2025-02-16 11:14:27'),
(10, 'Cameran Deleon', 'dyrihehidi@mailinator.com', 'Pa$$w0rd!', 'application1', 'Et accusamus dolor s', 'Task4 Day2.png', 'user', '2025-02-16 11:15:14'),
(11, 'Valentine Strickland', 'xucubapu@mailinator.com', 'Pa$$w0rd!', 'cloud', 'Dolorem placeat dui', 'Untitled.png', 'user', '2025-02-16 11:16:27'),
(12, 'Nicholas Tran', 'kesa@mailinator.com', 'Pa$$w0rd!', 'application1', 'Illo distinctio Duc', 'Untitled.png', 'user', '2025-02-16 11:17:40'),
(13, 'Hoyt Wallace', 'zamodexo@mailinator.com', 'Pa$$w0rd!', 'cloud', 'Ut eu assumenda et q', 'Untitled.png', 'user', '2025-02-16 11:20:08'),
(14, 'Eugenia Simmons', 'hupur@mailinator.com', 'Pa$$w0rd!', 'cloud', 'Impedit dolore esse', 'Task4 Day2.png', 'user', '2025-02-16 11:20:23'),
(15, 'Yolanda Sellers', 'wyzucukeri@mailinator.com', 'Pa$$w0rd!', 'application1', 'Voluptate labore asp', 'Untitled.png', 'user', '2025-02-16 11:56:16'),
(17, 'eid', 'eid@gmail.com', '1234', 'application1', 'ddddddd', 'Untitled.png', 'admin', '2025-02-16 13:11:46'),
(18, 'momo', 'momo@gmail.com', '1234', 'application1', 'ddddddd', 'Untitled.png', 'user', '2025-02-16 13:12:46');

-- --------------------------------------------------------

--
-- Structure for view `orders_total`
--
DROP TABLE IF EXISTS `orders_total`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orders_total`  AS SELECT `orders`.`order_id` AS `order_id`, `orders`.`status` AS `status`, `orders`.`date` AS `date`, `orders`.`user_id` AS `user_id`, sum(`products`.`price` * `order_products`.`quantity`) AS `total` FROM ((`order_products` join `orders` on(`orders`.`order_id` = `order_products`.`order_id`)) join `products` on(`products`.`product_id` = `order_products`.`product_id`)) GROUP BY `orders`.`order_id`, `orders`.`date`, `orders`.`status` ;

-- --------------------------------------------------------

--
-- Structure for view `order_detail`
--
DROP TABLE IF EXISTS `order_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_detail`  AS SELECT `orders`.`order_id` AS `order_id`, `products`.`product_id` AS `product_id`, `products`.`image` AS `image`, `products`.`product_name` AS `product_name`, `products`.`price` AS `price`, `orders`.`status` AS `status`, `orders`.`date` AS `date`, `orders`.`user_id` AS `user_id`, `order_products`.`quantity` AS `quantity`, `products`.`price`* `order_products`.`quantity` AS `total` FROM ((`order_products` join `orders` on(`orders`.`order_id` = `order_products`.`order_id`)) join `products` on(`products`.`product_id` = `order_products`.`product_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_user_id_fk` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `order_products_product_id_fk` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_category_id_fk` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_products_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
