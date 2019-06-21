<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>首页</title>
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
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/main.css">
<script src="/eshop/Public/Home/Js/main.js"></script>
<script src="/eshop/Public/Common/Js/myfocus-2.0.1.min.js"></script>
<script src="/eshop/Public/Common/Js/mF_qiyi.js"></script>
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/mF_qiyi.css">
<script type="text/javascript">
myFocus.set({
  id:'img_roll',
  pattern:'mF_qiyi',
  time:3,
  trigger:'click',
  width:612,
  height:274
});
</script>
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
<!-- 中间开始 -->
<div class="content">
  <div class="list_nav">
    <!-- 导航菜单开始 -->
    <div class="list_nav_left">
      <ul class="topmenu">
        <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="lists">
            <a href="<?php echo U('moreGoods',array('fmenu' => $item['id']));?>" target="_blank"><?php echo ($item["name"]); ?></a> 
            <div class="submenu">
              <div class="leftdiv">
                <?php if(is_array($item["child"])): $i = 0; $__LIST__ = $item["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><dl>
                    <dt><a href="<?php echo U('moreGoods',array('fmenu' => $item['id'],'smenu' => $data['id']));?>" target="_blank"><?php echo ($data["name"]); ?></a></dt>
                    <dd>
                      <?php if(is_array($data["child"])): $i = 0; $__LIST__ = $data["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tmenu): $mod = ($i % 2 );++$i;?><a href="<?php echo U('moreGoods',array('fmenu' => $item['id'],'smenu' => $data['id'],'tmenu'=>$tmenu['id']));?>" target="_blank"><?php echo ($tmenu["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                    </dd>
                  </dl><?php endforeach; endif; else: echo "" ;endif; ?>
              </div>
            </div>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
    <!-- 导航菜单结束 -->
    <!-- 商城广告开始 -->
    <div id="img_roll">
      <div class="loading"> <img src="/eshop/Public/Home/Image/loading.gif" alt="请稍后....." /> </div>
      <div class="pic">
        <ul>
          <li><a href="#"><img src="/eshop/Public/Home/Image/1.jpg" alt="图片1"></a></li>
          <li><a href="#"><img src="/eshop/Public/Home/Image/2.jpg" alt="图片2"></a></li>
          <li><a href="#"><img src="/eshop/Public/Home/Image/3.jpg" alt="图片3"></a></li>
          <li><a href="#"><img src="/eshop/Public/Home/Image/4.jpg" alt="图片4"></a></li>
          <li><a href="#"><img src="/eshop/Public/Home/Image/5.jpg" alt="图片5"></a></li>
        </ul>
      </div>
    </div>
    <!-- 商城广告结束 -->
    <!-- 商城通知开始 -->
    <div class="note">
      <div class="note_nav">
        <ul>
          <a href="javascript:void(0);" rel="noteBox" class="nav_active" val="con1" vals="con2">公告</a> 
          <a href="javascript:void(0);" rel="noteBox2" val="con3" vals="con4">资讯</a> 
          <a href="javascript:void(0);" rel="noteBox3" val="con5" vals="con6">优惠活动</a> 
          <a href="<?php echo U('Home/Index/infoLists',array('type' => 'note'));?>" target="_blank">更多</a>
        </ul>
      </div>
      <div class="info_wrapper">
        <div id="noteBox" class="info_items">
          <?php if(empty($note)): else: ?>
            <ul id="con1">
              <?php if(is_array($note)): $i = 0; $__LIST__ = $note;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Index/infoDetail',array('id' => $item['id']));?>" target="_blank"><?php echo ($i); ?>. <?php echo ($item["title"]); ?></a><span><?php echo (date("Y-m-d",$item["modify_time"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul><?php endif; ?>
          <ul id="con2">
          </ul>
        </div>
        <div  id="noteBox2" style="display:none;" class="info_items">
          <?php if(empty($infomation)): else: ?>
            <ul id="con3">
              <?php if(is_array($infomation)): $i = 0; $__LIST__ = $infomation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Index/infoDetail',array('id' => $item['id']));?>" target="_blank"><?php echo ($i); ?>. <?php echo ($item["title"]); ?></a><span><?php echo (date("Y-m-d",$item["modify_time"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul><?php endif; ?>
          <ul id="con4">
          </ul>
        </div>
        <div  id="noteBox3" style="display:none;" class="info_items">
          <?php if(empty($discountInfo)): else: ?>
            <ul id="con5">
              <?php if(is_array($discountInfo)): $i = 0; $__LIST__ = $discountInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Index/infoDetail',array('id' => $item['id']));?>" target="_blank"><?php echo ($i); ?>. <?php echo ($item["title"]); ?></a><span><?php echo (date("Y-m-d",$item["modify_time"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul><?php endif; ?>
          <ul id="con6">
          </ul>
        </div>
      </div>
    </div>
    <!-- 商城通知结束 -->
  </div>
  <!-- 左侧二级导航右侧图片轮播和公告结束--> 
  <!-- 商品列表循环展示开始-->
  <div id="product_wrapper">
    <?php if(is_array($menu)): $k = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><div class="product_show" id="floor<?php echo ($k); ?>">
        <div class="title">
          <div class="title_left">
            <h3><span class="floor"><?php echo ($k); ?>F</span><?php echo ($item["name"]); ?></h3>
          </div>
          <div class="title_right"><a href="<?php echo U('moreGoods',array('fmenu' => $item['id']));?>" target="_blank">More&gt;&gt;</a></div>
        </div>
        <div class="category">
          <div class="advertisement">
            <div class="icon"> 
              <a href="#">
                <img src="/eshop/Public/Home/Image/icon.jpg"/>
              </a> 
            </div>
            <!-- <div class="icon"> 
              <a href="#">
                <img src="/eshop/Public/Home/Image/icon.jpg"/>
              </a> 
            </div> -->
          </div>
          <ul class="p_list">
            <?php if(is_array($goodList)): $i = 0; $__LIST__ = $goodList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($data['w_fid'] == $item['id']): ?><li>
                  <div class="list-wrap">
                    <div class="p_pics">
                      <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$data['goodid']));?>" class="eshop_img" target="_blank"><img src="/eshop/<?php echo ($data["good_log"]); ?>"/>
                      </a>
                    </div>
                    <div class="p_sales">
                      <div class="p_price"> 
                        <strong><em style="color:red;">￥</em><i style="color:red;"><?php echo ($data["shopprice"]); ?></i></strong>
                      </div>
                      <div class="p_amounts"> 
                       <strong>销量：<span><?php echo ($data["count"]); ?></span></strong>
                     </div>
                    </div>
                    <div class="p_name"> 
                      <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$data['goodid']));?>" target="_blank"><?php echo ($data["goodname"]); ?>
                      </a> 
                    </div>
                    <div class="p_shop_info">
                      <div class="p_shop_name">
                        <span><a href="<?php echo U('Home/Shop/index',array('shopId'=> $data['shopid']));?>" target="_blank"><?php echo ($data["shopname"]); ?></a></span>
                      </div>
                      <div class="p_good_place">
                        <span style="color:#868686;"><?php echo ($data["place"]); ?></span>
                      </div>
                    </div>
                    <div class="p_operate">
                      <?php if(checkCollection($data['goodid'],0) == 1): ?><a href="javascript:void(0)" onclick="cancle(<?php echo ($data["goodid"]); ?>,0,<?php echo (session('uid')); ?>)">
                          <img src="/eshop/Public/Home/Icon/good-collection-do.png">
                          &nbsp;取消收藏
                        </a>
                        <?php else: ?>
                        <a href="javascript:void(0)" onclick="Collection(<?php echo ($data["goodid"]); ?>,0)">
                          <img src="/eshop/Public/Home/Icon/good-collection.png">
                          &nbsp;收藏
                        </a><?php endif; ?>
                      <a href="javascript:void(0);" style="float:right;" onclick="addCarts(<?php echo ($data["goodid"]); ?>,1)"> 
                        <img src="/eshop/Public/Home/Icon/add-cart.png">
                        &nbsp;加入购物车
                      </a>
                    </div>
                  </div>
                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
  <!-- 商品列表循环展示结束--> 
</div>
<!-- 中间结束--> 
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
<!--左侧楼层悬浮导航栏开始 -->
<div id="left_float_menu">
  <ul>
    <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
        <a href="#floor<?php echo ($i); ?>" class="current"><?php echo ($i); ?>F</a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
</div>
<!--左侧楼层悬浮导航栏结束 --> 
<!--右侧服务悬浮导航栏开始-->
<div id="right_float_menu">
  <ul id="float_menu">
    <li class="menu_up"><a href="javascript:void(0);">返回顶部</a></li>
    <li class="menu_qq"><a href="tencent://message/?uin=1411387106&Site=qq&Menu=yes"> 客服咨询</a></li>
    <li class="menu_tel">88888888</li>
    <li class="menu_weixin">关注微信<br/>
      <img src="/eshop/Public/Home/Image/float_icon_weixin.jpg"/></li>
  </ul>
</div>
<!--右侧服务悬浮导航栏结束-->
</body>
<!--公告栏标题点击背景改变和对应div显示事件-->
<script type="text/javascript">
  $(function(){
    $(document).on('click','.note_nav a',function(){
      var numid = $(this).attr('rel');
      $("#"+numid).css("display", "block").siblings().css("display", "none");
      $(this).addClass('nav_active').siblings().removeClass('nav_active');
    });
  });
</script>
<!-- 公告信息滚动显示脚本-->
<script type="text/javascript">
  // var item = $('.nav_active').attr('rel');
  // var value = $('.nav_active').attr('val');
  // var value1 = $('.nav_active').attr('vals');
  // var area = document.getElementById(item);
  // var con1 = document.getElementById(value);
  // var con2 = document.getElementById(value1);
  // var speed = 60;
  // area.scrollTop = 0;
  // con2.innerHTML = con1.innerHTML;
  //   function scrollUp(){
  //     if(area.scrollTop >= con1.scrollHeight) 
  //     {
  //       area.scrollTop = 0;
  //     }
  //     else{
  //       area.scrollTop ++; 
  //     } 
  //   }
  //   var myScroll = setInterval("scrollUp()",speed);
  //   area.onmouseover = function(){
  //    clearInterval(myScroll);
  //   }
  //   area.onmouseout = function(){
  //    myScroll = setInterval("scrollUp()",speed);
  //   }
</script>
<!--左侧楼层悬浮脚本-->
<script type="text/javascript">
$(document).ready(function () {
            $(window).scroll(function () {
                var items = $("#product_wrapper").find(".product_show");
                var menu = $("#left_float_menu");
                var top = $(document).scrollTop();
                var currentId = ""; //滚动条现在所在位置的item id
                items.each(function () {
                    var m = $(this);
                    //m.offset().top代表每一个item的顶部位置
                    if (top > m.offset().top - 400) {
                        currentId = "#" + m.attr("id");
                    } else {
                        return false;
                    }
                });
                var currentLink = menu.find(".current");
                if (currentId && currentLink.attr("href") != currentId) {
                    currentLink.removeClass("current");
                    menu.find("[href=" + currentId + "]").addClass("current");
                }
            });
            //滚动事件超过一定高度才开始显示距离底部一定距离时影藏
            $(function(){
              var minHeight = 100;
              var maxHeight = $(document).height()-800;
                $(window).scroll(function(){
                  if ($(window).scrollTop() > minHeight&&$(window).scrollTop()<maxHeight) {
                      $("#left_float_menu").css("display","block");
                  }
                  else{
                     $("#left_float_menu").css("display","none");
                  }
                });
            });
        });
</script>
<!--右侧悬停按钮事件-->
<script type="text/javascript">
  $(document).ready(function(){  
  	//鼠标悬停
  	var fm = $("#right_float_menu");
  	fm.hover(function(){
      fm.css("right","5px");
  		$(".menu_weixin").css("height","180px");
    },function(){
  		fm.css("right","-127px");
  		$(".menu_weixin").css("height","53px");
  	});
		//返回顶部
		$(".menu_up").click(function(){
      $("html,body").animate({
			 'scrollTop': '0px'
		  }, 200)
    });
		//滚动事件
		$(function(){    
      $(window).scroll(function(){    
        if($(window).scrollTop() > 700){     
          $('.menu_up').css('display','block');   
        }    
        else{     
          $('.menu_up').css('display','none');    
        }    
      });    
    });    
  });
</script>
<script type="text/javascript">
  // 购物车列表显示隐藏hover事件
  $(function(){
    $('.cart_icon').on('mouseenter',function(){
        $(this).css('background','#eee');
        $('.cart-content').show();
    }).on('mouseleave',function(){
        $('.cart-content').hide();
        if($('.cart-content').data('events','mouseenter')){
            $('.cart-content').on('mouseenter', function(){
          $('.cart-content').show();
      });
    }
    else{
      $('.cart-content').hide();
    }
  });
    $('.cart-content').mouseleave(function(){
      $('.cart-content').hide();
    });
  });
</script>
</html>