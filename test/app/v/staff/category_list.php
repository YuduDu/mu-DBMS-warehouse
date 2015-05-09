<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Staff Class ID</th>
  			<th>Staff Class Describe</th>
  			<th>Edit</th>
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
  			<td><?php echo $v['SCid']?></td>
  			<td><?php echo $v['SType']?></td>
  			<td><a href="?/staff/category_edit/SCid/<?php echo $v['SCid'];?>">Edit</a></td>
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
</div>