<form class="form-inline" method="post" action="">
  <div class="form-group">
    <label>Item Code</label>
    <input type="text" value="<?php echo $res['Iname'];?>" name="Iname" class="form-control">
  </div>
  <div class="form-group">
    <label>Item Category</label>
    <input type="text" value="<?php echo $res['ICname'];?>" name="ICname" class="form-control">
  </div>
  <div class="form-group">
    <label>Item Unit</label>
    <input type="text" value="<?php echo $res['Unit'];?>" name="Unit" class="form-control">
  </div>
  
  <br><div class="form-group">
    <button type="submit" name="item_edit" class="btn btn-default">Edit</button>
  </div>
</form>