/*
 *COS MYSQL DB SCRIPT
 *
 */

use mysql;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE DATABASE IF NOT EXISTS Cafeteria;

DROP TABLE IF EXISTS `Cafeteria`.`Special_Food`;
DROP TABLE IF EXISTS `Cafeteria`.`Specials`;
DROP TABLE IF EXISTS `Cafeteria`.`Menu_Food`;
DROP TABLE IF EXISTS `Cafeteria`.`Ordered_Food_Item`;
DROP TABLE IF EXISTS `Cafeteria`.`Menu_Food_Item`;
DROP TABLE IF EXISTS `Cafeteria`.`Menu`;
DROP TABLE IF EXISTS `Cafeteria`.`Cos_Order`;
DROP TABLE IF EXISTS `Cafeteria`.`Patron`;
DROP TABLE IF EXISTS `Cafeteria`.`Menu_Manager`;
DROP TABLE IF EXISTS `Cafeteria`.`Restaurant`;
DROP TABLE IF EXISTS `Cafeteria`.`Location`;



/*
 * -Patron Table
 */

 /*DROP TABLE IF EXISTS `Cafeteria`.`Patron`;*/

CREATE TABLE IF NOT EXISTS `Cafeteria`.`Patron` (
 `Employee_ID` INT NOT NULL AUTO_INCREMENT, 
 `Patron_FName` VARCHAR(255) NOT NULL,
 `Patron_SName` VARCHAR(255) NOT NULL,
 `Patron_PHNum` VARCHAR(255) NOT NULL,
 `Patron_Location` VARCHAR(255) NOT NULL,
 `Patron_Deduction_Status` BOOLEAN,
 
 PRIMARY KEY (`Employee_ID`)
 );
 
 /*
  * Location Table
  */
  
  CREATE TABLE IF NOT EXISTS `Cafeteria`.`Location` (
   `Location_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `Location_locale` VARCHAR (255) NOT NULL
   
   );
 
 /*
 * -Order Table
 */
/*DROP TABLE IF EXISTS `Cafeteria`.`Cos_Order`;*/

CREATE TABLE IF NOT EXISTS `Cafeteria`.`Cos_Order` (
 `Cos_Order_Num` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `Employee_ID` INT NOT NULL,
 `Location_ID` INT NOT NULL,
 `Cos_Order_Date_Time` DATE NOT NULL, 
 `Cos_Order_Meal_Status` VARCHAR(255) NOT NULL,
 
 
 INDEX `Idx_Emp_ID` (`Employee_ID`),
 CONSTRAINT `FK_Emp_ID`
 FOREIGN KEY (`Employee_ID`)
 REFERENCES `Cafeteria`.`Patron` (`Employee_ID`) ON UPDATE CASCADE ON DELETE CASCADE,
 
 INDEX `Idx_Loc_ID` (`Location_ID`),
 CONSTRAINT `FK_Loc_ID`
 FOREIGN KEY (`Location_ID`)
 REFERENCES `Cafeteria`.`Location` (`Location_ID`) ON UPDATE CASCADE ON DELETE CASCADE  
 
 

 );
 
 
/*
 * -Menu_Food_Item Table
 */
/*DROP TABLE IF EXISTS `Cafeteria`.`Menu_Food_Item`;*/

CREATE TABLE IF NOT EXISTS `Cafeteria`.`Menu_Food_Item` (
 `Menu_Food_Item_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `Food_Name` VARCHAR(255) NOT NULL,
 `Food_Desc` VARCHAR(510) NOT NULL,
 `Food_QTY` VARCHAR(255) NOT NULL,
 `Price`DECIMAL(3,2) NOT NULL

 );
 
 /*
 * -Ordered_Food_Item Table
 */
/*DROP TABLE IF EXISTS `Cafeteria`.`Ordered_Food_Item`;*/

CREATE TABLE IF NOT EXISTS `Cafeteria`.`Ordered_Food_Item` (
 `Ordered_Food_Item_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `Cos_Order_Num` INT,
 `Menu_Food_Item_ID` INT NOT NULL,
 `Ordered_Food_Item_Qty` INT NOT NULL,
 
 INDEX `Idx_Cos_Order_ID` (`Cos_Order_Num`),
 CONSTRAINT `FK_Cos_Order_ID` 
 FOREIGN KEY (`Cos_Order_Num`)
 REFERENCES `Cafeteria`.`Cos_Order` (`Cos_Order_Num`) ON UPDATE CASCADE ON DELETE CASCADE,
 
 INDEX `Idx_Menu_Food_Item_ID` (`Menu_Food_Item_ID`),
 CONSTRAINT `FK_Menu_Food_Item_ID` 
 FOREIGN KEY (`Menu_Food_Item_ID`)
 REFERENCES `Cafeteria`.`Menu_Food_Item` (`Menu_Food_Item_ID`) ON UPDATE CASCADE ON DELETE CASCADE
 
 );
 
 /*
  *Restaurant Table
  */
 
 /*DROP TABLE IF EXISTS `Cafeteria`.`Restaurant`;*/
 
 CREATE TABLE IF NOT EXISTS `Cafeteria`.`Restaurant` (
  `Restaurant_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Restaurant_Name` VARCHAR (255) NOT NULL,
  `Restaurant_Location` VARCHAR (255) NOT NULL
  
  );
  
 /*
  *Menu_Manager
  */
 
 /*DROP TABLE IF EXISTS `Cafeteria`.`Menu_Manager`;*/
 
 CREATE TABLE IF NOT EXISTS `Cafeteria`.`Menu_Manager` (
  `Menu_Manager_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Restaurant_ID` INT NOT NULL,
  `Menu_Manager_FName` VARCHAR (255) NOT NULL,
  `Menu_Manager_SName` VARCHAR (255) NOT NULL,
  
  INDEX `Idx_Restaurant_ID` (`Restaurant_ID`),
  CONSTRAINT `FK_Restaurant_ID`
  FOREIGN KEY (`Restaurant_ID`)
  REFERENCES `Cafeteria`.`Restaurant` (`Restaurant_ID`)
  );
  
 /*
  * Menu Table
  */
  
  /*DROP TABLE IF EXISTS `Cafeteria`.`Menu`;*/
 
 CREATE TABLE IF NOT EXISTS `Cafeteria`.`Menu` (
  `Menu_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Restaurant_ID`INT NOT NULL,
  `Menu_Date` DATE NOT NULL,
  
  INDEX `Idx_Restaurant_Menu_ID` (`Restaurant_ID`),
  CONSTRAINT `FK2_Restaurant_ID`
  FOREIGN KEY (`Restaurant_ID`)
  REFERENCES `Cafeteria`.`Restaurant` (`Restaurant_ID`)

  );
  
 /*
  * Menu_Food Table
  */
  
/*DROP TABLE IF EXISTS `Cafeteria`.`Menu_Food`;*/

CREATE TABLE IF NOT EXISTS `Cafeteria`.`Menu_Food` (
 `Menu_Food_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `Menu_ID` INT,
 `Menu_Food_Item_ID` INT,
 
 INDEX `Idx2_Menu_ID` (`Menu_ID`),
 CONSTRAINT `FK2_Menu_ID` 
 FOREIGN KEY (`Menu_ID`)
 REFERENCES `Cafeteria`.`Menu` (`Menu_ID`) ON UPDATE CASCADE ON DELETE CASCADE,
 
 INDEX `Idx2_Menu_Food_Item_ID` (`Menu_Food_Item_ID`),
 CONSTRAINT `FK2_Menu_Food_Item_ID` 
 FOREIGN KEY (`Menu_Food_Item_ID`)
 REFERENCES `Cafeteria`.`Menu_Food_Item` (`Menu_Food_Item_ID`) ON UPDATE CASCADE ON DELETE CASCADE
 
 );
 
 /*
  * Specials Table
  */
  
/*DROP TABLE IF EXISTS `Cafeteria`.`Specials`;*/

CREATE TABLE IF NOT EXISTS `Cafeteria`.`Specials` (
 `Special_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `Menu_ID` INT,
 `Special_Desc` VARCHAR (255) NOT NULL,
 `Special_Price` DECIMAL (3,2) NOT NULL,
 
 INDEX `Idx2_Menu_ID` (`Menu_ID`),
 CONSTRAINT `FK3_Menu_ID` 
 FOREIGN KEY (`Menu_ID`)
 REFERENCES `Cafeteria`.`Menu` (`Menu_ID`) ON UPDATE CASCADE ON DELETE CASCADE
 );
 
 /*
  * Special_Food Table
  */
  
/*DROP TABLE IF EXISTS `Cafeteria`.`Special_Food`;*/

CREATE TABLE IF NOT EXISTS `Cafeteria`.`Special_Food` (
 `Special_Food_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `Special_ID` INT,
 `Menu_Food_ID` INT,
 
 INDEX `Idx_Special_ID` (`Special_ID`),
 CONSTRAINT `FK2_Special_ID` 
 FOREIGN KEY (`Special_ID`)
 REFERENCES `Cafeteria`.`Specials` (`Special_ID`) ON UPDATE CASCADE ON DELETE CASCADE,
 
 INDEX `Idx2_Menu_Food_ID` (`Menu_Food_ID`),
 CONSTRAINT `FK3_Menu_Food_ID` 
 FOREIGN KEY (`Menu_Food_ID`)
 REFERENCES `Cafeteria`.`Menu_Food` (`Menu_Food_ID`) ON UPDATE CASCADE ON DELETE CASCADE
 
 );
 
 