-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2021 at 08:50 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16961938_belogydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cmt_ID` bigint(20) NOT NULL,
  `cmt_content` text COLLATE utf8_unicode_ci NOT NULL,
  `cmt_author_ID` bigint(20) NOT NULL,
  `cmt_post_ID` bigint(20) NOT NULL,
  `cmt_date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(89, 'pls help', 9, 91, '2021-06-04 01:06:28'),
(90, 'nice bird lol', 9, 98, '2021-06-03 19:15:14'),
(91, 'IT DOESSSS POGGGGGG', 9, 99, '2021-06-03 19:18:42'),
(92, 'niceeeeeeee', 2, 99, '2021-06-03 19:29:50'),
(93, 'alo\n', 11, 101, '2021-06-04 05:05:56'),
(95, 'noooooo :((((', 10, 103, '2021-06-04 05:25:25'),
(96, 'noooooo :((((', 10, 103, '2021-06-04 05:25:25'),
(97, 'I I LOVE THU WITH MY WHOLE LIFE', 12, 103, '2021-06-04 05:26:13'),
(98, 'this is getting deleted for sure D:', 2, 103, '2021-06-04 05:27:10'),
(99, 'LOLI IS LOVE', 12, 103, '2021-06-04 05:27:21'),
(100, 'TOUCH THAT 10 YEAR OLD KID', 12, 103, '2021-06-04 05:27:46'),
(102, 'AGENT P\n', 12, 103, '2021-06-04 05:28:45'),
(103, 'cute', 2, 105, '2021-06-04 05:32:31'),
(104, 'lmao', 2, 106, '2021-06-04 05:33:12'),
(105, 'AAAA', 12, 106, '2021-06-04 05:35:05'),
(106, 'lmao nice', 2, 113, '2021-06-04 05:44:41'),
(107, 'gae\n', 11, 63, '2021-06-04 06:48:02'),
(108, 'dảk', 2, 117, '2021-06-04 07:56:29'),
(113, 'lol cars', 13, 119, '2021-06-04 11:34:17'),
(114, 'cringe', 13, 63, '2021-06-04 11:37:25'),
(115, 'pls not again :(', 2, 118, '2021-06-04 11:43:28'),
(116, 'i know :(', 2, 63, '2021-06-04 11:48:06'),
(117, 'lol zedong', 2, 119, '2021-06-04 13:10:58'),
(118, 'big D', 11, 125, '2021-06-04 14:12:07'),
(119, 'lol nice thanks Juan', 9, 125, '2021-06-04 14:12:46'),
(120, 'lmao', 9, 109, '2021-06-05 16:22:44'),
(121, 'ffs pls :(', 9, 118, '2021-06-05 16:23:07'),
(126, 'why not ehe', 2, 129, '2021-06-06 08:21:57'),
(127, 'Heh', 2, 129, '2021-06-06 08:25:55'),
(128, '2', 2, 129, '2021-06-06 08:39:44'),
(129, '1', 2, 129, '2021-06-06 08:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_ID` bigint(20) NOT NULL,
  `like_author_ID` bigint(20) NOT NULL,
  `like_post_ID` bigint(20) NOT NULL,
  `like_date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(233, 9, 99, '2021-06-03 19:18:55'),
(234, 2, 99, '2021-06-03 19:24:28'),
(235, 2, 98, '2021-06-03 19:41:47'),
(237, 10, 101, '2021-06-04 05:01:21'),
(238, 11, 99, '2021-06-04 05:06:10'),
(240, 11, 97, '2021-06-04 05:18:57'),
(242, 10, 103, '2021-06-04 05:25:15'),
(243, 2, 103, '2021-06-04 05:27:39'),
(244, 12, 104, '2021-06-04 05:29:15'),
(245, 2, 105, '2021-06-04 05:31:59'),
(246, 2, 93, '2021-06-04 05:34:44'),
(247, 2, 109, '2021-06-04 05:38:41'),
(248, 2, 113, '2021-06-04 05:44:26'),
(249, 2, 115, '2021-06-04 06:04:16'),
(250, 2, 114, '2021-06-04 06:04:18'),
(251, 2, 117, '2021-06-04 08:19:35'),
(254, 13, 119, '2021-06-04 11:36:54'),
(255, 13, 118, '2021-06-04 11:36:55'),
(256, 13, 117, '2021-06-04 11:36:57'),
(257, 13, 116, '2021-06-04 11:36:59'),
(258, 13, 115, '2021-06-04 11:37:02'),
(260, 2, 118, '2021-06-04 13:10:45'),
(263, 9, 125, '2021-06-04 14:11:02'),
(264, 11, 125, '2021-06-04 14:12:34'),
(266, 9, 128, '2021-06-05 16:12:10'),
(267, 9, 118, '2021-06-05 16:21:39'),
(268, 9, 117, '2021-06-05 16:21:42'),
(269, 9, 115, '2021-06-05 16:21:44'),
(270, 9, 114, '2021-06-05 16:21:46'),
(271, 9, 113, '2021-06-05 16:21:48'),
(272, 9, 122, '2021-06-05 16:21:53'),
(273, 9, 123, '2021-06-05 16:21:59'),
(274, 9, 119, '2021-06-05 16:22:02'),
(275, 9, 116, '2021-06-05 16:22:29'),
(276, 9, 104, '2021-06-05 16:23:21'),
(277, 9, 98, '2021-06-05 16:23:22'),
(278, 9, 97, '2021-06-05 16:23:23'),
(279, 9, 87, '2021-06-05 16:23:25'),
(280, 9, 84, '2021-06-05 16:23:27'),
(281, 9, 83, '2021-06-05 16:23:28'),
(282, 9, 82, '2021-06-05 16:23:29'),
(283, 9, 81, '2021-06-05 16:23:30'),
(285, 9, 79, '2021-06-05 16:23:32'),
(286, 9, 80, '2021-06-05 16:23:33'),
(287, 9, 78, '2021-06-05 16:23:34'),
(288, 9, 77, '2021-06-05 16:23:35'),
(289, 9, 76, '2021-06-05 16:23:36'),
(290, 9, 75, '2021-06-05 16:23:37'),
(291, 9, 74, '2021-06-05 16:23:39'),
(292, 9, 68, '2021-06-05 16:23:40'),
(293, 9, 67, '2021-06-05 16:23:43'),
(294, 9, 66, '2021-06-05 16:23:44'),
(295, 9, 65, '2021-06-05 16:23:47'),
(296, 9, 64, '2021-06-05 16:23:51'),
(298, 9, 100, '2021-06-05 16:24:42'),
(299, 10, 129, '2021-06-05 16:30:13'),
(310, 2, 128, '2021-06-06 08:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_ID` bigint(20) NOT NULL,
  `post_title` text COLLATE utf8_unicode_ci NOT NULL,
  `post_content` text COLLATE utf8_unicode_ci NOT NULL,
  `post_img_url` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_author_ID` bigint(20) NOT NULL,
  `post_no_likes` int(11) NOT NULL DEFAULT 0,
  `post_no_comments` int(11) NOT NULL DEFAULT 0,
  `post_date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `post_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_ID`, `post_title`, `post_content`, `post_img_url`, `post_author_ID`, `post_no_likes`, `post_no_comments`, `post_date_created`, `post_last_modified`) VALUES
(63, 'This is the first ever post ', 'omg pls work ', '../images/useruploads/60b91553d4806.jpeg', 2, 2, 4, '2021-06-04 00:45:55', '2021-06-04 11:48:06'),
(64, 'IT ACTUALLY WORKS ', 'LOL IDK HOW hehe jk ', NULL, 2, 1, 0, '2021-06-04 00:47:06', '2021-06-05 16:23:51'),
(65, 'Okay let\'s add comments', 'Hopefully it won\'t take to much time', '../images/useruploads/60b915d2b9cec.png', 2, 1, 0, '2021-06-04 00:48:02', '2021-06-05 16:23:47'),
(66, 'It doesn\'t work', 'pls help', '../images/useruploads/60b915e86c1ff.gif', 2, 1, 1, '2021-06-04 00:48:24', '2021-06-05 16:23:44'),
(67, 'Gif image works', 'I tested the gif image in the previous post and it actually ran lmao nice', '../images/useruploads/60b916229c16c.gif', 2, 1, 1, '2021-06-04 00:49:22', '2021-06-05 16:23:43'),
(68, 'A lonely place', 'Talking to myself while uploading post for testing is a great experience ngl', NULL, 2, 1, 0, '2021-06-04 00:50:28', '2021-06-05 16:23:40'),
(69, 'Oh yes back to the comments', 'pls work mom i beg u', NULL, 2, 1, 7, '2021-06-04 00:50:53', '2021-06-03 18:37:21'),
(70, 'hi', 'heh', '../images/useruploads/60b9170652dd9.gif', 9, 0, 0, '2021-06-04 00:53:10', '2021-06-03 18:37:21'),
(71, 'Testing new accounts', 'it works lol', NULL, 9, 1, 0, '2021-06-04 00:53:35', '2021-06-03 18:37:21'),
(72, 'Lazy loading', 'or infinite scrolling? idk whatever ', '../images/useruploads/60b9178d165cb.jpeg', 9, 1, 0, '2021-06-04 00:55:25', '2021-06-03 18:37:21'),
(73, 'It doesn\'t work', 'as always', NULL, 9, 0, 0, '2021-06-04 00:55:38', '2021-06-03 18:37:21'),
(74, '1', '1', NULL, 2, 1, 0, '2021-06-04 00:56:19', '2021-06-05 16:23:39'),
(75, '2', '2', NULL, 2, 1, 0, '2021-06-04 00:56:24', '2021-06-05 16:23:37'),
(76, '3', '3', NULL, 2, 1, 0, '2021-06-04 00:56:27', '2021-06-05 16:23:36'),
(77, '4', '4', NULL, 2, 1, 0, '2021-06-04 00:56:31', '2021-06-05 16:23:35'),
(78, '5', '5', NULL, 2, 1, 0, '2021-06-04 00:56:34', '2021-06-05 16:23:34'),
(79, '6', '6', NULL, 2, 1, 0, '2021-06-04 00:56:38', '2021-06-05 16:23:32'),
(80, '7', '7', NULL, 2, 1, 0, '2021-06-04 00:56:41', '2021-06-05 16:23:33'),
(81, '8', '8', NULL, 2, 1, 0, '2021-06-04 00:56:44', '2021-06-05 16:23:30'),
(82, '9', '9', NULL, 2, 1, 0, '2021-06-04 00:56:50', '2021-06-05 16:23:29'),
(83, '10', '10', NULL, 2, 1, 0, '2021-06-04 00:56:56', '2021-06-05 16:23:28'),
(84, '11', '11', NULL, 2, 1, 0, '2021-06-04 00:57:00', '2021-06-05 16:23:27'),
(85, 'Lazy loading works', 'sometimes ', '../images/useruploads/60b918243780f.gif', 2, 1, 0, '2021-06-04 00:57:56', '2021-06-03 18:37:21'),
(86, 'Cool looking minecraft boat', 'very cul lol', '../images/useruploads/60b9191269102.jpeg', 9, 2, 1, '2021-06-04 01:01:54', '2021-06-03 18:37:21'),
(87, 'Guns', 'i think this is from rainbow six siege ', '../images/useruploads/60b9194c4b9bf.jpeg', 2, 1, 0, '2021-06-04 01:02:52', '2021-06-05 16:23:25'),
(88, 'Helicopter goes brrrrrrrrrrrrt', 'Some random image from a game', '../images/useruploads/60b9199ba4404.jpeg', 9, 1, 2, '2021-06-04 01:04:11', '2021-06-03 18:37:21'),
(89, 'Weebs', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../images/useruploads/60b919d6398e9.jpeg', 9, 0, 0, '2021-06-04 01:05:10', '2021-06-03 18:37:21'),
(91, 'UI is a pain', 'this statement is always true :(', '../images/useruploads/60b91a1c44d0b.jpeg', 9, 1, 2, '2021-06-04 01:06:20', '2021-06-03 18:37:21'),
(92, 'Edgy avatar', 'yes', '../images/useruploads/60b91a7245f97.jpeg', 9, 0, 0, '2021-06-04 01:07:46', '2021-06-03 18:37:21'),
(93, 'Run', 'Fast as f boi', '../images/useruploads/60b91aad19b62.gif', 9, 1, 0, '2021-06-04 01:08:45', '2021-06-04 05:34:44'),
(94, 'Very cul background', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../images/useruploads/60b91ad20ee9f.jpeg', 9, 0, 0, '2021-06-04 01:09:22', '2021-06-03 18:37:21'),
(95, 'Testtttttttt', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../images/useruploads/60b91af8b73ca.jpeg', 9, 0, 0, '2021-06-04 01:10:00', '2021-06-03 18:37:21'),
(96, 'Edgy', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../images/useruploads/60b91b30a9749.jpeg', 9, 0, 0, '2021-06-04 01:10:56', '2021-06-03 18:37:21'),
(97, 'Okay let\'s be real', 'These posts are scripted lol. But hey the OG posts when this website was created is very PG-13 so loloololjsdfoashfo;iashgha', NULL, 2, 2, 0, '2021-06-04 01:13:02', '2021-06-05 16:23:23'),
(98, 'heh nice', 'cul', '../images/useruploads/60b91c05eae64.jpeg', 2, 2, 1, '2021-06-04 01:13:16', '2021-06-05 16:23:22'),
(99, 'First post on the web host', 'let\'s see if it works', '../images/useruploads/60b92bc49ecc2.jpeg', 9, 3, 2, '2021-06-03 19:18:27', '2021-06-04 05:06:10'),
(100, 'Can\'t sign up after hosted', 'uh oh :(', NULL, 9, 1, 0, '2021-06-04 03:44:17', '2021-06-05 16:24:42'),
(101, 'Test for tory', '123123', '../images/useruploads/60b9b177b32bf.jpeg', 10, 1, 1, '2021-06-04 04:52:07', '2021-06-05 16:32:23'),
(103, 'I need lolis', 'No loli with me, my pp feels bad', '../images/useruploads/60b9b936543d6.jpeg', 12, 2, 8, '2021-06-04 05:25:10', '2021-06-04 05:28:45'),
(104, 'PLS STOP', 'plssss', '../images/useruploads/60b9ba1a81976.gif', 2, 2, 0, '2021-06-04 05:28:58', '2021-06-05 16:23:21'),
(105, 'A', 'A', '../images/useruploads/60b9baa8e3340.gif', 12, 1, 1, '2021-06-04 05:31:20', '2021-06-04 05:32:31'),
(106, 'Title', 'Content', '../images/useruploads/60b9baf904c62.jpeg', 11, 0, 2, '2021-06-04 05:32:41', '2021-06-04 05:35:05'),
(109, 'đẳng đẳng lmao', 'hehe boi', '../images/useruploads/60b9bc5040d9d.jpeg', 11, 1, 1, '2021-06-04 05:38:24', '2021-06-05 16:22:44'),
(110, 'not empty', 'not empty', NULL, 11, 0, 0, '2021-06-04 05:39:17', '2021-06-04 05:39:17'),
(111, 'Korega Requiem, da', 'Kono Giorno Giovanna niwa yume ga aru', '../images/useruploads/60b9bccb53a29.jpeg', 11, 0, 0, '2021-06-04 05:40:27', '2021-06-04 05:40:27'),
(112, 'empty', 'empty', '../images/useruploads/60b9bcf68ad34.jpeg', 11, 0, 0, '2021-06-04 05:41:10', '2021-06-04 05:41:10'),
(113, 'Khooi is ', 'a pedo', '../images/useruploads/60b9bd8d8c1cf.png', 11, 2, 1, '2021-06-04 05:43:41', '2021-06-05 16:21:48'),
(114, 'ánh sáng của Đảng', 'Đảng là chân ái\r\n', '../images/useruploads/60b9bfae45eff.jpeg', 11, 2, 0, '2021-06-04 05:52:46', '2021-06-05 16:21:46'),
(115, 'shitpost', 'i said, it\'s a shitpost', '../images/useruploads/60b9c14545990.jpeg', 11, 3, 0, '2021-06-04 05:59:33', '2021-06-05 16:21:44'),
(116, 'I\'m very useful to my team', 'i think', '../images/useruploads/60b9c230bf7d8.jpeg', 2, 2, 0, '2021-06-04 06:03:28', '2021-06-05 16:22:29'),
(117, 'huh?', 'what?', '../images/useruploads/60b9d1785e339.png', 11, 3, 1, '2021-06-04 07:08:40', '2021-06-05 16:21:42'),
(118, 'Sandstorm', 'by Rick Astley', '../images/useruploads/60b9fb422a8e0.jpeg', 11, 3, 2, '2021-06-04 10:06:58', '2021-06-05 16:23:07'),
(119, 'Testing long post on host', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../images/useruploads/60ba0dfce8269.jpeg', 2, 2, 2, '2021-06-04 11:26:52', '2021-06-05 16:22:02'),
(122, 'Clap clap', 'heh', '../images/useruploads/60ba2637c4a3e.jpeg', 2, 1, 0, '2021-06-04 11:42:21', '2021-06-05 16:21:53'),
(123, 'Test async task', 'not really an async task but ok lul', '../images/useruploads/60ba26c20d220.png', 2, 1, 0, '2021-06-04 13:11:45', '2021-06-05 16:21:59'),
(125, 'Test comment thử coi đc chưa Juan', 'comment vô post này thử xem', NULL, 9, 2, 2, '2021-06-04 14:10:36', '2021-06-04 14:12:46'),
(128, 'Belogy Update', 'Added profile page (customize avatar, cover background, bio, etc...). Added 2 new navbar items for easier navigation through out the page. Click on user avatar anywhere visible on the page to visit their profile.', '../images/useruploads/60bba11d16451.png', 2, 2, 0, '2021-06-05 16:06:53', '2021-06-06 08:38:06'),
(129, 'Minecraft boat', 'Should I start a new minecraft world? :/', '../images/useruploads/60bba5f5b17a8.jpeg', 9, 1, 4, '2021-06-05 16:27:33', '2021-06-06 08:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` bigint(20) NOT NULL,
  `user_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '../images/default/defaultUserAvatar.png',
  `user_cover_bg` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '../images/default/emptyimg.png',
  `user_bio` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `user_dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `user_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `user_username`, `user_email`, `user_password`, `user_avatar`, `user_cover_bg`, `user_bio`, `user_role`, `user_dateCreated`, `user_status`) VALUES
(2, 'quantriminh', 'quantriminh@gmail.com', '$2y$10$CE/kP2lsTkow1FhQfn3sm.BScGXxU8aDB42H4GAbfPDuNrr.pFgk6', '../images/useruploads/60bb9ef1a15fd.jpeg', '../images/useruploads/60bb9f1081292.jpeg', 'My name is Quan Minh Trí. I\'m 20 years old. I study at ITEC and I\'m the owner/admin of the Belogy website', 'admin', '2021-05-27 17:05:45', 'offline'),
(9, 'JustTory', 'johnnynathany@gmail.com', '$2y$10$XuF2tBOFXpo4AscliCpTM.ivcmxhQrSLgw4UkiIAvxPJn6VNFq4eO', '../images/useruploads/60bba00600f03.gif', '../images/useruploads/60bbb42ce844c.png', 'I struggle in everything', 'user', '2021-06-04 00:52:45', 'offline'),
(10, 'SoulSad', 'test@gmail.com', '$2y$10$SPsKKDKXi/AlHuNdGwwQHuTTTjj.YDqqOnrMi9I29SG4pmyPDzoHC', '../images/useruploads/60bba6dcb02f8.jpeg', '../images/useruploads/60bba6eceed71.jpeg', 'very nice profile', 'user', '2021-06-04 04:51:33', 'offline'),
(11, 'Potato', 'thefireofvengeance@gmail.com', '$2y$10$8kT5Mxw/aqSZxT2AC/kz8.Da6z7jsfW.cpwZ.GYz5Y79UhxF8iPeC', '../images/useruploads/60bba598d2154.jpeg', '../images/useruploads/60bba67d18336.jpeg', 'something about yourself', 'user', '2021-06-04 05:05:35', 'offline'),
(12, 'loliislove', 'iloveloli@abc.com', '$2y$10$jufnDGEzZ3zmKhvQ3VkySO.7mrWbaisPckh2o9pMSU2RhxsFt.Y4G', '../images/default/defaultUserAvatar.png', '../images/default/empty-coverbg.jpg', NULL, 'user', '2021-06-04 05:24:12', 'offline'),
(13, 'lmaoZedong123', 'royet11389@relumyx.com', '$2y$10$mr/dpcaRaw/tdJQj1cL6BuowzMWCCW5N85MPykgk9it49E1i/Iwli', '../images/default/defaultUserAvatar.png', '../images/default/empty-coverbg.jpg', NULL, 'user', '2021-06-04 11:31:14', 'offline'),
(14, 'chanhbeck', 'weiugwebi@wegn.weng', '$2y$10$BAg9GQxtJXG.OcsICfqjY.N.6BJW5nfhn/1Qyi4R5cmzO4J3aJQJW', '../images/default/defaultUserAvatar.png', '../images/default/empty-coverbg.jpg', NULL, 'user', '2021-06-04 15:54:33', 'offline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cmt_ID`),
  ADD KEY `fk_cmtpostid_postid` (`cmt_post_ID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_ID`),
  ADD KEY `fk_likepostid_postid` (`like_post_ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cmt_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_cmtpostid_postid` FOREIGN KEY (`cmt_post_ID`) REFERENCES `posts` (`post_ID`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likepostid_postid` FOREIGN KEY (`like_post_ID`) REFERENCES `posts` (`post_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
