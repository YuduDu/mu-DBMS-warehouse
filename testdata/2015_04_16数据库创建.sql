DROP DATABASE IF EXISTS final_project;
CREATE DATABASE IF NOT EXISTS final_project;
USE final_project;

-- create tables

DROP TABLE IF EXISTS Customers ;
DROP TABLE IF EXISTS Staff_Category ;
DROP TABLE IF EXISTS Staffs ;
DROP TABLE IF EXISTS Warehouses;
DROP TABLE IF EXISTS Outbound ;
DROP TABLE IF EXISTS Customer_Order_statistics ;
DROP TABLE IF EXISTS Item_Category ;
DROP TABLE IF EXISTS Items ;
DROP TABLE IF EXISTS Outbound_details ;
DROP TABLE IF EXISTS Stock_collection ;
DROP TABLE IF EXISTS Stocks ;
DROP TABLE IF EXISTS Suppliers ;
DROP TABLE IF EXISTS Inbound ;
DROP TABLE IF EXISTS Suppliers_Order_statistics ;
DROP TABLE IF EXISTS User ;
DROP TABLE IF EXISTS History_Stocks ;
DROP TABLE IF EXISTS Inner_Trasition ;

-- Table Customers

CREATE TABLE IF NOT EXISTS Customers (
  Cid INT NOT NULL AUTO_INCREMENT,
  Cname VARCHAR(50) NOT NULL, 
  Ccontact VARCHAR(50) NULL DEFAULT NULL,--
  Caddress VARCHAR(500) NULL DEFAULT NULL,
  Cpostcode CHAR(6) NULL DEFAULT NULL,
  Cphone VARCHAR(20) NULL DEFAULT NULL,
  Cbank VARCHAR(20) NULL DEFAULT NULL,
  Caccount VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (Cid))
ENGINE = InnoDB;

-- Table Staff_Category

CREATE TABLE IF NOT EXISTS Staff_Category (
  SCid INT NOT NULL,
  SType VARCHAR(20) NOT NULL,
  PRIMARY KEY (SCid))
ENGINE = InnoDB;

-- Table Staffs

CREATE TABLE IF NOT EXISTS Staffs (
  Sid INT NOT NULL AUTO_INCREMENT,
  Sname VARCHAR(20) NOT NULL,
  SCid INT NULL DEFAULT NULL,
  PRIMARY KEY (Sid),
  INDEX Scid_idx (SCid ASC),
  CONSTRAINT Staffs_SCid
    FOREIGN KEY (SCid)
    REFERENCES Staff_Category (SCid)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Table Warehouses

CREATE TABLE IF NOT EXISTS Warehouses (
  Wid INT NOT NULL AUTO_INCREMENT,
  Admin_id INT NULL DEFAULT NULL,
  PRIMARY KEY (Wid),
  INDEX Admin_idx (Admin_id ASC),
  CONSTRAINT Warehouses_Admin_id
    FOREIGN KEY (Admin_id)
    REFERENCES Staffs (Sid)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Table Outbound

CREATE TABLE IF NOT EXISTS Outbound (
  Outbound_id INT NOT NULL AUTO_INCREMENT,
  Customer_Cid INT NULL DEFAULT NULL,
  Createtime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  Approver_id INT NULL DEFAULT NULL,
  Consignee VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (Outbound_id),
  INDEX Cid_idx (Customer_Cid ASC),
  INDEX Approver_idx (Approver_id ASC),
  CONSTRAINT Outbound_Cid
    FOREIGN KEY (Customer_Cid)
    REFERENCES Customers (Cid)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT Outbound_Approver_id
    FOREIGN KEY (Approver_id)
    REFERENCES Staffs (Sid)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Table Customer_Order_statistics

CREATE TABLE IF NOT EXISTS Customer_Order_statistics (
  Cid INT NOT NULL,
  Outbound_Amount FLOAT NULL,
  Money DECIMAL(10,2) NULL,
  Outbound_id INT NULL,
  CreateTime TIMESTAMP, -- new
  PRIMARY KEY (Outbound_id),
  INDEX Customers1_Cid (Cid ASC),
  INDEX Outbound_id (Outbound_id ASC),
  CONSTRAINT Cid
    FOREIGN KEY (Cid)
    REFERENCES Customers (Cid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT Outbound_id
    FOREIGN KEY (Outbound_id)
    REFERENCES Outbound (Outbound_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- Table Item Category

CREATE TABLE IF NOT EXISTS Item_Category (
  ICname VARCHAR(50) NOT NULL,
  Spec VARCHAR(45) NULL,
  PRIMARY KEY (ICname))
ENGINE = InnoDB;

-- Table Items

CREATE TABLE IF NOT EXISTS Items (
  Iname VARCHAR(100) NOT NULL,
  ICname VARCHAR(50) NULL,
  Unit VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (Iname, ICname),
  INDEX Pcid_idx (Iname ASC),
  CONSTRAINT Items_ICid
    FOREIGN KEY (ICname)
    REFERENCES Item_Category (ICname)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Table Outbound_details

CREATE TABLE IF NOT EXISTS Outbound_details (
  Outbound_id INT NOT NULL,
  Outbound_Iname VARCHAR(100) NOT NULL,
  Amount FLOAT NULL DEFAULT NULL,
  Unit_price DECIMAL(10,2) NULL,
  Warehouse_Wid INT NOT NULL,
  PRIMARY KEY (Outbound_Iname, Outbound_id),
  INDEX Outbound_id_idx (Outbound_id ASC),
  INDEX Outbound_Iname_idx (Outbound_Iname ASC),
  INDEX Outbound_Warehouse_idx (Warehouse_Wid ASC),
  CONSTRAINT D_Outbound_id
    FOREIGN KEY (Outbound_id)
    REFERENCES Outbound (Outbound_id)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT D_Outbound_Iname
    FOREIGN KEY (Outbound_Iname)
    REFERENCES Items (Iname)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT Outbound_Warehouse_Wid
  	FOREIGN KEY (Warehouse_Wid)
  	REFERENCES Warehouses (Wid)
  	ON DELETE NO ACTION
  	ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- Table Stock_collection

CREATE TABLE IF NOT EXISTS Stock_collection (
  Remain_Amount FLOAT NOT NULL,
  Items_Iname VARCHAR(100) NOT NULL,
  Wid INT NULL,
  PRIMARY KEY (Items_Iname),
  Minimum FLOAT NOT NULL,
  Maximum FLOAT NOT NULL,
  INDEX Stock_collection_Items1_idx (Items_Iname ASC),
  INDEX Stock_collection_Wid_idx (Wid ASC),
  CONSTRAINT Stock_collection_Iname
    FOREIGN KEY (Items_Iname)
    REFERENCES Items (Iname)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT Stock_collection_Wid
    FOREIGN KEY (Wid)
    REFERENCES Warehouses (Wid)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Table Stocks

CREATE TABLE IF NOT EXISTS Stocks (
  Stockid INT NOT NULL AUTO_INCREMENT,
  Stocks_Wid INT NOT NULL,
  Stocks_Iname VARCHAR(100) NOT NULL,
  Stockamount FLOAT NOT NULL,
  Stockarea INT NULL DEFAULT NULL,
  Instocktime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (Stockid),
  INDEX Wid_idx (Stocks_Wid ASC),
  INDEX Pid_idx (Stockid ASC),
  CONSTRAINT Stocks_Wid
    FOREIGN KEY (Stocks_Wid)
    REFERENCES Warehouses (Wid)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT Stocks_Iname
    FOREIGN KEY (Stocks_Iname)
    REFERENCES Items (Iname)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Table Suppliers

CREATE TABLE IF NOT EXISTS Suppliers (
  Sid INT NOT NULL AUTO_INCREMENT,
  Sname VARCHAR(50) NOT NULL,
  Scontact VARCHAR(50) NULL DEFAULT NULL,
  Saddress VARCHAR(500) NULL DEFAULT NULL,
  Spostcode CHAR(6) NULL DEFAULT NULL,
  Sphone VARCHAR(20) NULL DEFAULT NULL,
  Sbank VARCHAR(20) NULL DEFAULT NULL,
  Saccount VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (Sid))
ENGINE = InnoDB;

-- Table Inbound

CREATE TABLE IF NOT EXISTS Inbound (
  Inbound_id INT NOT NULL AUTO_INCREMENT,
  CreateTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  Approver_id INT NULL DEFAULT NULL,
  Suppliers_Sid INT NOT NULL,
  Deliverer VARCHAR(20) NULL,
  PRIMARY KEY (Inbound_id),
  INDEX Approver_idx (Approver_id ASC),
  INDEX Warehouse_entry_Suppliers1_idx (Suppliers_Sid ASC),
  CONSTRAINT Inbound_Approver_id
    FOREIGN KEY (Approver_id)
    REFERENCES Staffs (Sid)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT Inbound_Suppliers_Sid
    FOREIGN KEY (Suppliers_Sid)
    REFERENCES Suppliers (Sid)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Table Suppliers_Order_statistics

CREATE TABLE IF NOT EXISTS Suppliers_Order_statistics (
  Sid INT NOT NULL,
  CreateTime DATETIME NULL DEFAULT NULL,
  Money DECIMAL(10,2) NULL,
  Inbound_id INT NULL,
  PRIMARY KEY (Inbound_id),
  INDEX Sid (Sid ASC),
  INDEX fk_Suppliers_Order_statistics_Inbound1_idx (Inbound_id ASC),
  CONSTRAINT Inblound_id
    FOREIGN KEY (Inbound_id)
    REFERENCES Inbound (Inbound_id)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT Sid
    FOREIGN KEY (Sid)
    REFERENCES Suppliers (Sid)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Table User

CREATE TABLE IF NOT EXISTS User (
  Username VARCHAR(20) NOT NULL,
  Password VARCHAR(20) NOT NULL,
  Staffs_Sid int NOT NULL,
  PRIMARY KEY (Username),
  INDEX User_Staff_idx (Staffs_Sid ASC),
  CONSTRAINT User_Staff
  	FOREIGN KEY (Staffs_Sid)
  	REFERENCES Staffs (sid)
  	ON DELETE NO ACTION
  	ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- Table Inbound_details

CREATE TABLE IF NOT EXISTS Inbound_details (
  Inbound_id INT NOT NULL,
  Inbound_Iname VARCHAR(100) NOT NULL,
  Amount FLOAT NULL DEFAULT NULL,
  Unit_Price DECIMAL(10,2) NULL DEFAULT NULL,
  Inbound_Stockid INT NULL,
  PRIMARY KEY (Inbound_id,Inbound_Iname),
  INDEX Inbound_idx (Inbound_id ASC),
  INDEX Iid_idx (Inbound_Iname ASC),
  INDEX Warehouse_entry_details_Stocks1_idx (Inbound_Stockid ASC),
  CONSTRAINT Inbound_id
    FOREIGN KEY (Inbound_id)
    REFERENCES Inbound (Inbound_id)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT Inbound_Iid
    FOREIGN KEY (Inbound_Iname)
    REFERENCES Items (Iname)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT Inbound_d_stockid
    FOREIGN KEY (Inbound_Stockid)
    REFERENCES Stocks (Stockid)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Table History_Stocks

CREATE TABLE IF NOT EXISTS History_Stocks (
  Stockid INT NOT NULL ,
  Stocks_Wid INT NULL,
  Stocks_lname VARCHAR(100) NULL,
  Stockamount FLOAT NULL,
  Stockarea INT NULL,
  Instocktime DATETIME NULL,
  Outstocktime DATETIME NULL,
  PRIMARY KEY (Stockid))
ENGINE = InnoDB;

-- Table Inner_Trasition

CREATE TABLE IF NOT EXISTS Inner_Trasition (
  Transitionid INT NOT NULL,
  I_T_Wid INT NOT NULL,
  Amount FLOAT NOT NULL,
  Items_Iname VARCHAR(100) NOT NULL,
  Operate CHAR(1) NULL,
  Time DATETIME NULL,
  PRIMARY KEY (Transitionid),
  INDEX fk_Inner_trasition_Products1_idx (Items_Iname ASC),
  INDEX I_T_Wid_idx (I_T_Wid ASC),
  CONSTRAINT I_T_Wid
    FOREIGN KEY (I_T_Wid)
    REFERENCES Warehouses (Wid)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT I_T_Iname
    FOREIGN KEY (Items_Iname)
    REFERENCES Items (Iname)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- create triggers

DROP TRIGGER IF EXISTS Outbound_AFTER_INSERT;
DROP TRIGGER IF EXISTS Outbound_details_AFTER_INSERT;
DROP TRIGGER IF EXISTS Stocks_AFTER_INSERT;
DROP TRIGGER IF EXISTS Stocks_BEFORE_UPDATE;
DROP TRIGGER IF EXISTS Stocks_AFTER_UPDATE;
DROP TRIGGER IF EXISTS Stocks_BEFORE_DELETE;
DROP TRIGGER IF EXISTS Inbound_AFTER_INSERT;
DROP TRIGGER IF EXISTS Inbound_details_AFTER_INSERT;

DELIMITER $$
CREATE TRIGGER Outbound_AFTER_INSERT AFTER INSERT ON Outbound FOR EACH ROW
BEGIN
	INSERT INTO Customer_Order_statistics SET Outbound_id=NEW.Outbound_id, Cid=NEW.Customer_Cid, CreateTime=New.CreateTime;
END;

CREATE TRIGGER Outbound_details_AFTER_INSERT AFTER INSERT ON Outbound_details FOR EACH ROW
BEGIN
	UPDATE Customer_Order_statistics SET Money=Money+cast(NEW.Amount AS DECIMAL(10,2))*NEW.Unit_price WHERE Outbound_id=NEW.Outbound_id;
END;

CREATE TRIGGER Stocks_AFTER_INSERT AFTER INSERT ON Stocks FOR EACH ROW
BEGIN
 INSERT INTO Stock_collection (Items_Iname, Remain_Amount,Wid) VALUES (NEW.Stocks_Iname, NEW.Stockamount, NEW.Stocks_Wid) ON DUPLICATE KEY UPDATE Remain_Amount=Remain_Amount+NEW.Stockamount;
END;

CREATE TRIGGER Stocks_BEFORE_UPDATE BEFORE UPDATE ON Stocks FOR EACH ROW
BEGIN
	UPDATE Stock_collection set Remain_Amount=Remain_Amount-OLD.Stockamount WHERE Iid=OLD.Stockid;
END;

CREATE TRIGGER Stocks_AFTER_UPDATE AFTER UPDATE ON Stocks FOR EACH ROW
BEGIN
	UPDATE Stock_collection set Remain_Amount=Remain_Amount+NEW.Stockamount WHERE Iid=OLD.Stockid;
END;

CREATE TRIGGER Stocks_BEFORE_DELETE BEFORE DELETE ON Stocks FOR EACH ROW
BEGIN
	UPDATE Stock_collection SC SET Remain_Amount=Remain_Amount-OLD.Stockamount WHERE SC.Items_Iname=OLD.Stocks_Iname;
    INSERT INTO History_Stocks SET Stockid=OLD.stockid, Stocks_Wid=OLD.Stocks_Wid, Stocks_Iname=OLD.Stocks_Iname, Stockamount=OLD.Stockamount, Stockarea=OLD.Stockarea, Instocktime=OLD.Instocktime, Outstocktime=NOW();
END;

CREATE TRIGGER Inbound_AFTER_INSERT AFTER INSERT ON Inbound FOR EACH ROW
BEGIN
	INSERT INTO Suppliers_Order_statistics SET Sid=NEW.Suppliers_Sid, Inbound_id=NEW.Inbound_id, CreateTime=NEW.CreateTime;
END;

CREATE TRIGGER Inbound_details_AFTER_INSERT AFTER INSERT ON Inbound_details FOR EACH ROW
BEGIN
	UPDATE Suppliers_Order_statistics SET Money=Money+cast(NEW.Amount AS DECIMAL(10,2))*NEW.Unit_Price WHERE Inbound_id=NEW.Inbound_id;
END; $$

DELIMITER $$

