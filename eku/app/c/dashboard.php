<?php
class dashboard extends base{
  function __construct()
  {
  		parent::__construct();
      $this->m = load('m/dashboard_m');

  }
  
  function index()
  {
  	redirect(BASE.'dashboard/add','','',0);   
  }

  function notice(){
	   $this->display('v/dashboard/add');
  }
  /**
  * 要同时保证Items中的Iname、Staffs中的Sid、Suppliers中的Sid等都存在
  */
  function add(){
    if(isset($_POST['addInBound'])){
      $post = $_POST;
      try {
          //Inbound
          $newBound = false;
          $errArr = array();
          if($post['InboundStyle'] == 2){  //创建入库单
            $newBound = true;
            $conf = array('Approver_id'=>'required','Suppliers_Sid'=>'required','Deliverer'=>'required');
            $err = validate($conf);
            if ( $err !== TRUE) {
                $errArr = $err;
                throw new Exception('Please fill out all information needed for Inbound!',1);
            }
            $conf_detail = array('Inbound_Iname'=>'required','Amount'=>'required','Unit_Price'=>'required',
                    'Stockarea'=>'required','Warehouse_Wid'=>'required');
            $err_detail = validate($conf_detail);
            if( $err_detail === TRUE ) {
              $inboundID = $this->m->inbound_add($post);
            }else{
              $errArr = $err_detail;
              throw new Exception('Please fill out all detailed information needed for Inbound',1);
            }
          }else if($post['InboundStyle'] == 1){
            $inboundID = $post['Inbound_id_old'];
          }

          //Warehouses入库
          $warehouses_id = $this->m->warehouses_add(array('Admin_id'=>$post['Approver_id']));
          if(!$warehouses_id){ throw new Exception('Failed to create Inbound record.',2);} 
          $post['Warehouse_Wid'] = $warehouses_id;

          //Stocks入库
          //var_dump($post);exit();
          $stockParams = array('Stocks_Wid'=>$warehouses_id,'Stocks_Iname'=>$_POST['Inbound_Iname'],'Stockamount'=>$_POST['Amount'],'Stockarea'=>$_POST['Stockarea']);
          $conf_Stocks = array('Stocks_Wid'=>'required','Stocks_Iname'=>'required','Stockamount'=>'required','Stockarea'=>'required');
          $err_Stocks = validate($conf_Stocks,$stockParams);
          if ( $err_Stocks !== TRUE) {
              $errArr = $err_Stocks;
              throw new Exception('Please fill out all informations needed for Stock',1);
          }
          $stockid = $this->m->stock_add($stockParams);
          if(!$stockid){ throw new Exception('Failed to create a Stock!',2);} 
          $post['Inbound_Stockid'] = $stockid;

          //Inbound_details入库
          if(!empty($inboundID)){
            $post['Inbound_id'] = $inboundID;
            $res = $this->m->inbound_detail_add($post);
            if($res !== 0){
              throw new Exception('Fail to create detailed Inbound information.',2);
            }else{
              throw new Exception('Inbound Succeed',2);
            }
          }else if($newBound) {
            throw new Exception('Inbound Fail',2);
          }

        } catch (Exception $e) {
            if($e->getCode() == 1){
              $this->err = $errArr;
            }else if($e->getCode() == 2){
              $this->msg = $e->getMessage();
            }

        }
    }

    $inbound = $this->m->inbound_getAll();
    $this->display('v/dashboard/add',array('inbound'=>$inbound));
  }

  /*出仓*/
  function out(){
    if(isset($_POST['outBound'])){
      try {
        $errArr = array();
        $conf = array('Customer_Cid'=>'required','Approver_id'=>'required','Consignee'=>'required');
        $err = validate($conf);
        if ( $err !== TRUE) {
            $errArr = $err;
            throw new Exception('Please fill out all imformation needed for Outbound',1);
        }

        //出库详情参数检验
        $conf_detail = array('Amount'=>'required');
        $err_detail = validate($conf_detail);
        if( $err_detail !== TRUE ){
          $errArr = $err_detail;
          throw new Exception('Please fill out all detailed information for outbound.',1);
        }
        
        //拿到入库详情数据
        $this->m->table = 'Stocks';
        $this->m->key = 'Stockid';
        $stock = $this->m->get_one($_POST['Stock_id_old']);
        //var_dump($stock);exit();

        if(!$stock){
          throw new Exception('Please fill out all detailed information for Outbound',2);
        }

        //添加出库单
        $outBoundId = $this->m->outbound_add();

        //添加出库详情数据
        if(!empty($outBoundId)){
            $post = array('Outbound_id'=>$outBoundId,'Outbound_Iname'=>$stock['Stocks_Iname'],'Amount'=>intval($_POST['Amount']),
              'Unit_price'=>intval($_POST['unitprice']),'Warehouse_Wid'=>intval($stock['Stocks_Wid']),'Outbound_Stockid'=>intval($stock['Stockid']));
            //var_dump($post);exit(); 
            $res = $this->m->outbound_detail_add($post);
            if($res !== 0){
              throw new Exception('Failed to create detailed Outbound record.',2);
            }else{
              throw new Exception('Outbound Succeed!',2);
            }
        }else if($newBound) {
          throw new Exception('Failed to create Outbound record!',2);
        }


      } catch (Exception $e) {
        if($e->getCode() == 1){
          $this->err = $errArr;
        }else if($e->getCode() == 2){
          $this->msg = $e->getMessage();
        }
      }

      
    }

    $stock_details = $this->m->Stocks_getAll();
    $this->display('v/dashboard/out',array('stock'=>$stock_details));
  }

  function inner_trasition(){
    if(isset($_POST['innert_trasition_add'])){
      $post = $_POST;
      try {
          $errArr = array();
          $conf = array('I_T_Wid'=>'required','Amount'=>'required','Items_Iname'=>'required','Operate'=>'required','Stockid'=>'required');
          $err = validate($conf);
          if ( $err !== TRUE ) {
              $errArr = $err;
              throw new Exception('Please fill out all information need for Inner Trasition!',1);
          }else{
              $inner = $this->m->inner_trasition_add();
              if($inner){
                throw new Exception('Inner Trasition Succeed!',2);
              }else{
                throw new Exception('Inner Trasition Failed!',2);
              }
          }
      } catch (Exception $e){
        if($e->getCode() == 1){
          $this->err = $errArr;
        }else if($e->getCode() == 2){
          $this->msg = $e->getMessage();
        }
      }
    }

    $this->display('v/dashboard/inner_trasition');
  }

}