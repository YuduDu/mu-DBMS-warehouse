<?php
class systemInfo extends base{
  function __construct()
  {
  		parent::__construct();
      $this->m = load('m/systemInfo_m');
  }
  
  function index()
  {
  	redirect(BASE.'systemInfo/info','','',0);    
  }

  function info(){
  	$this->display('v/systemInfo/info');
  }

  function account(){
    if(isset($_POST['edit_pwd'])){
        $password = strip_tags(trim($_POST['Password']));
        if(strlen($password)<5){
            $this->msg = 'Password need to be more than 5 characters.';
        }else{
          $this->m->key = 'Username';
          $res = $this->m->update($_POST['Username']);
          $this->msg = $res ? 'Succeed!':'Failed!';
        }
    }
    
    session_start();
    $user = $this->m->user_get($_SESSION['STOCK_USER']);
    $this->display('v/systemInfo/account',array('user'=>$user[0]));
  }

}