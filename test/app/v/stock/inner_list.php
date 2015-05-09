<div class="table-responsive">
<div id="canvasDiv"></div><br>
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Inner Transition</th>
  			<th>Warehouse Code</th>
  			<th>Amount</th>
        <th>Item Code</th>
        <th>Transition Code</th>
        <th>Stock Code</th>
        <th>Create Time</th>
        <!--<th>操作</th>-->
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
  			<td><?php echo $v['Transitionid']?></td>
  			<td><?php echo $v['I_T_Wid']?></td>
        <td><?php echo $v['Amount']?></td>
        <td><?php echo $v['Items_Iname']?></td>
        <td><?php echo $v['Operate']?></td>
        <td><?php echo $v['Stockid'];?></td>
        <td><?php echo $v['Time'];?></td>        
  			<!--<td><a href="?/warehouse/edit/Wid/<?php echo $v['Wid'];?>">编辑</a></td>-->
  		</tr>
  		<?php }?>
    	</tbody>
  </table>
  <?php echo $pagination;?>
</div>


<script type="text/javascript">
  $(function(){
    var val = [];
    var days = [];
    
    <?php while($pop = array_pop($map)) {?>
      val.push(<?php echo $pop['Amount']?$pop['Amount']:0;?>);
      days.push('<?php echo date('m-d H:i',strtotime($pop['Time']));?>')
    <?php }?>

    //~ console.log(val);return false;
      var data = [
                {
                  name : 'Inner',
                  value: val, //~[-9,1,12,20,26,30,32,29,22,12,0,-6]
                  color:'#1f7e92',
                  line_width:3
                }
             ];
      var chart = new iChart.LineBasic2D({
            render : 'canvasDiv',
            data: data,
            title : 'Inner Transition Statistics',
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