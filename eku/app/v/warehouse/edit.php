<form class="form-inline" method="post" action="">
  <div class="form-group">
    <label>Warehouse Code</label>
    <input type="text" disabled value="<?php echo $res['Wid'];?>" name="Wid" class="form-control">
  </div>
  <div class="form-group">
    <label>In Charge Staff ID</label>
    <input type="text" value="<?php echo $res['Admin_id'];?>" name="Admin_id" class="form-control">
  </div>
  
  <br><div class="form-group">
    <button type="submit" name="warehouses_edit" class="btn btn-default">Edit</button>
  </div>
</form>