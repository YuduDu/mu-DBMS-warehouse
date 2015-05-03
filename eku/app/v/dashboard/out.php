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

  <label>选择出货单组</label>
  <select class="form-control" name="Inbound_id_old">
    <?php foreach($inbound as $v){ ?>
    <option value="<?php echo $v['Inbound_id'];?>"><?php echo $v['Inbound_id'].': '.$v['Inbound_Iname'].',Amount'.$v['Amount'];?></option>
    <?php }?>
  </select>
  <div class="form-group" style="margin-left:14px">
    <label>Amount</label>
    <input type="text" name="Amount" class="form-control" >
  </div>

  <br><div class="form-group"><button type="submit" name="outBound" class="btn btn-default">添加出货</button></div>
</form>