<?php
/**
 * 后台商品管理控制器
 */
namespace Admin\Controller;
use Think\Controller;
class GoodManageController extends BaseController{
	/**
	 * [onsale 上架的商品列表]
	 * @return [type] [description]
	 */
	public function onsale(){
		$this->display();
	}

	/**
	 * [autho 待审核商品列表]
	 * @return [type] [description]
	 */
	public function autho(){
		$goodList = D('Good')->goodList(0);
		$this->assign('goodList',$goodList);
		$this->display('waitAutho');
	}

	/**
	 * [goodAuthoDo 商品审核实现]
	 * @return [type] [description]
	 */
	public function goodAuthoDo(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Good')->goodAuthoed();
		$this->ajaxReturn($msg);
	}
}