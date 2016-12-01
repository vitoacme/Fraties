-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2016 at 09:16 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `fraties`
--
CREATE DATABASE IF NOT EXISTS `fraties` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fraties`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `commentID` int(254) UNSIGNED NOT NULL,
  `postID` int(254) UNSIGNED NOT NULL,
  `userNSID` varchar(100) NOT NULL,
  `commentText` varchar(150) NOT NULL,
  `commentTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `postID`, `userNSID`, `commentText`, `commentTime`) VALUES
(1, 27, 'vit655', 'hey', '2016-12-01 00:09:55'),
(2, 27, 'vit655', 'hello', '2016-12-01 00:10:07'),
(3, 28, 'acg438', 'hey', '2016-12-01 00:33:57'),
(4, 29, 'acg438', 'comment', '2016-12-01 02:03:45'),
(5, 29, 'acg438', 'comment', '2016-12-01 02:04:26'),
(6, 29, 'acg438', 'comment', '2016-12-01 02:06:07'),
(7, 28, 'acg438', 'hey', '2016-12-01 02:07:17'),
(8, 28, 'acg438', 'hey', '2016-12-01 02:24:08'),
(9, 28, 'acg438', 'hey', '2016-12-01 02:24:12'),
(10, 28, 'acg438', 'hey', '2016-12-01 02:24:13'),
(11, 28, 'acg438', 'hey', '2016-12-01 02:24:13'),
(12, 28, 'acg438', 'hey', '2016-12-01 02:24:14'),
(13, 28, 'acg438', 'hey', '2016-12-01 02:24:14'),
(14, 28, 'acg438', 'hey', '2016-12-01 02:24:14'),
(15, 28, 'acg438', 'hey', '2016-12-01 02:24:14'),
(16, 28, 'acg438', 'hey', '2016-12-01 02:24:14'),
(17, 28, 'acg438', 'hey', '2016-12-01 02:24:15'),
(18, 28, 'acg438', 'hey', '2016-12-01 02:24:15'),
(19, 28, 'acg438', 'hey', '2016-12-01 02:25:11'),
(20, 28, 'acg438', 'hey', '2016-12-01 02:40:42'),
(21, 31, 'acg438', 'sleepy', '2016-12-01 07:55:01'),
(22, 32, 'acg438', 'heeeyyy', '2016-12-01 15:15:42'),
(23, 39, 'acg438', 'comment', '2016-12-01 20:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
CREATE TABLE `followers` (
  `followID` int(254) UNSIGNED NOT NULL,
  `userNSID` varchar(100) NOT NULL,
  `followingNSID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`followID`, `userNSID`, `followingNSID`) VALUES
(11, 'vit655', 'acg438'),
(15, 'acg438', 'vit655'),
(17, 'acg438', 'sym123');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `postID` int(254) UNSIGNED NOT NULL,
  `userNSID` varchar(100) NOT NULL,
  `userCollege` varchar(500) NOT NULL,
  `postText` varchar(150) NOT NULL,
  `postUpVotes` int(254) NOT NULL DEFAULT '0',
  `postDownVotes` int(254) NOT NULL DEFAULT '0',
  `postComments` int(254) NOT NULL DEFAULT '0',
  `postTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `userNSID`, `userCollege`, `postText`, `postUpVotes`, `postDownVotes`, `postComments`, `postTime`) VALUES
(18, 'vit655', 'Edwards School of Business', 'this is the first post!', 1, -1, 0, '2016-12-01 00:13:09'),
(19, 'sym123', 'Arts & Science', 'this is Symon\'s post!', 1, 0, 0, '2016-11-28 21:28:51'),
(20, 'sym123', 'Arts & Science', 'lets move upvote points to 4', 0, 0, 0, '2016-11-28 21:59:22'),
(21, 'sym123', 'Arts & Science', 'try again', 0, 0, 0, '2016-11-28 22:04:17'),
(22, 'sym123', 'Arts & Science', 'try again #2', 0, 0, 0, '2016-11-28 22:04:48'),
(23, 'sym123', 'Arts & Science', 'try again #5', 0, 0, 0, '2016-11-28 22:04:55'),
(24, 'sym123', 'Arts & Science', 'post a post', 0, 0, 0, '2016-11-28 22:11:17'),
(25, 'sym123', 'Arts & Science', 'increase points to 2 but not the upvote', 0, -1, 0, '2016-11-28 22:17:11'),
(26, 'sym123', 'Arts & Science', 'increase points to 2 but not the upvote #2', 1, 0, 0, '2016-11-28 22:17:07'),
(27, 'vit655', 'Edwards School of Business', 'hello', 0, 0, 2, '2016-12-01 00:13:09'),
(28, 'vit655', 'Edwards School of Business', 'blah', 0, -1, 4, '2016-12-01 02:40:43'),
(29, 'acg438', 'Arts & Science', 'post', 0, 0, 3, '2016-12-01 02:06:07'),
(30, 'acg438', 'Arts & Science', 'dedss', 0, -1, 0, '2016-12-01 07:55:43'),
(31, 'acg438', 'Arts & Science', 'tired...', 1, 0, 1, '2016-12-01 07:55:01'),
(32, 'acg438', 'Arts & Science', 'test', 1, 0, 1, '2016-12-01 15:15:42'),
(33, 'acg438', 'Arts & Science', 'hey', 0, 0, 0, '2016-12-01 15:41:40'),
(34, 'acg438', 'Arts & Science', 'hey', 0, -1, 0, '2016-12-01 19:35:48'),
(35, 'acg438', 'Arts & Science', 'blah', 0, 0, 0, '2016-12-01 19:36:35'),
(36, 'acg438', 'Arts & Science', 'A new post ', 0, 0, 0, '2016-12-01 19:39:53'),
(37, 'acg438', 'Arts & Science', 'Another post', 0, 0, 0, '2016-12-01 19:43:39'),
(38, 'acg438', 'Arts & Science', 'Tag post', 0, 0, 0, '2016-12-01 20:06:16'),
(39, 'acg438', 'Arts & Science', 'Hello ', 0, 0, 1, '2016-12-01 20:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `tagID` int(254) UNSIGNED NOT NULL,
  `postID` int(254) UNSIGNED NOT NULL,
  `tagText` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagID`, `postID`, `tagText`) VALUES
(1, 27, 'usask'),
(2, 27, 'test'),
(3, 27, 'fml'),
(4, 30, 'b'),
(5, 30, 'b'),
(6, 30, 'b'),
(7, 31, 'zzz'),
(8, 36, 'tag1'),
(9, 36, 'tag2'),
(10, 36, 'tag3'),
(11, 39, 't1'),
(12, 39, 't2'),
(13, 39, 't3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` int(254) UNSIGNED NOT NULL,
  `userNSID` varchar(100) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  `userFirstName` varchar(500) NOT NULL,
  `userLastName` varchar(500) NOT NULL,
  `userCollege` varchar(500) NOT NULL,
  `userImagePath` varchar(1000) NOT NULL,
  `userPoints` int(254) NOT NULL DEFAULT '0',
  `userUpvotes` int(254) NOT NULL DEFAULT '0',
  `userDownvotes` int(254) NOT NULL DEFAULT '0',
  `userActive` tinyint(1) NOT NULL DEFAULT '0',
  `userFollowers` int(11) NOT NULL DEFAULT '0',
  `userFollowing` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userNSID`, `userPassword`, `userFirstName`, `userLastName`, `userCollege`, `userImagePath`, `userPoints`, `userUpvotes`, `userDownvotes`, `userActive`, `userFollowers`, `userFollowing`) VALUES
(4, 'acg438', '123', 'Anja', 'Gilje', 'Arts & Science', 'UserImages/ninja-dinosaur.jpg', 40, 2, -2, 1, 1, 2),
(3, 'sym123', '123', 'Symon', 'Hernandez', 'Arts & Science', 'UserImages/13690870_1010780319036979_5306694210072325842_n.jpg', 4, 0, 0, 1, 2, 0),
(1, 'vit655', '123', 'Vishal', 'Tomar', 'Edwards School of Business', 'UserImages/12360281_10153291141323133_1246621340571062240_n.jpg', 6, 0, -1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userTag`
--

DROP TABLE IF EXISTS `userTag`;
CREATE TABLE `userTag` (
  `userTagID` int(254) UNSIGNED NOT NULL,
  `postID` int(254) UNSIGNED NOT NULL,
  `tagNSID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userTag`
--

INSERT INTO `userTag` (`userTagID`, `postID`, `tagNSID`) VALUES
(1, 36, 'vit655'),
(2, 38, 'vit655'),
(3, 39, 'sym123');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes` (
  `voteID` int(254) UNSIGNED NOT NULL,
  `postID` int(254) UNSIGNED NOT NULL,
  `userNSID` varchar(100) NOT NULL,
  `vote` tinyint(1) NOT NULL,
  `voteTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`voteID`, `postID`, `userNSID`, `vote`, `voteTime`) VALUES
(80, 18, 'vit655', 1, '2016-11-28 21:17:13'),
(93, 18, 'sym123', 0, '2016-11-28 21:17:46'),
(94, 19, 'sym123', 1, '2016-11-28 21:28:51'),
(114, 26, 'sym123', 1, '2016-11-28 22:17:07'),
(115, 25, 'sym123', 0, '2016-11-28 22:17:11'),
(123, 28, 'vit655', 0, '2016-12-01 00:14:32'),
(124, 31, 'acg438', 1, '2016-12-01 07:54:55'),
(125, 30, 'acg438', 0, '2016-12-01 07:55:43'),
(126, 32, 'acg438', 1, '2016-12-01 15:15:34'),
(127, 34, 'acg438', 0, '2016-12-01 19:35:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `userNSID` (`userNSID`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`followID`),
  ADD KEY `userNSID` (`userNSID`),
  ADD KEY `followingNSID` (`followingNSID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `userNSID` (`userNSID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagID`),
  ADD KEY `postID` (`postID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userNSID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `userNSID` (`userNSID`);

--
-- Indexes for table `userTag`
--
ALTER TABLE `userTag`
  ADD PRIMARY KEY (`userTagID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `tagNSID` (`tagNSID`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`voteID`),
  ADD UNIQUE KEY `postID` (`postID`,`userNSID`),
  ADD KEY `votes_ibfk_2` (`userNSID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(254) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `followID` int(254) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(254) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagID` int(254) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(254) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `userTag`
--
ALTER TABLE `userTag`
  MODIFY `userTagID` int(254) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `voteID` int(254) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userNSID`) REFERENCES `users` (`userNSID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`userNSID`) REFERENCES `users` (`userNSID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`followingNSID`) REFERENCES `users` (`userNSID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userNSID`) REFERENCES `users` (`userNSID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userTag`
--
ALTER TABLE `userTag`
  ADD CONSTRAINT `usertag_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usertag_ibfk_2` FOREIGN KEY (`tagNSID`) REFERENCES `users` (`userNSID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`userNSID`) REFERENCES `users` (`userNSID`) ON DELETE CASCADE ON UPDATE CASCADE;
