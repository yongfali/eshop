<?php
/**
*启用表单令牌功能，配置行为绑定
*/
return array(
         // 添加下面一行定义即可
         // 'view_filter' => array('Behavior\TokenBuild'),
        // 如果是3.2.1以上版本 需要改成
	'view_filter' => array('Behavior\TokenBuildBehavior'),
	);