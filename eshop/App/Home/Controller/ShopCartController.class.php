<?php
/**
*商品分类控制器
*/
namespace Home\Controller;
use Think\Controller;
class ShopCartController extends ShoperCommonController{

	/**
	 * [index 商品分类页面展示]
	 * @return [type] [description]
	 */
	public function index(){
		//根据商家ID查找店铺ID
		$uid = session('uid');
		$shopId = D('Shop')->getShopById($uid);
		//获取对应店铺商品分类二级菜单树
		$fmenu = getShopCart($shopId);
		$this->assign('list',$fmenu);
		$this->display();
	}

	/**
	 * [saveMenu 点击保存按钮保存商品分类]
	 * @return [type] [description]
	 */
	public function saveMenu(){
		if(!IS_POST){
			E('页面不存在！');
		}
		// 已有菜单新增的二级菜单数量
		$num = count(I('post.pid'));
		// 添加二级菜单对应的一级菜单ID序列号
		$pid = I('post.pid');
		// 对应二级菜单内容
		$param = I('post.param');
		// 新增加的菜单（包括一级菜单和二级菜单）内容
		$param1 = I('post.param1');
		// 处理已有一级菜单对应新增的二级菜单
		if (!empty($param)) {
			//添加对应一级菜单下新增的二级菜单
			for($i=0; $i < $num; $i++){
				$data['sname'] = $param[$pid[$i].'_'.$i];
				if($data['sname'] == '')continue;
				$data['pid'] = $pid[$i];
				$data['create_time'] = time();
				if(M('shop_secondmenu')->data($data)->add()){
					$msg['status'] = 1;
				}
				else{
					$msg['status'] = 0;
				}	
			}
		}
		//处理新增的一级菜单和对应的二级菜单为空不添加
		if(!empty($param1)){
		//根据商家ID查找店铺ID
			$shopId = D('Shop')->getShopById(session(uid));
			for ($i=0; $i < $param1['totalNum']; $i++) { 
				//先处理一级菜单为空则不进行处理对应二级菜单也不添加
				if($param1[$i.'_'] == ''){
					continue;
				}
				else{
					//一级菜单入库
					$data =array(
						'shopId' => $shopId,
						'name' => $param1[$i.'_'],
						'create_time' => time(),
						);
					$pid = M('shop_firstmenu')->data($data)->add();
					if($pid){
						//循环添加对应的二级菜单
						if($param1[$i.'_num']){
							for ($j=0; $j <$param1[$i.'_num'] ; $j++) { 
								$data = array(
									'pis' => $pid,
									'sname' => $param1[$i.'_'.$j],
									'create_time' => time(),
									);
								if(M('shop_secondmenu')->data($data)->add()){
									$msg['status'] = 1;
								}
								else{
									$msg['status'] = 0;
								}
							}
						}
						$msg['status'] = 1;	
					}
					else{
						$msg['status'] = 0;
					}
				}
			}
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [delCart 菜单的删除操作]
	 * @return [type] [description]
	 */
	public function delCart(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$type = I('post.type',0,'intval');
		$id = I('post.id',0,'intval');
		$where = array('id' => $id);
		//如果是一级菜单则级联删除对应的二级菜单
		if(!$type){
			if(M('shop_firstmenu')->where($where)->delete()){
				$msg['status'] =1;
			}
			else{
				$msg['status'] =0;
			}	
		}
		else{
			if(M('shop_secondmenu')->where($where)->delete()){
				$msg['status'] =1;
			}
			else{
				$msg['status'] =0;
			}
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [editCart 菜单的编辑操作]
	 * @return [type] [description]
	 */
	public function editCart(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$type = I('post.type');
		$name = I('post.name');
		//当前修改的为一级菜单
		if(!$type){
			if(!empty($name)){
				$where = array('id' => I('post.id',0,'intval'));
				$data =array(
					'name' => I('post.name'),
					'modify_time' => time(),
					);
				$id = M('shop_firstmenu')->where($where)->save($data);
				if($id){
					$msg['status'] = 1;
				}
				else{
					$msg['status'] = 0;
				}
			}
		}
		//当前修改为二级菜单
		else{
			if(!empty($name)){
				$where = array('id' => I('post.id',0,'intval'));
				$data =array(
					'sname' => I('post.name'),
					'modify_time' => time(),
					);
				$id = M('shop_secondmenu')->where($where)->save($data);
				if($id){
					$msg['status'] = 1;
				}
				else{
					$msg['status'] = 0;
				}
			}
		}
		$this->ajaxReturn($msg);
	} 

}