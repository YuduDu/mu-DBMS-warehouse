<h4>Customer Information</h4>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
        	<th>Customer ID</th>
  			<th>Customer Name</th>
  			<th>Customer Contact Name</th>
        	<th>Customer Address</th>
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
<div id="canvasDiv"></div><br>
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

<script type="text/javascript">
  $(function(){
    var val = [];
    var days = [];
    
    <?php while($pop = array_pop($map)) {?>
      val.push(<?php echo $pop['Money']?$pop['Money']:0;?>);
      days.push('<?php echo date('m-d H:i',strtotime($pop['CreateTime']));?>')
    <?php }?>

    //~ console.log(val);return false;
      var data = [
                {
                  name : 'Customer',
                  value: val, //~[-9,1,12,20,26,30,32,29,22,12,0,-6]
                  color:'#1f7e92',
                  line_width:3
                }
             ];
      var chart = new iChart.LineBasic2D({
            render : 'canvasDiv',
            data: data,
            title : 'Outbound Statistic',
            width : 970,
            height : 400,
            coordinate:{height:'90%',background_color:'#f6f9fa'},
            sub_option:{
              hollow_inside:false,//设置一个点的亮色在外环的效果
              point_size:16
            },
            labels: days
          });
      chart.draw();
    });
</script>
