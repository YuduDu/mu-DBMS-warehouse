Pre-proposal Notes
-----

2015.03.02 Night - Chunhui Xu

1. 数据来源 客户信息（
2. 逻辑关系图
lotion pump

**10 queries**

1. 以产品种类分，在库存里查询数量。
2. 查询某一日期的入库情况
3. 根据库存项，查询这批货物的接收人。
4. 按不同的残酷管理员，查询他所负责的进货数量。
5. 按供货商分类，查询从他这里的原料来源数量/种类
6. 按一定时间内，销售给某以客户的货物数量/种类
7. 按客户的销售数量排序，调取客户信息。
8. 通过入库单，查询目前这批货物的放置位置。
9. 按stockarea查询，盘点货物的目前数量。
10. 

-----

2015.03.03 Afternoon - Yihan Xu

**10 Queries:**

1. 根据产品编号查询该产品的成品库存量：check how many products are left in inventory according to its product id
2. 查询某一日期的入库清单：list the warehouse entry details in a certain period
3. 根据库存项查询经办该批货物入库的管理员: check the identity information of the warehouse-keeper who created the inbound record of a certain batch of goods
4. 查询某一日期某仓库管理员经办的入库事项: list records of the material checking in events created by a certain warehouse-keeper in a certain period
5. 查询库存中某一供应商所供原料的数量及原料编号: check the amount and id of the material provided by a certain supplier
6. 查询某一时间段内某客户所采购的货物数量及产品编号: list the amount and id of products purchased by a certain client in a certain period
7. 根据某一产品编号查询采购过该产品的客户: list all clients that have purchased a certain product according to its product id.
8. 通过入库单查询该批原料的存放位置: check the location of a batch of material in the warehouse according to the warehouse entry number
9. 查询某一仓库区域的物品数量: check the amount of item in a certain area of warehouse
10. 查询库存量低于自定义安全值的原料编号: list the id of material in inventory whose current amount is lower than safe value.

-----

2015.03.04 Afternoon - Yihan Xu

**Contribution by each member so far:**

Ming Du: 
- Database planning
- Decided development environment and languages to be used
- Discussed database structure and queries

Yudu Du: 
- Database planning
- ER Diagram and model
- Revised tables and relationship in database

Yihan Xu: 
- Database planning
- Created tables in database
- Discussed database structure and queries
- Project schedule

Chunhui Xu: 
- Database planning
- Acquired detailed information about client
- Discussed database struture and queries

**Workload Plan**

Ming Du: 
- Mainly responsible for database implementation. Also participate in the entire progress of the development

Yudu Du: 
- Mainly responsible for database planning and designing. Also partcipate in the entire progress of the development.

Yihan Xu: 
- Mainly responsible for project planning and managing. Also participate in the entire progress of the development.

Chunhui Xu: 
- Mainly responsible for report writing. Also participate in the entire progress of the development.

Every team member has his main responsibility and is supposed to dispatch his small tasks and complete other members' small tasks to complete the whole project.

**Weekly Schedule**

Mar 2 - Mar 8: 
- Database Structure
- Data Collection Method and Client information
- E-R Diagram
- Pre-Preposal report

Mar 9 - Mar 15:
- Database Planning
- Database Designing

Mar 16 - Mar 22:
- Software Planning Contd.
- Software Designing Contd.
- Software Prototying

Mar 23 - Mar 29:
- Database Implementation
- Software Implementation

Mar 30 - Apr 5:
- Database Implementatioin Contd.
- Software Implementation Contd.

Apr 6 - Apr 12:
- Database Implementation Contd.
- Software Implementation Contd.

Apr 13 - Apr 19:
- Database Implementation Contd.
- Software Implementation Contd.

Apr 20 - Apr 26:
- System Testing
- System Refinement

Apr 27 - May 3:
- System Refinement
- Report Writing
- Presentation Preparing

May 4 - May 10:
- Report Refinement
- Presentation Refinement


-----
2015.03.06 Night - Yihan

1. $$ ({ \sigma  }_{ <iid> }Items)\bowtie Stocks $$

2. $$ ({ \sigma  }_{ Start<CreateTime \&  End>CreateTime }Inbound) \bowtie Inbound\_details \bowtie Items $$

3. $$ { \pi  }_{ Sid, Sname }Staffs\bowtie ({ \sigma  }_{ Approver\_ id=<id> }Inbound) $$

4. $$ ({ \sigma  }_{ Sid=<id> }Staff)\bowtie ({ \sigma  }_{ <st><CreateTime<<end> }Inbound) $$

5. $$ ({ \sigma  }_{ Sid=<Sid> }Inbound)\bowtie Inbound\_ details \bowtie Items $$

6. $$ ({ \sigma  }_{ CreateTime }Inbound)\bowtie Inbound\_ details\bowtie Customers \bowtie Items $$

7. $$ ({ \sigma  }_{ Iid=<id> }Items)\bowtie Outbound\_ details\bowtie Outbound\bowtie Customers $$

8. $$ { \pi }_{ StockArea }({ \sigma }_{ Inbound\_id=id }Inbound\_details) \bowtie Stocks $$
