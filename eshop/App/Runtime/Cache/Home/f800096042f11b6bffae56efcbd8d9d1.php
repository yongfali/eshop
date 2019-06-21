<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>店铺商品列表详情</title>
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
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/smain.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/Shop/moreList.css">
<script src="/eshop/Public/Home/Js/Shop/moreList.js"></script>
<script type="text/javascript">
  var goodsOrder = "<?php echo U('Home/Shop/goodsOrder',array('shopId' => $shopInfo['id']));?>";
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
<!-- 中间内容开始 -->
<div class="sContent_wrapper">
  <div class="sContent_left">
    <div class="left_nav">
      <h3>宝贝分类</h3>
      <ul class="left_nav_items">
        <?php if(is_array($shopNav)): $i = 0; $__LIST__ = $shopNav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$items): $mod = ($i % 2 );++$i;?><li> 
            <a href="<?php echo U('Home/Shop/moreList',array('shopId' => $shopInfo['id'],'scat' => $items[id]));?>" class="nav_item"><?php echo ($items["name"]); ?>
            <p class="items_show"></p>
            </a>
            <?php if($items["childNum"] > 0): ?><ul class="items_content">
                <?php if(is_array($items["child"])): $i = 0; $__LIST__ = $items["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Home/Shop/moreList',array('shopId' => $shopInfo['id'],'scat' => $items[id],'scat2' => $data[id]));?>">
                  <li><?php echo ($data["sname"]); ?></li>
                </a><?php endforeach; endif; else: echo "" ;endif; ?>
              </ul><?php endif; ?>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div><!-- 店铺商品导航结束 --> 
  </div>
  <!-- 左边导航和商家推荐列表结束 -->
  <div class="sContent_right">
    <?php if(!empty($hotGoods)): ?><div class="right_hot_product">
        <div class="hot_title">
          <span>本店热销</span>
        </div>
        <div class="shop_Product_show">
          <ul class="p_list">
            <?php if(is_array($hotGoods)): $i = 0; $__LIST__ = $hotGoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
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
                      <span><a href="<?php echo U('Home/Shop/index',array('shopId'=> $shopInfo['id']));?>" target="_blank"><?php echo ($shopInfo["name"]); ?></a></span>
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
        </div>
      </div><!-- 本店热销产品结束 --><?php endif; ?>
    <!-- 分类导航标签 -->
    <div class="category_nav">
      <ul>
        <a href="javascript:void(0)" class="nav_active" rel="desc" onclick="goodOrder(this,1)" ><li>综合排序</li></a>
        <a href="javascript:void(0)" onclick="goodOrder(this,2)" rel="desc"><li>单价</li><span class="select_icon"></span></a>
        <a href="javascript:void(0)" onclick="goodOrder(this,3)" rel="desc"><li>销量</li><span class="select_icon"></span></a>
        <input id="cats" type="hidden" shopId="<?php echo ($shopInfo["id"]); ?>" val="<?php if(empty($scat1)): ?>0<?php else: echo ($scat1); endif; ?>" rel="<?php if(empty($scat2)): ?>0<?php else: echo ($scat2); endif; ?>" vals="<?php if(empty($pageType)): ?>more<?php else: echo ($pageType); endif; ?>" <?php if(!empty($searchContent)): ?>goodName="<?php echo ($searchContent); ?>"<?php endif; ?>/>
      </ul>
    </div>
    <!-- 分类导航标签 -->
    <div class="right_category_ajax">
      <div class="right_category_product">
        <?php if(empty($goods)): ?><div style="color:red; text-align:center;">暂没有商品！！！</div>
          <?php else: ?>
          <div class="shop_category_show">
            <ul class="p_list">
              <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
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
                        <span><a href="<?php echo U('Home/Shop/index',array('shopId'=> $shopInfo['id']));?>" target="_blank"><?php echo ($shopInfo["name"]); ?></a></span>
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
      </div><!-- 对应类别商品循环展示 -->
      <!-- 分页开始 -->
      <div class="pages" style="clear:both;"><?php echo ($page); ?></div>
    </div>
    <!-- 分页结束 --> 
  </div><!-- 右边商品展示区结束 --> 
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