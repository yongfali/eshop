<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新增店铺认证</title>
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
	<link rel="stylesheet" type="text/css" href="/eshop/Public/Admin/Css/ShopManage/index.css">
</head>
<body>
	<div class="autho-add-wrapper">
		<form id="addAuthoForm">
			<div class="autho-add-item">
				<span style="display: inline-block">认证名称：</span>
				<input type="text" name="authoname" id="authoname" class="inputs"/>
			</div>
			<div class="autho-add-item">
				<span style="display: inline-block">图标：</span>
				<input class="btn btn-info btn-upload" type="button" name="logo"  value="上传图标" onclick="$('#previewImg').click();" >
				<input type="file" name= "photo"  style="display: none;" onchange="previewImage(this)" id="previewImg" accept="image/*">
			</div>
			<div class="autho-add-item1">
				<span style="display: inline-block">预览图标：</span>
				<div id="preview" class="img-logo">
                  <img id="imghead" border="0" src="/eshop/Public/Home/Icon/good_default.png">
                </div>
			</div>
			<div class="autho-add-item2">
				<input class="btn btn-info mybtn" type="submit" value="提交">
				<input class="btn btn-default" type="reset" value="取消">
			</div>
		</form>
	</div>
</body>
<script src="/eshop/Public/Admin/Js/ShopManage/autho.js"></script>
</html>