<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>店铺管理-店铺信息</title>
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
<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/Css/scommon.css">
<link rel="stylesheet" type="text/css" href="/eshop/Public/Home/Css/scenter.css">
<script src="/eshop/Public/Home/Js/shoperCenter.js"></script>
<script src="/eshop/Public/Home/Js/goodCommon.js"></script>


<!-- 公共链接 -->
<script src="/eshop/Public/Home/Js/ShopManage/shopInfo.js"></script>
</head>
<body>
<!-- header开始 --> 
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
    <a href="<?php echo U('Home/ShopOrders/waitPay');?>">
    <li>待付款订单</li>
    </a> <a href="<?php echo U('Home/ShopOrders/waitDelivery');?>">
    <li>待发货订单<span class="order-num"><?php echo ($waitDeliveryNum); ?></span></li>
    </a> <a href="<?php echo U('Home/ShopOrders/delivered');?>">
    <li>已发货订单</li>
    </a> <a href="<?php echo U('Home/ShopOrders/finished');?>">
    <li>已收货订单</li>
    </a> <a href="<?php echo U('Home/ShopOrders/failure');?>">
    <li>取消/拒收订单</li>
    </a> <a href="<?php echo U('Home/ShopOrders/complaint');?>">
    <li>投诉订单</li>
    </a>
  </ul>
  <h3>店铺管理</h3>
  <ul>
    <a href="<?php echo U('Home/ShopManage/index');?>">
    <li>店铺信息</li>
    </a> <a href="<?php echo U('Home/ShopManage/info');?>">
    <li>信息发布</li>
    <a href="<?php echo U('Home/ShopManage/infoList');?>">
    <li>信息列表</li>
    </a> 
    </a> <a href="<?php echo U('Home/ShopManage/setting');?>">
    <li>店铺设置</li>
    </a>
  </ul>
  <h3>商家中心</h3>
  <ul>
    <a href="<?php echo U('Home/ShoperCenter/info');?>">
    <li>商家信息</li>
    </a>  
    <a href="<?php echo U('Home/ShoperCenter/messages');?>">
    <li>商家消息</li>
    </a>
    <a href="<?php echo U('Home/ShoperCenter/log');?>">
    <li>操作记录</li>
    </a> <a href="<?php echo U('Home/ShoperCenter/modifyPwd');?>">
    <li>修改密码</li>
    </a>
    <a href="<?php echo U('Home/ShoperCenter/security');?>">
    <li>安全设置</li>
    </a>
  </ul>
</div>
 
  <!-- 左边导航标签结束 -->
  <div class="scenter_right">
    <div class="scenter_right_title"> 
      <ul class="good_nav">
        <a href="javascript:;" class="active" rel="nav1">店铺信息 </a> <a href="javascript:;" rel="nav2">信息编辑</a> 
      </ul>
    </div>
    <div class="scenter_right_content">
      <!-- 店铺基本信息展示 -->
      <div id="nav1">
        <table class="shopInfo_table">
          <tbody>
            <tr>
              <td class="saccount">商家账号：</td>
              <td>
                <div class="sNick"><?php echo (session('uname')); ?>
                </div>
              </td>
            </tr>
            <tr>
              <td class="itemsName">
                店铺编号：
              </td>
              <td><span class="content"><?php echo get_number($shopInfo['id']);?></span></td>
            </tr>
            <tr>
              <td class="itemsName">店铺名称：</td>
              <td><span class="content"><?php echo ($shopInfo["name"]); ?></span></td>
            </tr>
            <tr>
              <td class="itemsName">经营范围：</td>
              <td><span class="content">时蔬水果、网上菜场、厨卫清洁、纸制用品、酒水饮料、茶叶冲饮、粮油食品、南北干货、美容护理、洗浴用品、家居家电</span></td>
            </tr>
            <tr>
              <td class="itemsName">认证类型：</td>
              <td><span class="content">消保认证商家、 七天无条件退款 </span></td>
            </tr>
            <tr>
              <td class="itemsName">店铺Logo：</td>
              <td>
                <?php if(empty($shopInfo["logo"])): ?><img src="/eshop/Public/Home/Icon/no-img.png">
                  <?php else: ?>
                  <img src="/eshop/<?php echo ($shopInfo["logo"]); ?>"><?php endif; ?>
              </td>
            </tr>
            <tr>
              <td class="itemsName">客服QQ：</td>
              <td><span class="content"><?php echo ($shopInfo["service_qq"]); ?></span></td>
            </tr>
            <tr>
              <td class="itemsName">客服电话：</td>
              <td><span class="content"><?php echo ($shopInfo["server_tel"]); ?></span></td>
            </tr>
            <tr>
              <td class="itemsName">店铺二维码：</td>
              <td>
                <?php if(empty($shopInfo["qrcode"])): ?><img src="/eshop/Public/Home/Icon/no-img.png">
                  <?php else: ?>
                  <img src="/eshop/<?php echo ($shopInfo["qrcode"]); ?>"><?php endif; ?> 
              </td>
            </tr>
            <tr>
              <td class="itemsName">店铺等级：</td>
              <td><span class="content"><?php echo ($shopInfo["rank"]); ?></span></td>
            </tr>
            <tr>
              <td class="itemsName">店铺地址：</td>
              <td><span class="content"><?php echo ($shopInfo["address"]); ?></span></td>
            </tr>
            <tr>
              <td class="itemsName">服务时间：</td>
              <td><span class="content"><?php echo ($shopInfo["server_time"]); ?></span></td>
            </tr>
            <tr>
              <td class="itemsName">店铺经营状态：</td>
              <td>
                <?php if($shopInfo["is_forbid"] == 0): ?><span class="content">正常</span>
                 <?php else: ?>
                 <span class="content">违规，被封号，请联系<a href="#" style="color:red;">管理员</a></span><?php endif; ?>
             </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- 店铺基本信息修改 -->
      <div id="nav2" style="display:none">
        <form id="shopInfo-edit" autocomplete="off">
          <table class="shopInfo_table">
            <tbody>
              <tr>
                <td class="saccount">商家账号：</td>
                <td>
                  <div class="sNick" style="float:left;"><?php echo (session('uname')); ?>
                  </div>
                  <span>（以下信息双击可修改包括图片）</span>
                </td>
              </tr>
              <tr>
                <td class="itemsName">店铺名称：</td>
                <td><input type="text" name="shopName" id="shopName" class="inputs" value="<?php echo ($shopInfo["name"]); ?>"/></td>
                <td rowspan="2">
                  <div id="preview">
                    <?php if(empty($shopInfo["logo"])): ?><img id="imghead" border="0" src="/eshop/Public/Home/Icon/good_default.png" onclick="$('#previewImg').click();">
                      <?php else: ?>
                      <img id="imghead" border="0" src="/eshop/<?php echo ($shopInfo["logo"]); ?>"onclick="$('#previewImg').click();"><?php endif; ?> 
                  </div>
                  <div>
                    <input type="file" name= "logo" onchange="previewImage(this)" style="display: none;" id="previewImg" accept="image/*">
                  </div>
                  <span class="names">店铺logo</span>
                </td>
                <td rowspan="2">
                  <div id="preview2">
                     <?php if(empty($shopInfo["qrcode"])): ?><img id="imghead" border="0" src="/eshop/Public/Home/Icon/good_default.png" onclick="$('#previewImg2').click();">
                      <?php else: ?>
                      <img id="imghead" border="0" src="/eshop/<?php echo ($shopInfo["qrcode"]); ?>"onclick="$('#previewImg2').click();"><?php endif; ?> 
                  </div>
                  <div>
                    <input type="file" name= "qrcode" onchange="previewImage2(this)" style="display: none;" id="previewImg2" accept="image/*">
                  </div>
                  <span class="names">店铺二维码</span>
                </td>
              </tr>
              <tr>
                <td class="itemsName">客服QQ：</td>
                <td><input type="text" name="shopqq" id="shopqq" class="inputs"value="<?php echo ($shopInfo["service_qq"]); ?>"/></td>
              </tr>
              <tr>
                <td class="itemsName">客服电话：</td>
                <td><input type="text" name="shopTel" id="shopTel" class="inputs" value="<?php echo ($shopInfo["server_tel"]); ?>"/></td>
              </tr>
              <tr>
                <td class="itemsName">店铺地址：</td>
                <td><input type="text" name="shopAddr" id="shopAddr" class="inputs" value="<?php echo ($shopInfo["address"]); ?>"/></td>
              </tr>
              <tr>
                <td class="itemsName">服务时间：</td>
                <td><input type="text" name="serverTime" id="serverTime" class="inputs" value="<?php echo ($shopInfo["server_time"]); ?>"/></td>
              </tr>
              <tr>
                <td colspan="2">
                  <input type="submit" value="编辑" class="btn" style="margin-left:150px"/>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
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