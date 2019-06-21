<?php if (!defined('THINK_PATH')) exit();?><!-- 商品收藏aJax分页内容 -->
<?php if(empty($lists)): ?><div>您还很懒，暂没有收藏的商品，请前往商城逛逛！！</div>
    <?php else: ?>
    <div class="collection-wraper">
    	<ul class="p_list">
    		<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
    				<div class="list-wrap">
    					<div class="p_pics">
    						<a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['goodid']));?>" class="eshop_img"><img src="/eshop/<?php echo ($item["good_log"]); ?>"/>
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
    							<span><a href="<?php echo U('Home/Shop/index',array('shopId'=>$item['shopid']));?>" target="_blank"><?php echo ($item["shopname"]); ?></a></span>
    						</div>
    						<div class="p_good_place">
    							<span style="color:#868686;"><?php echo ($item["place"]); ?></span>
    						</div>
    					</div>
    					<div class="p_operate">
    						<a href="javascript:void(0)" onclick="cancle(<?php echo ($item["id"]); ?>,0,<?php echo (session('uid')); ?>)">
    							<img src="/eshop/Public/Home/Icon/good-collection-do.png">
    							&nbsp;取消收藏
    						</a>
    						<a href="#" style="float:right;"> 
    							<img src="/eshop/Public/Home/Icon/add-cart.png">
    							&nbsp;加入购物车
    						</a>
    					</div>
    				</div>
    			</li><?php endforeach; endif; else: echo "" ;endif; ?>
    	</ul>
    </div><?php endif; ?>
<!-- 分页开始 -->
<div class="pages"><?php echo ($page); ?></div>
<!-- 分页结束 -->