<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
        <th>User Name</th>
  			<th>Password</th>
  			<th>Staff ID</th>
  			<th>Modify</th>
        <th>Delete</th>
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
        <td><?php echo $v['Username'];?></td>
        <td><?php echo $v['Password'];?></td>
        <td><?php echo $v['Staffs_Sid'];?></td>
        <td><a href="?/admin/admin_edit/Username/<?php echo $v['Username'];?>">Modify</a></td>  
  			<td><a href="?/admin/admin_remove/Username/<?php echo $v['Username'];?>">Delete</a></td>
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
</div>