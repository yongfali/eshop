<?php
/**
*eshop底部帮助中心控制器
*/
namespace Home\Controller;
use Think\Controller;
class HelpController extends BaseController{
	/**
	 * [index 帮助中心页面详情展示]
	 * @return [type] [description]
	 */
	public function index(){
		$id = I('get.id');
		is_num($id);
		$content = D('FooterNav')->getNavInfoById($id);
		$this->assign('content',$content);
		$this->display();
	}
}