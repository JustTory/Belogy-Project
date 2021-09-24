-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2021 at 11:59 AM
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
  PRIMARY KEY (`cmt_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cmt_ID`, `cmt_content`, `cmt_author_ID`, `cmt_post_ID`, `cmt_date_created`) VALUES
(12, 'testing date time', 2, 47, '2021-05-31 11:07:37'),
(11, 'test', 2, 47, '2021-05-31 10:57:03'),
(10, 'pls work mom', 5, 48, '2021-05-30 22:03:54'),
(9, 'heheboi', 5, 47, '2021-05-30 21:56:23'),
(8, 'pls work mom', 2, 47, '2021-05-30 19:21:36'),
(13, 'testing cmt date time', 2, 47, '2021-05-31 11:08:04'),
(14, 'testtt', 2, 47, '2021-05-31 11:10:28'),
(15, 'testing 123', 2, 47, '2021-05-31 11:11:30'),
(16, 'lol cringe background bro', 5, 47, '2021-05-31 11:12:33'),
(17, 'vietnamese hmmmm...', 5, 47, '2021-05-31 11:12:52'),
(18, ' rep weebs', 5, 49, '2021-05-31 11:52:32'),
(19, 'yea right cringe admin', 5, 46, '2021-05-31 11:58:55'),
(20, 'nice 1 piece', 5, 45, '2021-05-31 11:59:43'),
(21, 'pretty nice avatar i think', 5, 4, '2021-05-31 12:05:35'),
(22, 'damn edgy', 5, 23, '2021-05-31 12:09:14'),
(23, 'pretty cool ngl', 5, 23, '2021-05-31 12:09:28'),
(26, 'nicee', 5, 49, '2021-05-31 12:53:00'),
(25, 'heheboi', 5, 49, '2021-05-31 12:46:16'),
(27, 'weebs', 5, 49, '2021-05-31 13:00:23'),
(28, 'very cul', 5, 49, '2021-05-31 13:01:04'),
(29, 'number 6 boii', 5, 49, '2021-05-31 13:04:35'),
(30, 'hmmm', 5, 49, '2021-05-31 13:05:11'),
(31, 'plsssssss', 5, 49, '2021-05-31 13:06:16'),
(32, 'đoán xem', 5, 49, '2021-05-31 13:07:18'),
(33, 'đoán xem 2', 5, 49, '2021-05-31 13:08:20'),
(34, 'đoán xem 3', 5, 49, '2021-05-31 13:09:01'),
(35, 'đoán xem 4', 5, 49, '2021-05-31 13:09:13'),
(36, 'kekw', 5, 48, '2021-05-31 13:09:28'),
(37, 'oh boi oh boi', 5, 48, '2021-05-31 18:51:21'),
(38, 'nice heh', 5, 48, '2021-05-31 18:54:01'),
(39, 'huh', 5, 49, '2021-05-31 18:54:20'),
(40, 'wait', 5, 48, '2021-05-31 18:54:27'),
(41, '', 5, 48, '2021-06-01 23:20:29'),
(42, '', 5, 48, '2021-06-01 23:21:34'),
(43, 'heheboi', 5, 48, '2021-06-01 23:30:47'),
(44, 'heheboi', 5, 48, '2021-06-01 23:30:49'),
(45, 'please work mom', 5, 48, '2021-06-01 23:33:19'),
(46, 'niceee', 5, 48, '2021-06-01 23:33:29'),
(47, 'test', 7, 50, '2021-06-02 00:32:27'),
(48, 'hehe nice post bro', 5, 50, '2021-06-02 12:16:48'),
(49, 'khong :(', 5, 52, '2021-06-02 13:51:09'),
(50, 'heh ga', 5, 52, '2021-06-02 14:00:55'),
(51, 'heh', 5, 50, '2021-06-02 18:59:36'),
(52, 'hehe', 5, 52, '2021-06-02 19:06:54'),
(53, 'ga', 5, 52, '2021-06-02 19:06:59'),
(54, 'aig', 5, 52, '2021-06-02 19:07:08'),
(55, 'hehe boi', 5, 0, '2021-06-02 19:16:03'),
(56, 'u baby', 5, 0, '2021-06-02 19:16:07'),
(57, 'nice', 5, 0, '2021-06-02 19:16:11'),
(58, 'okay', 5, 0, '2021-06-02 19:16:14'),
(59, 'aight cool', 5, 0, '2021-06-02 19:18:56'),
(60, 'gg', 5, 0, '2021-06-02 19:21:16'),
(61, 'plllsss', 5, 53, '2021-06-02 19:21:50'),
(62, '1', 5, 53, '2021-06-02 19:22:08'),
(63, '2', 5, 52, '2021-06-02 19:22:10'),
(64, '3', 5, 53, '2021-06-02 19:22:12'),
(65, '4', 5, 52, '2021-06-02 19:22:15'),
(66, 'nice', 5, 52, '2021-06-02 19:22:25'),
(67, 'aight', 5, 52, '2021-06-02 19:24:15'),
(68, 'kakashi so cul', 5, 54, '2021-06-02 20:44:29'),
(69, 'damn assasinn', 5, 53, '2021-06-02 20:44:35'),
(70, 'kakasensi', 5, 54, '2021-06-02 20:44:40'),
(71, 'knfieee', 5, 53, '2021-06-02 20:44:43'),
(72, 'heh', 2, 52, '2021-06-02 21:25:50'),
(73, 'hmmmm', 2, 52, '2021-06-02 21:30:20'),
(74, 'heh', 5, 53, '2021-06-02 23:43:59');

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
  PRIMARY KEY (`like_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_ID`, `like_author_ID`, `like_post_ID`, `like_date_created`) VALUES
(201, 5, 56, '2021-06-03 01:08:56'),
(179, 5, 54, '2021-06-03 00:36:02'),
(104, 2, 52, '2021-06-02 22:15:45'),
(190, 5, 4, '2021-06-03 00:42:03'),
(25, 5, 23, '0000-00-00 00:00:00'),
(24, 5, 36, '0000-00-00 00:00:00'),
(182, 5, 46, '2021-06-03 00:36:10'),
(195, 5, 49, '2021-06-03 00:42:25'),
(177, 5, 51, '2021-06-03 00:34:52'),
(184, 5, 27, '2021-06-03 00:36:16'),
(186, 5, 5, '2021-06-03 00:36:22'),
(203, 5, 59, '2021-06-03 18:48:47');

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
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_ID`, `post_title`, `post_content`, `post_img_url`, `post_author_ID`, `post_no_likes`, `post_no_comments`, `post_date_created`) VALUES
(4, 'My Avatar', 'Bro, my avatar is so cool i can\'t believe bro holy moly lololol lmao ', '../images/useruploads/60b21604a6f43.jpeg', 2, 1, 1, '2021-05-29 17:23:00'),
(5, 'Edgy avatar', 'Very edgy but it\'s kinda cool ngl. What it\'s cringe? Aight then :(', '../images/useruploads/60b219c0a68d3.jpeg', 5, 1, 0, '2021-05-29 17:38:56'),
(6, 'TEst', 'testt', NULL, 5, 0, 0, '2021-05-29 17:39:47'),
(7, 'plsss', 'work mom', NULL, 5, 0, 0, '2021-05-29 17:41:19'),
(8, 'test', 'testttttt', NULL, 5, 0, 0, '2021-05-29 17:46:46'),
(9, 'asdfasdf', 'fffffffffffffff', NULL, 5, 0, 0, '2021-05-29 17:48:35'),
(10, 'asdfasf', 'asdfaaaa', NULL, 5, 0, 0, '2021-05-29 17:48:52'),
(11, 'aaaaa', 'aaaaa', NULL, 5, 0, 0, '2021-05-29 17:52:03'),
(12, 'hhh', 'gggg', NULL, 5, 0, 0, '2021-05-29 17:54:35'),
(13, 'a', 'a', NULL, 5, 0, 0, '2021-05-29 17:56:55'),
(14, 'a', 'aa', NULL, 5, 0, 0, '2021-05-29 17:57:40'),
(15, 'hhh', 'hhh', NULL, 5, 0, 0, '2021-05-29 17:58:24'),
(16, 'jj', 'jj', NULL, 5, 0, 0, '2021-05-29 18:00:06'),
(17, 'kk', 'kk', NULL, 5, 0, 0, '2021-05-29 18:00:52'),
(18, 'asdfasf', 'asdfas', NULL, 5, 0, 0, '2021-05-29 18:05:30'),
(19, 'hdshs', 'hshsh', NULL, 5, 0, 0, '2021-05-29 18:07:02'),
(20, 'aaaa', 'fdfdf', NULL, 5, 0, 0, '2021-05-29 18:07:47'),
(21, 'hahaahah', 'time goes brrrt', NULL, 5, 0, 0, '2021-05-29 19:18:44'),
(22, 'asdfasgy', 'ttttttttttt', NULL, 5, 0, 0, '2021-05-29 22:43:35'),
(23, 'New Post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam reprehenderit delectus qui totam porro recusandae blanditiis error, eveniet optio veritatis. Fuga ipsam quis ab a adipisci molestias praesentium numquam ut.', '../images/useruploads/60b275f2529d7.jpeg', 5, 1, 2, '2021-05-30 00:12:18'),
(24, '1', '1', NULL, 5, 0, 0, '2021-05-30 00:35:03'),
(25, '2', '2', NULL, 5, 0, 0, '2021-05-30 00:35:08'),
(26, '3', '3', NULL, 5, 0, 0, '2021-05-30 00:35:12'),
(27, '4', '4', NULL, 5, 1, 0, '2021-05-30 00:35:16'),
(28, '5', '5', NULL, 5, 0, 0, '2021-05-30 00:35:18'),
(29, '6', '6', NULL, 5, 0, 0, '2021-05-30 00:35:21'),
(30, '7', '7', NULL, 5, 0, 0, '2021-05-30 00:35:24'),
(31, '8', '8', NULL, 5, 0, 0, '2021-05-30 00:35:26'),
(32, '9', '9', NULL, 5, 0, 0, '2021-05-30 00:35:30'),
(33, '10', '10', NULL, 5, 0, 0, '2021-05-30 00:35:34'),
(34, '11', '11', NULL, 5, 0, 0, '2021-05-30 00:35:38'),
(35, '12', '12', NULL, 5, 0, 0, '2021-05-30 00:35:42'),
(36, '13', '13', NULL, 5, 1, 0, '2021-05-30 00:35:45'),
(37, '14', '14', NULL, 5, 0, 0, '2021-05-30 00:35:48'),
(38, '15', '15', NULL, 5, 0, 0, '2021-05-30 00:35:51'),
(39, '16', '16', NULL, 5, 0, 0, '2021-05-30 00:35:55'),
(40, '17', '17', NULL, 5, 0, 0, '2021-05-30 00:35:59'),
(41, '18', '18', NULL, 5, 0, 0, '2021-05-30 00:36:03'),
(42, '19', '19', NULL, 5, 0, 0, '2021-05-30 00:36:06'),
(43, '20', '20', NULL, 5, 0, 0, '2021-05-30 00:36:10'),
(45, 'This is a very cool title', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../images/useruploads/60b33b873a311.jpeg', 5, 0, 1, '2021-05-30 14:15:19'),
(46, 'Đây là Admin', 'Đang thử nghiệm tiếng việt trên Belogy', '../images/useruploads/60b36312583e4.jpeg', 2, 1, 1, '2021-05-30 17:04:02'),
(47, 'Kiểm tra tiếng việt', 'SOẠN THẢO VĂN BẢN TIẾNG VIỆTCâu 1: Khái niệm văn bản?- Văn bản là một tập hợp câu tạo thành một chỉnh thể thống nhất, vừa hoànchỉnh về hình thức, vừa trọn vẹn về nội dung, vừa thống nhất về cấu trúc,vừa độc lập về giao tiếp.- Văn bản là một tập hợp câu.- Nói đến chỉnh thể thống nhất là nói đến một tập hợp câu cùng nói về mộtchủ thể đồng thời trong các câu đều tồn tại một liên kết\r\n\r\nXem nội dung đầy đủ tại: https://123docz.net/document/4834375-soan-thao-van-ban-tieng-viet.html', '../images/useruploads/60b3649658eb6.jpeg', 2, 0, 9, '2021-05-30 17:10:30'),
(48, 'heheheehboi', 'TESTTTTTTTTTTTTTTTTT', '../images/useruploads/60b8bccbed0c4.jpeg', 5, 0, 11, '2021-05-30 22:01:18'),
(49, 'testttttttttt', 'pls work', '../images/useruploads/60b3aa16e36a8.jpeg', 5, 1, 13, '2021-05-30 22:07:02'),
(50, 'VERY LONG POST TEST', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', '../images/useruploads/60b667ea230dc.png', 5, 0, 3, '2021-06-02 00:01:30'),
(51, 'hmm nice', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n\r\n\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', NULL, 5, 1, 0, '2021-06-02 00:04:48'),
(52, 'plswork', 'work đi mà giáo sư work đi mà giáo sư\r\nwork đi mà giáo sưwork đi mà giáo sư\r\nwork đi mà giáo sư\r\nwork đi mà giáo sư\r\nwork đi mà giáo sư\r\nwork đi mà giáo sư\r\nwork đi mà giáo sư', '../images/useruploads/60b66fce8fc5c.jpeg', 7, 1, 11, '2021-06-02 00:35:10'),
(53, 'testt', 'asdfsadf', '../images/useruploads/60b7651a69447.jpeg', 5, 0, 6, '2021-06-02 18:01:46'),
(54, 'dfasdf', 'dffadf', '../images/useruploads/60b77e91b3018.jpeg', 5, 1, 2, '2021-06-02 19:50:25'),
(55, 'test', '123', NULL, 5, 0, 0, '2021-06-03 00:47:11'),
(56, 'r6', 'cool', '../images/useruploads/60b7c43024caa.jpeg', 5, 1, 0, '2021-06-03 00:47:28'),
(57, 'df', 'asdfa', '../images/useruploads/60b7c4c957624.jpeg', 5, 0, 0, '2021-06-03 00:50:01'),
(58, 'asdf', 'asdf', NULL, 5, 0, 0, '2021-06-03 14:40:03'),
(59, 'Minecraft', 'ugly boat ', NULL, 5, 1, 0, '2021-06-03 15:09:03'),
(60, 'Minecraft boat', 'very cool boat lol', '../images/useruploads/60b8bbf301644.jpeg', 5, 0, 0, '2021-06-03 15:10:43'),
(61, 'hehe cringe image', 'cool', NULL, 5, 0, 0, '2021-06-03 18:14:28');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `user_username`, `user_email`, `user_password`, `user_avatar`, `user_cover_bg`, `user_bio`, `user_role`, `user_dateCreated`, `user_status`) VALUES
(2, 'admin', 'quantriminh@gmail.com', '$2y$10$CE/kP2lsTkow1FhQfn3sm.BScGXxU8aDB42H4GAbfPDuNrr.pFgk6', '', '', '', 'admin', '2021-05-27 17:05:45', 'offline'),
(3, 'JustTory', 'johnnynathany@gmail.com', '$2y$10$mV1RpB.5nAGmHiRhykIhLO8oAXyGN3NQM/wtkPjhsSzzOSd/tfdYa', '', '', '', 'user', '2021-05-27 20:28:01', 'offline'),
(4, 'newww', '1@gmail.com', '$2y$10$BeBGvCLrCOK178s3Mr9fnemyCEf.Tk17yHFWV2MMO6ux/JU6/ei8.', '', '', '', 'user', '2021-05-27 20:30:40', 'offline'),
(5, 'TestTory', 'test@gmail.com', '$2y$10$ZtQPWG4Nq2Mmya1Jq6Wid.6JZzArcwQ5vKhxg5miIKgCreB60oabe', '', '', '', 'user', '2021-05-28 00:53:10', 'offline'),
(6, 'testnow', 'heheboi@gmail.com', '$2y$10$a80axrbdqK.UWdJX669PYOCApirRM4IAqsAlxUHn8kN9BMh95zBg6', '', '', '', 'user', '2021-05-28 01:48:43', 'offline'),
(7, 'plswork', 'plswork@gmail.com', '$2y$10$cbFZFQknCYuaXsgpEpjI8OtrnduquhA2bK8aiBhm6nriyyxa4isEW', '', '', '', 'user', '2021-06-02 00:32:05', 'offline'),
(8, 'heheboi', 'heheboi2@gmail.com', '$2y$10$uQ79cOsk/uJmt9qpDthNieD6fvCxPvFSwLfqk0jT5qufVHsCX58L6', '', '', '', 'user', '2021-06-02 22:25:05', 'offline');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
