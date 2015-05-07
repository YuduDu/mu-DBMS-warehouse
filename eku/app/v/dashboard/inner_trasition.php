<form class="form-inline" method="post" action="">
    <div class="radio">
  Inner Trasition Type:
    <label>Send IN
      <input type="radio" name="Operate" value="I" checked>
    </label>
  </div>
  <div class="radio">
    <label>Move OUT
      <input type="radio" name="Operate" value="O">
    </label>
  </div>
  <br>
  <div class="form-group">
    <label>Warehouse Code</label>
    <input type="text" name="I_T_Wid" class="form-control">
  </div>
  <div class="form-group">
    <label style="margin-left:97px">Amount</label>
    <input type="text" name="Amount" class="form-control" >
  </div><br>
  <div class="form-group" style="padding-left:44px">
    <label>Item code</label>
    <input type="text" name="Items_Iname" class="form-control" >
  </div>

  <!--<script type="text/javascript">
  if(Operate="O") -->
  <div class="form-group">
    <label style="margin-left:78px">Stock Code</label>
    <input type="text" name="Stockid" class="form-control" >
  </div>
  <!--</script>-->
  
  <br><div class="form-group"><button type="submit" name="innert_trasition_add" class="btn btn-default">ADD</button></div>
</form>