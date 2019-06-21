<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html">
	<title>微农后台管理系统-商城资讯列表</title>
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

	
	<script src="/eshop/Public/Admin/Js/ArticalManage/info.js"></script>
 
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
		<span>商城资讯列表</span>
	</div>
	<div class="head-wrapper">
		<div class="head-search">
			<!-- 头部检索框 -->
			<form action=" " id="info-search">
				<div class="artical-search">
					<label for="cat2">文章类型</label>
					<select name="cat1" id="cat1">
						<option value="0">--请选择--</option>
						<option value="3">公告</option>
						<option value="1">资讯</option>
						<option value="2">优惠活动</option>
					</select>
					<label for="cat2">发布者身份</label>
					<select name="cat2" id="cat2">  
						<option value="0">--请选择--</option>
						<option value="1">管理员</option>
						<option value="2">商家</option>
					</select>
					<label for="artical-title">文章标题</label>
					<input type="text" name="artical-title" id="artical-title" class="inputs" placeholder="输入标题进行查询">
					<input type="button" value="查询"  class="btn btn-info" id="artical_select"/>
				</div>
			</form>
			<!-- 头部检索框 -->  
		</div>
		<div class="action-nav">
			<a href="javascript:void(0);" onclick="delInfo(1)">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				批量删除
			</a>
			<a href="<?php echo U('Admin/ArticalManage/info');?>">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				新增
			</a>
		</div>
	</div>
	<div class="right-content-wrapper ajaxWrapper">
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
					<th>标题</th>
					<th>分类</th>
					<th>发布者</th>
					<th>发布者身份</th>
					<th>发布时间</th>
					<th>最近一次修改</th>
					<th>操作</th>
				</tr>
			</thead>
			<?php if(empty($infoList)): else: ?>
				<?php if(is_array($infoList)): $i = 0; $__LIST__ = $infoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tbody>
						<tr class="data-item">
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" class="item-check" value="<?php echo ($item["id"]); ?>" autocomplete="off">
									</label>
								</div>
							</td>
							<td><?php echo ($item["title"]); ?></td>
							<td>    
								<?php switch($item["type"]): case "1": ?>资讯<?php break;?>
									<?php case "2": ?>优惠活动<?php break;?>
									<?php default: ?>公告<?php endswitch;?>
							</td>
							<td><?php echo ($item["publishername"]); ?></td>
							<td>
								<?php switch($item["publishtype"]): case "1": ?>商家<?php break;?>
									<?php default: ?>管理员<?php endswitch;?>
							</td>
							<td><?php echo (date("Y-m-d",$item["publish_time"])); ?></td>
							<td><?php echo (date("Y-m-d",$item["modify_time"])); ?></td>
							<td>
								<a class="btn-link" href="<?php echo U('Admin/ArticalManage/infoEdit',array('id' => $item['id']));?>">修改</a>
								<a class="btn-link" href="javascript:void(0);" onclick="delInfo(0,<?php echo ($item["id"]); ?>)">删除</a>
							</td>
						</tr>
					</tbody><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		</table>
		<!-- 分页开始 -->
		<div class="pages"><?php echo ($page); ?></div>
		<!-- 分页结束 --> 
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