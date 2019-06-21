<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html">
	<title>微农后台管理系统-帮助列表编辑</title>
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
	
	<link rel="stylesheet" type="text/css" href="/eshop/Public/Admin/Css/ArticalManage/artical.css">

	
	<script src="/eshop/Public/Common/ueditor/ueditor.config.js"></script>
	<script src="/eshop/Public/Common/ueditor/ueditor.all.min.js"></script>
	<script src="/eshop/Public/Common/ueditor/lang/zh-cn/zh-cn.js"></script>
	<script src="/eshop/Public/Admin/Js/ArticalManage/info.js"></script>
	<script type="text/javascript">
		var toURL = "<?php echo U('helpList');?>";
	</script>
 
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
					<a href="#" target="_self"><dd>数据备份</dd></a>
				</dl>
			
			<div style="height:100px;">
			</div>
		</div>
		<div class="right-content">
			
	<div class="now-position">
		<span>帮助列表编辑</span>
	</div>
	<form autocomplete="off" id="helpEditForm" rel="<?php echo U('helpItemSave');?>">
		<table class="artical-add-table">
			<tbody>
				<tr class="artical-add-item">
					<td>
						<span class="icon">*</span>文章分类：
					</td>
					<td style="padding-left:5px;">
						<select name="pid" id="cat1">
							<option value="0">--请选择--</option>
							<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>"<?php if($item['id'] == $content['pid']): ?>selected="selected"<?php endif; ?> ><?php echo ($item["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="artical-title">
							<span class="icon">*</span>文章标题：
						</label>
					</td>
					<td>
						<input type="text" name="title" id="artical-title" class="inputs" value="<?php echo ($content["name"]); ?>" placeholder="请输入文章标题">
					</td>
				</tr>
				<tr>
					<td>
						<label for="content">
							<span class="icon">*</span>文章内容：
						</label>
					</td>
					<td style="padding-left:5px;">
						<textarea id="content" name="content" 
						style="width: 720px; height: 250px;"><?php echo ($content["content"]); ?>
						</textarea>
		                <!--  显示 ueditor编辑器 --> 
		                <script type="text/javascript">
		                  var ue = UE.getEditor('content');
		                </script>
					</td>
				</tr>
				<tr class="artical-add-item artical-add-btn">
					<td colspan="2">
						<button type="submit" class="btn btn-info">保存</button>
						<button type="reset" class="btn btn-danger">取消</button>
						<input type="hidden" name="navId" value="<?php echo ($content["id"]); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>

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