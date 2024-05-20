-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 05, 2024 at 04:35 AM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skill_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `svc_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `service_status` int(11) NOT NULL,
  PRIMARY KEY (`svc_id`),
  KEY `u_id` (`u_id`),
  KEY `w_id` (`w_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`svc_id`, `u_id`, `w_id`, `service_status`) VALUES
(1, 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `u_activate` int(11) NOT NULL,
  `u_role` varchar(255) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `firstname`, `lastname`, `email`, `password`, `u_activate`, `u_role`) VALUES
(1, 'Shabbir', 'Nazeer', 'example190@gmail.com', '12345', 1, 'customer'),
(2, 'Rashid', 'Ali', 'example44@gmail.com', '112233', 1, 'customer'),
(3, 'Arish', 'Shah', 'example234@gmail.com', '32424', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
CREATE TABLE IF NOT EXISTS `workers` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `chargers` varchar(255) NOT NULL,
  `available_time` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `worker_activity` int(6) NOT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`w_id`, `name`, `nic`, `profession`, `experience`, `chargers`, `available_time`, `email`, `password`, `profile_image`, `worker_activity`) VALUES
(3, 'Hadi', '11232-1232333-1', 'Electrician', '4', '33', '8 pm - 8am', 'citirav894@fulwark.com', '12345', 'content/Electrician/uni-1.png', 1),
(4, 'fsdf', '11232-1232333-1', 'Appliance technician', '2', '33', '8 pm - 8am', 'joret80028@akoption.com', '12345', 'content/Appliance technician/uni-2.png', 1),
(5, 'Hadi', '11232-1232333-1', 'Electrician', '3', '33', '8 pm - 8am', 'jcabola@98usd.com', '54321', 'content/Electrician/uni-3.png', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `services_ibfk_2` FOREIGN KEY (`w_id`) REFERENCES `workers` (`w_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
