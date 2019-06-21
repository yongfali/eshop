<?php
/**
*商品专项服务模型
*/
namespace Home\Model;
use Think\Model;
class GoodServiceModel extends Model{
	protected $trueTableName = 'eshop_goodservice';
	// 自动完成
	protected $_auto = array(
		array('createtime','time',1,'function'),
		array('modify_time','time',3,'function'),
		);

	/**
	 * [saveGoodService 商品服务添加]
	 * @param  [type] $goodId [商品ID序列号]
	 * @return [type]         [description]
	 */
	public function saveGoodService($goodId){
		$data =array(
			'goodId' => $goodId,
			'content' => I('post.service_content'),
			'createtime' => time(),
			'modify_time' => time(),
			);
		return $this->data($data)->add();
	}

	/**
	 * [modifyGoodService 商品服务信息修改保存]
	 * @param  [type] $goodId [商品ID序列号]
	 * @return [type]         [description]
	 */
	public function modifyGoodService($goodId){
		$data =array(
			'content' => I('post.service_content'),
			'modify_time' => time(),
			);
		$where = array('goodId' => $goodId);
		return $this->data($data)->where($where)->save();
	}

	/**
	 * [getServerContentById 根据商品ID获取商品服务内容]
	 * @param  [type] $id [商品ID]
	 * @return [type]     [description]
	 */
	public function getServerContentById($id){
		$where = array('goodId' => $id);
		return $this->field('content')->where($where)->find();
	}
}