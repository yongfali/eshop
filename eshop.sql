-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 06 月 11 日 06:06
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `eshop`
--
CREATE DATABASE IF NOT EXISTS `eshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `eshop`;

-- --------------------------------------------------------

--
-- 表的结构 `eshop_admin`
--

CREATE TABLE IF NOT EXISTS `eshop_admin` (
  `id` int(25) NOT NULL AUTO_INCREMENT COMMENT '管理员自增序列号',
  `name` varchar(50) NOT NULL COMMENT '账号',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `email` varchar(100) NOT NULL COMMENT '邮箱地址',
  `type` int(20) DEFAULT '0' COMMENT '类型',
  `create_time` int(20) DEFAULT NULL COMMENT '创建时间',
  `loginTime` int(10) NOT NULL COMMENT '最近一次登录时间',
  `ip` varchar(50) NOT NULL COMMENT '最近一次登录IP',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `eshop_admin`
--

INSERT INTO `eshop_admin` (`id`, `name`, `password`, `email`, `type`, `create_time`, `loginTime`, `ip`, `is_show`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@eshop.com', 0, NULL, 1497141950, '0.0.0.0', 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_cart`
--

CREATE TABLE IF NOT EXISTS `eshop_cart` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT COMMENT '购物车列表序列号',
  `goodId` bigint(20) NOT NULL COMMENT '商品序列号',
  `userId` int(250) NOT NULL COMMENT '用户序列号',
  `mount` int(10) DEFAULT NULL COMMENT '购物车商品数量',
  `time` int(10) NOT NULL COMMENT '商品添加时间',
  PRIMARY KEY (`id`),
  KEY `goodId` (`goodId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='购物车列表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `eshop_cart`
--

INSERT INTO `eshop_cart` (`id`, `goodId`, `userId`, `mount`, `time`) VALUES
(1, 17, 20, 1, 1496795993),
(2, 10, 20, 1, 1496795993);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_collection`
--

CREATE TABLE IF NOT EXISTS `eshop_collection` (
  `id` bigint(250) NOT NULL AUTO_INCREMENT COMMENT '收藏自增序列号',
  `targetId` bigint(20) NOT NULL COMMENT '被收藏目标ID',
  `type` int(2) DEFAULT '0' COMMENT '收藏目标类型默认为0表示为商品，1表示为店铺',
  `userId` int(250) NOT NULL COMMENT '收藏者ID',
  `time` int(10) DEFAULT NULL COMMENT '收藏的时间',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='我的收藏' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `eshop_collection`
--

INSERT INTO `eshop_collection` (`id`, `targetId`, `type`, `userId`, `time`) VALUES
(4, 13, 0, 20, 1492395350),
(6, 17, 0, 20, 1492400334),
(8, 2, 1, 20, 1492400336),
(11, 3, 1, 20, 1492692194),
(12, 10, 0, 20, 1494734707);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_express`
--

CREATE TABLE IF NOT EXISTS `eshop_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '快递公司序列号自增',
  `name` varchar(50) NOT NULL COMMENT '快递公司名称',
  `is_show` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否显示，默认1显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='快递公司信息' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `eshop_express`
--

INSERT INTO `eshop_express` (`id`, `name`, `is_show`) VALUES
(1, '申通快递', 1),
(2, '顺丰快递', 1),
(3, '邮政快递', 1),
(4, '圆通快递', 1),
(5, '韵达快递', 1),
(6, '菜鸟快递', 1),
(7, '中通快递', 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_firstmenu`
--

CREATE TABLE IF NOT EXISTS `eshop_firstmenu` (
  `id` int(150) NOT NULL AUTO_INCREMENT COMMENT '菜单序列号',
  `name` varchar(50) NOT NULL COMMENT '菜单名字',
  `creater_name` varchar(50) DEFAULT NULL COMMENT '菜单创建者',
  `create_time` int(20) DEFAULT NULL COMMENT '菜单创建时间',
  `modify_name` varchar(50) DEFAULT NULL COMMENT '菜单修改者',
  `modify_time` int(20) DEFAULT NULL COMMENT '菜单修改时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='全站一级菜单分类表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `eshop_firstmenu`
--

INSERT INTO `eshop_firstmenu` (`id`, `name`, `creater_name`, `create_time`, `modify_name`, `modify_time`, `is_show`) VALUES
(1, '蔬菜豆豉，时令蔬菜', NULL, NULL, NULL, NULL, 1),
(2, '新鲜水果，绿色食品', NULL, NULL, NULL, NULL, 1),
(3, '鲜肉蛋禽，牲畜活禽', NULL, NULL, NULL, NULL, 1),
(4, '水产海鲜，新鲜上市', NULL, NULL, NULL, NULL, 1),
(5, '素食冻品，质检合格', NULL, NULL, NULL, NULL, 1),
(6, '粮油食品，无转基因', NULL, NULL, NULL, NULL, 1),
(7, '南北干货，地方美食', NULL, NULL, NULL, NULL, 1),
(8, '茶叶冲饮，冰镇饮料', NULL, NULL, NULL, NULL, 1),
(9, '地方特产，特色美味', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_footer_nav`
--

CREATE TABLE IF NOT EXISTS `eshop_footer_nav` (
  `id` int(100) NOT NULL AUTO_INCREMENT COMMENT '自增序列号',
  `name` varchar(50) NOT NULL COMMENT '标签名',
  `content` text NOT NULL COMMENT '内容',
  `pid` int(100) NOT NULL DEFAULT '0' COMMENT '父标签序列号',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `modify_time` int(10) NOT NULL DEFAULT '0' COMMENT '最近一次修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商城底部帮助中心标签导航表' AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `eshop_footer_nav`
--

INSERT INTO `eshop_footer_nav` (`id`, `name`, `content`, `pid`, `create_time`, `modify_time`) VALUES
(1, '新手指南', '', 0, 0, 0),
(2, '商家入驻', '', 0, 0, 0),
(3, '订单服务', '', 0, 0, 0),
(4, '配送说明', '', 0, 0, 0),
(5, '售后服务', '', 0, 0, 0),
(6, '购物流程', '&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170611/1497158702136100.jpg&quot; title=&quot;1497158702136100.jpg&quot; alt=&quot;rBEQWVFlHpYIAAAAAACI4qKbEu4AAD0VAKcRBMAAIj6957.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;						&lt;/p&gt;', 1, 0, 1497158705),
(7, '注册须知', '', 1, 0, 0),
(8, '会员服务', '', 1, 0, 0),
(9, '关于我们', '', 1, 0, 0),
(10, '商家注册', '', 2, 0, 0),
(11, '店铺管理', '', 2, 0, 0),
(12, '诚信手册', '', 2, 0, 0),
(13, '常见问题', '', 2, 0, 0),
(14, '支付方式', '', 3, 0, 0),
(15, '订单处理', '', 3, 0, 0),
(16, '退款处理', '', 3, 0, 0),
(17, '常见问题', '', 3, 0, 0),
(18, '配送方式', '', 4, 0, 0),
(19, '配送费用', '', 4, 0, 0),
(20, '签收须知', '', 4, 0, 0),
(21, '常见问题', '', 4, 0, 0),
(22, '消费维权', '', 5, 0, 0),
(23, '投诉方式', '', 5, 0, 0),
(24, '问题反馈', '', 5, 0, 0),
(25, '常见问题', '', 5, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_good`
--

CREATE TABLE IF NOT EXISTS `eshop_good` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '商品序列号',
  `goodNumber` varchar(50) NOT NULL COMMENT '商品编号',
  `name` varchar(100) NOT NULL COMMENT '商品名',
  `marketPrice` decimal(10,2) DEFAULT NULL,
  `shopPrice` decimal(10,2) DEFAULT NULL,
  `place` varchar(150) NOT NULL COMMENT '产地 ',
  `stock` int(50) NOT NULL DEFAULT '0' COMMENT '库存 ',
  `stock_warning` int(50) NOT NULL DEFAULT '0' COMMENT '预警库存 ',
  `status` int(2) DEFAULT '1' COMMENT '商品状态',
  `is_new` int(2) DEFAULT '0' COMMENT '是否新品 ',
  `is_hot` int(2) DEFAULT '0' COMMENT '是否热销 ',
  `is_recomend` int(2) DEFAULT '0' COMMENT '是否推荐 ',
  `is_exam` int(2) DEFAULT '0' COMMENT '是否审核 ',
  `is_legal` int(2) DEFAULT '1' COMMENT '是否合法',
  `ilegal_reason` varchar(250) DEFAULT NULL COMMENT '商品违规原因',
  `is_forbid` int(2) DEFAULT '0' COMMENT '是否下架管理员 ',
  `is_show` int(2) NOT NULL DEFAULT '1' COMMENT '是否显示用于商家删除',
  `good_log` varchar(100) NOT NULL COMMENT '商品logo图片',
  `count` int(100) NOT NULL DEFAULT '0' COMMENT '商品的销量',
  `time` int(10) DEFAULT NULL COMMENT '信息填写时间 ',
  `modify_recenet` int(10) DEFAULT NULL COMMENT '最近一次修改时间 ',
  PRIMARY KEY (`id`),
  UNIQUE KEY `goodNumber` (`goodNumber`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品基本信息表 ' AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `eshop_good`
--

INSERT INTO `eshop_good` (`id`, `goodNumber`, `name`, `marketPrice`, `shopPrice`, `place`, `stock`, `stock_warning`, `status`, `is_new`, `is_hot`, `is_recomend`, `is_exam`, `is_legal`, `ilegal_reason`, `is_forbid`, `is_show`, `good_log`, `count`, `time`, `modify_recenet`) VALUES
(10, '14828254901325292459', '进口大鸭梨1', '12.00', '1.00', '泰国', 339, 12, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 'Uploads/Shops/logo/2017-03-28/thumb_58da4a8b69ad4.jpg', 21, 1490961727, 1491525883),
(13, '14828254901339183177', '玉米', '2.50', '1.20', '湖南邵阳', 171, 120, 1, 0, 1, 1, 1, 1, NULL, 0, 1, 'Uploads/Shops/logo/2017-04-08/thumb_58e8756a1e8b5.jpg', 334, 1491629418, 1491629418),
(14, '14828254901346173251', '湖南红柚', '3.20', '1.25', '湖南', 119, 12, 0, 1, 1, 0, 1, 1, NULL, 0, 1, 'Uploads/Shops/logo/2017-03-08/thumb_58c00c834f752.jpg', 55, 1488981123, 1495767758),
(15, '14828254901358206992', '树懒果园6个精选大果1-2kg', '3.40', '2.81', '江苏', 222, 23, 1, 1, 1, 1, 1, 1, NULL, 0, 1, 'Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg', 32, 1491530907, 1491530907),
(16, '14828254901321438936', '新鲜土鸡蛋', '1.82', '1.65', '湘西', 1230, 12, 1, 1, 0, 0, 1, 1, NULL, 0, 1, 'Uploads/Shops/logo/2017-04-07/thumb_58e6eac7c1f94.jpg', 123, 1491528391, 1491528391),
(17, '14828254901387957928', '咸鸭蛋', '1.21', '0.81', '广西桂林', 32, 12, 1, 0, 1, 1, 1, 1, NULL, 0, 1, 'Uploads/Shops/logo/2017-04-07/thumb_58e6ed4c93a95.jpg', 21, 1491530020, 1491530020),
(18, '14828254901369797085', '红富士苹果1', '2.34', '1.86', '山东', 344, 21, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 'Uploads/Shops/logo/2017-04-09/thumb_58e99b5942159.jpg', 0, 1493472805, 1493472805),
(22, '14828254901312864578', '特色牛肉', '45.00', '42.00', '内蒙古', 345, 12, 1, 1, 0, 0, 1, 1, NULL, 0, 1, 'Uploads/Shops/logo/2017-05-05/thumb_590c6c4310f13.jpg', 0, 1495766156, 1495766156);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_goodcomment`
--

CREATE TABLE IF NOT EXISTS `eshop_goodcomment` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT COMMENT '评论序列号',
  `goodId` bigint(20) NOT NULL COMMENT '商品序列号',
  `userId` int(250) NOT NULL COMMENT '买家序列号',
  `shopId` int(250) NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `orderId` bigint(100) NOT NULL COMMENT '订单ID',
  `goodScore` int(10) NOT NULL DEFAULT '0' COMMENT '商品评分',
  `logisticsScore` int(10) NOT NULL DEFAULT '0' COMMENT '物流评分',
  `serviceScore` int(10) NOT NULL COMMENT '客服服务评分',
  `contents` varchar(255) DEFAULT NULL COMMENT '评论内容',
  ` shopReply` text COMMENT '店家回复内容',
  `img` text COMMENT '评价图片',
  `time` int(10) DEFAULT NULL COMMENT '评论时间',
  `replyTime` int(10) NOT NULL DEFAULT '0' COMMENT '店家回复时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `goodId` (`goodId`),
  KEY `userId` (`userId`),
  KEY `shopId` (`shopId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品评论内容表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `eshop_goodcomment`
--

INSERT INTO `eshop_goodcomment` (`id`, `goodId`, `userId`, `shopId`, `orderId`, `goodScore`, `logisticsScore`, `serviceScore`, `contents`, ` shopReply`, `img`, `time`, `replyTime`, `is_show`) VALUES
(1, 10, 20, 3, 20, 10, 6, 8, '很好吃，下次还会关顾的。', NULL, NULL, 1493635303, 0, 1),
(2, 14, 20, 3, 11, 6, 6, 10, '树懒果园6个精选大果1-2kg', NULL, NULL, 1493637209, 0, 1),
(3, 15, 20, 3, 8, 8, 10, 8, '苹果很新鲜，也很好吃们还会再来的。', NULL, NULL, 1493645586, 0, 1),
(4, 17, 20, 3, 18, 6, 8, 10, '咸鸭蛋口感很好，吃起来特别香。', NULL, NULL, 1493645810, 0, 1),
(5, 14, 20, 3, 16, 8, 10, 10, '不vds不vsjksvdlsbjksns', NULL, NULL, 1493905980, 0, 1),
(6, 10, 20, 3, 5, 8, 10, 10, '能吃到数据库V打开时不仅使得V里', NULL, NULL, 1494156204, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_goodimg`
--

CREATE TABLE IF NOT EXISTS `eshop_goodimg` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT COMMENT '图片序列号',
  `goodId` bigint(20) NOT NULL COMMENT '商品序列号',
  `img` varchar(150) DEFAULT NULL COMMENT '对应图片地址',
  `thumb_img` varchar(150) NOT NULL COMMENT '对应缩略图地址',
  `createtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `goodId` (`goodId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品展示图片表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `eshop_goodimg`
--

INSERT INTO `eshop_goodimg` (`id`, `goodId`, `img`, `thumb_img`, `createtime`) VALUES
(5, 14, 'Uploads/Shops/goods/2017-03-08/58c00c749b99c.jpg', 'Uploads/Shops/goods/2017-03-08/thumb150_58c00c749b99c.jpg', 1488981123),
(6, 14, 'Uploads/Shops/goods/2017-03-08/58c00c74cb24f.jpg', 'Uploads/Shops/goods/2017-03-08/thumb150_58c00c74cb24f.jpg', 1488981123),
(7, 15, 'Uploads/Shops/goods/2017-03-12/58c4e37d5be26.jpg', 'Uploads/Shops/goods/2017-03-12/thumb150_58c4e37d5be26.jpg', 1489298303),
(8, 15, 'Uploads/Shops/goods/2017-03-12/58c4e37d690cb.jpg', 'Uploads/Shops/goods/2017-03-12/thumb150_58c4e37d690cb.jpg', 1489298303),
(9, 15, 'Uploads/Shops/goods/2017-03-12/58c4e37d75665.jpg', 'Uploads/Shops/goods/2017-03-12/thumb150_58c4e37d75665.jpg', 1489298303),
(10, 10, 'Uploads/Shops/goods/2017-03-31/58de453c19919.jpg', 'Uploads/Shops/goods/2017-03-31/thumb150_58de453c19919.jpg', 1490961727),
(11, 10, 'Uploads/Shops/goods/2017-03-31/58de453c311b8.jpg', 'Uploads/Shops/goods/2017-03-31/thumb150_58de453c311b8.jpg', 1490961727),
(12, 16, 'Uploads/Shops/goods/2017-04-07/58e6eac53c681.jpg', 'Uploads/Shops/goods/2017-04-07/thumb150_58e6eac53c681.jpg', 1491528392),
(15, 17, 'Uploads/Shops/goods/2017-04-07/58e6ef963c800.jpg', 'Uploads/Shops/goods/2017-04-07/thumb150_58e6ef963c800.jpg', 1491530020),
(16, 13, 'Uploads/Shops/goods/2017-04-08/58e87564cf4dc.jpg', 'Uploads/Shops/goods/2017-04-08/thumb150_58e87564cf4dc.jpg', 1491629418),
(17, 18, 'Uploads/Shops/goods/2017-04-09/58e99b5472c02.jpg', 'Uploads/Shops/goods/2017-04-09/thumb150_58e99b5472c02.jpg', 1491704665),
(18, 18, 'Uploads/Shops/goods/2017-04-09/58e99b549b510.jpg', 'Uploads/Shops/goods/2017-04-09/thumb150_58e99b549b510.jpg', 1491704665);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_goodinfo`
--

CREATE TABLE IF NOT EXISTS `eshop_goodinfo` (
  `id` bigint(150) NOT NULL AUTO_INCREMENT COMMENT '商品标签详情自增序列号',
  `goodId` bigint(20) NOT NULL COMMENT '商品序列号',
  `lableId` int(100) DEFAULT NULL COMMENT '标签序列号',
  `lableContent` varchar(150) DEFAULT NULL COMMENT '标签内容',
  `img` longtext COMMENT '商品图片',
  PRIMARY KEY (`id`),
  KEY `goodId` (`goodId`),
  KEY `lableId` (`lableId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品标签信息表' AUTO_INCREMENT=122 ;

--
-- 转存表中的数据 `eshop_goodinfo`
--

INSERT INTO `eshop_goodinfo` (`id`, `goodId`, `lableId`, `lableContent`, `img`) VALUES
(3, 13, 1, '12年', NULL),
(4, 13, 2, '密封，禁潮湿', NULL),
(5, 13, 3, '大玉米', NULL),
(6, 13, 4, '2017-03-01', NULL),
(7, 13, 5, '12', NULL),
(8, 13, 6, '冷藏', NULL),
(9, 13, 7, '0', NULL),
(10, 13, 8, '1', NULL),
(11, 13, 9, '包邮', NULL),
(12, 14, 1, '3公斤一个', NULL),
(13, 14, 2, '袋装', NULL),
(14, 14, 3, '红柚', NULL),
(15, 14, 4, '2017-03-06', NULL),
(16, 14, 5, '密封150天', NULL),
(17, 14, 6, '冷藏', NULL),
(18, 14, 7, '0', NULL),
(19, 14, 8, '1', NULL),
(20, 14, 9, '本地包邮', NULL),
(21, 15, 1, '0.5斤一个1', NULL),
(22, 15, 2, '袋装1', NULL),
(23, 15, 3, '蜜桃1', NULL),
(24, 15, 4, '2017-03-04', NULL),
(25, 15, 5, '冷藏下60天', NULL),
(26, 15, 6, '冷藏1', NULL),
(27, 15, 7, '0', NULL),
(28, 15, 8, '1', NULL),
(29, 15, 9, '免邮1', NULL),
(30, 10, NULL, '', NULL),
(31, 10, NULL, '', NULL),
(32, 10, NULL, '', NULL),
(33, 10, NULL, '', NULL),
(34, 10, NULL, '', NULL),
(35, 10, NULL, '', NULL),
(36, 10, NULL, '0', NULL),
(37, 10, NULL, '0', NULL),
(38, 10, NULL, '', NULL),
(39, 10, NULL, '', NULL),
(40, 10, NULL, '', NULL),
(41, 10, NULL, '', NULL),
(42, 10, NULL, '', NULL),
(43, 10, NULL, '', NULL),
(44, 10, NULL, '', NULL),
(45, 10, NULL, '0', NULL),
(46, 10, NULL, '0', NULL),
(47, 10, NULL, '', NULL),
(48, 10, NULL, '', NULL),
(49, 10, NULL, '', NULL),
(50, 10, NULL, '', NULL),
(51, 10, NULL, '', NULL),
(52, 10, NULL, '', NULL),
(53, 10, NULL, '', NULL),
(54, 10, NULL, '0', NULL),
(55, 10, NULL, '0', NULL),
(56, 10, NULL, '', NULL),
(57, 10, NULL, '', NULL),
(58, 10, NULL, '', NULL),
(59, 10, NULL, '', NULL),
(60, 10, NULL, '', NULL),
(61, 10, NULL, '', NULL),
(62, 10, NULL, '', NULL),
(63, 10, NULL, '0', NULL),
(64, 10, NULL, '0', NULL),
(65, 10, NULL, '', NULL),
(66, 16, 1, '0.3/个', NULL),
(67, 16, 2, '散装', NULL),
(68, 16, 3, '土鸡蛋', NULL),
(69, 16, 4, '2017-03-30', NULL),
(70, 16, 5, '常温保存30天', NULL),
(71, 16, 6, '常温', NULL),
(72, 16, 7, '1', NULL),
(73, 16, 8, '1', NULL),
(74, 16, 9, '免邮', NULL),
(75, 17, NULL, '', NULL),
(76, 17, NULL, '', NULL),
(77, 17, NULL, '', NULL),
(78, 17, NULL, '', NULL),
(79, 17, NULL, '', NULL),
(80, 17, NULL, '', NULL),
(81, 17, NULL, '0', NULL),
(82, 17, NULL, '0', NULL),
(83, 17, NULL, '', NULL),
(84, 17, NULL, '', NULL),
(85, 17, NULL, '', NULL),
(86, 17, NULL, '', NULL),
(87, 17, NULL, '', NULL),
(88, 17, NULL, '', NULL),
(89, 17, NULL, '', NULL),
(90, 17, NULL, '0', NULL),
(91, 17, NULL, '0', NULL),
(92, 17, NULL, '', NULL),
(102, 17, NULL, '', NULL),
(103, 17, NULL, '', NULL),
(104, 17, NULL, '', NULL),
(105, 17, NULL, '', NULL),
(106, 17, NULL, '', NULL),
(107, 17, NULL, '', NULL),
(108, 17, NULL, '0', NULL),
(109, 17, NULL, '0', NULL),
(110, 17, NULL, '', NULL),
(111, 18, 1, '0.5kg/个', NULL),
(112, 18, 2, '袋装', NULL),
(113, 18, 3, '红富士', NULL),
(114, 18, 4, '2017-04-02', NULL),
(115, 18, 5, '3个月', NULL),
(116, 18, 6, '常温或冷藏', NULL),
(117, 18, 7, '1', NULL),
(118, 18, 8, '1', NULL),
(119, 18, 9, '免邮', NULL),
(120, 22, 7, '1', NULL),
(121, 22, 8, '1', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_goodlable`
--

CREATE TABLE IF NOT EXISTS `eshop_goodlable` (
  `lableId` int(100) NOT NULL AUTO_INCREMENT COMMENT '商品详情标签序列号',
  `name` varchar(150) NOT NULL COMMENT '商品详情标签名称',
  `addid` int(11) NOT NULL COMMENT '添加者序列号',
  `type` int(2) NOT NULL DEFAULT '0' COMMENT '添加者身份0管理员1商家',
  `createtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`lableId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品详情标签表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `eshop_goodlable`
--

INSERT INTO `eshop_goodlable` (`lableId`, `name`, `addid`, `type`, `createtime`) VALUES
(1, '净含量', 13, 0, 0),
(2, '包装方式', 13, 0, 0),
(3, '品牌', 13, 0, 0),
(4, '出产日期', 13, 1, 0),
(5, '保质期', 13, 1, 0),
(6, '储藏方式', 13, 1, 0),
(7, '是否合格', 13, 0, 0),
(8, '是否绿色食品', 13, 0, 0),
(9, '寄送方式', 13, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_goodnav`
--

CREATE TABLE IF NOT EXISTS `eshop_goodnav` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT COMMENT '商品标签序列号 ',
  `goodId` bigint(20) NOT NULL COMMENT '商品序列号',
  `shopId` int(250) NOT NULL COMMENT '店铺序列号 ',
  `w_fid` int(150) NOT NULL COMMENT '全网一级菜单号 ',
  `w_sid` int(150) DEFAULT NULL COMMENT '全网二级菜单号 ',
  `w_tid` int(150) DEFAULT NULL COMMENT '全网三级菜单号 ',
  `s_fid` int(250) NOT NULL COMMENT '店铺一级菜单导航号 ',
  `s_sid` int(250) DEFAULT NULL COMMENT '店铺二级菜单导航号 ',
  `createtime` int(10) DEFAULT NULL COMMENT '添加时间 ',
  `modify_time` int(10) DEFAULT NULL COMMENT '修改时间 ',
  PRIMARY KEY (`id`),
  KEY `shopId` (`shopId`),
  KEY `w_fid` (`w_fid`),
  KEY `w_sid` (`w_sid`),
  KEY `w_tid` (`w_tid`),
  KEY `s_fid` (`s_fid`),
  KEY `s_sid` (`s_sid`),
  KEY `goodId` (`goodId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品导航标签表 ' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `eshop_goodnav`
--

INSERT INTO `eshop_goodnav` (`id`, `goodId`, `shopId`, `w_fid`, `w_sid`, `w_tid`, `s_fid`, `s_sid`, `createtime`, `modify_time`) VALUES
(3, 13, 2, 1, 1, 1, 1, 1, 1488505890, 1491629418),
(6, 10, 3, 2, 1, 1, 1, 2, 1488505893, 1490961727),
(7, 14, 3, 1, 1, 1, 5, 13, 1488981123, 1488981123),
(8, 15, 3, 2, 3, 0, 5, 17, 1489298303, 1491530907),
(9, 16, 3, 3, 7, 10, 5, 1, 1491528392, 1491528392),
(11, 17, 3, 3, 7, 10, 5, 2, 1491528343, 1491530020),
(12, 18, 3, 2, 3, 4, 5, 13, 1491704665, 1493472805),
(16, 22, 3, 7, 17, 0, 1, 1, 1493986371, 1495766156);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_goodservice`
--

CREATE TABLE IF NOT EXISTS `eshop_goodservice` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT COMMENT '专享服务序列号',
  `goodId` bigint(20) NOT NULL COMMENT '对应商品序列号',
  `content` text COMMENT '商品专享服务内容',
  `createtime` int(10) DEFAULT NULL COMMENT '发表时间',
  `modify_time` int(10) DEFAULT NULL COMMENT '修改时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `goodId` (`goodId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品专享服务表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `eshop_goodservice`
--

INSERT INTO `eshop_goodservice` (`id`, `goodId`, `content`, `createtime`, `modify_time`, `is_show`) VALUES
(3, 10, '', 1484467617, 1490961727, 1),
(4, 13, '&lt;p&gt;玉米很好吃，营养丰富，无公害，假一罚十。&lt;br/&gt;&lt;/p&gt;', 1488505890, 1491629418, 1),
(5, 14, '&lt;p&gt;红柚有营养好吃，对身体有好处，尤其是老人，小孩。&lt;br/&gt;&lt;/p&gt;', 1488981123, NULL, 1),
(6, 15, '&lt;p&gt;水蜜桃很甜，可口，多吃对身体有好处。&lt;br/&gt;&lt;/p&gt;', 1489298303, 1491530907, 1),
(7, 16, '&lt;p&gt;土鸡蛋（英文名称：native egg）人们通常把在农家&lt;a target=&quot;_blank&quot; href=&quot;http://baike.baidu.com/item/%E8%87%AA%E7%84%B6%E7%8E%AF%E5%A2%83&quot;&gt;自然环境&lt;/a&gt;中的散养鸡所生的蛋称为&lt;a target=&quot;_blank&quot; href=&quot;http://baike.baidu.com/item/%E5%9C%9F%E9%B8%A1%E8%9B%8B&quot;&gt;土鸡蛋&lt;/a&gt;，或称为柴鸡蛋；&lt;a target=&quot;_blank&quot; href=&quot;http://baike.baidu.com/item/%E7%AC%A8%E9%B8%A1%E8%9B%8B&quot;&gt;笨鸡蛋&lt;/a&gt;。农业部关于鸡蛋的标准只有无公害鸡蛋标准、绿色鸡蛋标准和&lt;a target=&quot;_blank&quot; href=&quot;http://baike.baidu.com/item/%E6%9C%89%E6%9C%BA%E9%B8%A1%E8%9B%8B&quot;&gt;有机鸡蛋&lt;/a&gt;标准，并无确切的土鸡蛋标准 。其实，在普通老百姓的眼中的土鸡蛋就应该定义为：农民家散养，吃五谷杂粮且白天自由觅食，鸡不受外力因素自然成长，鸡放养过程中没有使用任何药物。&lt;/p&gt;', 1491528392, 1491528392, 1),
(8, 17, '', NULL, 1491530020, 1),
(9, 18, '&lt;p&gt;苹果好吃，香甜可口。&lt;br/&gt;&lt;/p&gt;', 1491704665, 1493472805, 1),
(10, 22, '', 1493986371, 1495766156, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_information`
--

CREATE TABLE IF NOT EXISTS `eshop_information` (
  `id` int(100) NOT NULL AUTO_INCREMENT COMMENT '设置主键自增',
  `title` varchar(150) NOT NULL COMMENT '消息标题',
  `content` text COMMENT '消息内容',
  `type` int(10) NOT NULL DEFAULT '3' COMMENT '消息的类型，默认为3表示公告，1表示资讯，2表示优惠活动',
  `publisherId` varchar(25) DEFAULT NULL COMMENT '发布时者Id',
  `publisherName` varchar(100) NOT NULL COMMENT '发布者的名称',
  `publishType` int(11) DEFAULT '0' COMMENT '发布者的类型默认为0表示管理员，1表示商家',
  `publish_time` int(10) DEFAULT NULL COMMENT '发布时间',
  `modify_time` int(10) DEFAULT NULL COMMENT '最近一次修改时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='网站信息表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `eshop_information`
--

INSERT INTO `eshop_information` (`id`, `title`, `content`, `type`, `publisherId`, `publisherName`, `publishType`, `publish_time`, `modify_time`, `is_show`) VALUES
(1, 'eshop正式上线通知', '&lt;p&gt;&amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;						&lt;/p&gt;', 1, '13', 'shoper3', 1, 1490928051, 1497144701, 1),
(2, 'eshop更新通知', '&lt;p&gt;一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人，很多心绪与情绪，都是随着时间堆砌而成，只因在时光的磨合中成长了，却也多愁善感了，因为在一段段旅途中，体验了世间冷暖，聚散分离。一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人，很多心绪与情绪，都是随着时间堆砌而成，只因在时光的磨合中成长了，却也多愁善感了，因为在一段段旅途中，体验了世间冷暖，聚散分离。&lt;/p&gt;&lt;p&gt;一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人，很多心绪与情绪，都是随着时间堆砌而成，只因在时光的磨合中成长了，却也多愁善感了，因为在一段段旅途中，体验了世间冷暖，聚散分离。&lt;/p&gt;&lt;p&gt;一个人总要走陌生的路，欣赏的陌生的风景，相遇陌生的人，很多心绪与情绪，都是随着时间堆砌而成，只因在时光的磨合中成长了，却也多愁善感了，因为在一段段旅途中，体验了世间冷暖，聚散分离。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 2, '13', 'shoper3', 1, 1490706889, 1490706889, 1),
(3, 'eshop系统上线运营通知11', '&lt;p style=&quot;text-indent:24.0pt;&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;我校资产管理系统自&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;3&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;月&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;15&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;日试运行测试以来，经过&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;2&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;个多月的测试运行，期间对系统各模块功能与流程进行了全面的测试与优化，目前系统已达到正式运行条件。&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-indent:24.0pt;&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;为充分发挥资产管理系统高效快捷的功能，方便各位老师申购设备、报销经费及资产的日常管理，实现我校资产管理信息化，提高日常管理工作的运作效率，现决定该系统于&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;2015&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;年&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;6&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;月&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;1&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;日正式上线运行。现将有关事宜通知如下：&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-left:0cm;&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;一、&lt;span style=&quot;font-size:7pt;line-height:normal;font-family:&amp;#39;Times New Roman&amp;#39;;&quot;&gt;&amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;系统登录：登录校园网个人门户，在应用系统入口中点击“资产管理系统”即可跳转到资产管理系统中。&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-left:0cm;&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;二、&lt;span style=&quot;font-size:7pt;line-height:normal;font-family:&amp;#39;Times New Roman&amp;#39;;&quot;&gt;&amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;系统包括“设备申购”、“验收入库”、“日常管理”等多个模块，各模块的操作流程可在系统的“通知公告列表”的文件下载区中下载查看。&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-left:0cm;&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;三、&lt;span style=&quot;font-size:7pt;line-height:normal;font-family:&amp;#39;Times New Roman&amp;#39;;&quot;&gt;&amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;系统正式运行后，设备申购、领用、资产入帐、查询、变更、调拨等功能均在系统中进行提交和申请等各项操作。&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-left:0cm;&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;四、&lt;span style=&quot;font-size:7pt;line-height:normal;font-family:&amp;#39;Times New Roman&amp;#39;;&quot;&gt;&amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;设备申购、经费报销都需要经费主管事先将经费导入到系统中，否则后续无法进行。全校所有固定资产或低值材料的购买，必须先通过资产管理系统的设备申购流程，由资产处安排采购或自购。&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-left:0cm;&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;五、&lt;span style=&quot;font-size:7pt;line-height:normal;font-family:&amp;#39;Times New Roman&amp;#39;;&quot;&gt;&amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;报销须知：系统正式上线后，申请人须填好支出报销凭证（附发票原件）、由经费主管签字后，带上合同复印件（若有合同，无合同则不需要）到资产处审核，打印入库单（或直发单）。从&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;2015&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;年&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;6&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;月&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;1&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;日开始财务处凭资产处&lt;strong&gt;打印件&lt;/strong&gt;报销，原有手写入库单（或直发单）不再使用。单据具体生成流程，可查阅文件下载区中申购流程。&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-left:0cm;&quot;&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;&quot;&gt;六、&lt;span style=&quot;font-size:7pt;line-height:normal;font-family:&amp;#39;Times New Roman&amp;#39;;&quot;&gt;&amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;line-height:150%;font-family:宋体;&quot;&gt;系统在运行过程中各种不便在所难免，敬请各位教职工谅解。如对资产管理系统有任何意见、建议和要求，可向资产处提出，以期不断完善改进。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;						&lt;/p&gt;', 3, '1', 'admin', 0, 1497143628, 1497143628, 1),
(4, '电子商务培训通知', '&lt;p style=&quot;text-indent: 2em;&quot;&gt;为了进一步推进永靖县电子商务产业的发展，营造发展电子商务的良好社会氛围，根据《临夏回族自治州人民政府办公室关于批转临夏州大众创业万众创新培训方案的通知》精神，现将有关事宜通知如下：&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;一、培训对象&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;全县各乡（镇）、村电商服务体系从业人员，大学生村官、未就业大学生和贫困村在校大学生以及致富能人、驻村工作队队员、电商扶贫专干、扶贫对象、所有电子商务相关企业代表、个人网店店主、有意向应用电商的企业代表和有意从事电商的未就业大学生及有志青年。&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;二、培训时间及地点&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;每期培训40人，每期培训5天，共培训2期；&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;第一期2016年5月30日-6月3日；&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;第二期2016年6月6日-6月10日；&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;培训地点：临夏市职教中心。&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;三、培训费用&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;学员全部实行免费培训，免费提供食宿。&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;四、报名地点&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;永靖县古城新区统办大楼309室&lt;/p&gt;&lt;p style=&quot;text-indent: 2em;&quot;&gt;联系电话：0930-8837223&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 3, '1', 'admin', 0, 1497146221, 1497146428, 1),
(5, '2017年端午节放假通知', '&lt;p&gt;\r\n	&lt;span style=&quot;line-height:1.5;&quot;&gt;尊敬的客户：&lt;/span&gt; &lt;/p&gt;&lt;p&gt;\r\n	&amp;nbsp; &amp;nbsp; &amp;nbsp; 您好！根据国家节假日放假规定并结合我司实际情况，2017年端午节我司放假安排如下：&lt;/p&gt;&lt;p&gt;\r\n	&amp;nbsp;&lt;strong&gt; &amp;nbsp; &amp;nbsp; 一、放假时间安排&lt;/strong&gt;：&lt;/p&gt;&lt;p&gt;\r\n	&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;strong&gt;&lt;span style=&quot;color:#E53333;&quot;&gt;5月30号（星斯二）我司全体员工放假一天&lt;/span&gt;&lt;/strong&gt;，放假期间无人值班收货；&lt;strong&gt;&lt;span style=&quot;color:#E53333;&quot;&gt;31号（星期三）&lt;/span&gt;&lt;/strong&gt;&lt;strong&gt;&lt;span style=&quot;color:#E53333;&quot;&gt;恢复正常上班&lt;/span&gt;&lt;/strong&gt;。&lt;/p&gt;&lt;p&gt;\r\n	&amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;strong&gt; 二、收货及出货须知：&lt;/strong&gt; &lt;/p&gt;&lt;p&gt;\r\n	&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;截单后收到的货物，顺延至5月31号出货。&lt;/p&gt;&lt;p&gt;\r\n	&lt;br/&gt;&lt;/p&gt;&lt;p&gt;\r\n	&lt;strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 温馨提醒：&lt;/strong&gt; &lt;/p&gt;&lt;p&gt;\r\n	&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;因端午假期原因，货物上网或中转会有延误，端午假期期间我司无人值班，请客户自行跟进国际快递件，如有货物在假期期间退回，所产生的费用需要客户自行承担，谢谢理解！&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 3, '1', 'admin', 0, 1493114169, 1497146569, 1),
(6, 'eshop正式上线更名为微农', '&lt;p style=&quot;background: rgb(255, 255, 255) none repeat scroll 0% 0%; line-height: 2em;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0);&quot;&gt;&lt;span style=&quot;line-height: 200%; letter-spacing: 0px; font-weight: normal; font-style: normal; font-size: 14px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; color: rgb(0, 0, 0); font-family: 微软雅黑;&quot;&gt;各投资机构、投资人&lt;/span&gt;&lt;span style=&quot;line-height: 200%; font-size: 14px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; color: rgb(0, 0, 0); font-family: 微软雅黑;&quot;&gt;：&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 0px; text-indent: 32px; padding: 0px; line-height: 2em;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 14px;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑;&quot;&gt;经过前期大量的准备工作，华艺电商平台新系统上线业已就绪，经本公司研究，现定于&lt;/span&gt;4月15日（星期六）休市一天，进行系统升级。升级完成后，华艺电商平台新系统将于4月17日正式上线，&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑;&quot;&gt;现将相关事宜告知如下：&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 0px; text-indent: 32px; padding: 0px; line-height: 2em;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 14px;&quot;&gt;一、4月16日（星期日）为正常休市日，4月17日（星期一）正常开市；&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 0px; text-indent: 32px; padding: 0px; line-height: 2em;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 14px;&quot;&gt;二、&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑;&quot;&gt;休市期间，本公司系统暂停交易及办理出入金业务；&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 0px; text-indent: 32px; padding: 0px; line-height: 2em;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 14px;&quot;&gt;三、&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑;&quot;&gt;从&lt;/span&gt;4月17日起，原客户端系统所有商品将采用华艺电商平台新系统交易模式，新的系统采取现货实物挂牌方式进行实名自主协商交易，原有交易方式将不再继续使用；升级期间，投资人持仓及资金不受影响；&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 0px; text-indent: 32px; padding: 0px; line-height: 2em;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 14px;&quot;&gt;四、&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑;&quot;&gt;华艺电商平台新系统与华艺商城直连，所有用户均可使用平台账号登录华艺商城，使用身份证号码激活商城账号，账号激活后能够使用在平台获得的采购专款，进行自由消费；&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 0px; text-indent: 32px; padding: 0px; line-height: 2em;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 14px;&quot;&gt;五、&lt;span style=&quot;color: rgb(0, 0, 0); font-family: 微软雅黑;&quot;&gt;本公司电商平台新系统上线后，平台交易时间将统一调整为周一至周五：上午&lt;/span&gt;9:30-11:30，下午13:30-15:30；周六、周日正常休市。平台入金时间为周一至周五9:00-16:00；平台出金时间为周一至周五9:30-15:30。用户可每日24小时提交开户申请，平台将于工作时间内进行审核。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 0px; text-indent: 28px; padding: 0px; line-height: 2em;&quot;&gt;&lt;span style=&quot;font-family: 微软雅黑; font-size: 14px; color: rgb(0, 0, 0);&quot;&gt;以上事项特此公告，如有任何疑问可致电400-0730-929进行咨询。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 3, '1', 'admin', 0, 1497146946, 1497146946, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_messages`
--

CREATE TABLE IF NOT EXISTS `eshop_messages` (
  `id` bigint(250) NOT NULL AUTO_INCREMENT COMMENT '订单信息ID序列号',
  `sendId` int(250) NOT NULL DEFAULT '0' COMMENT '信息发送者ID',
  `receiveId` int(250) NOT NULL DEFAULT '0' COMMENT '信息接收者ID',
  `receiveType` tinyint(4) NOT NULL DEFAULT '1' COMMENT '信息接收者类型：1商家，2用户，3，管理员',
  `content` text NOT NULL COMMENT '信息内容',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '信息状态0表示未读，1表示已读',
  `sendTime` int(10) NOT NULL COMMENT '信息发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='通知信息' AUTO_INCREMENT=59 ;

--
-- 转存表中的数据 `eshop_messages`
--

INSERT INTO `eshop_messages` (`id`, `sendId`, `receiveId`, `receiveType`, `content`, `status`, `sendTime`) VALUES
(2, 20, 2, 1, '您有一笔新的订单[3]待处理，请尽快处理！', 0, 1493180146),
(8, 20, 3, 1, '您有一笔新的订单[1493210883152030684942]待处理，请尽快处理！', 1, 1493210883),
(11, 20, 3, 1, '您有一笔新的订单[1493253003142097115366]待处理，请尽快处理！', 1, 1493253004),
(12, 20, 2, 1, '您有一笔新的订单[1493253004132065809568]待处理，请尽快处理！', 0, 1493253004),
(16, 20, 3, 1, '您有一笔新的订单[1493343942162059121735]待处理，请尽快处理！', 1, 1493343942),
(18, 13, 20, 2, '您的订单[1493254121172093187044]商家已经发货了，等待查收！', 1, 1493466061),
(25, 20, 3, 1, '订单[1493254121172093187044]已被用户取消！', 0, 1493604626),
(27, 20, 3, 1, '订单[1493343839102072509323]用户已经确认收货！', 0, 1493608219),
(28, 20, 2, 1, '订单[1493253004132065809568]已被用户取消！', 0, 1493632751),
(34, 20, 2, 1, '订单[1493180146132012676961]已被用户取消！', 0, 1493640410),
(37, 13, 20, 2, '您的订单[1493210883152012149019]商家已经发货了，等待查收！', 1, 1493791797),
(38, 13, 20, 2, '您的订单[1493179784132093523730]商家已经发货了，等待查收！', 1, 1493791822),
(39, 13, 20, 2, '您的订单[1493207633102068361499]商家已经发货了，等待查收！', 1, 1493791860),
(40, 13, 20, 2, '您的订单[1493207286152084678642]商家已经发货了，等待查收！', 1, 1493791999),
(43, 20, 3, 1, '您的订单[1493210883152012149019]已被用户[admin]投诉！', 1, 1493816858),
(44, 20, 3, 1, '您有一笔新的订单[1493906264152017502766]待处理，请尽快处理！', 0, 1493906264),
(45, 20, 3, 1, '订单[1493207633102068361499]用户已经确认收货！', 0, 1494156170),
(46, 20, 3, 1, '您有一笔新的订单[1494156301102070445465]待处理，请尽快处理！', 0, 1494156301),
(47, 20, 3, 1, '您有一笔新的订单[1494156341182044842815]待处理，请尽快处理！', 0, 1494156342),
(48, 20, 3, 1, '您有一笔新的订单[1494156342152088535093]待处理，请尽快处理！', 0, 1494156342),
(49, 20, 3, 1, '您有一笔新的订单[1494156342102052885814]待处理，请尽快处理！', 0, 1494156342),
(50, 13, 20, 2, '您的订单[1494156342152088535093]商家已经发货了，等待查收！', 1, 1494156432),
(51, 20, 3, 1, '您有一笔新的订单[1494636005152096907433]待处理，请尽快处理！', 0, 1494636006),
(52, 20, 3, 1, '订单[1493207286152084678642]用户已经确认收货！', 0, 1494636255),
(53, 20, 3, 1, '您的订单[1493210883152012149019]用户[admin]已经取消了投诉！', 0, 1495075411),
(54, 20, 3, 1, '您有一笔新的订单[1495593164162025707139]待处理，请尽快处理！', 0, 1495593165),
(55, 20, 3, 1, '您有一笔新的订单[1495761279152098903263]待处理，请尽快处理！', 0, 1495761279),
(56, 20, 3, 1, '您有一笔新的订单[1495761311152067528266]待处理，请尽快处理！', 0, 1495761311),
(57, 20, 3, 1, '您有一笔新的订单[1495761793172066854312]待处理，请尽快处理！', 0, 1495761793),
(58, 20, 3, 1, '您有一笔新的订单[1495762299162052116514]待处理，请尽快处理！', 0, 1495762299);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_order`
--

CREATE TABLE IF NOT EXISTS `eshop_order` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT COMMENT '订单序列号',
  `orderNum` varchar(255) NOT NULL COMMENT '订单单号',
  `shopId` int(250) NOT NULL COMMENT '店铺序列号',
  `userId` int(250) NOT NULL COMMENT '用户序列号',
  `userName` varchar(100) DEFAULT NULL COMMENT '收货人姓名',
  `userAddr` varchar(250) NOT NULL COMMENT '收货地址',
  `userTel` varchar(20) NOT NULL COMMENT '收货人联系方式',
  `goodsMoney` decimal(11,2) DEFAULT '0.00' COMMENT '商品总金额',
  `Message` varchar(250) DEFAULT NULL COMMENT '订单留言',
  `deliverType` int(2) DEFAULT '0' COMMENT '运费类型',
  `deliverMoney` decimal(11,2) DEFAULT '0.00' COMMENT '运费金额',
  `totalMoney` decimal(11,2) DEFAULT '0.00' COMMENT '总金额',
  `is_pay` int(2) DEFAULT '0' COMMENT '是否支付',
  `payType` tinyint(4) NOT NULL DEFAULT '1' COMMENT '支付的类型默认为1表示支付宝支付，2表示微信支付，3表示银联支付，4表示其它支付',
  `is_deliver` int(2) DEFAULT '0' COMMENT '是否发货',
  `expressName` varchar(50) DEFAULT NULL COMMENT '快递公司名称',
  `expressNumber` varchar(50) DEFAULT NULL COMMENT '快递单号',
  `deliverTime` int(10) NOT NULL DEFAULT '0' COMMENT '发货时间',
  `is_confirm` int(2) DEFAULT '0' COMMENT '是否确认收货',
  `confirmTime` int(10) NOT NULL DEFAULT '0' COMMENT '收货时间',
  `is_recommend` int(2) DEFAULT '0' COMMENT '是否评价',
  `is_cancel` int(2) DEFAULT '0' COMMENT '是否取消订单',
  `cancelTime` int(10) NOT NULL DEFAULT '0' COMMENT '订单取消时间',
  `is_reject` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否拒收',
  `rejectReason` tinyint(10) NOT NULL DEFAULT '0' COMMENT '拒收原因',
  `cancleReason` int(10) DEFAULT '0' COMMENT '订单取消而定原因',
  `rejectTime` int(10) NOT NULL DEFAULT '0' COMMENT '拒收时间',
  `is_complaint` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否被投诉',
  `create_time` int(10) DEFAULT NULL COMMENT '订单生成时间',
  `complete_time` int(10) DEFAULT NULL COMMENT '订单完成时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `orderNum` (`orderNum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单内容表' AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `eshop_order`
--

INSERT INTO `eshop_order` (`id`, `orderNum`, `shopId`, `userId`, `userName`, `userAddr`, `userTel`, `goodsMoney`, `Message`, `deliverType`, `deliverMoney`, `totalMoney`, `is_pay`, `payType`, `is_deliver`, `expressName`, `expressNumber`, `deliverTime`, `is_confirm`, `confirmTime`, `is_recommend`, `is_cancel`, `cancelTime`, `is_reject`, `rejectReason`, `cancleReason`, `rejectTime`, `is_complaint`, `create_time`, `complete_time`) VALUES
(1, '1493179784132093523730', 3, 20, '李黎明', '北京市北京市市辖区东城区铁西区', ' 	13437826498', '2.50', NULL, 0, '0.00', '2.50', 1, 1, 1, '邮政快递', '123456789012', 1493791822, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1493178703, NULL),
(3, '1493180146132012676961', 2, 20, NULL, '', '', '1.20', NULL, 0, '0.00', '1.20', 0, 1, 0, '0', '0', 0, 0, 0, 0, 1, 1493640410, 0, 0, 3, 0, 0, 1493180146, NULL),
(4, '1493207286152084678642', 3, 20, NULL, '', '', '2.81', NULL, 0, '0.00', '2.81', 1, 1, 1, '菜鸟快递', '678912345602', 1493791999, 1, 1494636255, 0, 0, 0, 0, 0, 0, 0, 0, 1493207286, NULL),
(5, '1493207633102068361499', 3, 20, NULL, '', '', '2.00', NULL, 0, '0.00', '2.00', 1, 2, 1, '圆通快递', '987654321240', 1493791860, 1, 1494156170, 1, 0, 0, 0, 0, 0, 0, 0, 1493207633, NULL),
(6, '1493209470162031271510', 3, 20, NULL, '', '', '1.65', NULL, 0, '0.00', '1.65', 1, 1, 0, '0', '0', 0, 0, 0, 0, 1, 1493645936, 0, 0, 3, 0, 0, 1493209470, NULL),
(8, '1493210016152032961524', 3, 20, '刘梧州', ' 	浙江省宁波市北仑区', '13437826498', '2.81', NULL, 0, '0.00', '2.81', 1, 2, 1, '0', '0', 0, 1, 1493608165, 1, 0, 0, 0, 0, 0, 0, 0, 1493210016, NULL),
(9, '1493210883152012149019', 3, 20, NULL, '', '', '2.81', NULL, 0, '0.00', '2.81', 0, 1, 0, '顺丰快递', '123498712323', 1493791797, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1493210883, NULL),
(10, '1493210956142069781487', 3, 20, '晓红', '    浙江省宁波市北仑区', '18904010296', '1.25', NULL, 0, '0.00', '1.25', 1, 3, 0, '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1493210956, NULL),
(12, '1493211352152070879335', 3, 20, NULL, '', '', '2.81', NULL, 0, '0.00', '2.81', 1, 3, 1, '圆通快递', '653475642134', 1493467149, 0, 0, 0, 0, 0, 1, 1, 0, 1493695478, 0, 1493211352, NULL),
(13, '1493211353152080214581', 3, 20, NULL, '', '', '2.81', NULL, 0, '0.00', '2.81', 0, 3, 0, '顺丰快递', '123498765123', 1493465936, 0, 0, 0, 1, 1493604049, 0, 0, 3, 0, 0, 1493211353, NULL),
(16, '1493253003142097115366', 3, 20, '晓红', '浙江省宁波市北仑区兴工街21号', '18904010296', '1.25', NULL, 0, '0.00', '1.25', 1, 1, 1, '0', '0', 0, 1, 1493639757, 1, 0, 0, 0, 0, 0, 0, 0, 1493253003, NULL),
(18, '1493254121172093187044', 3, 20, NULL, '', '', '0.81', NULL, 0, '0.00', '0.81', 1, 1, 1, '圆通快递', '123498712323', 1493466061, 1, 1493640205, 1, 0, 1493604626, 0, 0, 3, 0, 0, 1493254121, NULL),
(20, '1493343839102072509323', 3, 20, '晓红', '浙江省宁波市北仑区兴工街21号', '13437826498', '1.00', NULL, 0, '0.00', '1.00', 1, 1, 1, '申通快递', '122222222222', 1493552959, 1, 1493640545, 1, 0, 0, 0, 0, 0, 0, 0, 1493343839, NULL),
(21, '1493343942102022155539', 3, 20, '李黎明', '北京市北京市市辖区东城区铁西区', '13437826498', '1.00', NULL, 0, '0.00', '1.00', 0, 1, 0, '0', '0', 0, 0, 0, 0, 1, 1493603953, 0, 0, 1, 0, 0, 1493343942, NULL),
(22, '1493906264152017502766', 3, 20, '刘梧州', '山西省太原市万柏林区太原街道', '14323459832', '2.81', NULL, 0, '0.00', '2.81', 1, 1, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1493906264, NULL),
(23, '1494156301102070445465', 3, 20, '晓红', '浙江省宁波市北仑区兴工街21号', '13437826498', '1.00', NULL, 0, '0.00', '1.00', 1, 2, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1494156301, NULL),
(24, '1494156341182044842815', 3, 20, '刘梧州', '山西省太原市万柏林区太原街道', '14323459832', '1.86', NULL, 0, '0.00', '1.86', 0, 1, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1494156341, NULL),
(25, '1494156342152088535093', 3, 20, '刘梧州', '山西省太原市万柏林区太原街道', '14323459832', '2.81', NULL, 0, '0.00', '2.81', 1, 1, 0, '韵达快递', '122222222222', 1494156432, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1494156342, NULL),
(26, '1494156342102052885814', 3, 20, '刘梧州', '山西省太原市万柏林区太原街道', '14323459832', '1.00', NULL, 0, '0.00', '1.00', 0, 1, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1494156342, NULL),
(27, '1494636005152096907433', 3, 20, '李黎明', '北京市北京市市辖区东城区铁西区', '13437826498', '2.81', NULL, 0, '0.00', '2.81', 0, 2, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1494636005, NULL),
(28, '1495593164162025707139', 3, 20, '李黎明', '北京市北京市市辖区东城区铁西区', '13437826498', '3.30', NULL, 0, '0.00', '3.30', 0, 1, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1495593164, NULL),
(29, '1495761279152098903263', 3, 20, '李黎明', '北京市北京市市辖区东城区铁西区', '13437826498', '5.62', NULL, 0, '0.00', '5.62', 1, 1, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1495761279, NULL),
(30, '1495761311152067528266', 3, 20, '李黎明', '北京市北京市市辖区东城区铁西区', '13437826498', '2.81', NULL, 0, '0.00', '2.81', 0, 1, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1495761311, NULL),
(31, '1495761793172066854312', 3, 20, '李黎明', '北京市北京市市辖区东城区铁西区', '13437826498', '0.81', NULL, 0, '0.00', '0.81', 1, 1, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1495761793, NULL),
(32, '1495762299162052116514', 3, 20, '李黎明', '北京市北京市市辖区东城区铁西区', '13437826498', '1.65', NULL, 0, '0.00', '1.65', 1, 1, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1495762299, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_order_complaint`
--

CREATE TABLE IF NOT EXISTS `eshop_order_complaint` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT COMMENT '投诉序列号',
  `orderId` bigint(255) NOT NULL COMMENT '投诉订单序列号',
  `userId` int(250) NOT NULL COMMENT '投诉用户序列号',
  `shopId` int(250) NOT NULL COMMENT '被投诉店铺序列号',
  `complainType` int(10) NOT NULL COMMENT '投诉的类型',
  `reason` text COMMENT '投诉原因',
  `img` text NOT NULL COMMENT '投诉上传的附件URL',
  `time` int(10) DEFAULT NULL COMMENT '投诉时间',
  `is_cancle` int(2) DEFAULT '0' COMMENT '是否取消投诉',
  `cancleTime` int(10) DEFAULT NULL COMMENT '取消投诉的时间',
  `is_deal` int(2) DEFAULT '0' COMMENT '网站客服是否受理',
  `dealTime` int(10) DEFAULT NULL COMMENT '投诉受理的时间',
  `dealContent` varchar(255) DEFAULT NULL COMMENT '受理结果',
  `is_complete` int(2) DEFAULT '0' COMMENT '是否解决问题',
  `result` varchar(255) DEFAULT NULL COMMENT '最终结果',
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`),
  KEY `userId` (`userId`),
  KEY `shopId` (`shopId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单投诉信息表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `eshop_order_complaint`
--

INSERT INTO `eshop_order_complaint` (`id`, `orderId`, `userId`, `shopId`, `complainType`, `reason`, `img`, `time`, `is_cancle`, `cancleTime`, `is_deal`, `dealTime`, `dealContent`, `is_complete`, `result`) VALUES
(3, 9, 20, 3, 3, '成绩考的是茶几上客户超时空', '', 1493816858, 1, 1495075410, 0, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_order_goods`
--

CREATE TABLE IF NOT EXISTS `eshop_order_goods` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT COMMENT '订单序列号',
  `orderId` bigint(255) NOT NULL COMMENT '订单单号',
  `goodId` bigint(20) NOT NULL COMMENT '商品序列号',
  `goodNumber` varchar(50) NOT NULL COMMENT '商品编号',
  `goodNum` int(50) NOT NULL COMMENT '商品数量',
  `goodPrice` decimal(12,2) NOT NULL COMMENT '商品单价',
  `goodName` varchar(250) NOT NULL COMMENT '商品名称',
  `goodImg` varchar(150) DEFAULT NULL COMMENT '商品图片',
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`),
  KEY `goodId` (`goodId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单商品信息表' AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `eshop_order_goods`
--

INSERT INTO `eshop_order_goods` (`id`, `orderId`, `goodId`, `goodNumber`, `goodNum`, `goodPrice`, `goodName`, `goodImg`) VALUES
(1, 1, 14, '14828254901346173251', 2, '1.25', '湖南红柚', '/eshop/Uploads/Shops/logo/2017-03-08/thumb_58c00c834f752.jpg'),
(2, 3, 13, '14828254901339183177', 1, '1.20', '玉米', '/eshop/Uploads/Shops/logo/2017-04-08/thumb_58e8756a1e8b5.jpg'),
(3, 4, 15, '14828254901358206992', 1, '2.81', '树懒果园6个精选大果1-2kg', '/eshop/Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg'),
(4, 5, 10, '14828254901325292459', 2, '1.00', '进口大鸭梨1', '/eshop/Uploads/Shops/logo/2017-03-28/thumb_58da4a8b69ad4.jpg'),
(5, 6, 16, '14828254901321438936', 1, '1.65', '新鲜土鸡蛋', '/eshop/Uploads/Shops/logo/2017-04-07/thumb_58e6eac7c1f94.jpg'),
(7, 8, 15, '14828254901358206992', 1, '2.81', '树懒果园6个精选大果1-2kg', '/eshop/Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg'),
(8, 9, 15, '14828254901358206992', 1, '2.81', '树懒果园6个精选大果1-2kg', '/eshop/Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg'),
(9, 10, 14, '14828254901346173251', 1, '1.25', '湖南红柚', '/eshop/Uploads/Shops/logo/2017-03-08/thumb_58c00c834f752.jpg'),
(11, 12, 15, '14828254901358206992', 1, '2.81', '树懒果园6个精选大果1-2kg', '/eshop/Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg'),
(12, 13, 15, '14828254901358206992', 1, '2.81', '树懒果园6个精选大果1-2kg', '/eshop/Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg'),
(13, 16, 14, '14828254901346173251', 1, '1.25', '湖南红柚', '/eshop/Uploads/Shops/logo/2017-03-08/thumb_58c00c834f752.jpg'),
(15, 18, 17, '14828254901387957928', 1, '0.81', '咸鸭蛋', '/eshop/Uploads/Shops/logo/2017-04-07/thumb_58e6ed4c93a95.jpg'),
(16, 20, 10, '14828254901325292459', 1, '1.00', '进口大鸭梨1', '/eshop/Uploads/Shops/logo/2017-03-28/thumb_58da4a8b69ad4.jpg'),
(17, 21, 10, '14828254901325292459', 1, '1.00', '进口大鸭梨1', '/eshop/Uploads/Shops/logo/2017-03-28/thumb_58da4a8b69ad4.jpg'),
(18, 22, 15, '14828254901358206992', 1, '2.81', '树懒果园6个精选大果1-2kg', '/eshop/Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg'),
(19, 23, 10, '14828254901325292459', 1, '1.00', '进口大鸭梨1', '/eshop/Uploads/Shops/logo/2017-03-28/thumb_58da4a8b69ad4.jpg'),
(20, 24, 18, '14828254901369797085', 1, '1.86', '红富士苹果1', '/eshop/Uploads/Shops/logo/2017-04-09/thumb_58e99b5942159.jpg'),
(21, 25, 15, '14828254901358206992', 1, '2.81', '树懒果园6个精选大果1-2kg', '/eshop/Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg'),
(22, 26, 10, '14828254901325292459', 1, '1.00', '进口大鸭梨1', '/eshop/Uploads/Shops/logo/2017-03-28/thumb_58da4a8b69ad4.jpg'),
(23, 27, 15, '14828254901358206992', 1, '2.81', '树懒果园6个精选大果1-2kg', '/eshop/Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg'),
(24, 28, 16, '14828254901321438936', 2, '1.65', '新鲜土鸡蛋', '/eshop/Uploads/Shops/logo/2017-04-07/thumb_58e6eac7c1f94.jpg'),
(25, 29, 15, '14828254901358206992', 2, '2.81', '树懒果园6个精选大果1-2kg', '/eshop/Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg'),
(26, 30, 15, '14828254901358206992', 1, '2.81', '树懒果园6个精选大果1-2kg', '/eshop/Uploads/Shops/logo/2017-03-13/thumb_58c630db33472.jpg'),
(27, 31, 17, '14828254901387957928', 1, '0.81', '咸鸭蛋', '/eshop/Uploads/Shops/logo/2017-04-07/thumb_58e6ed4c93a95.jpg'),
(28, 32, 16, '14828254901321438936', 1, '1.65', '新鲜土鸡蛋', '/eshop/Uploads/Shops/logo/2017-04-07/thumb_58e6eac7c1f94.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `eshop_order_logs`
--

CREATE TABLE IF NOT EXISTS `eshop_order_logs` (
  `id` bigint(250) NOT NULL AUTO_INCREMENT COMMENT '订单日志ID序列号',
  `orderId` bigint(255) NOT NULL DEFAULT '0' COMMENT '订单序列号',
  `orderStatus` int(11) NOT NULL DEFAULT '1' COMMENT '订单状态默认为1：下单，2：发货，3：收货，4：评价，-1取消，-2退款售后',
  `logContent` varchar(255) NOT NULL COMMENT '日志内容',
  `logUserId` int(11) NOT NULL DEFAULT '0' COMMENT '操作订单者的ID序列号',
  `logType` tinyint(4) NOT NULL DEFAULT '0' COMMENT '操作订单者的身份类型0：用户，1：商家，2：管理员',
  `time` int(10) DEFAULT NULL COMMENT '日志记录时间',
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单日志' AUTO_INCREMENT=53 ;

--
-- 转存表中的数据 `eshop_order_logs`
--

INSERT INTO `eshop_order_logs` (`id`, `orderId`, `orderStatus`, `logContent`, `logUserId`, `logType`, `time`) VALUES
(1, 1, 1, '下单成功', 20, 0, 1493178703),
(2, 3, 1, '下单成功', 20, 0, 1493180146),
(3, 4, 1, '下单成功', 20, 0, 1493207287),
(4, 5, 1, '下单成功', 20, 0, 1493207634),
(5, 6, 1, '下单成功', 20, 0, 1493209470),
(7, 8, 1, '下单成功', 20, 0, 1493210016),
(8, 9, 1, '下单成功', 20, 0, 1493210883),
(9, 10, 1, '下单成功', 20, 0, 1493210956),
(10, 12, 1, '下单成功', 20, 0, 1493211352),
(11, 16, 1, '下单成功', 20, 0, 1493253004),
(13, 18, 1, '下单成功', 20, 0, 1493254122),
(14, 20, 1, '下单成功', 20, 0, 1493343840),
(15, 21, 1, '下单成功', 20, 0, 1493343942),
(17, 12, 2, '商家已发货', 13, 1, 1493467149),
(18, 20, 2, '商家已发货', 13, 1, 1493552959),
(19, 21, -1, '用户取消订单', 20, 0, 1493603953),
(20, 13, -1, '用户取消订单', 20, 0, 1493604049),
(23, 18, -1, '用户取消订单', 20, 0, 1493604626),
(24, 8, 3, '用户已收货', 20, 0, 1493608165),
(25, 20, 3, '用户已收货', 20, 0, 1493608219),
(27, 16, 3, '用户已收货', 20, 0, 1493639757),
(28, 20, 3, '用户已收货', 20, 0, 1493639805),
(29, 20, 3, '用户已收货', 20, 0, 1493639997),
(30, 20, 3, '用户已收货', 20, 0, 1493640050),
(31, 18, 3, '用户已收货', 20, 0, 1493640206),
(32, 3, -1, '用户取消订单', 20, 0, 1493640410),
(33, 6, -1, '用户取消订单', 20, 0, 1493645936),
(34, 12, -2, '用户拒收订单', 20, 0, 1493695478),
(35, 9, 2, '商家已发货', 13, 1, 1493791797),
(36, 1, 2, '商家已发货', 13, 1, 1493791822),
(37, 5, 2, '商家已发货', 13, 1, 1493791860),
(38, 4, 2, '商家已发货', 13, 1, 1493791999),
(39, 22, 1, '下单成功', 20, 0, 1493906264),
(40, 5, 3, '用户已收货', 20, 0, 1494156170),
(41, 23, 1, '下单成功', 20, 0, 1494156301),
(42, 24, 1, '下单成功', 20, 0, 1494156342),
(43, 25, 1, '下单成功', 20, 0, 1494156342),
(44, 26, 1, '下单成功', 20, 0, 1494156342),
(45, 25, 2, '商家已发货', 13, 1, 1494156432),
(46, 27, 1, '下单成功', 20, 0, 1494636006),
(47, 4, 3, '用户已收货', 20, 0, 1494636255),
(48, 28, 1, '下单成功', 20, 0, 1495593165),
(49, 29, 1, '下单成功', 20, 0, 1495761279),
(50, 30, 1, '下单成功', 20, 0, 1495761311),
(51, 31, 1, '下单成功', 20, 0, 1495761793),
(52, 32, 1, '下单成功', 20, 0, 1495762299);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_secondmenu`
--

CREATE TABLE IF NOT EXISTS `eshop_secondmenu` (
  `id` int(150) NOT NULL AUTO_INCREMENT COMMENT '菜单序列号',
  `pid` int(150) NOT NULL COMMENT '对应一级菜单序列号',
  `name` varchar(50) NOT NULL COMMENT '二级菜单名字',
  `creater_name` varchar(50) DEFAULT NULL COMMENT '二级菜单创建者',
  `create_time` int(20) DEFAULT NULL COMMENT '二级菜单创建时间',
  `modify_name` varchar(50) DEFAULT NULL COMMENT '二级菜单修改者',
  `modify_time` int(20) DEFAULT NULL COMMENT '二级菜单修改时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='全站二级菜单分类表' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `eshop_secondmenu`
--

INSERT INTO `eshop_secondmenu` (`id`, `pid`, `name`, `creater_name`, `create_time`, `modify_name`, `modify_time`, `is_show`) VALUES
(1, 1, '新鲜蔬菜', NULL, NULL, NULL, NULL, 1),
(2, 1, '豆制品', NULL, NULL, NULL, NULL, 1),
(3, 2, '国产水果', NULL, NULL, NULL, NULL, 1),
(4, 2, '进口水果', NULL, NULL, NULL, NULL, 1),
(5, 3, '猪、牛羊肉', NULL, NULL, NULL, NULL, 1),
(6, 3, '家禽类', NULL, NULL, NULL, NULL, 1),
(7, 3, '蛋类', NULL, NULL, NULL, NULL, 1),
(8, 4, '海鲜', NULL, NULL, NULL, NULL, 1),
(9, 4, '河鲜', NULL, NULL, NULL, NULL, 1),
(10, 5, '冷冻食品', NULL, NULL, NULL, NULL, 1),
(11, 5, '方便速食', NULL, NULL, NULL, NULL, 1),
(12, 5, '冷冻食品1', NULL, NULL, NULL, NULL, 1),
(13, 5, '方便速食1', NULL, NULL, NULL, NULL, 1),
(14, 6, '调味品', NULL, NULL, NULL, NULL, 1),
(15, 6, '食用油', NULL, NULL, NULL, NULL, 1),
(16, 7, '罐头', NULL, NULL, NULL, NULL, 1),
(17, 7, '熏制食品', NULL, NULL, NULL, NULL, 1),
(18, 8, '南方特色茶叶', NULL, NULL, NULL, NULL, 1),
(19, 8, '乳制品', NULL, NULL, NULL, NULL, 1),
(20, 9, '江南特色小吃', NULL, NULL, NULL, NULL, 1),
(21, 9, '湖南特色小吃', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_shop`
--

CREATE TABLE IF NOT EXISTS `eshop_shop` (
  `id` int(250) NOT NULL AUTO_INCREMENT COMMENT '店铺序列号',
  `shoperId` int(250) NOT NULL COMMENT '商家序列号',
  `name` varchar(100) NOT NULL COMMENT '店铺名称',
  `address` varchar(100) DEFAULT NULL COMMENT '店铺地址',
  `logo` varchar(100) DEFAULT NULL COMMENT '店铺logo',
  `qrcode` varchar(100) DEFAULT NULL COMMENT '店铺二维码',
  `service_qq` varchar(50) DEFAULT NULL COMMENT '店铺服务QQ号',
  `server_tel` varchar(25) DEFAULT NULL COMMENT '店铺客服电话',
  `server_time` varchar(50) DEFAULT NULL COMMENT '店铺服务时间',
  `rank` varchar(25) DEFAULT NULL COMMENT '店铺等级',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `modifytime` int(10) NOT NULL COMMENT '信息修改最近一次时间',
  `is_exam` int(2) DEFAULT '0' COMMENT '是否审核',
  `is_forbid` int(2) DEFAULT '0' COMMENT '是否封号',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `shoperId` (`shoperId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='店铺信息表 ' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `eshop_shop`
--

INSERT INTO `eshop_shop` (`id`, `shoperId`, `name`, `address`, `logo`, `qrcode`, `service_qq`, `server_tel`, `server_time`, `rank`, `createtime`, `modifytime`, `is_exam`, `is_forbid`, `is_show`) VALUES
(2, 12, '红富士旗舰店3', '山东省枣庄市', '', NULL, '1234567', NULL, '08:30:00至22:30:00 ', NULL, 1482825346, 1482825346, 1, 0, 1),
(3, 13, '红富士旗舰店4', '湖南省邵阳市', 'Uploads/Shops/face/2017-03-28/thumb_58d9dc61ecf21.jpg', 'Uploads/Shops/qrcode/2017-03-28/thumb_58d9dcb8069d7.jpg', '1411387108', '021-12345678', '08:30:00至22:30:00', '普通会员', 1482825490, 1490672882, 1, 0, 1),
(4, 14, '测试店铺', '湖南省邵东县', 'Uploads/Shops/face/2017-03-28/thumb_58d9dc61ecf21.jpg', 'Uploads/Shops/qrcode/2017-03-28/thumb_58d9dcb8069d7.jpg', '', NULL, NULL, NULL, 1491275150, 1491275150, 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_shoper`
--

CREATE TABLE IF NOT EXISTS `eshop_shoper` (
  `id` int(250) NOT NULL AUTO_INCREMENT COMMENT '商户序列号',
  `name` varchar(150) NOT NULL COMMENT '商户名',
  `password` varchar(100) NOT NULL COMMENT '登录密码',
  `email` varchar(50) NOT NULL COMMENT '验证邮箱',
  `bind_email` int(2) NOT NULL DEFAULT '0' COMMENT '邮箱是否绑定默认为0表示没有绑定',
  `bind_tel` int(2) NOT NULL DEFAULT '0' COMMENT '电话号码是否验证默认为0表示没有验证',
  `trueName` varchar(50) DEFAULT NULL COMMENT '商家真实姓名',
  `sex` enum('男','女','保密') NOT NULL DEFAULT '保密' COMMENT '性别',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `carNum` varchar(50) DEFAULT NULL COMMENT '身份证号',
  `face` varchar(150) NOT NULL COMMENT '商户头像',
  `qq` varchar(35) DEFAULT NULL COMMENT 'qq号码',
  `tel` varchar(25) DEFAULT NULL COMMENT '联系方式',
  `create_time` int(10) DEFAULT NULL COMMENT '注册时间',
  `modify_time` int(10) NOT NULL DEFAULT '0' COMMENT '最近一次修改时间',
  `is_examine` int(2) DEFAULT '0' COMMENT '是否审核',
  `is_forbid` int(2) DEFAULT '0' COMMENT '是否封号',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商家信息表' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `eshop_shoper`
--

INSERT INTO `eshop_shoper` (`id`, `name`, `password`, `email`, `bind_email`, `bind_tel`, `trueName`, `sex`, `birthday`, `carNum`, `face`, `qq`, `tel`, `create_time`, `modify_time`, `is_examine`, `is_forbid`, `is_show`) VALUES
(12, 'shoper1', '77535d5579b816f9b2225e69c44a2bce', '123454337@qq.com', 0, 0, '赵六', '保密', '2016-03-31', '430521439410095672', '', '144267133', '18923410292', 1482825346, 0, 1, 0, 1),
(13, 'shoper3', 'd30625a753ea9fa658bfbfcb363033c4', '1411387108@qq.com', 1, 0, '小红', '保密', '2016-03-27', '430521439410095672', '', '144267133', '18923414392', 1482825490, 1495434962, 1, 0, 1),
(14, 'shoper4', '77bed0e701bd9c84f3104d95e61ea776', 'shoper4@sina.com', 0, 0, '李永发', '男', '2017-04-04', '430521199410095672', '', '', '18904010296', 1491275150, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_shoper_log`
--

CREATE TABLE IF NOT EXISTS `eshop_shoper_log` (
  `id` int(250) NOT NULL AUTO_INCREMENT COMMENT '记录序列号',
  `shoperId` int(250) NOT NULL COMMENT '商家序列号',
  `action` varchar(25) NOT NULL COMMENT '操作内容',
  `ip` varchar(50) NOT NULL COMMENT '当前IP',
  `location` varchar(100) DEFAULT NULL COMMENT '所在地址',
  `time` int(20) DEFAULT NULL COMMENT '操作时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `shoperId` (`shoperId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商家操作记录表' AUTO_INCREMENT=72 ;

--
-- 转存表中的数据 `eshop_shoper_log`
--

INSERT INTO `eshop_shoper_log` (`id`, `shoperId`, `action`, `ip`, `location`, `time`, `is_show`) VALUES
(17, 13, '登录', '0.0.0.0', NULL, 1482889297, 1),
(20, 13, '登录', '0.0.0.0', NULL, 1482990550, 1),
(38, 13, '修改密码', '0.0.0.0', NULL, 1490274438, 1),
(40, 13, '修改密码', '0.0.0.0', NULL, 1490274680, 1),
(48, 13, '登录', '0.0.0.0', NULL, 1491273200, 1),
(52, 13, '登录', '0.0.0.0', NULL, 1493254214, 1),
(55, 13, '登录', '0.0.0.0', NULL, 1493546983, 1),
(57, 13, '登录', '0.0.0.0', NULL, 1493791412, 1),
(59, 13, '登录', '0.0.0.0', NULL, 1493966335, 1),
(60, 13, '邮箱解绑', '0.0.0.0', NULL, 1493979838, 1),
(61, 13, '邮箱绑定', '0.0.0.0', NULL, 1493980755, 1),
(62, 13, '登录', '0.0.0.0', NULL, 1494136128, 1),
(63, 13, '登录', '0.0.0.0', NULL, 1494156411, 1),
(64, 13, '邮箱解绑', '0.0.0.0', NULL, 1494156526, 1),
(65, 13, '邮箱绑定', '0.0.0.0', NULL, 1494156654, 1),
(66, 13, '登录', '0.0.0.0', NULL, 1494205535, 1),
(67, 13, '密码找回', '0.0.0.0', NULL, 1495434962, 1),
(68, 13, '登录', '0.0.0.0', NULL, 1495442990, 1),
(69, 13, '登录', '0.0.0.0', NULL, 1495630839, 1),
(70, 13, '登录', '0.0.0.0', NULL, 1495764132, 1),
(71, 13, '登录', '0.0.0.0', NULL, 1497095868, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_shop_firstmenu`
--

CREATE TABLE IF NOT EXISTS `eshop_shop_firstmenu` (
  `id` int(250) NOT NULL AUTO_INCREMENT COMMENT '菜单序列号',
  `shopId` int(250) NOT NULL COMMENT '店铺序列号',
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `create_time` int(20) DEFAULT NULL COMMENT '添加时间',
  `modify_time` int(20) DEFAULT NULL COMMENT '修改时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `shopId` (`shopId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='店铺一级菜单表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `eshop_shop_firstmenu`
--

INSERT INTO `eshop_shop_firstmenu` (`id`, `shopId`, `name`, `create_time`, `modify_time`, `is_show`) VALUES
(1, 3, '食品饮料', NULL, NULL, 1),
(3, 2, '测试一级菜单', NULL, NULL, 1),
(5, 3, '蔬菜水果', 1483427974, 1483447567, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_shop_scollimg`
--

CREATE TABLE IF NOT EXISTS `eshop_shop_scollimg` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT COMMENT '自增序列号',
  `imgURL` varchar(100) NOT NULL COMMENT '图片地址',
  `shopId` int(250) NOT NULL COMMENT '店铺ID',
  `upload_time` int(10) DEFAULT NULL COMMENT '上传时间',
  `is_forbiden` int(2) DEFAULT '0' COMMENT '是否禁止',
  PRIMARY KEY (`id`),
  KEY `shopId` (`shopId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商铺首页轮播图片' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `eshop_shop_scollimg`
--

INSERT INTO `eshop_shop_scollimg` (`id`, `imgURL`, `shopId`, `upload_time`, `is_forbiden`) VALUES
(2, 'Uploads/Shops/ads/2017-03-31/58de5f8794c3f.png', 3, 1490968458, 0),
(3, 'Uploads/Shops/ads/2017-03-31/58de5f87a8c35.png', 3, 1490968458, 0),
(4, 'Uploads/Shops/ads/2017-03-31/58de5f87b8e40.png', 3, 1490968458, 0),
(5, 'Uploads/Shops/ads/2017-03-31/58de5f87cb96d.png', 3, 1490968458, 0),
(6, 'Uploads/Shops/ads/2017-03-31/58de5f87dc1d5.png', 3, 1490968458, 0);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_shop_secondmenu`
--

CREATE TABLE IF NOT EXISTS `eshop_shop_secondmenu` (
  `id` int(250) NOT NULL AUTO_INCREMENT COMMENT '二级菜单序列号',
  `pid` int(250) NOT NULL COMMENT '店铺一级菜单序列号',
  `sname` varchar(50) NOT NULL COMMENT '二级菜单名称',
  `create_time` int(20) DEFAULT NULL COMMENT '添加时间',
  `modify_time` int(20) DEFAULT NULL COMMENT '修改时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `eshop_shop_secondmenu` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='店铺二级菜单表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `eshop_shop_secondmenu`
--

INSERT INTO `eshop_shop_secondmenu` (`id`, `pid`, `sname`, `create_time`, `modify_time`, `is_show`) VALUES
(1, 1, '坚果零食', NULL, NULL, 1),
(2, 1, '水饮茶冲', NULL, NULL, 1),
(7, 3, '测试二级菜单', NULL, NULL, 1),
(8, 1, '可乐', 1483353990, 1483447709, 1),
(13, 5, '红富士苹果', 1483428258, 1491096284, 1),
(17, 5, '青苹果', 1483511364, 1491096290, 1),
(18, 5, '红柚', 1489286089, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_thirdmenu`
--

CREATE TABLE IF NOT EXISTS `eshop_thirdmenu` (
  `id` int(150) NOT NULL AUTO_INCREMENT COMMENT '菜单序列号',
  `pid` int(150) NOT NULL COMMENT '对应二级级菜单序列号',
  `name` varchar(50) NOT NULL COMMENT '三级菜单名字',
  `creater_name` varchar(50) DEFAULT NULL COMMENT '三级菜单创建者',
  `create_time` int(20) DEFAULT NULL COMMENT '三级菜单创建时间',
  `modify_name` varchar(50) DEFAULT NULL COMMENT '三级菜单修改者',
  `modify_time` int(20) DEFAULT NULL COMMENT '三级菜单修改时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='全站三级菜单分类表' AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `eshop_thirdmenu`
--

INSERT INTO `eshop_thirdmenu` (`id`, `pid`, `name`, `creater_name`, `create_time`, `modify_name`, `modify_time`, `is_show`) VALUES
(1, 1, '菌菇类', NULL, NULL, NULL, NULL, 1),
(2, 1, '葱蒜调味类', NULL, NULL, NULL, NULL, 1),
(3, 3, '橙、橘类', NULL, NULL, NULL, NULL, 1),
(4, 3, '苹果、梨', NULL, NULL, NULL, NULL, 1),
(5, 4, '东南亚香蕉', NULL, NULL, NULL, NULL, 1),
(6, 4, '菲律宾芒果', NULL, NULL, NULL, NULL, 1),
(7, 5, '湖南特色香猪肉', NULL, NULL, NULL, NULL, 1),
(8, 5, '内蒙古羊肉', NULL, NULL, NULL, NULL, 1),
(9, 6, '武冈铜鹅', NULL, NULL, NULL, NULL, 1),
(10, 7, '农家土鸡蛋', NULL, NULL, NULL, NULL, 1),
(11, 8, '海螺，扇贝', NULL, NULL, NULL, NULL, 1),
(12, 9, '草鱼', NULL, NULL, NULL, NULL, 1),
(13, 10, '冻鸡爪', NULL, NULL, NULL, NULL, 1),
(14, 11, '火腿肠', NULL, NULL, NULL, NULL, 1),
(15, 14, '陕西酱油', NULL, NULL, NULL, NULL, 1),
(16, 15, '转基因大豆油', NULL, NULL, NULL, NULL, 1),
(17, 16, '苹果罐头', NULL, NULL, NULL, NULL, 1),
(18, 17, '湘西腊肉', NULL, NULL, NULL, NULL, 1),
(19, 18, '西湖龙井', NULL, NULL, NULL, NULL, 1),
(20, 18, '云南普洱', NULL, NULL, NULL, NULL, 1),
(21, 19, '有机酸奶', NULL, NULL, NULL, NULL, 1),
(22, 19, '脱脂奶', NULL, NULL, NULL, NULL, 1),
(23, 20, '枣糕', NULL, NULL, NULL, NULL, 1),
(24, 20, '麻辣', NULL, NULL, NULL, NULL, 1),
(25, 21, '洞庭鱼仔', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_user`
--

CREATE TABLE IF NOT EXISTS `eshop_user` (
  `id` int(250) NOT NULL AUTO_INCREMENT COMMENT '用户序列号自增',
  `name` varchar(50) NOT NULL COMMENT '登录账号',
  `password` varchar(100) NOT NULL COMMENT '登录密码',
  `email` varchar(100) NOT NULL COMMENT '注册邮箱',
  `bind_email` tinyint(2) NOT NULL DEFAULT '0' COMMENT '邮箱是否绑定默认为0表示没有绑定',
  `nick` varchar(100) DEFAULT NULL COMMENT '昵称',
  `trueName` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `photo` varchar(150) DEFAULT NULL COMMENT '头像',
  `sex` enum('男','女','保密') NOT NULL DEFAULT '保密' COMMENT '性别',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `carNum` varchar(50) DEFAULT NULL COMMENT '身份证号',
  `qq` varchar(25) DEFAULT NULL COMMENT 'qq号码',
  `tel` varchar(20) DEFAULT NULL COMMENT '联系方式',
  `bind_tel` tinyint(2) NOT NULL DEFAULT '0' COMMENT '电话号码是否验证默认为0表示没有验证',
  `regist_time` int(20) DEFAULT NULL COMMENT '注册时间',
  `modify_time` int(10) NOT NULL COMMENT '最近一次修改时间',
  `is_forbid` int(2) DEFAULT '0' COMMENT '是否封号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `eshop_user`
--

INSERT INTO `eshop_user` (`id`, `name`, `password`, `email`, `bind_email`, `nick`, `trueName`, `photo`, `sex`, `birthday`, `carNum`, `qq`, `tel`, `bind_tel`, `regist_time`, `modify_time`, `is_forbid`) VALUES
(11, 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'admin1@qq.com', 0, '大漠雄鹰1', '李永发', NULL, '男', '2016-11-29', '430521199410095672', '1411387108', '18904010296', 0, 1481859632, 0, 0),
(12, 'testajax', 'cc03e747a6afbbcbf8be7668acfebee5', 'test1@qq.com', 0, NULL, NULL, NULL, '保密', NULL, NULL, NULL, NULL, 0, 1496851200, 0, 0),
(14, 'test', '60474c9c10d7142b7508ce7a50acf414', '123456@qq.com', 0, NULL, NULL, NULL, '保密', NULL, NULL, NULL, NULL, 0, 1482376006, 0, 0),
(15, 'test1', 'cc03e747a6afbbcbf8be7668acfebee5', '12345@qq.com', 0, NULL, NULL, NULL, '保密', NULL, NULL, NULL, NULL, 0, 1482376304, 0, 0),
(16, 'test12', '60474c9c10d7142b7508ce7a50acf414', '1234556@qq.com', 0, NULL, NULL, NULL, '保密', NULL, NULL, NULL, NULL, 0, 1482376420, 0, 0),
(17, 'test123', 'cc03e747a6afbbcbf8be7668acfebee5', '1234546@qq.com', 0, NULL, NULL, NULL, '保密', NULL, NULL, NULL, NULL, 0, 1482376589, 0, 0),
(18, 'test1234', '16d7a4fca7442dda3ad93c9a726597e4', '12345467@qq.com', 0, NULL, NULL, NULL, '保密', NULL, NULL, NULL, NULL, 0, 1482376785, 0, 0),
(19, 'uesr12', 'd781eaae8248db6ce1a7b82e58e60435', '1411387108@qq.con', 0, NULL, NULL, NULL, '保密', NULL, NULL, NULL, NULL, 0, 1489826635, 0, 0),
(20, 'admin', '1844156d4166d94387f1a4ad031ca5fa', '1411387108@qq.com', 1, '大漠雄鹰', '李永发', 'Uploads/Users/2017-04-22/thumb_58faaf73d95ff.jpg', '男', '2002-03-14', '430521199410095672', '1411345463', '18904010296', 0, 1489975553, 1495433759, 0);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_user_address`
--

CREATE TABLE IF NOT EXISTS `eshop_user_address` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '地址序列号	',
  `userId` int(250) NOT NULL COMMENT '买家序列号',
  `userName` varchar(50) NOT NULL COMMENT '收货人姓名',
  `location` varchar(100) NOT NULL COMMENT '所在地区',
  `streetInfo` text COMMENT '详细街道信息',
  `postCode` int(6) DEFAULT '0' COMMENT '邮编',
  `tel` varchar(20) NOT NULL COMMENT '联系方式',
  `is_first` int(2) DEFAULT '0' COMMENT '是否默认地址',
  `createtime` int(10) NOT NULL COMMENT '添加时间',
  `modifytime` int(10) NOT NULL COMMENT '最近一次修改时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户收货地址表' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `eshop_user_address`
--

INSERT INTO `eshop_user_address` (`id`, `userId`, `userName`, `location`, `streetInfo`, `postCode`, `tel`, `is_first`, `createtime`, `modifytime`, `is_show`) VALUES
(1, 11, '李永发', '辽宁省|沈阳市|铁西区', '沈阳工业大学', 112244, '18904010296', 0, 1482299591, 1483064865, 1),
(2, 11, '张三', '北京市|北京市市辖区|东城区', '三好胡同删号', 123456, '18904010296', 1, 1482300384, 1483064877, 1),
(8, 11, '梨花', '上海市|上海市市辖区|黄浦区', '黄浦区', 433322, '13437826498', 0, 1482301605, 1483064865, 1),
(11, 11, '王二', '山东省|济南市|历下区', '沈阳工业大学', 433322, '13437826498', 0, 1482327044, 1483064865, 1),
(12, 11, '王柳', '浙江省|杭州市|上城区', '昭阳大道', 433322, '13437826498', 0, 1482462406, 1483064865, 0),
(13, 19, '李永发', '北京市|北京市市辖区|东城区', '东咋会电视剧', 422800, '18904010296', 1, 1489847091, 0, 1),
(14, 20, '李黎明', '北京市|北京市市辖区|东城区', '铁西区', 110021, '13437826498', 1, 1492825260, 1495066829, 1),
(15, 20, '晓红', '浙江省|宁波市|北仑区', '兴工街21号', 220011, '13437826498', 0, 1492840464, 1495066829, 1),
(16, 20, '刘梧州', '山西省|太原市|万柏林区', '太原街道', 220011, '14323459832', 0, 1492917322, 1495066829, 1),
(17, 20, '测试号', '北京市|北京市市辖区|东城区', '测试街道', 123456, '18904010647', 0, 1493010869, 1495066829, 0);

-- --------------------------------------------------------

--
-- 表的结构 `eshop_user_log`
--

CREATE TABLE IF NOT EXISTS `eshop_user_log` (
  `id` int(250) NOT NULL AUTO_INCREMENT COMMENT '用户操作记录序列号自增',
  `userId` int(250) NOT NULL COMMENT '用户序列号',
  `action` varchar(25) NOT NULL COMMENT '操作内容',
  `ip` varchar(50) NOT NULL COMMENT '当前IP',
  `location` varchar(100) DEFAULT NULL COMMENT '当前地址',
  `time` int(20) DEFAULT NULL COMMENT '操作时间',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户操作记录表' AUTO_INCREMENT=100 ;

--
-- 转存表中的数据 `eshop_user_log`
--

INSERT INTO `eshop_user_log` (`id`, `userId`, `action`, `ip`, `location`, `time`, `is_show`) VALUES
(17, 11, '登录', '0.0.0.0', NULL, 1482113623, 1),
(22, 11, '修改密码', '0.0.0.0', NULL, 1482205787, 1),
(26, 11, '修改个人信息', '0.0.0.0', NULL, 1482214137, 1),
(27, 11, '修改个人信息', '0.0.0.0', NULL, 1482308698, 1),
(28, 11, '修改个人信息', '0.0.0.0', NULL, 1482308709, 1),
(29, 11, '修改个人信息', '0.0.0.0', NULL, 1482308720, 1),
(30, 11, '修改个人信息', '0.0.0.0', NULL, 1482324448, 1),
(31, 11, '修改个人信息', '0.0.0.0', NULL, 1482325938, 1),
(32, 11, '修改个人信息', '0.0.0.0', NULL, 1482326193, 1),
(33, 11, '修改个人信息', '0.0.0.0', NULL, 1482326286, 1),
(34, 11, '修改个人信息', '0.0.0.0', NULL, 1482326301, 1),
(35, 11, '修改个人信息', '0.0.0.0', NULL, 1482326316, 1),
(36, 11, '修改个人信息', '0.0.0.0', NULL, 1482326338, 1),
(37, 11, '修改个人信息', '0.0.0.0', NULL, 1482326384, 1),
(38, 11, '修改密码', '0.0.0.0', NULL, 1482326749, 1),
(39, 11, '登录', '0.0.0.0', NULL, 1482326789, 1),
(43, 11, '登录', '0.0.0.0', NULL, 1482380779, 1),
(44, 11, '登录', '0.0.0.0', NULL, 1482408645, 1),
(45, 11, '登录', '0.0.0.0', NULL, 1482554189, 1),
(46, 11, '登录', '0.0.0.0', NULL, 1482557078, 1),
(48, 11, '登录', '0.0.0.0', NULL, 1482838019, 1),
(49, 11, '登录', '0.0.0.0', NULL, 1482840071, 1),
(50, 11, '登录', '0.0.0.0', NULL, 1482840432, 1),
(51, 11, '登录', '0.0.0.0', NULL, 1482841829, 1),
(52, 11, '登录', '0.0.0.0', NULL, 1482990242, 1),
(53, 11, '登录', '0.0.0.0', NULL, 1483064840, 1),
(54, 11, '登录', '0.0.0.0', NULL, 1483531638, 1),
(55, 11, '登录', '0.0.0.0', NULL, 1483614379, 1),
(56, 11, '登录', '0.0.0.0', NULL, 1483696118, 1),
(57, 15, '登录', '0.0.0.0', NULL, 1488509281, 1),
(58, 19, '登录', '0.0.0.0', NULL, 1489827728, 1),
(60, 19, '登录', '0.0.0.0', NULL, 1489828837, 1),
(63, 19, '登录', '0.0.0.0', NULL, 1489846725, 1),
(64, 19, '登录', '0.0.0.0', NULL, 1489846847, 1),
(65, 20, '登录', '0.0.0.0', NULL, 1489975752, 1),
(66, 20, '修改个人信息', '0.0.0.0', NULL, 1489976344, 1),
(68, 20, '修改密码', '0.0.0.0', NULL, 1489992533, 1),
(69, 20, '登录', '0.0.0.0', NULL, 1489992564, 1),
(77, 20, '登录', '0.0.0.0', NULL, 1492687285, 1),
(80, 20, '修改密码', '0.0.0.0', NULL, 1492828668, 1),
(89, 20, '登录', '0.0.0.0', NULL, 1494134137, 1),
(91, 20, '登录', '0.0.0.0', NULL, 1494202388, 1),
(92, 20, '登录', '0.0.0.0', NULL, 1494635978, 1),
(93, 20, '邮箱绑定', '0.0.0.0', NULL, 1494986575, 1),
(94, 20, '密码找回', '0.0.0.0', NULL, 1495433385, 1),
(95, 20, '密码找回', '0.0.0.0', NULL, 1495433759, 1),
(96, 20, '登录', '0.0.0.0', NULL, 1495434701, 1),
(97, 20, '登录', '0.0.0.0', NULL, 1495591741, 1),
(98, 20, '登录', '0.0.0.0', NULL, 1495760626, 1),
(99, 20, '登录', '0.0.0.0', NULL, 1496795993, 1);

--
-- 限制导出的表
--

--
-- 限制表 `eshop_cart`
--
ALTER TABLE `eshop_cart`
  ADD CONSTRAINT `eshop_cart_ibfk_1` FOREIGN KEY (`goodId`) REFERENCES `eshop_good` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eshop_cart_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `eshop_user` (`id`) ON DELETE CASCADE;

--
-- 限制表 `eshop_collection`
--
ALTER TABLE `eshop_collection`
  ADD CONSTRAINT `eshop_collection_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `eshop_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `eshop_goodcomment`
--
ALTER TABLE `eshop_goodcomment`
  ADD CONSTRAINT `eshop_goodcomment_ibfk_1` FOREIGN KEY (`goodId`) REFERENCES `eshop_good` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eshop_goodcomment_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `eshop_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eshop_goodcomment_ibfk_3` FOREIGN KEY (`shopId`) REFERENCES `eshop_shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `eshop_goodimg`
--
ALTER TABLE `eshop_goodimg`
  ADD CONSTRAINT `eshop_goodimg_ibfk_1` FOREIGN KEY (`goodId`) REFERENCES `eshop_good` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `eshop_goodinfo`
--
ALTER TABLE `eshop_goodinfo`
  ADD CONSTRAINT `eshop_goodinfo_ibfk_1` FOREIGN KEY (`goodId`) REFERENCES `eshop_good` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eshop_goodinfo_ibfk_2` FOREIGN KEY (`lableId`) REFERENCES `eshop_goodlable` (`lableId`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- 限制表 `eshop_goodnav`
--
ALTER TABLE `eshop_goodnav`
  ADD CONSTRAINT `eshop_goodnav_ibfk_1` FOREIGN KEY (`w_fid`) REFERENCES `eshop_firstmenu` (`id`),
  ADD CONSTRAINT `eshop_goodnav_ibfk_2` FOREIGN KEY (`w_sid`) REFERENCES `eshop_secondmenu` (`id`),
  ADD CONSTRAINT `eshop_goodnav_ibfk_3` FOREIGN KEY (`w_tid`) REFERENCES `eshop_thirdmenu` (`id`),
  ADD CONSTRAINT `eshop_goodnav_ibfk_4` FOREIGN KEY (`s_fid`) REFERENCES `eshop_shop_firstmenu` (`id`),
  ADD CONSTRAINT `eshop_goodnav_ibfk_5` FOREIGN KEY (`s_sid`) REFERENCES `eshop_shop_secondmenu` (`id`),
  ADD CONSTRAINT `eshop_goodnav_ibfk_6` FOREIGN KEY (`shopId`) REFERENCES `eshop_shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eshop_goodnav_ibfk_7` FOREIGN KEY (`goodId`) REFERENCES `eshop_good` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `eshop_goodservice`
--
ALTER TABLE `eshop_goodservice`
  ADD CONSTRAINT `eshop_goodservice_ibfk_1` FOREIGN KEY (`goodId`) REFERENCES `eshop_good` (`id`) ON DELETE CASCADE;

--
-- 限制表 `eshop_order_complaint`
--
ALTER TABLE `eshop_order_complaint`
  ADD CONSTRAINT `eshop_order_complaint_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `eshop_order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eshop_order_complaint_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `eshop_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eshop_order_complaint_ibfk_3` FOREIGN KEY (`shopId`) REFERENCES `eshop_shop` (`id`) ON DELETE CASCADE;

--
-- 限制表 `eshop_order_goods`
--
ALTER TABLE `eshop_order_goods`
  ADD CONSTRAINT `eshop_order_goods_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `eshop_order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eshop_order_goods_ibfk_2` FOREIGN KEY (`goodId`) REFERENCES `eshop_good` (`id`) ON DELETE CASCADE;

--
-- 限制表 `eshop_order_logs`
--
ALTER TABLE `eshop_order_logs`
  ADD CONSTRAINT `eshop_order_logs_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `eshop_order` (`id`) ON DELETE CASCADE;

--
-- 限制表 `eshop_secondmenu`
--
ALTER TABLE `eshop_secondmenu`
  ADD CONSTRAINT `eshop_secondmenu_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `eshop_firstmenu` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- 限制表 `eshop_shop`
--
ALTER TABLE `eshop_shop`
  ADD CONSTRAINT `eshop_shop_ibfk_1` FOREIGN KEY (`shoperId`) REFERENCES `eshop_shoper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `eshop_shoper_log`
--
ALTER TABLE `eshop_shoper_log`
  ADD CONSTRAINT `eshop_shoper_log_ibfk_1` FOREIGN KEY (`shoperId`) REFERENCES `eshop_shoper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `eshop_shop_firstmenu`
--
ALTER TABLE `eshop_shop_firstmenu`
  ADD CONSTRAINT `eshop_shop_firstmenu_ibfk_1` FOREIGN KEY (`shopId`) REFERENCES `eshop_shop` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- 限制表 `eshop_shop_scollimg`
--
ALTER TABLE `eshop_shop_scollimg`
  ADD CONSTRAINT `eshop_shop_scollimg_ibfk_1` FOREIGN KEY (`shopId`) REFERENCES `eshop_shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `eshop_shop_secondmenu`
--
ALTER TABLE `eshop_shop_secondmenu`
  ADD CONSTRAINT `eshop_shop_secondmenu` FOREIGN KEY (`pid`) REFERENCES `eshop_shop_firstmenu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eshop_shop_secondmenu_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `eshop_shop_firstmenu` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- 限制表 `eshop_thirdmenu`
--
ALTER TABLE `eshop_thirdmenu`
  ADD CONSTRAINT `eshop_thirdmenu_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `eshop_secondmenu` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- 限制表 `eshop_user_address`
--
ALTER TABLE `eshop_user_address`
  ADD CONSTRAINT `eshop_user_address_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `eshop_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `eshop_user_log`
--
ALTER TABLE `eshop_user_log`
  ADD CONSTRAINT `eshop_user_log_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `eshop_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
