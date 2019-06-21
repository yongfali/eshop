<?php
namespace Home\Controller;
use Think\Controller;
class CollectionController extends Controller{

	/**
	 * [collection 商品/店铺收藏处理]
	 * [$type 表示收藏类型默认为0表示商品收藏，1表示店铺收藏]
	 * @return [type] [description]
	 */
	public function collection(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg['status'] = 0;
		//还有登录
		if(!isset($_SESSION['uid'])){
			$msg['content'] = '您还没有登录，请先以登录！';
		}
		//已登录但是为商家身份
		else if(session('type') === 1){
			$msg['content'] = '请以用户的身份登录！';
		}
		//用户身份登录成功
		else{
			$msg = D('Collection')->collectionDo();
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [cancle 收藏取消处理]
	 * @return [type] [description]
	 */
	public function cancle(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Collection')->cancle();
		$this->ajaxReturn($msg);
	}
}
