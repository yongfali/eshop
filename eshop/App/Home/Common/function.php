<?php
/**
*eshop home模块公共方法
*/
	/**
	 * [检查注册账号合法性]
	 * [长度为4-20的字符串且不能以数字开头]
	 * @param  $name [账号名称]
	 * @return Boolean
	 */
	function checkName($name){
		$reg = '/^[\x00-\xffa-zA-Z][\x00-\xffa-zA-Z0-9_]{4,20}$/';
		if(!preg_match($reg, $name)){
			return false;
		}
		else{
			return true;
		}
	}

	/**
	 * [检查注册密码合法性]
	 * [以字母开头且长度为6-36的字符串]
	 * @param  $password [字符串密码]
	 * @return Boolean
	 */
	function checkPwd($password){
		$reg = '/^[a-zA-Z][a-zA-Z0-9\w]{5,36}$/';
		if(!preg_match($reg, $password)){
			return false;
		}
		else{
			return true;
		}
	}

	/**
	 * [检查真实姓名的合法性]
	 * @param  $trueName [真实姓名]
	 * @return Boolean
	 */
	function checkTrueName($trueName){
		$reg = '/^[\x00-\xffa-zA-Z\.]{2,25}$/';
		if(preg_match($reg, $trueName)){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * [检查身份证号的合法性]
	 * @param  $carName [输入的身份证号]
	 * @return Boolean
	 */
	function checkCarNum($carName){
		$reg = '/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/';
		if(preg_match($reg, $carName)){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * [检查qq号的合法性]
	 * @param  $qq [输入的QQ账号]
	 * @return Boolean
	 */
	function checkQQ($qq){
		$reg = '/^\d{5,15}$/';
		if(preg_match($reg, $qq)){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * [检查联系方式证方法包括固定电话和移动号码的合法性]
	 * @param   $tel [输入的联系方式]
	 * @return Boolean
	 */
	function checkTel($tel){
		$reg = '/^((0\d{2,3}-\d{7,8})|(1[3584]\d{9}))$/';
		if(preg_match($reg, $tel)){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * [checkExpressNumber 检测快递单编号的合法性后期还需完善]
	 * @param  [type] $expressNumber [快递单编号]
	 * @return [type]                [description]
	 */
	function checkExpressNumber($expressNumber){
		$reg = '/^[1-9][0-9]{11}$/';
		if(preg_match($reg, $expressNumber)){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * [checkGoodName 检查商品名是否符合要求]
	 * @param  [type] $goodName [description]
	 * @return [type]           [description]
	 */
	function checkGoodName($goodName){
		$reg = '/^[\x00-\xff5][\x00-\xff5a-zA-Z0-9\.\-]{1,}$/';
		if(preg_match($reg, $goodName)){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * [单文件上传处理]
	 * @param   $config [文件上传基本配置]
	 * @param   $file   [文件内容]
	 * @return  $thumb_img   [生成的缩略图的路径]
	 */
	function uploadImg($config,$file){
		// 实例化Upload对象
		$upload = new \Think\Upload($config);
		// 文件上传
		$info = $upload->uploadOne($file);
		if(!$info){
			$msg['status'] = 0;
			$msg['content'] = '文件上传失败请重试！';
		}
		else{
			//拼接图片路径
			$imgURL = $config['rootPath'].$info['savepath'].$info['savename'];
			//生成缩略图并删除原图片
			$image = new \Think\Image();
			//打开原图
			$image->open($imgURL);
			// 生成一个等比缩放大小150*150的缩略图
			$thumb_img = $config['rootPath'].$info['savepath'].'thumb_'.$info['savename'];
			$image->thumb(150, 150,\Think\Image::IMAGE_THUMB_SCALE)->save($thumb_img);
			//删除原图
			@unlink($imgURL);
		}
		return $thumb_img;
	}

	/**
	 * [getShopCart 店铺菜单的获取]
	 * @param  $shopId [店铺ID序列号]
	 * @return $fmenu  [对应店铺的二级菜单树]
	 */
	function getShopCart($shopId){
		//根据店铺ID查找对应店铺的一级菜单
		$fmenu = D('ShopFirstMenu')->getAllCart($shopId);
		if(!empty($fmenu)){
			foreach ($fmenu as $key => $value) {
				$ids[]=$value['id'];
			}
			//查找对应二级菜单以查找的一级菜单序列号作为查询条件在对应ID范围内的都为其二级菜单
			$map['pid'] = array('in',implode(',',$ids));
			$map['is_show']=1;
			$smenu = M('shop_secondmenu')->where($map)->field('pid,id,sname')->select();
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
					$fmenu[$key]['childNum'] = array_key_exists($value['id'],$temp)?count($temp[$value['id']]):0;;
				}
			}
		}
		return $fmenu;
	}

	/**
	 * [goodsHistory 最近浏览的商品记录保存]
	 * @param  $goodId [传入的商品ID]
	 * @param  integer $num    [存的浏览记录条数，默认为5条]
	 * @return 
	 */
	function goodsHistory($goodId,$num=5){
		if(isset($_COOKIE['goods_history']) && !empty($_COOKIE['goods_history'])){
			$ids = explode(',', $_COOKIE['goods_history']);
			// 当前ID插入数组的头部
			array_unshift($ids, $goodId);
			//去除重复的商品ID
			$ids = array_unique($ids);
			// 判断是否超过历史记录数量，若超过则数组尾部数据依次弹出
			if(count($ids) > $num){
				array_pop($ids);
			}
			//cookie保存30天
			cookie('goods_history', implode(',', $ids),array('expire'=>3600*24*30,'path'=>'/'));
		}
		else{
			cookie('goods_history', $goodId,array('expire'=>3600*24*30,'path'=>'/'));
		}
	}

	/**
	 * [checkCollection 判断商品或店铺是否已被收藏]
	 * @param  $targetId [判断对象的ID序列号]
	 * @param  $type     [收藏对象的类型0表示店铺类型，1表示商品类型]
	 * @return $sign     [是否已被收藏]
	 */
	function checkCollection($targetId,$type){
		// 标记是否被收藏，默认为0表示没有被收藏
		$sign = 0;
		//判断用户是否登录若登录才判断该商品或店铺是否被其收藏
		if(isset($_SESSION['uid']) && session('type') === 0){
			$where = array('targetId' => $targetId, 'type' => $type, 'userId' => session('uid'));
			$res = D('Collection')->where($where)->field('id')->find();
			$sign = empty($res) ? 0 : 1;
		}
		return $sign;
	}

	/**
	 * [cartAdd 购物车cookie添加]
	 * @param  $goodId   [商品ID序列号]
	 * @param  integer $num      [商品数量默认为1]
	 * @param  array   $goodInfo [商品其他信息默认为空数组]
	 * @return [type]            [description]
	 */
	function cartAdd($goodId,$num=1,$goodInfo = array()){
		$data = readCart();
		// 当购物车中没有商品记录时
		if (!$data) {
			$data = array (
				$goodId => array (
					'goodid' => $goodId,
					'mount' => $num,
					'name' => $goodInfo['name'],
					'shopprice' => $goodInfo['shopprice'],
					'good_log' => $goodInfo['good_log']
					) 
				);
		} 
		else {
			// 当购物车中已存在所要添加的商品时,只进行数量更改操作
			if (isset($data[$goodId])){
				$data[$goodId]['mount'] += $num;
			} 
			else{
				$data [$goodId] = array (
					'goodid' => $goodId,
					'mount' => $num,
					'name' => $goodInfo['name'],
					'shopprice' => $goodInfo['shopprice'],
					'good_log' => $goodInfo['good_log']
					);
			}
		}
		//设置cookie保存30天
		cookie('good_cart',serialize($data),array('expire'=>3600*24*30,'path'=>'/'));
	}

	/**
	 * [readCart 购物车COOKIE数据读取]
	 * @return [type] [description]
	 */
	function readCart(){
		$data = unserialize($_COOKIE['good_cart']);
		if(!$data){
			return false;
		}
		else{
			return $data;
		}
	}

	/**
	 * [getCartTotalPrice 获取COOKIE保存的购物车商品总价格]
	 * @return $totalPrice [购物车商品总价格]
	 */
	function getCartTotalPrice() {
		$data = readCart ();
		$totalPrice = 0;
			// 当购物车中有商品记录时
		if ($data) {
			foreach ($data as $key => $value) {
				$totalPrice += $value['mount']*$value['shopprice'];
			}
		}
		return $totalPrice;
	}

	/**
	 * [delete 购物车商品删除COOKIE]
	 * @param  $goodId [商品ID序列号]
	 * @return boolean
	 */
	function delete($goodId) {
		$data = readCart();
		if(!$data){
			return true;
		}
		if(isset($data[$goodId])){
			unset($data[$goodId]);
			cookie('good_cart',serialize($data),array('expire'=>3600*24*30,'path'=>'/'));
		}
		return true;
	}

	/**
	 * [changeCartItemNum COOKIE购物车中商品数量变化]
	 * @param  $goodId [购物车商品ID]
	 * @param  $num    [对应商品新的数量]
	 * @return         [返回新的COOKIE值]
	 */
	function changeCartItemNum($goodId,$num){
		$data = readCart();
		if(!$data){
			return true;
		}
		if(isset($data[$goodId])){
			$data[$goodId]['mount'] = $num;
			cookie('good_cart',serialize($data),array('expire'=>3600*24*30,'path'=>'/'));
		}
		return true;
	}
	
	/**
	 * [cartsMove COOKIE中数据迁移]
	 * [若用户登录则把购物车COOKIE中存放的数据转移到数据库永久保存]
	 * [若数据库中有该商品则修改数量，没有则新插入一条记录]
	 * [全部执行成功后购物车COOKIE清空]
	 */
	function cartsMove(){
		$data = readCart();
		if(!data){
			return false;
		}
		else{ 
			foreach ($data as $key => $val) {
				//购物车数据迁移数据库
				D('Cart')->checkCart($val['goodid'],$val['mount'],1);
			}
			//删除COOKIE['good_cart']
			cookie('good_cart',null);
		}
	}

	/**
	 * [getCartItemPrice 获取购物车单件商品的总价格]
	 * @param  $goodId [单件商品的ID序列号]
	 * @param  $data   [购物车中的总数据]
	 * @return [float]         [单件商品的总价格保留两位小数]
	 */
	function getCartItemPrice($goodId,$data){
		foreach ($data as $key => $val) {
			if($val['goodid'] === $goodId){
				//sprintf保留两位小数
				return sprintf("%.2f",$val['mount']*$val['shopprice']);
			}
		}
	}

	/**
	 * [formatAddr 格式化用户收货地址]
	 * @param  [type]  $addr [地址]
	 * @param  integer $type [格式化类型默认为1表示不再拼接只返回数组,0表示重新拼接]
	 * @return [type]        [description]
	 */
	function formatAddr($addr,$type=1){
		$newAddr = explode('|', $addr);
		if(!$type){
			$newAddr = implode('', $newAddr);
		}
		return $newAddr;
	}

	/**
	 * [getShopScoreById 店铺评分获取]
	 * @param  [type] $shopId [店铺ID]
	 * @param  [type] $type   [统计平均分的字段默认为商品评分]
	 * @return [type]         [description]
	 */
	function getShopScoreById($shopId,$type=1){
		return sprintf("%.1f",D('Goodcomment')->shopScoreAverage($shopId,$type));
	}

	/**
	 * [hiddenMessage 隐藏敏感信息中间部分内容]
	 * @param  [type] $content [要实行影藏的内容]
	 * @return [type]          [description]
	 */
	function hiddenMessage($content){
		//检测是否为邮箱地址strpos()函数查找字符串在另一字符串中第一次出现的位置
		if(strpos($content, '@')){ 
			$email_array = explode("@", $content); 
			//邮箱前缀 
       		$prevfix = (strlen($email_array[0]) < 4) ? "" : substr($content, 0, 3); 
        	$count = 0; 
        	$content = preg_replace('/([\d\w+_-]{0,100})@/', '***@', $content, -1, $count); 
        	$rs = $prevfix . $content; 
    	} 
    	else{ 
    		$pattern = '/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i'; 
    		if (preg_match($pattern, $content)) { 
    			// substr_replace($name,'****',3,4);
            	$rs = preg_replace($pattern, '$1****$2', $content);  
        	} 
        	else{ 
        		$rs = substr($content, 0, 3) . "***" . substr($content, -1); 
        	} 
    	} 
    	return $rs; 
	}

	
