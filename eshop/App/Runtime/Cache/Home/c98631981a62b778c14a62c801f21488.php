<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>
  <?php if($_SESSION['type']== 1): ?>商户中心-商家消息
    <?php else: ?>
    用户中心-用户消息<?php endif; ?>
</title>
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
<?php if($_SESSION['type']== 1): ?><link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/scommon.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/scenter.css">
<script src="/eshop/Public/Home/Js/shoperCenter.js"></script>
<script src="/eshop/Public/Home/Js/goodCommon.js"></script>


 <?php else: ?>
 <!-- 用户中心公共页面样式和脚本链接 -->
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/User/ucenter.css">
<script src="/eshop/Public/Home/Js/common.js"></script><?php endif; ?>
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/Message/message.css">
<script src="/eshop/Public/Home/Js/Message/msg.js"></script>
<script src="/eshop/Public/Home/Js/common.js"></script>
</head>
<body>
  <?php if($_SESSION['type']== 1): ?><!-- 店铺首页头部开始 -->
<div class="header">
  <div class="header_wraper">
    <div class="header_left"> 
      <span>
      <a href="javascript:void(0);" onclick="SetHome(this,'http://www.eshop.lyf94.com');">设为首页</a>
    </span> 
    <span>
      <a href="javascript:void(0);" onclick="AddFavorite('微农电商网',location.href)">收藏本站</a>
    </span>
    <span>
      <a href="<?php if($_SESSION['type']== 1): echo U('Home/ShoperCenter/messages'); else: echo U('Home/UserMsgManage/messages'); endif; ?>" target="_blank">消息<span <?php if($noReadMsgNum > 0): ?>style="color:red;"<?php endif; ?> >（<?php echo ($noReadMsgNum); ?>）</span></a>
    </span>  
    </div>
    <div class="header_right">
      <ul>
        <li class="header_nav"><a href="<?php echo U('Home/ShoperCenter/info');?>">商家中心</a>
          <?php if($_SESSION['type']== 1): ?><ul>
              <li><a href="<?php echo U('Home/ShopCart/index');?>">商品管理</a></li>
              <li><a href="<?php echo U('Home/ShopOrders/waitPay');?>">交易管理</a></li>
              <li><a href="<?php echo U('Home/ShopManage/index');?>">店铺管理</a></li>
            </ul>
            <?php else: ?>
            <ul>
              <li><a href="<?php echo U('Home/Shoper/regist');?>">免费开店</a></li>
              <li><a href="<?php echo U('Home/Shoper/index');?>">商家登录</a></li> 
            </ul><?php endif; ?>
      </ul>
      <span class="header_nav"> 
      <?php if(empty($_SESSION['uname'])): ?>欢迎光临eshop商城，<a href="<?php echo U('Home/Shoper/index');?>">登录</a>
        <?php else: ?>
        欢迎<span style="color:red;font-size:16px;padding: 0px 8px;"><?php echo (session('uname')); ?></span>光临eshop商城，<a href="<?php echo U('Home/Shoper/loginout');?>">退出</a><?php endif; ?>
      </span> </div>
  </div>
</div>
<div class="float_clear"></div>
<!-- 店铺首页头部结束 --> 
<!-- 头部搜索开始 -->
<div class="shop_search_wrapper">
  <div class="shop_search_left">
    <div class="s_logo"> 
      <a href="<?php echo U('Home/Shop/index',array('shopId'=> $shopInfo['id']));?>" target="_blank">
        <?php if(empty($shopInfo["logo"])): ?><img src="/eshop/Public/Home/Icon/no-img.png" alt="店铺logo">
         <?php else: ?>
         <img src="/eshop/<?php echo ($shopInfo["logo"]); ?>" alt="店铺logo"><?php endif; ?>
      </a> 
    </div>
    <div class="s_info">
      <h3><?php echo ($shopInfo["name"]); ?></h3>
      <div class="s_info1"> 
        <img src="/eshop/Public/Home/ShopImage/renzheng.png"><span>国家认证商家</span> <img src="/eshop/Public/Home/ShopImage/qitian.png"><span>七天无条件退款</span> <a href="tencent://message/?uin=<?php echo ($shopInfo["service_qq"]); ?>&Site=qq&Menu=yes"><img src="/eshop/Public/Home/ShopImage/qq.gif" style="width:65px;height:24px;"></a> </div>
      <div class="s_info2">
        <lable>商品评分：<span><?php echo sprintf("%.1f", $goodScore);?>分</span></lable>
        <lable>服务评价：<span><?php echo sprintf("%.1f", $logisticsSocre);?>分</span></lable>
        <lable>物流评价：<span><?php echo sprintf("%.1f", $serviceScore);?>分</span></lable>
        <span>
          <?php if(checkCollection($shopInfo['id'],1) == 1): ?><a href="javascript:void(0);" onclick="cancle(<?php echo ($shopInfo["id"]); ?>,1,<?php echo (session('uid')); ?>)">取消关注</a>
            <?php else: ?> 
            <a href="javascript:void(0);" onclick="Collection(<?php echo ($shopInfo["id"]); ?>,1)">关注本店</a><?php endif; ?>
        </span>
        <label><a href="<?php echo U('Home/Index/index');?>" target="_blank">商城首页</a></label>
      </div>
    </div>
  </div>
  <!-- 店铺logo和基本信息结束 -->
  <div class="shop_search_right">
    <form action=" " method="post" class="s_form">
      <input type="text" name="words" id="keyWords" placeholder="输入您想要的商品" autocomplete="off"/>
      <a href="javascript:void(0);" onclick="goodsSearch(1);" id="shopSerch" rel="<?php echo ($shopInfo["id"]); ?>" class="btn1">
        <span>搜本店</span>
      </a> 
      <a href="javascript:void(0);" onclick="goodsSearch();" rel="<?php echo U('Home/Search/index');?>" id="goodSerch" class="btn1">
        <span>搜全站</span>
      </a>
    </form>
  </div>
  <!-- 搜索框结束--> 
</div>
<!-- 头部搜索结束 --> 
<!-- 店铺首页导航开始 -->
<div class="shop_nav_wrapper">
  <div class="shop_nav_list">
    <ul>
      <li class="allProduct"><a href="javascript:void(0);">本店所有产品</a>
        <p></p>
        <ul class="allProduct2">
          <?php if(is_array($shopNav)): $i = 0; $__LIST__ = $shopNav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('moreList',array('shopId' => $shopInfo['id'],'scat' => $item[id]));?>"><?php echo ($item["name"]); ?></a>
              <?php if($item["childNum"] > 0): ?><ul class="allProduct3">
                  <?php if(is_array($item["child"])): $j = 0; $__LIST__ = $item["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($j % 2 );++$j;?><li><a href="<?php echo U('moreList',array('shopId' => $shopInfo['id'],'scat' => $item[id],'scat2' => $data[id]));?>"><?php echo ($data["sname"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul><?php endif; ?>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </li>
      <li><a href="<?php echo U('Home/Shop/index',array('shopId'=> $shopInfo['id']));?>" target="_blank">首页</a></li>
      <?php if(is_array($shopNav)): $i = 0; $__LIST__ = array_slice($shopNav,0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('moreList',array('shopId' => $shopInfo['id'],'scat' => $data[id]));?>" target="_blank"><?php echo ($data["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
</div>
<!-- 店铺首页导航结束 -->
   <?php else: ?>
   <!-- 头部header开始 -->
<div class="header">
  <div class="header_wraper">
    <div class="header_left"> 
      <span>
      <a href="javascript:void(0);" onclick="SetHome(this,'http://www.eshop.lyf94.com');">设为首页</a>
    </span> 
    <span>
      <a href="javascript:void(0);" onclick="AddFavorite('微农电商网',location.href)">收藏本站</a>
    </span>
    <span>
      <a href="<?php if($_SESSION['type']== 1): echo U('Home/ShoperCenter/messages'); else: echo U('Home/UserMsgManage/messages'); endif; ?>" target="_blank">消息<span <?php if($noReadMsgNum > 0): ?>style="color:red;"<?php endif; ?> >（<?php echo ($noReadMsgNum); ?>）</span></a>
    </span>    
  </div>
    <div class="header_right">
      <ul>  
        <li class="header_nav"><a href="<?php echo U('Home/ShoperCenter/info');?>">商户中心</a>
          <ul>
            <li><a href="<?php echo U('Home/Shoper/regist');?>">免费开店</a></li>
            <li><a href="<?php echo U('Home/Shoper/index');?>">商家登录</a></li>
          </ul>
        </li>
        <li class="header_nav"><a href="<?php echo U('Home/UserCollection/goods');?>">我的收藏</a>
          <ul>
            <li><a href="<?php echo U('Home/UserCollection/goods');?>">收藏的商品</a></li>
            <li><a href="<?php echo U('Home/UserCollection/shops');?>">收藏的店铺</a></li>
          </ul>
        </li>
        <li class="header_nav"><a href="<?php echo U('Home/UserCenter/userinfo');?>">我的账号</a>
          <ul>
            <li><a href="<?php echo U('Home/UserCenter/security');?>">个人中心</a></li>
            <li><a href="<?php echo U('Home/UserCenter/modifyPwd');?>">修改密码</a></li>
          </ul>
        </li>
        <li class="header_nav"><a href="<?php echo U('Home/UserOrders/waitReceive');?>">我的订单</a>
          <ul>
            <li><a href="<?php echo U('Home/UserOrders/waitPay');?>">待支付订单</a></li>
            <li><a href="<?php echo U('Home/UserOrders/waitReceive');?>">待确认订单</a></li>
            <li><a href="<?php echo U('Home/UserOrders/waitAppraise');?>">待评价订单</a></li>
          </ul>
        </li>
      </ul>
      <span class="header_nav">
      <?php if(empty($_SESSION['uname'])): ?>欢迎光临eshop商城，<a href="<?php echo U('Home/User/login');?>">登录</a>
        <?php else: ?>
        欢迎<span style="color:red;font-size:16px;padding: 0px 8px;"><?php echo (session('uname')); ?></span>光临eshop商城，<a href="<?php echo U('Home/User/loginout');?>">退出</a><?php endif; ?>
      </span> </div>
  </div>
</div>
<div class="float_clear"></div>
<!-- 头部header结束 -->
<div class="content_header">
  <div class="content_header_left"> <a href="<?php echo U('Home/Index/index');?>"><img src="/eshop/Public/Home/Image/logo.jpg" alt="e_shop商城"></a> </div>
  <div class="content_header_center">
    <div class="search">
      <form action=" " method="post">
        <p>
          <input type="text" name="words" id="keyWords" placeholder="输入您想要的商品" autocomplete="off"/>
          <a href="javascript:void(0);" onclick="goodsSearch();" rel="<?php echo U('Home/Search/index');?>" id="goodSerch">
            <span>搜索</span>
          </a> 
        </p>
      </form>
    </div>
    <div class="hot_search"> 热门搜索： <a href="#">大蒜</a> <a href="#">黄瓜</a> <a href="#">西红柿</a> <a href="#">苹果</a> <a href="#">大蒜</a> </div>
  </div>
  <!-- 商城购物车展示 -->
  <div class="good_cart" >
    <div class="cart_icon">
      <span class="cart-left"> 
        <a href="<?php echo U('ShoppingCart/index');?>" target="_blank">我的购物车</a>
      </span>
      <span class="cart-num">
        <?php if(empty($cart)): ?>0
          <?php else: ?>
          <?php echo sizeof($cart); endif; ?>
      </span>
      <span class="cart-right">
        <img src="/eshop/Public/Home/Icon/cart.png">
      </span>
    </div>
    <div class="cart-content" style="display:none;">
      <div class="title-name">
        <strong style="color:#666">最新添加的商品</strong>
      </div>
      <?php if(empty($cart)): ?><div>购物车空空如也...</div>
        <?php else: ?>
        <div class="cart-contetn-list">
          <ul>
            <?php if(is_array($cart)): $i = 0; $__LIST__ = $cart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
                  <div class="p-img">
                    <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['goodid']));?>" target="_blank">
                      <img src="/eshop/<?php echo ($item["good_log"]); ?>" alt="" width="50" height="50">
                    </a>
                  </div>      
                  <div class="p-name">
                    <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['goodid']));?>" target="_blank"><?php echo ($item["name"]); ?>
                    </a>
                  </div>      
                  <div class="p-detail">          
                    <span class="p-price">
                      <strong>&yen;<?php echo ($item["shopprice"]); ?>&nbsp;</strong>×<?php echo ($item["mount"]); ?>
                    </span>                   
                    <br>
                    <?php if($type == 0 ): ?><a class="delete" href="javascript:void(0);" onclick="delCarts(<?php echo ($item['goodid']); ?>,0)">删除</a>
                      <?php else: ?>
                      <a class="delete" href="javascript:void(0);" onclick="delCarts(<?php echo ($item['goodid']); ?>,1)">删除</a><?php endif; ?>          
                  </div>  
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
        <div class="cart-total">
          <span>共<?php echo sizeof($cart);?>件商品，共计<strong>&yen;&nbsp;<?php echo sprintf("%.2f",$totalPrice);?></strong></span>
          <a href="<?php echo U('ShoppingCart/index');?>" target="_blank">去购物车</a>
        </div><?php endif; ?>
    </div>
  </div>
  <!-- 商城购物车展示 -->
</div>
<!-- 热门搜索结束-->
<div class="content_nav">
  <div class="content_nav_left"> <span class="grid"><img src="/eshop/Public/Home/Icon/grid.png" /></span> <span style="line-height:40px;">商品分类</span> <b></b> 
  </div>
  <div class="content_nav_right">
    <ul>
      <li><a href="<?php echo U('Home/Index/index');?>">首页</a></li>
      <li><a href="<?php echo U('Home/Index/index');?>">批发</a></li>
      <li><a href="<?php echo U('Home/Index/index');?>">零售</a></li>
    </ul>
  </div>
</div>
<!--商品导航条标签导航结束 --><?php endif; ?>
<div class="position_now">
  <label><a href="index.html">首页</a></label>
  <span>&gt</span>
  <label>
    <?php if($_SESSION['type']== 1): ?>商户消息
    <?php else: ?>
    用户消息<?php endif; ?>
  </label>
</div>
<div class="<?php if($_SESSION['type']== 1): ?>scenter_wrapper<?php else: ?>ucenter_wrapper<?php endif; ?>"> 
  <!-- 左侧导航开始 --> 
  <?php if($_SESSION['type']== 1): ?><!-- 商家中心左侧导航标签公共部分 -->

<div class="scenter_left">
  <h3>商品管理</h3>
  <ul>
    <a href="<?php echo U('Home/ShopCart/index');?>">
    <li>商品分类</li>
    </a> <a href="<?php echo U('Home/Good/add');?>">
    <li>新增商品</li>
    </a> <a href="<?php echo U('Home/Good/audit');?>">
    <li>待审核商品</li>
    </a> <a href="<?php echo U('Home/Good/illegal');?>">
    <li>违规商品</li>
    </a> <!-- <a href="#">
    <li>评价管理</li>
    </a>  --><a href="<?php echo U('Home/Good/stock');?>">
    <li>库存预警</li>
    </a> <a href="<?php echo U('Home/Good/onsale');?>">
    <li>出售中的商品</li>
    </a> <a href="<?php echo U('Home/Good/store');?>">
    <li>仓库中的商品</li>
    </a>
  </ul>
  <h3>交易管理</h3>
  <ul>
    <a href="<?php echo U('Home/ShopOrders/waitPay');?>">
    <li>待付款订单</li>
    </a> <a href="<?php echo U('Home/ShopOrders/waitDelivery');?>">
    <li>待发货订单<span class="order-num"><?php echo ($waitDeliveryNum); ?></span></li>
    </a> <a href="<?php echo U('Home/ShopOrders/delivered');?>">
    <li>已发货订单</li>
    </a> <a href="<?php echo U('Home/ShopOrders/finished');?>">
    <li>已收货订单</li>
    </a> <a href="<?php echo U('Home/ShopOrders/failure');?>">
    <li>取消/拒收订单</li>
    </a> <a href="<?php echo U('Home/ShopOrders/complaint');?>">
    <li>投诉订单</li>
    </a>
  </ul>
  <h3>店铺管理</h3>
  <ul>
    <a href="<?php echo U('Home/ShopManage/index');?>">
    <li>店铺信息</li>
    </a> <a href="<?php echo U('Home/ShopManage/info');?>">
    <li>信息发布</li>
    <a href="<?php echo U('Home/ShopManage/infoList');?>">
    <li>信息列表</li>
    </a> 
    </a> <a href="<?php echo U('Home/ShopManage/setting');?>">
    <li>店铺设置</li>
    </a>
  </ul>
  <h3>商家中心</h3>
  <ul>
    <a href="<?php echo U('Home/ShoperCenter/info');?>">
    <li>商家信息</li>
    </a>  
    <a href="<?php echo U('Home/ShoperCenter/messages');?>">
    <li>商家消息</li>
    </a>
    <a href="<?php echo U('Home/ShoperCenter/log');?>">
    <li>操作记录</li>
    </a> <a href="<?php echo U('Home/ShoperCenter/modifyPwd');?>">
    <li>修改密码</li>
    </a>
    <a href="<?php echo U('Home/ShoperCenter/security');?>">
    <li>安全设置</li>
    </a>
  </ul>
</div>
 
    <?php else: ?>
    <!-- 用户中心左侧导航标签公共部分 -->
<div class="ucenter_left">
  <h3>我的订单</h3>
  <ul>
    <a href="<?php echo U('Home/UserOrders/waitPay');?>">
    <li>待支付订单</li>
    </a> <a href="<?php echo U('Home/UserOrders/waitDelivery');?>">
    <li>待发货订单
      <?php if(!empty($waitDeliveryNum)): ?><span class="order-num"><?php echo ($waitDeliveryNum); ?></span><?php endif; ?>
    </li>
    </a> 
    <a href="<?php echo U('Home/UserOrders/waitReceive');?>">
      <li>待收货订单<?php if(!empty($waitReceiveNum)): ?><span class="order-num"><?php echo ($waitReceiveNum); ?></span><?php endif; ?>
    </li>
  </a> 
  <a href="<?php echo U('Home/UserOrders/waitAppraise');?>">
    <li>待评价订单
      <?php if(!empty($finishedNum)): ?><span class="order-num"><?php echo ($finishedNum); ?></span><?php endif; ?>
    </li>
  </a> 
    <a href="<?php echo U('Home/UserOrders/appraised');?>">
    <li>已评论订单</li>
    </a> <a href="<?php echo U('Home/UserOrders/failure');?>">
    <li>已取消订单</li>
    </a>
    <a href="<?php echo U('Home/UserOrders/refund');?>">
    <li>拒收或退款</li>
    </a>
  </ul>
  <h3>我的收藏</h3>
  <ul>
    <a href="<?php echo U('Home/UserCollection/goods');?>">
    <li>收藏商品</li>
    </a> <a href="<?php echo U('Home/UserCollection/shops');?>">
    <li>收藏店铺</li>
    </a>
  </ul>
  <h3>账户设置</h3>
  <ul>
    <a href="<?php echo U('Home/UserCenter/userinfo');?>">
    <li>个人资料</li>
    </a> 
    <a href="<?php echo U('Home/UserCenter/security');?>">
    <li>账号安全</li>
    </a> 
    <a href="<?php echo U('Home/UserCenter/address');?>">
    <li>地址管理</li>
    </a>
    <a href="<?php echo U('Home/UserCenter/modifyPwd');?>">
      <li>修改密码</li>
    </a> 
    <a href="<?php echo U('Home/UserCenter/index');?>">
    <li>操作记录</li>
    </a>
  </ul>
  <h3>客户管理</h3>
  <ul>
    <a href="<?php echo U('Home/UserMsgManage/orderComplainManage');?>">
    <li>投诉管理</li>
    </a> <a href="<?php echo U('Home/UserMsgManage/messages');?>">
    <li>消息管理</li>
    </a>
  </ul>
</div><?php endif; ?>
  <!-- 左侧导航结束 --> 
  <!-- 右侧内容显示开始 -->
  <div class="<?php if($_SESSION['type']== 1): ?>scenter_right<?php else: ?>ucenter_right<?php endif; ?>">
    <div class="<?php if($_SESSION['type']== 1): ?>scenter_right_title<?php else: ?>ucenter_right_title<?php endif; ?>"> 
      <span>
        <?php if($_SESSION['type']== 1): ?>商户消息
          <?php else: ?>
          用户消息<?php endif; ?>
      </span>
    </div>
    <div class="msg-action">
    	<a href="javascript:allMsgRead();">全部标为已读</a>
    	<a href="javascript:delMsg(1);" rel="<?php echo U('messageDel');?>">批量删除</a>
    </div>
    <div class="ucenter_right_content">
    	<table class="msg-table">
    		<thead>
    			<tr>
    				<th width="8%">
    					<input type="checkbox" id="allchecked" autocomplete="off"/>
    					<label for="allchecked">全选</label>
    				</th>
    				<th width="6%">状态</th>
    				<th width="76%">内容</th>
    				<th width="10%" style="text-align:center;">操作</th>
    			</tr>
    		</thead>
    		<tbody>
                <?php if(empty($list)): ?><tr>
                        <td colspan="4" style="text-align:center;color:red;">
                            暂无消息！！！
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
                            <td class="msg-item-box"><input type="checkbox" class="msg_check" value="<?php echo ($item["id"]); ?>" status="<?php echo ($item["status"]); ?>" autocomplete="off"/></td>
                            <td>
                                <span class="newMsg">
                                    <?php if($item["status"] == 1): ?><img src="/eshop/Public/Home/Icon/redMsg.png"> 
                                       <?php else: ?>
                                       <img src="/eshop/Public/Home/Icon/newMsg.png"><?php endif; ?>
                                </span>
                            </td>
                            <td class="msg-content"><span><?php echo ($item["content"]); ?></span></td>
                            <td class="msg-actions">
                              <?php if($item["status"] == 1): ?><a href="<?php echo U('messageDetail',array('msgId' => $item['id'],'status'=>'old'));?>" >查看</a>
                                <?php else: ?>
                                <a href="<?php echo U('messageDetail',array('msgId' => $item['id'],'status'=>'new'));?>" >查看</a><?php endif; ?>
                                <a href="javascript:delMsg(0,<?php echo ($item["id"]); ?>);" rel="<?php echo U('messageDel');?>">删除</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>	
    		</tbody>
    	</table>
      <!-- 分页开始 -->
      <div class="pages"><?php echo ($page); ?></div>
      <!-- 分页结束 --> 
    </div>
  </div>
  <!-- 右侧内容显示结束 --> 
</div>
<!-- 尾部开始 -->
<div class="float_clear"></div>
<div class="footer">
  <div class="footer_top">
    <ul>
      <li>
        <div class="footer_top_icon"><img src="/eshop/Public/Home/Image/footer_img01.png"></div>
        <div class="footer_top_text">
          <h3>安全无公害</h3>
          <span>放心购买</span></div>
      </li>
      <li>
        <div class="footer_top_icon"><img src="/eshop/Public/Home/Image/footer_img01.png"></div>
        <div class="footer_top_text">
          <h3>安全无公害</h3>
          <span>放心购买</span></div>
      </li>
      <li>
        <div class="footer_top_icon"><img src="/eshop/Public/Home/Image/footer_img01.png"></div>
        <div class="footer_top_text">
          <h3>安全无公害</h3>
          <span>放心购买</span></div>
      </li>
      <li>
        <div class="footer_top_icon"><img src="/eshop/Public/Home/Image/footer_img01.png"></div>
        <div class="footer_top_text">
          <h3>安全无公害</h3>
          <span>放心购买</span></div>
      </li>
      <li>
        <div class="footer_top_icon"><img src="/eshop/Public/Home/Image/footer_img01.png"></div>
        <div class="footer_top_text">
          <h3>安全无公害</h3>
          <span>放心购买</span></div>
      </li>
      <li>
        <div class="footer_top_icon"><img src="/eshop/Public/Home/Image/footer_img01.png"></div>
        <div class="footer_top_text">
          <h3>安全无公害</h3>
          <span>放心购买</span></div>
      </li>
    </ul>
  </div>
  <!--底部图标结束 -->
  <?php if(!empty($footerMenu)): ?><div class="footer_nav">
    <?php if(is_array($footerMenu)): $i = 0; $__LIST__ = $footerMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="footer_nav_list">
      <h3><?php echo ($item["name"]); ?></h3>
      <ul class="help">
        <?php if(is_array($item["child"])): $i = 0; $__LIST__ = $item["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Help/index',array('id' => $data[0]));?>" target="_blank"><?php echo ($data[1]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul> 
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div><?php endif; ?>
  <div class="copyright"> Copyright&copy;eshop商城&nbsp;&nbsp;2016-<?php echo date('Y',time()); ?> &nbsp;&nbsp;网址：<a href="<?php echo U('Home/Index/index');?>">http://www.eshop.lyf94.com</a>&nbsp;&nbsp;客服热线：<span>8888888</span> </div>
  <!--底部菜单导航结束 --> 
</div>
<!-- 尾部结束
</body>
</html>