<form class="form-inline" method="post" action="">
  <div class="form-group">
    <label>供应商名字</label>
    <input type="text" value="<?php echo $res['Sname'];?>" name="Sname" class="form-control">
  </div>
  <div class="form-group">
    <label>供应商联系人</label>
    <input type="text"  value="<?php echo $res['Scontact'];?>"  name="Scontact" class="form-control">
  </div>
  <div class="form-group">
    <label>供应商地址</label>
    <input type="text" value="<?php echo $res['Saddress'];?>"  name="Saddress" class="form-control">
  </div>
  <br>

  <div class="form-group">
    <label>供应商的邮编</label>
    <input type="text"  value="<?php echo $res['Spostcode'];?>" name="Spostcode" class="form-control">
  </div>
  <div class="form-group">
    <label>供应商电话</label>
    <input type="text"  value="<?php echo $res['Sphone'];?>" name="Sphone" class="form-control">
  </div>
  <div class="form-group">
    <label>供应商银行</label>
    <input type="text" value="<?php echo $res['Sbank'];?>"  name="Sbank" class="form-control">
  </div>
  <br>

  <div class="form-group">
    <label>供应商银行地址</label>
    <input type="text"  value="<?php echo $res['Saccount'];?>" name="Saccount" class="form-control">
  </div>
  
  <br><div class="form-group">
    <button type="submit" name="supplier_mod" class="btn btn-default">修改</button>
  </div>
</form>