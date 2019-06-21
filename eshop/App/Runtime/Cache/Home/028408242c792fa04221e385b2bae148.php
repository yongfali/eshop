<?php if (!defined('THINK_PATH')) exit();?><!-- 预警商品Ajax分页显示 -->
  <table class="auth_good_table">
            <thead>
              <th> 
                <input type="checkbox" id="allchecked" />
                <label for="allchecked">全选</label>
              </th>
              <th>商品名称</th>
              <th>商品编号</th>
              <th>现有库存<span style="color:red;">（可编辑）</span></th>
              <th>预警库存<span style="color:red;">（可编辑）</span></th>
              <th>操作</th>
            </thead>
            <tbody>
              <?php if(empty($list)): ?><tr>
                  <td colspan="11">没有相关数据！！！</td>
                </tr>
                <?php else: ?>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
                    <td><input type="checkbox" id="check-<?php echo ($i); ?>" class="goods_check" value="<?php echo ($item["id"]); ?>"/></td>
                    <td class="good_info"><div class="good_info_wrapper"> <a href="<?php echo U('Home/Good/info',array('id' => $item['id']));?>" target="_blank"> <img src="/eshop/<?php echo ($item["good_log"]); ?>" style="width:45px;height:45px;"> </a> <span><?php echo ($item["name"]); ?></span> </div></td>
                    <td><span><?php echo ($item["goodnumber"]); ?></span></td>
                    <td>
                      <span>
                        <input type="text" name="stock" value="<?php echo ($item["stock"]); ?>" class="inputs" style="width:60px;text-align:center;" onchange="editStock(this,<?php echo ($item["id"]); ?>,0)" autocomplete="off"> 
                      </span>
                    </td>
                    <td>
                      <span>
                        <input type="text" name="stock" value="<?php echo ($item["stock_warning"]); ?>" class="inputs" style="width:60px;text-align:center;" onchange="editStock(this,<?php echo ($item["id"]); ?>,1)" autocomplete="off"> 
                      </span>
                      </td>
                    <td>
                      <a href="<?php echo U('Home/Good/info',array('id' => $item['id']));?>" target='_blank' class="good_view" >查看</a>
                      <a href="javascript:delGoods(0,<?php echo ($item["id"]); ?>)" class="good_del">删除</a> 
                    </td>
                  </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </tbody>
  </table>
  <!-- 分页开始 -->
  <div class="pages"><?php echo ($page); ?></div>
  <!-- 分页结束 -->