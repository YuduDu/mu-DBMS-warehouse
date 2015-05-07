<form class="form-inline" method="post" action="">
  <div class="form-group">
      <label>Inbound Checker ID<?php echo $_SESSION['STOCK_Sid'];?></label>
      <input type="hidden" name="Approver_id" value="<?php echo $_SESSION['STOCK_Sid'];?>">
  </div>
  <br>

  <div class="radio">
    <!--<label>Choose exist from Inbound list:</label>-->
      <label>Exist Inbound</label> <input type="radio" name="InboundStyle" value="1" checked>
      <label>Create Inbound</label> <input type="radio" name="InboundStyle" value="2">
  </div>
  <br>

  <select class="form-control _old_inbound" name="Inbound_id_old" style="margin-left:20px;min-width:240px;">
    <?php foreach($inbound as $v){ ?>
    <option value="<?php echo $v['Inbound_id'];?>"><?php echo $v['Inbound_id'].'; Supplier ID:'.$v['Suppliers_Sid'].' ;Deliverer: '.$v['Deliverer'];?></option>
    <?php }?>
  </select>
  <br class="_old_inbound">

  <div class="_new_inbound" style="display:none;">
    <div class="form-group">
      <label>Supplier ID</label>
      <input type="text" name="Suppliers_Sid" class="form-control">
    </div>
    <div class="form-group">
      <label>Deliverer:</label>
      <input type="text" name="Deliverer" class="form-control" >
    </div>
  </div>

  <div class="form-group">
    <label>Item Code:</label>
    <input type="text" name="Inbound_Iname" class="form-control">
  </div>
  <div class="form-group">
    <label>Warehouse Code:</label>
    <input type="text" name="Warehouse_Wid" class="form-control" >
  </div>
  <div class="form-group">
    <label>Area Code</label>
    <input type="text" name="Stockarea" class="form-control" >
  </div><br>
  <div class="form-group">
    <label style="padding-left:18px">Amount</label>
    <input type="text" name="Amount" class="form-control" >
  </div>
  <div class="form-group">
    <label style="padding-left:48px">Unit Price</label>
    <input type="text" name="Unit_Price" class="form-control" >
  </div>
  
  <br><div class="form-group"><button type="submit" name="addInBound" class="btn btn-default">Add this Item</button></div>
</form>

<script type="text/javascript">
$(function(){
    $('input[name="InboundStyle"]').click(function(){
        var val = $(this).val();
        if(val == "1"){
            $('._old_inbound').show();
            $('._new_inbound').hide();
        }else{
            $('._old_inbound').hide();
            $('._new_inbound').show();
        }
    });
});
</script>