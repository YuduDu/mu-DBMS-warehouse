USE `final_project` ;
SET sql_safe_updates=0;

DELETE Customers.* FROM  Customers;
LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Customers.txt' INTO TABLE Customers
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';


DELETE Staff_Category.* from Staff_Category;
LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Staff_Category.txt' INTO TABLE Staff_Category
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';


DELETE Staffs.* from Staffs;
LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Staffs.txt' INTO TABLE Staffs
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';


DELETE Warehouses.* from Warehouses;
LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Warehouses.txt' INTO TABLE Warehouses
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';



DELETE Outbound.* from Outbound;
LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Outbound.txt' INTO TABLE Outbound
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';



DELETE Item_Category.* from Item_Category;
LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Item_Category.txt' INTO TABLE Item_Category
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';


DELETE Items.* from Items;
LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Items.txt' INTO TABLE Items
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';


DELETE Outbound_details.* from Outbound_details;
LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Outbound_details.txt' INTO TABLE Outbound_details
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';


LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Stocks.txt' INTO TABLE Stocks
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';



LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Suppliers.txt' INTO TABLE Suppliers
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';


LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Inbound.txt' INTO TABLE Inbound
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';


LOAD DATA LOCAL INFILE '/Users/ming/projects/mu-DBMS-warehouse/testdata/Inbound_details.txt' INTO TABLE Inbound_details
FIELDS TERMINATED BY '\t' ESCAPED BY '\b';