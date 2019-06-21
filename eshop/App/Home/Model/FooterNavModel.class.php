<?php
/**
 * 系统底部帮助中心标签模型
 */
namespace Home\Model;
use Think\Model;
class FooterNavModel extends Model{
	// 自动完成
	protected $_auto = array(
		array('create_time','time',1,'function'),
		array('modify_time','time',3,'function'),
		);
	/**
	 * [navTree 帮助中心标签菜单树获取]
	 * @return [type] [description]
	 */
	public function navTree(){
		$res = $this->alias('f')
		->join('eshop_footer_nav as n on f.id = n.pid')
		->field('f.id,f.name,n.id sid,n.name sname,n.content scontent')
		->select();
		//菜单分组
		foreach ($res as $key => $val) {
			$menu[$val['id']]['id'] = $val['id'];
			$menu[$val['id']]['name'] = $val['name'];
			$menu[$val['id']]['child'][$val['sid']][] = $val['sid'];
			$menu[$val['id']]['child'][$val['sid']][]= $val['sname'];
			$menu[$val['id']]['child'][$val['sid']][] = $val['scontent'];
		}
		return $menu;
	}

	/**
	 * [getNavInfoById 获取导航标签详情]
	 * @param  [type] $navId [标签ID]
	 * @return [type]        [description]
	 */
	public function getNavInfoById($navId){
		$where = array('id' => $navId);
		return $this->where($where)->field('id,pid,name,content')->find();
	}

	/**
	 * [navEditSaveById 编辑保存指定标签]
	 * @param  [type] $navId [标签ID]
	 * @return [type]        [description]
	 */
	public function navEditSaveById($navId){
		$where = array('id' => $navId);
		$_POST['id'] = $navId;
		$msg = 0;
		if ($this->create()) {
			$res = $this->where($where)->save();
			if ($res) {
				$msg = 1;
			}
		}
		return $msg;
	}
}