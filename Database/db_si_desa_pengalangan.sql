-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.38-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk db_si_desa_pengalangan
CREATE DATABASE IF NOT EXISTS `db_si_desa_pengalangan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_si_desa_pengalangan`;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_groups
CREATE TABLE IF NOT EXISTS `aauth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_groups: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_groups` DISABLE KEYS */;
INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
	(1, 'Admin', 'Superadmin Group'),
	(2, 'Public', 'Public Group'),
	(3, 'Default', 'Default Access Group'),
	(4, 'Member', 'Member Access Group');
/*!40000 ALTER TABLE `aauth_groups` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_group_to_group
CREATE TABLE IF NOT EXISTS `aauth_group_to_group` (
  `group_id` int(11) unsigned NOT NULL,
  `subgroup_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`subgroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_group_to_group: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_group_to_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_group_to_group` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_login_attempts
CREATE TABLE IF NOT EXISTS `aauth_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_login_attempts: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_login_attempts` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_perms
CREATE TABLE IF NOT EXISTS `aauth_perms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_perms: ~208 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_perms` DISABLE KEYS */;
INSERT INTO `aauth_perms` (`id`, `name`, `definition`) VALUES
	(1, 'menu_dashboard', NULL),
	(2, 'menu_crud_builder', NULL),
	(3, 'menu_api_builder', NULL),
	(4, 'menu_page_builder', NULL),
	(5, 'menu_form_builder', NULL),
	(6, 'menu_menu', NULL),
	(7, 'menu_auth', NULL),
	(8, 'menu_user', NULL),
	(9, 'menu_group', NULL),
	(10, 'menu_access', NULL),
	(11, 'menu_permission', NULL),
	(12, 'menu_api_documentation', NULL),
	(13, 'menu_web_documentation', NULL),
	(14, 'menu_settings', NULL),
	(15, 'user_list', NULL),
	(16, 'user_update_status', NULL),
	(17, 'user_export', NULL),
	(18, 'user_add', NULL),
	(19, 'user_update', NULL),
	(20, 'user_update_profile', NULL),
	(21, 'user_update_password', NULL),
	(22, 'user_profile', NULL),
	(23, 'user_view', NULL),
	(24, 'user_delete', NULL),
	(25, 'blog_list', NULL),
	(26, 'blog_export', NULL),
	(27, 'blog_add', NULL),
	(28, 'blog_update', NULL),
	(29, 'blog_view', NULL),
	(30, 'blog_delete', NULL),
	(31, 'form_list', NULL),
	(32, 'form_export', NULL),
	(33, 'form_add', NULL),
	(34, 'form_update', NULL),
	(35, 'form_view', NULL),
	(36, 'form_manage', NULL),
	(37, 'form_delete', NULL),
	(38, 'crud_list', NULL),
	(39, 'crud_export', NULL),
	(40, 'crud_add', NULL),
	(41, 'crud_update', NULL),
	(42, 'crud_view', NULL),
	(43, 'crud_delete', NULL),
	(44, 'rest_list', NULL),
	(45, 'rest_export', NULL),
	(46, 'rest_add', NULL),
	(47, 'rest_update', NULL),
	(48, 'rest_view', NULL),
	(49, 'rest_delete', NULL),
	(50, 'group_list', NULL),
	(51, 'group_export', NULL),
	(52, 'group_add', NULL),
	(53, 'group_update', NULL),
	(54, 'group_view', NULL),
	(55, 'group_delete', NULL),
	(56, 'permission_list', NULL),
	(57, 'permission_export', NULL),
	(58, 'permission_add', NULL),
	(59, 'permission_update', NULL),
	(60, 'permission_view', NULL),
	(61, 'permission_delete', NULL),
	(62, 'access_list', NULL),
	(63, 'access_add', NULL),
	(64, 'access_update', NULL),
	(65, 'menu_list', NULL),
	(66, 'menu_add', NULL),
	(67, 'menu_update', NULL),
	(68, 'menu_delete', NULL),
	(69, 'menu_save_ordering', NULL),
	(70, 'menu_type_add', NULL),
	(71, 'page_list', NULL),
	(72, 'page_export', NULL),
	(73, 'page_add', NULL),
	(74, 'page_update', NULL),
	(75, 'page_view', NULL),
	(76, 'page_delete', NULL),
	(77, 'blog_list', NULL),
	(78, 'blog_export', NULL),
	(79, 'blog_add', NULL),
	(80, 'blog_update', NULL),
	(81, 'blog_view', NULL),
	(82, 'blog_delete', NULL),
	(83, 'setting', NULL),
	(84, 'setting_update', NULL),
	(85, 'dashboard', NULL),
	(86, 'extension_list', NULL),
	(87, 'extension_activate', NULL),
	(88, 'extension_deactivate', NULL),
	(89, 'data_desa_add', ''),
	(90, 'data_desa_update', ''),
	(91, 'data_desa_view', ''),
	(92, 'data_desa_delete', ''),
	(93, 'data_desa_list', ''),
	(94, 'api_data_desa_all', ''),
	(95, 'api_data_desa_detail', ''),
	(96, 'api_data_desa_add', ''),
	(97, 'api_data_desa_update', ''),
	(98, 'api_data_desa_delete', ''),
	(99, 'data_jenis_lembaga_desa_add', ''),
	(100, 'data_jenis_lembaga_desa_update', ''),
	(101, 'data_jenis_lembaga_desa_view', ''),
	(102, 'data_jenis_lembaga_desa_delete', ''),
	(103, 'data_jenis_lembaga_desa_list', ''),
	(104, 'data_jenis_potensi_desa_add', ''),
	(105, 'data_jenis_potensi_desa_update', ''),
	(106, 'data_jenis_potensi_desa_view', ''),
	(107, 'data_jenis_potensi_desa_delete', ''),
	(108, 'data_jenis_potensi_desa_list', ''),
	(109, 'data_jenis_surat_add', ''),
	(110, 'data_jenis_surat_update', ''),
	(111, 'data_jenis_surat_view', ''),
	(112, 'data_jenis_surat_delete', ''),
	(113, 'data_jenis_surat_list', ''),
	(114, 'data_kartu_keluarga_add', ''),
	(115, 'data_kartu_keluarga_update', ''),
	(116, 'data_kartu_keluarga_view', ''),
	(117, 'data_kartu_keluarga_delete', ''),
	(118, 'data_kartu_keluarga_list', ''),
	(119, 'data_lembaga_desa_add', ''),
	(120, 'data_lembaga_desa_update', ''),
	(121, 'data_lembaga_desa_view', ''),
	(122, 'data_lembaga_desa_delete', ''),
	(123, 'data_lembaga_desa_list', ''),
	(124, 'data_master_surat_add', ''),
	(125, 'data_master_surat_update', ''),
	(126, 'data_master_surat_view', ''),
	(127, 'data_master_surat_delete', ''),
	(128, 'data_master_surat_list', ''),
	(129, 'data_penduduk_add', ''),
	(130, 'data_penduduk_update', ''),
	(131, 'data_penduduk_view', ''),
	(132, 'data_penduduk_delete', ''),
	(133, 'data_penduduk_list', ''),
	(134, 'data_perangkat_desa_add', ''),
	(135, 'data_perangkat_desa_update', ''),
	(136, 'data_perangkat_desa_view', ''),
	(137, 'data_perangkat_desa_delete', ''),
	(138, 'data_perangkat_desa_list', ''),
	(139, 'data_surat_masuk_add', ''),
	(140, 'data_surat_masuk_update', ''),
	(141, 'data_surat_masuk_view', ''),
	(142, 'data_surat_masuk_delete', ''),
	(143, 'data_surat_masuk_list', ''),
	(144, 'data_user_add', ''),
	(145, 'data_user_update', ''),
	(146, 'data_user_view', ''),
	(147, 'data_user_delete', ''),
	(148, 'data_user_list', ''),
	(149, 'data_surat_keluar_add', ''),
	(150, 'data_surat_keluar_update', ''),
	(151, 'data_surat_keluar_view', ''),
	(152, 'data_surat_keluar_delete', ''),
	(153, 'data_surat_keluar_list', ''),
	(154, 'api_data_jenis_lembaga_desa_all', ''),
	(155, 'api_data_jenis_lembaga_desa_detail', ''),
	(156, 'api_data_jenis_lembaga_desa_add', ''),
	(157, 'api_data_jenis_lembaga_desa_update', ''),
	(158, 'api_data_jenis_lembaga_desa_delete', ''),
	(159, 'api_data_jenis_potensi_desa_all', ''),
	(160, 'api_data_jenis_potensi_desa_detail', ''),
	(161, 'api_data_jenis_potensi_desa_add', ''),
	(162, 'api_data_jenis_potensi_desa_update', ''),
	(163, 'api_data_jenis_potensi_desa_delete', ''),
	(164, 'api_data_jenis_surat_all', ''),
	(165, 'api_data_jenis_surat_detail', ''),
	(166, 'api_data_jenis_surat_add', ''),
	(167, 'api_data_jenis_surat_update', ''),
	(168, 'api_data_jenis_surat_delete', ''),
	(169, 'api_data_kartu_keluarga_all', ''),
	(170, 'api_data_kartu_keluarga_detail', ''),
	(171, 'api_data_kartu_keluarga_add', ''),
	(172, 'api_data_kartu_keluarga_update', ''),
	(173, 'api_data_kartu_keluarga_delete', ''),
	(174, 'api_data_lembaga_desa_all', ''),
	(175, 'api_data_lembaga_desa_detail', ''),
	(176, 'api_data_lembaga_desa_add', ''),
	(177, 'api_data_lembaga_desa_update', ''),
	(178, 'api_data_lembaga_desa_delete', ''),
	(179, 'api_data_master_surat_all', ''),
	(180, 'api_data_master_surat_detail', ''),
	(181, 'api_data_master_surat_add', ''),
	(182, 'api_data_master_surat_update', ''),
	(183, 'api_data_master_surat_delete', ''),
	(184, 'api_data_penduduk_all', ''),
	(185, 'api_data_penduduk_detail', ''),
	(186, 'api_data_penduduk_add', ''),
	(187, 'api_data_penduduk_update', ''),
	(188, 'api_data_penduduk_delete', ''),
	(189, 'api_data_perangkat_desa_all', ''),
	(190, 'api_data_perangkat_desa_detail', ''),
	(191, 'api_data_perangkat_desa_add', ''),
	(192, 'api_data_perangkat_desa_update', ''),
	(193, 'api_data_perangkat_desa_delete', ''),
	(194, 'api_data_surat_keluar_all', ''),
	(195, 'api_data_surat_keluar_detail', ''),
	(196, 'api_data_surat_keluar_add', ''),
	(197, 'api_data_surat_keluar_update', ''),
	(198, 'api_data_surat_keluar_delete', ''),
	(199, 'api_data_surat_masuk_all', ''),
	(200, 'api_data_surat_masuk_detail', ''),
	(201, 'api_data_surat_masuk_add', ''),
	(202, 'api_data_surat_masuk_update', ''),
	(203, 'api_data_surat_masuk_delete', ''),
	(204, 'api_data_user_all', ''),
	(205, 'api_data_user_detail', ''),
	(206, 'api_data_user_add', ''),
	(207, 'api_data_user_update', ''),
	(208, 'api_data_user_delete', '');
/*!40000 ALTER TABLE `aauth_perms` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_perm_to_group
CREATE TABLE IF NOT EXISTS `aauth_perm_to_group` (
  `perm_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_perm_to_group: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_perm_to_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_perm_to_group` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_perm_to_user
CREATE TABLE IF NOT EXISTS `aauth_perm_to_user` (
  `perm_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_perm_to_user: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_perm_to_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_perm_to_user` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_pms
CREATE TABLE IF NOT EXISTS `aauth_pms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `title` varchar(225) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_pms: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_pms` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_pms` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_user
CREATE TABLE IF NOT EXISTS `aauth_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_user: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_user` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_users
CREATE TABLE IF NOT EXISTS `aauth_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `oauth_uid` text,
  `oauth_provider` varchar(100) DEFAULT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `avatar` text NOT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `top_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_users: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_users` DISABLE KEYS */;
INSERT INTO `aauth_users` (`id`, `email`, `oauth_uid`, `oauth_provider`, `pass`, `username`, `full_name`, `avatar`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `top_secret`, `ip_address`) VALUES
	(1, 'admin@gmail.com', NULL, NULL, 'b5c56a7a576509eb4933502ac81584e0a15b84f49cd274dc470273572f65d2db', 'admin', 'admin', '', 0, '2021-04-30 01:23:50', '2021-04-30 01:23:50', '2021-04-28 05:28:59', NULL, NULL, NULL, NULL, NULL, '::1');
/*!40000 ALTER TABLE `aauth_users` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_user_to_group
CREATE TABLE IF NOT EXISTS `aauth_user_to_group` (
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_user_to_group: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_user_to_group` DISABLE KEYS */;
INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
	(1, 1),
	(1, 3);
/*!40000 ALTER TABLE `aauth_user_to_group` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.aauth_user_variables
CREATE TABLE IF NOT EXISTS `aauth_user_variables` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.aauth_user_variables: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `aauth_user_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_user_variables` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.blog
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `tags` text NOT NULL,
  `category` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL,
  `author` varchar(100) NOT NULL,
  `viewers` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.blog: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` (`id`, `title`, `slug`, `content`, `image`, `tags`, `category`, `status`, `author`, `viewers`, `created_at`, `updated_at`) VALUES
	(1, 'Hello Wellcome To Cicool Builder', 'Hello-Wellcome-To-Ciool-Builder', 'greetings from our team I hope to be happy! ', 'wellcome.jpg', 'greetings', '1', 'publish', 'admin', 0, '2021-04-28 05:28:57', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.blog_category
CREATE TABLE IF NOT EXISTS `blog_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL,
  `category_desc` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.blog_category: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `blog_category` DISABLE KEYS */;
INSERT INTO `blog_category` (`category_id`, `category_name`, `category_desc`) VALUES
	(1, 'Technology', ''),
	(2, 'Lifestyle', '');
/*!40000 ALTER TABLE `blog_category` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.captcha
CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.captcha: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `captcha` DISABLE KEYS */;
/*!40000 ALTER TABLE `captcha` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.cc_options
CREATE TABLE IF NOT EXISTS `cc_options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) NOT NULL,
  `option_value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.cc_options: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `cc_options` DISABLE KEYS */;
INSERT INTO `cc_options` (`id`, `option_name`, `option_value`) VALUES
	(1, 'active_theme', 'cicool'),
	(2, 'favicon', 'default.png'),
	(3, 'site_name', 'AGASTYAN');
/*!40000 ALTER TABLE `cc_options` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.cc_session
CREATE TABLE IF NOT EXISTS `cc_session` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.cc_session: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `cc_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_session` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.crud
CREATE TABLE IF NOT EXISTS `crud` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `page_read` varchar(20) DEFAULT NULL,
  `page_create` varchar(20) DEFAULT NULL,
  `page_update` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.crud: ~11 rows (lebih kurang)
/*!40000 ALTER TABLE `crud` DISABLE KEYS */;
INSERT INTO `crud` (`id`, `title`, `subject`, `table_name`, `primary_key`, `page_read`, `page_create`, `page_update`) VALUES
	(1, 'Data Desa', 'Data Desa', 'data_desa', 'id_desa', 'yes', 'yes', 'yes'),
	(2, 'Data Jenis Lembaga Desa', 'Data Jenis Lembaga Desa', 'data_jenis_lembaga_desa', 'id_lembaga', 'yes', 'yes', 'yes'),
	(3, 'Data Jenis Potensi Desa', 'Data Jenis Potensi Desa', 'data_jenis_potensi_desa', 'id_jenis_potensi', 'yes', 'yes', 'yes'),
	(4, 'Data Jenis Surat', 'Data Jenis Surat', 'data_jenis_surat', 'id_jenis_surat', 'yes', 'yes', 'yes'),
	(5, 'Data Kartu Keluarga', 'Data Kartu Keluarga', 'data_kartu_keluarga', 'no_kk', 'yes', 'yes', 'yes'),
	(6, 'Data Lembaga Desa', 'Data Lembaga Desa', 'data_lembaga_desa', 'id_lembaga', 'yes', 'yes', 'yes'),
	(7, 'Data Master Surat', 'Data Master Surat', 'data_master_surat', 'id_surat', 'yes', 'yes', 'yes'),
	(8, 'Data Penduduk', 'Data Penduduk', 'data_penduduk', 'nik', 'yes', 'yes', 'yes'),
	(9, 'Data Perangkat Desa', 'Data Perangkat Desa', 'data_perangkat_desa', 'id_perangkat_desa', 'yes', 'yes', 'yes'),
	(10, 'Data Surat Masuk', 'Data Surat Masuk', 'data_surat_masuk', 'id_surat_masuk', 'yes', 'yes', 'yes'),
	(11, 'Data User', 'Data User', 'data_user', 'id_user', 'yes', 'yes', 'yes'),
	(12, 'Data Surat Keluar', 'Data Surat Keluar', 'data_surat_keluar', 'No_id_Surat', 'yes', 'yes', 'yes');
/*!40000 ALTER TABLE `crud` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.crud_custom_option
CREATE TABLE IF NOT EXISTS `crud_custom_option` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.crud_custom_option: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `crud_custom_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `crud_custom_option` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.crud_field
CREATE TABLE IF NOT EXISTS `crud_field` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `crud_id` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `input_type` varchar(200) NOT NULL,
  `show_column` varchar(10) DEFAULT NULL,
  `show_add_form` varchar(10) DEFAULT NULL,
  `show_update_form` varchar(10) DEFAULT NULL,
  `show_detail_page` varchar(10) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `relation_table` varchar(200) DEFAULT NULL,
  `relation_value` varchar(200) DEFAULT NULL,
  `relation_label` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.crud_field: ~39 rows (lebih kurang)
/*!40000 ALTER TABLE `crud_field` DISABLE KEYS */;
INSERT INTO `crud_field` (`id`, `crud_id`, `field_name`, `field_label`, `input_type`, `show_column`, `show_add_form`, `show_update_form`, `show_detail_page`, `sort`, `relation_table`, `relation_value`, `relation_label`) VALUES
	(5, 1, 'id_desa', 'id_desa', 'number', '', '', '', 'yes', 1, '', '', ''),
	(6, 1, 'nama_desa', 'nama_desa', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(7, 1, 'alamat_lengkap', 'alamat_lengkap', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
	(8, 1, 'deskripsi', 'deskripsi', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
	(9, 2, 'id_lembaga', 'id_lembaga', 'number', '', '', '', 'yes', 1, '', '', ''),
	(10, 2, 'nama_lembaga', 'nama_lembaga', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(11, 3, 'id_jenis_potensi', 'id_jenis_potensi', 'number', '', '', '', 'yes', 1, '', '', ''),
	(12, 3, 'nama_potensi', 'nama_potensi', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(13, 4, 'id_jenis_surat', 'id_jenis_surat', 'number', '', '', '', 'yes', 1, '', '', ''),
	(14, 4, 'id_surat_master', 'id_surat_master', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(15, 4, 'id_surat_masuk', 'id_surat_masuk', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
	(16, 4, 'id_surat_keluar', 'id_surat_keluar', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
	(17, 5, 'no_kk', 'no_kk', 'number', '', '', '', 'yes', 1, '', '', ''),
	(18, 5, 'nik', 'nik', 'number', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(19, 6, 'id_lembaga', 'id_lembaga', 'number', '', '', '', 'yes', 1, '', '', ''),
	(20, 6, 'nama_lembaga', 'nama_lembaga', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(21, 6, 'jenis_lembaga', 'jenis_lembaga', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
	(22, 7, 'id_surat', 'id_surat', 'number', '', '', '', 'yes', 1, '', '', ''),
	(23, 7, 'No_surat', 'No_surat', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(24, 7, 'keterangan_surat', 'keterangan_surat', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
	(25, 7, 'kepada', 'kepada', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
	(26, 7, 'Alamat', 'Alamat', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
	(27, 7, 'tanggal', 'tanggal', 'date', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
	(28, 7, 'tempat', 'tempat', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
	(29, 7, 'kepala_desa', 'kepala_desa', 'number', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
	(30, 8, 'nik', 'nik', 'number', '', '', '', 'yes', 1, '', '', ''),
	(31, 8, 'no_kk', 'no_kk', 'number', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(32, 8, 'nama_penduduk', 'nama_penduduk', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
	(33, 8, 'jenis_kelamin', 'jenis_kelamin', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
	(34, 8, 'alamat_penduduk', 'alamat_penduduk', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
	(35, 9, 'id_perangkat_desa', 'id_perangkat_desa', 'number', '', '', '', 'yes', 1, '', '', ''),
	(36, 9, 'nama_perangkat_desa', 'nama_perangkat_desa', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(37, 9, 'jabatan', 'jabatan', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
	(38, 10, 'id_surat_masuk', 'id_surat_masuk', 'number', '', '', '', 'yes', 1, '', '', ''),
	(39, 10, 'id_jenis_surat', 'id_jenis_surat', 'number', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(40, 10, 'tgl_masuk', 'tgl_masuk', 'date', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
	(41, 10, 'perihal', 'perihal', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
	(42, 11, 'id_user', 'id_user', 'number', '', '', '', 'yes', 1, '', '', ''),
	(43, 11, 'password', 'password', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(44, 11, 'nik', 'nik', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
	(45, 12, 'No_id_Surat', 'No_id_Surat', 'number', '', '', '', 'yes', 1, '', '', ''),
	(46, 12, 'id_surat_keluar', 'id_surat_keluar', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
	(47, 12, 'tgl_keluar', 'tgl_keluar', 'date', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
	(48, 12, 'Perihal', 'Perihal', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
/*!40000 ALTER TABLE `crud_field` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.crud_field_validation
CREATE TABLE IF NOT EXISTS `crud_field_validation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.crud_field_validation: ~49 rows (lebih kurang)
/*!40000 ALTER TABLE `crud_field_validation` DISABLE KEYS */;
INSERT INTO `crud_field_validation` (`id`, `crud_field_id`, `crud_id`, `validation_name`, `validation_value`) VALUES
	(5, 6, 1, 'required', ''),
	(6, 6, 1, 'max_length', '255'),
	(7, 7, 1, 'required', ''),
	(8, 8, 1, 'required', ''),
	(9, 10, 2, 'required', ''),
	(10, 10, 2, 'max_length', '50'),
	(11, 12, 3, 'required', ''),
	(12, 12, 3, 'max_length', '50'),
	(13, 14, 4, 'required', ''),
	(14, 14, 4, 'max_length', '255'),
	(15, 15, 4, 'required', ''),
	(16, 15, 4, 'max_length', '255'),
	(17, 16, 4, 'required', ''),
	(18, 16, 4, 'max_length', '255'),
	(19, 18, 5, 'required', ''),
	(20, 18, 5, 'max_length', '11'),
	(21, 20, 6, 'required', ''),
	(22, 20, 6, 'max_length', '255'),
	(23, 21, 6, 'required', ''),
	(24, 21, 6, 'max_length', '255'),
	(25, 23, 7, 'required', ''),
	(26, 23, 7, 'max_length', '255'),
	(27, 24, 7, 'required', ''),
	(28, 25, 7, 'required', ''),
	(29, 25, 7, 'max_length', '255'),
	(30, 26, 7, 'required', ''),
	(31, 27, 7, 'required', ''),
	(32, 28, 7, 'required', ''),
	(33, 29, 7, 'required', ''),
	(34, 29, 7, 'max_length', '11'),
	(35, 31, 8, 'required', ''),
	(36, 31, 8, 'max_length', '11'),
	(37, 32, 8, 'required', ''),
	(38, 32, 8, 'max_length', '255'),
	(39, 33, 8, 'required', ''),
	(40, 33, 8, 'max_length', '255'),
	(41, 34, 8, 'required', ''),
	(42, 36, 9, 'required', ''),
	(43, 36, 9, 'max_length', '50'),
	(44, 37, 9, 'required', ''),
	(45, 37, 9, 'max_length', '50'),
	(46, 39, 10, 'required', ''),
	(47, 39, 10, 'max_length', '11'),
	(48, 40, 10, 'required', ''),
	(49, 41, 10, 'required', ''),
	(50, 43, 11, 'required', ''),
	(51, 43, 11, 'max_length', '255'),
	(52, 44, 11, 'required', ''),
	(53, 44, 11, 'max_length', '255'),
	(54, 46, 12, 'required', ''),
	(55, 46, 12, 'max_length', '255'),
	(56, 47, 12, 'required', ''),
	(57, 48, 12, 'required', '');
/*!40000 ALTER TABLE `crud_field_validation` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.crud_input_type
CREATE TABLE IF NOT EXISTS `crud_input_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `custom_value` int(11) NOT NULL,
  `validation_group` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.crud_input_type: ~26 rows (lebih kurang)
/*!40000 ALTER TABLE `crud_input_type` DISABLE KEYS */;
INSERT INTO `crud_input_type` (`id`, `type`, `relation`, `custom_value`, `validation_group`) VALUES
	(1, 'input', '0', 0, 'input'),
	(2, 'textarea', '0', 0, 'text'),
	(3, 'select', '1', 0, 'select'),
	(4, 'editor_wysiwyg', '0', 0, 'editor'),
	(5, 'password', '0', 0, 'password'),
	(6, 'email', '0', 0, 'email'),
	(7, 'address_map', '0', 0, 'address_map'),
	(8, 'file', '0', 0, 'file'),
	(9, 'file_multiple', '0', 0, 'file_multiple'),
	(10, 'datetime', '0', 0, 'datetime'),
	(11, 'date', '0', 0, 'date'),
	(12, 'timestamp', '0', 0, 'timestamp'),
	(13, 'number', '0', 0, 'number'),
	(14, 'yes_no', '0', 0, 'yes_no'),
	(15, 'time', '0', 0, 'time'),
	(16, 'year', '0', 0, 'year'),
	(17, 'select_multiple', '1', 0, 'select_multiple'),
	(18, 'checkboxes', '1', 0, 'checkboxes'),
	(19, 'options', '1', 0, 'options'),
	(20, 'true_false', '0', 0, 'true_false'),
	(21, 'current_user_username', '0', 0, 'user_username'),
	(22, 'current_user_id', '0', 0, 'current_user_id'),
	(23, 'custom_option', '0', 1, 'custom_option'),
	(24, 'custom_checkbox', '0', 1, 'custom_checkbox'),
	(25, 'custom_select_multiple', '0', 1, 'custom_select_multiple'),
	(26, 'custom_select', '0', 1, 'custom_select');
/*!40000 ALTER TABLE `crud_input_type` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.crud_input_validation
CREATE TABLE IF NOT EXISTS `crud_input_validation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `validation` varchar(200) NOT NULL,
  `input_able` varchar(20) NOT NULL,
  `group_input` text NOT NULL,
  `input_placeholder` text NOT NULL,
  `call_back` varchar(10) NOT NULL,
  `input_validation` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.crud_input_validation: ~37 rows (lebih kurang)
/*!40000 ALTER TABLE `crud_input_validation` DISABLE KEYS */;
INSERT INTO `crud_input_validation` (`id`, `validation`, `input_able`, `group_input`, `input_placeholder`, `call_back`, `input_validation`) VALUES
	(1, 'required', 'no', 'input, file, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes, true_false, address_map, custom_option, custom_checkbox, custom_select_multiple, custom_select, file_multiple', '', '', ''),
	(2, 'max_length', 'yes', 'input, number, text, select, password, email, editor, yes_no, time, year, select_multiple, options, checkboxes, address_map', '', '', 'numeric'),
	(3, 'min_length', 'yes', 'input, number, text, select, password, email, editor, time, year, select_multiple, address_map', '', '', 'numeric'),
	(4, 'valid_email', 'no', 'input, email', '', '', ''),
	(5, 'valid_emails', 'no', 'input, email', '', '', ''),
	(6, 'regex', 'yes', 'input, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes', '', 'yes', 'callback_valid_regex'),
	(7, 'decimal', 'no', 'input, number, text, select', '', '', ''),
	(8, 'allowed_extension', 'yes', 'file, file_multiple', 'ex : jpg,png,..', '', 'callback_valid_extension_list'),
	(9, 'max_width', 'yes', 'file, file_multiple', '', '', 'numeric'),
	(10, 'max_height', 'yes', 'file, file_multiple', '', '', 'numeric'),
	(11, 'max_size', 'yes', 'file, file_multiple', '... kb', '', 'numeric'),
	(12, 'max_item', 'yes', 'file_multiple', '', '', 'numeric'),
	(13, 'valid_url', 'no', 'input, text', '', '', ''),
	(14, 'alpha', 'no', 'input, text, select, password, editor, yes_no', '', '', ''),
	(15, 'alpha_numeric', 'no', 'input, number, text, select, password, editor', '', '', ''),
	(16, 'alpha_numeric_spaces', 'no', 'input, number, text,select, password, editor', '', '', ''),
	(17, 'valid_number', 'no', 'input, number, text, password, editor, true_false', '', 'yes', ''),
	(18, 'valid_datetime', 'no', 'input, datetime, text', '', 'yes', ''),
	(19, 'valid_date', 'no', 'input, datetime, date, text', '', 'yes', ''),
	(20, 'valid_max_selected_option', 'yes', 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes', '', 'yes', 'numeric'),
	(21, 'valid_min_selected_option', 'yes', 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes', '', 'yes', 'numeric'),
	(22, 'valid_alpha_numeric_spaces_underscores', 'no', 'input, text,select, password, editor', '', 'yes', ''),
	(23, 'matches', 'yes', 'input, number, text, password, email', 'any field', 'no', 'callback_valid_alpha_numeric_spaces_underscores'),
	(24, 'valid_json', 'no', 'input, text, editor', '', 'yes', ' '),
	(25, 'valid_url', 'no', 'input, text, editor', '', 'no', ' '),
	(26, 'exact_length', 'yes', 'input, text, number', '0 - 99999*', 'no', 'numeric'),
	(27, 'alpha_dash', 'no', 'input, text', '', 'no', ''),
	(28, 'integer', 'no', 'input, text, number', '', 'no', ''),
	(29, 'differs', 'yes', 'input, text, number, email, password, editor, options, select', 'any field', 'no', 'callback_valid_alpha_numeric_spaces_underscores'),
	(30, 'is_natural', 'no', 'input, text, number', '', 'no', ''),
	(31, 'is_natural_no_zero', 'no', 'input, text, number', '', 'no', ''),
	(32, 'less_than', 'yes', 'input, text, number', '', 'no', 'numeric'),
	(33, 'less_than_equal_to', 'yes', 'input, text, number', '', 'no', 'numeric'),
	(34, 'greater_than', 'yes', 'input, text, number', '', 'no', 'numeric'),
	(35, 'greater_than_equal_to', 'yes', 'input, text, number', '', 'no', 'numeric'),
	(36, 'in_list', 'yes', 'input, text, number, select, options', '', 'no', 'callback_valid_multiple_value'),
	(37, 'valid_ip', 'no', 'input, text', '', 'no', '');
/*!40000 ALTER TABLE `crud_input_validation` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_desa
CREATE TABLE IF NOT EXISTS `data_desa` (
  `id_desa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_desa` varchar(255) DEFAULT NULL,
  `alamat_lengkap` longtext,
  `deskripsi` longtext,
  PRIMARY KEY (`id_desa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_desa: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `data_desa` DISABLE KEYS */;
INSERT INTO `data_desa` (`id_desa`, `nama_desa`, `alamat_lengkap`, `deskripsi`) VALUES
	(1, 'Desa Pengalangan', 'Jl. Pengalangan', 'Kec. Menganti');
/*!40000 ALTER TABLE `data_desa` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_jenis_lembaga_desa
CREATE TABLE IF NOT EXISTS `data_jenis_lembaga_desa` (
  `id_lembaga` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_lembaga`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_jenis_lembaga_desa: ~8 rows (lebih kurang)
/*!40000 ALTER TABLE `data_jenis_lembaga_desa` DISABLE KEYS */;
INSERT INTO `data_jenis_lembaga_desa` (`id_lembaga`, `nama_lembaga`) VALUES
	(1, 'RT'),
	(2, 'RW'),
	(3, 'LPMD'),
	(4, 'KARANG TARUNA'),
	(5, 'POSYANDU'),
	(6, 'GAPOKTAN'),
	(7, 'BUMDES'),
	(8, 'LINMAS');
/*!40000 ALTER TABLE `data_jenis_lembaga_desa` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_jenis_potensi_desa
CREATE TABLE IF NOT EXISTS `data_jenis_potensi_desa` (
  `id_jenis_potensi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_potensi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_potensi`)
) ENGINE=InnoDB AUTO_INCREMENT=11120000 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_jenis_potensi_desa: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `data_jenis_potensi_desa` DISABLE KEYS */;
INSERT INTO `data_jenis_potensi_desa` (`id_jenis_potensi`, `nama_potensi`) VALUES
	(11110000, 'RT'),
	(11111111, 'RW'),
	(11112222, 'PKK'),
	(11113333, 'KARANG TARUNA'),
	(11114444, 'POSYANDU'),
	(11115555, 'LINMAS'),
	(11116666, 'GAPOKTAN'),
	(11117777, 'BUMDES'),
	(11118888, 'LPMD'),
	(11119999, 'PAUD');
/*!40000 ALTER TABLE `data_jenis_potensi_desa` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_jenis_surat
CREATE TABLE IF NOT EXISTS `data_jenis_surat` (
  `id_jenis_surat` int(11) NOT NULL AUTO_INCREMENT,
  `id_surat_master` varchar(255) DEFAULT NULL,
  `id_surat_masuk` varchar(255) DEFAULT NULL,
  `id_surat_keluar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_jenis_surat: ~6 rows (lebih kurang)
/*!40000 ALTER TABLE `data_jenis_surat` DISABLE KEYS */;
INSERT INTO `data_jenis_surat` (`id_jenis_surat`, `id_surat_master`, `id_surat_masuk`, `id_surat_keluar`) VALUES
	(1, '5', '264/437.111.09/2021', '264/437.111.09/2021'),
	(2, '5', '265/437.111.09/2021', '265/347.111.09/2021'),
	(3, '4', '266/437.111.09/2021', '266/347.111.09/2021'),
	(4, '4', '267/437.111.09/2021', '267/347.111.09/2021'),
	(5, '3', '268/437.111.09/2021', '266/347.111.09/2022'),
	(6, '2', '269/437.111.09/2021', '267/347.111.09/2022');
/*!40000 ALTER TABLE `data_jenis_surat` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_kartu_keluarga
CREATE TABLE IF NOT EXISTS `data_kartu_keluarga` (
  `no_kk` int(100) NOT NULL AUTO_INCREMENT,
  `nik` int(100) DEFAULT NULL,
  PRIMARY KEY (`no_kk`)
) ENGINE=InnoDB AUTO_INCREMENT=765771 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_kartu_keluarga: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `data_kartu_keluarga` DISABLE KEYS */;
INSERT INTO `data_kartu_keluarga` (`no_kk`, `nik`) VALUES
	(765761, 765322),
	(765762, 765323),
	(765763, 765324),
	(765764, 765325),
	(765765, 765326),
	(765766, 765327),
	(765767, 765328),
	(765768, 765329),
	(765769, 765330),
	(765770, 765331);
/*!40000 ALTER TABLE `data_kartu_keluarga` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_lembaga_desa
CREATE TABLE IF NOT EXISTS `data_lembaga_desa` (
  `id_lembaga` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(255) DEFAULT NULL,
  `jenis_lembaga` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_lembaga`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_lembaga_desa: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `data_lembaga_desa` DISABLE KEYS */;
INSERT INTO `data_lembaga_desa` (`id_lembaga`, `nama_lembaga`, `jenis_lembaga`) VALUES
	(1, 'BPD', '6 tahun (2019-2024)'),
	(2, 'LPMD', '6 tahun (2019-2024)'),
	(3, 'BUMDES', '6 tahun (2019-2024)'),
	(4, 'PKK', '6 tahun (2019-2024)'),
	(5, 'KOPWAN', '6 tahun (2019-2024)'),
	(6, 'BANK DESA PENGALANGAN', '6 tahun (2019-2024)'),
	(7, 'GAPOKTAN', '6 tahun (2019-2024)'),
	(8, 'LINMAS', '6 tahun (2019-2024)'),
	(9, 'KARANG TARUNA', '3 tahun'),
	(10, 'POSYANDU', '2 tahun ');
/*!40000 ALTER TABLE `data_lembaga_desa` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_master_surat
CREATE TABLE IF NOT EXISTS `data_master_surat` (
  `id_surat` int(11) NOT NULL AUTO_INCREMENT,
  `No_surat` varchar(255) DEFAULT NULL,
  `keterangan_surat` text,
  `kepada` varchar(255) DEFAULT NULL,
  `Alamat` text,
  `tanggal` date DEFAULT NULL,
  `tempat` text,
  `kepala_desa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_master_surat: ~7 rows (lebih kurang)
/*!40000 ALTER TABLE `data_master_surat` DISABLE KEYS */;
INSERT INTO `data_master_surat` (`id_surat`, `No_surat`, `keterangan_surat`, `kepada`, `Alamat`, `tanggal`, `tempat`, `kepala_desa`) VALUES
	(1, '268/437.111.09/2021', 'penting ', 'Ibu. Ani Masmudah', 'Jl. Pengalangan No. 390', '0000-00-00', 'Balai Desa Pengalangan', 0),
	(2, '271/437.111.09/2021', 'penting ', 'Bpk. Joko Purnomo', 'Jl. Pengalangan No. 390', '0000-00-00', 'Balai Desa Pengalangan', 0),
	(3, '267/437.111.09/2021', 'penting ', 'Ibu. Kusniawati Tatik', 'Jl. Pengalangan No. 390', '0000-00-00', 'Balai Desa Pengalangan', 0),
	(4, '266/437.111.09/2021', 'penting ', 'Bpk. Doddy Dirgahayu Ahmad ', 'Jl. Pengalangan No. 390', '0000-00-00', 'Balai Desa Pengalangan', 0),
	(5, '264/437.111.09/2021', 'penting ', 'Bpk. Chandra NPP', 'Jl. Pengalangan No. 390', '0000-00-00', 'Balai Desa Pengalangan', 0),
	(6, '269/437.111.09/2021', 'penting ', 'Bpk.Syendra Sutardik', 'Jl. Pengalangan No. 390', '0000-00-00', 'Balai Desa Pengalangan', 0),
	(9, '270/437.111.09/2021', 'penting ', 'Bpk. Taufik ', 'Jl. Pengalangan No. 390', '0000-00-00', 'Balai Desa Pengalangan', 0);
/*!40000 ALTER TABLE `data_master_surat` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_penduduk
CREATE TABLE IF NOT EXISTS `data_penduduk` (
  `nik` int(11) NOT NULL AUTO_INCREMENT,
  `no_kk` int(11) DEFAULT NULL,
  `nama_penduduk` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `alamat_penduduk` longtext,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=2147483648 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_penduduk: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `data_penduduk` DISABLE KEYS */;
INSERT INTO `data_penduduk` (`nik`, `no_kk`, `nama_penduduk`, `jenis_kelamin`, `alamat_penduduk`) VALUES
	(2, 2147483647, 'NUR FITRIA', 'Pr', 'BONGSO KULON NO.46'),
	(3, 2147483647, 'MOHAMAD ROFITUL HUDA', 'Lk', 'BONGSO KULON NO.46'),
	(4, 2147483647, 'SAIPON', 'Lk', 'BONGSO KULON NO. 58'),
	(5, 2147483647, 'WIWIK', 'Pr', 'BONGSO KULON NO. 58'),
	(6, 2147483647, 'EDY PURWANTO', 'Lk', 'BONGSO KULON NO. 58'),
	(7, 2147483647, 'DINAR AMALIA SARI', 'Pr', 'BONGSO KULON NO. 58'),
	(8, 2147483647, 'KAMAT', 'Lk', 'BONGSO KULON NO. 30'),
	(9, 2147483647, 'SUKAIYAH', 'Pr', 'BONGSO KULON NO. 30'),
	(10, 2147483647, 'ANTONI WIJAYA', 'Lk', 'BONGSO KULON NO. 30'),
	(2147483647, 2147483647, 'DIDIK ANDRIYANTO', 'Lk', 'BONGSO KULON NO.46');
/*!40000 ALTER TABLE `data_penduduk` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_perangkat_desa
CREATE TABLE IF NOT EXISTS `data_perangkat_desa` (
  `id_perangkat_desa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perangkat_desa` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_perangkat_desa`)
) ENGINE=InnoDB AUTO_INCREMENT=1011 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_perangkat_desa: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `data_perangkat_desa` DISABLE KEYS */;
INSERT INTO `data_perangkat_desa` (`id_perangkat_desa`, `nama_perangkat_desa`, `jabatan`) VALUES
	(1001, 'japar sidik', 'kepala desa'),
	(1002, 'kurnia', 'sekertaris desa'),
	(1003, 'ulfa', 'urusan tata usaha'),
	(1004, 'siti', 'urusan keuangan'),
	(1005, 'kasim', 'urusan perencanaan'),
	(1006, 'sodiq', 'seksi pelayanan'),
	(1007, 'kaseno', 'seksi kesejateraan'),
	(1008, 'siswanto', 'seksi pemerintahan'),
	(1009, 'supriaji', 'kepala dusun lundo'),
	(1010, 'parno', 'kepala dusun sepat');
/*!40000 ALTER TABLE `data_perangkat_desa` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_surat_keluar
CREATE TABLE IF NOT EXISTS `data_surat_keluar` (
  `No_id_Surat` int(11) NOT NULL AUTO_INCREMENT,
  `id_surat_keluar` varchar(255) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `Perihal` text,
  PRIMARY KEY (`No_id_Surat`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_surat_keluar: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `data_surat_keluar` DISABLE KEYS */;
INSERT INTO `data_surat_keluar` (`No_id_Surat`, `id_surat_keluar`, `tgl_keluar`, `Perihal`) VALUES
	(1, 'Kerja Bakti Desa Pengalangan', '0000-00-00', 'Undangan'),
	(2, 'Sosialisasi Bahaya Narkoba', '0000-00-00', 'Undangan'),
	(3, 'Pembagian Dana Operasional', '0000-00-00', 'Undangan'),
	(4, 'Sosialisasi Covid-19', '0000-00-00', 'Undangan'),
	(5, 'Pembagian Sembako', '0000-00-00', 'Undangan'),
	(6, 'Pengelolaan Dana Desa', '0000-00-00', 'Undangan'),
	(7, 'Pendaftaran Keluarga', '0000-00-00', 'Undangan'),
	(8, 'Permohonan fasilitas Vaksin Covid-19', '0000-00-00', 'Undangan'),
	(10, 'Pembentukan Struktur Organisasi 2021', '0000-00-00', 'Undangan'),
	(15, 'Penggalangan Dana untuk Korban Covid-19', '0000-00-00', 'Undangan');
/*!40000 ALTER TABLE `data_surat_keluar` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_surat_masuk
CREATE TABLE IF NOT EXISTS `data_surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_surat` int(11) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `perihal` longtext,
  PRIMARY KEY (`id_surat_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_surat_masuk: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `data_surat_masuk` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_surat_masuk` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.data_user
CREATE TABLE IF NOT EXISTS `data_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_si_desa_pengalangan.data_user: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `data_user` DISABLE KEYS */;
INSERT INTO `data_user` (`id_user`, `nik`, `password`) VALUES
	(1, '352513', 'james12345'),
	(2, '352514', 'suyono6598'),
	(3, '352515', 'riski8767'),
	(4, '352516', 'irfan6600'),
	(5, '352517', 'agustin239'),
	(6, '352518', 'meita661'),
	(7, '352519', 'richard602'),
	(8, '352520', 'anton861'),
	(9, '352521', 'ardi8539'),
	(10, '352522', 'firman538');
/*!40000 ALTER TABLE `data_user` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.form
CREATE TABLE IF NOT EXISTS `form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.form: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `form` DISABLE KEYS */;
/*!40000 ALTER TABLE `form` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.form_custom_attribute
CREATE TABLE IF NOT EXISTS `form_custom_attribute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `attribute_value` text NOT NULL,
  `attribute_label` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.form_custom_attribute: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `form_custom_attribute` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_custom_attribute` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.form_custom_option
CREATE TABLE IF NOT EXISTS `form_custom_option` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.form_custom_option: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `form_custom_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_custom_option` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.form_field
CREATE TABLE IF NOT EXISTS `form_field` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `input_type` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `placeholder` text,
  `auto_generate_help_block` varchar(10) DEFAULT NULL,
  `help_block` text,
  `relation_table` varchar(200) DEFAULT NULL,
  `relation_value` varchar(200) DEFAULT NULL,
  `relation_label` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.form_field: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `form_field` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_field` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.form_field_validation
CREATE TABLE IF NOT EXISTS `form_field_validation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.form_field_validation: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `form_field_validation` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_field_validation` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.keys
CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL,
  `is_private_key` tinyint(1) NOT NULL,
  `ip_addresses` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.keys: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `keys` DISABLE KEYS */;
INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
	(1, 0, 'F81BB8200AF19BE50652013C3DF039C9', 0, 0, 0, NULL, '2021-04-28 05:28:58');
/*!40000 ALTER TABLE `keys` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `icon_color` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `menu_type_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.menu: ~22 rows (lebih kurang)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `label`, `type`, `icon_color`, `link`, `sort`, `parent`, `icon`, `menu_type_id`, `active`) VALUES
	(1, 'MAIN NAVIGATION', 'label', '', 'administrator/dashboard', 1, 0, '', 1, 1),
	(2, 'Dashboard', 'menu', '', 'administrator/dashboard', 2, 0, 'fa-dashboard', 1, 1),
	(3, 'CRUD Builder', 'menu', '', 'administrator/crud', 3, 0, 'fa-table', 1, 1),
	(4, 'API Builder', 'menu', '', 'administrator/rest', 4, 0, 'fa-code', 1, 1),
	(5, 'Page Builder', 'menu', '', 'administrator/page', 5, 0, 'fa-file-o', 1, 1),
	(6, 'Form Builder', 'menu', '', 'administrator/form', 6, 0, 'fa-newspaper-o', 1, 1),
	(7, 'Blog', 'menu', '', 'administrator/blog', 7, 0, 'fa-file-text-o', 1, 1),
	(8, 'Menu', 'menu', '', 'administrator/menu', 8, 0, 'fa-bars', 1, 1),
	(9, 'Auth', 'menu', '', '', 9, 0, 'fa-shield', 1, 1),
	(10, 'User', 'menu', '', 'administrator/user', 10, 9, '', 1, 1),
	(11, 'Groups', 'menu', '', 'administrator/group', 11, 9, '', 1, 1),
	(12, 'Access', 'menu', '', 'administrator/access', 12, 9, '', 1, 1),
	(13, 'Permission', 'menu', '', 'administrator/permission', 13, 9, '', 1, 1),
	(14, 'API Keys', 'menu', '', 'administrator/keys', 14, 9, '', 1, 1),
	(15, 'Extension', 'menu', '', 'administrator/extension', 15, 0, 'fa-puzzle-piece', 1, 1),
	(16, 'OTHER', 'label', '', '', 16, 0, '', 1, 1),
	(17, 'Settings', 'menu', 'text-red', 'administrator/setting', 17, 0, 'fa-circle-o', 1, 1),
	(18, 'Web Documentation', 'menu', 'text-blue', 'administrator/doc/web', 18, 0, 'fa-circle-o', 1, 1),
	(19, 'API Documentation', 'menu', 'text-yellow', 'administrator/doc/api', 19, 0, 'fa-circle-o', 1, 1),
	(20, 'Home', 'menu', '', '/', 1, 0, '', 2, 1),
	(21, 'Blog', 'menu', '', 'blog', 4, 0, '', 2, 1),
	(22, 'Dashboard', 'menu', '', 'administrator/dashboard', 5, 0, '', 2, 1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.menu_type
CREATE TABLE IF NOT EXISTS `menu_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.menu_type: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `menu_type` DISABLE KEYS */;
INSERT INTO `menu_type` (`id`, `name`, `definition`) VALUES
	(1, 'side menu', NULL),
	(2, 'top menu', NULL);
/*!40000 ALTER TABLE `menu_type` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.migrations: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`version`) VALUES
	(1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.page
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `fresh_content` text NOT NULL,
  `keyword` text,
  `description` text,
  `link` varchar(200) DEFAULT NULL,
  `template` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.page: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
/*!40000 ALTER TABLE `page` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.page_block_element
CREATE TABLE IF NOT EXISTS `page_block_element` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image_preview` varchar(200) NOT NULL,
  `block_name` varchar(200) NOT NULL,
  `content_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.page_block_element: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `page_block_element` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_block_element` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.rest
CREATE TABLE IF NOT EXISTS `rest` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `x_api_key` varchar(20) DEFAULT NULL,
  `x_token` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.rest: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `rest` DISABLE KEYS */;
INSERT INTO `rest` (`id`, `subject`, `table_name`, `primary_key`, `x_api_key`, `x_token`) VALUES
	(1, 'Data Desa', 'data_desa', 'id_desa', 'no', 'yes'),
	(2, 'Data Jenis Lembaga Desa', 'data_jenis_lembaga_desa', 'id_lembaga', 'no', 'yes'),
	(3, 'Data Jenis Potensi Desa', 'data_jenis_potensi_desa', 'id_jenis_potensi', 'no', 'yes'),
	(4, 'Data Jenis Surat', 'data_jenis_surat', 'id_jenis_surat', 'no', 'yes'),
	(5, 'Data Kartu Keluarga', 'data_kartu_keluarga', 'no_kk', 'no', 'yes'),
	(6, 'Data Lembaga Desa', 'data_lembaga_desa', 'id_lembaga', 'no', 'yes'),
	(7, 'Data Master Surat', 'data_master_surat', 'id_surat', 'no', 'yes'),
	(8, 'Data Penduduk', 'data_penduduk', 'nik', 'no', 'yes'),
	(9, 'Data Perangkat Desa', 'data_perangkat_desa', 'id_perangkat_desa', 'no', 'yes'),
	(10, 'Data Surat Keluar', 'data_surat_keluar', 'No_id_Surat', 'no', 'yes'),
	(11, 'Data Surat Masuk', 'data_surat_masuk', 'id_surat_masuk', 'no', 'yes'),
	(12, 'Data User', 'data_user', 'id_user', 'no', 'yes');
/*!40000 ALTER TABLE `rest` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.rest_field
CREATE TABLE IF NOT EXISTS `rest_field` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rest_id` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `input_type` varchar(200) NOT NULL,
  `show_column` varchar(10) DEFAULT NULL,
  `show_add_api` varchar(10) DEFAULT NULL,
  `show_update_api` varchar(10) DEFAULT NULL,
  `show_detail_api` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.rest_field: ~40 rows (lebih kurang)
/*!40000 ALTER TABLE `rest_field` DISABLE KEYS */;
INSERT INTO `rest_field` (`id`, `rest_id`, `field_name`, `field_label`, `input_type`, `show_column`, `show_add_api`, `show_update_api`, `show_detail_api`) VALUES
	(5, 2, 'id_lembaga', NULL, 'input', 'yes', '', '', 'yes'),
	(6, 2, 'nama_lembaga', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(7, 3, 'id_jenis_potensi', NULL, 'input', 'yes', '', '', 'yes'),
	(8, 3, 'nama_potensi', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(9, 4, 'id_jenis_surat', NULL, 'input', 'yes', '', '', 'yes'),
	(10, 4, 'id_surat_master', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(11, 4, 'id_surat_masuk', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(12, 4, 'id_surat_keluar', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(13, 5, 'no_kk', NULL, 'input', 'yes', '', '', 'yes'),
	(14, 5, 'nik', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(15, 6, 'id_lembaga', NULL, 'input', 'yes', '', '', 'yes'),
	(16, 6, 'nama_lembaga', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(17, 6, 'jenis_lembaga', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(18, 7, 'id_surat', NULL, 'input', 'yes', '', '', 'yes'),
	(19, 7, 'No_surat', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(20, 7, 'keterangan_surat', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(21, 7, 'kepada', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(22, 7, 'Alamat', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(23, 7, 'tanggal', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(24, 7, 'tempat', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(25, 7, 'kepala_desa', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(26, 8, 'nik', NULL, 'input', 'yes', '', '', 'yes'),
	(27, 8, 'no_kk', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(28, 8, 'nama_penduduk', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(29, 8, 'jenis_kelamin', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(30, 8, 'alamat_penduduk', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(31, 9, 'id_perangkat_desa', NULL, 'input', 'yes', '', '', 'yes'),
	(32, 9, 'nama_perangkat_desa', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(33, 9, 'jabatan', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(34, 10, 'No_id_Surat', NULL, 'input', 'yes', '', '', 'yes'),
	(35, 10, 'id_surat_keluar', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(36, 10, 'tgl_keluar', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(37, 10, 'Perihal', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(38, 11, 'id_surat_masuk', NULL, 'input', 'yes', '', '', 'yes'),
	(39, 11, 'id_jenis_surat', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(40, 11, 'tgl_masuk', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(41, 11, 'perihal', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(42, 12, 'id_user', NULL, 'input', 'yes', '', '', 'yes'),
	(43, 12, 'password', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(44, 12, 'nik', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(49, 1, 'id_desa', NULL, 'input', 'yes', '', '', 'yes'),
	(50, 1, 'nama_desa', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(51, 1, 'alamat_lengkap', NULL, 'input', 'yes', 'yes', 'yes', 'yes'),
	(52, 1, 'deskripsi', NULL, 'input', 'yes', 'yes', 'yes', 'yes');
/*!40000 ALTER TABLE `rest_field` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.rest_field_validation
CREATE TABLE IF NOT EXISTS `rest_field_validation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rest_field_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.rest_field_validation: ~52 rows (lebih kurang)
/*!40000 ALTER TABLE `rest_field_validation` DISABLE KEYS */;
INSERT INTO `rest_field_validation` (`id`, `rest_field_id`, `rest_id`, `validation_name`, `validation_value`) VALUES
	(5, 6, 2, 'required', ''),
	(6, 6, 2, 'max_length', '50'),
	(7, 8, 3, 'required', ''),
	(8, 8, 3, 'max_length', '50'),
	(9, 10, 4, 'required', ''),
	(10, 10, 4, 'max_length', '255'),
	(11, 11, 4, 'required', ''),
	(12, 11, 4, 'max_length', '255'),
	(13, 12, 4, 'required', ''),
	(14, 12, 4, 'max_length', '255'),
	(15, 14, 5, 'required', ''),
	(16, 14, 5, 'max_length', '11'),
	(17, 16, 6, 'required', ''),
	(18, 16, 6, 'max_length', '255'),
	(19, 17, 6, 'required', ''),
	(20, 17, 6, 'max_length', '255'),
	(21, 19, 7, 'required', ''),
	(22, 19, 7, 'max_length', '255'),
	(23, 20, 7, 'required', ''),
	(24, 21, 7, 'required', ''),
	(25, 21, 7, 'max_length', '255'),
	(26, 22, 7, 'required', ''),
	(27, 23, 7, 'required', ''),
	(28, 24, 7, 'required', ''),
	(29, 25, 7, 'required', ''),
	(30, 25, 7, 'max_length', '11'),
	(31, 27, 8, 'required', ''),
	(32, 27, 8, 'max_length', '11'),
	(33, 28, 8, 'required', ''),
	(34, 28, 8, 'max_length', '255'),
	(35, 29, 8, 'required', ''),
	(36, 29, 8, 'max_length', '255'),
	(37, 30, 8, 'required', ''),
	(38, 32, 9, 'required', ''),
	(39, 32, 9, 'max_length', '50'),
	(40, 33, 9, 'required', ''),
	(41, 33, 9, 'max_length', '50'),
	(42, 35, 10, 'required', ''),
	(43, 35, 10, 'max_length', '255'),
	(44, 36, 10, 'required', ''),
	(45, 37, 10, 'required', ''),
	(46, 39, 11, 'required', ''),
	(47, 39, 11, 'max_length', '11'),
	(48, 40, 11, 'required', ''),
	(49, 41, 11, 'required', ''),
	(50, 43, 12, 'required', ''),
	(51, 43, 12, 'max_length', '255'),
	(52, 44, 12, 'required', ''),
	(53, 44, 12, 'max_length', '255'),
	(58, 50, 1, 'required', ''),
	(59, 50, 1, 'max_length', '255'),
	(60, 51, 1, 'required', ''),
	(61, 52, 1, 'required', '');
/*!40000 ALTER TABLE `rest_field_validation` ENABLE KEYS */;

-- membuang struktur untuk table db_si_desa_pengalangan.rest_input_type
CREATE TABLE IF NOT EXISTS `rest_input_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `validation_group` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_si_desa_pengalangan.rest_input_type: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `rest_input_type` DISABLE KEYS */;
INSERT INTO `rest_input_type` (`id`, `type`, `relation`, `validation_group`) VALUES
	(1, 'input', '0', 'input'),
	(2, 'timestamp', '0', 'timestamp'),
	(3, 'file', '0', 'file');
/*!40000 ALTER TABLE `rest_input_type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
