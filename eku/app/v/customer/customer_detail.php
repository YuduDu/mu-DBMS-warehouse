<h4>Customer Information</h4>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
        	<th>ID</th>
  			<th>Comapny Name</th>
  			<th>Comany Contact Name</th>
        	<th>Company Address</th>
        	<th>Zip code</th>
        	<th>Phone</th>
        	<th>Bank Name</th>
        	<th>Bank Account</th>        
  		</tr>
      </thead>
      <tbody>
  		<tr>
        	<td><?php echo $customer['Cid'];?></td>
  			<td><?php echo $customer['Cname'];?></td>
  			<td><?php echo $customer['Ccontact'];?></td>
	        <td><?php echo $customer['Caddress'];?></td>
	        <td><?php echo $customer['Cpostcode'];?></td>
	        <td><?php echo $customer['Cphone'];?></td>
	        <td><?php echo $customer['Cbank'];?></td>
	        <td><?php echo $customer['Caccount'];?></td>
  		</tr>
    	</tbody>
  </table>
</div>

<h4>Outbound Order Statistic</h4>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Supplier ID</th>
        <th>Outbound Create Time</th>
        <th>Amount of Money</th>
        <th>Outbound ID</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($customer_order as $v) {?>
      <tr>
        <td><?php echo $v['Cid'];?></td>
        <td><?php echo $v['CreateTime'];?></td>
        <td><?php echo $v['Money'];?></td>
        <td><?php echo $v['Outbound_id'];?></td>
      </tr>
      <?php }?>
      </tbody>
  </table>
</div>