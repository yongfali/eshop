<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>商品详细信息</title>
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
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/goods.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/smoothproducts.css">
<script src="/eshop/Public/Common/Js/smoothproducts.min.js"></script>
<script src="/eshop/Public/Home/Js/goodInfo.js"></script>
<script type="text/javascript">
  var goodPurchase = "<?php echo U('Home/ShoppingCart/purchase');?>";
  var toSettlement = "<?php echo U('Home/ShoppingCart/settlement');?>";
  var userLogin = "<?php echo U('Home/User/login');?>";
</script>
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

<div class="position_now">
  <label><a href="<?php echo U('Home/Index/index');?>" target="_blank">首页</a></label>
  <span>&gt</span>
  <label>商品详细信息</label>
</div>
<div class="goods_info">
  <div class="goods_info_left">
    <div class="zoom">
      <div class="sp-loading">
        <img src="#" alt=""><br>
        LOADING /eshop/Public/Home/GoodImage</div>
        <div class="sp-wrap">
          <?php if(empty($goodImgs)): ?><a href="/eshop/<?php echo ($goodInfo["good_log"]); ?>">
              <img src="/eshop/<?php echo ($goodInfo["good_log"]); ?>" alt="">
            </a> 
            <?php else: ?>
            <?php if(is_array($goodImgs)): $i = 0; $__LIST__ = $goodImgs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><a href="/eshop/<?php echo ($item["img"]); ?>">
                <img src="/eshop/<?php echo ($item["thumb_img"]); ?>" alt="">
              </a><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
      </div>
    </div>
    <!--商品图片放大显示结束 -->
    <div class="goods_intro">
      <h2 class="goods_name"><?php echo ($goodInfo["name"]); ?></h2>
      <div class="goods_items">
        <ul>
          <li>
            <label>市场价：</label>
            <span class="m_price">&yen;&nbsp;<?php echo ($goodInfo["marketprice"]); ?></span></li>
          <li>
            <label>促销价：</label>
            <span class="s_price">&yen;&nbsp;<?php echo ($goodInfo["shopprice"]); ?></span></li>
          <li>
            <label>商品产地：</label>
            <span><?php echo ($goodInfo["place"]); ?></span></li>
          <li>
            <label>商品编号：</label>
            <span><?php echo ($goodInfo["goodnumber"]); ?></span></li>
          <li>
            <label>购买数量：</label>
            <a href="javascript:void(0)" class="jian">-</a>
            <input class="goodnum" value="1" name="num[]" type="text">
            <a href="javascript:void(0)" class="jia">+</a><span id="goodStock" value="<?php echo ($goodInfo["stock"]); ?>">库存（<?php echo ($goodInfo["stock"]); ?>）</span></li>
        </ul>
      </div>
      <div class="goods_icon">
        <?php if(empty($$shopInfo["qrcode"])): ?><img src="/eshop/Public/Home/Image/float_icon_weixin.jpg">
          <?php else: ?>
          <img src="/eshop/<?php echo ($shopInfo["qrcode"]); ?>"><?php endif; ?> 
        <div style="text-align:center">（扫码关注店铺）</div>
      </div>
      <div class="select_btn"> 
        <a href="javascript:void(0);" class="goods_add"  onclick="addCarts(<?php echo ($goodInfo["id"]); ?>,1)">加入购物车</a> 
        <a href="javascript:void(0);" class="goods_buy" onclick="purchase(<?php echo ($goodInfo["id"]); ?>)">立即购买</a>
        <?php if(checkCollection($goodInfo['id'],0) == 1): ?><a href="javascript:void(0);" class="goods_collection-do" onclick="cancle(<?php echo ($goodInfo["id"]); ?>,0,<?php echo (session('uid')); ?>)">
            <img src="/eshop/Public/Home/Icon/good-collection-do.png">
            取消收藏
          </a>
          <?php else: ?>
          <a href="javascript:void(0);" class="goods_collection" onclick="Collection(<?php echo ($goodInfo["id"]); ?>,0)">
            <img src="/eshop/Public/Home/Icon/good-collection.png">
            收藏商品
          </a><?php endif; ?>
      </div>
    </div>
    <!--图片右侧介绍信息结束 -->
    <div class="goods_moreInfo">
      <div class="wrapper">
        <div class="shoper_info">
          <h3><?php echo ($shopInfo["name"]); ?></h3>
          <div class="shoper_item">
            <div class="shop_logo">
              <?php if(empty($$shopInfo["logo"])): ?><img src="/eshop/Public/Home/ShopImage/shop_logo.jpg">
                <?php else: ?>
                <img src="/eshop/<?php echo ($shopInfo["logo"]); ?>"><?php endif; ?>  
            </div>
            <div class="itemscore">商品评分：<?php echo sprintf("%.1f", $goodScore);?>分</div>
            <div class="itemscore">服务评分：<?php echo sprintf("%.1f", $logisticsSocre);?>分</div>
            <div class="itemscore">物流评分：<?php echo sprintf("%.1f", $serviceScore);?>分</div>
            <div class="shop_footer"> 
              <a href="<?php echo U('Home/Shop/index',array('shopId'=>$shopInfo['id']));?>" target="_blank">进店逛逛</a>
              <?php if(checkCollection($shopInfo['id'],1) == 1): ?><a href="javascript:void(0);" onclick="cancle(<?php echo ($shopInfo["id"]); ?>,1,<?php echo (session('uid')); ?>)">取消关注</a>
                <?php else: ?>
                <a href="javascript:void(0);" onclick="Collection(<?php echo ($shopInfo["id"]); ?>,1)">关注本店</a><?php endif; ?>
            </div>
          </div>
        </div>
        <div class="shop_recommend">
          <h3>店主推荐</h3>
          <?php if(empty($recomendGoods)): else: ?>
            <ul class="p_list">
              <?php if(is_array($recomendGoods)): $i = 0; $__LIST__ = $recomendGoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
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
                        <span><a href="<?php echo U('Home/Shop/index',array('shopId'=> $item['shopid']));?>" target="_blank"><?php echo ($shopInfo["name"]); ?></a></span>
                      </div>
                      <div class="p_good_place">
                        <span style="color:#868686;"><?php echo ($item["place"]); ?></span>
                      </div>
                    </div>
                  </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul><?php endif; ?>
        </div>
      </div>
      <!-- 店铺信息和商家推荐结束-->
      <div class="goods_details">
        <div class="details_nav">
          <ul>
            <a href="javascript:void(0);" class="nav_active" rel="nav1">商品详情</a> <a href="javascript:void(0);" rel="nav2">商品评论（<?php echo (count($goodComment)); ?>）</a> <a href="javascript:void(0);" rel="nav3">专享服务</a>
          </ul>
        </div>
        <div class="details_wrapper">
          <div class="details_content" id="nav1">
            <div class="goods_detail_lists">
              <ul>
                <?php if(is_array($goodLable)): $i = 0; $__LIST__ = $goodLable;if( count($__LIST__)==0 ) : echo "该商品还没有详细信息！！！" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li>
                    <?php echo ($data["name"]); ?>：
                    <?php if($data["lablecontent"] == '1'): ?>是
                      <?php elseif($data["lablecontent"] == '0'): ?>
                      否
                      <?php else: ?>
                      <?php echo ($data["lablecontent"]); endif; ?>
                  </li><?php endforeach; endif; else: echo "该商品还没有详细信息！！！" ;endif; ?>           
              </ul>
            </div>
            <div class="goods_img">
              <ul>
                <li><img src="/eshop/Public/Home/Image/sg5.jpg" alt=""></li>
                <li><img src="/eshop/Public/Home/Image/sg4.jpg" alt=""></li>
                <li><img src="/eshop/Public/Home/Image/sg3.jpg" alt=""></li>
              </ul>
            </div>
          </div>
          <!--商品详细参数结束 -->
          <div class="details_content" id="nav2" style="display:none;">
            <ul class="s_comment">
              <?php if(is_array($goodComment)): $i = 0; $__LIST__ = $goodComment;if( count($__LIST__)==0 ) : echo "暂时没有评论！！！" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li>
                  <div class="s_comment_left">
                    <div class="user_photo">
                      <?php if($data["photo"] == null ): ?><img src="/eshop/Public/Home/Icon/user_photo.png">
                        <?php else: ?>
                        <img src="/eshop/<?php echo ($data["photo"]); ?>"><?php endif; ?>  
                    </div>
                    <div class="user_name"><?php echo ($data["name"]); ?></div>
                  </div>
                  <div class="s_comment_right">
                    <div class="texts"><?php echo ($data["contents"]); ?></div>
                    <div class="p_date"><?php echo (date("Y-m-d h:m",$data["time"])); ?>&nbsp;&nbsp;详情：<?php echo ($goodInfo["name"]); ?></div>
                  </li><?php endforeach; endif; else: echo "暂时没有评论！！！" ;endif; ?>      
            </ul>
          </div>
          <!--商品评论结束 -->
          <div class="details_content" id="nav3" style="display:none;">
            <?php if(empty($goodService[0]["content"])): ?>商家很懒，还没有填写任何东西！！！
              <?php else: ?> 
              <?php echo (html_entity_decode($goodService[0]["content"])); endif; ?> 
          </div>
          <!--商品专享服务结束 --> 
        </div>
      </div>
      <!--商品详细参数和评论结束 --> 
    </div>
  </div>
  <!--商品内容左侧显示结束 -->
  <div class="goods_info_right">
    <?php if(!empty($likeGoods)): ?><div class="like_wrap">
        <h3>您可能喜欢</h3>
        <div class="like">
          <ul class="p_list">
            <?php if(is_array($likeGoods)): $i = 0; $__LIST__ = $likeGoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
                <div class="list-wrap">
                    <div class="p_pics">
                      <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['id']));?>" class="eshop_img" target="_bank"><img src="/eshop/<?php echo ($item["good_log"]); ?>"/>
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
                    <div class="p_name" style="max-height:60px;overflow:hidden;min-height: auto;"> 
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
                </div>
              </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
      </div><?php endif; ?>
    <?php if(!empty($history)): ?><div class="history_wrap">
        <h3>浏览记录</h3>
        <div class="history">
          <ul class="p_list">
            <?php if(is_array($history)): $i = 0; $__LIST__ = array_slice($history,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
                <div class="list-wrap">
                  <div class="p_pics">
                    <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['id']));?>" class="eshop_img" target="_bank"><img src="/eshop/<?php echo ($item["good_log"]); ?>"/>
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
                 <div class="p_name" style="max-height:60px;overflow:hidden;min-height: auto;"> 
                  <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['id']));?>" target="_blank"><?php echo ($item["name"]); ?>
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="<?php echo U('Home/Shop/index',array('shopId'=>$shopInfo['id']));?>" target="_blank"><?php echo ($shopInfo["name"]); ?></a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;"><?php echo ($item["place"]); ?></span>
                  </div>
                </div>
              </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
      </div><?php endif; ?>
  </div>
  <!--商品内容右侧显示结束 --> 
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