<?php if (!defined('THINK_PATH')) exit();?><table class="orders_table">
  <thead>
    <th width="16%">订单编号</th>
    <th width="12%">投诉者</th>
    <th width="30%">投诉类型</th>
    <th width="16%">投诉时间</th>
    <th width="14%">投诉状态</th>
    <th width="12%">操作</th>
  </thead>
  <tbody class="complaint_items">
    <?php if(empty($lists)): ?><tr>
        <td colspan="6" style="color:red;">暂没有投诉订单！！！</td>
      </tr>
      <?php else: ?>
      <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
          <td style="padding:0px 5px;"><span><?php echo ($item["ordernum"]); ?> </span></td>
          <td><span><?php echo ($item["username"]); ?></span></td>
          <td class="reason">
            <span >
              <?php switch($item["complaintype"]): case "1": ?>卖家存在欺诈行为<?php break;?>
                <?php case "2": ?>未按约定时间发货<?php break;?>
                <?php case "3": ?>未按成交价格进行交易<?php break;?>
                <?php case "4": ?>虚假销售<?php break;?>
                <?php default: ?>其它<?php endswitch;?>
              商品与图片描述不符！！！ 
            </span>
          </td>
          <td><span><?php echo (date("Y-m-d H:i:s",$item["time"])); ?></span></td>
          <td>
            <span>
              <?php if($item["is_cancle"] == 1): ?>用户已取消投诉！
                <?php elseif($item["is_deal"] == 0): ?>
                系统未受理！
                <?php elseif(($item["is_deal"] == 1) AND ($item["is_complete"] == 0)): ?>
                正在处理中...
                <?php else: ?>
                已处理<?php endif; ?>
            </span>
          </td>
          <td class="orders_action">
            <a href="<?php echo U('Home/ShopOrders/complaintDetail');?>">详情</a>
            <a href="#">联系买家</a>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
  </tbody>
</table>
<!-- 分页开始 -->
<div class="pages"><?php echo ($page); ?></div>
<!-- 分页结束 -->