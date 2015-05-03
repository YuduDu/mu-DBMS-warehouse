<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Item Code</th>
  			<th>Item Class</th>
        <th>Unit</th>
        <th>Edit</th>
        <th>Delete</th>
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($items as $v) {?>
  		<tr>
  			<td><?php echo $v['Iname'];?></td>
  			<td><?php echo $v['ICname'];?></td>
        <td><?php echo $v['Unit'];?></td>
        <td><a href="?/item/item_edit/Iname/<?php echo urlencode($v['Iname']);?>">Edit</a></td>
        <td><a href="?/item/item_remove/Iname/<?php echo urlencode($v['Iname']);?>">Delete</a></td>
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
</div>