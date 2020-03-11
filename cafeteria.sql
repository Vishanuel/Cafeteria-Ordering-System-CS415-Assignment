-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 11, 2020 at 02:51 PM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `cos_order`
--

DROP TABLE IF EXISTS `cos_order`;
CREATE TABLE IF NOT EXISTS `cos_order` (
  `Cos_Order_Num` int(11) NOT NULL AUTO_INCREMENT,
  `Employee_ID` int(11) NOT NULL,
  `Cos_Order_Date_Time` date NOT NULL,
  `Cos_Meal_Date_Time` date NOT NULL,
  `Cos_Order_Meal_Status` varchar(255) NOT NULL,
  `Cos_Order_Cost` int(11) NOT NULL,
  `Cos_Order_Payment_Method` varchar(45) NOT NULL,
  PRIMARY KEY (`Cos_Order_Num`),
  KEY `Idx_Emp_ID` (`Employee_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cos_order`
--

INSERT INTO `cos_order` (`Cos_Order_Num`, `Employee_ID`, `Cos_Order_Date_Time`, `Cos_Meal_Date_Time`, `Cos_Order_Meal_Status`, `Cos_Order_Cost`, `Cos_Order_Payment_Method`) VALUES
(1, 1234, '2020-03-10', '2020-03-11', 'Approved', 12, 'payroll'),
(2, 1234, '2020-03-11', '2020-03-11', 'Approved', 5, 'cash'),
(3, 1234, '2020-03-11', '2020-03-11', 'Approved', 35, 'cash'),
(4, 1234, '2020-03-11', '2020-03-11', 'Approved', 5, 'payroll'),
(5, 1234, '2020-03-11', '2020-03-11', 'orderingg', 5, 'NN');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_instruction`
--

DROP TABLE IF EXISTS `delivery_instruction`;
CREATE TABLE IF NOT EXISTS `delivery_instruction` (
  `D_Instruction_ID` int(11) NOT NULL AUTO_INCREMENT,
  `D_Location` varchar(45) NOT NULL,
  `D_Time_Window` varchar(45) NOT NULL,
  `Cos_Order_Num` int(11) NOT NULL,
  PRIMARY KEY (`D_Instruction_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `Location_ID` int(11) NOT NULL,
  `Location_Name` varchar(45) NOT NULL,
  PRIMARY KEY (`Location_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Location_ID`, `Location_Name`) VALUES
(1, 'ICT Building A'),
(2, 'ICT Building B');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `Menu_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Restaurant_ID` int(11) NOT NULL,
  `Menu_Date` date NOT NULL,
  PRIMARY KEY (`Menu_ID`),
  KEY `Idx_Restaurant_Menu_ID` (`Restaurant_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Menu_ID`, `Restaurant_ID`, `Menu_Date`) VALUES
(1, 1, '2020-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `menu_food`
--

DROP TABLE IF EXISTS `menu_food`;
CREATE TABLE IF NOT EXISTS `menu_food` (
  `Menu_Food_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Menu_ID` int(11) DEFAULT NULL,
  `Menu_Food_Item_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Menu_Food_ID`),
  KEY `Idx2_Menu_ID` (`Menu_ID`),
  KEY `Idx2_Menu_Food_Item_ID` (`Menu_Food_Item_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_food`
--

INSERT INTO `menu_food` (`Menu_Food_ID`, `Menu_ID`, `Menu_Food_Item_ID`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu_food_item`
--

DROP TABLE IF EXISTS `menu_food_item`;
CREATE TABLE IF NOT EXISTS `menu_food_item` (
  `Menu_Food_Item_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Food_Name` varchar(255) NOT NULL,
  `Food_Desc` varchar(510) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(3,2) NOT NULL,
  PRIMARY KEY (`Menu_Food_Item_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_food_item`
--

INSERT INTO `menu_food_item` (`Menu_Food_Item_ID`, `Food_Name`, `Food_Desc`, `Quantity`, `Price`) VALUES
(1, 'Dhal and Bhaat', 'Dhal ', 7, '5.00'),
(2, 'Bhaat and Dhal v2', 'Test', 2, '6.00');

-- --------------------------------------------------------

--
-- Table structure for table `menu_manager`
--

DROP TABLE IF EXISTS `menu_manager`;
CREATE TABLE IF NOT EXISTS `menu_manager` (
  `Menu_Manager_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Restaurant_ID` int(11) NOT NULL,
  `Menu_Manager_FName` varchar(255) NOT NULL,
  `Menu_Manager_SName` varchar(255) NOT NULL,
  `User_ID` int(11) NOT NULL,
  PRIMARY KEY (`Menu_Manager_ID`),
  KEY `Idx_Restaurant_ID` (`Restaurant_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_manager`
--

INSERT INTO `menu_manager` (`Menu_Manager_ID`, `Restaurant_ID`, `Menu_Manager_FName`, `Menu_Manager_SName`, `User_ID`) VALUES
(2, 1, 'Test Manager', 'huh', 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ordered_food_item`
--

DROP TABLE IF EXISTS `ordered_food_item`;
CREATE TABLE IF NOT EXISTS `ordered_food_item` (
  `Ordered_Food_Item_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Cos_Order_Num` int(11) DEFAULT NULL,
  `Menu_Food_Item_ID` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`Ordered_Food_Item_ID`),
  KEY `Idx_Cos_Order_ID` (`Cos_Order_Num`),
  KEY `Idx_Menu_Food_Item_ID` (`Menu_Food_Item_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_food_item`
--

INSERT INTO `ordered_food_item` (`Ordered_Food_Item_ID`, `Cos_Order_Num`, `Menu_Food_Item_ID`, `Quantity`) VALUES
(1, 1, 2, 1),
(2, 1, 2, 1),
(3, 2, 1, 1),
(4, 3, 1, 3),
(5, 3, 1, 4),
(6, 4, 1, 1),
(7, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_cutoff`
--

DROP TABLE IF EXISTS `order_cutoff`;
CREATE TABLE IF NOT EXISTS `order_cutoff` (
  `Order_Cutoff_ID` int(11) NOT NULL,
  `Order_Cutoff_Time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_cutoff`
--

INSERT INTO `order_cutoff` (`Order_Cutoff_ID`, `Order_Cutoff_Time`) VALUES
(1, '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patron`
--

DROP TABLE IF EXISTS `patron`;
CREATE TABLE IF NOT EXISTS `patron` (
  `Employee_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Patron_FName` varchar(255) NOT NULL,
  `Patron_SName` varchar(255) NOT NULL,
  `Patron_PHNum` varchar(255) NOT NULL,
  `Patron_Location` varchar(255) NOT NULL,
  `Patron_Deduction_Status` tinyint(1) DEFAULT NULL,
  `User_ID` int(11) NOT NULL,
  PRIMARY KEY (`Employee_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1235 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patron`
--

INSERT INTO `patron` (`Employee_ID`, `Patron_FName`, `Patron_SName`, `Patron_PHNum`, `Patron_Location`, `Patron_Deduction_Status`, `User_ID`) VALUES
(1234, 'Test Patron', '@gmail.com', '9999999', 'Labasa', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

DROP TABLE IF EXISTS `payroll`;
CREATE TABLE IF NOT EXISTS `payroll` (
  `Payroll_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Employee_ID` int(11) NOT NULL,
  `Salary` int(11) NOT NULL,
  PRIMARY KEY (`Payroll_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10002 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`Payroll_ID`, `Employee_ID`, `Salary`) VALUES
(10001, 1234, 90);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `Restaurant_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Restaurant_Name` varchar(255) NOT NULL,
  `Restaurant_Location` varchar(255) NOT NULL,
  PRIMARY KEY (`Restaurant_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`Restaurant_ID`, `Restaurant_Name`, `Restaurant_Location`) VALUES
(1, 'Dummy', 'Dummy 2');

-- --------------------------------------------------------

--
-- Table structure for table `specials`
--

DROP TABLE IF EXISTS `specials`;
CREATE TABLE IF NOT EXISTS `specials` (
  `Special_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Menu_ID` int(11) DEFAULT NULL,
  `Special_Desc` varchar(255) NOT NULL,
  `Special_Price` decimal(3,2) NOT NULL,
  PRIMARY KEY (`Special_ID`),
  KEY `Idx2_Menu_ID` (`Menu_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `special_food`
--

DROP TABLE IF EXISTS `special_food`;
CREATE TABLE IF NOT EXISTS `special_food` (
  `Special_Food_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Special_ID` int(11) DEFAULT NULL,
  `Menu_Food_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Special_Food_ID`),
  KEY `Idx_Special_ID` (`Special_ID`),
  KEY `Idx2_Menu_Food_ID` (`Menu_Food_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `usertype`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test Patron', 'is314lcnotif@gmail.com', 'Patron', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL),
(2, 'Test Manager', 'test@gmail.com', 'Menu Manager', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
