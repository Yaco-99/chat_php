-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: mysqldb
-- Generation Time: Dec 18, 2020 at 11:23 AM
-- Server version: 5.7.32
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `text` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `time`, `text`) VALUES
(1, 1, 200, 'testMessage'),
(4, 2, 10, 'test2'),
(5, 1, 600, 'test3'),
(6, 1, 1608032767, 'aze'),
(7, 1, 1608032973, 'hello'),
(9, 1, 1608033633, 'hi'),
(10, 1, 1608033824, 'Moda'),
(16, 1, 1608034278, 'testee'),
(17, 1, 1608034381, 'enter'),
(18, 1, 1608034385, 'click'),
(19, 1, 1608125210, 'blazoedjzqfoiqzhfiogheghoiqhgiviqohvboighqbvgoizhgvioghzOIGEVHOIZHGVIOJHZOIEGjhzioeHFZQUGIEZIUHZEGFIOZEJFOIPJZEOIFHZEIFAZJEFSPDQVJNOPSJNPOJSOPSJVDPOHIOhoisdjvopqjpovhqopjvopjqjvqopsjvopqsdpivhs'),
(20, 1, 1608125390, 'bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla bla'),
(21, 3, 1608288806, 'hello');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
