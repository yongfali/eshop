<?php
/**
*商品标签信息模型
*/
namespace Home\Model;
use Think\Model;
class GoodinfoModel extends Model{
	/**
	*商品对应标签内容添加
	*/
	public function saveLableContent($goodId){
		$lable = I('post.pro');
		//获取标签内容数组的下标即标签内容对应的ID
		$lableId = array_keys($lable);
		//遍历存储标签信息
		foreach ($lableId as $key => $v) {
			//去除为空的标签内容
			if($lable[$v] !=''){
				$data[] = array(
					'goodId' => intval($goodId),
					'lableId' => $v,
					'lableContent' => $lable[$v]
					);
			}
		}
		return $this->addAll($data);		
	}
	/**
	*查询对应ID商品的标签内容
	*/
	public function getLableContetn($goodId){
		$where = array('goodId' => $goodId);
		$res = $this->alias('i')->field('lablecontent,name')->join('eshop_goodlable as s on i.lableId = s.lableId')->where($where)->select();
		return $res;
	}
	/**
	*批量更新标签内容，若该标签不存在则添加该标签
	*执行效率后续改进
	*/
	public function updataLableContent($goodId){
		$lable = I('post.pro');
		//获取标签内容数组的下标即标签内容对应的ID
		$lableId = array_keys($lable);
		foreach ($lableId as $key => $val) {
			// 先查询该数据数据库是否已经存在，有则更新，没有则插入
			$where = array('goodId' => $goodId,'lableId' => $val);
			$data = array('lableContent' => $lable[$val]);
			if($this->where($where)->find()){
				$this->where($where)->save($data);
			}
			else{
				$this->data(array('lableContent' => $lable[$val],'goodId' => $goodId))->add();
			}
		}
	}
}