-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema yihawwbz_dbms
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `yihawwbz_dbms` ;

-- -----------------------------------------------------
-- Schema yihawwbz_dbms
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `yihawwbz_dbms` DEFAULT CHARACTER SET latin1 ;
-- -----------------------------------------------------
-- Schema yihawwbz_dbms2
-- -----------------------------------------------------
USE `yihawwbz_dbms` ;

-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Customers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Customers` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Customers` (
  `Cid` CHAR(10) NOT NULL,
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
-- Table `yihawwbz_dbms`.`Staff_Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Staff_Category` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Staff_Category` (
  `SCid` INT NOT NULL,
  `Type` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`SCid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Staffs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Staffs` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Staffs` (
  `Sid` CHAR(10) NOT NULL,
  `Sname` VARCHAR(20) NOT NULL,
  `SCid` INT NULL DEFAULT NULL,
  PRIMARY KEY (`Sid`),
  INDEX `Scid_idx` (`SCid` ASC),
  CONSTRAINT `Staffs_SCid`
    FOREIGN KEY (`SCid`)
    REFERENCES `yihawwbz_dbms`.`Staff_Category` (`SCid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Warehouses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Warehouses` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Warehouses` (
  `Wid` INT NOT NULL,
  `Admin_id` CHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`Wid`),
  INDEX `Admin_idx` (`Admin_id` ASC),
  CONSTRAINT `Warehouses_Admin_id`
    FOREIGN KEY (`Admin_id`)
    REFERENCES `yihawwbz_dbms`.`Staffs` (`Sid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Outbound`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Outbound` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Outbound` (
  `Outbound_id` CHAR(15) NOT NULL,
  `Customer_Cid` CHAR(10) NULL DEFAULT NULL,
  `Createtime` DATETIME NULL DEFAULT NULL,
  `Approver_id` CHAR(10) NULL DEFAULT NULL,
  `Consignee` VARCHAR(20) NULL DEFAULT NULL,
  `Wid` INT NULL,
  PRIMARY KEY (`Outbound_id`),
  INDEX `Cid_idx` (`Customer_Cid` ASC),
  INDEX `Approver_idx` (`Approver_id` ASC),
  INDEX `Outbound_Warehouse_Wid_idx` (`Wid` ASC),
  CONSTRAINT `Outbound_Cid`
    FOREIGN KEY (`Customer_Cid`)
    REFERENCES `yihawwbz_dbms`.`Customers` (`Cid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Outbound_Approver_id`
    FOREIGN KEY (`Approver_id`)
    REFERENCES `yihawwbz_dbms`.`Staffs` (`Sid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Outbound_Wid`
    FOREIGN KEY (`Wid`)
    REFERENCES `yihawwbz_dbms`.`Warehouses` (`Wid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Customer_Order_statistics`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Customer_Order_statistics` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Customer_Order_statistics` (
  `Cid` CHAR(10) NOT NULL,
  `Index` INT NOT NULL AUTO_INCREMENT,
  `Completetime` DATETIME NULL,
  `Outbound_Amount` FLOAT NULL,
  `Money` DECIMAL(10,2) NULL,
  `Outbound_id` CHAR(15) NULL,
  PRIMARY KEY (`Index`),
  INDEX `fk_Customer_Order_statistics_Customers1_idx` (`Cid` ASC),
  INDEX `fk_Customer_Order_statistics_Outbound1_idx` (`Outbound_id` ASC),
  CONSTRAINT `Cid`
    FOREIGN KEY (`Cid`)
    REFERENCES `yihawwbz_dbms`.`Customers` (`Cid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Customer_Outbound_id`
    FOREIGN KEY (`Outbound_id`)
    REFERENCES `yihawwbz_dbms`.`Outbound` (`Outbound_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Item Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Item Category` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Item Category` (
  `ICid` VARCHAR(5) NOT NULL,
  `ICname` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`ICid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Items` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Items` (
  `Iid` CHAR(15) NOT NULL,
  `ICid` VARCHAR(5) NOT NULL,
  `Iname` VARCHAR(100) NOT NULL,
  `Spec` VARCHAR(50) NULL DEFAULT NULL,
  `Unit` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`Iid`, `ICid`),
  INDEX `Pcid_idx` (`ICid` ASC),
  CONSTRAINT `Items_ICid`
    FOREIGN KEY (`ICid`)
    REFERENCES `yihawwbz_dbms`.`Item Category` (`ICid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Outbound_details`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Outbound_details` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Outbound_details` (
  `Outbound_d_id` CHAR(15) NOT NULL,
  `Outbound_id` CHAR(15) NOT NULL,
  `Outbound_Iid` CHAR(15) NOT NULL,
  `Amount` FLOAT NULL DEFAULT NULL,
  `Completetime` DATETIME NULL DEFAULT NULL,
  `Unit_price` DECIMAL(10,2) NULL,
  PRIMARY KEY (`Outbound_d_id`),
  INDEX `Outbound_id_idx` (`Outbound_id` ASC),
  INDEX `Outbound_Iid_idx` (`Outbound_Iid` ASC),
  CONSTRAINT `Outbound_id`
    FOREIGN KEY (`Outbound_id`)
    REFERENCES `yihawwbz_dbms`.`Outbound` (`Outbound_id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Outbound_Iid`
    FOREIGN KEY (`Outbound_Iid`)
    REFERENCES `yihawwbz_dbms`.`Items` (`Iid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Stock_collection`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Stock_collection` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Stock_collection` (
  `Remain_Amount` FLOAT NOT NULL,
  `Iid` CHAR(15) NOT NULL,
  `Wid` INT NULL,
  PRIMARY KEY (`Iid`),
  INDEX `fk_Stock_collection_Items1_idx` (`Iid` ASC),
  INDEX `Stock_collection_Wid_idx` (`Wid` ASC),
  CONSTRAINT `Stock_collection_lid`
    FOREIGN KEY (`Iid`)
    REFERENCES `yihawwbz_dbms`.`Items` (`Iid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Stock_collection_Wid`
    FOREIGN KEY (`Wid`)
    REFERENCES `yihawwbz_dbms`.`Warehouses` (`Wid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
PACK_KEYS = Default;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Stocks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Stocks` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Stocks` (
  `Stockid` CHAR(20) NOT NULL,
  `Stocks_Wid` INT NOT NULL,
  `Stocks_Iid` CHAR(15) NOT NULL,
  `Stockamount` FLOAT NOT NULL,
  `Stockarea` INT NULL DEFAULT NULL,
  `Instocktime` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`Stockid`),
  INDEX `Wid_idx` (`Stocks_Wid` ASC),
  INDEX `Pid_idx` (`Stocks_Iid` ASC),
  CONSTRAINT `Stocks_Wid`
    FOREIGN KEY (`Stocks_Wid`)
    REFERENCES `yihawwbz_dbms`.`Warehouses` (`Wid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Stocks_Iid`
    FOREIGN KEY (`Stocks_Iid`)
    REFERENCES `yihawwbz_dbms`.`Items` (`Iid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Suppliers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Suppliers` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Suppliers` (
  `Sid` CHAR(10) NOT NULL,
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
-- Table `yihawwbz_dbms`.`Inbound`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Inbound` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Inbound` (
  `Inbound_id` CHAR(15) NOT NULL,
  `CreateTime` DATETIME NULL DEFAULT NULL,
  `Approver_id` CHAR(10) NULL DEFAULT NULL,
  `Suppliers_Sid` CHAR(10) NOT NULL,
  `Inbound_Wid` INT NOT NULL,
  `Deliverer` VARCHAR(20) NULL,
  PRIMARY KEY (`Inbound_id`),
  INDEX `Approver_idx` (`Approver_id` ASC),
  INDEX `fk_Warehouse_entry_Suppliers1_idx` (`Suppliers_Sid` ASC),
  INDEX `fk_Warehouse_entry_Warehouses1_idx` (`Inbound_Wid` ASC),
  CONSTRAINT `Inbound_Approver_id`
    FOREIGN KEY (`Approver_id`)
    REFERENCES `yihawwbz_dbms`.`Staffs` (`Sid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Inbound_Suppliers_Sid`
    FOREIGN KEY (`Suppliers_Sid`)
    REFERENCES `yihawwbz_dbms`.`Suppliers` (`Sid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Inbound_Wid`
    FOREIGN KEY (`Inbound_Wid`)
    REFERENCES `yihawwbz_dbms`.`Warehouses` (`Wid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Suppliers_Order_statistics`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Suppliers_Order_statistics` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Suppliers_Order_statistics` (
  `Sid` CHAR(10) NOT NULL,
  `Completetime` DATETIME NULL DEFAULT NULL,
  `Inbound_Amount` FLOAT NULL,
  `Money` DECIMAL(10,2) NULL,
  `index` INT NOT NULL AUTO_INCREMENT,
  `Inbound_id` CHAR(15) NULL,
  PRIMARY KEY (`index`),
  INDEX `Sid` (`Sid` ASC),
  INDEX `fk_Suppliers_Order_statistics_Inbound1_idx` (`Inbound_id` ASC),
  CONSTRAINT `Inblound_id`
    FOREIGN KEY (`Inbound_id`)
    REFERENCES `yihawwbz_dbms`.`Inbound` (`Inbound_id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Sid`
    FOREIGN KEY (`Sid`)
    REFERENCES `yihawwbz_dbms`.`Suppliers` (`Sid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`User` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`User` (
  `Username` VARCHAR(20) NOT NULL,
  `Password` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`Username`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Inbound_details`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Inbound_details` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Inbound_details` (
  `Inbound_d_id` CHAR(15) NOT NULL,
  `Inbound_id` CHAR(15) NOT NULL,
  `Inbound_Iid` CHAR(15) NOT NULL,
  `Amount` FLOAT NULL DEFAULT NULL,
  `Unit_Price` DECIMAL(10,2) NULL DEFAULT NULL,
  `Inbound_Stockid` CHAR(20) NULL,
  `Completetime` DATETIME NULL,
  PRIMARY KEY (`Inbound_d_id`),
  INDEX `Inbound_idx` (`Inbound_id` ASC),
  INDEX `Iid_idx` (`Inbound_Iid` ASC),
  INDEX `fk_Warehouse_entry_details_Stocks1_idx` (`Inbound_Stockid` ASC),
  CONSTRAINT `Inbound_id`
    FOREIGN KEY (`Inbound_id`)
    REFERENCES `yihawwbz_dbms`.`Inbound` (`Inbound_id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Inbound_Iid`
    FOREIGN KEY (`Inbound_Iid`)
    REFERENCES `yihawwbz_dbms`.`Items` (`Iid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `Inbound_d_stockid`
    FOREIGN KEY (`Inbound_Stockid`)
    REFERENCES `yihawwbz_dbms`.`Stocks` (`Stockid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`History_Stocks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`History_Stocks` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`History_Stocks` (
  `Stockid` CHAR(20) NOT NULL COMMENT '	',
  `Stocks_Wid` INT NULL,
  `Stocks_lid` CHAR(15) NULL,
  `Stockamount` FLOAT NULL,
  `Stockarea` INT NULL,
  `Instocktime` DATETIME NULL,
  `Outstocktime` DATETIME NULL,
  PRIMARY KEY (`Stockid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yihawwbz_dbms`.`Inner_Trasition`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yihawwbz_dbms`.`Inner_Trasition` ;

CREATE TABLE IF NOT EXISTS `yihawwbz_dbms`.`Inner_Trasition` (
  `Transitionid` INT NOT NULL,
  `I_T_Wid` INT NOT NULL,
  `Amount` FLOAT NOT NULL,
  `I_T_Iid` CHAR(15) NOT NULL,
  `Operate` CHAR(1) NULL,
  `Time` DATETIME NULL,
  PRIMARY KEY (`Transitionid`),
  INDEX `fk_Inner_trasition_Products1_idx` (`I_T_Iid` ASC),
  INDEX `I_T_Wid_idx` (`I_T_Wid` ASC),
  CONSTRAINT `I_T_Wid`
    FOREIGN KEY (`I_T_Wid`)
    REFERENCES `yihawwbz_dbms`.`Warehouses` (`Wid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `I_T_Iid`
    FOREIGN KEY (`I_T_Iid`)
    REFERENCES `yihawwbz_dbms`.`Items` (`Iid`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `yihawwbz_dbms`;

DELIMITER $$

USE `yihawwbz_dbms`$$
DROP TRIGGER IF EXISTS `yihawwbz_dbms`.`Outbound_AFTER_INSERT` $$
USE `yihawwbz_dbms`$$
CREATE DEFINER = CURRENT_USER TRIGGER `yihawwbz_dbms`.`Outbound_AFTER_INSERT` AFTER INSERT ON `Outbound` FOR EACH ROW
BEGIN
	INSERT INTO Customers_Order_statistics SET Cid=NEW.Customer_Cid,Outbound_id=NEW.Outbound_id;
END;$$


USE `yihawwbz_dbms`$$
DROP TRIGGER IF EXISTS `yihawwbz_dbms`.`Outbound_details_AFTER_INSERT` $$
USE `yihawwbz_dbms`$$
CREATE DEFINER = CURRENT_USER TRIGGER `yihawwbz_dbms`.`Outbound_details_AFTER_INSERT` AFTER INSERT ON `Outbound_details` FOR EACH ROW
BEGIN
	UPDATE Customer_Order_statistics SET Completetime=NEW.Completetime, Outbound_Amount=NEW.Amount, Money=cast(NEW.Amount AS DECIMAL(10,2))*NEW.Unit_price WHERE Outbound_id=NEW.Outbound_id;
END;$$


USE `yihawwbz_dbms`$$
DROP TRIGGER IF EXISTS `yihawwbz_dbms`.`Stocks_AFTER_INSERT` $$
USE `yihawwbz_dbms`$$
CREATE DEFINER = CURRENT_USER TRIGGER `yihawwbz_dbms`.`Stocks_AFTER_INSERT` AFTER INSERT ON `Stocks` FOR EACH ROW
BEGIN
 INSERT INTO Stock_collection (Iid, Remain_Amount,Wid) VALUES (NEW.Stocks_Iid, NEW.Stockamount, NEW.Stocks_Wid) ON DUPLICATE KEY UPDATE Remain_Amount=Remain_Amount+NEW.Stockamount;
END;
 
    $$


USE `yihawwbz_dbms`$$
DROP TRIGGER IF EXISTS `yihawwbz_dbms`.`Stocks_BEFORE_UPDATE` $$
USE `yihawwbz_dbms`$$
CREATE DEFINER = CURRENT_USER TRIGGER `yihawwbz_dbms`.`Stocks_BEFORE_UPDATE` BEFORE UPDATE ON `Stocks` FOR EACH ROW
BEGIN
	UPDATE Stock_collection set Remain_Amount=Remain_Amount-OLD.Stockamount WHERE Iid=OLD.Stocks_Iid;
END;$$


USE `yihawwbz_dbms`$$
DROP TRIGGER IF EXISTS `yihawwbz_dbms`.`Stocks_AFTER_UPDATE` $$
USE `yihawwbz_dbms`$$
CREATE DEFINER = CURRENT_USER TRIGGER `yihawwbz_dbms`.`Stocks_AFTER_UPDATE` AFTER UPDATE ON `Stocks` FOR EACH ROW
BEGIN
	UPDATE Stock_collection set Remain_Amount=Remain_Amount+NEW.Stockamount WHERE Iid=OLD.Stocks_Iid;
END;$$


USE `yihawwbz_dbms`$$
DROP TRIGGER IF EXISTS `yihawwbz_dbms`.`Stocks_BEFORE_DELETE` $$
USE `yihawwbz_dbms`$$
CREATE DEFINER = CURRENT_USER TRIGGER `yihawwbz_dbms`.`Stocks_BEFORE_DELETE` BEFORE DELETE ON `Stocks` FOR EACH ROW
BEGIN
	UPDATE Stock_collection SC SET Remain_Amount=Remain_Amount-OLD.Stockamount WHERE SC.Iid=OLD.Stocks_Iid;
    INSERT INTO History_Stocks SET Stockid=OLD.stockid, Stocks_Wid=OLD.Stocks_Wid, Stocks_Iid=OLD.Stocks_Iid, Stockamount=OLD.Stockamount, Stockarea=OLD.Stockarea, Instocktime=OLD.Instocktime, Outstocktime=NOW();
END;
    $$


USE `yihawwbz_dbms`$$
DROP TRIGGER IF EXISTS `yihawwbz_dbms`.`Inbound_AFTER_INSERT` $$
USE `yihawwbz_dbms`$$
CREATE DEFINER = CURRENT_USER TRIGGER `yihawwbz_dbms`.`Inbound_AFTER_INSERT` AFTER INSERT ON `Inbound` FOR EACH ROW
BEGIN
	INSERT INTO Suppliers_Order_statistics SET Sid=NEW.Suppliers_Sid, Inbound_id=NEW.Inbound_id;
END;$$


USE `yihawwbz_dbms`$$
DROP TRIGGER IF EXISTS `yihawwbz_dbms`.`Inbound_details_AFTER_INSERT` $$
USE `yihawwbz_dbms`$$
CREATE DEFINER = CURRENT_USER TRIGGER `yihawwbz_dbms`.`Inbound_details_AFTER_INSERT` AFTER INSERT ON `Inbound_details` FOR EACH ROW
BEGIN
	UPDATE Suppliers_Order_statistics SET Completetime=NEW.Completetime, Inbound_Amount=NEW.Amount, Money=cast(NEW.Amount AS DECIMAL(10,2))*NEW.Unit_Price WHERE Inbound_id=NEW.Inbound_id;
END;$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
