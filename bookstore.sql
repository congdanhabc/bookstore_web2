-- --------------------------------------------------------
-- Máy chủ:                      127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Phiên bản:           12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bookstore
CREATE DATABASE IF NOT EXISTS `bookstore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bookstore`;

-- Dumping structure for table bookstore.authors
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore.authors: ~10 rows (approximately)
DELETE FROM `authors`;
INSERT INTO `authors` (`id`, `name`) VALUES
	(1, 'Nguyễn Nhật Ánh'),
	(2, 'Tô Hoài'),
	(3, 'Vũ Trọng Phụng'),
	(4, 'Nam Cao'),
	(5, 'Xuân Diệu'),
	(6, 'Nguyễn Du'),
	(7, 'Kim Lân'),
	(8, 'Hồ Chí Minh'),
	(9, 'Trần Dần'),
	(10, 'Lỗ Tấn');

-- Dumping structure for table bookstore.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` decimal(10,3) DEFAULT 0.000,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `publisher_id` int(11) NOT NULL,
  `sale_price` decimal(10,3) NOT NULL DEFAULT 0.000,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 100,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `publish_year` year(4) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `cover_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_category_id` (`category_id`),
  KEY `fk_products_publisher_id` (`publisher_id`),
  KEY `fk_products_author_id` (`author_id`),
  CONSTRAINT `fk_products_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_products_publisher_id` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore.books: ~10 rows (approximately)
DELETE FROM `books`;
INSERT INTO `books` (`id`, `name`, `slug`, `price`, `image`, `description`, `publisher_id`, `sale_price`, `category_id`, `author_id`, `stock`, `created_at`, `updated_at`, `publish_year`, `size`, `page`, `cover_type`) VALUES
	(1, 'Mắt Biếc', 'mat-biec', 95000.000, 'matbiec.jpg', 'Một câu chuyện tình buồn man mác của Nguyễn Nhật Ánh.', 1, 85500.000, 1, 1, 50, '2025-02-25 10:58:28', '2025-03-04 02:51:28', NULL, NULL, NULL, NULL),
	(2, 'Dế Mèn Phiêu Lưu Ký', 'de-men-phieu-luu-ky', 80000.000, 'demen.jpg', 'Cuộc phiêu lưu đầy thú vị của chú dế Mèn.', 2, 65000.000, 1, 2, 75, '2025-02-25 10:58:28', '2025-03-04 02:53:07', NULL, NULL, NULL, NULL),
	(3, 'Số Đỏ', 'so-do', 120000.000, 'sodo.jpg', 'Một tác phẩm trào phúng nổi tiếng của Vũ Trọng Phụng.', 3, 90000.000, 1, 3, 30, '2025-02-25 10:58:28', '2025-03-04 02:53:09', NULL, NULL, NULL, NULL),
	(4, 'Chí Phèo', 'chi-pheo', 75000.000, 'chipheo.jpg', 'Chí Phèo - tập truyện ngắn tái hiện bức tranh chân thực nông thôn Việt Nam trước 1945, nghèo đói, xơ xác trên con đường phá sản, bần cùng, hết sức thê thảm, người nông dân bị đẩy vào con đường tha hóa, lưu manh hóa. Nam Cao không hề bôi nhọ người nông dân, trái lại nhà văn đi sâu vào nội tâm nhân vật để khẳng định nhân phẩm và bản chất lương thiện ngay cả khi bị vùi dập, cướp mất cà nhân hình, nhân tính của người nông dân, đồng thời kết án đanh thép cái xã hội tàn bạo đó trước 1945.\r\n\r\nNhững sáng tác của Nam Cao ngoài giá trị hiện thực sâu sắc, các tác phẩm đi sâu vào nội tâm nhân vật, để lại những cảm xúc sâu lắng trong lòng người đọc.', 3, 60000.000, 3, 4, 40, '2025-02-25 10:58:28', '2025-03-18 02:57:45', '2017', '13 x 20.5', 332, 'Bìa mềm'),
	(5, 'Nhật Ký Trong Tù', 'nhat-ky-trong-tu', 110000.000, 'nhatkytrongtu.jpg', 'Tuyển tập thơ đầy cảm xúc của Hồ Chí Minh.', 3, 110000.000, 5, 8, 60, '2025-02-25 10:58:28', '2025-03-04 02:53:56', NULL, NULL, NULL, NULL),
	(6, 'Lão Hạc', 'lao-hac', 65000.000, 'laohac.webp', 'Lão Hạc là một người nông dân chất phác, hiền lành. Vợ lão mất sớm, lão còn có một người con trai nhưng vì quá nghèo nên không thể lấy vợ cho con. Sau này, người con gái mà con trai lão yêu thương hết mực ấy lại lấy con trai một ông phó lí, nhà có của. Hắn vì phẫn chí đã rời bỏ quê hương để đến đồn điền cao su làm ăn kiếm tiền theo công-ta (hợp đồng). Lão Hạc luôn trăn trở, suy nghĩ về tương lai của đứa con. Lão sống bằng nghề làm vườn, mảnh vườn mà vợ lão đã mất bao công sức để mua về và để lại cho con trai lão.\r\n\r\nLão có một con chó tên là Vàng – con chó do con trai lão trước khi đi đồn điền cao su đã để lại. Lão coi nó như một người thân trong gia đình. Lão gọi nó là "cậu Vàng" và rất mực yêu thương nó. Tuy nhiên, vì gia cảnh nghèo khó lại còn trải qua một trận ốm nặng, lão đã kiệt quệ, không còn sức để nuôi nổi bản thân, huống chi là còn có thêm một con chó. Vì muốn giữ mảnh vườn cho con nên ông lão đành cắn răng bán "cậu Vàng" đi. Lão đã rất dằn vặt bản thân khi mang một "tội lỗi" là đã nỡ tâm "lừa một con chó". Lão đã khóc rất nhiều với ông giáo (người hàng xóm thân thiết của lão, và cũng là một người tri thức nghèo). Nhưng cũng kể từ đó, lão sống khép kín, lủi thủi một mình.', 3, 58500.000, 3, 7, 55, '2025-02-25 10:58:28', '2025-03-18 02:57:15', '2022', '13.5 x 20.5cm', 200, 'Bìa mềm'),
	(7, 'Tam Quốc Diễn Nghĩa', 'tam-quoc-dien-nghia', 250000.000, 'tamquoc.jpg', 'Bộ tiểu thuyết lịch sử kinh điển của Trung Quốc.', 2, 250000.000, 2, 5, 25, '2025-02-25 10:58:28', '2025-03-04 02:53:43', NULL, NULL, NULL, NULL),
	(8, 'Đắc Nhân Tâm', 'dac-nhan-tam', 150000.000, 'dacnhantam.jpg', 'Sách về kỹ năng giao tiếp và ứng xử.', 1, 135000.000, 6, 4, 80, '2025-02-25 10:58:28', '2025-03-04 02:51:49', NULL, NULL, NULL, NULL),
	(9, 'Cha Giàu Cha Nghèo', 'cha-giau-cha-ngheo', 180000.000, 'chagiauchangheo.jpg', 'Sách về tư duy tài chính và đầu tư.', 1, 180000.000, 7, 3, 70, '2025-02-25 10:58:28', '2025-03-18 02:51:55', '2018', '13x19cm', 372, 'Bìa mềm'),
	(10, 'Sử Ký Tư Mã Thiên', 'su-ky-tu-ma-thien', 300000.000, 'suky.jpg', 'Bộ sử đồ sộ của Trung Quốc.', 3, 200000.000, 8, 5, 20, '2025-02-25 10:58:28', '2025-03-04 02:53:15', NULL, NULL, NULL, NULL);

-- Dumping structure for table bookstore.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_carts_user_id` (`user_id`),
  CONSTRAINT `fk_carts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore.carts: ~3 rows (approximately)
DELETE FROM `carts`;
INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2025-02-25 10:58:28', '2025-02-25 10:58:28'),
	(2, 2, '2025-02-25 10:58:28', '2025-02-25 10:58:28'),
	(3, 3, '2025-02-25 10:58:28', '2025-02-25 10:58:28');

-- Dumping structure for table bookstore.cart_items
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_items_cart_id` (`cart_id`),
  KEY `fk_cart_items_product_id` (`product_id`),
  CONSTRAINT `fk_cart_items_cart_id` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cart_items_product_id` FOREIGN KEY (`product_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore.cart_items: ~4 rows (approximately)
DELETE FROM `cart_items`;
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `price`) VALUES
	(1, 1, 2, 2, 80000.000),
	(2, 1, 5, 1, 110000.000),
	(3, 2, 1, 1, 95000.000),
	(4, 3, 3, 3, 130000.000);

-- Dumping structure for table bookstore.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore.categories: ~8 rows (approximately)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `name`, `slug`, `description`) VALUES
	(1, 'Văn học Việt Nam', 'van-hoc-viet-nam', 'Các tác phẩm văn học kinh điển và hiện đại của Việt Nam.'),
	(2, 'Văn học Nước Ngoài', 'van-hoc-nuoc-ngoai', 'Các tác phẩm văn học dịch từ các quốc gia khác.'),
	(3, 'Truyện Ngắn', 'truyen-ngan', 'Tuyển tập truyện ngắn của các tác giả.'),
	(4, 'Tiểu Thuyết', 'tieu-thuyet', 'Các tác phẩm tiểu thuyết dài.'),
	(5, 'Thơ', 'tho', 'Các tuyển tập thơ.'),
	(6, 'Kỹ Năng Sống', 'ky-nang-song', 'Sách về các kỹ năng mềm và phát triển bản thân.'),
	(7, 'Kinh Tế', 'kinh-te', 'Sách về kinh tế, tài chính và đầu tư.'),
	(8, 'Lịch Sử', 'lich-su', 'Sách về lịch sử Việt Nam và thế giới.');

-- Dumping structure for table bookstore.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,3) NOT NULL,
  `shipping_address` text NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_orders_user_id` (`user_id`),
  CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore.orders: ~2 rows (approximately)
DELETE FROM `orders`;
INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `shipping_address`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 225000.000, '123 Đường ABC, Quận 1, TP.HCM', 'COD', 'delivered', '2025-02-25 10:58:28', '2025-02-25 10:58:28'),
	(2, 2, 153000.000, '456 Đường XYZ, Quận 3, TP.HCM', 'Credit Card', 'shipped', '2025-02-25 10:58:28', '2025-02-25 10:58:28');

-- Dumping structure for table bookstore.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_items_order_id` (`order_id`),
  KEY `fk_order_items_product_id` (`product_id`),
  CONSTRAINT `fk_order_items_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_order_items_product_id` FOREIGN KEY (`product_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore.order_items: ~5 rows (approximately)
DELETE FROM `order_items`;
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(1, 1, 1, 1, 85500.000),
	(2, 1, 4, 1, 67500.000),
	(3, 1, 6, 1, 72000.000),
	(4, 2, 2, 1, 72000.000),
	(5, 2, 8, 1, 81000.000);

-- Dumping structure for table bookstore.publishers
CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore.publishers: ~5 rows (approximately)
DELETE FROM `publishers`;
INSERT INTO `publishers` (`id`, `name`, `address`, `phone`, `email`) VALUES
	(1, 'Nhà Xuất Bản Trẻ', '161B Lý Chính Thắng, P.7, Q.3, TP. Hồ Chí Minh', '028.38437488', 'info@nhaxuatbantre.vn'),
	(2, 'Nhà Xuất Bản Kim Đồng', '248 Cống Quỳnh, P. Phạm Ngũ Lão, Q.1, TP. Hồ Chí Minh', '028.38294229', 'info@nxbkimdong.com.vn'),
	(3, 'Nhà Xuất Bản Văn Học', '18 Nguyễn Trường Tộ, Ba Đình, Hà Nội', '024.37332446', 'vanhoc18ntt@gmail.com'),
	(4, 'Nhà Xuất Bản Lao Động', '175 Giảng Võ, Đống Đa, Hà Nội', '024.35121914', 'nhaxuatbanlaodong@gmail.com'),
	(5, 'Nhà Xuất Bản Phụ Nữ Việt Nam', '39 Hàng Chuối, Hoàn Kiếm, Hà Nội', '024.38252340', 'info@nxbphunu.com.vn');

-- Dumping structure for table bookstore.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore.users: ~3 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `phone`, `created_at`, `updated_at`) VALUES
	(1, 'Nguyễn Văn An', 'an.nguyen@example.com', '$2y$10$abcdefghijklmnopqrstuvwxysdfasdfasdf', '123 Đường ABC, Quận 1, TP.HCM', '0901234567', '2025-02-25 10:58:28', '2025-02-25 10:58:28'),
	(2, 'Trần Thị Bình', 'binh.tran@example.com', '$2y$10$abcdefghijklmnopqrstuvwxysdfasdfasdf', '456 Đường XYZ, Quận 3, TP.HCM', '0918765432', '2025-02-25 10:58:28', '2025-02-25 10:58:28'),
	(3, 'Lê Văn Cường', 'cuong.le@example.com', '$2y$10$abcdefghijklmnopqrstuvwxysdfasdfasdf', '789 Đường QRS, Bình Thạnh, TP.HCM', '0987123456', '2025-02-25 10:58:28', '2025-02-25 10:58:28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
