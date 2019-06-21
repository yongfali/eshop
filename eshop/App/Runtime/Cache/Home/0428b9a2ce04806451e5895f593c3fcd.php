<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>发货快递信息填写</title>
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
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/scommon.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/scenter.css">
<script src="/eshop/Public/Home/Js/shoperCenter.js"></script>
<script src="/eshop/Public/Home/Js/goodCommon.js"></script>


<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/Order/order.css">
<script src="/eshop/Public/Home/Js/Order/order.js"></script>
<body>
	<div class="logistics_wrap">
		<form action=" " method="post" id="express">
			<div class="item">
				<label>快递公司：</label>
				<select name="companySelect" id="expressCompany">
					<option value="0">--请选择--</option>
					<?php if(is_array($expressList)): $i = 0; $__LIST__ = $expressList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>"><?php echo ($item["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
			<div class="item">
				<label>快递单号：</label>
				<input type="text" name="expressNumber"/>
			</div>
			<input type="hidden" value="<?php echo ($orderId); ?>" id="orderId" name="orderid"/>
			<input type="submit" value="确认发货" class="confirmDeliver" />
		</form>
	</div>
</body>
</html>