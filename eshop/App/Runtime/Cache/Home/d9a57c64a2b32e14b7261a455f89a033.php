<?php if (!defined('THINK_PATH')) exit();?><!-- 商户操作记录Ajax分页 -->
<table class="scenter_table">
  <tbody>
    <?php if(empty($loglist)): ?><div class="nolog">还没有任何操作记录！！！</div>
      <?php else: ?>
      <thead>
        <tr class="header">
          <th>序号</th>
          <th>当前IP</th>
          <th>当前地址</th>
          <th>操作内容</th>
          <th>操作时间</th>
          <th>操作</th>
        </tr>
      </thead>
      <?php if(is_array($loglist)): $i = 0; $__LIST__ = $loglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr class="logList">
          <td><span><?php echo ($i); ?></span></td>
          <td><?php echo ($data["ip"]); ?></td>
          <td><?php echo ($data["location"]); ?></td>
          <td><?php echo ($data["action"]); ?></td>
          <td><?php echo (date("Y-m-d H:i:m",$data["time"])); ?></td>
          <td><a href="javascript:delLog(<?php echo ($data["id"]); ?>);">删除</a> <span>|</span> <a href="<?php echo U('modifyPwd');?>">修改密码</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
  </tbody>
</table>
<!-- 分页开始 -->
<div class="pages"><?php echo ($page); ?></div>
<!-- 分页结束 -->