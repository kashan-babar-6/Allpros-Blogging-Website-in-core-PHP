-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 05:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allpros_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`user_id`, `full_name`, `username`, `email`, `dob`, `gender`, `password`, `profile_img`) VALUES
(1, 'Kashan Babar', 'kashan_babar', 'kashanbabar99@gmail.com', '1999-08-08', 'M', 'kb123', 'kashan_babar.jpg'),
(3, 'Ghayyour Abbas', 'guri_abbas', 'guri@gmail.com', '1999-08-24', 'M', 'guri123', 'cat_polygon.png'),
(4, 'Sheraz Ali', 'sheraz_ali', 'sheraz.ali@gmail.com', '1999-08-24', 'M', 'sheraz123', 'polygon_scenery.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Technology'),
(8, 'Artificial Intelligence'),
(12, 'Machine Learning');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `post_img` varchar(255) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `post_views` int(11) DEFAULT NULL,
  `description` varchar(8000) DEFAULT NULL,
  `author_Id_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `post_img`, `category`, `post_date`, `post_views`, `description`, `author_Id_FK`) VALUES
(1, 'Polygons are in high demand', 'main_article_img.png', 8, '2022-10-27', 5, 'Sed curae; mus nunc tempor, turpis eu fringilla. Maecenas sapien, volutpat nulla lacinia venenatis. Ridiculus gravida convallis laoreet justo sodales imperdiet tortor curabitur enim aliquam amet pretium mollis dignissim adipiscing pellentesque lacinia Venenatis fusce tempus nascetur commodo ligula interdum. Inceptos parturient dapibus curabitur erat proin, nisi fermentum erat sodales. Orci curae; elementum sed dolor iaculis maecenas, nibh. Vulputate justo natoque orci. Sit pretium purus auctor non. Tempus, class quam. Nulla potenti. Platea class tempus accumsan. Iaculis amet Venenatis dictum id scelerisque massa elit nisi mauris, magnis elementum massa feugiat parturient porttitor urna metus molestie proin amet. Cursus posuere parturient. Metus in sem parturient iaculis Scelerisque lorem velit erat convallis hendrerit natoque.\r\n\r\nId ac natoque luctus eleifend quam tortor elit eros dapibus condimentum, dis penatibus condimentum morbi rhoncus felis. Nascetur ac sodales nullam lacinia ped', 1),
(24, '22 of the Most Gorgeous Polygon Art Designs', 'cat_polygon.png', 1, '2022-10-31', 56, 'When most people think about the history of polygon art designs, they immediately jump to the low poly forms used in the early days of 3D animation and video games.\r\n\r\nHowever, a brief look through history shows that polygon designs have been around for centuries, most notably in Islamic art. While polygons are used in animation today for their simplicity, in the ancient world the different geometric shapes were weaved together to create elaborate, decorative elements.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `foreign_key_constraint` (`author_Id_FK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
