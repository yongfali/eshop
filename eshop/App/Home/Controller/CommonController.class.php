<?php
/**
*用户公共控制器
*/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{

	/**
	 * [_initialize 用户控制器公共自动运行的方法]
	 * @return [type] [description]
	 */
	public function _initialize(){
		//处理自动登录不能调用session()
		if(isset($_COOKIE['auto'])&&!isset($_SESSION['uid'])){
			$info = explode('|', encryption(cookie('auto'),1));
			$ip = get_client_ip();
			//本次登录IP与上一次登录IP一致时
			if($ip == $info[1]){
				// 当前登录身份是用户0
				if(!$info[2]){
					$uname = $info[0];
					$where = array('name'=>$uname);
					$user = D('User')->where($where)->field(array('id','name','is_forbid'))->find();
					//检索出用户信息并且该用户没有被封号时，保存登录状态
					if($user&&!$user['is_forbid']){
						session('uid', $user['id']);
						session('uname',$user['name']);
						session('type', 0);
					}
				}
			}
		}
		if (!isset($_SESSION['uid'])||session('type')) {
			redirect(U('User/login'));
		}
		//购物车信息赋值先判断用户是否处于登录状态
		$totalPrice = 0;
		$type = 0 ;
		if(isset($_SESSION['uid']) && $_SESSION['type'] === 0){
            // 登录状态从数据库读取
			$type = 1;
			$carts = D('Cart')->getAllCarts();
			//获取购物车商品总金额
			foreach ($carts as $key => $val) {
				$totalPrice += $val['shopprice']*$val['mount']; 
			}
		}
		else{
            // 未登录获取COOKIE值
			$carts = readCart();
			$totalPrice = getCartTotalPrice();
		}
		//模板赋值
		$this->assign('type',$type);
		$this->assign('totalPrice',$totalPrice);
		$this->assign('cart',$carts);
		//我的订单导航条订单数量显示
		$waitDeliverNum = D('Order')->orderLists(2,'waitDelivery');
		$this->assign('waitDeliveryNum',$waitDeliverNum);
		$waitReceiveNum = D('Order')->orderLists(2,'delivered');
		$this->assign('waitReceiveNum',$waitReceiveNum);
		$finishedNum = D('Order')->orderLists(2,'finished');
		$this->assign('finishedNum',$finishedNum);
		//获取未读消息数量
		$noReadMsg = D('Messages')->getAllNoReadMsg(session('type'));
		$this->assign('noReadMsgNum',$noReadMsg);
		//获取底部导航标签
		$footerMenu = D('FooterNav')->navTree();
		$this->assign('footerMenu',$footerMenu);
	}
}
