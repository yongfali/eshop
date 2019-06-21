<?php
/**
*全网二级菜单模型
*/
namespace Home\Model;
use Think\Model;
class SecondMenuModel extends Model{
	protected $trueTableName = 'eshop_secondmenu';
	/**
	*根据PIP获取对应的二级菜单
	*/
	public function getCartById($pid){
		$where = array('pid' => I('post.id'),'is_show' => 1);
		$list = $this->where($where)->field('id,name')->select();
		return $list;
	}
}
