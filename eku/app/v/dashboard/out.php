<form class="form-inline" method="post" action="">
  <div class="form-group">
      <label>Outbound Approver ID<?php echo $_SESSION['STOCK_Sid'];?></label>
      <input type="hidden" name="Approver_id" value="<?php echo $_SESSION['STOCK_Sid'];?>">
  </div>
  <br>

  <div class="form-group">
    <label>Customer ID</label>
    <input type="text" name="Customer_Cid" class="form-control" style="width:182px;">
  </div>
  <div class="form-group">
    <label>Deliverer</label>
    <input type="text" name="Consignee" class="form-control" >
  </div><br>

  <label>Choose Stock</label>
  <select class="form-control" name="Stock_id_old">
    <?php foreach($stock as $v){ ?>
    <option value="<?php echo $v['Stockid'];?>"><?php echo $v['Stocks_Iname'].' Warehouse:'.$v['Stocks_Wid'].', Amount'.$v['Stockamount'];?></option>
    <?php }?>
  </select>
  <div class="form-group" style="margin-left:14px">
  <label style="margin-left:24px">Amount</label>
    <input type="text" name="Amount" class="form-control" >
  </div>
  <label style="margin-left:24px">Unit Price</label>
    <input type="text" name="unitprice" class="form-control" >
  </div>
  <br><div class="form-group"><button type="submit" name="outBound" class="btn btn-default">ADD</button></div>
</form>