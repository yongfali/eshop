<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html">
	<title>微农后台管理系统-首页</title>
	<!-- 公共链接 -->
	<!-- 系统后台公共链接 -->
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/bootstrap3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Admin/Css/Common/common.css">
<script src="/eshop/Public/Common/Js/jquery-2.1.1.min.js"></script>
<script src="/eshop/Public/Common/bootstrap3.3.7/js/bootstrap.min.js"></script>
<script src="/eshop/Public/Common/Js/jquery.validate.js"></script>
<script src="/eshop/Public/Common/layer/layer.js"></script>
<script src="/eshop/Public/Admin/Js/Common/common.js"></script>
<script src="/eshop/Public/Admin/Js/Common/checkbox.js"></script>

	<!-- 公共链接 -->
	
	<link rel="stylesheet" type="text/css" href="/eshop/Public/Admin/Css/Index/index.css">

	 
</head>
<body>
	
		<div class="head">
			<div class="eshop-logo">
				<span>微农后台管理系统</span>
			</div>
			<div class="head_nav">
				<ul>
					<a href="<?php echo U('Home/Index/index');?>" target="_blank">
						<li class="line">商城首页</li>
					</a>
					<a href="">
						<li class="line">修改密码</li>
					</a>
					<a href="<?php echo U('Admin/Index/loginout');?>">
						<li>退出登录</li>
					</a>
				</ul>
			</div>
		</div>
	
	<div class="content-wrapper">
		<div class="left-nav">
			
				<div class="lines"></div>
				<dl class="index">
					<dt><a href="<?php echo U('Admin/Index/index');?>" style="background:#3992d0;">系统首页</a></dt>
				</dl>
				<dl class="shop-manage">
					<dt>店铺管理<img src="/eshop/Public/Admin/Icon/left/select_xl01.png"></dt>
					<a href="<?php echo U('Admin/ShopManage/autho');?>" target="_self"><dd>店铺认证</dd></a>
					<a href="<?php echo U('Admin/ShopManage/apply');?>" target="_self"><dd>开店申请</dd></a>
					<a href="#" target="_self"><dd>店铺管理</dd></a>
					<a href="#" target="_self"><dd>下架店铺</dd></a>
				</dl>
				<dl class="custom-manage">
					<dt>会员管理<img src="/eshop/Public/Admin/Icon/left/select_xl01.png"></dt>
					<a href="#" target="_self"><dd>会员等级</dd></a>
					<a href="#" target="_self"><dd>会员管理</dd></a>
					<a href="#" target="_self"><dd>账号管理</dd></a>
				</dl>
				<dl class="good-manage">
					<dt>商品管理<img src="/eshop/Public/Admin/Icon/left/select_xl01.png"></dt>
					<a href="<?php echo U('Admin/GoodManage/onsale');?>" target="_self"><dd>上架的商品</dd></a>
					<a href="<?php echo U('Admin/GoodManage/autho');?>" target="_self"><dd>待审核商品</dd></a>
					<a href="#" target="_self"><dd>违规商品</dd></a>
					<a href="#" target="_self"><dd>投诉的商品</dd></a>
				</dl>
				<dl class="order-manage">
					<dt>订单管理<img src="/eshop/Public/Admin/Icon/left/select_xl01.png"></dt>
					<a href="#" target="_self"><dd>订单列表</dd></a>
					<a href="#" target="_self"><dd>投诉订单</dd></a>
					<a href="#" target="_self"><dd>退款订单</dd></a>
				</dl>
				<dl class="artical-manage">
					<dt>文章管理<img src="/eshop/Public/Admin/Icon/left/select_xl01.png"></dt>
					<a href="<?php echo U('Admin/ArticalManage/index');?>" target="_self"><dd>商城资讯列表</dd></a>
					<a href="<?php echo U('Admin/ArticalManage/helpList');?>" target="_self"><dd>帮助中心列表</dd></a>
					<a href="<?php echo U('Admin/ArticalManage/nav');?>" target="_self"><dd>文章分类</dd></a>
					<a href="<?php echo U('Admin/ArticalManage/info');?>" target="_self"><dd>文章发表</dd></a>
				</dl>
				<dl class="syetem-manage">
					<dt>系统管理<img src="/eshop/Public/Admin/Icon/left/select_xl01.png"></dt>
					<a href="#" target="_self"><dd>职员管理</dd></a>
					<a href="#" target="_self"><dd>角色管理</dd></a>
					<a href="#" target="_self"><dd>菜单管理</dd></a>
					<a href="#" target="_self"><dd>广告管理</dd></a>
					<a href="#" target="_self"><dd>导航管理</dd></a>
					<a href="<?php echo U('Admin/SystemManage/backup');?>" target="_self"><dd>数据备份</dd></a>
				</dl>
			
			<div style="height:100px;">
			</div>
		</div>
		<div class="right-content">
			
	<div class="now-position">
		<span>首页</span>
	</div>
	<div class="login-log">
		<p>您好，<?php echo (session('adminName')); ?>，欢迎使用微农后台管理系统。 您上次登录的时间是 <?php echo (date('Y-m-d H:m:i',session('lastLoginTime'))); ?> ，IP 是 <?php echo (session('lastLoginIp')); ?></p>
	</div>
	<div class="info-table">
		<table class="table table-bordered table-hover">
			<caption><span style="display: inline-block;
				color: #0081ff;font-size: 16px;">&gt;&gt;</span>今日统计</caption>
			<tbody>
				<tr>
					<td class="col-md-3">新增会员：</td>
					<td class="col-md-3"><?php if($todayUserNum == 0): ?>0 <?php else: echo ($todayUserNum); endif; ?></td>
					<td class="col-md-3">新增商家：</td>
					<td class="col-md-3"><?php if($todayShoperNum == 0): ?>0 <?php else: echo ($todayShoperNum); endif; ?></td>
				</tr>
				<tr>
					<td>待审核商家：</td>
					<td><?php if($waitAuthoShop == 0): ?>0 <?php else: echo ($waitAuthoShop); endif; ?></td>
					<td>新增投诉：</td>
					<td><?php if($todaycomplaintOrder == 0): ?>0 <?php else: echo ($todaycomplaintOrder); endif; ?></td>
				</tr>
				<tr>
					<td>上架商品：</td>
					<td><?php if($todayGoodNum == 0): ?>0 <?php else: echo ($todayGoodNum); endif; ?>（总待审核：<?php if($waitAuthoGood == 0): ?>0 <?php else: echo ($waitAuthoGood); endif; ?>）</td>
					<td>新增订单：</td>
					<td><?php if($todayOrderNum == 0): ?>0 <?php else: echo ($todayOrderNum); endif; ?></td>
				</tr>
			</tbody>
		</table>
		<table class="table table-bordered table-hover">
			<caption><span style="display: inline-block;
				color: #0081ff;font-size: 16px;">&gt;&gt;</span>商城统计</caption>
			<tbody>
				<tr>
					<td class="col-md-3">会员总数：</td>
					<td class="col-md-3"><?php if($userNum == 0): ?>0 <?php else: echo ($userNum); endif; ?></td>
					<td class="col-md-3">商家总数：</td>
					<td class="col-md-3"><?php if($shoperNum == 0): ?>0 <?php else: echo ($shoperNum); endif; ?></td>
				</tr>
				<tr>
					<td>上架商品总数：</td>
					<td><?php if($goodNum == 0): ?>0 <?php else: echo ($goodNum); endif; ?></td>
					<td>订单总数：</td>
					<td><?php if($orderNum == 0): ?>0 <?php else: echo ($orderNum); endif; ?></td>
				</tr>
				<tr>
					<td>评价总数：</td>
					<td><?php if($commentNum == 0): ?>0 <?php else: echo ($commentNum); endif; ?></td>
					<td>投诉总数：</td>
					<td><?php if($complaintOrder == 0): ?>0 <?php else: echo ($complaintOrder); endif; ?></td>
				</tr>
			</tbody>
		</table>
		<table class="table table-bordered table-hover">
			<caption><span style="display: inline-block;
				color: #0081ff;font-size: 16px;">&gt;&gt;</span>系统信息</caption>
			<tbody>
				<tr>
					<td class="col-md-3">软件版本号：</td>
					<td class="col-md-3">1.1.0</td>
					<td class="col-md-3">授权类型：</td>
					<td class="col-md-3">未授权</td>
				</tr>
				<tr>
					<td>服务器操作系统：</td>
					<td><?php echo (PHP_OS); ?></td>
					<td>WEB服务器：</td>
					<td>Windows</td>
				</tr>
				<tr>
					<td>PHP版本：</td>
					<td><?php echo (PHP_VERSION); ?></td>
					<td>MYSQL版本：</td>
					<td><?php echo mysql_get_server_info();?></td>
				</tr>
			</tbody>
		</table>
	</div>

			<div style="height:100px;">
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	//二级菜单对应显示下拉并选中效果
	$(function(){
		$('.left-nav').find('a').each(function(index, element){
			if($($(this))[0].href == String(window.location)){
				$(".left-nav dt img").attr("src","/eshop/Public/Admin/Icon/left/select_xl01.png");
				$(this).parent().find('img').attr("src","/eshop/Public/Admin/Icon/left/select_xl.png");
				$(".left-nav dd").hide();
				$(this).parent().find('dd').slideToggle();
				$(this).addClass('left-nav-active');
			}
		});
		$(".left-nav dt").click(function(){
				$(".left-nav dt").css({"background-color":"#3992d0"})
				$(this).css({"background-color": "#317eb4"});
				$(".left-nav dt img").attr("src","/eshop/Public/Admin/Icon/left/select_xl01.png");
				$(this).parent().find('img').attr("src","/eshop/Public/Admin/Icon/left/select_xl.png");
				$(".left-nav dd").hide();
				$(this).parent().find('dd').slideToggle();
			});
	});
</script>
</html>