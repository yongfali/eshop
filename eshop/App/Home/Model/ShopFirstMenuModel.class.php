<?php
/**
*店铺一级菜单模型
*/
namespace Home\Model;
use Think\Model;
class ShopFirstMenuModel extends Model{
	protected $trueTableName = 'eshop_shop_firstmenu'; 
	/**
	*一级菜单列表获取根据传入的店铺号ID
	*/
	public function getAllCart($shoperId){
		$where = array('shopId' => $shoperId,'is_show'=>1);
		return $this->field('id,name')->where($where)->select();
	}
}