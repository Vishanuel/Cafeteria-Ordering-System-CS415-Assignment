-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2020 at 03:56 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `cafeteria_staff`
--

CREATE TABLE `cafeteria_staff` (
  `Cafeteria_Staff_ID` int(11) NOT NULL,
  `Restaurant_ID` int(11) NOT NULL,
  `Cafeteria_Staff_Name` text NOT NULL,
  `Cafeteria_Staff_Type` text NOT NULL,
  `User_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cafeteria_staff`
--

INSERT INTO `cafeteria_staff` (`Cafeteria_Staff_ID`, `Restaurant_ID`, `Cafeteria_Staff_Name`, `Cafeteria_Staff_Type`, `User_ID`) VALUES
(1, 1, 'John', 'Cafeteria Staff', 4);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` text NOT NULL,
  `Order_Cutoff_ID` int(11) NOT NULL
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

CREATE TABLE `cos_order` (
  `Cos_Order_Num` int(11) NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  `Cos_Order_Date_Time` date NOT NULL,
  `Cos_Meal_Date_Time` date NOT NULL,
  `Cos_Order_Meal_Status` varchar(255) NOT NULL,
  `Cos_Order_Cost` int(11) NOT NULL,
  `Cos_Order_Payment_Method` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 1234, '2020-03-23', '2020-03-24', 'Approved', 5, 'payroll'),
(13, 1234, '2020-03-23', '2020-03-24', 'Approved', 11, 'payroll'),
(14, 1234, '2020-05-02', '2020-05-03', 'orderingg', 5, 'NN');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_instruction`
--

CREATE TABLE `delivery_instruction` (
  `D_Instruction_ID` int(11) NOT NULL,
  `D_Location` int(11) NOT NULL,
  `D_Time_Window` varchar(45) NOT NULL,
  `Cos_Order_Num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `delivery_request` (
  `D_Request_ID` int(11) NOT NULL,
  `D_Instruction_ID` int(11) NOT NULL,
  `Meal_Deliverer_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_request`
--

INSERT INTO `delivery_request` (`D_Request_ID`, `D_Instruction_ID`, `Meal_Deliverer_ID`) VALUES
(2, 2, 1),
(6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `Ingredient_ID` int(255) NOT NULL,
  `Ingredient_Name` varchar(255) NOT NULL,
  `Ingredient_Type_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`Ingredient_ID`, `Ingredient_Name`, `Ingredient_Type_ID`) VALUES
(1, 'gravy', 2),
(2, 'soft drink', 2),
(3, 'salad', 2),
(4, 'chutney', 2),
(5, 'roti', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_type`
--

CREATE TABLE `ingredient_type` (
  `Ingredient_Type_ID` int(255) NOT NULL,
  `Ingredient_Type_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredient_type`
--

INSERT INTO `ingredient_type` (`Ingredient_Type_ID`, `Ingredient_Type_Name`) VALUES
(1, 'optional'),
(2, 'selective');

-- --------------------------------------------------------

--
-- Table structure for table `item_ingredient`
--

CREATE TABLE `item_ingredient` (
  `Item_Ingredient_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `Ingredient_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_ingredient`
--

INSERT INTO `item_ingredient` (`Item_Ingredient_ID`, `Item_ID`, `Ingredient_ID`) VALUES
(1, 1, 4),
(2, 1, 5),
(3, 6, 1),
(4, 6, 2),
(5, 6, 4),
(6, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `Location_ID` int(11) NOT NULL,
  `Location_Name` varchar(45) NOT NULL
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

CREATE TABLE `meal_deliverer` (
  `Meal_Deliverer_ID` int(11) NOT NULL,
  `Meal_Deliverer_Name` text NOT NULL,
  `Meal_Deliverer_Phone_Number` text NOT NULL,
  `Restaurant_ID` int(11) NOT NULL,
  `User_ID` bigint(20) UNSIGNED NOT NULL
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

CREATE TABLE `menu` (
  `Menu_ID` int(11) NOT NULL,
  `Restaurant_ID` int(11) NOT NULL,
  `Menu_Date` date NOT NULL,
  `Category_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Menu_ID`, `Restaurant_ID`, `Menu_Date`, `Category_ID`) VALUES
(1, 1, '2020-05-04', 2),
(3, 1, '2020-05-04', 3),
(7, 1, '2020-05-04', 1),
(8, 1, '2020-05-04', 2),
(9, 1, '2020-05-04', 1),
(10, 1, '2020-05-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_food`
--

CREATE TABLE `menu_food` (
  `Menu_Food_ID` int(11) NOT NULL,
  `Menu_ID` int(11) DEFAULT NULL,
  `Menu_Food_Item_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_food`
--

INSERT INTO `menu_food` (`Menu_Food_ID`, `Menu_ID`, `Menu_Food_Item_ID`) VALUES
(1, 1, 1),
(2, 1, 2),
(26, 3, 6),
(27, 3, 3),
(42, 7, 4),
(43, 7, 5),
(50, 9, 3),
(51, 9, 4),
(52, 10, 2),
(53, 10, 3),
(54, 8, 2),
(55, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `menu_food_item`
--

CREATE TABLE `menu_food_item` (
  `Menu_Food_Item_ID` int(11) NOT NULL,
  `Food_Name` varchar(255) NOT NULL,
  `Food_Desc` varchar(510) NOT NULL,
  `Quantity` int(11) DEFAULT 0,
  `Price` decimal(3,2) NOT NULL,
  `Restaurant_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_food_item`
--

INSERT INTO `menu_food_item` (`Menu_Food_Item_ID`, `Food_Name`, `Food_Desc`, `Quantity`, `Price`, `Restaurant_ID`) VALUES
(1, 'Dhal Bhaat', 'dhal soup with side dish of choice', 4, '5.00', 1),
(2, 'Fried Chicken', 'Fried chicken in sause of choice', 3, '6.00', 1),
(3, 'Spicy chicken and chips', 'Spicy fried chicken with chips', 9, '9.00', 1),
(4, 'Scrambled egg', 'fried eggs topped with salad', 3, '5.00', 1),
(5, 'pancakes', 'flavored in vanilla and butter', 3, '5.00', 1),
(6, 'grilled chicken', 'served with cassava or dalo with fruit salad', 3, '8.00', 1),
(7, 'chicken curry', 'chicken curry with rice or cassava', 0, '8.00', 1),
(13, 'egg rice', 'fried egg with rice', 0, '3.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_manager`
--

CREATE TABLE `menu_manager` (
  `Menu_Manager_ID` int(11) NOT NULL,
  `Restaurant_ID` int(11) NOT NULL,
  `Menu_Manager_FName` varchar(255) NOT NULL,
  `Menu_Manager_SName` varchar(255) NOT NULL,
  `User_ID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_manager`
--

INSERT INTO `menu_manager` (`Menu_Manager_ID`, `Restaurant_ID`, `Menu_Manager_FName`, `Menu_Manager_SName`, `User_ID`) VALUES
(2, 1, 'Test Manager', 'huh', 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ordered_food_item`
--

CREATE TABLE `ordered_food_item` (
  `Ordered_Food_Item_ID` int(11) NOT NULL,
  `Cos_Order_Num` int(11) DEFAULT NULL,
  `Menu_Food_Item_ID` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(16, 12, 1, 1),
(17, 13, 1, 1),
(18, 14, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_special`
--

CREATE TABLE `ordered_special` (
  `Ordered_Special_ID` int(11) NOT NULL,
  `Special_ID` int(11) NOT NULL,
  `Cos_Order_Num` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_special`
--

INSERT INTO `ordered_special` (`Ordered_Special_ID`, `Special_ID`, `Cos_Order_Num`, `Quantity`) VALUES
(1, 1, 9, 1),
(2, 1, 10, 1),
(3, 1, 11, 1),
(4, 1, 11, 1),
(5, 1, 11, 1),
(6, 1, 11, 1),
(7, 1, 11, 1),
(8, 1, 11, 1),
(9, 1, 11, 1),
(10, 1, 11, 1),
(11, 1, 11, 1),
(12, 1, 11, 1),
(13, 1, 11, 1),
(14, 1, 11, 1),
(15, 1, 11, 1),
(16, 1, 11, 1),
(17, 1, 11, 1),
(18, 1, 11, 1),
(19, 1, 11, 1),
(20, 1, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_cutoff`
--

CREATE TABLE `order_cutoff` (
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

CREATE TABLE `patron` (
  `Employee_ID` int(11) NOT NULL,
  `Patron_FName` varchar(255) NOT NULL,
  `Patron_SName` varchar(255) NOT NULL,
  `Patron_PHNum` varchar(255) NOT NULL,
  `Patron_Location` varchar(255) NOT NULL,
  `Patron_Deduction_Status` tinyint(1) DEFAULT NULL,
  `User_ID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patron`
--

INSERT INTO `patron` (`Employee_ID`, `Patron_FName`, `Patron_SName`, `Patron_PHNum`, `Patron_Location`, `Patron_Deduction_Status`, `User_ID`) VALUES
(1234, 'Test Patron', '@gmail.com', '9999999', 'Labasa', 1, 1),
(1236, 'Rakess', 'Misra', '98765432', 'Nadi', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `Payroll_ID` int(11) NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  `Salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`Payroll_ID`, `Employee_ID`, `Salary`) VALUES
(10001, 1234, 143);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `Restaurant_ID` int(11) NOT NULL,
  `Restaurant_Name` varchar(255) NOT NULL,
  `Restaurant_Location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`Restaurant_ID`, `Restaurant_Name`, `Restaurant_Location`) VALUES
(1, 'Harry Kitchen', 'White Tables'),
(2, 'Garry Kitchens', 'Damodar City');

-- --------------------------------------------------------

--
-- Table structure for table `specials`
--

CREATE TABLE `specials` (
  `Special_ID` int(11) NOT NULL,
  `Menu_ID` int(11) NOT NULL,
  `Special_Desc` varchar(255) NOT NULL,
  `Special_Price` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specials`
--

INSERT INTO `specials` (`Special_ID`, `Menu_ID`, `Special_Desc`, `Special_Price`) VALUES
(1, 1, 'Fried Chicken and Dhal Bhaat', '6.00'),
(7, 3, 'trial', '6.00'),
(8, 7, 'trail2', '6.00');

-- --------------------------------------------------------

--
-- Table structure for table `special_food`
--

CREATE TABLE `special_food` (
  `Special_Food_ID` int(11) NOT NULL,
  `Special_ID` int(11) DEFAULT NULL,
  `Menu_Food_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `special_food`
--

INSERT INTO `special_food` (`Special_Food_ID`, `Special_ID`, `Menu_Food_ID`) VALUES
(9, 8, 3),
(12, 1, 1),
(13, 7, 4),
(14, 7, 5),
(15, 7, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `usertype`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test Patron', 'is314lcnotif@gmail.com', 'Patron', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL),
(2, 'Test Manager', 'test@gmail.com', 'Menu Manager', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL),
(3, 'Rakess', 'cs324assignment@gmail.com', 'Patron', '2020-03-09 12:00:00', '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL),
(4, 'John', 'cafeteria@gmail.com', 'Cafeteria Staff', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL),
(5, 'Mark', 'deliverer@gmail.com', 'Meal Deliverer', NULL, '$2y$10$rlJYGJBXXGbIP/UEwdzKmeVMu71srbLW58u9Wjjeg.4vNDhXgOhEO', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cafeteria_staff`
--
ALTER TABLE `cafeteria_staff`
  ADD PRIMARY KEY (`Cafeteria_Staff_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`),
  ADD KEY `Order_Cutoff_ID` (`Order_Cutoff_ID`);

--
-- Indexes for table `cos_order`
--
ALTER TABLE `cos_order`
  ADD PRIMARY KEY (`Cos_Order_Num`),
  ADD KEY `Idx_Emp_ID` (`Employee_ID`);

--
-- Indexes for table `delivery_instruction`
--
ALTER TABLE `delivery_instruction`
  ADD PRIMARY KEY (`D_Instruction_ID`),
  ADD KEY `fk_delivery_instruction_cos_order_num` (`Cos_Order_Num`),
  ADD KEY `fk_delivery_instruction_location_id` (`D_Location`);

--
-- Indexes for table `delivery_request`
--
ALTER TABLE `delivery_request`
  ADD PRIMARY KEY (`D_Request_ID`),
  ADD KEY `fk_delivery_request_d_instruction_id` (`D_Instruction_ID`),
  ADD KEY `fk_delivery_request_meal_deliverer_id` (`Meal_Deliverer_ID`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`Ingredient_ID`),
  ADD KEY `Ingredient_Type_ID` (`Ingredient_Type_ID`);

--
-- Indexes for table `ingredient_type`
--
ALTER TABLE `ingredient_type`
  ADD PRIMARY KEY (`Ingredient_Type_ID`);

--
-- Indexes for table `item_ingredient`
--
ALTER TABLE `item_ingredient`
  ADD PRIMARY KEY (`Item_Ingredient_ID`),
  ADD KEY `Ingredient_ID` (`Ingredient_ID`),
  ADD KEY `Item_ID` (`Item_ID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`Location_ID`);

--
-- Indexes for table `meal_deliverer`
--
ALTER TABLE `meal_deliverer`
  ADD PRIMARY KEY (`Meal_Deliverer_ID`),
  ADD KEY `fk_meal_deliverer_restaurant_id` (`Restaurant_ID`),
  ADD KEY `fk_meal_deliverer_user_id` (`User_ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Menu_ID`),
  ADD KEY `Idx_Restaurant_Menu_ID` (`Restaurant_ID`),
  ADD KEY `Category_ID` (`Category_ID`);

--
-- Indexes for table `menu_food`
--
ALTER TABLE `menu_food`
  ADD PRIMARY KEY (`Menu_Food_ID`),
  ADD KEY `Idx2_Menu_ID` (`Menu_ID`),
  ADD KEY `Idx2_Menu_Food_Item_ID` (`Menu_Food_Item_ID`);

--
-- Indexes for table `menu_food_item`
--
ALTER TABLE `menu_food_item`
  ADD PRIMARY KEY (`Menu_Food_Item_ID`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `menu_manager`
--
ALTER TABLE `menu_manager`
  ADD PRIMARY KEY (`Menu_Manager_ID`),
  ADD KEY `Idx_Restaurant_ID` (`Restaurant_ID`),
  ADD KEY `fk_menu_manager_user_id` (`User_ID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_food_item`
--
ALTER TABLE `ordered_food_item`
  ADD PRIMARY KEY (`Ordered_Food_Item_ID`),
  ADD KEY `Idx_Cos_Order_ID` (`Cos_Order_Num`),
  ADD KEY `Idx_Menu_Food_Item_ID` (`Menu_Food_Item_ID`);

--
-- Indexes for table `ordered_special`
--
ALTER TABLE `ordered_special`
  ADD PRIMARY KEY (`Ordered_Special_ID`),
  ADD KEY `fk_ordered_cos_order_num` (`Cos_Order_Num`),
  ADD KEY `fk_ordered_special_id` (`Special_ID`);

--
-- Indexes for table `order_cutoff`
--
ALTER TABLE `order_cutoff`
  ADD PRIMARY KEY (`Order_Cutoff_ID`);

--
-- Indexes for table `patron`
--
ALTER TABLE `patron`
  ADD PRIMARY KEY (`Employee_ID`),
  ADD KEY `fk_patron_user_id` (`User_ID`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`Payroll_ID`),
  ADD KEY `fk_payroll_employee_id` (`Employee_ID`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`Restaurant_ID`);

--
-- Indexes for table `specials`
--
ALTER TABLE `specials`
  ADD PRIMARY KEY (`Special_ID`,`Menu_ID`) USING BTREE,
  ADD KEY `Idx2_Menu_ID` (`Menu_ID`);

--
-- Indexes for table `special_food`
--
ALTER TABLE `special_food`
  ADD PRIMARY KEY (`Special_Food_ID`),
  ADD KEY `Idx_Special_ID` (`Special_ID`),
  ADD KEY `Idx2_Menu_Food_ID` (`Menu_Food_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cafeteria_staff`
--
ALTER TABLE `cafeteria_staff`
  MODIFY `Cafeteria_Staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cos_order`
--
ALTER TABLE `cos_order`
  MODIFY `Cos_Order_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `delivery_instruction`
--
ALTER TABLE `delivery_instruction`
  MODIFY `D_Instruction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_request`
--
ALTER TABLE `delivery_request`
  MODIFY `D_Request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `Ingredient_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item_ingredient`
--
ALTER TABLE `item_ingredient`
  MODIFY `Item_Ingredient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `Menu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu_food`
--
ALTER TABLE `menu_food`
  MODIFY `Menu_Food_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `menu_food_item`
--
ALTER TABLE `menu_food_item`
  MODIFY `Menu_Food_Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `menu_manager`
--
ALTER TABLE `menu_manager`
  MODIFY `Menu_Manager_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordered_food_item`
--
ALTER TABLE `ordered_food_item`
  MODIFY `Ordered_Food_Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ordered_special`
--
ALTER TABLE `ordered_special`
  MODIFY `Ordered_Special_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `patron`
--
ALTER TABLE `patron`
  MODIFY `Employee_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1237;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `Payroll_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `Restaurant_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `specials`
--
ALTER TABLE `specials`
  MODIFY `Special_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `special_food`
--
ALTER TABLE `special_food`
  MODIFY `Special_Food_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_2` FOREIGN KEY (`Ingredient_Type_ID`) REFERENCES `ingredient_type` (`Ingredient_Type_ID`);

--
-- Constraints for table `item_ingredient`
--
ALTER TABLE `item_ingredient`
  ADD CONSTRAINT `item_ingredient_ibfk_1` FOREIGN KEY (`Item_ID`) REFERENCES `menu_food_item` (`Menu_Food_Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_ingredient_ibfk_2` FOREIGN KEY (`Ingredient_ID`) REFERENCES `ingredient` (`Ingredient_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_menu_restaurant_id` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
