<?php
/**
 * 投诉订单模型
 */
namespace Home\Model;
use Think\Model;
class OrderComplaintModel extends Model{
	//自动完成
	protected $_auto = array(
		array('time','time',1,'function'),
		);

	/**
	 * [complainOrderCreate 投诉订单生成]
	 * @return [type] [description]
	 */
	public function complainOrderCreate(){
		$_POST['userId'] = session('uid');
		$msg['status'] = 0;
		$this->startTrans();
		D('Order')->startTrans();
		if($this->create()){
			$res = $this->add();
			if($res){
				// 修改订单表is_complaint字段为1
				$res1 = D('Order')-> where(array('id' => I('post.orderId',0,'intval')))->setField('is_complaint','1');
				if($res1){
					// 如果投诉成功则给商家发送消息并记录订单日志
					$orderInfo = D('Order')->where(array('id' => I('post.orderId',0,'intval')))->getField('orderNum');
					$userInfo = D('User')->where(array('id' => session('uid')))->getField('name');
					$content = "您的订单[".$orderInfo."]已被用户[".$userInfo."]投诉！";
					D('Messages')->messageSend(I('post.shopId',0,'intval'),$type=1,$content);
					$this->commit();
					D('Order')->commit();
					$msg['status'] = 1;
				}
				else{
					$this->rollback();
					D('Order')->rollback();
				}
			}
			else{
				$this->rollback();
			}
		}
		return $msg;
	}

	/**
	 * [getComplainOrderList 获取投诉订单列表]
	 * @param  integer $utype [用户身份类型默认为0：用户，1，表示商家，2表示管理员]
	 * @param  [type] $searchType [订单获取类型默认为0表示获取数量，1表示获取订单信息分页列表]
	 * @param  [type] $page  [分页对象默认为空]
	 * @return [type]         [description]
	 */
	public function getComplainOrderList($utype=0,$searchType=0,$page=null){
		if($utype === 1){
			//根据商家ID查找店铺ID
			$uid = session('uid');
			$shopId = D('Shop')->getShopById($uid);
			$where['shopId'] = $shopId;
		}
		else{
			$where['userId'] = session('uid');
		}
		if(!$searchType){
			return $this->where($where)->count();
		}
		else{
			if($utype === 1){
				return $this->alias('c')
				->join('eshop_order as o on c.orderId = o.id')
				->join('eshop_shop as s on c.shopId = s.id')
				->join('eshop_user as u on c.userId = u.id')
				->field('c.*,o.orderNum,u.name username,u.qq uqq')
				->where(array('c.shopId' =>$shopId ))
				->order('time desc')
				->limit($page->firstRow, $page->listRows)
				->select();
			}
			else{
				return $this->alias('c')
				->join('eshop_order as o on c.orderId = o.id')
				->join('eshop_shop as s on c.shopId = s.id')
				->field('c.*,o.orderNum,s.name shopName')
				->where(array('c.userId' =>session('uid') ))
				->order('time desc')
				->limit($page->firstRow, $page->listRows)
				->select();
			}
			
		}
	}

	/**
	 * [getComplainOrderById 获取指定投诉订单信息]
	 * @param  [type] $orderId [投诉订单的ID]
	 * @return [type]          [description]
	 */
	public function getComplainOrderById($orderId){
		return $this->alias('c')
		->join('eshop_order as o on c.orderId = o.id')
		->field('c.*,o.orderNum')
		->where(array('c.id' => $orderId))
		->find();
	}

	/**
	 * [Withdrawal 投诉订单撤诉操作]
	 */
	public function Withdrawal(){
		$orderId = I('post.orderId',0,'intval');
		is_num($orderId);
		$msg = 0;
		$data = array(
			'is_cancle' => 1,
			'cancleTime' => time(),
			);
		$id = $this->where(array('orderId' => $orderId))
		->save($data);
		if($id){
			//如果撤诉成功则给商家发送一条信息
			$orderInfo = D('Order')->where(array('id' => $orderId))->field('orderNum,shopId')->find();
			$userInfo = D('User')->where(array('id' => session('uid')))->getField('name');
			$content = "您的订单[".$orderInfo['ordernum']."]用户[".$userInfo."]已经取消了投诉！";
			D('Messages')->messageSend($orderInfo['shopid'],$type=1,$content);
			$msg = 1;
		}
		return $msg;
	}
}