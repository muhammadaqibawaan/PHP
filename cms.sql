-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2019 at 03:25 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(2, 'JAWA'),
(3, 'PHP'),
(4, 'JavaScript'),
(18, 'HTML'),
(19, 'CSS'),
(27, 'OOP'),
(28, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(15) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(12, 2, 'Aqib', 'example@gmail.com', 'jkkhk', 'approved', '2019-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(10, 27, 'Example Post', 'New User', '2019-11-22', 'image_1.jpg', '  There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.                  ', 'OOP, PHP,javascript', 0, 'draft', 0),
(11, 1, 'Awesome post', 'Ahmed', '2019-11-23', 'image_3.jpg', '  Fantastic Post         ', 'web , php', 1, 'draft', 1),
(14, 18, 'Angular 2', 'ummer', '2019-11-28', 'Orientationday.PNG', ' <p>hgjhgj</p>         ', 'web , php', 0, 'draft', 0),
(21, 2, 'Example Post', 'New User', '2019-11-29', 'image_1.jpg', '      There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.                                                      ', 'OOP, PHP,javascript', 0, 'draft', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_image`, `user_role`, `randSalt`) VALUES
(2, 'ammarali', 'Ammar', 'Ahmed', 'ahmed123@gmail.com', '123', 'aqib.jpg', 'admin', ''),
(3, 'Jawad123', 'Jawad', 'Ahmed', 'jawad@gmail.com', '123', '20190420_174249.jpg', 'subscriber', ''),
(4, 'aqib1563', 'Muhammad', 'Aqib', 'aqib@gmail.com', '123', 'aqib.jpg', 'admin', ''),
(5, 'Ummer', 'ummer', 'minhaj', 'ummer@gmail.com', '123', 'aqib.jpg', 'admin', ''),
(11, 'user', '', '', 'user@gmail.com', '$2y$10$.Ua9Iz3VwOPMOaK54ca2EedFJI1O7h5zPP.wxf4V4cyLPkOPx5SP.', '', 'admin', ''),
(12, 'new', '', '', 'new@gmail.com', '$2y$10$qXe5DU4qVyV8rEFod2eKb.wix4bdm/jNf6x6ZNMg2xaxfb0dTwU8m', '', 'admin', ''),
(13, 'testuser', '', '', 'test@gmail.com', '$2y$10$zR6V6TCgfWXcTzn.XpOWcOKOEmoAkcBlyrAAgLoEMlvKZ8jdspVlG', '', 'admin', ''),
(14, 'anwar', '', '', 'anwar@gmail.com', '$2y$10$5yWXGiS5cR9jVjL88ZvcKe7u97EKxL6cnygpRdXAeyrYRm6Vld72O', '', 'admin', ''),
(15, 'imran', 'imran', 'khan', 'imran@gmail.com', '$2y$10$30uwKRjwKvHgmTsvlqxBRexPUJbLPQeLIwekp6Kg30Kp/.gEOMFP.', 'aqib.jpg', 'admin', ''),
(23, 'userrna', '', '', 'user@gmail.com', '$2y$10$LSiVA66s.1vk0UP9SrlBMeeZAWVnEgWxQEl7IimiFuCqhmtaV4IvW', '', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `session_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `session_time`) VALUES
(3, 'fr6ra9ngmjaigljr0elq347ue8', 1574971871),
(4, 'f7qrcrlu7bop55gfb81t7sn0vo', 1574971887),
(5, '3noef5mjeft4rf5cdsh9o1p30k', 1575009984),
(6, 'a6m4bdavii1tm9fnmffkumvd03', 1575009989),
(7, '623pn6bukai9ltubrm2sivo694', 1575018392),
(8, 'dm7oo6msglceck3pidj9nhm845', 1575031241),
(9, 'dt6s17h12qbpn39l1hu62grj0p', 1575085992),
(10, 'kb10c6b5g2i5mua47vi9lr3m8l', 1575299629),
(11, 'f7krtklf8tsuk3gjrd9ilk88am', 1575987765);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
