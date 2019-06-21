<?php
/**
*用户收货地址模型
*/
namespace Home\Model;
use Think\Model;
class UserAddressModel extends Model
{
	/**
	 * [getNums 获取对应用户收货地址数量]
	 * @param  [type] $uid [用户ID]
	 * @return [type] $num     [地址数量]
	 */
	public function getNums($uid){
		$where = array('userId' => $uid,'is_show' =>1);
		$num = $this->where($where)->count();
		return $num;
	}

	/**
	 * [getAllAddr 获取对应用户所有收货地址is_show=1]
	 * @param  [type] $uid [用户ID]
	 * @return [type] $data     [对应用户的地址列表]
	 */
	public function getAllAddr($uid){
		$where = array('userId' => $uid,'is_show' =>1);
		$data = $this->field('id,userid,username,location,streetinfo,postcode,tel,is_first')->where($where)->order('createtime')->select();
		return $data;
	}

	/**
	 * [delAddr 删除用户地址数据库不真正删除is_show=0]
	 * @param  [type] $id [用户ID]
	 * @return [type]     [description]
	 */
	public function delAddr($id){
		$where = array('id' => $id);
		$data = array('is_show' => 0);
		$result = $this->where($where)->setField($data);
		return $result;
	}

	/**
	 * [setDefaultAddr 设置默认地址,把该用户之前得默认地址is_first=1改为0]
	 * [当前对应ID序列号地址is_first设置为1]
	 * @param [type] $uid [用户ID]
	 * @param [type] $id  [地址ID序列号]
	 */
	public function setDefaultAddr($uid,$id){
		//设置之前先把该用户的所有地址都设置为非默认状态
		$where = array('userId' => $uid);
		$data = array('is_first' => 0,'modifytime' => time());
		$this->where($where)->data($data)->save();
		$where1 = array('id' => $id);
		$data1 = array('is_first' => 1,'modifytime' => time());
		$result = M('user_address')->where($where1)->setField($data1);
		return $result;
	}

	/**
	 * [getAddrById 根据指定地址ID序列号找到该地址并且默认显示]
	 * @param  [type] $id [地址ID序列号]
	 * @return [type] $data    [地址信息]
	 */
	public function getAddrById($id){
		$where = array('id' => $id,'is_show' =>1);
		$data = $this->field('id,userId,username,location,streetinfo,postcode,tel,is_first')
		->where($where)->find();
		return $data;
	}
}