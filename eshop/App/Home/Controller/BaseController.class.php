<?php
/**
*Home模块下基控制器主要用于一些数据的初始化
*/
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller{
   /**
    * [_initialize 公共部分赋值]
    * @return [type] [description]
    */
	public function _initialize(){
        //购物车信息赋值先判断用户是否处于登录状态
        $totalPrice = 0;
        $type = 0 ;
		if(isset($_SESSION['uid']) && $_SESSION['type'] === 0){
            // 登录状态从数据库读取
            $type = 1;
            $where = array('userId' => session('uid'));
			$carts = D('Cart')->getAllCarts($where);
			//获取购物车商品总金额
			foreach ($carts as $key => $val) {
				$totalPrice += $val['shopprice']*$val['mount'];
				$ids[] = $val['goodid']; 
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
		//获取用户未读消息数量
        $noReadMsg = D('Messages')->getAllNoReadMsg(session('type'));
        $this->assign('noReadMsgNum',$noReadMsg);
        //获取底部导航标签
		$footerMenu = D('FooterNav')->navTree();
		$this->assign('footerMenu',$footerMenu);
	}
}