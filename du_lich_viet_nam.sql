-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 11, 2026 lúc 05:49 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `du_lich_viet_nam`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dia_danh`
--

CREATE TABLE `dia_danh` (
  `id` int(11) NOT NULL,
  `ten_dia_danh` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `id_tinh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dia_danh`
--

INSERT INTO `dia_danh` (`id`, `ten_dia_danh`, `mo_ta`, `hinh_anh`, `id_tinh`) VALUES
(1, 'Chùa Một Cột - Biểu tượng văn hóa Hà Nội', 'Chùa Một Cột là một trong những biểu tượng của thủ đô Hà Nội. Ngôi chùa có kiến trúc độc đáo giống như một đóa sen nở trên mặt nước, nằm trong quần thể di tích Lăng Chủ tịch Hồ Chí Minh.', '1768124675_OIP.jpg', 24),
(2, 'Cột cờ Lũng Cú ', 'Cột cờ Lũng Cú là một cột cờ quốc gia nằm ở đỉnh Lũng Cú hay còn gọi là đỉnh núi Rồng (Long Sơn) có độ cao khoảng 1.470 m so với mực nước biển, thuộc xã Lũng Cú, huyện Đồng Văn, tỉnh Hà Giang cũ, nay là xã Lũng Cú, tỉnh Tuyên Quang, Việt Nam.\r\n\r\nCột cờ Lũng Cú cách điểm cực Bắc Việt Nam khoảng 3,3 km theo đường chim bay. Từ trên đỉnh cột cờ nhìn xuống đất có 02 ao nước hai bên núi quanh năm không bao giờ cạn nước được gọi là mắt rồng, là nguồn nước cho người dân tộc hai bản sử dụng. Cột cờ cách trung tâm xã Đồng Văn 24 km, cách phường Hà Giang 2, tỉnh Tuyên Quang, 154 km.\r\n\r\nCột cờ Lũng Cú có lịch sử lâu đời, trải qua nhiều lần phục dựng, tôn tạo. Cột cờ mới hình bát giác có độ cao trên 30m được khánh thành ngày 25 tháng 9 năm 2010.[1]', '1768147648_Cot-co-Lung-Cu3.jpg', 22);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dia_danh_anh`
--

CREATE TABLE `dia_danh_anh` (
  `id` int(11) NOT NULL,
  `id_dia_danh` int(11) DEFAULT NULL,
  `file_anh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dia_danh_anh`
--

INSERT INTO `dia_danh_anh` (`id`, `id_dia_danh`, `file_anh`) VALUES
(3, 2, '1768148332_sub_cot-co-lung-cu-su-thieng-lieng-tu-hao-cua-nguoi-ha-giang.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinh_thanh`
--

CREATE TABLE `tinh_thanh` (
  `id` int(11) NOT NULL,
  `ten_tinh` varchar(100) NOT NULL,
  `vung_mien` enum('Bắc','Trung','Nam') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tinh_thanh`
--

INSERT INTO `tinh_thanh` (`id`, `ten_tinh`, `vung_mien`) VALUES
(1, 'An Giang', 'Nam'),
(2, 'Bà Rịa - Vũng Tàu', 'Nam'),
(3, 'Bạc Liêu', 'Nam'),
(4, 'Bắc Giang', 'Bắc'),
(5, 'Bắc Kạn', 'Bắc'),
(6, 'Bắc Ninh', 'Bắc'),
(7, 'Bến Tre', 'Nam'),
(8, 'Bình Dương', 'Nam'),
(9, 'Bình Định', 'Trung'),
(10, 'Bình Phước', 'Nam'),
(11, 'Bình Thuận', 'Trung'),
(12, 'Cà Mau', 'Nam'),
(13, 'Cao Bằng', 'Bắc'),
(14, 'Cần Thơ', 'Nam'),
(15, 'Đà Nẵng', 'Trung'),
(16, 'Đắk Lắk', 'Trung'),
(17, 'Đắk Nông', 'Trung'),
(18, 'Điện Biên', 'Bắc'),
(19, 'Đồng Nai', 'Nam'),
(20, 'Đồng Tháp', 'Nam'),
(21, 'Gia Lai', 'Trung'),
(22, 'Hà Giang', 'Bắc'),
(23, 'Hà Nam', 'Bắc'),
(24, 'Hà Nội', 'Bắc'),
(25, 'Hà Tĩnh', 'Trung'),
(26, 'Hải Dương', 'Bắc'),
(27, 'Hải Phòng', 'Bắc'),
(28, 'Hậu Giang', 'Nam'),
(29, 'Hòa Bình', 'Bắc'),
(30, 'Thành phố Hồ Chí Minh', 'Nam'),
(31, 'Hưng Yên', 'Bắc'),
(32, 'Khánh Hòa', 'Trung'),
(33, 'Kiên Giang', 'Nam'),
(34, 'Kon Tum', 'Trung'),
(35, 'Lai Châu', 'Bắc'),
(36, 'Lạng Sơn', 'Bắc'),
(37, 'Lào Cai', 'Bắc'),
(38, 'Lâm Đồng', 'Trung'),
(39, 'Long An', 'Nam'),
(40, 'Nam Định', 'Bắc'),
(41, 'Nghệ An', 'Trung'),
(42, 'Ninh Bình', 'Bắc'),
(43, 'Ninh Thuận', 'Trung'),
(44, 'Phú Thọ', 'Bắc'),
(45, 'Phú Yên', 'Trung'),
(46, 'Quảng Bình', 'Trung'),
(47, 'Quảng Nam', 'Trung'),
(48, 'Quảng Ngãi', 'Trung'),
(49, 'Quảng Ninh', 'Bắc'),
(50, 'Quảng Trị', 'Trung'),
(51, 'Sóc Trăng', 'Nam'),
(52, 'Sơn La', 'Bắc'),
(53, 'Tây Ninh', 'Nam'),
(54, 'Thái Bình', 'Bắc'),
(55, 'Thái Nguyên', 'Bắc'),
(56, 'Thanh Hóa', 'Trung'),
(57, 'Thừa Thiên Huế', 'Trung'),
(58, 'Tiền Giang', 'Nam'),
(59, 'Trà Vinh', 'Nam'),
(60, 'Tuyên Quang', 'Bắc'),
(61, 'Vĩnh Long', 'Nam'),
(62, 'Vĩnh Phúc', 'Bắc'),
(63, 'Yên Bái', 'Bắc');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dia_danh`
--
ALTER TABLE `dia_danh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tinh` (`id_tinh`);

--
-- Chỉ mục cho bảng `dia_danh_anh`
--
ALTER TABLE `dia_danh_anh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dia_danh` (`id_dia_danh`);

--
-- Chỉ mục cho bảng `tinh_thanh`
--
ALTER TABLE `tinh_thanh`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dia_danh`
--
ALTER TABLE `dia_danh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `dia_danh_anh`
--
ALTER TABLE `dia_danh_anh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tinh_thanh`
--
ALTER TABLE `tinh_thanh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dia_danh`
--
ALTER TABLE `dia_danh`
  ADD CONSTRAINT `dia_danh_ibfk_1` FOREIGN KEY (`id_tinh`) REFERENCES `tinh_thanh` (`id`);

--
-- Các ràng buộc cho bảng `dia_danh_anh`
--
ALTER TABLE `dia_danh_anh`
  ADD CONSTRAINT `fk_dia_danh` FOREIGN KEY (`id_dia_danh`) REFERENCES `dia_danh` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
