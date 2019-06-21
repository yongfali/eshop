<?php
/**
*店铺管理控制器
*/
namespace Home\Controller;
use Think\Controller;
class ShopManageController extends ShoperCommonController{

	/**
	 * [index 店铺信息页面展示]
	 * @return [type] [description]
	 */
	public function index(){
		//根据商家ID查找店铺ID
		$uid = session('uid');
		$shopId = D('Shop')->getShopById($uid);
		$shopInfo = D('Shop')->getShopInfos($shopId);
		//模板赋值
		$this->assign('shopInfo',$shopInfo);
		$this->display();
	}

	/**
	 * [shopInfoEdit 店铺信息编辑处理]
	 * @return [type] [description]
	 */
	public function shopInfoEdit(){
		if(!IS_AJAX){
            E('页面不存在');
        }
        $msg = D('Shop')->modifyShopInfo();
        $this->ajaxReturn($msg);
	}

	/**
	 * [checkShopName 店铺信息编辑的时候检查店铺名是否重复]
	 * [查询时除去自身记录]
	 * @return [type] [description]
	 */
	public function checkShopName(){
		if(!IS_AJAX){
            E('页面不存在');
        }
        //根据商家ID查找对应店铺的ID
        $shopId = D('Shop')->getShopById(session('uid'));
        $where['id'] = array('NEQ',$shopId);
        $where['name'] = array('EQ',I('post.shopName'));
        $res = D('Shop')->where($where)->getField('id');
        if($res){
            echo 'false';
        }
        else{
            echo 'true';
        }
	}

	/**
	 * [info descr店铺信息发布iption]
	 * @return [type] [description]
	 */
	public function info(){
		$this->display();
	}

	/**
	 * [infoSave 店铺信息发布保存]
	 * @return [type] [description]
	 */
	public function infoSave(){
		if(!IS_AJAX){
            E('页面不存在');
        }
        $type = 1;
        $msg = D('Information')->saveInfo($type);
		$this->ajaxReturn($msg);
	}

	/**
	 * [infoEdit 店铺信息编辑显示]
	 * @return [type] [description]
	 */
	public function infoEdit(){
		is_num(I('get.id'));
		$info = D('Information')->infoDetail();
		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * [infoEditSave 店铺信息编辑保存处理]
	 * @return [type] [description]
	 */
	public function infoEditSave(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$infoId = I('post.infoId',0,'intval');
		$msg = D('Information')->infoEdit($infoId);
		$this->ajaxReturn($msg);
	}

	/**
	 * [infoList 信息列表]
	 * @return [type] [description]
	 */
	public function infoList(){
		$type = 1;
		$where = array('publishType' => $type,'publisherId' =>session('uid') ,'is_show' => 1);
		//获取对应消息列表的数量
		$count = D('Information')->infoListNum($where);
		$page = getpage($count,12);
		//分页查询
		$infoList = D('Information')->where($where)->order('modify_time desc')->limit($page->firstRow,$page->listRows)->select();
		$type = session('uid').'/'.session('uname');
		$type = encryption($type);
		// 模板赋值
		if(IS_AJAX){
			$this->assign('type', $type);
			$this->assign('infoList', $infoList);
			$this->assign('page', $page->show());
			$html = $this->fetch('ShopManage/infoListAjaxPage');
			$this->ajaxReturn($html);
		}
		$this->assign('type', $type);
		$this->assign('infoList', $infoList);
		// 赋值分页输出
		$this->assign('page', $page->show()); 
		$this->display();
	}

	/**
	 * [delInfos 店铺信息列表删除]
	 * @return [type] [description]
	 */
	public function delInfos(){
		if(!IS_AJAX){
            E('页面不存在');
        }
       $msg = D('Information')->infoListDel();
       $this->ajaxReturn($msg);
	}

	/**
	 * [searchInfos 店铺信息列表查询]
	 * @return [type] [description]
	 */
	public function searchInfos(){
		if(!IS_AJAX){
            E('页面不存在');
        }
		$type = I('post.type',0,'intval');
		$title = I('post.title');
		$types = session('uid').'/'.session('uname');
		$types = encryption($types);
		//消息发布者身份1表示商家，0表示管理员
		$publishType = 1;
		if($type == 0 && empty($title)){
			$msg = '查询条件不能为空！';
		}
		if($type && empty($title)){
			$where = array('type' => $type);
		}
		if($type == 0 && !empty($title)){
			$where = array('title' => array('like',"%".$title."%"));
		}
		if($type && !empty($title)){
			$where = array('type' => $type,'title' => array('like',"%".$title."%"));
		}
		$where['publisherId'] = session('uid');
		$where['publishType'] = $publishType;
		$where['is_show'] = 1;
		//获取查询数量
		$count  = D('Information')->infoListNum($where);
		$page = getpage($count,12);
		$list = D('Information')->where($where)->limit($page->firstRow,$page->listRows)->select();
		//模板赋值
		$this->assign('type', $types);
		$this->assign('infoList',$list);
		$this->assign('page', $page->show());
		$msg= $this->fetch('ShopManage/infoListAjaxPage');
		//ajax返回结果	
		$this->ajaxReturn($msg);
	}

	/**
	 * [setting 店铺设置]
	 * @return [type] [description]
	 */
	public function setting(){
		//根据商家ID查找店铺ID
		$uid = session('uid');
		$shopId = D('Shop')->getShopById($uid);
		//获取广告图片列表
		$adsList = D('ShopScollimg')->getAllById($shopId);
		$this->assign('adsList' ,$adsList);
		$this->display();
	}

	/**
	 * [settingSave 店铺设置保存]
	 * @return [type] [description]
	 */
	public function settingSave(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('ShopScollimg')->saveAdsImgURL();
		$this ->ajaxReturn($msg);
	}

	/**
	 * [adsImgUpload 店铺首页广告图片上传]
	 * @return [type] [description]
	 */
	public function adsImgUpload(){
		if(!IS_POST){
			E('页面不存在！');
		}
		$msg = mulitImgsLoad(C('UPLOAD_ADS'));
		$this ->ajaxReturn($msg);
	}

	/**
	 * [adsImgDel 商品图册上传成功后删除前端显示指定图片]
	 * @return [type] [description]
	 */
	public function adsImgDel(){
		if(!IS_POST){
			E('页面不存在！');
		}
		$type = I('post.type',0,'intval');
		if(!$type){
			$url = I('post.img_url');
			@unlink($url);
		}
		else{
			$id = I('post.id',0,'intval');
			$res = D('ShopScollimg')->getAdsImgUrlById($id);
			if(!empty($res)){
				@unlink($res['imgurl']);
			}
		}
		//删除goods下的空目录
		$dir = C('UPLOAD_ADS')['rootPath'];
		delEmptyDir($dir);
		$msg['status'] = 1;
		$this->ajaxReturn($msg);
	} 
}