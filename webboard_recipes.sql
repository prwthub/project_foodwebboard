-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 04:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webboard_recipes`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(100) NOT NULL,
  `category_tag` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_tag`) VALUES
(1, 'อาหารไทย'),
(2, 'อาหารหมา'),
(3, 'อาหารแมว');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(100) NOT NULL,
  `comment_content` varchar(200) NOT NULL,
  `comment_time` datetime(6) NOT NULL,
  `user_id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_content`, `comment_time`, `user_id`, `post_id`) VALUES
(13, '1. กำหนด size รูปภาพ', '0000-00-00 00:00:00.000000', 8, 97),
(14, '2. ลบรูปภาพได้', '0000-00-00 00:00:00.000000', 8, 97),
(15, '3. ลบคอมเม้นได้', '0000-00-00 00:00:00.000000', 8, 97),
(16, 'wow น่ากินสุดๆเลย', '0000-00-00 00:00:00.000000', 6, 98),
(17, 'ลบคอมเม้นนี้โหน่ยยยย', '0000-00-00 00:00:00.000000', 4, 99),
(18, 'อยากมีเมียวะ', '0000-00-00 00:00:00.000000', 4, 99),
(19, 'ท่ดๆ\r\n', '0000-00-00 00:00:00.000000', 4, 99);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` longblob NOT NULL,
  `created` datetime NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `category_id` int(100) NOT NULL,
  `post_title` varchar(1000) NOT NULL,
  `post_ingredient` varchar(2024) NOT NULL,
  `post_content` varchar(2048) NOT NULL,
  `post_picture` longblob NOT NULL,
  `post_date` date NOT NULL,
  `post_like` int(100) NOT NULL,
  `post_dislike` int(100) NOT NULL,
  `post_view` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `category_id`, `post_title`, `post_ingredient`, `post_content`, `post_picture`, `post_date`, `post_like`, `post_dislike`, `post_view`) VALUES
(97, 8, 1, 'หมูทอด', 'หมู น้ำมัน', 'เอาไปทอดไง', '', '2023-03-23', 0, 0, 0),
(98, 6, 2, 'มอส', 'มอส', 'เอาไปยำ', '', '2023-03-23', 0, 0, 0),
(99, 4, 3, 'แซลมอนดอง', 'แซลมอน น้ำดอง', 'เอาไปดอง ทำไรเยอะแยะวะ', '', '2023-03-23', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `user_username` varchar(64) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_role` varchar(1) NOT NULL,
  `user_fname` varchar(100) NOT NULL,
  `user_lname` varchar(100) NOT NULL,
  `user_phone` int(10) NOT NULL,
  `user_exp` varchar(255) NOT NULL,
  `user_des` varchar(255) NOT NULL,
  `user_country` varchar(100) NOT NULL,
  `user_state` varchar(100) NOT NULL,
  `user_pic` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_name`, `user_email`, `user_role`, `user_fname`, `user_lname`, `user_phone`, `user_exp`, `user_des`, `user_country`, `user_state`, `user_pic`) VALUES
(4, 'admin', '8dc9fa69ec51046b4472bb512e292d959edd2aef', 'ADMIN', 'admin@email.com', 'a', '', '', 0, '', '', '', '', ''),
(5, 'member', 'b54df48c4c77522382a5a3c2f0358573ad43746e', 'MEMBER', 'member@email.com', 'm', '', '', 0, '', '', '', '', ''),
(6, 'a', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'A', 'a@gmail.com', 'a', '', '', 0, '', '', '', '', ''),
(8, 'm', '6b0d31c0d563223024da45691584643ac78c96e8', 'M', 'm@email.com', 'm', '', '', 0, '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_ibfk_2` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
