<?php
/**
 * eshop商城用户登录、注册、退出相关逻辑操作控制器
 */
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController{

    /**
     * [login 用户登录页面]
     * @return [type] [description]
     */
    public  function  login(){
     $this->display();
    }

   /**
    * [doLogin 用户登录表单处理]
    * @return [type] [description]
    */
    public  function  doLogin(){
        if(!IS_AJAX){
            E('页面不存在！');
        }
        $uname = I('post.account');
        $upwd = I('post.pwd','','md5');
        $ip = get_client_ip();
        $where = array('name' => $uname);
        $user = D('User')->where($where)->find();
        if (empty($user) || $user['password'] != $upwd) {
            $msg['status'] =0;
            $msg['content'] = '用户名或者密码不正确！';
        }
        else if($user['is_forbid']){
            $msg['status'] =0;
            $msg['content'] = '账号禁止登录请联系管理员解封！';
        }
        else{
        //自动登录处理
            if(I('post.auto')){
                $utype = 0;
                $value = $uname.'|'.$ip.'|'.$utype;
                $value = encryption($value);
                cookie('auto',$value,C('COOKIE_EXPIRE_TIME'),'/');
            }
            //登录成功写入SESSION并且跳转到首页并且把此次登录记录插入用户log表
            session('uid', $user['id']);
            session('type',0);//0表示用户登录
            session('uname',$user['name']);
            $action = '登录';
            D('UserLog')->addLog($action);
            //购物车COOKIE数据迁移
            cartsMove();
            $msg['status'] =1;
            $msg['content'] = '登录成功！';
        } 
        $this->ajaxReturn($msg);
    }

   /**
    * [regist 用户注册页面]
    * @return [type] [description]
    */
    public function regist(){
        $this->display();
    }

   /**
    * [doRegist 用户注册表单处理]
    * @return [type] [description]
    */
    public function doRegist(){
        if(!IS_AJAX){
            E('页面不存在！');
        }
        $user = D('User');
        if(!$user->create()){
           $msg['status'] = 0;
           $msg['content'] = $user->getError();
        }
        else{
            $user->add();
            $msg['status'] = 1;
            $msg['content'] = '注册成功！';
        }
        $this->ajaxReturn($msg);
    }

   /**
    * [verify 获取验证码]
    * @return [type] [description]
    */
    Public function verify () {
        create_verify(1);
    }

   /**
    * [checkUserName 异步验证账号是否被注册]
    * @return [boolean] [description]
    */
    public function checkUserName(){
        // 首先判断是否为异步提交，若不是提示出错
        if(!IS_AJAX){
            E('页面不存在');
        }
        $uname = I('post.account');
        $where = array('name' => $uname);
        // 如果检索到用户ID则表明该用户名已经注册
        if(M('user')->where($where)->getField('id')){
            echo 'false';
        }else{
            echo 'true';
        }
    }

   /**
    * [checkuserEmail 异步验证邮箱是否已被注册]
    * @return [boolean] [description]
    */
    public function checkuserEmail(){
        if(!IS_AJAX){
            E('页面不存在');
        }
        $uemail = I('post.uemail');
        $where = array('email' => $uemail);
        if(M('user')->where($where)->getField('email')){
            echo 'false';
        }else{
            echo 'true';
        }
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

   /**
    * [loginout 用户退出操作]
    * @return [type] [description]
    */
    public function loginout(){
        //清空所有session和cookie
        cookie('auto',null);
        session(null);
        redirect(U('Index/index'));
    }
}