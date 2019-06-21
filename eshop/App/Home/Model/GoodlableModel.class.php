<?php
/**
*商品详情标签模型
*/
namespace Home\Model;
use Think\Model;
class GoodlableModel extends Model{
	/**
	 * [getGoodLableById 获取标签包括管理员和商家添加的]
	 * [前期只是全部读出商家并不可以自己添加]
	 * @return [type] [description]
	 */
	public function getGoodLableById(){
		return $this->field('lableid,name')->select();
	}
}