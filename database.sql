SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'site', '{"title":"SMK AL HUSAIN","link":"http:\\/\\/localhost\\/skalsain","image":"image_SMK AL HUSAIN_1514782288.png","keyword":"smk al husain keling","description":"smk al husain keling"}'),
(2, 'logo', '{"title":"SMK AL HUSAIN","image":"image_SMK AL HUSAIN_1514782270.png","width":"100","height":"100"}'),
(3, 'contact', '{"title":"esoftgreat","description":"website development","phone":"085640510460","email":"iwansafr@gmail.com","google":"http:\\/\\/plus.google.com\\/esoftgreat","facebook":"http:\\/\\/facebook.com\\/esoftgreat","twitter":"http:\\/\\/twitter.com\\/esoftgreat"}'),
(5, 'js_extra', '{"code":"<?php\\r\\necho \'haha\';"}'),
(6, 'templates', '{"templates":"public"}'),
(8, 'header', '{"image":"image_esoftgreat_1503199833.jpg","title":"esoftgreat","description":"Web Profile"}'),
(9, 'header_bottom', '{"image":"image_esoftgreat_1503200354.jpg","title":"esoftgreat","description":"Web Profile"}'),
(10, 'public_widget', '{"template":"public","menu_top":"menu_1","menu_sosmed":"menu_3","logo":"cat_1","menu_left":"menu_4","menu_right":"menu_5","news":"cat_55","content_top":"cat_0","content_middle":"cat_0","content_bottom":"cat_18","right_1":"cat_54","right_2":"cat_52","right_3":"cat_51","right_4":"cat_53","menu_bottom_1":"menu_6","menu_bottom_2":"menu_7","menu_bottom_3":"menu_8","menu_bottom_4":"menu_9","menu_sosmed_footer":"menu_10"}'),
(11, 'land_page_widget', '{"template":"land_page","menu_top":"menu_1","menu_header":"menu_1","content":"cat_1","content_bottom":"cat_1","menu_bottom":"menu_1","menu_footer":"menu_1"}'),
(12, 'creative_page_widget', '{"template":"creative_page","menu_top":"menu_1","menu_header":"menu_1","about":"cat_1","content":"cat_1","portofolio":"cat_1","menu_download":"menu_1","contact":"cat_1","footer":"cat_1"}');

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `cat_ids` mediumtext NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL,
  `last_hits` datetime NOT NULL,
  `rating` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `content` (`id`, `cat_ids`, `title`, `slug`, `description`, `keyword`, `intro`, `content`, `image`, `images`, `author`, `hits`, `last_hits`, `rating`, `created`, `updated`, `publish`) VALUES
(25, ',50,', 'PROFIL SMK ALHUSAIN KELING', 'profil-smk-alhusain-keling', '<p><strong>Nama SMK : SMK AL HUSAIN KELING</strong></p>\r\n\r\n<p><strong>NPSN : 20341437</strong></p>\r\n\r\n<p><strong>NSS : 332032013018</strong></p>\r\n\r\n<p><strong>Status : Swasta</strong></p>\r\n\r\n<p><strong>PBM : Pagi/Siang</strong></p>\r\n\r\n<p><strong>Satus Akr', 'PROFIL SMK ALHUSAIN KELING', '<p><strong>Nama SMK : SMK AL HUSAIN KELING</strong></p>\r\n\r\n<p><strong>NPSN : 20341437</strong></p>\r\n\r\n<p><strong>NSS : 332032013018</strong></p>\r\n\r\n<p><strong>Status : Swasta</strong></p>\r\n\r\n<p><stron', '<p><strong>Nama SMK : SMK AL HUSAIN KELING</strong></p>\r\n\r\n<p><strong>NPSN : 20341437</strong></p>\r\n\r\n<p><strong>NSS : 332032013018</strong></p>\r\n\r\n<p><strong>Status : Swasta</strong></p>\r\n\r\n<p><strong>PBM : Pagi/Siang</strong></p>\r\n\r\n<p><strong>Satus Akreditasi : Terakreditasi &ldquo;A&rdquo;</strong></p>\r\n\r\n<p><strong>Alamat Sekolah : Jl. Sambungoyot-Watuaji Km.05</strong></p>\r\n\r\n<p><strong>RT./RW : 01 / 01</strong></p>\r\n\r\n<p><strong>Desa : Watuaji</strong></p>\r\n\r\n<p><strong>Kecamatan : Keling</strong></p>\r\n\r\n<p><strong>Kabupaten/Kota : Jepara</strong></p>\r\n\r\n<p><strong>Telepon : 0291 3319637</strong></p>\r\n\r\n<p><strong>Email : smkalhusain@yahoo.co.id</strong></p>\r\n', 'image_PROFIL SMK ALHUSAIN KELING_1514595963.jpg', '', 'admin', 17, '2017-12-30 10:37:01', '', '2017-12-28 12:49:42', '2017-12-30 10:37:01', 1),
(26, ',50,', 'Visi dan Misi', 'visi-dan-misi', '<p style="text-align:center">Visi</p>\r\n\r\n<p style="text-align:center">Terciptanya anak didik yang berilmu, berkeahlian, kreatif, inovatif, kompetitif, dan bertanggung jawab, serta berakhlak mulia.</p>\r\n\r\n<p style="text-align:center">Misi</p>\r\n\r\n<p style="', 'Visi dan Misi', '<p style="text-align:center">Visi</p>\r\n\r\n<p style="text-align:center">Terciptanya anak didik yang berilmu, berkeahlian, kreatif, inovatif, kompetitif, dan bertanggung jawab, serta berakhlak mulia.</p>', '<p style="text-align:center">Visi</p>\r\n\r\n<p style="text-align:center">Terciptanya anak didik yang berilmu, berkeahlian, kreatif, inovatif, kompetitif, dan bertanggung jawab, serta berakhlak mulia.</p>\r\n\r\n<p style="text-align:center">Misi</p>\r\n\r\n<p style="text-align:center">Menciptakan tenaga kerja yang terampil, disiplin, dan kompetitif.</p>\r\n\r\n<p style="text-align:center">Membentuk siswa-siswi untuk mandiri, kreatif, dan inovatif.</p>\r\n\r\n<p style="text-align:center"><br />\r\nMembina anak didik yang tangguh, berkualitas, bertanggungjawab, dan berakhlakulkarimah.<br />\r\n&nbsp;</p>\r\n', '', '', 'admin', 3, '2017-12-30 10:20:08', '', '2017-12-30 06:52:30', '2017-12-30 10:20:08', 1),
(27, ',50,', 'Kompetensi Keahlian', 'kompetensi-keahlian', '<h4>Administrasi Perkantoran</h4>\r\n\r\n<ul>\r\n	<li>Staff Administrasi</li>\r\n	<li>Sekretaris</li>\r\n	<li>Tenaga Arsiparis</li>\r\n	<li>Tenaga Pembukuan</li>\r\n	<li>Wirausaha Jasa</li>\r\n	<li>Dan Masih Banyak Peluang Lainnya</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h4>Mult', 'Kompetensi Keahlian', '<h4>Administrasi Perkantoran</h4>\r\n\r\n<ul>\r\n	<li>Staff Administrasi</li>\r\n	<li>Sekretaris</li>\r\n	<li>Tenaga Arsiparis</li>\r\n	<li>Tenaga Pembukuan</li>\r\n	<li>Wirausaha Jasa</li>\r\n	<li>Dan Masih Banyak P', '<h4>Administrasi Perkantoran</h4>\r\n\r\n<ul>\r\n	<li>Staff Administrasi</li>\r\n	<li>Sekretaris</li>\r\n	<li>Tenaga Arsiparis</li>\r\n	<li>Tenaga Pembukuan</li>\r\n	<li>Wirausaha Jasa</li>\r\n	<li>Dan Masih Banyak Peluang Lainnya</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h4>Multimedia</h4>\r\n\r\n<ul>\r\n	<li>Perakitan Komputer</li>\r\n	<li>Desain Grafis</li>\r\n	<li>Photography</li>\r\n	<li>Videography</li>\r\n	<li>Animasi</li>\r\n	<li>Wirausaha Bidang Multimedia</li>\r\n</ul>\r\n', '', '', 'admin', 1, '2017-12-30 08:08:36', '', '2017-12-30 08:08:28', '2017-12-30 08:08:36', 1),
(28, ',50,', 'About Us', 'about-us', '<ul>\r\n	<li>Jl Raya Sambungoyot &ndash; Watuaji Km.05 Kecamatan Keling Kabupaten Jepara 59454</li>\r\n	<li>+6282301517731</li>\r\n	<li><a href="mailto:smkalhusain@yahoo.co.id">&nbsp;smkalhusain@yahoo.co.id</a></li>\r\n	<li>&nbsp;Sen-Sab 07:00-14:00</li>\r\n</ul>\r\n', 'About Us', '<ul>\r\n	<li>Jl Raya Sambungoyot &ndash; Watuaji Km.05 Kecamatan Keling Kabupaten Jepara 59454</li>\r\n	<li>+6282301517731</li>\r\n	<li><a href="mailto:smkalhusain@yahoo.co.id">&nbsp;smkalhusain@yahoo.co.id', '<ul>\r\n	<li>Jl Raya Sambungoyot &ndash; Watuaji Km.05 Kecamatan Keling Kabupaten Jepara 59454</li>\r\n	<li>+6282301517731</li>\r\n	<li><a href="mailto:smkalhusain@yahoo.co.id">&nbsp;smkalhusain@yahoo.co.id</a></li>\r\n	<li>&nbsp;Sen-Sab 07:00-14:00</li>\r\n</ul>\r\n', '', '', 'admin', 8, '2018-01-01 02:01:42', '', '2017-12-30 08:10:49', '2018-01-01 21:01:42', 1),
(29, ',18,53,', 'Jaya Selalu SMK Al Husain', 'jaya-selalu-smk-al-husain', '', 'Jaya Selalu SMK Al Husain', '', '', 'image_Jaya Selalu SMK Al Husain_1514596757.jpg', '', 'admin', 3, '2017-12-30 11:37:20', '', '2017-12-30 08:19:17', '2017-12-30 18:37:20', 1),
(30, ',18,', 'Guru Kita', 'guru-kita', '', 'Guru Kita', '', '', 'image_Guru Kita_1514597089.jpg', '', 'admin', 4, '2017-12-30 10:13:04', '', '2017-12-30 08:24:49', '2017-12-30 10:13:04', 1),
(31, ',18,', 'Visitasi Akreditasi Program Keahlian Otomatisasi dan Tata Kelola Perkantoran', 'visitasi-akreditasi-program-keahlian-otomatisasi-dan-tata-kelola-perkantoran', '<p>Visitasi Akreditasi Program Keahlian Otomatisasi dan Tata Kelola Perkantoran</p>\r\n', 'Visitasi Akreditasi Program Keahlian Otomatisasi dan Tata Kelola Perkantoran', '<p>Visitasi Akreditasi Program Keahlian Otomatisasi dan Tata Kelola Perkantoran</p>\r\n', '<p>Visitasi Akreditasi Program Keahlian Otomatisasi dan Tata Kelola Perkantoran</p>\r\n', 'image_Visitasi Akreditasi Program Keahlian Otomatisasi dan Tata Kelola Perkantoran_1514597188.jpg', '', 'admin', 4, '2018-01-07 01:00:06', '', '2017-12-30 08:26:28', '2018-01-07 08:00:06', 1),
(32, ',18,', 'SMK AL HUSAIN', 'smk-al-husain', '', 'SMK AL HUSAIN', '', '', 'image_SMK AL HUSAIN_1514597329.jpg', '', 'admin', 0, '0000-00-00 00:00:00', '', '2017-12-30 08:28:49', '2017-12-30 08:28:49', 1),
(33, ',18,51,54,55,', 'Juara 3 LKS', 'juara-3-lks', '<p>Selamat maya, Juara III Lomba Kompetensi Siswa Sekretaris Kab. Jepara ', 'Juara 3 LKS', '<p>Selamat maya, Juara III Lomba Kompetensi Siswa Sekretaris Kab. Jepara ', '<p>Selamat maya, Juara III Lomba Kompetensi Siswa Sekretaris Kab. Jepara ', 'image_Juara 3 LKS_1514597507.jpg', '', 'admin', 4, '2017-12-30 11:36:51', '', '2017-12-30 08:31:47', '2017-12-30 18:36:51', 1),
(34, ',18,49,51,52,55,50,', 'Literasi Peserta Didik SMK Al Husain', 'literasi-peserta-didik-smk-al-husain', '<p>Literasi Peserta Didik SMK Al Husain Keling &quot;SKALSAIN&quot;<br />\r\n#SMKAH<br />\r\n#AdministrasiPerkantoran<br />\r\n#Multimedia</p>\r\n', 'Literasi Peserta Didik SMK Al Husain', '<p>Literasi Peserta Didik SMK Al Husain Keling &quot;SKALSAIN&quot;<br />\r\n#SMKAH<br />\r\n#AdministrasiPerkantoran<br />\r\n#Multimedia</p>\r\n', '<p>Literasi Peserta Didik SMK Al Husain Keling &quot;SKALSAIN&quot;<br />\r\n#SMKAH<br />\r\n#AdministrasiPerkantoran<br />\r\n#Multimedia</p>\r\n', 'image_Literasi Peserta Didik SMK Al Husain_1514597711.jpg', '', 'admin', 12, '2018-01-02 03:27:35', '', '2017-12-30 08:35:11', '2018-01-02 22:27:35', 1),
(35, ',56,', 'Aji Ismoyo, S.Sos', 'aji-ismoyo-s-sos', '<p>Kepala Sekolah</p>\r\n', 'Aji Ismoyo, S.Sos', '<p>Kepala Sekolah</p>\r\n', '<p>Kepala Sekolah</p>\r\n', 'image_Aji_Ismoyo,_S.Sos_1514909621.jpg', '', 'admin', 0, '0000-00-00 00:00:00', '', '2018-01-02 23:13:22', '2018-01-02 23:13:41', 1),
(36, ',1,', 'Gallery', 'gallery', '', 'Gallery', '0', '', 'image_Gallery_1515250170.jpg', '["images_Gallery_0_1515250170.jpg","images_Gallery_1_1515250170.jpg","images_Gallery_2_1515250170.jpg"]', 'admin', 2, '2018-01-23 10:07:33', '', '2018-01-06 21:49:30', '2018-01-23 22:07:33', 1),
(37, ',57,', 'Sample Gallery', 'sample-gallery', '', 'Sample Gallery', '', '', 'image_Sample_Gallery_1516720049.png', '["images_Sample_Gallery_0_1516720049.png","images_Sample_Gallery_1_1516720049.png","images_Sample_Gallery_2_1516720049.png","images_Sample_Gallery_3_1516720049.png"]', 'admin', 15, '2018-01-23 10:26:10', '', '2018-01-23 22:07:29', '2018-01-23 22:26:10', 1);

DROP TABLE IF EXISTS `content_cat`;
CREATE TABLE `content_cat` (
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

INSERT INTO `content_cat` (`id`, `par_id`, `title`, `slug`, `image`, `description`, `publish`, `created`, `updated`) VALUES
(1, 0, 'Uncategorized', 'uncategorized', '', 'this is uncategorized', 1, '2017-05-01 07:33:31', '2017-12-30 10:18:17'),
(18, 0, 'Berita Sekolah', 'berita-sekolah', 'image_Berita Sekolah_1514594151.jpg', 'ini adalah kategori untuk berita sekolah', 1, '2017-07-19 09:52:52', '2017-12-30 10:11:29'),
(49, 18, 'Osis', 'osis', '', 'kategori untuk berita dari osis', 1, '2017-07-21 10:59:13', '2017-12-30 10:18:10'),
(50, 0, 'Profil', 'profil', '', '', 1, '2017-07-25 08:55:54', '2017-12-30 10:18:06'),
(51, 18, 'Administrasi Perkantoran', 'administrasi-perkantoran', '', 'kategori untuk berita dari jurusan administrasi perkantoran', 1, '2017-09-30 19:39:46', '2017-12-30 10:18:02'),
(52, 18, 'Multimedia', 'multimedia', '', 'kategori untuk berita dari jurusan multimedia', 1, '2017-09-30 22:39:22', '2017-12-30 10:17:57'),
(53, 0, 'Banner', 'banner', '', 'kategori untuk banner', 1, '2017-10-30 06:45:08', '2017-12-30 10:17:53'),
(54, 18, 'Pengumuman', 'pengumuman', '', 'ini adalah katerogi untuk pengumuman', 1, '2017-12-30 07:52:05', '2017-12-30 10:17:48'),
(55, 18, 'Breaking News', 'breaking-news', '', '', 1, '2017-12-30 08:11:36', '2017-12-30 09:55:42'),
(56, 50, 'Guru dan Staff Karyawan', 'guru-dan-staff-karyawan', '', '', 1, '2018-01-02 22:58:36', '2018-01-02 22:58:36'),
(57, 0, 'Gallery', 'gallery-57', '', '', 1, '2018-01-23 22:06:52', '2018-01-23 22:06:52');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `link` mediumtext NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `menu` (`id`, `par_id`, `position_id`, `title`, `link`, `publish`) VALUES
(8, 0, 3, 'facebook', 'https://web.facebook.com/smkalhusainkeling/', 1),
(9, 0, 3, 'twitter', 'http://www.twitter.com', 1),
(10, 0, 4, 'Home', 'http://skalsain.esoftgreat.com', 1),
(11, 0, 4, 'Profile', 'http://localhost/skalsain/content/category/50/Profile.html', 1),
(12, 0, 4, 'Guru', '', 1),
(13, 0, 5, 'Siswa', '', 1),
(14, 12, 0, 'Guru 1', '', 1),
(15, 12, 0, 'Guru 2', '', 1),
(16, 0, 0, 'Test', '', 1),
(17, 13, 0, 'siswa 1', '', 1),
(18, 0, 5, 'Kelas', '', 1),
(19, 0, 2, 'Information', '', 1),
(20, 0, 6, 'About Us', '', 1),
(21, 0, 6, 'Privacy Policy', '', 1),
(22, 0, 6, 'Terms and Condition', '', 1),
(23, 0, 7, 'Contact Us', '', 1),
(24, 0, 7, 'Site Map', '', 1),
(25, 0, 8, 'Brands', '', 1),
(26, 0, 8, 'Affiliates', '', 1),
(27, 0, 9, 'My Account', '', 1),
(28, 0, 9, 'Wish List', '', 1),
(29, 0, 9, 'Newsletter', '', 1),
(30, 0, 10, 'facebook', 'https://web.facebook.com/smkalhusainkeling/', 1),
(31, 0, 10, 'twitter', 'http://twitter.com', 1),
(32, 0, 10, 'instagram', 'https://www.instagram.com/just_smkalhusain/', 1),
(33, 0, 10, 'wordpress', 'https://alhusainkeling.wordpress.com/', 1),
(57, 11, 1, 'About Us', 'about-us.html', 1),
(58, 0, 1, 'Pengumuman', 'category/pengumuman.html', 1),
(59, 0, 1, 'Profile', '', 1),
(60, 0, 1, 'Berita Terbaru', 'content/', 1),
(61, 0, 1, 'PPDB', 'ppdb', 1),
(62, 59, 1, 'Guru dan Staff Karyawan', 'category/guru-dan-staff-karyawan.html?type=grid', 1);

DROP TABLE IF EXISTS `menu_position`;
CREATE TABLE `menu_position` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `menu_position` (`id`, `title`) VALUES
(1, 'Top'),
(2, 'Bottom'),
(3, 'Social Media'),
(4, 'middle'),
(5, 'middle_right'),
(6, 'Information'),
(7, 'Customer Service'),
(8, 'Extras'),
(9, 'My Account'),
(10, 'Footer Social Media');

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
(18, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'iwan@fisip.net', 'image_admin_1514590939.jpg', 1, 1, '2017-06-17 16:03:14', '2017-12-30 06:42:49'),
(19, 'iwansafr', 'c4ca4238a0b923820dcc509a6f75849b', 'iwan@mail.com', 'image_iwansafr_1514523323.jpg', 2, 1, '2017-07-06 05:47:21', '2017-12-29 11:55:23'),
(58, 'admin_smk', '6ef555e85c1b81e77507d2ac0c806a57', 'skalsain@esoftgreat.com', 'image_admin_smk_1514781470.jpg', 1, 1, '2018-01-01 11:37:50', '2018-01-01 11:37:50');


ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `content_cat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `menu_position`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ppdb`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
ALTER TABLE `content_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
ALTER TABLE `menu_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
ALTER TABLE `ppdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
