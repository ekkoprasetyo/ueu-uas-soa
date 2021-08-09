/*
 Navicat Premium Data Transfer

 Source Server         : MAC LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : db_uas_soa

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 09/08/2021 23:03:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for absensi
-- ----------------------------
DROP TABLE IF EXISTS `absensi`;
CREATE TABLE `absensi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `user_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of absensi
-- ----------------------------
BEGIN;
INSERT INTO `absensi` VALUES (1, '2021-08-09', '1', '2021-08-09 14:56:11', 1);
INSERT INTO `absensi` VALUES (2, '2021-08-09', '1', '2021-08-09 15:35:23', 1);
INSERT INTO `absensi` VALUES (3, '2021-08-09', '2', '2021-08-09 15:44:44', 1);
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2021_06_26_055459_create_barangs_table', 1);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token_bearer` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Eko Prasetyo', 'ekkoprasetyo@gmail.com', '$2y$10$ajFMNoKwfmZ5oW/GaoKeDOwix8D/.bONactzowb/bjW7LBABhS5JK', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJkdW5za2kiLCJuYW1lIjoiRWtvIFByYXNldHlvIiwiZW1haWwiOiJla2tvcHJhc2V0eW9AZ21haWwuY29tIn0.pIhtE86FfCV3VGu8V3-IDutNplMDjfQz6jvOJMzmPBU', 1);
INSERT INTO `users` VALUES (2, 'Rifki Ardiansyah', 'rifkiardians@gmail.com', '$2y$10$gklglpNlbl9gGvzZ2rinNuvSiAL71FscpnR2Nz5N.17SoBJKdk5ay', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJkdW5za2kiLCJuYW1lIjoiUmlma2kgQXJkaWFuc3lhaCIsImVtYWlsIjoicmlma2lhcmRpYW5zQGdtYWlsLmNvbSJ9.wsX8KRZ5xRZrL-mt04XSYo7KPSPDiGPgU1fCmuhncpY', 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
