<?php if (!defined('THINK_PATH')) exit();?><!-- 商品分类Ajax分页显示 -->
<div class="right_category_product">
 <?php if(empty($goods)): ?><div style="color:red; text-align:center;">暂没有商品！！！</div>
  <?php else: ?>
  <div class="shop_category_show">
    <ul class="p_list">
      <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
          <div class="list-wrap">
            <div class="p_pics">
              <a href="<?php echo U('Home/Index/info',array('id'=>$item['goodid']));?>" class="eshop_img"><img src="/eshop/<?php echo ($item["good_log"]); ?>"/>
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
            <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['goodid']));?>" target="_blank">树懒果园 <?php echo ($item["name"]); ?> 
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