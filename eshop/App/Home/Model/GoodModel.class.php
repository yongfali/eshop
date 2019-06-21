<?php
/**
*商品基本信息模型
*/
namespace Home\Model;
use Think\Model;
class GoodModel extends Model{
	//商品字段映射
	protected $_map = array(
		'goodsName' => 'name',
		'warnStock' => 'stock_warning',
		'goodsSn' => 'goodNumber',
		'recomend' => 'is_recomend',
		'hot' => 'is_hot',
		'newgood' => 'is_new',
	);
	//商品字段自动验证
	protected $_validate = array(
		//商品名称验证
		array('name','require','商品名不能为空'),
		array('name','/^[\x00-\xff][\x00-\xffa-zA-Z0-9\.]{1,}$/','商品名非法'),
		//新增商品编号验证
		array('goodNumber','','商品编号不能自行修改',0,'unique',1),
		//市场价格验证
		array('marketPrice','require','市场价不能为空'),
		array('marketPrice',array(0,100000000),'市场价大于等于0',0,'between'),
		// 店铺价格验证
		array('shopPrice','require','商品价格不能为空'),
		array('shopPrice',array(0,100000000),'店铺价大于等于0',0,'between'),
		// 库存验证
		array('stock','require','库存不能为空'),
		array('stock',array(1,100000000),'库存应大于0',0,'between'),
		// 预警库存验证
		array('stock_warning',array(0,100000000),'预警库存不能小于0',0,'between'),
		// 产地验证
		array('place','require','商品产地不能为空'),
		// 商品logo验证
		array('good_logo','require','商品logo不能为空'),
		); 
	//商品添加时间自动完成是在create()方法时收集数据时
	protected $_auto =array(
		array('time','time',1,'function'),
		array('modify_recenet','time',3,'function'),
		);

	/**
	 * [chanageGoodStatus 商品状态改变操作]
	 * [执行批量更新]
	 * [$type：1表示商品上架，0表示商品下架入库]
	 * @return [type] [description]
	 */
	public function chanageGoodStatus(){
		$goodIds = I('post.goodIds','','intval');
		$type = I('post.type','','intval');
		foreach ($goodIds as $key => $val) {
			$data[] = $val;
		}
		//开启事务
		$this->startTrans();
		$id = implode(',', $data);
		//上架
		if($type){
			$dataArr = array('status' => 1,'modify_recenet' => time());
		}
		else{
			$dataArr = array('status' => 0,'modify_recenet' => time());
		}
		$result = $this->where("id in ($id)")->setField($dataArr);
		if($result){
			$this->commit();
			$msg['status'] = 1;
			$msg['content'] = '成功下架/上架';
		}
		else{
			$this->rollback();
			$msg['status'] = 0;
			$msg['content'] = '操作失败';
		}
		return $msg;
	}

	/**
	 * [chanageGoodPros 批量修改商品属性（推荐，热销，新品）]
	 * @return [type] [description]
	 */
	public function chanageGoodPros(){
		$type = I('post.type');
		$goodIds = I('post.goodIds');
		$allowType = ['is_recomend','is_hot','is_new'];
		if (!in_array($type,$allowType)) {
			$msg['status'] = 0;
			$msg['content'] = "操作非法！";
		}
		else{
			$ids = implode(',', $goodIds);
			//开启事务
			$this->startTrans();
			$result = $this->where("id in ($ids)")->setField(array($type  => 1,'modify_recenet' => time()));
			if($result){
				$this->commit();
				$msg['status'] = 1;
				$msg['content'] = '修改成功！';
			}
			else{
				$this->rollback();
				$msg['status'] = 0;
				$msg['content'] = '操作失败或者对应属性已改变！';
			}
		}
		return $msg;
	}

	/**
	 * [goodDel 商品批量删除/单个删除，同时级联删除该商品对应的属性，信息]
	 * [级联信息包括：商品图册，商品标签内容，商品专享服务，商品导航]
	 * @return [type] [description]
	 */
	public function goodDel(){
		$goodIds = I('post.goodIds');
		//$type：0表示点击单个删除按钮，1表示点击批量删除按钮
		$type = I('post.type');
		$ids = array();
		if($type){
			$ids = implode(',', $goodIds);
			$where['id'] = array('in',$ids);
		}
		else{
			$ids = $goodIds;
			$where = array('id' => $ids);
		}
		$goodLog = $this->where("id in ($ids)")->field('id,good_log')->select();
		$goodImgs = D('Goodimg')->where("goodId in ($ids)")->field('id,img,thumb_img')->select();
		if (!empty($goodLog)) {
			foreach ($goodLog as $key => $val) {
			//商品Logo图片地址
				$log[] = $val['good_log'];
			}
		}
		if (!empty($goodImgs)) {
			foreach ($goodImgs as $key => $val) {
			// 商品图册地址
				$imgs[] = $val['img'];
			// 商品缩略图地址
				$thumbs[] = $val['thumb_img'];
			}
		}
		//开启事务
		$this->startTrans();
		$res = $this->where($where)->delete();
		//如果删除成功则提交事务，并删除商品相关图片
		if ($res) {
			//提交事务
			$this->commit();
			//循环删除商品logo图片
			foreach ($log as $key => $val) {
				if(file_exists($val)){
					@unlink($val);
				}
			}
			//循环删除商品图册所有图片
			foreach ($imgs as $key => $val) {
				if(file_exists($val)){
					@unlink($val);
				}
			}
			//循环删除商品图册所有缩略图片
			foreach ($thumbs as $key => $val) {
				if(file_exists($val)){
					@unlink($val);
				}
			}
			//执行完后检查是否有空目录，有的话则删除空目录
			//删除logo下的空目录
			$dir = C('UPLOAD_SHOPS')['rootPath'];
			delEmptyDir($dir);
			//删除goods下的空目录
			$dir1 = C('UPLOAD_Logo')['rootPath'];
			delEmptyDir($dir);
			$msg['status'] = 1;
			$msg['content'] = '删除成功！';
		}
		else{
			//回滚删除操作
			$this->rollback();
			$msg['status'] = 0;
			$msg['content'] = '删除失败！';
		}
		return $msg;
	}

	/**
	 * [goodsSearch 商品查询]
	 * @param  [type] $where [查询条件]
	 * @return [type] $res   [为返回的记录条数]
	 */
	public function goodsSearch($where){
		$res = $this->alias('g')->field('goodId')->join('eshop_goodnav as n on g.id = n.goodId')->where($where)->count();
		return $res;
	}

	/**
	 * [getLogoURL 根据商品ID查找商品logo的URL]
	 * @param  [type] $goodId [description]
	 * @return [type]         [description]
	 */
	public function getLogoURL($goodId){
		$where = array('id' => $goodId);
		return $this->where($where)->getField('good_log');
	}

	/**
	 * [getGoodInfoById 根据商品ID查找商品基本信息]
	 * @param  [type] $goodId [商品ID]
	 * @return [type]         [description]
	 */
	public function getGoodInfoById($goodId){
		$where = array('id' => $goodId);
		return $this->where($where)->field('id,name,shopPrice,good_log,stock')->find();
	}

	/**
	 * [getStockWarning 查找对应店铺库存预警列表数量]
	 * @param  [type] $where [description]
	 * @return [type]        [description]
	 */
	public function getStockWarning($where){
		return $this->alias('g')->field('g.id')->join('eshop_goodnav as n on g.id = n.goodId and g.stock<=g.stock_warning and g.stock_warning>=0')->where($where)->count();
	}

	/**
	 * [changeStock 商品库存数量编辑修改包括现有库存和预警库存]
	 * @return [type] [description]
	 */
	public function changeStock(){
		$type = I('post.type',0,'intval');
		$goodId = I('post.goodId',0,'intval');
		$where = array('id' => $goodId);
		$val = I('post.val',0,'intval');
		$data['modify_recenet'] = time();
		$msg = 0;
		//对预警库存更新
		if($type){
			$data = array('stock_warning' => $val);
		}
		else{
			$data = array('stock' => $val);
		}
		$res = $this->data($data)->where($where)->save();
		if($res){
			$msg = 1;
		}
		return $msg;
	}

	/**
	 * [getGoodsHistory 最近浏览的商品列表获取]
	 * @return [type] [description]
	 */
	public function getGoodsHistory(){
		if(isset($_COOKIE['goods_history']) && !empty($_COOKIE['goods_history'])){
			$ids = cookie('goods_history');
			return $this->alias('g')
			->join('eshop_goodnav as n on g.id = n.goodId')
			->join('eshop_shop as s on s.id = n.shopId')
			->field('g.id,g.name,g.shopPrice,g.place,g.good_log,g.count,s.id shopId,s.name shopName')
			->where(array('g.id' => array('in',$ids)))
			->select();
		}
		else{
			return NULL;
		}
	}

	/**
	 * [getMayLikeGoods 推测用户可能喜欢的商品]
	 * [目前只根据当前浏览的商品获取其属于的全网分类
	 * 然后获取该分类下的部分商品按价格高低显示
	 * 后期完善]
	 * @param  [type] $goodId [当前浏览的商品ID]
	 * @return [type]         [description]
	 */
	public function getMayLikeGoods($goodId){
		$res = D('Goodnav')->getNavsById($goodId);
		$data = $res['w_fid'];
		$map = array(
			'w_fid' => $data[0]['w_fid'],
			'_logic' => 'OR',
			'g.name' => array('like',"%".$data[0]['name']."%"),
			);
		$where = array(
			'g.id' => array('NEQ',$goodId),
			'g.is_exam' => 1,
			'g.is_legal' => 1,
			'g.is_forbid' => 0,
			'stock' => array('gt' , 0),
			'_complex' => $map,
			);
		$result = $this->alias('g')
		->join('eshop_goodnav as n on g.id = n.goodId')
		->join('eshop_shop as s on s.id = n.shopId')
		->field(array('g.id,g.name,g.shopPrice,g.place,g.good_log,g.count,s.id shopId,s.name shopName'))
		->where($where)
		->limit(3)
		->order('shopPrice,time')
		->select();
		return $result;
	}

	/**
	 * [decStockByGoodId 订单操作后修改商品对应的库存]
	 * @param  [type] $goodId [商品ID序列号]
	 * @param  [type] $num    [商品数量的变化,默认为1]
	 * @param  [type] $type   [默认为1表示下单成功库存减少，0表示取消订单或其他原因而是库存恢复]
	 * @return [type]         [description]
	 */
	public function changeStockByGoodId($goodId,$num=1,$type=1){
		$where = array('id' => $goodId);
		if($type){
			return $this->where($where)->setDec('stock',$num);
		}
		else{
			return $this->where($where)->setInc('stock',$num);
		}
	}
}