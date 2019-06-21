<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>新增商品</title>
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


<link rel="stylesheet" type="text/css" href="/eshop/Public/Common/webuploader/webuploader.css">
<script src="/eshop/Public/Common/ueditor/ueditor.config.js"></script>
<script src="/eshop/Public/Common/ueditor/ueditor.all.min.js"></script>
<script src="/eshop/Public/Common/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="/eshop/Public/Common/webuploader/webuploader.min.js"></script>
<script src="/eshop/Public/Home/Js/goodAdd.js"></script>
<script type="text/javascript">
  var getCart = "<?php echo U('getWebCart');?>";
  var goodsSave = "<?php echo U('goodsSave');?>";
  var auditIndex = "<?php echo U('Home/Good/audit');?>";
  var goodImg = "<?php echo U('goodImg');?>";
  var goodLogo = "<?php echo U('goodLogo');?>";
  var delImgItem = "<?php echo U('goodImgDel');?>";
  var sid = '<?php echo session_id();?>';
  var root = "/eshop/";
</script>
</head>
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
<div class="position_now">
  <label><a href="index.html">首页</a></label>
  <span>&gt</span>
  <label>商品分类</label>
</div>
<div class="scenter_wrapper"> 
  <!-- 商户中心左侧导航开始 --> 
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
 
  <!-- 商户中心左侧导航结束 --> 
  <!-- 商户中心右侧内容显示开始 -->
  <div class="scenter_right">
    <div class="scenter_right_title">
      <ul class="good_nav">
        <a href="javascript:;" class="active" rel="nav1">商品信息 </a> <a href="javascript:;" rel="nav2">商品属性</a> <a href="javascript:;" rel="nav3">商品图册</a>
      </ul>
    </div>
    <form id="goodInfo" autocomplete="off">
      <!-- 商品信息 -->
      <div class="scenter_right_content" id="nav1" >
        <table class="goodAdd_table">
          <tbody>
            <tr>
              <td class="saccount">商家账号：</td>
              <td><div class="sNick"><?php echo (session('uname')); ?></div></td>
            </tr>
            <tr>
              <td class="itemsName"><span class="icon">*</span>商品名称：</td>
              <td><input type="text" class="inputs" name="goodsName"/></td>
              <td rowspan="6" valign="top">
                <div id="preview" class="good_photo">
                  <img id="imghead" border="0" src="/eshop/Public/Home/Icon/good_default.png">
                </div>
                <div class="good_photo">
                  <input type="button" name="good_logoUploader" value="上传商品Logo" onclick="$('#previewImg').click();"/> 
                  <input type="file" name= "photo" onchange="previewImage(this)" style="display: none;" id="previewImg" accept="image/*">
                </div>
              </td>
            </tr>
            <tr>
              <td class="itemsName"><span class="icon">*</span>商品编号：</td>
              <td><input type="text" class="inputs" name="goodsSn" value="<?php echo ($goodNum); ?>"readonly="readonly"/></td>
            </tr>
            <tr>
              <td class="itemsName"><span class="icon">*</span>市场价格：</td>
              <td><input type="text" class="inputs" name="marketPrice" value="0.00"/></td>
            </tr>
            <tr>
              <td class="itemsName"><span class="icon">*</span>店铺价格：</td>
              <td><input type="text" class="inputs" name="shopPrice" value="0.00"/></td>
            </tr>
            <tr>
              <td class="itemsName"><span class="icon">*</span>商品库存：</td>
              <td><input type="text" class="inputs" name="stock" value="0" id="stock"/></td>
            </tr>
            <tr>
              <td class="itemsName">预警库存：</td>
              <td><input type="text" class="inputs" name="warnStock" value="0"/></td>
            </tr>
            <tr>
              <td class="itemsName"><span class="icon">*</span>商品产地：</td>
              <td><input type="text" class="inputs" name="place"/></td>
            </tr>
            <tr>
              <td class="itemsName"><span class="icon">*</span>商品状态：</td>
              <td class="attrSelect"><input type="radio"  name="status" value="1" checked="checked"/>
                <span>上架</span>
                <input type="radio"  name="goodStatus" value="0"/>
                <span>下架</span></td>
            </tr>
            <tr>
              <td class="itemsName">商品属性：</td>
              <td class="attrSelect"><input type="checkbox"  name="recomend" value="1" />
                <span>推荐</span>
                <input type="checkbox"  name="hot" value="1"/>
                <span>热销</span>
                <input type="checkbox"  name="newgood" value="1"/>
                <span>新品</span></td>
            </tr>
            <tr>
              <td class="itemsName"><span class="icon">*</span>商城分类：</td>
              <td class="attrSelect" width="500px"><select name="wfirst" id="wfirst" onchange="getNextCart('wSecond',this,0)">
                  <option value="0">--请选择--</option>
                  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data["id"]); ?>"><?php echo ($data["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <select name="wSecond" id="wSecond" onchange="getNextCart('wThird',this,1)">
                  <option value="">--请选择--</option>
                </select>
                <select name="wThird" id="wThird">
                  <option value="">--请选择--</option>
                </select></td>
            </tr>
            <tr>
              <td class="itemsName"><span class="icon">*</span>店铺分类：</td>
              <td class="attrSelect"><select name="sfirst" onchange="getShopCart(this)" action="<?php echo U('getShopCart');?>" id="sfirst">
                  <option value="0">--请选择--</option>
                  <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>"><?php echo ($item["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <select name="sSecond" id="sSecond">
                  <option value="">--请选择--</option>
                </select></td>
            </tr>
            <tr>
              <td class="itemsName">商品服务：</td>
              <td colspan="2">
                <textarea id="good_service" name="service_content"
                style="width: 720px; height: 250px;">
              </textarea>
              <!--  显示 ueditor编辑器 --> 
              <script type="text/javascript">
              var ue = UE.getEditor('good_service');
              </script>
            </td>
            </tr>
          </tbody>
        </table>
        <input type="submit" value="添加" class="btn" style="margin-left:150px"/>
        <input type="reset" value="重置" class="btn"/>
      </div>
      <!-- 商品信息 --> 
      <!-- 商品属性 -->
      <div class="scenter_right_content" id="nav2" style="display:none" >
        <table class="goodAdd_table">
          <tbody>
            <tr>
              <td class="saccount">商家账号：</td>
              <td><div class="sNick"><?php echo (session('uname')); ?> </div></td>
            </tr>
            <tr>
              <td class="itemsName1"><span class="icon">*</span><?php echo ($Goodlable[0]['name']); ?>：</td>
              <td><input type="text" class="inputs" name="pro[<?php echo ($Goodlable[0]['lableid']); ?>]"/></td>
            </tr>
            <tr>
              <td class="itemsName1"><?php echo ($Goodlable[1]['name']); ?>：</td>
              <td><input type="text" class="inputs" name="pro[<?php echo ($Goodlable[1]['lableid']); ?>]"/></td>
            </tr>
            <tr>
              <td class="itemsName1"><?php echo ($Goodlable[2]['name']); ?>：</td>
              <td><input type="text" class="inputs" name="pro[<?php echo ($Goodlable[2]['lableid']); ?>]" /></td>
            </tr>
            <tr>
              <td class="itemsName1"><span class="icon">*</span><?php echo ($Goodlable[3]['name']); ?>：</td>
              <td>
                <input class="Wdate inputs" type="text" onClick="WdatePicker()" name="pro[<?php echo ($Goodlable[3]['lableid']); ?>]">
              </td>
            </tr>
            <tr>
              <td class="itemsName1"><span class="icon">*</span><?php echo ($Goodlable[4]['name']); ?>：</td>
              <td><input type="text" class="inputs" name="pro[<?php echo ($Goodlable[4]['lableid']); ?>]" /></td>
            </tr>
            <tr>
              <td class="itemsName1"><?php echo ($Goodlable[5]['name']); ?>：</td>
              <td><input type="text" class="inputs" name="pro[<?php echo ($Goodlable[5]['lableid']); ?>]" /></td>
            </tr>
            <tr>
              <td class="itemsName1"><?php echo ($Goodlable[6]['name']); ?>：</td>
              <td class="attrSelect"><input type="radio"  name="pro[<?php echo ($Goodlable[6]['lableid']); ?>]" value="1" checked="checked"/>
                <span>是</span>
                <input type="radio"  name="pro[<?php echo ($Goodlable[6]['lableid']); ?>]" value="0"/>
                <span>否</span></td>
            </tr>
            <tr>
              <td class="itemsName1"><?php echo ($Goodlable[7]['name']); ?>：</td>
              <td class="attrSelect"><input type="radio"  name="pro[<?php echo ($Goodlable[7]['lableid']); ?>]" value="1" checked="checked"/>
                <span>是</span>
                <input type="radio"  name="pro[<?php echo ($Goodlable[7]['lableid']); ?>]" value="0"/>
                <span>否</span></td>
            </tr>
            <tr>
              <td class="itemsName1"><?php echo ($Goodlable[8]['name']); ?>：</td>
              <td><input type="text" class="inputs" name="pro[<?php echo ($Goodlable[8]['lableid']); ?>]" /></td>
            </tr>
          </tbody>
        </table>
        <input type="submit" value="添加" class="btn" style="margin-left:150px"/>
        <input type="reset" value="重置" class="btn"/>
      </div>
      <!-- 商品属性 --> 
      <!-- 商品图册 -->
      <div class="scenter_right_content" id="nav3" style="display:none" > 
        <div class="uploader-list-container">
          <div class="queueList">
            <div id="dndArea" class="placeholder">
              <div id="filePicker-2"></div>
              <p>或将照片拖到这里，单次最多可选10张，每张图片的大小不要超过5M（图片格式包含jpe,jpeg,phg,gif）</p>
            </div>
          </div>
          <div class="statusBar" style="display:none;">
            <div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
            <div class="info"></div>
            <div class="btns">
              <div id="filePicker2"></div>
              <div class="uploadBtn">开始上传</div>
            </div>
          </div>
        </div>
        <div style="margin:0 auto;text-align:center;s">
          <input type="submit" value="添加" class="btn"/>
          <input type="reset" value="重置" class="btn"/>
        </div>
      </div>
      <!-- 商品图册 -->
    </form>
  </div>
  <!-- 商户中心右侧内容显示结束 --> 
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