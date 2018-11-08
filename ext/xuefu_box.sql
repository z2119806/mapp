/*
Navicat MySQL Data Transfer

Source Server         : 47.104.69.42
Source Server Version : 50723
Source Host           : 47.104.69.42:3306
Source Database       : xuefu

Target Server Type    : MYSQL
Target Server Version : 50723
File Encoding         : 65001

Date: 2018-11-08 16:49:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `xuefu_box`
-- ----------------------------
DROP TABLE IF EXISTS `xuefu_box`;
CREATE TABLE `xuefu_box` (
  `box_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `box_title` varchar(30) NOT NULL DEFAULT '',
  `box_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 page 2 storage 3 bookself',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `box_pid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`box_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='笔记架构表';

-- ----------------------------
-- Records of xuefu_box
-- ----------------------------
INSERT INTO `xuefu_box` VALUES ('6', '阿萨德', '3', '10000', '0', '1', '1538207902', '1538207902');
INSERT INTO `xuefu_box` VALUES ('7', '阿萨德', '2', '10000', '2', '1', '1538278293', '1538278293');
INSERT INTO `xuefu_box` VALUES ('8', '阿萨德', '3', '10000', '0', '1', '1538278372', '1538278372');
INSERT INTO `xuefu_box` VALUES ('9', '阿萨德', '3', '10000', '0', '1', '1538278373', '1538278373');

-- ----------------------------
-- Table structure for `xuefu_user`
-- ----------------------------
DROP TABLE IF EXISTS `xuefu_user`;
CREATE TABLE `xuefu_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL DEFAULT '',
  `user_token` varchar(100) NOT NULL DEFAULT '',
  `user_password` varchar(32) NOT NULL DEFAULT '',
  `user_salt` int(4) unsigned NOT NULL DEFAULT '0',
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `user_sex` tinyint(4) NOT NULL DEFAULT '0',
  `user_age` tinyint(4) NOT NULL DEFAULT '0',
  `user_icon` varchar(255) NOT NULL DEFAULT '',
  `create_ip` varchar(15) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_idx` (`user_email`) USING BTREE,
  KEY `user_token_idx` (`user_token`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of xuefu_user
-- ----------------------------
INSERT INTO `xuefu_user` VALUES ('10000', '1@test.com', 'bHf8drisc0aFfwbLhpjRcTbWcGbYaza4aiaA', '593fbfee81e0edc203d9e0a643ea2d68', '2926', '1@test.com', '0', '0', '...', '127.0.0.1', '1538205179', '1538205179', '1');

-- ----------------------------
-- Table structure for `xuefu_user_login_record`
-- ----------------------------
DROP TABLE IF EXISTS `xuefu_user_login_record`;
CREATE TABLE `xuefu_user_login_record` (
  `user_login_record_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_login_record_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户登录记录表';

-- ----------------------------
-- Records of xuefu_user_login_record
-- ----------------------------
INSERT INTO `xuefu_user_login_record` VALUES ('1', '2', '1538203957', '127.0.0.1');
INSERT INTO `xuefu_user_login_record` VALUES ('2', '2', '1538203962', '127.0.0.1');
INSERT INTO `xuefu_user_login_record` VALUES ('3', '2', '1538204051', '127.0.0.1');
INSERT INTO `xuefu_user_login_record` VALUES ('4', '2', '1538204053', '127.0.0.1');
INSERT INTO `xuefu_user_login_record` VALUES ('5', '2', '1538204221', '127.0.0.1');
INSERT INTO `xuefu_user_login_record` VALUES ('6', '10000', '1538205179', '127.0.0.1');
