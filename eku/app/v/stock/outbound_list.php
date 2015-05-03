<?php
$m->table = 'Outbound_details';
$m->key = 'Outbound_id';
?>
<div id="canvasDiv"></div><br>

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
                  name : '北京',
                  value: val, //~[-9,1,12,20,26,30,32,29,22,12,0,-6]
                  color:'#1f7e92',
                  line_width:3
                }
             ];
      var chart = new iChart.LineBasic2D({
            render : 'canvasDiv',
            data: data,
            title : '出库单统计',
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