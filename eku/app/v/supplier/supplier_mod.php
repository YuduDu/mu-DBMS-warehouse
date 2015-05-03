<form class="form-inline" method="post" action="">
  <div class="form-group">
    <label>Supplier Company Name</label>
    <input type="text" value="<?php echo $res['Sname'];?>" name="Sname" class="form-control">
  </div>
  <div class="form-group">
    <label>Supplier Company Contact</label>
    <input type="text"  value="<?php echo $res['Scontact'];?>"  name="Scontact" class="form-control">
  </div>
  <div class="form-group">
    <label>Supplier Address</label>
    <input type="text" value="<?php echo $res['Saddress'];?>"  name="Saddress" class="form-control">
  </div>
  <br>

  <div class="form-group">
    <label>Zip code</label>
    <input type="text"  value="<?php echo $res['Spostcode'];?>" name="Spostcode" class="form-control">
  </div>
  <div class="form-group">
    <label>Phone</label>
    <input type="text"  value="<?php echo $res['Sphone'];?>" name="Sphone" class="form-control">
  </div>
  <div class="form-group">
    <label>Bank Name</label>
    <input type="text" value="<?php echo $res['Sbank'];?>"  name="Sbank" class="form-control">
  </div>
  <br>

  <div class="form-group">
    <label>Bank Account</label>
    <input type="text"  value="<?php echo $res['Saccount'];?>" name="Saccount" class="form-control">
  </div>
  
  <br><div class="form-group">
    <button type="submit" name="supplier_mod" class="btn btn-default">修改</button>
  </div>
</form>