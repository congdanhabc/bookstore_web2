-- --------------------------------------------------------
-- Máy chủ:                      127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
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


-- Dumping database structure for bookstore1
CREATE DATABASE IF NOT EXISTS `bookstore1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bookstore1`;

-- Dumping structure for table bookstore1.authors
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore1.authors: ~74 rows (approximately)
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
	(10, 'Lỗ Tấn'),
	(11, 'Thạch Lam'),
	(12, 'Nguyễn Tuân'),
	(13, 'Ngô Tất Tố'),
	(14, 'Nguyên Hồng'),
	(15, 'Paulo Coelho'),
	(16, 'Antoine de Saint-Exupéry'),
	(17, 'Haruki Murakami'),
	(18, 'Gabriel Garcia Marquez'),
	(19, 'Harper Lee'),
	(20, 'Mario Puzo'),
	(21, 'Margaret Mitchell'),
	(22, 'Ernest Hemingway'),
	(23, 'Emily Brontë'),
	(24, 'Jane Austen'),
	(25, 'Raymond Murphy'),
	(26, 'Barron\'s Educational Series'),
	(27, 'Nhiều Tác Giả'),
	(28, 'Eckhart Tolle'),
	(29, 'Baird T. Spalding'),
	(30, 'Nguyên Phong'),
	(31, 'Thích Nhất Hạnh'),
	(32, 'Neale Donald Walsch'),
	(33, 'Mark Manson'),
	(34, 'Stephen Covey'),
	(35, 'Napoleon Hill'),
	(36, 'Spencer Johnson'),
	(37, 'George S. Clason'),
	(38, 'Trác Nhã'),
	(39, 'Keith Ferrazzi'),
	(40, 'Rosie Nguyễn'),
	(41, 'Daniel Kahneman'),
	(42, 'Don Watson'),
	(43, 'Steven D. Levitt'),
	(44, 'Song Hongbing'),
	(45, 'Dan Senor'),
	(46, 'Benjamin Graham'),
	(47, 'Jim Collins'),
	(48, 'Nassim Nicholas Taleb'),
	(49, 'Tony Hsieh'),
	(50, 'Eric Ries'),
	(51, 'Al Ries'),
	(52, 'Yuval Noah Harari'),
	(53, 'Ngô Sĩ Liên'),
	(54, 'Jared Diamond'),
	(55, 'Charles Darwin'),
	(56, 'Trần Trọng Kim'),
	(57, 'Stephen Hawking'),
	(58, 'Nguyễn Văn Huyên'),
	(59, 'Tôn Tử'),
	(60, 'Niccolò Machiavelli'),
	(61, 'John Stuart Mill'),
	(62, 'Charles Perrault'),
	(63, 'J.K. Rowling'),
	(64, 'Đào Duy Anh'),
	(65, 'Aristotle'),
	(66, 'La Quán Trung'),
	(67, 'Dale Carnegie'),
	(68, 'Robert Kiyosaki'),
	(69, 'Tư Mã Thiên'),
	(70, 'Don Sexton'),
	(71, 'Philip Kotler'),
	(72, 'Đào Hải'),
	(73, 'Trần Ngọc Thêm'),
	(74, 'Joseph S.Nye');

-- Dumping structure for table bookstore1.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,3) DEFAULT '0.000',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `publisher_id` int NOT NULL,
  `sale_price` decimal(10,3) NOT NULL DEFAULT '0.000',
  `category_id` int NOT NULL,
  `author_id` int NOT NULL,
  `stock` int NOT NULL DEFAULT '100',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publish_year` year DEFAULT NULL,
  `size` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page` int DEFAULT NULL,
  `cover_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_category_id` (`category_id`),
  KEY `fk_products_publisher_id` (`publisher_id`),
  KEY `fk_products_author_id` (`author_id`),
  CONSTRAINT `fk_products_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_products_publisher_id` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore1.books: ~119 rows (approximately)
DELETE FROM `books`;
INSERT INTO `books` (`id`, `name`, `slug`, `price`, `image`, `description`, `publisher_id`, `sale_price`, `category_id`, `author_id`, `stock`, `created_at`, `updated_at`, `publish_year`, `size`, `page`, `cover_type`) VALUES
	(1, 'Mắt Biếc', 'mat-biec', 95000.000, 'matbiec.jpg', 'Một câu chuyện tình buồn man mác của Nguyễn Nhật Ánh.', 1, 85500.000, 1, 1, 50, '2025-02-25 10:58:28', '2025-04-15 01:59:25', '2018', '13 x 20.5cm', 300, 'Bìa mềm'),
	(2, 'Dế Mèn Phiêu Lưu Ký', 'de-men-phieu-luu-ky', 80000.000, 'demen.jpg', 'Cuộc phiêu lưu đầy thú vị của chú dế Mèn.', 2, 65000.000, 1, 2, 75, '2025-02-25 10:58:28', '2025-04-15 01:59:25', '2019', '14 x 20.5cm', 156, 'Bìa mềm'),
	(3, 'Số Đỏ', 'so-do', 120000.000, 'sodo.jpg', 'Một tác phẩm trào phúng nổi tiếng của Vũ Trọng Phụng.', 3, 90000.000, 1, 3, 30, '2025-02-25 10:58:28', '2025-04-15 01:59:25', '2017', '13.5 x 20.5cm', 320, 'Bìa mềm'),
	(4, 'Chí Phèo', 'chi-pheo', 75000.000, 'chipheo.jpg', 'Chí Phèo - tập truyện ngắn tái hiện bức tranh chân thực nông thôn Việt Nam trước 1945, nghèo đói, xơ xác trên con đường phá sản, bần cùng, hết sức thê thảm, người nông dân bị đẩy vào con đường tha hóa, lưu manh hóa. Nam Cao không hề bôi nhọ người nông dân, trái lại nhà văn đi sâu vào nội tâm nhân vật để khẳng định nhân phẩm và bản chất lương thiện ngay cả khi bị vùi dập, cướp mất cà nhân hình, nhân tính của người nông dân, đồng thời kết án đanh thép cái xã hội tàn bạo đó trước 1945.\r\n\r\nNhững sáng tác của Nam Cao ngoài giá trị hiện thực sâu sắc, các tác phẩm đi sâu vào nội tâm nhân vật, để lại những cảm xúc sâu lắng trong lòng người đọc.', 3, 60000.000, 1, 4, 40, '2025-02-25 10:58:28', '2025-04-15 01:35:57', '2017', '13 x 20.5', 332, 'Bìa mềm'),
	(5, 'Nhật Ký Trong Tù', 'nhat-ky-trong-tu', 110000.000, 'nhatkytrongtu.jpg', 'Tuyển tập thơ đầy cảm xúc của Hồ Chí Minh.', 3, 110000.000, 1, 8, 60, '2025-02-25 10:58:28', '2025-04-15 01:59:25', '2015', '11 x 18cm', 210, 'Bìa mềm'),
	(6, 'Lão Hạc', 'lao-hac', 65000.000, 'laohac.webp', 'Lão Hạc là một người nông dân chất phác, hiền lành. Vợ lão mất sớm, lão còn có một người con trai nhưng vì quá nghèo nên không thể lấy vợ cho con. Sau này, người con gái mà con trai lão yêu thương hết mực ấy lại lấy con trai một ông phó lí, nhà có của. Hắn vì phẫn chí đã rời bỏ quê hương để đến đồn điền cao su làm ăn kiếm tiền theo công-ta (hợp đồng). Lão Hạc luôn trăn trở, suy nghĩ về tương lai của đứa con. Lão sống bằng nghề làm vườn, mảnh vườn mà vợ lão đã mất bao công sức để mua về và để lại cho con trai lão.\r\n\r\nLão có một con chó tên là Vàng – con chó do con trai lão trước khi đi đồn điền cao su đã để lại. Lão coi nó như một người thân trong gia đình. Lão gọi nó là "cậu Vàng" và rất mực yêu thương nó. Tuy nhiên, vì gia cảnh nghèo khó lại còn trải qua một trận ốm nặng, lão đã kiệt quệ, không còn sức để nuôi nổi bản thân, huống chi là còn có thêm một con chó. Vì muốn giữ mảnh vườn cho con nên ông lão đành cắn răng bán "cậu Vàng" đi. Lão đã rất dằn vặt bản thân khi mang một "tội lỗi" là đã nỡ tâm "lừa một con chó". Lão đã khóc rất nhiều với ông giáo (người hàng xóm thân thiết của lão, và cũng là một người tri thức nghèo). Nhưng cũng kể từ đó, lão sống khép kín, lủi thủi một mình.', 3, 58500.000, 1, 7, 55, '2025-02-25 10:58:28', '2025-04-15 01:35:53', '2022', '13.5 x 20.5cm', 200, 'Bìa mềm'),
	(7, 'Tam Quốc Diễn Nghĩa', 'tam-quoc-dien-nghia', 250000.000, 'tamquoc.jpg', 'Bộ tiểu thuyết lịch sử kinh điển của Trung Quốc.', 3, 250000.000, 2, 66, 25, '2025-02-25 10:58:28', '2025-04-15 02:08:08', '2020', '16 x 24cm', 1500, 'Bìa cứng'),
	(8, 'Đắc Nhân Tâm', 'dac-nhan-tam', 150000.000, 'dacnhantam.jpg', 'Sách về kỹ năng giao tiếp và ứng xử.', 7, 135000.000, 6, 67, 80, '2025-02-25 10:58:28', '2025-04-15 02:08:08', '2013', '14 x 20.5cm', 320, 'Bìa mềm'),
	(9, 'Cha Giàu Cha Nghèo', 'cha-giau-cha-ngheo', 180000.000, 'chagiauchangheo.jpg', 'Sách về tư duy tài chính và đầu tư.', 1, 180000.000, 7, 68, 70, '2025-02-25 10:58:28', '2025-04-15 02:08:08', '2018', '13x19cm', 372, 'Bìa mềm'),
	(10, 'Sử Ký Tư Mã Thiên', 'su-ky-tu-ma-thien', 300000.000, 'suky.jpg', 'Bộ sử đồ sộ của Trung Quốc.', 3, 200000.000, 2, 69, 20, '2025-02-25 10:58:28', '2025-04-15 02:08:08', '2019', '17 x 24cm', 1200, 'Bìa cứng'),
	(11, 'Gió Lạnh Đầu Mùa', 'gio-lanh-dau-mua', 88000.000, 'gio-lanh.jpg', 'Tuyển tập truyện ngắn của Thạch Lam, nhẹ nhàng và tinh tế, khắc họa vẻ đẹp bình dị của con người và cảnh vật làng quê Việt Nam xưa, đọng lại dư vị man mác khó quên.', 3, 80000.000, 1, 11, 80, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '13x19cm', 198, 'Bìa mềm'),
	(12, 'Vang Bóng Một Thời', 'vang-bong-mot-thoi', 115000.000, 'vang-bong.jpg', 'Nguyễn Tuân đưa người đọc trở về với những thú chơi tao nhã, những nét đẹp văn hóa cổ xưa của kẻ sĩ Bắc Hà, thể hiện một sự nuối tiếc khôn nguôi về những giá trị đang dần mai một.', 1, 105000.000, 1, 12, 65, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '14x20.5cm', 250, 'Bìa cứng'),
	(13, 'Truyện Kiều (Bản Đặc Biệt)', 'truyen-kieu-ban-dac-biet', 250000.000, 'kieu-db.jpg', 'Kiệt tác của Nguyễn Du được tái bản với hình thức sang trọng, kèm theo những chú giải chi tiết, giúp độc giả hiểu sâu hơn về vẻ đẹp ngôn từ và giá trị nhân văn của tác phẩm.', 3, 250000.000, 1, 6, 30, '2025-04-15 01:59:25', '2025-04-15 01:59:25', '2024', '16x24cm', 450, 'Bìa cứng'),
	(14, 'Làng', 'lang', 60000.000, 'lang.jpg', 'Truyện ngắn Làng của Kim Lân khắc họa sâu sắc tình yêu làng quê hòa quyện với tình yêu nước của người nông dân Việt Nam trong kháng chiến chống Pháp, một biểu tượng đẹp về lòng yêu nước.', 6, 55000.000, 1, 7, 90, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '12x20cm', 150, 'Bìa mềm'),
	(15, 'Tắt Đèn', 'tat-den', 92000.000, 'tat-den.jpg', 'Tác phẩm hiện thực phê phán của Ngô Tất Tố, vẽ nên bức tranh cùng cực của người nông dân dưới ách sưu thuế thời Pháp thuộc, mà đỉnh điểm là hình ảnh chị Dậu quật cường.', 3, 85000.000, 1, 13, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '13.5x20.5cm', 280, 'Bìa mềm'),
	(16, 'Thơ Thơ', 'tho-tho', 75000.000, 'tho-tho.jpg', 'Tập thơ đầu tay của Xuân Diệu, tập trung những bài thơ tình cháy bỏng, nồng nàn, thể hiện một tâm hồn yêu đời, yêu người tha thiết và một quan niệm sống vội vàng, tận hưởng.', 3, 75000.000, 1, 5, 50, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '13x19cm', 180, 'Bìa mềm'),
	(17, 'Những Ngày Thơ Ấu', 'nhung-ngay-tho-au', 85000.000, 'nhung-ngay-tho-au.jpg', 'Hồi ký của Nguyên Hồng kể về tuổi thơ cay đắng, tủi cực nhưng cũng đầy khát vọng sống và tình yêu thương, lay động lòng người bởi sự chân thật và cảm xúc mãnh liệt.', 2, 78000.000, 1, 14, 60, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '14x20cm', 220, 'Bìa mềm'),
	(18, 'AQ Chính Truyện (Bản Dịch)', 'aq-chinh-truyen-ban-dich', 98000.000, 'aq-chinh-truyen.jpg', 'Tác phẩm trào phúng bậc thầy của Lỗ Tấn qua bản dịch tiếng Việt, vạch trần thói tự mãn, hão huyền và tinh thần thắng lợi AQ, một căn bệnh tinh thần phổ biến trong xã hội.', 3, 90000.000, 1, 10, 45, '2025-04-15 01:59:25', '2025-04-15 01:59:25', '2023', '13x20.5cm', 260, 'Bìa mềm'),
	(19, 'Đời Thừa', 'doi-thua', 70000.000, 'doi-thua.jpg', 'Truyện ngắn đặc sắc của Nam Cao, xoay quanh bi kịch của người trí thức nghèo trong xã hội cũ, với những dằn vặt nội tâm sâu sắc về cuộc sống và lý tưởng.', 3, 65000.000, 1, 4, 85, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '13x19cm', 170, 'Bìa mềm'),
	(20, 'Cỏ Dại', 'co-dai', 100000.000, 'co-dai.jpg', 'Tiểu thuyết của Tô Hoài, mang đến một không khí trong trẻo, hồn nhiên của tuổi thơ nơi làng quê, với những trò chơi, những rung động đầu đời thật đáng yêu và đáng nhớ.', 2, 90000.000, 1, 2, 70, '2025-04-15 01:59:25', '2025-04-15 01:59:25', '2024', '14x20.5cm', 310, 'Bìa mềm'),
	(21, 'Nhà Giả Kim', 'nha-gia-kim', 109000.000, 'nha-gia-kim.jpg', 'Cuốn sách kinh điển của Paulo Coelho, một câu chuyện ngụ ngôn đầy triết lý về hành trình theo đuổi ước mơ, lắng nghe trái tim và khám phá vận mệnh của chính mình.', 3, 99000.000, 2, 15, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '13x20.5cm', 220, 'Bìa mềm'),
	(22, 'Hoàng Tử Bé', 'hoang-tu-be', 79000.000, 'hoang-tu-be.jpg', 'Tác phẩm bất hủ của Antoine de Saint-Exupéry, không chỉ dành cho thiếu nhi mà còn cho cả người lớn, chứa đựng những bài học sâu sắc về tình bạn, tình yêu và ý nghĩa cuộc sống.', 11, 70000.000, 2, 16, 120, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '14x14cm', 120, 'Bìa cứng'),
	(23, 'Rừng Na Uy', 'rung-na-uy', 145000.000, 'rung-na-uy.jpg', 'Haruki Murakami dẫn dắt độc giả vào thế giới nội tâm phức tạp của tuổi trẻ Nhật Bản những năm 60, với tình yêu, mất mát và những nỗi niềm hoài niệm day dứt.', 11, 135000.000, 2, 17, 80, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '14.5x20.5cm', 480, 'Bìa mềm'),
	(24, 'Trăm Năm Cô Đơn', 'tram-nam-co-don', 199000.000, 'tram-nam-co-don.jpg', 'Kiệt tác của Gabriel Garcia Marquez, một thiên sử thi huyền ảo về dòng họ Buendía ở ngôi làng Macondo, phản ánh lịch sử và số phận của cả châu Mỹ Latinh.', 3, 189000.000, 2, 18, 50, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '16x24cm', 550, 'Bìa mềm'),
	(25, 'Giết Con Chim Nhại', 'giet-con-chim-nhai', 125000.000, 'giet-con-chim-nhai.jpg', 'Harper Lee kể câu chuyện cảm động về lòng dũng cảm, sự công bằng và định kiến chủng tộc ở miền Nam nước Mỹ qua đôi mắt trẻ thơ của cô bé Scout Finch.', 3, 115000.000, 2, 19, 90, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '14x20.5cm', 380, 'Bìa mềm'),
	(26, 'Bố Già', 'bo-gia', 180000.000, 'bo-gia.jpg', 'Tiểu thuyết kinh điển về thế giới Mafia của Mario Puzo, hé lộ những góc khuất tàn bạo nhưng cũng đầy quy tắc và tình cảm gia đình trong đế chế tội phạm Corleone.', 3, 170000.000, 2, 20, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '16x24cm', 600, 'Bìa mềm'),
	(27, 'Cuốn Theo Chiều Gió', 'cuon-theo-chieu-gio', 220000.000, 'cuon-theo-chieu-gio.jpg', 'Margaret Mitchell vẽ nên một thiên tình sử lãng mạn và bi tráng giữa Scarlett O Hara và Rhett Butler trên nền nội chiến và tái thiết nước Mỹ, một câu chuyện đầy sức sống mãnh liệt.', 3, 200000.000, 2, 21, 40, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '16x24cm', 1200, 'Bìa cứng'),
	(28, 'Ông Già và Biển Cả', 'ong-gia-va-bien-ca', 85000.000, 'ong-gia-va-bien-ca.jpg', 'Ernest Hemingway khắc họa hình ảnh ông lão Santiago kiên cường đối mặt với thử thách khắc nghiệt của biển cả, một biểu tượng về ý chí và phẩm giá con người trước nghịch cảnh.', 3, 80000.000, 2, 22, 110, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '13x19cm', 140, 'Bìa mềm'),
	(29, 'Đồi Gió Hú', 'doi-gio-hu', 135000.000, 'doi-gio-hu.jpg', 'Emily Brontë tạo ra một câu chuyện tình yêu đầy ám ảnh, mãnh liệt và bi kịch giữa Catherine và Heathcliff, trên khung cảnh hoang sơ, dữ dội của nước Anh thế kỷ 19.', 3, 125000.000, 2, 23, 60, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '14.5x20.5cm', 450, 'Bìa mềm'),
	(30, 'Kiêu Hãnh và Định Kiến', 'kieu-hanh-va-dinh-kien', 119000.000, 'kieu-hanh-va-dinh-kien.jpg', 'Jane Austen mang đến câu chuyện tình yêu lãng mạn, dí dỏm và sâu sắc giữa Elizabeth Bennet thông minh và ngài Darcy kiêu kỳ, vượt qua những rào cản xã hội và định kiến cá nhân.', 3, 110000.000, 2, 24, 85, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '13x20.5cm', 400, 'Bìa mềm'),
	(31, 'Giải Bài Tập Toán 12 Nâng Cao', 'giai-bai-tap-toan-12-nc', 55000.000, 'gbt-toan12nc.jpg', 'Cung cấp lời giải chi tiết cho các bài tập trong sách giáo khoa Toán 12 chương trình nâng cao, giúp học sinh tự kiểm tra, đối chiếu và củng cố kiến thức hiệu quả.', 6, 55000.000, 3, 27, 150, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '17x24cm', 250, 'Bìa mềm'),
	(32, 'Cẩm Nang Ôn Thi THPT Quốc Gia Môn Văn', 'cam-nang-on-thi-van', 120000.000, 'cn-onthi-van.jpg', 'Tổng hợp kiến thức trọng tâm, các dạng bài thường gặp và kỹ năng làm bài thi môn Ngữ Văn, kèm theo bộ đề thi thử và đáp án chi tiết, là tài liệu không thể thiếu cho sĩ tử.', 6, 110000.000, 3, 27, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '19x27cm', 400, 'Bìa mềm'),
	(33, 'Luyện Siêu Tư Duy Vật Lý 11', 'luyen-sieu-tu-duy-ly-11', 95000.000, 'lstd-ly11.jpg', 'Hệ thống bài tập Vật Lý lớp 11 đa dạng, từ cơ bản đến nâng cao, kèm phương pháp giải nhanh và sáng tạo, giúp học sinh rèn luyện tư duy và đạt điểm cao.', 0, 90000.000, 3, 27, 80, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '17x24cm', 320, 'Bìa mềm'),
	(34, 'Sơ Đồ Tư Duy Hóa Học Hữu Cơ', 'so-do-tu-duy-hoa-huu-co', 78000.000, 'sdtp-hoa-hc.jpg', 'Hệ thống hóa kiến thức Hóa học hữu cơ bằng sơ đồ tư duy trực quan, sinh động, giúp học sinh dễ dàng ghi nhớ mối liên hệ giữa các chất và phản ứng hóa học.', 7, 75000.000, 3, 27, 120, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '19x27cm', 180, 'Bìa mềm'),
	(35, 'Bài Tập Tiếng Anh Lớp 10 (Không Đáp Án)', 'bt-tieng-anh-10', 40000.000, 'bt-ta10.jpg', 'Tuyển tập bài tập bám sát chương trình Tiếng Anh lớp 10 mới, giúp học sinh thực hành và củng cố ngữ pháp, từ vựng đã học trên lớp một cách chủ động.', 6, 40000.000, 3, 27, 200, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '17x24cm', 150, 'Bìa mềm'),
	(36, 'Atlat Địa Lý Việt Nam (Bản Chuẩn)', 'atlat-dia-ly-vn', 35000.000, 'atlat-dlvn.jpg', 'Công cụ học tập không thể thiếu cho môn Địa Lý, cung cấp hệ thống bản đồ chi tiết về tự nhiên, kinh tế, xã hội Việt Nam, hỗ trợ hiệu quả cho việc học và thi.', 6, 35000.000, 3, 27, 300, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '21x30cm', 50, 'Bìa mềm'),
	(37, 'Hướng Dẫn Học Tốt Lịch Sử 12', 'hd-hoc-tot-su-12', 65000.000, 'hdht-su12.jpg', 'Tóm tắt kiến thức Lịch Sử lớp 12 theo từng bài, giải đáp câu hỏi, bài tập trong sách giáo khoa và cung cấp câu hỏi mở rộng, giúp học sinh nắm vững kiến thức lịch sử.', 6, 60000.000, 3, 27, 90, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '17x24cm', 280, 'Bìa mềm'),
	(38, 'Tuyển chọn đề thi HSG THPT Sinh học', 'de-thi-hsg-sinh', 110000.000, 'dethihsg-sinh.jpg', 'Bộ sưu tập các đề thi học sinh giỏi môn Sinh học cấp tỉnh, thành phố và quốc gia qua các năm, kèm lời giải chi tiết, là tài liệu quý giá cho học sinh chuyên Sinh.', 6, 105000.000, 3, 27, 50, '2025-04-15 01:59:25', '2025-04-15 02:44:46', '2023', '19x27cm', 350, 'Bìa mềm'),
	(39, 'Giáo Trình Tin Học Đại Cương', 'gt-tin-hoc-dai-cuong', 85000.000, 'gt-thdc.jpg', 'Cung cấp kiến thức nền tảng về máy tính, hệ điều hành, mạng máy tính, và các ứng dụng văn phòng cơ bản, phù hợp cho sinh viên năm nhất các trường đại học, cao đẳng.', 6, 85000.000, 3, 27, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '16x24cm', 300, 'Bìa mềm'),
	(40, 'Từ Điển Tiếng Việt (Dành cho học sinh)', 'td-tieng-viet-hs', 150000.000, 'tdtv-hs.jpg', 'Giải thích rõ ràng, dễ hiểu các từ ngữ Tiếng Việt phổ thông, kèm ví dụ minh họa sinh động, giúp học sinh tra cứu, mở rộng vốn từ và sử dụng tiếng Việt chính xác.', 0, 140000.000, 3, 27, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '14.5x20.5cm', 800, 'Bìa cứng'),
	(41, 'English Grammar in Use (Bản Tiếng Việt)', 'english-grammar-in-use-tv', 185000.000, 'egiu-tv.jpg', 'Cuốn sách ngữ pháp tiếng Anh kinh điển của Raymond Murphy, được dịch và chú giải bằng tiếng Việt, giúp người học nắm vững các cấu trúc ngữ pháp từ cơ bản đến nâng cao.', 7, 175000.000, 4, 25, 120, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '19x26cm', 390, 'Bìa mềm'),
	(42, '600 Essential Words for the TOEIC', '600-toeic-words', 150000.000, '600toeic.jpg', 'Cung cấp 600 từ vựng cốt lõi thường xuất hiện trong bài thi TOEIC, kèm theo định nghĩa, ví dụ và bài tập thực hành, giúp bạn xây dựng nền tảng từ vựng vững chắc.', 7, 140000.000, 4, 26, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '17x24cm', 350, 'Bìa mềm'),
	(43, 'Tự Học Tiếng Nhật Cho Người Mới Bắt Đầu', 'tu-hoc-tieng-nhat', 110000.000, 'th-tieng-nhat.jpg', 'Giáo trình tự học tiếng Nhật bài bản, đi từ bảng chữ cái, ngữ pháp cơ bản đến các mẫu câu giao tiếp thông dụng hàng ngày, phù hợp cho người chưa biết gì về tiếng Nhật.', 0, 100000.000, 4, 27, 90, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '16x24cm', 280, 'Bìa mềm'),
	(44, 'Hacking Your English Speaking', 'hacking-speaking', 199000.000, 'hack-speaking.jpg', 'Phương pháp luyện nói tiếng Anh đột phá, tập trung vào phát âm chuẩn, ngữ điệu tự nhiên và các cụm từ giao tiếp thực tế, giúp bạn tự tin nói chuyện như người bản xứ.', 8, 189000.000, 4, 27, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '14.5x20.5cm', 320, 'Bìa mềm kèm App'),
	(45, 'Giáo Trình Hán Ngữ Boya (Quyển 1)', 'gt-han-ngu-boya-1', 95000.000, 'boya1.jpg', 'Bộ giáo trình học tiếng Trung Quốc hiện đại, được biên soạn khoa học, nội dung phong phú, giúp người học phát triển đồng đều bốn kỹ năng nghe, nói, đọc, viết.', 13, 95000.000, 4, 27, 110, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '19x26cm', 250, 'Bìa mềm'),
	(46, 'Luyện Thi IELTS Speaking (Target 7.0+)', 'luyen-thi-ielts-speaking', 170000.000, 'ielts-speaking-7.jpg', 'Tổng hợp các chủ đề thường gặp trong IELTS Speaking Part 1, 2, 3, cung cấp từ vựng, cấu trúc câu và bài mẫu điểm cao, giúp bạn chinh phục mục tiêu 7.0+.', 7, 160000.000, 4, 27, 60, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '17x24cm', 300, 'Bìa mềm'),
	(47, 'Từ Điển Anh-Việt Việt-Anh (Bỏ Túi)', 'td-avva-botui', 65000.000, 'tdavva-botui.jpg', 'Cuốn từ điển nhỏ gọn, tiện lợi, bao gồm lượng từ vựng cơ bản và thông dụng, giúp tra cứu nhanh chóng khi học tập, làm việc hay du lịch.', 0, 60000.000, 4, 27, 150, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '8x12cm', 600, 'Bìa mềm'),
	(48, 'Easy Korean Reading For Beginners', 'easy-korean-reading', 130000.000, 'easy-korean.jpg', 'Tuyển tập các bài đọc tiếng Hàn ngắn, đơn giản với chủ đề gần gũi, kèm từ vựng và giải thích ngữ pháp, giúp người mới bắt đầu rèn luyện kỹ năng đọc hiểu.', 7, 120000.000, 4, 27, 80, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '15x21cm', 220, 'Bìa mềm'),
	(49, '5000 Từ Vựng Tiếng Anh Thông Dụng Nhất', '5000-tu-vung-ta', 140000.000, '5000tuvung.jpg', 'Tổng hợp 5000 từ vựng tiếng Anh được sử dụng thường xuyên nhất trong giao tiếp và văn viết, phân loại theo chủ đề, kèm phiên âm và ví dụ minh họa.', 7, 130000.000, 4, 27, 90, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '16x24cm', 450, 'Bìa mềm'),
	(50, 'Ngữ Pháp Tiếng Pháp Thực Hành', 'ngu-phap-phap-th', 160000.000, 'nguphap-phap.jpg', 'Giải thích cặn kẽ các điểm ngữ pháp tiếng Pháp phức tạp, đi kèm nhiều bài tập ứng dụng đa dạng, giúp người học sử dụng ngữ pháp một cách chính xác và tự nhiên.', 8, 150000.000, 4, 27, 50, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '17x24cm', 380, 'Bìa mềm'),
	(51, 'Muôn Kiếp Nhân Sinh (Tập 1)', 'muon-kiep-nhan-sinh-1', 159000.000, 'mkns1.jpg', 'Hành trình khám phá các quy luật vũ trụ như luật nhân quả, luân hồi qua những câu chuyện tiền kiếp đầy huyền bí và chiêm nghiệm sâu sắc của tác giả Nguyên Phong.', 12, 149000.000, 5, 30, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '14.5x20.5cm', 460, 'Bìa mềm'),
	(52, 'Hành Trình Về Phương Đông', 'hanh-trinh-ve-phuong-dong', 119000.000, 'htvpd.jpg', 'Ghi chép về cuộc hành trình của các nhà khoa học phương Tây đến Ấn Độ để tìm hiểu về các pháp thuật huyền bí, yoga và những bí ẩn tâm linh phương Đông.', 7, 110000.000, 5, 29, 90, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2019', '13x20.5cm', 350, 'Bìa mềm'),
	(53, 'Sức Mạnh Của Hiện Tại', 'suc-manh-cua-hien-tai', 138000.000, 'smcht.jpg', 'Eckhart Tolle hướng dẫn cách giải thoát khỏi sự chi phối của tâm trí, sống trọn vẹn trong khoảnh khắc hiện tại để đạt được bình an nội tâm và giác ngộ.', 7, 128000.000, 5, 28, 80, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2018', '14x20.5cm', 380, 'Bìa mềm'),
	(54, 'Kinh Pháp Cú (Song Ngữ)', 'kinh-phap-cu-song-ngu', 95000.000, 'kinh-phap-cu.jpg', 'Tuyển tập những lời dạy cốt tủy của Đức Phật về đạo đức, trí tuệ và con đường giải thoát, trình bày dưới dạng song ngữ Pali-Việt, giúp người đọc dễ dàng tiếp cận và suy ngẫm.', 0, 90000.000, 5, 27, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '13x19cm', 280, 'Bìa mềm'),
	(55, 'Minh Triết Trong Ăn Uống Của Phương Đông', 'minh-triet-an-uong', 88000.000, 'mt-an-uong.jpg', 'Khám phá mối liên hệ giữa ăn uống và sức khỏe thể chất, tinh thần theo quan điểm của triết học và y học cổ truyền phương Đông, hướng dẫn cách ăn uống quân bình, dưỡng sinh.', 5, 80000.000, 5, 27, 60, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '14.5x20.5cm', 240, 'Bìa mềm'),
	(56, 'Đối Thoại Với Thượng Đế (Tập 1)', 'doi-thoai-voi-thuong-de-1', 145000.000, 'dtvtd1.jpg', 'Cuộc trò chuyện đầy bất ngờ giữa tác giả Neale Donald Walsch và Thượng Đế về những vấn đề sâu sắc của cuộc sống, vũ trụ và bản chất con người.', 7, 135000.000, 5, 32, 50, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2017', '15x23cm', 400, 'Bìa mềm'),
	(57, 'Thiền Sư và Em Bé Năm Tuổi', 'thien-su-va-em-be', 105000.000, 'ts-vabe.jpg', 'Cuốn sách nhẹ nhàng, sâu lắng của Thích Nhất Hạnh, chia sẻ những bài học về chánh niệm, yêu thương và sống an lạc qua hình ảnh gần gũi của một thiền sư và em bé.', 7, 98000.000, 5, 31, 75, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '13x19cm', 260, 'Bìa mềm'),
	(58, 'Luật Hấp Dẫn - Bí Mật Tối Cao', 'luat-hap-dan-bi-mat', 129000.000, 'luat-hap-dan.jpg', 'Khám phá nguyên lý hoạt động của Luật Hấp Dẫn và cách ứng dụng sức mạnh của tư duy tích cực để thu hút những điều tốt đẹp vào cuộc sống của bạn.', 7, 120000.000, 5, 27, 85, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '14x20.5cm', 310, 'Bìa mềm'),
	(59, 'Tìm Về Bản Thể Chân Thật', 'tim-ve-ban-the', 99000.000, 'timvebanthe.jpg', 'Hướng dẫn thực hành thiền định và quán chiếu để nhận diện bản ngã, khám phá bản thể chân thật và đạt đến sự tự do, bình an nội tại.', 17, 92000.000, 5, 27, 65, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '13.5x20cm', 270, 'Bìa mềm'),
	(60, 'Tử Vi Đẩu Số Toàn Thư', 'tu-vi-dau-so', 280000.000, 'tuvi-dauso.jpg', 'Bộ sách nghiên cứu chuyên sâu về Tử Vi Đẩu Số, giải thích ý nghĩa các sao, cung và cách luận giải lá số chi tiết, giúp người đọc tìm hiểu về vận mệnh con người.', 0, 270000.000, 5, 27, 40, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '16x24cm', 700, 'Bìa cứng'),
	(61, '7 Thói Quen Hiệu Quả', '7-thoi-quen-hieu-qua', 165000.000, '7tqhq.jpg', 'Stephen Covey trình bày 7 thói quen cốt lõi giúp con người thay đổi tư duy, làm chủ bản thân và xây dựng các mối quan hệ hiệu quả, đạt được thành công bền vững.', 7, 155000.000, 6, 34, 110, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '15x23cm', 450, 'Bìa mềm'),
	(62, 'Nghĩ Giàu Làm Giàu', 'nghi-giau-lam-giau', 120000.000, 'nghigiau.jpg', 'Napoleon Hill đúc kết 13 nguyên tắc thành công từ cuộc đời của những người giàu có nhất, truyền cảm hứng và hướng dẫn cách biến khát vọng thành hiện thực.', 7, 110000.000, 6, 35, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2019', '14x20.5cm', 360, 'Bìa mềm'),
	(63, 'Ai Lấy Miếng Pho Mát Của Tôi', 'ai-lay-mieng-pho-mat', 69000.000, 'pho-mat.jpg', 'Câu chuyện ngụ ngôn giản dị về sự thay đổi, giúp người đọc nhận ra tầm quan trọng của việc thích ứng, dám bước ra khỏi vùng an toàn để tìm kiếm cơ hội mới.', 7, 65000.000, 6, 36, 130, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '13x19cm', 100, 'Bìa mềm'),
	(64, 'Người Giàu Có Nhất Thành Babylon', 'nguoi-giau-nhat-babylon', 85000.000, 'babylon.jpg', 'Những bài học quản lý tài chính cá nhân vượt thời gian qua các câu chuyện cổ xưa ở Babylon, dạy cách tiết kiệm, đầu tư và làm giàu một cách khôn ngoan.', 7, 79000.000, 6, 37, 90, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '13x20cm', 180, 'Bìa mềm'),
	(65, 'Khéo Ăn Nói Sẽ Có Được Thiên Hạ', 'kheo-an-noi', 105000.000, 'kheo-an-noi.jpg', 'Cuốn sách cung cấp những bí quyết và kỹ năng giao tiếp, ứng xử tinh tế, giúp bạn tạo thiện cảm, thuyết phục người khác và đạt được thành công trong công việc, cuộc sống.', 3, 98000.000, 6, 38, 120, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '14.5x20.5cm', 300, 'Bìa mềm'),
	(66, 'Đừng Bao Giờ Đi Ăn Một Mình', 'dung-bao-gio-di-an-mot-minh', 130000.000, 'di-an-mot-minh.jpg', 'Keith Ferrazzi chia sẻ nghệ thuật xây dựng và duy trì mạng lưới quan hệ bền chặt, nhấn mạnh tầm quan trọng của sự kết nối và giúp đỡ lẫn nhau để cùng phát triển.', 1, 120000.000, 6, 39, 80, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '14x20.5cm', 340, 'Bìa mềm'),
	(67, 'Tuổi Trẻ Đáng Giá Bao Nhiêu?', 'tuoi-tre-dang-gia', 95000.000, 'tuoi-tre-dang-gia.jpg', 'Rosie Nguyễn truyền cảm hứng cho người trẻ sống hết mình, dám ước mơ, dám trải nghiệm và không ngừng học hỏi để biến tuổi thanh xuân thành quãng thời gian ý nghĩa nhất.', 0, 88000.000, 6, 40, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '13x19cm', 250, 'Bìa mềm'),
	(68, 'Tư Duy Nhanh và Chậm', 'tu-duy-nhanh-cham', 190000.000, 'td-nhanh-cham.jpg', 'Daniel Kahneman giải thích về hai hệ thống tư duy của con người, giúp nhận diện những thành kiến, sai lầm trong phán đoán và ra quyết định sáng suốt hơn.', 10, 180000.000, 6, 41, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '16x24cm', 600, 'Bìa mềm'),
	(69, 'Nghệ Thuật Tinh Tế Của Việc Đếch Quan Tâm', 'nghe-thuat-dech-quan-tam', 115000.000, 'nt-dech-quan-tam.jpg', 'Mark Manson đưa ra góc nhìn thẳng thắn, thực tế về cuộc sống, khuyên chúng ta nên chấp nhận những điều không hoàn hảo và tập trung vào những giá trị thực sự quan trọng.', 3, 108000.000, 6, 33, 95, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '14x20.5cm', 280, 'Bìa mềm'),
	(70, 'Sức Mạnh Của Ngôn Từ', 'suc-manh-ngon-tu', 125000.000, 'sm-ngon-tu.jpg', 'Hướng dẫn cách sử dụng ngôn từ một cách hiệu quả để thuyết phục, tạo ảnh hưởng và xây dựng mối quan hệ tốt đẹp, từ giao tiếp hàng ngày đến các bài phát biểu quan trọng.', 7, 115000.000, 6, 42, 85, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '14.5x20.5cm', 320, 'Bìa mềm'),
	(71, 'Kinh Tế Học Hài Hước', 'kinh-te-hoc-hai-huoc', 140000.000, 'kth-hai-huoc.jpg', 'Steven D. Levitt và Stephen J. Dubner sử dụng các công cụ kinh tế học để lý giải những hiện tượng thú vị, bất ngờ trong đời sống xã hội một cách dí dỏm và dễ hiểu.', 8, 130000.000, 7, 43, 90, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '14x20.5cm', 350, 'Bìa mềm'),
	(72, 'Chiến Tranh Tiền Tệ', 'chien-tranh-tien-te', 175000.000, 'ct-tien-te.jpg', 'Song Hongbing hé lộ những âm mưu và cuộc chiến quyền lực đằng sau hệ thống tài chính toàn cầu, tập trung vào vai trò của các gia tộc ngân hàng lớn.', 4, 165000.000, 7, 44, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '16x24cm', 500, 'Bìa mềm'),
	(73, 'Quốc Gia Khởi Nghiệp', 'quoc-gia-khoi-nghiep', 155000.000, 'qg-khoi-nghiep.jpg', 'Lý giải sự thành công thần kỳ của nền kinh tế Israel, phân tích các yếu tố văn hóa, xã hội và chính sách đã tạo nên một quốc gia đổi mới sáng tạo hàng đầu thế giới.', 10, 145000.000, 7, 45, 80, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '14.5x20.5cm', 420, 'Bìa mềm'),
	(74, 'Nhà Đầu Tư Thông Minh', 'nha-dau-tu-thong-minh', 195000.000, 'ndt-thong-minh.jpg', 'Benjamin Graham, bậc thầy của Warren Buffett, trình bày triết lý đầu tư giá trị kinh điển, hướng dẫn cách phân tích cổ phiếu và quản lý rủi ro một cách khôn ngoan.', 4, 185000.000, 7, 46, 60, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2019', '16x24cm', 650, 'Bìa cứng'),
	(75, 'Từ Tốt Đến Vĩ Đại', 'tu-tot-den-vi-dai', 160000.000, 'tot-den-vi-dai.jpg', 'Jim Collins nghiên cứu và đúc kết những yếu tố then chốt giúp các công ty nhảy vọt từ mức tốt lên vĩ đại và duy trì thành công bền vững trong dài hạn.', 1, 150000.000, 7, 47, 85, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '15x23cm', 400, 'Bìa mềm'),
	(76, 'Thiên Nga Đen', 'thien-nga-den', 180000.000, 'thien-nga-den.jpg', 'Nassim Nicholas Taleb bàn về tác động của những sự kiện bất ngờ, khó lường (Thiên Nga Đen) và cách chúng ta đối phó với sự không chắc chắn trong thế giới phức tạp.', 1, 170000.000, 7, 48, 55, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '16x24cm', 550, 'Bìa mềm'),
	(77, 'Tỷ Phú Bán Giày', 'ty-phu-ban-giay', 135000.000, 'typhu-ban-giay.jpg', 'Tony Hsieh, CEO Zappos, chia sẻ hành trình khởi nghiệp đầy đam mê, xây dựng văn hóa doanh nghiệp độc đáo và mang lại hạnh phúc cho cả nhân viên và khách hàng.', 10, 125000.000, 7, 49, 95, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '14x20.5cm', 330, 'Bìa mềm'),
	(78, 'Khởi Nghiệp Tinh Gọn', 'khoi-nghiep-tinh-gon', 125000.000, 'kn-tinh-gon.jpg', 'Eric Ries giới thiệu phương pháp xây dựng và phát triển sản phẩm mới một cách nhanh chóng, linh hoạt, giảm thiểu lãng phí và tối đa hóa khả năng thành công cho startup.', 4, 118000.000, 7, 50, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '14.5x20.5cm', 310, 'Bìa mềm'),
	(79, 'Định Vị (Positioning)', 'dinh-vi', 110000.000, 'dinh-vi.jpg', 'Al Ries và Jack Trout trình bày khái niệm kinh điển về định vị thương hiệu trong tâm trí khách hàng, một yếu tố sống còn trong cuộc chiến marketing khốc liệt.', 1, 105000.000, 7, 51, 110, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '13x19cm', 250, 'Bìa mềm'),
	(80, '21 Bài Học Cho Thế Kỷ 21', '21-bai-hoc-tk21', 169000.000, '21baihoc.jpg', 'Yuval Noah Harari phân tích những thách thức lớn nhất mà nhân loại đang đối mặt trong thế kỷ 21, từ công nghệ, chính trị đến ý nghĩa cuộc sống.', 8, 159000.000, 7, 52, 75, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '15x23cm', 430, 'Bìa mềm'),
	(81, 'Đại Việt Sử Ký Toàn Thư (Bản Dịch)', 'dai-viet-su-ky-toan-thu', 450000.000, 'dvsktt.jpg', 'Bộ quốc sử chính thống lâu đời nhất của Việt Nam, ghi chép lịch sử từ thời Hồng Bàng đến Hậu Lê, là nguồn tư liệu vô giá để tìm hiểu về quá khứ dân tộc.', 0, 430000.000, 8, 53, 30, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '19x27cm', 1500, 'Bìa cứng'),
	(82, 'Lịch Sử Thế Giới', 'lich-su-the-gioi', 250000.000, 'lstg.jpg', 'Cuốn sách tổng hợp các sự kiện, nhân vật và nền văn minh quan trọng trong lịch sử nhân loại, từ thời tiền sử đến hiện đại, cung cấp cái nhìn bao quát về thế giới.', 8, 235000.000, 8, 27, 50, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '17x24cm', 800, 'Bìa cứng'),
	(83, 'Súng, Vi Trùng và Thép', 'sung-vi-trung-thep', 198000.000, 'svtt.jpg', 'Jared Diamond lý giải tại sao các xã hội khác nhau lại phát triển theo những con đường khác biệt, nhấn mạnh vai trò của yếu tố địa lý và môi trường.', 8, 188000.000, 8, 54, 60, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '16x24cm', 620, 'Bìa mềm'),
	(84, 'Việt Nam Sử Lược', 'viet-nam-su-luoc', 130000.000, 'vnsl.jpg', 'Công trình sử học súc tích, khách quan của Trần Trọng Kim, trình bày lịch sử Việt Nam từ nguồn gốc đến thời Pháp thuộc, dễ đọc và dễ tiếp cận.', 3, 120000.000, 8, 56, 80, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2018', '14.5x20.5cm', 550, 'Bìa mềm'),
	(85, 'Nguồn Gốc Các Loài', 'nguon-goc-cac-loai', 170000.000, 'ngcl.jpg', 'Tác phẩm nền tảng của Charles Darwin về thuyết tiến hóa thông qua chọn lọc tự nhiên, làm thay đổi căn bản hiểu biết của con người về sự sống trên Trái Đất.', 0, 160000.000, 8, 55, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2019', '16x24cm', 580, 'Bìa mềm'),
	(87, 'Lược Sử Thời Gian', 'luoc-su-thoi-gian', 145000.000, 'lstg-hawking.jpg', 'Stephen Hawking giải thích các khái niệm phức tạp của vũ trụ học, từ Vụ Nổ Lớn đến lỗ đen, bằng ngôn ngữ phổ thông, giúp độc giả khám phá những bí ẩn của không gian và thời gian.', 1, 135000.000, 8, 57, 65, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '13x20.5cm', 280, 'Bìa mềm'),
	(88, 'Lược Sử Loài Người', 'luoc-su-loai-nguoi', 185000.000, 'lsln.jpg', 'Yuval Noah Harari kể lại câu chuyện hấp dẫn về lịch sử loài người, từ sự tiến hóa của Homo sapiens đến các cuộc cách mạng nhận thức, nông nghiệp và khoa học.', 8, 175000.000, 8, 52, 75, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '15x23cm', 520, 'Bìa mềm'),
	(89, 'Hồ Chí Minh - Hành Trình Đi Tìm Nước', 'hcm-hanh-trinh', 100000.000, 'hcm-hanhtrinh.jpg', 'Tái hiện lại quãng đời đầy gian truân nhưng cũng vô cùng ý nghĩa của Chủ tịch Hồ Chí Minh trong suốt 30 năm bôn ba tìm đường cứu nước, giải phóng dân tộc.', 0, 95000.000, 8, 27, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '14x20.5cm', 350, 'Bìa mềm'),
	(90, 'Chiến Thắng Điện Biên Phủ', 'ct-dien-bien-phu', 120000.000, 'ctdbp.jpg', 'Phân tích chi tiết về diễn biến, ý nghĩa lịch sử và bài học kinh nghiệm từ chiến thắng Điện Biên Phủ lừng lẫy năm châu, chấn động địa cầu.', 0, 110000.000, 8, 27, 85, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '16x24cm', 400, 'Bìa cứng'),
	(91, 'Chú Mèo Đi Hia (Tranh Truyện)', 'chu-meo-di-hia', 55000.000, 'meo-di-hia.jpg', 'Câu chuyện cổ tích kinh điển về chú mèo thông minh, lém lỉnh giúp chủ nhân nghèo khó cưới được công chúa, được kể lại bằng tranh vẽ sinh động, hấp dẫn.', 2, 50000.000, 9, 62, 150, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '20x20cm', 32, 'Bìa mềm'),
	(92, 'Tớ Là Mây', 'to-la-may', 48000.000, 'to-la-may.jpg', 'Cuốn sách Ehon Nhật Bản nhẹ nhàng, dạy bé về vòng tuần hoàn của nước trong tự nhiên qua hình ảnh đám mây đáng yêu, với ngôn từ trong sáng, dễ hiểu.', 2, 45000.000, 9, 27, 120, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '18x18cm', 24, 'Bìa mềm'),
	(93, 'Kính Vạn Hoa (Tập 1)', 'kinh-van-hoa-1', 75000.000, 'kvh1.jpg', 'Mở đầu cho series truyện dài nổi tiếng của Nguyễn Nhật Ánh, kể về những cuộc phiêu lưu thú vị, hài hước của bộ ba Quý ròm, nhỏ Hạnh và Tiểu Long.', 1, 70000.000, 9, 1, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '13x19cm', 250, 'Bìa mềm'),
	(94, '10 Vạn Câu Hỏi Vì Sao (Thế Giới Động Vật)', '10v-chvs-dongvat', 89000.000, '10vchvs-dv.jpg', 'Giải đáp những thắc mắc ngộ nghĩnh của trẻ về thế giới động vật phong phú, từ các loài côn trùng bé nhỏ đến những loài thú lớn, kèm hình ảnh minh họa đẹp mắt.', 9, 85000.000, 9, 27, 90, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '17x24cm', 180, 'Bìa cứng'),
	(95, 'Truyện Cổ Tích Việt Nam Chọn Lọc', 'truyen-co-tich-vn', 98000.000, 'tctvn.jpg', 'Tuyển tập những câu chuyện cổ tích quen thuộc như Tấm Cám, Sọ Dừa, Thạch Sanh,... nuôi dưỡng tâm hồn trẻ thơ bằng những bài học về lòng tốt, lòng dũng cảm.', 2, 90000.000, 9, 27, 110, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '16x24cm', 300, 'Bìa cứng'),
	(96, 'Bộ Sách Bé Tập Tô Màu (Chủ đề Phương Tiện)', 'bo-sach-to-mau-pt', 60000.000, 'tomau-pt.jpg', 'Bộ sách gồm nhiều hình vẽ các loại phương tiện giao thông như ô tô, máy bay, tàu hỏa,... giúp bé nhận biết, gọi tên và thỏa sức sáng tạo với màu sắc.', 0, 55000.000, 9, 27, 140, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '21x28cm', 64, 'Bìa mềm'),
	(97, 'Harry Potter và Hòn Đá Phù Thủy', 'harry-potter-1', 179000.000, 'hp1.jpg', 'Mở ra thế giới phép thuật kỳ diệu của trường Hogwarts và cuộc phiêu lưu đầu tiên của cậu bé phù thủy Harry Potter cùng những người bạn thân Ron, Hermione.', 1, 169000.000, 9, 63, 80, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '14x20.5cm', 500, 'Bìa mềm'),
	(98, 'Thơ Cho Bé Học Nói', 'tho-cho-be-hoc-noi', 45000.000, 'tho-be-hocnoi.jpg', 'Tuyển tập những bài thơ ngắn, có vần điệu vui tươi, dễ nhớ, chủ đề gần gũi với cuộc sống hàng ngày, giúp bé phát triển ngôn ngữ và khả năng ghi nhớ.', 2, 42000.000, 9, 27, 130, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '15x15cm', 48, 'Bìa cứng'),
	(99, 'Bách Khoa Tri Thức Cho Trẻ Em', 'bach-khoa-tre-em', 195000.000, 'bktt-te.jpg', 'Cung cấp kiến thức phong phú về nhiều lĩnh vực như khoa học, vũ trụ, lịch sử, địa lý,... được trình bày sinh động qua hình ảnh và giải thích ngắn gọn, dễ hiểu.', 9, 185000.000, 9, 27, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '22x28cm', 256, 'Bìa cứng'),
	(100, 'Tí Quậy (Tập Truyện Tranh)', 'ti-quay', 68000.000, 'ti-quay.jpg', 'Những mẩu chuyện hài hước, tinh nghịch xoay quanh cậu bé Tí và các bạn cùng lớp, mang lại tiếng cười sảng khoái và những bài học nhẹ nhàng cho các em nhỏ.', 2, 65000.000, 9, 72, 100, '2025-04-15 01:59:25', '2025-04-15 02:48:52', '2022', '14.5x20.5cm', 192, 'Bìa mềm'),
	(101, 'Cơ sở văn hóa Việt Nam', 'ban-ve-van-hoa-vn', 140000.000, 'csvhvn.jpg', 'Tổng hợp các bài viết, nghiên cứu sâu sắc về các khía cạnh đa dạng của văn hóa Việt Nam, từ truyền thống đến hiện đại, giúp hiểu rõ hơn bản sắc dân tộc.', 0, 130000.000, 10, 73, 60, '2025-04-15 01:59:25', '2025-04-15 02:52:07', '2021', '16x24cm', 450, 'Bìa mềm'),
	(102, 'Chính Trị Luận', 'chinh-tri-luan', 165000.000, 'ctl-aristotle.jpg', 'Tác phẩm kinh điển của triết học chính trị phương Tây, phân tích các hình thức nhà nước, vai trò công dân và mục tiêu của một xã hội tốt đẹp.', 8, 155000.000, 10, 65, 50, '2025-04-15 01:59:25', '2025-04-15 02:54:20', '2020', '14.5x20.5cm', 500, 'Bìa mềm'),
	(103, 'Văn Minh Việt Nam', 'van-minh-viet-nam', 180000.000, 'vmvn.jpg', 'Công trình nghiên cứu công phu của Nguyễn Văn Huyên về nền văn minh lúa nước, tổ chức làng xã và các giá trị tinh thần cốt lõi của người Việt.', 19, 170000.000, 10, 58, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2019', '16x24cm', 600, 'Bìa cứng'),
	(104, 'Tôn Tử Binh Pháp', 'nghe-thuat-chien-tranh', 95000.000, 'bptt.jpg', 'Binh pháp cổ điển của Tôn Tử, không chỉ ứng dụng trong quân sự mà còn trong kinh doanh và đối nhân xử thế, với những triết lý sâu sắc về chiến lược và mưu lược.', 3, 90000.000, 10, 59, 90, '2025-04-15 01:59:25', '2025-04-15 02:58:28', '2022', '13x19cm', 200, 'Bìa mềm'),
	(105, 'Tìm Hiểu Về ASEAN', 'thvh-asean', 120000.000, 'th-asean.jpg', 'Giới thiệu những nét đặc sắc về văn hóa, phong tục tập quán, lễ hội của các quốc gia thành viên Hiệp hội các quốc gia Đông Nam Á (ASEAN).', 7, 110000.000, 10, 27, 80, '2025-04-15 01:59:25', '2025-04-15 03:00:45', '2023', '14.5x20.5cm', 350, 'Bìa mềm'),
	(106, 'Quân Vương (Thuật cai trị)', 'quan-vuong', 105000.000, 'quan-vuong.jpg', 'Tác phẩm chính trị gây tranh cãi của Machiavelli, bàn về cách giành và giữ quyền lực, thường được xem là nền tảng cho chủ nghĩa hiện thực chính trị.', 21, 100000.000, 10, 60, 75, '2025-04-15 01:59:25', '2025-04-15 03:02:52', '2021', '13x20.5cm', 280, 'Bìa mềm'),
	(107, 'Văn hóa ứng xử của người Việt', 'vhux-vn', 110000.000, 'vhux-vn.jpg', 'Cung cấp kiến thức về các quy tắc ứng xử, giao tiếp và lễ nghi truyền thống của người Việt trong gia đình, xã hội, giúp giữ gìn nét đẹp văn hóa dân tộc.', 5, 105000.000, 10, 27, 85, '2025-04-15 01:59:25', '2025-04-15 03:04:23', '2024', '14x20.5cm', 320, 'Bìa mềm'),
	(108, 'Tương Lai Của Quyền Lực', 'tuong-lai-quyen-luc', 150000.000, 'tlql.jpg', 'Joseph Nye phân tích sự chuyển dịch quyền lực trong thế kỷ 21, từ quyền lực cứng (quân sự, kinh tế) sang quyền lực mềm (văn hóa, giá trị) và quyền lực thông minh.', 21, 140000.000, 10, 74, 65, '2025-04-15 01:59:25', '2025-04-15 03:06:35', '2022', '15x23cm', 400, 'Bìa mềm'),
	(109, 'Đường Cách Mệnh', 'duong-cach-menh', 80000.000, 'duong-cach-menh.jpg', 'Tác phẩm lý luận chính trị quan trọng của Nguyễn Ái Quốc (Hồ Chí Minh), vạch ra con đường cách mạng giải phóng dân tộc cho Việt Nam.', 22, 75000.000, 10, 8, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2020', '12x19cm', 180, 'Bìa mềm'),
	(110, 'Bàn Về Tự Do', 'ban-ve-tu-do', 130000.000, 'bvtd.jpg', 'Luận giải sâu sắc về tầm quan trọng của tự do cá nhân, tự do tư tưởng và tự do ngôn luận đối với sự phát triển của cá nhân và xã hội.', 21, 120000.000, 10, 61, 70, '2025-04-15 01:59:25', '2025-04-15 03:09:07', '2023', '14x20.5cm', 360, 'Bìa mềm'),
	(111, 'Giáo Trình Giải Tích 1', 'gt-giai-tich-1', 90000.000, 'gt-gt1.jpg', 'Cung cấp kiến thức nền tảng về giới hạn, đạo hàm, vi phân và tích phân hàm một biến, dành cho sinh viên khối ngành kỹ thuật và khoa học tự nhiên.', 6, 85000.000, 11, 27, 90, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '17x24cm', 350, 'Bìa mềm'),
	(112, 'Nguyên Lý Kế Toán', 'nguyen-ly-ke-toan', 115000.000, 'nlkt.jpg', 'Giới thiệu những nguyên tắc, khái niệm và phương pháp cơ bản của kế toán tài chính, giúp người học hiểu về hệ thống báo cáo tài chính của doanh nghiệp.', 0, 110000.000, 11, 27, 100, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '16x24cm', 400, 'Bìa mềm'),
	(113, 'Marketing Căn Bản', 'marketing-can-ban', 130000.000, 'mkt-cb.jpg', 'Trình bày các khái niệm cốt lõi, quy trình và công cụ marketing hiện đại, từ nghiên cứu thị trường, phân khúc khách hàng đến xây dựng chiến lược 4P.', 7, 120000.000, 11, 70, 80, '2025-04-15 01:59:25', '2025-04-15 03:11:18', '2021', '16x24cm', 450, 'Bìa mềm'),
	(114, 'Giáo Trình Luật Dân Sự Việt Nam (Tập 1)', 'gt-luat-dan-su-1', 150000.000, 'gt-lds1.jpg', 'Phân tích các quy định pháp luật về chủ thể, tài sản, giao dịch dân sự và nghĩa vụ trong Bộ luật Dân sự Việt Nam, dành cho sinh viên ngành Luật.', 0, 145000.000, 11, 27, 70, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2024', '17x24cm', 550, 'Bìa mềm'),
	(115, 'Lập Trình C++ Cơ Bản và Nâng Cao', 'lap-trinh-cpp', 140000.000, 'lt-cpp.jpg', 'Hướng dẫn chi tiết về ngôn ngữ lập trình C++, từ cú pháp cơ bản, cấu trúc dữ liệu đến lập trình hướng đối tượng, phù hợp cho người mới bắt đầu và muốn nâng cao.', 0, 130000.000, 11, 27, 85, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '17x24cm', 500, 'Bìa mềm'),
	(116, 'Quản Trị Học', 'quan-tri-hoc', 125000.000, 'qth.jpg', 'Giới thiệu các lý thuyết, chức năng và kỹ năng cơ bản của quản trị trong tổ chức, bao gồm hoạch định, tổ chức, lãnh đạo và kiểm soát.', 0, 118000.000, 11, 27, 95, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '16x24cm', 420, 'Bìa mềm'),
	(117, 'Dược Lý Học (Tập 1)', 'duoc-ly-hoc-1', 180000.000, 'dlh1.jpg', 'Cung cấp kiến thức đại cương về dược lý, dược động học, dược lực học và tác dụng, chỉ định, chống chỉ định của các nhóm thuốc cơ bản.', 0, 170000.000, 11, 27, 60, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2021', '19x27cm', 600, 'Bìa cứng'),
	(118, 'Cơ Sở Dữ Liệu', 'co-so-du-lieu', 100000.000, 'csdl.jpg', 'Giới thiệu các mô hình dữ liệu, ngôn ngữ truy vấn SQL, thiết kế cơ sở dữ liệu quan hệ và các khái niệm về quản trị cơ sở dữ liệu.', 6, 95000.000, 11, 27, 110, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2022', '16x24cm', 380, 'Bìa mềm'),
	(119, 'Tài Chính Doanh Nghiệp', 'tai-chinh-doanh-nghiep', 160000.000, 'tcdn.jpg', 'Nghiên cứu các quyết định tài chính quan trọng trong doanh nghiệp như đầu tư, tài trợ và phân phối lợi nhuận, nhằm tối đa hóa giá trị doanh nghiệp.', 26, 150000.000, 11, 27, 75, '2025-04-15 01:59:25', '2025-04-15 02:08:08', '2023', '17x24cm', 520, 'Bìa mềm'),
	(120, 'Kỹ Thuật Điện Tử Cơ Bản', 'kt-dien-tu-cb', 95000.000, 'ktdt-cb.jpg', 'Trình bày nguyên lý hoạt động của các linh kiện điện tử cơ bản như diode, transistor, op-amp và các mạch ứng dụng đơn giản.', 0, 90000.000, 11, 27, 90, '2025-04-15 01:59:25', '2025-04-15 03:17:23', '2020', '17x24cm', 360, 'Bìa mềm');

-- Dumping structure for table bookstore1.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_carts_user_id` (`user_id`),
  CONSTRAINT `fk_carts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore1.carts: ~3 rows (approximately)
DELETE FROM `carts`;
INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2025-02-25 10:58:28', '2025-02-25 10:58:28'),
	(2, 2, '2025-02-25 10:58:28', '2025-02-25 10:58:28'),
	(3, 3, '2025-02-25 10:58:28', '2025-02-25 10:58:28');

-- Dumping structure for table bookstore1.cart_items
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_items_cart_id` (`cart_id`),
  KEY `fk_cart_items_product_id` (`product_id`),
  CONSTRAINT `fk_cart_items_cart_id` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cart_items_product_id` FOREIGN KEY (`product_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore1.cart_items: ~4 rows (approximately)
DELETE FROM `cart_items`;
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `price`) VALUES
	(1, 1, 2, 2, 80000.000),
	(2, 1, 5, 1, 110000.000),
	(3, 2, 1, 1, 95000.000),
	(4, 3, 3, 3, 130000.000);

-- Dumping structure for table bookstore1.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore1.categories: ~11 rows (approximately)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `name`, `slug`, `description`) VALUES
	(1, 'Văn học Việt Nam', 'van-hoc-viet-nam', 'Các tác phẩm văn học kinh điển và hiện đại của Việt Nam.'),
	(2, 'Văn học Nước Ngoài', 'van-hoc-nuoc-ngoai', 'Các tác phẩm văn học dịch từ các quốc gia khác.'),
	(3, 'SGK - Tham khảo', 'sach-giao-khoa-tham-khao', 'Sách giáo khoa, sách bài tập, sách tham khảo cho các cấp học.'),
	(4, 'Sách học ngoại ngữ', 'sach-hoc-ngoai-ngu', 'Sách học từ vựng, ngữ pháp, luyện thi các chứng chỉ ngoại ngữ phổ biến.'),
	(5, 'Tâm linh - Tôn giáo', 'tam-linh-ton-giao', 'Sách về các tôn giáo, triết lý sống, khám phá tâm linh và vũ trụ.'),
	(6, 'Kỹ Năng Sống', 'ky-nang-song', 'Sách về các kỹ năng mềm và phát triển bản thân.'),
	(7, 'Kinh Tế', 'kinh-te', 'Sách về kinh tế, tài chính và đầu tư.'),
	(8, 'Lịch Sử', 'lich-su', 'Sách về lịch sử Việt Nam và thế giới.'),
	(9, 'Sách thiếu nhi', 'sach-thieu-nhi', 'Truyện tranh, truyện cổ tích, sách kiến thức phù hợp với lứa tuổi thiếu nhi.'),
	(10, 'Văn hóa - Chính trị', 'van-hoa-chinh-tri', 'Sách nghiên cứu về văn hóa các vùng miền, quốc gia và các vấn đề chính trị.'),
	(11, 'Chuyên ngành', 'chuyen-nganh', 'Sách giáo trình, tài liệu nghiên cứu cho các ngành học cụ thể.');

-- Dumping structure for table bookstore1.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_amount` decimal(10,3) NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_orders_user_id` (`user_id`),
  CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore1.orders: ~2 rows (approximately)
DELETE FROM `orders`;
INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `shipping_address`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 225000.000, '123 Đường ABC, Quận 1, TP.HCM', 'COD', 'delivered', '2025-02-25 10:58:28', '2025-02-25 10:58:28'),
	(2, 2, 153000.000, '456 Đường XYZ, Quận 3, TP.HCM', 'Credit Card', 'shipped', '2025-02-25 10:58:28', '2025-02-25 10:58:28');

-- Dumping structure for table bookstore1.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_items_order_id` (`order_id`),
  KEY `fk_order_items_product_id` (`product_id`),
  CONSTRAINT `fk_order_items_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_order_items_product_id` FOREIGN KEY (`product_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore1.order_items: ~5 rows (approximately)
DELETE FROM `order_items`;
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(1, 1, 1, 1, 85500.000),
	(2, 1, 4, 1, 67500.000),
	(3, 1, 6, 1, 72000.000),
	(4, 2, 2, 1, 72000.000),
	(5, 2, 8, 1, 81000.000);

-- Dumping structure for table bookstore1.publishers
CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore1.publishers: ~31 rows (approximately)
DELETE FROM `publishers`;
INSERT INTO `publishers` (`id`, `name`, `address`, `phone`, `email`) VALUES
	(1, 'Nhà Xuất Bản Trẻ', '161B Lý Chính Thắng, P.7, Q.3, TP. Hồ Chí Minh', '028.38437488', 'info@nhaxuatbantre.vn'),
	(2, 'Nhà Xuất Bản Kim Đồng', '248 Cống Quỳnh, P. Phạm Ngũ Lão, Q.1, TP. Hồ Chí Minh', '028.38294229', 'info@nxbkimdong.com.vn'),
	(3, 'Nhà Xuất Bản Văn Học', '18 Nguyễn Trường Tộ, Ba Đình, Hà Nội', '024.37332446', 'vanhoc18ntt@gmail.com'),
	(4, 'Nhà Xuất Bản Lao Động', '175 Giảng Võ, Đống Đa, Hà Nội', '024.35121914', 'nhaxuatbanlaodong@gmail.com'),
	(5, 'Nhà Xuất Bản Phụ Nữ Việt Nam', '39 Hàng Chuối, Hoàn Kiếm, Hà Nội', '024.38252340', 'info@nxbphunu.com.vn'),
	(6, 'Nhà Xuất Bản Giáo dục Việt Nam', '81 Trần Hưng Đạo, Hoàn Kiếm, Hà Nội', '024 3822 0801', NULL),
	(7, 'Nhà Xuất Bản Tổng hợp TP.HCM', '62 Nguyễn Thị Minh Khai, P.Đa Kao, Q.1, TP.HCM', '028 3822 5340', NULL),
	(8, 'Nhà Xuất Bản Thế Giới', '46 Trần Hưng Đạo, Hoàn Kiếm, Hà Nội', '024 3825 3841', NULL),
	(9, 'Nhà Xuất Bản Dân Trí', 'Số 9, ngõ 26, phố Hoàng Cầu, P. Ô Chợ Dừa, Q. Đống Đa, Hà Nội', '024 3736 6491', NULL),
	(10, 'Alpha Books', '176 Thái Hà, Đống Đa, Hà Nội', '024 3722 6234', 'info@alphabooks.vn'),
	(11, 'Nhã Nam', '59 Đỗ Quang, Trung Hoà, Cầu Giấy, Hà Nội', '024 3514 6875', NULL),
	(12, 'First News - Trí Việt', '11H Nguyễn Thị Minh Khai, P. Bến Nghé, Q.1, TP.HCM', '028 3822 7979', NULL),
	(13, 'Nhà Xuất Bản Đại học Quốc Gia Hà Nội', '160 Hoàng Quốc Việt, Cầu Giấy, Hà Nội', '024 3754 7901', NULL),
	(14, 'Nhà Xuất Bản Đà Nẵng', '91 Lê Đình Dương, Hải Châu, Đà Nẵng', '0236 3897 424', NULL),
	(15, 'Nhà Xuất Bản Hồng Đức', '65 Tràng Thi, Hoàn Kiếm, Hà Nội', '024 3825 3986', NULL),
	(16, 'Nhà Xuất Bản Từ điển Bách Khoa', '109 Quán Thánh, Ba Đình, Hà Nội', '024 3843 8952', NULL),
	(17, 'Nhà Xuất Bản Tôn Giáo', '53 Tràng Thi, Hàng Bông, Hoàn Kiếm, Hà Nội', '024 3762 2639', 'tttbantongiao@chinhphu.vn'),
	(18, 'Nhà Xuất Bản Thời Đại', 'Nhà B15, Lô 2, KĐT Mỹ Đình I, Cầu Diễn, Nam Từ Liêm, Hà Nội', NULL, NULL),
	(19, 'Nhà Xuất Bản Hội Nhà Văn', '65 Nguyễn Du, Hai Bà Trưng, Hà Nội', '024 3822 2135', NULL),
	(20, 'Nhà Xuất Bản Khoa học Xã hội', '26 Lý Thường Kiệt, Hàng Bài, Hoàn Kiếm, Hà Nội', '024 3971 9073', 'nxbkhxh@gmail.com'),
	(21, 'Nhà Xuất Bản Tri Thức', 'Tầng 1, Tòa nhà VUSTA, Lô D20, ngõ 19 Duy Tân, Cầu Giấy, Hà Nội', '024 6687 8415', 'nxbtrithuc@gmail.com'),
	(22, 'Nhà Xuất Bản Chính trị Quốc gia Sự thật', 'Số 6/86 Duy Tân, Cầu Giấy, Hà Nội', '024 3942 2008', 'phathanh@nxbctqg.vn'),
	(23, 'Nhà Xuất Bản Quân đội Nhân dân', '23 Lý Nam Đế, Hoàn Kiếm, Hà Nội', '024 3747 0394', NULL),
	(24, 'Nhà Xuất Bản Mỹ Thuật', '44B Hàm Long, Hoàn Kiếm, Hà Nội', '024 3943 6126', NULL),
	(25, 'Nhà Xuất Bản Văn hóa Thông tin', 'Số 43 Lò Đúc, Hai Bà Trưng, Hà Nội', '024 3971 9512', NULL),
	(26, 'Nhà Xuất Bản Tài Chính', 'Số 7 Phan Huy Chú, Hoàn Kiếm, Hà Nội', '024 3933 1000', NULL),
	(27, 'Nhà Xuất Bản Tư Pháp', '35 Trần Quốc Toản, Hoàn Kiếm, Hà Nội', '024 3822 7867', NULL),
	(28, 'Nhà Xuất Bản Bách khoa Hà Nội', 'Số 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội', '024 3868 4569', NULL),
	(29, 'Nhà Xuất Bản Kinh tế TP.HCM', '279 Nguyễn Tri Phương, Phường 5, Quận 10, TP.HCM', '028 3857 5424', NULL),
	(30, 'Nhà Xuất Bản Y học', 'Số 352 Đội Cấn, Cống Vị, Ba Đình, Hà Nội', '024 3762 7819', 'xuatbanyhoc@fpt.vn'),
	(31, 'Nhà Xuất Bản Khoa học và Kỹ thuật', 'Số 70 Trần Hưng Đạo, Hoàn Kiếm, Hà Nội', '024 3942 3172', 'nxbkhkt@hn.vnn.vn');

-- Dumping structure for table bookstore1.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bookstore1.users: ~8 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `phone`, `created_at`, `updated_at`, `role`) VALUES
	(1, 'Nguyễn Văn An', 'an.nguyen@example.com', '$2y$10$abcdefghijklmnopqrstuvwxysdfasdfasdf', '123 Đường ABC, Quận 1, TP.HCM', '0901234567', '2025-02-25 10:58:28', '2025-02-25 10:58:28', 0),
	(2, 'Trần Thị Bình', 'binh.tran@example.com', '$2y$10$abcdefghijklmnopqrstuvwxysdfasdfasdf', '456 Đường XYZ, Quận 3, TP.HCM', '0918765432', '2025-02-25 10:58:28', '2025-02-25 10:58:28', 0),
	(3, 'Lê Văn Cường', 'cuong.le@example.com', '$2y$10$abcdefghijklmnopqrstuvwxysdfasdfasdf', '789 Đường QRS, Bình Thạnh, TP.HCM', '0987123456', '2025-02-25 10:58:28', '2025-02-25 10:58:28', 0),
	(4, 'Root', 'root@root', '$2y$10$geVqoZAmHNJSGIiWuAlFtehLSyPPnfmNC3UBdBxEzWKo6.nyPdUP.', 'N/A, 00004, 001, 01', '0908347930', '2025-04-15 01:02:40', '2025-04-15 01:02:40', 1),
	(5, 'Công Danh Nguyễn', 'ncongdanh91@gmail.com', '$2y$10$Zehmy3ItOZMcdaSGhNFhKeF1Qx6x1IKnoHUrSd7NarG0FUSB9QC2C', 'N/A, , , ', '0908347930', '2025-04-15 01:05:03', '2025-04-15 01:05:03', 1),
	(6, 'Du Nghia', 'nghiangu123@gmail.com', '$2y$10$5wgynmQ0XWX7YUgm9i/Ml.edzliX3sEk625G0TwG/IuHeDEcHpNAS', ' fasdasd, 08860, 253, 26', '0953987412', '2025-05-01 14:17:17', '2025-05-01 14:17:17', 1),
	(7, 'a', 'a@gmail.com', '$2y$10$vLibq1w3SzNpiKXVm4.Isu0A6nxXQsbLHY6ORtZ.WJUaYr/h7y4nS', 'N/A, 12430, 333, 33', '0908347930', '2025-05-01 14:20:24', '2025-05-01 14:20:24', 1),
	(8, 'b', 'b@gmail.com', '$2y$10$6FPe9RVuRmMwCP8u7k1sVOTpp4hL61CwY6RL69MR0oAylorXZJusu', 'N/A, 11293, 300, 30', '435345543', '2025-05-01 14:21:33', '2025-05-01 14:21:33', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
