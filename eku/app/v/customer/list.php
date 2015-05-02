<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
        <th>Customer Company Name</th>
  			<th>Customer Contact Name</th>
  			<th>Customer Contact Name</th>
        <th>Company Address</th>
        <th>Zip Code</th>
        <th>Phone</th>
        <th>Bank Name</th>
        <th>Bank Account</th>
        <th>More Informations</th>
  			<th style="width:48px">Edit</th>
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
        <td><?php echo $v['Cid'];?></td>
        <td><?php echo $v['Cname'];?></td>
        <td><?php echo $v['Ccontact'];?></td>
        <td><?php echo $v['Caddress'];?></td>
        <td><?php echo $v['Cpostcode'];?></td>
        <td><?php echo $v['Cphone'];?></td>
  			<td><?php echo $v['Cbank'];?></td>
  			<td><?php echo $v['Caccount'];?></td>
        <td><a href="?/customer/customer_detail/Cid/<?php echo $v['Cid'];?>">More Info</a></td>  
  			<td><a href="?/customer/customer_edit/Cid/<?php echo $v['Cid'];?>">Edit</a></td>
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
</div>