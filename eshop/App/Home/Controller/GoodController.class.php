<?php
/**
*商品控制器
*/	
namespace Home\Controller;
use Think\Controller;
class GoodController extends ShoperCommonController{

	/**
	 * [add 新增商品页显示]
	 */
	public function add(){
		//获取全网一级分类
		$list = D('FirstMenu')->getAllCart();
		//根据商家ID查找店铺ID
		$uid = session('uid');
		$shopId = D('Shop')->getShopById($uid);
		//获取店铺一级分类
		$list1 = D('ShopFirstMenu')->getAllCart($shopId);
		//获取商家注册时间
		$time =  D('Shoper')->getRegTime($uid);
		//用户注册时间+注册ID+随机8位数拼接成商品编码
		$goodNum = $time[0]['create_time'].$uid.get_random(4);
		//获取商品属性标签
		$Goodlable = D('Goodlable')->getGoodLableById();
		$this->assign('goodNum',$goodNum);
		$this->assign('list',$list);
		$this->assign('list1',$list1);
		$this->assign('Goodlable',$Goodlable);
		$this->display();
	}

	/**
	 * [goodsSave 新增商品信息保存]
	 * @return [type] [description]
	 */
	public function goodsSave(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$shopId = D('Shop') ->getShopById(session('uid'));
		//判断是否上传了图片
		if(!empty($_FILES['photo']['name'])){
			// 实例化Upload对象
			$upload = new \Think\Upload(C('UPLOAD_Logo'));
			// 文件上传
			$info = $upload->uploadOne($_FILES['photo']);
			if(!$info){
				$msg['status'] = 0;
				$msg['content'] = '文件上传失败请重试！';
			}
			// 文件上传成功操作
			else{
				//拼接图片路径
				$good_log = C('UPLOAD_Logo')['rootPath'].$info['savepath'].$info['savename'];
				//生成缩略图并删除原图片
				$image = new \Think\Image();
				//打开原图
				$image->open($good_log);
				// 生成一个缩放后填充大小150*150的缩略图
				$thumb_img = C('UPLOAD_Logo')['rootPath'].$info['savepath'].'thumb_'.$info['savename'];
				$image->thumb(150, 150,\Think\Image::IMAGE_THUMB_FILLED)->save($thumb_img);
				//删除原图
				@unlink($good_log);
				$_POST['good_log'] = $thumb_img;
				//开启事务,进行存储操作，若操作失败进行数据回滚
				$goodInfo = D('Good');
				$goodNav = D('Goodnav');
				$goodServive = D('GoodService');
				$Goodlable = D('Goodinfo');
				$goodInfo->startTrans();
				$goodNav->startTrans();
				$Goodlable->startTrans();
				if($goodInfo->create()){
					$id = $goodInfo->add();
					if($id){
						//当上传图册相片时
						if(I('post.type')){
							$GoodImg = D('Goodimg');
							$GoodImg -> startTrans();
							$result = $goodNav->saveGoodCart($id,$shopId);
							$result1 = $goodServive->saveGoodService($id);
							$result2 = $Goodlable->saveLableContent($id);
							$result3 = $GoodImg->saveImageUrl($id);
							//判断是否操作成功成功则提交事务
							if($result && $result1 && $result2 && $result3){
								$goodInfo->commit();
								$goodNav->commit();
								$goodServive->commit();
								$Goodlable->commit();
								$GoodImg->commit();
								$msg['status'] = 1;
								$msg['content'] = '添加成功';
							}
							//只要有一处提交失败则回滚
							else{
								$goodInfo->rollback();
								$goodNav->rollback();
								$goodServive->rollback();
								$Goodlable->rollback();
								$GoodImg->rollback();
								@unlink($thumb_img);
								$msg['status'] = 0;
								$msg['content'] = '添加失败';
							}
						}
						//当图册没有上传时
						else{
							$result = $goodNav->saveGoodCart($id,$shopId);
							$result1 = $goodServive->saveGoodService($id);
							$result2 = $Goodlable->saveLableContent($id);
							//判断是否操作成功成功则提交事务
							if($result && $result1 && $result2){
								$goodInfo->commit();
								$goodNav->commit();
								$goodServive->commit();
								$Goodlable->commit();
								$msg['status'] = 1;
								$msg['content'] = '添加成功';
							}
							//只要有一处提交失败则回滚
							else{
								$goodInfo->rollback();
								$goodNav->rollback();
								$goodServive->rollback();
								$Goodlable->rollback();
								@unlink($thumb_img);
								$msg['status'] = 0;
								$msg['content'] = '添加失败';
							}
						}
					}
					else{
						@unlink($thumb_img);
						$msg['status'] = 0;
						$msg['content'] = '添加失败';
					}
				}
				else{
					@unlink($thumb_img);
					$msg['status'] = 0;
					$msg['content'] = $goodInfo->getError();
				}
			}
		}
		else{
			$msg['status'] = 0;
			$msg['content'] ='请上传商品Logo'; 
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [edit 商品信息编辑页面显示]
	 * @return [type] [description]
	 */
	public function edit(){
		//获取全网一级分类
		$list = D('FirstMenu')->getAllCart();
		//根据商家ID查找店铺ID
		$shopId = D('Shop')->getShopById(session('uid'));
		//获取店铺一级分类
		$list1 = D('ShopFirstMenu')->getAllCart($shopId);
		$goodId = I('get.id');
		$where = array('id' => $goodId);
		//获取商品基本信息
		$goodInfo = D('Good')->where($where)->find();
		if ($goodInfo) {
			//获得商品导航标签信息
			$navName = D('Goodnav')->getNavsById($goodId);
			// 获取商品图册
			$goodImgs = D('Good')->alias('g')->field('i.id,i.img')->join('eshop_goodimg as i on g.id = i.goodId')->where("g.id = $goodId")->select();
			//获取商品标签详情
			$goodLable = D('Goodinfo')->alias('g')->field('g.lableId,name,lableContent')->join('eshop_goodlable as a on g.lableId = a.lableId')->where(array('goodId' => $goodId))->select();
			if(empty($goodLable)){
				$goodLable = D('Goodlable')->getGoodLableById();
			}
			//获取商品服务
			$goodService = D('GoodService')->getServerContentById($goodId);
			//模板赋值
			$this->assign('list',$list);
			$this->assign('list1',$list1);
			$this->assign('goodInfo',$goodInfo);
			$this->assign('navName',$navName);
			$this->assign('goodImgs',$goodImgs);
			$this->assign('goodLable',$goodLable);
			$this->assign('goodService',$goodService);
			$this->display();	
		}
		else{
			E('页面不存在！');
		}
	}

	/**
	 * [eidtSave 商品编辑保存]
	 * @return [type] [description]
	 */
	public function eidtSave(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$goodId = I('post.goodId',0,'intval');
		//error为0表示有文件上传
		if($_FILES['photo']['error'] == 0){
			$imgURl = uploadImg(C('UPLOAD_Logo'),$_FILES['photo']);
			$_POST['good_log'] = $imgURl;
			//获取原来的Logo路径
			$logo = D('Good')->getLogoURL($goodId);
		}
		//开启事务，若某一部分更新失败则回滚
		$goodInfo = D('Good');
		$goodNav = D('Goodnav');
		$goodServive = D('GoodService');
		$Goodlable = D('Goodinfo');
		$goodInfo -> startTrans();
		$goodNav -> startTrans();
		$goodServive -> startTrans();
		$Goodlable ->startTrans();
		if($goodInfo->create()){
			$id = $goodInfo -> where(array('id' => $goodId)) -> save();
			if ($id) {
				$result = $goodNav->modifyGoodCart($goodId);
				$result1 = $goodServive->modifyGoodService($goodId);
				$Goodlable->updataLableContent($goodId);
				//当有上传图册相片时
				if(I('post.type')){
					$GoodImg = D('Goodimg');
					$GoodImg -> startTrans();
					$result3 = $GoodImg->saveImageUrl($goodId);
					//判断是否操作成功成功则提交事务
					if($result && $result1 && $result3){
					    $goodInfo->commit();
						$goodNav->commit();
						$goodServive->commit();
						$Goodlable->commit();
						$GoodImg->commit();
						@unlink($logo);
						$msg['status'] = 1;
						$msg['content'] = '编辑成功';
					}
					//只要有一处提交失败则回滚
					else{
						$goodInfo->rollback();
						$goodNav->rollback();
						$goodServive->rollback();
						$Goodlable->rollback();
						$GoodImg->rollback();
						@unlink($imgURl);
						$msg['status'] = 0;
						$msg['content'] = '编辑失败';
					}
				}
				//判断是否操作成功成功则提交事务
				if($result && $result1){
					$goodInfo->commit();
				 	$goodNav->commit();
					$goodServive->commit();
					$Goodlable->commit();
					@unlink($logo);
					$msg['status'] = 1;
					$msg['content'] = '编辑成功';
				}
				//只要有一处提交失败则回滚
				else{
					$goodInfo->rollback();
					$goodNav->rollback();
					$goodServive->rollback();
					$Goodlable->rollback();
					@unlink($imgURl);
					$msg['status'] = 0;
					$msg['content'] = '编辑失败';
				}
			}
			else{
				@unlink($imgURl);
				$msg['status'] = 0;
				$msg['content'] = '编辑失败！';
			}
		}
		else{
			@unlink($imgURl);
			$msg['status'] = 0;
			$msg['content'] = $goodInfo->getError();
		}
		//删除商品Logo下的空目录
		$dir = C('UPLOAD_Logo')['rootPath'];
		delEmptyDir($dir);
		$this->ajaxReturn($msg);
	}

	/**
	 * [goodImg 商品图册上传处理]
	 * @return [type] [description]
	 */
	public function goodImg(){
		if(!IS_POST){
			E('页面不存在！');
		}
		$upload = new \Think\Upload(C('UPLOAD_SHOPS'));// 实例化上传类
		$info = $upload->upload();
		if(!$info) {
			$msg['status'] = 0;
			$msg['content'] = $info ->getErrorMsg();
		}else{
			$pathArr = "";
			$thumbArr = "";
			foreach($info as $file){
				$pathArr = C('UPLOAD_SHOPS')['rootPath']. $file['savepath']. $file['savename'];
				$image = new \Think\Image();
				$image->open($pathArr);
				// 生成一个缩放后填充大小150*150的缩略图
				$thumb_img = C('UPLOAD_SHOPS')['rootPath'].$file['savepath'].'thumb150_'.$file['savename'];
				$image->thumb(150, 150,\Think\Image::IMAGE_THUMB_FILLED)->save($thumb_img);
				$thumbArr = $thumb_img;
			}
			$msg['status'] = 1;
			$msg['content'] = $pathArr;
			$msg['thumb'] = $thumbArr;
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [goodImgDel 商品图册上传成功后删除前端显示指定图片]
	 * @return [type] [description]
	 */
	public function goodImgDel(){
		if(!IS_POST){
			E('页面不存在！');
		}
		$type = I('post.type',0,'intval');
		if(!$type){
			$url = I('post.img_url');
			$thumbURl = I('post.thumb_url');
			@unlink($url);
			@unlink($thumbURl);
		}
		else{
			$id = I('post.id',0,'intval');
			$res = D('Goodimg')->getImgUrlById($id);
			if(!empty($res)){
				@unlink($res['img']);
				@unlink($res['thumb_img']);
			}
		}
		//删除goods下的空目录
		$dir = C('UPLOAD_SHOPS')['rootPath'];
		delEmptyDir($dir);
		$msg['status'] = 1;
		$this->ajaxReturn($msg);
	} 

	/**
	 * [getWebCart 全网分类的获取]
	 * @return [type] [description]
	 */
	public function getWebCart(){
		if(!IS_POST){
			E('页面不存在！');
		}
		$type = I('post.type');
		$pid = I('post.id',0,'intval');
		//当前选择一级菜单通过ID号查找所有对应的二级菜单
		if(!$type){
			$list = D('SecondMenu')->getCartById($pid);
			if($list){
				$msg['status'] = 1;
				$msg['content'] = $list;
			}
			else{
				$msg['status'] = 0;
				$msg['content'] = '请求出错，请稍后重试...';
			}
		}
		else{
			$list = D('ThirdMenu')->getCartById($pid);
			if($list){
				$msg['status'] = 1;
				$msg['content'] = $list;
			}
			else{
				$msg['status'] = 0;
				$msg['content'] = '请求出错，请稍后重试...';
			}
		}
		$this->ajaxReturn($msg,'JSON');
	}

	/**
	 * [getShopCart 店铺分类的获取]
	 * @return [type] [description]
	 */
	public function getShopCart(){
		if(!IS_POST){
			E('页面不存在！');
		}
		$pid = I('post.id',0,'intval');
		//根据当前一级菜单序列号查找对应的二级菜单
		$list = D('ShopSecondMenu')->getAllCart($pid);
		if($list){
			$msg['status'] = 1;
			$msg['content'] = $list;
		}
		else{
			$msg['status'] = 0;
			$msg['content'] = '请求出错，请稍后重试...';
		}
		$this->ajaxReturn($msg);
	}

	/**
	 * [audit 待审核商品展示页面]
	 * @return [type] [description]
	 */
	public function audit(){
		//根据商家ID查找店铺ID
		$shopId = D('Shop')->getShopById(session('uid'));
		//获取店铺一级分类
		$list1 = D('ShopFirstMenu')->getAllCart($shopId);
		//获取待审核商品总条数
		$where = array('shopId' => $shopId, 'is_exam' => 0, 'status' => 1);
		$count = D('Good')->goodsSearch($where);
		//设置每页现实的条数
		$pagelimit = 10 ;
		$page = getpage($count,$pagelimit);
		//采用内连接根据店铺ID查找对应的待审核商品序列号集合
		$auditList = D('Good')->field('eshop_good.*')->join('eshop_goodnav on eshop_goodnav.goodId = eshop_good.id')->where($where)->order('time desc')->limit($page->firstRow, $page->listRows)->select();	
		if (IS_AJAX) {
			$this->assign('list',$auditList);
			$this->assign('page', $page->show());
			$html = $this->fetch('Good/auditAjaxPage');
			$this->ajaxReturn($html);
		}
		$this->assign('list1',$list1);
		$this->assign('list',$auditList);
		// 赋值分页输出
		$this->assign('page', $page->show()); 
		$this->display();
	}

	/**
	 * [illegal 违规商品页面展示]
	 * @return [type] [description]
	 */
	public function illegal(){
		//根据商家ID查找店铺ID
		$shopId = D('Shop')->getShopById(session('uid'));
		//获取店铺一级分类
		$list1 = D('ShopFirstMenu')->getAllCart($shopId);
		//获取违规商品总条数
		$where = array('shopId' => $shopId, 'is_legal' => 0);
		$count = D('Good')->goodsSearch($where);
		//设置每页现实的条数
		$pagelimit = 10 ;
		$page = getpage($count,$pagelimit);
		//采用内连接根据店铺ID查找对应的违规商品序列号集合
		$illegalList = D('Good')->alias('g')->field('g.id,goodnumber,name,ilegal_reason,good_log,modify_recenet')->join('eshop_goodnav on eshop_goodnav.goodId = g.id')->where($where)->order('modify_recenet desc')->limit($page->firstRow, $page->listRows)->select();	
		if (IS_AJAX) {
			$this->assign('list',$illegalList);
			$this->assign('page', $page->show()); 
			$html = $this->fetch('Good/illegalAjaxPage');
			$this->ajaxReturn($html);
		}
		//模板赋值
		$this->assign('list1',$list1);
		$this->assign('list',$illegalList);
		$this->assign('page', $page->show()); 
		$this->display();
	}

	/**
	 * [stock 库存预警页面显示]
	 * @return [type] [description]
	 */
	public function stock(){
		//根据商家ID查找店铺ID
		$shopId = D('Shop')->getShopById(session('uid'));
		$where = array('shopId' => $shopId);
		//获取店铺一级分类
		$list1 = D('ShopFirstMenu')->getAllCart($shopId);
		$count = D('Good')->getStockWarning($where);
		//设置每页现实的条数
		$page = getpage($count,10);
		//查找对应的预警商品序列号集合
		$stockList = D('Good')->alias('g')->field('g.id,g.name,g.goodnumber,g.stock,g.stock_warning,g.good_log')->join('eshop_goodnav as n on g.id = n.goodId and g.stock<=g.stock_warning and g.stock_warning>=0')->where($where)->limit($page->firstRow, $page->listRows)->select();
		if (IS_AJAX) {
			$this->assign('list',$stockList);
			$this->assign('page', $page->show()); 
			$html = $this->fetch('Good/stockAjaxPage');
			$this->ajaxReturn($html);
		}
		//模板赋值
		$this->assign('list1',$list1);
		$this->assign('list',$stockList);
		$this->assign('page', $page->show()); 
		$this->display();
	}

	/**
	 * [onsale 出售中商品页面展示]
	 * @return [type] [description]
	 */
	public function onsale(){
		//根据商家ID查找店铺ID
		$shopId = D('Shop')->getShopById(session('uid'));
		//获取店铺一级分类
		$list1 = D('ShopFirstMenu')->getAllCart($shopId);
		//获取出售中商品总条数
		$where = array('shopId' => $shopId, 'status' => 1, 'is_legal' => 1,'is_exam' =>1,'is_forbid'=>0);
		$count = D('Good')->goodsSearch($where);
		$page = getpage($count,10);
		//采用内连接根据店铺ID查找对应的违规商品序列号集合
		$saleList = D('Good')->alias('g')->field('g.*')->join('eshop_goodnav on eshop_goodnav.goodId = g.id')->where($where)->order('modify_recenet desc')->limit($page->firstRow, $page->listRows)->select();	
		if (IS_AJAX) {
			$this->assign('list',$saleList);
			$this->assign('page', $page->show()); 
			$html = $this->fetch('Good/auditAjaxPage');
			$this->ajaxReturn($html);
		}
		//模板赋值
		$this->assign('list1',$list1);
		$this->assign('list',$saleList);
		$this->assign('page', $page->show()); 
		$this->display();
	}

	/**
	 * [store 库存商品页面展示]
	 * @return [type] [description]
	 */
	public function store(){
		//根据商家ID查找店铺ID
		$shopId = D('Shop')->getShopById(session('uid'));
		//获取店铺一级分类
		$list1 = D('ShopFirstMenu')->getAllCart($shopId);
		//获取出售中商品总条数
		$where = array('shopId' => $shopId, 'status' => 0);
		$count = D('Good')->goodsSearch($where);
		$page = getpage($count,10);
		//采用内连接根据店铺ID查找对应的违规商品序列号集合
		$saleList = D('Good')->alias('g')->field('g.*')->join('eshop_goodnav on eshop_goodnav.goodId = g.id')->where($where)->order('modify_recenet desc')->limit($page->firstRow, $page->listRows)->select();	
		if (IS_AJAX) {
			$this->assign('list',$saleList);
			$this->assign('page', $page->show()); 
			$html = $this->fetch('Good/auditAjaxPage');
			$this->ajaxReturn($html);
		}
		//模板赋值
		$this->assign('list1',$list1);
		$this->assign('list',$saleList);
		$this->assign('page', $page->show()); 
		$this->display();
	}

	/**
	 * [changeGoodStock 商品库存编辑处理]
	 * @return [type] [description]
	 */
	public function changeGoodStock(){
		if(!IS_AJAX){
			E('页面不存在！');
		}
		$msg = D('Good')->changeStock();
		$this->ajaxReturn($msg);
	}

	/**
	 * [goodDel 商品删除操作（批量操作和单个操作）]
	 * @return [type] [description]
	 */
	public function goodDel(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$this->ajaxReturn(D('Good')->goodDel());
	}

	/**
	 * [changeStatus 商品下架处理]
	 * @return [type] [description]
	 */
	public function changeStatus(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$msg = D('good')->chanageGoodStatus();
		$this->ajaxReturn($msg);
	} 

	/**
	 * [changePro 商品属性变更处理]
	 * @return [type] [description]
	 */
	public function changePro(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$this->ajaxReturn(D('Good') ->chanageGoodPros());
	}

	/**
	 * [goodsSearch 商家中心商品搜索处理]
	 * @return [type] [description]
	 */
	public function goodsSearch(){
		if (!IS_AJAX) {
			E('页面不存在！');
		}
		$cat1 = I('post.cat1','0','intval');
		$cat2 = I('post.cat2','0','intval');
		$goodNames = I('post.goodsName');
		//根据商家ID查找店铺ID
		$shopId = D('Shop')->getShopById(session('uid'));
		if(!$cat1 && !$cat2 && empty($goodNames) ){
			$msg = '查询条件不能为空！';
			$this->ajaxReturn($msg); 
		}
		/**
		*开始查询条件组合分5中组合情况
		*/
		if($cat1 && $cat2 && !empty($goodNames)){
			$where = array('s_fid' => $cat1,'s_sid' => $cat2,'name' => array('like',"%".$goodNames."%"));
		}
		if($cat1 && $cat2 && empty($goodNames)){
			$where = array('s_fid' => $cat1,'s_sid' => $cat2);
		}
		if($cat1 && !$cat2 && !empty($goodNames)){
			$where = array('s_fid' => $cat1,'name' => array('like',"%".$goodNames."%"));
		}
		if($cat1 && !$cat2 && empty($goodNames)){
			$where = array('s_fid' => $cat1);
		}
		if(!$cat1 && !$cat2 && !empty($goodNames)){
			$where = array('name' => array('like',"%".$goodNames."%"));
		}
		$where['is_forbid'] = 0; 
		$where['status'] = 1;
		$where['shopId'] = $shopId;
		//查询提交类型判断
		switch (I('post.type')) {
			//待审核商品页面提交查询
			case 'audit':
				$where['is_exam'] = 0;
				$where['shopId'] = $shopId;
				$url = 'Good/'.'audit'.'AjaxPage';
				break;
			//违规商品页面提交查询
			case 'illegal':
				$where['is_legal'] = 0;
				$url = 'Good/'.'illegal'.'AjaxPage';
				break;
			//出售中商品页面提交查询
			case 'onsale':
				$where['is_legal'] = 1;
				$where['is_exam'] = 1;
				$url = 'Good/'.'audit'.'AjaxPage';
				break;
			//仓库中商品页面提交查询
			case 'store':
				$where['status'] = 0;
				$url = 'Good/'.'audit'.'AjaxPage';
				break;
			//仓库中商品页面提交查询
			case 'stock':
				$url = 'Good/'.'stock'.'AjaxPage';
				break;
			default:
				$msg = '查询出错了！！！';
				break;
		}
		if(I('post.type')=="stock"){
			//获取对应商品总条数
			$count = D('Good')->getStockWarning($where);
			//分页显示还有bug，因此调大页面数量避免该Bug后期修复
			$page = getpage($count,20);
			$goodList = D('Good')->alias('g')->field('g.*')->join('eshop_goodnav as n on g.id = n.goodId and g.stock<=g.stock_warning and g.stock_warning>=0')->where($where)->limit($page->firstRow, $page->listRows)->select();	
		}
		else{
			//获取对应商品总条数
			$count = D('Good')->goodsSearch($where);
			//分页显示还有bug，因此调大页面数量避免该Bug后期修复
			$page = getpage($count,20);
			$goodList = D('Good')->field('eshop_good.*')->join('eshop_goodnav on eshop_goodnav.goodId = eshop_good.id')->where($where)->order('time desc')->limit($page->firstRow, $page->listRows)->select();	
		}
		//模板赋值
		$this->assign('list',$goodList);
		$this->assign('page', $page->show());
		$html = $this->fetch($url);
		$msg = $html;
		//ajax返回结果	
		$this->ajaxReturn($msg); 
	}
}