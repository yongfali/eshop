<?php
/**
*商品展示图片模型
*/
namespace Home\Model;
use Think\Model;
class GoodimgModel extends Model{
	//自动完成商品图片添加时间
	protected $_auto = array(
		array('createtime','time',3,'function'),
		); 

	/**
	 * [saveImageUrl 上传商品图片（包含缩略图）路径存入数据库]
	 * @param  [type] $goodId [商品ID序列号]
	 * @return [type]         [description]
	 */
	public function saveImageUrl($goodId){
		$len = I('post.length') / 2.0;
	 	//循环把图片对应路径存入数组
		$imgURL = I('post.imgURL');
		$thumbURL = I('post.thumbURL');
		for ($i=0; $i < $len; $i++) { 
			$dataList[] = array(
				'goodId' => intval($goodId),
				'img' => $imgURL[$i],
				'thumb_img' => $thumbURL[$i],
				'createtime' => time()
				);
		}
		return $this->addAll($dataList);
	}

	/**
	 * [getImgUrlById 查找对应的图片路径,然后再删除对应数据]
	 * @param  [type] $id [ID序列号]
	 * @return [type]     [description]
	 */
	public function getImgUrlById($id){
		$where = array('id' => $id);
		$res = $this->field('img,thumb_img')->where($where)->find();
		$this->where($where)->delete();
		return $res;
	}
}

