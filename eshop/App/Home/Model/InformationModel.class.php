<?php
/**
*网站信息模型
*/
namespace Home\Model;
use Think\Model;
class InformationModel extends Model{
	// 自动完成
	protected $_auto = array(
		array('publish_time','time',1,'function'),
		array('modify_time','time',3,'function'),
		);

	/**
	 * [saveInfo 信息发布保存]
	 * @param  integer $type [默认0 表示管理员发布，1表示商家发布]
	 * @return [type]        [description]
	 */
	public function saveInfo($type=0){
		if(!$type){
			$_POST['publisherId'] = session('adminId');
			$_POST['publisherName'] = session('adminName');
		}
		else{
			$_POST['publisherId'] = session('uid');
			$_POST['publisherName'] = session('uname');
		}
		$_POST['publishType'] = $type;
		$msg['status'] = 0;
		if($this->create()){
			$res = $this->add();
			if($res){
				$msg['status'] = 1;
			}
		}
	 	return $msg;
	}
	
	/**
	 * [infoListNum 信息列表数量查询]
	 * @param  [type] $where [查询条件]
	 * @return [type]        [description]
	 */
	public  function infoListNum($where){
		return $this->where($where)->count();
	}

	/**
	 * [getAllInfoList 获取系统不同类别信息指定的数量条数]
	 * @param  integer $type [消息类型默认为3：公告，1：资讯，2：优惠互动]
	 * @param  integer $num  [获取的数量条数默认为10条]
	 * @return [type]        [description]
	 */
	public function getInfoLists($type=3,$num=10,$field=array('*')){
		$where = array(
			'is_show' => 1,
			'type' => $type,
			);
		return $this->where($where)->field($field)->limit($num)->select();
	}
	/**
	 * [infoDetail 根据信息ID查询对应内容]
	 * @return [type] [description]
	 */
	public  function infoDetail(){
		$id = I('get.id',0,'intval');
		is_num($id);
		$where = array('id' => $id,'is_show' =>1);
		return $this->field('id,title,content,type,publisherName,publishType,publish_time')->where($where)->find();
	}

	/**
	 * [infoListDel 消息列表批量删除操作，包含单个删除]
	 * [$tyep为0表示单个删除，1表示批量删除]
	 * @return [type] [description]
	 */
	public function infoListDel(){
		$InfoIds = I('post.InfoIds');
		$ids = array();
		$type = I('post.type');
		//批量删除
		if($type){
			$ids = implode(',', $InfoIds);
			$where['id'] = array('in',$ids);
		}
		else{
			$where = array('id' => $InfoIds);
		}
		// $data = array('is_show' => 0);
		$this->startTrans();
		$res = $this->where($where)->delete();
		// $res = $this->data($data)->where($where)->save();
		if($res){
			$this->commit();
			$msg['status'] = 1;
		}
		else{
			$this->rollback();
			$msg['status'] = 0;
		}
		return $msg;
	}

	/**
	 * [infoEdit 根据信息的ID进行编辑处理]
	 * @param  [type] $Infoid [信息的ID]
	 * @return [type]         [description]
	 */
	public function infoEdit($Infoid){
		$where = array('id' => $Infoid);
		$_POST['id'] = $Infoid;
		$msg['status'] = 0;
		if ($this->create()) {
			$res = $this->where($where)->save();
			if ($res) {
				$msg['status'] = 1;
			}
		}
		return $msg;
	}
}