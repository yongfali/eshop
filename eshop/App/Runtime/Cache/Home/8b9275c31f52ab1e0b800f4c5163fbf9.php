<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>拒收订单原因</title>
</head>
<!-- 用户和商家页面公共脚本引用链接 -->
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/Common/common.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/Common/order.css">
<script src="/eshop/Public/Common/Js/jquery-2.1.1.min.js"></script>
<script src="/eshop/Public/Common/Js/jquery.validate.js"></script>
<script src="/eshop/Public/Common/layer/layer.js"></script>
<script src="/eshop/Public/Common/Js/common.js"></script>
<script src="/eshop/Public/Common/My97DatePicker/WdatePicker.js"></script>
<!-- 购物车脚本 -->
<script src="/eshop/Public/Home/Js/Cart/goodCart.js"></script>
<script type="text/javascript">
	var collections = "<?php echo U('Home/Collection/collection');?>";
	var cancles = "<?php echo U('Home/Collection/cancle');?>";
	var indexs = "<?php echo U('Home/User/login');?>"; 
	var addCart = "<?php echo U('Home/ShoppingCart/add');?>";
	var delCart = "<?php echo U('Home/ShoppingCart/del');?>";
</script>
<script src="/eshop/Public/Home/Js/Order/order.js"></script>
<style type="text/css">
	.order-reject-wrapper{padding: 10px 30px;}
	.order-reject-wrapper span{display: block;height: 32px;line-height: 32px;margin-bottom: 10px;}
	#reasons{
		appearance: none;-moz-appearance: none;
		-webkit-appearance: none;
		width: 200px;
		height: 32px;
		margin-right: 6px;
		border-radius: 5px;
		border: 1px solid #ccc;
		box-shadow: 1px 1px 1px #f0f0f0 inset;
		background: url("/eshop/Public/Home/Icon/arrow.png") no-repeat scroll right center transparent;
		padding-right: 15px;
	}
	.orderReject
	{
		width: 80px;
		height: 34px;
		background: #32a9ea;
		color: #fff;
		border: 1px solid #32a9ea;
		border-radius: 3px;
		margin: 20px auto;
	}
	.orderReject:hover{
		background: #0289fc;
	}
</style>
<body>
	<div class="order-reject-wrapper">
		<span>请选择您拒收订单的原因，以便我们能更好的为您服务。</span>
		<div class="reject-reason-select">
			<select name="reason" id="reasons">
				<option value="1">商家没有按照约定时间发货</option>
				<option value="2">商品在配送中损害了</option>
				<option value="3">商品的质量不合格</option>
				<option value="4">其它原因</option>
			</select>
		</div>
		<input type="hidden" value="<?php echo ($orderId); ?>" id="orderId" name="orderid"/>
		<input type="submit" value="提交" class="orderReject" id="rejectSubmit"/>
	</div>
</body>
</html>