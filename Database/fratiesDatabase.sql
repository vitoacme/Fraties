-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2016 at 05:08 AM
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` int(10) UNSIGNED NOT NULL,
  `userNSID` varchar(100) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  `userFirstName` varchar(500) NOT NULL,
  `userLastName` varchar(500) NOT NULL,
  `userCollege` varchar(500) NOT NULL,
  `userImagePath` varchar(1000) NOT NULL,
  `userActive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userNSID`, `userPassword`, `userFirstName`, `userLastName`, `userCollege`, `userImagePath`, `userActive`) VALUES
(2, 'acg438', '123', '$FirstName', '$LastName', '$college', '$imagePath', 1),
(54, 'vit655', '123', 'Vishal', 'Tomar', 'Arts & Science', 'UserImages/mypic.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userNSID` (`userNSID`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;