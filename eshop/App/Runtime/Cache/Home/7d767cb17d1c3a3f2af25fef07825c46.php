<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>店铺首页</title>
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
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/smain.css">
<script src="/eshop/Public/Common/Js/myfocus-2.0.1.min.js"></script>
<script src="/eshop/Public/Common/Js/mF_fancy.js"></script>
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/mF_fancy.css">
<script src="/eshop/Public/Home/Js/Shop/index.js"></script>
</head>
<script type="text/javascript">
myFocus.set({
  id:'shopImg_roll',
  pattern:'mF_fancy',
  time:5,
  trigger:'click',
  width:1400,
  height:274
});
</script>
<body>
<!-- 店铺首页头部开始 -->
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
<!-- 店铺首页图片轮播开始 -->
<div id="shopImg_roll">
  <div class="loading"> <img src="/eshop/Public/Home/Image/loading.gif" alt="请稍后....." /> </div>
  <div class="pic">
    <?php if(empty($ads)): ?><ul>
        <li><img src="/eshop/Public/Home/Image/loading.gif" alt="请稍后....." /></li>
      </ul>
      <?php else: ?>
      <ul>
        <?php if(is_array($ads)): $i = 0; $__LIST__ = $ads;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li><a href="javascript:void(0);"><img src="/eshop/<?php echo ($item["imgurl"]); ?>" alt=""></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul><?php endif; ?>
  </div>
</div>
<!-- 店铺首页图片轮播结束 --> 
<!-- 中间内容开始 -->
<div class="shop_content_wrapper">
  <div class="shoper_recommend_title">
    <span class="title_item active" rel="item1">
      <a href="javascript:;">
        商家推荐
      </a>
    </span> 
    <span class="title_item" rel="item2"><a href="javascript:;">店铺热销</a></span>
 </div>
  <!-- 店长推荐标题结束 -->
  <!-- 店长推荐/本店热销内容开始 -->
  <div id="wrap">
    <div class="shoper_recommend_content" id="item1">
      <ul class="p_list">
        <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($data["is_recomend"] == 1): ?><li>
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
                  <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$data['goodid']));?>" target="_blank"><?php echo ($data["name"]); ?>
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="<?php echo U('Home/Shop/index',array('shopId'=> $shopInfo['id']));?>" target="_blank"><?php echo ($shopInfo["name"]); ?></a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;"><?php echo ($data["place"]); ?></span>
                  </div>
                </div>
                <div class="p_operate">
                  <?php if(checkCollection($data['id'],0) == 1): ?><a href="javascript:void(0)" onclick="cancle(<?php echo ($data["id"]); ?>,0,<?php echo (session('uid')); ?>)">
                      <img src="/eshop/Public/Home/Icon/good-collection-do.png">
                      &nbsp;取消收藏
                    </a>
                    <?php else: ?>
                    <a href="javascript:void(0)" onclick="Collection(<?php echo ($data["id"]); ?>,0)">
                      <img src="/eshop/Public/Home/Icon/good-collection.png">
                      &nbsp;收藏
                    </a><?php endif; ?>
                  <a href="javascript:void(0);" style="float:right;" onclick="addCarts(<?php echo ($data["id"]); ?>,1)"> 
                    <img src="/eshop/Public/Home/Icon/add-cart.png">
                    &nbsp;加入购物车
                  </a>
                </div>
              </div>
            </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
    <div class="shop_hotGoods_content" style="display:none" id="item2">
      <ul class="p_list">
        <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($data["is_hot"] == 1): ?><li>
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
                  <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$data['goodid']));?>" target="_blank"><?php echo ($data["name"]); ?>
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="<?php echo U('Home/Shop/index',array('shopId'=> $shopInfo['id']));?>" target="_blank"><?php echo ($shopInfo["name"]); ?></a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;"><?php echo ($data["place"]); ?></span>
                  </div>
                </div>
                <div class="p_operate">
                  <?php if(checkCollection($data['id'],0) == 1): ?><a href="javascript:void(0)" onclick="cancle(<?php echo ($data["id"]); ?>,0,<?php echo (session('uid')); ?>)">
                      <img src="/eshop/Public/Home/Icon/good-collection-do.png">
                      &nbsp;取消收藏
                    </a>
                    <?php else: ?>
                    <a href="javascript:void(0)" onclick="Collection(<?php echo ($data["id"]); ?>,0)">
                      <img src="/eshop/Public/Home/Icon/good-collection.png">
                      &nbsp;收藏
                    </a><?php endif; ?>
                  <a href="javascript:void(0);" style="float:right;" onclick="addCarts(<?php echo ($data["id"]); ?>,1)"> 
                    <img src="/eshop/Public/Home/Icon/add-cart.png">
                    &nbsp;加入购物车
                  </a>
                </div>
              </div>
            </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
  </div>
  <!-- 店长推荐/本店热销内容结束 -->
  <!-- 商店产品循环展示开始 -->
  <?php if(is_array($shopNav)): $i = 0; $__LIST__ = $shopNav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><div class="shop_product_show">
      <div class="products_title"> <span class="span1"><?php echo ($nav["name"]); ?></span> <span class="span2"><a href="<?php echo U('moreList',array('shopId' => $shopInfo['id'],'scat' => $nav[id]));?>" target="_blank">更多 &gt;&gt;</a></span> 
      </div>
      <div class="products_content">
        <ul class="p_list">
          <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($data["s_fid"] == $nav['id']): ?><li>
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
                    <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$data['goodid']));?>" target="_blank"><?php echo ($data["name"]); ?>
                    </a> 
                  </div>
                  <div class="p_shop_info">
                    <div class="p_shop_name">
                      <span><a href="<?php echo U('Home/Shop/index',array('shopId'=> $shopInfo['id']));?>" target="_blank"><?php echo ($shopInfo["name"]); ?></a></span>
                    </div>
                    <div class="p_good_place">
                      <span style="color:#868686;"><?php echo ($data["place"]); ?></span>
                    </div>
                  </div>
                  <div class="p_operate">
                    <?php if(checkCollection($data['id'],0) == 1): ?><a href="javascript:void(0)" onclick="cancle(<?php echo ($data["id"]); ?>,0,<?php echo (session('uid')); ?>)">
                        <img src="/eshop/Public/Home/Icon/good-collection-do.png">
                        &nbsp;取消收藏
                      </a>
                      <?php else: ?>
                      <a href="javascript:void(0)" onclick="Collection(<?php echo ($data["id"]); ?>,0)">
                        <img src="/eshop/Public/Home/Icon/good-collection.png">
                        &nbsp;收藏
                      </a><?php endif; ?>
                    <a href="javascript:void(0);" style="float:right;" onclick="addCarts(<?php echo ($data["id"]); ?>,1)"> 
                      <img src="/eshop/Public/Home/Icon/add-cart.png">
                      &nbsp;加入购物车
                    </a>
                  </div>
                </div>
              </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
  <!-- 商店产品循环展示结束 -->
  <div class="float_clear"></div>
  <?php if(!empty($history)): ?><div class="shop_history_title"> <span>最近浏览记录</span> </div>
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
<!-- 中间内容结束 --> 
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