<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>收藏的店铺</title>
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
<!-- 用户中心公共页面样式和脚本链接 -->
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/User/ucenter.css">
<script src="/eshop/Public/Home/Js/common.js"></script>
<script src="/eshop/Public/Home/Js/common.js"></script>
</head>
<body>
<!-- header开始 --> 
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
            <li><a href="<?php echo U('Home/UserCenter/index');?>">个人中心</a></li>
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
<!--商品导航条标签导航结束 -->
 
<!-- header结束 --> 
<!-- 当前位置开始 -->
<div class="position_now">
  <label><a href="<?php echo U('Home/Index/index');?>">首页</a></label>
  <span>&gt</span>
  <label>收藏的店铺</label>
</div>
<!-- 当前位置显示结束 --> 
<!-- 主体内容开始 -->
<div class="ucenter_wrapper"> 
  <!-- 左边导航标签开始 --> 
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
</div>
 
  <!-- 左边导航标签结束 -->
  <!-- 我的收藏右侧内容显示开始 --> 
  <div class="ucenter_right">
    <div class="ucenter_right_title"> 
      <span>收藏的店铺</span> 
    </div>
    <div class="ucenter_right_content">
      <div class="collection-wraper">
        <?php if(empty($lists)): ?><div>暂没收藏！！！</div>
          <?php else: ?>
          <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="shoper_info">
              <h3><?php echo ($item["name"]); ?></h3>
              <div class="shoper_item">
                <div class="shop_logo">
                  <?php if(empty($$item["logo"])): ?><img src="/eshop/Public/Home/ShopImage/shop_logo.jpg">
                    <?php else: ?>
                    <img src="/eshop/<?php echo ($item["logo"]); ?>"><?php endif; ?>  
                </div>
                <div class="itemscore">商品评分：<?php echo getShopScoreById($item['id']);?>分</div>
                <div class="itemscore">服务评分：<?php echo getShopScoreById($item['id'],2);?>分</div>
                <div class="itemscore">物流评分：<?php echo getShopScoreById($item['id'],3);?>分</div>
                <div class="shop_footer"> 
                  <a href="<?php echo U('Home/Shop/index',array('shopId'=>$item['id']));?>" target="_blank">进店逛逛
                  </a> 
                  <a href="javascript:void(0);" onclick="cancle(<?php echo ($item["id"]); ?>,1,<?php echo (session('uid')); ?>)">取消关注</a> 
                </div>
              </div>
            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
      </div>
      <!-- 分页开始 -->
      <div class="pages"><?php echo ($page); ?></div>
      <!-- 分页结束 --> 
    </div>
  </div>
  <!-- 我的收藏右侧内容显示结束 --> 
</div>
<!-- 主体内容结束 --> 
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
  <div class="footer_nav">
    <div class="footer_nav_list">
      <h3>新手指南</h3>
      <ul class="help">
        <li><a href="<?php echo U('Help/index');?>" target="_blank">购物流程</a></li>
        <li><a href="#">注册须知</a></li>
        <li><a href="#">会员服务</a></li>
        <li><a href="#">关于我们</a></li>
      </ul>
    </div>
    <div class="footer_nav_list">
      <h3>商家入驻</h3>
      <ul class="help">
        <li><a href="#">商家注册</a></li>
        <li><a href="#">店铺管理</a></li>
        <li><a href="#">诚信手册</a></li>
        <li><a href="#">常见问题</a></li>
      </ul>
    </div>
    <div class="footer_nav_list">
      <h3>订单服务</h3>
      <ul class="help">
        <li><a href="#">支付方式</a></li>
        <li><a href="#">订单处理</a></li>
        <li><a href="#">退款处理</a></li>
        <li><a href="#">常见问题</a></li>
      </ul>
    </div>
    <div class="footer_nav_list">
      <h3>配送说明</h3>
      <ul class="help">
        <li><a href="#">配送方式</a></li>
        <li><a href="#">配送费用</a></li>
        <li><a href="#">签收须知</a></li>
        <li><a href="#">常见问题</a></li>
      </ul>
    </div>
    <div class="footer_nav_list">
      <h3>售后服务</h3>
      <ul class="help">
        <li><a href="#">消费维权</a></li>
        <li><a href="#">投诉方式</a></li>
        <li><a href="#">问题反馈</a></li>
        <li><a href="#">常见问题</a></li>
      </ul>
    </div>
  </div>
  <div class="copyright"> Copyright&copy;eshop商城&nbsp;&nbsp;2016-2017 &nbsp;&nbsp;网址：<a href="<?php echo U('Home/Index/index');?>">http://www.eshop.lyf94.com</a>&nbsp;&nbsp;客服热线：<span>8888888</span> </div>
  <!--底部菜单导航结束 --> 
</div>
<!-- 尾部结束 -->
</body>
</html>