<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>订单（确认）填写</title>
<!-- 用户和商家页面公共脚本引用链接 -->
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/common.css">
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
  </div>
    <div class="header_right">
      <ul>  
        <li class="header_nav"><a href="#">商户中心</a>
          <ul>
            <li><a href="<?php echo U('Home/Shoper/regist');?>">免费开店</a></li>
            <li><a href="<?php echo U('Home/Shoper/index');?>">商家登录</a></li>
          </ul>
        </li>
        <li class="header_nav"><a href="#">我的收藏</a>
          <ul>
            <li><a href="ucenter_collection.html">收藏的商品</a></li>
            <li><a href="#">收藏的店铺</a></li>
          </ul>
        </li>
        <li class="header_nav"><a href="#">我的账号</a>
          <ul>
            <li><a href="<?php echo U('Home/UserCenter/index');?>">个人中心</a></li>
            <li><a href="<?php echo U('Home/UserCenter/modifyPwd');?>">修改密码</a></li>
          </ul>
        </li>
        <li class="header_nav"><a href="#">我的订单</a>
          <ul>
            <li><a href="ucenter_orders.html">待支付订单</a></li>
            <li><a href="#">待发货订单</a></li>
            <li><a href="#">待确认订单</a></li>
            <li><a href="#">待评价订单</a></li>
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
      <form action="#" method="post">
        <p>
          <input type="text" name="words"placeholder="输入您想要的商品"/>
          <a href="#"><span>搜索</span></a> </p>
      </form>
    </div>
    <div class="hot_search"> 热门搜索： <a href="#">大蒜</a> <a href="#">黄瓜</a> <a href="#">西红柿</a> <a href="#">苹果</a> <a href="#">大蒜</a> </div>
  </div>
  <!-- 商城购物车展示 -->
  <div class="good_cart" >
    <div class="cart_icon">
      <span class="cart-left"> 
        <a href="shopcart.html" target="_blank">我的购物车</a>
      </span>
      <span class="cart-num"><?php echo sizeof($cart);?></span>
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
          <span>共<?php echo sizeof($cart);?>件商品，共计<strong>&yen;&nbsp;<?php echo ($totalPrice); ?></strong></span>
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
      <li><a href="#">批发</a></li>
      <li><a href="#">零售</a></li>
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
    <form action="" method="post">
      <div class="order_place">
        <span>收货人信息：</span>
        <div class="name">姓名：张三</div>
        <div class="postcode">邮编：123456</div>
        <div class="tel">联系电话：1232468324</div>
        <div class="address">收货地址：沈阳市沈阳工业大学（默认地址） 
          <a href="javascript:;" id="moreAddress">更多收货地址</a>
          <a href="javascript:;" id="addressEdit">新增收货地址</a>  
        </div>
        <div class="addrList" style="display:none">
          <div class="addrListItem">
            <div class="item-left" val="11">
              <span><input type="radio" name="addr" val="11" autocomplete="off"></span>
              <span>李永发</span>
              <span>北京市|北京市市辖区|东城区</span>
              <span>110022</span>
              <span>13437826498</span>
            </div>
            <div class="item-right" style="display:none;">
              <span><a href="#" class="modifyAddr">编辑</a></span>
              <span><a href="#">设为默认</a></span>
              <span><a href="#">删除</a></span>
            </div>
          </div>
          <div class="addrListItem">
            <div class="item-left" val="22">
              <span><input type="radio" name="addr" val="22" autocomplete="off"></span>
              <span>李永发</span>
              <span>北京市|北京市市辖区|东城区</span>
              <span>110022</span>
              <span>13437826498</span>
            </div>
            <div class="item-right" style="display:none;">
              <span><a href="#" class="modifyAddr">编辑</a></span>
              <span><a href="#">设为默认</a></span>
              <span><a href="#">删除</a></span>
            </div>
          </div>
          <div class="addrListItem">
            <div class="item-left" val="33">
              <span><input type="radio" name="addr" val="33" autocomplete="off"></span>
              <span>李永发</span>
              <span>北京市|北京市市辖区|东城区</span>
              <span>110022</span>
              <span>13437826498</span>
            </div>
            <div class="item-right" style="display:none;">
              <span><a href="#" class="modifyAddr">编辑</a></span>
              <span><a href="#">设为默认</a></span>
              <span><a href="#">删除</a></span>
            </div>
          </div>
        </div>
      </div>
      <!-- 买家信息显示结束 -->
      <div class="pay_way">
        <span>支付方式：</span>
        <div class="pay_way_select">
          <input type="radio" name="payway" checked="checked">
          <img src="/eshop/Public/Home/OrderImage/zhifubao.jpg">
          <input type="radio" name="payway">
          <img src="/eshop/Public/Home/OrderImage/weixin.jpg">
          <input type="radio" name="payway">
          <img src="/eshop/Public/Home/OrderImage/yinlian.jpg"> </div>
      </div>
      <!-- 支付方式显示结束 -->
      <div class="goods_order_lists">
      <span class="list_title">商品清单</span>
      <div class="order_content">
        <table class="cart_lists">
          <thead>
            <tr>
              <th class="t_head">商品编号</th>
              <th class="t_head2">商品信息</th>
              <th class="t_head">单价（元）</th>
              <th class="t_head">数量</th>
              <th class="t_head">总计（元）</th>
            </tr>
          </thead>
          <tbody>
            <tr class="shop_info">
              <td colspan="6"> 店铺：<a href="shopIndex.html">红富士旗舰店</a> 卖家：<a href="shopIndex.html">纤巧百媚</a> <a href="tencent://message/?uin=1411387106&Site=qq&Menu=yes"s><img src="/eshop/Public/Home/ShopImage/qq.gif"></a></td>
            </tr>
            <tr class="cart_tr">
              <td class="items cart_td1">784378246</td>
              <td class="items2 cart_td2"><a href="goods_info.html"><img src="/eshop/Public/Home/ShopImage/goods.png"></a> <span>山东红富士苹果500g 山东红富士苹果500g
                山东红富士苹果500g</span></td>
              <td class="items cart_td3">5.00</td>
              <td class="items cart_td4">4</td>
              <td class="items cart_td5">20.00</td>
            </tr>
          </tbody>
        </table>
        <div class="lastStep"><a href="<?php echo U('Home/ShoppingCart/index');?>">上一步</a></div>
        <div class="sumMoney"> 应付总金额（含运费）：&yen;&nbsp;<span>0.00</span> <a href="shopOrderPay.html">提交订单</a> </div>
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