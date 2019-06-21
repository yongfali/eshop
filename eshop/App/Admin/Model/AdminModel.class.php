<?php
/**
 * 管理员模型
 */
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
	/**
	 * [checkLogin 管理员登录检查]
	 * @return [type] [description]
	 */
	public function checkLogin(){
		$msg['status'] = 0;
		$name = I('post.account');
		$pwd = I('post.pwd','','md5');
		$admin = $this->where(array('name' => $name))->find();
		if (!$admin || $admin['password'] != $pwd) {
			$msg['content'] = '账号或密码错误！';
		}
		else{
			$data = array(
				'loginTime' => time(),
				'ip' => get_client_ip()
				);
			//更新登录时间和IP
			$this->where(array('id' => $admin['id']))
			->save($data);
			//session保存管理员登录信息
			session('adminId',$admin['id']);
			session('adminName',$admin['name']);
			session('lastLoginTime',$admin['logintime']);
			session('lastLoginIp',$admin['ip']);
			$msg['status'] = 1;
			$msg['content'] = '登录成功！';
		}
		return $msg;
	}
}