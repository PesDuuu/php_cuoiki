-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 03:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webbanhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_user`, `admin_pass`, `admin_name`) VALUES
(1, 'huudu', '123456', 'huu du');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sid` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_status` int(3) DEFAULT NULL,
  `confirmation_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `product_id`, `product_name`, `image`, `quantity`, `order_date`, `order_status`, `confirmation_time`, `user_id`, `price`) VALUES
(2, 23, 'Final Fantasy VII Rebirth Deluxe Edition', '76dfb960ab.png', 1, NULL, NULL, NULL, 1, 2950000.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_soldout` int(11) DEFAULT 0,
  `price` decimal(10,2) NOT NULL,
  `product_desc` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` bit(1) NOT NULL,
  `product_remain` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_code`, `product_quantity`, `product_soldout`, `price`, `product_desc`, `image`, `type`, `product_remain`) VALUES
(21, 'Elden Ring: Shadow of the Erdtree Edition', 'elden01', 100, 59, 500000.00, '<p><span><span>Elden Ring</span>&nbsp;l&agrave; tựa game chiến thắng h&agrave;ng trăm giải thưởng bao gồm&nbsp;<span>\"Game of The Years\"</span>&nbsp;tại&nbsp;<span>The Game Awards</span>&nbsp;v&agrave;&nbsp;<span>\"Ultimate\'s Game of The Years\"</span>&nbsp;tại Giải thưởng&nbsp;<span>Golden Joystick</span>, đang mang đến một cuộc phi&ecirc;u lưu mới cho những người Tarnished tại V&ugrave;ng Trung Địa.</span>&nbsp;DLC Elden Ring:&nbsp;Shadow of the Erdtree&nbsp;l&agrave; bản mở rộng lớn nhất từ trước đến nay của FromSoftware, nơi người chơi phải v&eacute;n bức m&agrave;n b&iacute; mật ẩn giấu của thế giới từ tựa game h&agrave;nh động nhập vai phong c&aacute;ch huyền ảo được nhiều người y&ecirc;u th&iacute;ch.</p>', 'ac67e42eff.jpg', b'1', 41),
(22, 'Dragon\'s Dogma 2', 'dd2', 150, 0, 1550000.00, '<p><span><span>Đĩa game Dragon&rsquo;s Dogma 2 cho hệ m&aacute;y PS5 đang b&aacute;n tại Mimigame</span>&nbsp;l&agrave; phi&ecirc;n bản được mong chờ nhất của loạt game h&agrave;nh động nhập vai&nbsp;<span>Dragon&rsquo;s Dogma&trade;</span>&nbsp;nổi tiếng ph&aacute;t h&agrave;nh v&agrave;o năm 2012.&nbsp;</span>Dragon&rsquo;s Dogma 2&nbsp;sở hữu một thế giới huyền b&iacute; được tạo ra chi tiết v&agrave; s&acirc;u sắc bằng c&aacute;ch sử dụng vật l&yacute; sống động, tr&iacute; tuệ nh&acirc;n vật AI v&agrave; c&ocirc;ng nghệ đồ họa ti&ecirc;n tiến nhất từ RE ENGINE của Capcom. Nghề nghiệp của bạn cho ph&eacute;p bạn lựa chọn phong c&aacute;ch chơi của m&igrave;nh, v&agrave; liệu bạn sẽ sử dụng kiếm, cung, hay ph&eacute;p thuật mạnh mẽ để đ&aacute;nh bại kẻ th&ugrave; của bạn?</p>', '965d3b72a6.png', b'1', 150),
(23, 'Final Fantasy VII Rebirth Deluxe Edition', 'ff7rde', 120, 70, 2950000.00, '<p><span><span>Đĩa game&nbsp;</span></span><span><span>Final Fantasy VII Rebirth phi&ecirc;n bản Deluxe&nbsp;</span></span><span><span>của PS5.</span>&nbsp;</span><span>H</span><span>&agrave;nh tr&igrave;nh v&ocirc; danh vẫn tiếp tục... FINAL FANTASY VII REBIRTH l&agrave; c&acirc;u chuyện mới rất được mong đợi trong dự &aacute;n l&agrave;m lại FINAL FANTASY VII, một sự t&aacute;i hiện lại tr&ograve; chơi gốc mang t&iacute;nh biểu tượng th&agrave;nh ba tựa game độc lập bởi những người tạo ra n&oacute;</span></p>', '76dfb960ab.png', b'1', 50),
(24, 'Final Fantasy VII Rebirth', 'ff7re', 100, 0, 1590000.00, '<p><span>Đĩa game&nbsp;</span><span>Final Fantasy VII Rebirth phi&ecirc;n bản Deluxe&nbsp;</span><span><span>của PS5.</span>&nbsp;</span><span>H</span><span>&agrave;nh tr&igrave;nh v&ocirc; danh vẫn tiếp tục... FINAL FANTASY VII REBIRTH l&agrave; c&acirc;u chuyện mới rất được mong đợi trong dự &aacute;n l&agrave;m lại FINAL FANTASY VII, một sự t&aacute;i hiện lại tr&ograve; chơi gốc mang t&iacute;nh biểu tượng th&agrave;nh ba tựa game độc lập bởi những người tạo ra n&oacute;</span></p>\r\n<p><span><br /></span></p>', '1d31fba0af.png', b'1', 100),
(25, 'Sand Land', 'sandland', 50, 0, 300000.00, '<p><span>Bước v&agrave;o một thế giới sa mạc, nơi cả con người v&agrave; quỷ ma đều đối mặt với t&igrave;nh trạng thiếu nước nghi&ecirc;m trọng. H&atilde;y nhập vai v&agrave; theo ch&acirc;n Ho&agrave;ng tử Quỷ, Beelzebub, Thống đốc Rao v&agrave; t&ecirc;n trộm quỷ trong cuộc h&agrave;nh tr&igrave;nh t&igrave;m kiếm một Suối Nguồn Huyền thoại được giấu k&iacute;n trong l&ograve;ng sa mạc.</span></p>', '8c68dff900.png', b'1', 50),
(26, 'Rise of the Ronin', 'riseronin', 150, 0, 1200000.00, '<p><span>Nhật Bản, năm 1863. Sau ba thế kỷ của chế độ &aacute;p bức của&nbsp;</span><span>Shogunate Tokugawa</span><span>, c&aacute;c T&agrave;u Đen của phương T&acirc;y đang tiến xuống bi&ecirc;n giới của quốc gia v&agrave; đất nước rơi v&agrave;o t&igrave;nh trạng hỗn loạn. Giữa cảnh chiến tranh, dịch bệnh v&agrave; bất ổn ch&iacute;nh trị, một chiến binh kh&ocirc;ng t&ecirc;n đi t&igrave;m con đường ri&ecirc;ng, đồng thời nắm giữ số phận của Nhật Bản trong tay m&igrave;nh.....</span></p>', '26dff156f2.png', b'1', 150);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `password`, `address`, `phone`) VALUES
(1, 'Huu Du', 'huudu951@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '133/5', '0783894358'),
(2, 'thinh', 'thinh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'quãng ngãi', '012345689');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
