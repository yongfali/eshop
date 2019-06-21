<?php
/**
 * 店铺模型
 */
namespace Admin\Model;
use Think\Model;
use Think\Model\RelationModel;
class ShopModel extends RelationModel{
	/**
	 * [waitAuthoShop 获取待审核商家列表]
	 * @return [type] [description]
	 */
	public function waitAuthoShop(){
		$where = array('s.is_exam' =>0);
		return $this->alias('s')
		->join('eshop_shoper as p on s.shoperId = p.id')
		->where($where)
		->field('s.id,s.shoperId,s.name,s.address,s.logo,s.createtime,p.trueName')
		->select();
	}

	/**
	 * [shopAuthoed 店铺审核操作]
	 * @return [type] [description]
	 */
	public function shopAuthoed(){
		$Ids = I('post.Ids');
		//$type：0表示点击单个s审核按钮，1表示点击批量审核按钮
		$type = I('post.type');
		$ids = array();
		$msg = 0;
		if($type){
			$ids = implode(',', $Ids);
			$where['id'] = array('in',$ids);
		}
		else{
			$ids = $Ids;
			$where = array('id' => $ids);
		}
		$shoperId = $this->field('shoperId')->where($where)->select();
		foreach ($shoperId as $key => $val) {
			$shopIds[] = $val['shoperid']; 
		}
		$shoperIds = array();
		$shoperIds = implode(',', $shopIds);
		$this->startTrans();
		D('Shoper')->startTrans();
		$res = $this->where($where)->setField('is_exam',1);
		if($res){
			$where1['id'] = array('in',$shoperIds);
			$result = D('Shoper')->where($where1)->setField('is_examine',1);
			if($result){
				$this->commit();
				D('Shoper')->commit();
				$msg = 1;
			}
			else{
				$this->rollback();
				D('Shoper')->rollback();
			}
		}
		else{
			$this->rollback();
		}
		return $msg;
	}

	/**
	 * [shopDel 店铺删除]
	 * @return [type] [description]
	 */
	public function shopDel(){
		$shopId = I('post.shopId',0,'intval');
		$shoperId = I('post.shoperId',0,'intval');
		is_num($shopId);
		is_num($shoperId);
		$msg = 0;
		$where = array('id' => $shopId);
		$map = array('id' => $shoperId);
		$this->startTrans();
		D('Shoper')->startTrans();
		$res = $this->where($where)->delete();
		if($res){
			$ids = D('Shoper')->where($map)->delete();
			if($ids){
				$this->commit();
				D('Shoper')->commit();
				$msg = 1;
			}
			else{
				$this->rollback();
				D('Shoper')->rollback();
			}
		}
		else{
				$this->rollback();
		}
		return $msg;
	}
}