-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2016 at 09:22 PM
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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `postID` int(254) UNSIGNED NOT NULL,
  `userNSID` varchar(100) NOT NULL,
  `postText` varchar(150) NOT NULL,
  `postUpVotes` int(254) NOT NULL DEFAULT '0',
  `postDownVotes` int(254) NOT NULL DEFAULT '0',
  `postComments` int(254) NOT NULL DEFAULT '0',
  `postTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `userNSID`, `postText`, `postUpVotes`, `postDownVotes`, `postComments`, `postTime`) VALUES
(12, 'sym123', 'haha this is Smon first post!', 10, 0, 0, '2016-11-28 20:22:04'),
(14, 'sym123', 'hi vito', 15, -1, 0, '2016-11-28 20:21:54'),
(15, 'vit655', 'omg hi ', 24, -1, 3, '2016-11-28 20:22:06'),
(16, 'vit655', 'this is a pain in asss', 42, -12, 0, '2016-11-28 20:22:01'),
(17, 'vit655', 'succes with no reloading!', 37, -13, 0, '2016-11-28 20:21:55');

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
  `userPoints` int(224) NOT NULL DEFAULT '0',
  `userFollowers` int(224) NOT NULL DEFAULT '0',
  `userFollowing` int(224) NOT NULL DEFAULT '0',
  `userActive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userNSID`, `userPassword`, `userFirstName`, `userLastName`, `userCollege`, `userImagePath`, `userPoints`, `userFollowers`, `userFollowing`, `userActive`) VALUES
(3, 'sym123', '123', 'Symon', 'Hernandez', 'Arts & Science', 'UserImages/13690870_1010780319036979_5306694210072325842_n.jpg', 0, 0, 0, 1),
(1, 'vit655', '123', 'Vishal', 'Tomar', 'Arts & Science', 'UserImages/mypic.jpg', 0, 0, 0, 1);

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
(58, 14, 'vit655', 0, '2016-11-28 20:21:54'),
(59, 17, 'vit655', 0, '2016-11-28 20:21:55'),
(66, 16, 'vit655', 1, '2016-11-28 20:22:01'),
(70, 12, 'vit655', 1, '2016-11-28 20:22:04'),
(76, 15, 'vit655', 0, '2016-11-28 20:22:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `userNSID` (`userNSID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userNSID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `userNSID` (`userNSID`);

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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(254) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(254) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `voteID` int(254) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userNSID`) REFERENCES `users` (`userNSID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`userNSID`) REFERENCES `users` (`userNSID`) ON DELETE CASCADE ON UPDATE CASCADE;
