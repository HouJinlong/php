/*
Navicat MySQL Data Transfer

Source Server         : 侯晋龙
Source Server Version : 50713
Source Host           : 127.0.0.1:3306
Source Database       : php

Target Server Type    : MYSQL
Target Server Version : 50713
File Encoding         : 65001

Date: 2017-06-30 08:28:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dy_type
-- ----------------------------
DROP TABLE IF EXISTS `dy_type`;
CREATE TABLE `dy_type` (
  `tid` smallint(5) NOT NULL AUTO_INCREMENT,
  `tname` varchar(20) DEFAULT NULL,
  `tflag` smallint(3) unsigned zerofill DEFAULT NULL,
  `tdate` int(10) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dy_type
-- ----------------------------
INSERT INTO `dy_type` VALUES ('1', '学习', null, '1496304885');
INSERT INTO `dy_type` VALUES ('2', '工作', null, '1496304894');
INSERT INTO `dy_type` VALUES ('3', '娱乐', null, '1496304903');
INSERT INTO `dy_type` VALUES ('4', '旅游', null, '1496304911');
INSERT INTO `dy_type` VALUES ('5', '吃饭', null, '1496304917');

-- ----------------------------
-- Table structure for tb_urse
-- ----------------------------
DROP TABLE IF EXISTS `tb_urse`;
CREATE TABLE `tb_urse` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) NOT NULL,
  `upwd` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_urse
-- ----------------------------
INSERT INTO `tb_urse` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for ty_diary
-- ----------------------------
DROP TABLE IF EXISTS `ty_diary`;
CREATE TABLE `ty_diary` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `tid` smallint(5) NOT NULL,
  `dtitles` varchar(50) DEFAULT NULL,
  `dpic` varchar(255) DEFAULT NULL,
  `dcontent` text,
  `drelease` smallint(2) DEFAULT NULL,
  `flag` smallint(2) unsigned zerofill NOT NULL,
  `timeline` int(10) DEFAULT NULL,
  PRIMARY KEY (`did`),
  KEY `tid` (`tid`),
  CONSTRAINT `tid` FOREIGN KEY (`tid`) REFERENCES `dy_type` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ty_diary
-- ----------------------------
INSERT INTO `ty_diary` VALUES ('1', '1', '学习PHP', '', '挨打', '1', '00', '1496304954');
INSERT INTO `ty_diary` VALUES ('2', '2', '挣钱', '', '阿斯顿', '1', '00', '1496304974');
INSERT INTO `ty_diary` VALUES ('5', '1', '我爱学习', '', '我爱学习我爱学习我爱学习我爱学习我爱学习我爱学习我爱学习', '0', '00', '1496901366');
INSERT INTO `ty_diary` VALUES ('6', '2', '但他是很重要的', '', '', '1', '00', '1496903627');
INSERT INTO `ty_diary` VALUES ('7', '1', '钱不是万能的', '', '很多钱', '1', '00', '1496903646');
INSERT INTO `ty_diary` VALUES ('9', '4', '我想去大理', '', '但是得有钱', '1', '00', '1497236550');
INSERT INTO `ty_diary` VALUES ('10', '5', '牛排', '', '牛排十分熟才好吃，不会肚子疼', '1', '00', '1497236593');
INSERT INTO `ty_diary` VALUES ('12', '3', '腹肌', 'images/201706/594b2d3bbb36f.jpg', '没有', '1', '00', '1498099003');
