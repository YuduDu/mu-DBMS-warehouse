--1
SELECT Remain_Amount
FROM Stock_collection
WHERE Iid= <id>;

--2

SELECT *
FROM Inbound ib,Inbound_details ibd,Items it
WHERE ib.CreateTime>= <start>
       AND ib.CreateTime<= <end>
       AND ib.Iid = ibd.Inbound_Iid;
       
       
       
--3
SELECT sid,sname
FROM Staffs
WHERE sid IN 
    (
        SELECT Approver_id 
        FROM Inbound ib,Inbound_details ibd
        WHERE ib.Inbound_id=ibd.Inbound_id
            AND ibd.Inbound_Iid=<item id>
    );


--4
SELECT *
FROM Inbound ib,Staffs stf
WHERE ib.CreateTime>= <start>
      AND ib.CreateTime<= <end>
      AND stf.sid=ib.sid;


--5
SELECT COUNT(*)
FROM Inbound ib, Inbound_details ibd,Items it
WHERE ib.Inbound_id=ibd.Inbound_id
      AND ibd.Inbound_Iid=it.Iid
      AND ib.sid=<sid>
GROUP BY ibd.Inbound_Iid;

--6

SELECT it.name, it.Iid,COUNT(*)
FROM Customers C, Outbound ob,Outbound_details obd,Items it
WHERE C.cid=ob.cid
    AND obd.Outbound_id=ob.Outbound_id
    AND obd.Outbound_Iid=it.Iid
    AND ob.createTime<= <start>
    AND ob.CreateTime>= <end>
GROUP BY it.Iid;




7
SELECT distinct *
FROM Customers
WHERE cid in
	( 
	SELECT cid FROM Outbound ob, Outbound_details obd
	WHERE ob.Outbound_id = obd.Outbound_id
	AND obd.Outbound_Iid IN
		( 
		SELECT cid FROM item
		WHERE cid= <cid>
		)
	);


8

SELECT Stockarea
FROM Inbound_details, Stocks
WHERE Inbound_id= <id>
AND Inbound_Stockid = Stockid;


9.
SELECT Stockarea, SUM(Stockamount)
FROM Stocks
WHERE Stockarea = <stock_area>;

10.
SELECT SC.Iid, COUNT (*) AS CT
FROM Stocks_collection SC
GROUP BY SC.Iid 
HAVING CT< SC.Minimum;