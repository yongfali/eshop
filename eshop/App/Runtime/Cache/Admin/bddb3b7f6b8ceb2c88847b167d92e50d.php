<?php if (!defined('THINK_PATH')) exit();?><table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>
				<div class="checkbox">
					<label>
						<input type="checkbox" id="allchecked" autocomplete="off">全选
					</label>
				</div>
			</th>
			<th>标题</th>
			<th>分类</th>
			<th>发布者</th>
			<th>发布者身份</th>
			<th>发布时间</th>
			<th>最近一次修改</th>
			<th>操作</th>
		</tr>
	</thead>
	<?php if(empty($infoList)): ?><tbody><tr><td colspan="8">暂无消息！！！</td></tr></tbody>
		<?php else: ?>
		<?php if(is_array($infoList)): $i = 0; $__LIST__ = $infoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tbody>
				<tr class="data-item">
					<td>
						<div class="checkbox">
							<label>
								<input type="checkbox" class="item-check" value="<?php echo ($item["id"]); ?>" autocomplete="off">
							</label>
						</div>
					</td>
					<td><?php echo ($item["title"]); ?></td>
					<td>    
						<?php switch($item["type"]): case "1": ?>资讯<?php break;?>
							<?php case "2": ?>优惠活动<?php break;?>
							<?php default: ?>公告<?php endswitch;?>
					</td>
					<td><?php echo ($item["publishername"]); ?></td>
					<td>
						<?php switch($item["publishtype"]): case "1": ?>商家<?php break;?>
							<?php default: ?>管理员<?php endswitch;?>
					</td>
					<td><?php echo (date("Y-m-d",$item["publish_time"])); ?></td>
					<td><?php echo (date("Y-m-d",$item["modify_time"])); ?></td>
					<td>
						<a class="btn-link" href="javascript:void(0);">修改</a>
						<a class="btn-link" href="javascript:void(0);" onclick="delInfo(0,<?php echo ($item["id"]); ?>)">删除</a>
					</td>
				</tr>
			</tbody><?php endforeach; endif; else: echo "" ;endif; endif; ?>
</table>
<!-- 分页开始 -->
<div class="pages"><?php echo ($page); ?></div>
<!-- 分页结束 -->