-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.11-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk ud
CREATE DATABASE IF NOT EXISTS `ud` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ud`;

-- membuang struktur untuk table ud.cashes
CREATE TABLE IF NOT EXISTS `cashes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify` enum('y','n') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.cashes: ~2 rows (lebih kurang)
INSERT INTO `cashes` (`id`, `name`, `count`, `desc`, `verify`, `created_at`, `updated_at`) VALUES
	(1, 'kas', 300000, 'produk roti laku 4', 'n', '2024-01-04 23:08:22', '2024-01-04 23:09:38'),
	(2, 'kas', 5500000, 'barang terjual 4', 'y', '2024-01-05 02:01:16', '2024-01-05 02:01:44');

-- membuang struktur untuk table ud.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.failed_jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table ud.materialcategories
CREATE TABLE IF NOT EXISTS `materialcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.materialcategories: ~3 rows (lebih kurang)
INSERT INTO `materialcategories` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
	(4, 'kg', 'kilogram', '2024-01-05 19:47:28', '2024-01-05 19:47:28'),
	(5, 'l', 'liter', '2024-01-05 19:47:39', '2024-01-05 19:47:39'),
	(6, 'pack', 'pack', '2024-01-05 22:46:13', '2024-01-05 22:46:13');

-- membuang struktur untuk table ud.materials
CREATE TABLE IF NOT EXISTS `materials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `material_category` int(11) NOT NULL,
  `expired` date NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.materials: ~11 rows (lebih kurang)
INSERT INTO `materials` (`id`, `name`, `code_material`, `stock`, `material_category`, `expired`, `price`, `created_at`, `updated_at`) VALUES
	(2, 'tepung terigu', 'bunga', 3, 4, '2024-01-30', 10000, '2024-01-05 20:24:02', '2024-01-05 21:08:17'),
	(4, 'pewarna', 'biru', 16, 4, '2024-01-30', 2000, '2024-01-08 18:56:49', '2024-01-09 21:59:05'),
	(12, 'coklat', 'milo', 2, 4, '2024-01-23', 4000, '2024-01-08 20:51:11', '2024-01-08 20:51:11'),
	(14, 'pewarna', 'hitam', 6, 6, '2024-01-30', 2000, '2024-01-09 01:50:37', '2024-01-09 21:59:06'),
	(16, 'bumbu', 'rendang', 2, 4, '2024-01-25', 4000, '2024-01-09 18:06:45', '2024-01-09 18:06:45'),
	(17, 'bumbu', 'pecel', 2, 34, '2024-01-23', 6000, '2024-01-09 18:06:45', '2024-01-10 01:39:47'),
	(18, 'bumbu', 'rawon', 2, 4, '2024-01-17', 3000, '2024-01-09 20:32:23', '2024-01-09 20:32:23'),
	(19, 'bumbu', 'bakso', 2, 3, '2024-01-16', 4000, '2024-01-09 20:32:23', '2024-01-09 20:32:23'),
	(20, 'bawang', 'merah', 12, 4, '2024-01-30', 12000, '2024-01-09 23:40:53', '2024-01-09 23:40:53'),
	(21, 'bawang', 'putih', 13, 4, '2024-01-30', 13000, '2024-01-09 23:40:54', '2024-01-09 23:40:54'),
	(22, 'bawang', 'bombay', 14, 4, '2024-01-30', 14000, '2024-01-09 23:40:54', '2024-01-09 23:40:54'),
	(23, 'daging', 'ayam', 10, 4, '2024-01-24', 10000, '2024-01-10 01:34:44', '2024-01-10 01:39:48');

-- membuang struktur untuk table ud.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.migrations: ~11 rows (lebih kurang)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_01_05_031134_create_materials_table', 1),
	(6, '2024_01_05_031206_create_materialcategories_table', 1),
	(7, '2024_01_05_031229_create_promos_table', 1),
	(8, '2024_01_05_031300_create_cashes_table', 1),
	(9, '2024_01_05_031410_create_tr_sales_table', 1),
	(10, '2024_01_05_031423_create_tr_buys_table', 1),
	(14, '2024_01_05_031449_create_tr_productions_table', 2);

-- membuang struktur untuk table ud.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.password_resets: ~0 rows (lebih kurang)

-- membuang struktur untuk table ud.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.personal_access_tokens: ~61 rows (lebih kurang)
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 3, 'auth_token', '4e92aebeca5c341860b636b652bf7253f6697daa926b96c8224022f0612ebfe3', '["*"]', NULL, '2024-01-11 19:28:13', '2024-01-11 19:28:13'),
	(2, 'App\\Models\\User', 3, 'auth_token', '274fedb821952c2c49da6387310cbc063f708fd1f53db047b8d58935b88e9bf7', '["*"]', '2024-01-11 19:40:11', '2024-01-11 19:29:30', '2024-01-11 19:40:11'),
	(3, 'App\\Models\\User', 3, 'auth_token', '1f37695cdbc534ebc2bd4302e9b7452c6a1821f69e30b44e678d7fdbd16376f7', '["*"]', NULL, '2024-01-11 21:04:21', '2024-01-11 21:04:21'),
	(4, 'App\\Models\\User', 3, 'auth_token', '432191731da806c0491b36aa067184d1ec405eaf1797dc7f26e39b8d77305d09', '["*"]', NULL, '2024-01-11 21:05:43', '2024-01-11 21:05:43'),
	(5, 'App\\Models\\User', 3, 'auth_token', '0b4d90691bc848378cc066258355db6a29dfa06a33a1671cb61fea9528d8a925', '["*"]', NULL, '2024-01-11 22:35:47', '2024-01-11 22:35:47'),
	(6, 'App\\Models\\User', 3, 'auth_token', 'fd6fefdb78123b7e601940074c3b0e581ad50bee6548951c7a4494d12e54745c', '["*"]', NULL, '2024-01-11 22:38:40', '2024-01-11 22:38:40'),
	(7, 'App\\Models\\User', 3, 'auth_token', '9d12f1d03dec9992dedf0dbbda72e94b49edf86388f676b2001a35cb2ccf0295', '["*"]', NULL, '2024-01-11 22:38:49', '2024-01-11 22:38:49'),
	(8, 'App\\Models\\User', 3, 'auth_token', 'a4eb353fe0e28d601cb3e4429b61087f7acd3691f856f7471205ff07c99332fd', '["*"]', NULL, '2024-01-11 22:38:57', '2024-01-11 22:38:57'),
	(9, 'App\\Models\\User', 3, 'auth_token', '554a4f8409f1f4284f977d9097b8882949183dd5a9f0fe1a830308d6af4fc77c', '["*"]', NULL, '2024-01-11 22:39:30', '2024-01-11 22:39:30'),
	(10, 'App\\Models\\User', 3, 'auth_token', '45a90832e8bd8254843b5c4cdb9ffb724df9f6166abba824dd4173795a82ca29', '["*"]', NULL, '2024-01-11 22:39:36', '2024-01-11 22:39:36'),
	(11, 'App\\Models\\User', 3, 'auth_token', '533bd2df142861a1843aba41558a3a629be0f0b8d0137f5fd8f348ccf6fa2097', '["*"]', NULL, '2024-01-11 22:39:56', '2024-01-11 22:39:56'),
	(12, 'App\\Models\\User', 3, 'auth_token', '898ba39f6936082f435f4626c47a89950731e03c75899867f437bf1815cb15e0', '["*"]', NULL, '2024-01-11 22:40:06', '2024-01-11 22:40:06'),
	(13, 'App\\Models\\User', 3, 'auth_token', 'ee2efecbf61f23668e5be447058434881fbc2fda64f074a78fd099e57a4e7040', '["*"]', NULL, '2024-01-11 22:40:21', '2024-01-11 22:40:21'),
	(14, 'App\\Models\\User', 3, 'auth_token', 'b1f7104308e7a9c86390168ab919fc583732fca321182e56398ae3932165c343', '["*"]', NULL, '2024-01-11 22:43:58', '2024-01-11 22:43:58'),
	(15, 'App\\Models\\User', 1, 'auth_token', 'c59c79f18f4746b4e5eeae4ec0e2962e598860c79ece3e87a0209306ce9a1865', '["*"]', NULL, '2024-01-11 22:45:02', '2024-01-11 22:45:02'),
	(16, 'App\\Models\\User', 1, 'auth_token', 'e5f1664693d9f5b1f9edbd32fff71a19f8900fd640c4be6aaaa3601471fbeb08', '["*"]', NULL, '2024-01-11 22:47:16', '2024-01-11 22:47:16'),
	(17, 'App\\Models\\User', 1, 'auth_token', 'df57f536de0e62fa7976a462f4764517e62a24cd3e699320b3c6d49218326306', '["*"]', NULL, '2024-01-11 22:52:34', '2024-01-11 22:52:34'),
	(18, 'App\\Models\\User', 1, 'auth_token', 'a21fcc386dce1bccf43c7c4b4597dfbcfeed5c619b32e46cdd57f81c9b515da0', '["*"]', NULL, '2024-01-11 22:52:51', '2024-01-11 22:52:51'),
	(19, 'App\\Models\\User', 1, 'auth_token', '833fe295b401619e7cef55f8474f8c116777c237c13adae8b222ca37773d3d75', '["*"]', NULL, '2024-01-11 22:53:12', '2024-01-11 22:53:12'),
	(20, 'App\\Models\\User', 1, 'auth_token', '99879a82866fbb0c2727df6e61f40c3e01f6ee0895746335a69b978ba7ab079e', '["*"]', NULL, '2024-01-11 23:10:57', '2024-01-11 23:10:57'),
	(21, 'App\\Models\\User', 3, 'auth_token', 'e3d7f6f50a87de22287ce08b2328280e33f0cbdba8ef884fdcd38960b4860a10', '["*"]', NULL, '2024-01-11 23:23:13', '2024-01-11 23:23:13'),
	(22, 'App\\Models\\User', 1, 'auth_token', 'eef61e7e3e6fd7af7242cf619da18c46bcfd688aae6a7fc8ad047d4e7d93f0dc', '["*"]', NULL, '2024-01-11 23:23:22', '2024-01-11 23:23:22'),
	(23, 'App\\Models\\User', 1, 'auth_token', 'fac4b1a8769d2bfa8950e3206ec7c8e4dad5af4e797c51c14ce3debc52d0bf02', '["*"]', NULL, '2024-01-11 23:27:54', '2024-01-11 23:27:54'),
	(24, 'App\\Models\\User', 1, 'auth_token', 'e28a033134a3f530995ee8ba655925a81c84f2766ecac3f12062b4e15d64e4ab', '["*"]', NULL, '2024-01-11 23:34:04', '2024-01-11 23:34:04'),
	(25, 'App\\Models\\User', 1, 'auth_token', 'db7706dc3a3d94f6b04431f1fb8fb7d63f494875024d50bd562038d7763eb83a', '["*"]', NULL, '2024-01-12 00:21:54', '2024-01-12 00:21:54'),
	(26, 'App\\Models\\User', 1, 'auth_token', '03162a7a4f5fe4c2afee047edf5d04d27783692a5bcea2eca6d1a635392e0368', '["*"]', NULL, '2024-01-12 00:22:37', '2024-01-12 00:22:37'),
	(27, 'App\\Models\\User', 1, 'auth_token', 'f50b4fac19571c10107c6379c4437a19616535c4ceedc1034b3ef670d2aeb07c', '["*"]', NULL, '2024-01-12 00:23:02', '2024-01-12 00:23:02'),
	(28, 'App\\Models\\User', 1, 'auth_token', '09319ba4f59bdf1fc00b484ccb7cabc8a4000c4231c34da76d4dc0e6db116714', '["*"]', NULL, '2024-01-12 00:25:56', '2024-01-12 00:25:56'),
	(29, 'App\\Models\\User', 1, 'auth_token', '1e99b06ff74132beed4aa3f65718e7888a4a1bdfc9c27f44a2e79c34504a0b9e', '["*"]', NULL, '2024-01-12 00:26:45', '2024-01-12 00:26:45'),
	(30, 'App\\Models\\User', 1, 'auth_token', '89eca6b070ee70cd518d660747fd1753a11050bb7f7ef72cb4aa0cb0b0ed35d6', '["*"]', NULL, '2024-01-12 00:27:40', '2024-01-12 00:27:40'),
	(31, 'App\\Models\\User', 3, 'auth_token', '3340b95cf38b9f518fb2dbc74c1ee35cb6b78f8eb89e8f2957dc49b7b8946a8d', '["*"]', NULL, '2024-01-12 00:28:38', '2024-01-12 00:28:38'),
	(32, 'App\\Models\\User', 1, 'auth_token', '1983a4f94feb2958ebe4458e55eda2d949e284b4e853b0acca784829e361b7b3', '["*"]', '2024-01-12 00:39:11', '2024-01-12 00:33:21', '2024-01-12 00:39:11'),
	(33, 'App\\Models\\User', 1, 'auth_token', '48bc05ce1e9e062832cab04d884dda034065799b1588c8d7415a1e6a2f80d500', '["*"]', '2024-01-12 00:41:22', '2024-01-12 00:41:21', '2024-01-12 00:41:22'),
	(34, 'App\\Models\\User', 1, 'auth_token', '548e702f94e13dd82bc20713461565340f7289b988b1e19c98c8e86afa6f8f6e', '["*"]', '2024-01-12 01:19:42', '2024-01-12 00:52:12', '2024-01-12 01:19:42'),
	(35, 'App\\Models\\User', 3, 'auth_token', '5ba9be65650e310391f12f8f49b3823c728e8437211262d2a32b7e5036fd6379', '["*"]', '2024-01-12 01:22:55', '2024-01-12 01:21:11', '2024-01-12 01:22:55'),
	(36, 'App\\Models\\User', 3, 'auth_token', 'f84568fb6bff73f17b56ed390a97392c1e3b76162f1ecc7bba1a2ea23611d426', '["*"]', NULL, '2024-01-12 01:28:10', '2024-01-12 01:28:10'),
	(37, 'App\\Models\\User', 3, 'auth_token', 'fe8b5d91ad80190fcc585c64170fcc2be74df53e0f0a68b58294da9fb85f3fac', '["*"]', NULL, '2024-01-12 01:36:49', '2024-01-12 01:36:49'),
	(38, 'App\\Models\\User', 1, 'auth_token', '6fbb0ddecf9c3bcadb2da61c621d884f89c28204ef2f042dc5825421d9fcd44e', '["*"]', NULL, '2024-01-12 01:36:59', '2024-01-12 01:36:59'),
	(39, 'App\\Models\\User', 1, 'auth_token', '57b7cba333a74b628208619f44f7fb7f7d30501b136e16273908fc27f2b1221d', '["*"]', NULL, '2024-01-12 01:37:28', '2024-01-12 01:37:28'),
	(40, 'App\\Models\\User', 1, 'auth_token', '6b0673f63d4f0d8fc285792b95579a77f10ef786427f994bfcce1473d8cbc3b1', '["*"]', '2024-01-12 01:38:46', '2024-01-12 01:38:46', '2024-01-12 01:38:46'),
	(41, 'App\\Models\\User', 1, 'auth_token', '2f69c933b486da70feb6b09cc612374980d8fc9a16b13f008538b8d81a6f68bf', '["*"]', NULL, '2024-01-12 01:39:40', '2024-01-12 01:39:40'),
	(42, 'App\\Models\\User', 1, 'auth_token', '550edf8ef4718edd097d76ac3909a000b237aa6953f43e6f1fdd78a28b9b65ae', '["*"]', '2024-01-12 01:41:00', '2024-01-12 01:40:10', '2024-01-12 01:41:00'),
	(43, 'App\\Models\\User', 1, 'auth_token', '3e3dcf7d743c57eaf63bae9a1a97925ddf577d24f553b1f5c7a563a7caedd99b', '["*"]', '2024-01-12 01:41:35', '2024-01-12 01:41:34', '2024-01-12 01:41:35'),
	(44, 'App\\Models\\User', 3, 'auth_token', '6e400ff73fac2f00eaa924f0eea0d91c2c959ef32339e3cb61695703962aa4b1', '["*"]', '2024-01-12 01:44:00', '2024-01-12 01:41:41', '2024-01-12 01:44:00'),
	(45, 'App\\Models\\User', 1, 'auth_token', '49737c70cea31152b1b55d179699daaa53d7d3ac73999838f5a61cef74d24cf4', '["*"]', NULL, '2024-01-12 01:44:09', '2024-01-12 01:44:09'),
	(46, 'App\\Models\\User', 3, 'auth_token', '0e0d9078aad4773c6839974f96d89fb73080a55039da07f03bd572a43e0dd413', '["*"]', NULL, '2024-01-12 01:58:27', '2024-01-12 01:58:27'),
	(47, 'App\\Models\\User', 1, 'auth_token', 'cc204f12c799ff6221c2bf0f9af072a7c6ce56fbc1e85b9297142f0f4eb6db50', '["*"]', '2024-01-12 01:58:58', '2024-01-12 01:58:43', '2024-01-12 01:58:58'),
	(48, 'App\\Models\\User', 3, 'auth_token', 'c6daecd6790f874398d0b337e2762673fd7d7130deef4e2bcd6d03604e28500b', '["*"]', NULL, '2024-01-12 02:00:01', '2024-01-12 02:00:01'),
	(49, 'App\\Models\\User', 1, 'auth_token', 'f03454b8f3ff77bad969015469e96bc1dd474a828a556727f221768128fdbd25', '["*"]', '2024-01-12 02:00:30', '2024-01-12 02:00:24', '2024-01-12 02:00:30'),
	(50, 'App\\Models\\User', 3, 'auth_token', 'a9b51d7d921c5fb82c1366fa7ce925f98ca12c8781aa75f1919665e9c451b138', '["*"]', NULL, '2024-01-12 02:03:11', '2024-01-12 02:03:11'),
	(51, 'App\\Models\\User', 6, 'auth_token', '118ef29d9598a89e35885d55a2a5d3feba1300505ee2851662bcb107cfbb3afc', '["*"]', '2024-01-12 02:05:07', '2024-01-12 02:04:18', '2024-01-12 02:05:07'),
	(52, 'App\\Models\\User', 3, 'auth_token', '5a48681a20a83da71c48cb1d6810df94b51708a3ee6d112316a7a3bb5995a443', '["*"]', NULL, '2024-01-12 02:06:03', '2024-01-12 02:06:03'),
	(53, 'App\\Models\\User', 1, 'auth_token', '2344cd67c2ff3ffce6cbda174cdf36c5f533e76ca7f5c9d00c104e0b7fbe9a1f', '["*"]', '2024-01-12 02:06:19', '2024-01-12 02:06:19', '2024-01-12 02:06:19'),
	(54, 'App\\Models\\User', 3, 'auth_token', '54f45e0937eab9b14b0007cbe995960642d5aedc0affc4ecb5ae3506588cc303', '["*"]', NULL, '2024-01-12 02:10:10', '2024-01-12 02:10:10'),
	(55, 'App\\Models\\User', 1, 'auth_token', '98af2b481cd3e807e5ca2a027073fca04820f611f50bf8aeb4051fcb6ffc6493', '["*"]', '2024-01-12 02:10:29', '2024-01-12 02:10:28', '2024-01-12 02:10:29'),
	(56, 'App\\Models\\User', 3, 'auth_token', 'ec3afe218ed6f566178d34cc63b48e167f942a0778fe2e74c7a51ea3b41edf10', '["*"]', NULL, '2024-01-12 02:19:08', '2024-01-12 02:19:08'),
	(57, 'App\\Models\\User', 1, 'auth_token', 'ecb08b76c203c79e5f5050c3d40bc93418aaf69578ac839e96b29c6045163920', '["*"]', '2024-01-12 02:19:27', '2024-01-12 02:19:26', '2024-01-12 02:19:27'),
	(58, 'App\\Models\\User', 1, 'auth_token', '98bdf7eebe79cfa52a6ff1f55cb555cb98118e86e0298a810d8abd8e0e323e7b', '["*"]', NULL, '2024-01-12 17:57:58', '2024-01-12 17:57:58'),
	(59, 'App\\Models\\User', 1, 'auth_token', '78e88af327d25f2da91dc945895c2835c7407a59d4fcbce062285f7c1274e94c', '["*"]', NULL, '2024-01-12 17:59:32', '2024-01-12 17:59:32'),
	(60, 'App\\Models\\User', 3, 'auth_token', 'a7871ca7e91d7db52c4f8ea466f881674ab634fd638e216d24797f409351d6f0', '["*"]', '2024-01-12 18:07:27', '2024-01-12 18:03:47', '2024-01-12 18:07:27'),
	(61, 'App\\Models\\User', 7, 'auth_token', '14d86ed47d52a56c60ab32037f755da388406a2e7127edbb71da589b5e68fdf7', '["*"]', NULL, '2024-01-12 18:25:42', '2024-01-12 18:25:42'),
	(62, 'App\\Models\\User', 3, 'auth_token', '200a265da40450d0800bdbf62c15e14e72f5031396c8aa9857e23a416312e541', '["*"]', NULL, '2024-01-12 18:36:19', '2024-01-12 18:36:19'),
	(63, 'App\\Models\\User', 3, 'auth_token', 'a54a6a9d1f773cff90e893bc4a9bd4de2bc35777cb1d65acfd6b9c4e25c3feab', '["*"]', NULL, '2024-01-12 18:38:16', '2024-01-12 18:38:16'),
	(64, 'App\\Models\\User', 3, 'auth_token', '611d9b2ccd1da1a9588eef16914ca3d4126bb9e156459b1062b72fab71d3d2b9', '["*"]', NULL, '2024-01-12 18:52:29', '2024-01-12 18:52:29'),
	(65, 'App\\Models\\User', 1, 'auth_token', '61e208340290a8ae69ec7fb1ae7530289f9bcdf5850ca34747b8ec02d48c7193', '["*"]', '2024-01-12 20:06:46', '2024-01-12 20:06:27', '2024-01-12 20:06:46'),
	(66, 'App\\Models\\User', 3, 'auth_token', 'bcb15495a24222be0b2fe6745debd4b2970d587cd982f92468440e16b5001928', '["*"]', NULL, '2024-01-12 20:15:28', '2024-01-12 20:15:28'),
	(67, 'App\\Models\\User', 1, 'auth_token', '4dd5c64b19d167c98d9dbc0935d1134752d761265112f56236ff87ae38ab8144', '["*"]', '2024-01-12 20:33:55', '2024-01-12 20:33:18', '2024-01-12 20:33:55'),
	(68, 'App\\Models\\User', 3, 'auth_token', '310ed467d60db8ebcdeb0c08e9b02eb58645242e82034a8d29a78c45db9b28a9', '["*"]', NULL, '2024-01-12 20:34:44', '2024-01-12 20:34:44'),
	(69, 'App\\Models\\User', 1, 'auth_token', 'fb83fa490fbed7eeb82b24e9caeb22f9fda69ab8c47915c1fb32a92ea3f96a07', '["*"]', '2024-01-12 20:39:41', '2024-01-12 20:38:46', '2024-01-12 20:39:41');

-- membuang struktur untuk table ud.promos
CREATE TABLE IF NOT EXISTS `promos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`desc`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.promos: ~2 rows (lebih kurang)
INSERT INTO `promos` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
	(4, 'promo khusus', '{"desc":"khusus member","promo":"50"}', '2024-01-05 22:06:49', '2024-01-07 18:52:35'),
	(5, 'promo spesial', '{"desc":"promo spesial","promo":"20"}', '2024-01-05 22:46:55', '2024-01-07 18:52:50');

-- membuang struktur untuk table ud.tr_buys
CREATE TABLE IF NOT EXISTS `tr_buys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `materials` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`materials`)),
  `date` date NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.tr_buys: ~3 rows (lebih kurang)
INSERT INTO `tr_buys` (`id`, `user`, `materials`, `date`, `price`, `created_at`, `updated_at`) VALUES
	(9, 1, '["{\\"name\\":\\"bumbu\\",\\"code_material\\":\\"rendang\\",\\"stock\\":\\"2\\",\\"material_category\\":\\"4\\",\\"expired\\":\\"2024-01-25\\",\\"price\\":\\"4000\\"}","{\\"name\\":\\"bumbu\\",\\"code_material\\":\\"pecel\\",\\"stock\\":\\"3\\",\\"material_category\\":\\"34\\",\\"expired\\":\\"2024-01-23\\",\\"price\\":\\"6000\\"}"]', '2024-01-10', 10000, '2024-01-09 18:06:46', '2024-01-09 18:06:46'),
	(10, 1, '["{\\"name\\":\\"bumbu\\",\\"code_material\\":\\"rawon\\",\\"stock\\":\\"2\\",\\"material_category\\":\\"4\\",\\"expired\\":\\"2024-01-17\\",\\"price\\":\\"3000\\"}","{\\"name\\":\\"bumbu\\",\\"code_material\\":\\"bakso\\",\\"stock\\":\\"2\\",\\"material_category\\":\\"3\\",\\"expired\\":\\"2024-01-16\\",\\"price\\":\\"4000\\"}"]', '2024-01-19', 7000, '2024-01-09 20:32:24', '2024-01-09 20:32:24'),
	(11, 1, '["{\\"name\\":\\"bawang\\",\\"code_material\\":\\"merah\\",\\"stock\\":\\"12\\",\\"material_category\\":\\"4\\",\\"expired\\":\\"2024-01-30\\",\\"price\\":\\"12000\\"}","{\\"name\\":\\"bawang\\",\\"code_material\\":\\"putih\\",\\"stock\\":\\"13\\",\\"material_category\\":\\"4\\",\\"expired\\":\\"2024-01-30\\",\\"price\\":\\"13000\\"}","{\\"name\\":\\"bawang\\",\\"code_material\\":\\"bombay\\",\\"stock\\":\\"14\\",\\"material_category\\":\\"4\\",\\"expired\\":\\"2024-01-30\\",\\"price\\":\\"14000\\"}"]', '2024-01-10', 39000, '2024-01-09 23:40:54', '2024-01-09 23:40:54');

-- membuang struktur untuk table ud.tr_productions
CREATE TABLE IF NOT EXISTS `tr_productions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materials` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`materials`)),
  `promo` int(11) DEFAULT NULL,
  `expired` date NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.tr_productions: ~3 rows (lebih kurang)
INSERT INTO `tr_productions` (`id`, `name`, `desc`, `materials`, `promo`, `expired`, `stock`, `price`, `picture`, `created_at`, `updated_at`) VALUES
	(4, 'bakso', 'bakso enakk', '["{\\"id\\":\\"2\\",\\"count\\":\\"1\\"}","{\\"id\\":\\"19\\",\\"count\\":\\"1\\"}"]', 5, '2024-01-18', 20, 10000, NULL, '2024-01-09 20:36:16', '2024-01-10 01:11:32'),
	(5, 'tes', 'tess', '["{\\"id\\":\\"4\\",\\"count\\":\\"4\\"}","{\\"id\\":\\"14\\",\\"count\\":\\"4\\"}"]', NULL, '2024-01-19', 30, 2344, NULL, '2024-01-09 21:59:06', '2024-01-10 01:11:33'),
	(6, 'sate', 'sate enakk', '["{\\"id\\":\\"17\\",\\"count\\":\\"1\\"}","{\\"id\\":\\"23\\",\\"count\\":\\"5\\"}"]', 5, '2024-01-17', 25, 500000, NULL, '2024-01-10 01:39:49', '2024-01-10 01:40:40');

-- membuang struktur untuk table ud.tr_sales
CREATE TABLE IF NOT EXISTS `tr_sales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `product` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`product`)),
  `promo` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.tr_sales: ~3 rows (lebih kurang)
INSERT INTO `tr_sales` (`id`, `customer`, `admin`, `product`, `promo`, `date`, `price`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '{"nama":"kopi","jumlah":34}', 1, '2024-01-04', 100000, '2024-01-05 00:34:40', '2024-01-05 00:34:58'),
	(2, 1, 1, '["{\\"id\\":\\"4\\",\\"count\\":\\"2\\"}"]', NULL, '2024-01-10', 1234567, '2024-01-10 00:50:28', '2024-01-10 00:50:28'),
	(3, 1, 1, '["{\\"id\\":\\"4\\",\\"count\\":\\"3\\"}","{\\"id\\":\\"5\\",\\"count\\":\\"2\\"}"]', NULL, '2024-01-10', 432342, '2024-01-10 01:11:34', '2024-01-10 01:11:34'),
	(4, 1, 1, '["{\\"id\\":\\"6\\",\\"count\\":\\"5\\"}"]', NULL, '2024-01-10', 10000, '2024-01-10 01:40:41', '2024-01-10 01:40:41');

-- membuang struktur untuk table ud.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('customer','admin','superadmin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel ud.users: ~6 rows (lebih kurang)
INSERT INTO `users` (`id`, `name`, `email`, `role`, `desc`, `pic`, `password`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@gmail.com', 'admin', 'admin', NULL, '$2y$10$ZYk8wmkI8VActdGBE6ZcCOZ3W58.Wr21rlNwdf1aPKe5WDJbOT2iu', '2024-01-08 20:03:19', '2024-01-08 20:04:14'),
	(3, 'customer', 'customer@gmail.com', 'customer', 'customer', NULL, '$2y$10$ZYk8wmkI8VActdGBE6ZcCOZ3W58.Wr21rlNwdf1aPKe5WDJbOT2iu', '2024-01-11 18:50:53', '2024-01-11 18:50:53'),
	(4, 'nana', 'nana@gmail.com', 'customer', 'customer', 'food.png', '$2y$10$Gd5ZQLD4eEhoPg3DVt7zR.RB/be0PxtX7ln/4hGgEPCcx1ZXe3Cx.', '2024-01-12 00:16:24', '2024-01-12 00:16:24'),
	(5, 'dodi', 'dodi@gmail.com', 'customer', 'customer', 'food.png', '$2y$10$64/IbEocemYznbo1CFArresKxDISalEnIKDB9df7fXRoDaAd0KRTK', '2024-01-12 02:01:19', '2024-01-12 02:01:19'),
	(6, 'edo', 'edo@gmail.com', 'customer', 'edoo', 'food.png', '$2y$10$ZYk8wmkI8VActdGBE6ZcCOZ3W58.Wr21rlNwdf1aPKe5WDJbOT2iu', '2024-01-12 02:02:49', '2024-01-12 02:02:49'),
	(7, 'tes', 'tes@gmail.com', 'customer', 'tesss', 'food.png', '$2y$10$x7cybPnAFvBUah9zPQ5HpuFIMENS5MXBfo/D/ikpX/R65sDY0rhl.', '2024-01-12 18:25:29', '2024-01-12 18:25:29');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
