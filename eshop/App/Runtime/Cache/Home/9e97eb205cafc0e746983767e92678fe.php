<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>商品详细信息</title>
<!-- 用户和商家页面公共脚本引用链接 -->
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/common.css">
<script src="/eshop/Public/Common/Js/jquery-2.1.1.min.js"></script>
<script src="/eshop/Public/Common/Js/jquery.validate.js"></script>
<script src="/eshop/Public/Common/layer/layer.js"></script>
<script src="/eshop/Public/Common/Js/common.js"></script>
<script src="/eshop/Public/Common/My97DatePicker/WdatePicker.js"></script>
<!-- 购物车脚本 -->
<script src="/eshop/Public/Home/Js/goodCart.js"></script>
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/goods.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/smoothproducts.css">
<script src="/eshop/Public/Common/Js/smoothproducts.min.js"></script>
<script src="/eshop/Public/Home/Js/goodInfo.js"></script>
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
  </div>
    <div class="header_right">
      <ul>  
        <li class="header_nav"><a href="#">商户中心</a>
          <ul>
            <li><a href="<?php echo U('Home/Shoper/regist');?>">免费开店</a></li>
            <li><a href="<?php echo U('Home/Shoper/index');?>">商家登录</a></li>
            <li><a href="<?php echo U('Home/ShopCart/index');?>">店铺中心</a></li>
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
            <li><a href="ucenter_account.html">账号安全</a></li>
            <li><a href="#">我的评论</a></li>
            <li><a href="<?php echo U('Home/UserCenter/modifyPwd');?>">修改密码</a></li>
          </ul>
        </li>
        <li class="header_nav"><a href="#">我的订单</a>
          <ul>
            <li><a href="#">所有订单</a></li>
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
  <div class="good_cart" >
    <div class="cart_icon">
      <span class="cart-left"> 
        <a href="shopcart.html" target="_blank">我的购物车</a>
      </span>
      <span class="cart-num">3</span>
      <span class="cart-right">
        <img src="/eshop/Public/Home/Icon/cart.png">
      </span>
    </div>
    <div class="cart-content" style="display:none;">
      <div class="title-name">
        <strong style="color:#666">最新添加的商品</strong>
      </div>
      <div class="cart-contetn-list">
        <ul>
          <li>
            <div class="p-img">
              <a href="goods_info.html" target="_blank">
                <img src="/eshop/Public/Home/Image/sg1.jpg" alt="" width="50" height="50">
              </a>
            </div>      
            <div class="p-name">
              <a href="goods_info.html" target="_blank">树懒果园 墨西哥进口牛油果 6个 1-1.2kg
              </a>
            </div>      
            <div class="p-detail">          
              <span class="p-price">
                <strong>&yen;99.00&nbsp;</strong>×1
              </span>                   
              <br>          
              <a class="delete" href="#">删除</a>      
            </div>  
          </li>
          <li>
            <div class="p-img">
              <a href="goods_info.html" target="_blank">
                <img src="/eshop/Public/Home/Image/sg1.jpg" alt="" width="50" height="50">
              </a>
            </div>      
            <div class="p-name">
              <a href="goods_info.html" target="_blank">树懒果园 墨西哥进口牛油果 6个 1-1.2kg
              </a>
            </div>      
            <div class="p-detail">          
              <span class="p-price">
                <strong>&yen;99.00&nbsp;</strong>×1
              </span>                   
              <br>          
              <a class="delete" href="#">删除</a>      
            </div>  
          </li>
          <li>
            <div class="p-img">
              <a href="goods_info.html" target="_blank">
                <img src="/eshop/Public/Home/Image/sg1.jpg" alt="" width="50" height="50">
              </a>
            </div>      
            <div class="p-name">
              <a href="goods_info.html" target="_blank">树懒果园 墨西哥进口牛油果 6个 1-1.2kg
              </a>
            </div>      
            <div class="p-detail">          
              <span class="p-price">
                <strong>&yen;99.00&nbsp;</strong>×1
              </span>                   
              <br>          
              <a class="delete" href="#">删除</a>
            </div>  
          </li>
        </ul>
      </div>
      <div class="cart-total">
        <span>共3件商品，共计<strong>&yen;&nbsp;98</strong></span>
        <a href="<?php echo U('ShoppingCart/index');?>" target="_blank">去购物车</a>
      </div>
    </div>
  </div>
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
<!-- 网站导航开始2017-04-01新增 -->
    <!-- <div class="list_nav_left1"  style="display:none;">
      <div class="all-sort-list" >
        <div class="item bo">
          <h3><span>·</span><a href="">图书</a>、<a href="">音像</a>、<a href="">数字商品</a></h3>
          <div class="item-list clearfix">
            <div class="close">x</div>
            <div class="subitem">
              <dl class="fore1">
                <dt><a href="#">电子书0</a></dt>
                <dd><em><a href="#">免费</a></em><em><a href="#">小说</a></em><em><a href="#">励志与成功</a></em><em><a href="#">婚恋/两性</a></em><em><a href="#">文学</a></em><em><a href="#">经管</a></em><em><a href="#">畅读VIP</a></em></dd>
              </dl>
              <dl class="fore2">
                <dt><a href="#">数字音乐</a></dt>
                <dd><em><a href="#">通俗流行</a></em><em><a href="#">古典音乐</a></em><em><a href="#">摇滚说唱</a></em><em><a href="#">爵士蓝调</a></em><em><a href="#">乡村民谣</a></em><em><a href="#">有声读物</a></em></dd>
              </dl>
              <dl class="fore3">
                <dt><a href="#">音像</a></dt>
                <dd><em><a href="#">音乐</a></em><em><a href="#">影视</a></em><em><a href="#">教育音像</a></em><em><a href="#">游戏</a></em></dd>
              </dl>
              <dl class="fore4">
                <dt>文艺</dt>
                <dd><em><a href="#">小说</a></em><em><a href="#">文学</a></em><em><a href="#">青春文学</a></em><em><a href="#">传记</a></em><em><a href="#">艺术</a></em></dd>
              </dl>
              <dl class="fore5">
                <dt>人文社科</dt>
                <dd><em><a href="#">历史</a></em><em><a href="#">心理学</a></em><em><a href="#">政治/军事</a></em><em><a href="#">国学/古籍</a></em><em><a href="#">哲学/宗教</a></em><em><a href="#">社会科学</a></em></dd>
              </dl>
              <dl class="fore6">
                <dt>经管励志</dt>
                <dd><em><a href="#">经济</a></em><em><a href="#">金融与投资</a></em><em><a href="#">管理</a></em><em><a href="#">励志与成功</a></em></dd>
              </dl>
              <dl class="fore7">
                <dt>生活</dt>
                <dd><em><a href="#">家庭与育儿</a></em><em><a href="#">旅游/地图</a></em><em><a href="#">烹饪/美食</a></em><em><a href="#">时尚/美妆</a></em><em><a href="#">家居</a></em><em><a href="#">婚恋与两性</a></em><em><a href="#">娱乐/休闲</a></em><em><a href="#">健身与保健</a></em><em><a href="#">动漫/幽默</a></em><em><a href="#">体育/运动</a></em></dd>
              </dl>
              <dl class="fore8">
                <dt>科技</dt>
                <dd><em><a href="#">科普</a></em><em><a href="#">IT</a></em><em><a href="#">建筑</a></em><em><a href="#">医学</a></em><em><a href="#">工业技术</a></em><em><a href="#">电子/通信</a></em><em><a href="#">农林</a></em><em><a href="#">科学与自然</a></em></dd>
              </dl>
              <dl class="fore9">
                <dt>少儿</dt>
                <dd><em><a href="#">少儿</a></em><em><a href="#">0-2岁</a></em><em><a href="#">3-6岁</a></em><em><a href="#">7-10岁</a></em><em><a href="#">11-14岁</a></em></dd>
              </dl>
              <dl class="fore10">
                <dt>教育</dt>
                <dd><em><a href="#">教材教辅</a></em><em><a href="#">考试</a></em><em><a href="#">外语学习</a></em></dd>
              </dl>
              <dl class="fore11">
                <dt>其它</dt>
                <dd><em><a href="#">英文原版书</a></em><em><a href="#">港台图书</a></em><em><a href="#">工具书</a></em><em><a href="#">套装书</a></em><em><a href="#">杂志/期刊</a></em></dd>
              </dl>
            </div>
            <div class="cat-right">
              <dl class="categorys-promotions" clstag="homepage|keycount|home2013|0601c">
                <dd>
                  <ul>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="特价书满减"></a></li>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="重磅独家"></a></li>
                  </ul>
                </dd>
              </dl>
              <dl class="categorys-brands" clstag="homepage|keycount|home2013|0601d">
                <dt>推荐品牌出版商</dt>
                <dd>
                  <ul>
                    <li><a href="#" target="_blank">中华书局</a></li>
                    <li><a href="#" target="_blank">人民邮电出版社</a></li>
                    <li><a href="#" target="_blank">上海世纪出版股份有限公司</a></li>
                    <li><a href="#" target="_blank">电子工业出版社</a></li>
                    <li><a href="#" target="_blank">三联书店</a></li>
                    <li><a href="#" target="_blank">浙江少年儿童出版社</a></li>
                    <li><a href="#" target="_blank">人民文学出版社</a></li>
                    <li><a href="#" target="_blank">外语教学与研究出版社</a></li>
                    <li><a href="#" target="_blank">中信出版社</a></li>
                    <li><a href="#" target="_blank">化学工业出版社</a></li>
                    <li><a href="#" target="_blank">北京大学出版社</a></li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="item">
          <h3><span>·</span><a href="">图书</a>、<a href="">音像</a>、<a href="">数字商品</a></h3>
          <div class="item-list clearfix">
            <div class="close">x</div>
            <div class="subitem">
              <dl class="fore1">
                <dt><a href="#">电子书1</a></dt>
                <dd><em><a href="#">免费</a></em><em><a href="#">小说</a></em><em><a href="#">励志与成功</a></em><em><a href="#">婚恋/两性</a></em><em><a href="#">文学</a></em><em><a href="#">经管</a></em><em><a href="#">畅读VIP</a></em></dd>
              </dl>
              <dl class="fore2">
                <dt><a href="#">数字音乐</a></dt>
                <dd><em><a href="#">通俗流行</a></em><em><a href="#">古典音乐</a></em><em><a href="#">摇滚说唱</a></em><em><a href="#">爵士蓝调</a></em><em><a href="#">乡村民谣</a></em><em><a href="#">有声读物</a></em></dd>
              </dl>
              <dl class="fore3">
                <dt><a href="#">音像</a></dt>
                <dd><em><a href="#">音乐</a></em><em><a href="#">影视</a></em><em><a href="#">教育音像</a></em><em><a href="#">游戏</a></em></dd>
              </dl>
              <dl class="fore4">
                <dt>文艺</dt>
                <dd><em><a href="#">小说</a></em><em><a href="#">文学</a></em><em><a href="#">青春文学</a></em><em><a href="#">传记</a></em><em><a href="#">艺术</a></em></dd>
              </dl>
              <dl class="fore5">
                <dt>人文社科</dt>
                <dd><em><a href="#">历史</a></em><em><a href="#">心理学</a></em><em><a href="#">政治/军事</a></em><em><a href="#">国学/古籍</a></em><em><a href="#">哲学/宗教</a></em><em><a href="#">社会科学</a></em></dd>
              </dl>
              <dl class="fore6">
                <dt>经管励志</dt>
                <dd><em><a href="#">经济</a></em><em><a href="#">金融与投资</a></em><em><a href="#">管理</a></em><em><a href="#">励志与成功</a></em></dd>
              </dl>
              <dl class="fore7">
                <dt>生活</dt>
                <dd><em><a href="#">家庭与育儿</a></em><em><a href="#">旅游/地图</a></em><em><a href="#">烹饪/美食</a></em><em><a href="#">时尚/美妆</a></em><em><a href="#">家居</a></em><em><a href="#">婚恋与两性</a></em><em><a href="#">娱乐/休闲</a></em><em><a href="#">健身与保健</a></em><em><a href="#">动漫/幽默</a></em><em><a href="#">体育/运动</a></em></dd>
              </dl>
              <dl class="fore8">
                <dt>科技</dt>
                <dd><em><a href="#">科普</a></em><em><a href="#">IT</a></em><em><a href="#">建筑</a></em><em><a href="#">医学</a></em><em><a href="#">工业技术</a></em><em><a href="#">电子/通信</a></em><em><a href="#">农林</a></em><em><a href="#">科学与自然</a></em></dd>
              </dl>
              <dl class="fore9">
                <dt>少儿</dt>
                <dd><em><a href="#">少儿</a></em><em><a href="#">0-2岁</a></em><em><a href="#">3-6岁</a></em><em><a href="#">7-10岁</a></em><em><a href="#">11-14岁</a></em></dd>
              </dl>
            </div>
            <div class="cat-right">
              <dl class="categorys-promotions" clstag="homepage|keycount|home2013|0601c">
                <dd>
                  <ul>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="特价书满减"></a></li>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="重磅独家"></a></li>
                  </ul>
                </dd>
              </dl>
              <dl class="categorys-brands" clstag="homepage|keycount|home2013|0601d">
                <dt>推荐品牌出版商</dt>
                <dd>
                  <ul>
                    <li><a href="#" target="_blank">中华书局</a></li>
                    <li><a href="#" target="_blank">人民邮电出版社</a></li>
                    <li><a href="#" target="_blank">上海世纪出版股份有限公司</a></li>
                    <li><a href="#" target="_blank">电子工业出版社</a></li>
                    <li><a href="#" target="_blank">三联书店</a></li>
                    <li><a href="#" target="_blank">浙江少年儿童出版社</a></li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="item">
          <h3><span>·</span><a href="">图书</a>、<a href="">音像</a>、<a href="">数字商品</a></h3>
          <div class="item-list clearfix">
            <div class="close">x</div>
            <div class="subitem">
              <dl class="fore1">
                <dt><a href="#">电子书2</a></dt>
                <dd><em><a href="#">免费</a></em><em><a href="#">小说</a></em><em><a href="#">励志与成功</a></em><em><a href="#">婚恋/两性</a></em><em><a href="#">文学</a></em><em><a href="#">经管</a></em><em><a href="#">畅读VIP</a></em></dd>
              </dl>
              <dl class="fore2">
                <dt><a href="#">数字音乐</a></dt>
                <dd><em><a href="#">通俗流行</a></em><em><a href="#">古典音乐</a></em><em><a href="#">摇滚说唱</a></em><em><a href="#">爵士蓝调</a></em><em><a href="#">乡村民谣</a></em><em><a href="#">有声读物</a></em></dd>
              </dl>
              <dl class="fore3">
                <dt><a href="#">音像</a></dt>
                <dd><em><a href="#">音乐</a></em><em><a href="#">影视</a></em><em><a href="#">教育音像</a></em><em><a href="#">游戏</a></em></dd>
              </dl>
              <dl class="fore4">
                <dt>文艺</dt>
                <dd><em><a href="#">小说</a></em><em><a href="#">文学</a></em><em><a href="#">青春文学</a></em><em><a href="#">传记</a></em><em><a href="#">艺术</a></em></dd>
              </dl>
              <dl class="fore5">
                <dt>人文社科</dt>
                <dd><em><a href="#">历史</a></em><em><a href="#">心理学</a></em><em><a href="#">政治/军事</a></em><em><a href="#">国学/古籍</a></em><em><a href="#">哲学/宗教</a></em><em><a href="#">社会科学</a></em></dd>
              </dl>
            </div>
            <div class="cat-right">
              <dl class="categorys-brands" clstag="homepage|keycount|home2013|0601d">
                <dt>推荐品牌出版商</dt>
                <dd>
                  <ul>
                    <li><a href="#" target="_blank">中华书局</a></li>
                    <li><a href="#" target="_blank">人民邮电出版社</a></li>
                    <li><a href="#" target="_blank">上海世纪出版股份有限公司</a></li>
                    <li><a href="#" target="_blank">电子工业出版社</a></li>
                    <li><a href="#" target="_blank">三联书店</a></li>
                    <li><a href="#" target="_blank">浙江少年儿童出版社</a></li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="item">
          <h3><span>·</span><a href="">图书</a>、<a href="">音像</a>、<a href="">数字商品</a></h3>
          <div class="item-list clearfix">
            <div class="close">x</div>
            <div class="subitem">
              <dl class="fore1">
                <dt><a href="#">电子书3</a></dt>
                <dd><em><a href="#">免费</a></em><em><a href="#">小说</a></em><em><a href="#">励志与成功</a></em><em><a href="#">婚恋/两性</a></em><em><a href="#">文学</a></em><em><a href="#">经管</a></em><em><a href="#">畅读VIP</a></em></dd>
              </dl>
              <dl class="fore2">
                <dt><a href="#">数字音乐</a></dt>
                <dd><em><a href="#">通俗流行</a></em><em><a href="#">古典音乐</a></em><em><a href="#">摇滚说唱</a></em><em><a href="#">爵士蓝调</a></em><em><a href="#">乡村民谣</a></em><em><a href="#">有声读物</a></em></dd>
              </dl>
              <dl class="fore3">
                <dt><a href="#">音像</a></dt>
                <dd><em><a href="#">音乐</a></em><em><a href="#">影视</a></em><em><a href="#">教育音像</a></em><em><a href="#">游戏</a></em></dd>
              </dl>
              <dl class="fore4">
                <dt>文艺</dt>
                <dd><em><a href="#">小说</a></em><em><a href="#">文学</a></em><em><a href="#">青春文学</a></em><em><a href="#">传记</a></em><em><a href="#">艺术</a></em></dd>
              </dl>
              <dl class="fore5">
                <dt>人文社科</dt>
                <dd><em><a href="#">历史</a></em><em><a href="#">心理学</a></em><em><a href="#">政治/军事</a></em><em><a href="#">国学/古籍</a></em><em><a href="#">哲学/宗教</a></em><em><a href="#">社会科学</a></em></dd>
              </dl>
              <dl class="fore6">
                <dt>经管励志</dt>
                <dd><em><a href="#">经济</a></em><em><a href="#">金融与投资</a></em><em><a href="#">管理</a></em><em><a href="#">励志与成功</a></em></dd>
              </dl>
              <dl class="fore7">
                <dt>生活</dt>
                <dd><em><a href="#">家庭与育儿</a></em><em><a href="#">旅游/地图</a></em><em><a href="#">烹饪/美食</a></em><em><a href="#">时尚/美妆</a></em><em><a href="#">家居</a></em><em><a href="#">婚恋与两性</a></em><em><a href="#">娱乐/休闲</a></em><em><a href="#">健身与保健</a></em><em><a href="#">动漫/幽默</a></em><em><a href="#">体育/运动</a></em></dd>
              </dl>
              <dl class="fore8">
                <dt>科技</dt>
                <dd><em><a href="#">科普</a></em><em><a href="#">IT</a></em><em><a href="#">建筑</a></em><em><a href="#">医学</a></em><em><a href="#">工业技术</a></em><em><a href="#">电子/通信</a></em><em><a href="#">农林</a></em><em><a href="#">科学与自然</a></em></dd>
              </dl>
              <dl class="fore9">
                <dt>少儿</dt>
                <dd><em><a href="#">少儿</a></em><em><a href="#">0-2岁</a></em><em><a href="#">3-6岁</a></em><em><a href="#">7-10岁</a></em><em><a href="#">11-14岁</a></em></dd>
              </dl>
              <dl class="fore10">
                <dt>教育</dt>
                <dd><em><a href="#">教材教辅</a></em><em><a href="#">考试</a></em><em><a href="#">外语学习</a></em></dd>
              </dl>
              <dl class="fore11">
                <dt>其它</dt>
                <dd><em><a href="#">英文原版书</a></em><em><a href="#">港台图书</a></em><em><a href="#">工具书</a></em><em><a href="#">套装书</a></em><em><a href="#">杂志/期刊</a></em></dd>
              </dl>
            </div>
            <div class="cat-right">
              <dl class="categorys-promotions" clstag="homepage|keycount|home2013|0601c">
                <dd>
                  <ul>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="特价书满减"></a></li>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="重磅独家"></a></li>
                  </ul>
                </dd>
              </dl>
              <dl class="categorys-brands" clstag="homepage|keycount|home2013|0601d">
                <dt>推荐品牌出版商</dt>
                <dd>
                  <ul>
                    <li><a href="#" target="_blank">中华书局</a></li>
                    <li><a href="#" target="_blank">人民邮电出版社</a></li>
                    <li><a href="#" target="_blank">上海世纪出版股份有限公司</a></li>
                    <li><a href="#" target="_blank">电子工业出版社</a></li>
                    <li><a href="#" target="_blank">三联书店</a></li>
                    <li><a href="#" target="_blank">浙江少年儿童出版社</a></li>
                    <li><a href="#" target="_blank">人民文学出版社</a></li>
                    <li><a href="#" target="_blank">外语教学与研究出版社</a></li>
                    <li><a href="#" target="_blank">中信出版社</a></li>
                    <li><a href="#" target="_blank">化学工业出版社</a></li>
                    <li><a href="#" target="_blank">北京大学出版社</a></li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="item">
          <h3><span>·</span><a href="">图书</a>、<a href="">音像</a>、<a href="">数字商品</a></h3>
          <div class="item-list clearfix">
            <div class="close">x</div>
            <div class="subitem">
              <dl class="fore1">
                <dt><a href="#">电子书4</a></dt>
                <dd><em><a href="#">免费</a></em><em><a href="#">小说</a></em><em><a href="#">励志与成功</a></em><em><a href="#">婚恋/两性</a></em><em><a href="#">文学</a></em><em><a href="#">经管</a></em><em><a href="#">畅读VIP</a></em></dd>
              </dl>
              <dl class="fore2">
                <dt><a href="#">数字音乐</a></dt>
                <dd><em><a href="#">通俗流行</a></em><em><a href="#">古典音乐</a></em><em><a href="#">摇滚说唱</a></em><em><a href="#">爵士蓝调</a></em><em><a href="#">乡村民谣</a></em><em><a href="#">有声读物</a></em></dd>
              </dl>
              <dl class="fore3">
                <dt><a href="#">音像</a></dt>
                <dd><em><a href="#">音乐</a></em><em><a href="#">影视</a></em><em><a href="#">教育音像</a></em><em><a href="#">游戏</a></em></dd>
              </dl>
              <dl class="fore4">
                <dt>文艺</dt>
                <dd><em><a href="#">小说</a></em><em><a href="#">文学</a></em><em><a href="#">青春文学</a></em><em><a href="#">传记</a></em><em><a href="#">艺术</a></em></dd>
              </dl>
              <dl class="fore5">
                <dt>人文社科</dt>
                <dd><em><a href="#">历史</a></em><em><a href="#">心理学</a></em><em><a href="#">政治/军事</a></em><em><a href="#">国学/古籍</a></em><em><a href="#">哲学/宗教</a></em><em><a href="#">社会科学</a></em></dd>
              </dl>
              <dl class="fore6">
                <dt>经管励志</dt>
                <dd><em><a href="#">经济</a></em><em><a href="#">金融与投资</a></em><em><a href="#">管理</a></em><em><a href="#">励志与成功</a></em></dd>
              </dl>
              <dl class="fore7">
                <dt>生活</dt>
                <dd><em><a href="#">家庭与育儿</a></em><em><a href="#">旅游/地图</a></em><em><a href="#">烹饪/美食</a></em><em><a href="#">时尚/美妆</a></em><em><a href="#">家居</a></em><em><a href="#">婚恋与两性</a></em><em><a href="#">娱乐/休闲</a></em><em><a href="#">健身与保健</a></em><em><a href="#">动漫/幽默</a></em><em><a href="#">体育/运动</a></em></dd>
              </dl>
              <dl class="fore8">
                <dt>科技</dt>
                <dd><em><a href="#">科普</a></em><em><a href="#">IT</a></em><em><a href="#">建筑</a></em><em><a href="#">医学</a></em><em><a href="#">工业技术</a></em><em><a href="#">电子/通信</a></em><em><a href="#">农林</a></em><em><a href="#">科学与自然</a></em></dd>
              </dl>
              <dl class="fore9">
                <dt>少儿</dt>
                <dd><em><a href="#">少儿</a></em><em><a href="#">0-2岁</a></em><em><a href="#">3-6岁</a></em><em><a href="#">7-10岁</a></em><em><a href="#">11-14岁</a></em></dd>
              </dl>
            </div>
            <div class="cat-right">
              <dl class="categorys-promotions" clstag="homepage|keycount|home2013|0601c">
                <dd>
                  <ul>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="特价书满减"></a></li>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="重磅独家"></a></li>
                  </ul>
                </dd>
              </dl>
              <dl class="categorys-brands" clstag="homepage|keycount|home2013|0601d">
                <dt>推荐品牌出版商</dt>
                <dd>
                  <ul>
                    <li><a href="#" target="_blank">中华书局</a></li>
                    <li><a href="#" target="_blank">人民邮电出版社</a></li>
                    <li><a href="#" target="_blank">上海世纪出版股份有限公司</a></li>
                    <li><a href="#" target="_blank">电子工业出版社</a></li>
                    <li><a href="#" target="_blank">三联书店</a></li>
                    <li><a href="#" target="_blank">浙江少年儿童出版社</a></li>
                    <li><a href="#" target="_blank">人民文学出版社</a></li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="item">
          <h3><span>·</span><a href="">图书</a>、<a href="">音像</a>、<a href="">数字商品</a></h3>
          <div class="item-list clearfix">
            <div class="close">x</div>
            <div class="subitem">
              <dl class="fore1">
                <dt><a href="#">电子书5</a></dt>
                <dd><em><a href="#">免费</a></em><em><a href="#">小说</a></em><em><a href="#">励志与成功</a></em><em><a href="#">婚恋/两性</a></em><em><a href="#">文学</a></em><em><a href="#">经管</a></em><em><a href="#">畅读VIP</a></em></dd>
              </dl>
              <dl class="fore2">
                <dt><a href="#">数字音乐</a></dt>
                <dd><em><a href="#">通俗流行</a></em><em><a href="#">古典音乐</a></em><em><a href="#">摇滚说唱</a></em><em><a href="#">爵士蓝调</a></em><em><a href="#">乡村民谣</a></em><em><a href="#">有声读物</a></em></dd>
              </dl>
              <dl class="fore3">
                <dt><a href="#">音像</a></dt>
                <dd><em><a href="#">音乐</a></em><em><a href="#">影视</a></em><em><a href="#">教育音像</a></em><em><a href="#">游戏</a></em></dd>
              </dl>
              <dl class="fore4">
                <dt>文艺</dt>
                <dd><em><a href="#">小说</a></em><em><a href="#">文学</a></em><em><a href="#">青春文学</a></em><em><a href="#">传记</a></em><em><a href="#">艺术</a></em></dd>
              </dl>
              <dl class="fore5">
                <dt>人文社科</dt>
                <dd><em><a href="#">历史</a></em><em><a href="#">心理学</a></em><em><a href="#">政治/军事</a></em><em><a href="#">国学/古籍</a></em><em><a href="#">哲学/宗教</a></em><em><a href="#">社会科学</a></em></dd>
              </dl>
              <dl class="fore6">
                <dt>经管励志</dt>
                <dd><em><a href="#">经济</a></em><em><a href="#">金融与投资</a></em><em><a href="#">管理</a></em><em><a href="#">励志与成功</a></em></dd>
              </dl>
              <dl class="fore7">
                <dt>生活</dt>
                <dd><em><a href="#">家庭与育儿</a></em><em><a href="#">旅游/地图</a></em><em><a href="#">烹饪/美食</a></em><em><a href="#">时尚/美妆</a></em><em><a href="#">家居</a></em><em><a href="#">婚恋与两性</a></em><em><a href="#">娱乐/休闲</a></em><em><a href="#">健身与保健</a></em><em><a href="#">动漫/幽默</a></em><em><a href="#">体育/运动</a></em></dd>
              </dl>
              <dl class="fore8">
                <dt>科技</dt>
                <dd><em><a href="#">科普</a></em><em><a href="#">IT</a></em><em><a href="#">建筑</a></em><em><a href="#">医学</a></em><em><a href="#">工业技术</a></em><em><a href="#">电子/通信</a></em><em><a href="#">农林</a></em><em><a href="#">科学与自然</a></em></dd>
              </dl>
            </div>
            <div class="cat-right">
              <dl class="categorys-promotions" clstag="homepage|keycount|home2013|0601c">
                <dd>
                  <ul>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="特价书满减"></a></li>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="重磅独家"></a></li>
                  </ul>
                </dd>
              </dl>
              <dl class="categorys-brands" clstag="homepage|keycount|home2013|0601d">
                <dt>推荐品牌出版商</dt>
                <dd>
                  <ul>
                    <li><a href="#" target="_blank">中华书局</a></li>
                    <li><a href="#" target="_blank">人民邮电出版社</a></li>
                    <li><a href="#" target="_blank">上海世纪出版股份有限公司</a></li>
                    <li><a href="#" target="_blank">电子工业出版社</a></li>
                    <li><a href="#" target="_blank">三联书店</a></li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="item">
          <h3><span>·</span><a href="">图书</a>、<a href="">音像</a>、<a href="">数字商品</a></h3>
          <div class="item-list clearfix">
            <div class="close">x</div>
            <div class="subitem">
              <dl class="fore1">
                <dt><a href="#">电子书6</a></dt>
                <dd><em><a href="#">免费</a></em><em><a href="#">小说</a></em><em><a href="#">励志与成功</a></em><em><a href="#">婚恋/两性</a></em><em><a href="#">文学</a></em><em><a href="#">经管</a></em><em><a href="#">畅读VIP</a></em></dd>
              </dl>
              <dl class="fore2">
                <dt><a href="#">数字音乐</a></dt>
                <dd><em><a href="#">通俗流行</a></em><em><a href="#">古典音乐</a></em><em><a href="#">摇滚说唱</a></em><em><a href="#">爵士蓝调</a></em><em><a href="#">乡村民谣</a></em><em><a href="#">有声读物</a></em></dd>
              </dl>
              <dl class="fore3">
                <dt><a href="#">音像</a></dt>
                <dd><em><a href="#">音乐</a></em><em><a href="#">影视</a></em><em><a href="#">教育音像</a></em><em><a href="#">游戏</a></em></dd>
              </dl>
              <dl class="fore4">
                <dt>文艺</dt>
                <dd><em><a href="#">小说</a></em><em><a href="#">文学</a></em><em><a href="#">青春文学</a></em><em><a href="#">传记</a></em><em><a href="#">艺术</a></em></dd>
              </dl>
              <dl class="fore5">
                <dt>人文社科</dt>
                <dd><em><a href="#">历史</a></em><em><a href="#">心理学</a></em><em><a href="#">政治/军事</a></em><em><a href="#">国学/古籍</a></em><em><a href="#">哲学/宗教</a></em><em><a href="#">社会科学</a></em></dd>
              </dl>
              <dl class="fore6">
                <dt>经管励志</dt>
                <dd><em><a href="#">经济</a></em><em><a href="#">金融与投资</a></em><em><a href="#">管理</a></em><em><a href="#">励志与成功</a></em></dd>
              </dl>
              <dl class="fore7">
                <dt>生活</dt>
                <dd><em><a href="#">家庭与育儿</a></em><em><a href="#">旅游/地图</a></em><em><a href="#">烹饪/美食</a></em><em><a href="#">时尚/美妆</a></em><em><a href="#">家居</a></em><em><a href="#">婚恋与两性</a></em><em><a href="#">娱乐/休闲</a></em><em><a href="#">健身与保健</a></em><em><a href="#">动漫/幽默</a></em><em><a href="#">体育/运动</a></em></dd>
              </dl>
              <dl class="fore8">
                <dt>科技</dt>
                <dd><em><a href="#">科普</a></em><em><a href="#">IT</a></em><em><a href="#">建筑</a></em><em><a href="#">医学</a></em><em><a href="#">工业技术</a></em><em><a href="#">电子/通信</a></em><em><a href="#">农林</a></em><em><a href="#">科学与自然</a></em></dd>
              </dl>
              <dl class="fore9">
                <dt>少儿</dt>
                <dd><em><a href="#">少儿</a></em><em><a href="#">0-2岁</a></em><em><a href="#">3-6岁</a></em><em><a href="#">7-10岁</a></em><em><a href="#">11-14岁</a></em></dd>
              </dl>
              <dl class="fore10">
                <dt>教育</dt>
                <dd><em><a href="#">教材教辅</a></em><em><a href="#">考试</a></em><em><a href="#">外语学习</a></em></dd>
              </dl>
              <dl class="fore11">
                <dt>其它</dt>
                <dd><em><a href="#">英文原版书</a></em><em><a href="#">港台图书</a></em><em><a href="#">工具书</a></em><em><a href="#">套装书</a></em><em><a href="#">杂志/期刊</a></em></dd>
              </dl>
            </div>
            <div class="cat-right">
              <dl class="categorys-promotions" clstag="homepage|keycount|home2013|0601c">
                <dd>
                  <ul>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="特价书满减"></a></li>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="重磅独家"></a></li>
                  </ul>
                </dd>
              </dl>
              <dl class="categorys-brands" clstag="homepage|keycount|home2013|0601d">
                <dt>推荐品牌出版商</dt>
                <dd>
                  <ul>
                    <li><a href="#" target="_blank">中华书局</a></li>
                    <li><a href="#" target="_blank">人民邮电出版社</a></li>
                    <li><a href="#" target="_blank">上海世纪出版股份有限公司</a></li>
                    <li><a href="#" target="_blank">电子工业出版社</a></li>
                    <li><a href="#" target="_blank">三联书店</a></li>
                    <li><a href="#" target="_blank">浙江少年儿童出版社</a></li>
                    <li><a href="#" target="_blank">人民文学出版社</a></li>
                    <li><a href="#" target="_blank">外语教学与研究出版社</a></li>
                    <li><a href="#" target="_blank">中信出版社</a></li>
                    <li><a href="#" target="_blank">化学工业出版社</a></li>
                    <li><a href="#" target="_blank">北京大学出版社</a></li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="item">
          <h3><span>·</span><a href="">图书</a>、<a href="">音像</a>、<a href="">数字商品</a></h3>
          <div class="item-list clearfix">
            <div class="close">x</div>
            <div class="subitem">
              <dl class="fore1">
                <dt><a href="#">电子书7</a></dt>
                <dd><em><a href="#">免费</a></em><em><a href="#">小说</a></em><em><a href="#">励志与成功</a></em><em><a href="#">婚恋/两性</a></em><em><a href="#">文学</a></em><em><a href="#">经管</a></em><em><a href="#">畅读VIP</a></em></dd>
              </dl>
              <dl class="fore2">
                <dt><a href="#">数字音乐</a></dt>
                <dd><em><a href="#">通俗流行</a></em><em><a href="#">古典音乐</a></em><em><a href="#">摇滚说唱</a></em><em><a href="#">爵士蓝调</a></em><em><a href="#">乡村民谣</a></em><em><a href="#">有声读物</a></em></dd>
              </dl>
              <dl class="fore3">
                <dt><a href="#">音像</a></dt>
                <dd><em><a href="#">音乐</a></em><em><a href="#">影视</a></em><em><a href="#">教育音像</a></em><em><a href="#">游戏</a></em></dd>
              </dl>
              <dl class="fore4">
                <dt>文艺</dt>
                <dd><em><a href="#">小说</a></em><em><a href="#">文学</a></em><em><a href="#">青春文学</a></em><em><a href="#">传记</a></em><em><a href="#">艺术</a></em></dd>
              </dl>


            </div>
            <div class="cat-right">
              <dl class="categorys-promotions" clstag="homepage|keycount|home2013|0601c">
                <dd>
                  <ul>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="特价书满减"></a></li>
                  </ul>
                </dd>
              </dl>
              <dl class="categorys-brands" clstag="homepage|keycount|home2013|0601d">
                <dt>推荐品牌出版商</dt>
                <dd>
                  <ul>
                    <li><a href="#" target="_blank">中华书局</a></li>
                    <li><a href="#" target="_blank">人民邮电出版社</a></li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="item">
          <h3><span>·</span><a href="">图书</a>、<a href="">音像</a>、<a href="">数字商品</a></h3>
          <div class="item-list clearfix">
            <div class="close">x</div>
            <div class="subitem">
              <dl class="fore1">
                <dt><a href="#">电子书8</a></dt>
                <dd><em><a href="#">免费</a></em><em><a href="#">小说</a></em><em><a href="#">励志与成功</a></em><em><a href="#">婚恋/两性</a></em><em><a href="#">文学</a></em><em><a href="#">经管</a></em><em><a href="#">畅读VIP</a></em></dd>
              </dl>
              <dl class="fore2">
                <dt><a href="#">数字音乐</a></dt>
                <dd><em><a href="#">通俗流行</a></em><em><a href="#">古典音乐</a></em><em><a href="#">摇滚说唱</a></em><em><a href="#">爵士蓝调</a></em><em><a href="#">乡村民谣</a></em><em><a href="#">有声读物</a></em></dd>
              </dl>
              <dl class="fore3">
                <dt><a href="#">音像</a></dt>
                <dd><em><a href="#">音乐</a></em><em><a href="#">影视</a></em><em><a href="#">教育音像</a></em><em><a href="#">游戏</a></em></dd>
              </dl>
              <dl class="fore4">
                <dt>文艺</dt>
                <dd><em><a href="#">小说</a></em><em><a href="#">文学</a></em><em><a href="#">青春文学</a></em><em><a href="#">传记</a></em><em><a href="#">艺术</a></em></dd>
              </dl>
              <dl class="fore5">
                <dt>人文社科</dt>
                <dd><em><a href="#">历史</a></em><em><a href="#">心理学</a></em><em><a href="#">政治/军事</a></em><em><a href="#">国学/古籍</a></em><em><a href="#">哲学/宗教</a></em><em><a href="#">社会科学</a></em></dd>
              </dl>
              <dl class="fore6">
                <dt>经管励志</dt>
                <dd><em><a href="#">经济</a></em><em><a href="#">金融与投资</a></em><em><a href="#">管理</a></em><em><a href="#">励志与成功</a></em></dd>
              </dl>
              <dl class="fore7">
                <dt>生活</dt>
                <dd><em><a href="#">家庭与育儿</a></em><em><a href="#">旅游/地图</a></em><em><a href="#">烹饪/美食</a></em><em><a href="#">时尚/美妆</a></em><em><a href="#">家居</a></em><em><a href="#">婚恋与两性</a></em><em><a href="#">娱乐/休闲</a></em><em><a href="#">健身与保健</a></em><em><a href="#">动漫/幽默</a></em><em><a href="#">体育/运动</a></em></dd>
              </dl>
              <dl class="fore8">
                <dt>科技</dt>
                <dd><em><a href="#">科普</a></em><em><a href="#">IT</a></em><em><a href="#">建筑</a></em><em><a href="#">医学</a></em><em><a href="#">工业技术</a></em><em><a href="#">电子/通信</a></em><em><a href="#">农林</a></em><em><a href="#">科学与自然</a></em></dd>
              </dl>

            </div>
            <div class="cat-right">
              <dl class="categorys-promotions" clstag="homepage|keycount|home2013|0601c">
                <dd>
                  <ul>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="特价书满减"></a></li>
                    <li><a href="#" target="_blank"><img src="#" width="194" height="70" title="重磅独家"></a></li>
                  </ul>
                </dd>
              </dl>
              <dl class="categorys-brands" clstag="homepage|keycount|home2013|0601d">
                <dt>推荐品牌出版商</dt>
                <dd>
                  <ul>
                    <li><a href="#" target="_blank">中华书局</a></li>
                    <li><a href="#" target="_blank">人民邮电出版社</a></li>
                    <li><a href="#" target="_blank">上海世纪出版股份有限公司</a></li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div> -->
<div class="position_now">
  <label><a href="<?php echo U('Home/Index/index');?>" target="_blank">首页</a></label>
  <span>&gt</span>
  <label>商品详细信息</label>
</div>
<div class="goods_info">
  <div class="goods_info_left">
    <div class="zoom">
      <div class="sp-loading"><img src="#" alt=""><br>
        LOADING /eshop/Public/Home/GoodImage</div>
      <div class="sp-wrap">
       <!--  <?php if(is_array($goodImgs)): $i = 0; $__LIST__ = $goodImgs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><a href="/eshop/<?php echo ($item["img"]); ?>">
            <img src="/eshop/<?php echo ($item["thumb_img"]); ?>" alt="">
          </a><?php endforeach; endif; else: echo "" ;endif; ?>  --> 
        <a href="/eshop/Public/Home/GoodImage/goods.png">
          <img src="/eshop/Public/Home/GoodImage/goods.png" alt="">
        </a> 
        <a href="/eshop/Public/Home/GoodImage/1.jpg">
          <img src="/eshop/Public/Home/GoodImage/1.jpg" alt="">
        </a> 
        <a href="/eshop/Public/Home/GoodImage/3.jpg">
          <img src="/eshop/Public/Home/GoodImage/3_tb.jpg" alt="">
        </a> 
        <a href="/eshop/Public/Home/GoodImage/4.jpg">
          <img src="/eshop/Public/Home/GoodImage/4_tb.jpg" alt="">
        </a>  
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
      <div class="select_btn"> <a href="#" class="goods_add">加入购物车</a> <a href="#" class="goods_buy">立即购买</a> <a href="#" class="goods_collection">收藏商品</a> </div>
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
            <div class="itemscore">商品评价：8分</div>
            <div class="itemscore">服务评分：8分</div>
            <div class="itemscore">物流评分：10分</div>
            <div class="shop_footer"> <a href="<?php echo U('Home/Shop/index',array('shopId'=>$shopInfo['id']));?>" target="_blank">进店逛逛</a> <a href="#">关注商店</a> </div>
          </div>
        </div>
        <div class="shop_recommend">
          <h3>店主推荐</h3>
          <ul class="p_list">
            <li>
              <div class="list-wrap">
                <div class="p_pics">
                  <a href="goods_info.html" class="eshop_img"><img src="/eshop/Public/Home/Image/sg1.png"/>
                  </a>
                </div>
                <div class="p_sales">
                  <div class="p_price"> 
                    <strong><em style="color:red;">￥</em><i style="color:red;">79.90</i></strong>
                  </div>
                  <div class="p_amounts"> 
                     <strong>销量：<span>550</span></strong>
                  </div>
                </div>
                <div class="p_name"> 
                  <a href="goods_info.html" target="_blank">树懒果园 墨西哥进口牛油果 6个 1-1.2kg 精选大果，单果约180g左右，进口放心品 
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="shopIndex.html" target="_blank">红富士旗舰店</a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;">湖南</span>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="list-wrap">
                <div class="p_pics">
                  <a href="goods_info.html" class="eshop_img"><img src="/eshop/Public/Home/Image/sg1.png"/>
                  </a>
                </div>
                <div class="p_sales">
                  <div class="p_price"> 
                    <strong><em style="color:red;">￥</em><i style="color:red;">79.90</i></strong>
                  </div>
                  <div class="p_amounts"> 
                     <strong>销量：<span>550</span></strong>
                  </div>
                </div>
                <div class="p_name"> 
                  <a href="goods_info.html" target="_blank">树懒果园 墨西哥进口牛油果 6个 1-1.2kg 精选大果，单果约180g左右，进口放心品 
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="shopIndex.html" target="_blank">红富士旗舰店</a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;">湖南</span>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="list-wrap">
                <div class="p_pics">
                  <a href="goods_info.html" class="eshop_img"><img src="/eshop/Public/Home/Image/sg1.png"/>
                  </a>
                </div>
                <div class="p_sales">
                  <div class="p_price"> 
                    <strong><em style="color:red;">￥</em><i style="color:red;">79.90</i></strong>
                  </div>
                  <div class="p_amounts"> 
                     <strong>销量：<span>550</span></strong>
                  </div>
                </div>
                <div class="p_name"> 
                  <a href="goods_info.html" target="_blank">树懒果园 墨西哥进口牛油果 6个 1-1.2kg 精选大果，单果约180g左右，进口放心品 
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="shopIndex.html" target="_blank">红富士旗舰店</a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;">湖南</span>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="list-wrap">
                <div class="p_pics">
                  <a href="goods_info.html" class="eshop_img"><img src="/eshop/Public/Home/Image/sg1.png"/>
                  </a>
                </div>
                <div class="p_sales">
                  <div class="p_price"> 
                    <strong><em style="color:red;">￥</em><i style="color:red;">79.90</i></strong>
                  </div>
                  <div class="p_amounts"> 
                     <strong>销量：<span>550</span></strong>
                  </div>
                </div>
                <div class="p_name"> 
                  <a href="goods_info.html" target="_blank">树懒果园 墨西哥进口牛油果 6个 1-1.2kg 精选大果，单果约180g左右，进口放心品 
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="shopIndex.html" target="_blank">红富士旗舰店</a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;">湖南</span>
                  </div>
                </div>
              </div>
            </li>
          </ul>
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
                    <div class="texts"><?php echo ($data["content"]); ?></div>
                    <div class="p_date"><?php echo (date("y-m-d h：m：s",$data["time"])); ?>&nbsp;&nbsp;详情：<?php echo ($goodInfo["name"]); ?></div>
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
    <div class="like_wrap">
      <h3>您可能喜欢</h3>
      <div class="like">
        <ul class="p_list">
          <li>
            <div class="list-wrap">
                <div class="p_pics">
                  <a href="goods_info.html" class="eshop_img"><img src="/eshop/Public/Home/Image/sg1.png"/>
                  </a>
                </div>
                <div class="p_sales">
                  <div class="p_price"> 
                    <strong><em style="color:red;">￥</em><i style="color:red;">79.90</i></strong>
                  </div>
                  <div class="p_amounts"> 
                     <strong>销量：<span>550</span></strong>
                  </div>
                </div>
                <div class="p_name" style="max-height:60px;overflow:hidden;min-height: auto;"> 
                  <a href="goods_info.html" target="_blank">树懒果园 墨西哥进口牛油果 6个 1-1.2kg 精选大果，单果约180g左右，进口放心品 
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="shopIndex.html" target="_blank">红富士旗舰店</a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;">湖南</span>
                  </div>
                </div>
            </div>
          </li>
          <li>
            <div class="list-wrap">
                <div class="p_pics">
                  <a href="goods_info.html" class="eshop_img"><img src="/eshop/Public/Home/Image/sg1.png"/>
                  </a>
                </div>
                <div class="p_sales">
                  <div class="p_price"> 
                    <strong><em style="color:red;">￥</em><i style="color:red;">79.90</i></strong>
                  </div>
                  <div class="p_amounts"> 
                     <strong>销量：<span>550</span></strong>
                  </div>
                </div>
                <div class="p_name"> 
                  <a href="goods_info.html" target="_blank">树懒果园 墨西哥进口牛油果 6个 1-1.2kg 精选大果，单果约180g左右，进口放心品 
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="shopIndex.html" target="_blank">红富士旗舰店</a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;">湖南</span>
                  </div>
                </div>
            </div>
          </li>
          <li>
            <div class="list-wrap">
                <div class="p_pics">
                  <a href="goods_info.html" class="eshop_img"><img src="/eshop/Public/Home/Image/sg1.png"/>
                  </a>
                </div>
                <div class="p_sales">
                  <div class="p_price"> 
                    <strong><em style="color:red;">￥</em><i style="color:red;">79.90</i></strong>
                  </div>
                  <div class="p_amounts"> 
                     <strong>销量：<span>550</span></strong>
                  </div>
                </div>
                <div class="p_name"> 
                  <a href="goods_info.html" target="_blank">树懒果园 墨西哥进口牛油果 6个 1-1.2kg 精选大果，单果约180g左右，进口放心品 
                  </a> 
                </div>
                <div class="p_shop_info">
                  <div class="p_shop_name">
                    <span><a href="shopIndex.html" target="_blank">红富士旗舰店</a></span>
                  </div>
                  <div class="p_good_place">
                    <span style="color:#868686;">湖南</span>
                  </div>
                </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <noempty name="history">
      <div class="history_wrap">
        <h3>浏览记录</h3>
        <div class="history">
          <ul class="p_list">
            <?php if(is_array($history)): $i = 0; $__LIST__ = array_slice($history,0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
                <div class="list-wrap">
                  <div class="p_pics">
                    <a href="<?php echo U('Home/Good/info',array('id'=>$item['id']));?>" class="eshop_img"><img src="/eshop/<?php echo ($item["good_log"]); ?>"/>
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
                  <a href="<?php echo U('Home/Good/info',array('id'=>$item['id']));?>" target="_blank"><?php echo ($item["name"]); ?>
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
      </div>
    </noempty>
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