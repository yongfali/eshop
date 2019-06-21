<?php
/**
*安全设置控制器
*/
namespace Home\Controller;
use Think\Controller;
class SecurityController extends Controller{
	/**
	 * [emailSettingDo 邮箱绑定或解绑操作]
	 * @return [type] [description]
	 */
	public function emailSettingDo(){
		header("Content-Type:text/html;charset=utf-8");
		$dic = array('bind','unbind');
		$token = I('get.token');
		$item = explode('|', encryption(I('get.token'),1));
		$now = time();
		if($now - $item[0] > 1800 || !in_array($item[2], $dic)){
			echo "<script>alert('链接已失效！');window.location.href='http://localhost/eshop/index.php/Home/Index/index.html';</script>";
			die;
		}
		$where = array('id' => $item[3]);
		//邮箱绑定操作
		if($item[2] == 'bind'){
			$data = array('bind_email' => 1);
			//商家进行邮箱绑定
			if($item[1] == 1){
				$id = D('Shoper')->where($where)->save($data);
			}
			else{
				$id = D('User')->where($where)->save($data);
			}
			if(!$id){
				echo "<script>alert('绑定失败！！');window.location.href='http://localhost/eshop/index.php/Home/Index/index.html';</script>";
			}
			else{
				$action = '邮箱绑定';
				if($item[1] == 1){
					D('ShoperLog')->addLog($action,0,$item[3]);
				}
				else{
					D('UserLog')->addLog($action,0,$item[3]);
				}
				echo "<script>alert('绑定成功！！');window.location.href='http://localhost/eshop/index.php/Home/Index/index.html';</script>";
			}
		}
		//邮箱解绑操作
		if($item[2] == 'unbind'){
			$data = array('bind_email' => 0);
			//商家进行邮箱解绑
			if($item[1] == 1){
				$id = D('Shoper')->where($where)->save($data);
			}
			else{
				$id = D('User')->where($where)->save($data);
			}
			if(!$id){
				echo "<script>alert('解绑失败！！');window.location.href='http://localhost/eshop/index.php/Home/Index/index.html';</script>";
			}
			else{
				//插入日志
				$action = '邮箱解绑';
				if($item[1] == 1){
					D('ShoperLog')->addLog($action,0,$item[3]);
				}
				else{
					D('UserLog')->addLog($action,0,$item[3]);
				}
				echo "<script>alert('解绑成功！！');window.location.href='http://localhost/eshop/index.php/Home/Index/index.html';</script>";
			}
		}
	}
}