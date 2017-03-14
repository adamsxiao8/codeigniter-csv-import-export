/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : dps_db

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2015-12-27 00:13:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `controller` varchar(40) NOT NULL,
  `action` varchar(60) NOT NULL,
  `parent` tinyint(2) DEFAULT NULL,
  `roles` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', 'Home', 'Dashboard', 'index', null, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}');
INSERT INTO `menus` VALUES ('2', 'User', '', '', null, 'a:1:{i:0;s:1:\"1\";}');
INSERT INTO `menus` VALUES ('3', 'List', 'User', 'index', '2', 'a:1:{i:0;s:1:\"1\";}');
INSERT INTO `menus` VALUES ('4', 'Add', 'User', 'add', '2', 'a:1:{i:0;s:1:\"1\";}');
INSERT INTO `menus` VALUES ('6', 'Admin setup', 'Admin', 'index', null, 'a:1:{i:0;s:1:\"1\";}');
INSERT INTO `menus` VALUES ('7', 'File upload', 'Uploads', 'index', null, 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}');
INSERT INTO `menus` VALUES ('8', 'Reports generate', 'Reports', 'index', null, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}');
INSERT INTO `menus` VALUES ('9', 'Report Read/Search', 'Reports', 'search', null, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}');

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'Investors', '1', '53');
INSERT INTO `settings` VALUES ('2', 'Investors', '2', 'citi');
INSERT INTO `settings` VALUES ('3', 'Investors', '3', 'uwm');
INSERT INTO `settings` VALUES ('4', 'Investors', '4', 'nycb');
INSERT INTO `settings` VALUES ('5', 'Investors', '5', 'provident');
INSERT INTO `settings` VALUES ('6', 'Investors', '6', 'freedom');
INSERT INTO `settings` VALUES ('7', 'Investors', '7', 'parkside');
INSERT INTO `settings` VALUES ('8', 'Investors', '8', 'amerisave');
INSERT INTO `settings` VALUES ('9', 'Investors', '9', 'caliber');
INSERT INTO `settings` VALUES ('10', 'Investors', '10', 'GTC');
INSERT INTO `settings` VALUES ('11', 'Investors', '11', 'homebridge');
INSERT INTO `settings` VALUES ('12', 'Investors', '12', 'themoneysource');
INSERT INTO `settings` VALUES ('13', 'Investors', '13', 'interfirst');
INSERT INTO `settings` VALUES ('14', 'Investors', '14', 'anniemac');
INSERT INTO `settings` VALUES ('15', 'Investors', '15', 'msfhome');
INSERT INTO `settings` VALUES ('16', 'Investors', '16', 'nextbank');
INSERT INTO `settings` VALUES ('17', 'Investors', '17', 'homebrodge');
INSERT INTO `settings` VALUES ('18', 'Investors', '18', '360');
INSERT INTO `settings` VALUES ('19', 'Investors', '19', 'EA');
INSERT INTO `settings` VALUES ('20', 'Investors', '20', 'FNBT');
INSERT INTO `settings` VALUES ('21', 'Investors', '21', 'magnolia');
INSERT INTO `settings` VALUES ('22', 'Investors', '22', 'moneysource');
INSERT INTO `settings` VALUES ('23', 'Investors', '23', 'orion');
INSERT INTO `settings` VALUES ('24', 'Investors', '24', 'usbank');
INSERT INTO `settings` VALUES ('25', 'Investors', '25', 'acopia');
INSERT INTO `settings` VALUES ('26', 'loan product list', '1', '30 y fix');
INSERT INTO `settings` VALUES ('27', 'loan product list', '2', '20 y fix');
INSERT INTO `settings` VALUES ('28', 'loan product list', '3', '15 y fix');
INSERT INTO `settings` VALUES ('29', 'loan product list', '4', '10 y fix');
INSERT INTO `settings` VALUES ('30', 'loan product list', '5', '3/1 arm');
INSERT INTO `settings` VALUES ('31', 'loan product list', '6', '5/1 arm');
INSERT INTO `settings` VALUES ('32', 'loan product list', '7', '7/1 arm');
INSERT INTO `settings` VALUES ('33', 'loan product list', '8', '10/1 arm');
INSERT INTO `settings` VALUES ('34', 'loan product list', '9', '30 y fix FHA');
INSERT INTO `settings` VALUES ('35', 'loan product list', '10', '15 y fix FHA');
INSERT INTO `settings` VALUES ('36', 'loan product list', '11', '30 y fix VA');
INSERT INTO `settings` VALUES ('37', 'loan product list', '12', '15 y fix VA');
INSERT INTO `settings` VALUES ('38', 'loan product list', '13', '30 y fix JUMBO');
INSERT INTO `settings` VALUES ('39', 'loan product list', '14', '20 y fix JUMBO');
INSERT INTO `settings` VALUES ('40', 'loan product list', '15', '15 y fix JUMBO');
INSERT INTO `settings` VALUES ('41', 'loan product list', '16', '10 y fix JUMBO');
INSERT INTO `settings` VALUES ('42', 'loan product list', '17', '3/1 arm JUMBO');
INSERT INTO `settings` VALUES ('43', 'loan product list', '18', '5/1 arm JUMBO');
INSERT INTO `settings` VALUES ('44', 'loan product list', '19', '7/1 arm JUMBO');
INSERT INTO `settings` VALUES ('45', 'loan product list', '20', '10/1 arm JUMBO');
INSERT INTO `settings` VALUES ('46', 'lock days list', '1', '15 day');
INSERT INTO `settings` VALUES ('47', 'lock days list', '2', '21 day');
INSERT INTO `settings` VALUES ('48', 'lock days list', '3', '30 day');
INSERT INTO `settings` VALUES ('49', 'lock days list', '4', '40 day');
INSERT INTO `settings` VALUES ('50', 'lock days list', '5', '45 day');
INSERT INTO `settings` VALUES ('51', 'lock days list', '6', '50 day');
INSERT INTO `settings` VALUES ('52', 'lock days list', '7', '60 day');
INSERT INTO `settings` VALUES ('53', 'lock days list', '8', '90 day');
INSERT INTO `settings` VALUES ('54', 'date formet', '1', 'MM/DD/YY');
INSERT INTO `settings` VALUES ('55', 'date formet', '2', 'MM/DD/YYYY');
INSERT INTO `settings` VALUES ('56', 'date formet', '3', 'Month DD, YYYY');
INSERT INTO `settings` VALUES ('57', 'date formet', '4', 'Month DD YYYY');
INSERT INTO `settings` VALUES ('58', 'date formet', '5', 'DD-MM-YY');
INSERT INTO `settings` VALUES ('59', 'date formet', '6', 'MM-DD-YY');
INSERT INTO `settings` VALUES ('60', 'date formet', '7', 'No date');
INSERT INTO `settings` VALUES ('61', 'time format', '1', 'HH:MM');
INSERT INTO `settings` VALUES ('62', 'time format', '2', 'HH:MM:SS');
INSERT INTO `settings` VALUES ('63', 'time format', '3', 'H:MM:SS AM/PM');
INSERT INTO `settings` VALUES ('64', 'time format', '4', 'HH:MM AM/PM');
INSERT INTO `settings` VALUES ('65', 'time format', '5', 'HH:MMAM/PM');
INSERT INTO `settings` VALUES ('66', 'time format', '6', 'No time:');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `role` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Mika', 'Lindholm', '1');
INSERT INTO `users` VALUES ('9', 'bond', '1d2bba5d0b80938327ac901264bcf7d4fe492fe9', 'James', 'Bond', '2');
