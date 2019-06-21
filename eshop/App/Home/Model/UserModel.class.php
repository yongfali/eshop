<?php
/**
* 用户模型执行用户相关操作
*/
namespace Home\Model;
use Think\Model;
class UserModel extends Model
{
	//表单字段映射
	protected $_map = array(
		'account' => 'name',
		'pwd' => 'password',
		'uemail' => 'email',
		);
	//自动验证
	protected $_validate = array(
		//以下三条分别验证注册账号是否为空，是否已被注册，是否格式不正确
		array('name','','该用户名已被注册',0,'unique',1),
		array('name','require','用户名不能为空'),
		array('name','checkName','长度为4-20的字符串且不能以数字开头',0,'function',3),
		//验证密码是否为空，是否符合要求以及确认密码是否正确
		array('password','require','密码不能为空'),
		array('password','/^[a-zA-Z][a-zA-Z0-9\w]{5,36}$/','密码以字母开头且长度为6-36的字符串'),
		array('pwded','password','确认密码不正确',0,'confirm'),
		//验证邮箱
		array('email','require','邮箱不能为空'),
		array('email','email','邮箱格式不正确'), 
		array('email','','该邮箱已被注册',0,'unique',1),
		//验证用户昵称
		array('nick','checkName','长度为4-20的字符串且不能以数字开头',2,'function',3),
		//验证真实姓名
		array('trueName','checkTrueName','真实姓名不合法',2,'function',3),
		//验证身份证号
		array('carNum','checkCarNum','身份证号格式不正确',2,'function',3),
		//验证qq号
		array('qq','checkQQ','qq号格式不正确',2,'function',3),
		//验证联系方式
		array('tel','checkTel','联系方式格式不正确',2,'function',3),
		);
	//自动完成操作
	protected $_auto = array(
		array('password','md5',3,'function'),
		array('regist_time','time',1,'function'),
		);

	/**
	 * [getFaceURL 根据用户ID获取用户头像路径]
	 * @return [type] [description]
	 */
	public function getFaceURL(){
		$where = array('id' => session('uid'));
		return $this->where($where)->getField('photo');
	}

	/**
	 * [getUserInfo 获取用户基本信息]
	 * @param  [type] $where [查询条件]
	 * @param  array  $field [查询字段]
	 * @return [type]        [description]
	 */
	public function getUserInfo($where,$field=array('*')){
		return $this->field($field)->where($where)->find();
	}

	/**
	 * [modifyInfo 用户资料修改保存]
	 * @return [type] [description]
	 */
	public function modifyInfo(){
		$nick = I('post.nick');
		$name = I('post.truename');
		$sex = I('post.usex');
		$birth = I('post.ubirtd');
		$carnum = I('post.carnum');
		$qq = I('post.qq');
		$tel = I('post.tel');
		$msg['status'] = 0;
		if(!empty($nick) && !checkName($nick)){
			$msg['content'] = '长度为4-20的字符串且不能以数字开头';
		}
		if(!empty($name) && !checkTrueName($nick)){
			$msg['content'] = '真实姓名不合法';
		}
		if(!empty($carnum) && !checkCarNum($carnum)){
			$msg['content'] = '身份证号格式不正确';
		}
		if(!empty($qq) && !checkQQ($qq)){
			$msg['content'] = 'qq号格式不正确';
		}
		if(!empty($tel) && !checkTel($tel)){
			$msg['content'] = '联系方式格式不正确';
		}
		$data = array(
			'nick' => $nick,
			'trueName' => $name,
			'sex' => $sex,
			'birthday' => $birth,
			'carNum' => $carnum,
			'qq' => $qq,
			'tel' => $tel,
			'modify_time' => time(),
			);
		$where = array('id' => session('uid'));
		//当有头像上传时
		if($_FILES['photo']['error'] == 0){
			$photo = uploadImg(C('UPLOAD_FACE'),$_FILES['photo']);
			//获取原来头像的路径
			$face = $this->getFaceURL();
			$data['photo'] = $photo;
		}
		$res = $this->data($data)->where($where)->save();
		if($res){
			$msg['status'] = 1;
			$msg['content'] = '修改成功！';
			//删除原图片
			if(isset($face) && !empty($face)){
				@unlink($face);
			}
		}
		//当更新失败时若有头像上传则删除上传的
		else{
			$msg['content'] = '修改失败！';
			if(isset($photo) && !empty($photo)){
				@unlink($photo);
				//扫描删除空目录
				$path = C('UPLOAD_FACE')['rootPath'];
				delEmptyDir($path);
			}
		}
		return $msg;
	}

	/**
	 * [userCount 后台注册会员数量统计]
	 * @param  integer $type [统计的类型默认为0：查找所有数量，1：统计今日注册用户数量]
	 * @return [type]        [description]
	 */
	public function userCount($type=0){
		if(!$type){
			$num = $this->count();
		}
		else{
			//今天strtotime生成unix时间戳
			$today = strtotime(date("Y-m-d"));
			$where = array(
				'regist_time' => $today,
				);
			$num = $this->where($where)->count();
		}
		return $num;
	}
}
