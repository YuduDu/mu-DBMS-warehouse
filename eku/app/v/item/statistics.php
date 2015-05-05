<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Remain_Amount</th>
  			<th>Items_Iname</th>
  			<th>Minimum</th>
        <th>Maximum</th>
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
  			<td><?php echo $v['Remain_Amount']?></td>
  			<td><?php echo $v['Items_Iname']?></td>
        <td><?php echo $v['Minimum']?></td>
        <td><?php echo $v['Maximum']?></td>
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
  <?php echo $pagination;?>
</div>