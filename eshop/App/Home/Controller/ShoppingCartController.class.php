<?php
/**
*购物车控制器
*/
namespace Home\Controller;
use Think\Controller;
class ShoppingCartController extends BaseController{
	/**
	 * [index 购物车页面展示]
	 */
	public function index(){
		//购物车信息赋值先判断用户是否处于登录状态
		$type = 0 ;
		if(isset($_SESSION['uid']) && $_SESSION['type'] === 0){
            // 登录状态从数据库读取
			$type = 1;
			$where = array('userId' => session('uid'));
			$carts = D('Cart')->getAllCarts($where);
		}
		else{
            // 未登录获取COOKIE值
			$carts = readCart();
		}
		//获取购物车商品的ID序列号
		foreach ($carts as $key => $val) {
			$ids[] = $val['goodid']; 
		}
		$ids = implode(',', $ids);
		if(!empty($ids)){
			$shoperInfo = D('Goodnav')->getInfoByGoodId($ids);
		}
		else{
			$shoperInfo = null;
		}
		$this->assign('info',$shoperInfo);
		$this->assign('type',$type);
		$this->display();
	}

	/**
	 * [settlement 订单结算确认页面]
	 * @return [type] [description]
	 */
	public function settlement(){
		// 判断是否登录
		if(!isset($_SESSION['uid']) || $_SESSION['type'] !=0){
			redirect(U('Home/User/login'));
		}
		$ids = session('cart_temp');
		if(empty($ids)){
			redirect(U('Home/ShoppingCart/index'));
		}
		$uid = session('uid');
		$where = array(
			'userId' => $uid,
			'goodId' => array('in',$ids),
			);
		//获取选中的商品
		$carts = D('Cart')->getAllCarts($where);
		//获取用户地址数量
		$addrNum = D('UserAddress')->getNums($uid);
		//获取用户地址列表
		$addrLists = D('UserAddress')->getAllAddr($uid);
		//获取对应商品的店铺信息和商家信息
		$shoperInfo = D('Goodnav')->getInfoByGoodId($ids);
		//获取总价格
		foreach ($carts as $key => $val) {
				$totalPrice += $val['shopprice']*$val['mount'];
			}
		//模板赋值
		$this->assign('num',$addrNum);
		$this->assign('addrList',$addrLists);
		$this->assign('info',$shoperInfo);
		$this->assign('carts',$carts);
		$this->assign('totalPrice',$totalPrice);
		$this->display();
	}

	/**
	 * [ischecked 购物车商品选中处理，session临时存储]
	 * @return [type] [description]
	 */
	public function ischecked(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$ids = I('post.',0,'intval');
		$ids = implode(',', $ids);
		if(isset($_SESSION['cart_temp']) || !empty($_SESSION['cart_temp'])){
			//每次结算前都清空购物车选中的商品session
			session('cart_temp',null);
		}
		session('cart_temp',$ids);
	} 

	/**
	 * [add 购物车添加商品处理]
	 * @return $msg [状态信息]
	 */
	public function add(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$goodId = I('post.goodId',0,'intval');
		is_num($goodId);
		$num = I('post.num',0,'intval');
		//获取商品基本信息
		$goodInfo = D('Good')->getGoodInfoById($goodId);
		//判断用户是否登录没有登录则存入COOKIE，登录则存入数据库
		if(isset($_SESSION['uid']) && $_SESSION['type'] === 0){
			//商品存入数据库
			$msg = D('Cart')->checkCart($goodId,$num,1);
		}
		//用户没有登录
		else{
			//商品存入COOKIE
			cartAdd($goodId,$num,$goodInfo);
			$msg['status'] = 1;
		}
		$this->ajaxReturn($msg);
	} 

	/**
	 * [del 购物车商品删除处理]
	 * @return $msg [状态信息]
	 */
	public function del(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$type = I('post.type',0,'intval');
		$goodId = I('post.goodId',0,'intval');
		is_num($goodId);
		//用户登录状态删除购物车数据
		if($type){
			$msg = D('Cart')->delCartItem($goodId,1);
		}
		// 未登录状态删除，COOKIE删除
		else{
			$res = delete($goodId);
			if($res){
				$msg['status'] = 1;
			}
			else{
				$msg['status'] = 0;
			}
		}
		$this->ajaxReturn($msg);
	}  

	/**
	 * [changeNum 购物车单个商品数量变化处理]
	 * @return $msg [状态信息]
	 */
	public function changeNum(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$goodId = I('post.goodId',0,'intval');
		$num = I('post.num',1,'intval');
		$msg['status'] = 1;
		//用户登录状态改变数量
		if(I('post.type',0,'intval')){
			$msg = D('Cart')->checkCart($goodId,$num,0);
		}
		else{
			//未登录状态改变COOKIE数量
			changeCartItemNum($goodId,$num);
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [addressDefault 设置默认地址跨控制器调用]
	 * @return [type] [description]
	 */
	public function addressDefault(){
		A('UserCenter')->addressDefault();
	}

	/**
	 * [addressDel 收货地址删除，跨控制器调用]
	 * @return [type] [description]
	 */
	public function addressDel(){
		A('UserCenter')->addressDel();
	}

	/**
	 * [success 提交订单操作]
	 * @return [type] [description]
	 */
	public function success(){
		A('UserOrders')->orderSubmit();
	}

	/**
	 * [complete 订单提交成功后支付页面]
	 * @return [type] [description]
	 */
	public function payment(){
		if(!isset($_SESSION['temp_orderNumber'])||empty($_SESSION['temp_orderNumber']) || (time()-$_SESSION['temp_ordertime'] > 300 )){
			redirect(U('Home/ShoppingCart/index'));
		}
		$orderNumber = session('temp_orderNumber');
		$orderPrice = session('temp_orderPrice');
		//模板赋值
		$this->assign('totalPrice',$orderPrice);
		$this->assign('orderNumber',$orderNumber);
		$this->display();
	}

	/**
	 * [purchase 立即购买]
	 * @return [type] [description]
	 */
	public function purchase(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		if(!isset($_SESSION['uid']) || $_SESSION['type'] != 0){
			$msg['status'] = 0;
			$msg['content'] = '请先以用户的身份登录商城！';
			$msg['type'] = 0;
		}
		else{
			$goodId = I('post.goodId',0,'intval');
			is_num($goodId);
			//获取商品基本信息
			$goodInfo = D('Good')->getGoodInfoById($goodId);
			//商品存入数据库
			$msg = D('Cart')->checkCart($goodId,1,1);
			//添加成功后session保存该商品ID并跳转到结算页面
			session('cart_temp',null);
			session('cart_temp',strval($goodId));
		}
		$this->ajaxReturn($msg);
	}
}
