<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>用户中心-订单详情</title>
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
</head>
<body>
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

<div class="position_now">
  <label><a href="<?php echo U('Home/Index/index');?>" target="_blankx">首页</a></label>
  <span>&gt</span>
  <label>订单详情</label>
</div>
<div class="ucenter_wrapper"> 
  <!-- 交易管理左侧导航开始 --> 
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
    <a href="#">
    <li>投诉管理</li>
    </a> <a href="<?php echo U('Home/UserMsgManage/messages');?>">
    <li>消息管理</li>
    </a>
  </ul>
</div>
 
  <!-- 交易管理左侧导航结束 --> 
  <!-- 交易管理右侧内容显示开始 -->
  <div class="ucenter_right">
    <div class="ucenter_right_title"> <span>订单详情</span> 
    </div>
    <div class="ucenter_right_content"> 
      <!-- 订单详情展示 -->
      <?php if($orderInfo["is_cancel"] == 1): ?><div class="order-cancle">
           <div class="titles">订单状态</div>
           <div class="info"><?php echo (date("Y-m-d H：i：s",$orderInfo["create_time"])); ?><span>&nbsp;&nbsp;下单成功</span>
           </div>
          <div class="info"><?php echo (date("Y-m-d H：i：s",$orderInfo["canceltime"])); ?>&nbsp;&nbsp;用户取消订单：
            <span style="color:red;">
              <?php switch($orderInfo["canclereason"]): case "1": ?>下错单<?php break;?>
                <?php case "2": ?>订单信息填写有误<?php break;?>
                <?php case "3": ?>商家商品与图片描述不符<?php break;?>
                <?php case "4": ?>我有更好的商品想买<?php break;?>
                <?php default: ?>其它原因<?php endswitch;?>
            </span>
          </div>
        </div>
        <?php elseif($orderInfo["is_reject"] == 1): ?>
        <div class="order-cancle">
           <div class="titles">订单状态</div>
           <div class="info"><?php echo (date("Y-m-d H：i：s",$orderInfo["create_time"])); ?><span>&nbsp;&nbsp;下单成功</span>
           </div>
           <div class="info"><?php echo (date("Y-m-d H：i：s",$orderInfo["delivertime"])); ?><span>&nbsp;&nbsp;商家发货</span>
           </div>
          <div class="info"><?php echo (date("Y-m-d H：i：s",$orderInfo["rejecttime"])); ?>&nbsp;&nbsp;用户拒收订单：
            <span style="color:red;">
              <?php switch($orderInfo["rejectreason"]): case "1": ?>商家没有按照约定时间发货<?php break;?>
                <?php case "2": ?>商品在配送中损害了<?php break;?>
                <?php case "3": ?>商品的质量不合格<?php break;?>
                <?php default: ?>其它原因<?php endswitch;?>
            </span>
          </div>
        </div>
        <?php else: ?>
        <div class="order-progress">
          <div class="titles">订单状态</div>
          <div class="icons">
            <span class="icons-img"><img src="/eshop/Public/Home/Icon/place-order-success.png"></span>
            <span class="icons-line active">························&gt;</span>
          </div>
          <div class="icons">
            <span class="icons-img">
              <?php if($orderInfo["is_deliver"] == 1): ?><img src="/eshop/Public/Home/Icon/delivered.png">
                <?php else: ?>
                <img src="/eshop/Public/Home/Icon/deliver.png"><?php endif; ?>
            </span>
            <span class="icons-line <?php if($orderInfo["is_deliver"] == 1): ?>active<?php endif; ?>">························&gt;</span>
          </div>
          <div class="icons">
            <span class="icons-img">
              <?php if($orderInfo["is_confirm"] == 1): ?><img src="/eshop/Public/Home/Icon/good-received.png">
                <?php else: ?>
                 <img src="/eshop/Public/Home/Icon/good-receive.png"><?php endif; ?>
            </span>
            <span class="icons-line <?php if( $orderInfo["is_confirm"] == 1): ?>active<?php endif; ?>">························&gt;</span>
          </div>
          <div class="icons">
            <span class="icons-img">
              <?php if($orderInfo["is_recommend"] == 1): ?><img src="/eshop/Public/Home/Icon/commented.png">
               <?php else: ?>
               <img src="/eshop/Public/Home/Icon/comment.png"><?php endif; ?>
            </span>
          </div>
          <div class="icons-info">
            <span class="active">下单成功<?php echo (date("Y-m-d  H:i:s",$orderInfo["create_time"])); ?></span>
            <?php if($orderInfo["is_deliver"] == 1): ?><span class="active">
                商家已发货<?php echo (date("Y-m-d  H:i:s",$orderInfo["delivertime"])); ?>
              </span>
              <?php else: ?>
              <span>
                等待发货
              </span><?php endif; ?>
            <?php if($orderInfo["is_confirm"] == 1): ?><span class="active">
                买家已收货<?php echo (date("Y-m-d  H:i:s",$orderInfo["confirmtime"])); ?>
              </span>
              <?php else: ?>
              <span>
                确认收货
              </span><?php endif; ?>
            <?php if($orderInfo["is_recommend"] == 1): ?><span class="active">
                评价完成<?php echo (date("Y-m-d  H:i:s",$orderInfo["delivertime"])); ?>
              </span>
              <?php else: ?>
              <span>
                等待评价
              </span><?php endif; ?>
          </div>
        </div><!-- 订单进度条显示结束 --><?php endif; ?>
      <div class="order-info">
        <div  class="titles">订单信息</div>
        <div>
          <p><span>订单编号：</span><?php echo ($orderInfo["ordernum"]); ?></p>
          <p><span>支付方式：</span>
            <?php switch($orderInfo["paytype"]): case "2": ?>微信<?php break;?>
              <?php case "3": ?>银联<?php break;?>
              <?php case "4": ?>其它支付<?php break;?>
              <?php default: ?>支付宝<?php endswitch;?>
          </p>
          <p><span>配送方式：</span>京东配送</p>
          <?php if(($orderInfo["is_deliver"] == 1) OR ($orderInfo["is_confirmr"] == 1)): ?><p><span>快递公司：</span><?php echo ($orderInfo["expressname"]); ?></p>
            <p><span>快递单号：</span><?php echo ($orderInfo["expressnumber"]); ?></p>
            <p><span>购买意外险：</span>赠送运费险</p>
            <p><span>保险单号：</span>10000032289</p><?php endif; ?>
          <p><span>订单留言：</span>
            <?php if(empty($orderInfo["message"])): ?>无
              <?php else: ?>
              <?php echo ($orderInfo["message"]); endif; ?>
          </p>
        </div>
      </div><!-- 订单信息显示结束 -->
      <div class="buyer-info">
        <div  class="titles">买家信息</div>
        <p><span>买家姓名：</span><?php echo ($orderInfo["username"]); ?></p>
        <p><span>联系方式：</span><?php echo ($orderInfo["usertel"]); ?></p>
        <p><span>收货地址：</span><?php echo ($orderInfo["useraddr"]); ?></p>
      </div><!-- 买家信息显示结束 -->
      <div class="logistics">
        <div  class="titles">物流信息</div>
        <div>暂无物流信息！！！</div>
      </div><!-- 物流信息显示结束 -->
      <!-- 订单详情展示 --> 
    </div>
  </div>
  <!-- 交易管理右侧内容显示结束 --> 
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