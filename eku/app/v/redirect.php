<!DOCTYPE html>
<html>
<head>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="<?=$sec?>;url=<?=$url?>" />
<title> <?=$msg?> </title>
  <link href="static/default.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div class="win" >
  <?php if(!empty($msg)){?>
  <h1><?=$msg?></h1>
  <div class="msg" ><?=$ext_msg?></div>
  <div class="msg1" >Page goes to: <a href="<?=$url?>" ><?=$url?></a>
   <br />Click on <a href="<?=$url?>" >Go to page directly</a>
  </div>
  <?php }?>
</div>
</body>
</html>
