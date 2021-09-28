/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100148
 Source Host           : localhost:3306
 Source Schema         : lab_community

 Target Server Type    : MariaDB
 Target Server Version : 100148
 File Encoding         : 65001

 Date: 28/09/2021 22:38:36
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
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, '社區公告', '2021-09-26 13:03:23', '2021-09-26 13:03:23');
INSERT INTO `category` VALUES (2, '社區特色', '2021-09-26 13:03:23', '2021-09-26 13:03:23');
INSERT INTO `category` VALUES (3, '社區特產', '2021-09-26 13:03:23', '2021-09-26 13:03:23');
INSERT INTO `category` VALUES (4, '社區景點', '2021-09-26 13:03:23', '2021-09-26 13:03:23');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (42, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (43, '2021_09_24_040057_pages', 1);
INSERT INTO `migrations` VALUES (44, '2021_09_24_040109_users', 1);
INSERT INTO `migrations` VALUES (45, '2021_09_24_040121_category', 1);
INSERT INTO `migrations` VALUES (46, '2021_09_24_040133_setting', 1);
INSERT INTO `migrations` VALUES (47, '2021_09_24_040145_pageimage', 1);

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章標題',
  `page_content` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章內容',
  `page_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章狀態{T:發佈 F:未發佈}',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL COMMENT '分類ID',
  `page_chosen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '精選圖片',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `page_category_id_foreign`(`category_id`) USING BTREE,
  CONSTRAINT `page_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES (2, 'asd', '{\"blocks\":[{\"key\":\"90vnm\",\"text\":\"asd\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '2021-09-28 13:54:49', '2021-09-28 13:54:49', 1, '');
INSERT INTO `page` VALUES (3, 'asd', '{\"blocks\":[{\"key\":\"90vnm\",\"text\":\"asd\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '2021-09-28 14:05:36', '2021-09-28 14:05:36', 1, '');
INSERT INTO `page` VALUES (4, 'asdas', '{\"blocks\":[{\"key\":\"bns7l\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '2021-09-28 14:07:48', '2021-09-28 14:07:48', 1, '');
INSERT INTO `page` VALUES (5, 'asdas', '{\"blocks\":[{\"key\":\"bns7l\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '2021-09-28 14:08:15', '2021-09-28 14:08:15', 1, '');
INSERT INTO `page` VALUES (6, 'asdas', '{\"blocks\":[{\"key\":\"bns7l\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '2021-09-28 14:14:37', '2021-09-28 14:14:37', 1, 'uploads/1632838477.jpg');
INSERT INTO `page` VALUES (7, 'asdas', '{\"blocks\":[{\"key\":\"bns7l\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '2021-09-28 14:15:49', '2021-09-28 14:15:49', 1, '');
INSERT INTO `page` VALUES (8, 'asdas', '{\"blocks\":[{\"key\":\"bns7l\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '2021-09-28 14:24:34', '2021-09-28 14:24:34', 1, '');
INSERT INTO `page` VALUES (9, 'asdassssss', '{\"blocks\":[{\"key\":\"bns7l\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '2021-09-28 14:32:55', '2021-09-28 14:32:55', 1, 'uploads/1632839575.jpg');
INSERT INTO `page` VALUES (10, 'asdassssss', '{\"blocks\":[{\"key\":\"bns7l\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '2021-09-28 14:33:47', '2021-09-28 14:33:47', 1, 'uploads/1632839627.jpg');
INSERT INTO `page` VALUES (11, 'asdassssss', '{\"blocks\":[{\"key\":\"bns7l\",\"text\":\"\",\"type\":\"unstyled\",\"depth\":0,\"inlineStyleRanges\":[],\"entityRanges\":[],\"data\":{}}],\"entityMap\":{}}', 'T', '2021-09-28 14:34:00', '2021-09-28 14:34:00', 1, 'uploads/1632839640.jpg');

-- ----------------------------
-- Table structure for pageImage
-- ----------------------------
DROP TABLE IF EXISTS `pageImage`;
CREATE TABLE `pageImage`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pageImage_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '圖片名稱',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `pageId` int(10) UNSIGNED NOT NULL COMMENT '文章ID',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pageimage_pageid_foreign`(`pageId`) USING BTREE,
  CONSTRAINT `pageimage_pageid_foreign` FOREIGN KEY (`pageId`) REFERENCES `page` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pageImage
-- ----------------------------
INSERT INTO `pageImage` VALUES (1, 'uploads/1632839640.jpg', '2021-09-28 14:34:00', '2021-09-28 14:34:00', 11);
INSERT INTO `pageImage` VALUES (2, 'uploads/1632839640.png', '2021-09-28 14:34:00', '2021-09-28 14:34:00', 11);
INSERT INTO `pageImage` VALUES (3, 'uploads/1632839640.png', '2021-09-28 14:34:00', '2021-09-28 14:34:00', 11);

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
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('BASE', 'community_name', '', '2021-09-26 12:47:29', '2021-09-26 12:47:29');
INSERT INTO `setting` VALUES ('BASE', 'community_address', '', '2021-09-26 12:47:29', '2021-09-26 12:47:29');
INSERT INTO `setting` VALUES ('BASE', 'community_host', '', '2021-09-26 12:47:29', '2021-09-26 12:47:29');
INSERT INTO `setting` VALUES ('BASE', 'community_contact', '', '2021-09-26 12:47:29', '2021-09-26 12:47:29');
INSERT INTO `setting` VALUES ('BASE', 'community_phone', '', '2021-09-26 12:47:29', '2021-09-26 12:47:29');
INSERT INTO `setting` VALUES ('BASE', 'community_email', '', '2021-09-26 12:47:29', '2021-09-26 12:47:29');
INSERT INTO `setting` VALUES ('BASE', 'community_facebook', '', '2021-09-26 12:47:29', '2021-09-26 12:47:29');
INSERT INTO `setting` VALUES ('BASE', 'community_instagram', '', '2021-09-26 12:47:29', '2021-09-26 12:47:29');
INSERT INTO `setting` VALUES ('BASE', 'community_introduce', '', '2021-09-26 12:47:29', '2021-09-26 12:47:29');
INSERT INTO `setting` VALUES ('BASE', 'community_image', '', '2021-09-26 12:47:29', '2021-09-26 12:47:29');

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
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '123', '123', '123', '', '', '1', NULL, NULL);
INSERT INTO `user` VALUES (2, '1230', '1230', '4560', '4560', '4560', '1', '2021-09-26 10:31:11', '2021-09-26 10:31:11');

SET FOREIGN_KEY_CHECKS = 1;
