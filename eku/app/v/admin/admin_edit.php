<h4>Modify User Information</h4>
<form class="form-inline" method="post" action="">
  <div class="form-group">
    <label>User Name</label>
    <input type="text" disabled value="<?php echo $user['Username'];?>" name="Username" class="form-control">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="text" name="Password" value="<?php echo $user['Password'];?>" class="form-control">
  </div>
  <div class="form-group">
    <label>Staff ID</label>
    <input type="text" name="Staffs_Sid" value="<?php echo $user['Staffs_Sid'];?>" class="form-control">
  </div>
  
  <br><div class="form-group">
    <button type="submit" name="admin_edit" class="btn btn-default">Save Change</button>
  </div>
</form>