<form class="form-inline" method="post" action="">
    <div class="radio">
  <label>Inner Trasition Type:</label>
    <label>Send IN
      <input type="radio" name="Operate" value="I" checked>
    </label>
  </div>
  <div class="radio">
    <label>Move OUT
      <input type="radio" name="Operate" value="O">
    </label>
  </div>
    <div class="radio">
    <label>Check Stocks
      <input type="radio" name="Operate" value="C">
    </label>
  </div>
  <br>
  <div class="_check" style="display:none;">
  <select class="form-control _check" name="innertransition_out" style="margin-left:20px;min-width:240px;">
    <?php foreach($stock as $v){ ?>
    <option value="<?php echo $v['Stockid'];?>"><?php echo $v['Stocks_Iname'].' Warehouse:'.$v['Stocks_Wid'].', Amount '.$v['Stockamount'].' StockID: '. $v['Stockid'];?></option>
    <?php }?>
  </select>
  </div>

  <!--<script type="text/javascript">
  if(Operate="O") 
  <div class="form-group">
    <label style="margin-left:78px">Stock Code</label>
    <input type="text" name="Stockid" class="form-control" >
  </div>
  </script>
<br class="_out_innertransition">-->
<div class="_general">
  <div class="form-group">
    <label>Warehouse Code</label>
    <input type="text" name="I_T_Wid" class="form-control">
  </div>
  <div class="form-group" style="padding-left:44px">
    <label>Item code</label>
    <input type="text" name="Items_Iname" class="form-control" >
  </div>
    <div class="form-group">
    <label style="margin-left:97px">Amount</label>
    <input type="text" name="Amount" class="form-control" >
  </div>
  
  <div class="_in_innertransition">
  <div class="form-group">
    <label style="margin-left:97px">Stock Area</label>
    <input type="text" name="Stockarea" class="form-control" >
  </div>
</div>

<div class="_out_innertransition" style="display:none;">
   <div class="form-group">
    <label style="margin-left:97px">StockID</label>
    <input type="text" name="Stockid" class="form-control" >
  </div>
</div>

  <br><div class="form-group"><button type="submit" name="innert_trasition_add" class="btn btn-default">ADD</button></div>
</form>

<script type="text/javascript">
$(function(){
    $('input[name="Operate"]').click(function(){
        var val = $(this).val();
        if(val == "I"){
            $('._out_innertransition').hide();
            $('._in_innertransition').show();
            $('._check').hide();
            $('._general').show();
            
        }else if(val == "O"){
            $('._out_innertransition').show();
            $('._in_innertransition').hide();
            $('._check').hide();
            $('._general').show();
        }
        else{
          $('._check').show();
          $('._out_innertransition').hide();
          $('._in_innertransition').hide();
          $('._general').hide();
        }
    });
});
</script>
