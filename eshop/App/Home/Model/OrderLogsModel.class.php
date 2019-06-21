<?php
/**
 * 订单操作日志模型
 */
namespace Home\Model;
use Think\Model;
class OrderLogsModel extends Model{
	/**
	 * [orderLogAdd 订单操作日志记录]
	 * @param  [type]  $orderId [订单ID序列号]
	 * @param  integer $status  [订单状态默认为1表示下单成功,2：发货3：收货4：评价-1取消-2退款售后]
	 * @param  [type]  $Type   [操作订单者的身份类型0：用户 1：商家2：管理员]
	 * @return [type]           [description]
	 */
	public function orderLogAdd($orderId,$status=1,$type=0){
		switch ($status) {
			case 2:
				$data['logContent'] = '商家已发货';
				break;
			case 3:
				$data['logContent'] = '用户已收货';
				break;
			case 4:
				$data['logContent'] = '订单评价完成';
				break;
			case -1:
				$data['logContent'] = '用户取消订单';
				break;
			case -2:
				$data['logContent'] = '用户拒收订单';
				break;
			case -3:
				$data['logContent'] = '订单正在退款或售后';
				break;
			default:
				$data['logContent'] = '下单成功';
				break;
		}
		$data['orderId'] = $orderId;
		$data['orderStatus'] = $status;
		$data['logUserId'] = session('uid');
		$data['logType'] = $type;
		$data['time'] = time();
		return $this->add($data);
	}
}