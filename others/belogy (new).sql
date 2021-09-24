-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2021 at 06:37 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belogy`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `cmt_ID` bigint NOT NULL AUTO_INCREMENT,
  `cmt_content` text COLLATE utf8_unicode_ci NOT NULL,
  `cmt_author_ID` bigint NOT NULL,
  `cmt_post_ID` bigint NOT NULL,
  `cmt_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cmt_ID`),
  KEY `fk_cmtpostid_postid` (`cmt_post_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cmt_ID`, `cmt_content`, `cmt_author_ID`, `cmt_post_ID`, `cmt_date_created`) VALUES
(75, 'test', 2, 69, '2021-06-04 00:51:01'),
(76, 'POGGG\n', 2, 69, '2021-06-04 00:51:04'),
(77, 'IT DOES WORK\n', 2, 69, '2021-06-04 00:51:09'),
(78, 'hmm need some UI', 2, 69, '2021-06-04 00:51:15'),
(79, 'asdf', 2, 69, '2021-06-04 00:51:25'),
(80, 'fasdgh', 2, 69, '2021-06-04 00:51:26'),
(81, 'nice peepoo clap', 2, 67, '2021-06-04 00:51:35'),
(82, 'heh gitgud', 2, 66, '2021-06-04 00:51:42'),
(83, 'cringe', 2, 63, '2021-06-04 00:51:49'),
(84, 'heh nice', 9, 69, '2021-06-04 00:54:47'),
(85, 'is that steve on the boat?', 2, 86, '2021-06-04 01:03:08'),
(86, 'it\'s gta 5 dummy', 9, 88, '2021-06-04 01:04:16'),
(87, 'i think', 9, 88, '2021-06-04 01:04:20'),
(88, 'yub\n', 9, 91, '2021-06-04 01:06:26'),
(89, 'pls help', 9, 91, '2021-06-04 01:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `like_ID` bigint NOT NULL AUTO_INCREMENT,
  `like_author_ID` bigint NOT NULL,
  `like_post_ID` bigint NOT NULL,
  `like_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`like_ID`),
  KEY `fk_likepostid_postid` (`like_post_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_ID`, `like_author_ID`, `like_post_ID`, `like_date_created`) VALUES
(221, 2, 63, '2021-06-04 00:51:53'),
(222, 9, 69, '2021-06-04 00:53:39'),
(223, 9, 71, '2021-06-04 00:54:14'),
(224, 9, 63, '2021-06-04 00:54:18'),
(225, 9, 85, '2021-06-04 01:01:04'),
(226, 9, 72, '2021-06-04 01:01:10'),
(227, 2, 86, '2021-06-04 01:03:00'),
(228, 9, 88, '2021-06-04 01:04:22'),
(229, 9, 86, '2021-06-04 01:04:26'),
(230, 9, 91, '2021-06-04 01:06:30'),
(231, 2, 98, '2021-06-04 01:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_ID` bigint NOT NULL AUTO_INCREMENT,
  `post_title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_content` text COLLATE utf8_unicode_ci NOT NULL,
  `post_img_url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `post_author_ID` bigint NOT NULL,
  `post_no_likes` int NOT NULL DEFAULT '0',
  `post_no_comments` int NOT NULL DEFAULT '0',
  `post_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_ID`, `post_title`, `post_content`, `post_img_url`, `post_author_ID`, `post_no_likes`, `post_no_comments`, `post_date_created`) VALUES
(63, 'This is the first ever post ', 'omg pls work ', '../images/useruploads/60b91553d4806.jpeg', 2, 2, 1, '2021-06-04 00:45:55'),
(64, 'IT ACTUALLY WORKS ', 'LOL IDK HOW hehe jk ', NULL, 2, 0, 0, '2021-06-04 00:47:06'),
(65, 'Okay let\'s add comments', 'Hopefully it won\'t take to much time', '../images/useruploads/60b915d2b9cec.png', 2, 0, 0, '2021-06-04 00:48:02'),
(66, 'It doesn\'t work', 'pls help', '../images/useruploads/60b915e86c1ff.gif', 2, 0, 1, '2021-06-04 00:48:24'),
(67, 'Gif image works', 'I tested the gif image in the previous post and it actually ran lmao nice', '../images/useruploads/60b916229c16c.gif', 2, 0, 1, '2021-06-04 00:49:22'),
(68, 'A lonely place', 'Talking to myself while uploading post for testing is a great experience ngl', NULL, 2, 0, 0, '2021-06-04 00:50:28'),
(69, 'Oh yes back to the comments', 'pls work mom i beg u', NULL, 2, 1, 7, '2021-06-04 00:50:53'),
(70, 'hi', 'heh', '../images/useruploads/60b9170652dd9.gif', 9, 0, 0, '2021-06-04 00:53:10'),
(71, 'Testing new accounts', 'it works lol', NULL, 9, 1, 0, '2021-06-04 00:53:35'),
(72, 'Lazy loading', 'or infinite scrolling? idk whatever ', '../images/useruploads/60b9178d165cb.jpeg', 9, 1, 0, '2021-06-04 00:55:25'),
(73, 'It doesn\'t work', 'as always', NULL, 9, 0, 0, '2021-06-04 00:55:38'),
(74, '1', '1', NULL, 2, 0, 0, '2021-06-04 00:56:19'),
(75, '2', '2', NULL, 2, 0, 0, '2021-06-04 00:56:24'),
(76, '3', '3', NULL, 2, 0, 0, '2021-06-04 00:56:27'),
(77, '4', '4', NULL, 2, 0, 0, '2021-06-04 00:56:31'),
(78, '5', '5', NULL, 2, 0, 0, '2021-06-04 00:56:34'),
(79, '6', '6', NULL, 2, 0, 0, '2021-06-04 00:56:38'),
(80, '7', '7', NULL, 2, 0, 0, '2021-06-04 00:56:41'),
(81, '8', '8', NULL, 2, 0, 0, '2021-06-04 00:56:44'),
(82, '9', '9', NULL, 2, 0, 0, '2021-06-04 00:56:50'),
(83, '10', '10', NULL, 2, 0, 0, '2021-06-04 00:56:56'),
(84, '11', '11', NULL, 2, 0, 0, '2021-06-04 00:57:00'),
(85, 'Lazy loading works', 'sometimes ', '../images/useruploads/60b918243780f.gif', 2, 1, 0, '2021-06-04 00:57:56'),
(86, 'Cool looking minecraft boat', 'very cul lol', '../images/useruploads/60b9191269102.jpeg', 9, 2, 1, '2021-06-04 01:01:54'),
(87, 'Guns', 'i think this is from rainbow six siege ', '../images/useruploads/60b9194c4b9bf.jpeg', 2, 0, 0, '2021-06-04 01:02:52'),
(88, 'Helicopter goes brrrrrrrrrrrrt', 'Some random image from a game', '../images/useruploads/60b9199ba4404.jpeg', 9, 1, 2, '2021-06-04 01:04:11'),
(89, 'Weebs', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../images/useruploads/60b919d6398e9.jpeg', 9, 0, 0, '2021-06-04 01:05:10'),
(90, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 9, 0, 0, '2021-06-04 01:05:31'),
(91, 'UI is a pain', 'this statement is always true :(', '../images/useruploads/60b91a1c44d0b.jpeg', 9, 1, 2, '2021-06-04 01:06:20'),
(92, 'Edgy avatar', 'yes', '../images/useruploads/60b91a7245f97.jpeg', 9, 0, 0, '2021-06-04 01:07:46'),
(93, 'Run', 'Fast as f boi', '../images/useruploads/60b91aad19b62.gif', 9, 0, 0, '2021-06-04 01:08:45'),
(94, 'Very cul background', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../images/useruploads/60b91ad20ee9f.jpeg', 9, 0, 0, '2021-06-04 01:09:22'),
(95, 'Testtttttttt', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../images/useruploads/60b91af8b73ca.jpeg', 9, 0, 0, '2021-06-04 01:10:00'),
(96, 'Edgy', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../images/useruploads/60b91b30a9749.jpeg', 9, 0, 0, '2021-06-04 01:10:56'),
(97, 'Okay let\'s be real', 'These posts are scripted lol. But hey the OG posts when this website was created is very PG-13 so loloololjsdfoashfo;iashgha', NULL, 2, 0, 0, '2021-06-04 01:13:02'),
(98, 'heh nice', 'cul', '../images/useruploads/60b91c05eae64.jpeg', 2, 1, 0, '2021-06-04 01:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_ID` bigint NOT NULL AUTO_INCREMENT,
  `user_username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_cover_bg` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_bio` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_role` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `user_dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'offline',
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `user_username`, `user_email`, `user_password`, `user_avatar`, `user_cover_bg`, `user_bio`, `user_role`, `user_dateCreated`, `user_status`) VALUES
(2, 'admin', 'quantriminh@gmail.com', '$2y$10$CE/kP2lsTkow1FhQfn3sm.BScGXxU8aDB42H4GAbfPDuNrr.pFgk6', '', '', '', 'admin', '2021-05-27 17:05:45', 'offline'),
(9, 'JustTory', 'johnnynathany@gmail.com', '$2y$10$XuF2tBOFXpo4AscliCpTM.ivcmxhQrSLgw4UkiIAvxPJn6VNFq4eO', '', '', '', 'user', '2021-06-04 00:52:45', 'offline');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_cmtpostid_postid` FOREIGN KEY (`cmt_post_ID`) REFERENCES `posts` (`post_ID`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likepostid_postid` FOREIGN KEY (`like_post_ID`) REFERENCES `posts` (`post_ID`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
