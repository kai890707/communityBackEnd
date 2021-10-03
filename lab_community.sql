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

 Date: 04/10/2021 00:18:53
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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (7, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (8, '2021_09_24_040057_pages', 1);
INSERT INTO `migrations` VALUES (9, '2021_09_24_040109_users', 1);
INSERT INTO `migrations` VALUES (10, '2021_09_24_040121_category', 1);
INSERT INTO `migrations` VALUES (11, '2021_09_24_040133_setting', 1);
INSERT INTO `migrations` VALUES (12, '2021_09_24_040145_pageimage', 1);

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章標題',
  `page_content` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章內容',
  `page_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章狀態{T:發佈 F:未發佈}',
  `page_chosen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '精選圖片',
  `created_at` datetime(0) NOT NULL COMMENT '建立時間',
  `updated_at` datetime(0) NOT NULL COMMENT '修改時間',
  `category_id` int(10) UNSIGNED NOT NULL COMMENT '分類ID',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `page_category_id_foreign`(`category_id`) USING BTREE,
  CONSTRAINT `page_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES (7, 'asdasd', '{\"blocks\":[{\"key\":\"cn4aa\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', 'uploads/1633104287.JPG', '2021-10-02 15:24:15', '2021-10-02 15:24:15', 1);
INSERT INTO `page` VALUES (8, 'aaaaa77777', '{\"blocks\":[{\"key\":\"2agcc\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', 'uploads/1633167030.', '2021-10-02 17:30:30', '2021-10-02 17:30:30', 1);
INSERT INTO `page` VALUES (9, 'a', '{\"blocks\":[{\"key\":\"10aif\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', 'uploads/1633167232.', '2021-10-02 17:33:52', '2021-10-02 17:33:52', 1);
INSERT INTO `page` VALUES (10, 'asd', '{\"blocks\":[{\"key\":\"2dfoq\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '', '2021-10-02 17:45:53', '2021-10-02 17:45:53', 1);
INSERT INTO `page` VALUES (11, 'efs', '{\"blocks\":[{\"key\":\"692lf\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '', '2021-10-02 17:46:22', '2021-10-02 17:46:22', 1);
INSERT INTO `page` VALUES (12, 'asdaaaa', '{\"blocks\":[{\"key\":\"bbre3\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '', '2021-10-02 17:50:23', '2021-10-02 17:50:23', 1);
INSERT INTO `page` VALUES (13, 'abbbbb', '{\"blocks\":[{\"key\":\"896dg\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '', '2021-10-02 17:51:47', '2021-10-02 17:51:47', 1);
INSERT INTO `page` VALUES (14, 'ttttt', '{\"blocks\":[{\"key\":\"7ugpg\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', 'uploads/1633168333.JPG', '2021-10-02 17:52:13', '2021-10-02 17:52:13', 4);
INSERT INTO `page` VALUES (15, 'aaa', '{\"blocks\":[{\"key\":\"cjcv8\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', 'uploads/1633168360.JPG', '2021-10-02 17:52:40', '2021-10-02 17:52:40', 3);
INSERT INTO `page` VALUES (16, 'asd', '{\"blocks\":[{\"key\":\"bodi2\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '', '2021-10-03 13:03:38', '2021-10-03 13:03:38', 2);
INSERT INTO `page` VALUES (18, 'asdasd', '{\"blocks\":[{\"key\":\"eib6l\",\"text\":\"asassadasd\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', 'uploads/1633265025.JPG', '2021-10-03 20:43:45', '2021-10-03 20:43:45', 1);
INSERT INTO `page` VALUES (19, 'sss', '{\"blocks\":[{\"key\":\"d8pg1\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', 'uploads/1633265044.JPG', '2021-10-03 20:44:04', '2021-10-03 20:44:04', 1);
INSERT INTO `page` VALUES (20, 'asdasd', '{\"blocks\":[{\"key\":\"eoo9u\",\"text\":\"asdasa\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', 'uploads/1633265222.JPG', '2021-10-03 20:47:02', '2021-10-03 20:47:02', 3);

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
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pageImage
-- ----------------------------
INSERT INTO `pageImage` VALUES (11, 'uploads/01633239039.jpg', '2021-10-03 13:30:39', '2021-10-03 13:45:54', NULL);
INSERT INTO `pageImage` VALUES (12, 'uploads/11633239039.JPG', '2021-10-03 13:30:39', '2021-10-03 13:45:54', NULL);
INSERT INTO `pageImage` VALUES (13, 'uploads/21633239039.JPG', '2021-10-03 13:30:39', '2021-10-03 13:45:54', NULL);
INSERT INTO `pageImage` VALUES (14, 'uploads/01633239954.', '2021-10-03 13:45:54', '2021-10-03 13:52:25', NULL);
INSERT INTO `pageImage` VALUES (15, 'uploads/11633239954.', '2021-10-03 13:45:54', '2021-10-03 13:52:25', NULL);
INSERT INTO `pageImage` VALUES (16, 'uploads/01633240345.', '2021-10-03 13:52:25', '2021-10-03 13:54:52', NULL);
INSERT INTO `pageImage` VALUES (17, 'uploads/11633240345.', '2021-10-03 13:52:25', '2021-10-03 13:54:52', NULL);
INSERT INTO `pageImage` VALUES (18, 'uploads/01633240492.jpg', '2021-10-03 13:54:52', '2021-10-03 14:18:04', NULL);
INSERT INTO `pageImage` VALUES (19, 'uploads/01633242118.jpg', '2021-10-03 14:21:58', '2021-10-03 14:22:08', NULL);
INSERT INTO `pageImage` VALUES (20, 'uploads/01633242229.JPG', '2021-10-03 14:23:49', '2021-10-03 14:24:33', NULL);
INSERT INTO `pageImage` VALUES (21, 'uploads/01633242273.JPG', '2021-10-03 14:24:33', '2021-10-03 14:25:21', NULL);
INSERT INTO `pageImage` VALUES (22, 'uploads/01633242321.JPG', '2021-10-03 14:25:21', '2021-10-03 14:28:41', NULL);
INSERT INTO `pageImage` VALUES (23, 'uploads/01633242521.JPG', '2021-10-03 14:28:41', '2021-10-03 14:29:33', NULL);
INSERT INTO `pageImage` VALUES (24, 'uploads/01633242573.JPG', '2021-10-03 14:29:33', '2021-10-03 14:31:06', NULL);
INSERT INTO `pageImage` VALUES (25, 'uploads/01633242666.JPG', '2021-10-03 14:31:06', '2021-10-03 14:32:28', NULL);
INSERT INTO `pageImage` VALUES (26, 'uploads/01633242748.JPG', '2021-10-03 14:32:28', '2021-10-03 14:32:35', NULL);
INSERT INTO `pageImage` VALUES (27, 'uploads/01633242755.JPG', '2021-10-03 14:32:35', '2021-10-03 14:33:21', NULL);
INSERT INTO `pageImage` VALUES (28, 'uploads/01633242801.JPG', '2021-10-03 14:33:21', '2021-10-03 14:34:32', NULL);
INSERT INTO `pageImage` VALUES (29, 'uploads/01633242872.JPG', '2021-10-03 14:34:32', '2021-10-03 14:35:26', NULL);
INSERT INTO `pageImage` VALUES (30, 'uploads/01633242926.JPG', '2021-10-03 14:35:26', '2021-10-03 14:35:26', NULL);
INSERT INTO `pageImage` VALUES (31, 'uploads/01633244435.JPG', '2021-10-03 15:00:35', '2021-10-03 15:00:46', NULL);
INSERT INTO `pageImage` VALUES (32, 'uploads/11633244435.JPG', '2021-10-03 15:00:35', '2021-10-03 15:00:46', NULL);
INSERT INTO `pageImage` VALUES (33, 'uploads/21633244435.JPG', '2021-10-03 15:00:35', '2021-10-03 15:00:46', NULL);
INSERT INTO `pageImage` VALUES (34, 'uploads/01633244446.JPG', '2021-10-03 15:00:46', '2021-10-03 15:03:41', NULL);
INSERT INTO `pageImage` VALUES (35, 'uploads/11633244446.JPG', '2021-10-03 15:00:46', '2021-10-03 15:03:41', NULL);
INSERT INTO `pageImage` VALUES (40, 'uploads/01633265025.jpg', '2021-10-03 20:43:45', '2021-10-03 20:43:45', 18);
INSERT INTO `pageImage` VALUES (41, 'uploads/11633265025.JPG', '2021-10-03 20:43:45', '2021-10-03 20:43:45', 18);
INSERT INTO `pageImage` VALUES (42, 'uploads/01633265044.jpg', '2021-10-03 20:44:04', '2021-10-03 20:44:04', 19);
INSERT INTO `pageImage` VALUES (43, 'uploads/01633265222.JPG', '2021-10-03 20:47:02', '2021-10-03 20:47:02', 20);
INSERT INTO `pageImage` VALUES (44, 'uploads/11633265222.JPG', '2021-10-03 20:47:02', '2021-10-03 20:47:02', 20);

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
  `module` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模組名稱',
  `setting` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '設定欄位',
  `value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '值',
  `created_at` datetime(0) NOT NULL COMMENT '建立時間',
  `updated_at` datetime(0) NOT NULL COMMENT '修改時間'
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('BASE', 'community_name', '', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `setting` VALUES ('BASE', 'community_address', '', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `setting` VALUES ('BASE', 'community_host', '', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `setting` VALUES ('BASE', 'community_contact', '', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `setting` VALUES ('BASE', 'community_phone', '', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `setting` VALUES ('BASE', 'community_email', '', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `setting` VALUES ('BASE', 'community_facebook', '', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `setting` VALUES ('BASE', 'community_instagram', '', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `setting` VALUES ('BASE', 'community_introduce', '', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `setting` VALUES ('BASE', 'community_image', '', '2021-10-01 12:55:40', '2021-10-01 12:55:40');
INSERT INTO `setting` VALUES ('BASE', 'community_name', '', '2021-10-03 21:02:30', '2021-10-03 21:02:30');
INSERT INTO `setting` VALUES ('BASE', 'community_address', '', '2021-10-03 21:02:30', '2021-10-03 21:02:30');
INSERT INTO `setting` VALUES ('BASE', 'community_host', '', '2021-10-03 21:02:30', '2021-10-03 21:02:30');
INSERT INTO `setting` VALUES ('BASE', 'community_contact', '', '2021-10-03 21:02:30', '2021-10-03 21:02:30');
INSERT INTO `setting` VALUES ('BASE', 'community_phone', '', '2021-10-03 21:02:30', '2021-10-03 21:02:30');
INSERT INTO `setting` VALUES ('BASE', 'community_email', '', '2021-10-03 21:02:30', '2021-10-03 21:02:30');
INSERT INTO `setting` VALUES ('BASE', 'community_facebook', '', '2021-10-03 21:02:30', '2021-10-03 21:02:30');
INSERT INTO `setting` VALUES ('BASE', 'community_instagram', '', '2021-10-03 21:02:30', '2021-10-03 21:02:30');
INSERT INTO `setting` VALUES ('BASE', 'community_introduce', '', '2021-10-03 21:02:30', '2021-10-03 21:02:30');
INSERT INTO `setting` VALUES ('BASE', 'community_image', '', '2021-10-03 21:02:30', '2021-10-03 21:02:30');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '123', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0912345678', 'test@gmail.com', 'admin', '0000-00-00 00:00:00', '2021-10-04 00:17:36');
INSERT INTO `user` VALUES (2, 'l0726', 'l0726', '0cb604ef99cb8584b2a3acb18c429c2644ff0f34', '', 's18113223@stu.edu.tw', 'root', '2021-10-03 21:03:15', '2021-10-03 21:03:15');

SET FOREIGN_KEY_CHECKS = 1;
