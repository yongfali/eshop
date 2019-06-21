<?php
/**
 * 网站通知信息模型
 */
namespace Home\Model;
use Think\Model;
class MessagesModel extends Model{
	/**
	 * [messageSend 订单操作信息发送]
	 * @param  [type]  $receiveId [信息接收者ID]
	 * @param  integer $type      [信息接受者身份，1商家，2用户，3管理员]
	 * @param  [type]  $content   [信息内容]
	 * @return [type]             [description]
	 */
	public function messageSend($receiveId,$type=1,$content){
		$data = array(
			'sendId' => session('uid'),
			'receiveId' => $receiveId,
			'receiveType' =>$type,
			'content' => $content,
			'sendTime' => time(),　　
			);
		return $this->data($data)->add();
	}

	/**
	 * [getMessagesList 获取消息]
	 * @param  integer $type        [获取消息类型默认为0：获取数量，1获取分页数据]
	 * @param  integer $receiveType [接收消息者身份默认为2：用户，1：商家，3：管理员]
	 * @param  [type]  $page        [分页对象默认为空]
	 * @return [type]               [返回数量或分页数据集合]
	 */
	public function getMessagesList($type=0,$receiveType=2,$page=null){
		$where['receiveType'] = $receiveType;
		if($receiveType === 1){
			//根据商家ID查找店铺ID
			$uid = session('uid');
			$shopId = D('Shop')->getShopById($uid);
			$where['receiveId'] = $shopId;
		}
		else{
			$where['receiveId'] = session('uid');
		}
		if(!$type){
			return $this->field('id')->where($where)->count();
		}
		else{
			return $this->where($where)->limit($page->firstRow,$page->listRows)->order('sendTime desc')->select();
		}
	}

	/**
	 * [changeMsgStatus 消息状态改变]
	 * @param  [type]  $msgId [消息ID集合]
	 * @param  integer $type  [默认为0表示单个转态改变，1表示多个改变]
	 * @return [type]         [description]
	 */
	public function changeMsgStatus($msgId,$type=0){
		if(!$type){
			$where = array('id' => $msgId);
		}
		else{
			$where['id'] = array('in',$msgId);
		}
		$data = array('status' => 1);
		return $this->where($where)->save($data);
	}

	/**
	 * [getMsgById 获取单条消息内容]
	 * @param  [type] $msgId [消息ID序列号]
	 * @return [type]      [description]
	 */
	public  function getMsgById($msgId){
		$where = array('id' => $msgId);
		return $this->where($where)->field('id,content,sendTime')->find();
	}

	/**
	 * [delMsg 消息删除包括批量删除和单个删除]
	 * @return [type] $msg[删除结果状态]
	 */
	public function delMsg(){
		$ids = I('post.msgIds');
		$msg['status'] = 0;
		if(count($ids)){
			$where['id'] = array('in',$ids);
			$res = $this->where($where)->delete();
			if($res){
				$msg['status'] = 1;
			}
		}
		return $msg;
	}

	/**
	 * [getAllNoReadMsg 获取未读的消息列表数量]
	 * @param  integer $receiveType [接收消息者身份默认为0：用户，1：商家，3：管理员]
	 * @return [type]               [description]
	 */
	public function getAllNoReadMsg($receiveType=0){
		$where['status'] = 0;
		if($receiveType === 1){
			//根据商家ID查找店铺ID
			$uid = session('uid');
			$shopId = D('Shop')->getShopById($uid);
			$where['receiveId'] = $shopId;
		}
		else{
			$where['receiveId'] = session('uid');
		}
		return $this->where($where)->field('id')->count();
	}
}