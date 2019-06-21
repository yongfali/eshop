<?php
/**
*商品导航标签模型
*/
namespace Home\Model;
use Think\Model;
class GoodnavModel extends Model{
	/**
	 * [$_auto 自动完成]
	 * @var array
	 */
	protected $_auto = array(
		array('createtime','time',1,'function'),
		array('modifytime','time',3,'function'),
		);

	/**
	 * [saveGoodCart 保存商品的分类包括全网分类和店铺分类]
	 * @param  [type] $goodId [商品ID序列号]
	 * @param  [type] $shopId [店铺ID序列号]
	 * @return [保存成功后的ID]
	 */
	public function saveGoodCart($goodId,$shopId){
		$data = array(
			'goodId' => intval($goodId),
			'shopId' => intval($shopId),
			'createtime' => time(),
			'modify_time' => time(),
			);
		if(I('post.wfirst','','intval')){
			$data['w_fid'] = I('post.wfirst','','intval');
		}
		if(I('post.wSecond','','intval')){
			$data['w_sid'] = I('post.wSecond','','intval');
		}
		if(I('post.wThird','','intval')){
			$data['w_tid'] = I('post.wThird','','intval');
		}
		if(I('post.sfirst','','intval')){
			$data['s_fid'] = I('post.sfirst','','intval');
		}
		if(I('post.sSecond','','intval')){
			$data['s_sid'] = I('post.sSecond','','intval');
		}
		return $this->data($data)->add();
	}

	/**
	 * [modifyGoodCart 商品分类信息修改保存]
	 * @param  [type] $goodId [商品ID序列号]
	 */
	public function modifyGoodCart($goodId){
		$where = array('goodId' => $goodId);
		$data = array(
			'w_fid' => I('post.wfirst','','intval'),
			'w_sid' => I('post.wSecond','','intval'),
			'w_tid' => I('post.wThird','','intval'),
			's_fid' => I('post.sfirst','','intval'),
			's_sid' => I('post.sSecond','','intval'),
			'modify_time' => time(),
			);
		//为了防止为空选项，在更新外键之前先让外键约束去除，更新后在天添加约束
		$sql = "SET FOREIGN_KEY_CHECKS = 0";
		$sql2 = "SET FOREIGN_KEY_CHECKS = 1";
		$this->execute($sql);
		$res = $this->data($data)->where($where)->save();
		$this->execute($sql2);
		return $res;
	}

	/**
	 * [getNavsById 获取商品的导航标签]
	 * @param  [type] $goodId [商品ID序列号]
	 * @return $name         [导航标签内容]
	 */
	public function getNavsById($goodId){
		$where = array('goodId' => $goodId);
		$res = $this->field('w_fid,w_sid,w_tid,s_fid,s_sid')->where($where)->find();
		//去掉为空的标签
		foreach ($res as $key => $val) {
			if (!empty($val)) {
				$data[$key] = $val;
			}
		}
		//根据标签序列号查找对应标签的名称
		if(array_key_exists('w_fid', $data)){
			$name['w_fid'][] = $this->alias('n')->join('eshop_firstmenu as w_f on n.w_fid = w_f.id')->where($where)->field('name,w_fid')->find();
		}
		if(array_key_exists('w_sid', $data)){
			$name['w_sid'][] = $this->alias('n')->join('eshop_secondmenu as w_s on n.w_sid = w_s.id')->where($where)->field('name,w_sid')->find();
		}
		if(array_key_exists('w_tid', $data)){
			$name['w_tid'][] = $this->alias('n')->join('eshop_thirdmenu as w_t on n.w_tid = w_t.id')->where($where)->field('name,w_tid')->find();
		}
		if(array_key_exists('s_fid', $data)){
			$name['s_fid'][] = $this->alias('n')->join('eshop_shop_firstmenu as s_f on n.s_fid = s_f.id')->where($where)->field('name,s_fid')->find();
		}
		if(array_key_exists('s_sid', $data)){
			$name['s_sid'][] = $this->alias('n')->join('eshop_shop_secondmenu as s_s on n.s_sid = s_s.id')->where($where)->field('sname,s_sid')->find();
		}
		return $name;
	}

	/**
	 * [getShopGoods 查找对应店铺内的商品列表]
	 * @param  [type] $where [刷选条件]
	 * @param  array  $order [排序条件默认为按商品最近修改时间将序排列]
	 * @return [商品列表]
	 */
	public function getShopGoods($where , $order=array('modify_recenet'=>'desc')){
		return $this->alias('n')->join('eshop_good as g on n.goodId = g.id')->where($where)->order($order)->select();
	}

	/**
	 * [getGoodLists 获取商城所有商品列表，后期需完善]
	 * @return [type] [description]
	 */
	public function getGoodLists(){
		return $this->alias('n')
		->join('eshop_good as g on n.goodId = g.id')
		->join('eshop_shop as s on s.id = n.shopId')
		->where(
			array(
				'status' => 1,  
				'g.is_exam' => 1,
				'is_legal' =>1,
				'g.is_forbid' => 0,
				'stock' => array('gt',1),
				)
			)
		->field(
			array(
				'n.goodId,n.shopId,n.w_fid,
				g.name goodName,g.shopPrice,g.place,g.good_log,g.count,
				s.name shopName'
				)
			)
		->order(array('modify_recenet'=>'desc'))
		->select();
	}

	/**
	 * [getHostGoods 获取商家推荐或店铺热销商品]
	 * @param  [type]  $where [查询条件]
	 * @param  integer $num   [查询数据条数默认为1条]
	 * @return [商品列表]
	 */
	public function getHostGoods($where,$num=1){
		return $this->alias('n')->join('eshop_good as g on n.goodId = g.id')->where($where)->order('modify_recenet desc')->limit($num)->select();
	}

	/**
	 * [getShopIdByGoodId 根据商品的ID查找对应的店铺序列号]
	 * @param  $goodId [商品的ID]
	 * @return [店铺序列号]
	 */
	public function getShopIdByGoodId($goodId){
		$where = array('goodId' => $goodId);
		return $this->alias('n')->join('eshop_good as g on n.goodId = g.id')->field('n.shopId')->where($where)->find();
	}
	/**
	 * [getInfoByGoodId 店铺信息和商家信息获取]
	 * @param  [type] $goodId [商品序列号]
	 * @return [信息集合]
	 */
	public function getInfoByGoodId($ids){
		$where['goodId'] = array('in',$ids);
		return $this->alias('n')
		->join('eshop_shop as s on n.shopId = s.id')
		->join('eshop_shoper as r on s.shoperId = r.id')
		->field('goodId,s.id,s.name shopName,s.service_qq,r.name shoperName,r.qq')
		->where($where)->select();
	}
}