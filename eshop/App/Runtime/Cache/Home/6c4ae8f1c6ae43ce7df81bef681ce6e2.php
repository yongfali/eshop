<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>商品类别详细显示</title>
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
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/Index/moreGoods.css">
<script src="/eshop/Public/Home/Js/common.js"></script>
<script src="/eshop/Public/Home/Js/Index/moreGoods.js"></script>
<script type="text/javascript">
  var goodsOrder = "<?php echo U('Home/Index/goodsOrder');?>";
</script>
</head> 
<body>
<!-- 头部header开始 --> 
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
 
<!-- 头部header结束 --> 
<div class="position_now">
  <label><a href="index.html">首页</a></label>
  <span>&gt</span>
  <label>蔬菜</label>
</div>
<div class="lists_wrapper">
  <div class="lists_header">
    <ul>
      <a href="javascript:void(0)" class="nav_active" rel="desc" onclick="goodOrder(this,1)" ><li>综合排序</li></a>
      <a href="javascript:void(0)" onclick="goodOrder(this,2)" rel="desc"><li>单价</li><span class="select-icon"></span></a>
      <a href="javascript:void(0)" onclick="goodOrder(this,3)" rel="desc"><li>销量</li><span class="select-icon"></span></a>
      <input id="cats" type="hidden" val="<?php if(empty($fmenu)): ?>0<?php else: echo ($fmenu); endif; ?>" rel="<?php if(empty($smenu)): ?>0<?php else: echo ($smenu); endif; ?>" rels="<?php if(empty($tmenu)): ?>0<?php else: echo ($tmenu); endif; ?>"/>
      <input id="cats2" type="hidden" vals="<?php if(empty($pageType)): ?>more<?php else: echo ($pageType); endif; ?>" <?php if(!empty($searchContent)): ?>goodName="<?php echo ($searchContent); ?>"<?php endif; ?> />
    </ul>
  </div>
  <!--头部标签结束 -->
  <div class="ucenter_right_content lists_content" style="min-height:440px;">
    <?php if(empty($goodList)): ?><div style="height:32px;line-height:32px;text-align:center;color:red;">
        暂无商品！！！
      </div>
      <?php else: ?>
      <ul class="p_list">
        <?php if(is_array($goodList)): $i = 0; $__LIST__ = $goodList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
              <div class="list-wrap">
                <div class="p_pics">
                  <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['goodid']));?>" class="eshop_img" target="_blank"><img src="/eshop/<?php echo ($item["good_log"]); ?>"/>
                  </a>
                </div>
                <div class="p_sales">
                  <div class="p_price"> 
                    <strong><em style="color:red;">￥</em><i style="color:red;"><?php echo ($item["shopprice"]); ?></i></strong>
                  </div>
                  <div class="p_amounts"> 
                     <strong>销量：<span><?php echo ($item["count"]); ?></span></strong>
                  </div>
                </div>
                <div class="p_name"> 
                  <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['goodid']));?>" target="_blank"><?php echo ($item["name"]); ?>
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="<?php echo U('Home/Shop/index',array('shopId'=> $item['shopid']));?>" target="_blank"><?php echo ($item["shopname"]); ?></a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;"><?php echo ($item["place"]); ?></span>
                  </div>
                </div>
                <div class="p_operate">
                  <?php if(checkCollection($item['goodid'],0) == 1): ?><a href="javascript:void(0)" onclick="cancle(<?php echo ($item["goodid"]); ?>,0,<?php echo (session('uid')); ?>)">
                      <img src="/eshop/Public/Home/Icon/good-collection-do.png">
                      &nbsp;取消收藏
                    </a>
                    <?php else: ?>
                    <a href="javascript:void(0)" onclick="Collection(<?php echo ($item["goodid"]); ?>,0)">
                      <img src="/eshop/Public/Home/Icon/good-collection.png">
                      &nbsp;收藏
                    </a><?php endif; ?>
                  <a href="javascript:void(0);" style="float:right;" onclick="addCarts(<?php echo ($item["goodid"]); ?>,1)"> 
                    <img src="/eshop/Public/Home/Icon/add-cart.png">
                    &nbsp;加入购物车
                  </a>
                </div>
              </div>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul><?php endif; ?>
    <!-- 分页开始 -->
    <div class="pages" style="clear:both;"><?php echo ($page); ?></div>
  </div>
  <!--商品图片循环显示结束 -->
  <div class="float_clear"></div> 
  <?php if(!empty($history)): ?><div class="history_title"> 
      <span>最近浏览记录</span> 
    </div>
    <!-- 最近浏览记录标题结束 -->
    <div class="history_show">
     <ul class="p_list">
        <?php if(is_array($history)): $i = 0; $__LIST__ = $history;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
            <div class="list-wrap">
              <div class="p_pics">
                <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['id']));?>" class="eshop_img" target="_blank"><img src="/eshop/<?php echo ($item["good_log"]); ?>"/>
                </a>
              </div>
              <div class="p_sales">
                <div class="p_price"> 
                  <strong><em style="color:red;">￥</em><i style="color:red;"><?php echo ($item["shopprice"]); ?></i></strong>
                </div>
                <div class="p_amounts"> 
                 <strong>销量：<span><?php echo ($item["count"]); ?></span></strong>
               </div>
              </div>
              <div class="p_name"> 
              <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['id']));?>" target="_blank"><?php echo ($item["name"]); ?> 
              </a> 
              </div>
              <div class="p_shop_info">
              <div class="p_shop_name">
                <span><a href="<?php echo U('Home/Shop/index',array('shopId'=> $item['shopid']));?>" target="_blank"><?php echo ($item["shopname"]); ?></a></span>
              </div>
              <div class="p_good_place">
                <span style="color:#868686;"><?php echo ($item["place"]); ?></span>
              </div>
              </div>
              <div class="p_operate">
                <?php if(checkCollection($item['id'],0) == 1): ?><a href="javascript:void(0)" onclick="cancle(<?php echo ($item["id"]); ?>,0,<?php echo (session('uid')); ?>)">
                    <img src="/eshop/Public/Home/Icon/good-collection-do.png">
                    &nbsp;取消收藏
                  </a>
                  <?php else: ?>
                  <a href="javascript:void(0)" onclick="Collection(<?php echo ($item["id"]); ?>,0)">
                    <img src="/eshop/Public/Home/Icon/good-collection.png">
                    &nbsp;收藏
                  </a><?php endif; ?>
                <a href="javascript:void(0);" style="float:right;" onclick="addCarts(<?php echo ($item["id"]); ?>,1)"> 
                  <img src="/eshop/Public/Home/Icon/add-cart.png">
                  &nbsp;加入购物车
                </a>
              </div>
            </div>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>   
      </ul>
    </div><?php endif; ?>
  <!-- 最近浏览记录展示结束 --> 
</div>
<!--商品列表包裹显示结束 -->
<!-- 尾部开始 --> 
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
<!-- 尾部结束 --> 
</body>
</html>