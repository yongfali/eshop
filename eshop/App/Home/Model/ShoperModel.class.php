<?php
/**
*商户模型
*/
namespace Home\Model;
use Think\Model;
class ShoperModel extends Model{
	//字段映射
	protected $_map = array(
		's_account' => 'name',// 把表单中s_account映射到数据表的name字段
		's_pwd' => 'password',
		's_email' => 'email',
		'mobile' => 'tel',
		);
	//商户注册表单数据自动验证
	protected $_validate= array(
		//以下三条分别验证注册账号是否为空，是否已被注册，是否格式不正确
		array('name','','该商户名已被注册',0,'unique',1),
		array('name','require','商户名不能为空'),
		array('name','checkName','长度为4-20的字符串且不能以数字开头',0,'function',3),
		//验证密码是否为空，是否符合要求以及确认密码是否正确
		array('password','require','密码不能为空'),
		array('password','/^[a-zA-Z][a-zA-Z0-9\w]{5,36}$/','密码以字母开头且长度为6-36的字符串'),
		array('s_pwded','password','确认密码不正确',0,'confirm'),
		//验证邮箱
		array('email','require','邮箱不能为空'),
		array('email','email','邮箱格式不正确'), 
		array('email','','该邮箱已被注册',0,'unique',1),
		// 验证真实姓名
		array('trueName','require','真实姓名不能为空'),
		array('trueName','/^([\x00-\xff5a-zA-Z\.]{2,25})$/','姓名格式不正确',2,'regex'),
		// 验证省份证号码
		array('carNum','require','身份证不能为空'),
		array('carNum','/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/','身份证格式不正确',2,'regex'),
		// 验证QQ号码
		array('qq','/^\d{5,15}$/','qq格式不正确',2,'regex'),
		array('tel','/^((0\d{2,3}-\d{7,8})|(1[3584]\d{9}))$/','电话格式不正确',2,'regex'),
		);
	//商户注册自动完成操作
	protected $_auto = array(
		array('password','md5',3,'function'),
		array('create_time','time',1,'function'),
		);
	/**
	*商家基本信息获取
	*/
	public function shoperInfo($where,$field){
		return $this->field($field)->where($where)->find();
	}
	/**
	*获取商户注册时间
	*/
	public function getRegTime($sid){
		$where = array('id' => $sid);
		return M('shoper')->where($where)->field('create_time')->select();
	}
	/**
	*根据用户ID检测原密码是否正确
	*/
	public function checkPwds($pwd){
		$where = array('id' => session('uid'),'password' => $pwd);
		$res = $this -> where($where)->find();
		if ($res) {
			echo 'true';
		} else {
			echo 'false';
		}
	}
	/**
	*商家密码修改
	*/
	public function modifyPwds(){
		$oldPwd = I('post.soldpwd','','md5');
		if (I('post.snewpwd') != I('post.snewpwd1')) {
			$msg['status'] = 0;
			$msg['content'] = '新密码两次输入不一致';
		} 
		//执行密码更新操作
		else {
				$newPwd = I('post.snewpwd','','md5');
				$data['password'] = $newPwd;
				$where = array('id' => session('uid'));
				$res = $this->data($data)->where($where)->save();
				if(!$res){
					$msg['status'] = 0;
					$msg['content'] = '更新失败！';
				}
				else{
					// 如果修改密码成功则把修改记录插入到userlog表中
					$action = '修改密码';
					D('ShoperLog')->addLog($action);
					//然后清空session和保存的cookie跳转到登录页面
					cookie('auto',null);
					session('uid',null);
					session('uname',null);
					$msg['status'] = 1;
					$msg['content'] = '更新成功！';
				}
		}
		return $msg;
	}

	/**
	 * [shopCount 后台注册会员数量统计]
	 * @param  integer $type [统计的类型默认为0：查找所有数量，1：统计今日注册商家数量，2：申请商家]
	 * @return [type]        [description]
	 */
	public function shopCount($type=0){
		switch ($type) {
			case 1:
				//今天strtotime生成unix时间戳
				$today = strtotime(date("Y-m-d"));
				$where = array(
					'create_time' => $today,
					);
				$num = $this->where($where)->count();
				break;
			case 2:
					$where = array('is_examine' => 0);
					$num = $this->where($where)->count();
					break;
			default:
				$num = $this->count();
				break;
		}
		return $num;
	}
}