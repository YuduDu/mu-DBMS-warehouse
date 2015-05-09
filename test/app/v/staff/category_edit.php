<form class="form-inline" method="post" action="">
  <div class="form-group">
    <label>Staff Class ID</label>
    <input type="text" value="<?php echo $category['SCid'];?>" name="SCid" class="form-control">
  </div>
  <div class="form-group">
    <label>Staff Class Details</label>
    <input type="text" value="<?php echo $category['SType'];?>" name="SType" class="form-control">
  </div>
  
  <br><div class="form-group">
    <button type="submit" name="category_edit" class="btn btn-default">Edit</button>
  </div>
</form>