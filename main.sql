/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : main

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2020-04-29 15:27:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ysk_admin
-- ----------------------------
DROP TABLE IF EXISTS `ysk_admin`;
CREATE TABLE `ysk_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'UID',
  `auth_id` int(11) NOT NULL DEFAULT '1' COMMENT '角色ID',
  `nickname` varchar(63) DEFAULT NULL COMMENT '昵称',
  `username` varchar(31) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(63) NOT NULL DEFAULT '' COMMENT '密码',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  `reg_type` varchar(20) DEFAULT NULL COMMENT '注册人',
  `google_auth` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台管理员表格';

-- ----------------------------
-- Records of ysk_admin
-- ----------------------------
INSERT INTO `ysk_admin` VALUES ('5', '1', 'admin', 'admin', '8f3bd6b4d00391c9d09cc14e32fee28c', '13111111111', '1911986758', '1571910396', '1587364169', '1', null, '');

-- ----------------------------
-- Table structure for ysk_agent
-- ----------------------------
DROP TABLE IF EXISTS `ysk_agent`;
CREATE TABLE `ysk_agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(50) DEFAULT NULL COMMENT '代理用户名',
  `pwd` varchar(255) DEFAULT NULL COMMENT '代理登录密码',
  `zt` tinyint(3) DEFAULT '1' COMMENT '账号是否启用：0=停用 1=启用',
  `addtime` int(11) DEFAULT '0' COMMENT '开通时间',
  `ip` varchar(255) DEFAULT NULL COMMENT '所属ip',
  `login_num` int(11) DEFAULT '0' COMMENT '登录次数',
  `last_time` int(11) DEFAULT '0' COMMENT '最后一次登录',
  `pid` int(11) DEFAULT '0' COMMENT '上级ID',
  `bankname` varchar(255) DEFAULT NULL,
  `bankinfo` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `acc` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `wx` float DEFAULT '0',
  `zfb` float DEFAULT '0',
  `sjm` float DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `google_auth` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='代理表';

-- ----------------------------
-- Records of ysk_agent
-- ----------------------------
INSERT INTO `ysk_agent` VALUES ('1', 'shh001', 'e10adc3949ba59abbe56e057f20f883e', '1', '1582357884', '10.168.1.132', '1785', '1582357890', '0', '工行', '建设路 支行', '李天一', '111000999', 'admin', 'PSK3A8AHLP6CP3ES1X63MJN1JQR8R9OF', '2', '2', '2', '10798.92', '');
INSERT INTO `ysk_agent` VALUES ('2', 'shh002', 'e10adc3949ba59abbe56e057f20f883e', '1', '1560590181', '112.207.3.180', '1', '1567759579', '0', null, null, null, null, 'ceshi001.com', 'A8NYX3H381D3S9APXN64EMWIQ0SDP1I8', '2.8', '2.6', '1.2', '972.00', '');
INSERT INTO `ysk_agent` VALUES ('3', '', 'e10adc3949ba59abbe56e057f20f883e', '1', '1563019042', null, '0', '0', '0', null, null, null, null, 'admin', '', '0', '0', '0', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('4', 'jiejie0595', 'e10adc3949ba59abbe56e057f20f883e', '1', '1563532599', null, '0', '0', '0', null, null, null, null, 'admin', 'aa112233', '0.1', '0.1', '0.1', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('5', '13599217309', 'e10adc3949ba59abbe56e057f20f883e', '1', '1563533124', null, '0', '0', '0', null, null, null, null, '13599217309', '112233', '0.1', '0.1', '0.1', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('6', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', '1563611747', '127.0.0.1', '16', '1588138533', '0', null, null, null, null, 'admin.1111', '000000', '3', '2', '3', '2425.00', '');
INSERT INTO `ysk_agent` VALUES ('7', '123110', 'e10adc3949ba59abbe56e057f20f883e', '1', '1563611790', null, '0', '0', '0', null, null, null, null, 'admin.1111', 'B49RO1CLC6OF6YW3FA2LOC26GS9KEE3U', '3', '3', '3', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('8', '123', 'e10adc3949ba59abbe56e057f20f883e', '1', '1563612893', '113.65.231.17', '1', '1563612950', '0', null, null, null, null, 'admin', 'Y826ZSY7QAMTJ1UT16G7QV8IWEFX0QED', '10', '10', '10', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('9', '123321', 'd41d8cd98f00b204e9800998ecf8427e', '1', '1563679378', null, '0', '0', '0', null, null, null, null, '', '', '0', '0', '0', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('10', 'shanghu111', '3d186804534370c3c817db0563f0e461', '1', '1563719319', '123.161.217.215', '1', '1563719257', '0', '123', '123', '213', '123', 'v.pptv.com/show/fwP9e3sDC0msKpI.htm', 'YVR8CYLYZFLFUMGEIKA87DINLCPR8IG3', '1', '2', '3', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('11', '大发', 'e10adc3949ba59abbe56e057f20f883e', '1', '1563954416', '36.106.21.23', '1', '1563954480', '0', '', '', '', '', '', '6JS33XTCVF31K3QC4MXP8D2CIV68UTMZ', '4', '3.5', '2.5', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('12', '000002', 'e10adc3949ba59abbe56e057f20f883e', '1', '1564393540', '223.157.89.63', '2', '1564408932', '0', '建设银行', 'XX公司', '哈利油', '147258369', '', 'N8JN2B0RK0P8ZICNADI8Q6SBN1CH1VA8', '1', '1', '1', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('14', '521', 'c7b3802ebc4755d0b61e5db8c94e6bf4', '1', '1564504591', null, '0', '0', '0', null, null, null, null, '', 'wjy123', '3', '5', '2', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('15', '54645', 'e10adc3949ba59abbe56e057f20f883e', '1', '1564537805', null, '0', '0', '0', null, null, null, null, '562525.com', 'AD0WF5OOP3B53BAYBYWQ9YUNBOPCSEYU', '3', '3', '3', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('16', 'qazwsx', '7e7576bde8baa58874dc2a8a752ee3dc', '1', '1564541426', null, '0', '0', '0', null, null, null, null, '13599217309', '1U3YOBW7I2MUYAXXN4Y7DKTMYNNN2HHA', '1', '1', '1', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('17', 'azsxdc', 'e10adc3949ba59abbe56e057f20f883e', '1', '1564544816', null, '0', '0', '0', null, null, null, null, '772855984@qq.com', 'YJ8EHPPREQWJQMG0NFA6UAKLPYUFE3Y3', '1', '1', '1', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('21', 'ceshi', '44cf9833462ab54740bfb915b36d2733', '1', '1566191239', '222.212.6.25', '1', '1566191472', '0', null, null, null, null, 'www.baidu.com', 'VT1ZMJUFHC4QSNA4OCROEAV3T1WAPVDA', '0.1', '0.1', '0.1', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('22', 'aa123456', 'dc483e80a7a0bd9ef71d8cf973673924', '1', '1566639122', '121.31.246.4', '1', '1566639133', '0', '', '', '', '', 'www.cp8899.site', 'U5HYKIV39JVG9XQ7NXIAB5XHA31IL5JI', '0', '0', '0', '3541.00', '');
INSERT INTO `ysk_agent` VALUES ('23', '刘明一', 'd7077e0ccfe69607e3cb290ce61c811d', '1', '1566628896', '117.183.8.43', '1', '1566629631', '0', null, null, null, null, '', 'J2SOEPRP7EDJMW3RA7I419HDBLG2MZRT', '1.3', '1.3', '1.3', '0.99', '');
INSERT INTO `ysk_agent` VALUES ('24', 'xxceshi', 'e10adc3949ba59abbe56e057f20f883e', '1', '1566805015', '42.226.116.200', '1', '1566805042', '0', null, null, null, null, 'baidu.com', 'JVJSGK1RHUSI51L9ROMLLM5Z2GY1GOKD', '1.5', '1.5', '1.5', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('25', '龙龙', '36ed58c5c14dc2f58eef099585d2a939', '1', '1567059418', '117.183.8.43', '1', '1566994332', '0', '', '', '', '', '', 'LKAEB41GBCR499MHHURQIBM4H7Y1R1Y8', '0', '2', '2', '500.00', '');
INSERT INTO `ysk_agent` VALUES ('26', 'ZHUYI', '1dfc269f9a745a95802a4af561764115', '1', '1570124151', null, '0', '0', '0', null, null, null, null, 'https://s.taobao.com/search?q=%E8%B7%91%E5%88%86', 'MX0NXFXJ8QURY3S7MUBFGXEABP9PO6B7', '2', '2', '2', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('27', '111', 'e10adc3949ba59abbe56e057f20f883e', '1', '1571381333', '117.181.81.112', '1', '1571381542', '0', null, null, null, null, '13100000000', 'RUD85ZL5XF15Y91SSJ7WM1Q045875SAJ', '1', '0.1', '0.1', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('28', 'gghun1', 'c8837b23ff8aaa8a2dde915473ce0991', '1', '1571392634', null, '0', '0', '0', '', '', '', '', '112233', 'GCZ3YYJO9GCNWQQAVD1QL40M3MWKWFAY', '0', '0', '0', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('29', 'ddss667788', 'e10adc3949ba59abbe56e057f20f883e', '1', '1571531393', null, '0', '0', '0', '', '', '', '', '13100000000', 'HKPWGBNHWE4PYMK6X8O37QVPMFGIDJNA', '0', '0', '0', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('30', '222', 'e10adc3949ba59abbe56e057f20f883e', '1', '1577977529', '115.53.107.121', '1', '1577977535', '0', '', '', '', '', 'www.99t.com', 'BE47DWAC05N16Y84YR58L88GP2FMJAGF', '1.2', '1.2', '1.5', '1976.00', '');
INSERT INTO `ysk_agent` VALUES ('31', 'ceshishangjia1', 'e10adc3949ba59abbe56e057f20f883e', '0', '1577890466', '1.198.29.29', '1', '1575121381', '0', '', '', '', '', 'http://api.gnqtl.xyz/api1', 'P7Q94UXOR56LVE8II23IPXSWL9SYMLEF', '1.2', '1.2', '1.2', '0.00', '');
INSERT INTO `ysk_agent` VALUES ('32', 'merchant', 'e10adc3949ba59abbe56e057f20f883e', '1', '1587530898', '127.0.0.1', '11', '1587707361', '0', null, null, null, null, '', '', '0', '0', '0', '0.00', '');

-- ----------------------------
-- Table structure for ysk_bankcard
-- ----------------------------
DROP TABLE IF EXISTS `ysk_bankcard`;
CREATE TABLE `ysk_bankcard` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(11) NOT NULL COMMENT 'uid',
  `name` varchar(225) NOT NULL COMMENT '持卡人',
  `bankname` varchar(225) NOT NULL COMMENT '所属银行',
  `banknum` varchar(225) NOT NULL COMMENT '银行卡号',
  `addtime` varchar(225) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='银行卡管理';

-- ----------------------------
-- Records of ysk_bankcard
-- ----------------------------
INSERT INTO `ysk_bankcard` VALUES ('6', '48', '多岁的', '速度', '1231231231231532', '1564313203');
INSERT INTO `ysk_bankcard` VALUES ('7', '49', '都是', '速度', '123123123123', '1564313892');
INSERT INTO `ysk_bankcard` VALUES ('9', '57', '陈焰', '建设银行', '6217002730010318818', '1564507412');
INSERT INTO `ysk_bankcard` VALUES ('11', '61', '想起', '建行', '6234683497649679', '1564586240');
INSERT INTO `ysk_bankcard` VALUES ('13', '68', '小颜', '建设银行', '662284835877425638', '1564901416');
INSERT INTO `ysk_bankcard` VALUES ('14', '71', '1', '农业', '1', '1565001403');
INSERT INTO `ysk_bankcard` VALUES ('17', '83', '5845', '5485', '65448', '1565035255');
INSERT INTO `ysk_bankcard` VALUES ('18', '90', '尹青波', '兴业银行', '622908333084580728', '1565371345');
INSERT INTO `ysk_bankcard` VALUES ('21', '105', '全球', '工商银行', '555777889990', '1567316749');
INSERT INTO `ysk_bankcard` VALUES ('25', '116', '张某', '中国工商银行', '622202120200019372', '1567844989');
INSERT INTO `ysk_bankcard` VALUES ('27', '1', '测试', '四川银行', '234234345345', '1569485154');
INSERT INTO `ysk_bankcard` VALUES ('31', '151', '大哥', '中国银行', '123456', '1571995624');
INSERT INTO `ysk_bankcard` VALUES ('32', '152', '币币', '币币', '2323242424', '1572085434');
INSERT INTO `ysk_bankcard` VALUES ('33', '9', '9527', '交行', '6222601020000829885', '1573127191');
INSERT INTO `ysk_bankcard` VALUES ('34', '155', 'Yu', '8120', '11111111111', '1574252018');

-- ----------------------------
-- Table structure for ysk_complaint
-- ----------------------------
DROP TABLE IF EXISTS `ysk_complaint`;
CREATE TABLE `ysk_complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '投诉人id',
  `content` text CHARACTER SET utf8mb4 COMMENT '投诉内容',
  `imgs` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '图片路径',
  `status` tinyint(1) DEFAULT '0' COMMENT '0 未查看 1 已查看',
  `create_time` int(10) DEFAULT NULL COMMENT '投诉时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='投诉建议表';

-- ----------------------------
-- Records of ysk_complaint
-- ----------------------------
INSERT INTO `ysk_complaint` VALUES ('1', '1', '', '', '0', '1552122574');

-- ----------------------------
-- Table structure for ysk_config
-- ----------------------------
DROP TABLE IF EXISTS `ysk_config`;
CREATE TABLE `ysk_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '配置标题',
  `name` varchar(32) DEFAULT NULL COMMENT '配置名称',
  `value` text NOT NULL COMMENT '配置值',
  `group` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `type` varchar(16) NOT NULL DEFAULT '' COMMENT '配置类型',
  `options` varchar(255) NOT NULL DEFAULT '' COMMENT '配置额外值',
  `tip` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统配置表';

-- ----------------------------
-- Records of ysk_config
-- ----------------------------
INSERT INTO `ysk_config` VALUES ('1', '站点开关', 'TOGGLE_WEB_SITE', '1', '3', '0', '0:关闭\r\n1:开启', '商城建设中......', '1378898976', '1406992386', '1', '1');
INSERT INTO `ysk_config` VALUES ('2', '网站标题', 'WEB_SITE_TITLE', '', '1', '0', '', '网站标题前台显示标题', '1378898976', '1379235274', '2', '1');
INSERT INTO `ysk_config` VALUES ('3', '网站LOGO', 'WEB_SITE_LOGO', '', '1', '0', '', '网站LOGO', '1407003397', '1407004692', '3', '1');
INSERT INTO `ysk_config` VALUES ('4', '网站描述', 'WEB_SITE_DESCRIPTION', '', '1', '0', '', '网站搜索引擎描述', '1378898976', '1379235841', '4', '1');
INSERT INTO `ysk_config` VALUES ('5', '网站关键字', 'WEB_SITE_KEYWORD', '', '1', '0', '', '网站搜索引擎关键字', '1378898976', '1381390100', '5', '1');
INSERT INTO `ysk_config` VALUES ('6', '版权信息', 'WEB_SITE_COPYRIGHT', '', '1', '0', '', '设置在网站底部显示的版权信息，如“版权所有 © 2014-2015 ***网络科技”', '1406991855', '1406992583', '6', '1');
INSERT INTO `ysk_config` VALUES ('7', '网站备案号', 'WEB_SITE_ICP', '', '1', '0', '', '设置在网站底部显示的备案号，如“苏ICP备1502009号\"', '1378900335', '1415983236', '9', '1');
INSERT INTO `ysk_config` VALUES ('26', '微信二维码', 'WEB_SITE_WX', '', '1', '', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('32', '注册开关', 'close_reg', '1', '3', '', '0:关闭1:开启', '关闭注册功能说明', '0', '0', '12', '1');
INSERT INTO `ysk_config` VALUES ('33', '交易开关', 'close_trading', '1', '3', '', '0:关闭1:开启', '交易暂时关闭，16:00后开启', '0', '0', '13', '0');
INSERT INTO `ysk_config` VALUES ('41', '实时价格每分钟增长', 'growem', '', '2', '', '', '', '0', '0', '12', '1');
INSERT INTO `ysk_config` VALUES ('44', '奖励开关', 'regjifen', '0', '1', '0', '', '', '1407003397', '1407004692', '3', '1');

-- ----------------------------
-- Table structure for ysk_dj
-- ----------------------------
DROP TABLE IF EXISTS `ysk_dj`;
CREATE TABLE `ysk_dj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT '0.00',
  `addtime` int(11) DEFAULT NULL,
  `ppid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of ysk_dj
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_ewm
-- ----------------------------
DROP TABLE IF EXISTS `ysk_ewm`;
CREATE TABLE `ysk_ewm` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '记录id',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `ewm_class` int(11) NOT NULL COMMENT '二维码类型',
  `ewm_url` varchar(225) NOT NULL COMMENT '二维码地址',
  `ewm_price` float(10,2) NOT NULL COMMENT '二维码收款金额',
  `ewm_acc` varchar(225) NOT NULL COMMENT '二维码账号',
  `uaccount` varchar(225) NOT NULL COMMENT '用户账号',
  `uname` varchar(225) NOT NULL COMMENT '用户名',
  `addtime` varchar(50) NOT NULL COMMENT '添加时间',
  `gengxintime` varchar(50) DEFAULT NULL,
  `jdtime` int(10) DEFAULT '0',
  `zt` int(10) DEFAULT '1',
  `zt1` int(1) NOT NULL DEFAULT '0',
  `province` varchar(255) NOT NULL COMMENT '二维码省份',
  `city` varchar(255) NOT NULL COMMENT '二维码所属市',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`,`ewm_class`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='二维码管理';

-- ----------------------------
-- Records of ysk_ewm
-- ----------------------------
INSERT INTO `ysk_ewm` VALUES ('86', '159', '2', 'http://p.nanguang998.com/Public/attached/2019/11/25/5ddb92719c890.jpg', '0.00', '', '13931091933', '六熊猫', '1574670970', '1575311032', '1575310992', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('88', '157', '1', 'http://p.nanguang998.com/Public/attached/2019/11/25/5ddb953522bdb.jpg', '0.00', '', '18731028899', '刘海', '1574671681', '1574673233', '1574673222', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('89', '160', '2', 'http://p.nanguang998.com/Public/attached/2019/11/26/5ddcb9cd7018c.jpg', '0.00', '', '14033033330', '啊就好', '1574746579', '1574746934', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('90', '156', '2', 'http://p.nanguang998.com/Public/attached/2019/11/26/5ddcbce2a255f.jpg', '0.00', '', '13100007777', '123', '1574747367', '1575297453', '1575297317', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('91', '1', '2', 'http://p.nanguang998.com/Public/attached/2019/12/02/5de514b6df7c9.png', '0.00', '', '13100000000', '567', '1575294141', '1575294181', '1575294174', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('92', '152', '2', 'http://p.nanguang998.com/Public/attached/2019/12/02/5de516b31cd4c.png', '0.00', '', '13111112222', 'sdfsdf', '1575294646', '1575296589', '1575297395', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('93', '155', '2', 'http://p.nanguang998.com/Public/attached/2019/12/02/5de51c1e8bcdd.png', '0.00', '', '13100006666', '121212', '1575296031', '1575296668', '1575296663', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('94', '156', '2', 'http://p.nanguang998.com/Public/attached/2019/12/02/5de5210b315cf.png', '0.00', '', '13100007777', '士大夫大师傅', '1575297293', '1578045913', '1575304897', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('95', '9', '1', 'http://p.nanguang998.com/Public/attached/2019/12/09/5dee1c3875156.png', '0.00', '', '13800138000', '张三', '1575886416', '1578017400', '1578017467', '1', '1', '', '');
INSERT INTO `ysk_ewm` VALUES ('96', '164', '1', 'http://p.nanguang998.com/Public/attached/2019/12/11/5df0e6cd8749b.jpeg', '0.00', '', '13783914073', '张磊', '1576068816', '1576069337', '1576069324', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('97', '9', '2', 'http://p.nanguang998.com/Public/attached/2019/12/19/5dfb04b652507.jpg', '0.00', '', '13800138000', '多得到', '1576731834', '1578045884', '1576820862', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('98', '9', '2', 'http://p.nanguang998.com/Public/attached/2019/12/19/5dfb05fd79696.png', '0.00', '', '13800138000', '孙鹏', '1576732205', '1578045866', '1577455905', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('99', '9', '3', 'http://p.nanguang998.com/Public/attached/2019/12/19/5dfb3b8a2beca.png', '0.00', '456456', '13800138000', '456', '1576745867', '1576745867', '1577977047', '0', '1', '', '');
INSERT INTO `ysk_ewm` VALUES ('100', '9', '3', 'http://pao.h8pay.com/Public/attached/2019/12/21/5dfde01ec7613.jpg', '0.00', '6123359123569621', '13800138000', '张梦磊', '1576919082', '1578047939', '1579634027', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('105', '176', '2', 'http://www.h8pay.com/Public/attached/2020/01/01/5e0ca15cdfb8e.jpeg', '0.00', '', '17521149197', '王新钘', '1577886053', '1577886053', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('107', '165', '2', 'http://www.h8pay.com/Public/attached/2020/01/02/5e0e04b995899.png', '0.00', '', '14725836900', '我现在', '1577977021', '1577977042', '0', '0', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('109', '165', '3', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0e8fae6c259.png', '0.00', '4657286488500964', '14725836900', '刘亮', '1578012610', '1578044401', '1578044390', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('111', '179', '2', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0ebba6be664.jpg', '0.00', '', '15665431432', '周口蜂琴航空票务代理有限公司', '1578023848', '1578023848', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('112', '179', '2', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0ebbdff05b9.jpg', '0.00', '', '15665431432', '周口蜂琴航空票务代理有限公司', '1578023906', '1578023906', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('113', '179', '2', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0ebf17138d1.jpg', '0.00', '', '15665431432', '合肥水润网络信息科技有限公司', '1578024764', '1578024764', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('114', '186', '3', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0ec9a833e5a.jpeg', '0.00', '6217923671554615', '13386909567', '纪仁泽', '1578027508', '1578027508', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('116', '179', '1', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0ecea003115.jpg', '0.00', '', '15665431432', '来都借', '1578028709', '1578028709', '1578028868', '0', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('117', '165', '1', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0ed535c4244.png', '0.00', '', '14725836900', '个地方', '1578030393', '1578040970', '1578040919', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('118', '186', '1', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0ed54cb8019.jpeg', '0.00', '', '13386909567', '纪平凡', '1578030429', '1578030429', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('119', '172', '3', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0ed53bdde74.jpeg', '0.00', '6217001780006760433', '18075031017', '荣发涛', '1578030467', '1578034129', '1578034029', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('121', '169', '3', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0ef0658ac1d.jpg', '0.00', '6212262013027479790', '18928696507', '陈超威', '1578037371', '1578037371', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('122', '169', '1', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0ef0cf0fe64.jpeg', '0.00', '', '18928696507', '陈超威', '1578037458', '1578037458', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('123', '193', '3', 'http://www.h8pay.com/Public/attached/2020/01/03/5e0f03a4ed820.jpg', '0.00', '6230580000232230487', '15838717882', '秦守博', '1578042280', '1578317016', '1578048788', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('124', '193', '3', 'http://www.h8pay.com/Public/attached/2020/01/04/5e0fe9499e071.jpg', '0.00', '6221804910002203671', '15838717882', '秦守博', '1578101097', '1578101097', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('125', '166', '3', 'http://www.h8pay.com/Public/attached/2020/01/04/5e0ff40050267.jpeg', '0.00', '6215581510007874434', '18022484190', '陈冬明', '1578103870', '1578103870', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('127', '201', '3', 'http://www.h8pay.com/Public/attached/2020/01/06/5e12fd2af2a06.jpg', '0.00', '6216695000012002859', '18831206543', '胡子明', '1578302807', '1578302807', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('128', '199', '3', 'http://www.h8pay.com/Public/attached/2020/01/06/5e131b570ae1f.jpg', '0.00', '6217996750001251446', '13398322087', '欧波', '1578310519', '1578318944', '1578318797', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('129', '167', '3', 'http://www.h8pay.com/Public/attached/2020/01/07/5e13d5382eb32.jpg', '0.00', '6230520060085161877', '15715928077', '范孝鑫', '1578358074', '1578358074', '0', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('133', '21', '1', 'http://fast.com/Public/attached/2020/04/19/5e9c006c24a8b.png', '0.00', '', '13888888888', 'xiaxia', '1587282033', '1588131091', '1588131017', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('134', '21', '3', 'http://fast.com/Public/attached/2020/04/26/5ea4ed7c97336.png', '0.00', '123873474829839', '13888888888', 'XIA', '1587867014', '1587867014', '1587868297', '1', '0', '', '');
INSERT INTO `ysk_ewm` VALUES ('135', '21', '2', 'http://fast.com/Public/attached/2020/04/26/5ea5223112385.png', '0.00', '', '13888888888', '小虾', '1587880529', '1588131108', '1588132021', '1', '0', '浙江省', '杭州市');

-- ----------------------------
-- Table structure for ysk_group
-- ----------------------------
DROP TABLE IF EXISTS `ysk_group`;
CREATE TABLE `ysk_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '部门ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上级部门ID',
  `title` varchar(31) NOT NULL DEFAULT '' COMMENT '部门名称',
  `icon` varchar(31) NOT NULL DEFAULT '' COMMENT '图标',
  `menu_auth` text NOT NULL COMMENT '权限列表',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  `auth_id` int(11) DEFAULT NULL,
  `hylb` varchar(10) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='部门信息表';

-- ----------------------------
-- Records of ysk_group
-- ----------------------------
INSERT INTO `ysk_group` VALUES ('1', '0', '超级管理员', '', '', '1426881003', '1427552428', '0', '1', '1', '0');
INSERT INTO `ysk_group` VALUES ('2', '0', '财务查看', '', '1,7,8,9,337,10,11,316,341,340,344,324,342,322,338,3,323,347', '1498324367', '1551095515', '0', '-1', '2', '5');
INSERT INTO `ysk_group` VALUES ('7', '0', '超级管理', '', '1,3,4,6,327,7,8,9,316,318,322,323', '1526152893', '1528963727', '0', '-1', '0', '');
INSERT INTO `ysk_group` VALUES ('8', '0', '数据管理', '', '1,3,4,327,7,8,10,11,315,324,325,334,329,328', '1527085184', '1527140823', '0', '-1', '0', '0');
INSERT INTO `ysk_group` VALUES ('9', '0', '财务', '', '349,351,359,323', '1555013895', '1555013895', '1', '-1', null, '2');
INSERT INTO `ysk_group` VALUES ('10', '0', '客服', '', '354,355,356', '1555200785', '1555322515', '1', '-1', null, '');
INSERT INTO `ysk_group` VALUES ('13', '0', '财务001', '', '7,348,349,351', '1555839336', '1563223637', '6', '-1', null, '');
INSERT INTO `ysk_group` VALUES ('14', '0', '技术员', '', '1,7,401,400,8,9,348,349,350,351,359,352,555,353,354,355,356,560,357,562,556,557,558,559,3,402,5,6,323', '1563223674', '1571910343', '2', '-1', null, '1,2,3,4,5');
INSERT INTO `ysk_group` VALUES ('15', '0', '哦哦', '', '1,7,401,400,8,9,348,349,350,351,359,352,353,354,355,356,357,556,557,558,559,3,402,5,6,323', '1563530313', '1563530313', '1', '-1', null, '');
INSERT INTO `ysk_group` VALUES ('16', '0', '财务1', '', '7,401,400,8,9,348,349,350,351,359,352,353,354,355,356,357,556,557,558,559', '1563940444', '1570172105', '1', '-1', null, '');
INSERT INTO `ysk_group` VALUES ('17', '0', '测试人', '', '7,401,400,8,9,348,349,350,351,359,352,353,354,355,356,357', '1566785225', '1570172132', '9', '-1', null, '');
INSERT INTO `ysk_group` VALUES ('18', '0', 'jjc2001521', '', '1,7,401,400,8,9,348,349,350,351,359,352,353,354,355,356,357,556,557,558,559,3,402,5,6,323', '1568432735', '1569056014', '3', '-1', null, '1,2,3,4,5');
INSERT INTO `ysk_group` VALUES ('19', '0', '222', '', '1,7,401,400,8,9,348,349,350,351,359,352,555,353,354,355,356,560,357,562,556,557,558,559,3,402,5,6,323', '1571871201', '1572008612', '0', '-1', null, '1,2,3,4,5');
INSERT INTO `ysk_group` VALUES ('20', '0', '546563', '', '1,7,401,400,8,9,348,349,350,351,359,352,555,353,354,355,356,560,357,562,556,557,558,559,3,402,5,6,323', '1573525362', '1573525362', '2', '-1', null, '1,2,3,4,5');
INSERT INTO `ysk_group` VALUES ('21', '0', '测试5', '', '7,348,349,359,352,555,353,354,355,356,560', '1575020214', '1575307974', '0', '-1', null, '');

-- ----------------------------
-- Table structure for ysk_menu
-- ----------------------------
DROP TABLE IF EXISTS `ysk_menu`;
CREATE TABLE `ysk_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `pid` int(11) NOT NULL COMMENT '父级id',
  `gid` int(11) NOT NULL DEFAULT '0' COMMENT '爷爷ID、',
  `col` varchar(30) NOT NULL COMMENT '控制器',
  `act` varchar(30) NOT NULL COMMENT '方法',
  `patch` varchar(50) DEFAULT NULL COMMENT '全路径',
  `level` int(11) NOT NULL COMMENT '级别',
  `icon` varchar(50) DEFAULT NULL,
  `sort` char(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=566 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ysk_menu
-- ----------------------------
INSERT INTO `ysk_menu` VALUES ('1', '系统', '0', '0', '', '', '', '0', 'fa-cog', '0', '1');
INSERT INTO `ysk_menu` VALUES ('3', '统用功能', '1', '1', '', '', '', '1', 'fa-folder-open-o', '3', '1');
INSERT INTO `ysk_menu` VALUES ('5', '角色管理', '3', '1', 'Group', 'index', '', '2', 'fa-sitemap', '12', '1');
INSERT INTO `ysk_menu` VALUES ('6', '管理员管理', '3', '1', 'Manage', 'index', '', '2', 'fa fa-cog', '13', '1');
INSERT INTO `ysk_menu` VALUES ('7', '会员管理', '1', '1', '', '', '', '1', 'fa-folder-open-o', '1', '1');
INSERT INTO `ysk_menu` VALUES ('8', '会员列表', '7', '1', 'User', 'index', '', '2', 'fa-user', '21', '1');
INSERT INTO `ysk_menu` VALUES ('9', '推荐结构', '7', '1', 'Tree', 'index', '', '2', 'fa-th-large', '22', '1');
INSERT INTO `ysk_menu` VALUES ('323', '系统公告', '3', '1', 'News', 'index', '', '2', 'fa-twitter-square', '51', '1');
INSERT INTO `ysk_menu` VALUES ('327', '数据库管理', '3', '1', 'Database', 'index', '', '2', 'fa fa-lock', '14', '0');
INSERT INTO `ysk_menu` VALUES ('348', '充值管理', '7', '1', 'User', 'recharge', '', '2', 'fa-file-text', '34', '1');
INSERT INTO `ysk_menu` VALUES ('349', '提现管理', '7', '1', 'User', 'withdraw', '', '2', 'fa-file-text', '35', '1');
INSERT INTO `ysk_menu` VALUES ('350', '二维码管理', '7', '1', 'User', 'ewm', '', '2', 'fa-file-text', '36', '1');
INSERT INTO `ysk_menu` VALUES ('351', '银行卡管理', '7', '1', 'User', 'bankcard', '', '2', 'fa-file-text', '37', '1');
INSERT INTO `ysk_menu` VALUES ('352', '抢单管理', '1', '1', '', '', '', '1', 'fa-folder-open-o', '2', '1');
INSERT INTO `ysk_menu` VALUES ('353', '发布订单列表', '352', '1', 'Roborder', 'index', '', '2', 'fa-user', '38', '1');
INSERT INTO `ysk_menu` VALUES ('354', '会员抢单列表', '352', '1', 'Roborder', 'userrob', '', '2', 'fa-file-text', '39', '1');
INSERT INTO `ysk_menu` VALUES ('355', '匹配成功列表', '352', '1', 'Roborder', 'robsucc', '', '2', 'fa-file-text', '40', '1');
INSERT INTO `ysk_menu` VALUES ('356', '交易成功列表', '352', '1', 'Roborder', 'ordersucc', '', '2', 'fa-file-text', '41', '1');
INSERT INTO `ysk_menu` VALUES ('357', '游戏参数设置', '352', '1', 'Roborder', 'asystem', '', '2', 'fa-file-text', '43', '1');
INSERT INTO `ysk_menu` VALUES ('358', '收款二维码管理', '3', '1', 'Roborder', 'skewm', '', '2', 'fa-twitter-square', '42', '1');
INSERT INTO `ysk_menu` VALUES ('359', '资金流水', '7', '1', 'User', 'bill', '', '2', 'fa-file-text', '43', '1');
INSERT INTO `ysk_menu` VALUES ('400', '代理列表', '7', '1', 'User', 'indexs', null, '2', 'fa-user', '11', '1');
INSERT INTO `ysk_menu` VALUES ('401', '增加代理', '7', '1', 'User', 'adds', null, '2', 'fa-user', '10', '1');
INSERT INTO `ysk_menu` VALUES ('402', '密码修改', '3', '1', 'admin/Manage', 'edit/id/1', null, '2', 'fa-folder-open-o', '11', '1');
INSERT INTO `ysk_menu` VALUES ('555', '指定发单', '352', '1', 'Roborder', 'zdadd', null, '2', 'fa fa-lock', '14', '1');
INSERT INTO `ysk_menu` VALUES ('556', '商户管理', '1', '1', '', '', null, '1', null, '2', '1');
INSERT INTO `ysk_menu` VALUES ('557', '开通商户', '556', '1', 'User', 'shanghu', null, '2', 'fa-user', '12', '1');
INSERT INTO `ysk_menu` VALUES ('558', '商户列表', '556', '1', 'User', 'shanghus', null, '2', 'fa-user', '13', '1');
INSERT INTO `ysk_menu` VALUES ('559', '商户提现申请', '556', '1', 'User', 'stixian', null, '2', 'fa-user', '14', '1');
INSERT INTO `ysk_menu` VALUES ('560', '投诉管理', '352', '1', 'Roborder', 'tsgl', null, '2', 'fa-file-text', '42', '1');
INSERT INTO `ysk_menu` VALUES ('562', '超时取消列表', '352', '1', 'Roborder', 'robsucc2', null, '2', 'fa-file-text', '43', '1');
INSERT INTO `ysk_menu` VALUES ('563', '谷歌验证绑定', '3', '1', 'admin/Manage', 'google', null, '2', 'fa-file-text', '44', '1');
INSERT INTO `ysk_menu` VALUES ('564', '收款银行卡管理', '3', '1', 'Roborder', 'skyhk', '', '2', 'fa fa-cog', '43', '1');

-- ----------------------------
-- Table structure for ysk_news
-- ----------------------------
DROP TABLE IF EXISTS `ysk_news`;
CREATE TABLE `ysk_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '文章标题',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '文章图片',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `desc` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `is_out` tinyint(4) NOT NULL DEFAULT '0',
  `content` text NOT NULL COMMENT '内容',
  `from` varchar(255) NOT NULL DEFAULT '' COMMENT '文章来源',
  `visit` smallint(6) NOT NULL DEFAULT '0',
  `lang` tinyint(4) NOT NULL DEFAULT '0',
  `tuijian` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统公告';

-- ----------------------------
-- Records of ysk_news
-- ----------------------------
INSERT INTO `ysk_news` VALUES ('6', '5. 团队奖励', '', '0', '', '1575302343', '0', '您保证金额超过30000元，自动升级为代理，代理可额外得到3级奖励。', 'entrance', '0', '0', '0');
INSERT INTO `ysk_news` VALUES ('7', '4. 提现到账时间为24-72小时。', '', '0', '', '1577980778', '0', '提现到账时间为24-72小时。  ', 'mine-field', '0', '0', '0');
INSERT INTO `ysk_news` VALUES ('8', '3. 充值到账时间，系统默认为1到3分钟。', '', '0', '', '1575302918', '0', '到账时间，系统默认为1到3分钟，部分如果有延迟，请咨询客服，为保证您账号安全，系统充值自动添加1块钱尾数。（务必看清楚您选择充值的资金和您转账的实际金额，如果有差别请截图说明发给客服）', 'entrance', '0', '0', '0');
INSERT INTO `ysk_news` VALUES ('9', '2. 保证资金安全，您需先充平台保证金。', '', '0', '', '1575302319', '0', '因为平台抢单为资金流动，所以为了保证资金安全，您需先充值作为平台保证金，充值渠道由，银行卡，微信，支付宝，请对应相应的渠道进行充值并填写对应的用户名及账号（务必填写正确的用户名及账号，否则出现不到账，转错账的结果，平台概不负责）。当您信誉积分达到10000分时，则不再需要充值保证金即可获得利润。', 'mine-field', '0', '0', '0');
INSERT INTO `ysk_news` VALUES ('10', '1. 新会员抢单时，必须先绑定收款码。', '', '0', '', '1575302754', '0', '用户可上传多个收款码，系统默认使用第一个，如需更换，请点击收款码停用，或者删除。系统有微信和支付宝2种收款码，分别对应微信单，和支付宝单。会员成功抢单后会有3分钟间隙时间才能继续抢第二单（保障您账户安全）', 'entrance', '0', '0', '0');
INSERT INTO `ysk_news` VALUES ('11', '维护公告', '', '0', '', '1578045845', '0', '因机房调整，现进行维护，本次维护将于2020年1月5日中午12点结束，请各位用户相互告知，也有可能会提前维护结束，请大家时刻关注平台！谢谢！', 'entrance', '0', '0', '0');
INSERT INTO `ysk_news` VALUES ('12', 'test', '', '0', '', '1588123559', '0', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈啊哈哈哈', 'entrance', '0', '0', '0');

-- ----------------------------
-- Table structure for ysk_notice
-- ----------------------------
DROP TABLE IF EXISTS `ysk_notice`;
CREATE TABLE `ysk_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_tittle` varchar(80) NOT NULL COMMENT '公告标题',
  `notice_content` varchar(600) NOT NULL COMMENT '公告详情',
  `notice_addtime` varchar(20) NOT NULL COMMENT '公告添加时间',
  `notice_read` text NOT NULL COMMENT '看过公告会员',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ysk_notice
-- ----------------------------
INSERT INTO `ysk_notice` VALUES ('2', 'localhost', 'localhost', '1563521127', 'localhost');
INSERT INTO `ysk_notice` VALUES ('3', 'paofen.youyueapp.cn', 'paofen.youyueapp.cn', '1563540736', 'paofen.youyueapp.cn');
INSERT INTO `ysk_notice` VALUES ('4', 'pao.baiyipao.com', 'pao.baiyipao.com', '1563544217', 'pao.baiyipao.com');
INSERT INTO `ysk_notice` VALUES ('5', '', '', '1563605138', '');
INSERT INTO `ysk_notice` VALUES ('6', 'pao.nanguang998.com', 'pao.nanguang998.com', '1563608986', 'pao.nanguang998.com');
INSERT INTO `ysk_notice` VALUES ('7', 'pao.gcjr1688.com', 'pao.gcjr1688.com', '1563609083', 'pao.gcjr1688.com');
INSERT INTO `ysk_notice` VALUES ('8', 'pao.zhizunagent.com', 'pao.zhizunagent.com', '1563779095', 'pao.zhizunagent.com');
INSERT INTO `ysk_notice` VALUES ('9', 'paofen.qiuziguanyin.cn', 'paofen.qiuziguanyin.cn', '1563934862', 'paofen.qiuziguanyin.cn');

-- ----------------------------
-- Table structure for ysk_qrcode
-- ----------------------------
DROP TABLE IF EXISTS `ysk_qrcode`;
CREATE TABLE `ysk_qrcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `uname` varchar(225) NOT NULL COMMENT '会员名称',
  `code_class` int(2) NOT NULL COMMENT '二维码类型1支付宝2微信3银行卡',
  `code_url` varchar(225) NOT NULL COMMENT '二维码图片地址',
  `uaccount` varchar(225) NOT NULL COMMENT '会员账号',
  `code_acc` varchar(225) NOT NULL COMMENT '二维码账号，如支付宝账号',
  `addtime` varchar(225) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='二维码管理';

-- ----------------------------
-- Records of ysk_qrcode
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_recharge
-- ----------------------------
DROP TABLE IF EXISTS `ysk_recharge`;
CREATE TABLE `ysk_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `account` varchar(225) NOT NULL COMMENT '会员账号',
  `name` varchar(225) NOT NULL COMMENT '姓名',
  `price` float(10,2) NOT NULL COMMENT '充值金额',
  `way` int(11) NOT NULL COMMENT '充值方式：1支付宝2微信3银行卡',
  `addtime` varchar(225) NOT NULL COMMENT '充值日期',
  `status` int(11) NOT NULL COMMENT '充值状态1提交，2退回，3成功',
  `marker` varchar(225) NOT NULL COMMENT '备注',
  `pic` varchar(225) NOT NULL COMMENT '凭证',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员充值表';

-- ----------------------------
-- Records of ysk_recharge
-- ----------------------------
INSERT INTO `ysk_recharge` VALUES ('1', '9', '13800138000', '123123', '3000.00', '3', '1574663884', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('2', '159', '13931091933', '士大夫', '5000.00', '3', '1574669193', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('3', '159', '13931091933', '123123', '3000.00', '3', '1574670573', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('4', '157', '18731028899', '刘海', '2000.00', '3', '1574670655', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('5', '157', '18731028899', '刘海', '3000.00', '3', '1574672348', '2', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('6', '157', '18731028899', '刘海', '3000.00', '3', '1574672357', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('7', '160', '14033033330', 'dfdfdf', '3000.00', '3', '1574746466', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('8', '152', '13111112222', '12331313', '3000.00', '3', '1574747944', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('9', '159', '13931091933', '123123', '3000.00', '3', '1574750861', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('10', '9', '13800138000', '1000', '1000.00', '3', '1574927290', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('11', '159', '13931091933', '123456', '1500.00', '3', '1574996466', '3', '江西银行', '');
INSERT INTO `ysk_recharge` VALUES ('12', '159', '13931091933', '121212', '500.00', '3', '1575002481', '2', '121221', '');
INSERT INTO `ysk_recharge` VALUES ('13', '159', '13931091933', '12345', '500.00', '3', '1575003618', '2', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('14', '159', '13931091933', '给李磊', '500.00', '2', '1575015926', '2', '极力', '');
INSERT INTO `ysk_recharge` VALUES ('15', '159', '13931091933', '122121', '500.00', '1', '1575015964', '2', '', '');
INSERT INTO `ysk_recharge` VALUES ('16', '159', '13931091933', '121212', '500.00', '3', '1575016006', '2', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('17', '159', '13931091933', '123132123', '3000.00', '1', '1575017644', '3', '121321', '');
INSERT INTO `ysk_recharge` VALUES ('18', '159', '13931091933', '12121', '1000.00', '3', '1575018610', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('19', '159', '13931091933', '刘德华', '2001.00', '1', '1575261114', '3', '尬茶', '');
INSERT INTO `ysk_recharge` VALUES ('20', '159', '13931091933', '干净利落', '500.00', '3', '1575261673', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('21', '159', '13931091933', '改了', '500.00', '1', '1575261690', '2', '', '');
INSERT INTO `ysk_recharge` VALUES ('22', '159', '13931091933', '急急急', '500.00', '2', '1575261703', '3', '', '');
INSERT INTO `ysk_recharge` VALUES ('23', '159', '13931091933', '支付宝', '5001.00', '1', '1575262796', '3', '支付宝', '');
INSERT INTO `ysk_recharge` VALUES ('24', '159', '13931091933', '微信', '2001.00', '2', '1575262819', '3', '微信', '');
INSERT INTO `ysk_recharge` VALUES ('25', '159', '13931091933', '银行卡', '2001.00', '3', '1575262837', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('26', '159', '13931091933', '极力', '501.00', '2', '1575277328', '2', '极力', '');
INSERT INTO `ysk_recharge` VALUES ('27', '159', '13931091933', '给李磊', '500.00', '2', '1575277471', '2', '', '');
INSERT INTO `ysk_recharge` VALUES ('28', '159', '13931091933', '极力', '501.00', '2', '1575277790', '3', '给李磊', '');
INSERT INTO `ysk_recharge` VALUES ('29', '159', '13931091933', '11111', '5001.00', '3', '1575293593', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('30', '159', '13931091933', '122121', '5001.00', '2', '1575293669', '3', '12121', '');
INSERT INTO `ysk_recharge` VALUES ('31', '159', '13931091933', '急急急', '5001.00', '1', '1575293702', '3', '机会来了', '');
INSERT INTO `ysk_recharge` VALUES ('32', '152', '13111112222', '上心', '1001.00', '1', '1575294432', '3', '123456', '');
INSERT INTO `ysk_recharge` VALUES ('33', '155', '13100006666', 'weixin', '10000.00', '1', '1575296422', '3', 'weixin', '');
INSERT INTO `ysk_recharge` VALUES ('36', '73', 'admin', 'hhh', '501.00', '3', '1575777234', '2', '齐鲁银行', '');
INSERT INTO `ysk_recharge` VALUES ('37', '73', 'admin', 'hhh', '501.00', '3', '1575777235', '2', '齐鲁银行', '');
INSERT INTO `ysk_recharge` VALUES ('38', '9', '13800138000', '张三', '501.00', '1', '1575886604', '3', '测试', '');
INSERT INTO `ysk_recharge` VALUES ('39', '9', '13800138000', '12231', '501.00', '3', '1575887886', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('40', '9', '13800138000', '22', '10000.00', '1', '1576731980', '3', '222', '');
INSERT INTO `ysk_recharge` VALUES ('41', '9', '13800138000', '111', '10000.00', '3', '1576733250', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('42', '9', '13800138000', '111', '8001.00', '3', '1576733281', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('43', '9', '13800138000', '22', '5001.00', '3', '1576733299', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('44', '9', '13800138000', '333', '8001.00', '3', '1576733363', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('46', '9', '13800138000', '333', '45000.00', '3', '1576733407', '3', '中国光大银行', '');
INSERT INTO `ysk_recharge` VALUES ('47', '9', '13800138000', '张嘉尔', '3500.00', '1', '1576733607', '3', '客户新资', '');
INSERT INTO `ysk_recharge` VALUES ('48', '9', '13800138000', '22', '8001.00', '3', '1576733639', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('49', '9', '13800138000', 'ss', '3650.00', '3', '1576733763', '2', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('50', '9', '13800138000', 'bbb', '9600.00', '3', '1576733798', '2', '华夏银行', '');
INSERT INTO `ysk_recharge` VALUES ('51', '9', '13800138000', 'vvv', '18000.00', '3', '1576733821', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('52', '9', '13800138000', '22', '8960.00', '1', '1576733891', '3', '22', '');
INSERT INTO `ysk_recharge` VALUES ('53', '9', '13800138000', '333', '8900.00', '3', '1576733936', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('54', '9', '13800138000', '2222', '6000.00', '3', '1576734011', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('55', '9', '13800138000', '2222', '49999.00', '3', '1576734079', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('56', '9', '13800138000', '2222', '5966.00', '3', '1576734143', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('58', '171', '18846433059', '李刚', '1001.00', '1', '1577862445', '3', '18846433059', '');
INSERT INTO `ysk_recharge` VALUES ('59', '166', '18022484190', '陈冬明', '1001.00', '3', '1577971579', '2', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('60', '179', '15665431432', '余晨曦', '5001.00', '3', '1578024866', '2', '民生银行', '');
INSERT INTO `ysk_recharge` VALUES ('61', '179', '15665431432', '余晨曦', '5001.00', '3', '1578025037', '3', '民生银行', '');
INSERT INTO `ysk_recharge` VALUES ('62', '166', '18022484190', '陈冬明', '1001.00', '3', '1578026911', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('63', '165', '14725836900', '15开', '100000.00', '3', '1578027035', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('64', '172', '18075031017', '123456', '1001.00', '3', '1578028515', '1', '齐鲁银行', '');
INSERT INTO `ysk_recharge` VALUES ('65', '172', '18075031017', '荣发涛', '1001.00', '3', '1578031100', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('66', '172', '18075031017', '荣发涛', '1001.00', '3', '1578032291', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('67', '172', '18075031017', '荣发涛', '1001.00', '3', '1578032688', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('68', '172', '18075031017', '荣发涛', '1001.00', '3', '1578034848', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('69', '169', '18928696507', '陈超威', '2001.00', '3', '1578037579', '3', '民生银行', '');
INSERT INTO `ysk_recharge` VALUES ('70', '165', '14725836900', '哦哦哦', '50000.00', '3', '1578041417', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('71', '193', '15838717882', '秦守博', '5001.00', '3', '1578043164', '3', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('72', '195', '13153688111', '习近平', '5001.00', '3', '1578135142', '2', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('73', '193', '15838717882', '秦守博', '10000.00', '3', '1578275595', '2', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('74', '196', '17703945962', '郭义文', '10000.00', '2', '1578298187', '2', '', '');
INSERT INTO `ysk_recharge` VALUES ('75', '206', '15518888888', '李家', '10000.00', '3', '1578305281', '1', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('76', '199', '13398322087', '欧波', '3000.00', '3', '1578315547', '1', '中国邮储银行', '');
INSERT INTO `ysk_recharge` VALUES ('77', '199', '13398322087', '欧波', '3000.00', '3', '1578315691', '3', '中国邮储银行', '');
INSERT INTO `ysk_recharge` VALUES ('78', '199', '13398322087', '欧波', '2955.00', '3', '1578318509', '3', '中国邮储银行', '');
INSERT INTO `ysk_recharge` VALUES ('79', '199', '13398322087', '欧波', '2499.00', '3', '1578319276', '3', '中国邮储银行', '');
INSERT INTO `ysk_recharge` VALUES ('80', '193', '15838717882', '你爹妈', '10000.00', '3', '1578456457', '1', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('81', '193', '15838717882', '骗子死全家', '10000.00', '3', '1578456481', '1', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('82', '193', '15838717882', '骗子死全家', '10000.00', '3', '1578522380', '1', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('83', '193', '15838717882', '偷税漏税王八蛋', '10000.00', '3', '1578522393', '1', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('84', '193', '15838717882', '偷税漏税王八蛋', '10000.00', '3', '1578522401', '1', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('85', '169', '18928696507', '陈超威', '10000.00', '3', '1578843518', '1', '中国工商银行', '');
INSERT INTO `ysk_recharge` VALUES ('86', '169', '18928696507', '陈超威', '10000.00', '3', '1578856563', '3', '中国建设银行', '');
INSERT INTO `ysk_recharge` VALUES ('87', '21', '13888888888', 'XIA', '1001.00', '1', '1587867658', '3', 'test', '');
INSERT INTO `ysk_recharge` VALUES ('88', '21', '13888888888', 'XIA', '1001.00', '2', '1587971150', '1', 'test', '');
INSERT INTO `ysk_recharge` VALUES ('89', '9', '13800138000', '小虾', '2001.00', '2', '1587977618', '1', '1', '');
INSERT INTO `ysk_recharge` VALUES ('90', '9', '13800138000', '小虾', '1001.00', '3', '1588038088', '1', '中国工商银行', '');

-- ----------------------------
-- Table structure for ysk_roborder
-- ----------------------------
DROP TABLE IF EXISTS `ysk_roborder`;
CREATE TABLE `ysk_roborder` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `idewm` int(11) DEFAULT NULL COMMENT '匹配二维码id',
  `class` int(2) NOT NULL COMMENT '收款类型',
  `price` float(10,2) NOT NULL COMMENT '收款金额',
  `addtime` varchar(225) NOT NULL COMMENT '添加时间',
  `status` int(2) NOT NULL COMMENT '订单状态',
  `uid` int(11) NOT NULL COMMENT '匹配用户ID',
  `uname` varchar(225) NOT NULL COMMENT '匹配用户名称',
  `umoney` float(10,2) NOT NULL COMMENT '匹配用户余额',
  `pipeitime` varchar(225) NOT NULL COMMENT '匹配时间',
  `finishtime` varchar(225) NOT NULL COMMENT '完成时间',
  `ordernum` varchar(225) NOT NULL COMMENT '订单号',
  `class2` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `shanghu_name` varchar(255) DEFAULT NULL,
  `zduid` int(11) DEFAULT NULL COMMENT '指定单',
  `province` varchar(255) DEFAULT NULL COMMENT '订单省份',
  `city` varchar(255) DEFAULT NULL COMMENT '订单市区',
  `notify_url` varchar(255) DEFAULT '' COMMENT '回调路径',
  `notify_status` int(2) DEFAULT '0' COMMENT '回调状态1是成功，0是未回调',
  `fail_num` int(2) DEFAULT '0' COMMENT '失败次数',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `class` (`class`,`price`,`addtime`) USING BTREE,
  KEY `status` (`status`,`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=400 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='抢单表';

-- ----------------------------
-- Records of ysk_roborder
-- ----------------------------
INSERT INTO `ysk_roborder` VALUES ('139', '85', '2', '100.00', '1574928276', '3', '9', '56700000', '95134.57', '1574943983', '', 'N408660869886', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('140', '86', '2', '200.00', '1575002761', '3', '159', '', '6015.50', '1575002777', '', 'N023791160203', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('141', '86', '2', '200.00', '1575002761', '3', '159', '', '5817.50', '1575002838', '', 'N023791160203', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('142', '86', '2', '200.00', '1575002761', '3', '159', '', '5619.50', '1575002995', '', 'N023791160203', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('143', '86', '2', '300.00', '1575003047', '3', '159', '', '5221.50', '1575003401', '', 'N109067989069', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('144', '86', '2', '300.00', '1575003047', '3', '159', '', '4924.50', '1575003459', '', 'N109067989069', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('145', '85', '2', '300.00', '1575003047', '2', '9', '15566667777', '95135.57', '1575011432', '', 'N109067989069', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('146', '86', '2', '300.00', '1575003047', '2', '159', '13931091933', '1027.50', '1575018691', '', 'N109067989069', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('147', '85', '2', '300.00', '1575003047', '2', '9', '15566667777', '94838.57', '1575018289', '', 'N109067989069', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('148', '85', '2', '300.00', '1575011475', '3', '9', '56700000', '94835.57', '1575013189', '', 'N293306150044', null, null, null, '9', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('149', '86', '2', '900.00', '1575019217', '3', '159', '', '127.50', '1575019243', '', 'N518617975266', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('151', '85', '2', '500.00', '1575122004', '2', '9', '15566667777', '94838.57', '1575162866', '', 'E15751220029183', null, '1.198.29.29', 'ceshishangjia1', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('152', '86', '2', '1000.00', '1575261341', '3', '159', '', '1137.50', '1575261375', '', 'N555316056669', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('153', '86', '2', '1000.00', '1575261341', '3', '159', '', '147.50', '1575261432', '', 'N555316056669', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('154', '86', '2', '1000.00', '1575261341', '3', '159', '', '1058.50', '1575270367', '', 'N555316056669', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('155', '85', '2', '1000.00', '1575261341', '3', '9', '56700000', '93838.57', '1575276021', '', 'N555316056669', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('156', '86', '2', '1000.00', '1575261341', '2', '159', '13931091933', '1109.50', '1575276066', '', 'N555316056669', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('159', '86', '2', '4000.00', '1575271779', '3', '159', '', '1069.50', '1575271792', '', 'N067202184675', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('160', '86', '2', '1000.00', '1575277236', '3', '159', '', '16514.50', '1575293822', '', 'N291543218524', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('161', '93', '2', '1200.00', '1575291497', '3', '155', 'As', '3825.90', '1575296082', '', 'N690919360450', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('164', '93', '2', '1000.00', '1575294093', '3', '155', 'As', '2895.40', '1575296668', '', 'N881764183372', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('165', '86', '2', '1000.00', '1575294093', '3', '159', '', '97022.00', '1575311032', '', 'N881764183372', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('166', '86', '2', '1000.00', '1575294093', '3', '159', '', '18629.50', '1575303581', '', 'N881764183372', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('167', '92', '2', '1000.00', '1575294093', '3', '152', '王时尚', '2810.70', '1575294671', '', 'N881764183372', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('168', '91', '2', '1000.00', '1575294093', '3', '1', '', '5765.44', '1575294181', '', 'N881764183372', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('169', '90', '2', '100.00', '1575294905', '3', '156', '1', '6080.00', '1575297453', '', 'N008023427277', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('170', '85', '2', '100.00', '1575294905', '2', '9', '15566667777', '1000.00', '1575364667', '', 'N008023427277', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('171', '85', '2', '100.00', '1575294905', '2', '9', '15566667777', '1000.00', '1575431209', '', 'N008023427277', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('173', '94', '2', '100.00', '1575294905', '3', '156', '1', '6081.50', '1578045913', '', 'N008023427277', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('174', '92', '2', '100.00', '1575294905', '2', '152', '13111112222', '2758.05', '1575297395', '', 'N008023427277', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('175', '93', '2', '100.00', '1575294905', '3', '155', 'As', '3743.90', '1575296256', '', 'N008023427277', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('176', '92', '2', '100.00', '1575294905', '3', '152', '王时尚', '2528.70', '1575295892', '', 'N008023427277', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('177', '92', '2', '100.00', '1575294905', '3', '152', '王时尚', '2627.20', '1575295363', '', 'N008023427277', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('178', '92', '2', '100.00', '1575294905', '3', '152', '王时尚', '2725.70', '1575294927', '', 'N008023427277', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('181', '90', '2', '10000.00', '1575296459', '3', '156', '1', '6030.00', '1575296812', '', 'N958899380943', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('182', '92', '2', '10000.00', '1575296459', '3', '152', '王时尚', '2581.05', '1575296589', '', 'N958899380943', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('183', '93', '2', '10000.00', '1575296459', '3', '155', 'As', '3745.40', '1575296475', '', 'N958899380943', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('184', null, '2', '0.00', '1575303608', '2', '159', '13931091933', '19629.50', '1575303608', '', 'N824529841547', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('188', null, '2', '0.00', '1575737919', '2', '159', '13931091933', '98022.00', '1575737919', '', 'N513463935322', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('189', null, '2', '0.00', '1575737928', '2', '159', '13931091933', '98022.00', '1575737928', '', 'N513463935322', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('194', '95', '1', '500.00', '1575886712', '3', '9', '56700000', '500.00', '1575886862', '', 'E15758867096396', null, '58.57.39.236', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('195', '95', '1', '500.00', '1575886927', '3', '9', '56700000', '508.50', '1575887300', '', 'E15758869243156', null, '58.57.39.236', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('196', '95', '1', '500.00', '1575887350', '3', '9', '56700000', '16.00', '1575887384', '', 'E15758873482276', null, '58.57.39.236', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('198', '95', '1', '500.00', '1575887790', '3', '9', '56700000', '24.50', '1575887930', '', 'E15758877851077', null, '103.137.63.190', 'shh002', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('199', null, '1', '0.00', '1575966056', '2', '9', '15566667777', '524.50', '1575966056', '', 'N080163910709', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('200', null, '1', '0.00', '1575966057', '2', '9', '15566667777', '524.50', '1575966057', '', 'N080163910709', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('201', null, '1', '0.00', '1575966058', '2', '9', '15566667777', '524.50', '1575966058', '', 'N080163910709', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('202', null, '1', '0.00', '1575966059', '2', '9', '15566667777', '524.50', '1575966059', '', 'N080163910709', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('203', null, '1', '0.00', '1575966060', '2', '9', '15566667777', '524.50', '1575966060', '', 'N080163910709', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('204', null, '1', '0.00', '1575966061', '2', '9', '15566667777', '524.50', '1575966061', '', 'N080163910709', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('205', null, '1', '0.00', '1575966062', '2', '9', '15566667777', '524.50', '1575966062', '', 'N080163910709', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('206', null, '1', '0.00', '1575966064', '2', '9', '15566667777', '524.50', '1575966064', '', 'N080163910709', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('207', null, '1', '0.00', '1575966065', '3', '9', '56700000', '32.00', '1576006869', '', 'N080163910709', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('209', '96', '1', '1000.00', '1576066562', '3', '164', '张磊', '9000.00', '1576068910', '', 'N666502582464', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('210', '96', '1', '1000.15', '1576068997', '3', '164', '张磊', '8014.85', '1576069063', '', 'N902479199491', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('211', '96', '1', '500.00', '1576069184', '3', '164', '张磊', '7544.85', '1576069194', '', 'N513394259180', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('212', '96', '1', '1000.13', '1576069321', '3', '164', '张磊', '6559.72', '1576069337', '', 'N185423050755', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('230', '95', '1', '500.00', '1576731812', '3', '9', '56700000', '9566.50', '1576732053', '', 'E15767318102742', null, '36.34.29.92', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('243', '97', '2', '500.00', '1576732784', '3', '9', '56700000', '9081.50', '1576732897', '', 'E15767327827598', null, '36.34.29.92', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('244', '95', '1', '5000.00', '1576733086', '3', '9', '56700000', '763.50', '1576733118', '', 'N345807357629', null, null, null, '9', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('245', '97', '2', '1.00', '1576733163', '3', '9', '56700000', '177032.41', '1578045884', '', 'E15767331625108', null, '36.34.29.92', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('259', '98', '2', '500.00', '1576733621', '2', '9', '15566667777', '112075.50', '1576733840', '', 'E15767335934271', null, '36.34.29.92', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('260', '97', '2', '500.00', '1576735106', '3', '9', '56700000', '191400.50', '1576747082', '', 'E15767351058537', null, '36.34.29.92', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('268', '97', '2', '500.00', '1576758881', '2', '9', '15566667777', '191415.50', '1576761140', '', 'E15767588801690', null, '36.34.28.135', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('269', '98', '2', '500.00', '1576762604', '2', '9', '15566667777', '190915.50', '1576762606', '', 'E15767626037253', null, '36.34.28.135', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('279', '97', '2', '500.00', '1576779843', '3', '9', '56700000', '190415.50', '1576820902', '', 'E15767798411628', null, '36.34.28.135', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('280', '98', '2', '500.00', '1577455605', '3', '9', '56700000', '177526.91', '1578045866', '', 'E15774556023730', null, '115.53.104.202', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('282', '103', '2', '500.00', '1577890427', '3', '171', '', '501.00', '1577929159', '', 'E15778904233362', null, '115.53.67.180', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('284', '106', '3', '2000.00', '1577976415', '3', '165', '', '28000.00', '1577976462', '', 'N192884671792', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('286', null, '3', '0.00', '1577976511', '2', '165', '14725836900', '30000.00', '1577976511', '', 'N243224867838', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('287', '106', '3', '2000.00', '1577976584', '3', '165', '', '26020.00', '1577976606', '', 'N923733761342', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('288', null, '3', '0.00', '1577976673', '2', '165', '14725836900', '30000.00', '1577976673', '', 'N243224867838', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('289', '99', '3', '10000.00', '1577977043', '2', '9', '15566667777', '190430.50', '1577977047', '', 'N713415154236', null, null, null, '9', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('290', null, '3', '0.00', '1577977106', '2', '9', '15566667777', '190430.50', '1577977106', '', 'N276463817000', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('291', null, '3', '0.00', '1577977147', '2', '9', '15566667777', '190430.50', '1577977147', '', 'N276463817000', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('292', null, '3', '0.00', '1577977194', '2', '9', '15566667777', '190430.50', '1577977194', '', 'N276463817000', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('294', '106', '3', '10000.00', '1577977398', '2', '165', '14725836900', '26040.00', '1577977411', '', 'N008824784745', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('295', '100', '3', '10000.00', '1577977426', '2', '9', '15566667777', '180430.50', '1577977468', '', 'N160820079821', null, null, null, '9', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('296', null, '3', '0.00', '1577977609', '3', '9', '56700000', '180430.50', '1577977650', '', 'N496775261031', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('297', null, '3', '0.00', '1577977615', '2', '165', '14725836900', '26040.00', '1577977615', '', 'N203031086675', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('298', '100', '3', '10000.00', '1577977718', '3', '9', '56700000', '170530.50', '1577977728', '', 'N555769532297', null, null, null, '9', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('299', '109', '3', '2000.00', '1577978675', '3', '165', '', '24040.00', '1578012639', '', 'N785576694388', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('300', '100', '3', '3000.00', '1577978760', '3', '9', '56700000', '177680.50', '1577978775', '', 'N992906686706', null, null, null, '9', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('301', '109', '3', '10000.00', '1578016141', '3', '165', '', '14070.00', '1578016166', '', 'N855415491647', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('302', '109', '3', '3000.00', '1578016240', '3', '165', '', '11220.00', '1578016255', '', 'N168439070202', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('303', '109', '3', '5000.00', '1578016274', '3', '165', '', '6265.00', '1578016292', '', 'N218979350751', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('304', '95', '1', '100.00', '1578017386', '3', '9', '56700000', '177625.50', '1578017400', '', 'N085456447568', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('306', '109', '3', '2500.00', '1578017533', '3', '165', '', '3840.00', '1578018369', '', 'N552462446647', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('307', '109', '3', '2500.00', '1578017578', '3', '165', '', '1377.50', '1578018381', '', 'N472540809532', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('308', '109', '3', '10000.00', '1578026822', '3', '165', '', '91415.00', '1578027266', '', 'N808862424535', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('309', '101', '1', '350.00', '1578027349', '2', '166', '陈冬明', '501.00', '1578027557', '', 'N489270169329', null, null, null, '166', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('310', null, '1', '0.00', '1578027684', '3', '166', '', '151.00', '1578027688', '', 'N545175041604', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('311', '109', '3', '8000.00', '1578027722', '3', '165', '', '83566.47', '1578027750', '', 'N803312486644', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('312', '109', '3', '12000.00', '1578027744', '3', '165', '', '71686.47', '1578027764', '', 'N017737359555', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('313', '109', '3', '9500.00', '1578027758', '3', '165', '', '62366.47', '1578028672', '', 'N756647462778', null, null, null, '165', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('314', '109', '3', '10000.00', '1578027822', '3', '165', '', '52508.97', '1578028687', '', 'N587721382716', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('315', '109', '3', '10000.00', '1578027822', '3', '165', '', '42658.97', '1578028779', '', 'N587721382716', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('316', '109', '3', '10000.00', '1578027822', '3', '165', '', '32808.97', '1578028793', '', 'N587721382716', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('317', '109', '3', '10000.00', '1578027822', '3', '165', '', '22958.97', '1578028805', '', 'N587721382716', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('318', '109', '3', '10000.00', '1578027822', '3', '165', '', '13108.97', '1578029141', '', 'N587721382716', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('319', '109', '3', '10000.00', '1578027822', '3', '165', '', '43410.67', '1578043016', '', 'N587721382716', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('320', '109', '3', '10000.00', '1578027822', '3', '165', '', '33560.67', '1578043035', '', 'N587721382716', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('321', '100', '3', '10000.00', '1578027822', '3', '9', '56700000', '167131.42', '1578047939', '', 'N587721382716', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('322', '100', '3', '10000.00', '1578027822', '2', '9', '15566667777', '167281.42', '1578047944', '', 'N587721382716', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('323', '100', '3', '10000.00', '1578027822', '2', '9', '15566667777', '167281.42', '1578302042', '', 'N587721382716', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('324', '115', '1', '3500.00', '1578027846', '2', '179', '余晨曦', '5001.00', '1578028548', '', 'N925049230786', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('325', '116', '1', '3500.00', '1578027846', '2', '179', '余晨曦', '5001.00', '1578028868', '', 'N925049230786', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('326', '117', '1', '3500.00', '1578027846', '3', '165', '', '9758.97', '1578030408', '', 'N925049230786', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('327', '117', '1', '5000.00', '1578027862', '3', '165', '', '4807.97', '1578030420', '', 'N463680259578', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('328', '109', '3', '4500.00', '1578030828', '3', '165', '', '21626.17', '1578043157', '', 'N810348302983', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('329', '100', '3', '8500.00', '1578030841', '2', '9', '15566667777', '167281.42', '1579085206', '', 'N997188653735', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('330', '109', '3', '8500.00', '1578030841', '3', '165', '', '13193.67', '1578044401', '', 'N997188653735', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('331', '117', '1', '1500.00', '1578030857', '3', '165', '', '3389.67', '1578040970', '', 'N486015351237', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('332', '109', '3', '7700.00', '1578030869', '3', '165', '', '26010.67', '1578043075', '', 'N365341959467', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('333', '100', '3', '10000.00', '1578031269', '2', '9', '15566667777', '167281.42', '1579278749', '', 'N895504489999', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('334', '100', '3', '10000.00', '1578031269', '2', '9', '15566667777', '167281.42', '1579279150', '', 'N895504489999', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('335', '126', '3', '10000.00', '1578031269', '2', '9', '15566667777', '157281.42', '1579279161', '', 'N895504489999', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('336', '100', '3', '10000.00', '1578031269', '2', '9', '15566667777', '157281.42', '1579368932', '', 'N895504489999', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('337', '100', '3', '10000.00', '1578031269', '2', '9', '15566667777', '147281.42', '1579413246', '', 'N895504489999', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('338', '126', '3', '10000.00', '1578031269', '3', '9', '56700000', '127281.42', '1579413267', '', 'N895504489999', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('339', '100', '3', '10000.00', '1578031269', '2', '9', '15566667777', '137431.42', '1579427243', '', 'N895504489999', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('340', '100', '3', '10000.00', '1578031269', '2', '9', '15566667777', '137431.42', '1579584611', '', 'N895504489999', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('341', '100', '3', '10000.00', '1578031269', '2', '9', '15566667777', '137431.42', '1579634027', '', 'N895504489999', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('342', '126', '3', '10000.00', '1578031269', '2', '9', '15566667777', '147281.42', '1579368943', '', 'N895504489999', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('343', '119', '3', '700.00', '1578031401', '3', '172', '', '301.00', '1578031789', '', 'N891855167816', null, null, null, '172', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('344', '119', '3', '900.00', '1578032397', '3', '172', '', '412.50', '1578032525', '', 'N772066746751', null, null, null, '172', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('350', '119', '3', '500.00', '1578033156', '3', '172', '', '927.00', '1578033253', '', 'N241482595936', null, null, null, '172', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('351', '119', '3', '500.00', '1578034004', '3', '172', '', '434.50', '1578034129', '', 'N490521744878', null, null, null, '172', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('352', '123', '3', '5000.00', '1578045998', '3', '193', '', '1.00', '1578317016', '', 'N103610514613', null, null, null, '193', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('353', '123', '3', '5000.00', '1578047450', '2', '193', '秦守博', '5001.00', '1578048285', '', 'N995136209522', null, null, null, '193', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('354', '128', '3', '3000.00', '1578317002', '3', '199', '', '0.00', '1578317555', '', 'N702094962345', null, null, null, '199', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('355', '128', '3', '2500.00', '1578318795', '3', '199', '', '500.00', '1578318944', '', 'N005415200054', null, null, null, '199', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('356', '133', '1', '500.00', '1587867059', '3', '21', '谢', '22597.60', '1587867502', '', 'N722794217288', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('357', '133', '1', '500.00', '1587867059', '3', '21', '谢', '23105.60', '1587867711', '', 'N722794217288', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('358', '133', '1', '500.00', '1587867059', '3', '21', '谢', '22612.60', '1587868262', '', 'N722794217288', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('364', '134', '3', '100.00', '1587868288', '2', '21', '13033556688', '22619.60', '1587868297', '', 'N663946979633', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('370', '133', '1', '1000.00', '1587870259', '3', '21', '谢', '21519.60', '1587870711', '', 'E1587870257189', null, '127.0.0.1', 'shh001', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('371', '133', '1', '1000.00', '1587871068', '3', '21', '谢', '20633.60', '1587871105', '', 'E15878710659963', null, '127.0.0.1', 'admin', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('383', '133', '1', '500.00', '1587951167', '2', '21', '13033556688', '20647.60', '1587951194', '', 'E1587951166809', null, '127.0.0.1', 'shh001', null, '广东', '广州', '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('384', '133', '1', '500.00', '1587952523', '3', '21', '谢', '20147.60', '1587956123', '', 'E15879525223887', null, '127.0.0.1', 'admin', null, '广东', '广州', '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('385', '133', '1', '500.00', '1587956151', '3', '21', '谢', '19654.60', '1587956166', '', 'E15879561471039', null, '127.0.0.1', 'admin', null, '广东', '广州', '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('386', '135', '2', '500.00', '1587971608', '2', '21', '13033556688', '19661.60', '1587971633', '', 'E15879716075171', null, '127.0.0.1', 'admin', null, '广东', '广州', '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('390', '133', '1', '500.00', '1588039778', '3', '21', '谢', '19161.60', '1588039946', '', 'E15880397789009', null, '127.0.0.1', 'admin', null, '广东', '广州', '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('391', '133', '1', '500.00', '1588064719', '3', '21', '谢', '22669.60', '1588064741', '', 'E15880647190001379', null, '127.0.0.1', '222', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('392', '135', '2', '500.00', '1588064750', '3', '21', '谢', '22176.60', '1588064764', '', 'E15880647500006391', null, '127.0.0.1', '222', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('394', '133', '1', '500.00', '1588123357', '3', '21', '谢', '21682.10', '1588123718', '', 'N398166344525', null, null, null, '21', null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('395', null, '2', '0.00', '1588123370', '3', '21', '谢', '21689.10', '1588123726', '', 'N061617129936', null, null, null, null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('396', '133', '1', '500.00', '1588131003', '3', '21', '谢', '21194.60', '1588131091', '', 'E15881309980006329', null, '127.0.0.1', '222', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('398', '135', '2', '500.00', '1588131083', '3', '21', '谢', '20701.60', '1588131108', '', 'E15881310570005760', null, '127.0.0.1', '222', null, null, null, '', '0', '0');
INSERT INTO `ysk_roborder` VALUES ('399', '135', '2', '500.00', '1588132017', '2', '21', '13033556688', '20707.10', '1588132021', '', 'E15881320160003175', null, '127.0.0.1', '222', null, null, null, '', '0', '0');

-- ----------------------------
-- Table structure for ysk_skm
-- ----------------------------
DROP TABLE IF EXISTS `ysk_skm`;
CREATE TABLE `ysk_skm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wxewm` varchar(225) NOT NULL,
  `zfbewm` varchar(225) NOT NULL,
  `bankewm` varchar(225) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='收款码';

-- ----------------------------
-- Records of ysk_skm
-- ----------------------------
INSERT INTO `ysk_skm` VALUES ('1', '2020pay/2020-04-29/5ea8d78b8b54b.png', '2020pay/2020-04-20/5e9d417235dd3.png', '2020pay/2020-04-20/5e9d417236874.png');

-- ----------------------------
-- Table structure for ysk_somebill
-- ----------------------------
DROP TABLE IF EXISTS `ysk_somebill`;
CREATE TABLE `ysk_somebill` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `jl_class` int(11) NOT NULL DEFAULT '0' COMMENT '流水类别：1佣金2团队奖励3充值4提现5订单匹配 6 BC充值',
  `info` varchar(225) NOT NULL COMMENT '说明',
  `addtime` varchar(225) NOT NULL COMMENT '事件时间',
  `jc_class` varchar(225) NOT NULL COMMENT '分+ 或-',
  `num` float(10,2) NOT NULL COMMENT '币量',
  `xjuid` int(10) DEFAULT NULL COMMENT '来自谁的提成',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `jc_class` (`jc_class`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=411 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员流水账单';

-- ----------------------------
-- Records of ysk_somebill
-- ----------------------------
INSERT INTO `ysk_somebill` VALUES ('1', '9', '1', '佣金收入+', '1574597961', '+', '0.50', null);
INSERT INTO `ysk_somebill` VALUES ('2', '9', '6', '充值100.00确认-', '1574597961', '-', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('3', '9', '3', '充值+', '1574663900', '+', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('4', '9', '1', '佣金收入+', '1574668728', '+', '17.50', null);
INSERT INTO `ysk_somebill` VALUES ('5', '9', '6', '充值3500.00确认-', '1574668728', '-', '3500.00', null);
INSERT INTO `ysk_somebill` VALUES ('6', '9', '1', '佣金收入+', '1574668881', '+', '2.50', null);
INSERT INTO `ysk_somebill` VALUES ('7', '9', '6', '充值500.00确认-', '1574668881', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('8', '159', '3', '充值+', '1574669275', '+', '5000.00', null);
INSERT INTO `ysk_somebill` VALUES ('9', '157', '3', '充值+', '1574670688', '+', '2000.00', null);
INSERT INTO `ysk_somebill` VALUES ('10', '159', '1', '佣金收入+', '1574671225', '+', '2.50', null);
INSERT INTO `ysk_somebill` VALUES ('11', '159', '6', '充值500.00确认-', '1574671225', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('12', '157', '3', '充值+', '1574672417', '+', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('13', '157', '1', '佣金收入+', '1574672582', '+', '2.50', null);
INSERT INTO `ysk_somebill` VALUES ('14', '157', '6', '充值500.00确认-', '1574672582', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('15', '157', '1', '佣金收入+', '1574672922', '+', '17.50', null);
INSERT INTO `ysk_somebill` VALUES ('16', '157', '6', '充值3500.00确认-', '1574672922', '-', '3500.00', null);
INSERT INTO `ysk_somebill` VALUES ('17', '157', '1', '佣金收入+', '1574673233', '+', '2.50', null);
INSERT INTO `ysk_somebill` VALUES ('18', '157', '6', '充值500.00确认-', '1574673233', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('19', '159', '1', '佣金收入+', '1574739352', '+', '1.00', null);
INSERT INTO `ysk_somebill` VALUES ('20', '159', '6', '充值200.00确认-', '1574739352', '-', '200.00', null);
INSERT INTO `ysk_somebill` VALUES ('21', '159', '1', '佣金收入+', '1574739415', '+', '2.50', null);
INSERT INTO `ysk_somebill` VALUES ('22', '159', '6', '充值500.00确认-', '1574739415', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('23', '159', '1', '佣金收入+', '1574739577', '+', '2.50', null);
INSERT INTO `ysk_somebill` VALUES ('24', '159', '6', '充值500.00确认-', '1574739577', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('25', '159', '1', '佣金收入+', '1574741496', '+', '2.50', null);
INSERT INTO `ysk_somebill` VALUES ('26', '159', '6', '充值500确认-', '1574741496', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('27', '159', '1', '佣金收入+', '1574745145', '+', '2.50', null);
INSERT INTO `ysk_somebill` VALUES ('28', '159', '6', '充值500.00确认-', '1574745145', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('29', '159', '3', '充值+', '1574745442', '+', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('30', '159', '1', '佣金收入+', '1574745577', '+', '2.50', null);
INSERT INTO `ysk_somebill` VALUES ('31', '159', '6', '充值500.00确认-', '1574745577', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('32', '159', '1', '佣金收入+', '1574745650', '+', '2.50', null);
INSERT INTO `ysk_somebill` VALUES ('33', '159', '6', '充值500.00确认-', '1574745650', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('34', '159', '1', '佣金收入+', '1574745786', '+', '5.00', null);
INSERT INTO `ysk_somebill` VALUES ('35', '159', '6', '充值1000.00确认-', '1574745786', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('36', '159', '1', '佣金收入+', '1574745931', '+', '10.00', null);
INSERT INTO `ysk_somebill` VALUES ('37', '159', '6', '充值1000.00确认-', '1574745931', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('38', '160', '3', '充值+', '1574746486', '+', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('39', '156', '1', '佣金收入+', '1574747393', '+', '10.00', null);
INSERT INTO `ysk_somebill` VALUES ('40', '156', '6', '充值1000.00确认-', '1574747393', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('41', '155', '1', '直推抢单成功佣金', '1574747393', '+', '2.20', '156');
INSERT INTO `ysk_somebill` VALUES ('42', '152', '1', '二代抢单成功佣金', '1574747393', '+', '1.50', '156');
INSERT INTO `ysk_somebill` VALUES ('43', '1', '1', '三代抢单成功佣金', '1574747393', '+', '1.00', '156');
INSERT INTO `ysk_somebill` VALUES ('44', '156', '1', '佣金收入+', '1574747515', '+', '10.00', null);
INSERT INTO `ysk_somebill` VALUES ('45', '156', '6', '充值1000.00确认-', '1574747515', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('46', '155', '1', '直推抢单成功佣金', '1574747515', '+', '2.20', '156');
INSERT INTO `ysk_somebill` VALUES ('47', '152', '1', '二代抢单成功佣金', '1574747515', '+', '1.50', '156');
INSERT INTO `ysk_somebill` VALUES ('48', '1', '1', '三代抢单成功佣金', '1574747515', '+', '1.00', '156');
INSERT INTO `ysk_somebill` VALUES ('49', '155', '1', '佣金收入+', '1574747676', '+', '10.00', null);
INSERT INTO `ysk_somebill` VALUES ('50', '155', '6', '充值1000.00确认-', '1574747676', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('51', '152', '1', '直推抢单成功佣金', '1574747676', '+', '2.20', '155');
INSERT INTO `ysk_somebill` VALUES ('52', '1', '1', '二代抢单成功佣金', '1574747676', '+', '1.50', '155');
INSERT INTO `ysk_somebill` VALUES ('53', '152', '3', '充值+', '1574748083', '+', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('54', '152', '1', '佣金收入+', '1574748161', '+', '2.00', null);
INSERT INTO `ysk_somebill` VALUES ('55', '152', '6', '充值200.00确认-', '1574748161', '-', '200.00', null);
INSERT INTO `ysk_somebill` VALUES ('56', '1', '1', '直推抢单成功佣金', '1574748161', '+', '0.44', '152');
INSERT INTO `ysk_somebill` VALUES ('57', '159', '1', '佣金收入+', '1574750717', '+', '2.00', null);
INSERT INTO `ysk_somebill` VALUES ('58', '159', '6', '充值200.00确认-', '1574750717', '-', '200.00', null);
INSERT INTO `ysk_somebill` VALUES ('59', '159', '1', '佣金收入+', '1574751081', '+', '2.00', null);
INSERT INTO `ysk_somebill` VALUES ('60', '159', '6', '充值200.00确认-', '1574751081', '-', '200.00', null);
INSERT INTO `ysk_somebill` VALUES ('61', '159', '3', '充值+', '1574751115', '+', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('62', '9', '4', '提现-', '1574927253', '1', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('63', '9', '1', '佣金收入+', '1574927546', '+', '1.00', null);
INSERT INTO `ysk_somebill` VALUES ('64', '9', '6', '充值100.00确认-', '1574927546', '-', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('65', '9', '3', '充值+', '1574927826', '+', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('66', '9', '1', '佣金收入+', '1574943983', '+', '1.00', null);
INSERT INTO `ysk_somebill` VALUES ('67', '9', '6', '充值100.00确认-', '1574943983', '-', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('68', '159', '4', '提现-', '1574996429', '1', '222.00', null);
INSERT INTO `ysk_somebill` VALUES ('69', '159', '3', '充值+', '1574996660', '+', '1500.00', null);
INSERT INTO `ysk_somebill` VALUES ('70', '159', '1', '佣金收入+', '1575002777', '+', '2.00', null);
INSERT INTO `ysk_somebill` VALUES ('71', '159', '6', '充值200.00确认-', '1575002777', '-', '200.00', null);
INSERT INTO `ysk_somebill` VALUES ('72', '159', '1', '佣金收入+', '1575002838', '+', '2.00', null);
INSERT INTO `ysk_somebill` VALUES ('73', '159', '6', '充值200.00确认-', '1575002838', '-', '200.00', null);
INSERT INTO `ysk_somebill` VALUES ('74', '159', '1', '佣金收入+', '1575002995', '+', '2.00', null);
INSERT INTO `ysk_somebill` VALUES ('75', '159', '6', '充值200.00确认-', '1575002995', '-', '200.00', null);
INSERT INTO `ysk_somebill` VALUES ('76', '159', '4', '提现-', '1575003322', '1', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('77', '159', '1', '佣金收入+', '1575003401', '+', '3.00', null);
INSERT INTO `ysk_somebill` VALUES ('78', '159', '6', '充值300.00确认-', '1575003401', '-', '300.00', null);
INSERT INTO `ysk_somebill` VALUES ('79', '159', '1', '佣金收入+', '1575003459', '+', '3.00', null);
INSERT INTO `ysk_somebill` VALUES ('80', '159', '6', '充值300.00确认-', '1575003459', '-', '300.00', null);
INSERT INTO `ysk_somebill` VALUES ('81', '9', '1', '佣金收入+', '1575013189', '+', '3.00', null);
INSERT INTO `ysk_somebill` VALUES ('82', '9', '6', '充值300.00确认-', '1575013189', '-', '300.00', null);
INSERT INTO `ysk_somebill` VALUES ('83', '159', '4', '提现-', '1575017523', '1', '4900.00', null);
INSERT INTO `ysk_somebill` VALUES ('84', '159', '3', '充值+', '1575017750', '+', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('85', '159', '4', '提现-', '1575017880', '1', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('86', '159', '3', '充值+', '1575018623', '+', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('87', '159', '1', '佣金收入+', '1575019243', '+', '9.00', null);
INSERT INTO `ysk_somebill` VALUES ('88', '159', '6', '充值900.00确认-', '1575019243', '-', '900.00', null);
INSERT INTO `ysk_somebill` VALUES ('89', '159', '3', '充值+', '1575261129', '+', '2001.00', null);
INSERT INTO `ysk_somebill` VALUES ('90', '159', '1', '佣金收入+', '1575261375', '+', '10.00', null);
INSERT INTO `ysk_somebill` VALUES ('91', '159', '6', '充值1000.00确认-', '1575261375', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('92', '159', '1', '佣金收入+', '1575261432', '+', '10.00', null);
INSERT INTO `ysk_somebill` VALUES ('93', '159', '6', '充值1000.00确认-', '1575261432', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('94', '159', '4', '提现-', '1575261544', '1', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('95', '159', '3', '充值+', '1575261985', '+', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('96', '159', '3', '充值+', '1575262003', '+', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('97', '159', '4', '提现-', '1575262171', '1', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('98', '159', '3', '充值+', '1575270251', '+', '2001.00', null);
INSERT INTO `ysk_somebill` VALUES ('99', '159', '1', '佣金收入+', '1575270367', '+', '10.00', null);
INSERT INTO `ysk_somebill` VALUES ('100', '159', '6', '充值1000.00确认-', '1575270367', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('101', '159', '4', '提现-', '1575270426', '1', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('102', '159', '3', '充值+', '1575271594', '+', '5001.00', null);
INSERT INTO `ysk_somebill` VALUES ('103', '159', '1', '佣金收入+', '1575271792', '+', '40.00', null);
INSERT INTO `ysk_somebill` VALUES ('104', '159', '6', '充值4000.00确认-', '1575271792', '-', '4000.00', null);
INSERT INTO `ysk_somebill` VALUES ('105', '9', '1', '佣金收入+', '1575276021', '+', '10.00', null);
INSERT INTO `ysk_somebill` VALUES ('106', '9', '6', '充值1000.00确认-', '1575276021', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('107', '159', '4', '提现-', '1575277703', '1', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('108', '159', '3', '充值+', '1575277799', '+', '501.00', null);
INSERT INTO `ysk_somebill` VALUES ('109', '159', '4', '提现-', '1575291556', '1', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('110', '159', '3', '充值+', '1575291690', '+', '2001.00', null);
INSERT INTO `ysk_somebill` VALUES ('111', '159', '3', '充值+', '1575293725', '+', '5001.00', null);
INSERT INTO `ysk_somebill` VALUES ('112', '159', '3', '充值+', '1575293728', '+', '5001.00', null);
INSERT INTO `ysk_somebill` VALUES ('113', '159', '3', '充值+', '1575293731', '+', '5001.00', null);
INSERT INTO `ysk_somebill` VALUES ('114', '159', '1', '佣金收入+', '1575293822', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('115', '159', '6', '充值1000.00确认-', '1575293823', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('116', '1', '1', '佣金收入+', '1575294181', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('117', '1', '6', '充值1000.00确认-', '1575294181', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('118', '152', '3', '充值+', '1575294499', '+', '1001.00', null);
INSERT INTO `ysk_somebill` VALUES ('119', '152', '1', '佣金收入+', '1575294671', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('120', '152', '6', '充值1000.00确认-', '1575294671', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('121', '1', '1', '直推抢单成功佣金', '1575294671', '+', '18.00', '152');
INSERT INTO `ysk_somebill` VALUES ('122', '152', '1', '佣金收入+', '1575294927', '+', '1.50', null);
INSERT INTO `ysk_somebill` VALUES ('123', '152', '6', '充值100.00确认-', '1575294927', '-', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('124', '1', '1', '直推抢单成功佣金', '1575294927', '+', '1.80', '152');
INSERT INTO `ysk_somebill` VALUES ('125', '152', '1', '佣金收入+', '1575295363', '+', '1.50', null);
INSERT INTO `ysk_somebill` VALUES ('126', '152', '6', '充值100.00确认-', '1575295363', '-', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('127', '1', '1', '直推抢单成功佣金', '1575295363', '+', '0.15', '152');
INSERT INTO `ysk_somebill` VALUES ('128', '152', '1', '佣金收入+', '1575295892', '+', '1.50', null);
INSERT INTO `ysk_somebill` VALUES ('129', '152', '6', '充值100.00确认-', '1575295892', '-', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('130', '1', '1', '直推抢单成功佣金', '1575295892', '+', '0.45', '152');
INSERT INTO `ysk_somebill` VALUES ('131', '155', '1', '佣金收入+', '1575296082', '+', '18.00', null);
INSERT INTO `ysk_somebill` VALUES ('132', '155', '6', '充值1200.00确认-', '1575296082', '-', '1200.00', null);
INSERT INTO `ysk_somebill` VALUES ('133', '152', '1', '直推抢单成功佣金', '1575296082', '+', '5.40', '155');
INSERT INTO `ysk_somebill` VALUES ('134', '1', '1', '二代抢单成功佣金', '1575296082', '+', '2.70', '155');
INSERT INTO `ysk_somebill` VALUES ('135', '155', '1', '佣金收入+', '1575296256', '+', '1.50', null);
INSERT INTO `ysk_somebill` VALUES ('136', '155', '6', '充值100.00确认-', '1575296256', '-', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('137', '152', '1', '直推抢单成功佣金', '1575296256', '+', '0.45', '155');
INSERT INTO `ysk_somebill` VALUES ('138', '1', '1', '二代抢单成功佣金', '1575296256', '+', '0.22', '155');
INSERT INTO `ysk_somebill` VALUES ('139', '155', '3', '充值+', '1575296438', '+', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('140', '155', '1', '佣金收入+', '1575296475', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('141', '155', '6', '充值10000.00确认-', '1575296475', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('142', '152', '1', '直推抢单成功佣金', '1575296475', '+', '45.00', '155');
INSERT INTO `ysk_somebill` VALUES ('143', '1', '1', '二代抢单成功佣金', '1575296475', '+', '22.50', '155');
INSERT INTO `ysk_somebill` VALUES ('144', '152', '3', '充值+', '1575296574', '+', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('145', '152', '1', '佣金收入+', '1575296589', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('146', '152', '6', '充值10000.00确认-', '1575296589', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('147', '1', '1', '直推抢单成功佣金', '1575296589', '+', '45.00', '152');
INSERT INTO `ysk_somebill` VALUES ('148', '155', '1', '佣金收入+', '1575296668', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('149', '155', '6', '充值1000.00确认-', '1575296668', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('150', '152', '1', '直推抢单成功佣金', '1575296668', '+', '4.50', '155');
INSERT INTO `ysk_somebill` VALUES ('151', '1', '1', '二代抢单成功佣金', '1575296668', '+', '2.25', '155');
INSERT INTO `ysk_somebill` VALUES ('152', '156', '1', '佣金收入+', '1575296812', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('153', '156', '6', '充值10000.00确认-', '1575296812', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('154', '155', '1', '直推抢单成功佣金', '1575296812', '+', '45.00', '156');
INSERT INTO `ysk_somebill` VALUES ('155', '152', '1', '二代抢单成功佣金', '1575296812', '+', '22.50', '156');
INSERT INTO `ysk_somebill` VALUES ('156', '1', '1', '三代抢单成功佣金', '1575296812', '+', '12.00', '156');
INSERT INTO `ysk_somebill` VALUES ('157', '156', '1', '佣金收入+', '1575297453', '+', '1.50', null);
INSERT INTO `ysk_somebill` VALUES ('158', '156', '6', '充值100.00确认-', '1575297453', '-', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('159', '155', '1', '直推抢单成功佣金', '1575297453', '+', '0.45', '156');
INSERT INTO `ysk_somebill` VALUES ('160', '152', '1', '二代抢单成功佣金', '1575297453', '+', '0.22', '156');
INSERT INTO `ysk_somebill` VALUES ('161', '1', '1', '三代抢单成功佣金', '1575297453', '+', '0.12', '156');
INSERT INTO `ysk_somebill` VALUES ('162', '156', '4', '提现-', '1575298284', '1', '2000.00', null);
INSERT INTO `ysk_somebill` VALUES ('163', '156', '4', '提现-', '1575298369', '1', '2081.50', null);
INSERT INTO `ysk_somebill` VALUES ('164', '156', '6', '提现退回+', '1575298415', '+', '2081.50', null);
INSERT INTO `ysk_somebill` VALUES ('165', '156', '6', '提现退回+', '1575298439', '+', '2000.00', null);
INSERT INTO `ysk_somebill` VALUES ('166', '159', '6', '提现退回+', '1575298450', '+', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('167', '159', '6', '提现退回+', '1575298457', '+', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('168', '163', '4', '提现-', '1575301121', '1', '200.00', null);
INSERT INTO `ysk_somebill` VALUES ('169', '159', '1', '佣金收入+', '1575303581', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('170', '159', '6', '充值1000.00确认-', '1575303581', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('171', '159', '6', '提现退回+', '1575304061', '+', '4900.00', null);
INSERT INTO `ysk_somebill` VALUES ('172', '159', '6', '提现退回+', '1575307192', '+', '222.00', null);
INSERT INTO `ysk_somebill` VALUES ('173', '163', '4', '提现-', '1575310308', '1', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('174', '159', '4', '提现-', '1575310381', '1', '200.00', null);
INSERT INTO `ysk_somebill` VALUES ('175', '159', '4', '提现-', '1575310444', '1', '2000.00', null);
INSERT INTO `ysk_somebill` VALUES ('176', '159', '1', '佣金收入+', '1575311032', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('177', '159', '6', '充值1000.00确认-', '1575311032', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('178', '163', '3', '充值+', '1575362885', '+', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('179', '9', '1', '佣金收入+', '1575886862', '+', '7.50', null);
INSERT INTO `ysk_somebill` VALUES ('180', '9', '6', '充值500.00确认-', '1575886862', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('181', '9', '3', '充值+', '1575887139', '+', '501.00', null);
INSERT INTO `ysk_somebill` VALUES ('182', '9', '1', '佣金收入+', '1575887300', '+', '7.50', null);
INSERT INTO `ysk_somebill` VALUES ('183', '9', '6', '充值500.00确认-', '1575887300', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('184', '9', '1', '佣金收入+', '1575887384', '+', '7.50', null);
INSERT INTO `ysk_somebill` VALUES ('185', '9', '6', '充值500.00确认-', '1575887384', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('186', '9', '3', '充值+', '1575887903', '+', '501.00', null);
INSERT INTO `ysk_somebill` VALUES ('187', '9', '1', '佣金收入+', '1575887930', '+', '7.50', null);
INSERT INTO `ysk_somebill` VALUES ('188', '9', '6', '充值500.00确认-', '1575887930', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('189', '9', '1', '佣金收入+', '1576006869', '+', '7.50', null);
INSERT INTO `ysk_somebill` VALUES ('190', '9', '6', '充值500.00确认-', '1576006869', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('191', '164', '1', '佣金收入+', '1576068910', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('192', '164', '6', '充值1000.00确认-', '1576068910', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('193', '9', '1', '直推抢单成功佣金', '1576068910', '+', '4.50', '164');
INSERT INTO `ysk_somebill` VALUES ('194', '164', '1', '佣金收入+', '1576069063', '+', '30.00', null);
INSERT INTO `ysk_somebill` VALUES ('195', '164', '6', '充值1000.15确认-', '1576069063', '-', '1000.15', null);
INSERT INTO `ysk_somebill` VALUES ('196', '9', '1', '直推抢单成功佣金', '1576069063', '+', '9.00', '164');
INSERT INTO `ysk_somebill` VALUES ('197', '164', '1', '佣金收入+', '1576069194', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('198', '164', '6', '充值500.00确认-', '1576069194', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('199', '9', '1', '直推抢单成功佣金', '1576069194', '+', '4.50', '164');
INSERT INTO `ysk_somebill` VALUES ('200', '164', '1', '佣金收入+', '1576069337', '+', '30.00', null);
INSERT INTO `ysk_somebill` VALUES ('201', '164', '6', '充值1000.13确认-', '1576069337', '-', '1000.13', null);
INSERT INTO `ysk_somebill` VALUES ('202', '9', '1', '直推抢单成功佣金', '1576069337', '+', '9.00', '164');
INSERT INTO `ysk_somebill` VALUES ('203', '163', '6', '提现退回+', '1576323715', '+', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('204', '9', '3', '充值+', '1576732002', '+', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('205', '9', '1', '佣金收入+', '1576732053', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('206', '9', '6', '充值500.00确认-', '1576732053', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('207', '9', '1', '佣金收入+', '1576732897', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('208', '9', '6', '充值500.00确认-', '1576732897', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('209', '9', '4', '提现', '1576732958', '-', '3333.00', null);
INSERT INTO `ysk_somebill` VALUES ('210', '9', '1', '佣金收入+', '1576733118', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('211', '9', '6', '充值5000.00确认-', '1576733118', '-', '5000.00', null);
INSERT INTO `ysk_somebill` VALUES ('212', '9', '3', '充值+', '1576733260', '+', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('213', '9', '3', '充值+', '1576733318', '+', '5001.00', null);
INSERT INTO `ysk_somebill` VALUES ('214', '9', '3', '充值+', '1576733321', '+', '8001.00', null);
INSERT INTO `ysk_somebill` VALUES ('215', '9', '3', '充值+', '1576733421', '+', '45000.00', null);
INSERT INTO `ysk_somebill` VALUES ('216', '9', '3', '充值+', '1576733424', '+', '5658.00', null);
INSERT INTO `ysk_somebill` VALUES ('217', '9', '3', '充值+', '1576733427', '+', '8001.00', null);
INSERT INTO `ysk_somebill` VALUES ('218', '9', '3', '充值+', '1576733625', '+', '3500.00', null);
INSERT INTO `ysk_somebill` VALUES ('219', '9', '3', '充值+', '1576733688', '+', '8001.00', null);
INSERT INTO `ysk_somebill` VALUES ('220', '9', '3', '充值+', '1576733837', '+', '18000.00', null);
INSERT INTO `ysk_somebill` VALUES ('221', '9', '3', '充值+', '1576733901', '+', '8960.00', null);
INSERT INTO `ysk_somebill` VALUES ('222', '9', '3', '充值+', '1576734034', '+', '6000.00', null);
INSERT INTO `ysk_somebill` VALUES ('223', '9', '3', '充值+', '1576734037', '+', '8900.00', null);
INSERT INTO `ysk_somebill` VALUES ('224', '9', '3', '充值+', '1576734087', '+', '49999.00', null);
INSERT INTO `ysk_somebill` VALUES ('225', '9', '3', '充值+', '1576734182', '+', '5966.00', null);
INSERT INTO `ysk_somebill` VALUES ('226', '9', '1', '佣金收入+', '1576747082', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('227', '9', '6', '充值500.00确认-', '1576747082', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('228', '9', '1', '佣金收入+', '1576820902', '+', '15.00', null);
INSERT INTO `ysk_somebill` VALUES ('229', '9', '6', '充值500.00确认-', '1576820902', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('230', '171', '3', '充值+', '1577922199', '+', '1001.00', null);
INSERT INTO `ysk_somebill` VALUES ('231', '171', '1', '佣金收入+', '1577929159', '+', '5.00', null);
INSERT INTO `ysk_somebill` VALUES ('232', '171', '6', '充值500.00确认-', '1577929159', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('233', '165', '1', '直推抢单成功佣金', '1577929159', '+', '1.50', '171');
INSERT INTO `ysk_somebill` VALUES ('234', '171', '3', '充值+', '1577929803', '+', '1001.00', null);
INSERT INTO `ysk_somebill` VALUES ('235', '171', '4', '提现', '1577934108', '-', '1507.00', null);
INSERT INTO `ysk_somebill` VALUES ('236', '165', '1', '佣金收入+', '1577976463', '+', '20.00', null);
INSERT INTO `ysk_somebill` VALUES ('237', '165', '6', '充值2000.00确认-', '1577976463', '-', '2000.00', null);
INSERT INTO `ysk_somebill` VALUES ('238', '165', '1', '佣金收入+', '1577976606', '+', '20.00', null);
INSERT INTO `ysk_somebill` VALUES ('239', '165', '6', '充值2000.00确认-', '1577976606', '-', '2000.00', null);
INSERT INTO `ysk_somebill` VALUES ('240', '9', '1', '佣金收入+', '1577977650', '+', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('241', '9', '6', '充值10000.00确认-', '1577977650', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('242', '9', '1', '佣金收入+', '1577977728', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('243', '9', '6', '充值10000.00确认-', '1577977728', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('244', '9', '1', '佣金收入+', '1577978775', '+', '45.00', null);
INSERT INTO `ysk_somebill` VALUES ('245', '9', '6', '充值3000.00确认-', '1577978775', '-', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('246', '159', '6', '提现退回+', '1577979041', '+', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('247', '159', '6', '提现退回+', '1577979045', '+', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('248', '159', '6', '提现退回+', '1577979049', '+', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('249', '159', '6', '提现退回+', '1577979053', '+', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('250', '159', '6', '提现退回+', '1577979057', '+', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('251', '163', '6', '提现退回+', '1577979060', '+', '200.00', null);
INSERT INTO `ysk_somebill` VALUES ('252', '171', '6', '提现退回+', '1577979065', '+', '1507.00', null);
INSERT INTO `ysk_somebill` VALUES ('253', '165', '1', '佣金收入+', '1578012639', '+', '30.00', null);
INSERT INTO `ysk_somebill` VALUES ('254', '165', '6', '充值2000.00确认-', '1578012639', '-', '2000.00', null);
INSERT INTO `ysk_somebill` VALUES ('255', '165', '1', '佣金收入+', '1578016166', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('256', '165', '6', '充值10000.00确认-', '1578016166', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('257', '165', '1', '佣金收入+', '1578016255', '+', '45.00', null);
INSERT INTO `ysk_somebill` VALUES ('258', '165', '6', '充值3000.00确认-', '1578016255', '-', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('259', '165', '1', '佣金收入+', '1578016292', '+', '75.00', null);
INSERT INTO `ysk_somebill` VALUES ('260', '165', '6', '充值5000.00确认-', '1578016293', '-', '5000.00', null);
INSERT INTO `ysk_somebill` VALUES ('261', '9', '1', '佣金收入+', '1578017400', '+', '1.40', null);
INSERT INTO `ysk_somebill` VALUES ('262', '9', '6', '充值100.00确认-', '1578017400', '-', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('263', '165', '1', '佣金收入+', '1578018369', '+', '37.50', null);
INSERT INTO `ysk_somebill` VALUES ('264', '165', '6', '充值2500.00确认-', '1578018369', '-', '2500.00', null);
INSERT INTO `ysk_somebill` VALUES ('265', '165', '1', '佣金收入+', '1578018381', '+', '37.50', null);
INSERT INTO `ysk_somebill` VALUES ('266', '165', '6', '充值2500.00确认-', '1578018381', '-', '2500.00', null);
INSERT INTO `ysk_somebill` VALUES ('267', '171', '4', '提现', '1578018494', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('268', '179', '3', '充值+', '1578025850', '+', '5001.00', null);
INSERT INTO `ysk_somebill` VALUES ('269', '166', '3', '充值+', '1578026923', '+', '1001.00', null);
INSERT INTO `ysk_somebill` VALUES ('270', '165', '3', '充值+', '1578027226', '+', '100000.00', null);
INSERT INTO `ysk_somebill` VALUES ('271', '165', '1', '佣金收入+', '1578027266', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('272', '165', '6', '充值10000.00确认-', '1578027266', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('273', '166', '1', '佣金收入+', '1578027688', '+', '4.90', null);
INSERT INTO `ysk_somebill` VALUES ('274', '166', '6', '充值350.00确认-', '1578027688', '-', '350.00', null);
INSERT INTO `ysk_somebill` VALUES ('275', '165', '1', '直推抢单成功佣金', '1578027688', '+', '1.47', '166');
INSERT INTO `ysk_somebill` VALUES ('276', '165', '1', '佣金收入+', '1578027750', '+', '120.00', null);
INSERT INTO `ysk_somebill` VALUES ('277', '165', '6', '充值8000.00确认-', '1578027750', '-', '8000.00', null);
INSERT INTO `ysk_somebill` VALUES ('278', '165', '1', '佣金收入+', '1578027764', '+', '180.00', null);
INSERT INTO `ysk_somebill` VALUES ('279', '165', '6', '充值12000.00确认-', '1578027764', '-', '12000.00', null);
INSERT INTO `ysk_somebill` VALUES ('280', '165', '1', '佣金收入+', '1578028672', '+', '142.50', null);
INSERT INTO `ysk_somebill` VALUES ('281', '165', '6', '充值9500.00确认-', '1578028672', '-', '9500.00', null);
INSERT INTO `ysk_somebill` VALUES ('282', '165', '1', '佣金收入+', '1578028687', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('283', '165', '6', '充值10000.00确认-', '1578028687', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('284', '165', '1', '佣金收入+', '1578028779', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('285', '165', '6', '充值10000.00确认-', '1578028779', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('286', '165', '1', '佣金收入+', '1578028793', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('287', '165', '6', '充值10000.00确认-', '1578028793', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('288', '165', '1', '佣金收入+', '1578028805', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('289', '165', '6', '充值10000.00确认-', '1578028805', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('290', '165', '1', '佣金收入+', '1578029141', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('291', '165', '6', '充值10000.00确认-', '1578029141', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('292', '165', '1', '佣金收入+', '1578030408', '+', '49.00', null);
INSERT INTO `ysk_somebill` VALUES ('293', '165', '6', '充值3500.00确认-', '1578030408', '-', '3500.00', null);
INSERT INTO `ysk_somebill` VALUES ('294', '165', '1', '佣金收入+', '1578030420', '+', '70.00', null);
INSERT INTO `ysk_somebill` VALUES ('295', '165', '6', '充值5000.00确认-', '1578030420', '-', '5000.00', null);
INSERT INTO `ysk_somebill` VALUES ('296', '179', '4', '提现', '1578031141', '-', '5000.00', null);
INSERT INTO `ysk_somebill` VALUES ('297', '172', '3', '充值+', '1578031278', '+', '1001.00', null);
INSERT INTO `ysk_somebill` VALUES ('298', '172', '1', '佣金收入+', '1578031789', '+', '10.50', null);
INSERT INTO `ysk_somebill` VALUES ('299', '172', '6', '充值700.00确认-', '1578031789', '-', '700.00', null);
INSERT INTO `ysk_somebill` VALUES ('300', '165', '1', '直推抢单成功佣金', '1578031789', '+', '3.15', '172');
INSERT INTO `ysk_somebill` VALUES ('301', '166', '4', '提现', '1578031936', '-', '505.00', null);
INSERT INTO `ysk_somebill` VALUES ('302', '172', '3', '充值+', '1578032377', '+', '1001.00', null);
INSERT INTO `ysk_somebill` VALUES ('303', '172', '1', '佣金收入+', '1578032525', '+', '13.50', null);
INSERT INTO `ysk_somebill` VALUES ('304', '172', '6', '充值900.00确认-', '1578032525', '-', '900.00', null);
INSERT INTO `ysk_somebill` VALUES ('305', '165', '1', '直推抢单成功佣金', '1578032525', '+', '4.05', '172');
INSERT INTO `ysk_somebill` VALUES ('306', '172', '3', '充值+', '1578032724', '+', '1001.00', null);
INSERT INTO `ysk_somebill` VALUES ('307', '172', '1', '佣金收入+', '1578033253', '+', '7.50', null);
INSERT INTO `ysk_somebill` VALUES ('308', '172', '6', '充值500.00确认-', '1578033253', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('309', '165', '1', '直推抢单成功佣金', '1578033253', '+', '2.25', '172');
INSERT INTO `ysk_somebill` VALUES ('310', '172', '1', '佣金收入+', '1578034129', '+', '7.50', null);
INSERT INTO `ysk_somebill` VALUES ('311', '172', '6', '充值500.00确认-', '1578034129', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('312', '165', '1', '直推抢单成功佣金', '1578034129', '+', '2.25', '172');
INSERT INTO `ysk_somebill` VALUES ('313', '172', '3', '充值+', '1578035682', '+', '1001.00', null);
INSERT INTO `ysk_somebill` VALUES ('314', '169', '3', '充值+', '1578040442', '+', '2001.00', null);
INSERT INTO `ysk_somebill` VALUES ('315', '165', '1', '佣金收入+', '1578040970', '+', '21.00', null);
INSERT INTO `ysk_somebill` VALUES ('316', '165', '6', '充值1500.00确认-', '1578040970', '-', '1500.00', null);
INSERT INTO `ysk_somebill` VALUES ('317', '169', '4', '提现', '1578041201', '-', '2001.00', null);
INSERT INTO `ysk_somebill` VALUES ('318', '165', '3', '充值+', '1578041840', '+', '50000.00', null);
INSERT INTO `ysk_somebill` VALUES ('319', '165', '1', '佣金收入+', '1578043016', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('320', '165', '6', '充值10000.00确认-', '1578043016', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('321', '165', '1', '佣金收入+', '1578043035', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('322', '165', '6', '充值10000.00确认-', '1578043035', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('323', '165', '1', '佣金收入+', '1578043075', '+', '115.50', null);
INSERT INTO `ysk_somebill` VALUES ('324', '165', '6', '充值7700.00确认-', '1578043075', '-', '7700.00', null);
INSERT INTO `ysk_somebill` VALUES ('325', '165', '1', '佣金收入+', '1578043157', '+', '67.50', null);
INSERT INTO `ysk_somebill` VALUES ('326', '165', '6', '充值4500.00确认-', '1578043157', '-', '4500.00', null);
INSERT INTO `ysk_somebill` VALUES ('327', '193', '3', '充值+', '1578043875', '+', '5001.00', null);
INSERT INTO `ysk_somebill` VALUES ('328', '165', '1', '佣金收入+', '1578044401', '+', '127.50', null);
INSERT INTO `ysk_somebill` VALUES ('329', '165', '6', '充值8500.00确认-', '1578044401', '-', '8500.00', null);
INSERT INTO `ysk_somebill` VALUES ('330', '9', '1', '佣金收入+', '1578045866', '+', '5.50', null);
INSERT INTO `ysk_somebill` VALUES ('331', '9', '6', '充值500.00确认-', '1578045866', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('332', '9', '1', '佣金收入+', '1578045884', '+', '0.01', null);
INSERT INTO `ysk_somebill` VALUES ('333', '9', '6', '充值1.00确认-', '1578045884', '-', '1.00', null);
INSERT INTO `ysk_somebill` VALUES ('334', '156', '1', '佣金收入+', '1578045913', '+', '1.10', null);
INSERT INTO `ysk_somebill` VALUES ('335', '156', '6', '充值100.00确认-', '1578045913', '-', '100.00', null);
INSERT INTO `ysk_somebill` VALUES ('336', '155', '1', '直推抢单成功佣金', '1578045913', '+', '0.33', null);
INSERT INTO `ysk_somebill` VALUES ('337', '152', '1', '二代抢单成功佣金', '1578045913', '+', '0.16', null);
INSERT INTO `ysk_somebill` VALUES ('338', '1', '1', '三代抢单成功佣金', '1578045913', '+', '0.09', null);
INSERT INTO `ysk_somebill` VALUES ('339', '9', '1', '佣金收入+', '1578047939', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('340', '9', '6', '充值10000.00确认-', '1578047939', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('341', '193', '4', '提现', '1578101701', '-', '5000.00', null);
INSERT INTO `ysk_somebill` VALUES ('342', '172', '4', '提现', '1578201433', '-', '1400.00', null);
INSERT INTO `ysk_somebill` VALUES ('343', '172', '6', '提现退回+', '1578302192', '+', '1400.00', null);
INSERT INTO `ysk_somebill` VALUES ('344', '199', '3', '充值+', '1578316990', '+', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('345', '193', '1', '佣金收入+', '1578317016', '+', '75.00', null);
INSERT INTO `ysk_somebill` VALUES ('346', '193', '6', '充值5000.00确认-', '1578317016', '-', '5000.00', null);
INSERT INTO `ysk_somebill` VALUES ('347', '165', '1', '直推抢单成功佣金', '1578317016', '+', '22.50', null);
INSERT INTO `ysk_somebill` VALUES ('348', '199', '1', '佣金收入+', '1578317555', '+', '45.00', null);
INSERT INTO `ysk_somebill` VALUES ('349', '199', '6', '充值3000.00确认-', '1578317555', '-', '3000.00', null);
INSERT INTO `ysk_somebill` VALUES ('350', '165', '1', '直推抢单成功佣金', '1578317555', '+', '13.50', '199');
INSERT INTO `ysk_somebill` VALUES ('351', '199', '3', '充值+', '1578318698', '+', '2955.00', null);
INSERT INTO `ysk_somebill` VALUES ('352', '199', '1', '佣金收入+', '1578318944', '+', '37.50', null);
INSERT INTO `ysk_somebill` VALUES ('353', '199', '6', '充值2500.00确认-', '1578318944', '-', '2500.00', null);
INSERT INTO `ysk_somebill` VALUES ('354', '165', '1', '直推抢单成功佣金', '1578318944', '+', '11.25', '199');
INSERT INTO `ysk_somebill` VALUES ('355', '172', '4', '提现', '1578319807', '-', '1400.00', null);
INSERT INTO `ysk_somebill` VALUES ('356', '199', '3', '充值+', '1578320411', '+', '2499.00', null);
INSERT INTO `ysk_somebill` VALUES ('357', '199', '4', '提现', '1578386223', '-', '3036.00', null);
INSERT INTO `ysk_somebill` VALUES ('358', '9', '1', '佣金收入+', '1579413267', '+', '150.00', null);
INSERT INTO `ysk_somebill` VALUES ('359', '9', '6', '充值10000.00确认-', '1579413267', '-', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('360', '169', '3', '充值+', '1587867219', '+', '10000.00', null);
INSERT INTO `ysk_somebill` VALUES ('361', '21', '1', '佣金收入+', '1587867502', '+', '7.00', null);
INSERT INTO `ysk_somebill` VALUES ('362', '21', '6', '充值500.00确认-', '1587867502', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('363', '1', '1', '直推抢单成功佣金', '1587867502', '+', '2.10', '21');
INSERT INTO `ysk_somebill` VALUES ('364', '21', '3', '充值+', '1587867673', '+', '1001.00', null);
INSERT INTO `ysk_somebill` VALUES ('365', '21', '1', '佣金收入+', '1587867712', '+', '7.00', null);
INSERT INTO `ysk_somebill` VALUES ('366', '21', '6', '充值500.00确认-', '1587867712', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('367', '1', '1', '直推抢单成功佣金', '1587867712', '+', '2.10', '21');
INSERT INTO `ysk_somebill` VALUES ('368', '21', '1', '佣金收入+', '1587868262', '+', '7.00', null);
INSERT INTO `ysk_somebill` VALUES ('369', '21', '6', '充值500.00确认-', '1587868262', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('370', '1', '1', '直推抢单成功佣金', '1587868262', '+', '2.10', '21');
INSERT INTO `ysk_somebill` VALUES ('371', '21', '1', '佣金收入+', '1587870711', '+', '14.00', null);
INSERT INTO `ysk_somebill` VALUES ('372', '21', '6', '充值1000.00确认-', '1587870711', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('373', '1', '1', '直推抢单成功佣金', '1587870711', '+', '4.20', '21');
INSERT INTO `ysk_somebill` VALUES ('374', '21', '1', '佣金收入+', '1587871105', '+', '14.00', null);
INSERT INTO `ysk_somebill` VALUES ('375', '21', '6', '充值1000.00确认-', '1587871105', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('376', '1', '1', '直推抢单成功佣金', '1587871105', '+', '4.20', '21');
INSERT INTO `ysk_somebill` VALUES ('377', '21', '1', '佣金收入+', '1587956123', '+', '7.00', null);
INSERT INTO `ysk_somebill` VALUES ('378', '21', '6', '充值500.00确认-', '1587956123', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('379', '1', '1', '直推抢单成功佣金', '1587956123', '+', '2.10', '21');
INSERT INTO `ysk_somebill` VALUES ('380', '21', '1', '佣金收入+', '1587956166', '+', '7.00', null);
INSERT INTO `ysk_somebill` VALUES ('381', '21', '6', '充值500.00确认-', '1587956166', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('382', '1', '1', '直推抢单成功佣金', '1587956166', '+', '2.10', '21');
INSERT INTO `ysk_somebill` VALUES ('383', '21', '1', '佣金收入+', '1588039946', '+', '7.00', null);
INSERT INTO `ysk_somebill` VALUES ('384', '21', '6', '充值500.00确认-', '1588039946', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('385', '1', '1', '直推抢单成功佣金', '1588039946', '+', '2.10', '21');
INSERT INTO `ysk_somebill` VALUES ('386', '21', '4', '提现', '1588042708', '-', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('387', '199', '6', '提现退回+', '1588060736', '+', '3036.00', null);
INSERT INTO `ysk_somebill` VALUES ('388', '21', '6', '提现退回+', '1588060743', '+', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('389', '21', '6', '提现退回+', '1588060806', '+', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('390', '21', '6', '提现退回+', '1588060840', '+', '1000.00', null);
INSERT INTO `ysk_somebill` VALUES ('391', '179', '6', '提现退回+', '1588063658', '+', '5000.00', null);
INSERT INTO `ysk_somebill` VALUES ('392', '21', '3', '充值+', '1588063678', '+', '2001.00', null);
INSERT INTO `ysk_somebill` VALUES ('393', '21', '1', '佣金收入+', '1588064741', '+', '7.00', null);
INSERT INTO `ysk_somebill` VALUES ('394', '21', '6', '充值500.00确认-', '1588064741', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('395', '1', '1', '直推抢单成功佣金', '1588064741', '+', '2.10', '21');
INSERT INTO `ysk_somebill` VALUES ('396', '21', '1', '佣金收入+', '1588064764', '+', '5.50', null);
INSERT INTO `ysk_somebill` VALUES ('397', '21', '6', '充值500.00确认-', '1588064764', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('398', '1', '1', '直推抢单成功佣金', '1588064764', '+', '1.65', '21');
INSERT INTO `ysk_somebill` VALUES ('399', '21', '1', '佣金收入+', '1588123718', '+', '7.00', null);
INSERT INTO `ysk_somebill` VALUES ('400', '21', '6', '充值500.00确认-', '1588123718', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('401', '1', '1', '直推抢单成功佣金', '1588123718', '+', '2.10', '21');
INSERT INTO `ysk_somebill` VALUES ('402', '21', '1', '佣金收入+', '1588123726', '+', '5.50', null);
INSERT INTO `ysk_somebill` VALUES ('403', '21', '6', '充值500.00确认-', '1588123726', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('404', '1', '1', '直推抢单成功佣金', '1588123726', '+', '1.65', '21');
INSERT INTO `ysk_somebill` VALUES ('405', '21', '1', '佣金收入+', '1588131091', '+', '7.00', null);
INSERT INTO `ysk_somebill` VALUES ('406', '21', '6', '充值500.00确认-', '1588131091', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('407', '1', '1', '直推抢单成功佣金', '1588131091', '+', '2.10', '21');
INSERT INTO `ysk_somebill` VALUES ('408', '21', '1', '佣金收入+', '1588131108', '+', '5.50', null);
INSERT INTO `ysk_somebill` VALUES ('409', '21', '6', '充值500.00确认-', '1588131108', '-', '500.00', null);
INSERT INTO `ysk_somebill` VALUES ('410', '1', '1', '直推抢单成功佣金', '1588131108', '+', '1.65', '21');

-- ----------------------------
-- Table structure for ysk_store
-- ----------------------------
DROP TABLE IF EXISTS `ysk_store`;
CREATE TABLE `ysk_store` (
  `uid` int(11) unsigned NOT NULL COMMENT '用户id',
  `cangku_num` decimal(13,5) NOT NULL DEFAULT '0.00000' COMMENT '钱包余额',
  `fengmi_num` decimal(13,5) NOT NULL DEFAULT '0.00000' COMMENT '积分',
  `plant_num` decimal(13,4) NOT NULL DEFAULT '0.0000' COMMENT '播种总数',
  `huafei_total` decimal(13,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '施肥累计',
  `vip_grade` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of ysk_store
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_system
-- ----------------------------
DROP TABLE IF EXISTS `ysk_system`;
CREATE TABLE `ysk_system` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT '记录ID',
  `jdtime` int(10) DEFAULT NULL,
  `qd_sq` varchar(225) DEFAULT NULL,
  `qd_cf` int(11) NOT NULL COMMENT '抢单余额比列',
  `qd_nd` varchar(225) NOT NULL COMMENT '抢单难度，数组(0.1,0.2,0.3)',
  `qd_wxyj` float(10,3) NOT NULL COMMENT '微信抢单佣金30%填0.3',
  `qd_zfbyj` float(10,3) NOT NULL COMMENT '支付宝抢单佣金30%填0.3',
  `qd_bkyj` float(10,3) NOT NULL COMMENT '银行卡抢单佣金30%填0.3',
  `qd_ndtime` varchar(225) NOT NULL COMMENT '增加难度时间点',
  `qd_yjjc` varchar(12) NOT NULL COMMENT '佣金加成',
  `qd_minmoney` float NOT NULL COMMENT '抢单最低额度',
  `min_recharge` float(10,3) NOT NULL COMMENT '最低充值额度',
  `mix_withdraw` float(10,3) NOT NULL COMMENT '最小提现额度',
  `max_withdraw` float(10,3) NOT NULL COMMENT '最大提现额度',
  `tx_yeb` float NOT NULL COMMENT '提现要求：收款与余额比例 ',
  `team_oneyj` float(10,3) NOT NULL COMMENT '1代佣金比例30%写0.3',
  `team_twoyj` float(10,3) NOT NULL COMMENT '2代佣金比例30%写0.3',
  `team_threeyj` float(10,2) NOT NULL COMMENT '3代佣金比例30%写0.3',
  `cz_yh` varchar(255) NOT NULL,
  `cz_xm` varchar(255) NOT NULL,
  `cz_kh` varchar(255) NOT NULL,
  `wxb` varchar(255) DEFAULT NULL,
  `zfbb` varchar(255) DEFAULT NULL,
  `ylb` varchar(255) DEFAULT NULL,
  `ed` decimal(10,2) DEFAULT '0.00',
  `qd_kf` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='游戏参数设置表';

-- ----------------------------
-- Records of ysk_system
-- ----------------------------
INSERT INTO `ysk_system` VALUES ('1', '0', '', '100', '0', '0.014', '0.014', '0.014', '0', '0', '200', '1000.000', '100.000', '50000.000', '0', '0.300', '0.150', '0.08', '中国工商银行', '老王', '34534523434534521', '1.4', '1.1', '1.5', '0.00', '13888888888');

-- ----------------------------
-- Table structure for ysk_tixian
-- ----------------------------
DROP TABLE IF EXISTS `ysk_tixian`;
CREATE TABLE `ysk_tixian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shanghu_id` int(11) DEFAULT NULL,
  `shanghu_name` varchar(255) DEFAULT NULL,
  `shanghu_kahao` varchar(255) DEFAULT NULL,
  `shanghu_huming` varchar(255) DEFAULT NULL,
  `shanghu_yinhang` varchar(255) DEFAULT NULL,
  `shanghu_xinxi` varchar(255) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT '0.00',
  `addtime` varchar(255) DEFAULT NULL,
  `zt` int(11) DEFAULT '0' COMMENT '0未审核 1 已审核 2错误',
  `msg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ysk_tixian
-- ----------------------------
INSERT INTO `ysk_tixian` VALUES ('28', '1', 'shh001', '111', '', '', '测试数据修改', '100.00', '1573739643', '1', null);
INSERT INTO `ysk_tixian` VALUES ('29', '1', 'shh001', '111', '', '', '测试数据修改', '100.00', '1573739643', '1', null);
INSERT INTO `ysk_tixian` VALUES ('30', '1', 'shh001', '111', '', '', '测试数据修改', '20000.00', '1573783896', '1', null);
INSERT INTO `ysk_tixian` VALUES ('31', '1', 'shh001', '111', '', '', '测试数据修改', '8000.00', '1573822541', '2', null);
INSERT INTO `ysk_tixian` VALUES ('32', '1', 'shh001', '111', '', '', '测试数据修改', '7000.00', '1573822620', '1', null);

-- ----------------------------
-- Table structure for ysk_upload
-- ----------------------------
DROP TABLE IF EXISTS `ysk_upload`;
CREATE TABLE `ysk_upload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'UID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `url` varchar(255) DEFAULT NULL COMMENT '文件链接',
  `ext` char(4) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) DEFAULT NULL COMMENT '文件md5',
  `sha1` char(40) DEFAULT NULL COMMENT '文件sha1编码',
  `location` varchar(15) NOT NULL DEFAULT '' COMMENT '文件存储位置',
  `download` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='文件上传表';

-- ----------------------------
-- Records of ysk_upload
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_user
-- ----------------------------
DROP TABLE IF EXISTS `ysk_user`;
CREATE TABLE `ysk_user` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL COMMENT '上级ID',
  `gid` int(11) NOT NULL DEFAULT '0' COMMENT '上上级ID',
  `ggid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上上上级ID',
  `account` char(20) NOT NULL DEFAULT '0' COMMENT '用户账号',
  `mobile` char(20) NOT NULL COMMENT '用户手机号',
  `u_yqm` varchar(225) NOT NULL COMMENT '邀请码',
  `username` varchar(255) NOT NULL DEFAULT '',
  `login_pwd` varchar(225) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `login_salt` char(5) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `money` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '用户余额',
  `reg_date` int(11) NOT NULL COMMENT '注册时间',
  `reg_ip` varchar(20) NOT NULL COMMENT '注册IP',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户锁定  1 不锁  0拉黑  -1 删除',
  `activate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否激活 1-已激活 0-未激活',
  `session_id` varchar(225) DEFAULT NULL,
  `wx_no` varchar(225) DEFAULT NULL COMMENT '微信账号',
  `alipay` varchar(225) DEFAULT NULL COMMENT '支付宝',
  `truename` varchar(225) DEFAULT NULL COMMENT '真实姓名',
  `email` varchar(225) NOT NULL COMMENT '电子邮件',
  `userqq` varchar(32) NOT NULL COMMENT 'QQ',
  `usercard` varchar(32) NOT NULL COMMENT '身份证号码',
  `path` text,
  `use_grade` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户等级',
  `u_ztnum` int(11) NOT NULL COMMENT '直推人数',
  `rz_st` int(1) NOT NULL COMMENT '资料完善状态，1OK2no',
  `tx_status` int(11) NOT NULL DEFAULT '1' COMMENT '提现状态',
  `zsy` float(10,2) NOT NULL COMMENT '总收益',
  `agent` int(11) DEFAULT '0',
  `num` int(11) DEFAULT '10',
  `zdopention` int(11) DEFAULT NULL,
  `xyf` int(11) NOT NULL DEFAULT '0' COMMENT '信誉分',
  `google_auth` varchar(32) DEFAULT '',
  PRIMARY KEY (`userid`) USING BTREE,
  UNIQUE KEY `mobile` (`mobile`) USING BTREE,
  UNIQUE KEY `account` (`account`) USING BTREE,
  KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ysk_user
-- ----------------------------
INSERT INTO `ysk_user` VALUES ('1', '0', '0', '0', '13100000000', '13100000000', '', '13100000000', '9672e6c05f3b6eecdb57ab2358a9bd05', '3156', '5917.98', '1560570334', '', '1', '0', '5dn8rgub6kjb08lkd1inbl7h82', '', '', '', '', '', '', null, '0', '0', '1', '1', '40.50', '1', '0', '1', '1', '');
INSERT INTO `ysk_user` VALUES ('3', '2', '0', '0', 'dfdsfds', '13456789009', '4hse45h5', 'dfdsfds', '2184bf64e5e696123baf7d6425e77ef5', '2770', '0.00', '1560502602', '', '1', '0', null, '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '0', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('6', '0', '0', '0', '18321631857', '18321631857', '', '18321631857', '332e51c8f2ab46a377349260ade0f2e0', '370', '0.00', '1560570862', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('7', '0', '0', '0', '15511090417', '15511090417', '', '15511090417', 'd403b68b77860b5f1f698130505138d8', '3560', '0.02', '1560571836', '', '1', '0', null, null, null, null, '', '', '', null, '0', '5', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('8', '0', '0', '0', '13913124650', '13913124650', '', '13913124650', '698fd40f639b46efd8e4edfbd83831c3', '7183', '0.00', '1560572618', '', '1', '0', 'jit5sa70kor4428gde29dtsp14', null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('9', '0', '0', '0', '13800138000', '13800138000', '4534dfdfg', '15566667777', '041fa50fcfc633d6f5401fc548a11798', '7774', '137431.42', '1560579763', '', '1', '0', 'h7q8ul7qp8kdshqf5o1p9nlqs4', '567', '567', '56700000', '2342@qq.com', '567', '567', null, '0', '8', '1', '1', '707694.69', '1', '9999', '1', '24', '');
INSERT INTO `ysk_user` VALUES ('10', '2', '0', '0', '13333333333', '13333333333', 'fw54AhhD', '13333333333', '964f45954424fb2bc430411fe27ec971', '2707', '0.00', '1560584639', '', '1', '0', '1fk4vuh53hpe9g2u9nqiqnv1d1', null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '0', null, '1', '0', '');
INSERT INTO `ysk_user` VALUES ('11', '0', '0', '0', '18000000000', '18000000000', '', '18000000000', '77c05d2a6fcde573ffe3a68a61fd5443', '4738', '100000.00', '1560586188', '', '1', '0', '1q017j3qlekgc31butbcupcog2', '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('13', '12', '0', '0', '闫振龙', '18625824723', 'wBhDeFDh', '闫振龙', '749ea9c2e4f5fb5b76fdde1a1d902afe', '2443', '0.00', '1560590474', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('14', '2', '0', '0', 'whfes01', '19999999999', 'EFD140Cs', 'whfes01', 'ed744537809431da10caaf89991bb7bf', '6535', '0.00', '1560592506', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('16', '0', '0', '0', '18960238701', '18960238701', '', '18960238701', '70b2020a606735c34dedd04bf3d9038f', '1027', '0.00', '1560602161', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '0', '0.00', '1', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('17', '2', '0', '0', 'djfjds', '13567896789', 'Bh54C4Fh', 'djfjds', '5d7df6959beb5e42de65cff9c3ccd6d8', '4875', '8016.00', '1560657291', '', '1', '0', 'hvl5br8alvbp2qcgfj3ruapse6', '34', '34', 'dfds', 'dfdsf@dsf.com', '234324', '3432432', null, '0', '1', '1', '1', '16.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('18', '17', '2', '0', '13456789000', '13456789000', 'OLYqLpVJ28Iv', 'erwe', '149dd2de7d927a793945671245002279', 'TY8c', '0.00', '1560658942', '127.0.0.1', '1', '0', null, null, null, null, '', '', '', '-17-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('20', '0', '0', '0', '13252585458', '13252585458', '', '13252585458', 'dc4a26ce0b136b40a0f02335a71f46c5', '5281', '0.00', '1563149840', '', '1', '0', 'mc50krcg13svskashs1dbh6iv3', '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('21', '1', '1', '1', '13888888888', '13888888888', 'OYeKVKTqDObq', '13033556688', '8afc14645ed885190bfbb0ce23334b6b', 'f0f', '20707.10', '1563163346', '14.106.121.50', '1', '0', 'h7q8ul7qp8kdshqf5o1p9nlqs4', '456456', '456456', '谢', '456456@qq.com', '456456', '4564564546546456', '--', '1', '1', '1', '1', '915.50', '1', '100', '1', '14', '');
INSERT INTO `ysk_user` VALUES ('22', '0', '0', '0', '13245674567', '13245674567', 'ey261pbEIiUD', '13245674567', '96ca78c6286c56002a4748343a3ec7c6', '4907', '5000.00', '1563245021', '', '1', '0', '66bc90a3l8ap66a004menc53h1', null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('23', '1', '0', '0', '15637897332', '15637897332', 'rI6BMa453syO', '张旭', 'a91225a8bbe6f46bd5ed8a12c7f124d6', 'ZNDK', '0.00', '1563254320', '61.158.152.20', '0', '0', 'id5a4lno1sbbsd9ajaqg2l6ie1', '', '', '', '', '', '', '-196-1-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('24', '0', '0', '0', 'momo624', 'momo624', 'evMfpkbMX3YZ', 'momo624', '54fefe6a8dcfc185d7ad9d11485eaa51', '6421', '0.00', '1563444962', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('27', '0', '0', '0', '13599217309', '13599217309', 'SYL88d6AzoaS', '13599217309', '520191a5af5473475d04058ee366a7b2', '8396', '0.00', '1563532779', '', '1', '0', 'v42v2l6ghu8ove68k6edagka62', '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('28', '0', '0', '0', '1256744534', '1256744534', 'ZMTCwgdWobUZ', '1256744534', '14cc7b6019a4449f4a35871c5f56df3c', '1425', '0.00', '1563551675', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('31', '0', '0', '0', '15555555555', '15555555555', '2n0fUWnOcPQZ', '15555555555', 'ad38ff20d62df28081d7f7e5f2f06138', '167', '0.00', '1563760407', '', '1', '0', 's35dk6kdlvhoh59cn40i0b5vh5', null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('32', '0', '0', '0', '16666666666', '16666666666', 'VeNrSeNDMwwW', '16666666666', 'fd8fa02fdbf86e2e72f86240d1ed02b6', '8960', '1500.00', '1563804071', '', '1', '0', '559iao25aft84ovf6j550e28q5', '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('33', '0', '0', '0', '1870608', '1870608', 'hRdFFzHeBSQ6', '1870608', '5c3f83ce904a20d5f61e9ef03eb0b63e', '8095', '3210.40', '1563861223', '', '1', '0', '9e5v6t51lg5oamnef2btdju2v4', null, null, null, '', '', '', null, '0', '0', '1', '1', '22.40', '1', null, '1', '0', '');
INSERT INTO `ysk_user` VALUES ('34', '0', '0', '0', '13212312312', '13212312312', 'WPGhMddC8TIZ', '13212312312', '46b8525f34b0ea0534addff4778f2f23', '8346', '0.01', '1563892909', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('35', '34', '0', '0', '10086', '10086', '14DC05D1', '10086', '62dc4d6b70f423510b56742ab3d918f8', '3651', '9901.20', '1563894023', '', '1', '0', 'vkh1res5kps2jd75u0s1les095', '123456456', '23151', '测试', '132156151@qq.com', '256165165', '132151', null, '0', '0', '1', '1', '1.20', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('36', '0', '0', '0', '18666666666', '18666666666', 'atPOdZU0KrcS', '18666666666', '4266c1ace426c0ab69502f8e51ac24ad', '7417', '2000.00', '1563935183', '', '1', '0', 'gko43ls051fhi199or7mm9rc25', '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('38', '37', '0', '0', '1008611', '1231561', '05hDw4DF', '1008611', '7769648c25021e30019d997b8f6331f7', '1444', '9902.50', '1563994919', '', '1', '0', 'udadmcp7rdhn24cr1k1icjvid6', '234234', '234234', '34234', '23543@qq.com', '4534', '24323', null, '0', '0', '1', '1', '2.50', '0', '50000', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('39', '1', '0', '0', '18831173823', '18831173823', 'DnERTpsZySlU', '18831173823', '3e9b86eff66198f8dfd8131249faf958', 'Ikg2', '0.00', '1564069265', '106.117.77.155', '0', '0', 'dielbmo6k0e2456hi39enuljn3', null, null, null, '', '', '', '-196-1-', '1', '0', '0', '0', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('40', '0', '0', '0', '17777777777', '17777777777', '6q15h4zLUz4X', '17777777777', 'f71cf94ccc82d0f987eb8598aa34790a', '1543', '17059.50', '1564129394', '', '1', '0', 'nf4c373dbi1q6l8glapkbmpad2', null, null, null, '', '', '', null, '0', '0', '1', '1', '2.50', '1', null, '0', '0', '');
INSERT INTO `ysk_user` VALUES ('41', '0', '0', '0', '13566778800', '13566778808', '1Wpq3Hz4PHgr', '13566778808', 'a165d251f30df1f63be056da32f481bf', '5631', '0.00', '1564141563', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('43', '0', '0', '0', '12345678901', '12345678901', 'A5NrpwDkWHAI', '12345678901', '7a41812865281521299fe6905004c1f2', '3380', '0.00', '1564241011', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('44', '43', '0', '0', 'love2019', '13888888866', 'B1jA4eD5', 'love2019', '1fb5ca27c412ec20942581286c9dcf6a', '1035', '0.00', '1564244063', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '0', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('45', '2', '0', '0', '123456789', '12345678910', '15DhA04f', '123456789', '765b7afe4bc158d1a7148bee744ead6c', '9389', '15.72', '1564306407', '', '1', '0', 'kba40lupu1ss5jbdag2k81j8j4', '423423', '142342314', '3242314', '2343324@qq.com', '23423', '13242314', null, '0', '0', '1', '1', '12.52', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('46', '0', '0', '0', 'zbh123456', 'zbh123456', '4BCXPiwocaoo', 'zbh123456', '50436088a35ae95609cad12cf3651178', '1600', '0.00', '1564312590', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('47', '0', '0', '0', '1234567', '1234567', 'DVFKxDUfbGT5', '1234567', 'e79b3ab8fc02cb953221ffc732ba4191', '7008', '5354.26', '1564312722', '', '1', '0', 'j2parrbtm94sl5sg1nt0hh5hh4', null, null, null, '', '', '', null, '0', '1', '1', '1', '0.02', '1', null, '1', '0', '');
INSERT INTO `ysk_user` VALUES ('48', '47', '0', '0', '13888886666', '13888886666', 'dEqXKrwPjcK3', 'foryou', '57359bc6c453bd23ede28470e5540330', 'SydI', '480130.00', '1564312842', '113.247.47.64', '1', '0', 'kc8ui452kiqtvo2cbkri1slg45', '2312', '3123', '11', 'dwjikd@126.com', '1561561563', '416841564156', '-47-', '1', '1', '1', '1', '356.00', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('49', '48', '47', '0', '13866666666', '13866666666', 'LNJWpAcOhI2r', 'we', '30fe5f219ff09da95bfff4bbeed85014', 'ibEA', '10500.00', '1564313857', '113.247.47.64', '1', '0', 'lbqq0lh08egfrmudbgpjlhjke5', '123', '12321312', '2313', 'sds@126.com', '1516546', '14545646456', '-47-48-', '1', '0', '1', '1', '500.00', '0', '0', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('50', '31', '0', '0', '13200132000', '13200132000', 'C4j14SDh', '13200132000', 'cf69571d4fcb39309d9f98a9ebf8c135', '6911', '0.00', '1564370554', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('51', '33', '0', '0', '13300133000', '13300133000', 'DhD14eB4', '13300133000', 'bc4d39e7a261839759a622def40cae22', '5691', '0.00', '1564370771', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('52', '35', '0', '0', '15900159000', '15900159000', 'D04sBSA1', '15900159000', 'e292d3b975e397225aac7b21f5e1a15a', '2778', '100000.00', '1564371935', '', '1', '0', 'a355ui7toformtpn185j2235m3', '', '', '', '', '', '', null, '0', '0', '0', '1', '0.00', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('53', '47', '0', '0', '13455667766', '13455667766', '1hD0e40F', '13455667766', '57e263b731bce41082b70aca44f625d8', '7321', '0.00', '1564383604', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('54', '47', '0', '0', '123111144512', '123111144512', 'e01dEshA', '123111144512', '74590d4b9a5c828797ab69c02d720045', '800', '0.00', '1564383925', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('55', '0', '0', '0', '000001', '000001', 'pVUf6i8EO9hV', '000001', 'd15b29548e04cbb253b3f8d15073b2e7', '9150', '0.00', '1564384722', '', '1', '0', '7tmkq0g9pd9u1akttbeja8cul2', '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('56', '0', '0', '0', 'adminww', 'adminww', 'LuBysh2E01tB', 'adminww', '0b86cbdc28fcca0b2435dad67036ef9e', '9657', '10000000.00', '1564447325', '', '1', '0', null, '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('57', '1', '0', '0', '15926772119', '15926772119', 't49eB7Ey41bo', '小陈', '13c4a0404923cb20c0caab5cf3e69086', 'vNPJ', '88885360.00', '1564507289', '119.123.35.56', '1', '0', '72biu5td0lvt3peeec1hc89j01', '15926772119', '15926772119', '小陈', '15926772119@qq.com', '15926772119', '15926772119', '-196-1-', '1', '0', '1', '1', '44.41', '0', '999', null, '0', '');
INSERT INTO `ysk_user` VALUES ('58', '1', '0', '0', '18715207085', '18715207085', 'vtVkvct5txVK', 'azsxqw', '6b2c062e5f8eceda861ae18a01339814', '0dk8', '0.00', '1564545285', '117.136.103.172', '1', '0', null, null, null, null, '', '', '', '-196-1-', '1', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('59', '1', '0', '0', '18839290613', '18839290613', '6gJ3GusCRk7f', '李帅', '5a57dd86fee6a0751dcfb5a268d76489', 'ohbZ', '0.00', '1564550366', '120.216.173.75', '1', '0', 'hi0u4or9bo8i52loikk48357s3', null, null, null, '', '', '', '-196-1-', '1', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('60', '53', '0', '0', '18180461101', '18180461101', 'Fjd4s1Bf', '18180461101', '2ed6085ebcb63f179ef1d174062d89ed', '5069', '0.00', '1564560439', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('61', '56', '0', '0', '12345665432', '12345665432', 'hsh5401h', '12345665432', '005bc597af2919828086079e8395384b', '6319', '48800.08', '1564586009', '', '1', '0', '72biu5td0lvt3peeec1hc89j01', 'w po h xin k', '我陪你', '想起', '734943496@qq.com', '97349465', '3794389767946946464956', null, '0', '0', '1', '1', '8.08', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('62', '54', '0', '0', '胡小小', '15196672529', 'Ce45h400', '胡小小', '646fcd78176167d8c9d5805e220822d9', '2835', '0.00', '1564710832', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('63', '54', '0', '0', 'test', '13388886666', '50FD1hAD', 'test', 'c35eea6b59119e220be2db401937d268', '5739', '0.00', '1564711829', '', '1', '0', null, '', '', '', '', '', '', null, '0', '0', '0', '1', '0.00', '0', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('64', '1', '0', '0', '13598999347', '13598999347', 'Do6ofCTl9KKu', '1287677886', '8eca3688505a94acd91fc6bd03673d9c', '6Nph', '200.00', '1564746122', '61.158.149.169', '1', '0', 'r4rihh63m2npemugskb351epr1', '1287677886', '13598999347', '陈小东', '1512861809@qq.com', '1512861809', '411081199503228544', '-196-1-', '1', '0', '1', '0', '400.00', '0', '20', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('65', '0', '0', '0', '13859674037', '13859674037', 'fvBdhEGtzwwv', '13859674037', 'ae17a0a49cb6da7847eee4e22fb0857e', '7762', '0.00', '1564800597', '', '1', '0', 'pm8c1ar3qfe40apiii23fve3v7', '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '0', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('66', '0', '0', '0', '13333337777', '13333337777', 'K5wFHBjKTiI1', '13333337777', '17a23bf6315624671f1fe4ccff48bfc4', '5275', '0.18', '1564841192', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('67', '66', '0', '0', '1888555555', '1888555555', '4D5CDdE4', '1888555555', '2709ef118a8c716188fb2d9be0f25827', '5073', '91649.62', '1564841222', '', '0', '0', 'otqvfpnger3ofo3ub8q9mgrpb4', '44444444', '444444444', '4444444', '44444@qq.com', '444444444', '44444444444', null, '0', '0', '1', '1', '4.62', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('68', '2', '0', '0', '156710004444', '156710004444', 'DBs44A0A', '156710004444', '114a6488abfb58922796faa3039b2f18', '4797', '39620.66', '1564900970', '', '1', '0', '1pfh56aaj9fppi48ndu8sr6dq0', '小颜', '小颜', '小颜', '78524628@qq.com', '425875268', '4258842288566588', null, '0', '1', '1', '1', '136.65', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('69', '68', '2', '0', '13508080808', '13508080808', 'jxKP221m3Hvy', '13508080808', '13c05e5c445cc8f21cef30e8fb71e4a8', '4rAz', '0.00', '1564903065', '171.44.189.175', '1', '0', 'p53pmaa5k488mrifrijda41em4', null, null, null, '', '', '', '-68-', '1', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('70', '21', '1', '1', '13488888888', '13488888888', '4PB234ru22Yp', '1348888888', '26cd5cfa9cae68be66a3397be11ddddd', 'fm05', '27465.10', '1564917789', '49.156.33.4', '0', '0', '105ktratf33mfvi4qdf1q32cg0', '456456', '456456', '张', '654456456@qq.com', '456456456', '456456456456456456', '--21-', '1', '0', '1', '1', '165.10', '0', '0', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('71', '2', '0', '0', '13112345611', '13112345611', 'fA0dw4he', '13112345611', '1e90728d00535d574ec46e2d9d703d80', '9536', '10000000.00', '1564920869', '', '1', '0', '72biu5td0lvt3peeec1hc89j01', '1', '1', '1', '3319277666@qq.com', '3319277666', '350681198409152222', null, '0', '0', '1', '0', '0.00', '0', '66666', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('72', '1', '0', '0', '14795236763', '14795236763', 'dbm5LHXtdebi', '11', 'a893b21397ede3ee235a4b244e62c385', 'BMbf', '99994592.00', '1564935678', '60.176.76.216', '1', '0', 'qach2qk6m4e59sru8dl1tnpui5', '456464', '167864644', '黑猫', '20393989@163.com', '545424694', '450805658285646554', '-196-1-', '1', '0', '1', '1', '71.51', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('73', '0', '0', '0', 'admin', 'admin', 'OfiZigN702u8', 'admin', '62c208c97eab54634f67dec766f77041', '6365', '0.00', '1564936408', '', '1', '0', '404l02ofauo0jepef31gmi0ur7', null, null, null, '', '', '', null, '0', '0', '1', '0', '0.00', '1', null, '0', '0', '');
INSERT INTO `ysk_user` VALUES ('74', '72', '0', '0', 'maomao 01', '1815648646', '4hs45DD5', 'maomao 01', 'f7e9ef310347d94505713674962017ce', '4548', '0.00', '1564936691', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('77', '0', '0', '0', '18723888888', '18723888888', 'ceZXzzEmBsjE', '13112345611', 'eda1d542fab7a37327e2550e22f34e59', '343', '0.00', '1564993062', '', '1', '0', 'j2parrbtm94sl5sg1nt0hh5hh4', 'chenchen20190401', '18396290177', '陈梅香', '', '', '', null, '0', '0', '1', '0', '0.00', '1', '1000', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('82', '0', '0', '0', '18396290177', '18396290177', 'cPiXiaOEVJiK', '18396290177', '3cbdc7f204533c64a13a26958641ebc0', '8937', '0.00', '1565034733', '', '1', '0', 'p9k21aqms574at9momv33d8eo7', null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('83', '82', '0', '0', '15750735243', '15750735243', 'sS5BA0jD', '13112345611', '55295b5026dfa9aaecb415cfe74efd43', '9470', '10000.00', '1565035073', '', '1', '0', 'p9k21aqms574at9momv33d8eo7', '565455', '56544', 'kill', 'ghggc@qq.com', '53456985', '5368744', null, '0', '0', '1', '1', '0.00', '0', '10000', null, '0', '');
INSERT INTO `ysk_user` VALUES ('84', '73', '0', '0', 'member888', '18888888888', 'CF4BD55E', 'member888', '177bd29e30dadf9b86ef2912b122ae53', '6935', '10000.00', '1565060527', '', '1', '0', 'd4is3uicdjcfosbut2lo4gal14', '188888888', '188888888@163.com', '墨菲', '', '', '', null, '0', '0', '0', '1', '0.00', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('85', '0', '0', '0', '15970603995', '15970603995', 'SbPYwHVv9vgU', '15970603995', 'd81ed3d8efe67f7c93e9cb05a19f5105', '5117', '0.00', '1565076795', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('86', '0', '0', '0', '18988998899', '18988998899', 'm20lgW0LfTHb', '18988998899', '1a0233fb846010694d39f9b7ccdd07fb', '2123', '0.00', '1565177246', '', '1', '0', '0edg0jvmtof6sh4shnbm4rf007', null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, '0', '0', '');
INSERT INTO `ysk_user` VALUES ('87', '0', '0', '0', '18533126614', '18533126614', 'tpCRbDTkOp7t', '18533126614', 'e0e09883c489a960f67886a4830d497e', '4249', '92143.20', '1565177965', '', '1', '0', 'fdgau2akeuudsvpjtnm0amb8v5', '', '', '', '', '', '', null, '0', '0', '1', '1', '243.20', '1', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('88', '1', '0', '0', '陈', '15800000000', 'DhA10DB4', '陈', 'b4bf43ace6e094002a33f46b17810920', '4060', '0.00', '1565269172', '', '1', '0', 'gdam2e8s0htvcepc1ptfpd76n7', null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('89', '87', '0', '0', 'BBC888', '1388888888', 'hfEh541A', 'BBC888', 'c362f205bd19f1d0969be055139cbfbd', '2922', '9000.00', '1565297309', '', '1', '0', '930gv3nn666qvl24405jm20a72', '能', '不能', '到你', '128425868@qq.com', '54575', '454872764', null, '0', '0', '1', '1', '0.00', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('90', '0', '0', '0', '15112861560', '15112861560', '0ARWcA830nKB', 'admin', '445eff02e386539071e79ca90b254155', '4155', '2000.00', '1565370829', '', '1', '0', 'e9lfsnpvffptuh1f8qt00u0cb7', '123456', '123456', '尹青波', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '0', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('91', '0', '0', '0', '13938064269', '13938064269', 'uxbJJskXPeIC', '13938064269', 'e4e7b1c2add09fad97328121cc61731a', '2968', '0.00', '1565514615', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('92', '0', '0', '0', '15880881850', '15880881850', 'AsXsxh98nvHZ', '15880881850', '5db56015dad4a262745b1e664f3730d9', '5083', '0.00', '1565534788', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('93', '92', '0', '0', '15526279728', '15526279728', '4BS4015f', '15526279728', 'e9291cda089bb033ad0cc5a3c05fc0fc', '8938', '0.00', '1565534861', '', '1', '0', '2g3ekvkh1mb9jmr1feb06i4923', null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('94', '0', '0', '0', '0926602950', '0926602950', 'MTqXJ3YVZ4eR', '0926602950', 'ce65ff4e9d19070d169595fb7f9f84fd', '8424', '0.00', '1565593084', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('95', '94', '0', '0', '121212', '12121212121', 'h5h4CShB', '121212', 'e084d7c09d25bb7f91505d7059346423', '3800', '0.00', '1565593543', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('96', '0', '0', '0', '17112345678', '17112345678', 'xnX2KylTiNd0', '17112345678', 'c1f6813cdd7fcda41be7290315986670', '9529', '0.00', '1565750615', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('97', '67', '0', '0', '19917922661', '19917922661', '4hh1s5Aw', '19917922661', '0b88b4960873f9e378a4b077346ff196', '8015', '0.00', '1565848138', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('98', '0', '0', '0', '18570066850', '18570066850', 'HjuWfdPgfPHv', '18570066850', '2ff7df125570daf1c50b5a60d26ad6ae', '1584', '0.05', '1565947272', '', '1', '0', 'h16s8otbjvhcql9n05uvnpv7u3', '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('99', '98', '0', '0', 'suxi3589', '18570036580', 'h4DEhA5w', 'suxi3589', '427bb5e6e6c6f2f9219dade2d69e6daa', '8320', '1455.50', '1565947359', '', '1', '0', 'e57rtefo505bpamqjkfh60ohj0', 'lusuxi', 'lusuxi', 'lusuxi', '358923476@qq.cm', '358923476', '4312568954231', null, '0', '0', '1', '1', '5.50', '0', '100', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('100', '1', '0', '0', '777', '777', 'AjB4sD0E', '777', 'bd2eaf015c8ff7be6c04cde0d63ed761', '6015', '0.00', '1566193856', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '0', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('101', '0', '0', '0', '18888889999', '18888889999', 'oQVLpALOJuP5', '18888889999', '5172e416fd09aaea1a9b000ad5933361', '4206', '0.00', '1566397702', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '0', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('102', '0', '0', '0', '1566666666', '1566666666', 'ZjPVYKKwnnQ6', '1566666666', '85dde99c3240e56e7599873a618df0e8', '3579', '0.00', '1566569556', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('103', '1', '0', '0', 'a5526897', '17703166584', 'DDD1hA41', 'a5526897', 'da3de69c112857e01b8a16e578d057e3', '8915', '0.00', '1566620104', '', '1', '0', null, '', '', '', '', '', '', null, '0', '0', '0', '1', '0.00', '0', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('104', '1', '0', '0', 'zxc123', '13684876964', 'eh1d4h44', 'zxc123', '9320ea2b9ce0229cbe0f170ef781a3ae', '1853', '0.00', '1567047349', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '0', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('105', '7', '0', '0', '15541222155', '15541222155', '76Sv1kRSfyI4', 'ydoublel', '09c3400bd562c3b0c3b469cf663195ea', 'w4QQ', '4847.98', '1567315221', '42.249.51.176', '1', '0', 'jqdv9uoemef40ujppgg1p0qnj3', '39393939', '2828377@mail.com', '全球', '393@qq.com', '39399339', '20193701883830', '-7-', '1', '0', '1', '1', '1.98', '0', null, '0', '0', '');
INSERT INTO `ysk_user` VALUES ('106', '1', '0', '0', '吧', '13570896511', 'De41BhD4', '吧', 'badf3ae2b8f46195ab55c70f018a86e5', '10', '0.00', '1567357366', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('107', '0', '0', '0', '18975711234', '18975711234', '1K15cLpBhaRz', '18975711234', '78f6102f65a95b5bf391bb22f93dd439', '7226', '698.05', '1567478599', '', '1', '0', 'm4fjrsua6ga5773d8nds4ojn23', '', '', '', '', '', '', null, '0', '0', '1', '1', '631.05', '1', '0', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('108', '0', '0', '0', '18975711237', '18975711237', '5xY5jft5QASS', '18975711237', '0193c773c37a1c7d118300462426bf2b', '6771', '0.00', '1567514299', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('109', '108', '0', '0', '110', '4558745', 'ACDDwhhS', '110', '488fb654cce399cf153dc16be55fb765', '6518', '0.00', '1567514365', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('110', '107', '0', '0', '009', '18975711235', 'Ah5Ch1D4', '009', 'b5aadc20cc61e1b13c3ab635872e587f', '130', '95466.00', '1567517645', '', '1', '0', 'o17inev9mvtco3pfsp5m85k3h0', '566696', '888999', '龙五一', '13856876@qq.com', '8580755', '5568852655', null, '0', '0', '1', '1', '6340.99', '0', '0', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('111', '0', '0', '0', '17113141314', '17113141314', 'FGvzFu0eDIs8', '17113141314', '9460161b8266d41a1cd0eb878a654434', '4841', '0.00', '1567562753', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('112', '107', '0', '0', '008', '13549505371', 'Fe4dSD45', '008', 'd15672ab19545be02e66b97cea8662f1', '3962', '100000.00', '1567566832', '', '1', '0', null, '', '', '', '', '', '', null, '0', '0', '0', '1', '0.00', '0', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('113', '111', '0', '0', 'test123', '13000000000', '1d5FwCBE', 'test123', '482c28f3c3095328346244ca4d8b2163', '6360', '0.00', '1567589611', '', '1', '0', '8diurjhchs33n1sq825224vg57', null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('114', '0', '0', '0', '13800138111', '13800138111', '7YqjMZr8ittJ', '13800138111', 'd43cf5430ad64d12afdd140ff8af415f', '6288', '10000.00', '1567594241', '', '0', '0', '6536e76mb563d5fqd29jn82qf0', null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, '1', '0', '');
INSERT INTO `ysk_user` VALUES ('115', '0', '0', '0', '18568531155', '18568531155', 'QAtSRU6P3uqc', '18568531155', 'c004e17acd2cad23345514036e7a80de', '1456', '0.00', '1567769968', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('116', '9', '0', '0', '13812330018', '13812330018', 'F0B1hDd4', '13812330018', 'de47ba44b883e33bf6df6468bb30ea34', '2284', '20116.60', '1567844551', '', '1', '0', 'k5dcg7upu8tdg17285bsea61p1', '13812330018', '13812330018', '张某', '8488847@qq.com', '8488847', '320706198708091256', null, '0', '0', '1', '1', '666.60', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('117', '36', '0', '0', '17898511101', '123456', 'fwhjASS5', '17898511101', 'c8af03c29b41f13a90f254a40020ecce', '2891', '0.00', '1568018038', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '0', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('118', '0', '0', '0', '3113123424', '3113123424', 'q7hgbPt22Cb9', '3113123424', '80821d8b9cbef221794e1a6f1054ec38', '7279', '10000000.00', '1568043392', '', '1', '0', null, '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('119', '0', '0', '0', 'LELEI', 'LELEI', 'QzGOox2tno5B', 'LELEI', 'e208cc4cd832bd57bbef8e64ddf71e0d', '1031', '0.00', '1568641861', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('120', '0', '0', '0', '13999999999', '13999999999', 'XHxnthGtKTUm', '13999999999', 'd870b97765626ae4ed1a6e62e4504794', '9596', '21063.00', '1568701300', '', '1', '0', '4j8t7vi8b05547bi7sfvoram41', '', '', '', '', '', '', null, '0', '1', '1', '1', '0.00', '1', '0', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('121', '120', '0', '0', '13666666666', '13666666666', 'elMIlzxEFRiX', '小女子', '12b54b002d09da22f61daee87dfd52e7', 'hAio', '29626.00', '1568705259', '61.144.104.6', '1', '0', 'g8v5ijp3u612e9lgu74rdmqo47', '3366921', '13666666666', '小女子', '12345@163.com', '666666667', '6666666666666666', '-120-', '1', '0', '1', '1', '126.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('122', '0', '0', '0', '13777777777', '13777777777', 'BmduBpVmeqbe', '13777777777', '3dbae54b065f8e4e6d0c7e7a532aaab1', '9532', '0.00', '1568708528', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('123', '1', '0', '0', '123123123', '13112312312', '5h4C1e1D', '123123123', '92a4ccefaf33f6f9fcb41ae431ec4aa0', '2347', '4510.50', '1568712225', '', '1', '0', 'm6pe6bbl71g5dpg2varg5ssvu4', '123', '123', '123', '12345612@QQ.COM', '123418695132', '1234561321891459/865', null, '0', '0', '1', '1', '10.50', '0', '3', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('124', '1', '0', '0', 'ACACACAC', '17602087778', 'BDwA5F10', 'ACACACAC', '5f0ff97bc1f1906eed65bf953910811e', '1160', '0.00', '1569155440', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('125', '7', '0', '0', '13510076667', '13510076667', 'ZypFcw0B37aP', '王啊6', '341160213ef208cbed727a704915b370', 'km1c', '0.00', '1569160799', '116.26.128.27', '0', '0', null, null, null, null, '', '', '', '-7-', '1', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('126', '0', '0', '0', '', '', '6qXr3Xhd50Ll', '', '2ba7ac5c81fda32f55b36654eb586a6b', '8217', '0.00', '1569221856', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('127', '1', '0', '0', '张世豪', '13153559905', 'Ahhj54hf', '张世豪', '428600b1d6f084c3ff0072091ef7aa27', '6193', '0.00', '1569225924', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('128', '7', '0', '0', '15888888888', '15888888888', '9NfVHprD5JzE', '2888888888', '5a982417b85b62135305b1be59db8b60', 'Dk9D', '0.00', '1569265991', '223.104.65.60', '1', '0', null, null, null, null, '', '', '', '-7-', '1', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('129', '0', '0', '0', '13888881234', '13888881234', '4xgMuTBltx0N', '13888881234', 'd425d576a878f94712f068a997898e2e', '9336', '0.00', '1569336900', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('130', '0', '0', '0', '13933445727', '13933445727', 'cBQkKrbU0VA5', '13933445727', '18a49de7b79b576cdde2398d1244e09e', '5545', '0.00', '1569397983', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('131', '70', '0', '0', 'ts1234', '18080261713', 'DE5h5Cf4', 'ts1234', 'e260731e165c4ea2ef2e33b8a23703e6', '6724', '0.00', '1569399298', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('132', '0', '0', '0', '13859000638', '13859000638', 'NlaI4nqQNnOM', '13859000638', '5d88e90be7cf83fa3aa147ce55568126', '7845', '0.00', '1569501892', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('133', '0', '0', '0', '15980503407', '15980503407', 'ThGtyOJTwAsn', '15980503407', 'e81cf74c109a249d6763c5480471e577', '8281', '8.38', '1569502170', '', '0', '0', '1jthj5kg9arcqhnlas3n1m3092', '', '', '', '', '', '', null, '0', '2', '1', '1', '46.20', '1', '0', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('134', '133', '0', '0', '15680737571', '15680737571', 'd5ybsHyChSbV', '15680737571', 'e5127888d8e0cb6daf0a1dccf88dec25', '1FQ9', '362.81', '1569506630', '117.136.30.195', '1', '0', 'kh1eh8jv5cml2aupkttr8vonv7', '367889', '557@', '黑化股份', '5787655@qq.com', '7764578', '5688986534788', '-133-', '1', '1', '1', '1', '40.65', '0', '0', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('135', '134', '133', '0', '15980503405', '15980503405', 'dxQvNizy4A1L', '陈c 小小', '6384a2c052b5939cfeecc61865b0d33d', 'CLCW', '9500.00', '1569507654', '117.136.30.109', '1', '0', '1jthj5kg9arcqhnlas3n1m3092', '464664', '464664', '小心', '18156694@qq.com', '4949494', '466464646', '-133-134-', '1', '0', '1', '1', '10.90', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('136', '133', '0', '0', '15305913361', '15305913361', '1tcFS0TsnGc6', '桃夭', 'db611aacf439cea3a98bef9bea16e7d6', '7Rtq', '0.00', '1569557075', '112.49.139.59', '1', '0', 'n7nq7e56j1c7vv9v9j5oop6d23', null, null, null, '', '', '', '-133-', '1', '0', '0', '1', '0.00', '0', null, '1', '0', '');
INSERT INTO `ysk_user` VALUES ('137', '0', '0', '0', '123123123123', '123123123123', 'qx48F3QaIIiy', '123123123123', '97fb945f72689b78595c98c699938b6f', '8788', '0.00', '1569568562', '', '0', '0', 'm6pe6bbl71g5dpg2varg5ssvu4', null, null, null, '', '', '', null, '0', '1', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('138', '137', '0', '0', '13627125737', '13627125737', 'QZUnKWCNDDNZ', 'ceshi1', 'f6403851b0c7b2dc098db9e992d5c3d8', 'aOEy', '0.00', '1569568800', '117.154.71.217', '1', '0', 'hk05tvf7d5oqddoqvc75kegtg4', null, null, null, '', '', '', '-137-', '1', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('139', '1', '0', '0', '112233', '17877227788', 'e4D5EFhw', '112233', '0d096a7bb2a1ec93fee952ee46f84c18', '4817', '333.00', '1569637796', '', '0', '0', null, '', '', '', '', '', '', null, '0', '0', '0', '1', '0.00', '0', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('140', '1', '0', '0', '不知道', '17877667766', '54144S0w', '1787727766', '3d18a2647c2452e1560bc751f3cb64e7', '1274', '0.00', '1569638261', '', '0', '0', '8jes9ndkqu1ioks4hdfqa4cco5', '123456', '17877667766', '不知道', '123456@qq.com', '123456', '4567982555', null, '0', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('141', '9', '0', '0', '13169258523', '13169258523', 'ByPpLJFBqebK', '想法了', 'c087ec64af857c3930e3e831538dd23c', 'LeCY', '10.00', '1570132666', '218.204.253.84', '0', '0', null, '', '', '', '', '', '', '-9-', '1', '0', '0', '1', '0.00', '0', '30', null, '0', '');
INSERT INTO `ysk_user` VALUES ('142', '9', '0', '0', '18569438059', '18569438059', '8rgY9leoEIk7', '如梦', '8d44d30d1c85dd20d09a83751da7faab', '1GjH', '10000.00', '1570191973', '223.88.29.177', '1', '0', 'lflkm121ut1b983q5gver03mm5', '', '', '', '', '', '', '-9-', '1', '0', '0', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('143', '9', '0', '0', '13111111111', '13111111111', '6mD1b7hK8qJb', '13111111111', 'de3271516f5350c5496da291a1b285d3', 'AAqi', '0.00', '1570364166', '211.97.129.75', '1', '0', null, '', '', '', '', '', '', '-9-', '1', '0', '0', '1', '0.00', '0', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('144', '74', '0', '0', '222222', '155****8888', 'EBSDheD1', '222222', '24405441121d1726830cfc38f4393517', '622', '0.00', '1570527250', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('145', '9', '0', '0', '17666032583', '17666032583', 'lfaSzlascXWu', '张峰', 'b73590a6e48b21d00c880107892a29c3', 'xW8y', '110111.06', '1570847481', '119.39.248.82', '1', '0', 'ou47e0t2islu7jcjjnign40710', 'jj', 'jj', 'hhh', '101@qq.com', '88', 'jj', '-9-', '1', '1', '1', '1', '7.06', '0', '1', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('146', '145', '9', '0', '17775838321', '17775838321', 'TEEAv4TPttVw', 'lv123456', '0ac4b17cdf29e6400a4e91754c615e58', 'Ka1Y', '9999.00', '1570849554', '106.18.182.153', '1', '0', '53d6u4ovpcje11d6esrgc957j0', 'lv7827858', '177583', '吕盛', '204946@qw.com', '280018814', '430124198999991010', '-9-145-', '1', '0', '1', '0', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('147', '0', '0', '0', '13838888888', '13838888888', 'AVFJXCenxV3Q', '13838888888', '9a122842df7adf4b84cb0ef7ca3ae863', '1963', '0.00', '1570996428', '', '1', '0', 'pgnh4o48n6t6ot1p3qp03rcl54', '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('148', '118', '0', '0', '12', '12', '0wE4sF1h', '12', '69e49ee0fc642ea5cb4b37a29e33bfc8', '9099', '0.00', '1571559087', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('149', '0', '0', '0', '13255567890', '13255567890', 'FQITjxQCzZL1', '13255567890', '7d3c6625630cbc6656f27503d76c12f4', '9927', '0.00', '1571639941', '', '1', '0', 'uf4munuifrm3cs9sboik8frvh0', '', '', '', '', '', '', null, '0', '0', '1', '1', '0.00', '1', '0', null, '0', '');
INSERT INTO `ysk_user` VALUES ('150', '0', '0', '0', '13035720198', '13035720198', '7w2cyeiQT7et', '13035720198', '486a2947e66890bdae77dcaec757a266', '5969', '0.00', '1571991436', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('151', '9', '0', '0', '13169215839', '13169215839', 'cD9JzodL4tgk', '13169215839', '8d61844c5c849aaf815ef09111057955', 'E3PS', '100000.00', '1571995161', '112.97.53.228', '1', '0', 'gp7p20ongrnv1rk029g2de5km2', '', '', '', '', '', '', '-9-', '1', '0', '0', '1', '0.00', '0', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('152', '1', '0', '0', '13111112222', '13111112222', 'F4C5whDh', '13111112222', '9f460f71fc211a65f75c56313653b228', '6894', '2758.45', '1572085352', '', '1', '0', 'jg2m81k52tgs7u1f2h0950c7f1', '', '', '王时尚', '272829299@qq.com', '272829299', '28283739', null, '0', '2', '1', '1', '176.50', '1', '10', '0', '6', '');
INSERT INTO `ysk_user` VALUES ('153', '0', '0', '0', '12345678900', '12345678900', '3xaKlaKRSVuL', '12345678900', 'ee289333d4465ef75b7cbff88d70b580', '9290', '0.00', '1573202234', '', '1', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', null, null, '0', '');
INSERT INTO `ysk_user` VALUES ('154', '9', '0', '0', '18318339934', '18318339934', 'jiitMAgUaAlo', '鹤山', 'e224b36bfba7da6d93183fbee5081e54', 'eTJ3', '0.00', '1573563661', '14.30.29.244', '1', '0', 'n1qqculkkjnnf1qd0rl5bl5h83', '5', '4', '', '', '', '', '-9-', '1', '0', '0', '1', '0.00', '1', '0', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('155', '152', '1', '0', '13100006666', '13100006666', '2LAvjKp3UPRN', '13100006666', 'be3191fc10d8cfd989511ff3f961c626', 'JnEZ', '2956.18', '1574250817', '171.117.190.133', '1', '0', 'ekbltjuik2taoer8vmth2fd0p1', 'A', 'D', 'As', 'Www@qq.com', 'Uuuu', 'Hhhhhh', '-152-', '1', '1', '1', '1', '204.50', '1', '88', '0', '5', '');
INSERT INTO `ysk_user` VALUES ('156', '155', '152', '1', '13100007777', '13100007777', 'z5UQOXz6EOHh', '13100007777', '4fd7a246ce48098f59d9c88426704567', 'y7zp', '5982.60', '1574252582', '171.117.190.133', '1', '0', 'ekbltjuik2taoer8vmth2fd0p1', '1', '1', '1', 'ttt@qq.com', '5555555', '34445', '-152-155-', '1', '0', '1', '1', '182.60', '1', '100', '0', '4', '');
INSERT INTO `ysk_user` VALUES ('157', '0', '0', '0', '18731028899', '18731028899', 'T43gcVRJr4Da', '18731028899', '6dad7469a220501783e89c926620ad94', '5368', '522.50', '1574664549', '', '1', '0', 'kl5cf3aiof0plmf7qrimsi1t31', null, null, null, '', '', '', null, '0', '0', '1', '1', '22.50', '1', '10', '0', '3', '');
INSERT INTO `ysk_user` VALUES ('158', '157', '0', '0', '啊坤', '14888888888', 'shhF4S40', '啊坤', '083a3d5331c80ed627df3e3b400d1afe', '990', '0.00', '1574664911', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '0', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('159', '0', '0', '0', '13931091933', '13931091933', '0pWBI9QoVt6A', '13931091933', '71a76215198c13fb657a900882e0d364', '7376', '100237.00', '1574668943', '', '1', '0', 'gjj3a7u3417f2qsknn9cfkol34', '', '', '', '', '', '', null, '0', '0', '1', '1', '173.50', '1', '1000', '0', '24', '');
INSERT INTO `ysk_user` VALUES ('160', '159', '0', '0', '14033033330', '13033033330', 'jSE1Fh54', '14033033330', 'acc6f973afb6ed5223e835500ce11f67', '5926', '3000.00', '1574746187', '', '1', '0', 'jg2m81k52tgs7u1f2h0950c7f1', '', '', '', '', '', '', null, '0', '0', '0', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('161', '7', '0', '0', '13444444444', '13444444444', 'E6pJPia1CYey', '123', '8cc47fcbb54fc597468c3409ef87505c', 'UyKT', '0.00', '1574994214', '14.111.59.27', '1', '0', null, null, null, null, '', '', '', '-7-', '1', '0', '0', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('162', '7', '0', '0', '13555555555', '13555555555', 'Q4hbylOrjQlB', '41251', '4a71ebef2f1b4f46c5145c3747ef3361', 'Sob5', '0.00', '1574994298', '14.111.59.27', '1', '0', null, null, null, null, '', '', '', '-7-', '1', '0', '0', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('163', '152', '1', '0', '13500100001', '13500100001', 'W9eFPgQH4odu', '张学友', '615c71483a5bb5feb33609f08ff0c78c', 'CRIn', '10500.00', '1575299823', '223.104.3.30', '1', '0', 'jg2m81k52tgs7u1f2h0950c7f1', '123', '123', '张学友', '123', '', '123', '-152-', '1', '0', '0', '1', '0.00', '1', '100', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('164', '9', '0', '0', '13783914073', '13783914073', 'dUvuFoZ2p9jD', '张磊', '5e95053dab554c2ab956c4e36657e02d', 'Ah60', '6589.72', '1576068774', '222.136.28.156', '1', '0', 'rvck1os8jj9usfmkuu1gsks663', 'a2752365', '', '张磊', '', '', '', '-9-', '1', '0', '1', '1', '90.00', '1', '30', '1', '4', '');
INSERT INTO `ysk_user` VALUES ('165', '0', '0', '0', '14725836900', '14725836900', 'y4dHcTVeI8pK', '14725836900', 'd942ba845b9db33d2741c8150a6bb9c3', '4027', '13368.42', '1577451472', '', '1', '0', 'an7s2i23cvo5jagn5d2hr57en7', '', '', '', '', '', '', null, '0', '42', '1', '1', '2508.00', '1', '50', '0', '25', '');
INSERT INTO `ysk_user` VALUES ('166', '165', '0', '0', '18022484190', '18022484190', '49OpKLLkpEgB', '陈冬明', '30b9981d747a5400a2c98835bf90295c', 'nCYf', '0.90', '1577857596', '218.87.157.27', '1', '0', 'ev3upcffa392vd77ogm80plnh2', '', '', '', '', '', '', '-165-', '1', '0', '1', '1', '4.90', '0', '10', '0', '1', '');
INSERT INTO `ysk_user` VALUES ('167', '165', '0', '0', '15715928077', '15715928077', 'gOe1llmIGswc', '范孝是', '264f0aa72587323860758e8a89c77e79', 'kQps', '0.00', '1577857964', '117.136.75.41', '1', '0', 'jso8bh65b56in80q01c4iqmgb7', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('168', '165', '0', '0', '18035881118', '18035881118', 'mtwF9rsIory6', '李娜', 'f7fcbed522653fc97f27a8197bdaad78', 'IjaE', '0.00', '1577858694', '1.68.56.121', '1', '0', '5cjb55jco29911ecq6b4efhu97', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('169', '165', '0', '0', '18928696507', '18928696507', 'jIeS31UR8VwL', '陈超威', 'b58352a7e5e3b914c94e7e5917ec949c', 'be1q', '10000.00', '1577859401', '113.70.210.192', '1', '0', 'etvoh8pbo184sd8324e566i483', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('170', '165', '0', '0', '17532572345', '17532572345', 'Tq5LV2si3sHd', '师远东', 'b729473477295ef2fa869d13e0edacba', 'guZU', '0.00', '1577859568', '27.188.231.141', '1', '0', '1llg5b3vdpl0con6lj0bt35qm0', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('171', '165', '0', '0', '18846433059', '18846433059', 'cCvi34SaBWS5', '李刚', 'e7acb25a19bb5b3ba5cb279b8a934304', 'BNNO', '507.00', '1577860611', '123.166.207.98', '1', '0', '05hl0ff0a7dug1sa7972sa0d61', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '5.00', '0', '10', '0', '1', '');
INSERT INTO `ysk_user` VALUES ('172', '165', '0', '0', '18075031017', '18075031017', 'ReWoNOYsNze3', '荣发涛', 'c3d7bb356505ca31a587b64dc10bcea8', 'zG2X', '43.00', '1577861043', '183.167.23.108', '1', '0', 'gng8klqboe96j905aohvkk9ff0', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '39.00', '0', '10', '1', '4', '');
INSERT INTO `ysk_user` VALUES ('173', '165', '0', '0', '18873723013', '18873723013', '0XdsEzyNKsBy', '张可仁', '555572fbe7a44fa8daef8b4065a0fc06', 'KJQf', '0.00', '1577864093', '119.39.248.49', '1', '0', '6bpak6t0t1anrkqlaggfjk6ph0', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('174', '165', '0', '0', '15215716237', '15215716237', 'rGQJgvdAcbpb', '张新英', '56be4f1fc5493b6ad6d6ab380170da3a', 'D6Sp', '0.00', '1577867076', '112.17.238.79', '1', '0', 'jbe7klhv68020n5skfr2195810', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('175', '165', '0', '0', '19970864077', '19970864077', 'y41uXpT638eT', '谭志远', 'c3d86beaf82cb16bac63ecd480fb10f4', 'aeEl', '0.00', '1577868365', '182.97.135.41', '1', '0', 'fcqrqfgqfcsauifrmf5bbqhub1', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('176', '165', '0', '0', '17521149197', '17521149197', 'djOB2nIEYNOd', '王新钘', '055f026a58306bfc10a92fbbe2c29bab', 'PG0W', '0.00', '1577885851', '114.220.156.242', '1', '0', 'sf1omp476sl1ff67one3ubgbf7', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('177', '165', '0', '0', '18855682222', '18855682222', 'tx3Cvsm4E4fU', '余晨曦', '3b224db4d167c6367501b7eb0e13eb7b', '5ywD', '0.00', '1577976833', '183.160.226.92', '1', '0', 'drbi3o07dr92k1pc4dknq5sqi6', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('178', '165', '0', '0', '18648476450', '18648476450', '4IlfL0gHdQOS', '张乐', 'a86749e75c2832c2eca989d279934043', 'yjXi', '0.00', '1577978374', '110.17.1.239', '1', '0', 'oudg55d5mn3thbm39edhc2dn47', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('179', '165', '0', '0', '15665431432', '15665431432', 'aWzTOo4trRat', '余晨曦', 'e9d79a67995f7a865fc2b0eb5428d2d2', 'gEcB', '5001.00', '1577978421', '223.104.34.94', '1', '0', '2j9qreu724ekri9u4h9afsert4', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('180', '165', '0', '0', '15051491491', '15051491491', 'CTXs6en6rRWg', '周志刚', '6ade329f13e0b511f73e58e757673eae', 'wjrj', '0.00', '1577978614', '122.238.61.162', '1', '0', 'hcj7co99ufid2t5a1jcpi1d0t1', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('181', '165', '0', '0', '13713948362', '13713948362', 'aDqv5Uk6MP8w', 'wang19880910', 'b6dbfc8cbf959a5ccb1034c2682a56cf', 'SSeJ', '0.00', '1577978821', '119.123.31.122', '1', '0', 'p1qf548bjs65uchoonsan07vs1', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('182', '165', '0', '0', '15679816051', '15679816051', 'G3umi5c7NshT', 'superggh', '669a7783fd38efc3b245df5b3fb9aeba', 'KoJ9', '0.00', '1577979106', '183.251.92.237', '1', '0', '7hht8fkh7fta5simmu0vnui2f2', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('183', '165', '0', '0', '13110115142', '13110115142', '64fYjx4UulN3', '徐徐', 'bc80c9be4594580be51b2e738bade79f', 'B9ra', '0.00', '1577980929', '125.84.188.28', '1', '0', '47enn79evd8k27lm08ipeej413', '', '', '', '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('184', '165', '0', '0', '18520182079', '18520182079', 'sjy9r1XUAKi9', '大胖', 'ce44a5afbe083a181034dfd7edaa76fc', 'NOtZ', '0.00', '1578012746', '112.96.173.233', '1', '0', 'c6dq9jg4n9icdf680eei6moco2', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('185', '165', '0', '0', '15322312626', '15322312626', 'Sd8nWKeWpFyC', '轩柏', '236371a7def7ac8271f61950165d9104', 'WTL6', '0.00', '1578014866', '113.67.19.41', '1', '0', '3neof058a50al3m810mujm39g5', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('186', '165', '0', '0', '13386909567', '13386909567', '4xuTw5mxD1bi', '李大帅逼', '190350110537d9e9cf26fac359eadfc8', 'yhXl', '0.00', '1578026171', '27.159.251.2', '1', '0', 'l4q0env5uldrik40a6qqs34hi0', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('187', '165', '0', '0', '15306350631', '15306350631', 'i6LePYg4PBir', '李纯兵', '9b78c5faecc1ce441255e6d4f9e60952', 'NPcJ', '0.00', '1578027425', '113.129.56.6', '1', '0', 'm76erueani1ve3ufrior2p05o4', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('188', '165', '0', '0', '15666854567', '15666854567', '74hMO6G07IRy', '姜万飞', '67d1dd8f1fe7ab2c4c415871aacbf1db', 'q551', '0.00', '1578027545', '112.38.61.106', '1', '0', 'r7chp3364shbsk4nanubdvqf86', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('189', '165', '0', '0', '13693146786', '13693146786', 'Iwvbin2NAnbZ', '花杰', '0c6e05344c94b6eb4ef411679b1f9ae7', 'ejMA', '0.00', '1578029462', '223.104.3.145', '1', '0', 'brhcpotgige7vh52rt385kcb12', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('190', '165', '0', '0', '18558925009', '18558925009', '8WHDWHJRlx49', '罗丁根', 'dca58b721a25e0ac8d88a2aa94e83e36', 'r3Dw', '0.00', '1578033627', '220.249.163.44', '1', '0', 'bjc0cp4q294bilqpra4i8g1o61', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('191', '165', '0', '0', '18371000792', '18371000792', 'QzCfy0Tpw0A6', '心痒痒', 'c38257022639f9ae4074bd1609f514d1', '5CsN', '0.00', '1578038882', '116.136.21.240', '1', '0', '9l0sdv18v3og619aa6a2rpbsj3', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('192', '165', '0', '0', '18972222582', '18972222582', 'uA1a0rrPhlUC', '李光宇', 'eece617c8e8ccafa1177b77d76562066', 'KEQe', '0.00', '1578041205', '171.82.191.40', '1', '0', 'gaatk686thqcnsa0ej0gtt65c5', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('193', '165', '0', '0', '15838717882', '15838717882', 'qgDMaKTSBJPt', '秦守博', 'e90ff49632cf1d77bdb82adb547bfe4b', '3DQg', '-4924.00', '1578041979', '61.158.147.132', '0', '0', 'q6q9ciosvo9c4c4pqusc7o33d5', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '75.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('194', '165', '0', '0', '18818907350', '18818907350', 'xaE0JZQxPER1', '黄金容', 'cabb63d4e855a89bd034dc280b8f60e4', 'AVCY', '0.00', '1578104828', '113.67.17.203', '1', '0', 'j343fkl92utdiju8hrjk7sqb66', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('195', '165', '0', '0', '13153688111', '13153688111', 'OSLTAhzSDt7o', '胡烨光', '04213ac2b966b93ec4f04265ac7f4c87', 'jq5y', '0.00', '1578130069', '112.224.67.187', '1', '0', 'g6n1g01ki5gldjcben93gjqc60', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('196', '165', '0', '0', '17703945962', '17703945962', 'u2VjWxo1o8fX', '郭义文', '1b1f73f3d192d97806d0c1d070970d8f', 'F4Gi', '0.00', '1578298074', '171.10.39.120', '1', '0', '09g04go4piav1p2uguk7npgup6', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('197', '165', '0', '0', '13949018408', '13949018408', 'S8MJIEgxpwEv', '陈鹏飞', 'da9ab27fd42daba172a7312249a2fb12', 'd9uw', '0.00', '1578298249', '223.104.108.63', '1', '0', 'i119clptb1kfg2kqregvi8esm4', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('198', '165', '0', '0', '19961980369', '19961980369', '6ep6H7j6Ua9Z', '刘杨', 'a5c73dd83ef9711237d46f6d5983805a', 'NulM', '0.00', '1578298845', '49.94.25.229', '1', '0', '5eb560q8bqiut41gsk731tojo2', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('199', '165', '0', '0', '13398322087', '13398322087', '2HxPqVcFXHAx', '欧波', '18c4cfb4cebe7e2183d4efcfb715726d', 'XIY7', '3036.50', '1578298932', '171.216.246.167', '1', '0', '8emas8pqdtgmj7rqvrdcvhs6m6', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '82.50', '0', '10', '1', '2', '');
INSERT INTO `ysk_user` VALUES ('200', '165', '0', '0', '15858874434', '15858874434', 'E3LBaC4YCGAS', '冯建和', '1df25d78ddb552731deb1b9aafacc0d6', 'x6aR', '0.00', '1578299082', '112.17.236.196', '1', '0', '3pbekv4sv17gclantcf7mgqoc5', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '1', '0', '');
INSERT INTO `ysk_user` VALUES ('201', '165', '0', '0', '18831206543', '18831206543', 'zkoifXNCbLTN', '胡子明', '3687448728e1ee9ec3151f6aad599c11', 'nS40', '0.00', '1578299644', '101.74.83.230', '1', '0', 'e23mmrhg4tpm12p9t863r0mt52', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('202', '165', '0', '0', '18768894087', '18768894087', 'j3ixQeCJKzwF', '九', '224989c52246d8db325464e7aea4e7a9', 'epuO', '0.00', '1578299923', '117.136.44.176', '1', '0', null, null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('203', '165', '0', '0', '18236665590', '18236665590', 'RSaOisxYwQ6f', '王', '6a0c6c8b000c2111d1c8bb62daff8ed7', 'z71c', '0.00', '1578300198', '117.136.44.176', '1', '0', '4ce6ro0m5a0s69lmmhj4crlb16', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', null, '0', '');
INSERT INTO `ysk_user` VALUES ('204', '165', '0', '0', '13255445422', '13255445422', 'BFwP2pVFVp7r', '孙伯炀', 'e1931c3fa1d6d5c1d58328778f4fdd2d', 'kBWE', '0.00', '1578303841', '111.14.38.29', '1', '0', 'jl08u596dauptllbhndf0lphh0', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('205', '165', '0', '0', '13674941913', '13674941913', 'RYt1X16kgdZZ', '宋信帅', '342ae2f2a2af2fe47a02b7693f9c4a8e', 'YStN', '0.00', '1578304375', '223.104.111.252', '1', '0', 'jrtlvhvg27sv575jo17m3c86i1', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('206', '9', '0', '0', '15518888888', '15518888888', 'eF6zhAKMCwjZ', '小朋友', 'f3db8e48121c149ca507d71d4fbf96b8', 'e4xj', '0.00', '1578305157', '115.48.58.244', '1', '0', 'vp3ujivj3fh0j19fdsv09160l7', '', '', '', '', '', '', '-9-', '1', '0', '1', '1', '0.00', '1', '50', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('207', '165', '0', '0', 'agent', 'agent', 'lou3zXfe7WBD', '罗天', '5b17fd8dcec9cb30310b7d1ee9eb5ae8', '4950', '0.00', '1578319936', '42.232.94.123', '1', '0', '2lql7enfejgledfr4me7omc074', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('208', '165', '0', '0', '15979798334', '15979798334', 'hTKr2YinjHuq', '黄海波', 'dfb8c878ae5e991624480d1568b956ab', 'fwpg', '0.00', '1578377591', '117.136.124.25', '1', '0', 'vqibv3veh1mveu5k3i8oi8ebk7', null, null, null, '', '', '', '-165-', '1', '0', '1', '1', '0.00', '0', '10', '0', '0', '');
INSERT INTO `ysk_user` VALUES ('209', '0', '0', '0', 'agent1', 'agent1', 'B9SR707tC64I', 'agent', '5b17fd8dcec9cb30310b7d1ee9eb5ae8', '4950', '0.00', '1587619192', '', '0', '0', null, null, null, null, '', '', '', null, '0', '0', '1', '1', '0.00', '1', '10', null, '0', '');

-- ----------------------------
-- Table structure for ysk_userrob
-- ----------------------------
DROP TABLE IF EXISTS `ysk_userrob`;
CREATE TABLE `ysk_userrob` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `class` int(2) NOT NULL COMMENT '支付类别',
  `price` float(10,2) NOT NULL COMMENT '金额',
  `yjjc` float(10,2) NOT NULL COMMENT '佣金加成',
  `umoney` float(10,2) NOT NULL COMMENT '会员余额',
  `uaccount` varchar(225) NOT NULL COMMENT '会员账号',
  `uname` varchar(225) NOT NULL COMMENT '会员姓名',
  `ppid` int(11) NOT NULL COMMENT '匹配的ID号',
  `status` int(2) NOT NULL COMMENT '状态1等2匹配中3成功',
  `addtime` varchar(225) NOT NULL COMMENT '添加时间',
  `pipeitime` int(10) NOT NULL COMMENT '匹配成功时间',
  `finishtime` varchar(225) NOT NULL COMMENT '交易完成时间',
  `ordernum` varchar(225) NOT NULL COMMENT '订单号',
  `pay_sn` varchar(255) DEFAULT NULL COMMENT '充值编号',
  `pay_money` varchar(255) DEFAULT NULL,
  `idewm` int(11) DEFAULT NULL,
  `ts` int(11) NOT NULL DEFAULT '0' COMMENT '是否投诉',
  `tspic` varchar(225) DEFAULT NULL COMMENT '投诉图片',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`,`class`) USING BTREE,
  KEY `ordernum` (`ordernum`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员抢单表前台发起的';

-- ----------------------------
-- Records of ysk_userrob
-- ----------------------------
INSERT INTO `ysk_userrob` VALUES ('1', '9', '1', '100.00', '0.00', '95513.07', '13800138000', '15566667777', '2', '3', '1574597951', '1574597951', '1574597961', 'N855945146911', 'N802694802513', '100.00', '73', '0', null);
INSERT INTO `ysk_userrob` VALUES ('2', '9', '2', '3500.00', '0.00', '98413.57', '13800138000', '15566667777', '4', '3', '1574668692', '1574668692', '1574668728', 'N734336345449', 'N744495142585', '3500.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('3', '9', '2', '500.00', '0.00', '94931.07', '13800138000', '15566667777', '3', '3', '1574668847', '1574668847', '1574668881', 'N255938827733', 'E15746014598752', '500.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('4', '159', '2', '500.00', '0.00', '5000.00', '13931091933', '13931091933', '106', '3', '1574671150', '1574671150', '1574671225', 'N994212083538', 'N545420557074', '500.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('5', '157', '1', '500.00', '0.00', '5000.00', '18731028899', '18731028899', '107', '3', '1574672434', '1574672434', '1574672582', 'N387020375599', 'N012299093754', '500.00', '88', '0', null);
INSERT INTO `ysk_userrob` VALUES ('6', '157', '1', '3500.00', '0.00', '4502.50', '18731028899', '18731028899', '108', '3', '1574672915', '1574672915', '1574672922', 'N254869999351', 'N478177832735', '3500.00', '88', '0', null);
INSERT INTO `ysk_userrob` VALUES ('8', '159', '2', '200.00', '0.00', '4502.50', '13931091933', '13931091933', '123', '3', '1574739339', '1574739339', '1574739352', 'N926246144061', 'N056634230144', '200.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('9', '159', '2', '500.00', '0.00', '4303.50', '13931091933', '13931091933', '128', '3', '1574739407', '1574739407', '1574739415', 'N535331139551', 'N364198647569', '500.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('10', '159', '2', '500.00', '0.00', '3806.00', '13931091933', '13931091933', '127', '3', '1574739566', '1574739566', '1574739577', 'N259434165653', 'N364198647569', '500.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('11', '159', '2', '500.00', '0.00', '3308.50', '13931091933', '13931091933', '122', '3', '1574741413', '1574741413', '1574741496', 'N785466491479', 'E15747339745216', '500', '86', '2', '/Public/attached/2019/11/26/5ddca5cd1d916.jpg');
INSERT INTO `ysk_userrob` VALUES ('12', '159', '2', '500.00', '0.00', '2811.00', '13931091933', '13931091933', '126', '3', '1574745139', '1574745139', '1574745145', 'N781551981223', 'N364198647569', '500.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('13', '159', '2', '500.00', '0.00', '5313.50', '13931091933', '13931091933', '125', '3', '1574745570', '1574745570', '1574745577', 'N588666814779', 'N364198647569', '500.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('14', '159', '2', '500.00', '0.00', '4816.00', '13931091933', '13931091933', '124', '3', '1574745645', '1574745645', '1574745650', 'N751929766614', 'N364198647569', '500.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('15', '159', '2', '1000.00', '0.00', '4318.50', '13931091933', '13931091933', '134', '3', '1574745772', '1574745772', '1574745786', 'N937072195303', 'N588081160319', '1000.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('16', '159', '2', '1000.00', '0.00', '3323.50', '13931091933', '13931091933', '133', '3', '1574745926', '1574745926', '1574745931', 'N495786813283', 'N588081160319', '1000.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('17', '156', '2', '1000.00', '0.00', '18010.00', '13100007777', '13100007777', '132', '3', '1574747385', '1574747385', '1574747393', 'N156861821712', 'N588081160319', '1000.00', '90', '0', null);
INSERT INTO `ysk_userrob` VALUES ('18', '156', '2', '1000.00', '0.00', '17020.00', '13100007777', '13100007777', '131', '3', '1574747510', '1574747510', '1574747515', 'N926757070615', 'N588081160319', '1000.00', '90', '0', null);
INSERT INTO `ysk_userrob` VALUES ('19', '155', '2', '1000.00', '0.00', '6015.90', '13100006666', '13100006666', '130', '3', '1574747670', '1574747670', '1574747676', 'N835279359610', 'N588081160319', '1000.00', '83', '0', null);
INSERT INTO `ysk_userrob` VALUES ('20', '152', '2', '200.00', '0.00', '3007.70', '13111112222', '13111112222', '137', '3', '1574748155', '1574748155', '1574748161', 'N343230965518', 'N098924025019', '200.00', '60', '0', null);
INSERT INTO `ysk_userrob` VALUES ('21', '159', '2', '200.00', '0.00', '2333.50', '13931091933', '13931091933', '135', '3', '1574750706', '1574750706', '1574750717', 'N496540389758', 'N098924025019', '200.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('22', '159', '2', '200.00', '0.00', '2135.50', '13931091933', '13931091933', '136', '3', '1574750939', '1574750939', '1574751081', 'N150663771647', 'N098924025019', '200.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('23', '9', '2', '100.00', '0.00', '94333.57', '13800138000', '15566667777', '138', '3', '1574927534', '1574927534', '1574927546', 'N347494273258', 'N925890065989', '100.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('24', '9', '2', '100.00', '0.00', '95234.57', '13800138000', '15566667777', '139', '3', '1574928418', '1574928418', '1574943983', 'N282958036795', 'N408660869886', '100.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('25', '159', '2', '200.00', '0.00', '6215.50', '13931091933', '13931091933', '140', '3', '1575002766', '1575002766', '1575002777', 'N413533830903', 'N023791160203', '200.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('26', '159', '2', '200.00', '0.00', '6017.50', '13931091933', '13931091933', '141', '3', '1575002827', '1575002827', '1575002838', 'N620196442478', 'N023791160203', '200.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('27', '159', '2', '200.00', '0.00', '5819.50', '13931091933', '13931091933', '142', '3', '1575002932', '1575002932', '1575002995', 'N649524131296', 'N023791160203', '200.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('28', '159', '2', '300.00', '0.00', '5521.50', '13931091933', '13931091933', '143', '3', '1575003388', '1575003388', '1575003401', 'N161363004035', 'N109067989069', '300.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('29', '159', '2', '300.00', '0.00', '5224.50', '13931091933', '13931091933', '144', '3', '1575003450', '1575003450', '1575003459', 'N180451743464', 'N109067989069', '300.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('30', '9', '2', '300.00', '0.00', '95135.57', '13800138000', '15566667777', '145', '4', '1575011432', '1575011432', '', 'N337220675029', 'N109067989069', '300.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('31', '9', '2', '300.00', '0.00', '95135.57', '13800138000', '15566667777', '148', '3', '1575013148', '1575013148', '1575013189', 'N950098843385', 'N293306150044', '300.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('32', '9', '2', '300.00', '0.00', '94838.57', '13800138000', '15566667777', '147', '4', '1575018289', '1575018289', '', 'N632103953129', 'N109067989069', '300.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('33', '159', '2', '300.00', '0.00', '1027.50', '13931091933', '13931091933', '146', '4', '1575018691', '1575018691', '', 'N782991868472', 'N109067989069', '300.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('34', '159', '2', '900.00', '0.00', '1027.50', '13931091933', '13931091933', '149', '3', '1575019236', '1575019236', '1575019243', 'N528978567592', 'N518617975266', '900.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('35', '9', '2', '500.00', '0.00', '94838.57', '13800138000', '15566667777', '151', '4', '1575162866', '1575162866', '', 'N281646594093', 'E15751220029183', '500.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('36', '159', '2', '1000.00', '1.00', '2137.50', '13931091933', '13931091933', '152', '3', '1575261348', '1575261348', '1575261375', 'N032919996095', 'N555316056669', '1000.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('37', '159', '2', '1000.00', '1.00', '1147.50', '13931091933', '13931091933', '153', '3', '1575261425', '1575261425', '1575261432', 'N877974960801', 'N555316056669', '1000.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('38', '159', '2', '1000.00', '1.00', '2058.50', '13931091933', '13931091933', '154', '3', '1575270357', '1575270357', '1575270367', 'N047384648195', 'N555316056669', '1000.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('39', '159', '2', '4000.00', '1.00', '5069.50', '13931091933', '13931091933', '159', '3', '1575271786', '1575271786', '1575271792', 'N932881518368', 'N067202184675', '4000.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('40', '9', '2', '1000.00', '1.00', '94838.57', '13800138000', '15566667777', '155', '3', '1575275995', '1575275995', '1575276021', 'N518331565578', 'N555316056669', '1000.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('42', '159', '2', '1000.00', '0.00', '17514.50', '13931091933', '13931091933', '160', '3', '1575293748', '1575293748', '1575293822', 'N516168801087', 'N291543218524', '1000.00', '86', '0', null);
INSERT INTO `ysk_userrob` VALUES ('43', '1', '2', '1000.00', '0.00', '6765.44', '13100000000', '13100000000', '168', '3', '1575294174', '1575294174', '1575294181', 'N468396534505', 'N881764183372', '1000.00', '91', '0', null);
INSERT INTO `ysk_userrob` VALUES ('44', '152', '2', '1000.00', '0.00', '3810.70', '13111112222', '13111112222', '167', '3', '1575294662', '1575294662', '1575294671', 'N359254980039', 'N881764183372', '1000.00', '92', '0', null);
INSERT INTO `ysk_userrob` VALUES ('45', '152', '2', '100.00', '0.00', '2825.70', '13111112222', '13111112222', '178', '3', '1575294921', '1575294921', '1575294927', 'N372208366221', 'N008023427277', '100.00', '92', '0', null);
INSERT INTO `ysk_userrob` VALUES ('47', '152', '2', '100.00', '0.00', '2628.70', '13111112222', '13111112222', '176', '3', '1575295880', '1575295880', '1575295892', 'N501458366868', 'N008023427277', '100.00', '92', '0', null);
INSERT INTO `ysk_userrob` VALUES ('48', '155', '2', '1200.00', '0.00', '5025.90', '13100006666', '13100006666', '161', '3', '1575296052', '1575296052', '1575296082', 'N153599586085', 'N690919360450', '1200.00', '93', '0', null);
INSERT INTO `ysk_userrob` VALUES ('49', '155', '2', '100.00', '0.00', '3843.90', '13100006666', '13100006666', '175', '3', '1575296250', '1575296250', '1575296256', 'N389125478408', 'N008023427277', '100.00', '93', '0', null);
INSERT INTO `ysk_userrob` VALUES ('50', '155', '2', '10000.00', '0.00', '13745.40', '13100006666', '13100006666', '183', '3', '1575296469', '1575296469', '1575296475', 'N626147043632', 'N958899380943', '10000.00', '93', '0', null);
INSERT INTO `ysk_userrob` VALUES ('51', '152', '2', '10000.00', '0.00', '12581.05', '13111112222', '13111112222', '182', '3', '1575296583', '1575296583', '1575296589', 'N365817433676', 'N958899380943', '10000.00', '92', '0', null);
INSERT INTO `ysk_userrob` VALUES ('52', '155', '2', '1000.00', '0.00', '3895.40', '13100006666', '13100006666', '164', '3', '1575296663', '1575296663', '1575296668', 'N421416028352', 'N881764183372', '1000.00', '93', '0', null);
INSERT INTO `ysk_userrob` VALUES ('53', '156', '2', '10000.00', '0.00', '16030.00', '13100007777', '13100007777', '181', '3', '1575296802', '1575296802', '1575296812', 'N938008197500', 'N958899380943', '10000.00', '90', '0', null);
INSERT INTO `ysk_userrob` VALUES ('55', '152', '2', '100.00', '0.00', '2758.05', '13111112222', '13111112222', '174', '4', '1575297395', '1575297395', '', 'N247941022207', 'N008023427277', '100.00', '92', '0', null);
INSERT INTO `ysk_userrob` VALUES ('57', '156', '2', '100.00', '0.00', '6081.50', '13100007777', '13100007777', '173', '3', '1575304897', '1575304897', '1578045913', 'N623730858372', 'N008023427277', '100.00', '94', '0', null);
INSERT INTO `ysk_userrob` VALUES ('59', '9', '2', '100.00', '0.00', '1000.00', '13800138000', '15566667777', '170', '4', '1575364667', '1575364667', '', 'N778746295681', 'N008023427277', '100.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('60', '9', '2', '100.00', '0.00', '1000.00', '13800138000', '15566667777', '171', '4', '1575431209', '1575431209', '', 'N634639310884', 'N008023427277', '100.00', '85', '0', null);
INSERT INTO `ysk_userrob` VALUES ('61', '9', '1', '500.00', '0.00', '1000.00', '13800138000', '15566667777', '194', '3', '1575886717', '1575886717', '1575886862', 'N900567298011', 'E15758867096396', '500.00', '95', '0', null);
INSERT INTO `ysk_userrob` VALUES ('62', '9', '1', '500.00', '0.00', '507.50', '13800138000', '15566667777', '195', '3', '1575886933', '1575886933', '1575887300', 'N691363955446', 'E15758869243156', '500.00', '95', '0', null);
INSERT INTO `ysk_userrob` VALUES ('63', '9', '1', '500.00', '0.00', '516.00', '13800138000', '15566667777', '196', '3', '1575887365', '1575887365', '1575887384', 'N125475645120', 'E15758873482276', '500.00', '95', '0', null);
INSERT INTO `ysk_userrob` VALUES ('64', '9', '1', '0.00', '0.00', '524.50', '13800138000', '15566667777', '207', '3', '1575887916', '1575966065', '1576006869', 'N080163910709', 'E15758877851077', '500.00', '95', '0', null);
INSERT INTO `ysk_userrob` VALUES ('65', '164', '1', '1000.00', '0.00', '10000.00', '13783914073', '张磊', '209', '3', '1576068905', '1576068905', '1576068910', 'N269812237427', 'N666502582464', '1000.00', '96', '0', null);
INSERT INTO `ysk_userrob` VALUES ('66', '164', '1', '1000.15', '0.00', '9015.00', '13783914073', '张磊', '210', '3', '1576069055', '1576069055', '1576069063', 'N590955263888', 'N902479199491', '1000.15', '96', '0', null);
INSERT INTO `ysk_userrob` VALUES ('67', '164', '1', '500.00', '0.00', '8044.85', '13783914073', '张磊', '211', '3', '1576069184', '1576069184', '1576069194', 'N994262500372', 'N513394259180', '500.00', '96', '0', null);
INSERT INTO `ysk_userrob` VALUES ('68', '164', '1', '1000.13', '0.00', '7559.85', '13783914073', '张磊', '212', '3', '1576069324', '1576069324', '1576069337', 'N573283640807', 'N185423050755', '1000.13', '96', '0', null);
INSERT INTO `ysk_userrob` VALUES ('69', '9', '1', '500.00', '0.00', '10066.50', '13800138000', '15566667777', '230', '3', '1576732017', '1576732017', '1576732053', 'N620876709831', 'E15767318102742', '500.00', '95', '0', null);
INSERT INTO `ysk_userrob` VALUES ('70', '9', '2', '500.00', '0.00', '9581.50', '13800138000', '15566667777', '243', '3', '1576732848', '1576732848', '1576732897', 'N894436467197', 'E15767327827598', '500.00', '97', '0', null);
INSERT INTO `ysk_userrob` VALUES ('71', '9', '1', '5000.00', '0.00', '5763.50', '13800138000', '15566667777', '244', '3', '1576733097', '1576733097', '1576733118', 'N119911282181', 'N345807357629', '5000.00', '95', '0', null);
INSERT INTO `ysk_userrob` VALUES ('72', '9', '2', '1.00', '0.00', '913.50', '13800138000', '15566667777', '245', '3', '1576733164', '1576733164', '1578045884', 'N010947045974', 'E15767331625108', '1.00', '97', '0', null);
INSERT INTO `ysk_userrob` VALUES ('73', '9', '2', '500.00', '0.00', '112075.50', '13800138000', '15566667777', '259', '4', '1576733840', '1576733840', '', 'N487686617641', 'E15767335934271', '500.00', '98', '0', null);
INSERT INTO `ysk_userrob` VALUES ('74', '9', '2', '500.00', '0.00', '191900.50', '13800138000', '15566667777', '260', '3', '1576747063', '1576747063', '1576747082', 'N782326597793', 'E15767351058537', '500.00', '97', '0', null);
INSERT INTO `ysk_userrob` VALUES ('75', '9', '2', '500.00', '0.00', '191415.50', '13800138000', '15566667777', '268', '4', '1576761140', '1576761140', '', 'N212614605605', 'E15767588801690', '500.00', '97', '0', null);
INSERT INTO `ysk_userrob` VALUES ('76', '9', '2', '500.00', '0.00', '190915.50', '13800138000', '15566667777', '269', '4', '1576762606', '1576762606', '', 'N939489421059', 'E15767626037253', '500.00', '98', '0', null);
INSERT INTO `ysk_userrob` VALUES ('77', '9', '2', '500.00', '0.00', '190915.50', '13800138000', '15566667777', '279', '3', '1576820862', '1576820862', '1576820902', 'N061515238408', 'E15767798411628', '500.00', '97', '0', null);
INSERT INTO `ysk_userrob` VALUES ('78', '9', '2', '500.00', '0.00', '190430.50', '13800138000', '15566667777', '280', '3', '1577455905', '1577455905', '1578045866', 'N893808387242', 'E15774556023730', '500.00', '98', '0', null);
INSERT INTO `ysk_userrob` VALUES ('79', '171', '2', '500.00', '0.00', '1001.00', '18846433059', '李刚', '282', '3', '1577929127', '1577929127', '1577929159', 'N441639175214', 'E15778904233362', '500.00', '103', '0', null);
INSERT INTO `ysk_userrob` VALUES ('81', '165', '3', '2000.00', '0.00', '28020.00', '14725836900', '14725836900', '287', '3', '1577976585', '1577976585', '1577976606', 'N677840713240', 'N923733761342', '2000.00', '106', '0', null);
INSERT INTO `ysk_userrob` VALUES ('84', '9', '3', '0.00', '0.00', '180430.50', '13800138000', '15566667777', '296', '3', '1577977468', '1577977609', '1577977649', 'N496775261031', 'N160820079821', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('85', '9', '3', '10000.00', '0.00', '180530.50', '13800138000', '15566667777', '298', '3', '1577977719', '1577977719', '1577977728', 'N620684739897', 'N555769532297', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('86', '9', '3', '3000.00', '0.00', '180680.50', '13800138000', '15566667777', '300', '3', '1577978761', '1577978761', '1577978775', 'N955105330569', 'N992906686706', '3000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('87', '165', '3', '2000.00', '0.00', '26040.00', '14725836900', '14725836900', '299', '3', '1578012625', '1578012625', '1578012639', 'N403563493056', 'N785576694388', '2000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('88', '165', '3', '10000.00', '0.00', '24070.00', '14725836900', '14725836900', '301', '3', '1578016149', '1578016149', '1578016166', 'N972816160609', 'N855415491647', '10000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('89', '165', '3', '3000.00', '0.00', '14220.00', '14725836900', '14725836900', '302', '3', '1578016243', '1578016243', '1578016255', 'N409048562184', 'N168439070202', '3000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('90', '165', '3', '5000.00', '0.00', '11265.00', '14725836900', '14725836900', '303', '3', '1578016277', '1578016277', '1578016292', 'N595667527671', 'N218979350751', '5000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('91', '9', '1', '100.00', '0.00', '177725.50', '13800138000', '15566667777', '304', '3', '1578017389', '1578017389', '1578017400', 'N849908871235', 'N085456447568', '100.00', '95', '0', null);
INSERT INTO `ysk_userrob` VALUES ('93', '165', '3', '2500.00', '0.00', '6340.00', '14725836900', '14725836900', '306', '3', '1578017649', '1578017649', '1578018369', 'N555247223401', 'N552462446647', '2500.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('94', '165', '3', '2500.00', '0.00', '3877.50', '14725836900', '14725836900', '307', '3', '1578018370', '1578018370', '1578018381', 'N685733594610', 'N472540809532', '2500.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('95', '165', '3', '10000.00', '0.00', '101415.00', '14725836900', '14725836900', '308', '3', '1578027228', '1578027228', '1578027266', 'N917647601727', 'N808862424535', '10000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('96', '166', '1', '0.00', '0.00', '501.00', '18022484190', '陈冬明', '310', '3', '1578027557', '1578027684', '1578027688', 'N545175041604', 'N489270169329', '350.00', '101', '0', null);
INSERT INTO `ysk_userrob` VALUES ('97', '165', '3', '8000.00', '0.00', '91566.47', '14725836900', '14725836900', '311', '3', '1578027723', '1578027723', '1578027750', 'N738381063894', 'N803312486644', '8000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('98', '165', '3', '12000.00', '0.00', '83686.47', '14725836900', '14725836900', '312', '3', '1578027750', '1578027750', '1578027764', 'N260576649065', 'N017737359555', '12000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('99', '179', '1', '3500.00', '0.00', '5001.00', '15665431432', '余晨曦', '324', '4', '1578028548', '1578028548', '', 'N653486171196', 'N925049230786', '3500.00', '115', '0', null);
INSERT INTO `ysk_userrob` VALUES ('100', '165', '3', '9500.00', '0.00', '71866.47', '14725836900', '14725836900', '313', '3', '1578028567', '1578028567', '1578028672', 'N075310762732', 'N756647462778', '9500.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('101', '165', '3', '10000.00', '0.00', '62508.97', '14725836900', '14725836900', '314', '3', '1578028674', '1578028674', '1578028687', 'N099034802825', 'N587721382716', '10000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('102', '165', '3', '10000.00', '0.00', '52658.97', '14725836900', '14725836900', '315', '3', '1578028689', '1578028689', '1578028779', 'N955982015215', 'N587721382716', '10000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('103', '165', '3', '10000.00', '0.00', '42808.97', '14725836900', '14725836900', '316', '3', '1578028780', '1578028780', '1578028793', 'N063736578736', 'N587721382716', '10000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('104', '165', '3', '10000.00', '0.00', '32958.97', '14725836900', '14725836900', '317', '3', '1578028794', '1578028794', '1578028805', 'N351741834653', 'N587721382716', '10000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('105', '165', '3', '10000.00', '0.00', '23108.97', '14725836900', '14725836900', '318', '3', '1578028806', '1578028806', '1578029141', 'N823264677104', 'N587721382716', '10000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('106', '179', '1', '3500.00', '0.00', '5001.00', '15665431432', '余晨曦', '325', '4', '1578028868', '1578028868', '', 'N320191670950', 'N925049230786', '3500.00', '116', '0', null);
INSERT INTO `ysk_userrob` VALUES ('107', '165', '1', '3500.00', '0.00', '13258.97', '14725836900', '14725836900', '326', '3', '1578030395', '1578030395', '1578030408', 'N135951521778', 'N925049230786', '3500.00', '117', '0', null);
INSERT INTO `ysk_userrob` VALUES ('108', '165', '1', '5000.00', '0.00', '9807.97', '14725836900', '14725836900', '327', '3', '1578030409', '1578030409', '1578030420', 'N288918075086', 'N463680259578', '5000.00', '117', '0', null);
INSERT INTO `ysk_userrob` VALUES ('109', '172', '3', '700.00', '0.00', '1001.00', '18075031017', '荣发涛', '343', '3', '1578031419', '1578031419', '1578031789', 'N009572239011', 'N891855167816', '700.00', '119', '0', null);
INSERT INTO `ysk_userrob` VALUES ('110', '172', '3', '900.00', '0.00', '1312.50', '18075031017', '荣发涛', '344', '3', '1578032401', '1578032401', '1578032525', 'N861008279192', 'N772066746751', '900.00', '119', '0', null);
INSERT INTO `ysk_userrob` VALUES ('111', '172', '3', '500.00', '0.00', '1427.00', '18075031017', '荣发涛', '350', '3', '1578033169', '1578033169', '1578033253', 'N687490825863', 'N241482595936', '500.00', '119', '0', null);
INSERT INTO `ysk_userrob` VALUES ('112', '172', '3', '500.00', '0.00', '934.50', '18075031017', '荣发涛', '351', '3', '1578034029', '1578034029', '1578034129', 'N195441888135', 'N490521744878', '500.00', '119', '0', null);
INSERT INTO `ysk_userrob` VALUES ('113', '165', '1', '1500.00', '0.00', '4889.67', '14725836900', '14725836900', '331', '3', '1578040919', '1578040919', '1578040970', 'N948356625650', 'N486015351237', '1500.00', '117', '0', null);
INSERT INTO `ysk_userrob` VALUES ('114', '165', '3', '10000.00', '0.00', '53410.67', '14725836900', '14725836900', '319', '3', '1578042952', '1578042952', '1578043016', 'N292708516542', 'N587721382716', '10000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('115', '165', '3', '10000.00', '0.00', '43560.67', '14725836900', '14725836900', '320', '3', '1578043023', '1578043023', '1578043035', 'N253129251421', 'N587721382716', '10000.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('116', '165', '3', '7700.00', '0.00', '33710.67', '14725836900', '14725836900', '332', '3', '1578043066', '1578043066', '1578043075', 'N435888577429', 'N365341959467', '7700.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('117', '165', '3', '4500.00', '0.00', '26126.17', '14725836900', '14725836900', '328', '3', '1578043149', '1578043149', '1578043157', 'N084280593825', 'N810348302983', '4500.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('118', '165', '3', '8500.00', '0.00', '21693.67', '14725836900', '14725836900', '330', '3', '1578044390', '1578044390', '1578044401', 'N924999929715', 'N997188653735', '8500.00', '109', '0', null);
INSERT INTO `ysk_userrob` VALUES ('119', '9', '3', '10000.00', '0.00', '177031.42', '13800138000', '15566667777', '321', '3', '1578047864', '1578047864', '1578047939', 'N962388042525', 'N587721382716', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('120', '9', '3', '10000.00', '0.00', '167281.42', '13800138000', '15566667777', '322', '4', '1578047944', '1578047944', '', 'N914443550775', 'N587721382716', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('121', '193', '3', '5000.00', '0.00', '5001.00', '15838717882', '秦守博', '353', '4', '1578048285', '1578048285', '', 'N860700996959', 'N995136209522', '5000.00', '123', '1', '/Public/attached/2020/01/09/5e16577d1dbe8.jpg');
INSERT INTO `ysk_userrob` VALUES ('122', '193', '3', '5000.00', '0.00', '5001.00', '15838717882', '秦守博', '352', '3', '1578048788', '1578048788', '1578317016', 'N789442175769', 'N103610514613', '5000.00', '123', '1', '/Public/attached/2020/01/07/5e14586db3563.jpg');
INSERT INTO `ysk_userrob` VALUES ('123', '9', '3', '10000.00', '0.00', '167281.42', '13800138000', '15566667777', '323', '4', '1578302042', '1578302042', '', 'N175149857953', 'N587721382716', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('124', '199', '3', '3000.00', '0.00', '3000.00', '13398322087', '欧波', '354', '3', '1578317132', '1578317132', '1578317555', 'N242928184026', 'N702094962345', '3000.00', '128', '0', null);
INSERT INTO `ysk_userrob` VALUES ('125', '199', '3', '2500.00', '0.00', '3000.00', '13398322087', '欧波', '355', '3', '1578318797', '1578318797', '1578318944', 'N509664352500', 'N005415200054', '2500.00', '128', '0', null);
INSERT INTO `ysk_userrob` VALUES ('126', '9', '3', '8500.00', '0.00', '167281.42', '13800138000', '15566667777', '329', '4', '1579085206', '1579085206', '', 'N861882709521', 'N997188653735', '8500.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('127', '9', '3', '10000.00', '0.00', '167281.42', '13800138000', '15566667777', '333', '4', '1579278749', '1579278749', '', 'N151241213996', 'N895504489999', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('128', '9', '3', '10000.00', '0.00', '167281.42', '13800138000', '15566667777', '334', '4', '1579279150', '1579279150', '', 'N165938905754', 'N895504489999', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('129', '9', '3', '10000.00', '0.00', '157281.42', '13800138000', '15566667777', '335', '4', '1579279161', '1579279161', '', 'N613668447695', 'N895504489999', '10000.00', '126', '0', null);
INSERT INTO `ysk_userrob` VALUES ('130', '9', '3', '10000.00', '0.00', '157281.42', '13800138000', '15566667777', '336', '4', '1579368932', '1579368932', '', 'N472852945316', 'N895504489999', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('131', '9', '3', '10000.00', '0.00', '147281.42', '13800138000', '15566667777', '342', '4', '1579368943', '1579368943', '', 'N144547713230', 'N895504489999', '10000.00', '126', '0', null);
INSERT INTO `ysk_userrob` VALUES ('132', '9', '3', '10000.00', '0.00', '147281.42', '13800138000', '15566667777', '337', '4', '1579413246', '1579413246', '', 'N883622047354', 'N895504489999', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('133', '9', '3', '10000.00', '0.00', '137281.42', '13800138000', '15566667777', '338', '3', '1579413247', '1579413247', '1579413267', 'N223309955263', 'N895504489999', '10000.00', '126', '0', null);
INSERT INTO `ysk_userrob` VALUES ('134', '9', '3', '10000.00', '0.00', '137431.42', '13800138000', '15566667777', '339', '4', '1579427243', '1579427243', '', 'N872943833392', 'N895504489999', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('135', '9', '3', '10000.00', '0.00', '137431.42', '13800138000', '15566667777', '340', '4', '1579584611', '1579584611', '', 'N918674879735', 'N895504489999', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('136', '9', '3', '10000.00', '0.00', '137431.42', '13800138000', '15566667777', '341', '4', '1579634027', '1579634027', '', 'N711192844761', 'N895504489999', '10000.00', '100', '0', null);
INSERT INTO `ysk_userrob` VALUES ('137', '21', '1', '500.00', '0.00', '23097.60', '13888888888', '13033556688', '356', '3', '1587867062', '1587867062', '1587867502', 'N112674291150', 'N722794217288', '500.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('138', '21', '1', '500.00', '0.00', '23605.60', '13888888888', '13033556688', '357', '3', '1587867700', '1587867700', '1587867711', 'N473467121366', 'N722794217288', '500.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('139', '21', '1', '500.00', '0.00', '23112.60', '13888888888', '13033556688', '358', '3', '1587867972', '1587867972', '1587868262', 'N544635385108', 'N722794217288', '500.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('140', '21', '3', '100.00', '0.00', '22619.60', '13888888888', '13033556688', '364', '4', '1587868297', '1587868297', '', 'N906016166650', 'N663946979633', '100.00', '134', '0', null);
INSERT INTO `ysk_userrob` VALUES ('141', '21', '1', '1000.00', '0.00', '22519.60', '13888888888', '13033556688', '370', '3', '1587870407', '1587870407', '1587870711', 'N108425135387', 'E1587870257189', '1000.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('142', '21', '1', '1000.00', '0.00', '21633.60', '13888888888', '13033556688', '371', '3', '1587871070', '1587871070', '1587871105', 'N593943579125', 'E15878710659963', '1000.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('143', '21', '1', '500.00', '0.00', '20647.60', '13888888888', '13033556688', '383', '4', '1587951194', '1587951194', '', 'N295424390230', 'E1587951166809', '500.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('144', '21', '1', '500.00', '0.00', '20647.60', '13888888888', '13033556688', '384', '3', '1587952524', '1587952524', '1587956123', 'N394186110364', 'E15879525223887', '500.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('145', '21', '1', '500.00', '0.00', '20154.60', '13888888888', '13033556688', '385', '3', '1587956155', '1587956155', '1587956166', 'N511413664611', 'E15879561471039', '500.00', '133', '2', '/Public/attached/2020/04/27/5ea67cbd7e4e6.png');
INSERT INTO `ysk_userrob` VALUES ('146', '21', '2', '500.00', '0.00', '19661.60', '13888888888', '13033556688', '386', '4', '1587971633', '1587971633', '', 'N155199488533', 'E15879716075171', '500.00', '135', '0', null);
INSERT INTO `ysk_userrob` VALUES ('147', '21', '1', '500.00', '0.00', '19661.60', '13888888888', '13033556688', '390', '3', '1588039927', '1588039927', '1588039946', 'N125275707115', 'E15880397789009', '500.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('148', '21', '1', '500.00', '0.00', '23169.60', '13888888888', '13033556688', '391', '3', '1588064733', '1588064733', '1588064741', 'N695087098487', 'E15880647190001379', '500.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('149', '21', '2', '0.00', '0.00', '22676.60', '13888888888', '13033556688', '395', '3', '1588064753', '1588123370', '1588123726', 'N061617129936', 'E15880647500006391', '500.00', '135', '0', null);
INSERT INTO `ysk_userrob` VALUES ('150', '21', '1', '500.00', '0.00', '22182.10', '13888888888', '13033556688', '394', '3', '1588123702', '1588123702', '1588123718', 'N439637158514', 'N398166344525', '500.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('151', '21', '1', '500.00', '0.00', '21694.60', '13888888888', '13033556688', '396', '3', '1588131017', '1588131017', '1588131091', 'N266002766448', 'E15881309980006329', '500.00', '133', '0', null);
INSERT INTO `ysk_userrob` VALUES ('152', '21', '2', '500.00', '0.00', '21201.60', '13888888888', '13033556688', '398', '3', '1588131099', '1588131099', '1588131108', 'N059688681078', 'E15881310570005760', '500.00', '135', '0', null);
INSERT INTO `ysk_userrob` VALUES ('153', '21', '2', '500.00', '0.00', '20707.10', '13888888888', '13033556688', '399', '4', '1588132021', '1588132021', '', 'N385738554523', 'E15881320160003175', '500.00', '135', '0', null);

-- ----------------------------
-- Table structure for ysk_withdraw
-- ----------------------------
DROP TABLE IF EXISTS `ysk_withdraw`;
CREATE TABLE `ysk_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `account` varchar(225) NOT NULL COMMENT '提现账号',
  `name` varchar(225) NOT NULL COMMENT '提现人姓名',
  `way` varchar(225) NOT NULL COMMENT '提现方式',
  `price` float(10,2) NOT NULL COMMENT '提现金额',
  `addtime` varchar(225) NOT NULL COMMENT '提现时间',
  `endtime` varchar(225) NOT NULL COMMENT '完成时间',
  `status` int(11) NOT NULL COMMENT '状态1提交，2退回3成功',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='提现申请表';

-- ----------------------------
-- Records of ysk_withdraw
-- ----------------------------
INSERT INTO `ysk_withdraw` VALUES ('24', '9', '13800138000', '2', '2|2|2', '100.00', '1574927253', '', '3');
INSERT INTO `ysk_withdraw` VALUES ('25', '159', '13931091933', '我是谁', '123456789|123456789|12滴', '222.00', '1574996429', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('26', '159', '13931091933', '刘德华', '12122122|12122121|1212121', '100.00', '1575003322', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('27', '159', '13931091933', '4900', '123123|132121|123132', '4900.00', '1575017523', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('28', '159', '13931091933', '12312313', '123123|123123|123123', '3000.00', '1575017880', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('29', '159', '13931091933', '给李磊', '1212122|哈哈哈|还差', '100.00', '1575261544', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('30', '159', '13931091933', '151515', '181515|181515|18181', '1000.00', '1575262171', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('31', '159', '13931091933', '急急急', '急急急|急急急|急急急', '1000.00', '1575270426', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('32', '159', '13931091933', '100', '急急急|吉里吉里|急急急', '100.00', '1575277703', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('33', '159', '13931091933', '吉里吉里', '吉里吉里|吉里吉里|急急急', '1000.00', '1575291556', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('34', '156', '13100007777', '123', '123|123|123', '2000.00', '1575298284', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('35', '156', '13100007777', '1231231', '12312312|12312312|123131', '2081.50', '1575298369', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('36', '163', '13500100001', '121212', '12121|12121|12121', '200.00', '1575301121', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('37', '163', '13500100001', '11111', '11111|1111|1111', '100.00', '1575310308', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('38', '159', '13931091933', '200', '200|200|200', '200.00', '1575310381', '', '3');
INSERT INTO `ysk_withdraw` VALUES ('39', '159', '13931091933', '2000', '2000|2000|2000', '2000.00', '1575310444', '', '3');
INSERT INTO `ysk_withdraw` VALUES ('40', '9', '13800138000', '333', '33|33|333', '3333.00', '1576732958', '', '3');
INSERT INTO `ysk_withdraw` VALUES ('41', '171', '18846433059', '李刚', '6212263500039257221|中国工商银行|黑龙江省哈尔滨市道外区桦树支行', '1507.00', '1577934107', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('42', '171', '18846433059', '李刚', '6212263500039257221|中国工商银行|黑龙江省哈尔滨市道外区桦树支行', '1000.00', '1578018494', '', '1');
INSERT INTO `ysk_withdraw` VALUES ('43', '179', '15665431432', '余晨曦', '6226223401626638|民生银行|中国民生银行股份有限公司合肥马鞍山路支行', '5000.00', '1578031141', '', '2');
INSERT INTO `ysk_withdraw` VALUES ('44', '166', '18022484190', '陈冬明', '6215581510007874434|中国工商银行|全南支行', '505.00', '1578031936', '', '1');
INSERT INTO `ysk_withdraw` VALUES ('45', '169', '18928696507', '陈超威', '6226220319537196|民生银行|广东省佛山市南海区里水支行', '2001.00', '1578041201', '', '4');
INSERT INTO `ysk_withdraw` VALUES ('46', '193', '15838717882', '秦守博', '6222081714001505512|工商银行|工商银行南阳行政支行', '5000.00', '1578101701', '', '3');
INSERT INTO `ysk_withdraw` VALUES ('47', '172', '18075031017', '荣发涛', '6212261314002186926|中国工商银行|六安市三里桥支行', '1400.00', '1578201433', '', '3');
INSERT INTO `ysk_withdraw` VALUES ('48', '172', '18075031017', '荣发涛', '6212261314002186926|中国工商银行|安徽省六安市三里桥支行', '1400.00', '1578319807', '', '3');
INSERT INTO `ysk_withdraw` VALUES ('49', '199', '13398322087', '欧波', '6217996750001251446|中国邮政储蓄|通川支行', '3036.00', '1578386223', '', '3');
INSERT INTO `ysk_withdraw` VALUES ('50', '21', '13888888888', '小虾', '2435324234234|中国银行|北京支行', '1000.00', '1588042708', '', '3');

-- ----------------------------
-- Table structure for z_log
-- ----------------------------
DROP TABLE IF EXISTS `z_log`;
CREATE TABLE `z_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1828 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of z_log
-- ----------------------------
INSERT INTO `z_log` VALUES ('1', 'shh001', '127.0.0.1', '1560557427');
INSERT INTO `z_log` VALUES ('2', 'shh001', '223.11.185.230', '1560561273');
INSERT INTO `z_log` VALUES ('3', 'shh001', '117.136.63.94', '1560566390');
INSERT INTO `z_log` VALUES ('4', 'shh001', '112.194.42.171', '1560571518');
INSERT INTO `z_log` VALUES ('5', 'shh001', '223.72.64.152', '1560589038');
INSERT INTO `z_log` VALUES ('6', 'shh001', '119.98.195.87', '1560592117');
INSERT INTO `z_log` VALUES ('7', 'shh001', '117.177.229.237', '1560617126');
INSERT INTO `z_log` VALUES ('8', 'shh001', '171.115.168.217', '1562504617');
INSERT INTO `z_log` VALUES ('9', 'shh001', '171.115.168.217', '1562504630');
INSERT INTO `z_log` VALUES ('10', 'shh001', '171.115.168.217', '1562507005');
INSERT INTO `z_log` VALUES ('11', 'shh001', '171.115.168.217', '1562511873');
INSERT INTO `z_log` VALUES ('12', 'shh001', '218.11.66.50', '1562579414');
INSERT INTO `z_log` VALUES ('13', 'shh001', '183.202.244.186', '1562633077');
INSERT INTO `z_log` VALUES ('14', 'shh001', '115.59.9.214', '1562656853');
INSERT INTO `z_log` VALUES ('15', 'shh001', '117.136.81.91', '1562660866');
INSERT INTO `z_log` VALUES ('16', 'shh001', '223.104.6.47', '1562685688');
INSERT INTO `z_log` VALUES ('17', 'shh001', '35.229.172.2', '1562720188');
INSERT INTO `z_log` VALUES ('18', 'shh001', '35.229.172.2', '1562720280');
INSERT INTO `z_log` VALUES ('19', 'shh001', '35.229.172.2', '1562720284');
INSERT INTO `z_log` VALUES ('20', 'shh001', '123.181.17.67', '1562720491');
INSERT INTO `z_log` VALUES ('21', 'shh001', '123.181.17.67', '1562721439');
INSERT INTO `z_log` VALUES ('22', 'shh001', '123.181.17.67', '1562721504');
INSERT INTO `z_log` VALUES ('23', 'shh001', '35.229.172.2', '1562724879');
INSERT INTO `z_log` VALUES ('24', 'shh001', '106.34.145.192', '1562748385');
INSERT INTO `z_log` VALUES ('25', 'shh001', '220.197.208.223', '1562751189');
INSERT INTO `z_log` VALUES ('26', 'shh001', '113.5.5.185', '1562755774');
INSERT INTO `z_log` VALUES ('27', 'shh001', '1.192.20.247', '1562807980');
INSERT INTO `z_log` VALUES ('28', 'shh001', '60.6.224.205', '1562808979');
INSERT INTO `z_log` VALUES ('29', 'shh001', '60.6.224.205', '1562842484');
INSERT INTO `z_log` VALUES ('30', 'shh001', '121.26.219.214', '1562844852');
INSERT INTO `z_log` VALUES ('531', 'shh001', '27.151.64.61', '1564655023');
INSERT INTO `z_log` VALUES ('532', 'shh001', '36.110.118.87', '1564656478');
INSERT INTO `z_log` VALUES ('533', 'shh001', '36.110.118.87', '1564656862');
INSERT INTO `z_log` VALUES ('534', 'shh001', '122.190.201.109', '1564659519');
INSERT INTO `z_log` VALUES ('535', 'shh001', '122.190.201.109', '1564659831');
INSERT INTO `z_log` VALUES ('536', 'shh001', '122.190.201.109', '1564659872');
INSERT INTO `z_log` VALUES ('537', 'shh001', '122.190.201.109', '1564659908');
INSERT INTO `z_log` VALUES ('538', 'shh001', '182.97.220.8', '1564662096');
INSERT INTO `z_log` VALUES ('539', 'shh001', '121.32.179.176', '1564664499');
INSERT INTO `z_log` VALUES ('540', 'wwwwwwwww', '121.32.179.176', '1564665493');
INSERT INTO `z_log` VALUES ('541', 'shh001', '115.60.92.246', '1564708998');
INSERT INTO `z_log` VALUES ('542', 'shh001', '115.60.92.246', '1564709012');
INSERT INTO `z_log` VALUES ('543', 'shh001', '219.134.219.151', '1564715316');
INSERT INTO `z_log` VALUES ('544', 'shh001', '219.134.219.151', '1564715598');
INSERT INTO `z_log` VALUES ('545', 'shh001', '43.250.200.29', '1564719730');
INSERT INTO `z_log` VALUES ('546', 'shh001', '117.44.182.202', '1564725615');
INSERT INTO `z_log` VALUES ('547', 'shh001', '220.202.152.45', '1564728114');
INSERT INTO `z_log` VALUES ('548', 'shh001', '115.60.90.92', '1564731097');
INSERT INTO `z_log` VALUES ('549', 'shh001', '115.55.19.45', '1564731104');
INSERT INTO `z_log` VALUES ('550', 'shh001', '27.215.209.100', '1564732537');
INSERT INTO `z_log` VALUES ('551', 'shh001', '123.112.213.250', '1564737266');
INSERT INTO `z_log` VALUES ('552', 'shh001', '61.158.149.240', '1564741230');
INSERT INTO `z_log` VALUES ('553', 'shh001', '61.158.149.240', '1564741780');
INSERT INTO `z_log` VALUES ('554', 'shh001', '112.96.25.66', '1564750431');
INSERT INTO `z_log` VALUES ('555', 'shh001', '223.104.108.43', '1564756927');
INSERT INTO `z_log` VALUES ('556', 'shh001', '223.91.202.184', '1564758264');
INSERT INTO `z_log` VALUES ('557', 'shh001', '223.104.106.173', '1564758546');
INSERT INTO `z_log` VALUES ('558', 'shh001', '223.155.41.106', '1564759987');
INSERT INTO `z_log` VALUES ('559', 'shh001', '223.155.41.106', '1564760020');
INSERT INTO `z_log` VALUES ('560', 'shh001', '223.155.41.106', '1564761486');
INSERT INTO `z_log` VALUES ('561', 'shh001', '110.249.150.226', '1564765072');
INSERT INTO `z_log` VALUES ('562', 'shh001', '110.249.150.226', '1564765383');
INSERT INTO `z_log` VALUES ('563', 'shh001', '112.224.67.245', '1564804541');
INSERT INTO `z_log` VALUES ('564', 'shh001', '112.224.65.193', '1564804631');
INSERT INTO `z_log` VALUES ('565', 'shh001', '112.224.67.245', '1564804693');
INSERT INTO `z_log` VALUES ('566', 'shh001', '112.224.65.193', '1564804786');
INSERT INTO `z_log` VALUES ('567', 'shh001', '112.224.67.245', '1564804868');
INSERT INTO `z_log` VALUES ('568', 'shh001', '112.224.67.245', '1564804908');
INSERT INTO `z_log` VALUES ('569', 'shh001', '117.20.117.162', '1564805205');
INSERT INTO `z_log` VALUES ('570', 'shh001', '117.20.117.162', '1564805373');
INSERT INTO `z_log` VALUES ('571', 'shh001', '117.20.117.162', '1564805377');
INSERT INTO `z_log` VALUES ('572', 'shh001', '117.20.117.162', '1564805393');
INSERT INTO `z_log` VALUES ('573', 'shh001', '222.137.211.139', '1564811000');
INSERT INTO `z_log` VALUES ('574', 'shh001', '117.20.117.162', '1564811175');
INSERT INTO `z_log` VALUES ('575', 'shh001', '222.137.211.139', '1564813436');
INSERT INTO `z_log` VALUES ('576', 'shh001', '222.137.211.139', '1564814171');
INSERT INTO `z_log` VALUES ('577', 'shh001', '112.50.68.66', '1564815121');
INSERT INTO `z_log` VALUES ('578', 'shh001', '113.103.113.58', '1564815177');
INSERT INTO `z_log` VALUES ('579', 'shh001', '112.96.193.193', '1564817540');
INSERT INTO `z_log` VALUES ('580', 'shh001', '112.96.193.193', '1564817607');
INSERT INTO `z_log` VALUES ('581', 'shh001', '117.20.117.162', '1564819668');
INSERT INTO `z_log` VALUES ('582', 'shh001', '121.63.107.108', '1564819734');
INSERT INTO `z_log` VALUES ('583', 'shh001', '61.158.149.185', '1564819992');
INSERT INTO `z_log` VALUES ('584', 'shh001', '117.136.107.200', '1564824275');
INSERT INTO `z_log` VALUES ('585', 'shh001', '117.136.107.200', '1564824329');
INSERT INTO `z_log` VALUES ('586', 'shh001', '117.20.117.162', '1564825402');
INSERT INTO `z_log` VALUES ('587', 'shh001', '117.136.40.178', '1564826591');
INSERT INTO `z_log` VALUES ('588', 'shh001', '117.136.40.178', '1564826662');
INSERT INTO `z_log` VALUES ('589', 'shh001', '121.63.107.108', '1564827246');
INSERT INTO `z_log` VALUES ('590', 'shh001', '121.63.107.108', '1564827586');
INSERT INTO `z_log` VALUES ('591', 'shh001', '218.205.55.14', '1564835111');
INSERT INTO `z_log` VALUES ('592', 'shh001', '112.96.199.44', '1564835842');
INSERT INTO `z_log` VALUES ('593', 'shh001', '14.106.125.186', '1564839999');
INSERT INTO `z_log` VALUES ('594', 'shh001', '42.49.172.42', '1564840262');
INSERT INTO `z_log` VALUES ('595', 'shh001', '121.32.176.217', '1564841795');
INSERT INTO `z_log` VALUES ('596', 'shh001', '175.4.168.122', '1564843376');
INSERT INTO `z_log` VALUES ('597', 'shh001', '14.204.130.19', '1564845859');
INSERT INTO `z_log` VALUES ('598', 'shh001', '113.242.220.223', '1564847157');
INSERT INTO `z_log` VALUES ('599', 'shh001', '113.242.220.223', '1564847235');
INSERT INTO `z_log` VALUES ('600', 'shh001', '113.242.220.223', '1564847802');
INSERT INTO `z_log` VALUES ('601', 'shh001', '113.242.220.223', '1564847982');
INSERT INTO `z_log` VALUES ('602', 'shh001', '113.242.220.223', '1564848014');
INSERT INTO `z_log` VALUES ('603', 'shh001', '113.242.220.223', '1564848038');
INSERT INTO `z_log` VALUES ('604', 'shh001', '220.195.66.115', '1564849916');
INSERT INTO `z_log` VALUES ('605', 'shh001', '223.104.13.159', '1564860550');
INSERT INTO `z_log` VALUES ('606', 'shh001', '124.238.12.86', '1564871376');
INSERT INTO `z_log` VALUES ('607', 'shh001', '113.5.6.141', '1564880525');
INSERT INTO `z_log` VALUES ('608', 'shh001', '14.111.52.198', '1564881136');
INSERT INTO `z_log` VALUES ('609', 'shh001', '14.111.52.198', '1564881608');
INSERT INTO `z_log` VALUES ('610', 'shh001', '14.111.52.198', '1564882647');
INSERT INTO `z_log` VALUES ('611', 'shh001', '115.55.19.16', '1564883994');
INSERT INTO `z_log` VALUES ('612', 'shh001', '113.242.220.223', '1564888237');
INSERT INTO `z_log` VALUES ('613', 'shh001', '117.20.117.162', '1564892910');
INSERT INTO `z_log` VALUES ('614', 'shh001', '183.158.19.42', '1564899590');
INSERT INTO `z_log` VALUES ('615', 'shh001', '120.216.162.39', '1564902607');
INSERT INTO `z_log` VALUES ('616', 'shh001', '120.216.162.39', '1564903113');
INSERT INTO `z_log` VALUES ('617', 'shh001', '119.248.250.69', '1564907010');
INSERT INTO `z_log` VALUES ('618', 'shh001', '171.90.227.224', '1564907742');
INSERT INTO `z_log` VALUES ('619', 'shh001', '49.156.33.4', '1564910653');
INSERT INTO `z_log` VALUES ('620', 'shh001', '49.156.33.4', '1564914799');
INSERT INTO `z_log` VALUES ('621', 'shh001', '182.239.83.67', '1564914801');
INSERT INTO `z_log` VALUES ('622', 'shh001', '49.156.33.4', '1564916418');
INSERT INTO `z_log` VALUES ('623', 'shh001', '183.251.150.27', '1564917272');
INSERT INTO `z_log` VALUES ('624', 'shh001', '42.49.172.42', '1564919438');
INSERT INTO `z_log` VALUES ('625', 'shh001', '42.49.172.42', '1564923886');
INSERT INTO `z_log` VALUES ('626', 'shh001', '211.97.129.22', '1564924843');
INSERT INTO `z_log` VALUES ('627', 'shh001', '106.57.108.249', '1564925137');
INSERT INTO `z_log` VALUES ('628', 'shh001', '106.8.196.210', '1564925497');
INSERT INTO `z_log` VALUES ('629', 'shh001', '117.136.12.134', '1564926821');
INSERT INTO `z_log` VALUES ('630', 'shh001', '36.23.191.43', '1564933105');
INSERT INTO `z_log` VALUES ('631', 'shh001', '60.176.76.216', '1564935869');
INSERT INTO `z_log` VALUES ('632', 'shh001', '60.176.76.216', '1564935889');
INSERT INTO `z_log` VALUES ('633', 'shh001', '113.118.225.33', '1564969276');
INSERT INTO `z_log` VALUES ('634', 'shh001', '36.110.118.87', '1564977359');
INSERT INTO `z_log` VALUES ('635', 'shh001', '117.136.61.127', '1564977699');
INSERT INTO `z_log` VALUES ('636', 'shh001', '121.63.107.108', '1564985403');
INSERT INTO `z_log` VALUES ('637', 'shh001', '36.110.118.87', '1564991083');
INSERT INTO `z_log` VALUES ('638', 'shh001', '115.58.73.17', '1564993396');
INSERT INTO `z_log` VALUES ('639', 'shh001', '182.135.13.79', '1564994909');
INSERT INTO `z_log` VALUES ('640', 'shh001', '106.18.164.8', '1564995329');
INSERT INTO `z_log` VALUES ('641', 'shh001', '36.23.187.1', '1564996653');
INSERT INTO `z_log` VALUES ('642', 'shh001', '36.23.187.1', '1564997046');
INSERT INTO `z_log` VALUES ('643', 'shh001', '121.63.107.108', '1564998211');
INSERT INTO `z_log` VALUES ('644', 'shh001', '183.251.150.27', '1564999398');
INSERT INTO `z_log` VALUES ('645', 'shh001', '139.170.71.100', '1565001063');
INSERT INTO `z_log` VALUES ('646', 'shh001', '139.170.71.100', '1565001070');
INSERT INTO `z_log` VALUES ('647', 'shh001', '211.138.116.185', '1565003908');
INSERT INTO `z_log` VALUES ('648', 'shh001', '117.20.117.172', '1565007028');
INSERT INTO `z_log` VALUES ('649', 'shh001', '106.89.178.32', '1565014005');
INSERT INTO `z_log` VALUES ('650', 'shh001', '183.158.19.42', '1565014409');
INSERT INTO `z_log` VALUES ('651', 'shh001', '121.63.107.108', '1565017302');
INSERT INTO `z_log` VALUES ('652', 'shh001', '223.104.148.92', '1565018516');
INSERT INTO `z_log` VALUES ('653', 'shh001', '223.104.148.92', '1565018771');
INSERT INTO `z_log` VALUES ('654', 'shh001', '223.106.10.107', '1565018873');
INSERT INTO `z_log` VALUES ('655', 'shh001', '183.251.150.27', '1565019073');
INSERT INTO `z_log` VALUES ('656', 'shh001', '183.251.150.27', '1565033504');
INSERT INTO `z_log` VALUES ('657', 'shh001', '119.62.124.125', '1565040529');
INSERT INTO `z_log` VALUES ('658', 'shh001', '183.29.154.84', '1565058658');
INSERT INTO `z_log` VALUES ('659', 'shh001', '36.110.118.87', '1565059497');
INSERT INTO `z_log` VALUES ('660', 'shh001', '121.207.204.73', '1565061599');
INSERT INTO `z_log` VALUES ('661', 'shh001', '139.170.71.100', '1565065306');
INSERT INTO `z_log` VALUES ('662', 'shh001', '139.170.71.100', '1565065587');
INSERT INTO `z_log` VALUES ('663', 'shh001', '113.113.120.177', '1565079302');
INSERT INTO `z_log` VALUES ('664', 'shh001', '113.113.120.177', '1565079599');
INSERT INTO `z_log` VALUES ('665', 'shh001', '222.210.232.223', '1565082292');
INSERT INTO `z_log` VALUES ('666', 'shh001', '110.87.82.37', '1565087898');
INSERT INTO `z_log` VALUES ('667', 'shh001', '220.202.152.104', '1565098398');
INSERT INTO `z_log` VALUES ('668', 'shh001', '113.200.204.14', '1565106470');
INSERT INTO `z_log` VALUES ('669', 'shh001', '113.200.204.14', '1565106941');
INSERT INTO `z_log` VALUES ('670', 'shh001', '113.200.204.14', '1565106950');
INSERT INTO `z_log` VALUES ('671', 'shh001', '59.56.95.113', '1565136520');
INSERT INTO `z_log` VALUES ('672', 'shh001', '59.56.95.113', '1565136560');
INSERT INTO `z_log` VALUES ('673', 'shh001', '59.56.95.113', '1565136593');
INSERT INTO `z_log` VALUES ('674', 'shh001', '112.96.136.76', '1565140893');
INSERT INTO `z_log` VALUES ('675', 'shh001', '61.162.214.108', '1565143865');
INSERT INTO `z_log` VALUES ('676', 'shh001', '171.213.88.80', '1565146789');
INSERT INTO `z_log` VALUES ('677', 'shh001', '112.96.136.76', '1565147011');
INSERT INTO `z_log` VALUES ('678', 'shh001', '112.64.119.137', '1565151160');
INSERT INTO `z_log` VALUES ('679', 'shh001', '223.87.242.42', '1565153033');
INSERT INTO `z_log` VALUES ('680', 'shh001', '223.87.242.42', '1565153074');
INSERT INTO `z_log` VALUES ('681', 'shh001', '36.110.118.87', '1565160852');
INSERT INTO `z_log` VALUES ('682', 'shh001', '223.104.6.31', '1565161187');
INSERT INTO `z_log` VALUES ('683', 'shh001', '223.104.6.31', '1565161578');
INSERT INTO `z_log` VALUES ('684', 'shh001', '223.104.6.31', '1565161587');
INSERT INTO `z_log` VALUES ('685', 'shh001', '223.104.6.31', '1565161749');
INSERT INTO `z_log` VALUES ('686', 'shh001', '112.28.188.183', '1565170244');
INSERT INTO `z_log` VALUES ('687', 'shh001', '112.28.188.183', '1565171062');
INSERT INTO `z_log` VALUES ('688', 'shh001', '117.188.201.252', '1565177200');
INSERT INTO `z_log` VALUES ('689', 'shh001', '183.251.33.200', '1565179396');
INSERT INTO `z_log` VALUES ('690', 'shh001', '183.251.33.200', '1565181311');
INSERT INTO `z_log` VALUES ('691', 'shh001', '183.251.33.200', '1565182049');
INSERT INTO `z_log` VALUES ('692', 'shh001', '183.251.33.200', '1565182306');
INSERT INTO `z_log` VALUES ('693', 'shh001', '61.154.115.121', '1565186485');
INSERT INTO `z_log` VALUES ('694', 'shh001', '117.171.22.56', '1565193000');
INSERT INTO `z_log` VALUES ('695', 'shh001', '117.136.86.67', '1565193591');
INSERT INTO `z_log` VALUES ('696', 'shh001', '220.191.113.137', '1565201076');
INSERT INTO `z_log` VALUES ('697', 'shh001', '183.251.33.200', '1565214105');
INSERT INTO `z_log` VALUES ('698', 'shh001', '117.44.187.43', '1565231339');
INSERT INTO `z_log` VALUES ('699', 'shh001', '117.44.187.43', '1565234364');
INSERT INTO `z_log` VALUES ('700', 'shh001', '113.5.6.226', '1565235258');
INSERT INTO `z_log` VALUES ('701', 'shh001', '118.114.205.79', '1565238393');
INSERT INTO `z_log` VALUES ('702', 'shh001', '218.74.50.55', '1565242229');
INSERT INTO `z_log` VALUES ('703', 'shh001', '115.60.92.201', '1565243708');
INSERT INTO `z_log` VALUES ('704', 'shh001', '36.110.118.87', '1565245590');
INSERT INTO `z_log` VALUES ('705', 'shh001', '183.95.250.186', '1565247785');
INSERT INTO `z_log` VALUES ('706', 'shh001', '183.95.250.186', '1565247794');
INSERT INTO `z_log` VALUES ('707', 'shh001', '183.95.250.186', '1565247818');
INSERT INTO `z_log` VALUES ('708', 'shh001', '183.214.53.115', '1565251496');
INSERT INTO `z_log` VALUES ('709', 'shh001', '183.214.53.115', '1565251526');
INSERT INTO `z_log` VALUES ('710', 'shh001', '183.95.250.186', '1565254395');
INSERT INTO `z_log` VALUES ('711', 'shh001', '183.95.250.186', '1565254469');
INSERT INTO `z_log` VALUES ('712', 'shh001', '221.3.187.244', '1565259005');
INSERT INTO `z_log` VALUES ('713', 'shh001', '221.3.187.244', '1565259069');
INSERT INTO `z_log` VALUES ('714', 'shh001', '36.110.118.87', '1565260277');
INSERT INTO `z_log` VALUES ('715', 'shh001', '223.104.131.153', '1565262969');
INSERT INTO `z_log` VALUES ('716', 'shh001', '14.29.97.62', '1565268820');
INSERT INTO `z_log` VALUES ('717', 'shh001', '222.86.167.128', '1565268891');
INSERT INTO `z_log` VALUES ('718', 'shh001', '14.111.56.155', '1565269139');
INSERT INTO `z_log` VALUES ('719', 'shh001', '223.89.54.159', '1565277324');
INSERT INTO `z_log` VALUES ('720', 'shh001', '223.89.54.159', '1565285123');
INSERT INTO `z_log` VALUES ('721', 'shh001', '117.136.89.155', '1565285631');
INSERT INTO `z_log` VALUES ('722', 'shh001', '117.136.89.155', '1565285703');
INSERT INTO `z_log` VALUES ('723', 'shh001', '117.136.89.155', '1565286209');
INSERT INTO `z_log` VALUES ('724', 'shh001', '223.89.54.159', '1565287197');
INSERT INTO `z_log` VALUES ('725', 'shh001', '117.136.89.155', '1565287248');
INSERT INTO `z_log` VALUES ('726', 'shh001', '42.48.85.54', '1565314885');
INSERT INTO `z_log` VALUES ('727', 'shh001', '42.48.85.54', '1565314920');
INSERT INTO `z_log` VALUES ('728', 'shh001', '182.117.77.86', '1565322361');
INSERT INTO `z_log` VALUES ('729', 'shh001', '182.117.77.86', '1565322435');
INSERT INTO `z_log` VALUES ('730', 'shh001', '115.60.92.102', '1565326310');
INSERT INTO `z_log` VALUES ('731', 'shh001', '112.132.185.79', '1565326990');
INSERT INTO `z_log` VALUES ('732', 'shh001', '120.243.178.88', '1565327418');
INSERT INTO `z_log` VALUES ('733', 'shh001', '112.26.214.25', '1565327630');
INSERT INTO `z_log` VALUES ('734', 'shh001', '112.26.214.25', '1565327797');
INSERT INTO `z_log` VALUES ('735', 'shh001', '61.148.243.182', '1565331694');
INSERT INTO `z_log` VALUES ('736', 'shh001', '111.58.58.61', '1565333506');
INSERT INTO `z_log` VALUES ('737', 'shh001', '223.89.54.159', '1565337840');
INSERT INTO `z_log` VALUES ('738', 'shh001', '223.145.20.51', '1565337947');
INSERT INTO `z_log` VALUES ('739', 'shh001', '14.111.58.210', '1565339820');
INSERT INTO `z_log` VALUES ('740', 'shh001', '117.188.175.195', '1565340271');
INSERT INTO `z_log` VALUES ('741', 'shh001', '117.188.175.195', '1565342164');
INSERT INTO `z_log` VALUES ('742', 'shh001', '115.60.93.197', '1565343096');
INSERT INTO `z_log` VALUES ('743', 'shh001', '112.96.198.44', '1565351679');
INSERT INTO `z_log` VALUES ('744', 'shh001', '27.38.60.78', '1565358680');
INSERT INTO `z_log` VALUES ('745', 'shh001', '115.60.88.113', '1565401520');
INSERT INTO `z_log` VALUES ('746', 'shh001', '14.28.169.185', '1565401919');
INSERT INTO `z_log` VALUES ('747', 'shh001', '223.155.40.29', '1565418678');
INSERT INTO `z_log` VALUES ('748', 'shh001', '171.112.227.177', '1565418785');
INSERT INTO `z_log` VALUES ('749', 'shh001', '59.41.207.24', '1565430184');
INSERT INTO `z_log` VALUES ('750', 'shh001', '121.32.179.209', '1565444512');
INSERT INTO `z_log` VALUES ('751', 'shh001', '121.32.179.209', '1565444596');
INSERT INTO `z_log` VALUES ('752', 'shh001', '14.210.2.219', '1565494787');
INSERT INTO `z_log` VALUES ('753', 'shh001', '14.210.2.219', '1565494821');
INSERT INTO `z_log` VALUES ('754', 'shh001', '183.48.20.33', '1565508879');
INSERT INTO `z_log` VALUES ('755', 'shh001', '115.63.125.1', '1565511230');
INSERT INTO `z_log` VALUES ('756', 'shh001', '106.34.194.137', '1565514394');
INSERT INTO `z_log` VALUES ('757', 'shh001', '203.80.171.253', '1565523945');
INSERT INTO `z_log` VALUES ('758', 'shh001', '203.80.171.253', '1565523987');
INSERT INTO `z_log` VALUES ('759', 'shh001', '203.80.171.253', '1565523997');
INSERT INTO `z_log` VALUES ('760', 'shh001', '61.158.152.198', '1565524893');
INSERT INTO `z_log` VALUES ('761', 'shh001', '110.188.93.220', '1565533926');
INSERT INTO `z_log` VALUES ('762', 'shh001', '114.236.138.131', '1565535831');
INSERT INTO `z_log` VALUES ('763', 'shh001', '223.90.34.226', '1565541206');
INSERT INTO `z_log` VALUES ('764', 'shh001', '115.60.88.224', '1565579427');
INSERT INTO `z_log` VALUES ('765', 'shh001', '111.174.72.48', '1565583887');
INSERT INTO `z_log` VALUES ('766', 'shh001', '117.136.106.201', '1565591490');
INSERT INTO `z_log` VALUES ('767', 'shh001', '117.136.106.201', '1565591526');
INSERT INTO `z_log` VALUES ('768', 'shh001', '115.60.91.27', '1565591635');
INSERT INTO `z_log` VALUES ('769', 'shh001', '116.241.139.16', '1565591918');
INSERT INTO `z_log` VALUES ('770', 'admin', '117.44.182.96', '1565597476');
INSERT INTO `z_log` VALUES ('771', 'shh001', '117.136.75.69', '1565598007');
INSERT INTO `z_log` VALUES ('772', 'shh001', '118.255.225.3', '1565600554');
INSERT INTO `z_log` VALUES ('773', 'shh001', '36.110.118.87', '1565603028');
INSERT INTO `z_log` VALUES ('774', 'shh001', '171.41.5.73', '1565604279');
INSERT INTO `z_log` VALUES ('775', 'shh001', '36.110.118.87', '1565676832');
INSERT INTO `z_log` VALUES ('776', 'shh001', '175.4.210.230', '1565680477');
INSERT INTO `z_log` VALUES ('777', 'shh001', '14.30.27.27', '1565682432');
INSERT INTO `z_log` VALUES ('778', 'shh001', '115.60.95.47', '1565683228');
INSERT INTO `z_log` VALUES ('779', 'shh001', '36.110.118.87', '1565685534');
INSERT INTO `z_log` VALUES ('780', 'shh001', '14.30.36.247', '1565685573');
INSERT INTO `z_log` VALUES ('781', 'shh001', '36.110.118.87', '1565687347');
INSERT INTO `z_log` VALUES ('782', 'shh001', '36.110.118.87', '1565689654');
INSERT INTO `z_log` VALUES ('783', 'shh001', '183.48.23.231', '1565692181');
INSERT INTO `z_log` VALUES ('784', 'shh001', '134.159.205.34', '1565747032');
INSERT INTO `z_log` VALUES ('785', 'shh001', '118.115.198.217', '1565750031');
INSERT INTO `z_log` VALUES ('786', 'shh001', '117.44.183.193', '1565765997');
INSERT INTO `z_log` VALUES ('787', 'shh001', '110.53.174.164', '1565772188');
INSERT INTO `z_log` VALUES ('788', 'shh001', '223.104.108.118', '1565782885');
INSERT INTO `z_log` VALUES ('789', 'shh001', '211.138.116.103', '1565787244');
INSERT INTO `z_log` VALUES ('790', 'shh001', '36.23.214.138', '1565792098');
INSERT INTO `z_log` VALUES ('791', 'shh001', '211.138.116.103', '1565792328');
INSERT INTO `z_log` VALUES ('792', 'shh001', '223.96.61.76', '1565838725');
INSERT INTO `z_log` VALUES ('793', 'shh001', '14.28.54.125', '1565846213');
INSERT INTO `z_log` VALUES ('794', 'shh001', '36.110.118.87', '1565857294');
INSERT INTO `z_log` VALUES ('795', 'shh001', '223.104.45.67', '1565859985');
INSERT INTO `z_log` VALUES ('796', 'shh001', '223.104.45.67', '1565860086');
INSERT INTO `z_log` VALUES ('797', 'shh001', '14.210.2.160', '1565863113');
INSERT INTO `z_log` VALUES ('798', 'shh001', '14.210.2.160', '1565864879');
INSERT INTO `z_log` VALUES ('799', 'shh001', '128.90.189.5', '1565876676');
INSERT INTO `z_log` VALUES ('800', 'shh001', '117.136.40.252', '1565914950');
INSERT INTO `z_log` VALUES ('801', 'shh001', '117.136.88.132', '1565920150');
INSERT INTO `z_log` VALUES ('802', 'shh001', '122.191.131.97', '1565923681');
INSERT INTO `z_log` VALUES ('803', 'shh001', '122.191.131.97', '1565927073');
INSERT INTO `z_log` VALUES ('804', 'shh001', '110.87.78.55', '1565928250');
INSERT INTO `z_log` VALUES ('805', 'shh001', '121.31.247.85', '1565935267');
INSERT INTO `z_log` VALUES ('806', 'shh001', '115.60.88.187', '1565945139');
INSERT INTO `z_log` VALUES ('807', 'shh001', '115.60.88.187', '1565945269');
INSERT INTO `z_log` VALUES ('808', 'shh001', '115.60.88.187', '1565947316');
INSERT INTO `z_log` VALUES ('809', 'shh001', '115.53.183.234', '1565950760');
INSERT INTO `z_log` VALUES ('810', 'shh001', '43.250.201.21', '1565959808');
INSERT INTO `z_log` VALUES ('811', 'shh001', '223.104.108.106', '1565961456');
INSERT INTO `z_log` VALUES ('812', 'shh001', '122.53.214.107', '1565982774');
INSERT INTO `z_log` VALUES ('813', 'shh001', '110.54.221.63', '1565993900');
INSERT INTO `z_log` VALUES ('814', 'shh001', '183.12.223.243', '1566008785');
INSERT INTO `z_log` VALUES ('815', 'shh001', '42.230.24.90', '1566022835');
INSERT INTO `z_log` VALUES ('816', 'shh001', '218.5.38.44', '1566026489');
INSERT INTO `z_log` VALUES ('817', 'shh001', '119.123.42.107', '1566027458');
INSERT INTO `z_log` VALUES ('818', 'shh001', '219.134.114.239', '1566031356');
INSERT INTO `z_log` VALUES ('819', 'shh001', '183.12.222.192', '1566111068');
INSERT INTO `z_log` VALUES ('820', 'shh001', '27.38.60.148', '1566127647');
INSERT INTO `z_log` VALUES ('821', 'shh001', '112.32.71.102', '1566159209');
INSERT INTO `z_log` VALUES ('822', 'shh001', '171.9.137.18', '1566181422');
INSERT INTO `z_log` VALUES ('823', 'shh001', '61.163.237.194', '1566186472');
INSERT INTO `z_log` VALUES ('824', 'shh001', '222.212.6.25', '1566188923');
INSERT INTO `z_log` VALUES ('825', 'shh001', '222.212.6.25', '1566190126');
INSERT INTO `z_log` VALUES ('826', 'shh001', '222.212.6.25', '1566191422');
INSERT INTO `z_log` VALUES ('827', 'ceshi', '222.212.6.25', '1566191472');
INSERT INTO `z_log` VALUES ('828', 'shh001', '222.209.39.38', '1566192721');
INSERT INTO `z_log` VALUES ('829', 'shh001', '183.198.28.210', '1566202480');
INSERT INTO `z_log` VALUES ('830', 'shh001', '183.198.28.210', '1566202611');
INSERT INTO `z_log` VALUES ('831', 'shh001', '183.198.28.210', '1566202621');
INSERT INTO `z_log` VALUES ('832', 'shh001', '183.198.28.210', '1566202647');
INSERT INTO `z_log` VALUES ('833', 'shh001', '183.198.28.210', '1566202660');
INSERT INTO `z_log` VALUES ('834', 'shh001', '123.214.26.73', '1566226054');
INSERT INTO `z_log` VALUES ('835', 'shh001', '111.192.25.144', '1566257924');
INSERT INTO `z_log` VALUES ('836', 'shh001', '121.234.224.128', '1566263260');
INSERT INTO `z_log` VALUES ('837', 'shh001', '139.205.154.247', '1566271338');
INSERT INTO `z_log` VALUES ('838', 'shh001', '182.239.83.229', '1566276260');
INSERT INTO `z_log` VALUES ('839', 'shh001', '139.205.154.247', '1566278130');
INSERT INTO `z_log` VALUES ('840', 'shh001', '14.122.148.45', '1566281896');
INSERT INTO `z_log` VALUES ('841', 'shh001', '171.106.146.39', '1566286242');
INSERT INTO `z_log` VALUES ('842', 'shh001', '133.130.90.241', '1566293254');
INSERT INTO `z_log` VALUES ('843', 'shh001', '117.136.107.183', '1566299059');
INSERT INTO `z_log` VALUES ('844', 'shh001', '117.136.107.183', '1566299179');
INSERT INTO `z_log` VALUES ('845', 'shh001', '180.162.5.49', '1566320847');
INSERT INTO `z_log` VALUES ('846', 'shh001', '180.162.5.49', '1566321099');
INSERT INTO `z_log` VALUES ('847', 'shh001', '183.202.148.116', '1566338230');
INSERT INTO `z_log` VALUES ('848', 'shh001', '1.197.190.15', '1566353174');
INSERT INTO `z_log` VALUES ('849', 'shh001', '120.231.102.199', '1566356490');
INSERT INTO `z_log` VALUES ('850', 'shh001', '120.231.102.199', '1566356490');
INSERT INTO `z_log` VALUES ('851', 'shh001', '120.231.102.199', '1566356509');
INSERT INTO `z_log` VALUES ('852', 'shh001', '1.207.13.94', '1566361335');
INSERT INTO `z_log` VALUES ('853', 'shh001', '61.140.235.247', '1566375898');
INSERT INTO `z_log` VALUES ('854', 'shh001', '117.136.81.181', '1566376781');
INSERT INTO `z_log` VALUES ('855', 'shh001', '220.203.63.168', '1566377527');
INSERT INTO `z_log` VALUES ('856', 'shh001', '220.203.63.77', '1566378022');
INSERT INTO `z_log` VALUES ('857', 'shh001', '103.195.187.85', '1566378954');
INSERT INTO `z_log` VALUES ('858', 'shh001', '223.104.4.59', '1566396737');
INSERT INTO `z_log` VALUES ('859', 'shh001', '171.210.199.223', '1566436690');
INSERT INTO `z_log` VALUES ('860', 'shh001', '223.104.21.221', '1566453157');
INSERT INTO `z_log` VALUES ('861', 'shh001', '115.60.91.174', '1566456679');
INSERT INTO `z_log` VALUES ('862', 'shh001', '115.60.91.174', '1566456711');
INSERT INTO `z_log` VALUES ('863', 'shh001', '14.211.86.50', '1566458513');
INSERT INTO `z_log` VALUES ('864', 'shh001', '14.211.86.50', '1566459237');
INSERT INTO `z_log` VALUES ('865', 'shh001', '115.213.85.5', '1566464532');
INSERT INTO `z_log` VALUES ('866', 'shh001', '117.181.118.177', '1566476533');
INSERT INTO `z_log` VALUES ('867', 'shh001', '119.103.222.152', '1566478049');
INSERT INTO `z_log` VALUES ('868', 'shh001', '115.204.171.111', '1566478079');
INSERT INTO `z_log` VALUES ('869', 'shh001', '27.189.163.72', '1566489930');
INSERT INTO `z_log` VALUES ('870', 'shh001', '27.189.163.72', '1566490724');
INSERT INTO `z_log` VALUES ('871', 'shh001', '27.189.163.72', '1566490772');
INSERT INTO `z_log` VALUES ('872', 'shh001', '27.189.167.207', '1566523394');
INSERT INTO `z_log` VALUES ('873', 'shh001', '27.189.167.207', '1566523809');
INSERT INTO `z_log` VALUES ('874', 'shh001', '67.230.163.66', '1566524150');
INSERT INTO `z_log` VALUES ('875', 'shh001', '27.189.167.207', '1566527667');
INSERT INTO `z_log` VALUES ('876', 'shh001', '27.189.167.207', '1566530281');
INSERT INTO `z_log` VALUES ('877', 'shh001', '27.189.167.207', '1566533220');
INSERT INTO `z_log` VALUES ('878', 'shh001', '27.189.167.207', '1566536694');
INSERT INTO `z_log` VALUES ('879', 'shh001', '27.189.167.207', '1566536736');
INSERT INTO `z_log` VALUES ('880', 'shh001', '27.189.167.207', '1566536835');
INSERT INTO `z_log` VALUES ('881', 'shh001', '211.97.75.185', '1566541005');
INSERT INTO `z_log` VALUES ('882', 'shh001', '27.189.167.207', '1566544492');
INSERT INTO `z_log` VALUES ('883', 'shh001', '27.189.163.72', '1566562521');
INSERT INTO `z_log` VALUES ('884', 'shh001', '115.204.171.111', '1566563876');
INSERT INTO `z_log` VALUES ('885', 'shh001', '27.189.163.72', '1566571327');
INSERT INTO `z_log` VALUES ('886', 'shh001', '27.189.163.72', '1566571451');
INSERT INTO `z_log` VALUES ('887', 'shh001', '113.75.105.122', '1566573464');
INSERT INTO `z_log` VALUES ('888', 'shh001', '183.197.150.248', '1566613108');
INSERT INTO `z_log` VALUES ('889', 'shh001', '117.183.8.43', '1566614786');
INSERT INTO `z_log` VALUES ('890', 'shh001', '27.189.167.207', '1566618551');
INSERT INTO `z_log` VALUES ('891', 'shh001', '117.183.8.43', '1566619260');
INSERT INTO `z_log` VALUES ('892', 'shh001', '27.189.167.207', '1566620063');
INSERT INTO `z_log` VALUES ('893', 'shh001', '183.130.80.240', '1566626838');
INSERT INTO `z_log` VALUES ('894', '刘明一', '117.183.8.43', '1566629631');
INSERT INTO `z_log` VALUES ('895', 'shh001', '183.197.150.248', '1566632366');
INSERT INTO `z_log` VALUES ('896', 'shh001', '183.197.150.248', '1566632371');
INSERT INTO `z_log` VALUES ('897', 'shh001', '223.104.96.180', '1566638299');
INSERT INTO `z_log` VALUES ('898', 'shh001', '223.104.96.180', '1566638858');
INSERT INTO `z_log` VALUES ('899', 'shh001', '223.104.96.180', '1566638874');
INSERT INTO `z_log` VALUES ('900', 'aa123456', '121.31.246.4', '1566639133');
INSERT INTO `z_log` VALUES ('901', 'shh001', '221.1.168.240', '1566640253');
INSERT INTO `z_log` VALUES ('902', 'shh001', '221.1.168.240', '1566640263');
INSERT INTO `z_log` VALUES ('903', 'shh001', '221.1.168.240', '1566640306');
INSERT INTO `z_log` VALUES ('904', 'shh001', '61.140.235.247', '1566642096');
INSERT INTO `z_log` VALUES ('905', 'shh001', '125.122.13.216', '1566650507');
INSERT INTO `z_log` VALUES ('906', 'shh001', '115.211.89.200', '1566655708');
INSERT INTO `z_log` VALUES ('907', 'shh001', '223.155.101.78', '1566699551');
INSERT INTO `z_log` VALUES ('908', 'shh001', '42.229.75.216', '1566700480');
INSERT INTO `z_log` VALUES ('909', 'shh001', '42.229.75.216', '1566701116');
INSERT INTO `z_log` VALUES ('910', 'shh001', '42.229.75.216', '1566701261');
INSERT INTO `z_log` VALUES ('911', 'shh001', '42.229.75.216', '1566701935');
INSERT INTO `z_log` VALUES ('912', 'shh001', '42.49.1.111', '1566702185');
INSERT INTO `z_log` VALUES ('913', 'shh001', '42.229.75.216', '1566702292');
INSERT INTO `z_log` VALUES ('914', 'shh001', '42.229.75.216', '1566702424');
INSERT INTO `z_log` VALUES ('915', 'shh001', '119.103.222.152', '1566716161');
INSERT INTO `z_log` VALUES ('916', 'shh001', '61.144.116.134', '1566717623');
INSERT INTO `z_log` VALUES ('917', 'shh001', '61.144.116.134', '1566717647');
INSERT INTO `z_log` VALUES ('918', 'shh001', '61.144.116.134', '1566718092');
INSERT INTO `z_log` VALUES ('919', 'shh001', '61.144.116.134', '1566718124');
INSERT INTO `z_log` VALUES ('920', 'shh001', '122.190.201.162', '1566720924');
INSERT INTO `z_log` VALUES ('921', 'shh001', '219.134.182.128', '1566729107');
INSERT INTO `z_log` VALUES ('922', 'shh001', '219.134.182.128', '1566729145');
INSERT INTO `z_log` VALUES ('923', 'shh001', '14.106.125.143', '1566733617');
INSERT INTO `z_log` VALUES ('924', 'shh001', '116.106.17.6', '1566739329');
INSERT INTO `z_log` VALUES ('925', 'shh001', '182.127.141.57', '1566776483');
INSERT INTO `z_log` VALUES ('926', 'shh001', '140.243.129.188', '1566788747');
INSERT INTO `z_log` VALUES ('927', 'shh001', '117.136.88.139', '1566791997');
INSERT INTO `z_log` VALUES ('928', 'shh001', '61.144.116.134', '1566800584');
INSERT INTO `z_log` VALUES ('929', 'xxceshi', '42.226.116.200', '1566805042');
INSERT INTO `z_log` VALUES ('930', 'shh001', '42.226.116.200', '1566805676');
INSERT INTO `z_log` VALUES ('931', 'shh001', '110.82.110.169', '1566808888');
INSERT INTO `z_log` VALUES ('932', 'shh001', '118.117.102.244', '1566813416');
INSERT INTO `z_log` VALUES ('933', 'shh001', '112.97.51.36', '1566822066');
INSERT INTO `z_log` VALUES ('934', 'shh001', '117.136.79.254', '1566824527');
INSERT INTO `z_log` VALUES ('935', 'shh001', '60.182.139.141', '1566891294');
INSERT INTO `z_log` VALUES ('936', 'shh001', '183.167.181.45', '1566900475');
INSERT INTO `z_log` VALUES ('937', 'shh001', '183.167.181.45', '1566900486');
INSERT INTO `z_log` VALUES ('938', 'shh001', '27.109.253.112', '1566903001');
INSERT INTO `z_log` VALUES ('939', 'shh001', '39.130.108.49', '1566915150');
INSERT INTO `z_log` VALUES ('940', 'shh001', '39.130.108.49', '1566915371');
INSERT INTO `z_log` VALUES ('941', 'shh001', '39.130.108.49', '1566915808');
INSERT INTO `z_log` VALUES ('942', 'shh001', '39.188.234.215', '1566956992');
INSERT INTO `z_log` VALUES ('943', 'shh001', '117.136.73.114', '1566978639');
INSERT INTO `z_log` VALUES ('944', 'shh001', '1.197.190.190', '1566978715');
INSERT INTO `z_log` VALUES ('945', 'shh001', '117.183.8.43', '1566984293');
INSERT INTO `z_log` VALUES ('946', 'shh001', '117.136.22.247', '1566984739');
INSERT INTO `z_log` VALUES ('947', 'shh001', '117.183.8.43', '1566994016');
INSERT INTO `z_log` VALUES ('948', '龙龙', '117.183.8.43', '1566994332');
INSERT INTO `z_log` VALUES ('949', 'shh001', '202.131.86.221', '1567045510');
INSERT INTO `z_log` VALUES ('950', 'shh001', '111.74.54.236', '1567046028');
INSERT INTO `z_log` VALUES ('951', 'shh001', '111.74.54.236', '1567049751');
INSERT INTO `z_log` VALUES ('952', 'shh001', '111.74.54.236', '1567055734');
INSERT INTO `z_log` VALUES ('953', 'shh001', '222.172.165.121', '1567060470');
INSERT INTO `z_log` VALUES ('954', 'shh001', '14.111.52.35', '1567065155');
INSERT INTO `z_log` VALUES ('955', 'shh001', '117.181.118.113', '1567081035');
INSERT INTO `z_log` VALUES ('956', 'shh001', '111.74.54.236', '1567090628');
INSERT INTO `z_log` VALUES ('957', 'shh001', '111.74.54.236', '1567091338');
INSERT INTO `z_log` VALUES ('958', 'shh001', '112.224.2.207', '1567128781');
INSERT INTO `z_log` VALUES ('959', 'shh001', '183.214.203.207', '1567133275');
INSERT INTO `z_log` VALUES ('960', 'shh001', '121.31.246.58', '1567133349');
INSERT INTO `z_log` VALUES ('961', 'shh001', '123.12.252.140', '1567148214');
INSERT INTO `z_log` VALUES ('962', 'shh001', '36.102.20.54', '1567175829');
INSERT INTO `z_log` VALUES ('963', 'shh001', '111.74.54.236', '1567181265');
INSERT INTO `z_log` VALUES ('964', 'shh001', '27.38.60.66', '1567213579');
INSERT INTO `z_log` VALUES ('965', 'shh001', '223.88.203.187', '1567228927');
INSERT INTO `z_log` VALUES ('966', 'shh001', '183.3.226.234', '1567258528');
INSERT INTO `z_log` VALUES ('967', 'shh001', '61.158.152.85', '1567311547');
INSERT INTO `z_log` VALUES ('968', 'shh001', '182.202.10.11', '1567316228');
INSERT INTO `z_log` VALUES ('969', 'shh001', '111.75.39.207', '1567321535');
INSERT INTO `z_log` VALUES ('970', 'shh001', '182.116.247.100', '1567342772');
INSERT INTO `z_log` VALUES ('971', 'shh001', '182.116.194.125', '1567348541');
INSERT INTO `z_log` VALUES ('972', 'shh001', '115.49.223.64', '1567364374');
INSERT INTO `z_log` VALUES ('973', 'shh001', '115.49.223.64', '1567364501');
INSERT INTO `z_log` VALUES ('974', 'shh001', '223.91.238.224', '1567384275');
INSERT INTO `z_log` VALUES ('975', 'shh001', '39.176.71.224', '1567392524');
INSERT INTO `z_log` VALUES ('976', 'shh001', '39.176.71.224', '1567392661');
INSERT INTO `z_log` VALUES ('977', 'shh001', '114.102.191.127', '1567412518');
INSERT INTO `z_log` VALUES ('978', 'shh001', '106.19.98.86', '1567415710');
INSERT INTO `z_log` VALUES ('979', 'shh001', '117.136.24.213', '1567415824');
INSERT INTO `z_log` VALUES ('980', 'shh001', '112.96.164.172', '1567416527');
INSERT INTO `z_log` VALUES ('981', 'shh001', '120.227.98.174', '1567418364');
INSERT INTO `z_log` VALUES ('982', 'shh001', '182.116.194.183', '1567424559');
INSERT INTO `z_log` VALUES ('983', 'shh001', '39.187.227.181', '1567427316');
INSERT INTO `z_log` VALUES ('984', 'shh001', '39.187.227.181', '1567427360');
INSERT INTO `z_log` VALUES ('985', 'shh001', '14.211.85.94', '1567434039');
INSERT INTO `z_log` VALUES ('986', 'shh001', '42.226.115.248', '1567468629');
INSERT INTO `z_log` VALUES ('987', 'shh001', '123.5.232.1', '1567484143');
INSERT INTO `z_log` VALUES ('988', 'shh001', '61.158.152.254', '1567487320');
INSERT INTO `z_log` VALUES ('989', 'shh001', '117.136.23.207', '1567487337');
INSERT INTO `z_log` VALUES ('990', 'shh001', '117.136.89.247', '1567488403');
INSERT INTO `z_log` VALUES ('991', 'shh001', '123.5.232.1', '1567488980');
INSERT INTO `z_log` VALUES ('992', 'shh001', '61.158.152.254', '1567494890');
INSERT INTO `z_log` VALUES ('993', 'shh001', '110.53.205.115', '1567501561');
INSERT INTO `z_log` VALUES ('994', 'shh001', '120.216.128.162', '1567502430');
INSERT INTO `z_log` VALUES ('995', 'shh001', '123.168.86.97', '1567502452');
INSERT INTO `z_log` VALUES ('996', 'shh001', '106.18.167.10', '1567506573');
INSERT INTO `z_log` VALUES ('997', 'shh001', '106.18.167.10', '1567506585');
INSERT INTO `z_log` VALUES ('998', 'shh001', '106.18.167.10', '1567506603');
INSERT INTO `z_log` VALUES ('999', 'shh001', '106.18.167.10', '1567506669');
INSERT INTO `z_log` VALUES ('1000', 'shh001', '59.42.3.237', '1567508001');
INSERT INTO `z_log` VALUES ('1001', 'shh001', '223.152.218.71', '1567509797');
INSERT INTO `z_log` VALUES ('1002', 'shh001', '223.152.218.71', '1567510457');
INSERT INTO `z_log` VALUES ('1003', 'shh001', '223.152.218.71', '1567513834');
INSERT INTO `z_log` VALUES ('1004', 'shh001', '223.152.218.71', '1567514772');
INSERT INTO `z_log` VALUES ('1005', 'shh001', '36.157.207.208', '1567517490');
INSERT INTO `z_log` VALUES ('1006', 'shh001', '43.250.200.87', '1567524071');
INSERT INTO `z_log` VALUES ('1007', 'shh001', '112.215.235.16', '1567527344');
INSERT INTO `z_log` VALUES ('1008', 'shh001', '222.247.55.246', '1567563706');
INSERT INTO `z_log` VALUES ('1009', 'shh001', '223.152.218.71', '1567564661');
INSERT INTO `z_log` VALUES ('1010', 'shh001', '223.152.175.139', '1567564712');
INSERT INTO `z_log` VALUES ('1011', 'shh001', '222.247.55.246', '1567565262');
INSERT INTO `z_log` VALUES ('1012', 'shh001', '222.247.55.246', '1567568053');
INSERT INTO `z_log` VALUES ('1013', 'shh001', '223.104.130.41', '1567568765');
INSERT INTO `z_log` VALUES ('1014', 'shh001', '223.152.175.139', '1567569127');
INSERT INTO `z_log` VALUES ('1015', 'shh001', '106.16.155.175', '1567576455');
INSERT INTO `z_log` VALUES ('1016', 'shh001', '106.16.155.175', '1567578723');
INSERT INTO `z_log` VALUES ('1017', 'shh001', '115.60.92.36', '1567585784');
INSERT INTO `z_log` VALUES ('1018', 'shh001', '115.60.89.155', '1567586065');
INSERT INTO `z_log` VALUES ('1019', 'shh001', '115.60.89.155', '1567586144');
INSERT INTO `z_log` VALUES ('1020', 'shh001', '117.70.149.221', '1567588096');
INSERT INTO `z_log` VALUES ('1021', 'shh001', '117.70.149.221', '1567589369');
INSERT INTO `z_log` VALUES ('1022', 'shh001', '223.152.109.9', '1567590627');
INSERT INTO `z_log` VALUES ('1023', 'shh001', '182.122.179.59', '1567592420');
INSERT INTO `z_log` VALUES ('1024', 'shh001', '43.250.200.21', '1567600911');
INSERT INTO `z_log` VALUES ('1025', 'shh001', '106.19.26.24', '1567602545');
INSERT INTO `z_log` VALUES ('1026', 'shh001', '106.19.26.24', '1567603266');
INSERT INTO `z_log` VALUES ('1027', 'shh001', '113.88.110.143', '1567645332');
INSERT INTO `z_log` VALUES ('1028', 'shh001', '218.17.99.62', '1567647661');
INSERT INTO `z_log` VALUES ('1029', 'shh001', '103.106.245.25', '1567652356');
INSERT INTO `z_log` VALUES ('1030', 'shh001', '223.104.20.157', '1567652448');
INSERT INTO `z_log` VALUES ('1031', 'shh001', '223.104.105.97', '1567655123');
INSERT INTO `z_log` VALUES ('1032', 'shh001', '112.96.109.117', '1567664863');
INSERT INTO `z_log` VALUES ('1033', 'shh001', '103.227.172.91', '1567669384');
INSERT INTO `z_log` VALUES ('1034', 'shh001', '113.219.46.18', '1567674674');
INSERT INTO `z_log` VALUES ('1035', 'shh001', '223.152.27.140', '1567680077');
INSERT INTO `z_log` VALUES ('1036', 'shh001', '118.212.148.18', '1567683429');
INSERT INTO `z_log` VALUES ('1037', 'shh001', '119.136.124.180', '1567737366');
INSERT INTO `z_log` VALUES ('1038', 'shh001', '111.23.147.195', '1567746565');
INSERT INTO `z_log` VALUES ('1039', 'shh001', '1.195.34.249', '1567747550');
INSERT INTO `z_log` VALUES ('1040', 'shh001', '202.131.82.180', '1567752312');
INSERT INTO `z_log` VALUES ('1041', 'shh001', '223.104.106.167', '1567753822');
INSERT INTO `z_log` VALUES ('1042', 'shh001', '112.207.3.180', '1567756132');
INSERT INTO `z_log` VALUES ('1043', 'shh002', '112.207.3.180', '1567759579');
INSERT INTO `z_log` VALUES ('1044', 'shh001', '112.96.194.206', '1567766416');
INSERT INTO `z_log` VALUES ('1045', 'shh001', '139.214.251.219', '1567775460');
INSERT INTO `z_log` VALUES ('1046', 'shh001', '139.214.251.219', '1567775474');
INSERT INTO `z_log` VALUES ('1047', 'shh001', '139.214.251.219', '1567775489');
INSERT INTO `z_log` VALUES ('1048', 'shh001', '115.60.89.132', '1567823602');
INSERT INTO `z_log` VALUES ('1049', 'shh001', '112.44.78.228', '1567824121');
INSERT INTO `z_log` VALUES ('1050', 'shh001', '120.229.70.64', '1567844630');
INSERT INTO `z_log` VALUES ('1051', 'shh001', '120.229.70.64', '1567844651');
INSERT INTO `z_log` VALUES ('1052', 'shh001', '120.229.70.64', '1567844671');
INSERT INTO `z_log` VALUES ('1053', 'shh001', '123.12.185.88', '1567844710');
INSERT INTO `z_log` VALUES ('1054', 'shh001', '120.229.70.64', '1567845877');
INSERT INTO `z_log` VALUES ('1055', 'shh001', '123.12.185.88', '1567846301');
INSERT INTO `z_log` VALUES ('1056', 'shh001', '123.12.185.88', '1567846363');
INSERT INTO `z_log` VALUES ('1057', 'shh001', '183.225.28.207', '1567860276');
INSERT INTO `z_log` VALUES ('1058', 'shh001', '117.139.248.47', '1567861727');
INSERT INTO `z_log` VALUES ('1059', 'shh001', '117.139.248.47', '1567862037');
INSERT INTO `z_log` VALUES ('1060', 'shh001', '117.176.217.175', '1567862519');
INSERT INTO `z_log` VALUES ('1061', 'shh001', '36.106.21.23', '1567865409');
INSERT INTO `z_log` VALUES ('1062', 'shh001', '42.226.255.77', '1567869169');
INSERT INTO `z_log` VALUES ('1063', 'shh001', '1.83.233.115', '1567909258');
INSERT INTO `z_log` VALUES ('1064', 'shh001', '1.83.233.115', '1567910649');
INSERT INTO `z_log` VALUES ('1065', 'shh001', '42.226.255.77', '1567925592');
INSERT INTO `z_log` VALUES ('1066', 'shh001', '122.97.175.99', '1567930898');
INSERT INTO `z_log` VALUES ('1067', 'shh001', '122.97.175.99', '1567930923');
INSERT INTO `z_log` VALUES ('1068', 'shh001', '122.97.175.99', '1567931384');
INSERT INTO `z_log` VALUES ('1069', 'shh001', '122.97.175.99', '1567934209');
INSERT INTO `z_log` VALUES ('1070', 'shh001', '122.97.175.99', '1567934385');
INSERT INTO `z_log` VALUES ('1071', 'shh001', '122.97.175.99', '1567934547');
INSERT INTO `z_log` VALUES ('1072', 'shh001', '122.97.175.99', '1567934560');
INSERT INTO `z_log` VALUES ('1073', 'shh001', '139.205.151.24', '1567942672');
INSERT INTO `z_log` VALUES ('1074', 'shh001', '139.205.151.24', '1567942744');
INSERT INTO `z_log` VALUES ('1075', 'shh001', '119.123.34.148', '1567947830');
INSERT INTO `z_log` VALUES ('1076', 'shh001', '117.139.248.47', '1567953420');
INSERT INTO `z_log` VALUES ('1077', 'shh001', '122.97.179.221', '1568012079');
INSERT INTO `z_log` VALUES ('1078', 'shh001', '14.28.160.116', '1568012688');
INSERT INTO `z_log` VALUES ('1079', 'shh001', '106.86.46.138', '1568012935');
INSERT INTO `z_log` VALUES ('1080', 'shh001', '106.86.46.138', '1568012943');
INSERT INTO `z_log` VALUES ('1081', 'shh001', '14.28.160.116', '1568016477');
INSERT INTO `z_log` VALUES ('1082', 'shh001', '175.30.144.4', '1568017029');
INSERT INTO `z_log` VALUES ('1083', 'shh001', '34.85.4.182', '1568017545');
INSERT INTO `z_log` VALUES ('1084', 'shh001', '36.62.33.144', '1568020078');
INSERT INTO `z_log` VALUES ('1085', 'shh001', '42.234.46.156', '1568022261');
INSERT INTO `z_log` VALUES ('1086', 'shh001', '115.60.91.123', '1568022413');
INSERT INTO `z_log` VALUES ('1087', 'shh001', '42.234.46.156', '1568025393');
INSERT INTO `z_log` VALUES ('1088', 'shh001', '183.225.28.184', '1568042543');
INSERT INTO `z_log` VALUES ('1089', 'shh001', '120.3.186.23', '1568043296');
INSERT INTO `z_log` VALUES ('1090', 'shh001', '118.113.212.198', '1568090467');
INSERT INTO `z_log` VALUES ('1091', 'shh001', '117.136.63.89', '1568102754');
INSERT INTO `z_log` VALUES ('1092', 'shh001', '113.68.44.156', '1568205275');
INSERT INTO `z_log` VALUES ('1093', 'shh001', '183.225.28.184', '1568209306');
INSERT INTO `z_log` VALUES ('1094', 'shh001', '61.158.147.144', '1568267754');
INSERT INTO `z_log` VALUES ('1095', 'shh001', '113.65.14.50', '1568277700');
INSERT INTO `z_log` VALUES ('1096', 'shh001', '183.160.120.120', '1568279009');
INSERT INTO `z_log` VALUES ('1097', 'shh001', '123.132.45.133', '1568283681');
INSERT INTO `z_log` VALUES ('1098', 'shh001', '123.132.45.133', '1568283911');
INSERT INTO `z_log` VALUES ('1099', 'shh001', '123.132.45.133', '1568284066');
INSERT INTO `z_log` VALUES ('1100', 'shh001', '203.90.248.158', '1568290023');
INSERT INTO `z_log` VALUES ('1101', 'shh001', '203.90.248.158', '1568292401');
INSERT INTO `z_log` VALUES ('1102', 'shh001', '203.90.248.158', '1568292752');
INSERT INTO `z_log` VALUES ('1103', 'shh001', '203.90.248.158', '1568293271');
INSERT INTO `z_log` VALUES ('1104', 'shh001', '183.225.28.184', '1568296058');
INSERT INTO `z_log` VALUES ('1105', 'shh001', '183.160.120.120', '1568305758');
INSERT INTO `z_log` VALUES ('1106', 'shh001', '61.158.168.214', '1568382694');
INSERT INTO `z_log` VALUES ('1107', 'shh001', '106.18.127.20', '1568388126');
INSERT INTO `z_log` VALUES ('1108', 'shh001', '106.18.127.20', '1568390701');
INSERT INTO `z_log` VALUES ('1109', 'shh001', '117.136.52.60', '1568424555');
INSERT INTO `z_log` VALUES ('1110', 'shh001', '61.158.152.144', '1568431806');
INSERT INTO `z_log` VALUES ('1111', 'shh001', '61.158.152.144', '1568432129');
INSERT INTO `z_log` VALUES ('1112', 'shh001', '203.90.248.158', '1568443955');
INSERT INTO `z_log` VALUES ('1113', 'shh001', '203.90.248.158', '1568443999');
INSERT INTO `z_log` VALUES ('1114', 'shh001', '106.61.78.70', '1568446357');
INSERT INTO `z_log` VALUES ('1115', 'shh001', '58.17.121.222', '1568449740');
INSERT INTO `z_log` VALUES ('1116', 'shh001', '106.61.29.120', '1568475479');
INSERT INTO `z_log` VALUES ('1117', 'shh001', '106.119.8.101', '1568475489');
INSERT INTO `z_log` VALUES ('1118', 'shh001', '47.75.124.109', '1568493581');
INSERT INTO `z_log` VALUES ('1119', 'shh001', '120.84.11.142', '1568515730');
INSERT INTO `z_log` VALUES ('1120', 'shh001', '120.84.11.142', '1568515775');
INSERT INTO `z_log` VALUES ('1121', 'shh001', '175.4.243.220', '1568515969');
INSERT INTO `z_log` VALUES ('1122', 'shh001', '222.134.222.122', '1568515995');
INSERT INTO `z_log` VALUES ('1123', 'shh001', '117.188.71.230', '1568518759');
INSERT INTO `z_log` VALUES ('1124', 'shh001', '115.53.152.113', '1568532274');
INSERT INTO `z_log` VALUES ('1125', 'shh001', '106.61.26.110', '1568533244');
INSERT INTO `z_log` VALUES ('1126', 'shh001', '61.158.148.12', '1568540376');
INSERT INTO `z_log` VALUES ('1127', 'shh001', '122.97.175.28', '1568549457');
INSERT INTO `z_log` VALUES ('1128', 'shh001', '116.52.98.228', '1568609736');
INSERT INTO `z_log` VALUES ('1129', 'shh001', '61.244.68.32', '1568623899');
INSERT INTO `z_log` VALUES ('1130', 'shh001', '202.187.3.83', '1568629894');
INSERT INTO `z_log` VALUES ('1131', 'shh001', '202.186.196.22', '1568630486');
INSERT INTO `z_log` VALUES ('1132', 'shh001', '202.186.196.22', '1568630510');
INSERT INTO `z_log` VALUES ('1133', 'shh001', '120.34.75.243', '1568641822');
INSERT INTO `z_log` VALUES ('1134', 'shh001', '115.60.13.11', '1568689461');
INSERT INTO `z_log` VALUES ('1135', 'shh001', '115.60.13.11', '1568689917');
INSERT INTO `z_log` VALUES ('1136', 'shh001', '115.60.13.11', '1568690174');
INSERT INTO `z_log` VALUES ('1137', 'shh001', '114.43.164.4', '1568691216');
INSERT INTO `z_log` VALUES ('1138', 'shh001', '120.84.11.142', '1568691342');
INSERT INTO `z_log` VALUES ('1139', 'shh001', '120.84.11.142', '1568691430');
INSERT INTO `z_log` VALUES ('1140', 'shh001', '120.84.11.142', '1568691432');
INSERT INTO `z_log` VALUES ('1141', 'shh001', '58.57.177.85', '1568697900');
INSERT INTO `z_log` VALUES ('1142', 'shh001', '120.84.11.142', '1568698932');
INSERT INTO `z_log` VALUES ('1143', 'shh001', '120.37.96.118', '1568700468');
INSERT INTO `z_log` VALUES ('1144', 'shh001', '222.137.122.95', '1568700532');
INSERT INTO `z_log` VALUES ('1145', 'shh001', '222.137.122.95', '1568700554');
INSERT INTO `z_log` VALUES ('1146', 'shh001', '116.21.137.43', '1568700794');
INSERT INTO `z_log` VALUES ('1147', 'shh001', '120.84.11.142', '1568700921');
INSERT INTO `z_log` VALUES ('1148', 'shh001', '183.167.179.213', '1568702193');
INSERT INTO `z_log` VALUES ('1149', 'shh001', '119.86.36.99', '1568702683');
INSERT INTO `z_log` VALUES ('1150', 'shh001', '175.7.19.34', '1568702829');
INSERT INTO `z_log` VALUES ('1151', 'shh001', '45.114.166.66', '1568704475');
INSERT INTO `z_log` VALUES ('1152', 'shh001', '106.119.15.113', '1568704855');
INSERT INTO `z_log` VALUES ('1153', 'shh001', '120.37.96.118', '1568705714');
INSERT INTO `z_log` VALUES ('1154', 'shh001', '223.104.21.220', '1568708289');
INSERT INTO `z_log` VALUES ('1155', 'shh001', '203.90.248.158', '1568709780');
INSERT INTO `z_log` VALUES ('1156', 'shh001', '58.57.177.85', '1568710646');
INSERT INTO `z_log` VALUES ('1157', 'shh001', '211.97.128.36', '1568720875');
INSERT INTO `z_log` VALUES ('1158', 'shh001', '119.86.36.99', '1568726833');
INSERT INTO `z_log` VALUES ('1159', 'shh001', '119.86.36.99', '1568726964');
INSERT INTO `z_log` VALUES ('1160', 'shh001', '113.116.99.143', '1568728434');
INSERT INTO `z_log` VALUES ('1161', 'shh001', '120.228.76.170', '1568730785');
INSERT INTO `z_log` VALUES ('1162', 'shh001', '36.157.44.106', '1568730830');
INSERT INTO `z_log` VALUES ('1163', 'shh001', '119.86.33.8', '1568775930');
INSERT INTO `z_log` VALUES ('1164', 'shh001', '112.103.118.147', '1568779805');
INSERT INTO `z_log` VALUES ('1165', 'shh001', '112.97.61.224', '1568782103');
INSERT INTO `z_log` VALUES ('1166', 'shh001', '119.86.33.8', '1568785185');
INSERT INTO `z_log` VALUES ('1167', 'shh001', '219.157.158.149', '1568788544');
INSERT INTO `z_log` VALUES ('1168', 'shh001', '115.60.7.246', '1568795299');
INSERT INTO `z_log` VALUES ('1169', 'shh001', '115.60.7.246', '1568795311');
INSERT INTO `z_log` VALUES ('1170', 'shh001', '14.111.63.91', '1568803916');
INSERT INTO `z_log` VALUES ('1171', 'shh001', '120.37.112.43', '1568809464');
INSERT INTO `z_log` VALUES ('1172', 'shh001', '27.27.12.100', '1568825573');
INSERT INTO `z_log` VALUES ('1173', 'shh001', '113.105.71.3', '1568828042');
INSERT INTO `z_log` VALUES ('1174', 'shh001', '59.61.68.114', '1568863340');
INSERT INTO `z_log` VALUES ('1175', 'shh001', '110.87.116.114', '1568863646');
INSERT INTO `z_log` VALUES ('1176', 'shh001', '110.87.116.114', '1568877844');
INSERT INTO `z_log` VALUES ('1177', 'shh001', '175.44.174.61', '1568879840');
INSERT INTO `z_log` VALUES ('1178', 'shh001', '66.181.161.116', '1568894505');
INSERT INTO `z_log` VALUES ('1179', 'shh001', '66.181.161.116', '1568894715');
INSERT INTO `z_log` VALUES ('1180', 'shh001', '66.181.161.116', '1568894973');
INSERT INTO `z_log` VALUES ('1181', 'shh001', '112.97.52.130', '1568947097');
INSERT INTO `z_log` VALUES ('1182', 'shh001', '113.90.19.150', '1568948204');
INSERT INTO `z_log` VALUES ('1183', 'shh001', '120.84.11.142', '1568953016');
INSERT INTO `z_log` VALUES ('1184', 'shh001', '119.123.42.242', '1568954593');
INSERT INTO `z_log` VALUES ('1185', 'shh001', '223.152.18.117', '1568959817');
INSERT INTO `z_log` VALUES ('1186', 'shh001', '106.86.46.47', '1568960049');
INSERT INTO `z_log` VALUES ('1187', 'shh001', '223.152.18.117', '1568960288');
INSERT INTO `z_log` VALUES ('1188', 'shh001', '58.16.228.142', '1568962203');
INSERT INTO `z_log` VALUES ('1189', 'shh001', '183.93.98.129', '1568963478');
INSERT INTO `z_log` VALUES ('1190', 'shh001', '183.93.98.129', '1568963509');
INSERT INTO `z_log` VALUES ('1191', 'shh001', '117.136.79.133', '1568968780');
INSERT INTO `z_log` VALUES ('1192', 'shh001', '223.104.106.239', '1568981560');
INSERT INTO `z_log` VALUES ('1193', 'shh001', '223.104.6.58', '1568985101');
INSERT INTO `z_log` VALUES ('1194', 'shh001', '119.86.35.21', '1568987811');
INSERT INTO `z_log` VALUES ('1195', 'shh001', '115.60.21.244', '1568997903');
INSERT INTO `z_log` VALUES ('1196', 'shh001', '115.60.21.244', '1569027296');
INSERT INTO `z_log` VALUES ('1197', 'shh001', '220.173.178.72', '1569039620');
INSERT INTO `z_log` VALUES ('1198', 'shh001', '124.239.71.18', '1569050853');
INSERT INTO `z_log` VALUES ('1199', 'shh001', '183.225.28.198', '1569052752');
INSERT INTO `z_log` VALUES ('1200', 'shh001', '171.9.73.92', '1569060009');
INSERT INTO `z_log` VALUES ('1201', 'shh001', '202.36.59.6', '1569070909');
INSERT INTO `z_log` VALUES ('1202', 'shh001', '113.16.25.176', '1569073200');
INSERT INTO `z_log` VALUES ('1203', 'shh001', '113.16.25.176', '1569073368');
INSERT INTO `z_log` VALUES ('1204', 'shh001', '113.16.25.176', '1569073400');
INSERT INTO `z_log` VALUES ('1205', 'shh001', '122.97.178.126', '1569078253');
INSERT INTO `z_log` VALUES ('1206', 'shh001', '122.97.178.126', '1569078263');
INSERT INTO `z_log` VALUES ('1207', 'shh001', '122.97.178.126', '1569078266');
INSERT INTO `z_log` VALUES ('1208', 'shh001', '122.97.178.126', '1569078277');
INSERT INTO `z_log` VALUES ('1209', 'shh001', '112.44.106.216', '1569078320');
INSERT INTO `z_log` VALUES ('1210', 'shh001', '119.123.202.63', '1569089986');
INSERT INTO `z_log` VALUES ('1211', 'shh001', '183.200.116.190', '1569140997');
INSERT INTO `z_log` VALUES ('1212', 'shh001', '183.200.116.190', '1569141136');
INSERT INTO `z_log` VALUES ('1213', 'shh001', '118.183.107.186', '1569142953');
INSERT INTO `z_log` VALUES ('1214', 'shh001', '118.183.107.186', '1569142996');
INSERT INTO `z_log` VALUES ('1215', 'shh001', '223.74.158.201', '1569146357');
INSERT INTO `z_log` VALUES ('1216', 'shh001', '121.32.51.20', '1569154775');
INSERT INTO `z_log` VALUES ('1217', 'shh001', '122.97.175.96', '1569155384');
INSERT INTO `z_log` VALUES ('1218', 'shh001', '182.127.140.229', '1569156567');
INSERT INTO `z_log` VALUES ('1219', 'shh001', '120.42.194.151', '1569158461');
INSERT INTO `z_log` VALUES ('1220', 'shh001', '171.221.146.109', '1569206161');
INSERT INTO `z_log` VALUES ('1221', 'shh001', '27.21.97.130', '1569212492');
INSERT INTO `z_log` VALUES ('1222', 'shh001', '27.21.97.130', '1569213353');
INSERT INTO `z_log` VALUES ('1223', 'shh001', '14.127.249.195', '1569219409');
INSERT INTO `z_log` VALUES ('1224', 'shh001', '119.4.252.36', '1569220044');
INSERT INTO `z_log` VALUES ('1225', 'shh001', '36.152.48.106', '1569221708');
INSERT INTO `z_log` VALUES ('1226', 'shh001', '27.216.178.248', '1569222238');
INSERT INTO `z_log` VALUES ('1227', 'shh001', '110.54.160.33', '1569228327');
INSERT INTO `z_log` VALUES ('1228', 'shh001', '110.54.160.33', '1569228782');
INSERT INTO `z_log` VALUES ('1229', 'shh001', '117.132.197.180', '1569233400');
INSERT INTO `z_log` VALUES ('1230', 'shh001', '121.205.80.79', '1569243211');
INSERT INTO `z_log` VALUES ('1231', 'shh001', '123.161.177.1', '1569249731');
INSERT INTO `z_log` VALUES ('1232', 'shh001', '183.225.28.198', '1569250068');
INSERT INTO `z_log` VALUES ('1233', 'shh001', '42.237.24.174', '1569308386');
INSERT INTO `z_log` VALUES ('1234', 'shh001', '42.237.24.174', '1569308450');
INSERT INTO `z_log` VALUES ('1235', 'shh001', '14.111.59.48', '1569309428');
INSERT INTO `z_log` VALUES ('1236', 'shh001', '58.243.250.171', '1569324985');
INSERT INTO `z_log` VALUES ('1237', 'shh001', '61.158.152.168', '1569328446');
INSERT INTO `z_log` VALUES ('1238', 'shh001', '112.51.82.214', '1569330175');
INSERT INTO `z_log` VALUES ('1239', 'shh001', '112.51.82.214', '1569330209');
INSERT INTO `z_log` VALUES ('1240', 'shh001', '180.152.245.155', '1569336929');
INSERT INTO `z_log` VALUES ('1241', 'shh001', '180.130.10.127', '1569336957');
INSERT INTO `z_log` VALUES ('1242', 'shh001', '203.81.83.146', '1569337118');
INSERT INTO `z_log` VALUES ('1243', 'shh001', '1.207.102.117', '1569342801');
INSERT INTO `z_log` VALUES ('1244', 'shh001', '1.207.102.117', '1569342861');
INSERT INTO `z_log` VALUES ('1245', 'shh001', '1.207.102.117', '1569343547');
INSERT INTO `z_log` VALUES ('1246', 'shh001', '1.207.102.117', '1569343677');
INSERT INTO `z_log` VALUES ('1247', 'shh001', '36.152.48.121', '1569378404');
INSERT INTO `z_log` VALUES ('1248', 'shh001', '36.152.48.121', '1569378692');
INSERT INTO `z_log` VALUES ('1249', 'shh001', '116.23.19.81', '1569381883');
INSERT INTO `z_log` VALUES ('1250', 'shh001', '36.152.48.121', '1569397856');
INSERT INTO `z_log` VALUES ('1251', 'shh001', '27.154.109.199', '1569403705');
INSERT INTO `z_log` VALUES ('1252', 'shh001', '120.42.194.151', '1569416685');
INSERT INTO `z_log` VALUES ('1253', 'shh001', '120.42.194.151', '1569416923');
INSERT INTO `z_log` VALUES ('1254', 'shh001', '117.136.40.198', '1569420829');
INSERT INTO `z_log` VALUES ('1255', 'shh001', '117.136.40.198', '1569420913');
INSERT INTO `z_log` VALUES ('1256', 'shh001', '36.57.16.229', '1569451819');
INSERT INTO `z_log` VALUES ('1257', 'shh001', '36.57.16.229', '1569451847');
INSERT INTO `z_log` VALUES ('1258', 'shh001', '115.206.56.116', '1569460436');
INSERT INTO `z_log` VALUES ('1259', 'shh001', '223.73.123.72', '1569465889');
INSERT INTO `z_log` VALUES ('1260', 'shh001', '223.73.123.72', '1569467889');
INSERT INTO `z_log` VALUES ('1261', 'shh001', '115.206.56.116', '1569469326');
INSERT INTO `z_log` VALUES ('1262', 'shh001', '27.27.148.176', '1569477174');
INSERT INTO `z_log` VALUES ('1263', 'shh001', '14.24.157.196', '1569481072');
INSERT INTO `z_log` VALUES ('1264', 'shh001', '14.24.157.196', '1569485248');
INSERT INTO `z_log` VALUES ('1265', 'shh001', '36.152.48.121', '1569493165');
INSERT INTO `z_log` VALUES ('1266', 'shh001', '36.152.48.121', '1569493231');
INSERT INTO `z_log` VALUES ('1267', 'shh001', '36.152.48.121', '1569494227');
INSERT INTO `z_log` VALUES ('1268', 'shh001', '122.97.175.97', '1569494373');
INSERT INTO `z_log` VALUES ('1269', 'shh001', '210.213.222.220', '1569499096');
INSERT INTO `z_log` VALUES ('1270', 'shh001', '114.224.107.184', '1569502353');
INSERT INTO `z_log` VALUES ('1271', 'shh001', '116.228.221.202', '1569552071');
INSERT INTO `z_log` VALUES ('1272', 'shh001', '117.136.30.195', '1569554238');
INSERT INTO `z_log` VALUES ('1273', 'shh001', '117.136.30.195', '1569554810');
INSERT INTO `z_log` VALUES ('1274', 'shh001', '222.64.157.163', '1569558888');
INSERT INTO `z_log` VALUES ('1275', 'shh001', '222.64.157.163', '1569559102');
INSERT INTO `z_log` VALUES ('1276', 'shh001', '222.64.157.163', '1569559632');
INSERT INTO `z_log` VALUES ('1277', 'shh001', '222.64.157.163', '1569559947');
INSERT INTO `z_log` VALUES ('1278', 'shh001', '222.64.157.163', '1569560067');
INSERT INTO `z_log` VALUES ('1279', 'shh001', '222.64.157.163', '1569561722');
INSERT INTO `z_log` VALUES ('1280', 'shh001', '120.27.217.93', '1569568221');
INSERT INTO `z_log` VALUES ('1281', 'shh001', '222.64.157.163', '1569568383');
INSERT INTO `z_log` VALUES ('1282', 'shh001', '120.27.217.93', '1569568693');
INSERT INTO `z_log` VALUES ('1283', 'shh001', '222.64.157.163', '1569568861');
INSERT INTO `z_log` VALUES ('1284', 'shh001', '120.27.217.93', '1569571585');
INSERT INTO `z_log` VALUES ('1285', 'shh001', '117.136.30.195', '1569574907');
INSERT INTO `z_log` VALUES ('1286', 'shh001', '112.224.17.55', '1569577921');
INSERT INTO `z_log` VALUES ('1287', 'shh001', '110.82.57.247', '1569623316');
INSERT INTO `z_log` VALUES ('1288', 'shh001', '110.54.133.41', '1569634005');
INSERT INTO `z_log` VALUES ('1289', 'shh001', '117.140.56.76', '1569635783');
INSERT INTO `z_log` VALUES ('1290', 'shh001', '123.54.24.227', '1569658002');
INSERT INTO `z_log` VALUES ('1291', 'shh001', '223.152.18.204', '1569662941');
INSERT INTO `z_log` VALUES ('1292', 'shh001', '39.130.109.9', '1569673852');
INSERT INTO `z_log` VALUES ('1293', 'shh001', '61.158.148.6', '1569680779');
INSERT INTO `z_log` VALUES ('1294', 'shh001', '223.104.106.83', '1569706970');
INSERT INTO `z_log` VALUES ('1295', 'shh001', '121.21.92.20', '1569722091');
INSERT INTO `z_log` VALUES ('1296', 'shh001', '61.163.228.162', '1569723784');
INSERT INTO `z_log` VALUES ('1297', 'shh001', '106.121.157.135', '1569727619');
INSERT INTO `z_log` VALUES ('1298', 'shh001', '117.44.174.144', '1569728286');
INSERT INTO `z_log` VALUES ('1299', 'shh001', '111.194.188.49', '1569728318');
INSERT INTO `z_log` VALUES ('1300', 'shh001', '42.230.35.201', '1569738312');
INSERT INTO `z_log` VALUES ('1301', 'shh001', '121.205.80.79', '1569741487');
INSERT INTO `z_log` VALUES ('1302', 'shh001', '121.205.80.79', '1569742470');
INSERT INTO `z_log` VALUES ('1303', 'shh001', '111.194.188.49', '1569747151');
INSERT INTO `z_log` VALUES ('1304', 'shh001', '111.194.188.49', '1569747186');
INSERT INTO `z_log` VALUES ('1305', 'shh001', '123.139.86.101', '1569758497');
INSERT INTO `z_log` VALUES ('1306', 'shh001', '123.139.86.101', '1569759188');
INSERT INTO `z_log` VALUES ('1307', 'shh001', '61.158.168.214', '1569765884');
INSERT INTO `z_log` VALUES ('1308', 'shh001', '122.97.178.167', '1569768769');
INSERT INTO `z_log` VALUES ('1309', 'shh001', '221.225.203.43', '1569769216');
INSERT INTO `z_log` VALUES ('1310', 'shh001', '221.225.203.43', '1569769752');
INSERT INTO `z_log` VALUES ('1311', 'shh001', '119.123.73.76', '1569810662');
INSERT INTO `z_log` VALUES ('1312', 'shh001', '1.87.200.241', '1569814917');
INSERT INTO `z_log` VALUES ('1313', 'shh001', '119.186.96.46', '1569818512');
INSERT INTO `z_log` VALUES ('1314', 'shh001', '117.136.22.59', '1569826029');
INSERT INTO `z_log` VALUES ('1315', 'shh001', '122.97.178.41', '1569830834');
INSERT INTO `z_log` VALUES ('1316', 'shh001', '61.163.228.162', '1569831295');
INSERT INTO `z_log` VALUES ('1317', 'shh001', '122.97.178.41', '1569832628');
INSERT INTO `z_log` VALUES ('1318', 'shh001', '175.12.227.244', '1569848956');
INSERT INTO `z_log` VALUES ('1319', 'shh001', '61.51.136.187', '1569857874');
INSERT INTO `z_log` VALUES ('1320', 'shh001', '61.51.136.187', '1569858347');
INSERT INTO `z_log` VALUES ('1321', 'shh001', '223.88.63.67', '1569898992');
INSERT INTO `z_log` VALUES ('1322', 'shh001', '42.248.49.118', '1569918598');
INSERT INTO `z_log` VALUES ('1323', 'shh001', '61.51.136.187', '1570017853');
INSERT INTO `z_log` VALUES ('1324', 'shh001', '106.127.226.150', '1570028357');
INSERT INTO `z_log` VALUES ('1325', 'shh001', '110.53.174.181', '1570069380');
INSERT INTO `z_log` VALUES ('1326', 'shh001', '106.84.207.71', '1570069504');
INSERT INTO `z_log` VALUES ('1327', 'shh001', '106.84.207.71', '1570069571');
INSERT INTO `z_log` VALUES ('1328', 'shh001', '61.51.136.187', '1570074473');
INSERT INTO `z_log` VALUES ('1329', 'shh001', '113.57.182.0', '1570089429');
INSERT INTO `z_log` VALUES ('1330', 'shh001', '39.184.15.111', '1570109372');
INSERT INTO `z_log` VALUES ('1331', 'shh001', '39.184.15.111', '1570124019');
INSERT INTO `z_log` VALUES ('1332', 'shh001', '39.184.15.111', '1570124450');
INSERT INTO `z_log` VALUES ('1333', 'shh001', '113.200.204.97', '1570130053');
INSERT INTO `z_log` VALUES ('1334', 'shh001', '183.32.128.126', '1570182263');
INSERT INTO `z_log` VALUES ('1335', 'shh001', '223.88.29.177', '1570186782');
INSERT INTO `z_log` VALUES ('1336', 'shh001', '223.88.29.177', '1570186828');
INSERT INTO `z_log` VALUES ('1337', 'shh001', '223.88.29.177', '1570186917');
INSERT INTO `z_log` VALUES ('1338', 'shh001', '223.88.29.177', '1570186937');
INSERT INTO `z_log` VALUES ('1339', 'shh001', '183.32.128.126', '1570187994');
INSERT INTO `z_log` VALUES ('1340', 'shh001', '223.88.29.177', '1570189204');
INSERT INTO `z_log` VALUES ('1341', 'shh001', '223.88.29.177', '1570191461');
INSERT INTO `z_log` VALUES ('1342', 'shh001', '110.82.8.146', '1570191587');
INSERT INTO `z_log` VALUES ('1343', 'shh001', '223.104.6.122', '1570261009');
INSERT INTO `z_log` VALUES ('1344', 'shh001', '27.186.126.213', '1570263537');
INSERT INTO `z_log` VALUES ('1345', 'shh001', '115.63.175.157', '1570266226');
INSERT INTO `z_log` VALUES ('1346', 'shh001', '27.27.150.57', '1570327356');
INSERT INTO `z_log` VALUES ('1347', 'shh001', '139.214.251.119', '1570337018');
INSERT INTO `z_log` VALUES ('1348', 'shh001', '211.97.129.75', '1570359224');
INSERT INTO `z_log` VALUES ('1349', 'shh001', '211.97.129.75', '1570363195');
INSERT INTO `z_log` VALUES ('1350', 'shh001', '58.22.65.242', '1570363468');
INSERT INTO `z_log` VALUES ('1351', 'shh001', '180.142.29.199', '1570366334');
INSERT INTO `z_log` VALUES ('1352', 'shh001', '117.188.93.170', '1570375216');
INSERT INTO `z_log` VALUES ('1353', 'shh001', '113.220.40.42', '1570414364');
INSERT INTO `z_log` VALUES ('1354', 'shh001', '113.220.40.42', '1570414654');
INSERT INTO `z_log` VALUES ('1355', 'shh001', '113.220.40.42', '1570415684');
INSERT INTO `z_log` VALUES ('1356', 'shh001', '113.220.40.42', '1570416014');
INSERT INTO `z_log` VALUES ('1357', 'shh001', '113.220.40.42', '1570416805');
INSERT INTO `z_log` VALUES ('1358', 'shh001', '223.88.48.211', '1570417482');
INSERT INTO `z_log` VALUES ('1359', 'shh001', '58.62.202.120', '1570420472');
INSERT INTO `z_log` VALUES ('1360', 'shh001', '113.220.40.42', '1570423458');
INSERT INTO `z_log` VALUES ('1361', 'shh001', '113.220.40.42', '1570423499');
INSERT INTO `z_log` VALUES ('1362', 'shh001', '113.220.40.42', '1570423583');
INSERT INTO `z_log` VALUES ('1363', 'shh001', '58.62.202.120', '1570433716');
INSERT INTO `z_log` VALUES ('1364', 'shh001', '123.161.54.135', '1570436076');
INSERT INTO `z_log` VALUES ('1365', 'shh001', '123.161.54.135', '1570436155');
INSERT INTO `z_log` VALUES ('1366', 'shh001', '119.86.39.59', '1570444778');
INSERT INTO `z_log` VALUES ('1367', 'shh001', '36.4.82.4', '1570457264');
INSERT INTO `z_log` VALUES ('1368', 'shh001', '36.4.82.4', '1570457269');
INSERT INTO `z_log` VALUES ('1369', 'shh001', '36.157.124.21', '1570505538');
INSERT INTO `z_log` VALUES ('1370', 'shh001', '112.48.1.100', '1570507449');
INSERT INTO `z_log` VALUES ('1371', 'shh001', '123.4.123.5', '1570509084');
INSERT INTO `z_log` VALUES ('1372', 'shh001', '123.9.132.153', '1570513474');
INSERT INTO `z_log` VALUES ('1373', 'shh001', '27.110.131.50', '1570524345');
INSERT INTO `z_log` VALUES ('1374', 'shh001', '150.138.181.173', '1570532480');
INSERT INTO `z_log` VALUES ('1375', 'shh001', '115.219.162.168', '1570533780');
INSERT INTO `z_log` VALUES ('1376', 'shh001', '223.73.131.240', '1570535968');
INSERT INTO `z_log` VALUES ('1377', 'shh001', '223.73.131.240', '1570537843');
INSERT INTO `z_log` VALUES ('1378', 'shh001', '150.138.181.173', '1570592244');
INSERT INTO `z_log` VALUES ('1379', 'shh001', '27.110.131.50', '1570592296');
INSERT INTO `z_log` VALUES ('1380', 'shh001', '123.53.36.124', '1570600660');
INSERT INTO `z_log` VALUES ('1381', 'shh001', '175.1.108.111', '1570603184');
INSERT INTO `z_log` VALUES ('1382', 'shh001', '61.158.152.5', '1570616697');
INSERT INTO `z_log` VALUES ('1383', 'shh001', '59.39.196.51', '1570621244');
INSERT INTO `z_log` VALUES ('1384', 'shh001', '120.227.89.247', '1570621991');
INSERT INTO `z_log` VALUES ('1385', 'shh001', '58.22.113.98', '1570622883');
INSERT INTO `z_log` VALUES ('1386', 'shh001', '120.227.89.247', '1570625735');
INSERT INTO `z_log` VALUES ('1387', 'shh001', '120.227.89.247', '1570626613');
INSERT INTO `z_log` VALUES ('1388', 'shh001', '113.246.155.121', '1570627820');
INSERT INTO `z_log` VALUES ('1389', 'shh001', '106.8.173.66', '1570629513');
INSERT INTO `z_log` VALUES ('1390', 'shh001', '106.8.173.66', '1570629546');
INSERT INTO `z_log` VALUES ('1391', 'shh001', '106.8.173.66', '1570629801');
INSERT INTO `z_log` VALUES ('1392', 'shh001', '106.8.175.27', '1570630390');
INSERT INTO `z_log` VALUES ('1393', 'shh001', '106.8.175.27', '1570630671');
INSERT INTO `z_log` VALUES ('1394', 'shh001', '106.8.175.27', '1570631156');
INSERT INTO `z_log` VALUES ('1395', 'shh001', '106.8.175.27', '1570631278');
INSERT INTO `z_log` VALUES ('1396', 'shh001', '106.8.175.27', '1570633571');
INSERT INTO `z_log` VALUES ('1397', 'shh001', '211.97.105.225', '1570634635');
INSERT INTO `z_log` VALUES ('1398', 'shh001', '123.13.244.55', '1570656560');
INSERT INTO `z_log` VALUES ('1399', 'shh001', '113.138.36.216', '1570678085');
INSERT INTO `z_log` VALUES ('1400', 'shh001', '106.8.175.27', '1570679023');
INSERT INTO `z_log` VALUES ('1401', 'shh001', '221.192.178.234', '1570687992');
INSERT INTO `z_log` VALUES ('1402', 'shh001', '150.138.181.173', '1570688197');
INSERT INTO `z_log` VALUES ('1403', 'shh001', '110.250.153.178', '1570699172');
INSERT INTO `z_log` VALUES ('1404', 'shh001', '122.190.106.105', '1570705924');
INSERT INTO `z_log` VALUES ('1405', 'shh001', '106.122.210.205', '1570706262');
INSERT INTO `z_log` VALUES ('1406', 'shh001', '59.51.108.33', '1570706818');
INSERT INTO `z_log` VALUES ('1407', 'shh001', '183.160.208.11', '1570707535');
INSERT INTO `z_log` VALUES ('1408', 'shh001', '223.104.13.177', '1570707954');
INSERT INTO `z_log` VALUES ('1409', 'shh001', '183.160.208.11', '1570708935');
INSERT INTO `z_log` VALUES ('1410', 'shh001', '183.160.208.11', '1570709249');
INSERT INTO `z_log` VALUES ('1411', 'shh001', '61.163.148.90', '1570710236');
INSERT INTO `z_log` VALUES ('1412', 'shh001', '61.163.148.90', '1570710321');
INSERT INTO `z_log` VALUES ('1413', 'shh001', '112.17.240.2', '1570710776');
INSERT INTO `z_log` VALUES ('1414', 'shh001', '39.172.250.18', '1570710783');
INSERT INTO `z_log` VALUES ('1415', 'shh001', '39.172.250.18', '1570710802');
INSERT INTO `z_log` VALUES ('1416', 'shh001', '49.84.217.196', '1570711503');
INSERT INTO `z_log` VALUES ('1417', 'shh001', '115.60.16.218', '1570720049');
INSERT INTO `z_log` VALUES ('1418', 'shh001', '115.60.16.218', '1570720087');
INSERT INTO `z_log` VALUES ('1419', 'shh001', '223.104.64.254', '1570720678');
INSERT INTO `z_log` VALUES ('1420', 'shh001', '42.236.143.72', '1570722383');
INSERT INTO `z_log` VALUES ('1421', 'shh001', '211.97.129.202', '1570741511');
INSERT INTO `z_log` VALUES ('1422', 'shh001', '211.97.129.202', '1570741624');
INSERT INTO `z_log` VALUES ('1423', 'shh001', '124.114.252.42', '1570758937');
INSERT INTO `z_log` VALUES ('1424', 'shh001', '124.114.252.42', '1570759073');
INSERT INTO `z_log` VALUES ('1425', 'shh001', '113.56.203.129', '1570766050');
INSERT INTO `z_log` VALUES ('1426', 'shh001', '58.22.114.58', '1570767096');
INSERT INTO `z_log` VALUES ('1427', 'shh001', '36.45.41.252', '1570767273');
INSERT INTO `z_log` VALUES ('1428', 'shh001', '117.132.192.53', '1570773820');
INSERT INTO `z_log` VALUES ('1429', 'shh001', '222.76.251.164', '1570774232');
INSERT INTO `z_log` VALUES ('1430', 'shh001', '113.56.203.129', '1570774858');
INSERT INTO `z_log` VALUES ('1431', 'shh001', '115.63.122.153', '1570775949');
INSERT INTO `z_log` VALUES ('1432', 'shh001', '27.154.73.18', '1570777314');
INSERT INTO `z_log` VALUES ('1433', 'shh001', '222.76.251.164', '1570788173');
INSERT INTO `z_log` VALUES ('1434', 'shh001', '120.36.164.45', '1570795535');
INSERT INTO `z_log` VALUES ('1435', 'shh001', '120.36.164.45', '1570796291');
INSERT INTO `z_log` VALUES ('1436', 'shh001', '112.11.81.5', '1570797011');
INSERT INTO `z_log` VALUES ('1437', 'shh001', '221.192.179.234', '1570797790');
INSERT INTO `z_log` VALUES ('1438', 'shh001', '183.95.248.254', '1570801590');
INSERT INTO `z_log` VALUES ('1439', 'shh001', '171.10.177.34', '1570801946');
INSERT INTO `z_log` VALUES ('1440', 'shh001', '122.190.106.100', '1570812085');
INSERT INTO `z_log` VALUES ('1441', 'shh001', '123.4.145.212', '1570843411');
INSERT INTO `z_log` VALUES ('1442', 'shh001', '123.4.145.212', '1570843579');
INSERT INTO `z_log` VALUES ('1443', 'shh001', '211.97.129.32', '1570853665');
INSERT INTO `z_log` VALUES ('1444', 'shh001', '122.191.125.37', '1570856797');
INSERT INTO `z_log` VALUES ('1445', 'shh001', '115.151.191.8', '1570863695');
INSERT INTO `z_log` VALUES ('1446', 'shh001', '150.138.181.173', '1570865401');
INSERT INTO `z_log` VALUES ('1447', 'shh001', '115.62.242.123', '1570866829');
INSERT INTO `z_log` VALUES ('1448', 'shh001', '58.251.1.132', '1570867660');
INSERT INTO `z_log` VALUES ('1449', 'shh001', '58.251.1.132', '1570867700');
INSERT INTO `z_log` VALUES ('1450', 'shh001', '58.251.1.132', '1570867773');
INSERT INTO `z_log` VALUES ('1451', 'shh001', '112.224.19.2', '1570876977');
INSERT INTO `z_log` VALUES ('1452', 'shh001', '115.62.242.123', '1570879180');
INSERT INTO `z_log` VALUES ('1453', 'shh001', '42.249.17.114', '1570880930');
INSERT INTO `z_log` VALUES ('1454', 'shh001', '42.249.17.114', '1570880938');
INSERT INTO `z_log` VALUES ('1455', 'shh001', '115.62.242.123', '1570880987');
INSERT INTO `z_log` VALUES ('1456', 'shh001', '123.232.111.166', '1570883055');
INSERT INTO `z_log` VALUES ('1457', 'shh001', '123.232.111.166', '1570884449');
INSERT INTO `z_log` VALUES ('1458', 'shh001', '115.62.242.123', '1570885059');
INSERT INTO `z_log` VALUES ('1459', 'shh001', '115.62.242.123', '1570885073');
INSERT INTO `z_log` VALUES ('1460', 'shh001', '124.135.248.182', '1570886567');
INSERT INTO `z_log` VALUES ('1461', 'shh001', '124.135.248.182', '1570889052');
INSERT INTO `z_log` VALUES ('1462', 'shh001', '120.11.214.217', '1570895308');
INSERT INTO `z_log` VALUES ('1463', 'shh001', '183.160.2.37', '1570896528');
INSERT INTO `z_log` VALUES ('1464', 'shh001', '60.8.176.138', '1570931272');
INSERT INTO `z_log` VALUES ('1465', 'shh001', '183.40.25.4', '1570941479');
INSERT INTO `z_log` VALUES ('1466', 'shh001', '45.140.168.140', '1570949748');
INSERT INTO `z_log` VALUES ('1467', 'shh001', '123.232.111.166', '1570954942');
INSERT INTO `z_log` VALUES ('1468', 'shh001', '123.232.111.166', '1570956538');
INSERT INTO `z_log` VALUES ('1469', 'shh001', '123.232.111.166', '1570956881');
INSERT INTO `z_log` VALUES ('1470', 'shh001', '112.224.2.7', '1570956909');
INSERT INTO `z_log` VALUES ('1471', 'shh001', '58.218.213.137', '1570981267');
INSERT INTO `z_log` VALUES ('1472', 'shh001', '125.42.95.64', '1570983796');
INSERT INTO `z_log` VALUES ('1473', 'shh001', '125.42.95.64', '1570983970');
INSERT INTO `z_log` VALUES ('1474', 'shh001', '125.42.95.64', '1570984055');
INSERT INTO `z_log` VALUES ('1475', 'shh001', '125.42.95.64', '1570984086');
INSERT INTO `z_log` VALUES ('1476', 'shh001', '125.42.95.64', '1570984249');
INSERT INTO `z_log` VALUES ('1477', 'shh001', '125.42.95.64', '1570984256');
INSERT INTO `z_log` VALUES ('1478', 'shh001', '125.42.95.64', '1570984617');
INSERT INTO `z_log` VALUES ('1479', 'shh001', '125.42.95.64', '1570984657');
INSERT INTO `z_log` VALUES ('1480', 'shh001', '125.42.95.64', '1570984776');
INSERT INTO `z_log` VALUES ('1481', 'shh001', '106.34.69.180', '1570994740');
INSERT INTO `z_log` VALUES ('1482', 'shh001', '45.140.168.140', '1571010908');
INSERT INTO `z_log` VALUES ('1483', 'shh001', '58.218.213.137', '1571018696');
INSERT INTO `z_log` VALUES ('1484', 'shh001', '58.218.213.137', '1571019549');
INSERT INTO `z_log` VALUES ('1485', 'shh001', '183.62.162.115', '1571024735');
INSERT INTO `z_log` VALUES ('1486', 'shh001', '115.60.23.1', '1571025426');
INSERT INTO `z_log` VALUES ('1487', 'shh001', '125.42.95.64', '1571025702');
INSERT INTO `z_log` VALUES ('1488', 'shh001', '115.60.23.1', '1571032517');
INSERT INTO `z_log` VALUES ('1489', 'shh001', '115.60.23.1', '1571032602');
INSERT INTO `z_log` VALUES ('1490', 'shh001', '223.73.131.164', '1571054404');
INSERT INTO `z_log` VALUES ('1491', 'shh001', '223.73.131.164', '1571054457');
INSERT INTO `z_log` VALUES ('1492', 'shh001', '223.73.131.164', '1571054601');
INSERT INTO `z_log` VALUES ('1493', 'shh001', '223.73.131.164', '1571054618');
INSERT INTO `z_log` VALUES ('1494', 'shh001', '223.73.131.110', '1571056132');
INSERT INTO `z_log` VALUES ('1495', 'shh001', '61.163.150.32', '1571058009');
INSERT INTO `z_log` VALUES ('1496', 'shh001', '27.71.208.168', '1571059326');
INSERT INTO `z_log` VALUES ('1497', 'shh001', '182.200.199.213', '1571064881');
INSERT INTO `z_log` VALUES ('1498', 'shh001', '27.38.60.86', '1571111175');
INSERT INTO `z_log` VALUES ('1499', 'shh001', '171.8.218.83', '1571116496');
INSERT INTO `z_log` VALUES ('1500', 'shh001', '110.53.213.149', '1571121693');
INSERT INTO `z_log` VALUES ('1501', 'shh001', '223.88.200.219', '1571135056');
INSERT INTO `z_log` VALUES ('1502', 'shh001', '218.85.219.133', '1571146883');
INSERT INTO `z_log` VALUES ('1503', 'shh001', '218.85.219.133', '1571146899');
INSERT INTO `z_log` VALUES ('1504', 'shh001', '221.205.47.173', '1571187665');
INSERT INTO `z_log` VALUES ('1505', 'shh001', '101.204.247.134', '1571195795');
INSERT INTO `z_log` VALUES ('1506', 'shh001', '113.16.16.244', '1571228313');
INSERT INTO `z_log` VALUES ('1507', 'shh001', '112.96.109.100', '1571231125');
INSERT INTO `z_log` VALUES ('1508', 'shh001', '112.96.109.100', '1571231224');
INSERT INTO `z_log` VALUES ('1509', 'shh001', '223.104.63.99', '1571277936');
INSERT INTO `z_log` VALUES ('1510', 'shh001', '116.21.13.226', '1571277978');
INSERT INTO `z_log` VALUES ('1511', 'shh001', '116.21.13.226', '1571278738');
INSERT INTO `z_log` VALUES ('1512', 'shh001', '117.136.44.218', '1571280733');
INSERT INTO `z_log` VALUES ('1513', 'shh001', '222.78.61.95', '1571333386');
INSERT INTO `z_log` VALUES ('1514', 'shh001', '117.181.81.112', '1571381229');
INSERT INTO `z_log` VALUES ('1515', '111', '117.181.81.112', '1571381542');
INSERT INTO `z_log` VALUES ('1516', 'shh001', '27.18.105.116', '1571382079');
INSERT INTO `z_log` VALUES ('1517', 'shh001', '117.181.81.112', '1571388927');
INSERT INTO `z_log` VALUES ('1518', 'shh001', '27.18.105.116', '1571393038');
INSERT INTO `z_log` VALUES ('1519', 'shh001', '27.18.105.116', '1571396996');
INSERT INTO `z_log` VALUES ('1520', 'shh001', '27.18.105.116', '1571397588');
INSERT INTO `z_log` VALUES ('1521', 'shh001', '117.181.81.112', '1571398371');
INSERT INTO `z_log` VALUES ('1522', 'shh001', '27.18.105.116', '1571399446');
INSERT INTO `z_log` VALUES ('1523', 'shh001', '125.94.208.115', '1571409207');
INSERT INTO `z_log` VALUES ('1524', 'shh001', '223.104.172.42', '1571413378');
INSERT INTO `z_log` VALUES ('1525', 'shh001', '119.251.131.108', '1571414788');
INSERT INTO `z_log` VALUES ('1526', 'shh001', '27.16.214.80', '1571460686');
INSERT INTO `z_log` VALUES ('1527', 'shh001', '1.86.12.235', '1571473471');
INSERT INTO `z_log` VALUES ('1528', 'shh001', '43.250.200.112', '1571477526');
INSERT INTO `z_log` VALUES ('1529', 'shh001', '223.104.6.83', '1571488111');
INSERT INTO `z_log` VALUES ('1530', 'shh001', '223.104.6.83', '1571488165');
INSERT INTO `z_log` VALUES ('1531', 'shh001', '220.249.163.190', '1571489111');
INSERT INTO `z_log` VALUES ('1532', 'shh001', '175.44.123.166', '1571491905');
INSERT INTO `z_log` VALUES ('1533', 'shh001', '117.181.81.112', '1571499264');
INSERT INTO `z_log` VALUES ('1534', 'shh001', '112.49.197.5', '1571504285');
INSERT INTO `z_log` VALUES ('1535', 'shh001', '175.44.123.166', '1571544608');
INSERT INTO `z_log` VALUES ('1536', 'shh001', '220.202.231.186', '1571548609');
INSERT INTO `z_log` VALUES ('1537', 'shh001', '175.44.123.166', '1571549745');
INSERT INTO `z_log` VALUES ('1538', 'shh001', '223.104.130.134', '1571563427');
INSERT INTO `z_log` VALUES ('1539', 'shh001', '223.104.247.196', '1571570602');
INSERT INTO `z_log` VALUES ('1540', 'shh001', '223.104.247.196', '1571570653');
INSERT INTO `z_log` VALUES ('1541', 'shh001', '223.104.247.196', '1571570729');
INSERT INTO `z_log` VALUES ('1542', 'shh001', '117.136.110.53', '1571575205');
INSERT INTO `z_log` VALUES ('1543', 'shh001', '36.159.144.238', '1571619815');
INSERT INTO `z_log` VALUES ('1544', 'shh001', '117.132.193.158', '1571629297');
INSERT INTO `z_log` VALUES ('1545', 'shh001', '59.63.225.100', '1571630478');
INSERT INTO `z_log` VALUES ('1546', 'shh001', '1.193.58.157', '1571641472');
INSERT INTO `z_log` VALUES ('1547', 'shh001', '183.221.141.124', '1571647351');
INSERT INTO `z_log` VALUES ('1548', 'shh001', '140.243.212.85', '1571673772');
INSERT INTO `z_log` VALUES ('1549', 'shh001', '140.243.212.85', '1571673787');
INSERT INTO `z_log` VALUES ('1550', 'shh001', '175.4.145.217', '1571678451');
INSERT INTO `z_log` VALUES ('1551', 'shh001', '116.212.149.242', '1571711589');
INSERT INTO `z_log` VALUES ('1552', 'shh001', '119.86.37.153', '1571718178');
INSERT INTO `z_log` VALUES ('1553', 'shh001', '125.40.10.69', '1571728165');
INSERT INTO `z_log` VALUES ('1554', 'shh001', '115.60.82.187', '1571729791');
INSERT INTO `z_log` VALUES ('1555', 'shh001', '113.67.16.176', '1571733217');
INSERT INTO `z_log` VALUES ('1556', 'shh001', '113.67.16.176', '1571733526');
INSERT INTO `z_log` VALUES ('1557', 'shh001', '113.67.16.176', '1571733568');
INSERT INTO `z_log` VALUES ('1558', 'shh001', '111.6.13.2', '1571755163');
INSERT INTO `z_log` VALUES ('1559', 'shh001', '223.104.1.140', '1571785236');
INSERT INTO `z_log` VALUES ('1560', 'shh001', '223.104.1.140', '1571785414');
INSERT INTO `z_log` VALUES ('1561', 'shh001', '61.140.237.93', '1571799017');
INSERT INTO `z_log` VALUES ('1562', 'shh001', '61.140.237.93', '1571799035');
INSERT INTO `z_log` VALUES ('1563', 'shh001', '119.39.248.124', '1571800197');
INSERT INTO `z_log` VALUES ('1564', 'shh001', '117.136.109.220', '1571800198');
INSERT INTO `z_log` VALUES ('1565', 'shh001', '223.104.1.140', '1571810160');
INSERT INTO `z_log` VALUES ('1566', 'shh001', '121.110.226.10', '1571812233');
INSERT INTO `z_log` VALUES ('1567', 'shh001', '43.250.201.28', '1571816853');
INSERT INTO `z_log` VALUES ('1568', 'shh001', '116.253.192.7', '1571817806');
INSERT INTO `z_log` VALUES ('1569', 'shh001', '116.253.192.7', '1571817862');
INSERT INTO `z_log` VALUES ('1570', 'shh001', '194.124.32.106', '1571818254');
INSERT INTO `z_log` VALUES ('1571', 'shh001', '223.104.63.8', '1571836830');
INSERT INTO `z_log` VALUES ('1572', 'shh001', '223.104.63.8', '1571836865');
INSERT INTO `z_log` VALUES ('1573', 'shh001', '119.137.53.236', '1571842301');
INSERT INTO `z_log` VALUES ('1574', 'shh001', '117.136.39.226', '1571870315');
INSERT INTO `z_log` VALUES ('1575', 'shh001', '121.60.109.238', '1571895771');
INSERT INTO `z_log` VALUES ('1576', 'shh001', '103.136.186.9', '1571899525');
INSERT INTO `z_log` VALUES ('1577', 'shh001', '113.246.154.70', '1571900163');
INSERT INTO `z_log` VALUES ('1578', 'shh001', '171.115.87.64', '1571900885');
INSERT INTO `z_log` VALUES ('1579', 'shh001', '171.115.87.64', '1571901750');
INSERT INTO `z_log` VALUES ('1580', 'shh001', '183.160.1.147', '1571903964');
INSERT INTO `z_log` VALUES ('1581', 'shh001', '61.140.237.93', '1571904566');
INSERT INTO `z_log` VALUES ('1582', 'shh001', '60.169.131.213', '1571905958');
INSERT INTO `z_log` VALUES ('1583', 'shh001', '60.169.131.213', '1571906101');
INSERT INTO `z_log` VALUES ('1584', 'shh001', '60.169.131.213', '1571906879');
INSERT INTO `z_log` VALUES ('1585', 'shh001', '113.246.154.70', '1571910601');
INSERT INTO `z_log` VALUES ('1586', 'shh001', '36.60.14.93', '1571922950');
INSERT INTO `z_log` VALUES ('1587', 'shh001', '36.60.14.93', '1571922996');
INSERT INTO `z_log` VALUES ('1588', 'shh001', '222.175.7.139', '1571976549');
INSERT INTO `z_log` VALUES ('1589', 'shh001', '58.82.229.221', '1571981987');
INSERT INTO `z_log` VALUES ('1590', 'shh001', '119.137.53.115', '1571998615');
INSERT INTO `z_log` VALUES ('1591', 'shh001', '61.158.208.15', '1572006435');
INSERT INTO `z_log` VALUES ('1592', 'shh001', '115.60.73.68', '1572017946');
INSERT INTO `z_log` VALUES ('1593', 'shh001', '115.60.73.68', '1572020346');
INSERT INTO `z_log` VALUES ('1594', 'shh001', '103.119.129.216', '1572022409');
INSERT INTO `z_log` VALUES ('1595', 'shh001', '223.104.63.217', '1572059605');
INSERT INTO `z_log` VALUES ('1596', 'shh001', '115.59.46.154', '1572060287');
INSERT INTO `z_log` VALUES ('1597', 'shh001', '61.158.149.130', '1572063142');
INSERT INTO `z_log` VALUES ('1598', 'shh001', '113.246.107.101', '1572084538');
INSERT INTO `z_log` VALUES ('1599', 'shh001', '27.38.60.106', '1572100714');
INSERT INTO `z_log` VALUES ('1600', 'shh001', '61.158.152.178', '1572108545');
INSERT INTO `z_log` VALUES ('1601', 'shh001', '61.158.152.178', '1572108604');
INSERT INTO `z_log` VALUES ('1602', 'shh001', '61.158.152.178', '1572109037');
INSERT INTO `z_log` VALUES ('1603', 'shh001', '61.158.152.105', '1572146339');
INSERT INTO `z_log` VALUES ('1604', 'shh001', '183.202.203.20', '1572150540');
INSERT INTO `z_log` VALUES ('1605', 'shh001', '112.17.247.34', '1572156255');
INSERT INTO `z_log` VALUES ('1606', 'shh001', '183.202.64.197', '1572171504');
INSERT INTO `z_log` VALUES ('1607', 'shh001', '183.202.65.245', '1572171787');
INSERT INTO `z_log` VALUES ('1608', 'shh001', '223.11.137.162', '1572229124');
INSERT INTO `z_log` VALUES ('1609', 'shh001', '223.11.137.162', '1572230375');
INSERT INTO `z_log` VALUES ('1610', 'shh001', '49.64.84.1', '1572245344');
INSERT INTO `z_log` VALUES ('1611', 'shh001', '49.64.84.1', '1572245472');
INSERT INTO `z_log` VALUES ('1612', 'shh001', '49.64.84.1', '1572245784');
INSERT INTO `z_log` VALUES ('1613', 'shh001', '49.64.84.1', '1572245909');
INSERT INTO `z_log` VALUES ('1614', 'shh001', '183.150.223.73', '1572257546');
INSERT INTO `z_log` VALUES ('1615', 'shh001', '27.156.178.198', '1572270069');
INSERT INTO `z_log` VALUES ('1616', 'shh001', '115.60.79.124', '1572272751');
INSERT INTO `z_log` VALUES ('1617', 'shh001', '117.136.23.211', '1572282683');
INSERT INTO `z_log` VALUES ('1618', 'shh001', '117.27.203.226', '1572327426');
INSERT INTO `z_log` VALUES ('1619', 'shh001', '112.97.160.160', '1572330532');
INSERT INTO `z_log` VALUES ('1620', 'shh001', '112.97.160.160', '1572330565');
INSERT INTO `z_log` VALUES ('1621', 'shh001', '222.244.192.170', '1572348559');
INSERT INTO `z_log` VALUES ('1622', 'shh001', '180.142.65.61', '1572361074');
INSERT INTO `z_log` VALUES ('1623', 'shh001', '27.156.178.198', '1572367185');
INSERT INTO `z_log` VALUES ('1624', 'shh001', '61.158.152.2', '1572380365');
INSERT INTO `z_log` VALUES ('1625', 'shh001', '117.136.8.6', '1572395903');
INSERT INTO `z_log` VALUES ('1626', 'shh001', '117.136.8.6', '1572395925');
INSERT INTO `z_log` VALUES ('1627', 'shh001', '112.44.73.69', '1572414236');
INSERT INTO `z_log` VALUES ('1628', 'shh001', '117.136.81.118', '1572415076');
INSERT INTO `z_log` VALUES ('1629', 'shh001', '117.136.81.118', '1572415114');
INSERT INTO `z_log` VALUES ('1630', 'shh001', '218.200.110.12', '1572417564');
INSERT INTO `z_log` VALUES ('1631', 'shh001', '120.37.46.208', '1572417616');
INSERT INTO `z_log` VALUES ('1632', 'shh001', '59.42.237.123', '1572418817');
INSERT INTO `z_log` VALUES ('1633', 'shh001', '116.7.220.172', '1572418984');
INSERT INTO `z_log` VALUES ('1634', 'shh001', '116.7.220.172', '1572418999');
INSERT INTO `z_log` VALUES ('1635', 'shh001', '59.42.237.123', '1572419994');
INSERT INTO `z_log` VALUES ('1636', 'shh001', '112.96.112.113', '1572420090');
INSERT INTO `z_log` VALUES ('1637', 'shh001', '113.67.17.45', '1572423465');
INSERT INTO `z_log` VALUES ('1638', 'shh001', '113.67.17.45', '1572423500');
INSERT INTO `z_log` VALUES ('1639', 'shh001', '113.67.17.45', '1572423972');
INSERT INTO `z_log` VALUES ('1640', 'shh001', '112.44.73.69', '1572425971');
INSERT INTO `z_log` VALUES ('1641', 'shh001', '27.156.178.198', '1572426248');
INSERT INTO `z_log` VALUES ('1642', 'shh001', '106.114.181.60', '1572501440');
INSERT INTO `z_log` VALUES ('1643', 'shh001', '117.27.40.4', '1572526965');
INSERT INTO `z_log` VALUES ('1644', 'shh001', '223.88.212.46', '1572533711');
INSERT INTO `z_log` VALUES ('1645', 'shh001', '211.97.129.47', '1572542767');
INSERT INTO `z_log` VALUES ('1646', 'shh001', '122.190.107.245', '1572560636');
INSERT INTO `z_log` VALUES ('1647', 'shh001', '111.85.248.125', '1572569468');
INSERT INTO `z_log` VALUES ('1648', 'shh001', '222.137.248.31', '1572591063');
INSERT INTO `z_log` VALUES ('1649', 'shh001', '222.137.248.31', '1572591983');
INSERT INTO `z_log` VALUES ('1650', 'shh001', '14.24.146.231', '1572592042');
INSERT INTO `z_log` VALUES ('1651', 'shh001', '171.113.253.143', '1572593328');
INSERT INTO `z_log` VALUES ('1652', 'shh001', '183.160.122.99', '1572595705');
INSERT INTO `z_log` VALUES ('1653', 'shh001', '123.139.85.188', '1572596860');
INSERT INTO `z_log` VALUES ('1654', 'shh001', '106.114.181.60', '1572600544');
INSERT INTO `z_log` VALUES ('1655', 'shh001', '110.82.26.55', '1572603430');
INSERT INTO `z_log` VALUES ('1656', 'shh001', '203.100.52.13', '1572619473');
INSERT INTO `z_log` VALUES ('1657', 'shh001', '180.191.138.17', '1572621857');
INSERT INTO `z_log` VALUES ('1658', 'shh001', '117.136.85.213', '1572626940');
INSERT INTO `z_log` VALUES ('1659', 'shh001', '175.176.32.196', '1572648260');
INSERT INTO `z_log` VALUES ('1660', 'shh001', '122.228.197.76', '1572660016');
INSERT INTO `z_log` VALUES ('1661', 'shh001', '120.193.236.99', '1572660722');
INSERT INTO `z_log` VALUES ('1662', 'shh001', '203.100.52.13', '1572675777');
INSERT INTO `z_log` VALUES ('1663', 'shh001', '112.96.112.247', '1572683668');
INSERT INTO `z_log` VALUES ('1664', 'shh001', '106.114.181.60', '1572691277');
INSERT INTO `z_log` VALUES ('1665', 'shh001', '112.96.112.247', '1572699636');
INSERT INTO `z_log` VALUES ('1666', 'shh001', '223.104.108.58', '1572741816');
INSERT INTO `z_log` VALUES ('1667', 'shh001', '222.139.120.255', '1572854747');
INSERT INTO `z_log` VALUES ('1668', 'shh001', '222.139.120.255', '1572855156');
INSERT INTO `z_log` VALUES ('1669', 'shh001', '140.243.231.119', '1572863590');
INSERT INTO `z_log` VALUES ('1670', 'shh001', '111.36.75.37', '1572927190');
INSERT INTO `z_log` VALUES ('1671', 'shh001', '117.154.70.65', '1572982237');
INSERT INTO `z_log` VALUES ('1672', 'shh001', '112.48.19.160', '1573006130');
INSERT INTO `z_log` VALUES ('1673', 'shh001', '27.156.204.83', '1573010248');
INSERT INTO `z_log` VALUES ('1674', 'shh001', '14.111.61.70', '1573023681');
INSERT INTO `z_log` VALUES ('1675', 'shh001', '140.243.69.251', '1573048673');
INSERT INTO `z_log` VALUES ('1676', 'shh001', '140.243.69.251', '1573048711');
INSERT INTO `z_log` VALUES ('1677', 'shh001', '223.104.212.175', '1573050151');
INSERT INTO `z_log` VALUES ('1678', 'shh001', '180.116.177.224', '1573051954');
INSERT INTO `z_log` VALUES ('1679', 'shh001', '115.62.157.80', '1573055943');
INSERT INTO `z_log` VALUES ('1680', 'shh001', '119.123.41.121', '1573097452');
INSERT INTO `z_log` VALUES ('1681', 'shh001', '113.110.226.145', '1573101482');
INSERT INTO `z_log` VALUES ('1682', 'shh001', '123.8.46.207', '1573102723');
INSERT INTO `z_log` VALUES ('1683', 'shh001', '113.110.226.145', '1573111484');
INSERT INTO `z_log` VALUES ('1684', 'shh001', '223.104.63.27', '1573125951');
INSERT INTO `z_log` VALUES ('1685', 'shh001', '183.185.165.69', '1573126200');
INSERT INTO `z_log` VALUES ('1686', 'shh001', '61.158.148.104', '1573126210');
INSERT INTO `z_log` VALUES ('1687', 'shh001', '171.117.48.118', '1573127257');
INSERT INTO `z_log` VALUES ('1688', 'shh001', '171.117.48.118', '1573127304');
INSERT INTO `z_log` VALUES ('1689', 'shh001', '182.46.156.181', '1573135930');
INSERT INTO `z_log` VALUES ('1690', 'shh001', '182.46.156.181', '1573136105');
INSERT INTO `z_log` VALUES ('1691', 'shh001', '119.86.39.110', '1573142628');
INSERT INTO `z_log` VALUES ('1692', 'shh001', '223.104.1.152', '1573158254');
INSERT INTO `z_log` VALUES ('1693', 'shh001', '183.156.226.176', '1573187219');
INSERT INTO `z_log` VALUES ('1694', 'shh001', '223.104.170.169', '1573199488');
INSERT INTO `z_log` VALUES ('1695', 'shh001', '223.104.170.169', '1573199506');
INSERT INTO `z_log` VALUES ('1696', 'shh001', '113.110.225.136', '1573206018');
INSERT INTO `z_log` VALUES ('1697', 'shh001', '113.127.177.112', '1573209679');
INSERT INTO `z_log` VALUES ('1698', 'shh001', '116.31.115.10', '1573217021');
INSERT INTO `z_log` VALUES ('1699', 'shh001', '112.224.70.97', '1573219811');
INSERT INTO `z_log` VALUES ('1700', 'shh001', '218.19.18.186', '1573270914');
INSERT INTO `z_log` VALUES ('1701', 'shh001', '202.60.134.200', '1573271172');
INSERT INTO `z_log` VALUES ('1702', 'shh001', '117.136.104.166', '1573302687');
INSERT INTO `z_log` VALUES ('1703', 'shh001', '36.62.172.148', '1573356776');
INSERT INTO `z_log` VALUES ('1704', 'shh001', '106.114.72.66', '1573392371');
INSERT INTO `z_log` VALUES ('1705', 'shh001', '106.127.200.31', '1573392632');
INSERT INTO `z_log` VALUES ('1706', 'shh001', '43.250.201.9', '1573399881');
INSERT INTO `z_log` VALUES ('1707', 'shh001', '106.17.216.17', '1573411394');
INSERT INTO `z_log` VALUES ('1708', 'shh001', '223.104.37.242', '1573427318');
INSERT INTO `z_log` VALUES ('1709', 'shh001', '223.104.37.242', '1573427318');
INSERT INTO `z_log` VALUES ('1710', 'shh001', '39.160.210.244', '1573433693');
INSERT INTO `z_log` VALUES ('1711', 'shh001', '180.165.133.203', '1573435029');
INSERT INTO `z_log` VALUES ('1712', 'shh001', '119.139.198.172', '1573441067');
INSERT INTO `z_log` VALUES ('1713', 'shh001', '175.176.23.34', '1573447703');
INSERT INTO `z_log` VALUES ('1714', 'admin', '123.4.7.231', '1573460936');
INSERT INTO `z_log` VALUES ('1715', 'shh001', '117.136.101.185', '1573466990');
INSERT INTO `z_log` VALUES ('1716', 'shh001', '112.198.29.145', '1573474156');
INSERT INTO `z_log` VALUES ('1717', 'shh001', '112.198.29.145', '1573474590');
INSERT INTO `z_log` VALUES ('1718', 'shh001', '220.197.208.229', '1573476116');
INSERT INTO `z_log` VALUES ('1719', 'shh001', '140.243.253.20', '1573492519');
INSERT INTO `z_log` VALUES ('1720', 'shh001', '61.158.148.49', '1573522368');
INSERT INTO `z_log` VALUES ('1721', 'shh001', '113.245.23.195', '1573525416');
INSERT INTO `z_log` VALUES ('1722', 'shh001', '113.245.23.195', '1573525455');
INSERT INTO `z_log` VALUES ('1723', 'shh001', '36.157.158.100', '1573528126');
INSERT INTO `z_log` VALUES ('1724', 'shh001', '36.157.158.100', '1573528408');
INSERT INTO `z_log` VALUES ('1725', 'shh001', '39.64.16.107', '1573533010');
INSERT INTO `z_log` VALUES ('1726', 'shh001', '106.32.210.77', '1573552402');
INSERT INTO `z_log` VALUES ('1727', 'shh001', '171.10.49.25', '1573555154');
INSERT INTO `z_log` VALUES ('1728', 'shh001', '171.120.32.205', '1573565415');
INSERT INTO `z_log` VALUES ('1729', 'shh001', '222.209.71.62', '1573569525');
INSERT INTO `z_log` VALUES ('1730', 'shh001', '222.209.71.62', '1573569564');
INSERT INTO `z_log` VALUES ('1731', 'shh001', '222.209.71.62', '1573569567');
INSERT INTO `z_log` VALUES ('1732', 'shh001', '117.136.0.212', '1573627269');
INSERT INTO `z_log` VALUES ('1733', 'shh001', '61.158.149.127', '1573627422');
INSERT INTO `z_log` VALUES ('1734', 'shh001', '223.152.44.203', '1573649513');
INSERT INTO `z_log` VALUES ('1735', 'shh001', '42.234.16.109', '1573666979');
INSERT INTO `z_log` VALUES ('1736', 'shh001', '42.234.16.109', '1573667031');
INSERT INTO `z_log` VALUES ('1737', 'shh001', '42.234.16.109', '1573667188');
INSERT INTO `z_log` VALUES ('1738', 'shh001', '42.234.16.109', '1573667317');
INSERT INTO `z_log` VALUES ('1739', 'shh001', '110.54.230.130', '1573703054');
INSERT INTO `z_log` VALUES ('1740', 'shh001', '110.54.230.130', '1573703070');
INSERT INTO `z_log` VALUES ('1741', 'shh001', '110.54.230.130', '1573703143');
INSERT INTO `z_log` VALUES ('1742', 'shh001', '110.54.230.130', '1573703147');
INSERT INTO `z_log` VALUES ('1743', 'shh001', '110.54.230.130', '1573703156');
INSERT INTO `z_log` VALUES ('1744', 'shh001', '110.54.230.130', '1573703213');
INSERT INTO `z_log` VALUES ('1745', 'shh001', '110.54.183.15', '1573705997');
INSERT INTO `z_log` VALUES ('1746', 'shh001', '14.111.57.202', '1573715451');
INSERT INTO `z_log` VALUES ('1747', 'shh001', '182.116.43.61', '1573720110');
INSERT INTO `z_log` VALUES ('1748', 'shh001', '144.52.134.108', '1573720358');
INSERT INTO `z_log` VALUES ('1749', 'shh001', '144.52.134.108', '1573720530');
INSERT INTO `z_log` VALUES ('1750', 'shh001', '203.177.152.61', '1573720586');
INSERT INTO `z_log` VALUES ('1751', 'shh001', '119.86.119.190', '1573722041');
INSERT INTO `z_log` VALUES ('1752', 'shh001', '223.104.188.166', '1573724746');
INSERT INTO `z_log` VALUES ('1753', 'shh001', '223.88.255.112', '1573724869');
INSERT INTO `z_log` VALUES ('1754', 'shh001', '223.104.188.166', '1573724917');
INSERT INTO `z_log` VALUES ('1755', 'shh001', '112.97.247.164', '1573725427');
INSERT INTO `z_log` VALUES ('1756', 'shh001', '203.177.152.61', '1573728657');
INSERT INTO `z_log` VALUES ('1757', 'shh001', '113.12.192.230', '1573730931');
INSERT INTO `z_log` VALUES ('1758', 'shh001', '223.104.108.83', '1573731858');
INSERT INTO `z_log` VALUES ('1759', 'shh001', '14.106.124.228', '1573735950');
INSERT INTO `z_log` VALUES ('1760', 'shh001', '36.37.140.74', '1573738494');
INSERT INTO `z_log` VALUES ('1761', 'shh001', '42.234.13.192', '1573747465');
INSERT INTO `z_log` VALUES ('1762', 'shh001', '61.158.152.191', '1573750526');
INSERT INTO `z_log` VALUES ('1763', 'shh001', '221.13.63.55', '1573783617');
INSERT INTO `z_log` VALUES ('1764', 'shh001', '221.13.63.55', '1573783860');
INSERT INTO `z_log` VALUES ('1765', 'shh001', '120.200.26.18', '1573784781');
INSERT INTO `z_log` VALUES ('1766', 'shh001', '120.200.26.18', '1573784805');
INSERT INTO `z_log` VALUES ('1767', 'shh001', '120.200.26.18', '1573785169');
INSERT INTO `z_log` VALUES ('1768', 'shh001', '117.136.5.51', '1573803182');
INSERT INTO `z_log` VALUES ('1769', 'shh001', '120.200.26.18', '1573803877');
INSERT INTO `z_log` VALUES ('1770', 'shh001', '171.120.118.245', '1573813270');
INSERT INTO `z_log` VALUES ('1771', 'shh001', '171.120.118.245', '1573815180');
INSERT INTO `z_log` VALUES ('1772', 'shh001', '106.34.1.79', '1573815613');
INSERT INTO `z_log` VALUES ('1773', 'shh001', '171.120.118.245', '1573822415');
INSERT INTO `z_log` VALUES ('1774', 'shh001', '171.120.118.245', '1573822523');
INSERT INTO `z_log` VALUES ('1775', 'shh001', '223.104.197.101', '1573826478');
INSERT INTO `z_log` VALUES ('1776', 'admin', '120.239.57.164', '1573871009');
INSERT INTO `z_log` VALUES ('1777', 'shh001', '120.239.57.164', '1573871561');
INSERT INTO `z_log` VALUES ('1778', 'shh001', '118.77.86.14', '1573871740');
INSERT INTO `z_log` VALUES ('1779', 'shh001', '14.111.59.136', '1574149564');
INSERT INTO `z_log` VALUES ('1780', 'shh001', '14.111.59.136', '1574305568');
INSERT INTO `z_log` VALUES ('1781', 'admin', '106.121.128.141', '1574664109');
INSERT INTO `z_log` VALUES ('1782', 'admin', '106.121.128.141', '1574664375');
INSERT INTO `z_log` VALUES ('1783', 'ceshishangjia1', '1.198.29.29', '1575121381');
INSERT INTO `z_log` VALUES ('1784', 'shh001', '36.7.138.40', '1575530494');
INSERT INTO `z_log` VALUES ('1785', 'shh001', '117.136.107.93', '1575553674');
INSERT INTO `z_log` VALUES ('1786', 'shh001', '61.158.208.141', '1575553845');
INSERT INTO `z_log` VALUES ('1787', 'shh001', '117.136.0.233', '1575627268');
INSERT INTO `z_log` VALUES ('1788', 'shh001', '122.228.197.80', '1575734891');
INSERT INTO `z_log` VALUES ('1789', 'shh001', '122.228.197.80', '1575734950');
INSERT INTO `z_log` VALUES ('1790', 'shh001', '123.53.39.208', '1575875525');
INSERT INTO `z_log` VALUES ('1791', 'shh001', '58.57.39.236', '1575876101');
INSERT INTO `z_log` VALUES ('1792', 'shh001', '58.57.39.236', '1575876281');
INSERT INTO `z_log` VALUES ('1793', 'shh001', '58.57.39.236', '1575887595');
INSERT INTO `z_log` VALUES ('1794', 'shh001', '58.57.39.236', '1575966349');
INSERT INTO `z_log` VALUES ('1795', 'shh001', '221.192.178.134', '1575970214');
INSERT INTO `z_log` VALUES ('1796', 'shh001', '61.216.158.144', '1576058952');
INSERT INTO `z_log` VALUES ('1797', 'shh001', '61.158.149.59', '1576122090');
INSERT INTO `z_log` VALUES ('1798', 'shh001', '171.118.68.215', '1576289613');
INSERT INTO `z_log` VALUES ('1799', 'shh001', '113.61.42.175', '1576411066');
INSERT INTO `z_log` VALUES ('1800', 'shh001', '120.229.127.224', '1576721219');
INSERT INTO `z_log` VALUES ('1801', 'shh001', '122.97.220.161', '1576732282');
INSERT INTO `z_log` VALUES ('1802', 'shh001', '58.22.113.119', '1576768123');
INSERT INTO `z_log` VALUES ('1803', 'shh001', '58.22.113.119', '1576768248');
INSERT INTO `z_log` VALUES ('1804', 'admin', '14.106.125.10', '1576826612');
INSERT INTO `z_log` VALUES ('1805', 'shh001', '14.106.125.10', '1576826626');
INSERT INTO `z_log` VALUES ('1806', '222', '115.53.107.121', '1577977535');
INSERT INTO `z_log` VALUES ('1807', 'shh001', '10.168.1.132', '1582357890');
INSERT INTO `z_log` VALUES ('1808', 'admin', '127.0.0.1', '1587279097');
INSERT INTO `z_log` VALUES ('1809', 'admin', '127.0.0.1', '1587530707');
INSERT INTO `z_log` VALUES ('1810', 'merchant', '127.0.0.1', '1587530909');
INSERT INTO `z_log` VALUES ('1811', 'merchant', '127.0.0.1', '1587530916');
INSERT INTO `z_log` VALUES ('1812', 'merchant', '127.0.0.1', '1587611487');
INSERT INTO `z_log` VALUES ('1813', 'merchant', '127.0.0.1', '1587616489');
INSERT INTO `z_log` VALUES ('1814', 'admin', '127.0.0.1', '1587616553');
INSERT INTO `z_log` VALUES ('1815', 'merchant', '127.0.0.1', '1587616641');
INSERT INTO `z_log` VALUES ('1816', 'merchant', '127.0.0.1', '1587617255');
INSERT INTO `z_log` VALUES ('1817', 'merchant', '127.0.0.1', '1587622779');
INSERT INTO `z_log` VALUES ('1818', 'merchant', '127.0.0.1', '1587700640');
INSERT INTO `z_log` VALUES ('1819', 'merchant', '127.0.0.1', '1587700689');
INSERT INTO `z_log` VALUES ('1820', 'merchant', '127.0.0.1', '1587707314');
INSERT INTO `z_log` VALUES ('1821', 'merchant', '127.0.0.1', '1587707361');
INSERT INTO `z_log` VALUES ('1822', 'admin', '127.0.0.1', '1587867436');
INSERT INTO `z_log` VALUES ('1823', 'admin', '127.0.0.1', '1588045904');
INSERT INTO `z_log` VALUES ('1824', 'admin', '127.0.0.1', '1588054346');
INSERT INTO `z_log` VALUES ('1825', 'admin', '127.0.0.1', '1588124060');
INSERT INTO `z_log` VALUES ('1826', 'admin', '127.0.0.1', '1588128729');
INSERT INTO `z_log` VALUES ('1827', 'admin', '127.0.0.1', '1588138533');
