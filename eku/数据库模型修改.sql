

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema final_project
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema final_project
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `final_project` DEFAULT CHARACTER SET latin1 ;
USE `final_project` ;

-- -----------------------------------------------------
-- Table `final_project`.`Customers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Customers` (
  `Cid` INT NOT NULL,
  `Cname` VARCHAR(50) NOT NULL,
  `Ccontact` VARCHAR(50) NULL DEFAULT NULL,
  `Caddress` VARCHAR(500) NULL DEFAULT NULL,
  `Cpostcode` CHAR(6) NULL DEFAULT NULL,
  `Cphone` VARCHAR(20) NULL DEFAULT NULL,
  `Cbank` VARCHAR(20) NULL DEFAULT NULL,
  `Caccount` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`Cid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Staff_Category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Staff_Category` (
  `SCid` INT(11) NOT NULL AUTO_INCREMENT,
  `SType` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`SCid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Staffs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Staffs` (
  `Sid` INT NOT NULL AUTO_INCREMENT,
  `Sname` VARCHAR(20) NOT NULL,
  `SCid` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Sid`),
  INDEX `Scid_idx` (`SCid` ASC),
  CONSTRAINT `Staffs_SCid`
    FOREIGN KEY (`SCid`)
    REFERENCES `final_project`.`Staff_Category` (`SCid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Outbound`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Outbound` (
  `Outbound_id` INT NOT NULL AUTO_INCREMENT,
  `Customer_Cid` INT NULL DEFAULT NULL,
  `Createtime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Approver_id` CHAR(10) NULL DEFAULT NULL,
  `Consignee` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`Outbound_id`),
  INDEX `Cid_idx` (`Customer_Cid` ASC),
  INDEX `Approver_idx` (`Approver_id` ASC),
  CONSTRAINT `Outbound_Approver_id`
    FOREIGN KEY (`Approver_id`)
    REFERENCES `final_project`.`Staffs` (`Sid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Outbound_Cid`
    FOREIGN KEY (`Customer_Cid`)
    REFERENCES `final_project`.`Customers` (`Cid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Customer_Order_statistics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Customer_Order_statistics` (
  `Cid` INT NOT NULL,
  `Money` DECIMAL(10,2) NULL DEFAULT NULL,
  `Outbound_id` INT NOT NULL,
  `CreateTime` DATETIME NULL,
  INDEX `Customers1_Cid` (`Cid` ASC),
  INDEX `Outbound_id` (`Outbound_id` ASC),
  PRIMARY KEY (`Outbound_id`),
  CONSTRAINT `Cid`
    FOREIGN KEY (`Cid`)
    REFERENCES `final_project`.`Customers` (`Cid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Customer_Outbound_id`
    FOREIGN KEY (`Outbound_id`)
    REFERENCES `final_project`.`Outbound` (`Outbound_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`History_Stocks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`History_Stocks` (
  `Stockid` INT NOT NULL,
  `Stocks_Wid` INT(11) NULL DEFAULT NULL,
  `Stocks_lname` VARCHAR(100) NULL DEFAULT NULL,
  `Stockamount` FLOAT NULL DEFAULT NULL,
  `Stockarea` INT(11) NULL DEFAULT NULL,
  `Instocktime` DATETIME NULL DEFAULT NULL,
  `Outstocktime` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`Stockid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Suppliers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Suppliers` (
  `Sid` INT NOT NULL AUTO_INCREMENT,
  `Sname` VARCHAR(50) NOT NULL,
  `Scontact` VARCHAR(50) NULL DEFAULT NULL,
  `Saddress` VARCHAR(500) NULL DEFAULT NULL,
  `Spostcode` CHAR(6) NULL DEFAULT NULL,
  `Sphone` VARCHAR(20) NULL DEFAULT NULL,
  `Sbank` VARCHAR(20) NULL DEFAULT NULL,
  `Saccount` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`Sid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Inbound`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Inbound` (
  `Inbound_id` INT NOT NULL AUTO_INCREMENT,
  `CreateTime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Approver_id` INT NULL DEFAULT NULL,
  `Suppliers_Sid` INT NOT NULL,
  `Deliverer` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`Inbound_id`),
  INDEX `Approver_idx` (`Approver_id` ASC),
  INDEX `Warehouse_entry_Suppliers1_idx` (`Suppliers_Sid` ASC),
  CONSTRAINT `Inbound_Approver_id`
    FOREIGN KEY (`Approver_id`)
    REFERENCES `final_project`.`Staffs` (`Sid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Inbound_Suppliers_Sid`
    FOREIGN KEY (`Suppliers_Sid`)
    REFERENCES `final_project`.`Suppliers` (`Sid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Item_Category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Item_Category` (
  `ICname` VARCHAR(50) NOT NULL,
  `Spec` VARCHAR(45) NULL,
  PRIMARY KEY (`ICname`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Items` (
  `Iname` VARCHAR(100) NOT NULL,
  `Unit` VARCHAR(20) NULL DEFAULT NULL,
  `ICname` VARCHAR(50) NULL,
  PRIMARY KEY (`Iname`),
  INDEX `Item_Category_name_idx` (`ICname` ASC),
  CONSTRAINT `Item_Category_name`
    FOREIGN KEY (`ICname`)
    REFERENCES `final_project`.`Item_Category` (`ICname`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Warehouses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Warehouses` (
  `Wid` INT(11) NOT NULL AUTO_INCREMENT,
  `Admin_id` CHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`Wid`),
  INDEX `Admin_idx` (`Admin_id` ASC),
  CONSTRAINT `Warehouses_Admin_id`
    FOREIGN KEY (`Admin_id`)
    REFERENCES `final_project`.`Staffs` (`Sid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Stocks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Stocks` (
  `Stockid` INT NOT NULL AUTO_INCREMENT,
  `Stocks_Wid` INT(11) NOT NULL,
  `Stocks_Iname` VARCHAR(100) NOT NULL,
  `Stockamount` FLOAT NOT NULL,
  `Stockarea` INT(11) NULL DEFAULT NULL,
  `Instocktime` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`Stockid`),
  INDEX `Wid_idx` (`Stocks_Wid` ASC),
  INDEX `Pid_idx` (`Stocks_Iname` ASC),
  CONSTRAINT `Stocks_Iname`
    FOREIGN KEY (`Stocks_Iname`)
    REFERENCES `final_project`.`Items` (`Iname`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Stocks_Wid`
    FOREIGN KEY (`Stocks_Wid`)
    REFERENCES `final_project`.`Warehouses` (`Wid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Inbound_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Inbound_details` (
  `Inbound_id` INT NOT NULL,
  `Inbound_Iname` VARCHAR(100) NOT NULL,
  `Amount` FLOAT NULL DEFAULT NULL,
  `Unit_Price` DECIMAL(10,2) NULL DEFAULT NULL,
  `Inbound_Stockid` INT NULL DEFAULT NULL,
  INDEX `Inbound_idx` (`Inbound_id` ASC),
  INDEX `Iid_idx` (`Inbound_Iname` ASC),
  INDEX `Warehouse_entry_details_Stocks1_idx` (`Inbound_Stockid` ASC),
  PRIMARY KEY (`Inbound_id`, `Inbound_Iname`),
  CONSTRAINT `Inbound_Iname`
    FOREIGN KEY (`Inbound_Iname`)
    REFERENCES `final_project`.`Items` (`Iname`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Inbound_d_stockid`
    FOREIGN KEY (`Inbound_Stockid`)
    REFERENCES `final_project`.`Stocks` (`Stockid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `Inbound_id`
    FOREIGN KEY (`Inbound_id`)
    REFERENCES `final_project`.`Inbound` (`Inbound_id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Inner_Trasition`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Inner_Trasition` (
  `Transitionid` INT(11) NOT NULL AUTO_INCREMENT,
  `I_T_Wid` INT(11) NOT NULL,
  `Amount` FLOAT NOT NULL,
  `Items_Iname` VARCHAR(100) NOT NULL,
  `Operate` CHAR(1) NULL DEFAULT NULL,
  `Time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`Transitionid`),
  INDEX `fk_Inner_trasition_Products1_idx` (`Items_Iname` ASC),
  INDEX `I_T_Wid_idx` (`I_T_Wid` ASC),
  CONSTRAINT `I_T_Iid`
    FOREIGN KEY (`Items_Iname`)
    REFERENCES `final_project`.`Items` (`Iname`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `I_T_Wid`
    FOREIGN KEY (`I_T_Wid`)
    REFERENCES `final_project`.`Warehouses` (`Wid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Outbound_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Outbound_details` (
  `Outbound_id` INT NOT NULL,
  `Outbound_Iname` VARCHAR(100) NOT NULL,
  `Amount` FLOAT NULL DEFAULT NULL,
  `Unit_price` DECIMAL(10,2) NULL DEFAULT NULL,
  `Warehouses_Wid` INT(11) NOT NULL,
  PRIMARY KEY (`Outbound_id`, `Outbound_Iname`),
  INDEX `Outbound_id_idx` (`Outbound_id` ASC),
  INDEX `Outbound_Iid_idx` (`Outbound_Iname` ASC),
  INDEX `fk_Outbound_details_Warehouses1_idx` (`Warehouses_Wid` ASC),
  CONSTRAINT `Outbound_Iname`
    FOREIGN KEY (`Outbound_Iname`)
    REFERENCES `final_project`.`Items` (`Iname`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Outbound_id`
    FOREIGN KEY (`Outbound_id`)
    REFERENCES `final_project`.`Outbound` (`Outbound_id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Outbound_details_Warehouses1`
    FOREIGN KEY (`Warehouses_Wid`)
    REFERENCES `final_project`.`Warehouses` (`Wid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Stock_collection`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Stock_collection` (
  `Remain_Amount` FLOAT NOT NULL,
  `Items_Iname` VARCHAR(100) NOT NULL,
  `Wid` INT(11) NULL DEFAULT NULL,
  `Minimum` FLOAT NOT NULL,
  `Maximum` FLOAT NOT NULL,
  PRIMARY KEY (`Items_Iname`),
  INDEX `Stock_collection_Items1_idx` (`Items_Iname` ASC),
  INDEX `Stock_collection_Wid_idx` (`Wid` ASC),
  CONSTRAINT `Stock_collection_Wid`
    FOREIGN KEY (`Wid`)
    REFERENCES `final_project`.`Warehouses` (`Wid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Stock_collection_lname`
    FOREIGN KEY (`Items_Iname`)
    REFERENCES `final_project`.`Items` (`Iname`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`Suppliers_Order_statistics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`Suppliers_Order_statistics` (
  `Sid` INT NOT NULL,
  `CreateTime` DATETIME NULL DEFAULT NULL,
  `Money` DECIMAL(10,2) NULL DEFAULT NULL,
  `Inbound_id` INT NOT NULL,
  INDEX `Sid` (`Sid` ASC),
  INDEX `fk_Suppliers_Order_statistics_Inbound1_idx` (`Inbound_id` ASC),
  PRIMARY KEY (`Inbound_id`),
  CONSTRAINT `Inblound_id`
    FOREIGN KEY (`Inbound_id`)
    REFERENCES `final_project`.`Inbound` (`Inbound_id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Sid`
    FOREIGN KEY (`Sid`)
    REFERENCES `final_project`.`Suppliers` (`Sid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final_project`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `final_project`.`User` (
  `Username` VARCHAR(20) NOT NULL,
  `Password` VARCHAR(20) NOT NULL,
  `Staffs_Sid` INT NOT NULL,
  PRIMARY KEY (`Username`),
  INDEX `fk_User_Staffs1_idx` (`Staffs_Sid` ASC),
  CONSTRAINT `fk_User_Staffs1`
    FOREIGN KEY (`Staffs_Sid`)
    REFERENCES `final_project`.`Staffs` (`Sid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

USE `final_project`;

DROP TRIGGER IF EXISTS Outbound_AFTER_INSERT;
DROP TRIGGER IF EXISTS Outbound_details_AFTER_INSERT;
DROP TRIGGER IF EXISTS Stocks_AFTER_INSERT;
DROP TRIGGER IF EXISTS Stocks_BEFORE_UPDATE;
DROP TRIGGER IF EXISTS Stocks_AFTER_UPDATE;
DROP TRIGGER IF EXISTS Stocks_BEFORE_DELETE;
DROP TRIGGER IF EXISTS Inbound_AFTER_INSERT;
DROP TRIGGER IF EXISTS Inbound_details_AFTER_INSERT;


DELIMITER $$
USE `final_project`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `final_project`.`Outbound_AFTER_INSERT`
AFTER INSERT ON `final_project`.`Outbound`
FOR EACH ROW
BEGIN
	INSERT INTO Customers_Order_statistics SET Outbound_id=NEW.Outbound_id, Cid=NEW.Customer_Cid, CreateTime=New.CreateTime;
END$$

USE `final_project`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `final_project`.`Outbound_details_AFTER_INSERT`
AFTER INSERT ON `final_project`.`Outbound_details`
FOR EACH ROW
BEGIN
	UPDATE Customer_Order_statistics SET Money=Money+cast(NEW.Amount AS DECIMAL(10,2))*NEW.Unit_price WHERE Outbound_id=NEW.Outbound_id;
END$$


USE `final_project`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `final_project`.`Inbound_AFTER_INSERT`
AFTER INSERT ON `final_project`.`Inbound`
FOR EACH ROW
BEGIN
	INSERT INTO Suppliers_Order_statistics SET Sid=NEW.Suppliers_Sid, Inbound_id=NEW.Inbound_id, CreateTime=NEW.CreateTime;
END$$

USE `final_project`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `final_project`.`Inbound_details_AFTER_INSERT`
AFTER INSERT ON `final_project`.`Inbound_details`
FOR EACH ROW
BEGIN
	UPDATE Suppliers_Order_statistics SET Money=Money+cast(NEW.Amount AS DECIMAL(10,2))*NEW.Unit_Price WHERE Inbound_id=NEW.Inbound_id;
END$$


USE `final_project`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `final_project`.`Stocks_AFTER_INSERT`
AFTER INSERT ON `final_project`.`Stocks`
FOR EACH ROW
BEGIN
 INSERT INTO Stock_collection (Iid, Remain_Amount,Wid) VALUES (NEW.Stocks_Iname, NEW.Stockamount, NEW.Stocks_Wid) ON DUPLICATE KEY UPDATE Remain_Amount=Remain_Amount+NEW.Stockamount;
END$$

USE `final_project`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `final_project`.`Stocks_BEFORE_UPDATE`
BEFORE UPDATE ON `final_project`.`Stocks`
FOR EACH ROW
BEGIN
	UPDATE Stock_collection set Remain_Amount=Remain_Amount-OLD.Stockamount WHERE Iid=OLD.Stocks_Iid;
END$$

USE `final_project`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `final_project`.`Stocks_AFTER_UPDATE`
AFTER UPDATE ON `final_project`.`Stocks`
FOR EACH ROW
BEGIN
	UPDATE Stock_collection set Remain_Amount=Remain_Amount+NEW.Stockamount WHERE Iid=OLD.Stocks_Iid;
END$$

USE `final_project`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `final_project`.`Stocks_BEFORE_DELETE`
BEFORE DELETE ON `final_project`.`Stocks`
FOR EACH ROW
BEGIN
	UPDATE Stock_collection SC SET Remain_Amount=Remain_Amount-OLD.Stockamount WHERE SC.Items_Iname=OLD.Stocks_Iname;
    INSERT INTO History_Stocks SET Stockid=OLD.stockid, Stocks_Wid=OLD.Stocks_Wid, Stocks_Iname=OLD.Stocks_Iname, Stockamount=OLD.Stockamount, Stockarea=OLD.Stockarea, Instocktime=OLD.Instocktime, Outstocktime=NOW();
END$$




DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
