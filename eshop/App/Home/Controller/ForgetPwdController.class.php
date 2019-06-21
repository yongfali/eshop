<?php
/**
 * eshop商城忘记密码相关逻辑操作控制器
 */
namespace Home\Controller;
use Think\Controller;
class ForgetPwdController extends BaseController{
	/**
	 * [index 忘记密码首页-填写账户名]
	 * @return [type] [description]
	 */
	public function index(){
		$dic = array('user','shoper');
		$type = I('get.type');
		if(!in_array($type, $dic)){
			E('页面不存在！');
		}
		$this->assign('type',$type);
		$this->display('forgetPass');
	}

	/**
	 * [foregtPwd 忘记密码-验证身份]
	 * @return [type] [description]
	 */
	public function foregtPwd(){
		$tempSession = session('forgetPassword');
		if(time() - $tempSession['time'] > 300){
			session('forgetPassword',null);
			$this->error('页面已过期！');
		}
		$this->assign('info',$tempSession);
		$this->display('forgetPass2');
	}

    /**
     * [sendCodeByEmail 点击获取邮箱发送验证码]
     * @return [type] [description]
     */
    public function sendCodeByEmail(){
        $email = session('forgetPassword.email');
        if(empty($email)){
            $this->error('页面已过期！');
        }
        $code = get_random(3);
        $msg = 0;
        $temp = array(
            'verifyCode' => $code,
            'time' => time(),
            );
        session('emailVerifyCode',null);
        session('emailVerifyCode',$temp);
        // 发送邮件
        $subject = "密码找回-邮箱找回操作！";
        $content = "验证码为：".$code."（3分钟内有效！）";
        if(sendMail($email,$subject,$content)){
            $msg = 1;
        }
        $this->ajaxReturn($msg);
    }

    /**
     * [checkEmailVerifyCode 异步验证接收的验证码]
     * @return [type] [description]
     */
    public function checkEmailVerifyCode(){
        if(!IS_AJAX){
            E('页面不存在');
        }
        $code = I('post.emailVerifyCode');
        $scode = session('emailVerifyCode.verifyCode');
        $reg = '/^[0-9]{6}$/';
        if(!preg_match($reg, $code) || $code != $scode){
            echo 'false';
        }
        else{
            echo 'true';
        }
    }

    /**
     * [resetPwd 忘记密码-重置密码]
     * @return [type] [description]
     */
    public function resetPwd(){
        $tempSession = session('forgetPassword');
        if(time() - $tempSession['time'] > 300){
            session('forgetPassword',null);
            $this->error('页面已过期！');
        }
        $this->assign('info',$tempSession);
        $this->display('forgetPass3');
    }

    /**
     * [resetPwdDo 密码重置]
     * @return [type] [description]
     */
    public function resetPwdDo(){
        if(!IS_AJAX){
            E('页面不存在');
        }
        $newPwd = I('post.newPwd');
        $rePwd = I('post.repwd');
        $utype = I('post.utype');
        $msg['status'] = 0;
        $msg['content'] = '操作失败！';
        if(!checkPwd($newPwd)){
            $msg['content'] = '新密码格式不正确！';
        }
        else if($newPwd != $rePwd){
            $msg['content'] = '两次密码不一致！';
        }
        else{
            $data = array('password'=> md5($newPwd),'modify_time' => time());
            $where = array('id' => session('forgetPassword.id'));
            switch ($utype) {
                case 'user':
                    $id = D('User')->where($where)->data($data)->save();
                    if($id){
                        $action = '密码找回';
                        D('UserLog')->addLog($action,0,session('forgetPassword.id'));
                        //然后清空登录session和保存的cookie跳转到登录页面
                        cookie('auto',null);
                        session('uid',null);
                        session('uname',null);
                        $msg['status'] = 1;
                        $msg['content'] = '操作成功！';
                    }
                break;
                case 'shoper':
                    $id = D('Shoper')->where($where)->data($data)->save();
                    if($id){
                        $action = '密码找回';
                        D('ShoperLog')->addLog($action,0,session('forgetPassword.id'));
                        //然后清空登录session和保存的cookie跳转到登录页面
                        cookie('auto',null);
                        session('uid',null);
                        session('uname',null);
                        $msg['status'] = 1;
                        $msg['content'] = '操作成功！';
                    }
                break;
                default:
                    $msg['content'] = '非法操作！';
                    break;
            }
        }
        $this->ajaxReturn($msg);
    }

    /**
     * [finish 忘记密码-完成修改]
     * @return [type] [description]
     */
    public function finish(){
        $this->assign('utype',session('forgetPassword.utype'));
        $this->display('forgetPass4');
    }

	/**
    * [verify 获取验证码]
    * @return [type] [description]
    */
    Public function verify(){
    	$id = I('get.id',0,'intval');
    	is_num($id);
        create_verify($id);
    }

    /**
    * [checkVerify 异步验证验证码是否正确]
    * @return [boolean] [description]
    */
    public function checkVerify(){
        if(!IS_AJAX){
            E('页面不存在');
        }
        $code = I('post.verifyCode');
        $type = I('post.type',0,'intval');
        is_num($type);
        if(check_verify($code,$type)){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    /**
     * [checkAccount 异步账号合法性验证]
     * @return [type] [description]
     */
    public function checkAccount(){
    	$dic = array('shoper','user');
    	$type = I('post.utype');
    	if(!in_array($type, $dic)){
    		E('页面不存在！');
    	}
    	$account = I('post.account');
    	$where = array(
    		'name' => $account,
    		'_logic' => 'OR',
    		'email' => $account,
    		'_logic' => 'OR',
    		'tel' => $account,
    		);
    	switch ($type) {
    		case 'shoper':
    			$id = D('Shoper')->where($where)->field('id')->find();
    			break;
    		
    		default:
    			$id = D('User')->where($where)->field('id')->find();
    			break;
    	}
    	if($id){
    		 echo 'true';
    	}
    	else{
    		echo 'false';
    	}
    }

    /**
     * [findPwd 密码找回操作]
     * @return [type] [description]
     */
    public function findPwd(){
    	//禁止缓存
    	header('Cache-Control:no-cache,must-revalidate');
    	header('Pragma:no-cache');
    	$step = I('post.step',0,'intval');
    	// var_dump(I('post.'));die;
    	$msg['status'] = 0;
    	switch ($step) {
    		//第一步身份信息验证
    		case 1:
    			//后端验证账号是否存在
    			$res = $this->__checkAccount(I('post.account'),I('post.utype'));
    			if(!$res){
    				$msg['content'] = '账号不存在！';
    			}
    			else{
    				//session临时存储账号基本信息
    				$temp = array(
    					'id' => $res['id'],
    					'name' => $res['name'],
    					'email' => $res['email'],
    					'tel' => $res['tel'],
    					'bind_email' => $res['bind_email'],
    					'bind_tel' => $res['bind_tel'],
    					'utype' => I('post.utype'),
    					'time' => time(),
    					);
    				//先清空session临时值
    				session('forgetPassword',null);
    				session('forgetPassword',$temp);
    				$msg['status'] = 1;
    				$msg['content'] = '操作成功！';
    			}
    			break;
            //第二步验证身份并发送验证码
            case 2:
                //判断验证码是否正确或过期
                $emailCode = session('emailVerifyCode');
                $code = I('post.emailVerifyCode');
                if((time()-$emailCode['time'] > 180) || $code != $emailCode['verifyCode']){
                    $msg['content'] = '验证码错误或过期！';
                }
                else{
                    $msg['status'] = 1;
                    $msg['content'] = '操作成功！';
                }
                break;
    		default:
    			$this->error('页面已过期！');
    			break;
    	}
    	$this->ajaxReturn($msg);
    }

    /**
     * [__checkAccount 私有方法检测账号是否存在]
     * @param  [type] $account [账号名]
     * @param  [type] $type    [账号类型，只有商家和用户两种身份]
     * @return [type]          [description]
     */
    private function __checkAccount($account,$type){
    	$dic = array('shoper','user');
    	if(!in_array($type, $dic)){
    		E('页面不存在！');
    	}
    	$where = array(
    		'name' => $account,
    		'_logic' => 'OR',
    		'email' => $account,
    		'_logic' => 'OR',
    		'tel' => $account,
    		);
    	switch ($type) {
    		case 'shoper':
    			$res = D('Shoper')->where($where)->field(array('id','name','email','tel','bind_email','bind_tel'))->find();
    			break;
    		default:
    			$res = D('User')->where($where)->field(array('id','name','email','tel','bind_email','bind_tel'))->find();
    			break;
    	}
    	return $res;
    }
}
