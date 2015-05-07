<?php
$m->table = 'Inbound_details';
$m->key = 'Inbound_id';
?>
<div class="form-group"><button type="submit" class="btn btn-default"><a href="?/stock/inbound_export/" >Export</button>
<div id="canvasDiv"></div><br>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
  	<thead>
  		<tr>
  			<th>Inbound ID</th>
  			<th>Create Time</th>
  			<th>Approver</th>
        <th>Supplier ID</th>
        <th>Deliverer</th>
        <th>Inbound Detail</th>
        <!--<th>操作</th>-->
  		</tr>
      </thead>
      <tbody>
  		<?php foreach($res as $v) {?>
  		<tr>
  			<td><?php echo $v['Inbound_id']?></td>
  			<td><?php echo $v['CreateTime']?></td>
        <td><?php echo $v['Approver_id']?></td>
        <td><?php echo $v['Suppliers_Sid']?></td>
        <td><?php echo $v['Deliverer']?></td>
        <td><a href="?/stock/inbound_see/Inbound_id/<?php echo $v['Inbound_id'];?>">查看</a></td>
        <!-- <td>
          <?php
            //$r = $m->get_one($v['Inbound_id']);
            //echo 'Item Code:'.$r['Inbound_Iname'].'<br>'
            //.'Amount:'.$r['Amount'].'<br>'
            //.'Unit:'.$r['Unit_Price'].'<br>'
            //.'Stock Code:'.$r['Inbound_Stockid'].'<br>'
            //.'Warehouse Code:'.$r['Warehouse_Wid'];
          ?>
        </td> -->
  			<!--<td><a href="?/warehouse/edit/Wid/<?php //echo $v['Wid'];?>">编辑</a></td>-->
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