<?php
/**
 *eshop系统配置文件
 */
return array(
    // '配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'eshop', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => 'lyf19941009', // 密码
    'DB_PORT' => '3306', // 端口
    'DB_PREFIX' => 'eshop_', // 数据库表前缀
    'DB_CHARSET' => 'utf8', // 数据库编码默认采用utf8
    /* URL设置 */
    'URL_CASE_INSENSITIVE' => true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_HTML_SUFFIX' => 'html|shtml|xml',  // URL伪静态后缀设置
    /* 设置默认的模板主题*/
    'DEFAULT_THEME' => 'default', 
    /*显示页面 Trace 信息*/
    'SHOW_PAGE_TRACE'   =>  true,
    /*异位或加密字符串*/
    'ENCRIPTION' => 'www.eshop.lyf94.com',
    /*COOKIE设置*/
    'COOKIE_EXPIRE_TIME' => 3600*24*7,
    // 'COOKIE_SECURE'  =>  true,   // Cookie安全传输
    /*设置允许访问的模块*/
    'MODULE_ALLOW_LIST' => array('Home','Admin'),
    /*设置基本的字段过滤方法htmlspecialchars转义html,strip_tags 剥去字符串中的 HTML 标签,stripslashes 转义'\',trim去除左右空格 */
    'DEFAULT_FILTER' => 'htmlspecialchars,strip_tags,stripslashes,trim',
    /*session*/
    'VAR_SESSION_ID' => 'session_id',
    /*SESSION过期配置*/
    // 'SESSION_OPTIONS'         =>  array(
    //     'name'                =>  'temp_orderNumber',//设置session名
    //     'expire'              =>  300,//SESSION过期时间，单位秒
    //     'use_trans_sid'       =>  1,//跨页传递
    //     'use_only_cookies'    =>  0,//是否只开启基于cookies的session的会话方式
    // ),
);