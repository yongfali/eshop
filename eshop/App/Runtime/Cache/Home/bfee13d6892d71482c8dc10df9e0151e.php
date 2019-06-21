<?php if (!defined('THINK_PATH')) exit();?><!-- 收藏店铺ajax分页内容 -->
<div class="collection-wraper">
  <?php if(empty($lists)): ?><div>暂没收藏！！！</div>
    <?php else: ?>
    <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="shoper_info">
        <h3><?php echo ($item["name"]); ?></h3>
        <div class="shoper_item">
          <div class="shop_logo">
            <?php if(empty($$item["logo"])): ?><img src="/eshop/Public/Home/ShopImage/shop_logo.jpg">
              <?php else: ?>
              <img src="/eshop/<?php echo ($item["logo"]); ?>"><?php endif; ?>  
          </div>
          <div class="itemscore">商品评价：8分</div>
          <div class="itemscore">服务评分：8.2分</div>
          <div class="itemscore">物流评分：10分</div>
          <div class="shop_footer"> 
            <a href="<?php echo U('Home/Shop/index',array('shopId'=>$item['id']));?>" target="_blank">进店逛逛
            </a> 
            <a href="javascript:void(0);" onclick="cancle(<?php echo ($item["id"]); ?>,1,<?php echo (session('uid')); ?>)">取消关注</a> 
          </div>
        </div>
      </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
</div>
<!-- 分页开始 -->
<div class="pages"><?php echo ($page); ?></div>
<!-- 分页结束 -->