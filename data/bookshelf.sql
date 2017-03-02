-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2017 at 11:45 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bookshelf`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL,
  `book_isbn` int(11) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `book_author` varchar(50) NOT NULL,
  `book_category` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_isbn`, `book_title`, `book_author`, `book_category`) VALUES
(17, 123, 'Tamil', 'Raja', 'Pearson'),
(18, 456, 'German', 'Raja', 'Pearson');

-- --------------------------------------------------------

--
-- Table structure for table `book_rating`
--

CREATE TABLE IF NOT EXISTS `book_rating` (
  `rating_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating_number` int(11) NOT NULL,
  `total_points` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Block, 0 = Unblock'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_rating`
--

INSERT INTO `book_rating` (`rating_id`, `book_id`, `rating_number`, `total_points`, `created`, `modified`, `status`) VALUES
(6, 16, 3, 10, '2017-03-02 20:36:58', '2017-03-02 20:37:12', 1),
(8, 17, 1, 5, '2017-03-02 23:30:49', '2017-03-02 23:30:49', 1),
(9, 18, 1, 4, '2017-03-02 23:30:50', '2017-03-02 23:30:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_rating`
--
ALTER TABLE `book_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `book_rating`
--
ALTER TABLE `book_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
