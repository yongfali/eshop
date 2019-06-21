<?php
/**
*商品评论模型
*/
namespace Home\Model;
use Think\Model;
class GoodcommentModel extends Model{
	//自动完成
	protected  $_auto = array(
		array('time','time',1,'function'),
		array('replyTime','time',2,'function'),
		);
	/**
	 * [getGoodComments 商品评论查询]
	 * @param  [type] $goodId [商品ID]
	 * @return [type]         [description]
	 */
	public function getGoodComments($goodId){
		$where = array('goodId' => $goodId);
		$res = $this->alias('c')->field('contents,time,name,photo')->join('eshop_user as u on c.userId = u.id')->where($where)->select();
		return $res;
	}

	/**
	 * [orderAppraisedList 已评论订单列表获取]
	 * @param  integer $utype      [获取者身份默认为0：用户，1商家，2管理员]
	 * @param  integer $searchType [搜索类型默认为0：数量获取，1分页数据集获取]
	 * @param  [type]  $page       [分页类默认为空]
	 * @return [type]              [description]
	 */
	public function orderAppraisedList($utype=0,$searchType=0,$page=null){
		if($utype === 1){
			$uid = session('uid');
			$shopId = D('Shop')->getShopById($uid);
			$where['shopId'] = $shopId;
		}
		else{
			$where['userId'] = session('uid');
		}
		$where['is_recommend'] = 1;
		if(!$searchType){
			return D('Order')->where($where)->count();
		}
		else{
			return $this->alias('c')
			->join('eshop_order_goods as g on c.orderId = g.orderId')
			->join('eshop_order as o on c.orderId = o.id')
			->where(array('o.userId' => session('uid')))
			->order('c.time desc')
			->limit($page->firstRow, $page->listRows)
			->select();
		}
	}

	/**
	 * [shopScoreAverage 统计店铺商品，服务和物流三者的平均分]
	 * @param  [type] $shopId [description]
	 * @param  [type] $type   [统计平均分的字段默认为商品评分]
	 * @return [type]         [description]
	 */
	public function shopScoreAverage($shopId,$type=1){
		$where = array('shopId' =>$shopId);
		if($type === 1){
			return $this->where($where)->avg('goodScore');
		}
		if($type === 2){
			return $this->where($where)->avg('logisticsScore');
		}
		if($type === 3){
			return $this->where($where)->avg('serviceScore');
		}	
	}

	/**
	 * [orderAppraiseDo 订单评论操作]
	 * @return [type] [description]
	 */
	public function orderAppraiseDo(){
		$_POST['userId'] = session('uid');
		$orderId = I('post.orderId',0,'intval');
 		$msg['status'] = 0;
 		$this->startTrans();
		if($this->create()){
			$id = $this->add();
			if($id){
				//评价成功则更改订单状态为已评价
				$where = array('id' => $orderId);
				$data = array('is_recommend' => 1);
				D('Order')->startTrans();
				$res = D('Order')->where($where)->save($data);
				if($res){
					$this->commit();
					D('Order')->commit();
					$msg['status'] = 1;
				}
				else{
					$this->rollback();
					D('Order')->rollback();
				}
			}
			else{
				$this->roolback();
			}
		}
		return $msg;
	}

}