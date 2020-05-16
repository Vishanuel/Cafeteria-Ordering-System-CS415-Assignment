-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 07, 2020 at 05:25 PM
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
-- Table structure for table `cafeteria_staff`
--

DROP TABLE IF EXISTS `cafeteria_staff`;
CREATE TABLE IF NOT EXISTS `cafeteria_staff` (
  `Cafeteria_Staff_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Restaurant_ID` int(11) NOT NULL,
  `Cafeteria_Staff_Name` text NOT NULL,
  `Cafeteria_Staff_Type` text NOT NULL,
  `User_ID` int(11) NOT NULL,
  PRIMARY KEY (`Cafeteria_Staff_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cafeteria_staff`
--

INSERT INTO `cafeteria_staff` (`Cafeteria_Staff_ID`, `Restaurant_ID`, `Cafeteria_Staff_Name`, `Cafeteria_Staff_Type`, `User_ID`) VALUES
(1, 1, 'John', 'Cafeteria Staff', 4);

-- --------------------------------------------------------

--
-- Table structure for table `card_bank`
--

DROP TABLE IF EXISTS `card_bank`;
CREATE TABLE IF NOT EXISTS `card_bank` (
  `Card_Number` bigint(20) NOT NULL,
  `Card_Type` varchar(20) NOT NULL,
  `Card_Balance` int(11) NOT NULL,
  PRIMARY KEY (`Card_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_bank`
--

INSERT INTO `card_bank` (`Card_Number`, `Card_Type`, `Card_Balance`) VALUES
(100000000000000, 'Debit', 1000),
(9999999999999999, 'Debit', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `card_payment`
--

DROP TABLE IF EXISTS `card_payment`;
CREATE TABLE IF NOT EXISTS `card_payment` (
  `Card_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Card_Holder_Name` varchar(55) NOT NULL,
  `Card_Number` bigint(20) NOT NULL,
  `CVV` int(11) NOT NULL,
  `Expiry_Date` text NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  PRIMARY KEY (`Card_ID`),
  KEY `fk_card_payment_employee_id` (`Employee_ID`),
  KEY `fk_card_payment_card_number` (`Card_Number`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_payment`
--

INSERT INTO `card_payment` (`Card_ID`, `Card_Holder_Name`, `Card_Number`, `CVV`, `Expiry_Date`, `Employee_ID`) VALUES
(2, 'Rakess Misra', 100000000000000, 100, '10/20', 1236),
(5, 'Testing', 9999999999999999, 255, '12/20', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` text NOT NULL,
  `Order_Cutoff_ID` int(11) NOT NULL,
  PRIMARY KEY (`Category_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_Name`, `Order_Cutoff_ID`) VALUES
(1, 'Breakfast', 1),
(2, 'Lunch', 2),
(3, 'Dinner', 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cos_order`
--

INSERT INTO `cos_order` (`Cos_Order_Num`, `Employee_ID`, `Cos_Order_Date_Time`, `Cos_Meal_Date_Time`, `Cos_Order_Meal_Status`, `Cos_Order_Cost`, `Cos_Order_Payment_Method`) VALUES
(1, 1234, '2020-03-13', '2020-03-18', 'Pending Delivery', 25, 'payroll'),
(2, 1234, '2020-03-16', '2020-03-17', 'Delivered', 36, 'payroll'),
(3, 1234, '2020-03-16', '2020-03-17', 'Cancelled', 27, 'payroll'),
(4, 1234, '2020-03-16', '2020-03-16', 'Approved', 9, 'payroll'),
(6, 1236, '2020-03-17', '2020-03-17', 'Approved', 6, 'cash'),
(7, 1236, '2020-03-18', '2020-03-19', 'Approved', 15, 'cash'),
(8, 1234, '2020-03-22', '2020-03-22', 'Cancelled', 5, 'payroll'),
(9, 1234, '2020-03-23', '2020-03-23', 'Approved', 12, 'payroll'),
(10, 1234, '2020-03-23', '2020-03-23', 'Approved', 11, 'payroll'),
(11, 1234, '2020-03-23', '2020-03-23', 'Approved', 11, 'payroll'),
(12, 1234, '2020-03-29', '2020-03-24', 'Approved', 11, 'payroll'),
(13, 1234, '2020-03-24', '2020-03-25', 'Approved', 11, 'payroll'),
(14, 1234, '2020-03-25', '2020-03-25', 'Approved', 35, 'payroll'),
(15, 1234, '2020-03-25', '2020-03-25', 'Cancelled', 50, 'payroll'),
(16, 1234, '2020-03-25', '2020-03-25', 'Cancelled', 36, 'payroll'),
(17, 1234, '2020-03-29', '2020-03-23', 'Approved', 11, 'payroll'),
(18, 1234, '2020-03-29', '2020-03-29', 'Approved', 5, 'payroll'),
(19, 1234, '2020-03-29', '2020-03-29', 'Approved', 15, 'payroll');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_instruction`
--

DROP TABLE IF EXISTS `delivery_instruction`;
CREATE TABLE IF NOT EXISTS `delivery_instruction` (
  `D_Instruction_ID` int(11) NOT NULL AUTO_INCREMENT,
  `D_Location` int(11) NOT NULL,
  `D_Time_Window` varchar(45) NOT NULL,
  `Cos_Order_Num` int(11) NOT NULL,
  PRIMARY KEY (`D_Instruction_ID`),
  KEY `fk_delivery_instruction_cos_order_num` (`Cos_Order_Num`),
  KEY `fk_delivery_instruction_location_id` (`D_Location`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_instruction`
--

INSERT INTO `delivery_instruction` (`D_Instruction_ID`, `D_Location`, `D_Time_Window`, `Cos_Order_Num`) VALUES
(1, 1, '9:45 PM', 1),
(2, 1, '1:30 PM', 2),
(3, 2, '1:45 PM', 3),
(4, 2, '7:15 PM', 4);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_request`
--

DROP TABLE IF EXISTS `delivery_request`;
CREATE TABLE IF NOT EXISTS `delivery_request` (
  `D_Request_ID` int(11) NOT NULL AUTO_INCREMENT,
  `D_Instruction_ID` int(11) NOT NULL,
  `Meal_Deliverer_ID` int(11) NOT NULL,
  PRIMARY KEY (`D_Request_ID`),
  KEY `fk_delivery_request_d_instruction_id` (`D_Instruction_ID`),
  KEY `fk_delivery_request_meal_deliverer_id` (`Meal_Deliverer_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_request`
--

INSERT INTO `delivery_request` (`D_Request_ID`, `D_Instruction_ID`, `Meal_Deliverer_ID`) VALUES
(2, 2, 1),
(6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `Location_ID` int(11) NOT NULL,
  `Location_Name` varchar(45) NOT NULL,
  PRIMARY KEY (`Location_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Location_ID`, `Location_Name`) VALUES
(1, 'ICT Building A'),
(2, 'ICT Building B');

-- --------------------------------------------------------

--
-- Table structure for table `meal_deliverer`
--

DROP TABLE IF EXISTS `meal_deliverer`;
CREATE TABLE IF NOT EXISTS `meal_deliverer` (
  `Meal_Deliverer_ID` int(11) NOT NULL,
  `Meal_Deliverer_Name` text NOT NULL,
  `Meal_Deliverer_Phone_Number` text NOT NULL,
  `Restaurant_ID` int(11) NOT NULL,
  `User_ID` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`Meal_Deliverer_ID`),
  KEY `fk_meal_deliverer_restaurant_id` (`Restaurant_ID`),
  KEY `fk_meal_deliverer_user_id` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meal_deliverer`
--

INSERT INTO `meal_deliverer` (`Meal_Deliverer_ID`, `Meal_Deliverer_Name`, `Meal_Deliverer_Phone_Number`, `Restaurant_ID`, `User_ID`) VALUES
(1, 'Mark', '9988776', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `Menu_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Restaurant_ID` int(11) NOT NULL,
  `Menu_Date` date NOT NULL,
  `Category_ID` int(11) NOT NULL,
  PRIMARY KEY (`Menu_ID`),
  KEY `Idx_Restaurant_Menu_ID` (`Restaurant_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Menu_ID`, `Restaurant_ID`, `Menu_Date`, `Category_ID`) VALUES
(1, 1, '2020-04-01', 2),
(2, 1, '2020-04-01', 3),
(3, 1, '2020-03-31', 1),
(4, 2, '2020-03-31', 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_food`
--

INSERT INTO `menu_food` (`Menu_Food_ID`, `Menu_ID`, `Menu_Food_Item_ID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 2),
(5, 3, 5),
(6, 3, 4),
(7, 1, 4),
(8, 4, 5);

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
  `Price` decimal(4,2) NOT NULL,
  PRIMARY KEY (`Menu_Food_Item_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_food_item`
--

INSERT INTO `menu_food_item` (`Menu_Food_Item_ID`, `Food_Name`, `Food_Desc`, `Quantity`, `Price`) VALUES
(1, 'Dhal Bhaat', 'Nepalese dal bhat (dal bat or dhal bhat), composed of white rice (bhat) and lentils (dal) and is accompanied by a vegetable curry (tarkari), a mixture of spicy vegetables (pickles) and greens (sak).', 63, '5.00'),
(2, 'Fried Chicken', 'This dish consists of 8 chicken pieces which have been coated in a seasoned batter and deep fried. The breading adds a crisp coating or crust to the exterior of the chicken while retaining juices in the meat.', 6, '6.00'),
(3, 'Spicy chicken and chips', 'Spicy fried chicken with chips.', 9, '9.00'),
(4, 'French Fries', 'Golden brown french fried local potatoes.', 15, '10.00'),
(5, 'Vegetarian Sandwich', 'Double layer sandwich with fillings such as cheese, lettuce, tomatoes, grilled pineapple and mayo.', 6, '11.00');

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
  `User_ID` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`Menu_Manager_ID`),
  KEY `Idx_Restaurant_ID` (`Restaurant_ID`),
  KEY `fk_menu_manager_user_id` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_food_item`
--

INSERT INTO `ordered_food_item` (`Ordered_Food_Item_ID`, `Cos_Order_Num`, `Menu_Food_Item_ID`, `Quantity`) VALUES
(1, 1, 1, 3),
(2, 1, 1, 2),
(3, 2, 3, 4),
(4, 3, 3, 3),
(5, 4, 3, 1),
(8, 6, 2, 1),
(9, 7, 1, 1),
(10, 7, 1, 1),
(11, 7, 1, 1),
(12, 8, 1, 1),
(13, 9, 2, 1),
(14, 10, 1, 1),
(15, 11, 1, 1),
(17, 13, 1, 1),
(18, 14, 2, 3),
(19, 14, 1, 1),
(20, 14, 2, 2),
(21, 15, 1, 4),
(22, 15, 2, 2),
(23, 16, 2, 2),
(24, 16, 1, 3),
(35, 12, 1, 1),
(36, 12, 2, 1),
(37, 18, 1, 1),
(40, 19, 1, 1),
(41, 19, 1, 1),
(42, 19, 1, 1),
(43, 17, 1, 1),
(44, 17, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_special`
--

DROP TABLE IF EXISTS `ordered_special`;
CREATE TABLE IF NOT EXISTS `ordered_special` (
  `Ordered_Special_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Special_ID` int(11) NOT NULL,
  `Cos_Order_Num` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`Ordered_Special_ID`),
  KEY `fk_ordered_cos_order_num` (`Cos_Order_Num`),
  KEY `fk_ordered_special_id` (`Special_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_special`
--

INSERT INTO `ordered_special` (`Ordered_Special_ID`, `Special_ID`, `Cos_Order_Num`, `Quantity`) VALUES
(1, 1, 9, 1),
(2, 1, 10, 1),
(3, 1, 11, 1),
(4, 1, 13, 1),
(5, 1, 15, 3),
(6, 1, 16, 1);

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
  `Patron_CardRegister_Status` tinyint(1) NOT NULL,
  `User_ID` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`Employee_ID`),
  KEY `fk_patron_user_id` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1257 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patron`
--

INSERT INTO `patron` (`Employee_ID`, `Patron_FName`, `Patron_SName`, `Patron_PHNum`, `Patron_Location`, `Patron_Deduction_Status`, `Patron_CardRegister_Status`, `User_ID`) VALUES
(1234, 'Test Patron', '@gmail.com', '9999999', 'Labasa', 1, 1, 1),
(1236, 'Rakess', 'Misra', '98765432', 'Nadi', 0, 1, 3),
(1256, 'Mishra', 'Ramesh', '9876543', 'ICT Building A, Floor 3, Room 34', 0, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

DROP TABLE IF EXISTS `payroll`;
CREATE TABLE IF NOT EXISTS `payroll` (
  `Payroll_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Employee_ID` int(11) NOT NULL,
  `Salary` int(11) NOT NULL,
  PRIMARY KEY (`Payroll_ID`),
  KEY `fk_payroll_employee_id` (`Employee_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10002 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`Payroll_ID`, `Employee_ID`, `Salary`) VALUES
(10001, 1234, 186);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `Restaurant_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Restaurant_Name` varchar(255) NOT NULL,
  `Restaurant_Location` varchar(255) NOT NULL,
  `Restaurant_Pic` text NOT NULL,
  PRIMARY KEY (`Restaurant_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`Restaurant_ID`, `Restaurant_Name`, `Restaurant_Location`, `Restaurant_Pic`) VALUES
(1, 'Harry Kitchen', 'White Tables', 'dist/img/restaurant/restaurant1.jpg'),
(2, 'Garry Kitchens', 'Damodar City', 'dist/img/restaurant/restaurant2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `specials`
--

DROP TABLE IF EXISTS `specials`;
CREATE TABLE IF NOT EXISTS `specials` (
  `Special_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Menu_ID` int(11) NOT NULL,
  `Special_Desc` varchar(255) NOT NULL,
  `Special_Price` decimal(3,2) NOT NULL,
  PRIMARY KEY (`Special_ID`,`Menu_ID`) USING BTREE,
  KEY `Idx2_Menu_ID` (`Menu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specials`
--

INSERT INTO `specials` (`Special_ID`, `Menu_ID`, `Special_Desc`, `Special_Price`) VALUES
(1, 1, 'Fried Chicken and Dhal Bhaat', '6.00'),
(2, 2, 'Fried Chicken Special', '2.00');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `special_food`
--

INSERT INTO `special_food` (`Special_Food_ID`, `Special_ID`, `Menu_Food_ID`) VALUES
(1, 1, 1),
(2, 1, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `usertype`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test Patron', 'is314lcnotif@gmail.com', 'Patron', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL),
(2, 'Test Manager', 'test@gmail.com', 'Menu Manager', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL),
(3, 'Rakess', 'cs324assignment@gmail.com', 'Patron', '2020-03-09 12:00:00', '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL),
(4, 'John', 'cafeteria@gmail.com', 'Cafeteria Staff', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL),
(5, 'Mark', 'deliverer@gmail.com', 'Meal Deliverer', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL),
(6, 'Mishra', 'mishra@gmail.com', 'Patron', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card_payment`
--
ALTER TABLE `card_payment`
  ADD CONSTRAINT `fk_card_payment_card_number` FOREIGN KEY (`Card_Number`) REFERENCES `card_bank` (`Card_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_card_payment_employee_id` FOREIGN KEY (`Employee_ID`) REFERENCES `patron` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cos_order`
--
ALTER TABLE `cos_order`
  ADD CONSTRAINT `fk_cos_order_employee_id` FOREIGN KEY (`Employee_ID`) REFERENCES `patron` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery_instruction`
--
ALTER TABLE `delivery_instruction`
  ADD CONSTRAINT `fk_delivery_instruction_cos_order_num` FOREIGN KEY (`Cos_Order_Num`) REFERENCES `cos_order` (`Cos_Order_Num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delivery_instruction_location_id` FOREIGN KEY (`D_Location`) REFERENCES `location` (`Location_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery_request`
--
ALTER TABLE `delivery_request`
  ADD CONSTRAINT `fk_delivery_request_d_instruction_id` FOREIGN KEY (`D_Instruction_ID`) REFERENCES `delivery_instruction` (`D_Instruction_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delivery_request_meal_deliverer_id` FOREIGN KEY (`Meal_Deliverer_ID`) REFERENCES `meal_deliverer` (`Meal_Deliverer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meal_deliverer`
--
ALTER TABLE `meal_deliverer`
  ADD CONSTRAINT `fk_meal_deliverer_restaurant_id` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_meal_deliverer_user_id` FOREIGN KEY (`User_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_restaurant_id` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_food`
--
ALTER TABLE `menu_food`
  ADD CONSTRAINT `fk_menu_food_item_id` FOREIGN KEY (`Menu_Food_Item_ID`) REFERENCES `menu_food_item` (`Menu_Food_Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_menu_id` FOREIGN KEY (`Menu_ID`) REFERENCES `menu` (`Menu_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_manager`
--
ALTER TABLE `menu_manager`
  ADD CONSTRAINT `fk_menu_manager_restaurant_id` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_menu_manager_user_id` FOREIGN KEY (`User_ID`) REFERENCES `users` (`id`);

--
-- Constraints for table `ordered_food_item`
--
ALTER TABLE `ordered_food_item`
  ADD CONSTRAINT `fk_ordered_food_item_cos_order_num` FOREIGN KEY (`Cos_Order_Num`) REFERENCES `cos_order` (`Cos_Order_Num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ordered_food_item_menu_food_item` FOREIGN KEY (`Menu_Food_Item_ID`) REFERENCES `menu_food_item` (`Menu_Food_Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordered_special`
--
ALTER TABLE `ordered_special`
  ADD CONSTRAINT `fk_ordered_cos_order_num` FOREIGN KEY (`Cos_Order_Num`) REFERENCES `cos_order` (`Cos_Order_Num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ordered_special_id` FOREIGN KEY (`Special_ID`) REFERENCES `specials` (`Special_ID`);

--
-- Constraints for table `patron`
--
ALTER TABLE `patron`
  ADD CONSTRAINT `fk_patron_user_id` FOREIGN KEY (`User_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `fk_payroll_employee_id` FOREIGN KEY (`Employee_ID`) REFERENCES `patron` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specials`
--
ALTER TABLE `specials`
  ADD CONSTRAINT `fk_specials_menu_id` FOREIGN KEY (`Menu_ID`) REFERENCES `menu` (`Menu_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `special_food`
--
ALTER TABLE `special_food`
  ADD CONSTRAINT `fk_special_food_menu_food_item_id` FOREIGN KEY (`Menu_Food_ID`) REFERENCES `menu_food_item` (`Menu_Food_Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_special_food_special_id` FOREIGN KEY (`Special_ID`) REFERENCES `specials` (`Special_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
