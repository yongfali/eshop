<?php
/**
 * 订单商品信息模型
 */
namespace Home\Model;
use Think\Model;
class OrderGoodsModel extends Model{
	/**
	 * [orderGoodsInfoAdd 订单商品信息添加]
	 * @param  [type] $goodInfo [商品基本信息]
	 * @param  [type] $orderId  [订单ID]
	 * @return [type]           [description]
	 */
	public function orderGoodsInfoAdd($goodInfo,$orderId){
		$data = array(
			'orderId' => $orderId,
			'goodId' => $goodInfo['goodId'],
			'goodNumber' => $goodInfo['goodNumber'],
			'goodNum' => $goodInfo['goodMount'],
			'goodPrice' => $goodInfo['goodPrice'],
			'goodName' => $goodInfo['goodName'],
			'goodImg' => $goodInfo['goodImg'],
			);
		return $this->add($data);
	}

	/**
	 * [getOrderInfo 获取订单商品信息]
	 * @param  [type] $orderId [订单序列号]
	 * @return [type]          [description]
	 */
	public function getOrderInfo(){
		$orderId = I('get.orderId',0,'intval');
		$goodId = I('get.goodId',0,'intval');
		is_num($orderId);
		is_num($goodId);
		return D('Order')->alias('o')
		->join('eshop_order_goods as g on o.id = g.orderId')
		->join('eshop_shop as s on o.ShopId = s.id')
		->field('o.id orderId,o.orderNum,o.totalMoney,o.create_time,o.confirmTime,g.goodImg,g.goodId,s.name,s.id shopId')
		->where(array('o.id' => $orderId, 'g.goodId' => $goodId))
		->find();
	}
}