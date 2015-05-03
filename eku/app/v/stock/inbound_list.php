<?php
$m->table = 'Inbound_details';
$m->key = 'Inbound_id';
?>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Inbound ID</th>
  			<th>Create Time</th>
  			<th>Approver</th>
        <th>Supplier ID</th>
        <th>Deliverer</th>
        <th>Inbound Detail</th>
        <!--<th>操作</th>-->
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
  			<td><?php echo $v['Inbound_id']?></td>
  			<td><?php echo $v['CreateTime']?></td>
        <td><?php echo $v['Approver_id']?></td>
        <td><?php echo $v['Suppliers_Sid']?></td>
        <td><?php echo $v['Deliverer']?></td>
        <td>
          <?php
            $r = $m->get_one($v['Inbound_id']);
            echo 'Item Code:'.$r['Inbound_Iname'].'<br>'
            .'Amount:'.$r['Amount'].'<br>'
            .'Unit:'.$r['Unit_Price'].'<br>'
            .'Stock Code:'.$r['Inbound_Stockid'].'<br>'
            .'Warehouse Code:'.$r['Warehouse_Wid'];
          ?>
        </td>
  			<!--<td><a href="?/warehouse/edit/Wid/<?php echo $v['Wid'];?>">编辑</a></td>-->
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
  <?php echo $pagination;?>
</div>