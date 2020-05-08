-- MySQL dump 10.13  Distrib 5.6.44, for Linux (x86_64)
--
-- Host: localhost    Database: sql_103_45_104_2
-- ------------------------------------------------------
-- Server version	5.6.44-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `xh_agent_huoli_log`
--

DROP TABLE IF EXISTS `xh_agent_huoli_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_agent_huoli_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `agent_id` int(10) NOT NULL,
  `orderid` int(10) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `uid` int(10) NOT NULL,
  `huoli` decimal(10,3) NOT NULL,
  `trade_no` varchar(200) NOT NULL,
  `shanghu_fees` decimal(10,3) NOT NULL,
  `time` int(10) NOT NULL,
  `daili_balance` decimal(10,3) NOT NULL,
  `type` varchar(200) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `trade_no` (`trade_no`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_agent_huoli_log`
--

LOCK TABLES `xh_agent_huoli_log` WRITE;
/*!40000 ALTER TABLE `xh_agent_huoli_log` DISABLE KEYS */;
INSERT INTO `xh_agent_huoli_log` VALUES (1,10081,2,1.090,10085,-0.033,'2769320200118485497',0.000,1579283188,99.967,'支付宝固码',0),(2,10093,103,100.190,10094,-1.002,'4555720200120975498',0.000,1579466510,98.998,'支付宝固码',0),(3,10093,2,100.280,10094,1.003,'2619020200120971015',0.000,1579466614,100.001,'跑分模式',0),(4,10093,1,1.270,10094,0.013,'9218520200120495650',0.000,1579466623,100.014,'跑分模式',0),(5,10093,5,1000.260,10094,10.003,'1416520200120100565',0.000,1579467716,110.017,'跑分模式',0),(6,10093,7,5.250,10094,0.053,'3975220200120501025',0.000,1579468626,110.070,'跑分模式',0),(7,10093,12,5.220,10094,0.052,'6810320200120975650',0.000,1579469793,110.122,'跑分模式',0),(8,10093,13,5.280,10094,0.053,'9882420200120101555',0.000,1579469860,110.175,'跑分模式',0),(9,10093,14,5.290,10094,0.053,'3779420200120525357',0.000,1579470170,110.228,'跑分模式',0),(10,10093,15,5.250,10094,0.053,'6419920200120975250',0.000,1579470314,110.281,'跑分模式',0),(11,10093,16,5.280,10094,0.211,'7167020200120541025',0.053,1579470541,110.492,'跑分模式',0),(12,10093,19,5.220,10094,0.209,'7174120200120515498',0.052,1579471691,110.701,'跑分模式',0);
/*!40000 ALTER TABLE `xh_agent_huoli_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_agent_income_log`
--

DROP TABLE IF EXISTS `xh_agent_income_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_agent_income_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `order_id` int(11) NOT NULL,
  `money` decimal(10,3) DEFAULT NULL COMMENT '金额',
  `type` varchar(255) NOT NULL COMMENT '1（支付宝）（2微信）（3服务版）',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='代理收益记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_agent_income_log`
--

LOCK TABLES `xh_agent_income_log` WRITE;
/*!40000 ALTER TABLE `xh_agent_income_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_agent_income_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_agent_rate`
--

DROP TABLE IF EXISTS `xh_agent_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_agent_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL COMMENT '父ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `authority` text NOT NULL COMMENT '权限组分配 -1 全局禁止 json数据',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='代理费率表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_agent_rate`
--

LOCK TABLES `xh_agent_rate` WRITE;
/*!40000 ALTER TABLE `xh_agent_rate` DISABLE KEYS */;
INSERT INTO `xh_agent_rate` VALUES (1,10093,10094,'{\"wechat_auto\":\"0.01\",\"wechatdy_auto\":\"0.01\",\"wechatsj_auto\":\"0.01\",\"alipaygm_auto\":\"0.01\",\"alipay_auto\":\"0.01\",\"bank_auto\":\"0.01\",\"yunshanfu_auto\":\"0.01\",\"lakala_auto\":\"0.01\",\"nxyswx_auto\":\"0.01\",\"nxysyl_auto\":\"0.01\",\"taobaodf_auto\":\"0.01\",\"shouqianba_auto\":\"0.01\",\"pddgm_auto\":\"0.01\",\"paofen_auto\":\"0.01\"}',1579470515,NULL);
/*!40000 ALTER TABLE `xh_agent_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_app_log`
--

DROP TABLE IF EXISTS `xh_app_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_app_log` (
  `id` int(11) NOT NULL,
  `alipay_id` varchar(30) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `amount` decimal(10,3) NOT NULL DEFAULT '0.000',
  `no` varchar(50) NOT NULL DEFAULT '0',
  `pay_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='APP的回调LOG';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_app_log`
--

LOCK TABLES `xh_app_log` WRITE;
/*!40000 ALTER TABLE `xh_app_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_app_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_bank_id`
--

DROP TABLE IF EXISTS `xh_bank_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_bank_id` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(40) DEFAULT '0' COMMENT '银行名称',
  `bank_id` varchar(20) DEFAULT '0' COMMENT '银行简称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_bank_id`
--

LOCK TABLES `xh_bank_id` WRITE;
/*!40000 ALTER TABLE `xh_bank_id` DISABLE KEYS */;
INSERT INTO `xh_bank_id` VALUES (1,'中国银行','BOC'),(2,'招商银行','CMB'),(3,'民生银行','CMBC'),(4,'深圳发展银行','SDB'),(5,'建设银行','CCB'),(6,'农业银行','ABC'),(7,'邮政储蓄银行','POST'),(8,'工商银行','ICBC'),(9,'交通银行','BCOM'),(10,'华夏银行','HXBANK'),(11,'中信银行','CITIC'),(12,'平安银行','SPABANK'),(13,'光大银行','CEB');
/*!40000 ALTER TABLE `xh_bank_id` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_city`
--

DROP TABLE IF EXISTS `xh_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cityname` varchar(250) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_city`
--

LOCK TABLES `xh_city` WRITE;
/*!40000 ALTER TABLE `xh_city` DISABLE KEYS */;
INSERT INTO `xh_city` VALUES (1,'武汉',1),(2,'上海',1),(4,'阿克苏',1);
/*!40000 ALTER TABLE `xh_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_agentwithdraw`
--

DROP TABLE IF EXISTS `xh_client_agentwithdraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_agentwithdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `old_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '旧金额',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `new_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '新金额',
  `types` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 银行处理中 2 银行到账 3 钱款驳回 4 资金异常',
  `content` varchar(255) NOT NULL DEFAULT '0' COMMENT '处理信息',
  `apply_time` int(11) NOT NULL DEFAULT '0' COMMENT '申请时间',
  `date` char(8) NOT NULL DEFAULT '0',
  `deal_time` int(11) NOT NULL DEFAULT '0' COMMENT '处理时间',
  `flow_no` varchar(32) NOT NULL DEFAULT '0' COMMENT '流水号',
  `fees` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `is_notice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否通知过 1已通知  0未通知',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='提现表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_agentwithdraw`
--

LOCK TABLES `xh_client_agentwithdraw` WRITE;
/*!40000 ALTER TABLE `xh_client_agentwithdraw` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_agentwithdraw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_alipay_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_alipay_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_alipay_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '支付宝名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_user_id` varchar(50) NOT NULL COMMENT '支付宝的ID',
  `account` varchar(150) NOT NULL DEFAULT ' ',
  `pid` varchar(100) NOT NULL,
  `is_hongbao` int(10) NOT NULL DEFAULT '0',
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL,
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_alipay_automatic_account`
--

LOCK TABLES `xh_client_alipay_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_alipay_automatic_account` DISABLE KEYS */;
INSERT INTO `xh_client_alipay_automatic_account` VALUES (1,'aa',4,0,0,0,10033,'9C7CBC5AA586A7EBCE',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'','xjalqin@163.com','2088122000429149',0,'','',0);
/*!40000 ALTER TABLE `xh_client_alipay_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_alipay_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_alipay_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_alipay_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alipay_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(250) DEFAULT NULL COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_alipay_automatic_orders`
--

LOCK TABLES `xh_client_alipay_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_alipay_automatic_orders` DISABLE KEYS */;
INSERT INTO `xh_client_alipay_automatic_orders` VALUES (1,1,1576913554,0,2,1.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/alipay/automatic.do','http://xxnew.erinqak.cn/index/alipay/automatic.do',10033,0,'2019122115323428248','110.157.33.245','4381320191221501004','http://xxnew.erinqak.cn/gateway/pay/zzh5.do?id=1',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,''),(2,1,1576913870,0,2,1.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/alipay/automatic.do','http://xxnew.erinqak.cn/index/alipay/automatic.do',10033,0,'2019122115375099128','110.157.33.245','8719420191221101100','http://xxnew.erinqak.cn/gateway/pay/zzh5.do?id=2',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'');
/*!40000 ALTER TABLE `xh_client_alipay_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_alipaygm_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_alipaygm_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_alipaygm_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '支付宝名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_user_id` varchar(50) NOT NULL COMMENT '支付宝的ID',
  `account` varchar(150) NOT NULL DEFAULT ' ',
  `pid` varchar(100) NOT NULL,
  `is_hongbao` int(10) NOT NULL DEFAULT '0',
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL,
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_alipaygm_automatic_account`
--

LOCK TABLES `xh_client_alipaygm_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_alipaygm_automatic_account` DISABLE KEYS */;
INSERT INTO `xh_client_alipaygm_automatic_account` VALUES (24,'固码，不要删除',4,0,0,1560781205,10001,'06FA99B147EDBFD89C',' ',1,2,0,' ',NULL,0.000,'123',0.00,0,1,'',' ','https://qr.alipay.com/aex00878plkpvcgtrfqr9a7',0,'1001234','0',100),(26,'123',4,0,0,0,10001,'06ED2B6BD68A349630',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','13123123123123',0,'','',0),(27,'111',4,0,0,0,2,'C444A2092E391B5CFC',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','https://qr.alipay.com/fkx08312xmkqcu37wlvvyc1',0,'','',0),(30,'',4,0,0,0,10034,'47694E111CA8061FDB',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','https://qr.alipay.com/aex00878plkpvcgtrfqr9a7',0,'aa8888','',0),(29,'测试',4,0,0,0,3,'D2AE3414022B29C280',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','https://qr.alipay.com/aex00878plkpvcgtrfqr9a7',0,'aa10086','',0),(32,'',4,0,0,0,10033,'1C798F889C974D9B79',' ',1,2,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','https://qr.alipay.com/aex00878plkpvcgtrfqr9a7',0,'aa8888','',0),(33,'',4,0,0,0,10080,'78DDE014FCF1A1051C',' ',1,2,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','https://qr.alipay.com/fkx11039tan4luhfhjsuc28?t=1577780987431',0,'44444444','',0),(34,'',4,0,0,0,10085,'E57BCBD18F22BFAC67',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','https://qr.alipay.com/fkx05205h6xlylfsmzsgy0b',0,'002','',0),(36,'',4,0,0,0,10090,'CBDF01327B1F3E0131',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','https://qr.alipay.com/fkx05205h6xlylfsmzsgy0b',0,'','',0),(37,'',4,0,0,0,10094,'88F42C3FB2A7EEF39F',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','https://qr.alipay.com/fkx05205h6xlylfsmzsgy0b',0,'002','',0);
/*!40000 ALTER TABLE `xh_client_alipaygm_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_alipaygm_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_alipaygm_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_alipaygm_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alipaygm_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(250) DEFAULT NULL COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `ymoney` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_alipaygm_automatic_orders`
--

LOCK TABLES `xh_client_alipaygm_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_alipaygm_automatic_orders` DISABLE KEYS */;
INSERT INTO `xh_client_alipaygm_automatic_orders` VALUES (93,36,1579287333,0,2,1.03,'http://47.240.81.152/demo/notify.php','http://47.240.81.152/demo','http://47.240.81.152/demo',10090,0,'2020011802553362275','119.181.133.93','4508620200118539949','http://juxinyx.com/gateway/pay/zzh5.do?id=93',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',1.00),(94,36,1579287336,0,2,1.01,'http://47.240.81.152/demo/notify.php','http://47.240.81.152/demo','http://47.240.81.152/demo',10090,0,'2020011802553665279','119.181.133.93','5837720200118565498','http://juxinyx.com/gateway/pay/zzh5.do?id=94',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',1.00),(95,36,1579287337,0,2,1.04,'http://47.240.81.152/demo/notify.php','http://47.240.81.152/demo','http://47.240.81.152/demo',10090,0,'2020011802553732922','119.181.133.93','2029920200118571001','http://juxinyx.com/gateway/pay/zzh5.do?id=95',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',1.00),(96,36,1579287339,0,2,1.02,'http://47.240.81.152/demo/notify.php','http://47.240.81.152/demo','http://47.240.81.152/demo',10090,0,'2020011802553975810','119.181.133.93','8218220200118985399','http://juxinyx.com/gateway/pay/zzh5.do?id=96',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',1.00),(97,36,1579287340,0,2,1.05,'http://47.240.81.152/demo/notify.php','http://47.240.81.152/demo','http://47.240.81.152/demo',10090,0,'2020011802554050354','119.181.133.93','4387320200118999897','http://juxinyx.com/gateway/pay/zzh5.do?id=97',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',1.00),(98,36,1579287357,0,2,1.07,'http://47.240.81.152/demo/notify.php','http://47.240.81.152/demo','http://47.240.81.152/demo',10090,0,'2020011802555793012','119.181.133.93','8184320200118100535','http://juxinyx.com/gateway/pay/zzh5.do?id=98',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',1.00),(99,36,1579287359,0,2,1.08,'http://47.240.81.152/demo/notify.php','http://47.240.81.152/demo','http://47.240.81.152/demo',10090,0,'2020011802555997849','119.181.133.93','7564320200118102535','http://juxinyx.com/gateway/pay/zzh5.do?id=99',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',1.00),(100,36,1579287360,0,2,1.06,'http://47.240.81.152/demo/notify.php','http://47.240.81.152/demo','http://47.240.81.152/demo',10090,0,'2020011802560077317','119.181.133.93','7906220200118489797','http://juxinyx.com/gateway/pay/zzh5.do?id=100',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',1.00),(101,36,1579337011,0,2,1.14,'http://47.240.81.152/demo/notify.php','http://47.240.81.152/demo','http://47.240.81.152/demo',10090,0,'2020011816433115425','119.181.133.93','7005120200118519850','http://juxinyx.com/gateway/pay/zzh5.do?id=101',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',1.00),(102,37,1579465772,0,2,1.12,'http://47.240.81.152/index/index/callback.do','http://47.240.81.152/index/alipaygm/automatic.do','http://47.240.81.152/index/alipaygm/automatic.do',10094,0,'2020012004293228705','112.227.111.167','9958220200120995155','http://juxinyx.com/gateway/pay/zzh5.do?id=102',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',1.00),(103,37,1579466506,1579466510,4,100.19,'http://47.240.81.152/index/index/callback.do','http://47.240.81.152/index/alipaygm/automatic.do','http://47.240.81.152/index/alipaygm/automatic.do',10094,1579466510,'2020012004414667531','112.227.111.167','4555720200120975498','http://juxinyx.com/gateway/pay/zzh5.do?id=103',' ',1,'商户后台回调',0,'app',' ',0.000,1,-1.002,1.002,'002',100.00),(104,37,1579468944,0,2,5.16,'http://aaa.aahcg.cn/dcf/notifyUrl.php','http://aaa.aahcg.cn/dcf/backurl.php?ddh=2020012005222353054','http://aaa.aahcg.cn/dcf/backurl.php?ddh=2020012005222353054',10094,0,'2020012005222353054','112.227.111.167','7068420200120485198','http://juxinyx.com/gateway/pay/zzh5.do?id=104',' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'002',5.00);
/*!40000 ALTER TABLE `xh_client_alipaygm_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_bank_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_bank_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_bank_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '账号名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 开启使用，0关闭',
  `active_time` int(11) DEFAULT '0' COMMENT '最后使用时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(40) NOT NULL DEFAULT '0' COMMENT 'keyId',
  `bank_id` varchar(20) DEFAULT '0',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `natapp_url` varchar(128) NOT NULL DEFAULT '0',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT '0' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_user_id` varchar(50) NOT NULL DEFAULT '0' COMMENT '支付宝的ID',
  `gathering_name` varchar(50) NOT NULL DEFAULT '0' COMMENT '收款名称',
  `cardid` varchar(50) DEFAULT '0' COMMENT 'cardid',
  `account_no` varchar(50) DEFAULT '0' COMMENT '带*卡号',
  `app_user` varchar(200) NOT NULL,
  `area` varchar(200) NOT NULL,
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_bank_automatic_account`
--

LOCK TABLES `xh_client_bank_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_bank_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_bank_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_bank_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_bank_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_bank_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alipay_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `bank_acount` varchar(100) DEFAULT '0',
  `bank_id` varchar(20) DEFAULT '0',
  `gathering_name` varchar(40) DEFAULT '0',
  `bank_name` varchar(40) DEFAULT '0',
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_bank_automatic_orders`
--

LOCK TABLES `xh_client_bank_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_bank_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_bank_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_bank_automatic_orders_no`
--

DROP TABLE IF EXISTS `xh_client_bank_automatic_orders_no`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_bank_automatic_orders_no` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `bank_acount` varchar(100) DEFAULT '0',
  `time` int(11) DEFAULT '0',
  `status` smallint(2) DEFAULT '0' COMMENT '1 为已确认',
  `pay_time` int(11) DEFAULT '0' COMMENT '补单时间/确认订单时间',
  `fees` decimal(10,2) DEFAULT '0.00' COMMENT '手续费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_bank_automatic_orders_no`
--

LOCK TABLES `xh_client_bank_automatic_orders_no` WRITE;
/*!40000 ALTER TABLE `xh_client_bank_automatic_orders_no` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_bank_automatic_orders_no` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_code`
--

DROP TABLE IF EXISTS `xh_client_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(12) NOT NULL DEFAULT '' COMMENT '手机号',
  `codec` int(6) NOT NULL DEFAULT '0' COMMENT '验证码',
  `get_time` int(11) DEFAULT '0' COMMENT '获取时间',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1 正常 2 已使用',
  `typec` varchar(16) NOT NULL DEFAULT '' COMMENT '类型',
  `ip` varchar(16) NOT NULL DEFAULT '' COMMENT 'ip地址',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='短信验证码';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_code`
--

LOCK TABLES `xh_client_code` WRITE;
/*!40000 ALTER TABLE `xh_client_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_data`
--

DROP TABLE IF EXISTS `xh_client_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '0' COMMENT '键名',
  `value` text NOT NULL COMMENT '键值',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品费率';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_data`
--

LOCK TABLES `xh_client_data` WRITE;
/*!40000 ALTER TABLE `xh_client_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_dingding_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_dingding_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_dingding_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '账号名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 开启使用，0关闭',
  `active_time` int(11) DEFAULT '0' COMMENT '最后使用时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(40) NOT NULL DEFAULT '0' COMMENT 'keyId',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `natapp_url` varchar(128) NOT NULL DEFAULT '0',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT '0' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_no` varchar(50) DEFAULT '0' COMMENT '带*卡号',
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_dingding_automatic_account`
--

LOCK TABLES `xh_client_dingding_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_dingding_automatic_account` DISABLE KEYS */;
INSERT INTO `xh_client_dingding_automatic_account` VALUES (1,'656262626626',1,1552355841,1,'656262626626',1,1,'0',0.000,'0',0.00,0,0,'123123123','1000114'),(2,'123123',1,1551674207,1,'1EB594ABC6641DBBCB',2,1,'0',0.000,'0',0.00,0,0,'123123','10000-2'),(3,'张三',1,0,1,'375781E597F6DEDBD2',2,1,'0',0.000,'0',0.00,0,0,'13972579070','10000-3'),(4,'111',1,1551675201,2,'8031CF96084BE05CA7',1,1,'0',0.000,'0',0.00,0,0,'aaaa','4'),(5,'林冬梅',1,0,10004,'B387B6F7C7F7F96AC6',1,1,'0',0.000,'0',0.00,0,0,'15659536132',''),(6,'123',1,0,10001,'21406DA1139CCBAEBA',1,1,'0',0.000,'0',0.00,0,0,'123','');
/*!40000 ALTER TABLE `xh_client_dingding_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_dingding_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_dingding_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_dingding_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dingding_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `account_no` varchar(100) DEFAULT '0',
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_dingding_automatic_orders`
--

LOCK TABLES `xh_client_dingding_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_dingding_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_dingding_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_group`
--

DROP TABLE IF EXISTS `xh_client_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(26) NOT NULL DEFAULT '普通用户' COMMENT '用户组名称',
  `authority` text COMMENT '权限组分配 -1 全局禁止 json数据',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户组';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_group`
--

LOCK TABLES `xh_client_group` WRITE;
/*!40000 ALTER TABLE `xh_client_group` DISABLE KEYS */;
INSERT INTO `xh_client_group` VALUES (1,'0.5','{\"wechat_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"5\"},\"alipay_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"500\"},\"alipaygm_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"100\"},\"alipayhongbao_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"10\"},\"bank_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"500\"},\"lakala_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"1000\"},\"nxyswx_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"1000\"},\"nxysalipay_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"100\"},\"nxysyl_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"100\"},\"yunshanfu_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"100\"},\"shouqianba_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"100\"},\"pddgm_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"100\"},\"wechatsj_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"100\"},\"wechatdy_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"100\"},\"wechatbank_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"100\"},\"taobaodf_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"100\"},\"service_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"1000\",\"gateway\":null},\"paofen_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"1000\"},\"withdraw\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"1000\"},\"wechatphone_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"1000\"},\"wechatzs_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"1000\"},\"huafei_auto\":{\"cost\":\"0.05\",\"open\":1,\"quantity\":\"1000\"}}'),(2,'0.4','{\"wechat_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"alipay_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"alipaygm_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"alipayhongbao_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"bank_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"lakala_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"nxyswx_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"nxysalipay_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"nxysyl_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"yunshanfu_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"shouqianba_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"pddgm_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"wechatsj_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"wechatdy_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"wechatbank_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"taobaodf_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"service_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\",\"gateway\":null},\"paofen_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"withdraw\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"wechatphone_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"wechatzs_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"},\"huafei_auto\":{\"cost\":\"0.04\",\"open\":1,\"quantity\":\"500\"}}'),(5,'0.3','{\"wechat_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"alipay_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"alipaygm_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"alipayhongbao_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"bank_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"lakala_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"nxyswx_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"nxysalipay_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"nxysyl_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"yunshanfu_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"shouqianba_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"pddgm_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"wechatsj_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"wechatdy_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"wechatbank_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"taobaodf_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"service_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\",\"gateway\":null},\"paofen_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"withdraw\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"wechatphone_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"wechatzs_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"},\"huafei_auto\":{\"cost\":\"0.03\",\"open\":1,\"quantity\":\"500\"}}'),(6,'0.1','{\"wechat_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"alipay_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"alipaygm_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"alipayhongbao_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"bank_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"lakala_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"nxyswx_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"nxysalipay_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"nxysyl_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"yunshanfu_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"shouqianba_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"pddgm_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"wechatsj_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"wechatdy_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"wechatbank_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"taobaodf_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\"},\"service_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"5\",\"gateway\":null},\"paofen_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"1000\"},\"withdraw\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"1000\"},\"wechatphone_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"1000\"},\"wechatzs_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"1000\"},\"huafei_auto\":{\"cost\":\"0.01\",\"open\":1,\"quantity\":\"1000\"}}');
/*!40000 ALTER TABLE `xh_client_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_huafei_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_huafei_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_huafei_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '支付宝名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_user_id` varchar(50) NOT NULL COMMENT '支付宝的ID',
  `account` varchar(150) NOT NULL DEFAULT ' ',
  `phone` varchar(100) NOT NULL,
  `is_hongbao` int(10) NOT NULL DEFAULT '0',
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL,
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_huafei_automatic_account`
--

LOCK TABLES `xh_client_huafei_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_huafei_automatic_account` DISABLE KEYS */;
INSERT INTO `xh_client_huafei_automatic_account` VALUES (1,'测试',4,0,0,0,10033,'3220CE941EF88C6F33',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','13972579070',0,'aa6666aa','',0),(2,'',4,0,0,0,10068,'4B2009265DE284BC1D',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','13124477125',0,'','',0),(3,'',4,0,0,0,10080,'6A364139AB6AB0C113',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,1,'',' ','13333456785',0,'','',0);
/*!40000 ALTER TABLE `xh_client_huafei_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_huafei_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_huafei_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_huafei_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `huafei_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(250) DEFAULT NULL COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `ymoney` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_huafei_automatic_orders`
--

LOCK TABLES `xh_client_huafei_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_huafei_automatic_orders` DISABLE KEYS */;
INSERT INTO `xh_client_huafei_automatic_orders` VALUES (1,1,1576738839,0,2,10.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019121915003914218','110.157.35.34','5805520191219555210',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(2,1,1576740881,0,2,10.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019121915344126678','110.157.35.34','8100520191219495797',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(3,1,1576740952,0,2,10.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019121915355263954','110.157.35.34','8641420191219561015',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(4,1,1576740985,0,2,50.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019121915362470431','110.157.35.34','9127820191219575098',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(5,1,1576741024,0,2,10.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019121915370320212','110.157.35.34','7058620191219485010',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(6,1,1576741182,0,2,200.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019121915394241115','110.157.35.34','4812520191219101565',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(7,1,1576741451,0,2,30.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019121915441195723','110.157.35.34','7692020191219985749',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(8,1,1576741589,0,2,50.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019121915462831128','110.157.35.34','4696820191219535056',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(9,1,1576900820,0,2,10.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019122112002096856','110.157.33.245','9966320191221525799',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(10,1,1576901234,0,2,1.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019122112071415154','110.157.33.245','8005220191221505555',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(11,1,1576901239,0,2,50.00,'http://xxnew.erinqak.cn/index/index/callback.do','http://xxnew.erinqak.cn/index/huafei/automatic.do','http://xxnew.erinqak.cn/index/huafei/automatic.do',10033,0,'2019122112071950180','110.157.33.245','4658020191221555697',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'aa6666aa',0.00),(12,2,1577873308,0,2,1.00,'http://juxinyx.com/index/index/callback.do','http://juxinyx.com/index/huafei/automatic.do','http://juxinyx.com/index/huafei/automatic.do',10068,0,'2020010118082853285','121.207.40.184','6141720200101991015',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',0.00),(13,2,1577874615,0,2,1.00,'http://juxinyx.com/index/index/callback.do','http://juxinyx.com/index/huafei/automatic.do','http://juxinyx.com/index/huafei/automatic.do',10068,0,'2020010118301598718','183.253.135.61','7989220200101551019',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'',0.00);
/*!40000 ALTER TABLE `xh_client_huafei_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_lakala_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_lakala_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_lakala_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '账号名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 开启使用，0关闭',
  `active_time` int(11) DEFAULT '0' COMMENT '最后使用时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(40) NOT NULL DEFAULT '0' COMMENT 'keyId',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `natapp_url` varchar(128) NOT NULL DEFAULT '0',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT '0' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_no` varchar(50) DEFAULT '0' COMMENT '带*卡号',
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL,
  `max_dd` int(10) NOT NULL,
  `qrcode` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_lakala_automatic_account`
--

LOCK TABLES `xh_client_lakala_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_lakala_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_lakala_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_lakala_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_lakala_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_lakala_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lakala_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `account_no` varchar(100) DEFAULT '0',
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_lakala_automatic_orders`
--

LOCK TABLES `xh_client_lakala_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_lakala_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_lakala_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_lakala_automatic_orders_no`
--

DROP TABLE IF EXISTS `xh_client_lakala_automatic_orders_no`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_lakala_automatic_orders_no` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `bank_acount` varchar(100) DEFAULT '0',
  `time` int(11) DEFAULT '0',
  `status` smallint(2) DEFAULT '0' COMMENT '1 为已确认',
  `pay_time` int(11) DEFAULT '0' COMMENT '补单时间/确认订单时间',
  `fees` decimal(10,2) DEFAULT '0.00' COMMENT '手续费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_lakala_automatic_orders_no`
--

LOCK TABLES `xh_client_lakala_automatic_orders_no` WRITE;
/*!40000 ALTER TABLE `xh_client_lakala_automatic_orders_no` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_lakala_automatic_orders_no` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_mashangwithdraw`
--

DROP TABLE IF EXISTS `xh_client_mashangwithdraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_mashangwithdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `old_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '旧金额',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `new_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '新金额',
  `types` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 银行处理中 2 银行到账 3 钱款驳回 4 资金异常',
  `content` varchar(255) NOT NULL DEFAULT '0' COMMENT '处理信息',
  `apply_time` int(11) NOT NULL DEFAULT '0' COMMENT '申请时间',
  `date` char(8) NOT NULL DEFAULT '0',
  `deal_time` int(11) NOT NULL DEFAULT '0' COMMENT '处理时间',
  `flow_no` varchar(32) NOT NULL DEFAULT '0' COMMENT '流水号',
  `fees` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `is_notice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否通知过 1已通知  0未通知',
  `status` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='提现表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_mashangwithdraw`
--

LOCK TABLES `xh_client_mashangwithdraw` WRITE;
/*!40000 ALTER TABLE `xh_client_mashangwithdraw` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_mashangwithdraw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_nxys_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_nxys_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_nxys_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '账号名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 开启使用，0关闭',
  `active_time` int(11) DEFAULT '0' COMMENT '最后使用时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(40) NOT NULL DEFAULT '0' COMMENT 'keyId',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `natapp_url` varchar(128) NOT NULL DEFAULT '0',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT '0' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_no` varchar(50) DEFAULT '0' COMMENT '带*卡号',
  `app_user` varchar(100) NOT NULL,
  `type` int(10) NOT NULL,
  `qrcode` varchar(250) NOT NULL,
  `area` varchar(200) NOT NULL,
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_nxys_automatic_account`
--

LOCK TABLES `xh_client_nxys_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_nxys_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_nxys_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_nxys_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_nxys_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_nxys_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nxys_id` int(11) NOT NULL DEFAULT '0' COMMENT '农信易扫id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `account_no` varchar(100) DEFAULT '0',
  `app_user` varchar(100) NOT NULL,
  `type` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_nxys_automatic_orders`
--

LOCK TABLES `xh_client_nxys_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_nxys_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_nxys_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_nxys_automatic_orders_no`
--

DROP TABLE IF EXISTS `xh_client_nxys_automatic_orders_no`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_nxys_automatic_orders_no` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `bank_acount` varchar(100) DEFAULT '0',
  `time` int(11) DEFAULT '0',
  `status` smallint(2) DEFAULT '0' COMMENT '1 为已确认',
  `pay_time` int(11) DEFAULT '0' COMMENT '补单时间/确认订单时间',
  `fees` decimal(10,2) DEFAULT '0.00' COMMENT '手续费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_nxys_automatic_orders_no`
--

LOCK TABLES `xh_client_nxys_automatic_orders_no` WRITE;
/*!40000 ALTER TABLE `xh_client_nxys_automatic_orders_no` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_nxys_automatic_orders_no` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_pankouwithdraw`
--

DROP TABLE IF EXISTS `xh_client_pankouwithdraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_pankouwithdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `old_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '旧金额',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `new_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '新金额',
  `types` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 银行处理中 2 银行到账 3 钱款驳回 4 资金异常',
  `content` varchar(255) NOT NULL DEFAULT '0' COMMENT '处理信息',
  `apply_time` int(11) NOT NULL DEFAULT '0' COMMENT '申请时间',
  `date` char(8) NOT NULL DEFAULT '0',
  `deal_time` int(11) NOT NULL DEFAULT '0' COMMENT '处理时间',
  `flow_no` varchar(32) NOT NULL DEFAULT '0' COMMENT '流水号',
  `fees` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `is_notice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否通知过 1已通知  0未通知',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='提现表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_pankouwithdraw`
--

LOCK TABLES `xh_client_pankouwithdraw` WRITE;
/*!40000 ALTER TABLE `xh_client_pankouwithdraw` DISABLE KEYS */;
INSERT INTO `xh_client_pankouwithdraw` VALUES (1,10095,135.32,100.00,35.32,2,'提现已到账',1579471887,'0',1579471958,'20200120061127192494',4.00,1,1);
/*!40000 ALTER TABLE `xh_client_pankouwithdraw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_paofen_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_paofen_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_paofen_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '支付宝名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `account_user_id` varchar(50) NOT NULL COMMENT '支付宝的ID',
  `account` varchar(150) NOT NULL DEFAULT ' ',
  `pid` varchar(100) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL DEFAULT '0',
  `max_dd` int(10) NOT NULL,
  `ewm_url` varchar(255) NOT NULL,
  `type` int(10) NOT NULL COMMENT '1为支付宝，2微信3其他',
  `typename` varchar(255) NOT NULL,
  `gathering_name` varchar(200) NOT NULL,
  `cardid` varchar(200) NOT NULL,
  `bank_id` varchar(200) NOT NULL,
  `account_no` varchar(200) NOT NULL,
  `dy_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_paofen_automatic_account`
--

LOCK TABLES `xh_client_paofen_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_paofen_automatic_account` DISABLE KEYS */;
INSERT INTO `xh_client_paofen_automatic_account` VALUES (2,'',4,0,0,0,10068,'0448DF9F20E458B70B',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,'','0','0','','0',0,'',3,'0','0','0','0','0',''),(4,'',4,0,0,0,10084,'E622F1913DC884593F',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,'','0','0','003','0',0,'https://qr.alipay.com/fkx05205h6xlylfsmzsgy0b',1,'0','0','0','0','0',''),(5,'',4,0,0,0,10032,'66BFC07C256A5F76A2',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,'','0','0','','0',0,'mashang',1,'0','0','0','0','0',''),(6,'',4,0,0,0,10091,'5D369C5CBA05D65BCF',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,'','0','0','','0',0,'wqe',2,'0','0','0','0','0',''),(7,'',4,0,0,0,10091,'3EAD2AF6ECF460EC6C',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,'','0','0','','0',0,'wqe',1,'0','0','0','0','0',''),(8,'',4,0,0,0,10094,'81711DD32B89B770EA',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,'','0','0','002','0',0,'https://qr.alipay.com/fkx05205h6xlylfsmzsgy0b',1,'0','0','0','0','0',''),(9,'',4,0,0,0,10096,'C23C27ADBAF7F1EF55',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,'','0','0','','0',0,'112ww2',1,'0','0','0','0','0',''),(10,'',4,0,0,0,10093,'42503B4226151853F6',' ',1,1,0,' ',NULL,0.000,' ',0.00,0,'','0','0','','0',0,'',6,'0','0','0','0','0','');
/*!40000 ALTER TABLE `xh_client_paofen_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_paofen_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_paofen_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_paofen_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paofen_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(250) DEFAULT NULL COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `ymoney` decimal(10,2) NOT NULL,
  `pankou_id` int(10) NOT NULL,
  `type` int(10) NOT NULL,
  `pankou_fees` decimal(10,3) NOT NULL,
  `dy_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_paofen_automatic_orders`
--

LOCK TABLES `xh_client_paofen_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_paofen_automatic_orders` DISABLE KEYS */;
INSERT INTO `xh_client_paofen_automatic_orders` VALUES (1,8,1579465505,1579466623,4,1.27,'http://47.240.81.152/mashang/index/callback.do','http://47.240.81.152/index/paofen/automatic.do','http://47.240.81.152/index/paofen/automatic.do',10094,1579466623,'2020012004175293928','112.227.111.167','9218520200120495650',NULL,' ',1,'商户后台回调',0,'app',' ',0.000,1,0.000,0.000,'002',1.00,1122,1,0.000,''),(2,8,1579466602,1579466614,4,100.28,'http://47.240.81.152/mashang/index/callback.do','http://47.240.81.152/index/paofen/automatic.do','http://47.240.81.152/index/paofen/automatic.do',10094,1579466616,'2020012004432293120','112.227.111.167','2619020200120971015',NULL,' ',1,'商户后台回调',0,'app',' ',0.000,1,0.000,0.000,'002',100.00,1122,1,0.000,''),(3,8,1579466802,0,2,1.23,'http://47.240.81.152/mashang/index/callback.do','http://47.240.81.152/index/paofen/automatic.do','http://47.240.81.152/index/paofen/automatic.do',10094,0,'2020012004464197066','112.227.111.167','8424820200120504810',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'002',1.00,1122,1,0.000,''),(4,8,1579467102,1579467108,4,1.19,'http://47.240.81.152/mashang/index/callback.do','http://47.240.81.152/index/paofen/automatic.do','http://47.240.81.152/index/paofen/automatic.do',10094,1579467108,'2020012004514285858','112.227.111.167','3759420200120101509',NULL,' ',1,'商户后台回调',0,'app',' ',0.000,1,0.000,0.000,'002',1.00,1122,1,0.000,''),(5,8,1579467709,1579467716,4,1000.26,'http://47.240.81.152/mashang/index/callback.do','http://47.240.81.152/index/paofen/automatic.do','http://47.240.81.152/index/paofen/automatic.do',10094,1579467716,'2020012005012553549','112.227.111.167','1416520200120100565',NULL,' ',1,'商户后台回调',0,'app',' ',0.000,1,0.000,0.000,'002',1000.00,1122,1,0.000,''),(6,8,1579468436,0,2,5.20,'http://aaa.aahcg.cn/dcf/notifyUrl.php','http://aaa.aahcg.cn/dcf/backurl.php?ddh=2020012005135631787','http://aaa.aahcg.cn/dcf/backurl.php?ddh=2020012005135631787',10094,0,'2020012005135631787','112.227.111.167','4588020200120525454',NULL,' ',0,'0',0,'app',' ',0.000,0,0.000,0.000,'002',5.00,10095,1,0.000,'');
/*!40000 ALTER TABLE `xh_client_paofen_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_pay_record`
--

DROP TABLE IF EXISTS `xh_client_pay_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_pay_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `user_id` int(11) DEFAULT '0' COMMENT '用户id  0为系统',
  `pay_note` varchar(128) NOT NULL DEFAULT '' COMMENT '备注信息',
  `types` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单类型 1 微信 2 支付宝',
  `version_code` varchar(32) NOT NULL DEFAULT 'wechat_auto' COMMENT '软件版本',
  `notice` tinyint(1) DEFAULT '0' COMMENT '0 未通知 1 已通知',
  `average` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 普通订单 1 平台系统订单',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='实时交易记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_pay_record`
--

LOCK TABLES `xh_client_pay_record` WRITE;
/*!40000 ALTER TABLE `xh_client_pay_record` DISABLE KEYS */;
INSERT INTO `xh_client_pay_record` VALUES (1,1576738833,9.97,NULL,'[红包转账]ID： - 普通收款，流水号：',2,'alipay_auto',0,0),(2,1576741580,9.97,NULL,'[红包转账]ID： - 普通收款，流水号：',2,'alipay_auto',0,0);
/*!40000 ALTER TABLE `xh_client_pay_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_pddgm_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_pddgm_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_pddgm_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '微信名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '微信登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '微信通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ' COMMENT 'natapp_url',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `ewmurl` varchar(250) NOT NULL,
  `time` int(10) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL DEFAULT '0',
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信全自动版账户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_pddgm_automatic_account`
--

LOCK TABLES `xh_client_pddgm_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_pddgm_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_pddgm_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_pddgm_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_pddgm_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_pddgm_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pddgm_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `trade_no` (`trade_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_pddgm_automatic_orders`
--

LOCK TABLES `xh_client_pddgm_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_pddgm_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_pddgm_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_reduce_account`
--

DROP TABLE IF EXISTS `xh_client_reduce_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_reduce_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '账户名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `types` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 微信 2 支付宝 3 QQ 4 京东 ...',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='简约版';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_reduce_account`
--

LOCK TABLES `xh_client_reduce_account` WRITE;
/*!40000 ALTER TABLE `xh_client_reduce_account` DISABLE KEYS */;
INSERT INTO `xh_client_reduce_account` VALUES (1,'0',1,0,0,0,2,1,0,0);
/*!40000 ALTER TABLE `xh_client_reduce_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_reduce_order`
--

DROP TABLE IF EXISTS `xh_client_reduce_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_reduce_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reduce_id` int(11) NOT NULL DEFAULT '0' COMMENT '账户id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态 1未支付 2订单超时 3已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` int(6) NOT NULL DEFAULT '0' COMMENT '交易验证码（4位）',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `types` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单类型',
  `broadcast` tinyint(1) NOT NULL DEFAULT '0' COMMENT '语音播报，1 已播报',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='简约版订单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_reduce_order`
--

LOCK TABLES `xh_client_reduce_order` WRITE;
/*!40000 ALTER TABLE `xh_client_reduce_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_reduce_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_shouqianba_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_shouqianba_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_shouqianba_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '支付宝名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_user_id` varchar(50) NOT NULL COMMENT '支付宝的ID',
  `account` varchar(150) NOT NULL DEFAULT ' ',
  `pid` varchar(100) NOT NULL,
  `is_hongbao` int(10) NOT NULL DEFAULT '0',
  `app_user` varchar(100) NOT NULL,
  `type` int(10) NOT NULL,
  `area` varchar(100) NOT NULL,
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_shouqianba_automatic_account`
--

LOCK TABLES `xh_client_shouqianba_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_shouqianba_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_shouqianba_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_shouqianba_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_shouqianba_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_shouqianba_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shouqianba_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(250) DEFAULT NULL COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `sqbno` varchar(250) NOT NULL,
  `pno` varchar(250) NOT NULL,
  `type` int(10) NOT NULL,
  `ewmurl` varchar(250) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_shouqianba_automatic_orders`
--

LOCK TABLES `xh_client_shouqianba_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_shouqianba_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_shouqianba_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_taobaodf_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_taobaodf_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_taobaodf_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '微信名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '微信登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '微信通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ' COMMENT 'natapp_url',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `ewmurl` varchar(250) NOT NULL,
  `time` int(10) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL DEFAULT '0',
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信全自动版账户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_taobaodf_automatic_account`
--

LOCK TABLES `xh_client_taobaodf_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_taobaodf_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_taobaodf_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_taobaodf_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_taobaodf_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_taobaodf_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taobaodf_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(255) DEFAULT NULL COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `qrcode_id` int(10) NOT NULL,
  `taobao_orderid` text NOT NULL,
  `key_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `trade_no` (`trade_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_taobaodf_automatic_orders`
--

LOCK TABLES `xh_client_taobaodf_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_taobaodf_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_taobaodf_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_taobaodf_qrcode`
--

DROP TABLE IF EXISTS `xh_client_taobaodf_qrcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_taobaodf_qrcode` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `key_id` varchar(200) NOT NULL,
  `ewm_url` varchar(200) NOT NULL,
  `img_url` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `taobao_orderid` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `addtime` int(10) NOT NULL,
  `hexiaotime` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `suodingtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_taobaodf_qrcode`
--

LOCK TABLES `xh_client_taobaodf_qrcode` WRITE;
/*!40000 ALTER TABLE `xh_client_taobaodf_qrcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_taobaodf_qrcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_user`
--

DROP TABLE IF EXISTS `xh_client_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(18) NOT NULL DEFAULT '' COMMENT '用户名',
  `phone` varchar(12) NOT NULL DEFAULT '13800138000' COMMENT '手机号',
  `pwd` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `balance` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '余额-用作于消费',
  `money` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '金额-用作于提现',
  `yajin` decimal(10,3) NOT NULL,
  `token` varchar(12) NOT NULL DEFAULT '' COMMENT 'token',
  `ip` varchar(16) NOT NULL DEFAULT '8.8.8.8' COMMENT '登录IP',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户组id',
  `level_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级id',
  `login_time` int(11) DEFAULT '0' COMMENT '上次登录时间',
  `avatar` varchar(100) DEFAULT NULL,
  `key_id` varchar(32) DEFAULT '0' COMMENT '商户key',
  `client_id` varchar(50) NOT NULL DEFAULT ' ',
  `bank` text COMMENT '银行卡信息 json',
  `apk_download_num` tinyint(1) NOT NULL DEFAULT '0',
  `is_agent` int(10) NOT NULL,
  `is_pankou` int(10) NOT NULL,
  `is_mashang` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `phone` (`phone`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10097 DEFAULT CHARSET=utf8 COMMENT='用户';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_user`
--

LOCK TABLES `xh_client_user` WRITE;
/*!40000 ALTER TABLE `xh_client_user` DISABLE KEYS */;
INSERT INTO `xh_client_user` VALUES (10093,'daili1','15566666666','40d23c228fb110f191cee3b',110.701,100.000,0.000,'f9cecb98e','117.132.94.203',1,0,1580498725,'0','774393C10BA8AB',' ',NULL,0,1,0,0),(10094,'shanghu1','15566662222','eb9b0094c8b3991a4966b79',20.165,100.000,0.000,'0c6465782','117.132.94.203',6,10093,1580498672,'0','5EEBE86304A4E0',' ',NULL,0,0,0,0),(10095,'pankou1','15566666643','daddf158c0b4d134c0a1f32',35.320,100.000,0.000,'1e53b7971','117.132.94.203',2,10094,1580498709,'0','B83205253588C1',' ','{\"type\":1,\"name\":\"cecece\",\"card\":\"111@qq.com\"}',0,0,1,0),(10096,'mashang1','13877886655','b7e568ab394f71b1f5816d1',0.000,0.000,0.000,'fde4036fe','117.132.94.203',1,0,1580498866,'0','9FEB729370EB98',' ',NULL,0,0,0,1);
/*!40000 ALTER TABLE `xh_client_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_usermoney_log`
--

DROP TABLE IF EXISTS `xh_client_usermoney_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_usermoney_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `username` varchar(250) NOT NULL,
  `agent_id` int(10) NOT NULL,
  `info` varchar(250) NOT NULL,
  `addtime` int(10) NOT NULL,
  `ip` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_usermoney_log`
--

LOCK TABLES `xh_client_usermoney_log` WRITE;
/*!40000 ALTER TABLE `xh_client_usermoney_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_usermoney_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechat_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_wechat_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechat_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '微信名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '微信登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '微信通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ' COMMENT 'natapp_url',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `ewmurl` varchar(250) NOT NULL,
  `time` int(10) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL DEFAULT '0',
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信全自动版账户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechat_automatic_account`
--

LOCK TABLES `xh_client_wechat_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_wechat_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_wechat_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechat_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_wechat_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechat_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wechat_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `trade_no` (`trade_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechat_automatic_orders`
--

LOCK TABLES `xh_client_wechat_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_wechat_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_wechat_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechatbank_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_wechatbank_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechatbank_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '账号名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 开启使用，0关闭',
  `active_time` int(11) DEFAULT '0' COMMENT '最后使用时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(40) NOT NULL DEFAULT '0' COMMENT 'keyId',
  `bank_id` varchar(20) DEFAULT '0',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `natapp_url` varchar(128) NOT NULL DEFAULT '0',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT '0' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_user_id` varchar(50) NOT NULL DEFAULT '0' COMMENT '支付宝的ID',
  `gathering_name` varchar(50) NOT NULL DEFAULT '0' COMMENT '收款名称',
  `cardid` varchar(50) DEFAULT '0' COMMENT 'cardid',
  `account_no` varchar(50) DEFAULT '0' COMMENT '带*卡号',
  `app_user` varchar(200) NOT NULL,
  `area` varchar(200) NOT NULL,
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechatbank_automatic_account`
--

LOCK TABLES `xh_client_wechatbank_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_wechatbank_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_wechatbank_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechatbank_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_wechatbank_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechatbank_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alipay_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `bank_acount` varchar(100) DEFAULT '0',
  `bank_id` varchar(20) DEFAULT '0',
  `gathering_name` varchar(40) DEFAULT '0',
  `bank_name` varchar(40) DEFAULT '0',
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechatbank_automatic_orders`
--

LOCK TABLES `xh_client_wechatbank_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_wechatbank_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_wechatbank_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechatdy_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_wechatdy_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechatdy_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '微信名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '微信登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '微信通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ' COMMENT 'natapp_url',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `ewmurl` varchar(250) NOT NULL,
  `time` int(10) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL DEFAULT '0',
  `max_dd` int(10) NOT NULL,
  `dy_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='微信全自动版账户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechatdy_automatic_account`
--

LOCK TABLES `xh_client_wechatdy_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_wechatdy_automatic_account` DISABLE KEYS */;
INSERT INTO `xh_client_wechatdy_automatic_account` VALUES (1,'',4,0,0,0,10094,'F5764D29EB6D71F44A',' ',2,1,0,' ',NULL,0.000,' ',0.00,0,'wxp://f2f0M7CxDRb2stnBbAS9GYmdg5idnD3AP0Js ',1579607355,'','0',0,'');
/*!40000 ALTER TABLE `xh_client_wechatdy_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechatdy_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_wechatdy_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechatdy_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wechatdy_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `dy_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `trade_no` (`trade_no`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='订单列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechatdy_automatic_orders`
--

LOCK TABLES `xh_client_wechatdy_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_wechatdy_automatic_orders` DISABLE KEYS */;
INSERT INTO `xh_client_wechatdy_automatic_orders` VALUES (1,1,1579607359,0,2,1.14,'https://www.baidu.com','http://47.240.81.152/index/wechatdy/automatic.do','http://47.240.81.152/index/wechatdy/automatic.do',10094,0,'2020012119491977305','117.132.95.207','6079220200121102981','',' ',0,'0',0,0.000,0,0.000,0.000,'','');
/*!40000 ALTER TABLE `xh_client_wechatdy_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechatphone_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_wechatphone_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechatphone_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '微信名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '微信登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '微信通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ' COMMENT 'natapp_url',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `ewmurl` varchar(250) NOT NULL,
  `time` int(10) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL DEFAULT '0',
  `max_dd` int(10) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `account` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信全自动版账户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechatphone_automatic_account`
--

LOCK TABLES `xh_client_wechatphone_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_wechatphone_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_wechatphone_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechatphone_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_wechatphone_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechatphone_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wechatphone_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `trade_no` (`trade_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechatphone_automatic_orders`
--

LOCK TABLES `xh_client_wechatphone_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_wechatphone_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_wechatphone_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechatsj_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_wechatsj_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechatsj_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '微信名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '微信登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '微信通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ' COMMENT 'natapp_url',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `ewmurl` varchar(250) NOT NULL,
  `time` int(10) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL DEFAULT '0',
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='微信全自动版账户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechatsj_automatic_account`
--

LOCK TABLES `xh_client_wechatsj_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_wechatsj_automatic_account` DISABLE KEYS */;
INSERT INTO `xh_client_wechatsj_automatic_account` VALUES (1,'',4,0,0,0,10094,'4062B442607FED52E8',' ',2,1,0,' ',NULL,0.000,' ',0.00,0,'wxp://f2f0M7CxDRb2stnBbAS9GYmdg5idnD3AP0Js ',1579607383,'','0',0);
/*!40000 ALTER TABLE `xh_client_wechatsj_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechatsj_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_wechatsj_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechatsj_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wechatsj_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `trade_no` (`trade_no`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='订单列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechatsj_automatic_orders`
--

LOCK TABLES `xh_client_wechatsj_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_wechatsj_automatic_orders` DISABLE KEYS */;
INSERT INTO `xh_client_wechatsj_automatic_orders` VALUES (1,1,1579607387,0,2,1.13,'https://www.baidu.com','http://47.240.81.152/index/wechatsj/automatic.do','http://47.240.81.152/index/wechatsj/automatic.do',10094,0,'2020012119494761048','117.132.95.207','3718520200121985457','',' ',0,'0',0,0.000,0,0.000,0.000,''),(2,1,1579607719,0,2,1.03,'https://www.baidu.com','http://47.240.81.152/index/wechatsj/automatic.do','http://47.240.81.152/index/wechatsj/automatic.do',10094,0,'2020012119551934936','117.132.95.207','5737920200121559748','',' ',0,'0',0,0.000,0,0.000,0.000,'');
/*!40000 ALTER TABLE `xh_client_wechatsj_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechatzs_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_wechatzs_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechatzs_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '微信名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '微信登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '微信通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `bind_uid` varchar(50) NOT NULL DEFAULT ' ',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `natapp_url` varchar(128) NOT NULL DEFAULT ' ' COMMENT 'natapp_url',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `ewmurl` varchar(250) NOT NULL,
  `time` int(10) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL DEFAULT '0',
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信全自动版账户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechatzs_automatic_account`
--

LOCK TABLES `xh_client_wechatzs_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_wechatzs_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_wechatzs_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_wechatzs_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_wechatzs_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_wechatzs_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wechatzs_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `trade_no` (`trade_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_wechatzs_automatic_orders`
--

LOCK TABLES `xh_client_wechatzs_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_wechatzs_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_wechatzs_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_withdraw`
--

DROP TABLE IF EXISTS `xh_client_withdraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `old_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '旧金额',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `new_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '新金额',
  `types` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 银行处理中 2 银行到账 3 钱款驳回 4 资金异常',
  `content` varchar(255) NOT NULL DEFAULT '0' COMMENT '处理信息',
  `apply_time` int(11) NOT NULL DEFAULT '0' COMMENT '申请时间',
  `date` char(8) NOT NULL DEFAULT '0',
  `deal_time` int(11) NOT NULL DEFAULT '0' COMMENT '处理时间',
  `flow_no` varchar(32) NOT NULL DEFAULT '0' COMMENT '流水号',
  `fees` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `is_notice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否通知过 1已通知  0未通知',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='提现表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_withdraw`
--

LOCK TABLES `xh_client_withdraw` WRITE;
/*!40000 ALTER TABLE `xh_client_withdraw` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_withdraw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_yunshanfu_automatic_account`
--

DROP TABLE IF EXISTS `xh_client_yunshanfu_automatic_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_yunshanfu_automatic_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '账号名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 开启使用，0关闭',
  `active_time` int(11) DEFAULT '0' COMMENT '最后使用时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `key_id` varchar(40) NOT NULL DEFAULT '0' COMMENT 'keyId',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `natapp_url` varchar(128) NOT NULL DEFAULT '0',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT '0' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_no` varchar(50) DEFAULT '0' COMMENT '带*卡号',
  `app_user` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL,
  `max_dd` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_yunshanfu_automatic_account`
--

LOCK TABLES `xh_client_yunshanfu_automatic_account` WRITE;
/*!40000 ALTER TABLE `xh_client_yunshanfu_automatic_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_yunshanfu_automatic_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_yunshanfu_automatic_orders`
--

DROP TABLE IF EXISTS `xh_client_yunshanfu_automatic_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_yunshanfu_automatic_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yunshanfu_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(128) NOT NULL DEFAULT ' ',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(3) NOT NULL DEFAULT 'app' COMMENT '回调来源',
  `requset_data` varchar(1000) NOT NULL DEFAULT ' ',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `reached` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付，1已支付',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `xitong_fees` decimal(10,3) NOT NULL,
  `account_no` varchar(100) DEFAULT '0',
  `app_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_yunshanfu_automatic_orders`
--

LOCK TABLES `xh_client_yunshanfu_automatic_orders` WRITE;
/*!40000 ALTER TABLE `xh_client_yunshanfu_automatic_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_yunshanfu_automatic_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_client_yunshanfu_automatic_orders_no`
--

DROP TABLE IF EXISTS `xh_client_yunshanfu_automatic_orders_no`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_client_yunshanfu_automatic_orders_no` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `bank_acount` varchar(100) DEFAULT '0',
  `time` int(11) DEFAULT '0',
  `status` smallint(2) DEFAULT '0' COMMENT '1 为已确认',
  `pay_time` int(11) DEFAULT '0' COMMENT '补单时间/确认订单时间',
  `fees` decimal(10,2) DEFAULT '0.00' COMMENT '手续费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_client_yunshanfu_automatic_orders_no`
--

LOCK TABLES `xh_client_yunshanfu_automatic_orders_no` WRITE;
/*!40000 ALTER TABLE `xh_client_yunshanfu_automatic_orders_no` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_client_yunshanfu_automatic_orders_no` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_hexiaoma`
--

DROP TABLE IF EXISTS `xh_hexiaoma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_hexiaoma` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) NOT NULL,
  `shopname` varchar(200) NOT NULL,
  `addtime` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_hexiaoma`
--

LOCK TABLES `xh_hexiaoma` WRITE;
/*!40000 ALTER TABLE `xh_hexiaoma` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_hexiaoma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_ip_info`
--

DROP TABLE IF EXISTS `xh_ip_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_ip_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(60) NOT NULL COMMENT 'IP地址',
  `info` varchar(255) NOT NULL COMMENT 'IP信息',
  `create_time` varchar(20) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`),
  UNIQUE KEY `id` (`id`),
  KEY `ip_2` (`ip`),
  KEY `ip_3` (`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=270 DEFAULT CHARSET=utf8 COMMENT='ip信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_ip_info`
--

LOCK TABLES `xh_ip_info` WRITE;
/*!40000 ALTER TABLE `xh_ip_info` DISABLE KEYS */;
INSERT INTO `xh_ip_info` VALUES (1,'127.0.0.1','{\"code\":0,\"data\":{\"ip\":\"127.0.0.1\",\"country\":\"XX\",\"area\":\"\",\"region\":\"XX\",\"city\":\"内网IP\",\"county\":\"内网IP\",\"isp\":\"内网IP\",\"country_id\":\"xx\",\"area_id\":\"\",\"region_id\":\"xx\",\"city_id\":\"local\",\"county_id\":\"local\",\"isp_id\":\"local\"}}','1564066229'),(3,'127.0.0.2','{\"code\":0,\"data\":{\"ip\":\"127.0.0.1\",\"country\":\"XX\",\"area\":\"\",\"region\":\"XX\",\"city\":\"内网IP\",\"county\":\"内网IP\",\"isp\":\"内网IP\",\"country_id\":\"xx\",\"area_id\":\"\",\"region_id\":\"xx\",\"city_id\":\"local\",\"county_id\":\"local\",\"isp_id\":\"local\"}}','1564066985'),(5,'110.157.34.87','{\"code\":0,\"data\":{\"ip\":\"110.157.34.86\",\"country\":\"中国\",\"area\":\"\",\"region\":\"新疆\",\"city\":\"阿克苏\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"650000\",\"city_id\":\"652900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564070422'),(7,'110.157.34.86','{\"code\":0,\"data\":{\"ip\":\"110.157.34.86\",\"country\":\"中国\",\"area\":\"\",\"region\":\"新疆\",\"city\":\"阿克苏\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"650000\",\"city_id\":\"652900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564070956'),(8,'223.104.30.174','{\"code\":0,\"data\":{\"ip\":\"223.104.30.174\",\"country\":\"中国\",\"area\":\"\",\"region\":\"新疆\",\"city\":\"乌鲁木齐\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"650000\",\"city_id\":\"650100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1564151356'),(9,'171.210.186.72','{\"code\":0,\"data\":{\"ip\":\"171.210.186.72\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"成都\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564219080'),(10,'171.213.97.150','{\"code\":0,\"data\":{\"ip\":\"171.213.97.150\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"南充\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"511300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564219125'),(11,'117.136.53.17','{\"code\":0,\"data\":{\"ip\":\"117.136.53.17\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"武汉\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1564540582'),(12,'171.114.82.102','{\"code\":0,\"data\":{\"ip\":\"171.114.82.102\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"宜昌\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420500\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564637393'),(13,'58.19.100.205','{\"code\":0,\"data\":{\"ip\":\"58.19.100.205\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"武汉\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1564642294'),(14,'49.69.58.153','{\"code\":0,\"data\":{\"ip\":\"49.69.58.153\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"盐城\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564642525'),(15,'103.114.91.61','{\"code\":0,\"data\":{\"ip\":\"103.114.91.61\",\"country\":\"柬埔寨\",\"area\":\"\",\"region\":\"XX\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"KH\",\"area_id\":\"\",\"region_id\":\"xx\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}\n','1564642912'),(16,'36.157.21.198','{\"code\":0,\"data\":{\"ip\":\"36.157.21.198\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"郴州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"431000\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1564650019'),(17,'124.114.250.211','{\"code\":0,\"data\":{\"ip\":\"124.114.250.211\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"西安\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564650249'),(18,'183.225.15.133','{\"code\":0,\"data\":{\"ip\":\"183.225.15.133\",\"country\":\"中国\",\"area\":\"\",\"region\":\"云南\",\"city\":\"昆明\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"530000\",\"city_id\":\"530100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1564652152'),(19,'222.139.133.196','{\"code\":0,\"data\":{\"ip\":\"222.139.133.196\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"新乡\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410700\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1564652771'),(20,'36.98.194.1','{\"code\":0,\"data\":{\"ip\":\"36.98.194.1\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河北\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"130000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564656093'),(21,'::ffff:36.98.194.1','{\"code\":0,\"data\":[]}','1564656120'),(22,'122.117.20.188','{\"code\":0,\"data\":{\"ip\":\"122.117.20.188\",\"country\":\"中国\",\"area\":\"\",\"region\":\"台湾\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"中华电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"710000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100088\"}}','1564660280'),(24,'183.93.206.32','{\"code\":0,\"data\":{\"ip\":\"183.93.206.32\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"宜昌\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420500\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1564662280'),(26,'171.115.67.192','{\"code\":0,\"data\":{\"ip\":\"171.115.67.192\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"恩施\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"422800\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564664625'),(27,'113.94.156.63','{\"code\":0,\"data\":{\"ip\":\"113.94.156.63\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"阳江\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"441700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564667065'),(28,'27.189.203.93','{\"code\":0,\"data\":{\"ip\":\"27.189.203.93\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河北\",\"city\":\"廊坊\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"130000\",\"city_id\":\"131000\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564668000'),(29,'223.91.198.128','{\"code\":0,\"data\":{\"ip\":\"223.91.198.128\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"新乡\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410700\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1564669996'),(30,'222.135.72.53','{\"code\":0,\"data\":{\"ip\":\"222.135.72.53\",\"country\":\"中国\",\"area\":\"\",\"region\":\"山东\",\"city\":\"威海\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"370000\",\"city_id\":\"371000\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1564677626'),(31,'111.19.106.185','{\"code\":0,\"data\":{\"ip\":\"111.19.106.185\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"渭南\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610500\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1564685674'),(32,'::ffff:218.204.3.33','{\"code\":0,\"data\":[]}','1564697607'),(33,'115.198.40.198','{\"code\":0,\"data\":{\"ip\":\"115.198.40.198\",\"country\":\"中国\",\"area\":\"\",\"region\":\"浙江\",\"city\":\"杭州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"330000\",\"city_id\":\"330100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564709589'),(34,'122.190.208.164','{\"code\":0,\"data\":{\"ip\":\"122.190.208.164\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"宜昌\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420500\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1564715174'),(35,'218.189.125.130','{\"code\":0,\"data\":{\"ip\":\"218.189.125.130\",\"country\":\"中国\",\"area\":\"\",\"region\":\"香港\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"810000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}','1564726232'),(36,'117.184.168.62','{\"code\":0,\"data\":{\"ip\":\"117.184.168.62\",\"country\":\"中国\",\"area\":\"\",\"region\":\"上海\",\"city\":\"上海\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"310000\",\"city_id\":\"310100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1564737806'),(37,'222.173.28.150','{\"code\":0,\"data\":{\"ip\":\"222.173.28.150\",\"country\":\"中国\",\"area\":\"\",\"region\":\"山东\",\"city\":\"济南\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"370000\",\"city_id\":\"370100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564738594'),(38,'119.86.47.72','{\"code\":0,\"data\":{\"ip\":\"119.86.47.72\",\"country\":\"中国\",\"area\":\"\",\"region\":\"重庆\",\"city\":\"重庆\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"500000\",\"city_id\":\"500100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564746560'),(39,'49.88.70.48','{\"code\":0,\"data\":{\"ip\":\"49.88.70.48\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"连云港\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564750341'),(40,'103.119.98.187','{\"code\":0,\"data\":{\"ip\":\"103.119.98.187\",\"country\":\"柬埔寨\",\"area\":\"\",\"region\":\"XX\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"KH\",\"area_id\":\"\",\"region_id\":\"xx\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}\n','1564750471'),(41,'36.251.162.94','{\"code\":0,\"data\":{\"ip\":\"36.251.162.94\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"泉州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350500\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1564751074'),(42,'223.104.90.29','{\"code\":0,\"data\":{\"ip\":\"223.104.90.29\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广西\",\"city\":\"南宁\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"450000\",\"city_id\":\"450100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1564765570'),(43,'36.157.11.225','{\"code\":0,\"data\":{\"ip\":\"36.157.11.225\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"郴州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"431000\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1564768982'),(44,'113.66.237.95','{\"code\":0,\"data\":{\"ip\":\"113.66.237.95\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"广州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564780844'),(45,'61.144.102.137','{\"code\":0,\"data\":{\"ip\":\"61.144.102.137\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"广州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564781173'),(46,'113.69.198.191','{\"code\":0,\"data\":{\"ip\":\"113.69.198.191\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"佛山\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440600\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564783694'),(47,'110.90.178.90','{\"code\":0,\"data\":{\"ip\":\"110.90.178.90\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"宁德\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564796902'),(48,'113.118.226.219','{\"code\":0,\"data\":{\"ip\":\"113.118.226.219\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"深圳\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564799065'),(49,'223.152.214.243','{\"code\":0,\"data\":{\"ip\":\"223.152.214.243\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"郴州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"431000\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564808137'),(50,'113.94.156.32','{\"code\":0,\"data\":{\"ip\":\"113.94.156.32\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"阳江\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"441700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564812910'),(51,'140.243.220.43','{\"code\":0,\"data\":{\"ip\":\"140.243.220.43\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"福州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564819424'),(53,'49.88.71.220','{\"code\":0,\"data\":{\"ip\":\"49.88.71.220\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"连云港\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564820609'),(54,'125.79.202.55','{\"code\":0,\"data\":{\"ip\":\"125.79.202.55\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"南平\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564832898'),(55,'1.80.129.202','{\"code\":0,\"data\":{\"ip\":\"1.80.129.202\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"西安\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564834490'),(56,'125.84.177.26','{\"code\":0,\"data\":{\"ip\":\"125.84.177.26\",\"country\":\"中国\",\"area\":\"\",\"region\":\"重庆\",\"city\":\"重庆\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"500000\",\"city_id\":\"500100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564835596'),(57,'118.114.104.229','{\"code\":0,\"data\":{\"ip\":\"118.114.104.229\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"成都\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564845050'),(58,'183.160.245.244','{\"code\":0,\"data\":{\"ip\":\"183.160.245.244\",\"country\":\"中国\",\"area\":\"\",\"region\":\"安徽\",\"city\":\"合肥\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"340000\",\"city_id\":\"340100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564850085'),(59,'223.104.175.108','{\"code\":0,\"data\":{\"ip\":\"223.104.175.108\",\"country\":\"中国\",\"area\":\"\",\"region\":\"辽宁\",\"city\":\"沈阳\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"210000\",\"city_id\":\"210100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1564859859'),(60,'223.152.109.227','{\"code\":0,\"data\":{\"ip\":\"223.152.109.227\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"郴州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"431000\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564863179'),(61,'223.214.239.184','{\"code\":0,\"data\":{\"ip\":\"223.214.239.184\",\"country\":\"中国\",\"area\":\"\",\"region\":\"安徽\",\"city\":\"滁州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"340000\",\"city_id\":\"341100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564878170'),(62,'42.226.113.70','{\"code\":0,\"data\":{\"ip\":\"42.226.113.70\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"新乡\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410700\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1564897973'),(63,'106.112.46.93','{\"code\":0,\"data\":{\"ip\":\"106.112.46.93\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河北\",\"city\":\"承德\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"130000\",\"city_id\":\"130800\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564906591'),(64,'193.8.80.121','{\"code\":0,\"data\":{\"ip\":\"193.8.80.121\",\"country\":\"中国\",\"area\":\"\",\"region\":\"香港\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"810000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}\n','1564911408'),(65,'122.190.208.169','{\"code\":0,\"data\":{\"ip\":\"122.190.208.169\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"宜昌\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420500\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1564911674'),(66,'27.154.201.254','{\"code\":0,\"data\":{\"ip\":\"27.154.201.254\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"厦门\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350200\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564915063'),(67,'182.61.185.44','{\"code\":0,\"data\":{\"ip\":\"182.61.185.44\",\"country\":\"中国\",\"area\":\"\",\"region\":\"香港\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"810000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1564915212'),(68,'125.81.23.1','{\"code\":0,\"data\":{\"ip\":\"125.81.23.1\",\"country\":\"中国\",\"area\":\"\",\"region\":\"重庆\",\"city\":\"重庆\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"500000\",\"city_id\":\"500100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564931766'),(69,'36.42.241.217','{\"code\":0,\"data\":{\"ip\":\"36.42.241.217\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"渭南\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610500\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564934083'),(70,'221.234.240.12','{\"code\":0,\"data\":{\"ip\":\"221.234.240.12\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"武汉\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564936043'),(71,'180.123.77.186','{\"code\":0,\"data\":{\"ip\":\"180.123.77.186\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"徐州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564941092'),(72,'171.83.85.27','{\"code\":0,\"data\":{\"ip\":\"171.83.85.27\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"武汉\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564950006'),(73,'49.81.98.161','{\"code\":0,\"data\":{\"ip\":\"49.81.98.161\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"徐州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564958490'),(74,'112.206.146.45','{\"code\":0,\"data\":{\"ip\":\"112.206.146.45\",\"country\":\"菲律宾\",\"area\":\"\",\"region\":\"奎松省\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"菲律宾长途电话公司\",\"country_id\":\"PH\",\"area_id\":\"\",\"region_id\":\"PH_H2\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"300014\"}}\n','1564980412'),(75,'171.113.155.82','{\"code\":0,\"data\":{\"ip\":\"171.113.155.82\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"武汉\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564981136'),(76,'112.97.166.222','{\"code\":0,\"data\":{\"ip\":\"112.97.166.222\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"东莞\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"441900\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1564982732'),(77,'59.175.38.169','{\"code\":0,\"data\":{\"ip\":\"59.175.38.169\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"武汉\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564987460'),(78,'115.60.134.2','{\"code\":0,\"data\":{\"ip\":\"115.60.134.2\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"郑州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1564989559'),(79,'223.104.249.239','{\"code\":0,\"data\":{\"ip\":\"223.104.249.239\",\"country\":\"中国\",\"area\":\"\",\"region\":\"重庆\",\"city\":\"重庆\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"500000\",\"city_id\":\"500100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1564990604'),(80,'120.33.148.169','{\"code\":0,\"data\":{\"ip\":\"120.33.148.169\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"泉州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350500\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1564993696'),(81,'120.230.92.207','{\"code\":0,\"data\":{\"ip\":\"120.230.92.207\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"广州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1564994181'),(82,'203.90.248.218','{\"code\":0,\"data\":{\"ip\":\"203.90.248.218\",\"country\":\"中国\",\"area\":\"\",\"region\":\"香港\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"810000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}','1564996395'),(83,'115.205.14.162','{\"code\":0,\"data\":{\"ip\":\"115.205.14.162\",\"country\":\"中国\",\"area\":\"\",\"region\":\"浙江\",\"city\":\"杭州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"330000\",\"city_id\":\"330100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1564999788'),(85,'114.236.138.133','{\"code\":0,\"data\":{\"ip\":\"114.236.138.133\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"盐城\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565004484'),(86,'112.97.215.45','{\"code\":0,\"data\":{\"ip\":\"112.97.215.45\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"东莞\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"441900\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565004861'),(87,'110.73.6.171','{\"code\":0,\"data\":{\"ip\":\"110.73.6.171\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广西\",\"city\":\"防城港\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"450000\",\"city_id\":\"450600\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565005997'),(88,'103.114.91.54','{\"code\":0,\"data\":{\"ip\":\"103.114.91.54\",\"country\":\"柬埔寨\",\"area\":\"\",\"region\":\"XX\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"KH\",\"area_id\":\"\",\"region_id\":\"xx\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}\n','1565006007'),(89,'49.67.223.53','{\"code\":0,\"data\":{\"ip\":\"49.67.223.53\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"南通\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320600\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565006523'),(90,'180.162.151.48','{\"code\":0,\"data\":{\"ip\":\"180.162.151.48\",\"country\":\"中国\",\"area\":\"\",\"region\":\"上海\",\"city\":\"上海\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"310000\",\"city_id\":\"310100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565007158'),(91,'211.97.130.99','{\"code\":0,\"data\":{\"ip\":\"211.97.130.99\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"厦门\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350200\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565010654'),(92,'103.30.199.32','{\"code\":0,\"data\":{\"ip\":\"103.30.199.32\",\"country\":\"柬埔寨\",\"area\":\"\",\"region\":\"金边\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"Ezecom\",\"country_id\":\"KH\",\"area_id\":\"\",\"region_id\":\"KH_1009\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"30002022\"}}\n','1565010956'),(93,'47.244.54.60','{\"code\":0,\"data\":{\"ip\":\"47.244.54.60\",\"country\":\"中国\",\"area\":\"\",\"region\":\"香港\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"阿里云\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"810000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"1000323\"}}\n','1565011559'),(95,'113.246.228.73','{\"code\":0,\"data\":{\"ip\":\"113.246.228.73\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"长沙\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"430100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565014674'),(96,'113.57.27.248','{\"code\":0,\"data\":{\"ip\":\"113.57.27.248\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"武汉\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565016953'),(97,'58.47.234.146','{\"code\":0,\"data\":{\"ip\":\"58.47.234.146\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"益阳\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"430900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565023408'),(98,'117.140.174.132','{\"code\":0,\"data\":{\"ip\":\"117.140.174.132\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广西\",\"city\":\"百色\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"450000\",\"city_id\":\"451000\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565025026'),(99,'223.104.6.75','{\"code\":0,\"data\":{\"ip\":\"223.104.6.75\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"厦门\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350200\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565026894'),(100,'61.150.84.187','{\"code\":0,\"data\":{\"ip\":\"61.150.84.187\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"渭南\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610500\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565047633'),(101,'125.40.26.170','{\"code\":0,\"data\":{\"ip\":\"125.40.26.170\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"郑州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565054317'),(102,'114.87.101.6','{\"code\":0,\"data\":{\"ip\":\"114.87.101.6\",\"country\":\"中国\",\"area\":\"\",\"region\":\"上海\",\"city\":\"上海\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"310000\",\"city_id\":\"310100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565065215'),(103,'123.245.242.194','{\"code\":0,\"data\":{\"ip\":\"123.245.242.194\",\"country\":\"中国\",\"area\":\"\",\"region\":\"辽宁\",\"city\":\"锦州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"210000\",\"city_id\":\"210700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565075637'),(104,'223.104.30.92','{\"code\":0,\"data\":{\"ip\":\"223.104.30.92\",\"country\":\"中国\",\"area\":\"\",\"region\":\"新疆\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"650000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565078515'),(105,'171.212.198.183','{\"code\":0,\"data\":{\"ip\":\"171.212.198.183\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"成都\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565078579'),(106,'116.132.15.166','{\"code\":0,\"data\":{\"ip\":\"116.132.15.166\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河北\",\"city\":\"邯郸\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"130000\",\"city_id\":\"130400\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565079226'),(107,'14.113.14.231','{\"code\":0,\"data\":{\"ip\":\"14.113.14.231\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"阳江\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"441700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565082800'),(108,'36.57.129.76','{\"code\":0,\"data\":{\"ip\":\"36.57.129.76\",\"country\":\"中国\",\"area\":\"\",\"region\":\"安徽\",\"city\":\"合肥\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"340000\",\"city_id\":\"340100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565083031'),(109,'220.249.162.154','{\"code\":0,\"data\":{\"ip\":\"220.249.162.154\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"福州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565084655'),(110,'106.17.3.153','{\"code\":0,\"data\":{\"ip\":\"106.17.3.153\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"长沙\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"430100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565092513'),(111,'118.114.12.159','{\"code\":0,\"data\":{\"ip\":\"118.114.12.159\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"成都\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565092540'),(112,'125.71.154.96','{\"code\":0,\"data\":{\"ip\":\"125.71.154.96\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"成都\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565092754'),(113,'119.178.113.222','{\"code\":0,\"data\":{\"ip\":\"119.178.113.222\",\"country\":\"中国\",\"area\":\"\",\"region\":\"山东\",\"city\":\"聊城\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"370000\",\"city_id\":\"371500\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565095734'),(114,'61.134.39.146','{\"code\":0,\"data\":{\"ip\":\"61.134.39.146\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"汉中\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565099556'),(115,'117.136.29.141','{\"code\":0,\"data\":{\"ip\":\"117.136.29.141\",\"country\":\"中国\",\"area\":\"\",\"region\":\"青海\",\"city\":\"西宁\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"630000\",\"city_id\":\"630100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565102125'),(116,'47.52.114.175','{\"code\":0,\"data\":{\"ip\":\"47.52.114.175\",\"country\":\"中国\",\"area\":\"\",\"region\":\"香港\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"阿里云\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"810000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"1000323\"}}','1565102720'),(117,'36.27.219.233','{\"code\":0,\"data\":{\"ip\":\"36.27.219.233\",\"country\":\"中国\",\"area\":\"\",\"region\":\"浙江\",\"city\":\"金华\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"330000\",\"city_id\":\"330700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565102820'),(118,'222.210.42.243','{\"code\":0,\"data\":{\"ip\":\"222.210.42.243\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"成都\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565103256'),(119,'14.204.135.65','{\"code\":0,\"data\":{\"ip\":\"14.204.135.65\",\"country\":\"中国\",\"area\":\"\",\"region\":\"云南\",\"city\":\"西双版纳\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"530000\",\"city_id\":\"532800\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565103330'),(120,'27.209.158.155','{\"code\":0,\"data\":{\"ip\":\"27.209.158.155\",\"country\":\"中国\",\"area\":\"\",\"region\":\"山东\",\"city\":\"滨州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"370000\",\"city_id\":\"371600\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565103457'),(121,'121.207.204.73','{\"code\":0,\"data\":{\"ip\":\"121.207.204.73\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"福州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565103564'),(122,'97.64.19.70','{\"code\":0,\"data\":{\"ip\":\"97.64.19.70\",\"country\":\"美国\",\"area\":\"\",\"region\":\"加利福尼亚\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"US\",\"area_id\":\"\",\"region_id\":\"US_104\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}\n','1565110266'),(123,'113.94.156.187','{\"code\":0,\"data\":{\"ip\":\"113.94.156.187\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"阳江\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"441700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565112340'),(124,'123.5.158.254','{\"code\":0,\"data\":{\"ip\":\"123.5.158.254\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"洛阳\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410300\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565146196'),(126,'171.43.252.115','{\"code\":0,\"data\":{\"ip\":\"171.43.252.115\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"武汉\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565149602'),(127,'114.236.138.129','{\"code\":0,\"data\":{\"ip\":\"114.236.138.129\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"盐城\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565153523'),(128,'117.136.11.170','{\"code\":0,\"data\":{\"ip\":\"117.136.11.170\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"泉州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350500\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565155182'),(129,'211.97.129.59','{\"code\":0,\"data\":{\"ip\":\"211.97.129.59\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"厦门\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350200\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565155381'),(130,'182.148.25.164','{\"code\":0,\"data\":{\"ip\":\"182.148.25.164\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"成都\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565156963'),(131,'114.236.138.132','{\"code\":0,\"data\":{\"ip\":\"114.236.138.132\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"盐城\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565167197'),(132,'115.148.239.70','{\"code\":0,\"data\":{\"ip\":\"115.148.239.70\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江西\",\"city\":\"南昌\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"360000\",\"city_id\":\"360100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565169087'),(133,'43.250.201.88','{\"code\":0,\"data\":{\"ip\":\"43.250.201.88\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"长沙\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"430100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565169370'),(134,'216.24.186.26','{\"code\":0,\"data\":{\"ip\":\"216.24.186.26\",\"country\":\"美国\",\"area\":\"\",\"region\":\"加利福尼亚\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"US\",\"area_id\":\"\",\"region_id\":\"US_104\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}','1565186608'),(135,'219.138.221.198','{\"code\":0,\"data\":{\"ip\":\"219.138.221.198\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"鄂州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565198087'),(136,'183.226.146.150','{\"code\":0,\"data\":{\"ip\":\"183.226.146.150\",\"country\":\"中国\",\"area\":\"\",\"region\":\"重庆\",\"city\":\"重庆\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"500000\",\"city_id\":\"500100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565198305'),(137,'115.197.217.246','{\"code\":0,\"data\":{\"ip\":\"115.197.217.246\",\"country\":\"中国\",\"area\":\"\",\"region\":\"浙江\",\"city\":\"杭州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"330000\",\"city_id\":\"330100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565220294'),(138,'171.106.196.82','{\"code\":0,\"data\":{\"ip\":\"171.106.196.82\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广西\",\"city\":\"贵港\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"450000\",\"city_id\":\"450800\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565225165'),(139,'119.54.85.0','{\"code\":0,\"data\":{\"ip\":\"119.54.85.0\",\"country\":\"中国\",\"area\":\"\",\"region\":\"吉林\",\"city\":\"四平\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"220000\",\"city_id\":\"220300\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565233224'),(140,'125.77.82.251','{\"code\":0,\"data\":{\"ip\":\"125.77.82.251\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"福州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565234786'),(141,'60.180.28.240','{\"code\":0,\"data\":{\"ip\":\"60.180.28.240\",\"country\":\"中国\",\"area\":\"\",\"region\":\"浙江\",\"city\":\"温州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"330000\",\"city_id\":\"330300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565234979'),(142,'112.19.111.100','{\"code\":0,\"data\":{\"ip\":\"112.19.111.100\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"宜宾\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"511500\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565248378'),(143,'221.233.253.90','{\"code\":0,\"data\":{\"ip\":\"221.233.253.90\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565252009'),(144,'183.226.147.158','{\"code\":0,\"data\":{\"ip\":\"183.226.147.158\",\"country\":\"中国\",\"area\":\"\",\"region\":\"重庆\",\"city\":\"重庆\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"500000\",\"city_id\":\"500100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565257994'),(145,'182.111.237.253','{\"code\":0,\"data\":{\"ip\":\"182.111.237.253\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江西\",\"city\":\"九江\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"360000\",\"city_id\":\"360400\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565274863'),(146,'49.159.212.251','{\"code\":0,\"data\":{\"ip\":\"49.159.212.251\",\"country\":\"中国\",\"area\":\"\",\"region\":\"台湾\",\"city\":\"高雄\",\"county\":\"XX\",\"isp\":\"台湾固网\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"710000\",\"city_id\":\"TW_1006\",\"county_id\":\"xx\",\"isp_id\":\"3000674\"}}\n','1565275642'),(147,'218.164.109.218','{\"code\":0,\"data\":{\"ip\":\"218.164.109.218\",\"country\":\"中国\",\"area\":\"\",\"region\":\"台湾\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"中华电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"710000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100088\"}}','1565276754'),(148,'103.254.208.93','{\"code\":0,\"data\":{\"ip\":\"103.254.208.93\",\"country\":\"中国\",\"area\":\"\",\"region\":\"香港\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"810000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}','1565276778'),(149,'119.39.248.83','{\"code\":0,\"data\":{\"ip\":\"119.39.248.83\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"长沙\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"430100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565285303'),(150,'117.136.89.238','{\"code\":0,\"data\":{\"ip\":\"117.136.89.238\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"常德\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"430700\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565285310'),(152,'43.250.201.11','{\"code\":0,\"data\":{\"ip\":\"43.250.201.11\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"长沙\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"430100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565285352'),(153,'221.3.223.137','{\"code\":0,\"data\":{\"ip\":\"221.3.223.137\",\"country\":\"中国\",\"area\":\"\",\"region\":\"云南\",\"city\":\"文山\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"530000\",\"city_id\":\"532600\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565325977'),(154,'36.237.76.63','{\"code\":0,\"data\":{\"ip\":\"36.237.76.63\",\"country\":\"中国\",\"area\":\"\",\"region\":\"台湾\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"中华电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"710000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100088\"}}\n','1565328519'),(155,'221.229.135.172','{\"code\":0,\"data\":{\"ip\":\"221.229.135.172\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"徐州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565335036'),(156,'124.217.189.27','{\"code\":0,\"data\":{\"ip\":\"124.217.189.27\",\"country\":\"中国\",\"area\":\"\",\"region\":\"香港\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"810000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}\n','1565339172'),(157,'36.158.74.4','{\"code\":0,\"data\":{\"ip\":\"36.158.74.4\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"邵阳\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"430500\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565339477'),(158,'14.121.157.68','{\"code\":0,\"data\":{\"ip\":\"14.121.157.68\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"阳江\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"441700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565351325'),(160,'121.206.180.202','{\"code\":0,\"data\":{\"ip\":\"121.206.180.202\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"三明\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350400\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565361248'),(161,'125.46.213.120','{\"code\":0,\"data\":{\"ip\":\"125.46.213.120\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"郑州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565361566'),(162,'223.104.30.239','{\"code\":0,\"data\":{\"ip\":\"223.104.30.239\",\"country\":\"中国\",\"area\":\"\",\"region\":\"新疆\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"650000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565361713'),(163,'49.90.62.178','{\"code\":0,\"data\":{\"ip\":\"49.90.62.178\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"南京\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565365451'),(164,'110.157.32.252','{\"code\":0,\"data\":{\"ip\":\"110.157.32.252\",\"country\":\"中国\",\"area\":\"\",\"region\":\"新疆\",\"city\":\"阿克苏\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"650000\",\"city_id\":\"652900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565366361'),(165,'1.172.212.75','{\"code\":0,\"data\":{\"ip\":\"1.172.212.75\",\"country\":\"中国\",\"area\":\"\",\"region\":\"台湾\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"中华电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"710000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100088\"}}\n','1565366874'),(166,'202.124.35.130','{\"code\":0,\"data\":{\"ip\":\"202.124.35.130\",\"country\":\"柬埔寨\",\"area\":\"\",\"region\":\"XX\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"KH\",\"area_id\":\"\",\"region_id\":\"xx\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}','1565369624'),(167,'180.190.46.35','{\"code\":0,\"data\":{\"ip\":\"180.190.46.35\",\"country\":\"菲律宾\",\"area\":\"\",\"region\":\"奎松省\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"Globe-Telecom\",\"country_id\":\"PH\",\"area_id\":\"\",\"region_id\":\"PH_H2\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"30002039\"}}','1565373166'),(168,'39.13.98.67','{\"code\":0,\"data\":{\"ip\":\"39.13.98.67\",\"country\":\"中国\",\"area\":\"\",\"region\":\"台湾\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"远传电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"710000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100069\"}}','1565373466'),(169,'124.114.250.61','{\"code\":0,\"data\":{\"ip\":\"124.114.250.61\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"西安\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565373710'),(170,'27.47.154.198','{\"code\":0,\"data\":{\"ip\":\"27.47.154.198\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"广州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565379799'),(171,'183.225.149.151','{\"code\":0,\"data\":{\"ip\":\"183.225.149.151\",\"country\":\"中国\",\"area\":\"\",\"region\":\"云南\",\"city\":\"文山\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"530000\",\"city_id\":\"532600\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565392433'),(172,'1.81.171.124','{\"code\":0,\"data\":{\"ip\":\"1.81.171.124\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"汉中\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565401156'),(173,'218.173.163.61','{\"code\":0,\"data\":{\"ip\":\"218.173.163.61\",\"country\":\"中国\",\"area\":\"\",\"region\":\"台湾\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"中华电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"710000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"100088\"}}','1565401275'),(174,'36.62.191.206','{\"code\":0,\"data\":{\"ip\":\"36.62.191.206\",\"country\":\"中国\",\"area\":\"\",\"region\":\"安徽\",\"city\":\"滁州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"340000\",\"city_id\":\"341100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565401562'),(175,'125.46.214.233','{\"code\":0,\"data\":{\"ip\":\"125.46.214.233\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"郑州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565411814'),(176,'39.149.3.9','{\"code\":0,\"data\":{\"ip\":\"39.149.3.9\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"郑州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565412920'),(177,'112.97.218.148','{\"code\":0,\"data\":{\"ip\":\"112.97.218.148\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"东莞\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"441900\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565413312'),(178,'223.104.45.101','{\"code\":0,\"data\":{\"ip\":\"223.104.45.101\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"泉州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350500\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565418419'),(179,'113.94.156.118','{\"code\":0,\"data\":{\"ip\":\"113.94.156.118\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"阳江\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"441700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565419553'),(180,'183.39.156.103','{\"code\":0,\"data\":{\"ip\":\"183.39.156.103\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"深圳\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565419578'),(181,'113.61.49.87','{\"code\":0,\"data\":{\"ip\":\"113.61.49.87\",\"country\":\"菲律宾\",\"area\":\"\",\"region\":\"XX\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"PH\",\"area_id\":\"\",\"region_id\":\"xx\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}\n','1565425764'),(182,'113.251.17.218','{\"code\":0,\"data\":{\"ip\":\"113.251.17.218\",\"country\":\"中国\",\"area\":\"\",\"region\":\"重庆\",\"city\":\"重庆\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"500000\",\"city_id\":\"500100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565426981'),(183,'183.251.39.60','{\"code\":0,\"data\":{\"ip\":\"183.251.39.60\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"漳州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350600\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565427220'),(184,'140.243.207.82','{\"code\":0,\"data\":{\"ip\":\"140.243.207.82\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"福州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565429127'),(185,'113.110.184.9','{\"code\":0,\"data\":{\"ip\":\"113.110.184.9\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"深圳\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565430029'),(186,'183.15.205.106','{\"code\":0,\"data\":{\"ip\":\"183.15.205.106\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"深圳\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565431954'),(188,'183.199.23.111','{\"code\":0,\"data\":{\"ip\":\"183.199.23.111\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河北\",\"city\":\"保定\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"130000\",\"city_id\":\"130600\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565431971'),(189,'120.33.149.27','{\"code\":0,\"data\":{\"ip\":\"120.33.149.27\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"泉州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350500\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565432323'),(190,'117.136.12.109','{\"code\":0,\"data\":{\"ip\":\"117.136.12.109\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"佛山\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440600\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565432755'),(191,'183.0.182.194','{\"code\":0,\"data\":{\"ip\":\"183.0.182.194\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"茂名\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565433076'),(192,'123.139.113.26','{\"code\":0,\"data\":{\"ip\":\"123.139.113.26\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"西安\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565434202'),(193,'119.36.12.105','{\"code\":0,\"data\":{\"ip\":\"119.36.12.105\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"荆门\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420800\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565434604'),(195,'124.238.169.122','{\"code\":0,\"data\":{\"ip\":\"124.238.169.122\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河北\",\"city\":\"廊坊\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"130000\",\"city_id\":\"131000\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565436323'),(197,'112.94.117.247','{\"code\":0,\"data\":{\"ip\":\"112.94.117.247\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"广州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565441462'),(198,'182.139.76.198','{\"code\":0,\"data\":{\"ip\":\"182.139.76.198\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"成都\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565445669'),(199,'117.43.68.40','{\"code\":0,\"data\":{\"ip\":\"117.43.68.40\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江西\",\"city\":\"南昌\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"360000\",\"city_id\":\"360100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565447159'),(200,'119.181.106.13','{\"code\":0,\"data\":{\"ip\":\"119.181.106.13\",\"country\":\"中国\",\"area\":\"\",\"region\":\"山东\",\"city\":\"济宁\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"370000\",\"city_id\":\"370800\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565448155'),(202,'58.62.167.252','{\"code\":0,\"data\":{\"ip\":\"58.62.167.252\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"广州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565451039'),(204,'122.97.174.45','{\"code\":0,\"data\":{\"ip\":\"122.97.174.45\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"南京\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}','1565454027'),(205,'112.32.76.44','{\"code\":0,\"data\":{\"ip\":\"112.32.76.44\",\"country\":\"中国\",\"area\":\"\",\"region\":\"安徽\",\"city\":\"合肥\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"340000\",\"city_id\":\"340100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565471424'),(206,'106.119.72.236','{\"code\":0,\"data\":{\"ip\":\"106.119.72.236\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河北\",\"city\":\"邯郸\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"130000\",\"city_id\":\"130400\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565478144'),(207,'182.142.33.108','{\"code\":0,\"data\":{\"ip\":\"182.142.33.108\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"广安\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"511600\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565491989'),(208,'115.203.195.147','{\"code\":0,\"data\":{\"ip\":\"115.203.195.147\",\"country\":\"中国\",\"area\":\"\",\"region\":\"浙江\",\"city\":\"台州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"330000\",\"city_id\":\"331000\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565498565'),(209,'118.181.0.225','{\"code\":0,\"data\":{\"ip\":\"118.181.0.225\",\"country\":\"中国\",\"area\":\"\",\"region\":\"甘肃\",\"city\":\"酒泉\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"620000\",\"city_id\":\"620900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565500762'),(210,'115.60.199.132','{\"code\":0,\"data\":{\"ip\":\"115.60.199.132\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"郑州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565502637'),(211,'183.202.107.188','{\"code\":0,\"data\":{\"ip\":\"183.202.107.188\",\"country\":\"中国\",\"area\":\"\",\"region\":\"山西\",\"city\":\"忻州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"140000\",\"city_id\":\"140900\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565505330'),(212,'140.243.86.97','{\"code\":0,\"data\":{\"ip\":\"140.243.86.97\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"福州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565519497'),(213,'183.160.219.29','{\"code\":0,\"data\":{\"ip\":\"183.160.219.29\",\"country\":\"中国\",\"area\":\"\",\"region\":\"安徽\",\"city\":\"合肥\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"340000\",\"city_id\":\"340100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565522701'),(214,'220.166.2.153','{\"code\":0,\"data\":{\"ip\":\"220.166.2.153\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"德阳\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510600\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565528935'),(215,'223.73.123.103','{\"code\":0,\"data\":{\"ip\":\"223.73.123.103\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"广州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565529184'),(216,'203.90.239.2','{\"code\":0,\"data\":{\"ip\":\"203.90.239.2\",\"country\":\"中国\",\"area\":\"\",\"region\":\"香港\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"810000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}','1565530701'),(217,'60.223.105.81','{\"code\":0,\"data\":{\"ip\":\"60.223.105.81\",\"country\":\"中国\",\"area\":\"\",\"region\":\"山西\",\"city\":\"晋中\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"140000\",\"city_id\":\"140700\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565535285'),(219,'49.68.194.82','{\"code\":0,\"data\":{\"ip\":\"49.68.194.82\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"徐州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565544454'),(220,'223.95.44.207','{\"code\":0,\"data\":{\"ip\":\"223.95.44.207\",\"country\":\"中国\",\"area\":\"\",\"region\":\"浙江\",\"city\":\"金华\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"330000\",\"city_id\":\"330700\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565546374'),(221,'103.228.209.10','{\"code\":0,\"data\":{\"ip\":\"103.228.209.10\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广西\",\"city\":\"南宁\",\"county\":\"XX\",\"isp\":\"广西广电\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"450000\",\"city_id\":\"450100\",\"county_id\":\"xx\",\"isp_id\":\"2000867\"}}\n','1565548424'),(222,'113.240.175.130','{\"code\":0,\"data\":{\"ip\":\"113.240.175.130\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"长沙\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"430100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565551223'),(223,'111.29.255.65','{\"code\":0,\"data\":{\"ip\":\"111.29.255.65\",\"country\":\"中国\",\"area\":\"\",\"region\":\"海南\",\"city\":\"海口\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"460000\",\"city_id\":\"460100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565560818'),(224,'58.255.233.102','{\"code\":0,\"data\":{\"ip\":\"58.255.233.102\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"茂名\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440900\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565587192'),(225,'103.120.133.230','{\"code\":0,\"data\":{\"ip\":\"103.120.133.230\",\"country\":\"柬埔寨\",\"area\":\"\",\"region\":\"XX\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"湄公网\",\"country_id\":\"KH\",\"area_id\":\"\",\"region_id\":\"xx\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"30002024\"}}\n','1565591410'),(226,'117.87.200.113','{\"code\":0,\"data\":{\"ip\":\"117.87.200.113\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"徐州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565593568'),(227,'117.41.153.193','{\"code\":0,\"data\":{\"ip\":\"117.41.153.193\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江西\",\"city\":\"南昌\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"360000\",\"city_id\":\"360100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565594804'),(228,'122.96.42.83','{\"code\":0,\"data\":{\"ip\":\"122.96.42.83\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"南京\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565598565'),(229,'49.83.42.121','{\"code\":0,\"data\":{\"ip\":\"49.83.42.121\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"盐城\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565618769'),(231,'182.110.5.10','{\"code\":0,\"data\":{\"ip\":\"182.110.5.10\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江西\",\"city\":\"南昌\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"360000\",\"city_id\":\"360100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565621461'),(232,'27.153.10.229','{\"code\":0,\"data\":{\"ip\":\"27.153.10.229\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"泉州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350500\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565622916'),(233,'182.150.158.83','{\"code\":0,\"data\":{\"ip\":\"182.150.158.83\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"成都\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565623770'),(234,'45.195.92.91','{\"code\":0,\"data\":{\"ip\":\"45.195.92.91\",\"country\":\"中国\",\"area\":\"\",\"region\":\"香港\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"XX\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"810000\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"xx\"}}','1565624003'),(235,'110.54.220.104','{\"code\":0,\"data\":{\"ip\":\"110.54.220.104\",\"country\":\"菲律宾\",\"area\":\"\",\"region\":\"甲米地省\",\"city\":\"XX\",\"county\":\"XX\",\"isp\":\"Globe-Telecom\",\"country_id\":\"PH\",\"area_id\":\"\",\"region_id\":\"PH_20\",\"city_id\":\"xx\",\"county_id\":\"xx\",\"isp_id\":\"30002039\"}}\n','1565624040'),(236,'111.49.37.174','{\"code\":0,\"data\":{\"ip\":\"111.49.37.174\",\"country\":\"中国\",\"area\":\"\",\"region\":\"宁夏\",\"city\":\"银川\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"640000\",\"city_id\":\"640100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565624050'),(237,'117.136.87.157','{\"code\":0,\"data\":{\"ip\":\"117.136.87.157\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"渭南\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610500\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565639177'),(238,'114.87.162.132','{\"code\":0,\"data\":{\"ip\":\"114.87.162.132\",\"country\":\"中国\",\"area\":\"\",\"region\":\"上海\",\"city\":\"上海\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"310000\",\"city_id\":\"310100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565660086'),(239,'182.119.5.35','{\"code\":0,\"data\":{\"ip\":\"182.119.5.35\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"郑州\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"410100\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565670249'),(240,'114.236.138.114','{\"code\":0,\"data\":{\"ip\":\"114.236.138.114\",\"country\":\"中国\",\"area\":\"\",\"region\":\"江苏\",\"city\":\"盐城\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"320000\",\"city_id\":\"320900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565672161'),(241,'140.243.18.21','{\"code\":0,\"data\":{\"ip\":\"140.243.18.21\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"福州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565676197'),(242,'120.37.187.220','{\"code\":0,\"data\":{\"ip\":\"120.37.187.220\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"泉州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350500\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565676713'),(243,'140.243.13.189','{\"code\":0,\"data\":{\"ip\":\"140.243.13.189\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"福州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565677731'),(244,'223.104.130.29','{\"code\":0,\"data\":{\"ip\":\"223.104.130.29\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"长沙\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"430100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565677796'),(245,'211.97.130.210','{\"code\":0,\"data\":{\"ip\":\"211.97.130.210\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"厦门\",\"county\":\"XX\",\"isp\":\"联通\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350200\",\"county_id\":\"xx\",\"isp_id\":\"100026\"}}\n','1565681109'),(246,'27.186.108.220','{\"code\":0,\"data\":{\"ip\":\"27.186.108.220\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河北\",\"city\":\"保定\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"130000\",\"city_id\":\"130600\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565689020'),(247,'36.157.1.71','{\"code\":0,\"data\":{\"ip\":\"36.157.1.71\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖南\",\"city\":\"郴州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"430000\",\"city_id\":\"431000\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565693787'),(248,'1.81.169.0','{\"code\":0,\"data\":{\"ip\":\"1.81.169.0\",\"country\":\"中国\",\"area\":\"\",\"region\":\"陕西\",\"city\":\"汉中\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"610000\",\"city_id\":\"610700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565703238'),(249,'183.194.159.10','{\"code\":0,\"data\":{\"ip\":\"183.194.159.10\",\"country\":\"中国\",\"area\":\"\",\"region\":\"上海\",\"city\":\"上海\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"310000\",\"city_id\":\"310100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565706112'),(250,'111.58.213.133','{\"code\":0,\"data\":{\"ip\":\"111.58.213.133\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广西\",\"city\":\"南宁\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"450000\",\"city_id\":\"450100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565708979'),(251,'222.212.197.253','{\"code\":0,\"data\":{\"ip\":\"222.212.197.253\",\"country\":\"中国\",\"area\":\"\",\"region\":\"四川\",\"city\":\"成都\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"510000\",\"city_id\":\"510100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565710617'),(252,'42.88.84.30','{\"code\":0,\"data\":{\"ip\":\"42.88.84.30\",\"country\":\"中国\",\"area\":\"\",\"region\":\"甘肃\",\"city\":\"兰州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"620000\",\"city_id\":\"620100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565718238'),(253,'119.123.30.247','{\"code\":0,\"data\":{\"ip\":\"119.123.30.247\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"深圳\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"440300\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565722027'),(254,'110.157.39.168','{\"code\":0,\"data\":{\"ip\":\"110.157.39.168\",\"country\":\"中国\",\"area\":\"\",\"region\":\"新疆\",\"city\":\"阿克苏\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"650000\",\"city_id\":\"652900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565745884'),(255,'112.8.57.196','{\"code\":0,\"data\":{\"ip\":\"112.8.57.196\",\"country\":\"中国\",\"area\":\"\",\"region\":\"山东\",\"city\":\"临沂\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"370000\",\"city_id\":\"371300\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1565751777'),(256,'123.162.39.12','{\"code\":0,\"data\":{\"ip\":\"123.162.39.12\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"商丘\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"411400\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565756340'),(257,'1.196.77.141','{\"code\":0,\"data\":{\"ip\":\"1.196.77.141\",\"country\":\"中国\",\"area\":\"\",\"region\":\"河南\",\"city\":\"商丘\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"410000\",\"city_id\":\"411400\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565756475'),(258,'111.172.121.34','{\"code\":0,\"data\":{\"ip\":\"111.172.121.34\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"武汉\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565763705'),(259,'59.173.213.110','{\"code\":0,\"data\":{\"ip\":\"59.173.213.110\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"武汉\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565769284'),(260,'110.157.36.84','{\"code\":0,\"data\":{\"ip\":\"110.157.36.84\",\"country\":\"中国\",\"area\":\"\",\"region\":\"新疆\",\"city\":\"阿克苏\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"650000\",\"city_id\":\"652900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1565775956'),(261,'223.104.64.5','{\"code\":0,\"data\":{\"ip\":\"223.104.64.5\",\"country\":\"中国\",\"area\":\"\",\"region\":\"广东\",\"city\":\"东莞\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"440000\",\"city_id\":\"441900\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}','1565794687'),(263,'110.85.16.99','{\"code\":0,\"data\":{\"ip\":\"110.85.16.99\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"泉州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350500\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565795745'),(264,'27.23.64.39','{\"code\":0,\"data\":{\"ip\":\"27.23.64.39\",\"country\":\"中国\",\"area\":\"\",\"region\":\"湖北\",\"city\":\"孝感\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"420000\",\"city_id\":\"420900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1565837610'),(265,'59.56.149.234','{\"code\":0,\"data\":{\"ip\":\"59.56.149.234\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"福州\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350100\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1566455789'),(266,'110.157.36.245','{\"code\":0,\"data\":{\"ip\":\"110.157.36.245\",\"country\":\"中国\",\"area\":\"\",\"region\":\"新疆\",\"city\":\"阿克苏\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"650000\",\"city_id\":\"652900\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}','1566490090'),(267,'117.136.75.170','{\"code\":0,\"data\":{\"ip\":\"117.136.75.170\",\"country\":\"中国\",\"area\":\"\",\"region\":\"福建\",\"city\":\"福州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"350000\",\"city_id\":\"350100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1566832754'),(268,'125.113.237.131','{\"code\":0,\"data\":{\"ip\":\"125.113.237.131\",\"country\":\"中国\",\"area\":\"\",\"region\":\"浙江\",\"city\":\"金华\",\"county\":\"XX\",\"isp\":\"电信\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"330000\",\"city_id\":\"330700\",\"county_id\":\"xx\",\"isp_id\":\"100017\"}}\n','1568528849'),(269,'223.104.247.193','{\"code\":0,\"data\":{\"ip\":\"223.104.247.193\",\"country\":\"中国\",\"area\":\"\",\"region\":\"浙江\",\"city\":\"杭州\",\"county\":\"XX\",\"isp\":\"移动\",\"country_id\":\"CN\",\"area_id\":\"\",\"region_id\":\"330000\",\"city_id\":\"330100\",\"county_id\":\"xx\",\"isp_id\":\"100025\"}}\n','1568528988');
/*!40000 ALTER TABLE `xh_ip_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_mashang_huoli_log`
--

DROP TABLE IF EXISTS `xh_mashang_huoli_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_mashang_huoli_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orderid` int(10) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `uid` int(10) NOT NULL,
  `balance` decimal(10,3) NOT NULL,
  `trade_no` varchar(200) NOT NULL,
  `pankou_fees` decimal(10,3) NOT NULL,
  `time` int(10) NOT NULL,
  `old_balance` decimal(10,3) NOT NULL,
  `type` int(10) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_mashang_huoli_log`
--

LOCK TABLES `xh_mashang_huoli_log` WRITE;
/*!40000 ALTER TABLE `xh_mashang_huoli_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_mashang_huoli_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_mashang_yajin_log`
--

DROP TABLE IF EXISTS `xh_mashang_yajin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_mashang_yajin_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `trade_no` varchar(200) NOT NULL,
  `money` decimal(10,3) NOT NULL,
  `old_balance` decimal(10,3) NOT NULL,
  `new_balance` decimal(10,3) NOT NULL,
  `remark` varchar(250) NOT NULL,
  `time` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_mashang_yajin_log`
--

LOCK TABLES `xh_mashang_yajin_log` WRITE;
/*!40000 ALTER TABLE `xh_mashang_yajin_log` DISABLE KEYS */;
INSERT INTO `xh_mashang_yajin_log` VALUES (1,10094,'3759420200120101509',1.190,100.000,100.060,'补发订单成功！订单号：3759420200120101509,扣除金额：1.19元，扣除前余额：100.000元，扣除后余额：100.060元',1579467108,2),(2,10094,'4588020200120525454',5.000,100.060,95.060,'抢单成功！订单号：4588020200120525454,冻结金额：5元，冻结前余额：100.060元，冻结后余额：95.060元',1579468436,1),(3,10094,'3975220200120501025',5.000,95.060,90.060,'抢单成功！订单号：3975220200120501025,冻结金额：5元，冻结前余额：95.060元，冻结后余额：90.060元',1579468498,1),(4,10094,'4785620200120100544',5.000,90.060,85.060,'抢单成功！订单号：4785620200120100544,冻结金额：5元，冻结前余额：90.060元，冻结后余额：85.060元',1579468781,1),(5,10094,'5076520200120565154',5.000,85.060,80.060,'抢单成功！订单号：5076520200120565154,冻结金额：5元，冻结前余额：85.060元，冻结后余额：80.060元',1579468808,1),(6,10094,'8850820200120985497',5.000,80.060,75.060,'抢单成功！订单号：8850820200120985497,冻结金额：5元，冻结前余额：80.060元，冻结后余额：75.060元',1579469147,1),(7,10094,'3840820200120539748',5.000,75.060,70.060,'抢单成功！订单号：3840820200120539748,冻结金额：5元，冻结前余额：75.060元，冻结后余额：70.060元',1579469381,1),(8,10094,'6810320200120975650',5.000,70.060,65.060,'抢单成功！订单号：6810320200120975650,冻结金额：5元，冻结前余额：70.060元，冻结后余额：65.060元',1579469786,1),(9,10094,'9882420200120101555',5.000,65.060,60.060,'抢单成功！订单号：9882420200120101555,冻结金额：5元，冻结前余额：65.060元，冻结后余额：60.060元',1579469854,1),(10,10094,'3779420200120525357',5.000,60.060,55.060,'抢单成功！订单号：3779420200120525357,冻结金额：5元，冻结前余额：60.060元，冻结后余额：55.060元',1579470132,1),(11,10094,'6419920200120975250',5.000,55.060,50.060,'抢单成功！订单号：6419920200120975250,冻结金额：5元，冻结前余额：55.060元，冻结后余额：50.060元',1579470298,1),(12,10094,'7167020200120541025',5.000,50.060,45.060,'抢单成功！订单号：7167020200120541025,冻结金额：5元，冻结前余额：50.060元，冻结后余额：45.060元',1579470535,1),(13,10094,'1983820200120985298',5.000,45.113,40.113,'抢单成功！订单号：1983820200120985298,冻结金额：5元，冻结前余额：45.113元，冻结后余额：40.113元',1579471659,1),(14,10094,'5814520200120100561',5.000,40.113,35.113,'抢单成功！订单号：5814520200120100561,冻结金额：5元，冻结前余额：40.113元，冻结后余额：35.113元',1579471661,1),(15,10094,'7174120200120515498',5.000,35.113,30.113,'抢单成功！订单号：7174120200120515498,冻结金额：5元，冻结前余额：35.113元，冻结后余额：30.113元',1579471667,1),(16,10094,'2703320200120579956',5.000,30.165,25.165,'抢单成功！订单号：2703320200120579956,冻结金额：5元，冻结前余额：30.165元，冻结后余额：25.165元',1579472793,1),(17,10094,'4845020200120525198',5.000,25.165,20.165,'抢单成功！订单号：4845020200120525198,冻结金额：5元，冻结前余额：25.165元，冻结后余额：20.165元',1579473220,1);
/*!40000 ALTER TABLE `xh_mashang_yajin_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_mgt`
--

DROP TABLE IF EXISTS `xh_mgt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_mgt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(18) NOT NULL DEFAULT '' COMMENT '管理组用户名',
  `pwd` varchar(32) NOT NULL DEFAULT '' COMMENT '密码MD5',
  `pwd_safe` varchar(26) NOT NULL DEFAULT '0' COMMENT '安全口令',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `avatar` varchar(48) DEFAULT 'default.jpg' COMMENT '头像',
  `phone` varchar(12) NOT NULL DEFAULT '13800138000' COMMENT '手机号码',
  `email` varchar(46) DEFAULT '' COMMENT '邮箱',
  `token` varchar(10) NOT NULL DEFAULT '' COMMENT '动态token密钥',
  `remarks` varchar(255) DEFAULT '' COMMENT '用户备注',
  `ip` varchar(15) NOT NULL DEFAULT '255.255.255.255' COMMENT 'ip登录地址',
  `view_module` varchar(255) DEFAULT '0' COMMENT '最近访问的10个操作',
  `login_time` int(11) NOT NULL DEFAULT '0' COMMENT '上次登录时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `phone` (`phone`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_mgt`
--

LOCK TABLES `xh_mgt` WRITE;
/*!40000 ALTER TABLE `xh_mgt` DISABLE KEYS */;
INSERT INTO `xh_mgt` VALUES (20,'admin','95103d9f419d8136bc494da','93a681f2e45b8c81d541091',1,'201806072328206282363.jpg','17091900007','17091900007@qq.com','d3b18f10f','默认账户','117.132.94.203','0',1580498857),(27,'xiaobai','fa672cf7116bd78f2753a85','a03bd479ebd045c3c38e7d8',1,'default.jpg','13622224567','123@qq.com','6d390dcb6','小白','223.244.144.62','0',1564823124);
/*!40000 ALTER TABLE `xh_mgt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_mgt_group`
--

DROP TABLE IF EXISTS `xh_mgt_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_mgt_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authority` text COMMENT '权限组，json数据，-2 为最高权限，-1 为全局封禁',
  `mgt_name` varchar(26) NOT NULL DEFAULT '' COMMENT '权限组名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='管理员用户组';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_mgt_group`
--

LOCK TABLES `xh_mgt_group` WRITE;
/*!40000 ALTER TABLE `xh_mgt_group` DISABLE KEYS */;
INSERT INTO `xh_mgt_group` VALUES (1,'-2','超级管理员'),(2,'-1','BENNED'),(8,'[\"14\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\"]','软件管理'),(9,'[\"17\",\"20\",\"28\"]','a');
/*!40000 ALTER TABLE `xh_mgt_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_mgt_menu`
--

DROP TABLE IF EXISTS `xh_mgt_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_mgt_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` text NOT NULL COMMENT '菜单名称',
  `opened` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 默认打开 2 默认关闭',
  `hide` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 开启 2 隐藏',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=238 DEFAULT CHARSET=utf8 COMMENT='菜单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_mgt_menu`
--

LOCK TABLES `xh_mgt_menu` WRITE;
/*!40000 ALTER TABLE `xh_mgt_menu` DISABLE KEYS */;
INSERT INTO `xh_mgt_menu` VALUES (6,'<span class=\"icon color7\"><i class=\"fa fa-cog\"></i></span>系统设置<span class=\"caret\"></span>',1,1),(7,'<span class=\"icon color7\"><i class=\"fa fa-user\"></i></span>用户管理<span class=\"caret\"></span>',1,1),(8,'<span class=\"icon color7\"><i class=\"fa fa-wechat\"></i></span>微信管理<span class=\"caret\"></span>',2,2),(9,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>支付宝<span class=\"caret\"></span>',1,1),(10,'<span class=\"icon color7\"><i class=\"fa fa-pied-piper\"></i></span>服务版<span class=\"caret\"></span>',2,2),(11,'<span class=\"icon color7\"><i class=\"fa fa-shopping-cart\"></i></span>商店系统<span class=\"caret\"></span>',2,2),(222,'<span class=\"icon color7\"><i class=\"fa fa-cog\"></i></span> 支付宝转银行卡<span class=\"caret\"></span>',2,2),(223,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>云闪付<span class=\"caret\"></span>',2,2),(224,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>拉卡拉<span class=\"caret\"></span>',2,2),(225,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>钉钉红包<span class=\"caret\"></span>',2,2),(226,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>农信易扫<span class=\"caret\"></span>',2,2),(227,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>收钱吧<span class=\"caret\"></span>',2,2),(228,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>支付宝固码<span class=\"caret\"></span>',1,1),(229,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>微信商家固码<span class=\"caret\"></span>',1,1),(230,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>微信店员<span class=\"caret\"></span>',1,1),(231,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>微信转银行卡<span class=\"caret\"></span>',2,2),(232,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>拼多多固码<span class=\"caret\"></span>',2,2),(233,'<span class=\"icon color7\"><i class=\"fa fa-cog\"></i></span> 拼多多固码<span class=\"caret\"></span>',2,2),(234,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>跑分模式<span class=\"caret\"></span>',1,1),(235,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>话费通道<span class=\"caret\"></span>',2,2),(236,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>微信赞赏<span class=\"caret\"></span>',2,2),(237,'<span class=\"icon color7\"><i class=\"fa fa-pinterest\"></i></span>微信转手机<span class=\"caret\"></span>',2,2);
/*!40000 ALTER TABLE `xh_mgt_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_mgt_module`
--

DROP TABLE IF EXISTS `xh_mgt_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_mgt_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '模块id',
  `name` varchar(32) NOT NULL DEFAULT '控制面板' COMMENT '控制器名称',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 开启 2 关闭',
  `menuid` int(11) NOT NULL DEFAULT '0' COMMENT '绑定菜单ID',
  `route` varchar(40) NOT NULL DEFAULT 'admin/index/console' COMMENT '路径',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COMMENT='模块索引';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_mgt_module`
--

LOCK TABLES `xh_mgt_module` WRITE;
/*!40000 ALTER TABLE `xh_mgt_module` DISABLE KEYS */;
INSERT INTO `xh_mgt_module` VALUES (14,'网站设置',1,6,'admin/system/webCog'),(16,'注册开关',1,6,'admin/system/smsCog'),(17,'用户组',1,7,'admin/customer/index'),(18,'通道开关',1,6,'admin/system/costCog'),(19,'注册设置',1,7,'admin/customer/registerCog'),(20,'商户管理',1,7,'admin/member/index'),(21,'微信账户',1,8,'admin/wechat/automatic'),(58,'账户管理',1,228,'admin/alipaygm/automatic'),(23,'交易订单',1,8,'admin/wechat/automaticOrder'),(24,'公开版 v7.0',1,9,'admin/alipay/automatic'),(25,'交易订单',1,9,'admin/alipay/automaticOrder'),(26,'交易订单',1,10,'admin/service/order'),(27,'账户管理',1,10,'admin/service/index'),(28,'商户提现',1,7,'admin/member/withdraw'),(29,'商品管理',1,11,'admin/shop/index'),(76,'盘口提现',1,7,'admin/member/pankouwithdraw'),(31,'卡密管理',1,11,'admin/shop/card'),(32,'订单管理',1,11,'admin/shop/order'),(33,'订单统计',1,9,'admin/alipay/orderCount'),(34,'订单统计',1,8,'admin/wechat/orderCount'),(39,'转账通道',1,222,'admin/bank/automatic'),(40,'交易订单',1,222,'admin/bank/automaticOrder'),(41,'订单统计',1,222,'admin/bank/orderCount'),(52,'账户管理',1,226,'admin/nxys/automatic'),(43,'账户管理',1,223,'admin/yunshanfu/automatic'),(44,'交易订单',1,223,'admin/yunshanfu/automaticOrder'),(45,'订单统计',1,223,'admin/yunshanfu/orderCount'),(46,'账户管理',1,224,'admin/lakala/automatic'),(47,'交易订单',1,224,'admin/lakala/automaticOrder'),(48,'订单统计',1,224,'admin/lakala/orderCount'),(53,'交易订单',1,226,'admin/nxys/automaticOrder'),(54,'订单统计',1,226,'admin/nxys/orderCount'),(55,'收钱吧账户',1,227,'admin/shouqianba/automatic'),(56,'交易订单',1,227,'admin/wechat/automaticOrder'),(57,'订单统计',1,227,'admin/shouqianba/orderCount'),(59,'订单管理',1,228,'admin/alipaygm/automaticOrder'),(60,'订单统计',1,228,'admin/alipaygm/orderCount'),(61,'地区管理',1,6,'admin/area/list'),(62,'账户管理',1,229,'admin/wechatsj/automatic'),(63,'交易订单',1,229,'admin/wechatsj/automaticOrder'),(64,'订单统计',1,229,'admin/wechatsj/orderCount'),(65,'账户管理',1,230,'admin/wechatdy/automatic'),(66,'交易订单',1,230,'admin/wechatdy/automaticOrder'),(67,'订单统计',1,230,'admin/wechatdy/orderCount'),(71,'账户管理',1,232,'admin/pddgm/automatic'),(72,'交易订单',1,232,'admin/pddgm/automaticOrder'),(73,'订单统计',1,232,'admin/pddgm/orderCount'),(74,'代理管理',1,7,'admin/member/daili'),(75,'盘口管理',1,7,'admin/member/pankou'),(80,'账户管理',1,234,'admin/paofen/automatic'),(77,'代理提现',1,7,'admin/member/agentwithdraw'),(78,'码商管理',1,7,'admin/member/mashang'),(79,'码商提现',1,7,'admin/member/mashangwithdraw'),(81,'交易订单',1,234,'admin/paofen/automaticOrder'),(82,'订单统计',1,234,'admin/paofen/orderCount'),(83,'账户管理',1,235,'admin/huafei/automatic'),(84,'订单管理',1,235,'admin/huafei/automaticOrder'),(85,'订单统计',1,235,'admin/huafei/orderCount'),(86,'账户管理',1,236,'admin/wechatzs/automatic'),(87,'订单管理',1,236,'admin/wechatzs/automaticOrder'),(88,'订单统计',1,236,'admin/wechatzs/orderCount'),(89,'账户管理',1,237,'admin/wechatphone/automatic'),(90,'订单管理',1,237,'admin/wechatphone/automaticOrder'),(91,'订单统计',1,237,'admin/wechatphone/orderCount');
/*!40000 ALTER TABLE `xh_mgt_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_order_log`
--

DROP TABLE IF EXISTS `xh_order_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_order_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) NOT NULL DEFAULT '0',
  `order_id` varchar(50) NOT NULL DEFAULT '0',
  `money` varchar(30) NOT NULL DEFAULT '0.00',
  `type` varchar(10) NOT NULL DEFAULT 'alipay',
  `json_data` varchar(1000) NOT NULL DEFAULT ' ',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已回调',
  `add_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_order_log`
--

LOCK TABLES `xh_order_log` WRITE;
/*!40000 ALTER TABLE `xh_order_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_order_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_pankou_huoli_log`
--

DROP TABLE IF EXISTS `xh_pankou_huoli_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_pankou_huoli_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orderid` int(10) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `uid` int(10) NOT NULL,
  `balance` decimal(10,3) NOT NULL,
  `trade_no` varchar(200) NOT NULL,
  `pankou_fees` decimal(10,3) NOT NULL,
  `time` int(10) NOT NULL,
  `old_balance` decimal(10,3) NOT NULL,
  `type` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trade_no` (`trade_no`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_pankou_huoli_log`
--

LOCK TABLES `xh_pankou_huoli_log` WRITE;
/*!40000 ALTER TABLE `xh_pankou_huoli_log` DISABLE KEYS */;
INSERT INTO `xh_pankou_huoli_log` VALUES (1,7,5.250,10095,104.988,'3975220200120501025',0.263,1579468626,100.000,1),(2,12,5.220,10095,109.947,'6810320200120975650',0.261,1579469793,104.988,1),(3,13,5.280,10095,115.069,'9882420200120101555',0.158,1579469860,109.947,1),(4,14,5.290,10095,120.200,'3779420200120525357',0.159,1579470170,115.069,1),(5,15,5.250,10095,125.240,'6419920200120975250',0.210,1579470314,120.200,1),(6,16,5.280,10095,130.309,'7167020200120541025',0.211,1579470541,125.240,1),(7,19,5.220,10095,135.320,'7174120200120515498',0.209,1579471691,130.309,1);
/*!40000 ALTER TABLE `xh_pankou_huoli_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_service_account`
--

DROP TABLE IF EXISTS `xh_service_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_service_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '0' COMMENT '账户名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'login.txt',
  `login_time` int(11) DEFAULT '0' COMMENT '登录时间',
  `heartbeats` int(11) DEFAULT '0' COMMENT '通讯心跳次数',
  `active_time` int(11) DEFAULT '0' COMMENT '最近活跃时间',
  `key_id` varchar(36) NOT NULL DEFAULT '' COMMENT 'keyId',
  `natapp_url` varchar(255) NOT NULL DEFAULT ' ' COMMENT '手机映射域名',
  `training` tinyint(1) NOT NULL DEFAULT '2' COMMENT '轮训 1 开启  2 关闭',
  `receiving` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启动网关 2 关闭网关',
  `android_heartbeat` int(11) DEFAULT '0' COMMENT '安卓连接心跳时间',
  `login_img` text COMMENT '登录图片base64',
  `max_amount` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '收款多少之后停止收款',
  `note` varchar(500) NOT NULL DEFAULT ' ' COMMENT '通道备注',
  `today_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '今日收款总额',
  `today_pens` int(10) NOT NULL DEFAULT '0' COMMENT '今日交易笔数',
  `types` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 微信 2 支付宝 3 QQ 4 京东 ...',
  `lord` tinyint(1) NOT NULL DEFAULT '0',
  `is_new_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0旧版本  1新版本',
  `account_user_id` varchar(50) DEFAULT NULL COMMENT '支付宝的ID',
  `gathering_name` varchar(255) NOT NULL,
  `cardid` varchar(50) DEFAULT '0' COMMENT 'cardid',
  `account_no` varchar(50) DEFAULT '0' COMMENT '带*卡号',
  `bank_id` varchar(20) DEFAULT '0.00' COMMENT '$bank_id银行id',
  `alipay_pid` varchar(30) DEFAULT '0' COMMENT '支付宝PID',
  `account` varchar(200) NOT NULL COMMENT '支付宝账号',
  `ewmurl` varchar(255) NOT NULL COMMENT '微信二维码',
  `is_hongbao` int(10) NOT NULL,
  `app_user` varchar(200) NOT NULL COMMENT 'APP登录商户号',
  `lakala_account` varchar(100) NOT NULL,
  `yunshanfu_account` varchar(100) NOT NULL,
  `nx_type` int(10) NOT NULL,
  `nxys_account` varchar(200) NOT NULL,
  `area` varchar(200) NOT NULL,
  `max_dd` int(10) NOT NULL,
  `dy_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key_id` (`key_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='服务版';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_service_account`
--

LOCK TABLES `xh_service_account` WRITE;
/*!40000 ALTER TABLE `xh_service_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_service_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_service_order`
--

DROP TABLE IF EXISTS `xh_service_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_service_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL DEFAULT '0' COMMENT '服务id',
  `creation_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态  1 等待下发支付二维码   2未支付 3订单超时 4已支付',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `callback_url` text NOT NULL COMMENT '回调url',
  `success_url` text COMMENT '支付成功后跳转url',
  `error_url` text COMMENT '支付异常或超时跳转url',
  `user_id` int(11) DEFAULT '0' COMMENT '用户id  0为系统',
  `callback_time` int(11) DEFAULT '0' COMMENT '通知发送的时间',
  `out_trade_no` varchar(128) NOT NULL DEFAULT '0' COMMENT '交易订单号，用户名，备注信息',
  `ip` varchar(18) NOT NULL DEFAULT '127.0.0.1' COMMENT '发起支付时IP地址',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '订单交易号',
  `qrcode` varchar(128) DEFAULT '' COMMENT '支付二维码',
  `no` varchar(50) NOT NULL DEFAULT ' ' COMMENT 'app的订单号',
  `callback_status` tinyint(1) DEFAULT '0' COMMENT '0 未回调 1已回调',
  `callback_content` varchar(32) DEFAULT '0' COMMENT '回调内容',
  `callback_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送回调次数',
  `callback_from` varchar(5) NOT NULL DEFAULT 'app',
  `fees` decimal(10,3) DEFAULT '0.000' COMMENT '手续费',
  `types` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单类型',
  `reached` tinyint(1) NOT NULL DEFAULT '0',
  `agent_rate` decimal(10,3) DEFAULT '0.000' COMMENT '代理获利',
  `amount_true` decimal(10,2) DEFAULT '0.00' COMMENT '真实金额',
  `bank_id` varchar(20) DEFAULT '0' COMMENT '银行简称',
  `bank_name` varchar(50) DEFAULT '0' COMMENT '银行名称',
  `gathering_name` varchar(20) DEFAULT '0' COMMENT '收款人名称',
  `bank_acount` varchar(100) DEFAULT '0' COMMENT '在银行卡账号',
  `expire_time` int(11) DEFAULT '0' COMMENT 'expire_time 过期时间',
  `ymoney` decimal(10,3) NOT NULL COMMENT '原金额',
  `app_user` varchar(100) NOT NULL,
  `nx_type` int(10) NOT NULL,
  `dy_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='服务订单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_service_order`
--

LOCK TABLES `xh_service_order` WRITE;
/*!40000 ALTER TABLE `xh_service_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_service_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_service_order_no`
--

DROP TABLE IF EXISTS `xh_service_order_no`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_service_order_no` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount_true` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `bank_acount` varchar(100) DEFAULT '0',
  `time` int(11) DEFAULT '0',
  `status` smallint(2) DEFAULT '0' COMMENT '1 为已确认',
  `pay_time` int(11) DEFAULT '0' COMMENT '补单时间/确认订单时间',
  `fees` decimal(10,2) DEFAULT '0.00' COMMENT '手续费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1322 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_service_order_no`
--

LOCK TABLES `xh_service_order_no` WRITE;
/*!40000 ALTER TABLE `xh_service_order_no` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_service_order_no` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_service_reached_record`
--

DROP TABLE IF EXISTS `xh_service_reached_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_service_reached_record` (
  `add_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `amount` decimal(10,3) NOT NULL DEFAULT '0.000',
  `fees` decimal(10,3) NOT NULL DEFAULT '0.000',
  `mark` varchar(150) NOT NULL DEFAULT ' ',
  `sys_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否计算成功',
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_service_reached_record`
--

LOCK TABLES `xh_service_reached_record` WRITE;
/*!40000 ALTER TABLE `xh_service_reached_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_service_reached_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_shop`
--

DROP TABLE IF EXISTS `xh_shop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(86) NOT NULL DEFAULT '默认名称' COMMENT '商品名称',
  `description` text COMMENT '商品描述',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品单价',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '物品成本',
  `category` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 购买用户组 2 卡密购买 3 商品购买',
  `discount` text COMMENT '批量购买优惠规则',
  `restriction` int(11) NOT NULL DEFAULT '0' COMMENT '限制购买次数/数量',
  `purchases` int(11) DEFAULT '0' COMMENT '已被购买次数',
  `sort` int(6) NOT NULL DEFAULT '0' COMMENT '商品排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 正常购买 2 停止购买',
  `release_time` int(11) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `bind_special` int(11) DEFAULT '0' COMMENT '綁定特殊id',
  `warehouse` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品管理';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_shop`
--

LOCK TABLES `xh_shop` WRITE;
/*!40000 ALTER TABLE `xh_shop` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_shop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_shop_card`
--

DROP TABLE IF EXISTS `xh_shop_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_shop_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_no` varchar(255) NOT NULL DEFAULT '0' COMMENT '卡号',
  `card_pwd` varchar(255) NOT NULL DEFAULT '0' COMMENT '卡密',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 未出售 1 已出售',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `sell_time` int(11) NOT NULL DEFAULT '0' COMMENT '出售时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='卡密列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_shop_card`
--

LOCK TABLES `xh_shop_card` WRITE;
/*!40000 ALTER TABLE `xh_shop_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_shop_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_shop_order`
--

DROP TABLE IF EXISTS `xh_shop_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_shop_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '折扣金额',
  `quantity` int(11) NOT NULL DEFAULT '0' COMMENT '购买数量',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 未支付 1 已支付 2 已发货 3 已收货 4 退款中 5 退款成功 6 退款失败 7 订单关闭',
  `serial_no` varchar(32) NOT NULL DEFAULT '0' COMMENT '订单流水号',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `address` text NOT NULL COMMENT '收货人信息-JSON',
  `ship` text NOT NULL COMMENT '运输信息-JSON-商品写运单号',
  `refund_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '退款金额',
  `refund_quantity` int(11) NOT NULL DEFAULT '0' COMMENT '退货数量',
  `refund_feedback` text COMMENT '退货原因-JSON',
  `refund_schedule` text COMMENT '退款进度-JSON',
  `pay_method` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付方式 1 微信 2 支付宝 3 余额 4盈利余额',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `delivery_time` int(11) DEFAULT '0' COMMENT '发货时间',
  `express` varchar(32) DEFAULT '0' COMMENT '快递代码',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `serial_no` (`serial_no`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COMMENT='用户购买订单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_shop_order`
--

LOCK TABLES `xh_shop_order` WRITE;
/*!40000 ALTER TABLE `xh_shop_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_shop_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_user_paylog`
--

DROP TABLE IF EXISTS `xh_user_paylog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_user_paylog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `money` decimal(10,3) NOT NULL,
  `old_money` decimal(10,3) NOT NULL,
  `new_money` decimal(10,3) NOT NULL,
  `remark` varchar(250) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_user_paylog`
--

LOCK TABLES `xh_user_paylog` WRITE;
/*!40000 ALTER TABLE `xh_user_paylog` DISABLE KEYS */;
/*!40000 ALTER TABLE `xh_user_paylog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xh_variable`
--

DROP TABLE IF EXISTS `xh_variable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xh_variable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT 'key' COMMENT '变量名称',
  `value` text COMMENT '变量值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='系统变量';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xh_variable`
--

LOCK TABLES `xh_variable` WRITE;
/*!40000 ALTER TABLE `xh_variable` DISABLE KEYS */;
INSERT INTO `xh_variable` VALUES (8,'webCog','{\"name\":\"免签支付\",\"keywords\":\"免签支付\",\"description\":\"免签支付\",\"open\":1}'),(9,'smsCog','{\"accessKeyId\":\"LTAIpEj9owChasPI\",\"accessKeySecret\":\"2guOfXP0Rc9GERnFwatWfQMvCBD5QJ\",\"SignName\":\"免签支付\",\"TemplateCode\":\"SMS_147197042\",\"TemplateErrorCode\":\"SMS_147197042\",\"TemplateDefend\":\"SMS_147197042\",\"open\":1}'),(10,'costCog','{\"wechat_auto\":{\"open\":2},\"alipay_auto\":{\"open\":1},\"alipaygm_auto\":{\"open\":1},\"alipayhongbao_auto\":{\"open\":2},\"bank_auto\":{\"open\":2},\"lakala_auto\":{\"open\":2},\"nxyswx_auto\":{\"open\":2},\"nxysalipay_auto\":{\"open\":2},\"nxysyl_auto\":{\"open\":2},\"yunshanfu_auto\":{\"open\":2},\"shouqianba_auto\":{\"open\":2},\"pddgm_auto\":{\"open\":2},\"wechatsj_auto\":{\"open\":1},\"wechatdy_auto\":{\"open\":1},\"wechatbank_auto\":{\"open\":2},\"taobaodf_auto\":{\"open\":2},\"service_auto\":{\"open\":2},\"paofen_auto\":{\"open\":1},\"withdraw\":{\"open\":1},\"wechatphone_auto\":{\"open\":2},\"wechatzs_auto\":{\"open\":2},\"huafei_auto\":{\"open\":2}}'),(11,'registerCog','{\"integral\":\"100\",\"scale\":\"\",\"scale_open\":1,\"points\":\"\",\"points_open\":2,\"group_id\":1}'),(12,'server','{\"key\":\"12345678\",\"service_phone\":\"15017399440\"}');
/*!40000 ALTER TABLE `xh_variable` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-01  3:29:54
