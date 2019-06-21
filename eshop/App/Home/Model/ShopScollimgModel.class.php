<?php
/**
*店铺首页滚动广告模型
*/
namespace Home\Model;
use Think\Model;
class ShopScollimgModel extends Model{
	/**
	*店铺广告上传路径保存到数据库
	*/
	public function saveAdsImgURL(){
	 	//循环把图片对应路径存入数组
		$imgURL = I('post.imgURL');
		//根据商家ID查找店铺ID
		$uid = session('uid');
		$shopId = D('Shop')->getShopById($uid);
		foreach ($imgURL as $key => $val) {
			$dataList[] = array(
				'shopId' => $shopId,
				'imgURL' => $val,
				'upload_time' => time()
				);
		}
		$res = $this->addAll($dataList);
		if($res){
			$msg['status'] = 1;
		}
		else{
			$msg['status'] = 1;
		}
		return $msg;
	}
	/**
	*根据指定ID序列号查找对应的图片路径,然后再删除对应数据
	*/
	public function getAdsImgUrlById($id){
		$where = array('id' => $id);
		$res = $this->field('imgURL')->where($where)->find();
		$this->where($where)->delete();
		return $res;
	}
	/**
	*根据店铺ID获取所有广告图片的URL地址
	*/
	public function getAllById($shopId){
		$where = array('shopId' => $shopId,'is_forbiden' => 0);
		return $this->field('id,imgURL')->where($where)->select();
	}
}