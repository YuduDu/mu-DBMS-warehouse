<?php
class admin_m extends m {
  public $table_User;
  function __construct()
  {
    global $app_id;
    parent::__construct();
    
    $this->table = 'User';
    $this->fields = array('Username','Password','Staffs_Sid');
  }


  function admin_add($param=false){
  	if(!$param)$param = $_POST;
    $this->table = 'User';
    return $this->add($param);
  }

  function admin_getAll(){
  	$res = $this->db->query("select * from User");
  	return $res;
  }

  function admin_getByUsername($username){
  	if (!ctype_alnum($username)){
		return null;
	}
    $res = $this->db->query("select * from User where Username = '".$username."'");
    return $res;
  }

  function admin_login($username,$password){
  	##$username=filter_var($username, FILTER_SANITIZE_STRING);
  	
	
   	$res = $this->db->query("select * from User where Username = '".$username."' AND Password = '".$password."'");
    return $res;
  }

}
