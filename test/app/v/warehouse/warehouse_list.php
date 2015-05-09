<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Warehouse Code</th>
  			<th>In Charge Staff ID</th>
  			<th>Operation</th>
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
  			<td><?php echo $v['Wid']?></td>
  			<td><?php echo $v['Admin_id']?></td>
  			<td><a href="?/warehouse/edit/Wid/<?php echo $v['Wid'];?>">Edit</a></td>
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
  <?php echo $pagination;?>
</div>