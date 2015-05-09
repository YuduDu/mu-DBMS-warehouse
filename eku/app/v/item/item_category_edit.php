<form class="form-inline" method="post" action="">
  <div class="form-group">
    <label>Items Class</label>
    <input type="text" value="<?php echo $res['ICname'];?>" name="ICname" class="form-control">
  </div>
  <div class="form-group">
    <label>Items Type</label>
  <select class="form-control" name="Spec">
    <option <?php echo $res['Spec']=='Raw Materials'?'selected':'';?> value="Raw Materials">Raw Material</option>
    <option <?php echo $res['Spec']=='Semifinished'?'selected':'';?> value="Semifinished">Semifinished</option>
    <option <?php echo $res['Spec']=='Final Product'?'selected':'';?> value="Final Product">Finished Product</option>
  </select>
  </div>
  
  <br><div class="form-group">  
    <button type="submit" name="item_category_edit" class="btn btn-default">Confirm</button>
  </div>
</form>