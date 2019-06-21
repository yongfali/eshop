<?php if (!defined('THINK_PATH')) exit();?><!-- 已评论页面AJAX分页 -->
<table class="orders_table">
  <thead>
    <th width="43%">订单详情</th>
    <th width="15%">商品评分</th>
    <th width="15%">物流评分</th>
    <th width="15%">服务评分</th>
    <th width="12%">操作</th>
  </thead>
  <?php if(empty($lists)): ?><tbody>
      <tr style="line-height:36px;text-align:center; color:red;"><td colspan="6">暂没有已评价订单！！！</td></tr>
    </tbody>
    <?php else: ?>
    <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tbody class="orders_items">
        <tr class="orders_head">
          <td colspan="6">
            <div class="order_time">
              <span>订单编号：<?php echo ($item["ordernum"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span>评价时间：<?php echo (date("Y-m-d  H：i：s",$item["confirmtime"])); ?></span>&nbsp;
            </div>
            <div class="order_status">已评价</div>
          </td>
        </tr>
        <tr class="orders_info">
          <td class="line" style="padding:0px 5px;">
            <div class="good_img">
              <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['goodid']));?>" target="_blank">
                <img src="<?php echo ($item["goodimg"]); ?>">
              </a>
            </div>
            <div class="good_detail" style="max-width:245px;">
              <span>
                <?php echo ($item["goodname"]); ?>
              </span>
            </div>
            <div class="good_num">
              <span>&yen;<?php echo ($item["goodprice"]); ?>&times;<?php echo ($item["goodnum"]); ?></span>
            </div>
          </td>
          <td class="line">
           <?php $__FOR_START_10061__=1;$__FOR_END_10061__=$item["goodscore"];for($i=$__FOR_START_10061__;$i < $__FOR_END_10061__;$i+=2){ ?><img src="/eshop/Public/Home/Icon/star_gold.png"/><?php } ?>
        </td>
        <td class="line">
          <?php $__FOR_START_25090__=1;$__FOR_END_25090__=$item["logisticsscore"];for($i=$__FOR_START_25090__;$i < $__FOR_END_25090__;$i+=2){ ?><img src="/eshop/Public/Home/Icon/star_gold.png"/><?php } ?>
        </td>
        <td class="line">
          <?php $__FOR_START_1811__=1;$__FOR_END_1811__=$item["servicescore"];for($i=$__FOR_START_1811__;$i < $__FOR_END_1811__;$i+=2){ ?><img src="/eshop/Public/Home/Icon/star_gold.png"/><?php } ?>
        </td>
        <td class="orders_action">
          <a href="javascript:orderDel(<?php echo ($item["orderid"]); ?>)">删除</a>
          <a href="<?php echo U('Home/UserOrders/orderDetail',array('orderId' => $item['orderid']));?>">订单详情</a>
        </td>
      </tr>
      <tr class="order-appraise">
       <td colspan="5">
        <span>评价内容：</span>
        <span><?php echo ($item["contents"]); ?></span>
      </td>
    </tr>
  </tbody><?php endforeach; endif; else: echo "" ;endif; endif; ?>
</table>
<!-- 分页开始 -->
<div class="pages"><?php echo ($page); ?></div>
<!-- 分页结束 -->