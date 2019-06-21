<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>个人资料</title>
<!-- 公共链接 -->
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
<!-- 公共链接 -->
<script src="/eshop/Public/Home/Js/User/userInfo.js"></script>
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
 
<!-- header结束 --> 
<!-- 当前位置开始 -->
<div class="position_now">
  <label><a href="<?php echo U('Home/Index/index');?>">首页</a></label>
  <span>&gt</span>
  <label>个人资料</label>
</div>
<!-- 当前位置显示结束 --> 
<!-- 主体内容开始 -->
<div class="ucenter_wrapper"> 
  <!-- 左边导航标签开始 --> 
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
    <a href="<?php echo U('Home/UserMsgManage/orderComplainManage');?>">
    <li>投诉管理</li>
    </a> <a href="<?php echo U('Home/UserMsgManage/messages');?>">
    <li>消息管理</li>
    </a>
  </ul>
</div>
 
  <!-- 左边导航标签结束 -->
  <div class="ucenter_right">
    <div class="ucenter_right_title"> <span>个人资料</span> </div>
    <div class="ucenter_right_content">
      <form method="post"  enctype="multipart/form-data" id="uinfo_form" autocomplete="off">
        <table class="uinfo_table">
          <tbody>
            <tr>
              <td class="title">登录账号：</td>
              <td class="uaccount"><div><?php echo (session('uname')); ?></div></td>
              <td style="padding-left:32px;">个人头像：</td>
            </tr>
            <tr>
              <td class="title"><label for="unick">昵称：</label></td>
              <td class="content"><input type="text" name="nick" id="unick" value="<?php echo ($list["nick"]); ?>" class="inputs" placeholder="昵称"/></td>
              <td rowspan="8" valign="top">
                <div id="preview" class="uphoto">
                  <?php if(empty($list["photo"])): ?><img id="imghead" border="0" src="/eshop/Public/Home/Icon/default-face.png">
                    <?php else: ?>
                    <img id="imghead" border="0" src="/eshop/<?php echo ($list["photo"]); ?>"><?php endif; ?>
                </div>
                <div class="face-upload">
                  <span>（图片大小为150*150(px),格式包含jpg,jpeg,png,gif）</span>
                  <input type="button" name="face" value="上传头像" onclick="$('#previewImg').click();"/>    
                  <input type="file" name= "photo" onchange="previewImage(this)" style="display: none;" id="previewImg" accept="image/*">
                </div>
              </td>
            </tr>
            <tr>
              <td class="title"><label for="utruename">真实姓名：</label></td>
              <td class="content"><input type="text" name="truename" value="<?php echo ($list["truename"]); ?>" id="utruename" class="inputs" placeholder="您的真实姓名"/></td>
            </tr>
            <tr>
              <td class="title"><label>性别：</label></td>
              <td class="sex"><input type="radio" name="usex" value="男"
                <?php if($list["sex"] == '男'): ?>checked="checked"<?php endif; ?>
                />&nbsp;男 <input type="radio" name="usex" value="女"  
                <?php if($list["sex"] == '女'): ?>checked="checked"<?php endif; ?>
                />&nbsp;女 <input type="radio" name="usex" value="保密"  
                <?php if($list["sex"] == '保密'): ?>checked="checked"<?php endif; ?>
                />&nbsp;保密 </td>
            </tr>
            <tr>
              <td class="title"><label for="ubirtd">生日：</label></td>
              <td class="content"><input class="Wdate inputs" type="text" onClick="WdatePicker()" name="ubirtd" id="ubirtd" value="<?php echo ($list["birthday"]); ?>" placeholder="您的生日"></td>
            </tr>
            <tr>
              <td class="title"><label for="ucarnum">身份证号：</label></td>
              <td class="content"><input type="text" name="carnum" id="ucarnum" value="<?php echo ($list["carnum"]); ?>" class="inputs" placeholder="您的省份证号"/></td>
            </tr>
            <tr>
              <td class="title"><label for="uqq">qq：</label></td>
              <td class="content"><input type="text" name="qq" id="uqq" value="<?php echo ($list["qq"]); ?>" class="inputs" placeholder="您的QQ号"/></td>
            </tr>
            <tr>
              <td class="title"><label for="utel">联系电话：</label></td>
              <td class="content"><input type="text" name="tel" id="utel" value="<?php echo ($list["tel"]); ?>" class="inputs" placeholder="您的联系方式"/></td>
            </tr>
            <tr>
              <td colspan="2"><input type="submit" name="btn" value="保存" class="btn" id="uinfo_submit"/></td>
            </tr>
          </tbody>
        </table>
      </form>
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