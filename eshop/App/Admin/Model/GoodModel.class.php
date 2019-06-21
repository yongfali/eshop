<?php
/**
 * 商品模型
 */
namespace Admin\Model;
use Think\Model;
class GoodModel extends Model{
	/**
	 * [goodCount 后台商品数量统计]
	 * @param  integer $type 
	 * [统计的类型默认为
	 * 0：查找所有上架数量，
	 * 1：统计今日上架商品数量，
	 * 2：待审核商品数量
	 * ]
	 * @return [type]        [description]
	 */
	public function goodCount($type=0){
		$where['status'] = 1;
		switch ($type) {
			case 1:
				//今天strtotime生成unix时间戳
				$today = strtotime(date("Y-m-d"));
				$where['time'] = $today;
				break;
			case 2:
				$where['is_exam'] = 0;
				break;
			default:
				break;
		}
		$num = $this->where($where)->count();
		return $num;
	}

	/**
	 * [goodList 商品列表获取]
	 * @param  integer $searchType [description]
	 * @return [type]              [description]
	 */
	public function goodList($searchType=0){
		$where['s.is_forbid'] = 0;
		switch ($searchType) {
			case 1:
				# code...
				break;
			
			default:
				$where['g.is_exam'] = 0;
				break;
		}
		return $this->alias('g')
		->join('eshop_goodnav as n on g.id = n.goodId')
		->join('eshop_shop as s on n.shopId = s.id')
		->field('g.id,g.goodnumber,g.name,g.shopprice,
			g.place,g.good_log,s.name shopname')
		->where($where)
		->select();
	}

	/**
	 * [goodAuthoed 商品审核操作]
	 * @return [type] [description]
	 */
	public function goodAuthoed(){
		$Ids = I('post.Ids');
		//$type：0表示点击单个审核按钮，1表示点击批量审核按钮
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
		$res = $this->where($where)->setField('is_exam',1);
		if($res){
			$msg = 1;
		}
		return $msg;
	}
}