<form class="form-inline" method="post" action="">
  <div class="form-group">
    <label>Staff ID</label>
    <input type="text" value="<?php echo $user['Staffs_Sid'];?>" disabled name="Staffs_Sid" class="form-control">
    <input type="hidden" value="<?php echo $user['Staffs_Sid'];?>" name="Staffs_Sid">
  </div>
  <div class="form-group">
    <label>User Name</label>
    <input type="text" value="<?php echo $user['Username'];?>" disabled class="form-control">
    <input type="hidden" value="<?php echo $user['Username'];?>" name="Username">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="text" name="Password" class="form-control">
  </div>
  
  <br><div class="form-group">
    <button type="submit" name="edit_pwd" class="btn btn-default">Edit</button>
  </div>
</form>