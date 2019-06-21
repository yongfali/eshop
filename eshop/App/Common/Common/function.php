<?php
/**
* esho项目公共方法
*/
	/**
	 * [p 格式化打印数组]
	 * @param  [type] $arr [打印内容]
	 * @return [type]      [格式化输出]
	 */
	function p($arr){
		echo '<pagere>';
		var_dump($arr);
		echo '<pagere/>';
	}

	/**
	 * [create_verify 创建验证码]
	 * @param  [type] $id [指定当前验证码生成id没有此参数会导致验证码异步验证失败]
	 * @return [type]     [返回验证码实例]
	 */
	function create_verify($id){
		$verify = new \Think\Verify();
		$verify->entry($id);
	}

	/**
	 * [check_verify 校验验证码]
	 * @param  [type] $code [验证码内容]
	 * @param  string $id   [验证码对应ID]
	 * @return [boolean]       [返回校验结果]
	 */
	function check_verify($code, $id = ''){
	    $verify = new \Think\Verify();
	    return $verify->check($code, $id);
	}

	/**
	 * [encryption 异位或加密字符串]
	 * @param  [type]  $value [加密明文或密文]
	 * @param  integer $type  [类型默认为加密]
	 * @return [type]         [返回加密密文或明文]
	 */
	function encryption ($value, $type=0) {
		$key = md5(C('ENCRIPTION'));
		if (!$type) {
			return str_replace('=', '', base64_encode($value ^ $key));
		}
		$value = base64_decode($value);
		return $value ^ $key;
	}

	/**
	 * [getpage 数据分页实现]
	 * @param  [type]  $count    [数据总记录数]
	 * @param  integer $pagesize [每页数据条数]
	 * @return [type]  $page     [ 分页实例]
	 */
	function getpage($count, $pagesize = 10) {
		$page = new Think\Page($count, $pagesize);
		$page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('last', '末页');
		$page->setConfig('first', '首页');
		$page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
	    $page->lastSuffix = false;//最后一页不显示为总页数
	    return $page;
	}

	/**
	 * [get_random 随机数生成]
	 * @param  [int] $len [随机数生成长度]
	 * @return [int]      [随机数]
	 */
	function get_random($len){  
	  //range 是将10到99列成一个数组   
		$numbers = range (10,99);  
	  //shuffle 将数组顺序随即打乱   
		shuffle ($numbers);   
	  //取值起始位置随机  
		$start = mt_rand(1,10);  
	  //取从指定定位置开始的若干数  
		$result = array_slice($numbers,$start,$len);   
		$random = "";  
		for ($i=0;$i<$len;$i++){   
			$random = $random.$result[$i];  
		}   
		return $random;  
	}

	/**
	 * [is_num 判断get获得的参数ID是否为数字]
	 * @param  $id [get获得的参数ID]
	 * @return boolean 
	 */
	function is_num($id){
		$reg = '/^[1-9][0-9]*$/';
		if (!preg_match($reg, $id)) {
			E('页面不存在！');
		}
	}

	/**
	 * [delEmptyDir 删除空目录]
	 * @param  [String] $path [目录路径]
	 * @return [type]       [description]
	 */
	function delEmptyDir($path){
		//判断是否为目录
		if(is_dir($path)){
			//打开指定目录并判断
			if($dh = opendir($path)){
				//遍历文件夹
				while (($file = readdir($dh)) !== false) {
					if ($file !='.' && $file !='..') {
						//获取当前目录
						$current = $path.'/'.$file;
						//判断是否为目录
						if(is_dir($current)){
							//递归遍历子目录
							delEmptyDir($current);
							if(count(scandir($current)) == 2){
								rmdir($current);
							}
						}
					}
				}
			}
			//关闭目录
			closedir($path);
		}
	} 

	/**
	 * [get_number 指定位数的标号生成，不足指定位数的在左侧补0]
	 * @param  [type]  $num [要生成指定长度的数字]
	 * @param  integer $bit [要生成的的长度]
	 * @return [type]       [生成结果]
	 */
	function get_number($num,$bit=10){
		//获取数字的长度
		$len = strlen($num);
		if($len >= $bit){
			$rel = $num;
		}
		else{
			for ($i=$len; $i <$bit ; $i++) { 
				$zero .= "0";
			}
			$rel = 'S'.$zero.$num;
		}
		echo $rel;
	}

	/**
	 * [mulitImgsLoad 多图片上传处理]
	 * @param  [type]  $config [图片上传配置参数]
	 * @param  integer $type   [默认为0表示不生成缩略图，1表示生成缩略图]
	 * @return [type]  $msg        [处理结果信息]
	 */
	function mulitImgsLoad($config,$type=0){
		$upload = new \Think\Upload($config);// 实例化上传类
			$info = $upload->upload();
			if(!$info) {
				$msg['status'] = 0;
				$msg['content'] = $info ->getErrorMsg();
			}else{
				$pathArr = "";
				//不生成缩略图
				if(!$type){
					foreach($info as $file){
						$pathArr = $config['rootPath']. $file['savepath']. $file['savename'];
					}
				}
				//生成缩略图
				else{
					$thumbArr = "";
					foreach($info as $file){
						$pathArr = $config['rootPath']. $file['savepath']. $file['savename'];
						$image = new \Think\Image();
						$image->open($pathArr);
						// 生成一个缩放后填充大小150*150的缩略图
						$thumb_img = $config['rootPath'].$file['savepath'].'thumb150_'.$file['savename'];
						$image->thumb(150, 150,\Think\Image::IMAGE_THUMB_FILLED)->save($thumb_img);
						$thumbArr = $thumb_img;
					}
					$msg['thumb'] = $thumbArr;
				}
				$msg['status'] = 1;
				$msg['content'] = $pathArr;
			}
			return $msg;
	}

	/**
	 * [sendMail 邮件发送函数]
	 * @param  [type] $to      [目标邮箱]
	 * @param  [type] $subject [邮件主题（标题）]
	 * @param  [type] $content [邮件内容]
	 * @return [bool] true    
	 */
	function sendMail($to, $subject, $content) {
		Vendor('PHPMailer.class#smtp'); 
    	Vendor('PHPMailer.class#phpmailer');  
   		$mail = new \PHPMailer();
    	// 装配邮件服务器
	    if (C('MAIL_SMTP')) {
	    	$mail->IsSMTP();
	    }
	    $mail->Host = C('MAIL_HOST'); 
	    $mail->SMTPAuth = C('MAIL_SMTPAUTH');  
	    $mail->Username = C('MAIL_USERNAME');
	    $mail->Password = C('MAIL_PASSWORD');
	    $mail->CharSet = C('MAIL_CHARSET');
	    // 装配邮件头信息
	    $mail->From = C('MAIL_USERNAME');
	    $mail->AddAddress($to);
	    $mail->FromName = C('MAIL_FROMNAME');
	    $mail->IsHTML(C('MAIL_ISHTML'));
	    // 装配邮件正文信息
	    $mail->Subject = $subject;
	    $mail->Body = $content;
	    // 发送邮件
	    if(!$mail->Send()) {
	    	return false;
	    } 
	    else {
	    	return true;
	    }
	}