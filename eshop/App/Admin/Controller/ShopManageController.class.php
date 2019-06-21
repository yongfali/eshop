<?php
/**
 * 后台店铺管理控制器
 */
namespace Admin\Controller;
use Think\Controller;
class ShopManageController extends BaseController{
	/**
	 * [autho 店铺认证列表显示页面]
	 * @return [type] [description]
	 */
	public function autho(){
		$this->display();
	}

	/**
	 * [addAutho 添加店铺认证]
	 * @return [type] [description]
	 */
	public function addAuthoDo(){
		var_dump(I('post.'));
		var_dump($_FILES['photo']);
	}

	/**
	 * [apply 开店申请待审核列表]
	 * @return [type] [description]
	 */
	public function apply(){
		$waitAuthoShop = D('Shop')->waitAuthoShop();
		$this->assign('waitAuthoShop',$waitAuthoShop);
		$this->display('shopApply');
	}

	/**
	 * [shopAuthoDo 店铺审核通过]
	 * @return [type] [description]
	 */
	public function shopAuthoDo(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Shop')->shopAuthoed();
		$this->ajaxReturn($msg);
	}

	/**
	 * [shoperDel 待审核商家删除]
	 * @return [type] [description]
	 */
	public function shoperDel(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Shop')->shopDel();
		$this->ajaxReturn($msg);
	}
}