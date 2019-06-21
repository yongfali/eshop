<?php if (!defined('THINK_PATH')) exit();?><!-- 系统消息列表Ajax分页显示页面 -->
<div class="moreInfo_lists">
  <ul>
    <?php if(empty($infoList)): ?><li>暂无信息！！！</li>
      <?php else: ?>
      <?php if(is_array($infoList)): $i = 0; $__LIST__ = $infoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li>
          <a href="<?php echo U('infoDetail');?>"><?php echo ($data["title"]); ?></a>
          <span><?php echo (date("Y-m-d h：m：s",$data["modify_time"])); ?></span>
        </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
  </ul>
</div>
<!-- 分页开始 -->
<div class="pages"><?php echo ($page); ?></div>
<!-- 分页结束 -->