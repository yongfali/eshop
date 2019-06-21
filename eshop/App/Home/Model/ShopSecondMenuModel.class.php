<?php
/**
*店铺二级菜单模型
*/
namespace Home\Model;
use Think\Model;
class ShopSecondMenuModel extends Model{
	/**
	*二级菜单列表获取根据传入的店铺号ID
	*/
	protected $trueTableName = 'eshop_shop_secondmenu'; 
	public function getAllCart($pid){
		$where = array('pid' => $pid,'is_show'=>1);
		return $this->field('id,sname')->where($where)->select();
	}
}