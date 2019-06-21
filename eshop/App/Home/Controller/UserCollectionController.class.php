<?php
/**
*我的收藏控制器
*/
namespace Home\Controller;
use Think\Controller;
class UserCollectionController extends CommonController{

	/**
	 * [goods 收藏的商品页面展示]
	 * @return [type] [description]
	 */
	public function goods(){
		$count = D('Collection')->collectionLists(0);
		//分页显示收藏商品
		$page = getpage($count,8);
		$where = array('type' => 0,'userId' => session('uid'));
		$goodList = D('Collection')->alias('c')
		->join('eshop_good as g on c.targetId = g.id')
		->join('eshop_goodnav as n on g.id = n.goodId')
		->join('eshop_shop as s on n.shopId = s.id')
		->field('g.id goodId,g.name goodName,shopprice,place,good_log,count,s.id shopId,s.name shopName')
		->where($where)
		->limit($page->firstRow, $page->listRows)
		->select();
		// 模板赋值
		if (IS_AJAX) {
			$this->assign('lists',$goodList);
			$this->assign('page', $page->show());
			$html = $this->fetch('UserCollection/goodsAjaxPage');
			$this->ajaxReturn($html);
		}
		$this->assign('lists',$goodList);
		$this->assign('page', $page->show()); 
		$this->display();
	}

	/**
	 * [shops 收藏的店铺页面展示]
	 * @return [type] [description]
	 */
	public function shops(){
		$count = D('Collection')->collectionLists(1);
		//分页显示收藏店铺
		$page = getpage($count,12);
		$where = array('type' => 1,'userId' => session('uid'));
		$shopList = D('Collection')->alias('c')
		->join('eshop_shop as s on c.targetId = s.id')
		->field('s.id,s.name,s.logo')
		->where($where)
		->limit($page->firstRow, $page->listRows)
		->select();
		//模板赋值
		if (IS_AJAX) {
			$this->assign('lists',$shopList);
			$this->assign('page', $page->show()); 
			$html = $this->fetch('UserCollection/shopAjaxPage');
			$this->ajaxReturn($html);
		}
		$this->assign('lists',$shopList);
		$this->assign('page', $page->show()); 
		$this->display();
	}
}