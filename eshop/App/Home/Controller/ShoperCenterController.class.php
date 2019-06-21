<?php
/**
*商家中心控制器
*/
namespace Home\Controller;
use Think\Controller;
class ShoperCenterController extends ShoperCommonController{

	/**
	 * [info 商家信息展示]
	 * @return [type] [description]
	 */
	public function info(){
		$where = array('id' => session('uid'),'is_forbid'=>0,'is_examine' =>1);
		$field = array('id,trueName,sex,carNum,face,qq,tel');
		$info = D('Shoper')->shoperInfo($where,$field);
		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * [messages 商家中心消息列表显示]
	 * @return [type] [description]
	 */
	public function messages(){
		$count = D('Messages')->getMessagesList(0,1);
		$page = getpage($count,12);
		$msgList = D('Messages')->getMessagesList(1,1,$page);
		if(IS_AJAX){
			$this->assign('list',$msgList);
			$this->assign('utype',session('type'));
			$this->assign('page', $page->show());
			$html = $this->fetch('Message/ajaxPage');
			$this->ajaxReturn($html); 
		}
		//模板赋值
		$this->assign('list',$msgList);
		$this->assign('utype',session('type'));
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
		$uid = session('uid');
		$shopId = D('Shop')->getShopById($uid);
		$where['receiveId'] = $shopId;
		$data = array('status' => 1);
		$msg['status'] = 0;
		$id = D('Messages')->where($where)->save($data);
		if($id){
			$msg['status'] = 1;
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [log 操作记录展示]
	 * @return [type] [description]
	 */
	public function log(){
		$shoperLog = D('ShoperLog');
		$where = array('shoperId' => session('uid'),'is_show' => 1);
		$count = $shoperLog->getLogNum();
		$page = getpage($count,12);
		$list = $shoperLog->where($where)->order('time desc')->limit($page->firstRow, $page->listRows)->select();
		if(IS_AJAX){
			$this->assign('loglist', $list);
        	$this->assign('page', $page->show());
        	$html = $this->fetch('ShoperCenter/logAjaxPage');
        	$this->ajaxReturn($html);
		}
		$this->assign('loglist', $list); // 赋值数据集
        $this->assign('page', $page->show()); // 赋值分页输出
        $this->display();	
	}

	/**
	 * [delLog 操作记录删除]
	 * @return [type] [description]
	 */
	public function delLog(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$id = I('post.logid','','intval');
		$shoperLog = D('ShoperLog');
		$msg = $shoperLog -> logDel($id);
		$this -> ajaxReturn($msg);
	}

	/**
	 * [modifyPwd 密码修改页面显示]
	 * @return [type] [description]
	 */
	public function modifyPwd(){
		$this->display();
	}

	/**
	 * [doModifyPwd 密码修改操作执行]
	 * @return [type] [description]
	 */
	public function doModifyPwd(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$msg = D('Shoper')->modifyPwds(); 
		$this->ajaxReturn($msg);
	}

	/**
	 * [checkPwd 检查原密码是否正确]
	 * @return [type] [description]
	 */
	public function checkPwd(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$pwd = I('post.soldpwd','','md5');
		D('Shoper')->checkPwds($pwd);
	}

	/**
	 * [security 商家账号安全设置]
	 * @return [type] [description]
	 */
	public function security(){
		$where = array('id' => session('uid'),'is_forbid'=>0,'is_examine' =>1);
		$field = array('id,face,email,tel,bind_email,bind_tel');
		$info = D('Shoper')->shoperInfo($where,$field);
		//获取最近一次登录信息
		$recentLog = D('ShoperLog')->getRecentLog();
		$this->assign('recentLog', $recentLog);
		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * [emailSetting 邮箱绑定/解绑发送邮件操作]
	 * @return [type] [description]
	 */
	public function emailSetting(){
		if(!IS_AJAX){
			E("页面不存在！");
		}
		$dic = array('bind','unbind');
		$email = I('post.email');
		$type = I('post.type');
		$msg = 0;
		$time = date('Y-m-d H:i:s', time());
		if(in_array($type, $dic) && I('post.utype',0,'intval') === session(type)){
			$subject = "邮箱绑定（解绑）操作！";
			$token = time().'|'.session('type').'|'.$type.'|'.session('uid');
			$token = encryption($token);
			$url = 'http://localhost'.U('Home/security/emailSettingDo', array('token' => $token));
			//组装邮件发送的内容
			$content = "<html><body>亲爱的 ".$email."：<br/>您在".$time."提交了邮箱绑定（解绑）的请求。请点击下面的链接完成邮箱绑定（解绑）
			（链接30分钟内有效，若点击无效，则复制链接到浏览器上即可！）。<br/><a href='$url' target='_blank'> $url </a></body></html>";
			if(sendMail($email,$subject,$content)){
				$msg = 1;
			}
		}
		$this->ajaxReturn($msg);
	}
}