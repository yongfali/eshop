<?php
/**
*店铺/商品收藏模型
*/
namespace Home\Model;
use Think\Model;
class CollectionModel extends Model{
	//字段映射
	protected $_map = array(
		'id' => 'targetId',
		);

	/**
	 * [collectionDo 店铺/商品收藏]
	 * @return [type] [description]
	 */
	public function collectionDo(){
		//收藏者的ID
		$_POST['userId'] = session('uid');
		//收藏时间
		$_POST['time'] = time();
		$msg['status'] = 0;
		$msg['content'] = "收藏失败！";
		if($this->create()){
			$res = $this->add();
			if($res){
				$msg['status'] = 1;
				$msg['content'] = "收藏成功！";
			}
		}
		return $msg;
	}

	/**
	 * [cancle 取消店铺/商品收藏]
	 * @return [type] [description]
	 */
	public function cancle(){
		$id = I('post.id',0,'intval');
		$type = I('post.type',0,'intval');
		$uid = I('post.uid',0,'intval');
		$where = array('targetId' => $id, 'type' => $type, 'userId' =>$uid);
		$res = $this->where($where)->delete();
		if ($res) {
			$msg['status'] = 1;
		}
		else{
			$msg['status'] = 0;
		}
		return $msg;
	}

	/**
	 * [collectionLists 收藏列表数量的获取]
	 * @param  [type] $type [收藏类型默认为0表示商品收藏，1表示店铺]
	 * @return [type]       [description]
	 */
	public function collectionLists($type){
		$where = array('type' => $type,'userId' => session('uid'));
		//获取收藏店铺基本信息
		if($type){
			$res = $this->alias('c')->join('eshop_shop as s on c.targetId = s.id')->field('s.id,s.name,s.logo')->where($where)->count();
		}
		else{
			$res = $this->alias('c')->join('eshop_good as g on c.targetId = g.id')->field('g.id,name,shopprice,place,good_log,count')->where($where)->count();
		}
		return $res;
	}
}
