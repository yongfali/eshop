<?php
/**
*店铺订单控制器
*/
namespace Home\Controller;
use Think\Controller;
class ShopOrdersController extends ShoperCommonController{

	/**
	 * [waitPay 待付款订单页面显示]
	 * @return [type] [description]
	 */
	public function waitPay(){
		$this->getOrderLists();
	}

	/**
	 * [waitDelivery 待发货订单页面显示]
	 * @return [type] [description]
	 */
	public function waitDelivery(){
		$pageType = 'waitDelivery';
		$this->getOrderLists($pageType);
	}

	/**
	 * [delivered 已发货订单页面显示]
	 * @return [type] [description]
	 */
	public function delivered(){
		$pageType = 'delivered';
		$this->getOrderLists($pageType);
	}

	/**
	 * [finished 已收货订单页面显示]
	 * @return [type] [description]
	 */
	public function finished(){
		$pageType = 'finished';
		$this->getOrderLists($pageType);
	}

	/**
	 * [failure 取消/拒收订单页面显示]
	 * @return [type] [description]
	 */
	public function failure(){
		$pageType = 'cancle';
		$this->getOrderLists($pageType);
		$this->display();
	}

	/**
	 * [complaint 投诉订单页面显示]
	 * @return [type] [description]
	 */
	public function complaint(){
		$count = D('OrderComplaint')->getComplainOrderList(1);
		$page = getpage($count,10);
		$lists = D('OrderComplaint')->getComplainOrderList(1,1,$page);
		if(IS_AJAX){
			$this->assign('lists', $lists);
			$this->assign('page', $page->show());
			$this->assign('pageType',$listType);
			$html = $this->fetch('ShopOrders/complainOrderAjaxPage');
			$this->ajaxReturn($html);
		}
		// 模板赋值
		$this->assign('lists', $lists);
		$this->assign('page', $page->show());
		$this->display();
	}

	/**
	 * [complaintDetail 投诉详情页面显示]
	 * @return [type] [description]
	 */
	public function complaintDetail(){
		$id = I('get.cid',0,'intval');
		is_num($id);
		$orderInfo = D('OrderComplaint')->getComplainOrderById($id);
		$this->assign('info',$orderInfo);
		$this->display();
	}

	/**
	 * [orderDetail 订单详情]
	 * @return [type] [description]
	 */
	public function orderDetail(){
		$orderId = I('get.orderId');
		is_num($orderId);
		$oerderInfo = D('Order')->getOrderInfoById($orderId);
		$this->assign('orderInfo',$oerderInfo);
		$this->display();
	}

	/**
	 * [orderSearch 订单检索]
	 * @return [type] [description]
	 */
	public function orderSearch(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$dic = array('waitPay','waitDelivery','delivered','finished','cancle');
		$payWay = I('post.payWay',0,'intval');
		$orderNum = I('post.orderNumber');
		$type = I('post.type');
		$msg['status'] = 0;
		if($payWay === 0 && empty($orderNum)){
			$msg['content'] = '查询条件不能为空！';
		}
		else if(!in_array($type, $dic)){
			$msg['content'] = '非法搜索！';
		}
		else{
			//查询结果获取
			//查询结果数量获取
			$count = D('Order')->orderSearchList(1,$payWay,$orderNum,$type);
			//ajax分页后点击分页有问题
			$page = getpage($count,6);
			$lists = D('Order')->orderSearchList(1,$payWay,$orderNum,$type,1,$page);
			//模板赋值
			$this->assign('lists', $lists);
			$this->assign('page', $page->show());
			$this->assign('pageType',$typee);
			$html = $this->fetch('ShopOrders/orderAjaxPage');
			$msg['status'] = 1;
			$msg['content'] = $html;
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [express 发货快递信息显示页面]
	 * @return [type] [description]
	 */
	public function express(){
		$orderId = I('get.orderId');
		is_num($orderId);
		//快递公司名称列表
		$expressList = M('express')->where(array('is_show' => 1))->select();
		$this->assign('expressList',$expressList);
		$this->assign('orderId',$orderId);
		$this->display();
	}

	/**
	 * [orderDeliverDo 订单发货操作]
	 * @return [type] [description]
	 */
	public function orderDeliverDo(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Order')->orderDelivered();
		$this->ajaxReturn($msg);
	}
	
	/**
	 * [getOrderLists 订单页面显示公共部分]
	 * @param  [type] $listType [订单的类型默认为待支付订单]
	 * @return [type]              [description]
	 */
	private function getOrderLists($listType='waitPay'){
		$count = D('Order')->orderLists(1,$listType);
		$page = getpage($count,5);
		$lists = D('Order')->orderLists(1,$listType,1,$page);
		if(IS_AJAX){
			$this->assign('lists', $lists);
			$this->assign('page', $page->show());
			$this->assign('pageType',$listType);
			$html = $this->fetch('ShopOrders/orderAjaxPage');
			$this->ajaxReturn($html);
		}
		// 模板赋值
		$this->assign('lists', $lists);
		$this->assign('page', $page->show());
		$this->display();
	}
}