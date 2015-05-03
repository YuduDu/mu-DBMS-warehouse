<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Inner Transition</th>
  			<th>Warehouse Code</th>
  			<th>Amount</th>
        <th>Item Code</th>
        <th>Transition Code</th>
        <th>Stock Code</th>
        <th>Create Time</th>
        <!--<th>操作</th>-->
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
  			<td><?php echo $v['Transitionid']?></td>
  			<td><?php echo $v['I_T_Wid']?></td>
        <td><?php echo $v['Amount']?></td>
        <td><?php echo $v['Items_Iname']?></td>
        <td><?php echo $v['Operate']?></td>
        <td><?php echo $v['Stockid'];?></td>
        <td><?php echo $v['Time'];?></td>        
  			<!--<td><a href="?/warehouse/edit/Wid/<?php echo $v['Wid'];?>">编辑</a></td>-->
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
  <?php echo $pagination;?>
</div>