<?php
class item extends base{
  function __construct()
  {
  		parent::__construct();
      $this->m = load('m/item_m');
  }
  
  function index()
  {
  	redirect(BASE.'item/item_category_list','','',0);    
  }

  //物品大类列表
  function item_category_list(){
    $this->m->table = 'Item_Category';
    $this->fields = array('ICname','Spec');
    
    if(seg(3) != 's'){
      $page_cur = seg(4)?seg(4):1;
      $res = $this->m->get_many('',$page_cur,10);
      $tot = $this->m->count();
      $pagination = pagination($tot ,  $page_cur, 10 ,BASE.'item/item_category_list/p/');
    }else{
      $page_cur = seg(6)?seg(6):1;
      $where = 'AND ICname like "%'.urldecode(strip_tags(trim(seg(4)))).'%" OR Spec like "%'.urldecode(strip_tags(trim(seg(4)))).'%"';
      $res = $this->m->get_many($where,$page_cur,10);
      $tot = $this->m->count($where);
      $pagination = pagination($tot ,  $page_cur, 10 ,BASE.'item/item_category_list/s/'.urlencode(strip_tags(trim(seg(4)))).'/p/');
    }

    //$res = $this->m->item_Category_getAll();
    $this->display('v/item/item_category_list',array('res'=>$res,'pagination'=>$pagination,'m'=>$this->m),true);
  }

  function item_category_add(){
    if(isset($_POST['item_add'])){
      $conf = array('ICname'=>'required','Spec'=>'required');
      $err = validate($conf);
      if ( $err === TRUE) {
          $this->m->item_Category_add();
          $this->msg = 'Add Succeeded';
      }else{
        $this->err = $err;
      }
    }
    $this->display('v/item/item_category_add');
  }

  function item_category_edit(){
    $this->m->table = 'Item_Category';
    $this->m->key = 'ICname';
    $this->m->fields = array('ICname','Spec');
    $ICname = urldecode(seg(4));
    if(isset($_POST['item_category_edit'])){
      $conf = array('ICname'=>'required','Spec'=>'required');
      $err = validate($conf);
      if ( $err !== TRUE ) {
        $this->err = $err;
      }
      $up = $this->m->update($ICname);
      $this->msg = $up?'Edit Succeeded':'Edit Failed';
    }
    $res = $this->m->get_one($ICname);
    $this->display('v/item/item_category_edit',array('res'=>$res));
  }

  function item_category_remove(){
    $this->m->table = 'Item_Category';
    $this->m->key = 'ICname';
    $this->m->del(urldecode(seg(4)));
    redirect('?/item/item_category_list','Delete Succeeded','',3);
  }

  function item_see(){
    $items = $this->m->item_getByICname(urldecode(seg(4)));
    

    $this->display('v/item/item_list',array('items'=>$items),true);
  }

  function item_see_search(){

  }
  
  function item_add(){
    $this->addParams = array(
      'submitName'=>'item_add', //提交按钮
      'required'=>array('Iname','ICname','Unit'),  //必填字段
      'addCondition'=>false, //排重条件
      'addConditionMsg'=>'Repeat information!',  //出现重复时，给出提示文字
      'addExcute'=>array('m'=>$this->m,'method'=>'item_add'),  //执行添加
      'view'=>'v/item/item_add'  //视图
    );
    $this->actionAdd();
  }

  function item_edit(){
    $this->m->table = 'Items';
    $this->m->key = 'Iname';
    $this->m->fields = array('Iname','ICname','Unit');
    $Iname = urldecode(seg(4));
    if(isset($_POST['item_edit'])){
      $conf = array('ICname'=>'required','Spec'=>'required');
      $err = validate($conf);
      if ( $err !== TRUE ) {
        $this->err = $err;
      }
      $up = $this->m->update($Iname);
      $this->msg = $up?'Edit Succeeded':'Edit Failed';
      $up && redirect('?/item/item_edit/Iname/'.$_POST['Iname'],'','',0);
    }
    $res = $this->m->get_one($Iname);
    $this->display('v/item/item_edit',array('res'=>$res));
  }

  function item_remove(){
    $this->m->table = 'Items';
    $this->m->key = 'Iname';
    $this->m->del(urldecode(seg(4)));
    redirect('?/item/item_category_list','Delete succeeded','',3);
  }

  function item_statistics(){
    $this->m->table = 'Stock_collection';
    $this->fields = array('Remain_Amount','Items_Iname','Minimum','Maximum');
    
    $page_cur = seg(4)?seg(4):1;
    $res = $this->m->get_many('',$page_cur,10);
    $tot = $this->m->count();
    $pagination = pagination($tot ,  $page_cur, 10 ,BASE.'item/item_statistics/p/');

    $this->display('v/item/statistics',array('res'=>$res,'pagination'=>$pagination));
  }

}