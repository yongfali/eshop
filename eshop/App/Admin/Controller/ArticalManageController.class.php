<?php
/**
 * 文章管理控制器
 */
namespace Admin\Controller;
use Think\Controller;
class ArticalManageController extends BaseController{
	/**
	 * [list 系统文章列表显示]
	 * @return [type] [description]
	 */
	public function index(){
		$where = array('is_show' => 1);
		//获取对应消息列表的数量
		$count = D('Home/Information')->infoListNum($where);
		$page = getpage($count,6);
		//分页查询
		$infoList = D('Home/Information')->where($where)->order('modify_time desc')->limit($page->firstRow,$page->listRows)->select();
		// 模板赋值
		if(IS_AJAX){
			$this->assign('infoList', $infoList);
			$this->assign('page', $page->show());
			$html = $this->fetch('ArticalManage/infoAjaxPage');
			$this->ajaxReturn($html);
		}
		$this->assign('infoList', $infoList);
		// 赋值分页输出
		$this->assign('page', $page->show()); 
		$this->display();
	}

	/**
	 * [info 新增消息页面]
	 * @return [type] [description]
	 */
	public function info(){
		$this->display();
	}

	/**
	 * [infoAdd 新增消息]
	 * @return [type] [description]
	 */
	public function infoAdd(){
		if(!IS_AJAX){
			E('页面不存在');
		}
		$msg = D('Home/Information')->saveInfo();
		$this->ajaxReturn($msg);
	}

	/**
	 * [infoDel 消息删除]
	 * @return [type] [description]
	 */
	public function infoDel(){
		if(!IS_AJAX){
            E('页面不存在');
        }
       $msg = D('Home/Information')->infoListDel();
       $this->ajaxReturn($msg);
	}

	/**
	 * [infoEdit 消息修改]
	 * @return [type] [description]
	 */
	public function infoEdit(){
		$info = D('Home/Information')->infoDetail();
		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * [infoEditSave 信息编辑保存]
	 * @return [type] [description]
	 */
	public function infoEditSave(){
		$infoId = I('post.infoId',0,'intval');
		is_num($infoId);
		$msg = D('Home/Information')->infoEdit($infoId);
		$this->ajaxReturn($msg);
	}

	/**
	 * [helpList 帮助中心列表显示]
	 * @return [type] [description]
	 */
	public function helpList(){
		$info = D('Home/FooterNav')->navTree();
		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * [helpItemEdit 底部帮助列表编辑]
	 * @return [type] [description]
	 */
	public function helpItemEdit(){
		$navId = I('get.id',0,'intval');
		is_num($navId);
		$content = D('Home/FooterNav')->getNavInfoById($navId);
		$info = D('Home/FooterNav')->navTree();
		$this->assign('info',$info);
		$this->assign('content',$content);
		$this->display('helpEdit');
	}

	/**
	 * [helpItemSave 底部帮助列表编辑保存]
	 * @return [type] [description]
	 */
	public function helpItemSave(){
		$navId = I('post.navId',0,'intval');
		is_num($navId);
		$msg = D('Home/FooterNav')->navEditSaveById($navId);
		$this->ajaxReturn($msg);
	}

	/**
	 * [nav 分类列表显示]
	 * @return [type] [description]
	 */
	public function nav(){
		$this->display();
	}

	/**
	 * [infoSearch 消息检索]
	 * @return [type] [description]
	 */
	public function infoSearch(){
		if(!IS_AJAX){
            E('页面不存在');
        }
		$type = I('post.type',0,'intval');
		$title = I('post.title');
		$utype = I('post.utype',0,'intval');
		$publishType = 1;
		if($utype == 1){
			$publishType = 0;
		}
		if($type == 0 && $utype == 0 && empty($title)){
			$msg = '查询条件不能为空！';
		}
		if($type && $utype == 0 && empty($title)){
			$where = array('type' => $type);
		}
		if($type == 0 && $utype && empty($title)){
			$where = array('publishType' => $publishType);
		}
		if($type == 0 && $utype == 0 && !empty($title)){
			$where = array('title' => array('like',"%".$title."%"));
		}
		if($type && $utype && empty($title)){
			$where = array('type' => $type,'publishType' => $publishType);
		}
		if($type && $utype == 0 && !empty($title)){
			$where = array('type' => $type,'title' => array('like',"%".$title."%"));
		}
		if($type == 0 && $utype && !empty($title)){
			$where = array('publishType' => $publishType,'title' => array('like',"%".$title."%"));
		}
		if($type && $utype && !empty($title)){
			$where = array('type' => $type,'publishType' => $publishType,'title' => array('like',"%".$title."%"));
		}
		$where['is_show'] = 1;
		//获取查询数量
		$count  = D('Home/Information')->infoListNum($where);
		$page = getpage($count,6);
		$list = D('Home/Information')->where($where)->limit($page->firstRow,$page->listRows)->select();
		//模板赋值
		$this->assign('infoList',$list);
		$this->assign('page', $page->show());
		$msg = $this->fetch('ArticalManage/infoAjaxPage');
		//ajax返回结果	
		$this->ajaxReturn($msg);
	}
}