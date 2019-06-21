<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>店铺管理-店铺信息</title>
<!-- 公共链接 -->
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/common.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/scommon.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/scenter.css">
<script src="/eshop/Public/Common/Js/jquery-2.1.1.min.js"></script>
<script src="/eshop/Public/Common/Js/jquery.validate.js"></script>
<script src="/eshop/Public/Common/layer/layer.js"></script>
<script src="/eshop/Public/Home/Js/shoperCenter.js"></script>
<script src="/eshop/Public/Home/Js/goodCommon.js"></script>
<script src="/eshop/Public/Common/My97DatePicker/WdatePicker.js"></script>

<!-- 公共链接 -->
</head>
<body>
<!-- header开始 --> 
<!-- 店铺首页头部开始 -->
<div class="header">
  <div class="header_wraper">
    <div class="header_left"> <span><a href="#">设为首页</a></span> <span><a href="#">收藏本站</a></span> </div>
    <div class="header_right">
      <ul>
        <li class="header_nav"><a href="#">商家中心</a>
          <ul>
            <li><a href="<?php echo U('Home/ShopCart/index');?>">商品管理</a></li>
            <li><a href="shoper_regist.html">交易管理</a></li>
            <li><a href="#">店铺管理</a></li>
          </ul>
      </ul>
      <span class="header_nav"> 
      <!-- 欢迎某某光临e_shop商城，<a href="#">退出</a> -->
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
    <div class="s_logo"> <a href="#"><img src="/eshop/Public/Home/ShopImage/shop_logo.jpg" alt="店铺logo"></a> </div>
    <div class="s_info">
      <h3>红富士旗舰店</h3>
      <div class="s_info1"> <img src="/eshop/Public/Home/ShopImage/renzheng.png"><span>国家认证商家</span> <img src="/eshop/Public/Home/ShopImage/qitian.png"><span>七天无条件退款</span> <a href="tencent://message/?uin=1411387106&Site=qq&Menu=yes"><img src="/eshop/Public/Home/ShopImage/qq.gif" style="width:65px;height:24px;"></a> </div>
      <div class="s_info2">
        <lable>商品评价：<span>8分</span></lable>
        <lable>服务评价：<span>9分</span></lable>
        <lable>物流评价：<span>10分</span></lable>
        <span><a href="#">关注本店</a></span>
        <label><a href="<?php echo U('Home/Index/index');?>">商城首页</a></label>
      </div>
    </div>
  </div>
  <!-- 店铺logo和基本信息结束 -->
  <div class="shop_search_right">
    <form action="#" method="post" class="s_form">
      <input type="text" id="s_content" placeholder="输入要查找的商品">
      <input type="submit" value="搜本店" class="btn1">
      <input type="submit" value="搜全站" class="btn1">
    </form>
  </div>
  <!-- 搜索框结束--> 
</div>
<!-- 头部搜索结束 --> 
<!-- 店铺首页导航开始 -->
<div class="shop_nav_wrapper">
  <div class="shop_nav_list">
    <ul>
      <li class="allProduct"><a href="#">本店所有产品</a>
        <p></p>
        <ul class="allProduct2">
          <li><a href="">水果,水彩</a>
            <ul class="allProduct3">
              <li><a href="#">蔬菜</a></li>
              <li><a href="#">鲜果</a></li>
              <li><a href="#">鲜菜</a></li>
              <li><a href="#">进口</a></li>
              <li><a href="#">蔬菜</a></li>
              <li><a href="#">鲜果</a></li>
              <li><a href="#">鲜菜</a></li>
              <li><a href="#">进口</a></li>
            </ul>
          </li>
          <li><a href="">水果,水彩</a>
            <ul class="allProduct3">
              <li><a href="#">蔬菜</a></li>
              <li><a href="#">鲜果</a></li>
              <li><a href="#">鲜菜</a></li>
              <li><a href="#">进口</a></li>
              <li><a href="#">蔬菜</a></li>
              <li><a href="#">鲜果</a></li>
              <li><a href="#">鲜菜</a></li>
              <li><a href="#">进口</a></li>
            </ul>
          </li>
          <li><a href="">水果,水彩</a>
            <ul class="allProduct3">
              <li><a href="#">蔬菜</a></li>
              <li><a href="#">鲜果</a></li>
              <li><a href="#">鲜菜</a></li>
              <li><a href="#">进口</a></li>
              <li><a href="#">蔬菜</a></li>
              <li><a href="#">鲜果</a></li>
              <li><a href="#">鲜菜</a></li>
              <li><a href="#">进口</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li><a href="<?php echo U('Home/Shop/index');?>" target="_blank">首页</a></li>
      <li><a href="">热销水果</a></li>
      <li><a href="">纯天然水果</a></li>
      <li><a href="">进口水果</a></li>
    </ul>
  </div>
</div>
<!-- 店铺首页导航结束 -->
<!-- header结束 --> 
<!-- 当前位置开始 -->
<div class="position_now">
  <label><a href="<?php echo U('Home/Index/index');?>">首页</a></label>
  <span>&gt</span>
  <label>店铺信息</label>
</div>
<!-- 当前位置显示结束 --> 
<!-- 主体内容开始 -->
<div class="scenter_wrapper"> 
  <!-- 左边导航标签开始 --> 
  <!-- 商家中心左侧导航标签公共部分 -->

<div class="scenter_left">
  <h3>商品管理</h3>
  <ul>
    <a href="<?php echo U('Home/ShopCart/index');?>">
    <li>商品分类</li>
    </a> <a href="<?php echo U('Home/Good/add');?>">
    <li>新增商品</li>
    </a> <a href="<?php echo U('Home/Good/audit');?>">
    <li>待审核商品</li>
    </a> <a href="<?php echo U('Home/Good/illegal');?>">
    <li>违规商品</li>
    </a> <!-- <a href="#">
    <li>评价管理</li>
    </a>  --><a href="<?php echo U('Home/Good/stock');?>">
    <li>库存预警</li>
    </a> <a href="<?php echo U('Home/Good/onsale');?>">
    <li>出售中的商品</li>
    </a> <a href="<?php echo U('Home/Good/store');?>">
    <li>仓库中的商品</li>
    </a>
  </ul>
  <h3>交易管理</h3>
  <ul>
    <a href="#">
    <li>待付款订单</li>
    </a> <a href="#">
    <li>待发货订单</li>
    </a> <a href="#">
    <li>已发货订单</li>
    </a> <a href="#">
    <li>已收货订单</li>
    </a> <a href="#">
    <li>取消/拒收订单</li>
    </a> <a href="#">
    <li>投诉订单</li>
    </a>
  </ul>
  <h3>店铺管理</h3>
  <ul>
    <a href="<?php echo U('Home/ShoperManage/index');?>">
    <li>店铺信息</li>
    </a> <a href="#">
    <li>信息发布</li>
    </a> <a href="#">
    <li>店铺设置</li>
    </a>
  </ul>
  <h3>商家中心</h3>
  <ul>
    <a href="#">
    <li>商家信息</li>
    </a> <a href="<?php echo U('Home/ShoperCenter/log');?>">
    <li>操作记录</li>
    </a> <a href="<?php echo U('Home/ShoperCenter/modifyPwd');?>">
    <li>修改密码</li>
    </a>
  </ul>
</div>
 
  <!-- 左边导航标签结束 -->
  <div class="scenter_right">
    <div class="scenter_right_title"> 
      <span>店铺信息</span> 
    </div>
    <div class="scenter_right_content">
        <table class="smodifypwd_table">
          <tbody>
            <tr>
              <td class="saccount">商家账号：</td>
              <td><div class="sNick"><?php echo (session('uname')); ?></div></td>
            </tr>
             <tr>
              <td class="itemsName">
                <span class="icon">*</span>原密码：
              </td>
              <td><input type="password" name="soldpwd" id="soldpwd" value="" class="inputs" placeholder="请输入您的原密码"/></td>
            </tr>
            <tr>
              <td class="itemsName">
                <span class="icon">*</span>新密码：
              </td>
              <td><input type="password" name="snewpwd" id="snewpwd" value="" class="inputs" placeholder="请输入您的新密码"/></td>
            </tr>
            <tr>
              <td class="itemsName">
                 <span class="icon">*</span>确认密码： 
              </td>
              <td><input type="password" name="snewpwd1" id="snewpwd1" value="" class="inputs" placeholder="再次确认您的密码"/></td>
            </tr>
            <tr>
              <td colspan="2"><input type="submit" name="btn" value="修改" class="btn mbtn"/></td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
  <!-- 用户中心右侧内容显示结束 --> 
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
        <li><a href="<?php echo U('Help/index');?>">购物流程</a></li>
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