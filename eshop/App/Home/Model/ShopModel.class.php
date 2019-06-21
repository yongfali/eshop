<?php
/**
*店铺shop模型
*/
namespace Home\Model;
use Think\Model;
class ShopModel extends Model{
	//字段映射
	protected $_map = array(
		'shopname' => 'name',// 把表单中shopname映射到数据表的name字段
		);
	protected $_validate = array(
		array('name','require','店铺名不能为空',0,'function',3),
		array('name','checkName','店铺名长度为4-20的字符串且不能以数字开头',0,'function',3),
		array('name','','该店铺名已被使用，请更换名称',0,'unique',3),
		array('server_qq','/^\d{5,15}$/','qq格式不正确',2,'regex'),
		array('server_tel','/^((0\d{2,3}-\d{7,8})|(1[3584]\d{9}))$/','电话格式不正确',2,'regex'),
		);
	protected $_auto = array(
		array('createtime','time',1,'function'),
		array('modifytime','time',3,'function'),
		);

	/**
	 * [getShopById 通过商家ID查找对应的店铺Id]
	 * @param  [type] $id [商家ID序列号]
	 * @return [type]     [description]
	 */
	public function getShopById($id){
		$where = array('shoperId' => $id);
		return $this->where($where)->getField('id');
	}

	/**
	 * [getShopInfos 根据店铺序列号查找对应店铺基本信息]
	 * @param  [type] $shopId [店铺ID序列号]
	 * @param  array  $field  [查找的字段，默认为所有字段]
	 * @return [type]         [description]
	 */
	public function getShopInfos($shopId,$field = array('*')){
		$where = array('id' => $shopId,'is_exam' => 1,'is_forbid' => 0,'is_show' => 1);
		$res = $this->field($field)->where($where)->find();
		return $res;
	}

	/**
	 * [modifyShopInfo 店铺信息修改]
	 * @return [type] [description]
	 */
	public function modifyShopInfo(){
		$shoperId = session('uid');
		$where = array('shoperId' => $shoperId);
		if(!checkName(I('post.shopName'))){
			$msg['status'] = 0;
			$msg['content'] = '店铺名不合格！';
		}
		else if(!checkQQ(I('post.shopqq'))){
			$msg['status'] = 0;
			$msg['content'] = 'qq格式不合格！';
		}
		else if(!checkTel(I('post.shopTel'))){
			$msg['status'] = 0;
			$msg['content'] = '联系方式格式不合格！';
		}
		else{
			$data['name'] = I('post.shopName');
			$data['address'] = I('post.shopAddr');
			$data['service_qq'] = I('post.shopqq');
			$data['server_tel'] = I('post.shopTel');
			$data['server_time'] = I('post.serverTime');
			$data['modifytime'] = time();
			$res = $this->getShopInfos($shoperId);
			//判断是否有店铺Logo上传
			if ($_FILES['logo']['error']==0) {
				if(!empty($res['logo'])){
					$logoURL = $res['logo'];
				}
				//上传新的Logo
				$newLogo = uploadImg(C('UPLOAD_ShopLogo'),$_FILES['logo']);
				$data['logo'] = $newLogo;
			}
			//判断是否有店铺二维码上传
			if ($_FILES['qrcode']['error']==0) {
				if(!empty($res['qrcode'])){
					$qrcodeURL = $res['qrcode'];
				}
				//上传新的店铺二维码
				$newQrcode = uploadImg(C('UPLOAD_Qrcode'),$_FILES['qrcode']);
				$data['qrcode'] = $newQrcode;
			}
			$id = $this->data($data)->where($where)->save();
			//保存成功
			if ($id) {
				@unlink($logoURL);
				@unlink($qrcodeURL);
				$msg['status'] = 1;
				$msg['content'] = '保存成功！';
			}
			else{
				@unlink($newLogo);
				@unlink($newQrcode);
				delEmptyDir(C('UPLOAD_ShopLogo'));
				delEmptyDir(C('UPLOAD_Qrcode'));
				$msg['status'] = 0;
				$msg['content'] = '编辑失败！';
			}
		}
		return $msg;
	}
}