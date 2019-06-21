<?php
/**
*eshop网站三方登录功能实现
*/
namespace Home\Controller;
use Think\Controller;
use Org\ThinkSDK;
class LoginController extends Controller{
	/**
	*实现qq登录
	*/
	public function login($type = null){
		empty($type) && $this->error('参数错误');
	 	//加载ThinkOauth类并实例化一个对象
		$qq =  \Org\ThinkSDK\ThinkOauth::getInstance($type);
		//跳转到授权页面
		redirect($qq->getRequestCodeURL());
	}
}