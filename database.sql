SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `apbdes`;
CREATE TABLE `apbdes` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `anggaran` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `apbdes_ket_id` text,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `apbdes` (`id`, `par_id`, `user_id`, `uraian`, `anggaran`, `no`, `apbdes_ket_id`, `created`, `updated`) VALUES
(1, 0, 18, 'PENDAPATAN', 2000000000, 1, ',1,2,3,', '2018-04-08 21:14:43', '2018-04-15 10:02:56'),
(2, 1, 18, 'Pendapatan Desa', 5000000, 1, ',3,', '2018-04-08 21:25:24', '2018-04-15 10:03:02'),
(3, 2, 18, 'hasil usaha', 1500000, 1, NULL, '2018-04-08 21:29:03', '2018-04-15 21:26:59'),
(4, 2, 18, 'Swadaya', 0, 2, NULL, '2018-04-08 21:29:40', '2018-04-15 10:02:47'),
(5, 2, 18, 'lain-lain', 0, 3, NULL, '2018-04-08 21:31:27', '2018-04-15 10:02:47'),
(6, 0, 18, 'PENGELUARAN', 20000000, 2, ',2,', '2018-04-14 06:21:07', '2018-04-15 11:12:25'),
(7, 2, 18, 'jl jlj lkj ljlj lj lj lj lj lj l j jl jlj lkj ljlj lj lj lj lj lj l j jl jlj lkj ljlj lj lj lj lj lj l j jl jlj lkj ljlj lj lj lj lj lj l j', 0, 4, NULL, '2018-04-15 14:02:11', '2018-04-15 21:14:35');

DROP TABLE IF EXISTS `apbdes_ket`;
CREATE TABLE `apbdes_ket` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `apbdes_ket` (`id`, `par_id`, `title`) VALUES
(1, 0, 'ADD'),
(2, 0, 'DD'),
(3, 0, 'PAD');

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `module` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=content,2=product',
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comment` (`id`, `par_id`, `module`, `module_id`, `user_id`, `username`, `content`, `created`, `updated`) VALUES
(2, 0, 1, 3, 0, 'iwan', 'jfdlfjalk', '2018-04-05 13:13:02', '2018-04-05 13:13:02');

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'site', '{\"title\":\"apbdes\",\"link\":\"http:\\/\\/localhost\\/apbdes\",\"image\":\"image_esoftgreat_1517456501.png\",\"keyword\":\"software development, it consulting, it support\",\"description\":\"software development, it consulting, it support\"}'),
(2, 'logo', '{\"title\":\"esoftgreat\",\"image\":\"image_esoftgreat_1516772919.png\",\"width\":\"300\",\"height\":\"25\"}'),
(3, 'contact', '{\"title\":\"esoftgreat\",\"description\":\"website development\",\"phone\":\"085640510460\",\"email\":\"iwansafr@gmail.com\",\"google\":\"http:\\/\\/plus.google.com\\/esoftgreat\",\"facebook\":\"http:\\/\\/facebook.com\\/esoftgreat\",\"twitter\":\"http:\\/\\/twitter.com\\/esoftgreat\"}'),
(5, 'js_extra', '{\"code\":\"\"}'),
(6, 'templates', '{\"templates\":\"land_page_2\",\"admin_templates\":\"admin-lte\"}'),
(8, 'header', '{\"image\":\"image_apbdes_1523498496.png\",\"title\":\"apbdes\",\"description\":\"\"}'),
(9, 'header_bottom', '{\"image\":\"image_apbdes_1523498513.png\",\"title\":\"\",\"description\":\"pemerintah jawa tengah\"}'),
(10, 'public_widget', '{\"template\":\"public\",\"menu_top\":\"menu_1\",\"menu_sosmed\":\"menu_1\",\"logo\":\"cat_1\",\"menu_left\":\"menu_1\",\"menu_right\":\"menu_1\",\"news\":\"cat_1\",\"content_top\":\"cat_0\",\"content_middle\":\"cat_0\",\"content_bottom\":\"cat_1\",\"right_1\":\"cat_1\",\"right_2\":\"cat_1\",\"right_3\":\"cat_1\",\"right_4\":\"cat_1\",\"menu_bottom_1\":\"menu_1\",\"menu_bottom_2\":\"menu_1\",\"menu_bottom_3\":\"menu_1\",\"menu_bottom_4\":\"menu_1\",\"menu_sosmed_footer\":\"menu_2\"}'),
(11, 'land_page_widget', '{\"template\":\"land_page\",\"menu_top\":{\"content\":\"menu_1\",\"limit\":\"3\"},\"menu_header\":{\"content\":\"menu_1\",\"limit\":\"7\"},\"content\":{\"content\":\"cat_2\",\"limit\":\"2\"},\"content_bottom\":{\"content\":\"cat_3\",\"limit\":\"7\"},\"menu_bottom\":{\"content\":\"menu_2\",\"limit\":\"7\"},\"menu_footer\":{\"content\":\"menu_1\",\"limit\":\"7\"}}'),
(12, 'alert', '{\"login_failed\":\"Make Sure That Your Username and Password is Correct\",\"login_max_failed\":\"You have failed login 3 time. please wait 30 minute later and login again\",\"save_success\":\"\"}'),
(13, 'education_widget', '{\"template\":\"education\",\"menu_site\":\"menu_3\",\"menu_contact\":\"menu_4\",\"menu_socmed\":\"menu_2\",\"menu_logo\":\"menu_1\",\"menu_top\":\"menu_1\",\"header\":\"cat_1\",\"cat_category\":\"cat_5\",\"counter\":\"cat_1\",\"product\":\"cat_13\",\"testimonial\":\"cat_14\",\"news\":\"cat_1\",\"portofolio\":\"cat_1\",\"contact\":\"cat_1\",\"gallery\":\"cat_1\",\"content_bottom\":\"cat_1\",\"menu_bottom\":\"menu_1\"}'),
(14, 'admin-lte_config', '{\"site_title\":\"\",\"site_link\":\"\",\"site_image\":\"\",\"site_keyword\":\"\",\"site_description\":\"\",\"logo_title\":\"\",\"logo_image\":\"\",\"logo_width\":\"200\",\"logo_height\":\"50\"}'),
(15, 'education_config', '{\"site_title\":\"\",\"site_link\":\"\",\"site_image\":\"\",\"site_keyword\":\"\",\"site_description\":\"\",\"logo_title\":\"\",\"logo_image\":\"\",\"logo_width\":\"200\",\"logo_height\":\"50\"}'),
(16, 'web_type', '{\"type\":\"0\"}'),
(17, 'up_landed_widget', '{\"template\":\"up_landed\",\"menu_top\":{\"content\":\"menu_1\",\"limit\":\"7\"},\"bottom\":{\"content\":\"cat_1\",\"limit\":\"7\"},\"bottom_left\":{\"content\":\"cat_1\",\"limit\":\"7\"},\"bottom_middle\":{\"content\":\"cat_1\",\"limit\":\"7\"},\"bottom_right\":{\"content\":\"cat_1\",\"limit\":\"7\"},\"right\":{\"content\":\"cat_1\",\"limit\":\"7\"},\"left\":{\"content\":\"cat_1\",\"limit\":\"7\"},\"portofolio\":{\"content\":\"cat_1\",\"limit\":\"7\"},\"menu_footer\":{\"content\":\"menu_1\",\"limit\":\"7\"}}'),
(18, 'up_landed_config', '{\"site_title\":\"\",\"site_link\":\"\",\"site_image\":\"\",\"site_keyword\":\"\",\"site_description\":\"\",\"logo_title\":\"\",\"logo_image\":\"\",\"logo_width\":\"150\",\"logo_height\":\"35\"}'),
(19, 'newsfeed_widget', '{\"template\":\"newsfeed\",\"menu_top\":\"menu_1\",\"banner\":\"cat_1\",\"menu_middle\":\"menu_1\",\"top_news\":\"cat_1\",\"slide_news\":\"cat_1\",\"left_secsion_1\":\"cat_1\",\"left_secsion_2\":\"cat_1\",\"left_secsion_3\":\"cat_1\",\"photography\":\"cat_1\",\"left_secsion_4\":\"cat_1\",\"right_section_1\":\"cat_1\",\"right_section_2\":\"cat_1\",\"category_video_comment\":\"cat_1\",\"sponsor\":\"cat_1\",\"category\":\"cat_1\",\"links\":\"cat_1\",\"images\":\"cat_1\",\"tag\":\"cat_1\",\"contact\":\"cat_1\"}'),
(20, 'content_config', '{\"author_detail\":\"1\",\"tag_detail\":\"1\",\"comment_detail\":\"1\",\"created_detail\":\"1\",\"author_list\":\"1\",\"tag_list\":\"1\",\"created_list\":\"1\"}'),
(21, 'land_page_2_widget', '{\"template\":\"land_page_2\",\"menu_top\":{\"content\":\"menu_6\"},\"header\":{\"content\":\"cat_0\",\"limit\":\"7\"},\"menu_left\":{\"content\":\"menu_5\"},\"content\":{\"content\":\"cat_0\",\"limit\":\"7\"},\"content_bottom\":{\"content\":\"cat_0\",\"limit\":\"7\"},\"menu_bottom\":{\"content\":\"menu_6\"},\"menu_footer\":{\"content\":\"menu_6\"}}'),
(22, 'pemdes', '{\"desa\":\"Bangsri\",\"kep_des\":\"Iwan Safrudin, S.Kom\"}');

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `cat_ids` mediumtext NOT NULL,
  `tag_ids` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `image_link` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL,
  `last_hits` datetime NOT NULL,
  `rating` varchar(255) NOT NULL,
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `content_cat`;
CREATE TABLE `content_cat` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `content_tag`;
CREATE TABLE `content_tag` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `content_tag` (`id`, `title`, `created`) VALUES
(1, 'tes', '2018-02-10 09:31:06'),
(2, 'ajah', '2018-02-10 09:31:06'),
(3, 'gitu', '2018-02-10 09:31:06'),
(4, 'loh', '2018-02-10 09:31:06'),
(5, 'test', '2018-02-10 10:11:39'),
(6, 'tags', '2018-02-10 10:11:39'),
(7, 'yagitudeh', '2018-02-10 10:11:39'),
(8, 'iyah', '2018-02-10 10:36:06'),
(9, 'aku', '2018-02-10 10:45:06'),
(10, 'kamu', '2018-02-10 10:45:30'),
(11, 'kita', '2018-02-10 10:46:36'),
(12, 'software', '2018-03-04 01:55:31'),
(13, 'development', '2018-03-04 01:55:31'),
(14, 'web', '2018-03-04 01:55:31'),
(15, 'murah', '2018-03-08 13:00:38'),
(16, 'paket', '2018-03-08 13:00:38');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` mediumtext NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `menu` (`id`, `par_id`, `position_id`, `sort_order`, `title`, `link`, `publish`) VALUES
(1, 0, 5, 1, 'Data Apbdes', '', 1),
(2, 0, 5, 5, 'Logout', 'user/logout', 1),
(3, 0, 5, 3, 'Laporan', 'apbdes/report', 1),
(4, 0, 5, 2, 'Keterangan', 'apbdes/keterangan', 1),
(5, 0, 5, 4, 'Konfigurasi', 'apbdes/config', 1);

DROP TABLE IF EXISTS `menu_position`;
CREATE TABLE `menu_position` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `menu_position` (`id`, `title`) VALUES
(5, 'User'),
(6, 'None');

DROP TABLE IF EXISTS `player`;
CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `ppdb`;
CREATE TABLE `ppdb` (
  `id` int(11) NOT NULL,
  `nisn` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `asal_sekolah` varchar(255) NOT NULL,
  `no_sttb` varchar(50) NOT NULL,
  `no_skhu` varchar(50) NOT NULL,
  `tahun_ijazah` int(4) NOT NULL,
  `nilai_un` varchar(50) NOT NULL,
  `nama_orangtua` varchar(255) NOT NULL,
  `alamat_orangtua` text NOT NULL,
  `pekerjaan_orangtua` varchar(255) NOT NULL,
  `penghasilan_orangtua` varchar(50) NOT NULL,
  `telp_orangtua` varchar(50) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `cat_ids` text NOT NULL,
  `tag_ids` text NOT NULL,
  `image` varchar(11) NOT NULL,
  `images` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `discount` double NOT NULL,
  `qty` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = not publish, 1 = publish',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `product_cat`;
CREATE TABLE `product_cat` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product_cat` (`id`, `par_id`, `title`, `slug`, `image`, `description`, `publish`, `created`, `updated`) VALUES
(1, 0, 'Uncategorized', 'uncategorized', '', '', 1, '2018-02-16 10:14:47', '2018-02-16 10:14:47');

DROP TABLE IF EXISTS `product_tag`;
CREATE TABLE `product_tag` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `answer` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = option 1, 2 = option 2',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `question` (`id`, `question`, `option1`, `option2`, `answer`, `created`) VALUES
(1, '<h1><span style=\"font-family:Comic Sans MS,cursive\">apakah <span style=\"color:#3498db\">sebelum </span>atau <span style=\"color:#3498db\">sesudah</span>&nbsp; tahun <span style=\"color:#3498db\">1940</span> negara republik indonesia merdeka ?</span></h1>\r\n', 'sebelum', 'sesudah', 2, '2018-01-28 17:40:26'),
(2, '<p>apakah belanda atau inggris negara yang pernah menjajah negara republik indonesia ?</p>\r\n', 'inggris', 'belanda', 2, '2018-01-28 17:41:10');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '5' COMMENT '1=admin, 2=editor, 3=author, 4=contributor, 5=subscriber',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = not active',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `username`, `password`, `email`, `image`, `role`, `active`, `created`, `updated`) VALUES
(18, 'esoftgreat', '$2y$10$WUymBKnkJxdksza90iX7wOx.6ZgOFbv4OYhkZqN2WKifDOwrnGy.2', 'iwan@fisip.net', 'image_esoftgreat_1517645260.png', 1, 1, '2017-06-17 16:03:14', '2018-02-03 15:07:40'),
(19, 'iwansafr', '$2y$10$pgZ7XJogphtKNcKptjSH5uQ4TGz2cpCZ5aboc.Eh/gyOjiqlZKN.m', 'iwan@mail.com', 'image_iwansafr_1514523323.jpg', 2, 1, '2017-07-06 05:47:21', '2018-01-28 12:31:03'),
(59, 'rizki', '$2y$10$mSZ7YxfOuRNvs5nBDTHJ3e.XR7JBMsCmDaCXD.8IbQaeMFPwmVQ0a', 'rizki@esoftgreat.com', 'image_rizki_1516850862.jpg', 1, 1, '2018-01-25 10:27:42', '2018-01-28 12:30:57'),
(60, 'sabil', '$2y$10$HQTwUFwL5GomOuYVEDh2E.UsRHL0FXbHr.NZvRZ8vDnh77QSU5iJO', 'sabil@esoftgreat.com', 'image_sabil_1516850902.jpg', 1, 1, '2018-01-25 10:28:22', '2018-01-28 12:30:51');

DROP TABLE IF EXISTS `visitor`;
CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `visited` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `visitor` (`id`, `ip`, `visited`, `created`) VALUES
(1, '::1', 'http://localhost/esoftgreat/templates/admin/css/ionicons.min.css', '2018-02-05 05:31:51'),
(2, '::1', 'http://localhost/esoftgreat/', '2018-02-05 05:32:24'),
(3, '::1', 'http://localhost/esoftgreat/templates/education/css/fonts/icomoon.ttf', '2018-02-05 05:32:24'),
(4, '::1', 'http://localhost/esoftgreat/templates/education/css/fonts/icomoon.woff', '2018-02-05 05:32:24'),
(5, '::1', 'http://localhost/esoftgreat/', '2018-02-05 05:35:43'),
(6, '::1', 'http://localhost/esoftgreat/templates/education/css/fonts/icomoon.ttf', '2018-02-05 05:35:44'),
(7, '::1', 'http://localhost/esoftgreat/templates/education/css/fonts/icomoon.woff', '2018-02-05 05:35:44'),
(8, '::1', 'http://localhost/esoftgreat/', '2018-02-05 05:35:55'),
(9, '::1', 'http://localhost/esoftgreat/templates/education/css/fonts/icomoon.ttf', '2018-02-05 05:35:55'),
(10, '::1', 'http://localhost/esoftgreat/templates/education/css/fonts/icomoon.woff', '2018-02-05 05:35:56'),
(11, '::1', 'http://localhost/esoftgreat/', '2018-02-05 05:37:01'),
(12, '::1', 'http://localhost/esoftgreat/templates/education/css/fonts/icomoon.ttf', '2018-02-05 05:37:01'),
(13, '::1', 'http://localhost/esoftgreat/templates/education/css/fonts/icomoon.woff', '2018-02-05 05:37:01');


ALTER TABLE `apbdes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `apbdes_ket`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `content_cat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

ALTER TABLE `content_tag`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `menu_position`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `player`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ppdb`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product_cat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `apbdes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `apbdes_ket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `content_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `content_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `menu_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ppdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `product_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `product_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
