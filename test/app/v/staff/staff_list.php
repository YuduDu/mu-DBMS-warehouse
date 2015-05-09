<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
        <th>Staff ID </th>
        <th>Staff Name</th>
  			<th>Staff Class ID</th>
  			<th>Phone</th>
  			<th>Edit</th>
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
        <td><?php echo $v['Sid']?></td>
        <td><?php echo $v['Sname']?></td>
  			<td><?php echo $v['SCid']?></td>
  			<td><?php echo $v['Sphone']?></td>
  			<td><a href="?/staff/staff_edit/Sid/<?php echo $v['Sid'];?>">Edit</a></td>
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
</div>