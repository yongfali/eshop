<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新增二级子分类</title>
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
</head>
<style type="text/css">
	.cart-wrapper{
		padding: 15px;
	}
	.cart-wrapper .inputs{
		width: 160px;
	}
	.add-item{
		height: 50px;
		line-height: 50px;
	}
</style>
<body>
	<div class="cart-wrapper">
		<form id="addCartForm">
			<div class="add-item">
				<label>分类名称：</label>
				<input type="text" class="inputs">
			</div>
			<div class="add-item" style="padding-left: 80px;">
				<input class="btn btn-info" type="submit" value="提交">
				<input class="btn btn-default" type="reset" value="取消">
			</div>
		</form>
	</div>
</body>
</html>