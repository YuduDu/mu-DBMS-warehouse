<form class="form-inline" method="post" action="">
  <div class="form-group">
    <label>Customer  Name</label>
    <input type="text" value="<?php echo $res['Cname'];?>" name="Cname" class="form-control">
  </div>
  <div class="form-group">
    <label>Customer Contact Name</label>
    <input type="text" name="Ccontact" value="<?php echo $res['Ccontact'];?>" class="form-control">
  </div>
  <div class="form-group">
    <label>Customer Address</label>
    <input type="text" name="Caddress" value="<?php echo $res['Caddress'];?>" class="form-control">
  </div>
  <div class="form-group">
    <label>Zip code</label>
    <input type="text" name="Cpostcode" value="<?php echo $res['Cpostcode'];?>" class="form-control">
  </div>
  <div class="form-group">
    <label>Phone</label>
    <input type="text" name="Cphone" value="<?php echo $res['Cphone'];?>" class="form-control">
  </div>
  <div class="form-group">
    <label>Bank Name</label>
    <input type="text" name="Cbank" value="<?php echo $res['Cbank'];?>" class="form-control">
  </div>
  <div class="form-group">
    <label>Bank Account</label>
    <input type="text" name="Caccount" value="<?php echo $res['Caccount'];?>" class="form-control">
  </div>
  
  <br><div class="form-group">
    <button type="submit" name="customer_edit" class="btn btn-default">Save Changes</button>
  </div>
</form>