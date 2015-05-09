<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
        <th>Supplier ID</th>
  			<th>Supplier Company Name</th>
  			<th>Supplier Company Contact</th>
        <th>Supplier Address</th>
        <th>Zip code</th>
        <th>Phone</th>
        <th>Bank Name</th>
        <th>Bank Account</th>        
  			<th style="width:48px">More Info</th>
        <th style="width:48px">Edit</th>
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
        <td><?php echo $v['Sid'];?></td>
  			<td><?php echo $v['Sname'];?></td>
  			<td><?php echo $v['Scontact'];?></td>
        <td><?php echo $v['Saddress'];?></td>
        <td><?php echo $v['Spostcode'];?></td>
        <td><?php echo $v['Sphone'];?></td>
        <td><?php echo $v['Sbank'];?></td>
        <td><?php echo $v['Saccount'];?></td>
        <td><a href="?/supplier/see_supplier/Sid/<?php echo $v['Sid'];?>">Check</td>
  			<td><a href="?/supplier/mod_supplier/Sid/<?php echo $v['Sid'];?>">Edit</a></td>
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
  <?php echo $pagination;?>
</div>