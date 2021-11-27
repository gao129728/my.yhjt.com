-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-11-23 10:41:16
-- 服务器版本： 5.7.34-log
-- PHP 版本： 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `yhjt_cfsite4_ahc`
--

-- --------------------------------------------------------

--
-- 表的结构 `core_ad`
--

CREATE TABLE `core_ad` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `ad_position_id` int(10) DEFAULT NULL COMMENT '广告位',
  `url` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '状态',
  `closed` tinyint(1) DEFAULT '0',
  `orderby` int(11) DEFAULT '100'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_ad`
--

INSERT INTO `core_ad` (`id`, `title`, `ad_position_id`, `url`, `photo`, `status`, `closed`, `orderby`) VALUES
(77, '首页banner1', 1, '', '20211115/e7f9bd26cd42d38bd8dd99171a92c7c8.png', 1, 0, 10),
(79, '搜索banner', 25, '', '20211108/2e036a426edaa453404214b22185dea4.png', 1, 0, 30),
(80, '手机banner', 26, '', '20211118/dd970d3f94d6338333f94c30ec972b4b.jpg', 1, 0, 40);

-- --------------------------------------------------------

--
-- 表的结构 `core_address`
--

CREATE TABLE `core_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `postcode` int(20) DEFAULT NULL,
  `phone_kind` varchar(50) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `is_default` tinyint(2) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_address`
--

INSERT INTO `core_address` (`id`, `user_id`, `email`, `name`, `address`, `postcode`, `phone_kind`, `phone`, `create_time`, `is_default`, `sex`) VALUES
(72, 33, '1122@qq.com', 'iohy', '安徽合肥', 625735, 'company', '13625641234', 1637028668, 1, 'man'),
(67, 29, '2252098231@qq.com', 'iohy22222222', '安徽合肥', 625735, '', '13625641234', 1636946534, 0, ''),
(68, 29, '2252098231@qq.com', 'iohy', '安徽合肥', 625735, '', '13625641234', 1636946604, 0, ''),
(69, 29, '2252098231@qq.com', '1111', '安徽合肥', 625735, '', '13625641234', 1636946639, 0, ''),
(70, 31, '2252098231@qq.com', 'nice', '安徽合肥', 625735, '', '13625641234', 1636970932, 1, ''),
(71, 32, '1111111@qq.com', 'iohy', '安徽合肥', 625735, '', '13625641234', 1637028125, 1, ''),
(76, 29, '11222@qq.com', 'zhangsan', '安徽合肥', 625735, '', '13625641234', 1637562710, 0, NULL),
(73, 30, '1297282206@qq.com', 'gzj', '安徽合肥', 625735, 'personal', '13625641234', 1637032736, 1, ''),
(74, 30, '1297282206@qq.com', 'iohy', '安徽合肥', 625735, '', '13625641234', 1637032747, 0, ''),
(75, 29, '11222@qq.com', 'wangwu', '安徽合肥', 625735, '', '13625641234', 1637562685, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `core_add_field`
--

CREATE TABLE `core_add_field` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `style` tinyint(11) DEFAULT '1',
  `value` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `core_add_field`
--

INSERT INTO `core_add_field` (`id`, `name`, `style`, `value`) VALUES
(1, '外链', 1, 'website'),
(20, '价格', 1, 'price');

-- --------------------------------------------------------

--
-- 表的结构 `core_admin`
--

CREATE TABLE `core_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_bin DEFAULT '' COMMENT '用户名',
  `password` varchar(32) COLLATE utf8_bin DEFAULT '' COMMENT '密码',
  `portrait` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '头像',
  `loginnum` int(11) DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) DEFAULT '0' COMMENT '最后登录时间',
  `real_name` varchar(20) COLLATE utf8_bin DEFAULT '' COMMENT '真实姓名',
  `status` int(1) DEFAULT '0' COMMENT '状态',
  `groupid` int(11) DEFAULT '1' COMMENT '用户角色id',
  `token` varchar(32) COLLATE utf8_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `core_admin`
--

INSERT INTO `core_admin` (`id`, `username`, `password`, `portrait`, `loginnum`, `last_login_ip`, `last_login_time`, `real_name`, `status`, `groupid`, `token`) VALUES
(1, 'admin', 'ebbd202c239d6fc65061ae22a13c1b69', '20161122\\admin.jpg', 305, '112.30.97.201', 1637630453, 'admin', 1, 1, 'cfcd208495d565ef66e7dff9f98764da');

-- --------------------------------------------------------

--
-- 表的结构 `core_ad_position`
--

CREATE TABLE `core_ad_position` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(32) DEFAULT NULL COMMENT '分类名称',
  `orderby` int(11) DEFAULT '100' COMMENT '排序',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_ad_position`
--

INSERT INTO `core_ad_position` (`id`, `name`, `orderby`, `create_time`, `update_time`, `status`) VALUES
(1, '首页轮播', 1, 1477140627, 1518228789, 1),
(25, '内页banner', 11, 1530499756, 1530499756, 1),
(26, '手机banner', 30, 1629185802, 1629185802, 1),
(27, '手机内页banner', 40, 1629186269, 1629186269, 1);

-- --------------------------------------------------------

--
-- 表的结构 `core_article`
--

CREATE TABLE `core_article` (
  `id` int(11) NOT NULL COMMENT '文章逻辑ID',
  `sortnum` int(10) DEFAULT NULL,
  `title` varchar(128) NOT NULL COMMENT '文章标题',
  `admin_id` int(11) DEFAULT '0',
  `website` varchar(200) DEFAULT NULL,
  `cate_id` int(11) NOT NULL DEFAULT '1' COMMENT '文章类别',
  `photo` varchar(200) DEFAULT '' COMMENT '文章图片',
  `video` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bigpic` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `annex` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_title` varchar(200) DEFAULT '' COMMENT '文章描述',
  `keyword` varchar(200) DEFAULT '' COMMENT '文章关键字',
  `description` text,
  `intro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content` text NOT NULL COMMENT '文章内容',
  `views` int(11) NOT NULL DEFAULT '1' COMMENT '浏览量',
  `attribute_ids` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `isTop` int(1) DEFAULT '0' COMMENT '是否推荐',
  `writer` varchar(200) DEFAULT NULL COMMENT '作者',
  `source` varchar(200) DEFAULT NULL,
  `ip` varchar(16) NOT NULL,
  `create_time` int(11) NOT NULL,
  `updata_time` int(11) DEFAULT NULL,
  `peoples` varchar(200) DEFAULT NULL,
  `cases` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `nums` varchar(200) DEFAULT NULL,
  `years` varchar(10) DEFAULT NULL,
  `postname` varchar(200) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `registered` varchar(200) DEFAULT NULL,
  `companies` varchar(200) DEFAULT NULL,
  `area` varchar(200) DEFAULT NULL,
  `bankroll` varchar(200) DEFAULT NULL,
  `price` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表';

--
-- 转存表中的数据 `core_article`
--

INSERT INTO `core_article` (`id`, `sortnum`, `title`, `admin_id`, `website`, `cate_id`, `photo`, `video`, `bigpic`, `annex`, `seo_title`, `keyword`, `description`, `intro`, `content`, `views`, `attribute_ids`, `status`, `isTop`, `writer`, `source`, `ip`, `create_time`, `updata_time`, `peoples`, `cases`, `address`, `nums`, `years`, `postname`, `department`, `registered`, `companies`, `area`, `bankroll`, `price`) VALUES
(347, 10, '共建人口健康生物样本库安徽医科大学与中科美菱达成战略合作', 0, NULL, 85, '20211103/44aae5730165a08084d8a5969ea66cb9.png', NULL, NULL, NULL, '', '', '', NULL, '<p>为助力生物样本库建设，保障人口生命健康。2021年8月13日，安徽医科大学与中科美菱战略合作签约仪式暨共建人口健康生物样本库揭牌仪式在安徽医科大学知行楼（A）一楼会议室举办。安徽医科大学副校长余永强、安徽医科大学出生人口健康教育部重点实验室主任陶芳标、安徽医科大学国有资产管理处处长宋玉梅、安徽医科大学教育基金会秘书长许柏松...</p>', 26, '', 1, 0, '', 'Dahua', '127.0.0.1', 1635901644, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(348, 20, '共建人口健康生物样本库安徽医科大学与中科美菱达成战略合作', 0, NULL, 85, '20211103/4faec6460c03c2a52e8fddf7416ae461.png', NULL, NULL, NULL, '', '', '', NULL, '<p>为助力生物样本库建设，保障人口生命健康。2021年8月13日，安徽医科大学与中科美菱战略合作签约仪式暨共建人口健康生物样本库揭牌仪式在安徽医科大学知行楼（A）一楼会议室举办。安徽医科大学副校长余永强、安徽医科大学出生人口健康教育部重点实验室主任陶芳标、安徽医科大学国有资产管理处处长宋玉梅、安徽医科大学教育基金会秘书长许柏松...</p>', 7, '', 1, 0, '', 'Dahua', '127.0.0.1', 1635906078, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(351, 30, '共建人口健康生物样本库安徽医科大学与中科美菱达成战略合作', 0, NULL, 85, '20211103/3f87d95d251831525e0714f00417e7fc.png', NULL, NULL, NULL, '', '', '', NULL, '<p>为助力生物样本库建设，保障人口生命健康。2021年8月13日，安徽医科大学与中科美菱战略合作签约仪式暨共建人口健康生物样本库揭牌仪式在安徽医科大学知行楼（A）一楼会议室举办。安徽医科大学副校长余永强、安徽医科大学出生人口健康教育部重点实验室主任陶芳标、安徽医科大学国有资产管理处处长宋玉梅、安徽医科大学教育基金会秘书长许柏松...</p>', 10, '', 1, 0, '', 'Dahua', '127.0.0.1', 1635906203, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(352, 40, '共建人口健康生物样本库安徽医科大学与中科美菱达成战略合作', 0, NULL, 85, '20211103/6e85814c5317cfbc68984f785eb06b2b.png', NULL, NULL, NULL, '', '', '', NULL, '<p>为助力生物样本库建设，保障人口生命健康。2021年8月13日，安徽医科大学与中科美菱战略合作签约仪式暨共建人口健康生物样本库揭牌仪式在安徽医科大学知行楼（A）一楼会议室举办。安徽医科大学副校长余永强、安徽医科大学出生人口健康教育部重点实验室主任陶芳标、安徽医科大学国有资产管理处处长宋玉梅、安徽医科大学教育基金会秘书长许柏松...</p>', 17, '', 1, 0, '', 'Dahua', '127.0.0.1', 1635819813, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(354, 20, 'Beauty of manufacturing Award', 1, NULL, 88, '20211119/09b5a3c140d96e1ac4e0a1f36a0b5f79.jpg', NULL, NULL, NULL, '', '', '', NULL, '<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20211119/1637298733960455.png\" title=\"1637298733960455.png\" _src=\"/ueditor/php/upload/image/20211119/1637298733960455.png\" alt=\"image.png\"/></p>', 6, '', 1, 0, '', '', '127.0.0.1', 1635907430, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(355, 30, 'Verified Supplier Certificate', 1, NULL, 88, '20211119/c0c6ce1eb7087ef8fa674a3a7dd366a8.jpg', NULL, NULL, NULL, '', '', '', NULL, '<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20211119/1637298610574130.png\" title=\"1637298610574130.png\" _src=\"/ueditor/php/upload/image/20211119/1637298610574130.png\" alt=\"image.png\"/></p>', 5, '', 1, 0, '', '', '127.0.0.1', 1635907438, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(356, 40, 'Verified Supplier Certificate', 1, NULL, 88, '20211119/b6f1f36387df710bf4cec1b1709ab573.jpg', NULL, NULL, NULL, '', '', '', NULL, '<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20211119/1637298476632162.png\" title=\"1637298476632162.png\" _src=\"/ueditor/php/upload/image/20211119/1637298476632162.png\" alt=\"image.png\"/></p>', 25, '', 1, 0, '', '', '127.0.0.1', 1635907448, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(357, 10, '集团简介', 0, NULL, 86, '', NULL, NULL, NULL, '', '', '', NULL, '<p>为助力生物样本库建设，保障人口生命健康。2021年8月13日，安徽医科大学与中科美菱战略合作签约仪式暨共建人口健康生物样本库揭牌仪式在安徽医科大学知行楼（A）一楼会议室举办。安徽医科大学副校长余永强、安徽医科大学出生人口健康教育部重点实验室主任陶芳标、安徽医科大学国有资产管理处处长宋玉梅、安徽医科大学教育基金会秘书长许柏松...</p>', 3, '', 1, 0, '', '', '127.0.0.1', 1635907620, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(359, 10, 'about_index', 1, NULL, 79, '20211119/61f34f1e40d1fe48f3d933505e9473ef.jpg', NULL, NULL, '2021-11/163728490417786400.mp4', '', '', '', NULL, '<p>&nbsp;Anhui Yuhuan Intelligent Manufacturing Group Co., Ltd., established in 2010, is an enterprise specializingin the R &amp; D, production,</p><p>sales and service of outdoor sports, fitness equipment, mechanical equipment, medical and beauty products.</p><p>The company is located in Hefei City, Anhui Province, with convenient transportation. With strict quality control and considerate customer service,</p><p>our experienced employees can always discuss your requirements to ensure full customer satisfaction.</p>', 1, '', 1, 0, '', '', '127.0.0.1', 1635908100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(367, 10, 'service', 0, NULL, 98, '', NULL, NULL, NULL, '', '', '', NULL, '<p>serviceserviceserviceservice</p>', 0, '', 1, 0, '', '', '127.0.0.1', 1636072381, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(362, 10, 'contactinformation', 0, NULL, 89, '', NULL, NULL, NULL, '', '', '', NULL, '<p>contactinformationcontactinformationcontactinformation</p>', 0, '', 1, 0, '', '', '127.0.0.1', 1635918462, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(365, 10, '3018 desktop mini CNC laser engraving machine', 1, NULL, 95, '20211119/7937f95fa2dcfeeeea1ae7b5e90c5c5a.jpg', NULL, NULL, NULL, '', '', '', '<p class=\"clearfix\" style=\"white-space: normal;\"><strong>No. :</strong></p><p class=\"clearfix\" style=\"white-space: normal;\"><strong>Contact :</strong></p><p style=\"white-space: normal;\">Contact: Ms. Leona<br/>Tel: 0086-519-86183109<br/>Fax: 0086-519-86183064<br/>E-mail: leona@dahuagroup.com.cn</p>', '<p>3018 adopts two engraving modes: laser engraving and spindle engraving. It has a wide range of applications, including wood, leather, acrylic and other non-metallic materials and some metal oxide layers.</p><p>&nbsp;</p><p>High cost performance:</p><p>Many functions, the price is lower than the large-scale machinery on the market; suitable for small and micro enterprises or the initial stage of entrepreneurship</p><p>&nbsp;</p><p>Many industries covered:</p><p>Wooden seal, packing box, metal oxide film nameplate, notebook cover carving, wooden chopsticks carving, etc.</p><p>&nbsp;</p><p>Zero labor cost:</p><p>Fully automatic numerical control operation, computer adjustment of parameters, simple operation;</p><p>&nbsp;</p><p>easy to carry:</p><p>Small size and simple installation; put it in a backpack or suitcase</p><p>&nbsp;</p><p>Place of Origin: China (Mainland)</p><p>Brand Name: HD</p><p>Model: 3018</p><p>Material: Aluminum</p><p>Purpose: Engraving of non-metal and some metal oxide layers</p><p>Size: 450*260*190mm</p><p>Packaging cartons</p><p><br/></p>', 177, '', 1, 0, '', '', '127.0.0.1', 1635997502, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10.00'),
(405, 10, 'Skate', 1, NULL, 103, '20211119/478b7b570f6aff58f74b3cb9f7034a38.jpg', NULL, NULL, NULL, '', '', '', '<p>Contact: Kevin Pan</p><p>Tel: 008617756080563</p><p>WhatsApp：008617756080563</p><p>E-mail: kevin@yuhuan-med.com</p><p><br/></p><p><br/></p>', '<p>Skate Board Longboard Surfskate Direct Custom Skateboard Land Surfskate</p><p>&nbsp;</p><p>Surfskate is a skateboard for surfing on the street! The special front truck allows movements similar to surfing. The turning dynamics of the Surfskate truck allows short and manoeuvrable turns like surfing. Even if you have absolutely nothing to do with surfing: it doesn&#39;t matter. The movements are absolutely intuitive and easy to learn.&nbsp;</p><p>&nbsp;</p><p>Place of Origin:Anhui, China</p><p>Model Number:LS-CX4, LS-CX7,LS-S7</p><p>Size:76cm X 23cm*13cm(customizable）</p><p>Product Name:surfskate</p><p>Max Load:85KG</p><p>Product Weight:3.5KG</p><p>Material::8ply Canadian maple+Alu truck+PU wheels</p><p>Packing:1pcs/ctn</p><p>MOQ:20PCS</p><p>Wheel size:65* 45mm/70*51mm</p><p>Wheel hardness:78A</p><p style=\"text-align: center;\"><br/></p>', 11, '', 1, 0, '', '', '112.30.97.201', 1637285715, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28'),
(368, 10, 'Yh-ef01 hydrofoil', 1, NULL, 97, '20211119/750bf970a1ed547bef404df99a97fbb1.jpg', NULL, NULL, NULL, '', '', '', '<p>No.:&nbsp;YH-EF01</p><p>Contact:Ms.Cathy</p><p>Tel:0086-17756070821</p><p>E-mail：<a href=\"mailto:Cathy@yuhuan-med.com\">Cathy@yuhuan-med.com</a></p><p><br/></p>', '<p><strong>Do you like being on the water, surfing, sailing, kayaking, or windsurfing? If you do, there is a new and faster way of getting around, it&#39;s called the Hydrofoil surfboard / electric foil surfboard.</strong></p><p>&nbsp;</p><p>Amazingly fast, the electric motor of the hydrofoil lifts the surfboard out of the water and lets you cruise with nearly no drag. It&#39;s efficient, as you seemingly glide above the waves at impressive speeds.</p><p>&nbsp;</p><p>Boards Basic Specification:&nbsp;</p><p>&nbsp;</p><p>Engine Controller.</p><p>&nbsp;</p><p>The engine is now with the perfect accelerations, decelerations and speed outlets so you get the most stability out of your ride.</p><p>&nbsp;</p><p>Silent Electric Engine.</p><p>&nbsp;</p><p>Lots of energy in a compact space allows you to travel swiftly through the water without the irritant noise created by gas engines.</p><p>&nbsp;</p><p>Waterproof Hatch.</p><p>&nbsp;</p><p>All the batteries, engine controller, chips and the wires are stored in the waterproof hatch. It&#39;s easily opened to replace the battery.</p><p>&nbsp;</p><p>Control Performance.</p><p>&nbsp;</p><p>The engine is commanded by the controller in your hand. The power will automatically shut off by simply releasing the lever, if submerged in water.</p><p>&nbsp;</p><p>Electric foil surfboard Specification :</p><p>1. Average speed: 25-30 km/hour</p><p>2. Top speed : 40-45 km/hour</p><p>3. Battery charge time :3&nbsp;hours normal charger</p><p>4. Battery lifetime : 70&nbsp;minutes</p><p>5. Powerful lithium battery ( 30Ah ) : rechargeable</p><p>6. Voltage: 48v,30ah</p><p>7. High efficiency electric motor: 3000W</p><p>8. Rotation rate : 5000 rmp</p><p>9. Flying Foil : Full carbon ( patent on design )</p><p>10. Wireless waterproof controller: R/F type.</p><p>11. Safety control system: magnetic blow-out switch</p><p>12. Board Size: 168cm or 210 cm</p><p>13. Board package: 226 x 91 x 24cm</p><p>14. Parts package:105 x 97 x 32cm</p><p>15. Battery package : 41x43x14 cm (sample Separate packing )</p><p>&nbsp;</p><p>&nbsp;</p><p>Package Details</p><p>Packing in high quality plywood cases or cartons based on your requets</p><p>Included Accessories (for one unit)</p><p>1*Board + waterproof hatch;</p><p>1*Lithium battery</p><p>1*Fairwater sleeve + Propeller;</p><p>1*Remote control;</p><p>1*Front Wing + fuselage + Rear Wing;</p><p>1*Motor + mast; 1*Inverter;</p><p>1*Charger; 1*Leash + magnetic switch;</p><p>1*Board bag</p><p>&nbsp;</p><p><br/></p>', 35, '', 1, 0, '', '', '127.0.0.1', 1636073405, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10.00'),
(373, 10, 'Mechanical Equipment', 1, NULL, 91, '20211119/8369ef469699194af537ec55bca937a2.png', NULL, NULL, NULL, '', '', '', NULL, '<p><span style=\"white-space: normal;\">We have also obtained CE and FDA certification, and relevant products have obtained patent certification and intellectual property rights. Our aim is innovation and rights.Our aim ....</span></p>', 0, '', 1, 0, '', '', '127.0.0.1', 1636074531, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(374, 10, 'Land Sport', 1, NULL, 93, '20211119/a0bfd417ae8c77ef1a026592ee0be7bb.png', NULL, NULL, NULL, '', '', '', NULL, '<p><span style=\"white-space: normal;\">We have also obtained CE and FDA certification, and relevant products have obtained patent certification and intellectual property rights. Our aim is innovation and rights.Our aim ....</span></p>', 0, '', 1, 0, '', '', '127.0.0.1', 1636074563, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(375, 10, 'Aquatic Sports', 1, NULL, 96, '20211119/5c44fe870a011956cdd8fc7bbada8bc4.png', NULL, NULL, NULL, '', '', '', '', '<p><span style=\"white-space: normal;\">We have also obtained CE and FDA certification, and relevant products have obtained patent certification and intellectual property rights. Our aim is innovation and rights.Our aim ....</span></p>', 0, '', 1, 0, '', '', '127.0.0.1', 1636074580, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(377, 10, 'Disposable PP reverse wear isolation clothing', 1, NULL, 100, '20211119/fb2a57d3441afbbce03a4168b244044f.jpg', NULL, NULL, NULL, '', '', '', '', '<p><strong>Product Name:Disposable isolation gown level 1 non sterile</strong></p><p><strong>&nbsp;</strong></p><p>Classification:level 1</p><p>&nbsp;</p><p>Intended use:</p><p>Low-fluid exposure environment;dentists’ house,health-care center,Nursing home etc.</p><p>&nbsp;</p><p>Item Code:JH006</p><p>&nbsp;</p><p>Material:PP 30gsm</p><p>&nbsp;</p><p>Size:115(Length)*137(chest)</p><p>120(Length)*140cm(chest)</p><p>Also can be customized</p><p>&nbsp;</p><p>Available Colour:White,Yellow ,Green ,Blue&nbsp;</p><p>&nbsp;</p><p>Style detail:</p><p>&nbsp;Knit Cuffs/Ribbed Cuffs</p><p>Stitched seams</p><p>Back neck closure with velcro or tie closure</p><p><br/></p><p>Characteristics:</p><p>Water pepellent</p><p>Breathable</p><p>Latex-free</p><p>Single use</p><p>&nbsp;</p><p>Approvals:</p><p>93/42EEC (Medical device)</p><p><br/></p>', 42, '', 1, 0, '', '', '127.0.0.1', 1636074707, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10.00'),
(408, 20, 'Disposable protective clothing', 1, NULL, 100, '20211119/c2ed1fc063ed2717e28954b850790735.jpg', NULL, NULL, NULL, '', '', '', '<p><strong>No. </strong><strong>:</strong>JH002</p><p><strong>Contact: </strong>Ms.Ella</p><p>Tel: 0086-1Fax: 0086-13505685030</p><p>E-mail: ella@yuhuan-med.com</p><p><br/></p>', '<p>EN 14126 protective clothing virus non woven type 5 6 disposable protective suit protective coverall</p><p>&nbsp;</p><p>Intended use:</p><p>1.&nbsp;Health care/General hospital room</p><p>2.&nbsp;Maintenance/cleaning/restoration&nbsp;</p><p>3.&nbsp;Foodproduction/agriculture/pharmaceutical industry/ bee keeping/pest control/mining,etc</p><p>&nbsp;</p><p>Material:PP+Microporous 65gsm</p><p>Available Colour:White&nbsp;or Customized</p><p>&nbsp;</p><p>&nbsp;</p><p>Style detail:</p><p>l Hooded elastic cap</p><p>l Half-elastic waist</p><p>l Two-way zipper with seal-able storm flap&nbsp;ends upper the neck.</p><p>l Elastic Cuffs and Ankle</p><p>l Stitched seams&nbsp;with tape</p><p>&nbsp;</p><p>Characteristics:</p><p>l Heavy liquid splash and biological hazards proof</p><p>l High level of comfortable and breath-ability</p><p>l Anti-static or static dissipative</p><p>l One-time use</p><p>&nbsp;</p><p>Approvals:</p><p>l EU 2016/425</p><p>l EN 14126: 2003 / AC: 2004 (TYPE 4-B&nbsp;TYPE 5-B, TYPE 6-B)</p><p>&nbsp;</p><p>l EN 13982-1: 2004 + A1: 2010 (TYPE 5)</p><p>l EN 13034: 2005 + A1: 2009 (TYPE 6)</p><p>l EN 1149-5: 2018</p><p>l EN 13688: 2013</p><p>l CE 0598</p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20211119/1637287123797567.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637287123797567.jpg\" title=\"1637287123797567.jpg\"/></p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20211119/1637287123148982.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637287123148982.jpg\" title=\"1637287123148982.jpg\"/></p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20211119/1637287123710976.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637287123710976.jpg\" title=\"1637287123710976.jpg\"/></p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20211119/1637287123446462.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637287123446462.jpg\" title=\"1637287123446462.jpg\"/></p><p><img src=\"/ueditor/php/upload/image/20211119/1637287123992734.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637287123992734.jpg\" style=\"\" title=\"1637287123992734.jpg\"/></p><p style=\"text-align: center;\"><br/></p>', 15, '', 1, 0, '', '', '112.30.97.201', 1637287017, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10.00'),
(400, 10, 'Machinery device & PEE Products', 1, NULL, 99, '20211119/e7c7455fbe9a7c5e694a920a8bc36bd7.png', NULL, NULL, NULL, '', '', '', NULL, '<p><span style=\"white-space: normal;\">We have also obtained CE and FDA certification, and relevant products have obtained patent certification and intellectual property rights. Our aim is innovation and rights.Our aim ....</span></p>', 1, '', 1, 0, '', '', '127.0.0.1', 1636100428, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(406, 20, 'Yh-es01 electric surfboard', 1, NULL, 97, '20211119/20397750e5e980c7b291422c240a3660.jpg', NULL, NULL, NULL, '', '', '', '<p><strong>No. :</strong>&nbsp;YH-ES01</p><p><strong>Contact :</strong>Cathy Wu</p><p>Tel: +86-17756070821 &nbsp;</p><p>Fax: +86-17756070821</p><p>E-mail: cathy@yuhuan-med.com</p>', '<p><strong>With YH-ES01 Surfboard Electric, there are no more limits--just pure fun.</strong></p><p><strong>&nbsp;</strong></p><p>We have designed the best match of motor, control unit, battery management, and water cooling system, which altogether guarantee the best performance available on the Surfboard Powered.</p><p>&nbsp;lets you cruise with nearly no drag. It&#39;s efficient, as you seemingly glide above the waves at impressive speeds.--everyone simply loves</p><p>we can provide:</p><p>Sample order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>Ready ship&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>Support drop shipping&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>Provide door to door shipping service if you need&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>Complete product qualifications&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>OEM&amp;ODM is available</p><p>&nbsp;</p><p>1.&nbsp;&nbsp;About Power&nbsp;:</p><p>Motor power:10KW</p><p>Motor cooling system :Two-stroke water cooling system</p><p>Max speed :52km/h</p><p>Working time: About 40 minutes</p><p>&nbsp;</p><p>2.&nbsp;&nbsp;About the&nbsp;battery:</p><p>Battery lifecycle :1000 times charge and discharge</p><p>Battery type :Lithium battery</p><p>Battery replacement Fast removeable plug-in battery ,5S finish</p><p>Battery&nbsp;(Voltage/capacity):72V/30A</p><p>Recharging duration: 3-4h</p><p>Battery weight :14kg</p><p>3.&nbsp;&nbsp;About surfboard</p><p>Material: Carbon Fiber Shell</p><p>Max Loading Weight :100kg</p><p>Product total weight: 31kg</p><p>Product size: 175cm*60cm*16.5cm</p><p>Carton size :200cm*70cm*28cm</p><p>Gross weight: 39kg</p><p>Certificates: CE/UN38.3/MSDS test report</p><p>Waterproof rating: IP67</p><p>Warranty: 1 year</p><p>Package: plywood case</p><p style=\"text-align:center\"><img src=\"http://yhjt.cfsite4.ahcfkj.com/ueditor/php/upload/image/20211119/1637286391733106.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637286391733106.jpg\" title=\"1637286391733106.jpg\" style=\"white-space: normal;\"/></p><p style=\"text-align:center\"><img src=\"http://yhjt.cfsite4.ahcfkj.com/ueditor/php/upload/image/20211119/1637286391327052.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637286391327052.jpg\" title=\"1637286391327052.jpg\" style=\"white-space: normal;\"/></p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20211119/1637286391366849.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637286391366849.jpg\" title=\"1637286391366849.jpg\"/></p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20211119/1637286391745236.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637286391745236.jpg\" title=\"1637286391745236.jpg\"/></p><p><br/></p><p><br/></p><p style=\"text-align: center;\"><br/></p>', 24, '', 1, 0, '', '', '112.30.97.201', 1637286261, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(407, 30, 'Yh-gs01 fuel surfboard', 1, NULL, 97, '20211119/07d8fb404201920c118008b0e97abe8a.jpg', NULL, NULL, NULL, '', '', '', '<p><strong>No. ：</strong>YH-GS01&nbsp;</p><p><strong>Contact: </strong>Cathy</p><p>Tel: +86 17756070821&nbsp;&nbsp;</p><p>E-mail: <a href=\"mailto:cathy@yuhuan-med.com\">cathy@yuhuan-med.com</a></p><p><br/></p>', '<p><strong>Gasoline surfboards with two-stroke water-cooled engine</strong> </p><p>Speed and passion, enjoy the entertainment of surfing</p><p>&nbsp;</p><p>DURABLE &amp; HIGH QUALITY</p><p>Made by carbon fiber ,high strength, high modulus, high temperature resistance, corrosion resistance, erosion resistance</p><p>&nbsp;</p><p>Delivery with product manual ,easy to operate.</p><p>&nbsp;</p><p>EASY TO CARRY:&nbsp;</p><p>Lightweight , supplied with a carrying bag</p><p>&nbsp;</p><p>Place of Origin: China (Mainland)</p><p>Model Number:YH-GS01</p><p>Material: &nbsp;carbon fiber</p><p>Usage: surfing &nbsp;</p><p>Size: 1800mm x 600mm x 150mm (out of fin)</p><p>Package: carton&nbsp;</p><p style=\"text-align:center\"><img src=\"http://yhjt.cfsite4.ahcfkj.com/ueditor/php/upload/image/20211119/1637286587225040.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637286587225040.jpg\" title=\"1637286587225040.jpg\" style=\"text-align: center; white-space: normal;\"/></p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20211119/1637286586791143.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637286586791143.jpg\" title=\"1637286586791143.jpg\"/></p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20211119/1637286587653543.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637286587653543.jpg\" title=\"1637286587653543.jpg\"/></p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20211119/1637286587797881.jpg\" _src=\"/ueditor/php/upload/image/20211119/1637286587797881.jpg\" title=\"1637286587797881.jpg\"/></p><p style=\"text-align:center\"><br/></p><p style=\"text-align: center;\"><br/></p>', 4, '', 1, 0, '', '', '112.30.97.201', 1637286460, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `core_article_cate`
--

CREATE TABLE `core_article_cate` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '分类名称',
  `en_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `orderby` int(11) DEFAULT '100' COMMENT '排序',
  `info_state` tinyint(5) NOT NULL DEFAULT '0',
  `website` varchar(200) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `wap_photo` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `wap_website` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pic` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `is_Target` tinyint(2) DEFAULT NULL,
  `is_nav` tinyint(2) DEFAULT NULL,
  `seo_title` text,
  `keyword` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `fields` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `classification_ids` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `catedir` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_bigpic` int(5) DEFAULT '0',
  `is_annex` int(5) DEFAULT '0',
  `is_intro` int(5) DEFAULT '0',
  `is_video` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_piclist` int(5) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_article_cate`
--

INSERT INTO `core_article_cate` (`id`, `name`, `en_name`, `parent_id`, `admin_id`, `orderby`, `info_state`, `website`, `photo`, `wap_photo`, `wap_website`, `pic`, `create_time`, `update_time`, `status`, `is_Target`, `is_nav`, `seo_title`, `keyword`, `description`, `fields`, `classification_ids`, `catedir`, `is_bigpic`, `is_annex`, `is_intro`, `is_video`, `is_piclist`) VALUES
(79, 'About', 'About Us', 0, 0, 10, 1, '', '20211115/261e232e0a913f5bf490d1d7c4dc4a8e.png', NULL, NULL, '', 1635821842, 1636943766, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 1, 0, NULL, 0),
(80, 'Product', 'Product', 0, 0, 20, 2, '', '20211115/db6a5d11c2bf66ee5a0a12bd4b625828.png', NULL, NULL, '', 1635821880, 1636943741, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(81, 'Service', 'Service', 0, 0, 30, 3, '', '20211102/6a5f663dc052deb496d07b7877db3296.png', NULL, NULL, '', 1635821890, 1635910230, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(82, 'News', 'News Information', 0, 0, 40, 1, '', '', NULL, NULL, '', 1635821898, 1635900262, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(83, 'Contact', 'Contact Us', 0, 0, 50, 1, '', '20211102/042829127d11c2eeec98da219707f41e.png', NULL, NULL, '', 1635821910, 1635918435, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(85, 'News', '', 82, 1, 20, 4, '', '20211115/4cc6b09e9c248abd385bab3c3eea7db9.png', NULL, NULL, '', 1635837970, 1637631142, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(86, 'Profile', '', 79, 0, 10, 1, '', '', NULL, NULL, '', 1635843815, 1635907820, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(88, 'Honor', '', 79, 0, 30, 6, '', '', NULL, NULL, '', 1635843842, 1635907227, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(89, 'Contact Information', '', 83, 0, 10, 1, '', '20211115/451e51ae866fd21663002ba41aed8248.png', NULL, NULL, '', 1635916467, 1636943710, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(90, 'Online Message', '', 83, 0, 20, 5, '', '20211115/83bc7ee7f0831540a4efd5e0191f63eb.png', NULL, NULL, '', 1635916484, 1636943717, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(91, 'Mechanical Equipment', '', 80, 1, 10, 2, '', '', NULL, NULL, '', 1635992130, 1637544313, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(93, 'Land Sport', '', 80, 1, 20, 2, '', '', NULL, NULL, '', 1635992161, 1637544285, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(103, 'Land Sport', '', 93, 1, 10, 2, '', '', NULL, NULL, '', 1637285710, 1637544293, 1, NULL, NULL, '', '', '', '20', '', NULL, 0, 0, 1, NULL, 1),
(95, 'Mechanical Equipment', '', 91, 1, 20, 2, '', '', NULL, NULL, '', 1635993468, 1637544332, 1, NULL, NULL, '', '', '', '20', '', NULL, 0, 0, 1, NULL, 1),
(96, 'Aquatic Sports', '', 80, 1, 30, 2, '', '', NULL, NULL, '', 1636018079, 1637286035, 1, NULL, NULL, '', '', '', '20', '', NULL, 0, 0, 1, NULL, 1),
(97, 'Aquatic Sports', '', 96, 1, 10, 2, '', '', NULL, NULL, '', 1636018106, 1637286049, 1, NULL, NULL, '', '', '', '20', '', NULL, 0, 0, 1, NULL, 1),
(98, 'Service', '', 81, 0, 10, 3, '', '20211115/ebd0ed80538b1bf25dca20ff0b564a7d.png', NULL, NULL, '', 1636072372, 1636943694, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(99, 'Medical Epidemic Prevention', '', 80, 1, 40, 2, '', '', NULL, NULL, '', 1636074626, 1637544353, 1, NULL, NULL, '', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(100, 'Medical Epidemic Prevention', '', 99, 1, 10, 2, '', '', NULL, NULL, '', 1636074647, 1637544361, 1, NULL, NULL, '', '', '', '20', '', NULL, 0, 0, 1, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `core_attribute`
--

CREATE TABLE `core_attribute` (
  `id` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `create_time` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `core_auth_group`
--

CREATE TABLE `core_auth_group` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_auth_group`
--

INSERT INTO `core_auth_group` (`id`, `title`, `status`, `rules`, `create_time`, `update_time`) VALUES
(1, '系统管理员', 1, '1,2,3,61,88,89,90,5,6,27,13,14,24,25,26,48,81,82,83,85,87,84,70,91,71,75,92,93,96,97,98,115,116,117', 1446535750, 1520211372),
(2, '内容管理员', 1, '1,2,3,61,94,95,5,6,27,13,14,24,25,26,48,81,82,70,71,75,92,93,96,97,98', 1446535750, 1531301016);

-- --------------------------------------------------------

--
-- 表的结构 `core_auth_group_access`
--

CREATE TABLE `core_auth_group_access` (
  `uid` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_auth_group_access`
--

INSERT INTO `core_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `core_auth_rule`
--

CREATE TABLE `core_auth_rule` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `css` varchar(20) NOT NULL COMMENT '样式',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_auth_rule`
--

INSERT INTO `core_auth_rule` (`id`, `name`, `title`, `type`, `status`, `css`, `condition`, `pid`, `sort`, `create_time`, `update_time`) VALUES
(1, '#', '系统管理', 1, 1, 'fa fa-gear', '', 0, 40, 1446535750, 1477312169),
(2, 'admin/user/index', '用户管理', 1, 1, '', '', 1, 10, 1446535750, 1477312169),
(3, 'admin/role/index', '角色管理', 1, 1, '', '', 1, 20, 1446535750, 1477312169),
(5, '#', '数据库管理', 1, 0, 'fa fa-database', '', 0, 50, 1446535750, 1477312169),
(6, 'admin/data/index', '数据库备份', 1, 0, '', '', 5, 50, 1446535750, 1477312169),
(13, '#', '日志管理', 1, 0, 'fa fa-tasks', '', 0, 60, 1477312169, 1477312169),
(14, 'admin/log/operate_log', '行为日志', 1, 0, '', '', 13, 50, 1477312169, 1477312169),
(24, '#', '文章管理', 1, 1, 'fa fa-paste', '', 0, 20, 1477312169, 1535340122),
(25, 'admin/article/index_cate', '栏目分类', 1, 1, '', '', 24, 10, 1477312260, 1547544024),
(26, 'admin/article/index', '文章列表', 1, 1, '', '', 24, 20, 1477312333, 1535340145),
(27, 'admin/data/import', '数据库还原', 1, 0, '', '', 5, 50, 1477639870, 1477639870),
(48, '#', '广告管理', 1, 1, 'fa fa-image', '', 0, 30, 1477640011, 1477640011),
(81, 'admin/ad/index_position', '广告位', 1, 0, '', '', 48, 50, 1517022329, 1517022329),
(82, 'admin/ad/index', '广告列表', 1, 1, '', '', 48, 50, 1517022352, 1517022352),
(61, 'admin/config/index', '系统配置', 1, 0, '', '', 1, 50, 1479908607, 1527832715),
(70, '#', '会员管理', 1, 0, 'fa fa-user-circle-o', '', 0, 10, 1484103066, 1528095832),
(71, 'admin/member/group', '会员组', 1, 0, '', '', 70, 20, 1484103304, 1528096076),
(75, 'admin/member/index', '会员列表', 1, 0, '', '', 70, 10, 1484103304, 1484103304),
(92, '#', '功能管理', 1, 1, 'fa fa fa-legal', '', 0, 35, 1519872916, 1528098816),
(93, 'admin/message/index', '留言管理', 1, 1, '', '', 92, 20, 1519872954, 1528098912),
(94, 'admin/website/index', '网站配置', 1, 1, '', '', 1, 10, 1527835580, 1527835580),
(95, 'admin/counter/index', '访问统计', 1, 1, '', '', 1, 50, 1527924894, 1527924894),
(100, 'admin/nature/cate', '链接分类', 1, 0, '', '', 92, 50, 1532058065, 1532058065),
(101, 'admin/nature/index', '链接列表', 1, 0, '', '', 92, 50, 1532058093, 1532058093),
(102, '#', '内容批量处理', 1, 1, 'fa fa-legal ', '', 0, 50, 1532081423, 1532081454),
(103, 'admin/batch/batchupload', '信息批量上传', 1, 1, '', '', 102, 1, 1532081526, 1532081526),
(104, 'admin/batch/move', ' 批量转移', 1, 1, '', '', 102, 50, 1532081555, 1532081555),
(105, 'admin/batch/watermark', '批量水印', 1, 1, '', '', 102, 50, 1532081582, 1532081582),
(106, 'admin/batch/replace', '批量替换', 1, 1, '', '', 102, 50, 1532081610, 1532081610),
(107, 'admin/weixin/index', '微信配置', 1, 0, '', '', 1, 50, 1538035879, 1538035879),
(108, 'admin/wx_member/index', '微信会员', 1, 0, '', '', 70, 50, 1542334651, 1542334651),
(109, 'admin/article/article_recycle', '回收站', 1, 1, '', '', 24, 50, 1542961855, 1542961855),
(110, 'admin/querlist/index', '抓取网站数据', 1, 0, '', '', 1, 50, 1547629860, 1547629860),
(111, 'admin/fields/index', '新增新闻字段', 1, 0, '', '', 1, 50, 1557368380, 1557368380),
(112, 'admin/floating/index', '漂浮窗', 1, 0, '', '', 92, 50, 1560993700, 1560993700),
(113, 'admin/online/index', '在线客服', 1, 0, '', '', 92, 50, 1561944795, 1561944795),
(115, '#', '属性管理', 1, 0, 'fa fa-cubes', '', 0, 50, 1583119681, 1583119681),
(116, 'admin/classification/index', '属性分类', 1, 0, '', '', 115, 50, 1583119845, 1583119845),
(117, 'admin/attribute/index', '属性列表', 1, 0, '', '', 115, 50, 1583140434, 1583140434),
(118, 'admin/apply/job_index', '人才招聘', 1, 0, '', '', 92, 50, 1629179481, 1629179481),
(124, 'admin/message/subscribe_index', '订阅管理', 1, 1, '', '', 92, 50, 1636088672, 1636088672),
(125, '#', '订单管理', 1, 1, 'fa fa-file-text-o', '', 0, 30, 1636948261, 1636948396),
(126, 'admin/orders/index', '订单列表', 1, 1, '', '', 125, 50, 1636952379, 1636952379),
(123, 'admin/message/consult_index', '产品咨询', 1, 1, '', '', 92, 50, 1636010281, 1636010628);

-- --------------------------------------------------------

--
-- 表的结构 `core_cate_config`
--

CREATE TABLE `core_cate_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `value` text COMMENT '配置值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_cate_config`
--

INSERT INTO `core_cate_config` (`id`, `name`, `value`) VALUES
(1, 'en_name', '1'),
(2, 'catedir', '0'),
(3, 'website', '1'),
(4, 'photo', '1'),
(5, 'wap_photo', '0'),
(6, 'pic', '1'),
(7, 'info_state', '1'),
(8, 'target', '0'),
(9, 'nav', '0'),
(10, 'other', '1'),
(11, 'pic_list', '1'),
(12, 'wzjl', '0'),
(17, 'wap_website', '0');

-- --------------------------------------------------------

--
-- 表的结构 `core_classification`
--

CREATE TABLE `core_classification` (
  `id` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `style` tinyint(2) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `create_time` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `core_collection`
--

CREATE TABLE `core_collection` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_time` varchar(200) DEFAULT NULL,
  `product_id` int(20) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_collection`
--

INSERT INTO `core_collection` (`id`, `user_id`, `create_time`, `product_id`, `status`) VALUES
(25, 29, '1636945808', 364, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `core_config`
--

CREATE TABLE `core_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `value` text COMMENT '配置值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_config`
--

INSERT INTO `core_config` (`id`, `name`, `value`) VALUES
(1, 'web_site_close', '1'),
(2, 'list_rows', '10'),
(3, 'admin_allow_ip', ''),
(13, 'web_weixin_close', '0'),
(14, 'wap_site_state', '1'),
(15, 'wap_site_domain', '');

-- --------------------------------------------------------

--
-- 表的结构 `core_counter`
--

CREATE TABLE `core_counter` (
  `id` int(10) UNSIGNED NOT NULL,
  `client` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `core_counter`
--

INSERT INTO `core_counter` (`id`, `client`, `source`, `create_time`, `ip`, `state`) VALUES
(101, '电脑端', '', 1637327276, '36.99.136.131', 0),
(99, '电脑端', '', 1637327275, '111.7.100.27', 0),
(100, '电脑端', '', 1637327275, '111.7.100.22', 0),
(98, '电脑端', '', 1637327275, '111.7.100.25', 0),
(97, '电脑端', '', 1637327275, '36.99.136.137', 0),
(96, '电脑端', '', 1637327275, '36.99.136.132', 0),
(94, '电脑端', '', 1637327266, '36.99.136.139', 0),
(95, '电脑端', '', 1637327266, '36.99.136.138', 0),
(93, '电脑端', 'http://112.29.174.22:8888/', 1637308662, '112.30.97.201', 0),
(92, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/', 1637303583, '61.151.178.180', 0),
(91, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/83.html', 1637303582, '61.151.178.164', 0),
(90, '电脑端', 'http://112.29.174.22:8888/', 1637303519, '36.7.69.84', 0),
(89, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/97.html', 1637303518, '112.30.97.201', 0),
(88, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/detail/id/346.html', 1637302979, '101.91.60.90', 0),
(87, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/82.html', 1637302896, '61.151.178.164', 0),
(86, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/80.html', 1637302842, '101.91.60.90', 0),
(85, '电脑端', '', 1637302697, '36.7.69.84', 0),
(84, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/80.html', 1637302645, '61.151.207.141', 0),
(83, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/', 1637302455, '101.89.29.78', 0),
(82, '电脑端', 'https://exmail.qq.com/', 1637302443, '101.89.239.238', 0),
(81, '电脑端', 'https://exmail.qq.com/', 1637299737, '61.151.178.217', 0),
(80, '电脑端', 'https://exmail.qq.com/', 1637299677, '36.7.69.84', 0),
(78, '电脑端', '', 1637298509, '27.115.124.6', 0),
(79, '电脑端', 'http://baidu.com/', 1637298509, '27.115.124.45', 0),
(77, '电脑端', 'http://baidu.com/', 1637298507, '42.236.10.75', 0),
(75, '电脑端', '', 1637298494, '180.163.220.4', 0),
(76, '电脑端', '', 1637298502, '42.236.10.75', 0),
(74, '电脑端', 'http://baidu.com/', 1637298473, '27.115.124.70', 0),
(73, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/', 1637298284, '112.30.97.201', 0),
(72, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/93.html', 1637287862, '112.30.97.201', 0),
(71, '电脑端', '', 1637283852, '112.30.97.201', 0),
(70, '电脑端', 'http://112.29.174.22:8888/', 1637283359, '112.30.97.201', 0),
(69, '手机端', 'http://yhjt.cfsite4.ahcfkj.com/mobile/member/myorder?status=1', 1637228946, '117.70.162.35', 0),
(67, '手机端', '', 1637224690, '117.70.162.35', 0),
(68, '手机端', '', 1637226048, '117.70.189.20', 0),
(65, '手机端', '', 1637224632, '61.151.206.17', 0),
(66, '手机端', '', 1637224643, '61.151.178.217', 0),
(64, '手机端', '', 1637224632, '61.151.178.177', 0),
(63, '手机端', '', 1637224630, '61.151.207.205', 0),
(62, '手机端', '', 1637224611, '61.151.207.158', 0),
(61, '手机端', '', 1637224610, '61.151.178.197', 0),
(60, '手机端', '', 1637224608, '61.151.207.141', 0),
(59, '手机端', '', 1637224560, '101.89.239.120', 0),
(58, '电脑端', '', 1637224504, '223.167.152.22', 0),
(57, '电脑端', '', 1637224504, '223.167.152.22', 0),
(55, '电脑端', '', 1637224504, '120.204.17.69', 0),
(56, '电脑端', '', 1637224504, '120.204.17.69', 0),
(54, '电脑端', '', 1637224503, '183.192.164.79', 0),
(52, '电脑端', '', 1637224503, '223.167.152.113', 0),
(53, '电脑端', '', 1637224503, '223.167.152.113', 0),
(51, '手机端', '', 1637224503, '112.30.97.201', 0),
(49, '手机端', '', 1637223738, '117.70.162.35', 0),
(50, '手机端', '', 1637224381, '112.30.97.201', 0),
(48, '电脑端', 'http://112.29.174.22:8888/', 1637221656, '112.30.97.201', 0),
(46, '电脑端', '', 1637207760, '61.151.207.158', 0),
(47, '电脑端', 'http://112.29.174.22:8888/', 1637211051, '112.30.97.201', 0),
(45, '电脑端', 'http://112.29.174.22:8888/', 1637207005, '112.30.97.201', 0),
(44, '电脑端', '', 1637152598, '117.71.58.176', 0),
(42, '电脑端', '', 1637152588, '223.167.152.113', 0),
(43, '电脑端', '', 1637152590, '223.166.151.234', 0),
(41, '电脑端', '', 1637152588, '223.167.152.84', 0),
(40, '电脑端', '', 1637152588, '223.167.152.20', 0),
(38, '电脑端', '', 1637152587, '120.204.17.69', 0),
(39, '电脑端', '', 1637152587, '120.204.17.69', 0),
(37, '电脑端', '', 1637152587, '120.204.17.69', 0),
(36, '电脑端', '', 1637152587, '120.204.17.69', 0),
(35, '电脑端', '', 1637152587, '120.204.17.69', 0),
(34, '电脑端', '', 1637152587, '112.32.35.132', 0),
(33, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/80.html', 1637148602, '117.71.58.176', 0),
(32, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/81.html', 1637139708, '112.30.97.201', 0),
(31, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/82.html', 1637135172, '112.30.97.201', 0),
(30, '电脑端', '', 1637128209, '117.71.58.176', 0),
(28, '电脑端', '', 1637127879, '112.32.101.7', 0),
(29, '电脑端', '', 1637128070, '117.71.58.176', 0),
(27, '电脑端', '', 1637127208, '117.71.58.176', 0),
(26, '电脑端', '', 1637127157, '117.71.58.176', 0),
(25, '电脑端', '', 1637127143, '117.71.58.176', 0),
(24, '电脑端', '', 1637127141, '11.186.123.154', 0),
(23, '电脑端', '', 1637127141, '113.96.232.116', 0),
(22, '电脑端', '', 1637127109, '61.151.207.158', 0),
(20, '电脑端', '', 1637127050, '117.71.58.176', 0),
(21, '电脑端', '', 1637127085, '117.71.58.176', 0),
(19, '电脑端', '', 1637127045, '117.71.58.176', 0),
(18, '电脑端', '', 1637127006, '117.71.58.176', 0),
(17, '电脑端', '', 1637126979, '11.186.122.21', 0),
(16, '电脑端', '', 1637126979, '61.151.206.17', 0),
(15, '电脑端', '', 1637126417, '117.71.58.176', 0),
(14, '电脑端', '', 1637126344, '180.163.220.68', 0),
(13, '电脑端', '', 1637126333, '42.236.10.75', 0),
(12, '电脑端', 'http://baidu.com/', 1637126316, '42.236.10.106', 0),
(10, '电脑端', '', 1637126311, '42.236.10.125', 0),
(11, '电脑端', '', 1637126314, '112.30.97.201', 0),
(9, '电脑端', '', 1637126299, '61.151.178.163', 0),
(8, '电脑端', '', 1637126271, '117.71.58.176', 0),
(7, '电脑端', '', 1637126245, '117.71.58.176', 0),
(6, '电脑端', '', 1637126244, '117.71.57.33', 0),
(5, '电脑端', '', 1637126237, '61.151.207.112', 0),
(4, '电脑端', '', 1637126172, '112.30.97.201', 0),
(2, '电脑端', 'http://112.29.174.22:8888/', 1637053280, '112.30.97.201', 0),
(3, '电脑端', 'http://112.29.174.22:8888/', 1637126143, '112.30.97.201', 0),
(1, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/member/confirm.html', 1637038490, '112.30.97.201', 0),
(102, '电脑端', '', 1637327276, '36.99.136.137', 0),
(103, '电脑端', '', 1637327276, '111.7.100.27', 0),
(104, '电脑端', '', 1637327276, '111.7.100.21', 0),
(105, '电脑端', '', 1637327276, '111.7.100.25', 0),
(106, '电脑端', '', 1637327276, '111.7.100.24', 0),
(107, '电脑端', '', 1637327277, '111.7.100.23', 0),
(108, '电脑端', '', 1637327280, '111.7.100.24', 0),
(109, '电脑端', '', 1637327281, '111.7.100.27', 0),
(110, '电脑端', '', 1637327287, '36.99.136.136', 0),
(111, '电脑端', '', 1637327288, '36.99.136.132', 0),
(112, '电脑端', '', 1637327289, '111.7.100.25', 0),
(113, '电脑端', '', 1637327291, '111.7.100.21', 0),
(114, '电脑端', '', 1637327292, '36.99.136.136', 0),
(115, '电脑端', '', 1637327297, '111.7.100.27', 0),
(116, '电脑端', '', 1637327304, '36.99.136.132', 0),
(117, '电脑端', '', 1637327306, '111.7.100.25', 0),
(118, '电脑端', '', 1637327306, '36.99.136.132', 0),
(119, '电脑端', '', 1637327310, '111.7.100.24', 0),
(120, '电脑端', '', 1637327314, '36.99.136.137', 0),
(121, '电脑端', '', 1637327317, '111.7.100.22', 0),
(122, '电脑端', '', 1637327328, '36.99.136.136', 0),
(123, '电脑端', '', 1637327336, '111.7.100.24', 0),
(124, '电脑端', '', 1637330057, '111.7.100.22', 0),
(125, '电脑端', '', 1637330148, '111.7.100.20', 0),
(126, '电脑端', '', 1637337714, '8.217.34.68', 0),
(127, '电脑端', '', 1637355368, '42.157.129.131', 0),
(128, '手机端', '', 1637387702, '117.71.58.176', 0),
(129, '手机端', '', 1637387765, '117.71.58.176', 0),
(130, '手机端', '', 1637387862, '61.151.207.141', 0),
(131, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/83.html', 1637391816, '117.71.58.176', 0),
(132, '手机端', '', 1637406667, '39.144.38.251', 0),
(133, '电脑端', 'http://112.29.174.22:8888/', 1637541403, '112.30.97.201', 0),
(134, '电脑端', '', 1637541892, '120.209.143.11', 0),
(135, '电脑端', 'https://exmail.qq.com/', 1637542674, '36.7.69.84', 0),
(136, '电脑端', 'https://exmail.qq.com/', 1637542734, '61.151.207.158', 0),
(137, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/80.html', 1637542841, '101.89.239.120', 0),
(138, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/detail/id/365.html', 1637543015, '101.91.62.89', 0),
(139, '电脑端', '', 1637543984, '112.30.97.201', 0),
(140, '电脑端', '', 1637544044, '61.151.178.163', 0),
(141, '手机端', '', 1637544068, '112.30.97.201', 0),
(142, '电脑端', '', 1637544122, '117.71.58.176', 0),
(143, '电脑端', '', 1637544192, '61.151.207.141', 0),
(144, '电脑端', '', 1637544332, '101.91.62.89', 0),
(145, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/83.html', 1637545016, '112.30.97.201', 0),
(146, '电脑端', 'http://112.29.174.22:8888/', 1637546527, '36.7.69.84', 0),
(147, '电脑端', '', 1637546870, '120.209.143.14', 0),
(148, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/cfwl_system.php', 1637548637, '112.30.97.201', 0),
(149, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/', 1637549605, '61.151.178.164', 0),
(150, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/83.html', 1637549667, '101.91.62.89', 0),
(151, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/83.html', 1637550288, '36.7.69.84', 0),
(152, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/83.html', 1637550347, '101.89.239.245', 0),
(153, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/category/index/id/80.html', 1637550370, '101.91.60.104', 0),
(154, '手机端', '', 1637551927, '220.205.232.149', 0),
(155, '手机端', '', 1637551983, '101.89.239.120', 0),
(156, '手机端', '', 1637552005, '101.89.29.78', 0),
(157, '手机端', '', 1637552022, '61.151.178.163', 0),
(158, '手机端', '', 1637552230, '101.89.239.238', 0),
(159, '手机端', '', 1637552239, '61.151.178.163', 0),
(160, '手机端', 'http://yhjt.cfsite4.ahcfkj.com/mobile/member/login', 1637552242, '112.30.97.201', 0),
(161, '手机端', '', 1637552248, '61.151.178.163', 0),
(162, '手机端', '', 1637552260, '61.151.178.217', 0),
(163, '手机端', '', 1637552261, '101.89.19.197', 0),
(164, '手机端', '', 1637552270, '101.89.239.245', 0),
(165, '手机端', '', 1637552274, '61.151.207.141', 0),
(166, '电脑端', '', 1637552543, '112.30.97.201', 0),
(167, '电脑端', '', 1637552566, '112.30.97.201', 0),
(168, '电脑端', '', 1637552583, '27.115.124.109', 0),
(169, '电脑端', 'http://baidu.com/', 1637552583, '27.115.124.38', 0),
(170, '电脑端', 'http://baidu.com/', 1637552654, '27.115.124.70', 0),
(171, '电脑端', 'http://baidu.com/', 1637552677, '42.236.10.106', 0),
(172, '电脑端', '', 1637552708, '180.163.220.67', 0),
(173, '电脑端', 'http://baidu.com/', 1637552708, '180.163.220.67', 0),
(174, '手机端', 'http://yhjt.cfsite4.ahcfkj.com/mobile', 1637552779, '101.89.239.245', 0),
(175, '手机端', 'http://yhjt.cfsite4.ahcfkj.com/mobile', 1637552781, '61.151.178.217', 0),
(176, '手机端', 'http://yhjt.cfsite4.ahcfkj.com/mobile/index/index.html', 1637552795, '61.151.207.205', 0),
(177, '手机端', 'http://yhjt.cfsite4.ahcfkj.com/mobile/category/index/id/91.html', 1637552822, '101.91.60.90', 0),
(178, '电脑端', '', 1637552908, '120.204.17.69', 0),
(179, '手机端', '', 1637552986, '101.91.60.104', 0),
(180, '电脑端', '', 1637553015, '61.151.182.118', 0),
(181, '手机端', '', 1637553016, '61.151.206.26', 0),
(182, '手机端', '', 1637553076, '101.89.29.78', 0),
(183, '手机端', '', 1637553148, '117.71.58.176', 0),
(184, '电脑端', '', 1637553336, '117.71.58.176', 0),
(185, '电脑端', '', 1637553430, '101.91.62.89', 0),
(186, '手机端', 'http://yhjt.cfsite4.ahcfkj.com/mobile/category/index/id/97.html', 1637556715, '112.30.97.201', 0),
(187, '电脑端', '', 1637558568, '117.71.58.176', 0),
(188, '电脑端', 'http://112.29.174.22:8888/', 1637562308, '112.30.97.201', 0),
(189, '电脑端', '', 1637563489, '120.209.143.16', 0),
(190, '电脑端', 'http://112.29.174.22:8888/', 1637569453, '112.30.97.201', 0),
(191, '电脑端', '', 1637629421, '117.71.58.176', 0),
(192, '电脑端', 'http://112.29.174.22:8888/', 1637630095, '112.30.97.201', 0),
(193, '电脑端', 'http://yhjt.cfsite4.ahcfkj.com/home/index/index.html', 1637633696, '112.30.97.201', 0);

-- --------------------------------------------------------

--
-- 表的结构 `core_floating`
--

CREATE TABLE `core_floating` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `link_url` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `ad_position` int(10) DEFAULT NULL,
  `mode` varchar(200) DEFAULT NULL,
  `width` int(10) DEFAULT NULL,
  `height` int(10) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL COMMENT '开始时间',
  `end_date` int(11) DEFAULT NULL COMMENT '结束时间',
  `asidetop` int(10) DEFAULT NULL,
  `asideleft` int(10) DEFAULT NULL,
  `screen_time` int(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '状态',
  `closed` tinyint(1) DEFAULT '0',
  `orderby` tinyint(3) DEFAULT '100'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_floating`
--

INSERT INTO `core_floating` (`id`, `title`, `link_url`, `photo`, `ad_position`, `mode`, `width`, `height`, `start_date`, `end_date`, `asidetop`, `asideleft`, `screen_time`, `status`, `closed`, `orderby`) VALUES
(2, 'cs', '1', '20190617/a62340fa5774f3c35b05ab6c40300f62.png', 1, 'hangL', 150, 150, 1559318400, 1564502400, 200, 5, 4, 0, 1, 10);

-- --------------------------------------------------------

--
-- 表的结构 `core_job`
--

CREATE TABLE `core_job` (
  `id` int(10) UNSIGNED NOT NULL,
  `cateId` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `sortnum` int(10) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `graduate_time` varchar(50) DEFAULT NULL,
  `college` varchar(50) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `resumes` text,
  `appraise` text,
  `create_time` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `birthday` varchar(100) DEFAULT NULL,
  `major` varchar(50) DEFAULT NULL,
  `cate_name` varchar(50) DEFAULT NULL,
  `annex` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `core_log`
--

CREATE TABLE `core_log` (
  `log_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `admin_name` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `description` varchar(300) DEFAULT NULL COMMENT '描述',
  `ip` char(60) DEFAULT NULL COMMENT 'IP地址',
  `status` tinyint(1) DEFAULT NULL COMMENT '1 成功 2 失败',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_log`
--

INSERT INTO `core_log` (`log_id`, `admin_id`, `admin_name`, `description`, `ip`, `status`, `add_time`) VALUES
(1, 1, 'admin', '用户【admin】登录成功', '112.30.97.201', 1, 1637033278),
(2, 1, 'admin', '用户【admin】登录成功', '112.30.97.201', 1, 1637033350),
(3, 1, 'admin', '用户【admin】登录成功', '112.30.97.201', 1, 1637283539),
(4, 1, 'admin', '用户【admin】登录成功', '112.30.97.201', 1, 1637283956),
(5, 1, 'admin', '用户【admin】登录成功', '112.30.97.201', 1, 1637284484),
(6, 1, 'admin', '用户【admin】登录成功', '112.30.97.201', 1, 1637544225),
(7, 1, 'admin', '用户【admin】登录成功', '112.30.97.201', 1, 1637630250),
(8, 1, 'admin', '用户【admin】登录成功', '112.30.97.201', 1, 1637630453);

-- --------------------------------------------------------

--
-- 表的结构 `core_member`
--

CREATE TABLE `core_member` (
  `id` int(10) UNSIGNED NOT NULL,
  `account` varchar(32) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `sex` int(10) DEFAULT NULL COMMENT '1男2女',
  `password` char(32) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `head_img` varchar(200) DEFAULT NULL,
  `realname` varchar(32) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL COMMENT '认证的手机号码',
  `create_time` int(11) DEFAULT '0' COMMENT '注册时间',
  `login_num` varchar(15) DEFAULT NULL COMMENT '登录次数',
  `status` tinyint(1) DEFAULT NULL COMMENT '1正常  0 禁用'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_member`
--

INSERT INTO `core_member` (`id`, `account`, `email`, `sex`, `password`, `group_id`, `head_img`, `realname`, `mobile`, `create_time`, `login_num`, `status`) VALUES
(30, NULL, '1297282206@qq.com', NULL, '5bfc85c9b3f7875b64d8a7cf91c14651', 1, NULL, NULL, NULL, 1636969171, '5', 1),
(35, NULL, '123123321@qq.com', NULL, '1eec2d6cd573dfaea338d55ec1b9097d', 1, NULL, NULL, NULL, 1637053297, '0', 1),
(29, NULL, '11222@qq.com', NULL, '1eec2d6cd573dfaea338d55ec1b9097d', 1, NULL, NULL, NULL, 1636435846, '36', 1),
(34, NULL, '576733974@qq.com', NULL, '315959ad89fca1fcb7595b5200bf0719', 1, NULL, NULL, NULL, 1637030072, '1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `core_member_group`
--

CREATE TABLE `core_member_group` (
  `id` int(11) NOT NULL COMMENT '留言Id',
  `group_name` varchar(32) NOT NULL COMMENT '留言评论作者',
  `status` tinyint(1) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL COMMENT '留言回复时间',
  `update_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章评论表';

--
-- 转存表中的数据 `core_member_group`
--

INSERT INTO `core_member_group` (`id`, `group_name`, `status`, `create_time`, `update_time`) VALUES
(1, '普通会员', 1, 1441616559, 1528097175),
(2, '高级会员', 1, 1441617195, 1528097192),
(3, 'VIP会员', 1, 1441769224, 1528097200);

-- --------------------------------------------------------

--
-- 表的结构 `core_message`
--

CREATE TABLE `core_message` (
  `id` int(10) UNSIGNED NOT NULL,
  `sortnum` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `fax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `topic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reply` text COLLATE utf8_unicode_ci,
  `create_time` int(11) NOT NULL,
  `ip` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `firstname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isMessage` int(2) DEFAULT NULL,
  `isSubscribe` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `core_message`
--

INSERT INTO `core_message` (`id`, `sortnum`, `name`, `phone`, `email`, `content`, `fax`, `topic`, `address`, `company`, `reply`, `create_time`, `ip`, `state`, `status`, `firstname`, `lastname`, `product`, `isMessage`, `isSubscribe`) VALUES
(108, 80, 'lisi', NULL, '11222@qq.com', 'mess', NULL, 'subj', NULL, NULL, NULL, 1637550535, '112.30.97.201', 1, 1, NULL, NULL, 'Disposable PP reverse wear isolation clothing', 0, NULL),
(101, 10, 'g', '13625641234', '1297282206@qq.com', 'first message content', '0554', 'first message', '安徽合肥', 'yhjt', NULL, 1637033424, '112.30.97.201', 1, 1, NULL, NULL, NULL, 1, NULL),
(107, 70, 'zhangs', NULL, '11222@qq.com', 'content', NULL, 'sub', NULL, NULL, NULL, 1637545964, '112.30.97.201', 1, 1, NULL, NULL, '3018 desktop mini CNC laser engraving machine', 0, NULL),
(104, 40, NULL, NULL, 'abel@yuhuan-med.com', NULL, NULL, NULL, NULL, NULL, NULL, 1637391814, '117.71.58.176', 0, 1, NULL, NULL, NULL, NULL, 1),
(105, 50, NULL, NULL, 'abel@yuhuan-med.com', NULL, NULL, NULL, NULL, NULL, NULL, 1637391818, '117.71.58.176', 0, 1, NULL, NULL, NULL, NULL, 1),
(106, 60, 'iohy', NULL, '1297282206@qq.com', '1', NULL, '1', NULL, NULL, NULL, 1637545635, '112.30.97.201', 1, 1, NULL, NULL, '3018 desktop mini CNC laser engraving machine', 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `core_nature`
--

CREATE TABLE `core_nature` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pic` varchar(200) DEFAULT NULL,
  `url` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nature_id` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL DEFAULT '0',
  `create_time` varchar(200) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `core_nature`
--

INSERT INTO `core_nature` (`id`, `name`, `pic`, `url`, `nature_id`, `sortnum`, `create_time`, `status`) VALUES
(1, '百度', '', 'http://www.baidu.com', 1, 10, '1547620706', 1);

-- --------------------------------------------------------

--
-- 表的结构 `core_nature_cate`
--

CREATE TABLE `core_nature_cate` (
  `id` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `core_nature_cate`
--

INSERT INTO `core_nature_cate` (`id`, `sortnum`, `name`) VALUES
(1, 1, '友情链接');

-- --------------------------------------------------------

--
-- 表的结构 `core_online_config`
--

CREATE TABLE `core_online_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `value` text COMMENT '配置值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_online_config`
--

INSERT INTO `core_online_config` (`id`, `name`, `value`) VALUES
(1, 'status', '0'),
(2, 'position', 'right'),
(3, 'show_btn', '1'),
(4, 'topSpace', '200'),
(5, 'width', '160'),
(6, 'bgcolor', '#FFFFFF'),
(8, 'title', '在线客服'),
(9, 'qrcode', NULL),
(10, 'content', '<p style=\"text-align: center;\">联系电话</p><h6 style=\"text-align: center;\"><strong><span style=\"font-size: 16px;\">18600588099</span></strong></h6>'),
(7, 'serviceLine', ''),
(11, 'titcolor', '#FFFFFF'),
(12, 'titbgcolor', '#262626'),
(13, 'color', '#555555'),
(14, 'is_open', '0');

-- --------------------------------------------------------

--
-- 表的结构 `core_online_list`
--

CREATE TABLE `core_online_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `sortnum` int(10) UNSIGNED NOT NULL,
  `number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_icon` int(10) UNSIGNED NOT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `core_online_list`
--

INSERT INTO `core_online_list` (`id`, `sortnum`, `number`, `name`, `show_icon`, `state`) VALUES
(1, 1, '26216125', '在线客服', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `core_orders`
--

CREATE TABLE `core_orders` (
  `id` int(11) NOT NULL,
  `order_num` varchar(33) DEFAULT NULL,
  `product_ids` varchar(100) DEFAULT NULL,
  `cart_ids` varchar(100) DEFAULT NULL,
  `create_time` varchar(100) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `update_time` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_orders`
--

INSERT INTO `core_orders` (`id`, `order_num`, `product_ids`, `cart_ids`, `create_time`, `total`, `address`, `status`, `update_time`, `user_id`) VALUES
(50, '2021112255975710', '365', '325', '1637562695', '10.00', '{\"id\":75,\"user_id\":29,\"email\":\"11222@qq.com\",\"name\":\"wangwu\",\"address\":\"\\u5b89\\u5fbd\\u5408\\u80a5\",\"postcode\":625735,\"phone_kind\":\"\",\"phone\":\"13625641234\",\"create_time\":\"2021-11-22 14:31:25\",\"is_default\":1,\"sex\":null}', 0, NULL, 29),
(48, '2021111853999710', '365,377', '316,320', '1637214325', '70.00', '{\"id\":69,\"user_id\":29,\"email\":\"2252098231@qq.com\",\"name\":\"1111\",\"address\":\"\\u5b89\\u5fbd\\u5408\\u80a5\",\"postcode\":625735,\"phone_kind\":\"\",\"phone\":\"13625641234\",\"create_time\":\"2021-11-15 11:23:59\",\"is_default\":1,\"sex\":\"\"}', 0, NULL, 29),
(49, '2021112210110155', '365', '324', '1637562430', '50.00', '{\"id\":67,\"user_id\":29,\"email\":\"2252098231@qq.com\",\"name\":\"iohy22222222\",\"address\":\"\\u5b89\\u5fbd\\u5408\\u80a5\",\"postcode\":625735,\"phone_kind\":\"\",\"phone\":\"13625641234\",\"create_time\":\"2021-11-15 11:22:14\",\"is_default\":1,\"sex\":\"\"}', 0, NULL, 29),
(51, '2021112251569810', '365', '326', '1637562803', '40.00', '{\"id\":75,\"user_id\":29,\"email\":\"11222@qq.com\",\"name\":\"wangwu\",\"address\":\"\\u5b89\\u5fbd\\u5408\\u80a5\",\"postcode\":625735,\"phone_kind\":\"\",\"phone\":\"13625641234\",\"create_time\":\"2021-11-22 14:31:25\",\"is_default\":1,\"sex\":null}', 0, NULL, 29),
(52, '2021112299101565', '365,405,408', '327,328,329', '1637563276', '68.00', '{\"id\":75,\"user_id\":29,\"email\":\"11222@qq.com\",\"name\":\"wangwu\",\"address\":\"\\u5b89\\u5fbd\\u5408\\u80a5\",\"postcode\":625735,\"phone_kind\":\"\",\"phone\":\"13625641234\",\"create_time\":\"2021-11-22 14:31:25\",\"is_default\":1,\"sex\":null}', 0, NULL, 29),
(53, '2021112248555097', '365,406', '330,331', '1637563840', '50.00', '{\"id\":75,\"user_id\":29,\"email\":\"11222@qq.com\",\"name\":\"wangwu\",\"address\":\"\\u5b89\\u5fbd\\u5408\\u80a5\",\"postcode\":625735,\"phone_kind\":\"\",\"phone\":\"13625641234\",\"create_time\":\"2021-11-22 14:31:25\",\"is_default\":1,\"sex\":null}', 0, NULL, 29),
(54, '2021112298505197', '365,406,408', '332,333,334', '1637564283', '60.00', '{\"id\":75,\"user_id\":29,\"email\":\"11222@qq.com\",\"name\":\"wangwu\",\"address\":\"\\u5b89\\u5fbd\\u5408\\u80a5\",\"postcode\":625735,\"phone_kind\":\"\",\"phone\":\"13625641234\",\"create_time\":\"2021-11-22 14:31:25\",\"is_default\":1,\"sex\":null}', 0, NULL, 29);

-- --------------------------------------------------------

--
-- 表的结构 `core_pic_catelist`
--

CREATE TABLE `core_pic_catelist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `sortnum` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `url` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `core_pic_list`
--

CREATE TABLE `core_pic_list` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `sortnum` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `url` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `core_pic_list`
--

INSERT INTO `core_pic_list` (`id`, `product_id`, `article_id`, `sortnum`, `title`, `pic`, `url`) VALUES
(12, 0, 275, 1, '20190249471115964', '20211020/3cc1d7d37d48ab99d02d77e108f735d8.jpg', ''),
(13, 0, 275, 2, '1550645600617', '20211020/b5557451674e8474790a23af2e26853a.jpg', ''),
(14, 0, 275, 3, '1550645608084', '20211020/3e8e0742ebf5195fd0990b1a1f29e53a.jpg', ''),
(15, 0, 277, 1, '20190170284213136', '20211021/f937f9e1f923f3b7f5cefa6b3a9f6e68.jpg', ''),
(17, 0, 277, 3, '20190160410213136', '20211021/65298b1c75a7cbb524fe0358ef564574.jpg', ''),
(36, NULL, 365, 2, '微信图片_20211117170548', '20211119/f1a96e09c5b35bf9ea214988298b5e1e.jpg', ''),
(35, NULL, 365, 1, '微信图片_20211117170544', '20211119/f3b4732885ac6b2805a6a9da1767f1d2.jpg', ''),
(23, NULL, 366, 1, 'carts', '20211105/c9221990fa4866b504fae1b58fe1ec6f.png', ''),
(24, NULL, 366, 2, 'details', '20211105/8c8a0306bb29a6752cd4366c5e5643fb.png', ''),
(25, NULL, 366, 3, 'product', '20211105/2f82161e52538c66e993bc6bcfc72edd.jpg', ''),
(48, NULL, 368, 3, '3', '20211119/19c758f69de24344b5a147006930c4c4.jpg', ''),
(47, NULL, 368, 2, '1', '20211119/e862f69931bf9e28afeb2115951304fa.jpg', ''),
(46, NULL, 368, 1, '2 ', '20211119/022eb50291fe3bdfffdc2dace4066b8e.jpg', ''),
(32, NULL, 378, 1, 'carts', '20211105/eb1419f676a5cd9dfd9fea4ff5d558d8.png', ''),
(33, NULL, 378, 2, 'details', '20211105/541b9d0324bb8fdea1d46850e6c74beb.png', ''),
(34, NULL, 378, 3, 'product', '20211105/2e7e660f2bfb4925f1782ee41a1e5817.jpg', ''),
(37, NULL, 365, 3, '微信图片_20211117170552', '20211119/886bf44b5465432f53317578b2e9138b.jpg', ''),
(38, NULL, 365, 4, '微信图片_20211117170558', '20211119/c8683af07a6fb28a4a367068645bfaa2.jpg', ''),
(39, NULL, 405, 1, '1_06', '20211119/4c4038c0bb6230da03b76979160aa226.jpg', ''),
(40, NULL, 405, 2, '1_01', '20211119/4208ab045c3cd1bbffdd9ebf59a2219e.jpg', ''),
(41, NULL, 405, 3, '55', '20211119/f8c72bb2e0328c3222200ad280a703b4.jpg', ''),
(42, NULL, 405, 4, '800_20_15', '20211119/8e3dd14ebc886af28fd7060e57404cb2.jpg', ''),
(43, NULL, 405, 5, 'cx4 02', '20211119/aa8064794e5f44efbd27572df6a946d1.jpg', ''),
(44, NULL, 405, 6, '2 (14)', '20211119/14a01b5e830e5ecd0a8e603474a57d5d.jpg', ''),
(45, NULL, 405, 7, 'cx4 truck', '20211119/db5f9f3fdc75668e1f41d1ae03ebe624.jpg', ''),
(49, NULL, 377, 1, '2 (2)', '20211119/52ed57ce5ac725e565eb9f3763e09b0d.jpg', ''),
(50, NULL, 377, 2, '2 (3)', '20211119/8271b4c8e5e7e73e1e49a2eb27633817.jpg', ''),
(51, NULL, 377, 3, '15x750_12', '20211119/c44a2a8107720acf331c9e11893dd336.jpg', ''),
(52, NULL, 377, 4, '15x750_09', '20211119/b6082c8d0a48f42040f7ecc5b8f0ccbb.jpg', ''),
(53, NULL, 377, 5, '15x750_06', '20211119/f82bfdbcc3ce7967aabfdbb91a738feb.jpg', ''),
(54, NULL, 377, 6, '15x750_14', '20211119/3a61332881ced8fa2f4603c3fe98f14a.jpg', ''),
(55, NULL, 377, 7, 'Isolataion gown', '20211119/cec28586443c0ce7e2cf0bb1daf77afd.jpg', '');

-- --------------------------------------------------------

--
-- 表的结构 `core_shop_cart`
--

CREATE TABLE `core_shop_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `cart_num` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `create_time` varchar(100) DEFAULT NULL,
  `update_time` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_shop_cart`
--

INSERT INTO `core_shop_cart` (`id`, `user_id`, `product_id`, `cart_num`, `price`, `create_time`, `update_time`, `status`) VALUES
(311, 32, 365, 2, '10.00', '1637028330', '1637028331', 1),
(310, 32, 365, 1, '10.00', '1637027866', '1637027866', 1),
(309, 32, 365, 2, '10.00', '1637027582', '1637027584', 1),
(308, 29, 365, 1, '10.00', '1637026441', '1637026441', 1),
(307, 29, 368, 2, '10.00', '1637025934', '1637025936', 1),
(259, 29, 378, 7, '10.00', '1636622170', '1636703681', 1),
(306, 31, 365, 1, '10.00', '1636970966', '1636970966', 1),
(252, 29, 377, 4, '10.00', '1636620409', '1636622162', 1),
(305, 31, 365, 2, '10.00', '1636970391', '1636970401', 1),
(304, 29, 365, 2, '10.00', '1636968268', '1636968270', 1),
(303, 29, 365, 4, '10.00', '1636967833', '1636967858', 1),
(302, 29, 377, 2, '10.00', '1636966537', '1636966541', 1),
(301, 29, 368, 1, '10.00', '1636966532', '1636966532', 1),
(300, 29, 365, 1, '10.00', '1636966527', '1636966527', 1),
(299, 29, 366, 2, '10.00', '1636964501', '1636964502', 1),
(298, 29, 365, 1, '10.00', '1636964496', '1636964496', 1),
(297, 29, 365, 1, '10.00', '1636963594', '1636963594', 1),
(296, 29, 366, 2, '10.00', '1636961436', '1636961437', 1),
(271, 29, 368, 1, '10.00', '1636785791', '1636785791', 1),
(295, 29, 365, 1, '10.00', '1636961432', '1636961432', 1),
(274, 29, 366, 1, '10.00', '1636785953', '1636785953', 1),
(294, 29, 366, 1, '10.00', '1636961422', '1636961422', 1),
(293, 29, 365, 3, '10.00', '1636955318', '1636955320', 1),
(292, 29, 365, 2, '10.00', '1636946749', '1636946750', 1),
(291, 29, 365, 1, '10.00', '1636946621', '1636946621', 1),
(279, 29, 366, 1, '10.00', '1636786744', '1636786744', 1),
(280, 29, 377, 2, '10.00', '1636786752', '1636786754', 1),
(290, 29, 365, 2, '10.00', '1636946244', '1636946280', 1),
(287, 29, 364, 1, '10.00', '1636945626', '1636945626', 1),
(286, 29, 364, 1, '10.00', '1636944730', '1636944730', 1),
(312, 32, 365, 1, '10.00', '1637028471', '1637028471', 0),
(313, 33, 365, 1, '10.00', '1637028648', '1637028648', 1),
(314, 33, 365, 1, '10.00', '1637028845', '1637028845', 1),
(315, 29, 365, 7, '10.00', '1637029711', '1637029715', 1),
(316, 29, 365, 4, '10.00', '1637029810', '1637214304', 1),
(317, 30, 365, 1, '10.00', '1637032714', '1637032714', 1),
(318, 30, 366, 1, '10.00', '1637034386', '1637034386', 1),
(319, 30, 365, 1, '10.00', '1637211064', '1637224000', 0),
(320, 29, 377, 3, '10.00', '1637214315', '1637214320', 1),
(321, 30, 366, 2, '10.00', '1637223960', '1637223963', 0),
(325, 29, 365, 1, '10.00', '1637562665', '1637562665', 1),
(324, 29, 365, 5, '10.00', '1637562409', '1637562417', 1),
(326, 29, 365, 4, '10.00', '1637562788', '1637562790', 1),
(327, 29, 365, 1, '10.00', '1637563198', '1637563198', 1),
(328, 29, 405, 1, '28.00', '1637563204', '1637563204', 1),
(329, 29, 408, 3, '10.00', '1637563210', '1637563212', 1),
(330, 29, 365, 5, '10.00', '1637563315', '1637563317', 1),
(331, 29, 406, 1, '0.00', '1637563325', '1637563668', 1),
(332, 29, 365, 1, '10.00', '1637563861', '1637563861', 1),
(333, 29, 406, 1, '0.00', '1637564031', '1637564031', 1),
(334, 29, 408, 5, '10.00', '1637564195', '1637564196', 1);

-- --------------------------------------------------------

--
-- 表的结构 `core_watermark`
--

CREATE TABLE `core_watermark` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `value` text COMMENT '配置值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_watermark`
--

INSERT INTO `core_watermark` (`id`, `name`, `value`) VALUES
(1, 'wm_type', '1'),
(2, 'wm_position', '3'),
(3, 'wm_text', '晨飞网络'),
(4, 'wm_fontfamily', 'ARIAL.TTF'),
(5, 'wm_fontsize', '18'),
(6, 'wm_color', '#363636'),
(7, 'wm_textquality', '75'),
(8, 'wm_image', '20180721/1793529026c8ecf744fe9149c7be6299.png'),
(9, 'wm_alpha', '60'),
(10, 'wm_imgquality', '75');

-- --------------------------------------------------------

--
-- 表的结构 `core_web_config`
--

CREATE TABLE `core_web_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `value` text COMMENT '配置值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `core_web_config`
--

INSERT INTO `core_web_config` (`id`, `name`, `value`) VALUES
(1, 'web_site_title', 'Yuhuan Group'),
(2, 'web_site_description', 'Yuhuan Group'),
(3, 'web_site_keyword', 'Yuhuan Group'),
(4, 'web_site_icp', '陇ICP备15002349号-1'),
(9, 'web_footer_javascript', ''),
(6, 'web_site_copy', '<p>© Copyright 2021 Zhongke Meiling Cryogenics Company Limited</p>'),
(5, 'web_serviceLine', '86-592-6300505'),
(7, 'web_site_logo', '20211115/ab7aa66df86268c81c3ade5b488c6224.png'),
(8, 'web_head_javascript', ''),
(13, 'web_site_address', 'yaxia automobile building, Shushan District, Hefei, Anhui'),
(14, 'web_site_qrcode', NULL),
(15, 'web_site_ico', NULL),
(16, 'web_qq', ''),
(17, 'web_contact', ''),
(18, 'web_site_waplogo', NULL),
(19, 'web_email', 'hfcfwl@cfwl.com'),
(20, 'web_site_wapqrcode', NULL),
(21, 'web_sales', '<div class=\"tit\" style=\"text-align: center;\">sign up to get 5% Off</div><div class=\"cont\" style=\"text-align: center;\">Stay updated with our latest promotion or events</div>');

-- --------------------------------------------------------

--
-- 表的结构 `core_wx_account`
--

CREATE TABLE `core_wx_account` (
  `id` mediumint(9) NOT NULL,
  `wx_name` varchar(32) DEFAULT NULL COMMENT '公众号名称',
  `appid` varchar(32) DEFAULT NULL,
  `appsecret` varchar(64) DEFAULT NULL,
  `access_token_time` int(11) DEFAULT NULL COMMENT 'token的更新时间',
  `access_token` text,
  `jsapi_ticket_time` int(11) DEFAULT NULL COMMENT 'ticket更新时间',
  `jsapi_ticket` text,
  `token` varchar(32) DEFAULT NULL COMMENT '开发者模式的token',
  `mch_id` varchar(16) DEFAULT NULL COMMENT '微信支付商户号',
  `sub_mch_id` varchar(16) DEFAULT NULL COMMENT '子商户号',
  `pay_key` varchar(32) DEFAULT NULL COMMENT '微信支付密钥'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信公众号';

--
-- 转存表中的数据 `core_wx_account`
--

INSERT INTO `core_wx_account` (`id`, `wx_name`, `appid`, `appsecret`, `access_token_time`, `access_token`, `jsapi_ticket_time`, `jsapi_ticket`, `token`, `mch_id`, `sub_mch_id`, `pay_key`) VALUES
(1, 'ces', '121212', '2222', NULL, NULL, NULL, NULL, NULL, '2222', NULL, '2222');

-- --------------------------------------------------------

--
-- 表的结构 `core_wx_member`
--

CREATE TABLE `core_wx_member` (
  `id` int(11) NOT NULL,
  `appid` varchar(32) NOT NULL,
  `openid` varchar(32) NOT NULL,
  `nickname` varchar(128) NOT NULL,
  `sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 未知 1 男 2 女',
  `country` varchar(32) NOT NULL,
  `province` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `subscribe_time` int(11) NOT NULL COMMENT '关注的时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '最后登录时间',
  `create_ip` varchar(20) NOT NULL,
  `update_ip` varchar(20) NOT NULL,
  `phone` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `headimgurl` varchar(512) NOT NULL COMMENT '头像地址'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `core_ad`
--
ALTER TABLE `core_ad`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_address`
--
ALTER TABLE `core_address`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_add_field`
--
ALTER TABLE `core_add_field`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_admin`
--
ALTER TABLE `core_admin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_ad_position`
--
ALTER TABLE `core_ad_position`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_article`
--
ALTER TABLE `core_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_title` (`title`),
  ADD KEY `id` (`id`);

--
-- 表的索引 `core_article_cate`
--
ALTER TABLE `core_article_cate`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_attribute`
--
ALTER TABLE `core_attribute`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_auth_group`
--
ALTER TABLE `core_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_auth_group_access`
--
ALTER TABLE `core_auth_group_access`
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- 表的索引 `core_auth_rule`
--
ALTER TABLE `core_auth_rule`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_cate_config`
--
ALTER TABLE `core_cate_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`);

--
-- 表的索引 `core_classification`
--
ALTER TABLE `core_classification`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_collection`
--
ALTER TABLE `core_collection`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_config`
--
ALTER TABLE `core_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`);

--
-- 表的索引 `core_counter`
--
ALTER TABLE `core_counter`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_floating`
--
ALTER TABLE `core_floating`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_job`
--
ALTER TABLE `core_job`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_log`
--
ALTER TABLE `core_log`
  ADD PRIMARY KEY (`log_id`);

--
-- 表的索引 `core_member`
--
ALTER TABLE `core_member`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_member_group`
--
ALTER TABLE `core_member_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_message`
--
ALTER TABLE `core_message`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_nature`
--
ALTER TABLE `core_nature`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_nature_cate`
--
ALTER TABLE `core_nature_cate`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_online_config`
--
ALTER TABLE `core_online_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`);

--
-- 表的索引 `core_online_list`
--
ALTER TABLE `core_online_list`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_orders`
--
ALTER TABLE `core_orders`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_pic_catelist`
--
ALTER TABLE `core_pic_catelist`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_pic_list`
--
ALTER TABLE `core_pic_list`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_shop_cart`
--
ALTER TABLE `core_shop_cart`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `core_watermark`
--
ALTER TABLE `core_watermark`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`);

--
-- 表的索引 `core_web_config`
--
ALTER TABLE `core_web_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`);

--
-- 表的索引 `core_wx_account`
--
ALTER TABLE `core_wx_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appid` (`appid`) USING BTREE;

--
-- 表的索引 `core_wx_member`
--
ALTER TABLE `core_wx_member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `openid` (`openid`),
  ADD KEY `appid` (`appid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `core_ad`
--
ALTER TABLE `core_ad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- 使用表AUTO_INCREMENT `core_address`
--
ALTER TABLE `core_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- 使用表AUTO_INCREMENT `core_add_field`
--
ALTER TABLE `core_add_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用表AUTO_INCREMENT `core_admin`
--
ALTER TABLE `core_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `core_ad_position`
--
ALTER TABLE `core_ad_position`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用表AUTO_INCREMENT `core_article`
--
ALTER TABLE `core_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章逻辑ID', AUTO_INCREMENT=409;

--
-- 使用表AUTO_INCREMENT `core_article_cate`
--
ALTER TABLE `core_article_cate`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- 使用表AUTO_INCREMENT `core_attribute`
--
ALTER TABLE `core_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `core_auth_group`
--
ALTER TABLE `core_auth_group`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `core_auth_rule`
--
ALTER TABLE `core_auth_rule`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- 使用表AUTO_INCREMENT `core_cate_config`
--
ALTER TABLE `core_cate_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID', AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `core_classification`
--
ALTER TABLE `core_classification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `core_collection`
--
ALTER TABLE `core_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- 使用表AUTO_INCREMENT `core_config`
--
ALTER TABLE `core_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID', AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `core_counter`
--
ALTER TABLE `core_counter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=958;

--
-- 使用表AUTO_INCREMENT `core_floating`
--
ALTER TABLE `core_floating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `core_job`
--
ALTER TABLE `core_job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `core_log`
--
ALTER TABLE `core_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3796;

--
-- 使用表AUTO_INCREMENT `core_member`
--
ALTER TABLE `core_member`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- 使用表AUTO_INCREMENT `core_member_group`
--
ALTER TABLE `core_member_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '留言Id', AUTO_INCREMENT=123;

--
-- 使用表AUTO_INCREMENT `core_message`
--
ALTER TABLE `core_message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- 使用表AUTO_INCREMENT `core_nature`
--
ALTER TABLE `core_nature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `core_nature_cate`
--
ALTER TABLE `core_nature_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `core_online_config`
--
ALTER TABLE `core_online_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID', AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `core_online_list`
--
ALTER TABLE `core_online_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `core_orders`
--
ALTER TABLE `core_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- 使用表AUTO_INCREMENT `core_pic_catelist`
--
ALTER TABLE `core_pic_catelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `core_pic_list`
--
ALTER TABLE `core_pic_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- 使用表AUTO_INCREMENT `core_shop_cart`
--
ALTER TABLE `core_shop_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- 使用表AUTO_INCREMENT `core_watermark`
--
ALTER TABLE `core_watermark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID', AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `core_web_config`
--
ALTER TABLE `core_web_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID', AUTO_INCREMENT=22;

--
-- 使用表AUTO_INCREMENT `core_wx_account`
--
ALTER TABLE `core_wx_account`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `core_wx_member`
--
ALTER TABLE `core_wx_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
