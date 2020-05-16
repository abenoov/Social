-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2020 at 10:49 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `participant_id`, `date`) VALUES
(1, 1, 2, '2020-05-15 15:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `img` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `img`, `date`, `post_id`, `user_id`) VALUES
(1, 'This is interresting', NULL, '2020-05-16 10:04:21', 1, 2),
(2, 'hi', NULL, '2020-05-16 10:42:28', 9, 2),
(3, 'there', NULL, '2020-05-16 10:42:37', 9, 2),
(4, '', NULL, '2020-05-16 17:52:08', 3, 2),
(5, '', NULL, '2020-05-16 18:04:33', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `friendRequest`
--

CREATE TABLE `friendRequest` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `isActive` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `date`) VALUES
(3, 2, 1, '2020-05-16 19:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `date`) VALUES
(1, 2, 1, '2020-05-15 20:14:19'),
(2, 2, 2, '2020-05-15 20:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `img` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `content`, `img`, `user_id`, `chat_id`, `date`) VALUES
(1, 'Hi', NULL, 1, 1, '2020-05-15 15:53:28'),
(2, 'are you here?', NULL, 2, 1, '2020-05-15 15:53:28'),
(3, 'Lol', 'images/messages/1589558917.png', 1, 1, '2020-05-15 16:08:37'),
(4, 'Lol', 'images/messages/1589558948.png', 1, 1, '2020-05-15 16:09:08'),
(5, 'Lol', 'images/messages/1589558996.png', 1, 1, '2020-05-15 16:09:56'),
(6, 'Lol', 'images/messages/1589559018.png', 1, 1, '2020-05-15 16:10:18'),
(7, 'Lol', 'images/messages/1589569180.png', 1, 1, '2020-05-15 18:59:40'),
(8, 'Test', NULL, 2, 1, '2020-05-16 13:05:40'),
(9, 'Hello', NULL, 2, 1, '2020-05-16 13:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `img` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `img`, `date`, `user_id`) VALUES
(1, 'hello', 'images/posts/1589397444.png', '2020-05-13 19:17:24', 1),
(2, 'New one', 'img/previewphoto.jpg', '2020-05-13 19:19:27', 2),
(3, 'Hello!', NULL, '2020-05-16 09:46:30', 2),
(9, 'Screen', 'images/posts/1589623076.png', '2020-05-16 09:57:56', 2);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `bio` text DEFAULT NULL,
  `school` text DEFAULT NULL,
  `college` text DEFAULT NULL,
  `job` text DEFAULT NULL,
  `family_status` text DEFAULT NULL,
  `favourite` text DEFAULT NULL,
  `img` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `country` text DEFAULT NULL,
  `city` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `bio`, `school`, `college`, `job`, `family_status`, `favourite`, `img`, `user_id`, `country`, `city`) VALUES
(11, '', '', '', '', '', '', 'images/profile/1589398650.png', 1, 'Kazakhstan', 'Moscow');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` text DEFAULT NULL,
  `second_name` text DEFAULT NULL,
  `third_name` text DEFAULT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `second_name`, `third_name`, `login`, `password`) VALUES
(1, 'Alikhan', 'Nursapayev', 'Ganiuly', 'nursapayev@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(2, 'Mukhtar', 'Abenov', 'Sakenuly', 'mukhtarabenov@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendRequest`
--
ALTER TABLE `friendRequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `friendRequest`
--
ALTER TABLE `friendRequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
