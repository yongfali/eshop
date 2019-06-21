<?php if (!defined('THINK_PATH')) exit();?><!-- 消息列表AJAX分页 -->
<table class="msg-table">
	<thead>
		<tr>
			<th width="8%">
				<input type="checkbox" id="allchecked" autocomplete="off"/>
				<label for="allchecked">全选</label>
			</th>
			<th width="6%">状态</th>
			<th width="76%">内容</th>
			<th width="10%" style="text-align:center;">操作</th>
		</tr>
	</thead>
	<tbody>
		<?php if(empty($list)): ?><tr>
				<td colspan="4" style="text-align:center;color:red;">
					暂无消息！！！
				</td>
			</tr>
			<?php else: ?>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
					<td class="msg-item-box"><input type="checkbox" class="msg_check" value="<?php echo ($item["id"]); ?>" autocomplete="off"/></td>
					<td>
						<span class="newMsg">
							<?php if($item["status"] == 1): ?><img src="/eshop/Public/Home/Icon/redMsg.png"> 
								<?php else: ?>
								<img src="/eshop/Public/Home/Icon/newMsg.png"><?php endif; ?>
						</span>
					</td>
					<td class="msg-content"><span><?php echo ($item["content"]); ?></span></td>
					<td class="msg-actions">
						<?php if($item["status"] == 1): ?><a href="<?php echo U('messageDetail',array('msgId' => $item['id'],'status'=>'old'));?>" >查看</a>
							<?php else: ?>
							<a href="<?php echo U('messageDetail',array('msgId' => $item['id'],'status'=>'new'));?>" >查看</a><?php endif; ?>  
						<a href="javascript:delMsg(0,<?php echo ($item["id"]); ?>);" rel="<?php echo U('messageDel');?>">删除</a>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>	
	</tbody>
</table>
<!-- 分页开始 -->
<div class="pages"><?php echo ($page); ?></div>
<!-- 分页结束 -->