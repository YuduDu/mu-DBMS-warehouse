<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Item Name</th>
  			<th>Item Class</th>
  			<th>Item Codes</th>
        <th>Edit</th>
        <th>Delete</th>
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
  			<td><?php echo $v['ICname']?></td>
  			<td><?php echo $v['Spec']?></td>
  			<td><a href="?/item/item_see/ICname/<?php echo urlencode($v['ICname']);?>">Detail</a></td>
        <td><a href="?/item/item_category_edit/ICname/<?php echo urlencode($v['ICname']);?>">Edit</a></td>
        <td><a href="?/item/item_category_remove/ICname/<?php echo urlencode($v['ICname']);?>">Delete</a></td>
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
  <?php echo $pagination;?>
</div>