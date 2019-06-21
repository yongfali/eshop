<?php if (!defined('THINK_PATH')) exit(); if(empty($goodList)): ?>暂无商品！！！
  <?php else: ?>
  <ul class="p_list">
    <?php if(is_array($goodList)): $i = 0; $__LIST__ = $goodList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
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
          <a href="goods_info.html" target="_blank"><?php echo ($item["goodname"]); ?>
          </a> 
        </div>
        <div class="p_shop_info">
          <div class="p_shop_name">
            <span><a href="shopIndex.html" target="_blank"><?php echo ($item["shopname"]); ?></a></span>
          </div>
          <div class="p_good_place">
            <span style="color:#868686;"><?php echo ($item["place"]); ?></span>
          </div>
        </div>
        <div class="p_operate">
          <?php if(checkCollection($item['goodid'],0) == 1): ?><a href="javascript:void(0)" onclick="cancle(<?php echo ($item["goodid"]); ?>,0,<?php echo (session('uid')); ?>)">
              <img src="/eshop/Public/Home/Icon/good-collection-do.png">
              &nbsp;取消收藏
            </a>
            <?php else: ?>
            <a href="javascript:void(0)" onclick="Collection(<?php echo ($item["goodid"]); ?>,0)">
              <img src="/eshop/Public/Home/Icon/good-collection.png">
              &nbsp;收藏
            </a><?php endif; ?>
          <a href="javascript:void(0);" style="float:right;" onclick="addCarts(<?php echo ($item["goodid"]); ?>,1)"> 
            <img src="/eshop/Public/Home/Icon/add-cart.png">
            &nbsp;加入购物车
          </a>
        </div>
      </div>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul><?php endif; ?>
<!-- 分页开始 -->
<div class="pages" style="clear:both;"><?php echo ($page); ?></div>