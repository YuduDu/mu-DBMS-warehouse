<h4>入库信息</h4>
<div class="table-responsive">

  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Inbound ID</th>
  			<th>Create Time</th>
  			<th>Approver</th>
        <th>Supplier ID</th>
        <th>Deliverer</th>
  		</tr>
      </thead>
      <tbody>
  		<tr>
  			<td><?php echo $res['Inbound_id']?></td>
  			<td><?php echo $res['CreateTime']?></td>
        <td><?php echo $res['Approver_id']?></td>
        <td><?php echo $res['Suppliers_Sid']?></td>
        <td><?php echo $res['Deliverer']?></td>
  		</tr>
    	</tbody>
  </table>
</div>

<h4>入库清单</h4>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Inbound ID</th>
        <th>Inbound_Iname</th>
        <th>Amount</th>
        <th>Unit_Price</th>
        <th>Inbound_Stockid</th>
        <th>Warehouse_Wid</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($list as $v) {?>
      <tr>
        <td><?php echo $v['Inbound_id']?></td>
        <td><?php echo $v['Inbound_Iname']?></td>
        <td><?php echo $v['Amount']?></td>
        <td><?php echo $v['Unit_Price']?></td>
        <td><?php echo $v['Inbound_Stockid']?></td>
        <td><?php echo $v['Warehouse_Wid']?></td>
      </tr>
      <?php }?>
      </tbody>
  </table>
</div>

