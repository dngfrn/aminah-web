/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 80036
 Source Host           : 127.0.0.1:3306
 Source Schema         : db_equity_crowdfunding

 Target Server Type    : MySQL
 Target Server Version : 80036
 File Encoding         : 65001

 Date: 27/06/2024 20:56:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_batches
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_06_19_173227_create_pemodal_table', 2);
INSERT INTO `migrations` VALUES (6, '2024_06_21_225035_create_pengajuan_table', 2);
INSERT INTO `migrations` VALUES (7, '2024_05_18_142146_add_role_to_users_table', 3);
INSERT INTO `migrations` VALUES (8, '2024_06_24_123341_create_review_table', 4);
INSERT INTO `migrations` VALUES (10, '2024_06_25_063456_create_status_pendanaan_table', 5);
INSERT INTO `migrations` VALUES (12, '2024_06_25_172257_update_default_value_role_user', 6);
INSERT INTO `migrations` VALUES (13, '2024_06_27_112628_update_tbl_user_last_name', 6);
INSERT INTO `migrations` VALUES (14, '2024_06_25_063008_create_pendanaan_table', 7);
COMMIT;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pemodal
-- ----------------------------
DROP TABLE IF EXISTS `pemodal`;
CREATE TABLE `pemodal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `namaLengkap` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenisKelamin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotoKtp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempatLahir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggalLahir` date NOT NULL,
  `pekerjaan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaBank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noRekening` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pemodal
-- ----------------------------
BEGIN;
INSERT INTO `pemodal` VALUES (2, 1, 'TEST', 'Laki - Laki', 'TEST', '1719044668.png', 'Jakarta', '2003-03-08', 'ANU', 'ini', 'ono', '2024-06-22 08:24:29', '2024-06-22 08:24:29');
INSERT INTO `pemodal` VALUES (3, 10, 'Test', 'Laki - Laki', 'Test', '1719408037.png', 'test', '2002-02-02', 'TEST', 'TEST', 'TEST', '2024-06-26 13:20:37', '2024-06-26 13:20:37');
INSERT INTO `pemodal` VALUES (4, 12, 'Rifki', 'Laki - Laki', 'TEST', '1719487252.png', 'TEST', '2024-06-27', 'Mahasiswa', 'BCA', 'ws2232', '2024-06-27 11:20:52', '2024-06-27 11:20:52');
INSERT INTO `pemodal` VALUES (5, 7, 'TEST', 'Laki - Laki', 'TEST', '1719491775.png', 'TEST', '2024-06-20', 'TEST', 'test', 'test', '2024-06-27 12:36:15', '2024-06-27 12:36:15');
COMMIT;

-- ----------------------------
-- Table structure for pendanaan
-- ----------------------------
DROP TABLE IF EXISTS `pendanaan`;
CREATE TABLE `pendanaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `review_id` bigint unsigned NOT NULL,
  `pemodal_id` bigint unsigned NOT NULL,
  `namaUsaha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlahUnit` int NOT NULL,
  `totalPembayaran` int NOT NULL,
  `buktiTransfer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pendanaan
-- ----------------------------
BEGIN;
INSERT INTO `pendanaan` VALUES (1, 3, 10, 'TEST JUALAN', 100, 10100000, '1719488295.png', '2024-06-27 11:38:10', '2024-06-27 11:38:15');
INSERT INTO `pendanaan` VALUES (2, 3, 10, 'TEST JUALAN', 50, 5100000, '1719488422.png', '2024-06-27 11:38:47', '2024-06-27 11:40:22');
INSERT INTO `pendanaan` VALUES (3, 3, 10, 'TEST JUALAN', 350, 35100000, '1719488426.png', '2024-06-27 11:39:19', '2024-06-27 11:40:26');
INSERT INTO `pendanaan` VALUES (4, 3, 10, 'TEST JUALAN', 20, 2100000, '1719488872.png', '2024-06-27 11:47:47', '2024-06-27 11:47:52');
INSERT INTO `pendanaan` VALUES (5, 3, 10, 'TEST JUALAN', 30, 3100000, '1719489034.png', '2024-06-27 11:50:30', '2024-06-27 11:50:34');
COMMIT;

-- ----------------------------
-- Table structure for pengajuan
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan`;
CREATE TABLE `pengajuan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `namaPemilik` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotoKtp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaUsaha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamatUsaha` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategoriUsaha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsiUsaha` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `omsetPerBulan` double NOT NULL,
  `jumlahPengajuan` double NOT NULL,
  `rencanaPengajuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodeBagiHasil` int NOT NULL,
  `persentaseBagiHasil` double NOT NULL,
  `companyProfile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambarProduk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `omsetTigaBulanTerakhir` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pengajuan
-- ----------------------------
BEGIN;
INSERT INTO `pengajuan` VALUES (5, 18, 'Camren Homenick', '1323123', 'TEST', '1719491594.png', 'AYO APAAN', 'AYO APAAN', 'AYO APAAN', 'AYO APAAN', 10000000, 10000000, 'TEST', 2, 20, '1719491596.png', '1719491595.png', '1719491596.png', '2024-06-27 12:33:16', '2024-06-27 12:33:16');
INSERT INTO `pengajuan` VALUES (56, 10, 'Dr. Jose Stamm Jr.', '0395211692415484', '214 Warren Branch\nKilbackburgh, WI 09103-5925', 'https://via.placeholder.com/640x480.png/00ff00?text=iste', 'Grant-Dickinson', '2090 Mitchell Mount\nLangoshstad, NV 09307-2229', 'enim', 'Quia maiores quod ratione omnis facilis. Est quia quia id sunt asperiores corrupti numquam. Inventore quis perferendis distinctio itaque totam. Sed fugit incidunt optio reprehenderit qui soluta.', 39396769, 50070201, 'Dolorem nihil vitae recusandae aut et eum.', 2, 99, 'Non pariatur atque sapiente nobis necessitatibus qui. Quisquam nulla voluptas alias omnis architecto. Sunt maiores dolorem a assumenda.', 'https://via.placeholder.com/640x480.png/0011aa?text=laudantium', '43088377', '2024-06-27 12:46:39', '2024-06-27 12:46:39');
INSERT INTO `pengajuan` VALUES (58, 16, 'Elmore Wyman', '2527634206459051', '32397 Makayla Harbor Apt. 059\nSouth Raquel, WY 70772', 'https://via.placeholder.com/640x480.png/006600?text=quae', 'Becker PLC', '35083 Reilly Port\nAlexfurt, LA 28076-2777', 'et', 'Quod laboriosam labore ratione error dolorem. Ea libero veniam in labore.', 56969705, 77503135, 'Fuga nostrum quibusdam ipsa voluptates.', 11, 70, 'Ea possimus illo aut ea. Recusandae ut at inventore quo voluptatem nulla. Facere consequatur enim doloribus eum sint.', 'https://via.placeholder.com/640x480.png/00ff44?text=nobis', '74408307', '2024-06-27 12:47:09', '2024-06-27 12:47:09');
INSERT INTO `pengajuan` VALUES (59, 15, 'Dennis Stroman', '1867019630244608', '70100 Swift Causeway Apt. 951\nLueilwitzshire, AK 26550-1401', 'https://via.placeholder.com/640x480.png/002266?text=assumenda', 'Rodriguez, Kling and Lind', '28951 Caleb Knolls\nKeenanberg, WY 72862-3271', 'soluta', 'Tenetur impedit ex qui soluta nisi officiis. Voluptatem et ullam id. Porro atque molestiae sit voluptas minus nihil ut.', 77299486, 48320584, 'Blanditiis nesciunt qui temporibus est.', 9, 88, 'Qui aut ipsum at. Assumenda cumque deleniti a eaque soluta quia tempore.', 'https://via.placeholder.com/640x480.png/008855?text=nihil', '104836076', '2024-06-27 12:47:09', '2024-06-27 12:47:09');
INSERT INTO `pengajuan` VALUES (60, 7, 'Mr. Hazle Hamill Jr.', '3345729436020047', '757 Feeney Club Apt. 334\nGloverhaven, TN 06887-6181', 'https://via.placeholder.com/640x480.png/001122?text=voluptas', 'Towne-Bednar', '9400 Eloisa Dam Suite 591\nLake Clinton, MT 21313-4761', 'facilis', 'Voluptatem id quod veritatis sit quam magni. Nulla vero perspiciatis laboriosam soluta. Vero omnis quia id eligendi labore ut porro. Voluptatibus et fugit dolores cumque reiciendis.', 27736903, 65767007, 'Minima quae neque earum animi.', 7, 75, 'Accusantium laborum suscipit consequatur hic quo voluptatem atque. Molestias enim iure esse aliquid. Totam qui deserunt autem debitis porro tempore. Et dolore suscipit veniam dolores.', 'https://via.placeholder.com/640x480.png/0077dd?text=omnis', '139563562', '2024-06-27 12:47:09', '2024-06-27 12:47:09');
INSERT INTO `pengajuan` VALUES (66, 6, 'Miss Shaniya Fahey', '3746680098850379', '9821 Makenzie Canyon Suite 523\nElzaberg, AR 27789', 'https://via.placeholder.com/640x480.png/0022ff?text=pariatur', 'Weimann-Witting', '264 Vern Mall Suite 787\nWehnerberg, WY 89346', 'rerum', 'Iste rem non eos. Voluptatem fuga temporibus voluptatum aspernatur voluptatem id. Nemo quo nemo sint rem. Est ratione minus dolores accusamus.', 42182988, 34348587, 'Mollitia officia recusandae natus atque quia totam.', 3, 71, 'Consequatur non omnis illum perferendis blanditiis quo cum. Sint provident molestiae dicta magnam. Autem quia at deserunt consequatur id minus laudantium.', 'https://via.placeholder.com/640x480.png/005533?text=ipsa', '292519924', '2024-06-27 12:47:09', '2024-06-27 12:47:09');
INSERT INTO `pengajuan` VALUES (67, 19, 'Mr. Muhammad Tromp II', '6068301507538928', '51683 Alexandrine Mills Apt. 487\nNannieview, MN 82518', 'https://via.placeholder.com/640x480.png/0044aa?text=suscipit', 'Feil-Turner', '665 Hudson Island Suite 597\nOrnview, AK 19962-6230', 'veniam', 'Atque ut itaque non laudantium quas et qui. Deserunt sunt consequatur et enim consequatur omnis aut. Modi quod explicabo sint. Rerum sed necessitatibus possimus repellendus aliquid.', 43669577, 77704831, 'Ad labore et voluptates et iste in animi.', 1, 83, 'Est praesentium officia dolor ex quod numquam sint. Qui laudantium commodi facilis necessitatibus.', 'https://via.placeholder.com/640x480.png/007766?text=voluptatem', '83014354', '2024-06-27 12:47:09', '2024-06-27 12:47:09');
INSERT INTO `pengajuan` VALUES (68, 5, 'Janiya Herzog', '0283729704574102', '573 Morgan Garden Apt. 300\nBorerfurt, GA 37473-1428', 'https://via.placeholder.com/640x480.png/0077cc?text=aut', 'Ferry-Gibson', '16547 Toy Place\nD\'Amoretown, DE 14695', 'tempore', 'Minus cum quisquam deserunt sit voluptas. Animi sed magnam dolor sunt veniam. Nostrum consequatur laborum consequatur asperiores commodi voluptas dolor.', 58905951, 83578246, 'Quia voluptatem vel perspiciatis aut inventore tempora.', 7, 57, 'Sunt nam vel alias ipsa labore error et. Porro eius error vero ut molestias.', 'https://via.placeholder.com/640x480.png/00cc77?text=ut', '69293149', '2024-06-27 12:47:09', '2024-06-27 12:47:09');
INSERT INTO `pengajuan` VALUES (69, 20, 'Prof. Donny Abbott', '4905573312488828', '20773 Chris Lakes\nLake Evansport, MO 00185-8170', 'https://via.placeholder.com/640x480.png/00bb44?text=eveniet', 'Kuhn-Carroll', '270 Melyssa Run\nNorth Tanner, FL 17234', 'velit', 'Commodi error aspernatur non itaque et molestias tempore. Distinctio quae dolor aut sed aut quas iusto. Doloribus ea illo ut ad praesentium. Odio aut molestias voluptatem est. Accusamus sunt accusamus omnis repellendus quod consequatur numquam.', 98599181, 97466946, 'Veritatis quae quia asperiores aut blanditiis.', 6, 15, 'Maiores quibusdam ullam laudantium quis dolorem voluptas. Ab illum voluptates consequatur adipisci. Omnis cumque laboriosam omnis consequatur dolores. Voluptas voluptas est ad exercitationem labore est est ea.', 'https://via.placeholder.com/640x480.png/00ff11?text=omnis', '27540574', '2024-06-27 12:47:09', '2024-06-27 12:47:09');
INSERT INTO `pengajuan` VALUES (71, 17, 'Leta Maggio PhD', '6951950559041600', '230 Tomas Points Apt. 118\nBrainfurt, HI 75103-9044', 'https://via.placeholder.com/640x480.png/005511?text=et', 'Tromp-Harris', '3666 Erdman Square Suite 234\nSpencerbury, IN 92828', 'maxime', 'Quas natus nam quia dicta minima. Omnis architecto veniam praesentium voluptas vitae rem. Nemo ea aliquam velit ullam ullam quam occaecati. A in non est porro.', 99961886, 34043080, 'Sunt omnis et enim est quas.', 3, 90, 'Ducimus nulla commodi consequatur aut incidunt quia reiciendis. Et cumque temporibus maiores ducimus provident officiis. Quod qui possimus quis quis eos provident. Id sint autem et non ipsum.', 'https://via.placeholder.com/640x480.png/001100?text=hic', '98306683', '2024-06-27 12:47:09', '2024-06-27 12:47:09');
INSERT INTO `pengajuan` VALUES (76, 12, 'Miss Clarissa Kassulke Jr.', '2008395528815084', '564 Lang Islands\nEast Lilaton, NV 07898', 'https://via.placeholder.com/640x480.png/003322?text=perspiciatis', 'Bartoletti PLC', '62234 Cortez Shore\nBreitenbergport, CO 82429', 'quod', 'Consequuntur dicta assumenda soluta aperiam repellendus libero. Molestiae consectetur sint nemo sit. Illum dolorem corporis tempore quo odit sequi eius.', 98537060, 78584056, 'Itaque corrupti quibusdam ut esse hic.', 12, 95, 'Consequatur eius cumque id iure sit rerum incidunt. Exercitationem animi fugiat commodi odit quam qui porro. Et odio corporis repellat animi quo.', 'https://via.placeholder.com/640x480.png/00bb00?text=ut', '187186657', '2024-06-27 12:47:09', '2024-06-27 12:47:09');
COMMIT;

-- ----------------------------
-- Table structure for review
-- ----------------------------
DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pengajuan_id` bigint unsigned NOT NULL,
  `statusPengajuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of review
-- ----------------------------
BEGIN;
INSERT INTO `review` VALUES (1, 1, 'FULFILL', '2024-06-24 22:22:09', '2024-06-26 21:48:19');
INSERT INTO `review` VALUES (2, 3, 'DONE', '2024-06-25 05:50:20', '2024-06-26 20:26:41');
INSERT INTO `review` VALUES (3, 4, 'FULFILL', '2024-06-27 11:32:54', '2024-06-27 12:21:29');
INSERT INTO `review` VALUES (4, 5, 'ACCEPT', '2024-06-27 12:33:16', '2024-06-27 12:33:31');
INSERT INTO `review` VALUES (5, 68, 'ACCEPT', NULL, NULL);
INSERT INTO `review` VALUES (6, 66, 'ACCEPT', NULL, NULL);
INSERT INTO `review` VALUES (7, 60, 'ACCEPT', NULL, NULL);
INSERT INTO `review` VALUES (8, 56, 'ACCEPT', NULL, NULL);
INSERT INTO `review` VALUES (9, 76, 'ACCEPT', NULL, NULL);
INSERT INTO `review` VALUES (10, 59, 'ACCEPT', NULL, NULL);
INSERT INTO `review` VALUES (11, 58, 'ACCEPT', NULL, NULL);
INSERT INTO `review` VALUES (12, 71, 'ACCEPT', NULL, NULL);
INSERT INTO `review` VALUES (13, 67, 'ACCEPT', NULL, NULL);
INSERT INTO `review` VALUES (14, 69, 'ACCEPT', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
INSERT INTO `sessions` VALUES ('G4fhISYDDRRhn7DC0EejAppiNsGCOxG5vdQpxvkd', 4, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNU1BUUdZVTROSWQ5WmxjMEdWZjNRZjJXaFFMVmYyVGppS0ROOVdndiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wZW1vZGFsIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3MTk0ODcwOTg7fX0=', 1719492186);
INSERT INTO `sessions` VALUES ('h8JmIyIqZ9yCsA7IG8f3QwlVj7bLmnDiMEu4awfh', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOUtjYmlpSUQyR05UMW1wbWxORlVvck9TTEw4QjJaNHpJaFVyQ3pwQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MjM5OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvcGVtb2RhbC9zdWIvc2hvdy9leUpwZGlJNklubHdUa3hNWVZvemJrVnVaMVZIUzFCbVVWRlRNSGM5UFNJc0luWmhiSFZsSWpvaVprbFBlQzlITm5kd1lYSlJSa2hDUm1WNlFqVnFkejA5SWl3aWJXRmpJam9pWmpCa01UVm1NalpqWlRNeVltWXhNMlZsTXpNek1HTXlNREkwWmpRMk9HWXdPV0V6WkdabU4yRXlNelF6Wmpnek5UaGpOV0ZrTkdRd01HUTBOR1l4WWlJc0luUmhaeUk2SWlKOSI7fX0=', 1719493925);
COMMIT;

-- ----------------------------
-- Table structure for status_pendanaan
-- ----------------------------
DROP TABLE IF EXISTS `status_pendanaan`;
CREATE TABLE `status_pendanaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pendanaan_id` bigint unsigned NOT NULL,
  `statusPendanaan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of status_pendanaan
-- ----------------------------
BEGIN;
INSERT INTO `status_pendanaan` VALUES (5, 1, 'ACCEPT', '2024-06-27 11:38:10', '2024-06-27 11:38:29');
INSERT INTO `status_pendanaan` VALUES (6, 2, 'REJECT', '2024-06-27 11:38:48', '2024-06-27 11:45:19');
INSERT INTO `status_pendanaan` VALUES (7, 3, 'ACCEPT', '2024-06-27 11:39:19', '2024-06-27 11:48:01');
INSERT INTO `status_pendanaan` VALUES (8, 4, 'ACCEPT', '2024-06-27 11:47:47', '2024-06-27 11:48:05');
INSERT INTO `status_pendanaan` VALUES (9, 5, 'ACCEPT', '2024-06-27 11:50:30', '2024-06-27 12:27:23');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pemodal',
  `noTelp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Admin', 'admin', 'admin@example.com', '2024-06-17 14:41:40', '$2y$12$QpvhJ4xI/EDAINjjIbhgV.ghBClO5dPe9vV2cxn0VPCiRb9.O8a0a', 'QTo5SHb2QdS1HacOfMmMUpA3rFxx9maEywE83iQBwl7BlJvWpYJ4dtS4Z9qr', '2024-06-17 14:41:41', '2024-06-24 05:47:24', 'pemodal', '088290224278');
INSERT INTO `users` VALUES (4, 'Rifki', 'Shidiq', 'rifkialfarizshidiq.1@gmail.com', NULL, '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', 'ghtkLG2tca3rQ1JjF6jPPU715vWjOQVh03PGD2REYkJZYxSmyh3eQ51aLTCr', '2024-06-19 17:18:06', '2024-06-25 08:57:01', 'admin', '088290224278');
INSERT INTO `users` VALUES (5, 'test', 'pemilik usaha', 'test@example.ccom', NULL, '$2y$12$ZYBVBWjZrL7ahvqGzDG8FubDXGCOIafsEZCJg9Rq8eiPG8yXFxo/u', NULL, '2024-06-24 05:49:01', '2024-06-24 10:17:51', 'pelaku_usaha', '088290223232');
INSERT INTO `users` VALUES (6, 'TEST2', 'TEST', 'test@example2.com', NULL, '$2y$12$51PQERtzz1FWRVyFf7fz1e4.axvFW8ZpVAslU3o6Ag8AR9AESA5YO', NULL, '2024-06-24 10:13:26', '2024-06-24 10:17:35', 'pelaku_usaha', '08829022322');
INSERT INTO `users` VALUES (7, 'asfasf', 'sasfa', 'rifkialfarizshidiq.1@gmail.com2', NULL, '$2y$12$oh0qGQLzGfGE/5vzgRuyIOUx9bVXE43YUFPk4dZFNkpPkp.VSmDVq', NULL, '2024-06-24 10:17:20', '2024-06-24 10:17:20', 'pemodal', '231322313213');
INSERT INTO `users` VALUES (8, 'Rifki Shidi', '', 'rifkialfarizshidiq.2@gmail.com', NULL, '$2y$12$zncDCn8UTs1Do9WXkKreN.0z3rRjjF4J172FP.dcOZ2CDINu1rUCi', NULL, '2024-06-24 19:30:35', '2024-06-24 19:30:35', 'pelaku_usaha', '088290224278');
INSERT INTO `users` VALUES (10, 'Pemodal', 'pemodal', 'pemodal@example.com', '2024-06-25 14:54:07', '$2y$12$q8wUsVZ4iHkAuUjlqTP/Qusyqki4.8HJBwWGH410kIwD.ofkOeHqa', 'P61RsXAqy7thRp85z0R6cqGhwzkIiK0N0HkLEIMnHDAN9OlYEAh3d39kGb3k', '2024-06-25 14:54:07', '2024-06-25 14:54:07', 'pemodal', '11111111111');
INSERT INTO `users` VALUES (11, 'Pemilik', 'Usaha', 'pemilik_usaha@example.com', '2024-06-25 14:54:07', '$2y$12$j2T6nOkKqRhklXa0segx2eLH7HT6KxRNeM02iHZFQp3P6y4dQXen2', 'hhsR8VTT19', '2024-06-25 14:54:07', '2024-06-25 14:54:07', 'pelaku_usaha', '11111111111');
INSERT INTO `users` VALUES (12, 'test', 'pemodal', 'pemodal@example2.com', NULL, '$2y$12$L7NeFc.JCponRyfN4ZwnhOtnf9J//wDt56w109knwZpA7sMPYqkce', NULL, '2024-06-27 11:20:23', '2024-06-27 11:20:23', 'pelaku_usaha', NULL);
INSERT INTO `users` VALUES (14, 'Dr. Bessie Lang', NULL, 'bergnaum.randi@example.org', '2024-06-27 11:29:03', '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', 'koLwyuaK2O', '2024-06-27 11:29:06', '2024-06-27 11:29:06', 'pelaku_usaha', NULL);
INSERT INTO `users` VALUES (15, 'Dr. Arielle Rice DDS', NULL, 'randi.haag@example.net', '2024-06-27 11:29:03', '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', 'XvUrhHG399yw52NloNis0O8byKUSIaGLErcfIWZUo8KvMum4qjzcLaHQ0lpt', '2024-06-27 11:29:06', '2024-06-27 11:29:06', 'pelaku_usaha', NULL);
INSERT INTO `users` VALUES (16, 'Mrs. Sydnee Abernathy Jr.', NULL, 'haley.dorothea@example.com', '2024-06-27 11:29:03', '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', '1zGkQTxcIG', '2024-06-27 11:29:06', '2024-06-27 11:29:06', 'pelaku_usaha', NULL);
INSERT INTO `users` VALUES (17, 'Angelita Jast', NULL, 'dominic87@example.com', '2024-06-27 11:29:04', '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', 'L8EW1umMQx', '2024-06-27 11:29:06', '2024-06-27 11:29:06', 'pelaku_usaha', NULL);
INSERT INTO `users` VALUES (18, 'Camren Homenick', NULL, 'morissette.murl@example.com', '2024-06-27 11:29:04', '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', 'CNbsuAkUqUjwALYyl0fb2niDqmcffakyIPdPE3LX8pQqwBCtH439VOntDapx', '2024-06-27 11:29:06', '2024-06-27 11:29:06', 'pelaku_usaha', NULL);
INSERT INTO `users` VALUES (19, 'Ruby Franecki', NULL, 'hmann@example.com', '2024-06-27 11:29:04', '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', 'SRUTjpbUu0', '2024-06-27 11:29:06', '2024-06-27 11:29:06', 'pelaku_usaha', NULL);
INSERT INTO `users` VALUES (20, 'Demario Wilkinson', NULL, 'iblanda@example.net', '2024-06-27 11:29:05', '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', '45A17FtsDa', '2024-06-27 11:29:06', '2024-06-27 11:29:06', 'pemodal', NULL);
INSERT INTO `users` VALUES (21, 'Katelyn Gibson', NULL, 'shea76@example.com', '2024-06-27 11:29:05', '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', 'FhuWAkaXkp', '2024-06-27 11:29:06', '2024-06-27 11:29:06', 'pemodal', NULL);
INSERT INTO `users` VALUES (22, 'Katelin Olson', NULL, 'kattie.langosh@example.com', '2024-06-27 11:29:05', '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', 'lPAxqvbWdE', '2024-06-27 11:29:06', '2024-06-27 11:29:06', 'pemodal', NULL);
INSERT INTO `users` VALUES (23, 'Valentine Keebler Jr.', NULL, 'vstracke@example.net', '2024-06-27 11:29:05', '$2y$12$abjltJ7njNCwJnm701tv/uSBeFH.RJzJHXUQeUUWFEy7F7lUKkv9a', 'xx8dsFycGI', '2024-06-27 11:29:06', '2024-06-27 11:29:06', 'pemodal', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
