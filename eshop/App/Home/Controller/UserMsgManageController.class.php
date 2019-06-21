<?php
/**
 * 客户管理控制器包含投诉管理和消息管理
 */
namespace Home\Controller;
use Think\Controller;
class UserMsgManageController extends CommonController{
	/**
	 * [messages 用户中心消息列表显示]
	 * @return [type] [description]
	 */
	public function messages(){
		$count = D('Messages')->getMessagesList(0,2);
		$page = getpage($count,10);
		$msgList = D('Messages')->getMessagesList(1,2,$page);
		if(IS_AJAX){
			$this->assign('list',$msgList);
			$this->assign('page', $page->show());
			$html = $this->fetch('Message/ajaxPage');
			$this->ajaxReturn($html); 
		}
		//模板赋值
		$this->assign('list',$msgList);
		$this->assign('page', $page->show()); 
		$this->display('Message/index');
	}

	/**
	 * [messageDetail 消息详细内容展示]
	 * @return [type] [description]
	 */
	public function messageDetail(){
		$dic = array('old','new');
		$status = I('get.status');
		if(!in_array($status, $dic)){
			E('页面不存在！');
		}
		$msgId = I('get.msgId');
		is_num($msgId);
		$msgInfo = D('Messages')->getMsgById($msgId);
		//同时把该消息设置为已读状态(若该消息未读)
		if($status == 'new'){
			D('Messages')->changeMsgStatus($msgId);
		}
		$this->assign('msgInfo',$msgInfo);
		$this->display('Message/msgDetail');
	}

	/**
	 * [messageDel 消息删除包括批量删除和单个删除]
	 * @return [type] [description]
	 */
	public function messageDel(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Messages')->delMsg();
		$this->ajaxReturn($msg);
	}

	/**
	 * [allMessageRead 所有消息全部设为已读，后期还需完善之传入未读消息的ID]
	 * @return [type] [description]
	 */
	public function allMessageRead(){
		$where['receiveId'] = session('uid');
		$data = array('status' => 1);
		$msg['status'] = 0;
		$id = D('Messages')->where($where)->save($data);
		if($id){
			$msg['status'] = 1;
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [orderComplainManage 投诉管理页面显示]
	 * @return [type] [description]
	 */
	public function orderComplainManage(){
		$count = D('OrderComplaint')->getComplainOrderList();
		$page = getpage($count,8);
		$lists = D('OrderComplaint')->getComplainOrderList(0,1,$page);
		if(IS_AJAX){
			$this->assign('lists', $lists);
			$this->assign('page', $page->show());
			$this->assign('pageType',$listType);
			$html = $this->fetch('UserOrders/complainManageAjaxPage');
			$this->ajaxReturn($html);
		}
		// 模板赋值
		$this->assign('lists', $lists);
		$this->assign('page', $page->show());
		$this->display('UserOrders/complainManage');
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
		$this->display('UserOrders/complaintDetail');
	}
	/**
	 * [Withdrawal 撤诉操作]
	 */
	public function Withdrawal(){
		$msg = D('OrderComplaint')->Withdrawal();
		$this->ajaxReturn($msg);
	}
}