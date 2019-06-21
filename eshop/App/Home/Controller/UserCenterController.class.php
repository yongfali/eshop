<?php
/**
*用户中心控制器包括操作记录、密码修改、个人信息编辑、地址管理
*/	
namespace Home\Controller;
use Think\Controller;
class UserCenterController extends CommonController{
	/**
	 * [index 展示用户操作记录]
	 * @return [type] [description]
	 */
	public function index(){
		$userlog = M('user_log');
		$where = array('is_show' => 1,'userId' => session('uid'));
		$count = $userlog ->where($where)->count();
		$pagelimit = 10;//每页显示数据记录数
		$page = getpage($count,$pagelimit);	
		$list = $userlog->where($where)->order('time desc')->limit($page->firstRow, $page->listRows)->select();
		if(IS_AJAX){
			$this->assign('loglist', $list);
        	$this->assign('page', $page->show());
        	$html = $this->fetch('UserCenter/logAjaxPage');
        	$this->ajaxReturn($html);
		}
		$this->assign('loglist', $list); // 赋值数据集
        $this->assign('page', $page->show()); // 赋值分页输出
        $this->display();	
	}

	/**
	 * [delLog 删除用户操作记录]
	 * @return [type] [description]
	 */
	public function delLog(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$userlog = M('user_log');
		$where = array('id' => I('post.logid'));
		$result = $userlog->where($where)->delete();
		if($result){
			$msg['status']  = 1;
			$msg['content'] = '删除成功！';
		}
		else{
			$msg['status']  = 0;
			$msg['content'] = '删除失败！';
		}
		$this->ajaxReturn($msg,'json');
	}

	/**
	 * [userinfo 用户个人信息展示]
	 * @return [type] [description]
	 */
	public function userinfo(){
		$useinfo = D('User');
		$where = array('id' => session('uid'));	
		$list = D('User')->field('id,nick,truename,photo,sex,birthday,carnum,qq,tel')->where($where)->find();
		$this->assign('list',$list);
		$this->display();
	} 

	/**
	 * [userinfoEdit 用户个人资料修改/添加]
	 * @return [type] [description]
	 */
	public function userinfoEdit(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('User')->modifyInfo();
		$this->ajaxReturn($msg);
	} 

	/**
	 * [checkuNickname 异步检查昵称是否已有]
	 * @return [boolean] [description]
	 */
	public function checkuNickname(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$unickname = I('post.unick');
		$where['id'] = array('NEQ',session('uid'));
        $where['nick'] = array('EQ',$unickname);
		$uid = M('user')->where($where)->getField('id');
		if($uid){
			echo 'false';
		}
		else{
			echo 'true';
		}
	} 

	/**
	 * [modifyPwd 用户修改密码页面展示]
	 * @return [boolean] [description]
	 */
	public function modifyPwd(){
		$this->display();
	}

	/**
	 * [doModifyPwd 用户修改密码操作]
	 * @return [type] [description]
	 */
	public function doModifyPwd(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$pwd = I('post.unewpwd','','md5');
		$pwd1 = I('post.unewpwd1','','md5');
		if($pwd !=$pwd1 ||empty($pwd)||empty($pwd1)){
			$msg['status'] = 0;
		}
		$data = array('password'=>$pwd,'modify_time' => time());
		$where = array('id' =>session('uid'));
		$id = M('user')->where($where)->data($data)->save();
		if($id){
			// 如果修改密码成功则把修改记录插入到userlog表中
			$action = '修改密码';
			D('UserLog')->addLog($action);
        	//然后清空session和保存的cookie跳转到登录页面
			cookie('auto',null);
			session('uid',null);
			session('uname',null);
        	$msg['status'] = 1;
		}
		else{
			$msg['status'] = 0;
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [address 用户收货地址显示]
	 * @return [type] [description]
	 */
	public function address(){
		$count = D('UserAddress')->getNums(session('uid'));
		$lists = D('UserAddress')->getAllAddr(session('uid'));
		$this->assign('list',$lists);
		$this->assign('num',$count);
		$this->display();
	} 

	/**
	 * [addressAdd 新增用户收货地址]
	 * @return [type] [description]
	 */
	public function addressAdd(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$username = I('post.username');
		$location = I('post.province1').'|'.I('post.city1').'|'.I('post.district1');
		$street = I('post.street');
		$postcode = I('post.postcode');
		$tel = I('post.usertel');
		$first = I('post.address');
		$uaddress = M('user_address');
		$uid = session('uid');
		$num = D('UserAddress')->getNums($uid);
		if(empty($username)||empty($street)||empty($tel)){
			$msg['status'] = 0;
			$msg['content'] = "地址信息填写不完全或不正确！";
			$this->ajaxReturn($msg);
		}
		//如果该用户的地址已经存在或者地址总数大于5则不进行添加并提示用户
		$num = D('UserAddress')->getNums($uid);
		if($num>5){
			$msg['status'] = 0;
			$msg['content'] = "添加地址数量超过限定值！";
			$this->ajaxReturn($msg);
		}
		if($first){
			//如果设置为默认地址了则把该用户之前添加默认地址修改为非默认状态
			$data = array(
				'is_first' => 0,
				'modifytime' => time()
				);
			$where = array(
				'userId' => $uid,
				'is_first' => 1,
				);
			$uaddress->where($where)->save($data);
		}
		$data = array(
			'userId' => $uid,
			'userName' => $username,
			'location' => $location,
			'streetInfo' => $street,
			'postCode' => $postcode,
			'tel' => $tel,
			'is_first' => $first,
			'createtime' => time(),
			'modifytime' => time(),
			);
		if($uaddress ->create($data)){
			$result = $uaddress ->add();
			if($result){
				$msg['status'] = 1;
				$msg['content'] = "添加成功！";
			}
			else{
				$msg['status'] = 0;
				$msg['content'] = "添加失败！";
			}
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [editAddrShow 显示用户收货地址编辑页面]
	 * @return [type] [description]
	 */
	public function editAddrShow(){
		$id = I('get.id','','intval');
		is_num($id);
		$list = D('UserAddress')->getAddrById($id);
		$arr = formatAddr($list['location'],1);
		$this->assign('array',$arr);
		$this->assign('data',$list);
		$this->display('addressmodify');
	} 

	/**
	 * [doEditAddrShow 用户收货地址编辑处理]
	 * @return [type] [description]
	 */
	public function doEditAddrShow(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$username = I('post.username');
		$location = I('post.province1').'|'.I('post.city1').'|'.I('post.district1');
		$street = I('post.street');
		$postcode = I('post.postcode');
		$tel = I('post.usertel');
		$first = I('post.address','','intval');
		$uaddress = M('user_address');
		$id = I('post.id','','intval');
		$uid = session('uid');
		if(empty($username)||empty($street)||empty($tel)){
			$msg['status'] = 0;
			$msg['content'] = "地址信息填写不完全或不正确！";
			$this->ajaxReturn($msg);
		}
		if($first){
			//如果设置为默认地址了则把该用户之前添加默认地址修改为非默认状态
			$data = array(
				'is_first' => 0,
				'modifytime' => time()
				);
			$where = array(
				'userId' => $uid,
				'is_first' => 1,
				);
			$uaddress->where($where)->save($data);
		}
		$data = array(
			'userId' => $uid,
			'userName' => $username,
			'location' => $location,
			'streetInfo' => $street,
			'postCode' => $postcode,
			'tel' => $tel,
			'is_first' => $first,
			'modifytime' => time()
			);
		if($uaddress ->create($data)){
			$where = array('id' => $id);
			$result = $uaddress ->where($where)->save();
			if($result){
				$msg['status'] = 1;
				$msg['content'] = "修改成功！";
			}
			else{
				$msg['status'] = 0;
				$msg['content'] = "修改失败！";
			}
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [addressDefault 默认收货地址设置]
	 * @return [type] [description]
	 */
	public function addressDefault(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$id = I('post.id','','intval');
		$result = D('UserAddress')->setDefaultAddr(session('uid'),$id);
		if($result){
			$msg['status'] = 1;
		}
		else{
			$msg['status'] = 0;
		}
		$this->ajaxReturn($msg);
	} 

	/**
	 * [addressDel 删除用户收货地址]
	 * @return [type] [description]
	 */
	public function addressDel(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$id = I('post.id');
		$result = D('UserAddress')->delAddr($id);
		if(!$result){
			$msg['status'] = 0;
		}
		else{
			$msg['status'] = 1;
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [security 用户安全页面显示]
	 * @return [type] [description]
	 */
	public function security(){
		$where = array('id' => session('uid'),'is_forbid'=>0);
		$field = array('id,photo,email,tel,bind_email,bind_tel');
		$info = D('User')->getUserInfo($where,$field);
		//获取最近一次登录信息
		$recentLog = D('UserLog')->getRecentLog();
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