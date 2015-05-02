<?php
class user extends base{

  function __construct()
  {
    parent::__construct();
    $this->m = load('m/user_m');
  }
 
  function login()
  {
    if(!is_email($_POST['email']))redirect(BASE,'Wrong Username!');
    if( $this->m->login( $_POST['email'] , $_POST['password'] )){
      redirect('?/store/','Login Succeed!','',3);
      exit;
    }
    redirect(BASE,$this->m->login_err);
  }

  function logout()
  {
    $this->m->logout();
    redirect(BASE,'You can now log out!','',0);
  }
}
