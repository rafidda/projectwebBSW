-- MySQL dump 10.13  Distrib 8.4.0, for Win64 (x86_64)
--
-- Host: ::1    Database: local
-- ------------------------------------------------------
-- Server version	8.4.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_commentmeta`
--

LOCK TABLES `wp_commentmeta` WRITE;
/*!40000 ALTER TABLE `wp_commentmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_commentmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_comments` (
  `comment_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'comment',
  `comment_parent` bigint unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_comments`
--

LOCK TABLES `wp_comments` WRITE;
/*!40000 ALTER TABLE `wp_comments` DISABLE KEYS */;
INSERT INTO `wp_comments` VALUES (1,1,'A WordPress Commenter','wapuu@wordpress.example','https://wordpress.org/','','2026-09-10 13:16:14','2026-09-10 13:16:14','Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://gravatar.com/\">Gravatar</a>.',0,'1','','comment',0,0);
/*!40000 ALTER TABLE `wp_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_links` (
  `link_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint unsigned NOT NULL DEFAULT '1',
  `link_rating` int NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_links`
--

LOCK TABLES `wp_links` WRITE;
/*!40000 ALTER TABLE `wp_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_options` (
  `option_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`),
  KEY `autoload` (`autoload`)
) ENGINE=InnoDB AUTO_INCREMENT=703 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_options`
--

LOCK TABLES `wp_options` WRITE;
/*!40000 ALTER TABLE `wp_options` DISABLE KEYS */;
INSERT INTO `wp_options` VALUES (1,'cron','a:12:{i:1789604175;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1789608431;a:1:{s:21:\"wp_update_user_counts\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1789611374;a:1:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1789613174;a:1:{s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1789614974;a:1:{s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1789650975;a:2:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:41:\"wp_privacy_personal_data_cleanup_requests\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1789651631;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1789651636;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1789651724;a:1:{s:30:\"wp_delete_temp_updater_backups\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}i:1789651769;a:1:{s:27:\"acf_update_site_health_data\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1789737375;a:1:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}s:7:\"version\";i:2;}','on');
INSERT INTO `wp_options` VALUES (2,'siteurl','http://wakalumibprscoid.local','on');
INSERT INTO `wp_options` VALUES (3,'home','http://wakalumibprscoid.local','on');
INSERT INTO `wp_options` VALUES (4,'blogname','Bank Syariah Wakalumi - Beranda','on');
INSERT INTO `wp_options` VALUES (5,'blogdescription','Bank Syariah Wakalumi','on');
INSERT INTO `wp_options` VALUES (6,'users_can_register','0','on');
INSERT INTO `wp_options` VALUES (7,'admin_email','dev-email@wpengine.local','on');
INSERT INTO `wp_options` VALUES (8,'start_of_week','1','on');
INSERT INTO `wp_options` VALUES (9,'use_balanceTags','0','on');
INSERT INTO `wp_options` VALUES (10,'use_smilies','1','on');
INSERT INTO `wp_options` VALUES (11,'require_name_email','1','on');
INSERT INTO `wp_options` VALUES (12,'comments_notify','1','on');
INSERT INTO `wp_options` VALUES (13,'posts_per_rss','10','on');
INSERT INTO `wp_options` VALUES (14,'rss_use_excerpt','0','on');
INSERT INTO `wp_options` VALUES (15,'mailserver_url','mail.example.com','on');
INSERT INTO `wp_options` VALUES (16,'mailserver_login','login@example.com','on');
INSERT INTO `wp_options` VALUES (17,'mailserver_pass','','on');
INSERT INTO `wp_options` VALUES (18,'mailserver_port','110','on');
INSERT INTO `wp_options` VALUES (19,'default_category','1','on');
INSERT INTO `wp_options` VALUES (20,'default_comment_status','open','on');
INSERT INTO `wp_options` VALUES (21,'default_ping_status','open','on');
INSERT INTO `wp_options` VALUES (22,'default_pingback_flag','1','on');
INSERT INTO `wp_options` VALUES (23,'posts_per_page','10','on');
INSERT INTO `wp_options` VALUES (24,'date_format','F j, Y','on');
INSERT INTO `wp_options` VALUES (25,'time_format','g:i a','on');
INSERT INTO `wp_options` VALUES (26,'links_updated_date_format','F j, Y g:i a','on');
INSERT INTO `wp_options` VALUES (27,'comment_moderation','0','on');
INSERT INTO `wp_options` VALUES (28,'moderation_notify','1','on');
INSERT INTO `wp_options` VALUES (29,'permalink_structure','/%postname%/','on');
INSERT INTO `wp_options` VALUES (30,'rewrite_rules','a:185:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:17:\"^wp-sitemap\\.xml$\";s:23:\"index.php?sitemap=index\";s:17:\"^wp-sitemap\\.xsl$\";s:36:\"index.php?sitemap-stylesheet=sitemap\";s:23:\"^wp-sitemap-index\\.xsl$\";s:34:\"index.php?sitemap-stylesheet=index\";s:48:\"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:75:\"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]\";s:34:\"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:47:\"index.php?sitemap=$matches[1]&paged=$matches[2]\";s:17:\"katalog-produk/?$\";s:26:\"index.php?post_type=produk\";s:47:\"katalog-produk/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?post_type=produk&feed=$matches[1]\";s:42:\"katalog-produk/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?post_type=produk&feed=$matches[1]\";s:34:\"katalog-produk/page/([0-9]{1,})/?$\";s:44:\"index.php?post_type=produk&paged=$matches[1]\";s:9:\"berita/?$\";s:26:\"index.php?post_type=berita\";s:39:\"berita/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?post_type=berita&feed=$matches[1]\";s:34:\"berita/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?post_type=berita&feed=$matches[1]\";s:26:\"berita/page/([0-9]{1,})/?$\";s:44:\"index.php?post_type=berita&paged=$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:33:\"slide/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:43:\"slide/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:63:\"slide/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"slide/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"slide/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:39:\"slide/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:22:\"slide/([^/]+)/embed/?$\";s:43:\"index.php?hero_slide=$matches[1]&embed=true\";s:26:\"slide/([^/]+)/trackback/?$\";s:37:\"index.php?hero_slide=$matches[1]&tb=1\";s:34:\"slide/([^/]+)/page/?([0-9]{1,})/?$\";s:50:\"index.php?hero_slide=$matches[1]&paged=$matches[2]\";s:41:\"slide/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?hero_slide=$matches[1]&cpage=$matches[2]\";s:30:\"slide/([^/]+)(?:/([0-9]+))?/?$\";s:49:\"index.php?hero_slide=$matches[1]&page=$matches[2]\";s:22:\"slide/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:32:\"slide/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:52:\"slide/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:47:\"slide/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:47:\"slide/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:28:\"slide/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:42:\"katalog-produk/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:52:\"katalog-produk/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:72:\"katalog-produk/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:67:\"katalog-produk/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:67:\"katalog-produk/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:48:\"katalog-produk/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:31:\"katalog-produk/([^/]+)/embed/?$\";s:39:\"index.php?produk=$matches[1]&embed=true\";s:35:\"katalog-produk/([^/]+)/trackback/?$\";s:33:\"index.php?produk=$matches[1]&tb=1\";s:55:\"katalog-produk/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?produk=$matches[1]&feed=$matches[2]\";s:50:\"katalog-produk/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?produk=$matches[1]&feed=$matches[2]\";s:43:\"katalog-produk/([^/]+)/page/?([0-9]{1,})/?$\";s:46:\"index.php?produk=$matches[1]&paged=$matches[2]\";s:50:\"katalog-produk/([^/]+)/comment-page-([0-9]{1,})/?$\";s:46:\"index.php?produk=$matches[1]&cpage=$matches[2]\";s:39:\"katalog-produk/([^/]+)(?:/([0-9]+))?/?$\";s:45:\"index.php?produk=$matches[1]&page=$matches[2]\";s:31:\"katalog-produk/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:41:\"katalog-produk/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:61:\"katalog-produk/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\"katalog-produk/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\"katalog-produk/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:37:\"katalog-produk/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:56:\"kategori-produk/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:54:\"index.php?kategori_produk=$matches[1]&feed=$matches[2]\";s:51:\"kategori-produk/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:54:\"index.php?kategori_produk=$matches[1]&feed=$matches[2]\";s:32:\"kategori-produk/([^/]+)/embed/?$\";s:48:\"index.php?kategori_produk=$matches[1]&embed=true\";s:44:\"kategori-produk/([^/]+)/page/?([0-9]{1,})/?$\";s:55:\"index.php?kategori_produk=$matches[1]&paged=$matches[2]\";s:26:\"kategori-produk/([^/]+)/?$\";s:37:\"index.php?kategori_produk=$matches[1]\";s:34:\"berita/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:44:\"berita/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:64:\"berita/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:59:\"berita/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:59:\"berita/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:40:\"berita/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:23:\"berita/([^/]+)/embed/?$\";s:39:\"index.php?berita=$matches[1]&embed=true\";s:27:\"berita/([^/]+)/trackback/?$\";s:33:\"index.php?berita=$matches[1]&tb=1\";s:47:\"berita/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?berita=$matches[1]&feed=$matches[2]\";s:42:\"berita/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?berita=$matches[1]&feed=$matches[2]\";s:35:\"berita/([^/]+)/page/?([0-9]{1,})/?$\";s:46:\"index.php?berita=$matches[1]&paged=$matches[2]\";s:42:\"berita/([^/]+)/comment-page-([0-9]{1,})/?$\";s:46:\"index.php?berita=$matches[1]&cpage=$matches[2]\";s:31:\"berita/([^/]+)(?:/([0-9]+))?/?$\";s:45:\"index.php?berita=$matches[1]&page=$matches[2]\";s:23:\"berita/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:33:\"berita/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:53:\"berita/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:48:\"berita/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:48:\"berita/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:29:\"berita/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:56:\"kategori-berita/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:54:\"index.php?kategori_berita=$matches[1]&feed=$matches[2]\";s:51:\"kategori-berita/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:54:\"index.php?kategori_berita=$matches[1]&feed=$matches[2]\";s:32:\"kategori-berita/([^/]+)/embed/?$\";s:48:\"index.php?kategori_berita=$matches[1]&embed=true\";s:44:\"kategori-berita/([^/]+)/page/?([0-9]{1,})/?$\";s:55:\"index.php?kategori_berita=$matches[1]&paged=$matches[2]\";s:26:\"kategori-berita/([^/]+)/?$\";s:37:\"index.php?kategori_berita=$matches[1]\";s:31:\"tim/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:41:\"tim/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:61:\"tim/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\"tim/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\"tim/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:37:\"tim/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:20:\"tim/([^/]+)/embed/?$\";s:44:\"index.php?anggota_tim=$matches[1]&embed=true\";s:24:\"tim/([^/]+)/trackback/?$\";s:38:\"index.php?anggota_tim=$matches[1]&tb=1\";s:32:\"tim/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?anggota_tim=$matches[1]&paged=$matches[2]\";s:39:\"tim/([^/]+)/comment-page-([0-9]{1,})/?$\";s:51:\"index.php?anggota_tim=$matches[1]&cpage=$matches[2]\";s:28:\"tim/([^/]+)(?:/([0-9]+))?/?$\";s:50:\"index.php?anggota_tim=$matches[1]&page=$matches[2]\";s:20:\"tim/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:30:\"tim/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:50:\"tim/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:45:\"tim/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:45:\"tim/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:26:\"tim/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:13:\"favicon\\.ico$\";s:19:\"index.php?favicon=1\";s:12:\"sitemap\\.xml\";s:23:\"index.php?sitemap=index\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:27:\"comment-page-([0-9]{1,})/?$\";s:38:\"index.php?&page_id=5&cpage=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}','on');
INSERT INTO `wp_options` VALUES (31,'hack_file','0','on');
INSERT INTO `wp_options` VALUES (32,'blog_charset','UTF-8','on');
INSERT INTO `wp_options` VALUES (33,'moderation_keys','','off');
INSERT INTO `wp_options` VALUES (34,'active_plugins','a:1:{i:0;s:30:\"advanced-custom-fields/acf.php\";}','on');
INSERT INTO `wp_options` VALUES (35,'category_base','','on');
INSERT INTO `wp_options` VALUES (36,'ping_sites','https://rpc.pingomatic.com/','on');
INSERT INTO `wp_options` VALUES (37,'comment_max_links','2','on');
INSERT INTO `wp_options` VALUES (38,'gmt_offset','7','on');
INSERT INTO `wp_options` VALUES (39,'default_email_category','1','on');
INSERT INTO `wp_options` VALUES (40,'recently_edited','','off');
INSERT INTO `wp_options` VALUES (41,'template','assets/..','on');
INSERT INTO `wp_options` VALUES (42,'stylesheet','assets/..','on');
INSERT INTO `wp_options` VALUES (43,'comment_registration','0','on');
INSERT INTO `wp_options` VALUES (44,'html_type','text/html','on');
INSERT INTO `wp_options` VALUES (45,'use_trackback','0','on');
INSERT INTO `wp_options` VALUES (46,'default_role','subscriber','on');
INSERT INTO `wp_options` VALUES (47,'db_version','61833','on');
INSERT INTO `wp_options` VALUES (48,'uploads_use_yearmonth_folders','1','on');
INSERT INTO `wp_options` VALUES (49,'upload_path','','on');
INSERT INTO `wp_options` VALUES (50,'blog_public','1','on');
INSERT INTO `wp_options` VALUES (51,'default_link_category','2','on');
INSERT INTO `wp_options` VALUES (52,'show_on_front','page','on');
INSERT INTO `wp_options` VALUES (53,'tag_base','','on');
INSERT INTO `wp_options` VALUES (54,'show_avatars','1','on');
INSERT INTO `wp_options` VALUES (55,'avatar_rating','G','on');
INSERT INTO `wp_options` VALUES (56,'upload_url_path','','on');
INSERT INTO `wp_options` VALUES (57,'thumbnail_size_w','150','on');
INSERT INTO `wp_options` VALUES (58,'thumbnail_size_h','150','on');
INSERT INTO `wp_options` VALUES (59,'thumbnail_crop','1','on');
INSERT INTO `wp_options` VALUES (60,'medium_size_w','300','on');
INSERT INTO `wp_options` VALUES (61,'medium_size_h','300','on');
INSERT INTO `wp_options` VALUES (62,'avatar_default','mystery','on');
INSERT INTO `wp_options` VALUES (63,'large_size_w','1024','on');
INSERT INTO `wp_options` VALUES (64,'large_size_h','1024','on');
INSERT INTO `wp_options` VALUES (65,'image_default_link_type','none','on');
INSERT INTO `wp_options` VALUES (66,'image_default_size','','on');
INSERT INTO `wp_options` VALUES (67,'image_default_align','','on');
INSERT INTO `wp_options` VALUES (68,'close_comments_for_old_posts','0','on');
INSERT INTO `wp_options` VALUES (69,'close_comments_days_old','14','on');
INSERT INTO `wp_options` VALUES (70,'thread_comments','1','on');
INSERT INTO `wp_options` VALUES (71,'thread_comments_depth','5','on');
INSERT INTO `wp_options` VALUES (72,'page_comments','0','on');
INSERT INTO `wp_options` VALUES (73,'comments_per_page','50','on');
INSERT INTO `wp_options` VALUES (74,'default_comments_page','newest','on');
INSERT INTO `wp_options` VALUES (75,'comment_order','asc','on');
INSERT INTO `wp_options` VALUES (76,'sticky_posts','a:0:{}','on');
INSERT INTO `wp_options` VALUES (77,'widget_categories','a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (78,'widget_text','a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (79,'widget_rss','a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (80,'uninstall_plugins','a:0:{}','off');
INSERT INTO `wp_options` VALUES (81,'timezone_string','','on');
INSERT INTO `wp_options` VALUES (82,'page_for_posts','0','on');
INSERT INTO `wp_options` VALUES (83,'page_on_front','5','on');
INSERT INTO `wp_options` VALUES (84,'default_post_format','0','on');
INSERT INTO `wp_options` VALUES (85,'link_manager_enabled','0','on');
INSERT INTO `wp_options` VALUES (86,'finished_splitting_shared_terms','1','on');
INSERT INTO `wp_options` VALUES (87,'site_icon','11','on');
INSERT INTO `wp_options` VALUES (88,'medium_large_size_w','768','on');
INSERT INTO `wp_options` VALUES (89,'medium_large_size_h','0','on');
INSERT INTO `wp_options` VALUES (90,'wp_page_for_privacy_policy','3','on');
INSERT INTO `wp_options` VALUES (91,'show_comments_cookies_opt_in','1','on');
INSERT INTO `wp_options` VALUES (92,'admin_email_lifespan','1804598174','on');
INSERT INTO `wp_options` VALUES (93,'disallowed_keys','','off');
INSERT INTO `wp_options` VALUES (94,'comment_previously_approved','1','on');
INSERT INTO `wp_options` VALUES (95,'auto_plugin_theme_update_emails','a:0:{}','off');
INSERT INTO `wp_options` VALUES (96,'auto_update_core_dev','enabled','on');
INSERT INTO `wp_options` VALUES (97,'auto_update_core_minor','enabled','on');
INSERT INTO `wp_options` VALUES (98,'auto_update_core_major','enabled','on');
INSERT INTO `wp_options` VALUES (99,'wp_force_deactivated_plugins','a:0:{}','on');
INSERT INTO `wp_options` VALUES (100,'wp_attachment_pages_enabled','0','on');
INSERT INTO `wp_options` VALUES (101,'wp_notes_notify','1','on');
INSERT INTO `wp_options` VALUES (102,'initial_db_version','61833','on');
INSERT INTO `wp_options` VALUES (103,'wp_user_roles','a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}','on');
INSERT INTO `wp_options` VALUES (104,'fresh_site','0','off');
INSERT INTO `wp_options` VALUES (105,'user_count','1','off');
INSERT INTO `wp_options` VALUES (106,'widget_block','a:6:{i:2;a:1:{s:7:\"content\";s:19:\"<!-- wp:search /-->\";}i:3;a:1:{s:7:\"content\";s:154:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Recent Posts</h2><!-- /wp:heading --><!-- wp:latest-posts /--></div><!-- /wp:group -->\";}i:4;a:1:{s:7:\"content\";s:227:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Recent Comments</h2><!-- /wp:heading --><!-- wp:latest-comments {\"displayAvatar\":false,\"displayDate\":false,\"displayExcerpt\":false} /--></div><!-- /wp:group -->\";}i:5;a:1:{s:7:\"content\";s:146:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Archives</h2><!-- /wp:heading --><!-- wp:archives /--></div><!-- /wp:group -->\";}i:6;a:1:{s:7:\"content\";s:150:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Categories</h2><!-- /wp:heading --><!-- wp:categories /--></div><!-- /wp:group -->\";}s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (107,'sidebars_widgets','a:2:{s:19:\"wp_inactive_widgets\";a:5:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";i:3;s:7:\"block-5\";i:4;s:7:\"block-6\";}s:13:\"array_version\";i:3;}','auto');
INSERT INTO `wp_options` VALUES (108,'widget_pages','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (109,'widget_calendar','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (110,'widget_archives','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (111,'widget_media_audio','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (112,'widget_media_image','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (113,'widget_media_gallery','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (114,'widget_media_video','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (115,'widget_meta','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (116,'widget_search','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (117,'widget_recent-posts','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (118,'widget_recent-comments','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (119,'widget_tag_cloud','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (120,'widget_nav_menu','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (121,'widget_custom_html','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (122,'_transient_wp_core_block_css_files','a:2:{s:7:\"version\";s:3:\"7.1\";s:5:\"files\";a:624:{i:0;s:31:\"accordion-heading/style-rtl.css\";i:1;s:35:\"accordion-heading/style-rtl.min.css\";i:2;s:27:\"accordion-heading/style.css\";i:3;s:31:\"accordion-heading/style.min.css\";i:4;s:28:\"accordion-item/style-rtl.css\";i:5;s:32:\"accordion-item/style-rtl.min.css\";i:6;s:24:\"accordion-item/style.css\";i:7;s:28:\"accordion-item/style.min.css\";i:8;s:29:\"accordion-panel/style-rtl.css\";i:9;s:33:\"accordion-panel/style-rtl.min.css\";i:10;s:25:\"accordion-panel/style.css\";i:11;s:29:\"accordion-panel/style.min.css\";i:12;s:23:\"accordion/style-rtl.css\";i:13;s:27:\"accordion/style-rtl.min.css\";i:14;s:19:\"accordion/style.css\";i:15;s:23:\"accordion/style.min.css\";i:16;s:22:\"archives/style-rtl.css\";i:17;s:26:\"archives/style-rtl.min.css\";i:18;s:18:\"archives/style.css\";i:19;s:22:\"archives/style.min.css\";i:20;s:20:\"audio/editor-rtl.css\";i:21;s:24:\"audio/editor-rtl.min.css\";i:22;s:16:\"audio/editor.css\";i:23;s:20:\"audio/editor.min.css\";i:24;s:19:\"audio/style-rtl.css\";i:25;s:23:\"audio/style-rtl.min.css\";i:26;s:15:\"audio/style.css\";i:27;s:19:\"audio/style.min.css\";i:28;s:19:\"audio/theme-rtl.css\";i:29;s:23:\"audio/theme-rtl.min.css\";i:30;s:15:\"audio/theme.css\";i:31;s:19:\"audio/theme.min.css\";i:32;s:21:\"avatar/editor-rtl.css\";i:33;s:25:\"avatar/editor-rtl.min.css\";i:34;s:17:\"avatar/editor.css\";i:35;s:21:\"avatar/editor.min.css\";i:36;s:20:\"avatar/style-rtl.css\";i:37;s:24:\"avatar/style-rtl.min.css\";i:38;s:16:\"avatar/style.css\";i:39;s:20:\"avatar/style.min.css\";i:40;s:25:\"breadcrumbs/style-rtl.css\";i:41;s:29:\"breadcrumbs/style-rtl.min.css\";i:42;s:21:\"breadcrumbs/style.css\";i:43;s:25:\"breadcrumbs/style.min.css\";i:44;s:21:\"button/editor-rtl.css\";i:45;s:25:\"button/editor-rtl.min.css\";i:46;s:17:\"button/editor.css\";i:47;s:21:\"button/editor.min.css\";i:48;s:20:\"button/style-rtl.css\";i:49;s:24:\"button/style-rtl.min.css\";i:50;s:16:\"button/style.css\";i:51;s:20:\"button/style.min.css\";i:52;s:22:\"buttons/editor-rtl.css\";i:53;s:26:\"buttons/editor-rtl.min.css\";i:54;s:18:\"buttons/editor.css\";i:55;s:22:\"buttons/editor.min.css\";i:56;s:21:\"buttons/style-rtl.css\";i:57;s:25:\"buttons/style-rtl.min.css\";i:58;s:17:\"buttons/style.css\";i:59;s:21:\"buttons/style.min.css\";i:60;s:22:\"calendar/style-rtl.css\";i:61;s:26:\"calendar/style-rtl.min.css\";i:62;s:18:\"calendar/style.css\";i:63;s:22:\"calendar/style.min.css\";i:64;s:25:\"categories/editor-rtl.css\";i:65;s:29:\"categories/editor-rtl.min.css\";i:66;s:21:\"categories/editor.css\";i:67;s:25:\"categories/editor.min.css\";i:68;s:24:\"categories/style-rtl.css\";i:69;s:28:\"categories/style-rtl.min.css\";i:70;s:20:\"categories/style.css\";i:71;s:24:\"categories/style.min.css\";i:72;s:19:\"code/editor-rtl.css\";i:73;s:23:\"code/editor-rtl.min.css\";i:74;s:15:\"code/editor.css\";i:75;s:19:\"code/editor.min.css\";i:76;s:18:\"code/style-rtl.css\";i:77;s:22:\"code/style-rtl.min.css\";i:78;s:14:\"code/style.css\";i:79;s:18:\"code/style.min.css\";i:80;s:18:\"code/theme-rtl.css\";i:81;s:22:\"code/theme-rtl.min.css\";i:82;s:14:\"code/theme.css\";i:83;s:18:\"code/theme.min.css\";i:84;s:22:\"columns/editor-rtl.css\";i:85;s:26:\"columns/editor-rtl.min.css\";i:86;s:18:\"columns/editor.css\";i:87;s:22:\"columns/editor.min.css\";i:88;s:21:\"columns/style-rtl.css\";i:89;s:25:\"columns/style-rtl.min.css\";i:90;s:17:\"columns/style.css\";i:91;s:21:\"columns/style.min.css\";i:92;s:33:\"comment-author-name/style-rtl.css\";i:93;s:37:\"comment-author-name/style-rtl.min.css\";i:94;s:29:\"comment-author-name/style.css\";i:95;s:33:\"comment-author-name/style.min.css\";i:96;s:29:\"comment-content/style-rtl.css\";i:97;s:33:\"comment-content/style-rtl.min.css\";i:98;s:25:\"comment-content/style.css\";i:99;s:29:\"comment-content/style.min.css\";i:100;s:26:\"comment-date/style-rtl.css\";i:101;s:30:\"comment-date/style-rtl.min.css\";i:102;s:22:\"comment-date/style.css\";i:103;s:26:\"comment-date/style.min.css\";i:104;s:31:\"comment-edit-link/style-rtl.css\";i:105;s:35:\"comment-edit-link/style-rtl.min.css\";i:106;s:27:\"comment-edit-link/style.css\";i:107;s:31:\"comment-edit-link/style.min.css\";i:108;s:32:\"comment-reply-link/style-rtl.css\";i:109;s:36:\"comment-reply-link/style-rtl.min.css\";i:110;s:28:\"comment-reply-link/style.css\";i:111;s:32:\"comment-reply-link/style.min.css\";i:112;s:30:\"comment-template/style-rtl.css\";i:113;s:34:\"comment-template/style-rtl.min.css\";i:114;s:26:\"comment-template/style.css\";i:115;s:30:\"comment-template/style.min.css\";i:116;s:42:\"comments-pagination-numbers/editor-rtl.css\";i:117;s:46:\"comments-pagination-numbers/editor-rtl.min.css\";i:118;s:38:\"comments-pagination-numbers/editor.css\";i:119;s:42:\"comments-pagination-numbers/editor.min.css\";i:120;s:34:\"comments-pagination/editor-rtl.css\";i:121;s:38:\"comments-pagination/editor-rtl.min.css\";i:122;s:30:\"comments-pagination/editor.css\";i:123;s:34:\"comments-pagination/editor.min.css\";i:124;s:33:\"comments-pagination/style-rtl.css\";i:125;s:37:\"comments-pagination/style-rtl.min.css\";i:126;s:29:\"comments-pagination/style.css\";i:127;s:33:\"comments-pagination/style.min.css\";i:128;s:29:\"comments-title/editor-rtl.css\";i:129;s:33:\"comments-title/editor-rtl.min.css\";i:130;s:25:\"comments-title/editor.css\";i:131;s:29:\"comments-title/editor.min.css\";i:132;s:23:\"comments/editor-rtl.css\";i:133;s:27:\"comments/editor-rtl.min.css\";i:134;s:19:\"comments/editor.css\";i:135;s:23:\"comments/editor.min.css\";i:136;s:22:\"comments/style-rtl.css\";i:137;s:26:\"comments/style-rtl.min.css\";i:138;s:18:\"comments/style.css\";i:139;s:22:\"comments/style.min.css\";i:140;s:20:\"cover/editor-rtl.css\";i:141;s:24:\"cover/editor-rtl.min.css\";i:142;s:16:\"cover/editor.css\";i:143;s:20:\"cover/editor.min.css\";i:144;s:19:\"cover/style-rtl.css\";i:145;s:23:\"cover/style-rtl.min.css\";i:146;s:15:\"cover/style.css\";i:147;s:19:\"cover/style.min.css\";i:148;s:22:\"details/editor-rtl.css\";i:149;s:26:\"details/editor-rtl.min.css\";i:150;s:18:\"details/editor.css\";i:151;s:22:\"details/editor.min.css\";i:152;s:21:\"details/style-rtl.css\";i:153;s:25:\"details/style-rtl.min.css\";i:154;s:17:\"details/style.css\";i:155;s:21:\"details/style.min.css\";i:156;s:20:\"embed/editor-rtl.css\";i:157;s:24:\"embed/editor-rtl.min.css\";i:158;s:16:\"embed/editor.css\";i:159;s:20:\"embed/editor.min.css\";i:160;s:19:\"embed/style-rtl.css\";i:161;s:23:\"embed/style-rtl.min.css\";i:162;s:15:\"embed/style.css\";i:163;s:19:\"embed/style.min.css\";i:164;s:19:\"embed/theme-rtl.css\";i:165;s:23:\"embed/theme-rtl.min.css\";i:166;s:15:\"embed/theme.css\";i:167;s:19:\"embed/theme.min.css\";i:168;s:19:\"file/editor-rtl.css\";i:169;s:23:\"file/editor-rtl.min.css\";i:170;s:15:\"file/editor.css\";i:171;s:19:\"file/editor.min.css\";i:172;s:18:\"file/style-rtl.css\";i:173;s:22:\"file/style-rtl.min.css\";i:174;s:14:\"file/style.css\";i:175;s:18:\"file/style.min.css\";i:176;s:23:\"footnotes/style-rtl.css\";i:177;s:27:\"footnotes/style-rtl.min.css\";i:178;s:19:\"footnotes/style.css\";i:179;s:23:\"footnotes/style.min.css\";i:180;s:23:\"freeform/editor-rtl.css\";i:181;s:27:\"freeform/editor-rtl.min.css\";i:182;s:19:\"freeform/editor.css\";i:183;s:23:\"freeform/editor.min.css\";i:184;s:22:\"gallery/editor-rtl.css\";i:185;s:26:\"gallery/editor-rtl.min.css\";i:186;s:18:\"gallery/editor.css\";i:187;s:22:\"gallery/editor.min.css\";i:188;s:21:\"gallery/style-rtl.css\";i:189;s:25:\"gallery/style-rtl.min.css\";i:190;s:17:\"gallery/style.css\";i:191;s:21:\"gallery/style.min.css\";i:192;s:21:\"gallery/theme-rtl.css\";i:193;s:25:\"gallery/theme-rtl.min.css\";i:194;s:17:\"gallery/theme.css\";i:195;s:21:\"gallery/theme.min.css\";i:196;s:20:\"group/editor-rtl.css\";i:197;s:24:\"group/editor-rtl.min.css\";i:198;s:16:\"group/editor.css\";i:199;s:20:\"group/editor.min.css\";i:200;s:19:\"group/style-rtl.css\";i:201;s:23:\"group/style-rtl.min.css\";i:202;s:15:\"group/style.css\";i:203;s:19:\"group/style.min.css\";i:204;s:19:\"group/theme-rtl.css\";i:205;s:23:\"group/theme-rtl.min.css\";i:206;s:15:\"group/theme.css\";i:207;s:19:\"group/theme.min.css\";i:208;s:21:\"heading/style-rtl.css\";i:209;s:25:\"heading/style-rtl.min.css\";i:210;s:17:\"heading/style.css\";i:211;s:21:\"heading/style.min.css\";i:212;s:19:\"html/editor-rtl.css\";i:213;s:23:\"html/editor-rtl.min.css\";i:214;s:15:\"html/editor.css\";i:215;s:19:\"html/editor.min.css\";i:216;s:19:\"icon/editor-rtl.css\";i:217;s:23:\"icon/editor-rtl.min.css\";i:218;s:15:\"icon/editor.css\";i:219;s:19:\"icon/editor.min.css\";i:220;s:18:\"icon/style-rtl.css\";i:221;s:22:\"icon/style-rtl.min.css\";i:222;s:14:\"icon/style.css\";i:223;s:18:\"icon/style.min.css\";i:224;s:20:\"image/editor-rtl.css\";i:225;s:24:\"image/editor-rtl.min.css\";i:226;s:16:\"image/editor.css\";i:227;s:20:\"image/editor.min.css\";i:228;s:19:\"image/style-rtl.css\";i:229;s:23:\"image/style-rtl.min.css\";i:230;s:15:\"image/style.css\";i:231;s:19:\"image/style.min.css\";i:232;s:19:\"image/theme-rtl.css\";i:233;s:23:\"image/theme-rtl.min.css\";i:234;s:15:\"image/theme.css\";i:235;s:19:\"image/theme.min.css\";i:236;s:29:\"latest-comments/style-rtl.css\";i:237;s:33:\"latest-comments/style-rtl.min.css\";i:238;s:25:\"latest-comments/style.css\";i:239;s:29:\"latest-comments/style.min.css\";i:240;s:27:\"latest-posts/editor-rtl.css\";i:241;s:31:\"latest-posts/editor-rtl.min.css\";i:242;s:23:\"latest-posts/editor.css\";i:243;s:27:\"latest-posts/editor.min.css\";i:244;s:26:\"latest-posts/style-rtl.css\";i:245;s:30:\"latest-posts/style-rtl.min.css\";i:246;s:22:\"latest-posts/style.css\";i:247;s:26:\"latest-posts/style.min.css\";i:248;s:18:\"list/style-rtl.css\";i:249;s:22:\"list/style-rtl.min.css\";i:250;s:14:\"list/style.css\";i:251;s:18:\"list/style.min.css\";i:252;s:22:\"loginout/style-rtl.css\";i:253;s:26:\"loginout/style-rtl.min.css\";i:254;s:18:\"loginout/style.css\";i:255;s:22:\"loginout/style.min.css\";i:256;s:19:\"math/editor-rtl.css\";i:257;s:23:\"math/editor-rtl.min.css\";i:258;s:15:\"math/editor.css\";i:259;s:19:\"math/editor.min.css\";i:260;s:18:\"math/style-rtl.css\";i:261;s:22:\"math/style-rtl.min.css\";i:262;s:14:\"math/style.css\";i:263;s:18:\"math/style.min.css\";i:264;s:25:\"media-text/editor-rtl.css\";i:265;s:29:\"media-text/editor-rtl.min.css\";i:266;s:21:\"media-text/editor.css\";i:267;s:25:\"media-text/editor.min.css\";i:268;s:24:\"media-text/style-rtl.css\";i:269;s:28:\"media-text/style-rtl.min.css\";i:270;s:20:\"media-text/style.css\";i:271;s:24:\"media-text/style.min.css\";i:272;s:19:\"more/editor-rtl.css\";i:273;s:23:\"more/editor-rtl.min.css\";i:274;s:15:\"more/editor.css\";i:275;s:19:\"more/editor.min.css\";i:276;s:30:\"navigation-link/editor-rtl.css\";i:277;s:34:\"navigation-link/editor-rtl.min.css\";i:278;s:26:\"navigation-link/editor.css\";i:279;s:30:\"navigation-link/editor.min.css\";i:280;s:29:\"navigation-link/style-rtl.css\";i:281;s:33:\"navigation-link/style-rtl.min.css\";i:282;s:25:\"navigation-link/style.css\";i:283;s:29:\"navigation-link/style.min.css\";i:284;s:38:\"navigation-overlay-close/style-rtl.css\";i:285;s:42:\"navigation-overlay-close/style-rtl.min.css\";i:286;s:34:\"navigation-overlay-close/style.css\";i:287;s:38:\"navigation-overlay-close/style.min.css\";i:288;s:33:\"navigation-submenu/editor-rtl.css\";i:289;s:37:\"navigation-submenu/editor-rtl.min.css\";i:290;s:29:\"navigation-submenu/editor.css\";i:291;s:33:\"navigation-submenu/editor.min.css\";i:292;s:25:\"navigation/editor-rtl.css\";i:293;s:29:\"navigation/editor-rtl.min.css\";i:294;s:21:\"navigation/editor.css\";i:295;s:25:\"navigation/editor.min.css\";i:296;s:24:\"navigation/style-rtl.css\";i:297;s:28:\"navigation/style-rtl.min.css\";i:298;s:20:\"navigation/style.css\";i:299;s:24:\"navigation/style.min.css\";i:300;s:23:\"nextpage/editor-rtl.css\";i:301;s:27:\"nextpage/editor-rtl.min.css\";i:302;s:19:\"nextpage/editor.css\";i:303;s:23:\"nextpage/editor.min.css\";i:304;s:24:\"page-list/editor-rtl.css\";i:305;s:28:\"page-list/editor-rtl.min.css\";i:306;s:20:\"page-list/editor.css\";i:307;s:24:\"page-list/editor.min.css\";i:308;s:23:\"page-list/style-rtl.css\";i:309;s:27:\"page-list/style-rtl.min.css\";i:310;s:19:\"page-list/style.css\";i:311;s:23:\"page-list/style.min.css\";i:312;s:24:\"paragraph/editor-rtl.css\";i:313;s:28:\"paragraph/editor-rtl.min.css\";i:314;s:20:\"paragraph/editor.css\";i:315;s:24:\"paragraph/editor.min.css\";i:316;s:23:\"paragraph/style-rtl.css\";i:317;s:27:\"paragraph/style-rtl.min.css\";i:318;s:19:\"paragraph/style.css\";i:319;s:23:\"paragraph/style.min.css\";i:320;s:28:\"playlist-track/style-rtl.css\";i:321;s:32:\"playlist-track/style-rtl.min.css\";i:322;s:24:\"playlist-track/style.css\";i:323;s:28:\"playlist-track/style.min.css\";i:324;s:23:\"playlist/editor-rtl.css\";i:325;s:27:\"playlist/editor-rtl.min.css\";i:326;s:19:\"playlist/editor.css\";i:327;s:23:\"playlist/editor.min.css\";i:328;s:22:\"playlist/style-rtl.css\";i:329;s:26:\"playlist/style-rtl.min.css\";i:330;s:18:\"playlist/style.css\";i:331;s:22:\"playlist/style.min.css\";i:332;s:35:\"post-author-biography/style-rtl.css\";i:333;s:39:\"post-author-biography/style-rtl.min.css\";i:334;s:31:\"post-author-biography/style.css\";i:335;s:35:\"post-author-biography/style.min.css\";i:336;s:30:\"post-author-name/style-rtl.css\";i:337;s:34:\"post-author-name/style-rtl.min.css\";i:338;s:26:\"post-author-name/style.css\";i:339;s:30:\"post-author-name/style.min.css\";i:340;s:26:\"post-author/editor-rtl.css\";i:341;s:30:\"post-author/editor-rtl.min.css\";i:342;s:22:\"post-author/editor.css\";i:343;s:26:\"post-author/editor.min.css\";i:344;s:25:\"post-author/style-rtl.css\";i:345;s:29:\"post-author/style-rtl.min.css\";i:346;s:21:\"post-author/style.css\";i:347;s:25:\"post-author/style.min.css\";i:348;s:33:\"post-comments-count/style-rtl.css\";i:349;s:37:\"post-comments-count/style-rtl.min.css\";i:350;s:29:\"post-comments-count/style.css\";i:351;s:33:\"post-comments-count/style.min.css\";i:352;s:33:\"post-comments-form/editor-rtl.css\";i:353;s:37:\"post-comments-form/editor-rtl.min.css\";i:354;s:29:\"post-comments-form/editor.css\";i:355;s:33:\"post-comments-form/editor.min.css\";i:356;s:32:\"post-comments-form/style-rtl.css\";i:357;s:36:\"post-comments-form/style-rtl.min.css\";i:358;s:28:\"post-comments-form/style.css\";i:359;s:32:\"post-comments-form/style.min.css\";i:360;s:32:\"post-comments-link/style-rtl.css\";i:361;s:36:\"post-comments-link/style-rtl.min.css\";i:362;s:28:\"post-comments-link/style.css\";i:363;s:32:\"post-comments-link/style.min.css\";i:364;s:26:\"post-content/style-rtl.css\";i:365;s:30:\"post-content/style-rtl.min.css\";i:366;s:22:\"post-content/style.css\";i:367;s:26:\"post-content/style.min.css\";i:368;s:23:\"post-date/style-rtl.css\";i:369;s:27:\"post-date/style-rtl.min.css\";i:370;s:19:\"post-date/style.css\";i:371;s:23:\"post-date/style.min.css\";i:372;s:27:\"post-excerpt/editor-rtl.css\";i:373;s:31:\"post-excerpt/editor-rtl.min.css\";i:374;s:23:\"post-excerpt/editor.css\";i:375;s:27:\"post-excerpt/editor.min.css\";i:376;s:26:\"post-excerpt/style-rtl.css\";i:377;s:30:\"post-excerpt/style-rtl.min.css\";i:378;s:22:\"post-excerpt/style.css\";i:379;s:26:\"post-excerpt/style.min.css\";i:380;s:34:\"post-featured-image/editor-rtl.css\";i:381;s:38:\"post-featured-image/editor-rtl.min.css\";i:382;s:30:\"post-featured-image/editor.css\";i:383;s:34:\"post-featured-image/editor.min.css\";i:384;s:33:\"post-featured-image/style-rtl.css\";i:385;s:37:\"post-featured-image/style-rtl.min.css\";i:386;s:29:\"post-featured-image/style.css\";i:387;s:33:\"post-featured-image/style.min.css\";i:388;s:34:\"post-navigation-link/style-rtl.css\";i:389;s:38:\"post-navigation-link/style-rtl.min.css\";i:390;s:30:\"post-navigation-link/style.css\";i:391;s:34:\"post-navigation-link/style.min.css\";i:392;s:27:\"post-template/style-rtl.css\";i:393;s:31:\"post-template/style-rtl.min.css\";i:394;s:23:\"post-template/style.css\";i:395;s:27:\"post-template/style.min.css\";i:396;s:24:\"post-terms/style-rtl.css\";i:397;s:28:\"post-terms/style-rtl.min.css\";i:398;s:20:\"post-terms/style.css\";i:399;s:24:\"post-terms/style.min.css\";i:400;s:31:\"post-time-to-read/style-rtl.css\";i:401;s:35:\"post-time-to-read/style-rtl.min.css\";i:402;s:27:\"post-time-to-read/style.css\";i:403;s:31:\"post-time-to-read/style.min.css\";i:404;s:24:\"post-title/style-rtl.css\";i:405;s:28:\"post-title/style-rtl.min.css\";i:406;s:20:\"post-title/style.css\";i:407;s:24:\"post-title/style.min.css\";i:408;s:26:\"preformatted/style-rtl.css\";i:409;s:30:\"preformatted/style-rtl.min.css\";i:410;s:22:\"preformatted/style.css\";i:411;s:26:\"preformatted/style.min.css\";i:412;s:24:\"pullquote/editor-rtl.css\";i:413;s:28:\"pullquote/editor-rtl.min.css\";i:414;s:20:\"pullquote/editor.css\";i:415;s:24:\"pullquote/editor.min.css\";i:416;s:23:\"pullquote/style-rtl.css\";i:417;s:27:\"pullquote/style-rtl.min.css\";i:418;s:19:\"pullquote/style.css\";i:419;s:23:\"pullquote/style.min.css\";i:420;s:23:\"pullquote/theme-rtl.css\";i:421;s:27:\"pullquote/theme-rtl.min.css\";i:422;s:19:\"pullquote/theme.css\";i:423;s:23:\"pullquote/theme.min.css\";i:424;s:39:\"query-pagination-numbers/editor-rtl.css\";i:425;s:43:\"query-pagination-numbers/editor-rtl.min.css\";i:426;s:35:\"query-pagination-numbers/editor.css\";i:427;s:39:\"query-pagination-numbers/editor.min.css\";i:428;s:31:\"query-pagination/editor-rtl.css\";i:429;s:35:\"query-pagination/editor-rtl.min.css\";i:430;s:27:\"query-pagination/editor.css\";i:431;s:31:\"query-pagination/editor.min.css\";i:432;s:30:\"query-pagination/style-rtl.css\";i:433;s:34:\"query-pagination/style-rtl.min.css\";i:434;s:26:\"query-pagination/style.css\";i:435;s:30:\"query-pagination/style.min.css\";i:436;s:25:\"query-title/style-rtl.css\";i:437;s:29:\"query-title/style-rtl.min.css\";i:438;s:21:\"query-title/style.css\";i:439;s:25:\"query-title/style.min.css\";i:440;s:25:\"query-total/style-rtl.css\";i:441;s:29:\"query-total/style-rtl.min.css\";i:442;s:21:\"query-total/style.css\";i:443;s:25:\"query-total/style.min.css\";i:444;s:20:\"query/editor-rtl.css\";i:445;s:24:\"query/editor-rtl.min.css\";i:446;s:16:\"query/editor.css\";i:447;s:20:\"query/editor.min.css\";i:448;s:19:\"quote/style-rtl.css\";i:449;s:23:\"quote/style-rtl.min.css\";i:450;s:15:\"quote/style.css\";i:451;s:19:\"quote/style.min.css\";i:452;s:19:\"quote/theme-rtl.css\";i:453;s:23:\"quote/theme-rtl.min.css\";i:454;s:15:\"quote/theme.css\";i:455;s:19:\"quote/theme.min.css\";i:456;s:23:\"read-more/style-rtl.css\";i:457;s:27:\"read-more/style-rtl.min.css\";i:458;s:19:\"read-more/style.css\";i:459;s:23:\"read-more/style.min.css\";i:460;s:18:\"rss/editor-rtl.css\";i:461;s:22:\"rss/editor-rtl.min.css\";i:462;s:14:\"rss/editor.css\";i:463;s:18:\"rss/editor.min.css\";i:464;s:17:\"rss/style-rtl.css\";i:465;s:21:\"rss/style-rtl.min.css\";i:466;s:13:\"rss/style.css\";i:467;s:17:\"rss/style.min.css\";i:468;s:21:\"search/editor-rtl.css\";i:469;s:25:\"search/editor-rtl.min.css\";i:470;s:17:\"search/editor.css\";i:471;s:21:\"search/editor.min.css\";i:472;s:20:\"search/style-rtl.css\";i:473;s:24:\"search/style-rtl.min.css\";i:474;s:16:\"search/style.css\";i:475;s:20:\"search/style.min.css\";i:476;s:20:\"search/theme-rtl.css\";i:477;s:24:\"search/theme-rtl.min.css\";i:478;s:16:\"search/theme.css\";i:479;s:20:\"search/theme.min.css\";i:480;s:24:\"separator/editor-rtl.css\";i:481;s:28:\"separator/editor-rtl.min.css\";i:482;s:20:\"separator/editor.css\";i:483;s:24:\"separator/editor.min.css\";i:484;s:23:\"separator/style-rtl.css\";i:485;s:27:\"separator/style-rtl.min.css\";i:486;s:19:\"separator/style.css\";i:487;s:23:\"separator/style.min.css\";i:488;s:23:\"separator/theme-rtl.css\";i:489;s:27:\"separator/theme-rtl.min.css\";i:490;s:19:\"separator/theme.css\";i:491;s:23:\"separator/theme.min.css\";i:492;s:24:\"shortcode/editor-rtl.css\";i:493;s:28:\"shortcode/editor-rtl.min.css\";i:494;s:20:\"shortcode/editor.css\";i:495;s:24:\"shortcode/editor.min.css\";i:496;s:24:\"site-logo/editor-rtl.css\";i:497;s:28:\"site-logo/editor-rtl.min.css\";i:498;s:20:\"site-logo/editor.css\";i:499;s:24:\"site-logo/editor.min.css\";i:500;s:23:\"site-logo/style-rtl.css\";i:501;s:27:\"site-logo/style-rtl.min.css\";i:502;s:19:\"site-logo/style.css\";i:503;s:23:\"site-logo/style.min.css\";i:504;s:27:\"site-tagline/editor-rtl.css\";i:505;s:31:\"site-tagline/editor-rtl.min.css\";i:506;s:23:\"site-tagline/editor.css\";i:507;s:27:\"site-tagline/editor.min.css\";i:508;s:26:\"site-tagline/style-rtl.css\";i:509;s:30:\"site-tagline/style-rtl.min.css\";i:510;s:22:\"site-tagline/style.css\";i:511;s:26:\"site-tagline/style.min.css\";i:512;s:25:\"site-title/editor-rtl.css\";i:513;s:29:\"site-title/editor-rtl.min.css\";i:514;s:21:\"site-title/editor.css\";i:515;s:25:\"site-title/editor.min.css\";i:516;s:24:\"site-title/style-rtl.css\";i:517;s:28:\"site-title/style-rtl.min.css\";i:518;s:20:\"site-title/style.css\";i:519;s:24:\"site-title/style.min.css\";i:520;s:26:\"social-link/editor-rtl.css\";i:521;s:30:\"social-link/editor-rtl.min.css\";i:522;s:22:\"social-link/editor.css\";i:523;s:26:\"social-link/editor.min.css\";i:524;s:27:\"social-links/editor-rtl.css\";i:525;s:31:\"social-links/editor-rtl.min.css\";i:526;s:23:\"social-links/editor.css\";i:527;s:27:\"social-links/editor.min.css\";i:528;s:26:\"social-links/style-rtl.css\";i:529;s:30:\"social-links/style-rtl.min.css\";i:530;s:22:\"social-links/style.css\";i:531;s:26:\"social-links/style.min.css\";i:532;s:21:\"spacer/editor-rtl.css\";i:533;s:25:\"spacer/editor-rtl.min.css\";i:534;s:17:\"spacer/editor.css\";i:535;s:21:\"spacer/editor.min.css\";i:536;s:20:\"spacer/style-rtl.css\";i:537;s:24:\"spacer/style-rtl.min.css\";i:538;s:16:\"spacer/style.css\";i:539;s:20:\"spacer/style.min.css\";i:540;s:23:\"tab-list/editor-rtl.css\";i:541;s:27:\"tab-list/editor-rtl.min.css\";i:542;s:19:\"tab-list/editor.css\";i:543;s:23:\"tab-list/editor.min.css\";i:544;s:22:\"tab-list/style-rtl.css\";i:545;s:26:\"tab-list/style-rtl.min.css\";i:546;s:18:\"tab-list/style.css\";i:547;s:22:\"tab-list/style.min.css\";i:548;s:23:\"tab-panel/style-rtl.css\";i:549;s:27:\"tab-panel/style-rtl.min.css\";i:550;s:19:\"tab-panel/style.css\";i:551;s:23:\"tab-panel/style.min.css\";i:552;s:20:\"table/editor-rtl.css\";i:553;s:24:\"table/editor-rtl.min.css\";i:554;s:16:\"table/editor.css\";i:555;s:20:\"table/editor.min.css\";i:556;s:19:\"table/style-rtl.css\";i:557;s:23:\"table/style-rtl.min.css\";i:558;s:15:\"table/style.css\";i:559;s:19:\"table/style.min.css\";i:560;s:19:\"table/theme-rtl.css\";i:561;s:23:\"table/theme-rtl.min.css\";i:562;s:15:\"table/theme.css\";i:563;s:19:\"table/theme.min.css\";i:564;s:18:\"tabs/style-rtl.css\";i:565;s:22:\"tabs/style-rtl.min.css\";i:566;s:14:\"tabs/style.css\";i:567;s:18:\"tabs/style.min.css\";i:568;s:23:\"tag-cloud/style-rtl.css\";i:569;s:27:\"tag-cloud/style-rtl.min.css\";i:570;s:19:\"tag-cloud/style.css\";i:571;s:23:\"tag-cloud/style.min.css\";i:572;s:28:\"template-part/editor-rtl.css\";i:573;s:32:\"template-part/editor-rtl.min.css\";i:574;s:24:\"template-part/editor.css\";i:575;s:28:\"template-part/editor.min.css\";i:576;s:27:\"template-part/theme-rtl.css\";i:577;s:31:\"template-part/theme-rtl.min.css\";i:578;s:23:\"template-part/theme.css\";i:579;s:27:\"template-part/theme.min.css\";i:580;s:24:\"term-count/style-rtl.css\";i:581;s:28:\"term-count/style-rtl.min.css\";i:582;s:20:\"term-count/style.css\";i:583;s:24:\"term-count/style.min.css\";i:584;s:30:\"term-description/style-rtl.css\";i:585;s:34:\"term-description/style-rtl.min.css\";i:586;s:26:\"term-description/style.css\";i:587;s:30:\"term-description/style.min.css\";i:588;s:23:\"term-name/style-rtl.css\";i:589;s:27:\"term-name/style-rtl.min.css\";i:590;s:19:\"term-name/style.css\";i:591;s:23:\"term-name/style.min.css\";i:592;s:28:\"term-template/editor-rtl.css\";i:593;s:32:\"term-template/editor-rtl.min.css\";i:594;s:24:\"term-template/editor.css\";i:595;s:28:\"term-template/editor.min.css\";i:596;s:27:\"term-template/style-rtl.css\";i:597;s:31:\"term-template/style-rtl.min.css\";i:598;s:23:\"term-template/style.css\";i:599;s:27:\"term-template/style.min.css\";i:600;s:27:\"text-columns/editor-rtl.css\";i:601;s:31:\"text-columns/editor-rtl.min.css\";i:602;s:23:\"text-columns/editor.css\";i:603;s:27:\"text-columns/editor.min.css\";i:604;s:26:\"text-columns/style-rtl.css\";i:605;s:30:\"text-columns/style-rtl.min.css\";i:606;s:22:\"text-columns/style.css\";i:607;s:26:\"text-columns/style.min.css\";i:608;s:19:\"verse/style-rtl.css\";i:609;s:23:\"verse/style-rtl.min.css\";i:610;s:15:\"verse/style.css\";i:611;s:19:\"verse/style.min.css\";i:612;s:20:\"video/editor-rtl.css\";i:613;s:24:\"video/editor-rtl.min.css\";i:614;s:16:\"video/editor.css\";i:615;s:20:\"video/editor.min.css\";i:616;s:19:\"video/style-rtl.css\";i:617;s:23:\"video/style-rtl.min.css\";i:618;s:15:\"video/style.css\";i:619;s:19:\"video/style.min.css\";i:620;s:19:\"video/theme-rtl.css\";i:621;s:23:\"video/theme-rtl.min.css\";i:622;s:15:\"video/theme.css\";i:623;s:19:\"video/theme.min.css\";}}','on');
INSERT INTO `wp_options` VALUES (126,'recovery_keys','a:0:{}','off');
INSERT INTO `wp_options` VALUES (127,'WPLANG','','auto');
INSERT INTO `wp_options` VALUES (128,'_site_transient_update_core','O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:57:\"https://downloads.wordpress.org/release/wordpress-7.1.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:57:\"https://downloads.wordpress.org/release/wordpress-7.1.zip\";s:10:\"no_content\";s:68:\"https://downloads.wordpress.org/release/wordpress-7.1-no-content.zip\";s:11:\"new_bundled\";s:69:\"https://downloads.wordpress.org/release/wordpress-7.1-new-bundled.zip\";s:7:\"partial\";s:0:\"\";s:8:\"rollback\";s:0:\"\";}s:7:\"current\";s:3:\"7.1\";s:7:\"version\";s:3:\"7.1\";s:11:\"php_version\";s:3:\"7.4\";s:13:\"mysql_version\";s:5:\"5.5.5\";s:11:\"new_bundled\";s:3:\"6.7\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1789593160;s:15:\"version_checked\";s:3:\"7.1\";s:12:\"translations\";a:0:{}}','off');
INSERT INTO `wp_options` VALUES (132,'_site_transient_update_themes','O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1789593166;s:7:\"checked\";a:8:{s:9:\"assets/..\";s:5:\"1.0.0\";s:6:\"inc/..\";s:5:\"1.0.0\";s:15:\"node_modules/..\";s:5:\"1.0.0\";s:17:\"template-parts/..\";s:5:\"1.0.0\";s:16:\"twentytwentyfive\";s:3:\"1.5\";s:16:\"twentytwentyfour\";s:3:\"1.6\";s:17:\"twentytwentythree\";s:3:\"1.7\";s:14:\"wakalumi-theme\";s:5:\"1.0.0\";}s:8:\"response\";a:0:{}s:9:\"no_update\";a:3:{s:16:\"twentytwentyfive\";a:6:{s:5:\"theme\";s:16:\"twentytwentyfive\";s:11:\"new_version\";s:3:\"1.5\";s:3:\"url\";s:46:\"https://wordpress.org/themes/twentytwentyfive/\";s:7:\"package\";s:62:\"https://downloads.wordpress.org/theme/twentytwentyfive.1.5.zip\";s:8:\"requires\";s:3:\"6.7\";s:12:\"requires_php\";s:3:\"7.2\";}s:16:\"twentytwentyfour\";a:6:{s:5:\"theme\";s:16:\"twentytwentyfour\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:46:\"https://wordpress.org/themes/twentytwentyfour/\";s:7:\"package\";s:62:\"https://downloads.wordpress.org/theme/twentytwentyfour.1.6.zip\";s:8:\"requires\";s:3:\"6.4\";s:12:\"requires_php\";s:3:\"7.0\";}s:17:\"twentytwentythree\";a:6:{s:5:\"theme\";s:17:\"twentytwentythree\";s:11:\"new_version\";s:3:\"1.7\";s:3:\"url\";s:47:\"https://wordpress.org/themes/twentytwentythree/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/theme/twentytwentythree.1.7.zip\";s:8:\"requires\";s:3:\"6.1\";s:12:\"requires_php\";s:3:\"5.6\";}}s:12:\"translations\";a:0:{}}','off');
INSERT INTO `wp_options` VALUES (133,'_site_transient_timeout_browser_751d56298673b4d1962564d60150a0de','1789651635','off');
INSERT INTO `wp_options` VALUES (134,'_site_transient_browser_751d56298673b4d1962564d60150a0de','a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:9:\"152.0.0.0\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}','off');
INSERT INTO `wp_options` VALUES (135,'_site_transient_timeout_php_check_986ab27a5c44eb5941b7e3b238532f66','1789651636','off');
INSERT INTO `wp_options` VALUES (136,'_site_transient_php_check_986ab27a5c44eb5941b7e3b238532f66','a:5:{s:19:\"recommended_version\";s:3:\"8.3\";s:15:\"minimum_version\";s:3:\"7.4\";s:12:\"is_supported\";b:0;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}','off');
INSERT INTO `wp_options` VALUES (140,'can_compress_scripts','0','on');
INSERT INTO `wp_options` VALUES (151,'_site_transient_wp_plugin_dependencies_plugin_data','a:0:{}','off');
INSERT INTO `wp_options` VALUES (152,'recently_activated','a:0:{}','off');
INSERT INTO `wp_options` VALUES (157,'finished_updating_comment_type','1','auto');
INSERT INTO `wp_options` VALUES (160,'acf_first_activated_version','6.8.9','on');
INSERT INTO `wp_options` VALUES (161,'acf_site_health','{\"version\":\"6.8.9\",\"plugin_type\":\"Free\",\"update_source\":\"wordpress.org\",\"wp_version\":\"7.1\",\"mysql_version\":\"8.4.0\",\"is_multisite\":false,\"active_theme\":{\"name\":\"Wakalumi Theme\",\"version\":\"1.0.0\",\"theme_uri\":\"https:\\/\\/bprswakalumi.co.id\",\"stylesheet\":false},\"active_plugins\":{\"advanced-custom-fields\\/acf.php\":{\"name\":\"Advanced Custom Fields\",\"version\":\"6.8.9\",\"plugin_uri\":\"https:\\/\\/www.advancedcustomfields.com\"}},\"ui_field_groups\":\"0\",\"php_field_groups\":\"0\",\"json_field_groups\":\"0\",\"rest_field_groups\":\"0\",\"all_location_rules\":[\"post_type==hero_slide\",\"post_type==anggota_tim\",\"post_type==produk\",\"post_type==berita\",\"page_type==front_page\",\"page_template==front-page.php\"],\"field_groups_by_post_type\":[{\"post_type\":\"anggota_tim\",\"field_group_count\":1},{\"post_type\":\"berita\",\"field_group_count\":1},{\"post_type\":\"hero_slide\",\"field_group_count\":1},{\"post_type\":\"produk\",\"field_group_count\":1}],\"number_of_fields_by_type\":{\"textarea\":4,\"text\":14,\"number\":2,\"select\":1,\"true_false\":1,\"wysiwyg\":1,\"image\":1},\"number_of_third_party_fields_by_type\":[],\"post_types_enabled\":true,\"ui_post_types\":\"0\",\"json_post_types\":\"0\",\"ui_taxonomies\":\"0\",\"json_taxonomies\":\"0\",\"rest_api_format\":\"light\",\"admin_ui_enabled\":true,\"field_type-modal_enabled\":true,\"field_settings_tabs_enabled\":false,\"shortcode_enabled\":false,\"registered_acf_forms\":\"0\",\"json_save_paths\":1,\"json_load_paths\":1,\"ai_enabled\":false,\"schema_support\":false,\"schema_ready_objects\":{\"blocks\":0,\"post_types\":0},\"event_first_activated\":1789046969,\"last_updated\":1789593165}','off');
INSERT INTO `wp_options` VALUES (163,'acf_version','6.8.9','auto');
INSERT INTO `wp_options` VALUES (164,'theme_mods_twentytwentyfive','a:1:{s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1789046987;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:9:\"sidebar-2\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}}}}','off');
INSERT INTO `wp_options` VALUES (165,'current_theme','Wakalumi Theme','auto');
INSERT INTO `wp_options` VALUES (166,'theme_mods_assets/..','a:4:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;s:11:\"custom_logo\";i:10;}','on');
INSERT INTO `wp_options` VALUES (167,'theme_switched','','auto');
INSERT INTO `wp_options` VALUES (174,'_transient_wp_styles_for_blocks','a:2:{s:4:\"hash\";s:32:\"94289267f68ccac1fefa45915ab93347\";s:6:\"blocks\";a:9:{s:32:\"832dc2d864d79097d8b8b493ad93453b\";s:0:\"\";s:32:\"45d3e0c4afcbd8cf25cb1ba51abfb3d7\";s:46:\":root :where(.wp-block-icon svg){width: 24px;}\";s:32:\"feca6e996f694be2d29599793228e0d7\";s:0:\"\";s:32:\"5eef131663eddaf830554df656fc2968\";s:324:\":where(.wp-block-gallery.is-layout-flex){gap: var( --wp--style--gallery-gap-default, var( --gallery-block--gutter-size, var( --wp--style--block-gap, 0.5em ) ) );}:where(.wp-block-gallery.is-layout-grid){gap: var( --wp--style--gallery-gap-default, var( --gallery-block--gutter-size, var( --wp--style--block-gap, 0.5em ) ) );}\";s:32:\"c99c05932c6685777ec5b856698fcc7d\";s:118:\":where(.wp-block-latest-posts.is-layout-flex){gap: 1.25em;}:where(.wp-block-latest-posts.is-layout-grid){gap: 1.25em;}\";s:32:\"dec8d648f30b13caec8e61374591787d\";s:120:\":where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}\";s:32:\"6c35533f7a92cce94808323603db9fc8\";s:120:\":where(.wp-block-term-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-term-template.is-layout-grid){gap: 1.25em;}\";s:32:\"6a0505cd5c78a87ed77570cda43c1132\";s:102:\":where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}\";s:32:\"25a66f156386551185570f72a9f7d44e\";s:69:\":root :where(.wp-block-pullquote){font-size: 1.5em;line-height: 1.6;}\";}}','on');
INSERT INTO `wp_options` VALUES (178,'site_logo','10','auto');
INSERT INTO `wp_options` VALUES (202,'_transient_health-check-site-status-result','{\"good\":\"21\",\"recommended\":\"3\",\"critical\":\"1\"}','on');
INSERT INTO `wp_options` VALUES (281,'category_children','a:0:{}','auto');
INSERT INTO `wp_options` VALUES (286,'new_admin_email','dev-email@wpengine.local','auto');
INSERT INTO `wp_options` VALUES (296,'options_contact_phone','(021) 7401667','auto');
INSERT INTO `wp_options` VALUES (297,'options_contact_email','info@bprswakalumi.co.id','auto');
INSERT INTO `wp_options` VALUES (298,'options_contact_address','Jl. Ir. H. Juanda No. 21, Rempoa\r\nCiputat Timur, Tangerang Selatan 15412','auto');
INSERT INTO `wp_options` VALUES (299,'options_maps_embed','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9046.292126595641!2d106.74108664674968!3d-6.325965727329664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3aa7230643f%3A0xe76da8f0b25c55b0!2sBPR%20Syariah%20Wakalumi.%20PT!5e0!3m2!1sen!2sid!4v1789491041348!5m2!1sen!2sid','auto');
INSERT INTO `wp_options` VALUES (300,'options_quick_card_1_title','Pembiayaan','auto');
INSERT INTO `wp_options` VALUES (301,'options_quick_card_1_desc','Solusi modal usaha & konsumtif syariah.','auto');
INSERT INTO `wp_options` VALUES (302,'options_quick_card_1_url','http://wakalumibprscoid.local/produk/pembiayaan','auto');
INSERT INTO `wp_options` VALUES (303,'options_quick_card_2_title','Produk Dana','auto');
INSERT INTO `wp_options` VALUES (304,'options_quick_card_2_desc','Tabungan & deposito aman penuh berkah.','auto');
INSERT INTO `wp_options` VALUES (305,'options_quick_card_2_url','http://wakalumibprscoid.local/produk/pendanaan','auto');
INSERT INTO `wp_options` VALUES (306,'options_quick_card_3_title','Simulasi','auto');
INSERT INTO `wp_options` VALUES (307,'options_quick_card_3_desc','Hitung estimasi margin & angsuran mudah.','auto');
INSERT INTO `wp_options` VALUES (308,'options_quick_card_3_url','http://wakalumibprscoid.local/simulasi','auto');
INSERT INTO `wp_options` VALUES (309,'options_quick_card_4_title','Laporan','auto');
INSERT INTO `wp_options` VALUES (310,'options_quick_card_4_desc','Akses laporan kinerja transparansi Bank.','auto');
INSERT INTO `wp_options` VALUES (311,'options_quick_card_4_url','http://wakalumibprscoid.local/informasi/laporan','auto');
INSERT INTO `wp_options` VALUES (312,'options_video_badge','Company Profile','auto');
INSERT INTO `wp_options` VALUES (313,'options_video_title','Mengenal Lebih Dekat Bank Syariah Wakalumi','auto');
INSERT INTO `wp_options` VALUES (314,'options_video_desc','Berkomitmen menjadi lembaga keuangan syariah terdepan yang berkontribusi nyata dalam memberdayakan ekonomi umat.','auto');
INSERT INTO `wp_options` VALUES (315,'options_video_url','','auto');
INSERT INTO `wp_options` VALUES (316,'options_video_thumb','','auto');
INSERT INTO `wp_options` VALUES (317,'options_ig_title','Aktivitas & Sosial Media BSW','auto');
INSERT INTO `wp_options` VALUES (318,'options_ig_subtitle','Ikuti perjalanan keuangan syariah kami di Instagram.','auto');
INSERT INTO `wp_options` VALUES (319,'options_ig_post_1','https://www.instagram.com/p/DSW6wx4gWl5/','auto');
INSERT INTO `wp_options` VALUES (320,'options_ig_post_2','https://www.instagram.com/p/DcLJupqTRoo/','auto');
INSERT INTO `wp_options` VALUES (321,'options_ig_post_3','https://www.instagram.com/p/DSW6_3WgUo-/','auto');
INSERT INTO `wp_options` VALUES (323,'options_announcement_active','0','auto');
INSERT INTO `wp_options` VALUES (324,'options_announcement_text','Selamat Datang di Portal Resmi PT BPRS Wakalumi','auto');
INSERT INTO `wp_options` VALUES (325,'options_announcement_link_text','Pelajari Selengkapnya','auto');
INSERT INTO `wp_options` VALUES (326,'options_announcement_link_url','','auto');
INSERT INTO `wp_options` VALUES (327,'options_announcement_type','warning','auto');
INSERT INTO `wp_options` VALUES (328,'options_contact_wa','6281517380388','auto');
INSERT INTO `wp_options` VALUES (329,'options_contact_wa_message','Halo CS Bank Syariah Wakalumi, saya ingin berkonsultasi mengenai produk perbankan.','auto');
INSERT INTO `wp_options` VALUES (340,'options_nisbah_bulan','Agustus 2026','auto');
INSERT INTO `wp_options` VALUES (341,'options_nisbah_data','a:6:{i:0;a:5:{s:13:\"nisbah_produk\";s:13:\"Tabungan Umum\";s:12:\"nisbah_jenis\";s:8:\"tabungan\";s:14:\"nisbah_nasabah\";s:2:\"15\";s:11:\"nisbah_bank\";s:2:\"85\";s:12:\"nisbah_equiv\";s:5:\"1.49%\";}i:1;a:5:{s:13:\"nisbah_produk\";s:16:\"Tabungan Ukhuwah\";s:12:\"nisbah_jenis\";s:8:\"tabungan\";s:14:\"nisbah_nasabah\";s:2:\"10\";s:11:\"nisbah_bank\";s:2:\"90\";s:12:\"nisbah_equiv\";s:5:\"1.00%\";}i:2;a:5:{s:13:\"nisbah_produk\";s:16:\"Deposito 1 Bulan\";s:12:\"nisbah_jenis\";s:8:\"deposito\";s:14:\"nisbah_nasabah\";s:2:\"30\";s:11:\"nisbah_bank\";s:2:\"70\";s:12:\"nisbah_equiv\";s:5:\"2.99%\";}i:3;a:5:{s:13:\"nisbah_produk\";s:16:\"Deposito 3 Bulan\";s:12:\"nisbah_jenis\";s:8:\"deposito\";s:14:\"nisbah_nasabah\";s:2:\"35\";s:11:\"nisbah_bank\";s:2:\"65\";s:12:\"nisbah_equiv\";s:5:\"3.48%\";}i:4;a:5:{s:13:\"nisbah_produk\";s:16:\"Deposito 6 Bulan\";s:12:\"nisbah_jenis\";s:8:\"deposito\";s:14:\"nisbah_nasabah\";s:2:\"40\";s:11:\"nisbah_bank\";s:2:\"60\";s:12:\"nisbah_equiv\";s:5:\"3.98%\";}i:5;a:5:{s:13:\"nisbah_produk\";s:17:\"Deposito 12 Bulan\";s:12:\"nisbah_jenis\";s:8:\"deposito\";s:14:\"nisbah_nasabah\";s:4:\"42.5\";s:11:\"nisbah_bank\";s:4:\"57.5\";s:12:\"nisbah_equiv\";s:5:\"4.23%\";}}','auto');
INSERT INTO `wp_options` VALUES (344,'options_quick_card_1_icon','financing','auto');
INSERT INTO `wp_options` VALUES (345,'options_quick_card_1_image','','auto');
INSERT INTO `wp_options` VALUES (346,'options_quick_card_2_icon','card','auto');
INSERT INTO `wp_options` VALUES (347,'options_quick_card_2_image','','auto');
INSERT INTO `wp_options` VALUES (348,'options_quick_card_3_icon','calculator','auto');
INSERT INTO `wp_options` VALUES (349,'options_quick_card_3_image','','auto');
INSERT INTO `wp_options` VALUES (350,'options_quick_card_4_icon','report','auto');
INSERT INTO `wp_options` VALUES (351,'options_quick_card_4_image','','auto');
INSERT INTO `wp_options` VALUES (352,'options_hero_reg_desktop','1','auto');
INSERT INTO `wp_options` VALUES (353,'options_hero_reg_mobile','1','auto');
INSERT INTO `wp_options` VALUES (354,'options_hero_reg_logos','a:2:{i:0;a:2:{s:5:\"label\";s:3:\"OJK\";s:3:\"url\";s:105:\"http://wakalumibprscoid.local/wp-content/uploads/2026/09/Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_.png\";}i:1;a:2:{s:5:\"label\";s:3:\"LPS\";s:3:\"url\";s:97:\"http://wakalumibprscoid.local/wp-content/uploads/2026/09/9d69a4e2-b315-4aa6-8389-947cd7fa4daa.png\";}}','auto');
INSERT INTO `wp_options` VALUES (355,'options_lps_badge_active','1','auto');
INSERT INTO `wp_options` VALUES (356,'options_lps_badge_logo','http://wakalumibprscoid.local/wp-content/uploads/2026/09/9d69a4e2-b315-4aa6-8389-947cd7fa4daa.png','auto');
INSERT INTO `wp_options` VALUES (357,'options_lps_badge_text','Simpanan Dijamin LPS sampai dengan Rp2 Miliar per Nasabah per Bank','auto');
INSERT INTO `wp_options` VALUES (358,'options_lps_badge_desktop','1','auto');
INSERT INTO `wp_options` VALUES (359,'options_lps_badge_mobile','1','auto');
INSERT INTO `wp_options` VALUES (360,'options_about_label','Tentang Kami','auto');
INSERT INTO `wp_options` VALUES (361,'options_about_title','Melayani dengan Prinsip Syariah Sejak Hari Pertama','auto');
INSERT INTO `wp_options` VALUES (362,'options_about_content','<p>BPRS Wakalumi hadir sebagai bank syariah yang berkomitmen memberikan layanan keuangan terbaik berdasarkan prinsip-prinsip syariah Islam.</p>','auto');
INSERT INTO `wp_options` VALUES (363,'options_about_image_url','','auto');
INSERT INTO `wp_options` VALUES (364,'options_about_cta_text','Selengkapnya','auto');
INSERT INTO `wp_options` VALUES (365,'options_about_cta_url','http://wakalumibprscoid.local/profil/tentang-kami','auto');
INSERT INTO `wp_options` VALUES (366,'options_about_img_mobile_mode','show_top','auto');
INSERT INTO `wp_options` VALUES (367,'options_ig_posts','a:4:{i:0;s:40:\"https://www.instagram.com/p/DSW6wx4gWl5/\";i:1;s:40:\"https://www.instagram.com/p/DcLJupqTRoo/\";i:2;s:40:\"https://www.instagram.com/p/DSW6_3WgUo-/\";i:3;s:99:\"https://www.instagram.com/p/DcdNcHYzAil/?utm_source=ig_web_button_share_sheet&stkn=MzRlODBiNWFlZA==\";}','auto');
INSERT INTO `wp_options` VALUES (399,'_site_transient_timeout_browser_a654d5eda172d96fed0476f4130cfab1','1789959337','off');
INSERT INTO `wp_options` VALUES (400,'_site_transient_browser_a654d5eda172d96fed0476f4130cfab1','a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:9:\"153.0.0.0\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}','off');
INSERT INTO `wp_options` VALUES (423,'recovery_mode_email_last_sent','1789391736','auto');
INSERT INTO `wp_options` VALUES (437,'options_about_page_badge','Profil Perusahaan','auto');
INSERT INTO `wp_options` VALUES (438,'options_about_page_title','Mengenal Lebih Dekat Bank Syariah Wakalumi','auto');
INSERT INTO `wp_options` VALUES (439,'options_about_page_subtitle','Membangun kualitas hidup berkah sesuai Syariah — Lembaga keuangan syariah yang fokus pada jasa keuangan dan pemberdayaan ekonomi umat serta UMKM.','auto');
INSERT INTO `wp_options` VALUES (440,'options_about_page_sec_badge','Sekilas Perusahaan','auto');
INSERT INTO `wp_options` VALUES (441,'options_about_page_sec_title','Tumbuh Bersama Umat, Melayani Sepenuh Hati','auto');
INSERT INTO `wp_options` VALUES (442,'options_about_page_narrative_1','PT Bank Perekonomian Rakyat Syariah (BPRS) Wakalumi didirikan oleh Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank) berdasarkan Akta Notaris Ny. Siti Pertiwi Henny Shidki, SH Nomor 59 tanggal 7 Oktober 1989 dan mendapatkan pengesahan Menteri Kehakiman RI tanggal 13 Januari 1990. BPRS Wakalumi memulai aktivitas operasi perbankan pada tanggal 1 Mei 1992, dan resmi dikonversi menjadi Bank Pembiayaan Rakyat Syariah pada tahun 1995 berlandaskan UU Nomor 7 Tahun 1992.','auto');
INSERT INTO `wp_options` VALUES (443,'options_about_page_narrative_2','BPRS Wakalumi senantiasa berpegang teguh pada komitmen ISHLAH—terus melakukan perbaikan berkelanjutan demi kemaslahatan bersama. Kami menghimpun dana dari masyarakat dalam bentuk deposito berjangka dan tabungan syariah, memberikan pembiayaan bagi pengusaha kecil, mikro, maupun masyarakat umum, serta aktif memfasilitasi literasi ekonomi syariah dan pembinaan Bank Mini di sekolah-sekolah.','auto');
INSERT INTO `wp_options` VALUES (444,'options_about_page_image','http://wakalumibprscoid.local/wp-content/themes/assets/../assets/img/about-photo.jpg','auto');
INSERT INTO `wp_options` VALUES (445,'options_about_page_stat_1_val','35+','auto');
INSERT INTO `wp_options` VALUES (446,'options_about_page_stat_1_lbl','Tahun Pengalaman (1989)','auto');
INSERT INTO `wp_options` VALUES (447,'options_about_page_stat_2_val','5.000+','auto');
INSERT INTO `wp_options` VALUES (448,'options_about_page_stat_2_lbl','Nasabah Setia','auto');
INSERT INTO `wp_options` VALUES (449,'options_about_page_stat_3_val','100%','auto');
INSERT INTO `wp_options` VALUES (450,'options_about_page_stat_3_lbl','Prinsip Murni Syariah','auto');
INSERT INTO `wp_options` VALUES (451,'options_about_page_stat_4_val','Rp2 Miliar','auto');
INSERT INTO `wp_options` VALUES (452,'options_about_page_stat_4_lbl','Dijamin LPS per Nasabah','auto');
INSERT INTO `wp_options` VALUES (453,'options_about_page_vision_badge','Visi Perusahaan','auto');
INSERT INTO `wp_options` VALUES (454,'options_about_page_vision_title','Menjadi BPR Syariah yang sehat, besar dan bermanfaat bagi umat','auto');
INSERT INTO `wp_options` VALUES (455,'options_about_page_vision_desc','“Menjadikan BPRS Wakalumi ibarat sebuah pohon yang memiliki akar dan batang yang kuat, daun yang lebat dan buah yang manis”','auto');
INSERT INTO `wp_options` VALUES (456,'options_about_page_missions','a:5:{i:0;s:72:\"Memberdayakan ekonomi umat dengan fokus usaha mikro, kecil dan menengah.\";i:1;s:49:\"Memberikan layanan prima dan amanah bagi nasabah.\";i:2;s:72:\"Menjalankan fungsi inklusi dan literasi ekonomi syariah bagi masyarakat.\";i:3;s:49:\"Memberikan manfaat optimal bagi para stakeholder.\";i:4;s:146:\"Membangun sistem dan tata kerja yang unggul dengan sumber daya insani yang professional, kompeten, handal dan menjunjung tinggi ukhuwah islamiyah.\";}','auto');
INSERT INTO `wp_options` VALUES (457,'options_about_page_identity','BPRS Wakalumi adalah Lembaga Keuangan Syariah yang memiliki fokus pada jasa keuangan dan pemberdayaan ekonomi umat dan masyarakat sesuai syariah.','auto');
INSERT INTO `wp_options` VALUES (458,'options_about_page_belief','BPRS Wakalumi berkomitmen untuk selalu melakukan ISHLAH, yakni kami terus melakukan perbaikan berkelanjutan.','auto');
INSERT INTO `wp_options` VALUES (459,'options_about_page_values','a:4:{i:0;a:3:{s:7:\"acronym\";s:1:\"S\";s:5:\"title\";s:5:\"Skill\";s:4:\"desc\";s:57:\"Selalu mengasah kompetensi agar dapat menciptakan peluang\";}i:1;a:3:{s:7:\"acronym\";s:1:\"A\";s:5:\"title\";s:6:\"Action\";s:4:\"desc\";s:55:\"Melakukan tindakan profesional yang penuh tanggungjawab\";}i:2;a:3:{s:7:\"acronym\";s:1:\"P\";s:5:\"title\";s:4:\"Pray\";s:4:\"desc\";s:89:\"Menghadirkan Allah dalam setiap aktifitas kerja, ibadah dan doa yang penuh nilai kebaikan\";}i:3;a:3:{s:7:\"acronym\";s:1:\"A\";s:5:\"title\";s:8:\"Attitude\";s:4:\"desc\";s:62:\"Memiliki sikap dan prilaku positif yang memberi warna kebaikan\";}}','auto');
INSERT INTO `wp_options` VALUES (460,'options_about_page_logo_img','http://wakalumibprscoid.local/wp-content/themes/assets/../assets/img/logo-new-1.png','auto');
INSERT INTO `wp_options` VALUES (461,'options_about_page_logo_desc','Logo BPRS Wakalumi merefleksikan identitas perbankan syariah yang dinamis, bersih, dan berakar pada nilai-nilai keislaman universal.','auto');
INSERT INTO `wp_options` VALUES (462,'options_about_page_logo_p1_title','Bentuk Gelombang & Aliran Berkah','auto');
INSERT INTO `wp_options` VALUES (463,'options_about_page_logo_p1_desc','Melambangkan kelancaran aliran rezeki, fleksibilitas dalam melayani, serta kesegaran solusi finansial yang menyejukkan perekonomian umat.','auto');
INSERT INTO `wp_options` VALUES (464,'options_about_page_logo_p2_title','Warna Ocean Teal & Bright Teal','auto');
INSERT INTO `wp_options` VALUES (465,'options_about_page_logo_p2_desc','Merefleksikan ketenangan, stabilitas finansial yang kokoh, profesionalisme modern, serta komitmen menjaga amanah nasabah.','auto');
INSERT INTO `wp_options` VALUES (466,'options_about_page_logo_p3_title','Aksen Mint Glow','auto');
INSERT INTO `wp_options` VALUES (467,'options_about_page_logo_p3_desc','Melambangkan pertumbuhan ekonomi yang berkah, harapan baru bagi UMKM, dan masa depan perbankan syariah yang gemilang.','auto');
INSERT INTO `wp_options` VALUES (468,'options_about_page_cta_badge','Langkah Nyata Bersama Kami','auto');
INSERT INTO `wp_options` VALUES (469,'options_about_page_cta_title','Siap Mengembangkan Usaha & Mengelola Dana Secara Berkah?','auto');
INSERT INTO `wp_options` VALUES (470,'options_about_page_cta_desc','Konsultasikan kebutuhan perbankan syariah Anda bersama tim profesional BPRS Wakalumi, atau temukan solusi simpanan dan pembiayaan yang tepat untuk masa depan finansial Anda.','auto');
INSERT INTO `wp_options` VALUES (471,'options_about_page_cta_btn1_text','Hubungi via WhatsApp','auto');
INSERT INTO `wp_options` VALUES (472,'options_about_page_cta_btn1_url','','auto');
INSERT INTO `wp_options` VALUES (473,'options_about_page_cta_btn2_text','Jelajahi Produk Kami','auto');
INSERT INTO `wp_options` VALUES (474,'options_about_page_cta_btn2_url','http://wakalumibprscoid.local/produk','auto');
INSERT INTO `wp_options` VALUES (475,'options_about_page_show_stats','1','auto');
INSERT INTO `wp_options` VALUES (476,'options_about_page_show_vision','1','auto');
INSERT INTO `wp_options` VALUES (477,'options_about_page_show_values','1','auto');
INSERT INTO `wp_options` VALUES (478,'options_about_page_show_logo','1','auto');
INSERT INTO `wp_options` VALUES (479,'options_about_page_show_cta','1','auto');
INSERT INTO `wp_options` VALUES (485,'options_footer_about','Bank Syariah modern yang mengutamakan pelayanan prima dan prinsip keadilan untuk kesejahteraan bersama.','auto');
INSERT INTO `wp_options` VALUES (486,'options_jam_operasional_weekday','08:00 - 15:00 WIB','auto');
INSERT INTO `wp_options` VALUES (487,'options_jam_operasional_weekend','Tutup','auto');
INSERT INTO `wp_options` VALUES (488,'options_footer_copyright','Bank Syariah Wakalumi. All Rights Reserved.','auto');
INSERT INTO `wp_options` VALUES (489,'options_footer_disclaimer','BPRS Wakalumi Berizin dan Diawasi Oleh Otoritas Jasa Keuangan (OJK) serta merupakan peserta program penjaminan Lembaga Penjamin Simpanan (LPS).','auto');
INSERT INTO `wp_options` VALUES (490,'options_footer_show_logos','1','auto');
INSERT INTO `wp_options` VALUES (491,'options_footer_logos_desktop','1','auto');
INSERT INTO `wp_options` VALUES (492,'options_footer_logos_mobile','1','auto');
INSERT INTO `wp_options` VALUES (493,'options_footer_reg_logos','a:2:{i:0;a:2:{s:5:\"label\";s:3:\"OJK\";s:3:\"url\";s:105:\"http://wakalumibprscoid.local/wp-content/uploads/2026/09/Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_.png\";}i:1;a:2:{s:5:\"label\";s:3:\"LPS\";s:3:\"url\";s:97:\"http://wakalumibprscoid.local/wp-content/uploads/2026/09/9d69a4e2-b315-4aa6-8389-947cd7fa4daa.png\";}}','auto');
INSERT INTO `wp_options` VALUES (494,'options_footer_show_prayer_times','1','auto');
INSERT INTO `wp_options` VALUES (495,'options_footer_prayer_city','Tangerang Selatan','auto');
INSERT INTO `wp_options` VALUES (496,'options_social_instagram','https://www.instagram.com/bprswakalumi','auto');
INSERT INTO `wp_options` VALUES (497,'options_social_facebook','https://facebook.com/bprswakalumi','auto');
INSERT INTO `wp_options` VALUES (498,'options_social_linkedin','https://linkedin.com/company/bprswakalumi','auto');
INSERT INTO `wp_options` VALUES (499,'options_social_youtube','','auto');
INSERT INTO `wp_options` VALUES (516,'options_pengurus_list','a:4:{i:0;a:10:{s:4:\"nama\";s:20:\"DRS. H. Zarkasih Nur\";s:8:\"kategori\";s:22:\"Dewan Pengawas Syariah\";s:7:\"jabatan\";s:28:\"Ketua Dewan Pengawas Syariah\";s:4:\"foto\";s:91:\"http://wakalumibprscoid.local/wp-content/themes/assets/../assets/img/pengurus/dps-ketua.png\";s:13:\"riwayat_karir\";s:220:\"Berpengalaman lebih dari 20 tahun di bidang ekonomi syariah dan fatwa keuangan Islam. Aktif sebagai narasumber di berbagai forum perbankan syariah nasional dan pelatihan sertifikasi DPS yang diselenggarakan oleh DSN-MUI.\";s:10:\"pendidikan\";s:2:\"--\";s:11:\"sertifikasi\";s:44:\"Sertifikasi Dewan Pengawas Syariah (DSN-MUI)\";s:7:\"kutipan\";s:69:\"Menjaga kemurnian prinsip syariah adalah fondasi kepercayaan nasabah.\";s:6:\"status\";s:5:\"Aktif\";s:6:\"urutan\";i:1;}i:1;a:10:{s:4:\"nama\";s:8:\"Haryanto\";s:8:\"kategori\";s:22:\"Dewan Pengawas Syariah\";s:7:\"jabatan\";s:30:\"Anggota Dewan Pengawas Syariah\";s:4:\"foto\";s:93:\"http://wakalumibprscoid.local/wp-content/themes/assets/../assets/img/pengurus/dps-anggota.png\";s:13:\"riwayat_karir\";s:184:\"Memiliki keahlian mendalam dalam fikih muamalah dan hukum ekonomi syariah. Berkontribusi aktif dalam pengembangan produk-produk keuangan syariah yang inovatif dan sesuai fatwa DSN-MUI.\";s:10:\"pendidikan\";s:2:\"--\";s:11:\"sertifikasi\";s:44:\"Sertifikasi Dewan Pengawas Syariah (DSN-MUI)\";s:7:\"kutipan\";s:69:\"Inovasi keuangan harus tetap berpijak pada kaidah syariah yang kokoh.\";s:6:\"status\";s:5:\"Aktif\";s:6:\"urutan\";i:2;}i:2;a:10:{s:4:\"nama\";s:11:\"Budi Satoto\";s:8:\"kategori\";s:15:\"Dewan Komisaris\";s:7:\"jabatan\";s:29:\"Komisaris Utama (PLT Direksi)\";s:4:\"foto\";s:97:\"http://wakalumibprscoid.local/wp-content/themes/assets/../assets/img/pengurus/komisaris-utama.png\";s:13:\"riwayat_karir\";s:212:\"Profesional perbankan dengan pengalaman luas di industri keuangan dan perbankan. Memiliki rekam jejak kepemimpinan strategis dalam pengawasan tata kelola perusahaan perbankan syariah yang sehat dan berkelanjutan.\";s:10:\"pendidikan\";s:2:\"--\";s:11:\"sertifikasi\";s:64:\"Sertifikasi Komisaris BPR/BPRS (OJK), Manajemen Risiko Perbankan\";s:7:\"kutipan\";s:61:\"Tata kelola yang baik adalah kunci pertumbuhan berkelanjutan.\";s:6:\"status\";s:5:\"Aktif\";s:6:\"urutan\";i:3;}i:3;a:10:{s:4:\"nama\";s:23:\"Rena Bangun Luhur S.PD.\";s:8:\"kategori\";s:15:\"Dewan Komisaris\";s:7:\"jabatan\";s:9:\"Komisaris\";s:4:\"foto\";s:91:\"http://wakalumibprscoid.local/wp-content/themes/assets/../assets/img/pengurus/komisaris.png\";s:13:\"riwayat_karir\";s:191:\"Berpengalaman di bidang keuangan korporasi dan pengawasan kepatuhan. Berperan aktif dalam memastikan implementasi prinsip kehati-hatian dan kepatuhan regulasi OJK di lingkungan BPRS Wakalumi.\";s:10:\"pendidikan\";s:2:\"--\";s:11:\"sertifikasi\";s:36:\"Sertifikasi Komisaris BPR/BPRS (OJK)\";s:7:\"kutipan\";s:53:\"Kepatuhan dan kehati-hatian adalah pilar kepercayaan.\";s:6:\"status\";s:5:\"Aktif\";s:6:\"urutan\";i:4;}}','auto');
INSERT INTO `wp_options` VALUES (517,'options_pengurus_page_badge','Susunan Pengurus','auto');
INSERT INTO `wp_options` VALUES (518,'options_pengurus_page_title','Jajaran Kepemimpinan BPRS Wakalumi','auto');
INSERT INTO `wp_options` VALUES (519,'options_pengurus_page_subtitle','Dipimpin oleh para profesional berpengalaman yang berkomitmen pada prinsip perbankan syariah, tata kelola yang baik (GCG), dan pelayanan terbaik bagi nasabah.','auto');
INSERT INTO `wp_options` VALUES (520,'options_pengurus_page_intro','BPRS Wakalumi berkomitmen menerapkan Tata Kelola Perusahaan yang Baik (Good Corporate Governance) dalam setiap aspek bisnis. Susunan pengurus kami mencerminkan integritas, profesionalisme, dan keahlian di bidang keuangan syariah.','auto');
INSERT INTO `wp_options` VALUES (521,'options_pengurus_orgchart_show','1','auto');
INSERT INTO `wp_options` VALUES (522,'options_pengurus_orgchart_image','','auto');
INSERT INTO `wp_options` VALUES (523,'options_pengurus_orgchart_desc','','auto');
INSERT INTO `wp_options` VALUES (524,'options_pengurus_cta_show','1','auto');
INSERT INTO `wp_options` VALUES (525,'options_pengurus_cta_badge','Bergabung Bersama Kami','auto');
INSERT INTO `wp_options` VALUES (526,'options_pengurus_cta_title','Siap Mempercayakan Dana Anda pada Kepemimpinan Profesional Syariah?','auto');
INSERT INTO `wp_options` VALUES (527,'options_pengurus_cta_desc','','auto');
INSERT INTO `wp_options` VALUES (528,'options_pengurus_cta_btn1_text','Hubungi via WhatsApp','auto');
INSERT INTO `wp_options` VALUES (529,'options_pengurus_cta_btn1_url','','auto');
INSERT INTO `wp_options` VALUES (530,'options_pengurus_cta_btn2_text','Jelajahi Produk Kami','auto');
INSERT INTO `wp_options` VALUES (531,'options_pengurus_cta_btn2_url','','auto');
INSERT INTO `wp_options` VALUES (561,'options_kantor_list','a:3:{i:0;a:12:{s:4:\"nama\";s:24:\"Kantor Pusat Operasional\";s:4:\"tipe\";s:24:\"Kantor Pusat Operasional\";s:4:\"foto\";s:104:\"http://wakalumibprscoid.local/wp-content/uploads/2026/09/02-BSW-Office-Photos-by-Luluil-Manun-scaled.jpg\";s:6:\"alamat\";s:70:\"Jl. Dewi Sartika, Komp. Ciputat Mutiara Center Blok B1 - Ciputat 15411\";s:8:\"kota_kab\";s:17:\"Tangerang Selatan\";s:7:\"telepon\";s:23:\"(021) 7401667 - 7490874\";s:8:\"whatsapp\";s:12:\"081517380388\";s:15:\"jam_operasional\";s:32:\"Senin - Jumat: 08.00 - 15.00 WIB\";s:7:\"layanan\";s:123:\"Semua Layanan Perbankan Syariah, Pembiayaan Modal Kerja & Konsumtif, Pembukaan Tabungan, Deposito Syariah, Customer Service\";s:9:\"gmaps_url\";s:41:\"https://maps.app.goo.gl/vedKPG39fLo66DfGA\";s:6:\"status\";s:12:\"Segera Hadir\";s:6:\"urutan\";i:1;}i:1;a:12:{s:4:\"nama\";s:17:\"Kantor Kas Cikupa\";s:4:\"tipe\";s:10:\"Kantor Kas\";s:4:\"foto\";s:92:\"http://wakalumibprscoid.local/wp-content/uploads/2026/09/Profil-Perusahaan-Wakalumi-Baru.png\";s:6:\"alamat\";s:117:\"Jl. Raya Serang Km 15, Ruko Cikupa Niaga Mas Blok C No. 22 Talagasari, Kec. Cikupa, Kabupaten Tangerang, Banten 15710\";s:8:\"kota_kab\";s:19:\"Kabupaten Tangerang\";s:7:\"telepon\";s:13:\"(021) 7401667\";s:8:\"whatsapp\";s:12:\"081517380388\";s:15:\"jam_operasional\";s:32:\"Senin - Jumat: 08.00 - 15.00 WIB\";s:7:\"layanan\";s:98:\"Setoran & Penarikan Tunai, Pembukaan Tabungan Syariah, Pengajuan Pembiayaan UMKM, Informasi Produk\";s:9:\"gmaps_url\";s:61:\"https://maps.google.com/?q=Ruko+Cikupa+Niaga+Mas+Blok+C+No+22\";s:6:\"status\";s:17:\"Beroperasi Normal\";s:6:\"urutan\";i:2;}i:2;a:12:{s:4:\"nama\";s:22:\"Kantor Layanan Ciledug\";s:4:\"tipe\";s:14:\"Kantor Layanan\";s:4:\"foto\";s:94:\"http://wakalumibprscoid.local/wp-content/uploads/2026/09/Profil-Perusahaan-Wakalumi-Barumm.png\";s:6:\"alamat\";s:52:\"Plaza Ciledug, Lt. Basement Blok B.4, Kota Tangerang\";s:8:\"kota_kab\";s:14:\"Kota Tangerang\";s:7:\"telepon\";s:13:\"(021) 7401667\";s:8:\"whatsapp\";s:12:\"081517380388\";s:15:\"jam_operasional\";s:32:\"Senin - Jumat: 08.00 - 15.00 WIB\";s:7:\"layanan\";s:77:\"Pembukaan Tabungan, Informasi Produk Simpanan & Pembiayaan, Pelayanan Nasabah\";s:9:\"gmaps_url\";s:40:\"https://maps.google.com/?q=Plaza+Ciledug\";s:6:\"status\";s:17:\"Beroperasi Normal\";s:6:\"urutan\";i:3;}}','auto');
INSERT INTO `wp_options` VALUES (562,'options_kantor_page_badge','Jaringan Kantor','auto');
INSERT INTO `wp_options` VALUES (563,'options_kantor_page_title','Jaringan Kantor & Layanan BPRS Wakalumi','auto');
INSERT INTO `wp_options` VALUES (564,'options_kantor_page_subtitle','Kami hadir lebih dekat di lokasi-lokasi strategis untuk memberikan kemudahan, keamanan, dan kenyamanan prima bagi seluruh nasabah perbankan syariah.','auto');
INSERT INTO `wp_options` VALUES (565,'options_kantor_stat1_num','3 Kantor','auto');
INSERT INTO `wp_options` VALUES (566,'options_kantor_stat1_label','Kantor Operasional & Kas','auto');
INSERT INTO `wp_options` VALUES (567,'options_kantor_stat2_num','3 Wilayah','auto');
INSERT INTO `wp_options` VALUES (568,'options_kantor_stat2_label','Tangsel, Kab. Tangerang, & Kota Tangerang','auto');
INSERT INTO `wp_options` VALUES (569,'options_kantor_stat3_num','Senin - Jumat','auto');
INSERT INTO `wp_options` VALUES (570,'options_kantor_stat3_label','Pukul 08.00 - 15.00 WIB','auto');
INSERT INTO `wp_options` VALUES (571,'options_kantor_cta_show','1','auto');
INSERT INTO `wp_options` VALUES (572,'options_kantor_cta_badge','Layanan Nasabah','auto');
INSERT INTO `wp_options` VALUES (573,'options_kantor_cta_title','Perlu Bantuan atau Ingin Berkonsultasi Langsung?','auto');
INSERT INTO `wp_options` VALUES (574,'options_kantor_cta_desc','Kunjungi kantor kami terdekat atau hubungi layanan nasabah kami via WhatsApp untuk kemudahan informasi produk simpanan dan pengajuan pembiayaan syariah.','auto');
INSERT INTO `wp_options` VALUES (575,'options_kantor_cta_btn1_text','Chat WhatsApp CS','auto');
INSERT INTO `wp_options` VALUES (576,'options_kantor_cta_btn1_url','https://wa.me/6281517380388','auto');
INSERT INTO `wp_options` VALUES (577,'options_kantor_cta_btn2_text','Jelajahi Produk Kami','auto');
INSERT INTO `wp_options` VALUES (578,'options_kantor_cta_btn2_url','http://wakalumibprscoid.local/produk','auto');
INSERT INTO `wp_options` VALUES (606,'wakalumi_flush_rewrite_v2','yes','auto');
INSERT INTO `wp_options` VALUES (628,'options_tabungan_page_badge','Penghimpunan Dana Syariah','auto');
INSERT INTO `wp_options` VALUES (629,'options_tabungan_page_title','Simpanan Berkah Sesuai Syariah','auto');
INSERT INTO `wp_options` VALUES (630,'options_tabungan_page_subtitle','Solusi simpanan syariah amanah, bebas biaya administrasi bulanan, bagi hasil bersaing, dan dijamin LPS hingga Rp 2 Miliar.','auto');
INSERT INTO `wp_options` VALUES (631,'options_tabungan_list','a:4:{i:0;a:13:{s:4:\"nama\";s:16:\"Tabungan Tawakal\";s:4:\"slug\";s:7:\"tawakal\";s:7:\"tagline\";s:22:\"Tabungan Umum Wakalumi\";s:5:\"badge\";s:15:\"Umum & Keluarga\";s:5:\"color\";s:4:\"teal\";s:4:\"akad\";s:20:\"Mudharabah Muthlaqah\";s:9:\"min_setor\";s:9:\"Rp 50.000\";s:11:\"biaya_admin\";s:28:\"Gratis / Bebas Biaya Bulanan\";s:4:\"desc\";s:142:\"Simpanan investasi dengan pola bagi hasil, dikelola dengan prinsip syariah. Solusi amanah untuk kemaslahatan simpanan perorangan dan keluarga.\";s:10:\"keunggulan\";s:246:\"Bebas biaya administrasi bulanan\r\nBagi hasil syariah kompetitif dibagikan setiap bulan\r\nSetoran awal sangat ringan dan terjangkau\r\nDapat disetor dan ditarik sewaktu-waktu pada jam operasional\r\nSimpanan aman dijamin Lembaga Penjamin Simpanan (LPS)\";s:6:\"syarat\";s:180:\"Mengisi dan menandatangani formulir pembukaan rekening\r\nMelampirkan fotokopi e-KTP / Paspor yang masih berlaku\r\nMelampirkan fotokopi NPWP (bila ada)\r\nSetoran awal minimal Rp 50.000\";s:7:\"wa_text\";s:119:\"Halo BPRS Wakalumi, saya tertarik untuk membuka rekening Tabungan Tawakal. Mohon informasi prosedur dan persyaratannya.\";s:6:\"urutan\";i:1;}i:1;a:13:{s:4:\"nama\";s:19:\"Tabungan Pendidikan\";s:4:\"slug\";s:10:\"pendidikan\";s:7:\"tagline\";s:27:\"Simpanan Masa Depan Pelajar\";s:5:\"badge\";s:19:\"Pelajar & Mahasiswa\";s:5:\"color\";s:4:\"blue\";s:4:\"akad\";s:20:\"Mudharabah / Wadi`ah\";s:9:\"min_setor\";s:9:\"Rp 20.000\";s:11:\"biaya_admin\";s:28:\"Gratis / Bebas Biaya Bulanan\";s:4:\"desc\";s:157:\"Simpanan untuk para pelajar dengan pola bagi hasil, dikelola sesuai dengan prinsip syariah. Melatih kemandirian dan kebiasaan gemar menabung sejak usia dini.\";s:10:\"keunggulan\";s:273:\"Bebas biaya administrasi bulanan agar tabungan anak tidak terpotong\r\nBuku tabungan diterbitkan atas nama anak (pelajar)\r\nBagi hasil syariah yang berkah dan transparan\r\nPerencanaan biaya jenjang sekolah dan perguruan tinggi yang aman\r\nDijamin Lembaga Penjamin Simpanan (LPS)\";s:6:\"syarat\";s:242:\"Mengisi formulir pembukaan rekening oleh anak / orang tua wali\r\nFotokopi Kartu Identitas Anak (KIA) atau Akta Kelahiran\r\nFotokopi Kartu Pelajar (jika sudah ada)\r\nFotokopi e-KTP Orang Tua / Wali yang mendampingi\r\nSetoran awal minimal Rp 20.000\";s:7:\"wa_text\";s:123:\"Halo BPRS Wakalumi, saya ingin membuka Tabungan Pendidikan untuk putra/putri saya. Mohon informasi syarat dan formulasinya.\";s:6:\"urutan\";i:2;}i:2;a:13:{s:4:\"nama\";s:23:\"Tabungan Haji dan Umroh\";s:4:\"slug\";s:10:\"haji-umroh\";s:7:\"tagline\";s:30:\"Langkah Niat Suci ke Baitullah\";s:5:\"badge\";s:16:\"Persiapan Ibadah\";s:5:\"color\";s:5:\"amber\";s:4:\"akad\";s:20:\"Mudharabah Muthlaqah\";s:9:\"min_setor\";s:10:\"Rp 100.000\";s:11:\"biaya_admin\";s:28:\"Gratis / Bebas Biaya Bulanan\";s:4:\"desc\";s:131:\"Simpanan khusus bagi umat Islam yang akan menunaikan ibadah haji dan umroh dengan pola bagi hasil, dikelola dengan prinsip syariah.\";s:10:\"keunggulan\";s:343:\"Membantu percepatan pencapaian setoran awal porsi haji Kemenag (Rp 25 Juta) atau paket Umroh\r\nDana tersimpan aman dan terhindar dari pemakaian konsumtif sehari-hari\r\nBebas biaya administrasi bulanan\r\nBagi hasil bulanan diinvestasikan kembali untuk mempercepat keberangkatan\r\nPendampingan dan konsultasi berkala persiapan pendaftaran haji/umroh\";s:6:\"syarat\";s:228:\"Mengisi formulir pembukaan Tabungan Haji & Umroh\r\nMelampirkan fotokopi e-KTP yang masih berlaku\r\nMelampirkan fotokopi Kartu Keluarga (KK)\r\nPas foto 3x4 dan 4x6 latar putih (untuk persiapan porsi)\r\nSetoran awal minimal Rp 100.000\";s:7:\"wa_text\";s:118:\"Halo BPRS Wakalumi, saya berencana membuka Tabungan Haji & Umroh. Mohon pendampingan informasi setoran dan porsi haji.\";s:6:\"urutan\";i:3;}i:3;a:13:{s:4:\"nama\";s:37:\"Tabungan Ukhuwah (Tabungan Berhadiah)\";s:4:\"slug\";s:7:\"ukhuwah\";s:7:\"tagline\";s:36:\"Tabungan Berhadiah Berkah Tanpa Riba\";s:5:\"badge\";s:17:\"Program Berhadiah\";s:5:\"color\";s:4:\"cyan\";s:4:\"akad\";s:20:\"Mudharabah Muthlaqah\";s:9:\"min_setor\";s:10:\"Rp 100.000\";s:11:\"biaya_admin\";s:28:\"Gratis / Bebas Biaya Bulanan\";s:4:\"desc\";s:207:\"Simpanan investasi berjangka syariah yang memberikan kesempatan hadiah menarik (hadiah langsung atau poin undian berkah) bagi nasabah setia, dikelola murni dengan prinsip syariah yang adil dan menenteramkan.\";s:10:\"keunggulan\";s:294:\"Program apresiasi hadiah menarik tanpa melanggar prinsip syariah\r\nBagi hasil bulanan tetap menguntungkan dan bersaing\r\nBebas biaya administrasi bulanan\r\nNominal penempatan fleksibel dengan berbagai pilihan program hadiah\r\nSimpanan aman dijamin Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar\";s:6:\"syarat\";s:260:\"Mengisi formulir pembukaan Tabungan Ukhuwah Berhadiah\r\nMelampirkan fotokopi e-KTP yang masih berlaku\r\nMelampirkan fotokopi NPWP (bila ada)\r\nMenyetujui ketentuan periode penempatan dana program berhadiah\r\nSetoran awal minimal sesuai paket program hadiah pilihan\";s:7:\"wa_text\";s:133:\"Halo BPRS Wakalumi, saya tertarik dengan program Tabungan Ukhuwah (Tabungan Berhadiah). Mohon info katalog hadiah dan persyaratannya.\";s:6:\"urutan\";i:4;}}','auto');
INSERT INTO `wp_options` VALUES (632,'options_tabungan_calc_badge','Simulasi Finansial Syariah','auto');
INSERT INTO `wp_options` VALUES (633,'options_tabungan_calc_title','Kalkulator Rencana Menabung Berkah','auto');
INSERT INTO `wp_options` VALUES (634,'options_tabungan_calc_subtitle','Tentukan target impian Anda—mulai dari porsi haji, dana sekolah anak, program tabungan ukhuwah, hingga simpanan masa depan keluarga. Kami hitungkan estimasi sisihan per bulan.','auto');
INSERT INTO `wp_options` VALUES (635,'options_tabungan_faq_badge','Tanya Jawab (FAQ)','auto');
INSERT INTO `wp_options` VALUES (636,'options_tabungan_faq_title','Pertanyaan Seputar Tabungan','auto');
INSERT INTO `wp_options` VALUES (637,'options_tabungan_faq_subtitle','Pertanyaan umum nasabah seputar produk simpanan syariah, keamanan simpanan di LPS, dan prosedur pembukaan rekening.','auto');
INSERT INTO `wp_options` VALUES (638,'options_tabungan_faq_list','a:5:{i:0;a:2:{s:1:\"q\";s:58:\"Bagaimana cara membuka rekening tabungan di BPRS Wakalumi?\";s:1:\"a\";s:309:\"Anda dapat langsung mengunjungi salah satu jaringan kantor operasional kami (Kantor Pusat Ciputat, Kantor Kas Cikupa, atau Kantor Layanan Ciledug) dengan membawa kartu identitas (e-KTP). Anda juga dapat menghubungi Customer Service via WhatsApp untuk mendapatkan layanan jemput setoran atau pendampingan awal.\";}i:1;a:2:{s:1:\"q\";s:70:\"Apakah ada potongan biaya administrasi bulanan pada rekening tabungan?\";s:1:\"a\";s:151:\"Tidak ada. Seluruh produk tabungan BPRS Wakalumi bebas biaya administrasi bulanan, sehingga saldo tabungan Anda tetap utuh terjaga dan tidak berkurang.\";}i:2;a:2:{s:1:\"q\";s:56:\"Apakah dana simpanan tabungan saya aman dan dijamin LPS?\";s:1:\"a\";s:236:\"Sangat aman. BPRS Wakalumi adalah bank peserta penjaminan Lembaga Penjamin Simpanan (LPS) dengan batas penjaminan hingga Rp 2 Miliar per nasabah per bank, serta beroperasi dengan izin resmi dan diawasi oleh Otoritas Jasa Keuangan (OJK).\";}i:3;a:2:{s:1:\"q\";s:70:\"Apa perbedaan antara akad Mudharabah dan Wadiah pada tabungan syariah?\";s:1:\"a\";s:323:\"Akad Wadiah adalah titipan murni di mana nasabah menitipkan dana tanpa janji bagi hasil tetap (dapat berupa bonus sukarela). Sedangkan akad Mudharabah adalah kerja sama investasi syariah di mana dana nasabah dikelola secara produktif oleh bank dan keuntungan dibagikan setiap bulan sesuai nisbah bagi hasil yang disepakati.\";}i:4;a:2:{s:1:\"q\";s:65:\"Apakah BPRS Wakalumi menyediakan layanan jemput setoran tabungan?\";s:1:\"a\";s:231:\"Ya, BPRS Wakalumi menyediakan fasilitas layanan jemput setoran (pick-up service) bagi nasabah perorangan maupun pedagang/pelaku usaha UMKM untuk memudahkan menabung tanpa perlu repot meninggalkan tempat usaha atau aktivitas harian.\";}}','auto');
INSERT INTO `wp_options` VALUES (639,'options_deposito_page_badge','Investasi Syariah Berkah','auto');
INSERT INTO `wp_options` VALUES (640,'options_deposito_page_title','Deposito Mudharabah BPRS Wakalumi','auto');
INSERT INTO `wp_options` VALUES (641,'options_deposito_page_subtitle','Pilihan tepat bagi Anda berinvestasi sekaligus beribadah. Investasi aman, menguntungkan, dan berkah dengan prinsip Mudharabah Muthlaqah.','auto');
INSERT INTO `wp_options` VALUES (642,'options_deposito_quote','Merupakan investasi anda baik secara individu maupun perusahaan dalam bentuk deposito yang sesuai dengan prinsip syariah yakni Mudharabah Muthlaqah, pilihan tepat bagi anda berinvestasi sekaligus juga ibadah.','auto');
INSERT INTO `wp_options` VALUES (643,'options_deposito_akad','Mudharabah Muthlaqah','auto');
INSERT INTO `wp_options` VALUES (644,'options_deposito_min_penempatan','Rp 500.000','auto');
INSERT INTO `wp_options` VALUES (645,'options_deposito_tenor_list','1 Bulan, 3 Bulan, 6 Bulan, 12 Bulan','auto');
INSERT INTO `wp_options` VALUES (646,'options_deposito_keunggulan','Prinsip murni Mudharabah Muthlaqah (bebas riba & gharar)\r\nNisbah bagi hasil kompetitif dan adil\r\nPilihan jangka waktu fleksibel (1, 3, 6, dan 12 bulan)\r\nFasilitas ARO (Automatic Roll Over) pokok atau pokok + bagi hasil\r\nDapat dijadikan agunan/jaminan pembiayaan syariah\r\nDijamin Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar','auto');
INSERT INTO `wp_options` VALUES (647,'options_deposito_syarat_individu','Mengisi formulir permohonan pembukaan bilyet Deposito Mudharabah\r\nFotokopi e-KTP / Paspor pemohon yang masih berlaku\r\nFotokopi NPWP pemohon\r\nMemiliki rekening tabungan di BPRS Wakalumi sebagai rekening penampung bagi hasil\r\nNominal penempatan minimal Rp 5.000.000','auto');
INSERT INTO `wp_options` VALUES (648,'options_deposito_syarat_lembaga','Mengisi formulir pembukaan rekening Deposito Lembaga / Perusahaan\r\nFotokopi Akta Pendirian Perusahaan & Perubahan Anggaran Dasar Terakhir\r\nFotokopi NIB (Nomor Induk Berusaha) / SIUP & TDP\r\nFotokopi NPWP Perusahaan / Yayasan\r\nFotokopi e-KTP Pengurus / Direksi yang berwenang menandatangani bilyet\r\nSurat Kuasa Direksi (jika dikuasakan)\r\nNominal penempatan minimal Rp 10.000.000','auto');
INSERT INTO `wp_options` VALUES (649,'options_produk_wa_number','6281517380388','auto');
INSERT INTO `wp_options` VALUES (650,'options_produk_cta_title','Mulai Langkah Finansial Bersama Bank Syariah Wakalumi','auto');
INSERT INTO `wp_options` VALUES (651,'options_produk_cta_desc','Konsultasikan rencana simpanan dan investasi deposito Anda bersama staf profesional kami via WhatsApp.','auto');
INSERT INTO `wp_options` VALUES (655,'options_footer_maps_title','Lokasi Kantor','auto');
INSERT INTO `wp_options` VALUES (670,'_transient_timeout_wkl_prayer_tangerang-selatan_20260916','1789603200','off');
INSERT INTO `wp_options` VALUES (671,'_transient_wkl_prayer_tangerang-selatan_20260916','a:8:{s:4:\"city\";s:30:\"Tangerang Selatan & Sekitarnya\";s:5:\"subuh\";s:5:\"04:29\";s:6:\"dzuhur\";s:5:\"11:48\";s:5:\"ashar\";s:5:\"15:01\";s:7:\"maghrib\";s:5:\"17:50\";s:4:\"isya\";s:5:\"18:59\";s:5:\"hijri\";s:21:\"5 Rabiul Akhir 1448 H\";s:9:\"is_cached\";b:1;}','off');
INSERT INTO `wp_options` VALUES (688,'_site_transient_update_plugins','O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1789593165;s:8:\"response\";a:1:{s:30:\"advanced-custom-fields/acf.php\";O:8:\"stdClass\":13:{s:2:\"id\";s:36:\"w.org/plugins/advanced-custom-fields\";s:4:\"slug\";s:22:\"advanced-custom-fields\";s:6:\"plugin\";s:30:\"advanced-custom-fields/acf.php\";s:11:\"new_version\";s:6:\"6.8.10\";s:3:\"url\";s:53:\"https://wordpress.org/plugins/advanced-custom-fields/\";s:7:\"package\";s:72:\"https://downloads.wordpress.org/plugin/advanced-custom-fields.6.8.10.zip\";s:5:\"icons\";a:2:{s:2:\"1x\";s:67:\"https://ps.w.org/advanced-custom-fields/assets/icon.svg?rev=3207824\";s:3:\"svg\";s:67:\"https://ps.w.org/advanced-custom-fields/assets/icon.svg?rev=3207824\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:78:\"https://ps.w.org/advanced-custom-fields/assets/banner-1544x500.jpg?rev=3374528\";s:2:\"1x\";s:77:\"https://ps.w.org/advanced-custom-fields/assets/banner-772x250.jpg?rev=3374528\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"6.2\";s:6:\"tested\";s:3:\"7.1\";s:12:\"requires_php\";s:3:\"7.4\";s:16:\"requires_plugins\";a:0:{}}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:0:{}s:7:\"checked\";a:1:{s:30:\"advanced-custom-fields/acf.php\";s:5:\"6.8.9\";}}','off');
INSERT INTO `wp_options` VALUES (695,'_site_transient_timeout_theme_roots','1789594965','off');
INSERT INTO `wp_options` VALUES (696,'_site_transient_theme_roots','a:8:{s:9:\"assets/..\";s:7:\"/themes\";s:6:\"inc/..\";s:7:\"/themes\";s:15:\"node_modules/..\";s:7:\"/themes\";s:17:\"template-parts/..\";s:7:\"/themes\";s:16:\"twentytwentyfive\";s:7:\"/themes\";s:16:\"twentytwentyfour\";s:7:\"/themes\";s:17:\"twentytwentythree\";s:7:\"/themes\";s:14:\"wakalumi-theme\";s:7:\"/themes\";}','off');
INSERT INTO `wp_options` VALUES (700,'_site_transient_timeout_wp_theme_files_patterns-550a97d076fef324f3784bd73fd5b234','1789602905','off');
INSERT INTO `wp_options` VALUES (701,'_site_transient_wp_theme_files_patterns-550a97d076fef324f3784bd73fd5b234','a:2:{s:7:\"version\";s:5:\"1.0.0\";s:8:\"patterns\";a:0:{}}','off');
/*!40000 ALTER TABLE `wp_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_postmeta` (
  `meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_postmeta`
--

LOCK TABLES `wp_postmeta` WRITE;
/*!40000 ALTER TABLE `wp_postmeta` DISABLE KEYS */;
INSERT INTO `wp_postmeta` VALUES (1,2,'_wp_page_template','default');
INSERT INTO `wp_postmeta` VALUES (2,3,'_wp_page_template','default');
INSERT INTO `wp_postmeta` VALUES (3,5,'_edit_lock','1789447836:1');
INSERT INTO `wp_postmeta` VALUES (4,8,'_wp_attached_file','2026/09/untitled3.png');
INSERT INTO `wp_postmeta` VALUES (5,8,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:1000;s:6:\"height\";i:1000;s:4:\"file\";s:21:\"2026/09/untitled3.png\";s:8:\"filesize\";i:112423;s:5:\"sizes\";a:5:{s:6:\"medium\";a:5:{s:4:\"file\";s:21:\"untitled3-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:18137;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:21:\"untitled3-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:7468;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:21:\"untitled3-768x768.png\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:68807;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:21:\"untitled3-600x400.png\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:42780;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:21:\"untitled3-400x500.png\";s:5:\"width\";i:400;s:6:\"height\";i:500;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:36382;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}');
INSERT INTO `wp_postmeta` VALUES (6,9,'_wp_attached_file','2026/09/cropped-untitled3.png');
INSERT INTO `wp_postmeta` VALUES (7,9,'_wp_attachment_context','custom-logo');
INSERT INTO `wp_postmeta` VALUES (8,9,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:683;s:6:\"height\";i:873;s:4:\"file\";s:29:\"2026/09/cropped-untitled3.png\";s:8:\"filesize\";i:106246;s:5:\"sizes\";a:4:{s:6:\"medium\";a:5:{s:4:\"file\";s:29:\"cropped-untitled3-235x300.png\";s:5:\"width\";i:235;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:20933;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:29:\"cropped-untitled3-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:9898;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:29:\"cropped-untitled3-600x400.png\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:56273;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:29:\"cropped-untitled3-400x500.png\";s:5:\"width\";i:400;s:6:\"height\";i:500;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:44833;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}');
INSERT INTO `wp_postmeta` VALUES (9,10,'_wp_attached_file','2026/09/cropped-untitled3-1.png');
INSERT INTO `wp_postmeta` VALUES (10,10,'_wp_attachment_context','custom-logo');
INSERT INTO `wp_postmeta` VALUES (11,10,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:999;s:6:\"height\";i:999;s:4:\"file\";s:31:\"2026/09/cropped-untitled3-1.png\";s:8:\"filesize\";i:111462;s:5:\"sizes\";a:5:{s:6:\"medium\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-1-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:18179;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:7466;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-1-768x768.png\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:69047;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-1-600x400.png\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:43506;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-1-400x500.png\";s:5:\"width\";i:400;s:6:\"height\";i:500;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:36785;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}');
INSERT INTO `wp_postmeta` VALUES (12,11,'_wp_attached_file','2026/09/cropped-untitled3-2.png');
INSERT INTO `wp_postmeta` VALUES (13,11,'_wp_attachment_context','site-icon');
INSERT INTO `wp_postmeta` VALUES (14,11,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:512;s:6:\"height\";i:512;s:4:\"file\";s:31:\"2026/09/cropped-untitled3-2.png\";s:8:\"filesize\";i:39236;s:5:\"sizes\";a:9:{s:6:\"medium\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-2-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:19671;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-2-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:7932;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-2-512x400.png\";s:5:\"width\";i:512;s:6:\"height\";i:400;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:38904;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-2-400x500.png\";s:5:\"width\";i:400;s:6:\"height\";i:500;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:39720;}s:13:\"site_icon-270\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-2-270x270.png\";s:5:\"width\";i:270;s:6:\"height\";i:270;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:16786;}s:13:\"site_icon-192\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-2-192x192.png\";s:5:\"width\";i:192;s:6:\"height\";i:192;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:10660;}s:13:\"site_icon-180\";a:5:{s:4:\"file\";s:31:\"cropped-untitled3-2-180x180.png\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:9810;}s:12:\"site_icon-64\";a:5:{s:4:\"file\";s:29:\"cropped-untitled3-2-64x64.png\";s:5:\"width\";i:64;s:6:\"height\";i:64;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:2901;}s:12:\"site_icon-32\";a:5:{s:4:\"file\";s:29:\"cropped-untitled3-2-32x32.png\";s:5:\"width\";i:32;s:6:\"height\";i:32;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1352;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}');
INSERT INTO `wp_postmeta` VALUES (15,12,'_edit_lock','1789047777:1');
INSERT INTO `wp_postmeta` VALUES (16,12,'_wp_trash_meta_status','publish');
INSERT INTO `wp_postmeta` VALUES (17,12,'_wp_trash_meta_time','1789047815');
INSERT INTO `wp_postmeta` VALUES (18,13,'_wp_trash_meta_status','publish');
INSERT INTO `wp_postmeta` VALUES (19,13,'_wp_trash_meta_time','1789047891');
INSERT INTO `wp_postmeta` VALUES (20,14,'_edit_lock','1789081640:1');
INSERT INTO `wp_postmeta` VALUES (21,15,'_edit_lock','1789081642:1');
INSERT INTO `wp_postmeta` VALUES (24,17,'_edit_lock','1789145628:1');
INSERT INTO `wp_postmeta` VALUES (25,18,'_edit_lock','1789145629:1');
INSERT INTO `wp_postmeta` VALUES (26,19,'_edit_lock','1789145633:1');
INSERT INTO `wp_postmeta` VALUES (27,20,'_edit_lock','1789145638:1');
INSERT INTO `wp_postmeta` VALUES (28,21,'_edit_last','1');
INSERT INTO `wp_postmeta` VALUES (29,21,'tim_jabatan','staff ');
INSERT INTO `wp_postmeta` VALUES (30,21,'_tim_jabatan','field_tim_jabatan');
INSERT INTO `wp_postmeta` VALUES (31,21,'tim_urutan','0');
INSERT INTO `wp_postmeta` VALUES (32,21,'_tim_urutan','field_tim_urutan');
INSERT INTO `wp_postmeta` VALUES (33,21,'_edit_lock','1789146503:1');
INSERT INTO `wp_postmeta` VALUES (34,21,'_wp_trash_meta_status','publish');
INSERT INTO `wp_postmeta` VALUES (35,21,'_wp_trash_meta_time','1789146648');
INSERT INTO `wp_postmeta` VALUES (36,21,'_wp_desired_post_slug','staff');
INSERT INTO `wp_postmeta` VALUES (37,22,'_edit_last','1');
INSERT INTO `wp_postmeta` VALUES (38,22,'slide_subheadline','');
INSERT INTO `wp_postmeta` VALUES (39,22,'_slide_subheadline','field_wakalumi_slide_subheadline');
INSERT INTO `wp_postmeta` VALUES (40,22,'slide_cta_text','Hubungi Kami');
INSERT INTO `wp_postmeta` VALUES (41,22,'_slide_cta_text','field_wakalumi_slide_cta_text');
INSERT INTO `wp_postmeta` VALUES (42,22,'slide_cta_url','');
INSERT INTO `wp_postmeta` VALUES (43,22,'_slide_cta_url','field_wakalumi_slide_cta_url');
INSERT INTO `wp_postmeta` VALUES (44,22,'slide_cta_text_2','Lihat Produk');
INSERT INTO `wp_postmeta` VALUES (45,22,'_slide_cta_text_2','field_wakalumi_slide_cta_text_2');
INSERT INTO `wp_postmeta` VALUES (46,22,'slide_cta_url_2','');
INSERT INTO `wp_postmeta` VALUES (47,22,'_slide_cta_url_2','field_wakalumi_slide_cta_url_2');
INSERT INTO `wp_postmeta` VALUES (48,22,'slide_overlay_opacity','60');
INSERT INTO `wp_postmeta` VALUES (49,22,'_slide_overlay_opacity','field_wakalumi_slide_overlay_opacity');
INSERT INTO `wp_postmeta` VALUES (50,22,'_edit_lock','1789282891:1');
INSERT INTO `wp_postmeta` VALUES (51,1,'_edit_lock','1789266303:1');
INSERT INTO `wp_postmeta` VALUES (52,24,'_wp_attached_file','2026/09/Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_.png');
INSERT INTO `wp_postmeta` VALUES (53,24,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:1098;s:6:\"height\";i:427;s:4:\"file\";s:56:\"2026/09/Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_.png\";s:8:\"filesize\";i:95654;s:5:\"sizes\";a:6:{s:6:\"medium\";a:5:{s:4:\"file\";s:56:\"Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_-300x117.png\";s:5:\"width\";i:300;s:6:\"height\";i:117;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:20526;}s:5:\"large\";a:5:{s:4:\"file\";s:57:\"Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_-1024x398.png\";s:5:\"width\";i:1024;s:6:\"height\";i:398;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:95570;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:56:\"Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:9769;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:56:\"Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_-768x299.png\";s:5:\"width\";i:768;s:6:\"height\";i:299;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:68702;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:56:\"Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_-600x400.png\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:53725;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:56:\"Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_-400x427.png\";s:5:\"width\";i:400;s:6:\"height\";i:427;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:23171;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}');
INSERT INTO `wp_postmeta` VALUES (54,25,'_wp_attached_file','2026/09/9d69a4e2-b315-4aa6-8389-947cd7fa4daa.png');
INSERT INTO `wp_postmeta` VALUES (55,25,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:1280;s:6:\"height\";i:525;s:4:\"file\";s:48:\"2026/09/9d69a4e2-b315-4aa6-8389-947cd7fa4daa.png\";s:8:\"filesize\";i:61909;s:5:\"sizes\";a:6:{s:6:\"medium\";a:5:{s:4:\"file\";s:48:\"9d69a4e2-b315-4aa6-8389-947cd7fa4daa-300x123.png\";s:5:\"width\";i:300;s:6:\"height\";i:123;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:17351;}s:5:\"large\";a:5:{s:4:\"file\";s:49:\"9d69a4e2-b315-4aa6-8389-947cd7fa4daa-1024x420.png\";s:5:\"width\";i:1024;s:6:\"height\";i:420;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:66486;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:48:\"9d69a4e2-b315-4aa6-8389-947cd7fa4daa-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:9676;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:48:\"9d69a4e2-b315-4aa6-8389-947cd7fa4daa-768x315.png\";s:5:\"width\";i:768;s:6:\"height\";i:315;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:47602;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:48:\"9d69a4e2-b315-4aa6-8389-947cd7fa4daa-600x400.png\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:39296;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:48:\"9d69a4e2-b315-4aa6-8389-947cd7fa4daa-400x500.png\";s:5:\"width\";i:400;s:6:\"height\";i:500;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:26817;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}');
INSERT INTO `wp_postmeta` VALUES (56,26,'_edit_last','1');
INSERT INTO `wp_postmeta` VALUES (57,26,'_edit_lock','1789404866:1');
INSERT INTO `wp_postmeta` VALUES (58,26,'slide_subheadline','Membangun kualitas hidup berkah sesuai Syariah — Lembaga keuangan syariah yang fokus pada jasa keuangan dan pemberdayaan ekonomi umat serta UMKM.');
INSERT INTO `wp_postmeta` VALUES (59,26,'_slide_subheadline','field_wakalumi_slide_subheadline');
INSERT INTO `wp_postmeta` VALUES (60,26,'slide_cta_text','Hubungi Kami');
INSERT INTO `wp_postmeta` VALUES (61,26,'_slide_cta_text','field_wakalumi_slide_cta_text');
INSERT INTO `wp_postmeta` VALUES (62,26,'slide_cta_url','');
INSERT INTO `wp_postmeta` VALUES (63,26,'_slide_cta_url','field_wakalumi_slide_cta_url');
INSERT INTO `wp_postmeta` VALUES (64,26,'slide_cta_text_2','Lihat Produk');
INSERT INTO `wp_postmeta` VALUES (65,26,'_slide_cta_text_2','field_wakalumi_slide_cta_text_2');
INSERT INTO `wp_postmeta` VALUES (66,26,'slide_cta_url_2','');
INSERT INTO `wp_postmeta` VALUES (67,26,'_slide_cta_url_2','field_wakalumi_slide_cta_url_2');
INSERT INTO `wp_postmeta` VALUES (68,26,'slide_overlay_opacity','60');
INSERT INTO `wp_postmeta` VALUES (69,26,'_slide_overlay_opacity','field_wakalumi_slide_overlay_opacity');
INSERT INTO `wp_postmeta` VALUES (70,28,'_wp_page_template','page-tentang-kami.php');
INSERT INTO `wp_postmeta` VALUES (71,29,'_wp_page_template','page-legalitas.php');
INSERT INTO `wp_postmeta` VALUES (72,5,'_wp_page_template','front-page.php');
INSERT INTO `wp_postmeta` VALUES (73,30,'_wp_attached_file','2026/09/1000353225.png');
INSERT INTO `wp_postmeta` VALUES (74,30,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:1448;s:6:\"height\";i:1086;s:4:\"file\";s:22:\"2026/09/1000353225.png\";s:8:\"filesize\";i:1444809;s:5:\"sizes\";a:7:{s:6:\"medium\";a:5:{s:4:\"file\";s:22:\"1000353225-300x225.png\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:63262;}s:5:\"large\";a:5:{s:4:\"file\";s:23:\"1000353225-1024x768.png\";s:5:\"width\";i:1024;s:6:\"height\";i:768;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:561113;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:22:\"1000353225-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:24863;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:22:\"1000353225-768x576.png\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:334753;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:22:\"1000353225-600x400.png\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:195555;}s:10:\"hero-large\";a:5:{s:4:\"file\";s:24:\"1000353225-1448x1080.png\";s:5:\"width\";i:1448;s:6:\"height\";i:1080;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1327652;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:22:\"1000353225-400x500.png\";s:5:\"width\";i:400;s:6:\"height\";i:500;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:158513;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}');
INSERT INTO `wp_postmeta` VALUES (75,26,'_slide_image_desktop','field_wakalumi_slide_image_desktop');
INSERT INTO `wp_postmeta` VALUES (76,26,'_slide_image_mobile','field_wakalumi_slide_image_mobile');
INSERT INTO `wp_postmeta` VALUES (78,26,'slide_image_mobile','http://wakalumibprscoid.local/wp-content/uploads/2026/09/file_00000000054c81f5ac46c8fb5683d3b2.png');
INSERT INTO `wp_postmeta` VALUES (79,31,'slide_image_desktop','');
INSERT INTO `wp_postmeta` VALUES (80,31,'_slide_image_desktop','field_wakalumi_slide_image_desktop');
INSERT INTO `wp_postmeta` VALUES (81,31,'slide_image_mobile','');
INSERT INTO `wp_postmeta` VALUES (82,31,'_slide_image_mobile','field_wakalumi_slide_image_mobile');
INSERT INTO `wp_postmeta` VALUES (83,31,'slide_subheadline','membantu UMKM dalam mengembangkan usaha anda');
INSERT INTO `wp_postmeta` VALUES (84,31,'_slide_subheadline','field_wakalumi_slide_subheadline');
INSERT INTO `wp_postmeta` VALUES (85,31,'slide_cta_text','Hubungi Kami');
INSERT INTO `wp_postmeta` VALUES (86,31,'_slide_cta_text','field_wakalumi_slide_cta_text');
INSERT INTO `wp_postmeta` VALUES (87,31,'slide_cta_url','');
INSERT INTO `wp_postmeta` VALUES (88,31,'_slide_cta_url','field_wakalumi_slide_cta_url');
INSERT INTO `wp_postmeta` VALUES (89,31,'slide_cta_text_2','Lihat Produk');
INSERT INTO `wp_postmeta` VALUES (90,31,'_slide_cta_text_2','field_wakalumi_slide_cta_text_2');
INSERT INTO `wp_postmeta` VALUES (91,31,'slide_cta_url_2','');
INSERT INTO `wp_postmeta` VALUES (92,31,'_slide_cta_url_2','field_wakalumi_slide_cta_url_2');
INSERT INTO `wp_postmeta` VALUES (93,31,'slide_overlay_opacity','60');
INSERT INTO `wp_postmeta` VALUES (94,31,'_slide_overlay_opacity','field_wakalumi_slide_overlay_opacity');
INSERT INTO `wp_postmeta` VALUES (95,26,'slide_image_desktop','http://wakalumibprscoid.local/wp-content/uploads/2026/09/1000353225.png');
INSERT INTO `wp_postmeta` VALUES (96,26,'_thumbnail_id','30');
INSERT INTO `wp_postmeta` VALUES (97,27,'_edit_lock','1789398872:1');
INSERT INTO `wp_postmeta` VALUES (98,32,'_wp_attached_file','2026/09/file_00000000054c81f5ac46c8fb5683d3b2.png');
INSERT INTO `wp_postmeta` VALUES (99,32,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:1086;s:6:\"height\";i:1448;s:4:\"file\";s:49:\"2026/09/file_00000000054c81f5ac46c8fb5683d3b2.png\";s:8:\"filesize\";i:1418028;s:5:\"sizes\";a:7:{s:6:\"medium\";a:5:{s:4:\"file\";s:49:\"file_00000000054c81f5ac46c8fb5683d3b2-225x300.png\";s:5:\"width\";i:225;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:63426;}s:5:\"large\";a:5:{s:4:\"file\";s:50:\"file_00000000054c81f5ac46c8fb5683d3b2-768x1024.png\";s:5:\"width\";i:768;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:548238;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:49:\"file_00000000054c81f5ac46c8fb5683d3b2-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:25749;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:50:\"file_00000000054c81f5ac46c8fb5683d3b2-768x1024.png\";s:5:\"width\";i:768;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:548238;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:49:\"file_00000000054c81f5ac46c8fb5683d3b2-600x400.png\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:201710;}s:10:\"hero-large\";a:5:{s:4:\"file\";s:51:\"file_00000000054c81f5ac46c8fb5683d3b2-1086x1080.png\";s:5:\"width\";i:1086;s:6:\"height\";i:1080;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1012534;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:49:\"file_00000000054c81f5ac46c8fb5683d3b2-400x500.png\";s:5:\"width\";i:400;s:6:\"height\";i:500;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:161211;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}');
INSERT INTO `wp_postmeta` VALUES (100,26,'slide_image_mobile_id','32');
INSERT INTO `wp_postmeta` VALUES (101,26,'slide_image_desktop_id','30');
INSERT INTO `wp_postmeta` VALUES (102,33,'_wp_page_template','page-susunan-pengurus.php');
INSERT INTO `wp_postmeta` VALUES (103,28,'_edit_lock','1789431818:1');
INSERT INTO `wp_postmeta` VALUES (104,34,'_wp_page_template','page-jaringan-kantor.php');
INSERT INTO `wp_postmeta` VALUES (105,35,'_wp_attached_file','2026/09/02-BSW-Office-Photos-by-Luluil-Manun-scaled.jpg');
INSERT INTO `wp_postmeta` VALUES (106,35,'_wp_attachment_metadata','a:7:{s:5:\"width\";i:2560;s:6:\"height\";i:1707;s:4:\"file\";s:55:\"2026/09/02-BSW-Office-Photos-by-Luluil-Manun-scaled.jpg\";s:8:\"filesize\";i:817766;s:5:\"sizes\";a:9:{s:6:\"medium\";a:5:{s:4:\"file\";s:48:\"02-BSW-Office-Photos-by-Luluil-Manun-300x200.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:49772;}s:5:\"large\";a:5:{s:4:\"file\";s:49:\"02-BSW-Office-Photos-by-Luluil-Manun-1024x683.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:683;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:183941;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:48:\"02-BSW-Office-Photos-by-Luluil-Manun-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:40763;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:48:\"02-BSW-Office-Photos-by-Luluil-Manun-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:122133;}s:9:\"1536x1536\";a:5:{s:4:\"file\";s:50:\"02-BSW-Office-Photos-by-Luluil-Manun-1536x1024.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:353939;}s:9:\"2048x2048\";a:5:{s:4:\"file\";s:50:\"02-BSW-Office-Photos-by-Luluil-Manun-2048x1365.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:1365;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:567517;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:48:\"02-BSW-Office-Photos-by-Luluil-Manun-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:90452;}s:10:\"hero-large\";a:5:{s:4:\"file\";s:50:\"02-BSW-Office-Photos-by-Luluil-Manun-1920x1080.jpg\";s:5:\"width\";i:1920;s:6:\"height\";i:1080;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:455801;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:48:\"02-BSW-Office-Photos-by-Luluil-Manun-400x500.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:500;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:85856;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:2:\"10\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:8:\"ILCE-7M2\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:10:\"1444334911\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:2:\"16\";s:3:\"iso\";s:3:\"100\";s:13:\"shutter_speed\";s:6:\"0.0025\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}s:14:\"original_image\";s:40:\"02-BSW-Office-Photos-by-Luluil-Manun.jpg\";}');
INSERT INTO `wp_postmeta` VALUES (107,36,'_wp_attached_file','2026/09/Profil-Perusahaan-Wakalumi-Baru.png');
INSERT INTO `wp_postmeta` VALUES (108,36,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:564;s:6:\"height\";i:864;s:4:\"file\";s:43:\"2026/09/Profil-Perusahaan-Wakalumi-Baru.png\";s:8:\"filesize\";i:885209;s:5:\"sizes\";a:4:{s:6:\"medium\";a:5:{s:4:\"file\";s:43:\"Profil-Perusahaan-Wakalumi-Baru-196x300.png\";s:5:\"width\";i:196;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:78388;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:43:\"Profil-Perusahaan-Wakalumi-Baru-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:32983;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:43:\"Profil-Perusahaan-Wakalumi-Baru-564x400.png\";s:5:\"width\";i:564;s:6:\"height\";i:400;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:176342;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:43:\"Profil-Perusahaan-Wakalumi-Baru-400x500.png\";s:5:\"width\";i:400;s:6:\"height\";i:500;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:199853;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}');
INSERT INTO `wp_postmeta` VALUES (109,37,'_wp_attached_file','2026/09/Profil-Perusahaan-Wakalumi-Barumm.png');
INSERT INTO `wp_postmeta` VALUES (110,37,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:648;s:6:\"height\";i:864;s:4:\"file\";s:45:\"2026/09/Profil-Perusahaan-Wakalumi-Barumm.png\";s:8:\"filesize\";i:1047157;s:5:\"sizes\";a:4:{s:6:\"medium\";a:5:{s:4:\"file\";s:45:\"Profil-Perusahaan-Wakalumi-Barumm-225x300.png\";s:5:\"width\";i:225;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:108287;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:45:\"Profil-Perusahaan-Wakalumi-Barumm-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:39003;}s:14:\"card-thumbnail\";a:5:{s:4:\"file\";s:45:\"Profil-Perusahaan-Wakalumi-Barumm-600x400.png\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:313924;}s:13:\"team-portrait\";a:5:{s:4:\"file\";s:45:\"Profil-Perusahaan-Wakalumi-Barumm-400x500.png\";s:5:\"width\";i:400;s:6:\"height\";i:500;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:284004;}}s:10:\"image_meta\";a:13:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}s:3:\"alt\";s:0:\"\";}}');
INSERT INTO `wp_postmeta` VALUES (111,39,'_wp_page_template','page-tabungan-syariah.php');
INSERT INTO `wp_postmeta` VALUES (112,40,'_wp_page_template','page-deposito-syariah.php');
INSERT INTO `wp_postmeta` VALUES (113,41,'_wp_page_template','page-pembiayaan.php');
/*!40000 ALTER TABLE `wp_postmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_posts` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`),
  KEY `type_status_author` (`post_type`,`post_status`,`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_posts`
--

LOCK TABLES `wp_posts` WRITE;
/*!40000 ALTER TABLE `wp_posts` DISABLE KEYS */;
INSERT INTO `wp_posts` VALUES (1,1,'2026-09-10 13:16:14','2026-09-10 13:16:14','<!-- wp:paragraph -->\n<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n<!-- /wp:paragraph -->','Hello world!','','publish','open','open','','hello-world','','','2026-09-10 13:16:14','2026-09-10 13:16:14','',0,'http://wakalumibprscoid.local/?p=1',0,'post','',1);
INSERT INTO `wp_posts` VALUES (2,1,'2026-09-10 13:16:14','2026-09-10 13:16:14','<!-- wp:paragraph -->\n<p>This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\">\n<!-- wp:paragraph -->\n<p>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</p>\n<!-- /wp:paragraph -->\n</blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\">\n<!-- wp:paragraph -->\n<p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p>\n<!-- /wp:paragraph -->\n</blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href=\"http://wakalumibprscoid.local/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->','Sample Page','','publish','closed','open','','sample-page','','','2026-09-10 13:16:14','2026-09-10 13:16:14','',0,'http://wakalumibprscoid.local/?page_id=2',0,'page','',0);
INSERT INTO `wp_posts` VALUES (3,1,'2026-09-10 13:16:14','2026-09-10 13:16:14','<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Who we are</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Our website address is: http://wakalumibprscoid.local.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Comments</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Media</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Cookies</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Embedded content from other websites</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Who we share your data with</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you request a password reset, your IP address will be included in the reset email.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">How long we retain your data</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">What rights you have over your data</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Where your data is sent</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Visitor comments may be checked through an automated spam detection service.</p>\n<!-- /wp:paragraph -->\n','Privacy Policy','','draft','closed','open','','privacy-policy','','','2026-09-10 13:16:14','2026-09-10 13:16:14','',0,'http://wakalumibprscoid.local/?page_id=3',0,'page','',0);
INSERT INTO `wp_posts` VALUES (4,1,'2026-09-10 13:27:16','0000-00-00 00:00:00','','Auto Draft','','auto-draft','open','open','','','','','2026-09-10 13:27:16','0000-00-00 00:00:00','',0,'http://wakalumibprscoid.local/?p=4',0,'post','',0);
INSERT INTO `wp_posts` VALUES (5,1,'2026-09-10 13:31:28','2026-09-10 13:31:28','','Home','','publish','closed','closed','','home','','','2026-09-10 13:31:28','2026-09-10 13:31:28','',0,'http://wakalumibprscoid.local/?page_id=5',0,'page','',0);
INSERT INTO `wp_posts` VALUES (6,1,'2026-09-10 13:30:09','2026-09-10 13:30:09','{\"version\": 3, \"isGlobalStylesUserThemeJSON\": true }','Custom Styles','','publish','closed','closed','','wp-global-styles-assets%2f','','','2026-09-10 13:30:09','2026-09-10 13:30:09','',0,'http://wakalumibprscoid.local/wp-global-styles-assets%2f/',0,'wp_global_styles','',0);
INSERT INTO `wp_posts` VALUES (7,1,'2026-09-10 13:31:28','2026-09-10 13:31:28','','Home','','inherit','closed','closed','','5-revision-v1','','','2026-09-10 13:31:28','2026-09-10 13:31:28','',5,'http://wakalumibprscoid.local/?p=7',0,'revision','',0);
INSERT INTO `wp_posts` VALUES (8,1,'2026-09-10 13:41:28','2026-09-10 13:41:28','','untitled3','','inherit','open','closed','','untitled3','','','2026-09-10 13:41:28','2026-09-10 13:41:28','',0,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/untitled3.png',0,'attachment','image/png',0);
INSERT INTO `wp_posts` VALUES (9,1,'2026-09-10 13:41:56','2026-09-10 13:41:56','http://wakalumibprscoid.local/wp-content/uploads/2026/09/cropped-untitled3.png','cropped-untitled3.png','','inherit','open','closed','','cropped-untitled3-png','','','2026-09-10 13:41:56','2026-09-10 13:41:56','',8,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/cropped-untitled3.png',0,'attachment','image/png',0);
INSERT INTO `wp_posts` VALUES (10,1,'2026-09-10 13:42:15','2026-09-10 13:42:15','http://wakalumibprscoid.local/wp-content/uploads/2026/09/cropped-untitled3-1.png','cropped-untitled3-1.png','','inherit','open','closed','','cropped-untitled3-1-png','','','2026-09-10 13:42:15','2026-09-10 13:42:15','',8,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/cropped-untitled3-1.png',0,'attachment','image/png',0);
INSERT INTO `wp_posts` VALUES (11,1,'2026-09-10 13:42:51','2026-09-10 13:42:51','http://wakalumibprscoid.local/wp-content/uploads/2026/09/cropped-untitled3-2.png','cropped-untitled3-2.png','','inherit','open','closed','','cropped-untitled3-2-png','','','2026-09-10 13:42:51','2026-09-10 13:42:51','',8,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/cropped-untitled3-2.png',0,'attachment','image/png',0);
INSERT INTO `wp_posts` VALUES (12,1,'2026-09-10 13:43:35','2026-09-10 13:43:35','{\n    \"blogname\": {\n        \"value\": \"bprswakalumi.co.id\",\n        \"type\": \"option\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2026-09-10 13:42:57\"\n    },\n    \"blogdescription\": {\n        \"value\": \"Bank Syariah Wakalumi\",\n        \"type\": \"option\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2026-09-10 13:42:57\"\n    },\n    \"site_icon\": {\n        \"value\": 11,\n        \"type\": \"option\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2026-09-10 13:42:57\"\n    },\n    \"assets/..::custom_logo\": {\n        \"value\": 10,\n        \"type\": \"theme_mod\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2026-09-10 13:42:57\"\n    }\n}','','','trash','closed','closed','','162d36ac-db8c-4676-ba54-d315d3b748f3','','','2026-09-10 13:43:35','2026-09-10 13:43:35','',0,'http://wakalumibprscoid.local/?p=12',0,'customize_changeset','',0);
INSERT INTO `wp_posts` VALUES (13,1,'2026-09-10 13:44:51','2026-09-10 13:44:51','{\n    \"blogname\": {\n        \"value\": \"Bank Syariah Wakalumi - Beranda\",\n        \"type\": \"option\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2026-09-10 13:44:51\"\n    }\n}','','','trash','closed','closed','','57bd6bf4-a100-4d60-9a27-49e5f6f2c507','','','2026-09-10 13:44:51','2026-09-10 13:44:51','',0,'http://wakalumibprscoid.local/57bd6bf4-a100-4d60-9a27-49e5f6f2c507/',0,'customize_changeset','',0);
INSERT INTO `wp_posts` VALUES (14,1,'2026-09-10 23:07:19','0000-00-00 00:00:00','','Auto Draft','','auto-draft','open','open','','','','','2026-09-10 23:07:19','0000-00-00 00:00:00','',0,'http://wakalumibprscoid.local/?p=14',0,'post','',0);
INSERT INTO `wp_posts` VALUES (15,1,'2026-09-10 23:07:22','0000-00-00 00:00:00','','Auto Draft','','auto-draft','open','open','','','','','2026-09-10 23:07:22','0000-00-00 00:00:00','',0,'http://wakalumibprscoid.local/?p=15',0,'post','',0);
INSERT INTO `wp_posts` VALUES (17,1,'2026-09-11 16:53:48','0000-00-00 00:00:00','','Auto Draft','','auto-draft','open','open','','','','','2026-09-11 16:53:48','0000-00-00 00:00:00','',0,'http://wakalumibprscoid.local/?p=17',0,'post','',0);
INSERT INTO `wp_posts` VALUES (18,1,'2026-09-11 16:53:49','0000-00-00 00:00:00','','Auto Draft','','auto-draft','open','open','','','','','2026-09-11 16:53:49','0000-00-00 00:00:00','',0,'http://wakalumibprscoid.local/?p=18',0,'post','',0);
INSERT INTO `wp_posts` VALUES (19,1,'2026-09-11 16:53:53','0000-00-00 00:00:00','','Auto Draft','','auto-draft','open','open','','','','','2026-09-11 16:53:53','0000-00-00 00:00:00','',0,'http://wakalumibprscoid.local/?p=19',0,'post','',0);
INSERT INTO `wp_posts` VALUES (20,1,'2026-09-11 16:53:58','0000-00-00 00:00:00','','Auto Draft','','auto-draft','open','open','','','','','2026-09-11 16:53:58','0000-00-00 00:00:00','',0,'http://wakalumibprscoid.local/?p=20',0,'post','',0);
INSERT INTO `wp_posts` VALUES (21,1,'2026-09-11 17:10:03','2026-09-11 17:10:03','','staff','','trash','closed','closed','','staff__trashed','','','2026-09-11 17:10:48','2026-09-11 17:10:48','',0,'http://wakalumibprscoid.local/?post_type=anggota_tim&#038;p=21',0,'anggota_tim','',0);
INSERT INTO `wp_posts` VALUES (22,1,'2026-09-13 00:59:22','0000-00-00 00:00:00','','','','draft','closed','closed','','','','','2026-09-13 00:59:22','2026-09-13 00:59:22','',0,'http://wakalumibprscoid.local/?post_type=hero_slide&#038;p=22',0,'hero_slide','',0);
INSERT INTO `wp_posts` VALUES (23,1,'2026-09-13 13:55:49','0000-00-00 00:00:00','','Auto Draft','','auto-draft','closed','closed','','','','','2026-09-13 13:55:49','0000-00-00 00:00:00','',0,'http://wakalumibprscoid.local/?post_type=hero_slide&p=23',0,'hero_slide','',0);
INSERT INTO `wp_posts` VALUES (24,1,'2026-09-13 13:57:32','2026-09-13 06:57:32','','Logo Otoritas Jasa Keuangan (OJK) - Dianisa.com','','inherit','open','closed','','logo-otoritas-jasa-keuangan-ojk-dianisa-com','','','2026-09-13 13:57:32','2026-09-13 06:57:32','',0,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/Logo-Otoritas-Jasa-Keuangan-OJK-Dianisa.com_.png',0,'attachment','image/png',0);
INSERT INTO `wp_posts` VALUES (25,1,'2026-09-13 13:59:36','2026-09-13 06:59:36','','9d69a4e2-b315-4aa6-8389-947cd7fa4daa','','inherit','open','closed','','9d69a4e2-b315-4aa6-8389-947cd7fa4daa','','','2026-09-13 13:59:36','2026-09-13 06:59:36','',0,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/9d69a4e2-b315-4aa6-8389-947cd7fa4daa.png',0,'attachment','image/png',0);
INSERT INTO `wp_posts` VALUES (26,1,'2026-09-13 14:04:41','2026-09-13 07:04:41','','Bank Syariah Wakalumi','','publish','closed','closed','','pembiayaan-umkm','','','2026-09-14 22:28:57','2026-09-14 15:28:57','',0,'http://wakalumibprscoid.local/?post_type=hero_slide&#038;p=26',0,'hero_slide','',0);
INSERT INTO `wp_posts` VALUES (27,1,'2026-09-14 19:16:52','2026-09-14 12:16:52','','Profil','','publish','closed','closed','','profil','','','2026-09-14 19:16:52','2026-09-14 12:16:52','',0,'http://wakalumibprscoid.local/profil/',0,'page','',0);
INSERT INTO `wp_posts` VALUES (28,1,'2026-09-14 19:16:52','2026-09-14 12:16:52','','Tentang Kami','','publish','closed','closed','','tentang-kami','','','2026-09-14 19:16:52','2026-09-14 12:16:52','',27,'http://wakalumibprscoid.local/profil/tentang-kami/',0,'page','',0);
INSERT INTO `wp_posts` VALUES (29,1,'2026-09-14 20:43:32','2026-09-14 13:43:32','','Legalitas Perusahaan','','publish','closed','closed','','legalitas','','','2026-09-14 20:43:32','2026-09-14 13:43:32','',27,'http://wakalumibprscoid.local/profil/legalitas/',0,'page','',0);
INSERT INTO `wp_posts` VALUES (30,1,'2026-09-14 21:54:04','2026-09-14 14:54:04','','1000353225','','inherit','open','closed','','1000353225','','','2026-09-14 21:54:04','2026-09-14 14:54:04','',26,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/1000353225.png',0,'attachment','image/png',0);
INSERT INTO `wp_posts` VALUES (31,1,'2026-09-14 21:55:08','2026-09-14 14:55:08','','Bank Syariah Wakalumi','','inherit','closed','closed','','26-autosave-v1','','','2026-09-14 21:55:08','2026-09-14 14:55:08','',26,'http://wakalumibprscoid.local/?p=31',0,'revision','',0);
INSERT INTO `wp_posts` VALUES (32,1,'2026-09-14 22:17:54','2026-09-14 15:17:54','','file_00000000054c81f5ac46c8fb5683d3b2','','inherit','open','closed','','file_00000000054c81f5ac46c8fb5683d3b2','','','2026-09-14 22:17:54','2026-09-14 15:17:54','',26,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/file_00000000054c81f5ac46c8fb5683d3b2.png',0,'attachment','image/png',0);
INSERT INTO `wp_posts` VALUES (33,0,'2026-09-14 23:04:26','2026-09-14 16:04:26','','Susunan Pengurus','','publish','closed','closed','','susunan-pengurus','','','2026-09-14 23:04:26','2026-09-14 16:04:26','',27,'http://wakalumibprscoid.local/profil/susunan-pengurus/',0,'page','',0);
INSERT INTO `wp_posts` VALUES (34,1,'2026-09-15 13:12:39','2026-09-15 06:12:39','','Jaringan Kantor','','publish','closed','closed','','jaringan-kantor','','','2026-09-15 13:12:39','2026-09-15 06:12:39','',27,'http://wakalumibprscoid.local/profil/jaringan-kantor/',0,'page','',0);
INSERT INTO `wp_posts` VALUES (35,1,'2026-09-15 13:27:49','2026-09-15 06:27:49','','02 BSW Office Photos by Lu\'luil Ma\'nun','','inherit','open','closed','','02-bsw-office-photos-by-luluil-manun','','','2026-09-15 13:27:49','2026-09-15 06:27:49','',0,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/02-BSW-Office-Photos-by-Luluil-Manun.jpg',0,'attachment','image/jpeg',0);
INSERT INTO `wp_posts` VALUES (36,1,'2026-09-15 13:29:36','2026-09-15 06:29:36','','Profil Perusahaan Wakalumi Baru','','inherit','open','closed','','profil-perusahaan-wakalumi-baru','','','2026-09-15 13:29:36','2026-09-15 06:29:36','',0,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/Profil-Perusahaan-Wakalumi-Baru.png',0,'attachment','image/png',0);
INSERT INTO `wp_posts` VALUES (37,1,'2026-09-15 13:29:41','2026-09-15 06:29:41','','Profil Perusahaan Wakalumi Barumm','','inherit','open','closed','','profil-perusahaan-wakalumi-barumm','','','2026-09-15 13:29:41','2026-09-15 06:29:41','',0,'http://wakalumibprscoid.local/wp-content/uploads/2026/09/Profil-Perusahaan-Wakalumi-Barumm.png',0,'attachment','image/png',0);
INSERT INTO `wp_posts` VALUES (38,1,'2026-09-15 17:57:25','2026-09-15 10:57:25','','Produk','','publish','closed','closed','','produk','','','2026-09-15 17:57:25','2026-09-15 10:57:25','',0,'http://wakalumibprscoid.local/produk/',0,'page','',0);
INSERT INTO `wp_posts` VALUES (39,1,'2026-09-15 17:57:25','2026-09-15 10:57:25','','Tabungan Syariah','','publish','closed','closed','','tabungan-syariah','','','2026-09-15 17:57:25','2026-09-15 10:57:25','',38,'http://wakalumibprscoid.local/produk/tabungan-syariah/',0,'page','',0);
INSERT INTO `wp_posts` VALUES (40,1,'2026-09-15 17:57:25','2026-09-15 10:57:25','','Deposito Syariah','','publish','closed','closed','','deposito-syariah','','','2026-09-15 17:57:25','2026-09-15 10:57:25','',38,'http://wakalumibprscoid.local/produk/deposito-syariah/',0,'page','',0);
INSERT INTO `wp_posts` VALUES (41,1,'2026-09-15 17:57:25','2026-09-15 10:57:25','','Pembiayaan Syariah','','publish','closed','closed','','pembiayaan','','','2026-09-15 17:57:25','2026-09-15 10:57:25','',38,'http://wakalumibprscoid.local/produk/pembiayaan/',0,'page','',0);
/*!40000 ALTER TABLE `wp_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint unsigned NOT NULL DEFAULT '0',
  `term_order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_relationships`
--

LOCK TABLES `wp_term_relationships` WRITE;
/*!40000 ALTER TABLE `wp_term_relationships` DISABLE KEYS */;
INSERT INTO `wp_term_relationships` VALUES (1,1,0);
INSERT INTO `wp_term_relationships` VALUES (6,2,0);
/*!40000 ALTER TABLE `wp_term_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint unsigned NOT NULL DEFAULT '0',
  `count` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_taxonomy`
--

LOCK TABLES `wp_term_taxonomy` WRITE;
/*!40000 ALTER TABLE `wp_term_taxonomy` DISABLE KEYS */;
INSERT INTO `wp_term_taxonomy` VALUES (1,1,'category','',0,1);
INSERT INTO `wp_term_taxonomy` VALUES (2,2,'wp_theme','',0,1);
/*!40000 ALTER TABLE `wp_term_taxonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_termmeta`
--

DROP TABLE IF EXISTS `wp_termmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_termmeta` (
  `meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_termmeta`
--

LOCK TABLES `wp_termmeta` WRITE;
/*!40000 ALTER TABLE `wp_termmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_termmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_terms` (
  `term_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_terms`
--

LOCK TABLES `wp_terms` WRITE;
/*!40000 ALTER TABLE `wp_terms` DISABLE KEYS */;
INSERT INTO `wp_terms` VALUES (1,'Uncategorized','uncategorized',0);
INSERT INTO `wp_terms` VALUES (2,'assets/..','assets',0);
/*!40000 ALTER TABLE `wp_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_usermeta`
--

LOCK TABLES `wp_usermeta` WRITE;
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` VALUES (1,1,'nickname','admin');
INSERT INTO `wp_usermeta` VALUES (2,1,'first_name','');
INSERT INTO `wp_usermeta` VALUES (3,1,'last_name','');
INSERT INTO `wp_usermeta` VALUES (4,1,'description','');
INSERT INTO `wp_usermeta` VALUES (5,1,'rich_editing','true');
INSERT INTO `wp_usermeta` VALUES (6,1,'syntax_highlighting','true');
INSERT INTO `wp_usermeta` VALUES (7,1,'infinite_scrolling','true');
INSERT INTO `wp_usermeta` VALUES (8,1,'comment_shortcuts','false');
INSERT INTO `wp_usermeta` VALUES (9,1,'admin_color','modern');
INSERT INTO `wp_usermeta` VALUES (10,1,'use_ssl','0');
INSERT INTO `wp_usermeta` VALUES (11,1,'show_admin_bar_front','true');
INSERT INTO `wp_usermeta` VALUES (12,1,'locale','');
INSERT INTO `wp_usermeta` VALUES (13,1,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}');
INSERT INTO `wp_usermeta` VALUES (14,1,'wp_user_level','10');
INSERT INTO `wp_usermeta` VALUES (15,1,'dismissed_wp_pointers','');
INSERT INTO `wp_usermeta` VALUES (16,1,'default_password_nag','1');
INSERT INTO `wp_usermeta` VALUES (17,1,'show_welcome_panel','1');
INSERT INTO `wp_usermeta` VALUES (18,1,'session_tokens','a:1:{s:64:\"33937935c09483953abec8a0de0b345eb007be55c0c22ef2fb13b1f1378f208a\";a:4:{s:10:\"expiration\";i:1790256431;s:2:\"ip\";s:9:\"127.0.0.1\";s:2:\"ua\";s:125:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0\";s:5:\"login\";i:1789046831;}}');
INSERT INTO `wp_usermeta` VALUES (19,1,'wp_dashboard_quick_press_last_post_id','4');
INSERT INTO `wp_usermeta` VALUES (20,1,'wp_persisted_preferences','a:3:{s:4:\"core\";a:1:{s:26:\"isComplementaryAreaVisible\";b:1;}s:14:\"core/edit-post\";a:1:{s:12:\"welcomeGuide\";b:0;}s:9:\"_modified\";s:24:\"2026-09-10T13:30:16.294Z\";}');
INSERT INTO `wp_usermeta` VALUES (21,1,'wp_user-settings','libraryContent=browse');
INSERT INTO `wp_usermeta` VALUES (22,1,'wp_user-settings-time','1789047821');
INSERT INTO `wp_usermeta` VALUES (23,1,'manageedit-acf-post-typecolumnshidden','a:1:{i:0;s:7:\"acf-key\";}');
INSERT INTO `wp_usermeta` VALUES (24,1,'acf_user_settings','a:2:{s:19:\"post-type-first-run\";b:1;s:20:\"taxonomies-first-run\";b:1;}');
INSERT INTO `wp_usermeta` VALUES (25,1,'manageedit-acf-taxonomycolumnshidden','a:1:{i:0;s:7:\"acf-key\";}');
INSERT INTO `wp_usermeta` VALUES (26,1,'closedpostboxes_anggota_tim','a:0:{}');
INSERT INTO `wp_usermeta` VALUES (27,1,'metaboxhidden_anggota_tim','a:1:{i:0;s:7:\"slugdiv\";}');
/*!40000 ALTER TABLE `wp_usermeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_users` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_users`
--

LOCK TABLES `wp_users` WRITE;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;
INSERT INTO `wp_users` VALUES (1,'admin','$wp$2y$10$jnJIvXFrh4PrqViVeTiei.1kt5dfHphKt9y67p5Udx5C0B9kNhXSq','admin','dev-email@wpengine.local','http://wakalumibprscoid.local','2026-09-10 13:16:14','',0,'admin');
/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-17  6:26:15
