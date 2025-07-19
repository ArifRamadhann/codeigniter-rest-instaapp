-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 19, 2025 at 10:11 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instaapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`) VALUES
(1, 13, 4, 'ngetes', '2025-07-20 03:24:50'),
(2, 13, 4, 'komen kedua', '2025-07-20 03:27:27'),
(12, 14, 4, 'bejir', '2025-07-20 04:01:31'),
(14, 15, 4, 'apa tuh', '2025-07-20 04:44:19'),
(16, 16, 7, 'Ngetes', '2025-07-20 04:55:57'),
(17, 16, 4, 'uhuy', '2025-07-20 04:56:13'),
(18, 16, 8, 'Pertama', '2025-07-20 04:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` int NOT NULL,
  `follower_id` int NOT NULL,
  `following_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `follower_id`, `following_id`, `created_at`) VALUES
(4, 14, 13, '2025-07-20 04:38:39'),
(7, 15, 14, '2025-07-20 04:45:18'),
(9, 16, 14, '2025-07-20 04:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`) VALUES
(16, 14, 5, '2025-07-20 04:01:02'),
(17, 14, 4, '2025-07-20 04:01:05'),
(18, 15, 7, '2025-07-20 04:43:51'),
(19, 15, 5, '2025-07-20 04:43:53'),
(20, 15, 6, '2025-07-20 04:43:55'),
(21, 15, 4, '2025-07-20 04:44:22'),
(23, 16, 6, '2025-07-20 04:55:08'),
(24, 16, 5, '2025-07-20 04:55:10'),
(25, 16, 7, '2025-07-20 04:55:39'),
(26, 16, 8, '2025-07-20 04:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `caption` text,
  `image_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `caption`, `image_url`, `created_at`) VALUES
(4, 13, 'Ini sebuah caption pendek', '17ddae8ede271ef5191fdc12f5610745.jpg', '2025-07-19 23:54:57'),
(5, 13, 'Sebuah gambar iphone', '2d9ef0b90e1fc944409e13d3358c0104.jpg', '2025-07-20 01:19:07'),
(6, 14, 'bunga bunga bunga', '20bbfb02e23aa5848e405b5595b2475c.jpg', '2025-07-20 04:00:20'),
(7, 15, 'Kursi pink', '0628722ed34907a620a868d641d81ebd.jpg', '2025-07-20 04:42:03'),
(8, 16, 'Happy caption', '94b001ba1aa359b5ebae31136c6daf4d.jpg', '2025-07-20 04:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `last_activity` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `session_token`, `ip_address`, `user_agent`, `last_activity`) VALUES
(17, 13, '$2y$10$DOhpz/Qv82TtiYMvx1K3POKisTVWg3fWP4sJEEPCtDL5Kfvkmmgf.', '::1', NULL, '2025-07-19 23:00:13'),
(18, 14, '$2y$10$4BFc2w89ZNnf4BXVQuhRZeU/KgjTBFHiJ9eMSiM3zBftx.NeRWuuq', '::1', NULL, '2025-07-20 03:59:05'),
(19, 13, '$2y$10$95470Az.jB8m1KAT4cZgp.D7XyC/peCvmLO1CIpXHzzGjOp8f7GCG', '::1', NULL, '2025-07-20 04:38:50'),
(20, 15, '$2y$10$3vwBSJJC6QPl2FiQAdIkI.i9jjp9osZ6QDPndmQI.OcsfBkjNb/zq', '::1', NULL, '2025-07-20 04:41:05'),
(21, 16, '$2y$10$5pyklIa2vVGQy9xkGbKUNOuHgnzyhrb3AMmnXitQnalXLGqEeb29C', '::1', NULL, '2025-07-20 04:54:47'),
(22, 16, '$2y$10$ZZHYQEAKmedXP3fB9ekdye7dHaL862F3MpHiDLyYKM.0CWvjQ0FHi', '::1', 'PostmanRuntime/7.43.0', '2025-07-20 04:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` text,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `full_name`, `password`, `bio`, `profile_picture`, `created_at`) VALUES
(13, 'stellarlupine', 'arif.bintang.20@gmail.com', 'Wolf of the Stars', '$2y$10$fei5yriAURI022.HmdIhseRvdAFYOpj7tISd1Ig3Jyy7qE.xSA2m6', 'Semacam Biografi', '265a6155cd8e4f8bf3f1f34834259f13.png', '2025-07-19 22:43:19'),
(14, 'solarfalco', 'riperion.squad.20@gmail.com', 'Birds of The Sun', '$2y$10$swflsyItXsKM6JoqaJ.m9uK/QZhPm1uUosigT2.4FyPLJc/a7wWGW', 'wididididi', '7c1d6ddca7ed4bb76866f71f860f5f23.png', '2025-07-20 03:58:53'),
(15, 'nebulaorca', 'uhuyuhuy@gmail.com', 'Giant of The Sea', '$2y$10$sPLB9.PL/43EmVo5qOsWI.b.hm4FJ1/hL/BaHzsM1LXAIKzuYOip2', 'Aku Cantik', 'd2e64b06f8146a5c7a84de416e134179.png', '2025-07-20 04:40:50'),
(16, 'aripramadhann', 'arif.tobat.20@gmail.com', 'Arif Ramadhan', '$2y$10$yKGtPWReC6gJtTbHq7ua2.p8b.jjwkHOnvB8y05ub.ZyBT8GvXKYW', 'ini bio saya', 'd4914e6544722e130dc39ad7c9c18f6e.png', '2025-07-20 04:54:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_follow` (`follower_id`,`following_id`),
  ADD KEY `following_id` (`following_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_token` (`session_token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
