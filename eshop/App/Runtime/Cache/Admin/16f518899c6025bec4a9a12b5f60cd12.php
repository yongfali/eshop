<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html">
	<title>微农后台管理系统-待审核商品</title>
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
	
	<link rel="stylesheet" type="text/css" href="/eshop/Public/Admin/Css/GoodManage/good.css">

	
	<script src="/eshop/Public/Admin/Js/GoodManage/goodAutho.js"></script>
 
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
					<a href="<?php echo U('Admin/ArticalManage/index1');?>" target="_self"><dd>帮助中心列表</dd></a>
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
		<span>待审核的商品</span>
	</div>
	<div class="head-wrapper">
		<div class="head-search">
			<!-- 头部检索框 -->
			<form action=" " id="order_search">
				<div class="artical-search">
					<label for="cat1">商品分类</label>
					<select name="cat1" id="cat1">  
						<option value="0">--请选择--</option>
						<option value="1">帮助中心</option>
						<option value="2">商城资讯</option>
					</select>
					<label for="shopname">店铺名称</label>
					<input type="text" name="shopname" id="shopname" class="inputs" placeholder="输入商户名进行查询">
					<label for="goodname">商品名称</label>
					<input type="text" name="goodname" id="goodname" class="inputs" placeholder="输入商品名进行查询">
					<input type="button" value="查询"  class="btn btn-info" id="goods-search" />
				</div>
			</form>
			<!-- 头部检索框 -->  
		</div>
		<div class="action-nav">
			<a href="javascript:void(0);" onclick="goodAutho(1)">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				批量审核
			</a>
		</div>
	</div>
	<div class="good-wrapper">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>
						<div class="checkbox">
							<label>
								<input type="checkbox" id="allchecked" autocomplete="off">全选
							</label>
						</div>
					</th>
					<th>商品的名称</th>
					<th>商品编号</th>
					<th>商品产地</th>
					<th>店铺价格</th>
					<th>所属店铺</th>
					<th>商品状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<?php if(empty($goodList)): ?><tbody><tr><td colspan="8">暂无待审核的商品！</td></tr></tbody>
				<?php else: ?>
				<tbody>
					<?php if(is_array($goodList)): $i = 0; $__LIST__ = $goodList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr class="data-item">
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" class="item-check" autocomplete="off" value="<?php echo ($item["id"]); ?>" >
									</label>
								</div>
							</td>
							<td>
								<div class="good-info">
									<img src="/eshop/<?php echo ($item["good_log"]); ?>">
									<span><?php echo ($item["name"]); ?></span>
								</div>
							</td>
							<td><?php echo ($item["goodnumber"]); ?></td>
							<td><?php echo ($item["place"]); ?></td>
							<td><?php echo ($item["shopprice"]); ?></td>
							<td><?php echo ($item["shopname"]); ?></td>
							<td>待审核</td>
							<td>
								<a class="btn-link" href="javascript:void(0);"onclick="goodAutho(0,<?php echo ($item["id"]); ?>);">审核通过</a>
								<a class="btn-link" href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['id']));?>" target="_blank">查看</a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody><?php endif; ?>
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