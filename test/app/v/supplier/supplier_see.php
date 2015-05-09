<h4>Supplier Information</h4>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
        <th>Supplier ID</th>
  			<th>Supplier Name</th>
  			<th>Supplier Contact</th>
        <th>Supplier Address</th>
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
<div id="canvasDiv"></div><br>
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
                  name : 'Inbound',
                  value: val, //~[-9,1,12,20,26,30,32,29,22,12,0,-6]
                  color:'#1f7e92',
                  line_width:3
                }
             ];
      var chart = new iChart.LineBasic2D({
            render : 'canvasDiv',
            data: data,
            title : 'Inbound Statistics',
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