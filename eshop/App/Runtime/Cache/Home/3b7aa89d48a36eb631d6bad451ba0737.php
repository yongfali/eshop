<?php if (!defined('THINK_PATH')) exit();?><!-- 消息列表Ajax分页实现 -->
<table class="infoList_table">
	<thead>
		<th width="6%"> 
			<input type="checkbox" id="allchecked" />
			<label for="allchecked">全选</label>
		</th>
		<th width="16%">标题</th>
		<th width="8%">类型</th>
		<th>内容简介</th>
		<th width="10%">发布时间</th>
		<th width="12%">操作</th>
	</thead>
	<tbody>
		<?php if(empty($infoList)): ?><tr>
				<td colspan="6">
					暂无数据！
				</td>
			</tr>
			<?php else: ?>
			<?php if(is_array($infoList)): $i = 0; $__LIST__ = $infoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
					<td><input type="checkbox" id="check-<?php echo ($i); ?>" class="infoList_check" value="<?php echo ($item["id"]); ?>"/>
					</td>
					<td class="info_title">
						<div>
							<span><?php echo ($item["title"]); ?></span>
						</div>
					</td>
					<td>
						<?php if($item["type"] == 1): ?><span>资讯</span>
							<?php else: ?>
							<span>优惠活动</span><?php endif; ?>
					</td>
					<td class="info_content">
						<div style="text-align:left;">
							<span><?php echo (mb_substr(html_entity_decode($item["content"]),0,70,'utf-8')); ?>....</span>
						</div>
					</td>
					<td>
						<span><?php echo (date("Y-m-d ",$item["publish_time"])); ?></span>
					</td>
					<td>
						<a href="<?php echo U('Home/Index/infoDetail',array('id' => $item['id'],'type' => $type));?>" target='_blank' class="info_view" >查看</a>
						<a href="javascript:delInfo(0,<?php echo ($item["id"]); ?>)" class="info_del">删除</a> 
						<a href="<?php echo U('infoEdit',array('id' => $item['id']));?>" class="info_edit">编辑</a>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	</tbody>
</table>
<!-- 分页开始 -->
<div class="pages"><?php echo ($page); ?></div>
<!-- 分页结束 -->