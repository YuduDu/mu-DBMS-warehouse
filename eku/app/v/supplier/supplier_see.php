<h4>Supplier Information</h4>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
        <th>Supplier ID</th>
  			<th>Supplier Company Name</th>
  			<th>Supplier Company Contact</th>
        <th>Supplier Comnpany Address</th>
        <th>Zip code</th>
        <th>Phone</th>
        <th>Bank Name</th>
        <th>Bank Account</th>        
  		</tr>
      </thead>
      <tbody>
  		<tr>
        <td><?php echo $sup['Sid'];?></td>
  			<td><?php echo $sup['Sname'];?></td>
  			<td><?php echo $sup['Scontact'];?></td>
        <td><?php echo $sup['Saddress'];?></td>
        <td><?php echo $sup['Spostcode'];?></td>
        <td><?php echo $sup['Sphone'];?></td>
        <td><?php echo $sup['Sbank'];?></td>
        <td><?php echo $sup['Saccount'];?></td>
  		</tr>
    	</tbody>
  </table>
</div>

<h4>Supplier Order Statistic</h4>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Supplier ID</th>
        <th>Create Time</th>
        <th>Amount Money</th>
        <th>Inbound ID</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($suppliers_order as $v) {?>
      <tr>
        <td><?php echo $v['Sid'];?></td>
        <td><?php echo $v['CreateTime'];?></td>
        <td><?php echo $v['Money'];?></td>
        <td><?php echo $v['Inbound_id'];?></td>
      </tr>
      <?php }?>
      </tbody>
  </table>
</div>