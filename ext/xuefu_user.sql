/*
Navicat MySQL Data Transfer

Source Server         : banban
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : xuefu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-09-03 19:22:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `xuefu_user`
-- ----------------------------
DROP TABLE IF EXISTS `xuefu_user`;
CREATE TABLE `xuefu_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(320) NOT NULL DEFAULT '',
  `user_sex` tinyint(4) unsigned NOT NULL COMMENT '1 man 2 woman',
  `user_age` tinyint(4) unsigned NOT NULL,
  `user_icon` varchar(255) NOT NULL DEFAULT '',
  `user_token` varchar(255) NOT NULL DEFAULT '',
  `user_login_last_time` int(11) unsigned NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '-1 abnormal 1 normal',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_idx` (`user_email`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10006 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xuefu_user
-- ----------------------------
INSERT INTO `xuefu_user` VALUES ('10004', '', '12', '0', '0', '', '', '0', '0', '0', '0');
