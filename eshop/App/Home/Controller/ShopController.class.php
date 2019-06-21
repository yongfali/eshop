<?php
/**
*店铺控制器
*/
namespace Home\Controller;
use Think\Controller;
class ShopController extends BaseController{

	/**
	 * [_initialize 公共部分赋值]
	 * @return [type] [description]
	 */
	public function _initialize(){
		parent::_initialize();
		is_num(I('get.shopId'));
		$shopId = I('get.shopId','','intval');
		// 店铺首页公共头部信息赋值根据传入的店铺ID
		$shopInfo = D('Shop')->getShopInfos($shopId);
		//店铺所有产品分类菜单
		$shopMenu = getShopCart($shopId);
		//店铺商品，服务，物流评分获取
		$goodScore = D('Goodcomment')->shopScoreAverage($shopId);
		$logisticsSocre = D('Goodcomment')->shopScoreAverage($shopId,2);
		$serviceScore = D('Goodcomment')->shopScoreAverage($shopId,3);
		$this->assign('goodScore',$goodScore);
		$this->assign('logisticsSocre',$logisticsSocre);
		$this->assign('serviceScore',$serviceScore);
		//模板赋值
		$this->assign('shopInfo',$shopInfo);
		$this->assign('shopNav',$shopMenu);
	}

	/**
	 * [index 店铺首页展示(后期还需完善)]
	 * @return [type] [description]
	 */
	public function index(){
		is_num(I('get.shopId'));
		$shopId = I('get.shopId','','intval');
		$where = array(
			'status' => 1,
			'shopId' => $shopId,
			'is_exam' => 1,
			'is_legal' =>1,
			'is_forbid' => 0,
			'stock' => array('gt',1),
			);
		//店铺首页滚动广告获取
		$ads = D('ShopScollimg')->getAllById($shopId);
		//店铺所有商品列表获取
		$goodList = D('Goodnav')->getShopGoods($where);
		//浏览记录获取
		$history = D('Good')->getGoodsHistory();
		//模板赋值
		$this->assign('ads',$ads);
		$this->assign('goods',$goodList);
		$this->assign('history',$history);
		$this->display();
	}

	/**
	 * [moreList 店铺商品列表详情]
	 * @return [type] [description]
	 */
	public function moreList(){
		is_num(I('get.shopId'));
		$shopId = I('get.shopId','','intval');
		is_num(I('get.scat'));
		$scatId = I('get.scat','','intval');
		$where = array('shopId' => $shopId,'s_fid' => $scatId);
		if(isset($_GET['scat2'])){
			is_num(I('get.scat2'));
			$scatId2 = I('get.scat2','','intval');
			$where = array('shopId' => $shopId,'s_fid' => $scatId,'s_sid' => $scatId2);
			$this->assign('scat2',$scatId2);
		}
		$where['status'] = 1;
		$where['g.is_exam'] = 1;
		$where['is_legal'] = 1;
		$where['g.is_forbid'] = 0;
		$this->assign('scat1',$scatId);
		//对应店铺商品分类一级菜单序列号
		$where1 = array('shopId' => $shopId,'is_hot' =>1);
		//店铺对应一级/一二级菜单下所有商品列表获取
		$goodList = D('Goodnav')->getShopGoods($where);
		$count = count($goodList);
		//分页显示商品
		$page = getpage($count,8);
		$goodList = D('Goodnav')->alias('n')->join('eshop_good as g on n.goodId = g.id')->where($where)->order('modify_recenet desc')->limit($page->firstRow, $page->listRows)->select();
		//获取店铺内热销产品
		$hotGoods = D('Goodnav')->getHostGoods($where1,4);
		if (IS_AJAX) {
			$this->assign('goods',$goodList);
			$this->assign('page', $page->show());
			$html = $this->fetch('Shop/ajaxPage');
			$this->ajaxReturn($html);
		}
		//模板赋值
		$this->assign('goods',$goodList);
		$this->assign('hotGoods',$hotGoods);
		$this->assign('page', $page->show()); 
		$this->display();
	}

	/**
	 * [goodsOrder 按单价或销量排序商品列表]
	 * @return [type] [description]
	 */
	public function goodsOrder(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$type = I('post.type',0,'intval');
		$status = I('post.status'); 
		$where['shopId'] = I('post.shopId',0,'intval');
		$ptype = I('post.ptype');
		//搜索页面下的排序
		if($ptype == 'search'){
			$goodName = I('post.name');
			$where['g.name'] = array('like',"%".$goodName."%");
		}
		//更多详情列表下的排序
		else{
			$where['s_fid'] = I('post.cat1',0,'intval');
			$this->assign('scat1',I('post.cat1',0,'intval'));
			if(I('post.cat2',0,'intval')){
				$where['s_sid'] = I('post.cat2',0,'intval');
				$this->assign('scat2',I('post.cat2',0,'intval'));
			}
		}
		$where['status'] = 1;
		$where['g.is_exam'] = 1;
		$where['is_legal'] = 1;
		$where['g.is_forbid'] = 0;
		switch ($type) {
			case 2:
				$order = array('shopPrice' => $status);
				break;
			case 3:
				$order = array('count' => $status);
				break;
			default:
				$order = array('modify_recenet' => 'desc');
				break;
		}
		$goodList = D('Goodnav')->getShopGoods($where,$order);
		$count = count($goodList);
		//分页显示还有bug，因此调大页面数量避免该Bug后期修复
		$page = getpage($count,12);
		$goodList = D('Goodnav')->alias('n')->join('eshop_good as g on n.goodId = g.id')->where($where)->order($order)->limit($page->firstRow, $page->listRows)->select();
		//模板赋值
		$this->assign('goods',$goodList);
		$this->assign('page', $page->show());
		$html = $this->fetch('Shop/ajaxPage');
		$this->ajaxReturn($html);
	}
}