<?php
/**
*商户公共控制器
*/
namespace Home\Controller;
use Think\Controller;
class ShoperCommonController extends Controller{

	/**
	 * [_initialize 自动运行的方法]
	 * @return [type] [description]
	 */
	public function _initialize(){
		//处理自动登录不能调用session()
		if(isset($_COOKIE['auto'])&&!isset($_SESSION['uid'])){
			$info = explode('|', encryption(cookie('auto'),1));
			$ip = get_client_ip();
			//本次登录IP与上一次登录IP一致时
			if($ip == $info[1]){
				// 当前登录身份是商户1
				if($info[2]){
					$sname = $info[0];
					$where = array('name'=>$sname);
					$shoper = M('Shoper')->where($where)->field(array('id','name','is_examine','is_forbid'))->find();
					//检索出商户信息并且该商户没有被封号时，保存登录状态
					if($shoper&&$shoper['is_examine']&&!$shoper['is_forbid']){
						session('uid', $shoper['id']);
						session('uname',$shoper['name']);
						session('type',1);
					}
				}
			}
		}
		if (!isset($_SESSION['uid'])||!session('type')) {
			redirect(U('Shoper/index'));
		}
		// 商家中心公共头部信息赋值
		//根据商家ID查找店铺ID
		$shopId = D('Shop')->getShopById(session('uid'));
		$shopInfo = D('Shop')->getShopInfos($shopId);
		$this->assign('shopInfo',$shopInfo);
		//店铺所有产品分类菜单
		$shopMenu = getShopCart($shopId);
		$this->assign('shopNav',$shopMenu);
		//店铺左侧导航条交易管理中心订单数量显示
		$waitPayNum = D('Order')->orderLists(1,'waitDelivery');
		$this->assign('waitDeliveryNum',$waitPayNum);
		//获取未读消息数量
		$noReadMsg = D('Messages')->getAllNoReadMsg(1);
		$this->assign('noReadMsgNum',$noReadMsg);
		//店铺商品，服务，物流评分获取
		$goodScore = D('Goodcomment')->shopScoreAverage($shopId);
		$logisticsSocre = D('Goodcomment')->shopScoreAverage($shopId,2);
		$serviceScore = D('Goodcomment')->shopScoreAverage($shopId,3);
		$this->assign('goodScore',$goodScore);
		$this->assign('logisticsSocre',$logisticsSocre);
		$this->assign('serviceScore',$serviceScore);
		//获取底部导航标签
		$footerMenu = D('FooterNav')->navTree();
		$this->assign('footerMenu',$footerMenu);
	}
}
