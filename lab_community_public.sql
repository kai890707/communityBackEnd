/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100148
 Source Host           : localhost:3306
 Source Schema         : lab_community_public

 Target Server Type    : MariaDB
 Target Server Version : 100148
 File Encoding         : 65001

 Date: 10/10/2021 00:46:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章類別',
  `created_at` datetime(0) NOT NULL COMMENT '建立時間',
  `updated_at` datetime(0) NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, '社區公告', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `category` VALUES (2, '社區特色', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `category` VALUES (3, '社區特產', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `category` VALUES (4, '社區景點', '2021-10-01 12:55:40', '2021-10-01 12:55:40');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (45, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (46, '2021_09_24_040057_pages', 1);
INSERT INTO `migrations` VALUES (47, '2021_09_24_040109_users', 1);
INSERT INTO `migrations` VALUES (48, '2021_09_24_040121_category', 1);
INSERT INTO `migrations` VALUES (49, '2021_09_24_040133_setting', 1);
INSERT INTO `migrations` VALUES (50, '2021_09_24_040145_pageimage', 1);

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章標題',
  `page_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章內容',
  `page_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章狀態{T:發佈 F:未發佈}',
  `page_chosen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '精選圖片',
  `created_at` datetime(0) NOT NULL COMMENT '建立時間',
  `updated_at` datetime(0) NOT NULL COMMENT '修改時間',
  `category_id` int(10) UNSIGNED NOT NULL COMMENT '分類ID',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `page_category_id_foreign`(`category_id`) USING BTREE,
  CONSTRAINT `page_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for pageImage
-- ----------------------------
DROP TABLE IF EXISTS `pageImage`;
CREATE TABLE `pageImage`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pageImage_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '圖片名稱',
  `created_at` datetime(0) NOT NULL COMMENT '建立時間',
  `updated_at` datetime(0) NOT NULL COMMENT '修改時間',
  `pageId` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '文章ID',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pageimage_pageid_foreign`(`pageId`) USING BTREE,
  CONSTRAINT `pageimage_pageid_foreign` FOREIGN KEY (`pageId`) REFERENCES `page` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 58 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '編輯主鍵',
  `community_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '社區名稱',
  `community_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '社區地址',
  `community_host` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '社區負責人',
  `community_contact` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '社區聯絡人',
  `community_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '社區電話',
  `community_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '聯絡信箱',
  `community_facebook` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'FB',
  `community_instagram` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'IG',
  `community_introduce` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '簡介',
  `community_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '社區圖片',
  `created_at` datetime(0) NOT NULL COMMENT '建立時間',
  `updated_at` datetime(0) NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, '保社社區', '高雄市大社區保社里中正路367-1號', '許清泉', '林小姐', '0925922969', 'sixgas@yahoo.com.tw', 'default', 'default', '保社社區發展協會，原由理事長黃郡先生與總幹事徐國賢先生及會員共襄盛舉，創立於民國八十六年間。協會成立之初承蒙許多默默付出的會員辛苦經營，爾後民國九十四年間由理事長莊仁平先生與總幹事黃明宗先生代理職務一年六個月。現今為第三、四屆理事長韓進鄉先生與總幹事許清泉先生由會員大會經理事會順利而產生，並由高雄縣政府及大社鄉公所輔導和地方人士慷慨贊助，承先啟後奠定日後發展的基礎。目前於103年1月1日產生第五屆理事長許清泉與總幹事徐陳酉蘭繼續推動創新社區新里程。', 'uploads/1633769094.jpg', '2021-10-04 17:33:46', '2021-10-09 16:44:54');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_account` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_permission` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '權限{root:系統開發者,admin:網站管理者,normal:一般管理員}',
  `created_at` datetime(0) NOT NULL COMMENT '建立時間',
  `updated_at` datetime(0) NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '123', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0912345678', 'test@gmail.com', 'admin', '0000-00-00 00:00:00', '2021-10-04 00:17:36');
INSERT INTO `user` VALUES (2, 'l0726', 'l0726', '0cb604ef99cb8584b2a3acb18c429c2644ff0f34', '', 's18113223@stu.edu.tw', 'root', '2021-10-03 21:03:15', '2021-10-03 21:03:15');
INSERT INTO `user` VALUES (3, '123', '122222', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0123123123', 's17113230@stu.edu.tw', 'normal', '2021-10-04 11:40:45', '2021-10-04 11:40:45');

SET FOREIGN_KEY_CHECKS = 1;
