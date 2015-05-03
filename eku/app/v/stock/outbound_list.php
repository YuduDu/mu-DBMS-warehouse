<?php
$m->table = 'Outbound_details';
$m->key = 'Outbound_id';
?>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Outbound ID</th>
  			<th>Customer ID</th>
  			<th>Create Time</th>
        <th>Approver</th>
        <th>Deliverer</th>
        <th>Outbound Details</th>
        <!--<th>操作</th>-->
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
  			<td><?php echo $v['Outbound_id']?></td>
  			<td><?php echo $v['Customer_Cid']?></td>
        <td><?php echo $v['Createtime']?></td>
        <td><?php echo $v['Approver_id']?></td>
        <td><?php echo $v['Consignee']?></td>
        <td>
          <?php
            $r = $m->get_one($v['Outbound_id']);
            echo 'Item Code:'.$r['Outbound_Iname'].'<br>'
            .'Amount:'.$r['Amount'].'<br>'
            .'Unit_price:'.$r['Unit_price'].'<br>'
            .'Stock Code:'.$r['Outbound_Stockid'].'<br>'
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