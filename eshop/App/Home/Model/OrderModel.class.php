<?php
/**
 * 订单模型
 */
namespace Home\Model;
use Think\Model;
class OrderModel extends Model{
	/**
	 * [orderCreate 订单创建]
	 * @return [type] [description]
	 */
	public function orderCreate(){
		$orderInfo = I('post.params');
		$addrId = I('post.addrId');
		is_num($addrId);
		$msg['status'] = 0;
		//获取用户收货地址信息
		$addrInfo = D('UserAddress')->getAddrById($addrId);
		//创建订单前先清空session保存的临时订单号
		if(isset($_SESSION['temp_orderNumber'])){
			session('temp_orderNumber',null);
			session('temp_orderPrice',null);
			session('temp_ordertime',null);
		}
		// 开启事务
		$this->startTrans();
		D('OrderGoods')->startTrans();
		D('Cart')->startTrans();
		D('Good')->startTrans();
		foreach ($orderInfo as $key => $val) {
			//生成订单编号
			$orderNum = $this->orderNumberCreate(intval($val['goodId']));
			$data= array(
				'orderNum' => $orderNum,
				'shopId' => intval($val['shopId']),
				'userId' => session('uid'),
				'userName' => $addrInfo['username'],
				'userAddr' => formatAddr($addrInfo['location'],0).$addrInfo['streetinfo'],
				'userTel' => $addrInfo['tel'],
				'goodsMoney' => $val['goodItemPrice'],
				'totalMoney' => $val['goodItemPrice'],
				'payType' => intval($val['payId']),
				'create_time' => time(),
				'Message' => isset($val['messages']) ? $val['messages'] : NULL,
				);
			//订单添加
			$id = $this->data($data)->add();
			//订单生成成功
			if($id){
				//插入订单商品信息
				$res = D('OrderGoods')->orderGoodsInfoAdd($val,$id);
				//删除购物车已完成的商品
				$res1 = D('Cart')->delCarts($val['goodId']);
				//更新商品的库存数量
				$res2 = D('Good')->changeStockByGoodId($val['goodId'],$val['goodMount'],1);
				if($res && $res1 && $res2){
					//提交成功后插入日志和信息发送
					D('OrderLogs')->orderLogAdd($id);
					$content = "您有一笔新的订单[".$orderNum."]待处理，请尽快处理！";
					D('Messages')->messageSend($val['shopId'],1,$content);
					$this->commit();
					D('OrderGoods')->commit();
					D('Cart')->commit();
					D('Good')->commit();
					//session存储订单编号和总价格
					$orderNumber[] = $orderNum;
					$orderPrices += $val['goodItemPrice']; 
					$msg['status'] = 1;
				}
				//回滚
				else{
					$this->rollback();
					D('OrderGoods')->rollback();
					D('Cart')->rollback();
					D('Good')->rollback();
					break;
				}
			}
			//订单创建失败
			else{
				$this->rollback();
				break;
			}
		}
		if(isset($orderNumber) && !empty($orderNumber)){
			session('temp_orderNumber',$orderNumber);
			session('temp_orderPrice',$orderPrices);
			session('temp_ordertime',time());
		}
		return $msg;
	}

	/**
	 * [orderLists 订单列表获取]
	 * @param  [type] $utype    [用户的身份类型，默认为0表示管理员获取，1表示商家获取，2表示用户获取]
	 * @param  [type] $listType [订单的类型默认为待支付订单]
	 * @param  [type] $searchType [订单获取类型默认为0表示获取数量，1表示获取订单信息分页列表]
	 * @param  [type] $page  [分页对象默认为空]
	 * @return [type]           [description]
	 */
	public function orderLists($utype=0,$listType='waitPay',$searchType=0,$page=null){
		if($utype === 1){
			//根据商家ID查找店铺ID
			$uid = session('uid');
			$shopId = D('Shop')->getShopById($uid);
			$where['shopId'] = $shopId;
		}
		if($utype === 2){
			$where['userId'] = session('uid');
		}
		$where['is_complaint'] = 0;
		switch ($listType) {
			case 'waitDelivery':
				$where['is_pay'] = 1;
				$where['is_deliver'] = 0;
				$where['is_cancel'] = 0;
				break;
			case 'delivered':
				$where['is_deliver'] = 1;
				$where['is_confirm'] = 0;
				$where['is_reject'] = 0;
				$where['is_recommend'] = 0;
				break;
			case 'finished':
				$where['is_confirm'] = 1;
				$where['is_recommend'] = 0;
				break;
			case 'cancle':
				$where['is_pay'] = 0;
				$where['is_cancel'] = 1;
				break;
			case 'refund':
				$where['is_confirm'] = 0;
				$where['is_reject'] = 1;
				break;
			default:
				$where['is_pay'] = 0;
				$where['is_cancel'] = 0;
				break;
		}
		if(!$searchType){
			return $this->where($where)->field('id')->count();
		}
		else{
			if($utype === 2 || $utype === 3){
				return $this->alias('o')
				->join('eshop_order_goods as g on o.id = g.orderId')
				->join('eshop_shop as s on o.shopId = s.id')
				->field('o.*,g.*,s.name,s.service_qq')
				->where($where)->order('o.create_time desc')
				->limit($page->firstRow, $page->listRows)
				->select();
			}
			else{
				return $this->alias('o')
				->join('eshop_order_goods as g on o.id = g.orderId')
				->where($where)->order('o.create_time desc')
				->limit($page->firstRow, $page->listRows)
				->select();	
			}
		}
	}

	/**
	 * [orderSearchList 订单搜索]
	 * @param  integer $utype      [用户的身份类型默认为0表示管理员获取，1表示商家获取，2表示用户获取]
	 * @param  [type]  $payType    [支付类型默认为0]
	 * @param  [type]  $orderNum   [订单编号默认为空]
	 * @param  string  $listType   [订单的类型默认为待支付订单]
	 * @param  integer $searchType [订单获取类型默认为0表示获取数量，1表示获取订单信息分页列表]
	 * @param  [type]  $page       [分页对象默认为空]
	 * @return [type]              [description]
	 */
	public function orderSearchList($utype=0,$payType=0,$orderNum=null,$listType='waitPay',$searchType=0,$page=null){
		if($utype === 1){
			//根据商家ID查找店铺ID
			$uid = session('uid');
			$shopId = D('Shop')->getShopById($uid);
			$where['shopId'] = $shopId;
		}
		if($utype === 2){
			$where['userId'] = session('uid');
		}
		//查询条件组合三种情况
		if($payType && empty($orderNum)){
			$where['payType'] = $payType;
		}
		if($payType === 0 && !empty($orderNum)){
			$where['orderNum'] = $orderNum;
		}
		if($payType && !empty($orderNum)){
			$where['payType'] = $payType;
			$where['orderNum'] = $orderNum;
		}
		$where['is_complaint'] = 0;
		switch ($listType) {
			case 'waitDelivery':
				$where['is_pay'] = 1;
				$where['is_deliver'] = 0;
				$where['is_cancel'] = 0;
				break;
			case 'delivered':
				$where['is_deliver'] = 1;
				$where['is_confirm'] = 0;
				$where['is_reject'] = 0;
				$where['is_recommend'] = 0;
				break;
			case 'finished':
				$where['is_confirm'] = 1;
				$where['is_recommend'] = 0;
				break;
			case 'cancle':
				$where['is_pay'] = 0;
				$where['is_cancel'] = 1;
				break;
			case 'refund':
				$where['is_confirm'] = 0;
				$where['is_reject'] = 1;
				break;
			default:
				$where['is_pay'] = 0;
				$where['is_cancel'] = 0;
				break;
		}
		if(!$searchType){
			return $this->where($where)->field('id')->count();
		}
		else{
			if($utype === 2 || $utype === 3){
				return $this->alias('o')
				->join('eshop_order_goods as g on o.id = g.orderId')
				->join('eshop_shop as s on o.shopId = s.id')
				->field('o.*,g.*,s.name,s.service_qq')
				->where($where)->order('o.create_time desc')
				->limit($page->firstRow, $page->listRows)
				->select();
			}
			else{
				return $this->alias('o')
				->join('eshop_order_goods as g on o.id = g.orderId')
				->where($where)->order('o.create_time desc')
				->limit($page->firstRow, $page->listRows)
				->select();	
			}
		}
	}
	
	/**
	 * [getOrderInfoById 获取单个订单详细信息]
	 * @param  [type] $orderId [订单的ID序列号]
	 * @return [type]          [description]
	 */
	public function getOrderInfoById($orderId){
		$where = array('id' => $orderId);
		return $this->where($where)->find();
	}

	/**
	 * [orderDelivered 订单发货]
	 * @return [type] $msg[description]
	 */
	public function orderDelivered(){
		$orderId = I('post.orderid',0,'intval');
		$company = I('post.companySelect',0,'intval');
		$expressNumber = I('post.expressNumber');
		$msg['status'] = 0;
		if(!checkExpressNumber($expressNumber)){
			$msg['content'] = '快递单号由12位数字组成';
		}
		else{
			//通过快递公司ID获得快递公司名称
			$companyName = M('express')->field('name')->where(array('id' => $company))->find();
			$where = array('id' => $orderId);
			$data = array(
				'is_deliver' => 1,
				'expressName' => $companyName['name'],
				'expressNumber' => $expressNumber,
				'deliverTime' => time(),
				);
			$id = $this->where($where)->save($data);
			if($id){
				$orderInfo = $this->getOrderInfoById($orderId);
				//发货成功，则给用户发一条message
				$content = "您的订单[".$orderInfo['ordernum']."]商家已经发货了，等待查收！";
				D('Messages')->messageSend($orderInfo['userid'],2,$content);
				//记录订单操作日志
				D('OrderLogs')->orderLogAdd($orderInfo['id'],2,1);
				$msg['status'] = 1;
				$msg['content'] = '发货成功！';
			}
			else{
				$msg['content'] = '发货失败！';
			}
		}
		return $msg;
	}

	/**
	 * [orderCancle 订单确定收货]
	 * @return [type] [description]
	 */
	public function orderReceive(){
		$orderId = I('post.orderId',0,'intval');
		$msg['status'] = 0;
		$where = array('id' => $orderId);
		$data = array(
			'is_confirm' => 1,
			'confirmTime' => time(),
			);
		$id = $this->where($where)->save($data);
		if($id){
			$orderInfo = $this->getOrderInfoById($orderId);
			//取消成功则向商家发送一条消息
			$content = "订单[".$orderInfo['ordernum']."]用户已经确认收货！";
			D('Messages')->messageSend($orderInfo['shopid'],1,$content);
			//记录订单操作日志
			D('OrderLogs')->orderLogAdd($orderInfo['id'],3,0);
			$msg['status'] = 1;
		}
		return $msg;
	}

	/**
	 * [orderCancle 订单取消]
	 * @return [type] [description]
	 */
	public function orderCancle(){
		$orderId = I('post.id',0,'intval');
		$reasonId = I('post.reasonId',0,'intval');
		$msg['status'] = 0;
		$where = array('id' => $orderId);
		$data = array(
			'is_cancel' => 1,
			'cancelTime' => time(),
			'cancleReason' => $reasonId,
			);
		$this->startTrans();
		D('Good')->startTrans();
		$id = $this->where($where)->save($data);
		if($id){
			//若取消成功则退回库存
			$orderGoodInfo = D('OrderGoods')->field('goodId,goodNum')
			->where(array('orderId' => $orderId))
			->find();
			$gid = D('Good')->changeStockByGoodId($orderGoodInfo['goodid'],$orderGoodInfo['goodnum'],0);
			if($gid){
				$this->commit();
				D('Good')->commit();
				$orderInfo = $this->getOrderInfoById($orderId);
				//取消成功则向商家发送一条消息
				$content = "订单[".$orderInfo['ordernum']."]已被用户取消！";
				D('Messages')->messageSend($orderInfo['shopid'],1,$content);
				//记录订单操作日志
				D('OrderLogs')->orderLogAdd($orderInfo['id'],-1,0);
				$msg['status'] = 1;
				$msg['content'] = '订单取消成功！';
			}
			else{
				$this->rollback();
				D('Good')->rollback();
				$msg['content'] = '订单取消失败！';
			}	
		}
		else{
			$this->rollback();
			$msg['content'] = '订单取消失败！';
		}
		return $msg;
	}

	/**
	 * [orderReject 订单拒收]
	 * @return [type] [description]
	 */
	public function orderReject(){
		$orderId = I('post.id',0,'intval');
		$reasonId = I('post.reasonId',0,'intval');
		$msg['status'] = 0;
		$where = array('id' => $orderId);
		$data = array(
			'is_reject' => 1,
			'rejectTime' => time(),
			'rejectReason' => $reasonId,
			);
		$this->startTrans();
		$id = $this->where($where)->save($data);
		if($id){
			$orderInfo = $this->getOrderInfoById($orderId);
			//取消成功则向商家发送一条消息
			$content = "订单[".$orderInfo['ordernum']."]已被用户拒收！";
			D('Messages')->messageSend($orderInfo['shopid'],1,$content);
			//记录订单操作日志
			D('OrderLogs')->orderLogAdd($orderInfo['id'],-2,0);
			$this->commit();
			$msg['status'] = 1;
			$msg['content'] = '订单拒收成功！';
		}
		else{
			$this->rollback();
			$msg['content'] = '订单拒收失败！';
		}
		return $msg;
	}

	/**
	 * [orderDel 订单删除]
	 * @return [type] [description]
	 */
	public function orderDel(){
		$orderId = I('post.orderId',0,'intval');
		$msg['status'] = 0;
		$where = array('id' => $orderId);
		$id = $this->where($where)->delete();
		if($id){
			$msg['status'] = 1;
		}
		return $msg;
	}

	/**
	 * [orderNumberCreate 订单编号生成由订单生成时间+商品ID+用户ID+4位随机数]
	 * @param  [type] $goodId [description]
	 * @return [type]         [订单号]
	 */
	private function orderNumberCreate($goodId){
		return time().$goodId.session('uid').get_random(4);
	}
}