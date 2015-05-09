<h4>Outbound Information</h4>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Outbound_id</th>
  			<th>Customer_Cid</th>
  			<th>Createtime</th>
        <th>Approver_id</th>
        <th>Consignee</th>
  		</tr>
      </thead>
      <tbody>
  		<tr>
  			<td><?php echo $res['Outbound_id']?></td>
  			<td><?php echo $res['Customer_Cid']?></td>
        <td><?php echo $res['Createtime']?></td>
        <td><?php echo $res['Approver_id']?></td>
        <td><?php echo $res['Consignee']?></td>
  		</tr>
    	</tbody>
  </table>
</div>

<h4>Outbound list</h4>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Outbound_id</th>
        <th>Outbound_Iname</th>
        <th>Amount</th>
        <th>Unit_Price</th>
        <th>Outbound_Stockid</th>
        <th>Warehouse_Wid</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($list as $v) {?>
      <tr>
        <td><?php echo $v['Outbound_id']?></td>
        <td><?php echo $v['Outbound_Iname']?></td>
        <td><?php echo $v['Amount']?></td>
        <td><?php echo $v['Unit_price']?></td>
        <td><?php echo $v['Outbound_Stockid']?></td>
        <td><?php echo $v['Warehouse_Wid']?></td>
      </tr>
      <?php }?>
      </tbody>
  </table>
</div>

