<?php
/**
 * 后台登录控制器
 */
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    /**
     * [index 后台登录页面]
     * @return [type] [description]
     */
    public function index(){
    	$this->display();
    }

    /**
     * [doLogin 管理员登录验证]
     * @return [type] [description]
     */
    public function doLogin(){
    	if(!IS_AJAX){
    		E('页面不存在！');
    	}
    	$msg = D('Admin')->checkLogin();
		$this->ajaxReturn($msg);
    }

    /**
    * [verify 获取验证码]
    * @return [type] [description]
    */
    Public function verify() {
        create_verify(1);
    }

    /**
    * [checkVerify 异步验证验证码是否正确]
    * @return [boolean] [description]
    */
    public function checkVerify(){
        if(!IS_AJAX){
            E('页面不存在');
        }
        $code = I('post.verify');
        if(check_verify($code,1)){
            echo 'true';
        }else{
            echo 'false';
        }
    }
}