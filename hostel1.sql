-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 11:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'admin', 'yashhmehtaa1212@gmail.com', 'Yash@1807', '2024-04-12 09:31:45', '2024-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(5) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_complaint` varchar(800) NOT NULL,
  `date_of_complaint` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_reply` varchar(400) NOT NULL,
  `date_of_adminreply` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `userid`, `student_name`, `student_complaint`, `date_of_complaint`, `admin_reply`, `date_of_adminreply`) VALUES
(3, 21, 'Rekha Mehta', 'Tap water is salty', '2024-09-01 00:32:43', 'Will resolve', '2024-09-04 22:43:07'),
(5, 10, 'Yash Mehta', 'Room Light not working', '2024-09-01 00:39:14', 'Electricain will come and solve the issue in 2 days', '2024-09-01 00:43:11'),
(6, 21, 'John Trevor', 'Mess food is sometimes too salty sometimes too pale. Also hygiene is not maintained properly in mess', '2024-09-03 02:08:24', 'Will take an action soon', '2024-09-03 02:09:05'),
(7, 27, 'Ronny Trevor', 'Shower not working properly', '2024-09-04 22:52:05', 'Issue resolved', '2024-09-06 11:44:08'),
(8, 32, 'Steve Smith', 'Bedsheets are smelling and tap water is muddy', '2024-09-07 03:43:57', '', '0000-00-00 00:00:00'),
(9, 10, 'Yash Mehta', 'Ceiling  plaster if falling', '2024-09-07 19:21:25', 'Will resolve in 3 days', '2024-09-07 21:32:24'),
(10, 26, 'Ronny Jason Trevor', 'Pests are growing in the furniture', '2024-09-07 21:31:12', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_sn` varchar(255) NOT NULL,
  `course_fn` varchar(255) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_sn`, `course_fn`, `posting_date`) VALUES
(1, 'B10992', 'B.TECH', 'Bachelor  of Technology', '2024-06-11 08:31:42'),
(2, 'BCOM1453', 'B.Com', 'Bachelor Of commerce ', '2024-06-11 08:32:46'),
(3, 'BSC12', 'BSC', 'Bachelor  of Science', '2024-06-11 08:33:23'),
(4, 'BC36356', 'BCA', 'Bachelor Of Computer Application', '2024-06-11 08:34:18'),
(5, 'MCA565', 'MCA', 'Master of Computer Application', '2024-06-11 08:34:40'),
(6, 'MBA75', 'MBA', 'Master of Business Administration', '2024-06-11 08:34:59'),
(7, 'BE765', 'BE', 'Bachelor of Engineering', '2024-06-11 08:35:19'),
(8, 'BMS2559', 'BCOM.BBAF', 'Bachelor in accounting and finance', '2024-09-03 16:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `mess_menu`
--

CREATE TABLE `mess_menu` (
  `id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `breakfast` varchar(255) NOT NULL,
  `lunch` varchar(255) NOT NULL,
  `dinner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mess_menu`
--

INSERT INTO `mess_menu` (`id`, `day`, `breakfast`, `lunch`, `dinner`) VALUES
(1, 'Monday', 'Poha, Tea, Coffee', 'Pulao, Dal-Chawal, Chaas', 'Chole-Bhature, Paneer, Tandoori Roti, Dahi vada, Chicken tandoori, Chicken handi'),
(2, 'Tuesday', 'Masala Omlette, Normal Omlette Cheese Sandwich, Tea, Coffee,', 'Jeera Rice and Dal, Roti and Bhindi, Chaas', 'Toor dal and Rice, Roti, Eggplant, Kheer'),
(3, 'Wednesday', 'Scrambled eggs, Vegetable Poha, Tea, Coffee', 'Grilled Meat, Plain rice, Dal, Chaas', 'Chicken curry, Tandoori roti, Rice'),
(4, 'Thursday', 'Puri with Bhaji, Masala Dosa, Boiled Eggs, Coffee, Milkshake', ' Rice, Aloo Gobi, Dal Makhani, Raita, Roti', 'Chapati, Lemon Rice, Veg Biryani, Veg Salad and Rabdi'),
(5, 'Friday', 'Chole Bhature, Poha, Boiled Eggs, Upma, Tea', 'Rice, Sambar, Gobi Manchurian, Salad, Chaas', ' Roti, Fried Rice, Paneer Tikka Masala, Pickle, Kheer'),
(6, 'Saturday', 'Upma, Idli with Coconut Chutney, Scrambled Eggs', 'Rice, Dal Tadka, Vegetable Kofta, Papad, Chaas', 'Chapati, Vegetable Biryani, Mutton Curry, Onion Salad'),
(7, 'Sunday', 'Aloo Paratha with Curd, Bread Omelette, Fruit Salad', 'Rice, Palak Paneer, Masoor Dal, Pickle', 'Chapati, Chicken Pulao, Mixed Vegetable Curry, Cucumber Raita and Papad');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_method` varchar(10) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `card_holder_name` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(5) DEFAULT NULL,
  `cvv` varchar(3) DEFAULT NULL,
  `upi_name` varchar(50) DEFAULT NULL,
  `upi_id` varchar(100) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `user_id`, `payment_method`, `amount`, `card_number`, `card_holder_name`, `expiry_date`, `cvv`, `upi_name`, `upi_id`, `payment_status`, `payment_date`) VALUES
(6, 23, 'card', 29480.00, '283645238754', 'Ram Jayesh Kanojiya', '11/29', '374', NULL, NULL, 'successful', '2024-09-06 16:42:43'),
(7, 27, 'card', 36000.00, '112233445566', 'Ronny Jason Trevor', '03/25', '987', NULL, NULL, 'successful', '2024-09-06 18:01:51'),
(8, 27, 'upi', 48000.00, NULL, NULL, NULL, NULL, 'Ronny Trevor', 'ronnytrevor@okaxis', 'successful', '2024-09-06 18:18:32'),
(9, 32, 'card', 20000.00, '273327291029', 'Steve Johnson Smith', '11/29', '657', NULL, NULL, 'successful', '2024-09-06 22:07:55'),
(10, 10, 'upi', 32000.00, NULL, NULL, NULL, NULL, 'Yash Mehta', 'yashmehta@oksbi', 'successful', '2024-09-07 15:13:49'),
(11, 26, 'upi', 5600.00, NULL, NULL, NULL, NULL, 'Ronny Jason Trevor', 'ronnyjason@okaxis', 'successful', '2024-09-10 12:17:05'),
(12, 29, 'card', 16800.00, '738282621234', 'Shiva Iyer', '12/29', '102', NULL, NULL, 'successful', '2024-09-12 14:59:19'),
(13, 10, 'upi', 8000.00, NULL, NULL, NULL, NULL, 'Yash Mehta', 'yashmehta@oksbi', 'successful', '2024-09-12 18:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `roomno` int(11) NOT NULL,
  `seater` int(11) NOT NULL,
  `feespm` int(11) NOT NULL,
  `foodstatus` int(11) NOT NULL,
  `stayfrom` date NOT NULL,
  `duration` int(11) NOT NULL,
  `totalamt` int(11) DEFAULT NULL,
  `course` varchar(500) NOT NULL,
  `regno` int(11) NOT NULL,
  `firstName` varchar(500) NOT NULL,
  `middleName` varchar(500) NOT NULL,
  `lastName` varchar(500) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `contactno` bigint(11) NOT NULL,
  `emailid` varchar(500) NOT NULL,
  `egycontactno` bigint(11) NOT NULL,
  `guardianName` varchar(500) NOT NULL,
  `guardianRelation` varchar(500) NOT NULL,
  `guardianContactno` bigint(11) NOT NULL,
  `corresAddress` varchar(500) NOT NULL,
  `corresCIty` varchar(500) NOT NULL,
  `corresState` varchar(500) NOT NULL,
  `corresPincode` int(11) NOT NULL,
  `pmntAddress` varchar(500) NOT NULL,
  `pmntCity` varchar(500) NOT NULL,
  `pmnatetState` varchar(500) NOT NULL,
  `pmntPincode` int(11) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `userid`, `roomno`, `seater`, `feespm`, `foodstatus`, `stayfrom`, `duration`, `totalamt`, `course`, `regno`, `firstName`, `middleName`, `lastName`, `gender`, `contactno`, `emailid`, `egycontactno`, `guardianName`, `guardianRelation`, `guardianContactno`, `corresAddress`, `corresCIty`, `corresState`, `corresPincode`, `pmntAddress`, `pmntCity`, `pmnatetState`, `pmntPincode`, `postingDate`, `updationDate`) VALUES
(2, 23, 8000, 1, 3435, 1, '2024-09-25', 8, 29480, 'Bachelor of Engineering', 90114108, 'Ram', 'Jayesh', 'Kanojiya', 'male', 9797232118, 'ram123@gmail.com', 3825237997, 'John', 'Brother', 3862421191, 'D/15,Om riddhi siddhi chs  Sarojini Naidu Rd Siddharth Nagar Mulund West', 'MUMBAI SUBURBAN', 'Maharashtra', 400080, 'D/15,Om riddhi siddhi chs  Sarojini Naidu Rd Siddharth Nagar Mulund West', 'MUMBAI SUBURBAN', 'Maharashtra', 400080, '2024-09-06 16:40:36', ''),
(3, 27, 201, 2, 6000, 1, '2024-09-25', 8, 50000, 'Bachelor  of Science', 11881189, 'Ronny', 'Jason', 'Trevor', 'female', 8467067343, 'ronny123@gmail.com', 7575979596, 'Jennifer', 'Mother', 3862421191, 'D/15,Om riddhi siddhi chs  Sarojini Naidu Rd Siddharth Nagar Mulund West', 'MUMBAI SUBURBAN', 'Maharashtra', 400080, 'D/15,Om riddhi siddhi chs  Sarojini Naidu Rd Siddharth Nagar Mulund West', 'MUMBAI SUBURBAN', 'Maharashtra', 400080, '2024-09-06 18:00:53', ''),
(9, 29, 69, 4, 2100, 0, '2024-09-22', 8, 16800, 'Bachelor Of Computer Application', 37486362, 'Ronny', 'Jason', 'Trevor', 'male', 6758612983, 'shiva@gmail.com', 9249294771, 'Shivani', 'Mother', 6583583479, 'Tambe Nagar, RRT Road', 'Mulund', 'Maharashtra', 400080, 'Tambe Nagar, RRT Road', 'Mulund', 'Maharashtra', 400080, '2024-09-12 14:56:41', ''),
(12, 10, 1200, 5, 1000, 1, '2024-09-17', 8, 10000, 'Bachelor  of Technology', 10806121, 'Yash', 'Kuldeep', 'Mehta', 'male', 9321788548, 'test@gmail.com', 3825237993, 'Rekha', 'Mother', 6359735310, 'D/15,Om Riddhi Siddhi CHSL,Near Shanti Industrial Estate,SN Road, Mulund West', 'Mumbai suburban', 'Maharashtra', 400080, 'D/15,Om Riddhi Siddhi CHSL,Near Shanti Industrial Estate,SN Road, Mulund West', 'Mumbai suburban', 'Maharashtra', 400080, '2024-08-07 02:11:36', ''),
(13, 24, 794, 3, 4599, 1, '2024-08-19', 11, 52589, 'Bachelor  of Technology', 90111478, 'Yash', 'Prakash', 'Mehta', 'female', 6458375129, 'yashmehtaa17182@gmail.com', 3789715693, 'Rekha', 'Mother', 7481735699, 'D/15,Om Riddhi Siddhi CHSL,Near Shanti Industrial Estate,SN Road, Mulund West', 'Mumbai suburban', 'Maharashtra', 400080, 'D/15,Om Riddhi Siddhi CHSL,Near Shanti Industrial Estate,SN Road, Mulund West', 'Mumbai suburban', 'Maharashtra', 400080, '2024-08-30 07:04:45', ''),
(17, 21, 1000, 2, 6000, 1, '2024-09-24', 10, 64000, 'Master of Business Administration', 29728414, 'Rekha', 'Kuldeep', 'Mehta', 'female', 9930689665, 'yashhmehtaa1807@gmail.com', 3279599357, 'John', 'Husband', 7124724922, 'D/15,Om riddhi siddhi chs  Sarojini Naidu Rd Siddharth Nagar Mulund West', 'MUMBAI SUBURBAN', 'Maharashtra', 400080, 'D/15,Om riddhi siddhi chs  Sarojini Naidu Rd Siddharth Nagar Mulund West', 'MUMBAI SUBURBAN', 'Maharashtra', 400080, '2024-09-02 20:35:53', ''),
(23, 32, 132, 5, 2000, 0, '2024-09-23', 10, 20000, 'Bachelor in accounting and finance', 37486393, 'Steve', 'Johnson', 'Smith', 'male', 8352732083, 'steve@gmail.com', 7575979595, 'John', 'Brother', 8734562390, 'Tambe Nagr\r\nOm Riddhi Siddhi', 'Mulund', 'Maharashtra', 400080, 'Tambe Nagr\r\nOm Riddhi Siddhi', 'Mulund', 'Maharashtra', 400080, '2024-09-05 15:18:15', ''),
(24, 26, 300, 3, 1200, 1, '2024-09-12', 3, 5600, 'Bachelor  of Science', 37486350, 'Ronny', 'Jason', 'Trevor', 'male', 9867500863, 'ronny@gmail.com', 3825237990, 'Jessica', 'Mother', 3862421195, 'D/15,Om riddhi siddhi chs  Sarojini Naidu Rd Siddharth Nagar Mulund West', 'MUMBAI SUBURBAN', 'Maharashtra', 400080, 'D/15,Om riddhi siddhi chs  Sarojini Naidu Rd Siddharth Nagar Mulund West', 'MUMBAI SUBURBAN', 'Maharashtra', 400080, '2024-09-05 20:11:26', '');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `seater` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `seater`, `room_no`, `fees`, `posting_date`) VALUES
(1, 5, 100, 8000, '2024-05-11 11:45:43'),
(2, 2, 201, 6000, '2024-05-11 14:30:47'),
(3, 2, 200, 6000, '2024-05-11 14:30:58'),
(4, 3, 112, 4000, '2024-05-11 14:31:07'),
(5, 5, 132, 2000, '2024-05-11 14:31:15'),
(7, 3, 300, 1200, '2024-06-01 09:10:17'),
(8, 4, 69, 2100, '2024-06-21 12:56:41'),
(9, 2, 1000, 6000, '2024-08-20 03:03:47'),
(12, 2, 901, 10000, '2024-08-20 10:39:14'),
(13, 4, 1900, 4739, '2024-08-20 10:40:16'),
(14, 3, 794, 4599, '2024-08-28 00:07:15'),
(16, 5, 1200, 1000, '2024-09-03 14:44:18'),
(17, 1, 8000, 3400, '2024-09-03 14:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `State` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `State`) VALUES
(1, 'Andaman and Nicobar Island (UT)'),
(2, 'Andhra Pradesh'),
(3, 'Arunachal Pradesh'),
(4, 'Assam'),
(5, 'Bihar'),
(6, 'Chandigarh (UT)'),
(7, 'Chhattisgarh'),
(8, 'Dadra and Nagar Haveli (UT)'),
(9, 'Daman and Diu (UT)'),
(10, 'Delhi (NCT)'),
(11, 'Goa'),
(12, 'Gujarat'),
(13, 'Haryana'),
(14, 'Himachal Pradesh'),
(15, 'Jammu and Kashmir'),
(16, 'Jharkhand'),
(17, 'Karnataka'),
(18, 'Kerala'),
(19, 'Lakshadweep (UT)'),
(20, 'Madhya Pradesh'),
(21, 'Maharashtra'),
(22, 'Manipur'),
(23, 'Meghalaya'),
(24, 'Mizoram'),
(25, 'Nagaland'),
(26, 'Odisha'),
(27, 'Puducherry (UT)'),
(28, 'Punjab'),
(29, 'Rajastha'),
(30, 'Sikkim'),
(31, 'Tamil Nadu'),
(32, 'Telangana'),
(33, 'Tripura'),
(34, 'Uttarakhand'),
(35, 'EPE'),
(36, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `temp_registration`
--

CREATE TABLE `temp_registration` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `roomno` int(11) NOT NULL,
  `seater` int(11) NOT NULL,
  `feespm` int(11) NOT NULL,
  `foodstatus` int(11) NOT NULL,
  `stayfrom` date NOT NULL,
  `duration` int(11) NOT NULL,
  `totalamt` int(11) DEFAULT NULL,
  `course` varchar(500) NOT NULL,
  `regno` int(11) NOT NULL,
  `firstName` varchar(500) NOT NULL,
  `middleName` varchar(500) NOT NULL,
  `lastName` varchar(500) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `contactno` bigint(11) NOT NULL,
  `emailid` varchar(500) NOT NULL,
  `egycontactno` bigint(11) NOT NULL,
  `guardianName` varchar(500) NOT NULL,
  `guardianRelation` varchar(500) NOT NULL,
  `guardianContactno` bigint(11) NOT NULL,
  `corresAddress` varchar(500) NOT NULL,
  `corresCIty` varchar(500) NOT NULL,
  `corresState` varchar(500) NOT NULL,
  `corresPincode` int(11) NOT NULL,
  `pmntAddress` varchar(500) NOT NULL,
  `pmntCity` varchar(500) NOT NULL,
  `pmnatetState` varchar(500) NOT NULL,
  `pmntPincode` int(11) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `userIp`, `loginTime`) VALUES
(7, 10, 'test@gmail.com', 0x3a3a31, '2024-06-19 08:11:34'),
(8, 10, 'test@gmail.com', 0x3a3a31, '2024-06-19 08:20:09'),
(9, 10, 'test@gmail.com', 0x3a3a31, '2024-06-19 09:24:47'),
(10, 10, 'test@gmail.com', 0x3a3a31, '2024-06-21 02:59:44'),
(11, 10, 'test@gmail.com', 0x3a3a31, '2024-06-21 03:19:08'),
(12, 10, 'test@gmail.com', 0x3a3a31, '2024-06-21 03:25:32'),
(13, 10, 'test@gmail.com', 0x3a3a31, '2024-06-21 07:27:50'),
(14, 10, 'test@gmail.com', 0x3a3a31, '2024-06-21 08:30:00'),
(15, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-06-21 12:48:15'),
(16, 10, 'test@gmail.com', 0x3a3a31, '2024-06-21 15:09:42'),
(17, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-06-22 08:11:42'),
(18, 10, 'test@gmail.com', 0x3a3a31, '2024-06-25 07:52:01'),
(19, 10, 'test@gmail.com', 0x3a3a31, '2024-06-25 08:45:08'),
(20, 10, 'test@gmail.com', 0x3a3a31, '2024-06-25 10:42:19'),
(21, 10, 'test@gmail.com', 0x3a3a31, '2024-06-25 10:50:40'),
(22, 10, 'test@gmail.com', 0x3a3a31, '2024-06-25 12:05:23'),
(23, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-06-25 12:07:23'),
(24, 10, 'test@gmail.com', 0x3a3a31, '2024-06-26 13:28:32'),
(25, 10, 'test@gmail.com', 0x3a3a31, '2024-06-26 13:39:25'),
(26, 10, 'test@gmail.com', 0x3a3a31, '2024-06-28 12:02:08'),
(27, 10, 'test@gmail.com', 0x3a3a31, '2024-07-09 01:03:15'),
(28, 10, 'test@gmail.com', 0x3a3a31, '2024-07-12 07:51:25'),
(29, 10, 'test@gmail.com', 0x3a3a31, '2024-07-20 09:57:16'),
(30, 10, 'test@gmail.com', 0x3a3a31, '2024-07-20 10:47:03'),
(31, 10, 'test@gmail.com', 0x3a3a31, '2024-07-22 07:29:13'),
(32, 22, 'saikesh@gmail.com', 0x3a3a31, '2024-07-22 09:06:21'),
(33, 10, 'test@gmail.com', 0x3a3a31, '2024-07-22 10:59:57'),
(34, 10, 'test@gmail.com', 0x3a3a31, '2024-07-26 12:03:52'),
(35, 10, 'test@gmail.com', 0x3a3a31, '2024-07-27 05:48:17'),
(36, 10, 'test@gmail.com', 0x3a3a31, '2024-07-27 07:11:21'),
(37, 10, 'test@gmail.com', 0x3a3a31, '2024-07-27 08:32:27'),
(38, 10, 'test@gmail.com', 0x3a3a31, '2024-07-27 08:39:42'),
(39, 10, 'test@gmail.com', 0x3a3a31, '2024-07-30 12:51:15'),
(40, 10, 'test@gmail.com', 0x3a3a31, '2024-08-06 09:39:21'),
(41, 10, 'test@gmail.com', 0x3a3a31, '2024-08-06 09:48:57'),
(42, 10, 'test@gmail.com', 0x3a3a31, '2024-08-06 09:49:48'),
(43, 10, 'test@gmail.com', 0x3a3a31, '2024-08-06 10:04:04'),
(44, 10, 'test@gmail.com', 0x3a3a31, '2024-08-06 10:28:05'),
(45, 10, 'test@gmail.com', 0x3a3a31, '2024-08-06 10:49:32'),
(46, 10, 'test@gmail.com', 0x3a3a31, '2024-08-06 10:52:44'),
(47, 10, 'test@gmail.com', 0x3a3a31, '2024-08-06 10:53:37'),
(48, 10, 'test@gmail.com', 0x3a3a31, '2024-08-06 13:43:07'),
(49, 23, 'ram123@gmail.com', 0x3a3a31, '2024-08-06 14:22:37'),
(50, 23, 'ram123@gmail.com', 0x3a3a31, '2024-08-06 14:24:22'),
(51, 10, 'test@gmail.com', 0x3a3a31, '2024-08-07 02:09:30'),
(52, 10, 'test@gmail.com', 0x3a3a31, '2024-08-07 02:17:18'),
(53, 10, 'test@gmail.com', 0x3a3a31, '2024-08-07 02:21:52'),
(54, 10, 'test@gmail.com', 0x3a3a31, '2024-08-07 02:26:22'),
(55, 10, 'test@gmail.com', 0x3a3a31, '2024-08-07 02:29:16'),
(56, 10, 'test@gmail.com', 0x3a3a31, '2024-08-07 02:31:29'),
(57, 10, 'test@gmail.com', 0x3a3a31, '2024-08-07 12:14:04'),
(58, 10, 'test@gmail.com', 0x3a3a31, '2024-08-12 08:23:14'),
(59, 10, 'test@gmail.com', 0x3a3a31, '2024-08-12 08:31:03'),
(60, 10, 'test@gmail.com', 0x3a3a31, '2024-08-12 08:41:26'),
(61, 10, 'test@gmail.com', 0x3a3a31, '2024-08-12 09:44:17'),
(62, 10, 'test@gmail.com', 0x3a3a31, '2024-08-12 14:27:56'),
(63, 10, 'test@gmail.com', 0x3a3a31, '2024-08-12 14:36:53'),
(64, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-08-12 14:57:19'),
(65, 10, 'test@gmail.com', 0x3a3a31, '2024-08-12 15:19:47'),
(66, 10, 'test@gmail.com', 0x3a3a31, '2024-08-12 15:39:45'),
(67, 10, 'test@gmail.com', 0x3a3a31, '2024-08-13 03:09:47'),
(68, 10, 'test@gmail.com', 0x3a3a31, '2024-08-17 08:16:59'),
(69, 10, 'test@gmail.com', 0x3a3a31, '2024-08-17 08:17:39'),
(70, 10, 'test@gmail.com', 0x3a3a31, '2024-08-17 09:58:43'),
(71, 10, 'test@gmail.com', 0x3a3a31, '2024-08-17 13:38:12'),
(72, 10, 'test@gmail.com', 0x3a3a31, '2024-08-17 13:38:35'),
(73, 10, 'test@gmail.com', 0x3a3a31, '2024-08-17 13:45:14'),
(74, 10, 'test@gmail.com', 0x3a3a31, '2024-08-17 13:46:59'),
(75, 10, 'test@gmail.com', 0x3a3a31, '2024-08-17 13:54:28'),
(76, 10, 'test@gmail.com', 0x3a3a31, '2024-08-17 13:55:32'),
(77, 10, 'test@gmail.com', 0x3a3a31, '2024-08-18 08:13:00'),
(78, 10, 'test@gmail.com', 0x3a3a31, '2024-08-18 10:25:23'),
(79, 10, 'test@gmail.com', 0x3a3a31, '2024-08-18 10:37:09'),
(80, 10, 'test@gmail.com', 0x3a3a31, '2024-08-19 01:33:28'),
(81, 10, 'test@gmail.com', 0x3a3a31, '2024-08-20 03:02:59'),
(82, 10, 'test@gmail.com', 0x3a3a31, '2024-08-29 23:57:34'),
(83, 10, 'test@gmail.com', 0x3a3a31, '2024-08-30 00:12:36'),
(84, 10, 'test@gmail.com', 0x3a3a31, '2024-08-30 05:01:38'),
(85, 10, 'test@gmail.com', 0x3a3a31, '2024-08-30 06:44:57'),
(86, 24, 'yashmehtaa17182@gmail.com', 0x3a3a31, '2024-08-30 07:03:53'),
(87, 10, 'test@gmail.com', 0x3a3a31, '2024-08-30 07:28:55'),
(88, 10, 'test@gmail.com', 0x3a3a31, '2024-08-30 07:49:54'),
(89, 10, 'test@gmail.com', 0x3a3a31, '2024-08-30 08:59:17'),
(90, 10, 'test@gmail.com', 0x3a3a31, '2024-08-30 09:03:56'),
(91, 10, 'test@gmail.com', 0x3a3a31, '2024-08-31 11:39:27'),
(92, 10, 'test@gmail.com', 0x3a3a31, '2024-08-31 11:42:47'),
(93, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-08-31 13:32:11'),
(94, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-08-31 13:36:57'),
(95, 10, 'test@gmail.com', 0x3a3a31, '2024-08-31 13:38:07'),
(96, 10, 'test@gmail.com', 0x3a3a31, '2024-08-31 13:43:34'),
(97, 10, 'test@gmail.com', 0x3a3a31, '2024-08-31 14:36:32'),
(98, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 06:15:26'),
(99, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 07:49:37'),
(100, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 08:36:25'),
(101, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 08:38:44'),
(102, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 08:50:58'),
(103, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-09-01 09:08:49'),
(104, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-09-01 09:10:04'),
(105, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 10:11:48'),
(106, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 10:29:22'),
(107, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 10:38:34'),
(108, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 10:47:08'),
(109, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 10:51:04'),
(110, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 11:26:41'),
(111, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 11:52:52'),
(112, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 12:24:13'),
(113, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 12:35:38'),
(114, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 12:36:55'),
(115, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 12:37:57'),
(116, 10, 'test@gmail.com', 0x3a3a31, '2024-09-01 12:40:56'),
(117, 10, 'test@gmail.com', 0x3a3a31, '2024-09-02 02:31:38'),
(118, 10, 'test@gmail.com', 0x3a3a31, '2024-09-02 19:29:14'),
(119, 10, 'test@gmail.com', 0x3a3a31, '2024-09-02 19:48:59'),
(120, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-09-02 20:31:06'),
(121, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-09-03 13:41:52'),
(122, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-09-03 14:09:16'),
(123, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-09-03 14:31:26'),
(124, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-09-03 19:08:48'),
(125, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-09-04 13:24:06'),
(126, 27, 'ronny123@gmail.com', 0x3a3a31, '2024-09-04 17:20:56'),
(127, 10, 'test@gmail.com', 0x3a3a31, '2024-09-04 18:49:48'),
(128, 10, 'test@gmail.com', 0x3a3a31, '2024-09-05 06:16:47'),
(129, 10, 'test@gmail.com', 0x3a3a31, '2024-09-05 06:26:43'),
(130, 10, 'test@gmail.com', 0x3a3a31, '2024-09-05 06:48:18'),
(131, 10, 'test@gmail.com', 0x3a3a31, '2024-09-05 07:05:41'),
(132, 27, 'ronny123@gmail.com', 0x3a3a31, '2024-09-05 14:00:29'),
(133, 32, 'steve@gmail.com', 0x3a3a31, '2024-09-05 15:20:03'),
(134, 10, 'test@gmail.com', 0x3a3a31, '2024-09-05 16:14:53'),
(135, 29, 'shiva@gmail.com', 0x3a3a31, '2024-09-05 16:18:44'),
(136, 26, 'ronny@gmail.com', 0x3a3a31, '2024-09-05 20:01:13'),
(137, 26, 'ronny@gmail.com', 0x3a3a31, '2024-09-05 20:03:28'),
(138, 26, 'ronny@gmail.com', 0x3a3a31, '2024-09-05 20:14:58'),
(139, 26, 'ronny@gmail.com', 0x3a3a31, '2024-09-05 20:24:46'),
(140, 23, 'ram123@gmail.com', 0x3a3a31, '2024-09-06 14:49:06'),
(141, 27, 'ronny123@gmail.com', 0x3a3a31, '2024-09-06 17:57:53'),
(142, 27, 'ronny123@gmail.com', 0x3a3a31, '2024-09-06 19:14:34'),
(143, 32, 'steve@gmail.com', 0x3a3a31, '2024-09-06 22:05:29'),
(144, 32, 'steve@gmail.com', 0x3a3a31, '2024-09-06 22:14:46'),
(145, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 06:20:21'),
(146, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 06:40:36'),
(147, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 09:19:56'),
(148, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 11:26:08'),
(149, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 14:29:48'),
(150, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 14:38:41'),
(151, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 14:39:25'),
(152, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 14:45:22'),
(153, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 14:51:01'),
(154, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 14:55:46'),
(155, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 15:03:19'),
(156, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 15:08:16'),
(157, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 15:08:50'),
(158, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 15:10:27'),
(159, 26, 'ronny@gmail.com', 0x3a3a31, '2024-09-07 15:58:47'),
(160, 26, 'ronny@gmail.com', 0x3a3a31, '2024-09-07 16:02:58'),
(161, 10, 'test@gmail.com', 0x3a3a31, '2024-09-07 16:03:16'),
(162, 29, 'shiva@gmail.com', 0x3a3a31, '2024-09-07 18:51:40'),
(163, 29, 'shiva@gmail.com', 0x3a3a31, '2024-09-07 19:16:48'),
(164, 29, 'shiva@gmail.com', 0x3a3a31, '2024-09-07 19:25:31'),
(165, 29, 'shiva@gmail.com', 0x3a3a31, '2024-09-07 19:29:15'),
(166, 26, 'ronny@gmail.com', 0x3a3a31, '2024-09-09 08:20:54'),
(167, 10, 'test@gmail.com', 0x3a3a31, '2024-09-09 21:00:02'),
(168, 29, 'shiva@gmail.com', 0x3a3a31, '2024-09-10 07:32:27'),
(169, 10, 'test@gmail.com', 0x3a3a31, '2024-09-10 09:58:11'),
(170, 29, 'shiva@gmail.com', 0x3a3a31, '2024-09-10 10:13:02'),
(171, 26, 'ronny@gmail.com', 0x3a3a31, '2024-09-10 12:00:43'),
(172, 26, 'ronny@gmail.com', 0x3a3a31, '2024-09-10 12:13:53'),
(173, 24, 'yashmehtaa17182@gmail.com', 0x3a3a31, '2024-09-10 12:46:08'),
(174, 32, 'steve@gmail.com', 0x3a3a31, '2024-09-10 13:00:42'),
(175, 21, 'yashhmehtaa1807@gmail.com', 0x3a3a31, '2024-09-10 14:01:26'),
(176, 32, 'steve@gmail.com', 0x3a3a31, '2024-09-10 14:03:44'),
(177, 32, 'steve@gmail.com', 0x3a3a31, '2024-09-10 14:05:14'),
(178, 26, 'ronny@gmail.com', 0x3a3a31, '2024-09-10 20:06:41'),
(179, 10, 'test@gmail.com', 0x3a3a31, '2024-09-11 12:18:02'),
(180, 29, 'shiva@gmail.com', 0x3a3a31, '2024-09-12 14:54:53'),
(181, 32, 'steve@gmail.com', 0x3a3a31, '2024-09-12 15:18:20'),
(182, 10, 'test@gmail.com', 0x3a3a31, '2024-09-12 18:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `id` int(11) NOT NULL,
  `regNo` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contactNo` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(45) NOT NULL,
  `passUdateDate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`id`, `regNo`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate`) VALUES
(10, '10806121', 'Yash', 'Kuldeep', 'Mehta', 'male', 9321788548, 'test@gmail.com', 'Yash@123', '2024-06-21 17:21:33', '05-09-2024 12:20:33', '05-09-2024 12:22:13'),
(21, '29728414', 'Rekha', 'Kuldeep', 'Mehta', 'female', 9930689665, 'yashhmehtaa1807@gmail.com', 'Yash@12345', '2024-06-19 12:29:38', '03-09-2024 07:31:51', '03-09-2024 07:36:49'),
(23, '90114108', 'Ram', 'Jayesh', 'Kanojiya', 'male', 9797232118, 'ram123@gmail.com', '9797232118', '2024-08-06 14:19:09', '', ''),
(24, '90111478', 'Yash', 'Prakash', 'Mehta', 'female', 6458375129, 'yashmehtaa17182@gmail.com', 'Test@1234', '2024-08-30 07:02:58', '', ''),
(26, '37486350', 'Ronny', 'Jason', 'Trevor', 'male', 9867500863, 'ronny@gmail.com', 'Ronny@123', '2024-09-04 14:38:36', '', '06-09-2024 01:55:41'),
(27, '11881189', 'Ronny', 'Jason', 'Trevor', 'female', 8467067343, 'ronny123@gmail.com', '8467067343', '2024-09-04 15:08:06', '', ''),
(29, '37486362', 'Ronny', 'Jason', 'Trevor', 'male', 6758612983, 'shiva@gmail.com', 'Shiva@123', '2024-09-04 15:44:46', '', '10-09-2024 04:56:47'),
(32, '37486393', 'Steve', 'Johnson', 'Smith', 'male', 8352732083, 'steve@gmail.com', 'Steve@123', '2024-09-05 15:17:04', '', '07-09-2024 03:45:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mess_menu`
--
ALTER TABLE `mess_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_registration`
--
ALTER TABLE `temp_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mess_menu`
--
ALTER TABLE `mess_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `temp_registration`
--
ALTER TABLE `temp_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
