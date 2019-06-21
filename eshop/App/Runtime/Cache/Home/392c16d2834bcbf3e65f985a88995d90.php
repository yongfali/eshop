<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>商家注册</title>
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
<link rel="stylesheet" type="text/css"
  href="/eshop/Public/Home/Css/regist.css" />
<script src="/eshop/Public/Home/Js/scrollable.js"></script>
<script src="/eshop/Public/Home/Js/shoperRegist.js"></script>
<script >
  var checkShoperName = "<?php echo U('checkShoperName');?>";
  var checkShoperEmail = "<?php echo U('checkShoperEmail');?>";
  var checkShopName = "<?php echo U('checkShopName');?>";
  var checkVerify = "<?php echo U('checkVerify');?>";
  var shoperLoginIndex = "<?php echo U('index');?>";
  var doShoperRegist = "<?php echo U('doRegist');?>";
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
  <label><a href="index.html">首页</a></label>
  <span>&gt</span>
  <label>商家注册</label>
</div>
<div id='reg-wrap'>
  <form action="" method='post' id="shop_regist">
    <div id="wizard">
      <ul id="status">
        <li class="active"><strong>1.</strong>创建账户</li>
        <li><strong>2.</strong>商家基本信息</li>
        <li><strong>3.</strong>店铺基本信息</li>
        <li><strong>4.</strong>完成</li>
      </ul>
      <div class="items">
        <div class="page" id="page1">
          <h3>创建一个账户<br/>
            <em>请填写您的注册账户信息，用于登录。</em></h3>
          <p>
            <label><span>*</span>商户名：</label>
            <input type="text" class="input" id="s_account" name="s_account" />
          </p>
          <p>
            <label><span>*</span>密码：</label>
            <input type="password" class="input" id="s_pwd" name="s_pwd" />
          </p>
          <p>
            <label><span>*</span>确认密码：</label>
            <input type="password" class="input" id="s_pwded" name="s_pwded" />
          </p>
          <p>
            <label><span>*</span>E-mail：</label>
            <input type="email" class="input" id="s_email" name="s_email" />
          </p>
          <div class="btn_nav">
            <input type="button" class="next" value="下一步" id="ee" />
          </div>
        </div>
        <div class="page">
          <h3>填写商家基本信息<br/>
            <em><span style="color:red">*</span>选项为必填项，信息越完善越有利于通过审核</em></h3>
          <p>
            <label><span>*</span>真实姓名：</label>
            <input type="text" class="input" name="trueName" id="trueName" />
          </p>
          <p>
            <label><span>*</span>身份证号：</label>
            <input type="text" class="input" name="carNum" />
          </p>
          <p>
            <label>性别：</label>
            <input type="radio"  name="sex" value="男" />
            <span class="sex">男</span>
            <input type="radio"  name="sex" value="女" />
            <span class="sex">女</span>
            <input type="radio"  name="sex" value="保密" checked="checked" />
            <span class="sex">保密</span> </p>
          <p>
            <label>出生日期：</label>
            <input class="Wdate input" type="text" onClick="WdatePicker()" name="birthday" id="birtd">
          </p>
          <p>
            <label>QQ：</label>
            <input type="text" class="input" name="qq" />
          </p>
          <p>
            <label><span>*</span>手机号码：</label>
            <input type="text" class="input" name="mobile" />
          </p>
          <div class="btn_nav">
            <input type="button" class="prev" style="float:left" value="上一步" />
            <input type="button" class="next right" value="下一步" />
          </div>
        </div>
        <div class="page">
          <h3>填写店铺基本信息<br/>
            <em>先给您的店铺取一个响亮的名字，后期还可完善基本信息</em></h3>
          <p>
            <label><span>*</span>店铺名：</label>
            <input type="text" class="input" name="shopname" id="shopname" />
          </p>
          <p>
            <label>服务QQ：</label>
            <input type="text" class="input" name="service_qq" />
          </p>
          <p>
            <label>服务热线：</label>
            <input type="text" class="input" name="service_tel" />
          </p>
          <div class="btn_nav">
            <input type="button" class="prev" style="float:left" value="上一步" />
            <input type="button" class="next right" value="下一步" />
          </div>
        </div>
        <div class="page">
          <h3>完成注册<br/>
            <em>点击确定完成注册。</em></h3>
          <h4>eshop欢迎您前来注册！</h4>
          <p>若确认信息无误后，同意用户注册协议然后请点击“注册”按钮完成注册。</p>
          <p>
            <label for="verify">验证码：</label>
            <input type="text" name='verify'  id='verify'
          class='input'/>
            <img src="<?php echo U('verify');?>" width='137px' height='38px' id='s_verufyImg' /> </p>
          <p class="sprotocol">
            <input type="checkbox" id="protocol" name="protocol" class="R_protocol" value="1" />
            <span>我已阅读并同意</span> <a href="javascript:;" id="protocolInfo" onClick="show();"><span>《商家注册协议》</span></a> <a href="<?php echo U('index');?>"><span class="">已有账号？点击登录</span></a> </p>
          <div class="btn_nav">
            <input type="button" class="prev" style="float:left" value="上一步" />
            <input type="submit" class="next right" value="注册" />
          </div>
        </div>
      </div>
    </div>
  </form>
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