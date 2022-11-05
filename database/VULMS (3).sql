-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2018 at 09:25 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `VULMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(10) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `phone` int(40) NOT NULL,
  `creationdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `firstname`, `lastname`, `username`, `email`, `password`, `phone`, `creationdate`) VALUES
(4, 'biki', 'ghullu', 'biki', 'biki@gmail.com', 'd6819706aec8681f4554ad43190259cb', 414034745, '2018-10-08 00:00:00'),
(5, 'Rachid ', 'Hamadi', 'Rachid', 'Rachid@gmail.com', 'b3fa472c2302a29ca2551667844f16db', 414734674, '2018-10-16 09:46:08'),
(7, 'Wicky', 'Ghullu', 'wickygh', 'wicky@gmail.com', '201b4da8792d4ac770ed8c61f60c090f', 413745758, '2018-10-16 09:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `authorid` int(11) NOT NULL,
  `authorname` varchar(40) NOT NULL,
  `authordate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorid`, `authorname`, `authordate`) VALUES
(4, 'William Shakespeare', '2018-10-17'),
(5, 'Emily Dickinson', '2018-10-17'),
(6, 'Arthur Conan Doyle', '2018-10-17'),
(7, 'Leo Tolstoy', '2018-10-17'),
(8, 'John Donne', '2018-10-17'),
(9, 'William Blake', '2018-10-17'),
(10, 'Charles Dickens', '2018-10-17'),
(11, 'Margaret Thatcher', '2018-10-17'),
(12, 'Lord Byron', '2018-10-17'),
(13, 'Emily Bronte', '2018-10-17'),
(14, 'Harper Lee', '2018-10-18'),
(15, 'Jane Austen', '2018-10-18'),
(16, 'Anne Frank', '2018-10-18'),
(17, 'J.K. Rowling', '2018-10-18'),
(18, 'J.R.R Tolkien', '2018-10-18'),
(19, 'Scott Fitzgerald', '2018-10-18'),
(20, 'E. B. White', '2018-10-18'),
(21, 'Ray Bradbury', '2018-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookid` int(11) NOT NULL,
  `bookname` varchar(150) NOT NULL,
  `authid` varchar(40) NOT NULL,
  `catid` int(11) NOT NULL,
  `isbn` int(100) NOT NULL,
  `bookpublish` varchar(40) NOT NULL,
  `bookadd` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `rstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookid`, `bookname`, `authid`, `catid`, `isbn`, `bookpublish`, `bookadd`, `status`, `rstatus`) VALUES
(30, 'Beach Safari', '4', 29, 2147483647, '2018-10-01', '2018-10-18 06:02:43', 0, 1),
(47, 'The Diary of Anne Frank', '11', 31, 123456783, '2018-10-15', '2018-10-18 06:29:47', 0, 0),
(48, 'Harry Potter and the Sorcerer\'s Stone', '17', 31, 123456784, '2018-10-15', '2018-10-18 06:30:14', 0, 0),
(49, 'Welcome to PHP', '21', 24, 123456785, '2016-10-11', '2018-10-18 06:30:40', 0, 0),
(50, 'The Great Gatsby', '19', 21, 123456787, '2014-10-10', '2018-10-18 06:31:08', 0, 0),
(51, 'The Hobbit', '18', 26, 123456789, '2014-10-24', '2018-10-18 06:31:31', 1, 0),
(56, 'Pride and Prejudice', '15', 22, 123456782, '2018-10-18', '2018-10-18 08:32:42', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bookissue`
--

CREATE TABLE `bookissue` (
  `issueid` int(10) NOT NULL,
  `bookid` int(10) NOT NULL,
  `studentid` int(10) NOT NULL,
  `bookissued` datetime NOT NULL,
  `bookreturned` datetime NOT NULL,
  `returnstatus` int(10) NOT NULL,
  `fine` int(10) NOT NULL,
  `exissue` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookissue`
--

INSERT INTO `bookissue` (`issueid`, `bookid`, `studentid`, `bookissued`, `bookreturned`, `returnstatus`, `fine`, `exissue`) VALUES
(39, 123456789, 45804, '2018-10-18 07:12:21', '0000-00-00 00:00:00', 0, 0, '2018-11-01 00:00:00'),
(42, 123456782, 45800, '2018-10-18 08:32:55', '2018-10-18 08:35:04', 1, 1, '2018-11-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bookreserve`
--

CREATE TABLE `bookreserve` (
  `reserveid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `bookisbn` int(11) NOT NULL,
  `reserved` datetime NOT NULL,
  `due` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookreserve`
--

INSERT INTO `bookreserve` (`reserveid`, `studentid`, `bookisbn`, `reserved`, `due`) VALUES
(21, 45801, 1232, '2018-10-17 13:44:56', '2018-10-19 00:00:00'),
(23, 45800, 2147483647, '2018-10-18 08:55:56', '2018-10-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(40) NOT NULL,
  `categorydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categoryname`, `categorydate`) VALUES
(19, 'Arts and Music', '2018-10-17 14:41:42'),
(20, 'Biographies', '2018-10-17 14:42:06'),
(21, 'Business', '2018-10-17 14:42:11'),
(22, 'Kids', '2018-10-17 14:42:14'),
(23, 'Comics', '2018-10-17 14:42:21'),
(24, 'Computer & Tech', '2018-10-17 14:42:31'),
(25, 'Cooking', '2018-10-17 14:42:37'),
(26, 'Hobbies & Crafts', '2018-10-17 14:42:47'),
(27, 'Edu & Reference', '2018-10-17 14:42:57'),
(28, 'Health & Fitness', '2018-10-17 14:43:11'),
(29, 'History', '2018-10-17 14:43:18'),
(31, 'Literature & Fiction', '2018-10-17 14:43:44'),
(32, 'Socia Sciences', '2018-10-17 14:43:55'),
(33, 'Philosophy', '2018-10-18 07:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `id` int(11) NOT NULL,
  `studentid` int(10) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(50) NOT NULL,
  `registrationdate` datetime DEFAULT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`id`, `studentid`, `firstname`, `lastname`, `password`, `email`, `phone`, `registrationdate`, `status`) VALUES
(25, 45800, 'biki', 'ghullu', 'd6819706aec8681f4554ad43190259cb', 'biki@gmail.com', 414034745, '2018-10-11 08:26:19', 1),
(26, 45801, 'wicky', 'wicky', '201b4da8792d4ac770ed8c61f60c090f', 'wicky@gmail.com', 414034455, '2018-10-11 08:52:00', 1),
(27, 45802, 'Biki', 'Biki', 'e6ba9ae67a3f4d565eb788dfbe8df560', 'biki@gmail.com', 4580321, '2018-10-16 08:30:51', 1),
(28, 45804, 'Susma', 'Kc', 'fb2803e777079d2e25dc0cf01ecda6a8', 'susma@gmail.com', 2147483647, '2018-10-16 09:59:15', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorid`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookid`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `bookissue`
--
ALTER TABLE `bookissue`
  ADD PRIMARY KEY (`issueid`);

--
-- Indexes for table `bookreserve`
--
ALTER TABLE `bookreserve`
  ADD PRIMARY KEY (`reserveid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`studentid`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `authorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `bookissue`
--
ALTER TABLE `bookissue`
  MODIFY `issueid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `bookreserve`
--
ALTER TABLE `bookreserve`
  MODIFY `reserveid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
