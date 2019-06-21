<?php
/**
*全网一级菜单模型
*/
namespace Home\Model;
use Think\Model;
class FirstMenuModel extends Model{
	protected $trueTableName = 'eshop_firstmenu';
	/**
	 * [getAllCart 一级分类菜单的获取]
	 * @return [type] [description]
	 */
	public function getAllCart(){
		$where = array('is_show' => 1);
		$list = $this->field('id,name')->where($where)->select();
		return $list;
	}

	/**
	 * [getHomeMenu 商城菜单树的获取]
	 * @return [type] [description]
	 */
	public function getHomeMenu(){
		$fmenu = $this->getAllCart();
		if(!empty($fmenu)){
			foreach ($fmenu as $key => $val) {
				$fids[] = $val['id'];
			}
		}
		$fids = implode(',', $fids);
		//查找二级菜单
		$map['pid'] = array('in',$fids);
		$map['is_show']=1;
		$smenu = M('secondmenu')->where($map)->field('pid,id,name')->select();
		if(!empty($smenu)){
			foreach ($smenu as $key => $val) {
				$sids[] = $val['id'];
			}
		}
		$sids = implode(',', $sids);
		//查找三级菜单
		$where['pid'] = array('in',$sids);
		$where['is_show']=1;
		$tmenu = M('thirdmenu')->where($where)->field('pid,id,name')->select();
		if(!empty($smenu)){
			//对二级菜单按照一级菜单号分组
			foreach ($smenu as $key => $value) {
				$temp[$value['pid']][] = $value;
			}
			/** 
			*把二级菜单拼接到一级菜单内形成一个二维数组
			*添加child 和childNum字段
			*child内为对应二级菜单数组
			*childNum统计对应二级菜单数量
			*/
			foreach ($fmenu as $key => $value){
				$fmenu[$key]['child'] = array_key_exists($value['id'],$temp)?$temp[$value['id']]:null;
				$fmenu[$key]['childNum'] = array_key_exists($value['id'],$temp)?count($temp[$value['id']]):0;
			}
		}
		if(!empty($tmenu)){
			//对三级菜单按照二级菜单号分组
		    foreach ($tmenu as $key => $val) {
				$temp1[$val['pid']][] = $val;
			}
			/**
			 * [$key 三级菜单追加到一二级组合的二级菜单中行程三级菜单树]
			 * @var [type]
			 */
			foreach ($fmenu as $key => $v) {
				foreach ($v['child'] as $k => $val) {
					$fmenu[$key]['child'][$k]['child'] = array_key_exists($val['id'],$temp1)?$temp1[$val['id']]:null;
					$fmenu[$key]['child'][$k]['childNum'] = array_key_exists($val['id'],$temp1)?count($temp1[$val['id']]):0;
				}
			}
		}
		return $fmenu;	
	}
}