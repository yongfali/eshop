<?php
/**
 * 订单模型
 */
namespace Admin\Model;
use Think\Model;
class OrderModel extends Model{
	/**
	 * [orderCount 后台订单数量统计]
	 * @param  integer $type 
	 * [统计的类型默认为
	 * 0：查找所有订单数量，
	 * 1：统计今日下单数量，
	 * 2：投诉订单数量
	 * 3：今日投诉订单数量
	 * ]
	 * @return [type]        [description]
	 */
	public function orderCount($type=0){
		//今天strtotime生成unix时间戳
		$today = strtotime(date("Y-m-d"));
		switch ($type) {
			case 1:
				$where['create_time'] = $today;
				break;
			case 2:
				$where['is_complaint'] = 1;
				break;
			case 3:
				$where['create_time'] = $today;
				$where['is_complaint'] = 1;
				break;
			default:
				break;
		}
		$num = $this->where($where)->count();
		return $num;
	}
}