<?php
/**
 * 商品搜索控制器
 */
namespace Home\Controller;
use Think\Controller;
class SearchController extends BaseController
{
	/**
	 * [index 全站商品搜索]
	 * @return [type] [description]
	 */
	public function index(){
		header("Content-Type:text/html;charset=utf8");
		$goodName = I('get.goodname');
        $type = I('get.type',0,'intval');
		if(!checkGoodName($goodName)){
			E('页面不存在！');
		}
		$where['status'] = 1;
        $where['g.is_exam'] = 1;
        $where['is_legal'] = 1;
        $where['g.is_forbid'] = 0;
        $where['stock'] = array('gt',1);
        $where['g.name'] = array('like',"%".$goodName."%");
        if($type){
            $shopId = I('get.shopId',0,'intval');
            is_num($shopId);
            $where['n.shopId'] = $shopId;
        }
        $count = D('Goodnav')->alias('n')
        ->join('eshop_good as g on n.goodId = g.id')
        ->where($where)
        ->count();
        $page = getpage($count,15);
        $goodList = D('Goodnav')->alias('n')
        ->join('eshop_good as g on n.goodId = g.id')
        ->join('eshop_shop as s on s.id = n.shopId')
        ->where($where)
        ->field(
            array(
                'n.goodId,n.shopId,n.w_fid,
                g.name,g.shopPrice,g.place,g.good_log,g.count,
                s.name shopName'
                )
            )
        ->order(array('modify_recenet'=>'desc'))
        ->limit($page->firstRow, $page->listRows)
        ->select();
        $this->assign('page', $page->show()); 
        $this->assign('searchContent',$goodName);
        $this->assign('pageType','search');
        //店铺内搜索
        if($type){
            $where1 = array('shopId' => $shopId,'is_hot' =>1);
            // 店铺首页公共头部信息赋值根据传入的店铺ID
            $shopInfo = D('Shop')->getShopInfos($shopId);
            //店铺所有产品分类菜单
            $shopMenu = getShopCart($shopId);
            //店铺商品，服务，物流评分获取
            $goodScore = D('Goodcomment')->shopScoreAverage($shopId);
            $logisticsSocre = D('Goodcomment')->shopScoreAverage($shopId,2);
            $serviceScore = D('Goodcomment')->shopScoreAverage($shopId,3);
            //获取店铺内热销产品
            $hotGoods = D('Goodnav')->getHostGoods($where1,4);
            $this->assign('goodScore',$goodScore);
            $this->assign('logisticsSocre',$logisticsSocre);
            $this->assign('serviceScore',$serviceScore);
            $this->assign('shopInfo',$shopInfo);
            $this->assign('shopNav',$shopMenu);
            $this->assign('goods',$goodList);
            $this->assign('hotGoods',$hotGoods);
            $this->display('Shop/moreList');
        }
        else{
            //浏览记录获取
            $history = D('Good')->getGoodsHistory();
            $this->assign('goodList',$goodList);
            $this->assign('history',$history);
            $this->display('Index/moreGoods');
        }
	}
}