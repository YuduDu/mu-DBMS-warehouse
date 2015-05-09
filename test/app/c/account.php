<?php
class account extends base{
  function __construct()
  {
  	  parent::__construct(false);
      $this->m = load('m/admin_m');
  }
  
  function login()
  {
  	$msg = '';
	if(isset($_POST['account_login'])){
		$res = $this->m->admin_login($_POST['Username'],$_POST['Password']);
		if (!empty($res)){
			session_start();
			$_SESSION['STOCK_USER'] = $res[0]['Username'];
      		$_SESSION['STOCK_Sid'] = $res[0]['Staffs_Sid'];
	  		
			/*
			 $db_config = array(
     		 'host'      =>'45.62.107.251', 
      		 'user'      =>'eku',  
             'password'  =>'eku',
             'db_type'   =>'mysql',
             'default_db'=>'zadmin_eku'
             );

    		$db = new db($db_config);
			*//////////
			redirect('?/dashboard/notice');
		}else{
			$msg = 'Wrong account or password !';
		}
	}

    view('v/account/login',array('msg'=>$msg));
  }

  function logout(){
    session_start();
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
         setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    redirect('?/account/login');
  }


}