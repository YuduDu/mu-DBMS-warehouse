<?php
load('lib/utility',false);
class base extends c{
  public $menu;
  public $err;
  public $msg;
  public $addParams;
  public $upParams;
  public $searchParams;
  function __construct($needCheck=true)
  {
    session_start();
    if(empty($_SESSION['STOCK_USER']) && $needCheck){
      redirect('?/account/login','','',0);
    }

    global $db_config,$db;

    $db_config = array(
      'host'      =>'45.62.107.251', 
      'user'      =>'eku',  
      'password'  =>'eku',
      'db_type'   =>'mysql',
      'default_db'=>'zadmin_eku'
    );

    $db = new db($db_config);
    
    // if(!isset($db_config)){
    //   // Normal Install Process
    //   $this->install();
    //   exit;
    // }
     
    // if(!load('m/app')->is_install()){
    //   $this->sae_install();
    //   exit;
    // }

    $this->err = array();
    $this->msg = '';

    $this->menu = array(
          'dashboard'=>'Dashboard',
          'stock'=>'Inbound/Outbound',
          'item'=>'Items',
          'supplier'=>'Supplier',
          'customer'=>'Customer',
          'warehouse'=>'warehouse',
          'logout'=>'Log Out',
          'staff'=>'Staff',
          'admin'=>'System',
          'systemInfo'=>'System Information'
   );

  $this->tabCell = array(
          'dashboard'=>array( //'notice'=>'库存通知',
              'add'=>'Add New Inbound','out'=>'Add New Outbound','inner_trasition'=>'Add New Inner Trasition'),
          'stock'=>array(
              'inbound_list'=>'Inbound List','outbound_list'=>'Outbound List','inner_list'=>'Inner Trasition List'),
          'item'=>array(
              'item_category_list'=>'Items Category', 'item_category_add'=>'New Item Category','item_add'=>'New Item'),//'detailList'=>'具体物品列表数据','collect'=>'物品统计'),
          'supplier'=>array(
              'supplier_list'=>'Supplier List','add'=>'New Supplier'),//,'detail'=>'供应商详情','edit'=>'修改供应商详情'),
          'customer'=>array(
              'customer_list'=>'Customer List','add'=>'New Customer'),
          'warehouse'=>array(
              'warehouse_list'=>'Warehouse List','warehouse_add'=>'Add Warehouse'),
          'systemInfo'=>array('info'=>'System Information','account'=>'New Password'),
          'staff'=>array(
              'category_list'=>'Staff Category','category_add'=>'New Staff Category','staff_list'=>'Staff List','staff_add'=>'Add New Staff'),
          'admin'=>array(
              'admin_list'=>'User List','admin_add'=>'Add New User'),
          'logout'=>'Log Out'
  );

  //添加参数
  $this->addParams = array(
      'submitName'=>'_add', //提交按钮
      'required'=>array(),  //必填字段
      'addCondition'=>false, //排重条件
      'addConditionMsg'=>'Repeated Information! ',  //出现重复时，给出提示文字
      'addExcute'=>array('m'=>object,'method'=>''),  //执行添加
      'view'=>'v/'  //视图
  );

  //更新参数
  $this->upParams = array(
      'submitName'=>'_edit',  //提交按钮
      'required'=>array(),  //必填字段
      'upExcute'=>array(),  //执行更新
      'view'=>'v/'  //视图
  );
    
  }
  
  function check()
  {
    $this->u = load('m/user_m')->check(); 
    if(!$this->u['id']){
      $this->login();
    }
  }
  
  function loadapp()
  {
    
    global $app_id;
    $app_id = 1;
    return 1;
  }
  
  function display($view,$param = array(),$needSearch=false)
  {
    $param['al_content'] = view($view,$param,TRUE);
    $param['u'] = $this->u;
    $param['menu']  = $this->menu;
    $param['tabCell'] = $this->tabCell;
    $param['err'] = $this->err;
    $param['msg'] = $this->msg;
    $param['needSearch'] = $needSearch;
    header("Content-type: text/html; charset=utf-8");
    view('v/layout/template',$param);
  }
  
  
  function excel($view,$param = array())
  {
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:attachment;filename=test_data.xls");
    $param['al_content'] = view($view,$param,TRUE);
    view('v/excel'.$temp,$param);
  }
  
  function login()
  {
    $rtu = isset($_GET['rtu'])?$_GET['rtu']:BASE;
    $conf = array('username'=>'required','password'=>'required');
    $err = validate($conf);
    if (is_array($err)) {
      //$err['info'] = $this->m->login_err; 
      $param['err'] = $err;
      $param['page_title'] = $param['meta_keywords'] = $param['meta_description'] = '登录';
      //$this->display('v/user/login',$param); 
      //if(browser() == 'html4')view('v/user/login_ie',$param);
      view('v/store/login',$param);  
      exit;
    }
    
    if( $this->m->login( $_POST['username'] , $_POST['password'] )){
      redirect($rtu,'Welcome!');
      exit;
    }
    
    redirect(BASE.'?rtu='.$rtu,$this->m->login_err);
  }
  

  private function install()
  {
//     global $db_config;
//     if(is_array($db_config))redirect("/");
//     $param['writable'] = file_put_contents(APP.'writable.tmp','test');
    
//     if(isset($_POST['db_type'])){
//       $db_type = $_POST['db_type'] == 'sqlite'?'sqlite':'mysql';
//       $_POST['default_db'] = $db_type=='sqlite'?rand(100000,999999).'.sqlite':$_POST['default_db'];
//  //     $cname = 'db_'.$db_type;
//       $db = new db($_POST);
//       $sql = file_get_contents(APP.$db_type.'_ins.sql');
//       $db->muti_query($sql);
//       $base_dir = rtrim($_POST['base_dir'],'/').'/';
//       $seed = randstr();
//       file_put_contents(APP.'config_user.php','<?
// define(\'BASE\',\'?/\');
// define(\'SEED\',\''.$seed.'\');
// $db_config = array(
//   \'host\'      =>\''.$_POST['host'].'\', 
//   \'user\'      =>\''.$_POST['user'].'\',  
//   \'password\'  =>\''.$_POST['password'].'\', 
//   \'db_type\'   =>\''.$_POST['db_type'].'\',
//   \'default_db\'=>\''.$_POST['default_db'].'\'
// );');
//       redirect($_POST['base_dir'],'安装成功','用户名 admin@b24.cn 密码 admin','8');
//     }
//     else {
//       header("Content-type: text/html; charset=utf-8");
//       $base = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']);
//       view("v/home/install",$param);
//     }
  }

  // private function sae_install()
  // {
  //   global $db_config,$db;
  //   if(load('m/app')->is_install())redirect("/");
  //   $sql = file_get_contents(APP.'mysql_ins.sql');
  //   $db->muti_query($sql);
  //   header("Content-type: text/html; charset=utf-8");
  //   view("v/home/sae_install");
  // }

  function actionAdd(){ 
    $submitName = $this->addParams['submitName'];
    $required = $this->addParams['required'];
    $addConditionMsg = $this->addParams['addConditionMsg'];
    $addExcute = $this->addParams['addExcute'];
    $view = $this->addParams['view'];
    $reqArr = array();
    foreach($required as $v){
      $reqArr[$v] = 'required';
    }
    if(isset($_POST[$submitName])){
      $conf = $reqArr;
      $err = validate($conf);
      if ( $err === TRUE) {
        if($this->addParams['addCondition']){ //防止重复添加
          $this->msg = $addConditionMsg;
        }else{
          $m = $addExcute['m'];
          $m->$addExcute['method']();
          $this->msg = 'Succeed';
        }
      }else{
        $this->err = $err;
      }
    }
    $this->display($view);
  }

  //更新
  // function actionUpdate(){
  //   $submitName = $this->upParams['submitName'];
  //   $required = $this->upParams['required'];
  //   $upExcute = $this->upParams['upExcute'];
  //   $view = $this->upParams['view'];
  //   $reqArr = array();
  //   foreach($required as $v){
  //     $reqArr[$v] = 'required';
  //   }
  //   if(isset($_POST[$submitName])){
  //     $conf = $reqArr;
  //     $err = validate($conf);
  //     if ( $err === TRUE ) {
  //         $m = $upExcute['m'];
  //         if($m->$upExcute['method']()){
  //           $this->msg = '修改成功'
  //         }else{
  //           $this->msg = '修改失败';
  //         }
  //     }else{
  //       $this->err = $err;
  //     }
  //   }
  // }




}
