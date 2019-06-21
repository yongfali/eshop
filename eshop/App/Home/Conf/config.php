<?php
return array(
	//'配置项'=>'配置值'
	//用户头像上传参数配置
	'UPLOAD_FACE' => array(
        'maxSize'       =>  3145728, //上传的文件大小限制 (0-不做限制)
        'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
        'autoSub'       =>  true, //自动子目录保存文件
        'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath'      =>  'Uploads/Users/', //保存根路径
        'savePath'      =>  '', //保存路径
        'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'       =>  'jpg', //文件保存后缀，空则使用原后缀
        'replace'       =>  true, //存在同名是否覆盖
        'hash'          =>  true, //是否生成hash编码
    ),
    //商品图片上传参数配置
    'UPLOAD_SHOPS' => array(
        'maxSize'       =>  5242880, //上传的文件大小不超过5M
        'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
        'autoSub'       =>  true, //自动子目录保存文件
        'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式
        'rootPath'      =>  'Uploads/Shops/goods/', //保存根路径
        'savePath'      =>  '', //保存路径
        'saveName'      =>  array('uniqid', ''), //上传文件命名规则
        'saveExt'       =>  'jpg', //文件保存后缀，空则使用原后缀
        'replace'       =>  true, //存在同名是否覆盖
        ),
     //商品Logo上传参数配置
    'UPLOAD_Logo' => array(
        'maxSize'       =>  4194304, //上传的文件大小不超过4M
        'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
        'autoSub'       =>  true, //自动子目录保存文件
        'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式
        'rootPath'      =>  'Uploads/Shops/logo/', //保存根路径
        'savePath'      =>  '', //保存路径
        'saveName'      =>  array('uniqid', ''), //上传文件命名规则
        'saveExt'       =>  'jpg', //文件保存后缀，空则使用原后缀
        'replace'       =>  true, //存在同名是否覆盖
        ),
    //店铺Logo上传参数配置
    'UPLOAD_ShopLogo' => array(
        'maxSize'       =>  4194304, //上传的文件大小不超过4M
        'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
        'autoSub'       =>  true, //自动子目录保存文件
        'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式
        'rootPath'      =>  'Uploads/Shops/face/', //保存根路径
        'savePath'      =>  '', //保存路径
        'saveName'      =>  array('uniqid', ''), //上传文件命名规则
        'saveExt'       =>  'jpg', //文件保存后缀，空则使用原后缀
        'replace'       =>  true, //存在同名是否覆盖
        ),
    //店铺二维码上传参数配置
    'UPLOAD_Qrcode' => array(
        'maxSize'       =>  4194304, //上传的文件大小不超过4M
        'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
        'autoSub'       =>  true, //自动子目录保存文件
        'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式
        'rootPath'      =>  'Uploads/Shops/qrcode/', //保存根路径
        'savePath'      =>  '', //保存路径
        'saveName'      =>  array('uniqid', ''), //上传文件命名规则
        'saveExt'       =>  'jpg', //文件保存后缀，空则使用原后缀
        'replace'       =>  true, //存在同名是否覆盖
        ),
    //店铺首页广告上传参数配置
    'UPLOAD_ADS' => array(
        'maxSize'       =>  5242880, //上传的文件大小不超过5M
        'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
        'autoSub'       =>  true, //自动子目录保存文件
        'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式
        'rootPath'      =>  'Uploads/Shops/ads/', //保存根路径
        'savePath'      =>  '', //保存路径
        'saveName'      =>  array('uniqid', ''), //上传文件命名规则
        'saveExt'       =>  'png', //文件保存后缀，空则使用原后缀
        'replace'       =>  true, //存在同名是否覆盖
        ),
    // 配置邮件发送服务器
    'MAIL_SMTP'            =>  TRUE,
    'MAIL_HOST'            =>  'smtp.163.com',          //邮件发送SMTP服务器
    'MAIL_SMTPAUTH'   =>  TRUE,
    'MAIL_USERNAME'   =>  'myblog_1994@163.com',       //SMTP服务器登录用户名
    'MAIL_PASSWORD'   =>  'lyf19941009',              //SMTP服务器登录密码
    'MAIL_CHARSET'       =>  'utf-8',
    'MAIL_ISHTML'         =>  TRUE,
    'MAIL_FROMNAME' =>  '微农官方平台',
    //商品key加密字符串
    'GOODSTRING' => 'www.weinong.com',
    'TOKEN_ON'      =>    false,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true

    //腾讯QQ登录配置
    // 'THINK_SDK_QQ' => array(
    //     'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    //     'APP_SECRET' => '', //应用注册成功后分配的KEY
    //     'CALLBACK'   => URL_CALLBACK . 'qq',
    // ),
    // 默认错误跳转对应的模板文件
    // 'TMPL_ACTION_ERROR'     =>  MODULE_PATH.'View/default/Public/exception.html', 
    // 异常页面的模板文件
    // 'TMPL_EXCEPTION_FILE'   =>  MODULE_PATH.'View/default/Public/exception.html',
);