<?php
/**
*购物车模型
*/
namespace Home\Model;
use Think\Model;
class CartModel extends Model{
	/**
	 * [checkCart 判断商品是否已在购物车中]
	 * @param  [type]  $goodId [商品ID]
	 * @param  integer $num    [商品的数量]
	 * @param  integer $type   [点击类型默认为1表示直接点击商品加1,0表示点击购物车加减号]
	 * @return $msg
	 */
	public function checkCart($goodId,$num=1,$type=1){
		//获取商品库存
		$goodIfo = D('Good')->getGoodInfoById($goodId);
		$stock = $goodIfo['stock'];
		$where = array('goodId' => $goodId, 'userId' => session('uid'));
		$res = $this->where($where)->find();
		$msg['status'] = 0;
		$msg['content'] = "添加失败！";
		//若存在则商品数量加$num
		if($res){
			$res['mount'] += $num;
			if(!$type){
				$res['mount'] = $num;
			}
			//小于库存直接更新
			if($res['mount'] <= $stock){
				$res['time'] = time();
				$id = $this->where($where)->save($res);
				//更新成功
				if($id){
					$msg['status'] = 1;
				}
			}
			//若大于库存则不执行更行操作提示大于库存
			else{
				$msg['content'] = "商品库存不足!";
			}
		}
		//不存在则新插入一条数据
		else{
			//判断是否大于库存
			if($num <= $stock){
				$data = array(
					'goodId' => $goodId,
					'userId' => session('uid'),
					'mount' => $num,
					'time' => time(),
				);
				$id = $this->data($data)->add();
				//添加成功
				if($id){
					$msg['status'] = 1;
				}
			}
			else{
				$msg['content'] = "商品库存不足!";
			} 
		}
		return $msg;
	}

	/**
	 * [delCartItem 删除对应用户收藏的商品]
	 * @param  [type] $goodId [商品ID]
	 * @param  [type] $type [删除类型1表示单个删除，0表示批量删除]
	 * @return $msg
	 */
	public function delCartItem($goodId,$type=1){
		$where = array('goodId' => $goodId, 'userId' => session('uid'));
		if(!$type){
			$where = array('goodId' => array('in',$goodId), 'userId' => session('uid'));
		}
		$res = $this->where($where)->delete();
		$msg['status'] = 0;
		if($res){
			$msg['status'] = 1;
		}
		return $msg;
	}

	/**
	 * [getAllCarts 获取登录状态下的用户的购物车信息]
	 * @param  [type] $where [购物车数据查询条件]
	 * @return $res [对应用户的购物车数据]
	 */
	public function getAllCarts($where){
		return $this->alias('c')
		->join('eshop_good as g on c.goodId = g.id')
		->field('goodId,goodNumber,mount,name,shopPrice,good_log')
		->where($where)->order('c.time desc')->select();
	}

	/**
	 * [delCartItem 删除对应用户收藏的商品]
	 * @param  [type] $goodId [商品ID]
	 * @return $msg
	 */
	public function delCarts($goodId){
		$where = array('goodId' => $goodId, 'userId' => session('uid'));
		return $this->where($where)->delete();
	}

}