-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2021 at 11:27 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desa_vis`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

DROP TABLE IF EXISTS `aauth_groups`;
CREATE TABLE IF NOT EXISTS `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Superadmin Group'),
(2, 'Public', 'Public Group'),
(3, 'Default', 'Default Access Group'),
(4, 'Member', 'Member Access Group');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_group_to_group`
--

DROP TABLE IF EXISTS `aauth_group_to_group`;
CREATE TABLE IF NOT EXISTS `aauth_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`group_id`,`subgroup_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_login_attempts`
--

DROP TABLE IF EXISTS `aauth_login_attempts`;
CREATE TABLE IF NOT EXISTS `aauth_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms`
--

DROP TABLE IF EXISTS `aauth_perms`;
CREATE TABLE IF NOT EXISTS `aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perms`
--

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
(123, 'api_data_jenis_lembaga_desa_add', ''),
(122, 'api_data_jenis_lembaga_desa_detail', ''),
(120, 'api_data_desa_delete', ''),
(119, 'api_data_desa_update', ''),
(118, 'api_data_desa_add', ''),
(117, 'api_data_desa_detail', ''),
(116, 'api_data_desa_all', ''),
(99, 'rest_edit', ''),
(100, 'keys_list', ''),
(124, 'api_data_jenis_lembaga_desa_update', ''),
(121, 'api_data_jenis_lembaga_desa_all', ''),
(128, 'api_data_jenis_potensi_desa_add', ''),
(127, 'api_data_jenis_potensi_desa_detail', ''),
(125, 'api_data_jenis_lembaga_desa_delete', ''),
(126, 'api_data_jenis_potensi_desa_all', ''),
(129, 'api_data_jenis_potensi_desa_update', ''),
(130, 'api_data_jenis_potensi_desa_delete', ''),
(131, 'api_data_jenis_surat_all', ''),
(132, 'api_data_jenis_surat_detail', ''),
(133, 'api_data_jenis_surat_add', ''),
(134, 'api_data_jenis_surat_update', ''),
(135, 'api_data_jenis_surat_delete', ''),
(136, 'api_data_kartu_keluarga_all', ''),
(137, 'api_data_kartu_keluarga_detail', ''),
(138, 'api_data_kartu_keluarga_add', ''),
(139, 'api_data_kartu_keluarga_update', ''),
(140, 'api_data_kartu_keluarga_delete', ''),
(141, 'api_data_lembaga_desa_all', ''),
(142, 'api_data_lembaga_desa_detail', ''),
(143, 'api_data_lembaga_desa_add', ''),
(144, 'api_data_lembaga_desa_update', ''),
(145, 'api_data_lembaga_desa_delete', ''),
(146, 'api_data_master_surat_all', ''),
(147, 'api_data_master_surat_detail', ''),
(148, 'api_data_master_surat_add', ''),
(149, 'api_data_master_surat_update', ''),
(150, 'api_data_master_surat_delete', ''),
(151, 'api_data_penduduk_all', ''),
(152, 'api_data_penduduk_detail', ''),
(153, 'api_data_penduduk_add', ''),
(154, 'api_data_penduduk_update', ''),
(155, 'api_data_penduduk_delete', ''),
(156, 'api_data_perangkat_desa_all', ''),
(157, 'api_data_perangkat_desa_detail', ''),
(158, 'api_data_perangkat_desa_add', ''),
(159, 'api_data_perangkat_desa_update', ''),
(160, 'api_data_perangkat_desa_delete', ''),
(161, 'api_data_surat_masuk_all', ''),
(162, 'api_data_surat_masuk_detail', ''),
(163, 'api_data_surat_masuk_add', ''),
(164, 'api_data_surat_masuk_update', ''),
(165, 'api_data_surat_masuk_delete', ''),
(166, 'api_data_user_all', ''),
(167, 'api_data_user_detail', ''),
(168, 'api_data_user_add', ''),
(169, 'api_data_user_update', ''),
(170, 'api_data_user_delete', ''),
(171, 'api_data_surat_keluar_all', ''),
(172, 'api_data_surat_keluar_detail', ''),
(173, 'api_data_surat_keluar_add', ''),
(174, 'api_data_surat_keluar_update', ''),
(175, 'api_data_surat_keluar_delete', '');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_group`
--

DROP TABLE IF EXISTS `aauth_perm_to_group`;
CREATE TABLE IF NOT EXISTS `aauth_perm_to_group` (
  `perm_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_user`
--

DROP TABLE IF EXISTS `aauth_perm_to_user`;
CREATE TABLE IF NOT EXISTS `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`perm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

DROP TABLE IF EXISTS `aauth_pms`;
CREATE TABLE IF NOT EXISTS `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(225) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user`
--

DROP TABLE IF EXISTS `aauth_user`;
CREATE TABLE IF NOT EXISTS `aauth_user` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

DROP TABLE IF EXISTS `aauth_users`;
CREATE TABLE IF NOT EXISTS `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `oauth_uid`, `oauth_provider`, `pass`, `username`, `full_name`, `avatar`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `top_secret`, `ip_address`) VALUES
(1, 'admin@gmail.com', NULL, NULL, 'ec225039f1cb0c48ad528709e8e0184991e637d96db175f094b6b2037ec1a3c2', 'admin', 'admin', '', 0, '2021-04-22 06:42:59', '2021-04-22 06:42:59', '2021-04-21 23:39:53', NULL, NULL, NULL, NULL, NULL, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_group`
--

DROP TABLE IF EXISTS `aauth_user_to_group`;
CREATE TABLE IF NOT EXISTS `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_user_to_group`
--

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

DROP TABLE IF EXISTS `aauth_user_variables`;
CREATE TABLE IF NOT EXISTS `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `slug`, `content`, `image`, `tags`, `category`, `status`, `author`, `viewers`, `created_at`, `updated_at`) VALUES
(1, 'Hello Wellcome To Cicool Builder', 'Hello-Wellcome-To-Ciool-Builder', 'greetings from our team I hope to be happy! ', 'wellcome.jpg', 'greetings', '1', 'publish', 'admin', 1, '2021-04-21 23:39:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE IF NOT EXISTS `blog_category` (
  `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL,
  `category_desc` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`category_id`, `category_name`, `category_desc`) VALUES
(1, 'Technology', ''),
(2, 'Lifestyle', '');

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

DROP TABLE IF EXISTS `captcha`;
CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cc_options`
--

DROP TABLE IF EXISTS `cc_options`;
CREATE TABLE IF NOT EXISTS `cc_options` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) NOT NULL,
  `option_value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cc_session`
--

DROP TABLE IF EXISTS `cc_session`;
CREATE TABLE IF NOT EXISTS `cc_session` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) NOT NULL,
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

DROP TABLE IF EXISTS `crud`;
CREATE TABLE IF NOT EXISTS `crud` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `page_read` varchar(20) DEFAULT NULL,
  `page_create` varchar(20) DEFAULT NULL,
  `page_update` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crud_custom_option`
--

DROP TABLE IF EXISTS `crud_custom_option`;
CREATE TABLE IF NOT EXISTS `crud_custom_option` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crud_field`
--

DROP TABLE IF EXISTS `crud_field`;
CREATE TABLE IF NOT EXISTS `crud_field` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_field`
--

INSERT INTO `crud_field` (`id`, `crud_id`, `field_name`, `field_label`, `input_type`, `show_column`, `show_add_form`, `show_update_form`, `show_detail_page`, `sort`, `relation_table`, `relation_value`, `relation_label`) VALUES
(1, 1, 'no_kk', 'no_kk', 'number', '', '', '', 'yes', 1, '', '', ''),
(2, 1, 'nik', 'nik', 'number', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `crud_field_configuration`
--

DROP TABLE IF EXISTS `crud_field_configuration`;
CREATE TABLE IF NOT EXISTS `crud_field_configuration` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `group_config` varchar(200) NOT NULL,
  `config_name` text NOT NULL,
  `config_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crud_field_validation`
--

DROP TABLE IF EXISTS `crud_field_validation`;
CREATE TABLE IF NOT EXISTS `crud_field_validation` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_field_validation`
--

INSERT INTO `crud_field_validation` (`id`, `crud_field_id`, `crud_id`, `validation_name`, `validation_value`) VALUES
(1, 2, 1, 'required', ''),
(2, 2, 1, 'max_length', '11');

-- --------------------------------------------------------

--
-- Table structure for table `crud_input_chained`
--

DROP TABLE IF EXISTS `crud_input_chained`;
CREATE TABLE IF NOT EXISTS `crud_input_chained` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `chain_field` varchar(250) DEFAULT NULL,
  `chain_field_eq` varchar(250) DEFAULT NULL,
  `crud_field_id` int(11) DEFAULT NULL,
  `crud_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crud_input_type`
--

DROP TABLE IF EXISTS `crud_input_type`;
CREATE TABLE IF NOT EXISTS `crud_input_type` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `custom_value` int(11) NOT NULL,
  `validation_group` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_input_type`
--

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
(26, 'custom_select', '0', 1, 'custom_select'),
(27, 'chained', '1', 0, 'chained');

-- --------------------------------------------------------

--
-- Table structure for table `crud_input_validation`
--

DROP TABLE IF EXISTS `crud_input_validation`;
CREATE TABLE IF NOT EXISTS `crud_input_validation` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `validation` varchar(200) NOT NULL,
  `input_able` varchar(20) NOT NULL,
  `group_input` text NOT NULL,
  `input_placeholder` text NOT NULL,
  `call_back` varchar(10) NOT NULL,
  `input_validation` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_input_validation`
--

INSERT INTO `crud_input_validation` (`id`, `validation`, `input_able`, `group_input`, `input_placeholder`, `call_back`, `input_validation`) VALUES
(1, 'required', 'no', 'input, file, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes, true_false, address_map, custom_option, custom_checkbox, custom_select_multiple, custom_select, file_multiple, chained', '', '', ''),
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

-- --------------------------------------------------------

--
-- Table structure for table `data_desa`
--

DROP TABLE IF EXISTS `data_desa`;
CREATE TABLE IF NOT EXISTS `data_desa` (
  `id_desa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_desa` varchar(255) DEFAULT NULL,
  `alamat_lengkap` longtext,
  `deskripsi` longtext,
  PRIMARY KEY (`id_desa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_jenis_lembaga_desa`
--

DROP TABLE IF EXISTS `data_jenis_lembaga_desa`;
CREATE TABLE IF NOT EXISTS `data_jenis_lembaga_desa` (
  `id_lembaga` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_lembaga`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_jenis_potensi_desa`
--

DROP TABLE IF EXISTS `data_jenis_potensi_desa`;
CREATE TABLE IF NOT EXISTS `data_jenis_potensi_desa` (
  `id_jenis_potensi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_potensi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_potensi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_jenis_surat`
--

DROP TABLE IF EXISTS `data_jenis_surat`;
CREATE TABLE IF NOT EXISTS `data_jenis_surat` (
  `id_jenis_surat` int(11) NOT NULL AUTO_INCREMENT,
  `id_surat_master` varchar(255) DEFAULT NULL,
  `id_surat_masuk` varchar(255) DEFAULT NULL,
  `id_surat_keluar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_surat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_kartu_keluarga`
--

DROP TABLE IF EXISTS `data_kartu_keluarga`;
CREATE TABLE IF NOT EXISTS `data_kartu_keluarga` (
  `no_kk` int(11) NOT NULL AUTO_INCREMENT,
  `nik` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_kk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_lembaga_desa`
--

DROP TABLE IF EXISTS `data_lembaga_desa`;
CREATE TABLE IF NOT EXISTS `data_lembaga_desa` (
  `id_lembaga` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(255) DEFAULT NULL,
  `jenis_lembaga` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_lembaga`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_master_surat`
--

DROP TABLE IF EXISTS `data_master_surat`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_penduduk`
--

DROP TABLE IF EXISTS `data_penduduk`;
CREATE TABLE IF NOT EXISTS `data_penduduk` (
  `nik` int(11) NOT NULL AUTO_INCREMENT,
  `no_kk` int(11) DEFAULT NULL,
  `nama_penduduk` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `alamat_penduduk` longtext,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_perangkat_desa`
--

DROP TABLE IF EXISTS `data_perangkat_desa`;
CREATE TABLE IF NOT EXISTS `data_perangkat_desa` (
  `id_perangkat_desa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perangkat_desa` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_perangkat_desa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_surat_keluar`
--

DROP TABLE IF EXISTS `data_surat_keluar`;
CREATE TABLE IF NOT EXISTS `data_surat_keluar` (
  `No_id_Surat` int(11) NOT NULL AUTO_INCREMENT,
  `id_surat_keluar` varchar(255) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `Perihal` text,
  PRIMARY KEY (`No_id_Surat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_surat_masuk`
--

DROP TABLE IF EXISTS `data_surat_masuk`;
CREATE TABLE IF NOT EXISTS `data_surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_surat` int(11) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `perihal` longtext,
  PRIMARY KEY (`id_surat_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

DROP TABLE IF EXISTS `data_user`;
CREATE TABLE IF NOT EXISTS `data_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
CREATE TABLE IF NOT EXISTS `form` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `form_custom_attribute`
--

DROP TABLE IF EXISTS `form_custom_attribute`;
CREATE TABLE IF NOT EXISTS `form_custom_attribute` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `attribute_value` text NOT NULL,
  `attribute_label` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `form_custom_option`
--

DROP TABLE IF EXISTS `form_custom_option`;
CREATE TABLE IF NOT EXISTS `form_custom_option` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `form_field`
--

DROP TABLE IF EXISTS `form_field`;
CREATE TABLE IF NOT EXISTS `form_field` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `form_field_validation`
--

DROP TABLE IF EXISTS `form_field_validation`;
CREATE TABLE IF NOT EXISTS `form_field_validation` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

DROP TABLE IF EXISTS `keys`;
CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL,
  `is_private_key` tinyint(1) NOT NULL,
  `ip_addresses` text,
  `date_created` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, '7F9F25CCF6130E7C9F6882C1191AA4E8', 0, 0, 0, NULL, '2021-04-21 16:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `label`, `type`, `icon_color`, `link`, `sort`, `parent`, `icon`, `menu_type_id`, `active`) VALUES
(1, 'MAIN NAVIGATION', 'label', '', '{admin_url}/dashboard', 1, 0, '', 1, 1),
(2, 'Dashboard', 'menu', '', '{admin_url}/dashboard', 2, 0, 'fa-dashboard', 1, 1),
(3, 'CRUD Builder', 'menu', '', '{admin_url}/crud', 3, 0, 'fa-table', 1, 1),
(4, 'API Builder', 'menu', '', '{admin_url}/rest', 4, 0, 'fa-code', 1, 1),
(5, 'Page Builder', 'menu', '', '{admin_url}/page', 5, 0, 'fa-file-o', 1, 1),
(6, 'Form Builder', 'menu', '', '{admin_url}/form', 6, 0, 'fa-newspaper-o', 1, 1),
(7, 'Blog', 'menu', '', '{admin_url}/blog', 7, 0, 'fa-file-text-o', 1, 1),
(8, 'Menu', 'menu', '', '{admin_url}/menu', 8, 0, 'fa-bars', 1, 1),
(9, 'Auth', 'menu', '', '', 9, 0, 'fa-shield', 1, 1),
(10, 'User', 'menu', '', '{admin_url}/user', 10, 9, '', 1, 1),
(11, 'Groups', 'menu', '', '{admin_url}/group', 11, 9, '', 1, 1),
(12, 'Access', 'menu', '', '{admin_url}/access', 12, 9, '', 1, 1),
(13, 'Permission', 'menu', '', '{admin_url}/permission', 13, 9, '', 1, 1),
(14, 'API Keys', 'menu', '', '{admin_url}/keys', 14, 9, '', 1, 1),
(15, 'Extension', 'menu', '', '{admin_url}/extension', 15, 0, 'fa-puzzle-piece', 1, 1),
(16, 'Database', 'menu', '', '{admin_url}/database', 16, 0, 'fa-database', 1, 1),
(17, 'OTHER', 'label', '', '', 17, 0, '', 1, 1),
(18, 'Settings', 'menu', 'text-red', '{admin_url}/setting', 18, 0, 'fa-circle-o', 1, 1),
(19, 'Web Documentation', 'menu', 'text-blue', '{admin_url}/doc/web', 19, 0, 'fa-circle-o', 1, 1),
(20, 'API Documentation', 'menu', 'text-yellow', '{admin_url}/doc/api', 20, 0, 'fa-circle-o', 1, 1),
(21, 'Home', 'menu', '', '/', 1, 0, '', 2, 1),
(22, 'Blog', 'menu', '', 'blog', 4, 0, '', 2, 1),
(23, 'Dashboard', 'menu', '', 'administrator/dashboard', 5, 0, '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

DROP TABLE IF EXISTS `menu_type`;
CREATE TABLE IF NOT EXISTS `menu_type` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id`, `name`, `definition`) VALUES
(1, 'side menu', NULL),
(2, 'top menu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `fresh_content` text NOT NULL,
  `keyword` text,
  `description` text,
  `link` varchar(200) DEFAULT NULL,
  `template` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `page_block_element`
--

DROP TABLE IF EXISTS `page_block_element`;
CREATE TABLE IF NOT EXISTS `page_block_element` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_name` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image_preview` varchar(200) NOT NULL,
  `block_name` varchar(200) NOT NULL,
  `content_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rest`
--

DROP TABLE IF EXISTS `rest`;
CREATE TABLE IF NOT EXISTS `rest` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `x_api_key` varchar(20) DEFAULT NULL,
  `x_token` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rest`
--

INSERT INTO `rest` (`id`, `subject`, `table_name`, `primary_key`, `x_api_key`, `x_token`) VALUES
(5, 'Data Desa', 'data_desa', 'id_desa', 'no', 'yes'),
(6, 'Data Jenis Lembaga Desa', 'data_jenis_lembaga_desa', 'id_lembaga', 'no', 'yes'),
(7, 'Data Jenis Potensi Desa', 'data_jenis_potensi_desa', 'id_jenis_potensi', 'no', 'yes'),
(8, 'Data Jenis Surat', 'data_jenis_surat', 'id_jenis_surat', 'no', 'yes'),
(9, 'Data Kartu Keluarga', 'data_kartu_keluarga', 'no_kk', 'no', 'yes'),
(10, 'Data Lembaga Desa', 'data_lembaga_desa', 'id_lembaga', 'no', 'yes'),
(11, 'Data Master Surat', 'data_master_surat', 'id_surat', 'no', 'yes'),
(12, 'Data Penduduk', 'data_penduduk', 'nik', 'no', 'yes'),
(13, 'Data Perangkat Desa', 'data_perangkat_desa', 'id_perangkat_desa', 'no', 'yes'),
(14, 'Data Surat Masuk', 'data_surat_masuk', 'id_surat_masuk', 'no', 'yes'),
(15, 'Data User', 'data_user', 'id_user', 'no', 'yes'),
(16, 'Data Surat Keluar', 'data_surat_keluar', 'No_id_Surat', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `rest_field`
--

DROP TABLE IF EXISTS `rest_field`;
CREATE TABLE IF NOT EXISTS `rest_field` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rest_id` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `input_type` varchar(200) NOT NULL,
  `show_column` varchar(10) DEFAULT NULL,
  `show_add_api` varchar(10) DEFAULT NULL,
  `show_update_api` varchar(10) DEFAULT NULL,
  `show_detail_api` varchar(10) DEFAULT NULL,
  `relation_table` varchar(200) DEFAULT NULL,
  `relation_value` varchar(200) DEFAULT NULL,
  `relation_label` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rest_field`
--

INSERT INTO `rest_field` (`id`, `rest_id`, `field_name`, `field_label`, `input_type`, `show_column`, `show_add_api`, `show_update_api`, `show_detail_api`, `relation_table`, `relation_value`, `relation_label`) VALUES
(64, 16, 'No_id_Surat', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(63, 5, 'deskripsi', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(62, 5, 'alamat_lengkap', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(61, 5, 'nama_desa', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(60, 5, 'id_desa', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(16, 6, 'id_lembaga', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(17, 6, 'nama_lembaga', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(18, 7, 'id_jenis_potensi', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(19, 7, 'nama_potensi', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(20, 8, 'id_jenis_surat', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(21, 8, 'id_surat_master', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(22, 8, 'id_surat_masuk', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(23, 8, 'id_surat_keluar', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(24, 9, 'no_kk', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(25, 9, 'nik', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(26, 10, 'id_lembaga', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(27, 10, 'nama_lembaga', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(28, 10, 'jenis_lembaga', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(29, 11, 'id_surat', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(30, 11, 'No_surat', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(31, 11, 'keterangan_surat', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(32, 11, 'kepada', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(33, 11, 'Alamat', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(34, 11, 'tanggal', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(35, 11, 'tempat', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(36, 11, 'kepala_desa', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(37, 12, 'nik', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(38, 12, 'no_kk', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(39, 12, 'nama_penduduk', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(40, 12, 'jenis_kelamin', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(41, 12, 'alamat_penduduk', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(42, 13, 'id_perangkat_desa', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(43, 13, 'nama_perangkat_desa', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(44, 13, 'jabatan', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(54, 14, 'tgl_masuk', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(53, 14, 'id_jenis_surat', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(52, 14, 'id_surat_masuk', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(49, 15, 'id_user', NULL, 'input', 'yes', '', '', 'yes', '', '', ''),
(50, 15, 'password', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(51, 15, 'nik', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(55, 14, 'perihal', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(65, 16, 'id_surat_keluar', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(66, 16, 'tgl_keluar', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', ''),
(67, 16, 'Perihal', NULL, 'input', 'yes', 'yes', 'yes', 'yes', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rest_field_validation`
--

DROP TABLE IF EXISTS `rest_field_validation`;
CREATE TABLE IF NOT EXISTS `rest_field_validation` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rest_field_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rest_field_validation`
--

INSERT INTO `rest_field_validation` (`id`, `rest_field_id`, `rest_id`, `validation_name`, `validation_value`) VALUES
(74, 65, 16, 'required', ''),
(73, 63, 5, 'required', ''),
(72, 62, 5, 'required', ''),
(71, 61, 5, 'max_length', '255'),
(70, 61, 5, 'required', ''),
(18, 17, 6, 'max_length', '50'),
(17, 17, 6, 'required', ''),
(19, 19, 7, 'required', ''),
(20, 19, 7, 'max_length', '50'),
(21, 21, 8, 'required', ''),
(22, 21, 8, 'max_length', '255'),
(23, 22, 8, 'required', ''),
(24, 22, 8, 'max_length', '255'),
(25, 23, 8, 'required', ''),
(26, 23, 8, 'max_length', '255'),
(27, 25, 9, 'required', ''),
(28, 25, 9, 'max_length', '11'),
(29, 27, 10, 'required', ''),
(30, 27, 10, 'max_length', '255'),
(31, 28, 10, 'required', ''),
(32, 28, 10, 'max_length', '255'),
(33, 30, 11, 'required', ''),
(34, 30, 11, 'max_length', '255'),
(35, 31, 11, 'required', ''),
(36, 32, 11, 'required', ''),
(37, 32, 11, 'max_length', '255'),
(38, 33, 11, 'required', ''),
(39, 34, 11, 'required', ''),
(40, 35, 11, 'required', ''),
(41, 36, 11, 'required', ''),
(42, 36, 11, 'max_length', '11'),
(43, 38, 12, 'required', ''),
(44, 38, 12, 'max_length', '11'),
(45, 39, 12, 'required', ''),
(46, 39, 12, 'max_length', '255'),
(47, 40, 12, 'required', ''),
(48, 40, 12, 'max_length', '255'),
(49, 41, 12, 'required', ''),
(50, 43, 13, 'required', ''),
(51, 43, 13, 'max_length', '50'),
(52, 44, 13, 'required', ''),
(53, 44, 13, 'max_length', '50'),
(64, 54, 14, 'required', ''),
(63, 53, 14, 'max_length', '11'),
(62, 53, 14, 'required', ''),
(58, 50, 15, 'required', ''),
(59, 50, 15, 'max_length', '255'),
(60, 51, 15, 'required', ''),
(61, 51, 15, 'max_length', '255'),
(65, 55, 14, 'required', ''),
(75, 65, 16, 'max_length', '255'),
(76, 66, 16, 'required', ''),
(77, 67, 16, 'required', '');

-- --------------------------------------------------------

--
-- Table structure for table `rest_input_type`
--

DROP TABLE IF EXISTS `rest_input_type`;
CREATE TABLE IF NOT EXISTS `rest_input_type` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `validation_group` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rest_input_type`
--

INSERT INTO `rest_input_type` (`id`, `type`, `relation`, `validation_group`) VALUES
(1, 'input', '0', 'input'),
(2, 'timestamp', '0', 'timestamp'),
(3, 'file', '0', 'file'),
(4, 'select', '1', 'select');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
