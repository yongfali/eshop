<?php
/**
*店铺控制器实现登录注册
*/
namespace Home\Controller;
use Think\Controller;
class ShoperController extends BaseController{

    /**
     * [index 商家登录页面展示]
     * @return [type] [description]
     */
	public function index(){
		$this->display();	
	}

    /**
     * [doLogin 商家登录表单处理]
     * @return [type] [description]
     */
	public  function  doLogin(){
        if(!IS_AJAX){
            E('页面不存在！');
        }
        $name = I('post.shopername');
        $pwd = I('post.shoper_pwd','','md5');
        $ip = get_client_ip();
        $where = array('name' => $name);
        $shoper = M('Shoper')->where($where)->find();
        if (empty($shoper) || $shoper['password'] != $pwd) {
            $msg['status'] =0;
            $msg['content'] = '商户名或者密码不正确！';
        }
        else if(!$shoper['is_examine']){
            $msg['status'] =0;
            $msg['content'] = '账号还未审核！';
        }
        else if($shoper['is_forbid']){
            $msg['status'] =0;
            $msg['content'] = '账号禁止登录请联系eshop客服人员！';
        }
        else{
            //自动登录处理
            if(I('post.auto')){
                // $utype为1表示为商家登录为0表示普通用户登录
                $utype = 1;
                $value = $name.'|'.$ip.'|'.$utype;
                $value = encryption($value);
                cookie('auto',$value,C('COOKIE_EXPIRE_TIME'),'/');
            }
            //登录成功写入SESSION并且跳转到首页并且把此次登录记录插入商户log表
            session('uid', $shoper['id']);
            session('type',1);//1表示商家登录
            session('uname',$shoper['name']);
            $action = '登录';
            D('ShoperLog')->addLog($action);
            $msg['status'] =1;
            $msg['content'] = '登录成功！';
        }
        $this->ajaxReturn($msg);
    }

    /**
     * [regist 商家注册页面展示]
     * @return [type] [description]
     */
	public function regist(){
		$this->display();
	}

    /**
     * [doRegist 商家注册表单页面处理]
     * @return [type] [description]
     */
	public function doRegist(){
		if(!IS_AJAX){
			E('页面不存在');
		}
       $shoper = D('Shoper');
       $shop = D('Shop');
       if(!$shoper->create()){
        $msg['status'] = 0;
        $msg['content'] = $shoper->getError();
       }
       else if(!$shop->create()){
        $msg['status'] = 0;
        $msg['content'] = $shop->getError();
       }
       else{
        $id = $shoper->add();
        $shop->shoperId = $id;
        $shop->add();
        $msg['status'] = 1;
        $msg['content'] = '注册成功！等待管理员审核';
       }
       $this->ajaxReturn($msg);
	}

    /**
     * [verify 获取验证码]
     * @return [type] [description]
     */
	Public function verify () {
	 	create_verify(2);
	 }

   /**
    * [checkShoperName 异步验证账号是否被注册]
    * @return [type] [description]
    */
    public function checkShoperName(){
     	if(!IS_AJAX){
     		E('页面不存在');
     	}
     	$sname = I('post.s_account');
     	$where = array('name' => $sname);
        // 如果检索到用户ID则表明该用户名已经注册
     	if(M('shoper')->where($where)->getField('id')){
     		echo 'false';
     	}else{
     		echo 'true';
     	}
     }

   /**
    * [checkShoperEmail 异步验证邮箱是否已被注册]
    * @return [type] [description]
    */
    public function checkShoperEmail(){
    	if(!IS_AJAX){
    		E('页面不存在');
    	}
    	$semail = I('post.s_email','','email');
    	$where = array('email' => $semail);
    	if(M('shoper')->where($where)->getField('email')){
    		echo 'false';
    	}else{
    		echo 'true';
    	}
    }

   /**
    * [checkShopName 异步检测店铺名是否被注册]
    * @return [type] [description]
    */
    public function checkShopName(){
        if(!IS_AJAX){
            E('页面不存在');
        }
        $where = array('name' => I('post.shopname'));
        if(M('shop')->where($where)->getField('id')){
            echo 'false';
        }
        else{
            echo 'true';
        }
    }

   /**
    * [checkVerify 异步验证验证码是否正确]
    * @return [type] [description]
    */
    public function checkVerify(){
    	if(!IS_AJAX){
    		E('页面不存在');
    	}
    	$code = I('post.verify');
    	if(check_verify($code,2)){
    		echo 'true';
    	}else{
    		echo 'false';
    	}
    }

   /**
    * [loginout 商户退出操作]
    * @return [type] [description]
    */
    public function loginout(){
        //清空所有session和cookie若先清空session则会导致cookie无法清除
    	cookie('auto',null);
        session(null);
    	redirect(U('Index/index'));
    }
}
