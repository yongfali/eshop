<?php if (!defined('THINK_PATH')) exit();?><!-- 待审核/出售中/仓库中商品列表ajax分页 -->
<table class="auth_good_table">
  <thead>
    <th> 
      <input type="checkbox" id="allchecked" />
      <label for="allchecked">全选</label>
    </th>
    <th>商品名称</th>
    <th>商品编号</th>
    <th>价格</th>
    <th>库存</th>
    <th>销量</th>
    <th>推荐</th>
    <th>新品</th>
    <th>热销</th>
    <th>产地</th>
    <th>操作</th>
  </thead>
  <tbody>
    <?php if(empty($list)): ?><tr>
        <td colspan="11">没有相关数据！！！</td>
      </tr>
      <?php else: ?>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
          <td><input type="checkbox" id="check-<?php echo ($i); ?>" class="goods_check" value="<?php echo ($item["id"]); ?>"/></td>
          <td class="good_info"><div class="good_info_wrapper"> <a href="<?php echo U('Home/Index/goodsInfo',array('id' => $item['id']));?>" target="_blank"> <img src="/eshop/<?php echo ($item["good_log"]); ?>" style="width:45px;height:45px;"> </a> <span><?php echo ($item["name"]); ?></span> </div></td>
          <td><span><?php echo ($item["goodnumber"]); ?></span></td>
          <td><span style="color:red;"><?php echo ($item["shopprice"]); ?></span></td>
          <td><span><?php echo ($item["stock"]); ?></span></td>
          <td><span>0</span></td>
          <td class="icon_show"><?php if($item["is_recomend"] == 1): ?><img src="/eshop/Public/Home/Icon/check_mark.png" >
            <?php else: ?>
            <img src="/eshop/Public/Home/Icon/x.png" ><?php endif; ?>
          </td>
          <td class="icon_show"><?php if($item["is_new"] == 1): ?><img src="/eshop/Public/Home/Icon/check_mark.png" >
            <?php else: ?>
            <img src="/eshop/Public/Home/Icon/x.png" ><?php endif; ?>
          </td>
          <td class="icon_show"><?php if($item["is_hot"] == 1): ?><img src="/eshop/Public/Home/Icon/check_mark.png">
            <?php else: ?>
            <img src="/eshop/Public/Home/Icon/x.png" ><?php endif; ?>
          </td>
          <td><span><?php echo ($item["place"]); ?></span></td>
          <td>
            <a href="<?php echo U('Home/Index/goodsInfo',array('id' => $item['id']));?>" target='_blank' class="good_view" >查看</a>
            <a href="javascript:delGoods(0,<?php echo ($item["id"]); ?>)" class="good_del">删除</a> <a href="<?php echo U('Home/Good/edit',array('id' => $item['id'],'src' => 'audit'));?>" class="good_edit">编辑</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
  </tbody>
</table>
  <!-- 分页开始 -->
  <div class="pages"><?php echo ($page); ?></div>
  <!-- 分页结束 -->