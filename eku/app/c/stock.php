<?php
class stock extends base{
  function __construct()
  {
  		parent::__construct();
      $this->m = load('m/stock_m');	
  }
  
  function index()
  {
  	redirect(BASE.'stock/inbound_list','','',0);    
  }

  function inbound_list(){
    $this->m->table = 'Inbound';
    $this->fields = array('Inbound_id','CreateTime','Approver_id','Suppliers_Sid','Deliverer');
    
    if(seg(3) != 's'){
      $page_cur = seg(4)?seg(4):1;
      $res = $this->m->get_many('order by CreateTime desc',$page_cur,10);
      $tot = $this->m->count();
      $pagination = pagination($tot ,  $page_cur, 10 ,BASE.'stock/inbound_list/p/');
    }else{
      $page_cur = seg(6)?seg(6):1;
      $where = 'AND Deliverer like "%'.urldecode(strip_tags(trim(seg(4)))).'%" order by CreateTime desc';
      $res = $this->m->get_many($where,$page_cur,10);
      $tot = $this->m->count($where);
      $pagination = pagination($tot ,  $page_cur, 10 ,BASE.'stock/inbound_list/s/'.urlencode(strip_tags(trim(seg(4)))).'/p/');
    }

    $this->display('v/stock/inbound_list',array('res'=>$res,'pagination'=>$pagination,'m'=>$this->m,'map'=>$this->inbound_statistics()),true);
  }

  function inbound_see(){
    $this->m->table = 'Inbound';
    $this->m->key = 'Inbound_id';
    $res = $this->m->get_one(seg(4));

    $Inbound_id = seg(4);
    $list = $this->m->db->query("select * from Inbound_details where Inbound_id = $Inbound_id order by Inbound_id desc");
    $this->display('v/stock/inbound_see',array('res'=>$res,'list'=>$list));
  }

  private function inbound_statistics(){
    $res = $this->m->db->query('select * from Suppliers_Order_statistics order by CreateTime desc limit 0,10');
    return $res;
  }

  function outbound_list(){
    $this->m->table = 'Outbound';
    $this->fields = array('Outbound_id','Customer_Cid','Createtime','Approver_id','Consignee');
    
    if(seg(3) != 's'){
      $page_cur = seg(4)?seg(4):1;
      $res = $this->m->get_many('order by Createtime desc',$page_cur,10);
      $tot = $this->m->count();
      $pagination = pagination($tot ,  $page_cur, 10 ,BASE.'stock/outbound_list/p/');
    }else{
      $page_cur = seg(6)?seg(6):1;
      $where = 'AND Consignee like "%'.urldecode(strip_tags(trim(seg(4)))).'%" order by Createtime desc';
      $res = $this->m->get_many($where,$page_cur,10);
      $tot = $this->m->count($where);
      $pagination = pagination($tot ,  $page_cur, 10 ,BASE.'stock/outbound_list/s/'.urlencode(strip_tags(trim(seg(4)))).'/p/');
    }

    $this->display('v/stock/outbound_list',array('res'=>$res,'pagination'=>$pagination,'m'=>$this->m,'map'=>$this->outbound_statistics()),true);
  }

  function outbound_see(){
    $this->m->table = 'Outbound';
    $this->m->key = 'Outbound_id';
    $res = $this->m->get_one(seg(4));

    $Outbound_id = seg(4);
    $list = $this->m->db->query("select * from Outbound_details where Outbound_id = $Outbound_id order by Outbound_id desc");
    $this->display('v/stock/outbound_see',array('res'=>$res,'list'=>$list));
  }

  //出库单统计
  private function outbound_statistics(){
    $res = $this->m->db->query('select * from Customer_Order_statistics order by CreateTime desc limit 0,10');
    return $res;
  }

  function inner_list(){
    $this->m->table = 'Inner_Trasition';
    $this->fields = array('Transitionid','I_T_Wid','Amount','Items_Iname','Operate','Stockid','Time');
    
    if(seg(3) != 's'){
      $page_cur = seg(4)?seg(4):1;
      $res = $this->m->get_many('order by Time desc',$page_cur,10);
      $tot = $this->m->count();
      $pagination = pagination($tot ,  $page_cur, 10 ,BASE.'stock/inner_list/p/');
    }else{
      $page_cur = seg(6)?seg(6):1;
      $where = 'AND Items_Iname like "%'.urldecode(strip_tags(trim(seg(4)))).'%" order by Time desc';
      $res = $this->m->get_many($where,$page_cur,10);
      $tot = $this->m->count($where);
      $pagination = pagination($tot ,  $page_cur, 10 ,BASE.'stock/inner_list/s/'.urlencode(strip_tags(trim(seg(4)))).'/p/');
    }

    $this->display('v/stock/inner_list',array('res'=>$res,'pagination'=>$pagination,'m'=>$this->m,'map'=>$this->innerbound_statistics()),true);
  
  }

  function innerbound_see(){
    $this->m->table = 'Inner_Trasition';
    $this->m->key = 'Transitionid';
    $res = $this->m->get_one(seg(4));

    $Inbound_id = seg(4);
    $list = $this->m->db->query("select * from Inbound_details where Inbound_id = $Inbound_id order by Inbound_id desc");
    $this->display('v/stock/inbound_see',array('res'=>$res,'list'=>$list));
  }
  private function innerbound_statistics(){
    $res = $this->m->db->query('select * from Inner_Trasition order by Time desc limit 0,10');
    return $res;
  }

    function inbound_export()
  {
    $list = $this->m->db->query("select * from Inbound");
    $this->excel('v/stock/stock_excel',$list);    
  }


}