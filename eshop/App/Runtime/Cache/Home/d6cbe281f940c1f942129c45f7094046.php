<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>订单（确认）填写</title>
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
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/shopcart.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/shoporders.css">
<script src="/eshop/Public/Home/Js/Cart/settlement.js"></script>
<script src="/eshop/Public/Home/Js/User/addrManage.js"></script>
<script type="text/javascript">
  var paymentIndex = "<?php echo U('payment');?>";
</script>
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
<!--商品导航条标签导航结束 -->
 
<!-- header结束 --> 
<div class="shoporders_wrapper">
  <div class="shopcart_nav">
    <dl class="first doing">
      <dt class="cart_num">1</dt>
      <dd class="cart_text">我的购物车</dd>
      <dd></dd>
    </dl>
    <dl class="second doing">
      <dt class="cart_num">2</dt>
      <dd class="cart_text">填写（确认）订单</dd>
    </dl>
    <dl class="third">
      <dt class="cart_num1">3</dt>
      <dd class="cart_text1">付款</dd>
    </dl>
  </div>
  <!-- 导航标题结束 -->
  <div class="cart_title">填写并订单确认</div>
  <!-- 标题 -->
  <div class="cart_content">
    <form action="<?php echo U('success');?>" method="post">
      <div class="order_place">
        <span>收货人信息：</span>
        <?php if(empty($addrList)): ?><div class="address">
            暂时还没有任何地址！<a href="javascript:;" id="addressEdit">新增收货地址</a>  
          </div>
          <?php else: ?>
          <?php if(is_array($addrList)): $i = 0; $__LIST__ = $addrList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; if($item["is_first"] == 1): ?><div class="name">姓名：<?php echo ($item["username"]); ?></div>
              <div class="postcode">邮编：<?php echo ($item["postcode"]); ?></div>
              <div class="tel">联系电话：<?php echo ($item["tel"]); ?></div>
              <div class="address" style="float:left;">收货地址：<?php echo formatAddr($item['location'],0);?>&nbsp;&nbsp;&nbsp;<?php echo ($item["streetinfo"]); ?>（默认地址） 
              </div><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
        <div class="addr-action">
          <?php if(!empty($addrList)): ?><a href="javascript:;" id="moreAddress">更多收货地址</a><?php endif; ?>
          <?php if($num < 5): ?><a href="javascript:;" id="addressEdit">新增收货地址</a><?php endif; ?>
        </div>
        <div class="addrList" style="display:none">
          <?php if(is_array($addrList)): $i = 0; $__LIST__ = $addrList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="addrListItem" <?php if($item["is_first"] == 1): ?>style="display:none"<?php endif; ?>>
                <div class="item-left">
                  <span><input type="radio" name="addr" value="<?php echo ($item["id"]); ?>" autocomplete="off"  <?php if($item["is_first"] == 1): ?>checked="checked"<?php endif; ?>></span>
                  <span><?php echo ($item["username"]); ?></span>
                  <span><?php echo formatAddr($item['location'],0);?>&nbsp;&nbsp;&nbsp;<?php echo ($item["streetinfo"]); ?></span>
                  <span><?php echo ($item["postcode"]); ?></span>
                  <span><?php echo ($item["tel"]); ?></span>
                </div>
                <div class="item-right" style="display:none;">
                  <span><a href="javascript:;" class="modifyAddr" value="<?php echo ($item["id"]); ?>">编辑</a></span>
                  <span><a href="javascript:setDefaultAddr(<?php echo ($item["id"]); ?>);">设为默认</a></span>
                  <span><a href="javascript:delAddr(<?php echo ($item["id"]); ?>);">删除</a></span>
                </div>
              </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </div>
      <!-- 买家信息显示结束 -->
      <div class="pay_way">
        <span>支付方式：</span>
        <div class="pay_way_select">
          <input type="radio" name="payway" checked="checked" id="zhifubao" value="1">
          <label for="zhifubao"><img src="/eshop/Public/Home/OrderImage/zhifubao.jpg"></label>
          <input type="radio" name="payway" id="weixin"value="2">
          <label for="weixin"><img src="/eshop/Public/Home/OrderImage/weixin.jpg"></label>
          <input type="radio" name="payway" id="yinlian" value="3">
          <label for="yinlian"><img src="/eshop/Public/Home/OrderImage/yinlian.jpg"></label> 
        </div>
      </div>
      <!-- 支付方式显示结束 -->
      <div class="goods_order_lists">
        <span class="list_title">商品清单</span>
        <div class="order_content">
          <div class="order_content_head">
            <ul>
              <li class="order_nav cart-item">商品编号</li>
              <li class="order_nav cart-item1">商品信息</li>
              <li class="order_nav cart-item2">单价（元）</li>
              <li class="order_nav cart-item2">数量</li>
              <li class="cart-item2">总计</li>
            </ul>
          </div>
          <?php if(is_array($carts)): $i = 0; $__LIST__ = $carts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="order-item" rel="<?php echo ($i); ?>">
              <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($item['goodid'] == $data['goodid']): ?><div class="shopinfo">
                    店铺：<a href="<?php echo U('Home/Shop/index',array('shopId'=> $data['id']));?>" target="_blank">&nbsp;&nbsp;<?php echo ($data["shopname"]); ?>&nbsp;&nbsp;</a> 商家：<a href="<?php echo U('Home/Shop/index',array('shopId'=> $data['id']));?>" target="_blank" class="shopName">&nbsp;&nbsp;<?php echo ($data["shopername"]); ?>&nbsp;&nbsp;</a> <a href="tencent://message/?uin=<?php echo ($data["service_qq"]); ?>&Site=qq&Menu=yes"s><img src="/eshop/Public/Home/ShopImage/qq.gif"></a>
                    <input type="hidden" name="shopId" value="<?php echo ($data['id']); ?>"/>
                  </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
              <div class="order-info">
                  <input type="hidden" name="goodId" value="<?php echo ($item['goodid']); ?>"/>
                <div class="order_nav cart-item goodNumber"><?php echo ($item["goodnumber"]); ?></div>
                <div class="order_nav cart-item1 goodInfo">
                  <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['goodid']));?>" target="_blank"><img src="/eshop/<?php echo ($item["good_log"]); ?>"></a>
                  <span><?php echo ($item["name"]); ?></span>
                </div>
                <div class="order_nav cart-item2 price"><?php echo ($item["shopprice"]); ?></div>
                <div class="order_nav cart-item2 mount"><?php echo ($item["mount"]); ?></div>
                <div class="cart-item2 itemPrice"><?php echo getCartItemPrice($item['goodid'],$carts);?></div>
              </div>
              <div class="order-message">
                <span>给卖家留言：</span>
                <input type="text" class="message" name="messages" placeholder="留言内容50个字以内！" value="" autocomplete="off"/>
              </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </div>
      <!-- 商品清单列表显示结束 -->
          <div class="lastStep"><a href="<?php echo U('index');?>">上一步</a></div>
          <div class="sumMoney"> 应付总金额（含运费：0）：&yen;&nbsp;<span style="font-size:18px;margin-right:10px;" id="totalPrice"><?php echo ($totalPrice); ?></span> 
            <a href="javascript:orderSubmit(this);" id="submitOrder">提交订单</a> 
          </div>
      <!-- 商品清单列表显示结束 -->
    </form>
  </div>
</div>
<!-- 订单页面中间包裹内容结束 -->
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