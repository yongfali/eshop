<?php if (!defined('THINK_PATH')) exit();?><!-- 订单ajax分页部分 -->
<table class="orders_table">
  <thead>
    <th width="53%">订单详情</th>
    <th width="10%">支付方式</th>
    <th width="10%">配送方式</th>
    <?php switch($pageType): case "waitDelivery": ?><th width="17%">总金额</th>
        <th width="10%">操作</th><?php break;?>
      <?php default: ?>
      <th width="19%">总金额</th>
      <th width="8%">操作</th><?php endswitch;?>
  </thead>
  <?php if(empty($lists)): ?><tbody>
      <tr style="line-height:36px;text-align:center; color:red;"><td colspan="6">暂没有相关订单！！！</td></tr>
    </tbody>
    <?php else: ?>
    <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tbody class="orders_items">
        <tr class="orders_head">
          <td colspan="6">
            <div class="order_time">
              <span>订单编号：<?php echo ($item["ordernum"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span>
                <?php switch($pageType): case "delivered": ?>发货时间：<?php echo (date("Y-m-d  H：i：s",$item["delivertime"])); break;?>
                  <?php case "finished": ?>收货时间：<?php echo (date("Y-m-d  H：i：s",$item["confirmtime"])); break;?>
                  <?php case "cancle": ?>收货时间：<?php echo (date("Y-m-d  H：i：s",$item["canceltime"])); break;?>
                  <?php default: ?>
                  下单时间：<?php echo (date("Y-m-d  H：i：s",$item["create_time"])); endswitch;?>
              </span>
            </div>
            <div class="order_status">
              <?php switch($pageType): case "waitDelivery": ?>等待发货<?php break;?>
              <?php case "delivered": ?>配送中<?php break;?>
              <?php case "finished": ?>已收货<?php break;?>
              <?php case "cancle": ?>已取消<?php break;?>
              <?php default: ?>等待支付<?php endswitch;?>
            </div>
          </td>
        </tr>
        <tr class="orders_info">
          <td class="line" style="padding:0px 5px;">
            <div class="good_img">
              <a href="<?php echo U('Home/Index/goodsInfo',array('id'=>$item['goodid']));?>" target="_blank">
                <img src="<?php echo ($item["goodimg"]); ?>">
              </a>
            </div>
            <div class="good_detail">
              <span>
               <?php echo ($item["goodname"]); ?>
             </span>
           </div>
           <div class="good_num">
            <span>&yen;<?php echo ($item["goodprice"]); ?>&times;<?php echo ($item["goodnum"]); ?></span>
          </div>
        </td>
        <td class="line">
          <?php if($item["paytype"] == 1): ?><span>支付宝</span>
            <?php elseif($item["paytype"] == 2): ?>
            <span>微信</span>
            <?php elseif($item["paytype"] == 3): ?>
            <span>银联</span>
            <?php else: ?>
            <span>其它支付方式</span><?php endif; ?>
        </td>
        <td class="line"><span>京东配送</span></td>
        <td class="line">
          <div class="money_item">
            商品金额：&yen;<?php echo ($item["goodsmoney"]); ?>
          </div>
          <div class="money_item">运费：&yen;<?php echo ($item["delivermoney"]); ?></div>
          <div class="money_item">实付金额：<span style="color:red;">&yen;<?php echo ($item["totalmoney"]); ?></span></div>
        </td>
        <td class="orders_action">
          <?php switch($pageType): case "waitDelivery": ?><a href="#">发货</a>
              <a href="<?php echo U('Home/ShopOrders/orderDetail',array('orderId' => $item['orderid']));?>">订单详情</a><?php break;?>
            <?php default: ?>
            <a href="<?php echo U('Home/ShopOrders/orderDetail',array('orderId' => $item['orderid']));?>">订单详情</a><?php endswitch;?>
        </td>
      </tr>
    </tbody><?php endforeach; endif; else: echo "" ;endif; endif; ?>
</table>
<!-- 分页开始 -->
<div class="pages"><?php echo ($page); ?></div>
<!-- 分页结束 -->