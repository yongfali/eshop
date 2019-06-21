<?php
/**
 * 后台首页框架控制器
 */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController{
	/**
	 * [index 后台首页]
	 * @return [type] [description]
	 */
	public function index(){
		//统计会员数量
		$userNum = D('Home/User')->userCount();
		$todayUserNum = D('Home/User')->userCount(1);
		//统计商家数量
		$shoperNum = D('Home/Shoper')->shopCount();
		$todayShoperNum = D('Home/Shoper')->shopCount(1);
		$waitAuthoShop = D('Home/Shoper')->shopCount(2);
		//商品数量统计
		$goodNum = D('Good')->goodCount();
		$todayGoodNum =  D('Good')->goodCount(1);
		$waitAuthoGood = D('Good')->goodCount(2);
		//订单数量统计
		$orderNum = D('Order')->orderCount();
		$todayOrderNum = D('Order')->orderCount(1);
		$complaintOrder = D('Order')->orderCount(2);
		$todaycomplaintOrder = D('Order')->orderCount(3);
		//评价总数
		$commentNum = M('Goodcomment')->count(); 
		//模板赋值
		$this->assign('userNum',$userNum);
		$this->assign('todayUserNum',$todayUserNum);
		$this->assign('shoperNum',$shoperNum);
		$this->assign('todayShoperNum',$todayShoperNum);
		$this->assign('waitAuthoShop',$waitAuthoShop);
		$this->assign('goodNum',$goodNum);
		$this->assign('todayGoodNum',$todayGoodNum);
		$this->assign('waitAuthoGood',$waitAuthoGood);
		$this->assign('orderNum',$orderNum);
		$this->assign('todayOrderNum',$todayOrderNum);
		$this->assign('complaintOrder',$complaintOrder);
		$this->assign('todaycomplaintOrder',$todaycomplaintOrder);
		$this->assign('commentNum',$commentNum);
		$this->display();
	}

	/**
	 * [loginout 退出登录]
	 * @return [type] [description]
	 */
	public function loginout(){
		session('adminId',null);
		session('adminName',null);
		redirect(U('Admin/Login/index'));
	}
}