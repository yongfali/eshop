<?php
// 应用入口文件
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
// 定义项目名称
define('APP_NAME','App');
//绑定Admin模块
//define('BIND_MODULE', 'Admin');
// 定义应用目录
define('APP_PATH','./App/');
// 引入ThinkPHP入口文件  核心运行文件
require './ThinkPHP/ThinkPHP.php';
//定义常量
define('__PUBLIC__', "http://localhost/APP/Public");
