<?php
/**
 * 用户订单操作控制器
 */
namespace Home\Controller;
use Think\Controller;
class UserOrdersController extends CommonController{
	/**
	 * [orderSubmit 订单提交]
	 * @return [type] [description]
	 */
	public function orderSubmit(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$msg = D('Order')->orderCreate();
		//订单提交成功后清空选中商品的临时session值
		session('cart_temp',null);
		$this->ajaxReturn($msg);
	}

	/**
	 * [orderDetail 订单详情]
	 * @return [type] [description]
	 */
	public function orderDetail(){
		$orderId = I('get.orderId');
		is_num($orderId);
		$orderInfo = D('Order')->getOrderInfoById($orderId);
		$this->assign('orderInfo',$orderInfo);
		$this->display();
	}

	/**
	 * [waitPay 待付款订单页面显示]
	 * @return [type] [description]
	 */
	public function waitPay(){
		$this->getOrderLists();
	}

	/**
	 * [orderToPay 待付款订单页面支付功能实现]
	 * @return [type] [description]
	 */
	public function orderToPay(){
		$orderId = I('post.orderId',0,'intval');
		is_num($orderId);
		$orderInfo = D('Order')->getOrderInfoById($orderId);
		if($orderInfo){
			session('temp_orderNumber',null);
			session('temp_orderPrice',null);
			//session保存订单编号和总价格
			$orderNumber[] = $orderInfo['ordernum'];
			session('temp_orderNumber',$orderNumber);
			session('temp_orderPrice',$orderInfo['totalmoney']);
			session('temp_ordertime',time());
			$msg = 1;
		}
		else{
			$msg = 0;
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [waitDelivery 等待发货页面]
	 * @return [type] [description]
	 */
	public function waitDelivery(){
		$pageType = 'waitDelivery';
		$this->getOrderLists($pageType);
	}

	/**
	 * [delivered 待收货订单页面显示]
	 * @return [type] [description]
	 */
	public function waitReceive(){
		$pageType = 'delivered';
		$this->getOrderLists($pageType);
	}

	/**
	 * [finished 待评价订单页面显示]
	 * @return [type] [description]
	 */
	public function waitAppraise(){
		$pageType = 'finished';
		$this->getOrderLists($pageType);
	}

	/**
	 * [appraised 已评论订单页面]
	 * @return [type] [description]
	 */
	public function appraised(){
		$count = D('Goodcomment')->orderAppraisedList();
		$page = getpage($count,3);
		$lists = D('Goodcomment')->orderAppraisedList(0,1,$page);
		if(IS_AJAX){
			$this->assign('lists', $lists);
			$this->assign('page', $page->show());
			$html = $this->fetch('UserOrders/appraisedAjaxPage');
			$this->ajaxReturn($html);
		}
		$this->assign('lists', $lists);
		$this->assign('page', $page->show());
		$this->display();
	}

	/**
	 * [orderAppraise 订单评价页面]
	 * @return [type] [description]
	 */
	public  function orderAppraise(){
		$orderInfo = D('OrderGoods')->getOrderInfo();
		$this->assign('orderInfo',$orderInfo);
		$this->display();
	}

	/**
	 * [orderAppraiseDo 订单评价处理]
	 * @return [type] [description]
	 */
	public function orderAppraiseDo(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Goodcomment')->orderAppraiseDo();
		$this->ajaxReturn($msg);
	}

	/**
	 * [failure 已取消订单页面显示]
	 * @return [type] [description]
	 */
	public function failure(){
		$pageType = 'cancle';
		$this->getOrderLists($pageType);
	}

	/**
	 * [cancle 订单取消原因页面]
	 * @return [type] [description]
	 */
	public function cancle(){
		$orderId = I('get.orderId');
		is_num($orderId);
		$this->assign('orderId',$orderId);
		$this->display('cancleReason');
	}

	/**
	 * [orderCancleDo 订单取消操作]
	 * @return [type] [description]
	 */
	public function orderCancleDo(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Order')->orderCancle();
		$this->ajaxReturn($msg);
	}

	/**
	 * [complaintDetail 投诉详情页面显示]
	 * @return [type] [description]
	 */
	public function complaintDetail(){
		$orderInfo = D('OrderGoods')->getOrderInfo();
		$this->assign('orderInfo',$orderInfo);
		$this->display('complain');
	}

	/**
	 * [complainDo 订单投诉提交处理]
	 * @return [type] [description]
	 */
	public function complainDo(){
		if(!IS_AJAX){
			E(页面不存在！);
		}
		$msg = D('OrderComplaint')->complainOrderCreate();
		$this->ajaxReturn($msg);
	}

	/**
	 * [orderReceive 订单确认收货]
	 * @return [type] [description]
	 */
	public function orderReceive(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Order')->orderReceive();
		$this->ajaxReturn($msg);
	}

	/**
	 * [reject 订单拒收原因页面显示]
	 * @return [type] [description]
	 */
	public function reject(){
		$orderId = I('get.orderId');
		is_num($orderId);
		$this->assign('orderId',$orderId);
		$this->display('rejectReason');
	}

	/**
	 * [orderRejectDo 订单拒收操作]
	 * @return [type] [description]
	 */
	public function orderRejectDo(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Order')->orderReject();
		$this->ajaxReturn($msg);
	}

	/**
	 * [orderDel 订单删除]
	 * @return [type] [description]
	 */
	public function orderDel(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Order')->orderDel();
		$this->ajaxReturn($msg);
	}

	/**
	 * [refund 拒收或退款页面显示]
	 * [前期只完成拒收功能后期完善退款]
	 * @return [type] [description]
	 */
	public function refund(){
		$pageType = 'refund';
		$this->getOrderLists($pageType);
	}

	/**
	 * [orderSearch 订单检索]
	 * @return [type] [description]
	 */
	public function orderSearch(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$dic = array('waitPay','waitDelivery','delivered','finished','cancle','refund');
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
			//查询结果数量获取
			$count = D('Order')->orderSearchList(2,$payWay,$orderNum,$type);
			//ajax分页后点击分页有问题
			$page = getpage($count,6);
			$lists = D('Order')->orderSearchList(2,$payWay,$orderNum,$type,1,$page);
			//模板赋值
			$this->assign('lists', $lists);
			$this->assign('page', $page->show());
			$this->assign('pageType',$type);
			$html = $this->fetch('UserOrders/orderAjaxPage');
			$msg['status'] = 1;
			$msg['content'] = $html;
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [getOrderLists 订单页面显示公共部分]
	 * @param  [type] $listType [订单的类型默认为待支付订单]
	 * @return [type]              [description]
	 */
	private function getOrderLists($listType='waitPay'){
		$count = D('Order')->orderLists(2,$listType);
		$page = getpage($count,4);
		$lists = D('Order')->orderLists(2,$listType,1,$page);
		if(IS_AJAX){
			$this->assign('lists', $lists);
			$this->assign('page', $page->show());
			$this->assign('pageType',$listType);
			$html = $this->fetch('UserOrders/orderAjaxPage');
			$this->ajaxReturn($html);
		}
		// 模板赋值
		$this->assign('lists', $lists);
		$this->assign('page', $page->show());
		$this->display();
	}
}