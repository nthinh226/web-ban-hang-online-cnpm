-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 25, 2022 at 05:13 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuahangmaytinh`
--

DELIMITER $$
--
-- Functions
--
DROP FUNCTION IF EXISTS `ExtractNumber`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `ExtractNumber` (`in_string` VARCHAR(50)) RETURNS INT(11) NO SQL
BEGIN
    DECLARE ctrNumber VARCHAR(50);
    DECLARE finNumber VARCHAR(50) DEFAULT '';
    DECLARE sChar VARCHAR(1);
    DECLARE inti INTEGER DEFAULT 1;

    IF LENGTH(in_string) > 0 THEN
        WHILE(inti <= LENGTH(in_string)) DO
            SET sChar = SUBSTRING(in_string, inti, 1);
            SET ctrNumber = FIND_IN_SET(sChar, '0,1,2,3,4,5,6,7,8,9'); 
            IF ctrNumber > 0 THEN
                SET finNumber = CONCAT(finNumber, sChar);
            END IF;
            SET inti = inti + 1;
        END WHILE;
        RETURN CAST(finNumber AS UNSIGNED);
    ELSE
        RETURN 0;
    END IF;    
END$$

DROP FUNCTION IF EXISTS `thanhtien`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `thanhtien` (`soluong` INT, `giatien` FLOAT, `giamgia` FLOAT) RETURNS FLOAT BEGIN
	return (soluong*giatien)-giamgia;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `chitietdh`
--

DROP TABLE IF EXISTS `chitietdh`;
CREATE TABLE IF NOT EXISTS `chitietdh` (
  `id_item` int(11) NOT NULL,
  `sodh` varchar(20) NOT NULL,
  `masp` varchar(20) NOT NULL,
  `soluong` int(11) NOT NULL,
  `giatien` float NOT NULL,
  `giamgia` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_item`,`sodh`),
  KEY `sodh` (`sodh`),
  KEY `masp` (`masp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chitietdh`
--

INSERT INTO `chitietdh` (`id_item`, `sodh`, `masp`, `soluong`, `giatien`, `giamgia`) VALUES
(1, 'DH1', 'CPUI1', 2, 2699000, 0),
(2, 'DH1', 'CPUI2', 1, 4399000, 0),
(3, 'DH2', 'CPUI2', 1, 4399000, 0),
(5, 'DH3', 'MBGI3', 1, 6059000, 500000),
(6, 'DH4', 'CPUI2', 1, 4399000, 0),
(7, 'DH5', 'PWCO1', 1, 3339000, 320000),
(8, 'DH6', 'VGAAS1', 1, 55449000, 0),
(9, 'DH7', 'HDDSE1', 1, 1999000, 0),
(10, 'DH8', 'VGAGI3', 1, 66999000, 0),
(11, 'DH9', 'CPUA5', 1, 100100000, 2931000),
(12, 'DH9', 'MBMS4', 1, 22999000, 0),
(13, 'DH9', 'PWCO1', 1, 3339000, 320000),
(14, 'DH9', 'RACO1', 2, 1419000, 290000),
(15, 'DH9', 'SSDKT1', 2, 909000, 230000),
(16, 'DH9', 'VGAAS1', 1, 55449000, 0),
(17, 'DH10', 'CSCO1', 1, 2179000, 171000);

-- --------------------------------------------------------

--
-- Table structure for table `dondathang`
--

DROP TABLE IF EXISTS `dondathang`;
CREATE TABLE IF NOT EXISTS `dondathang` (
  `sodh` varchar(20) NOT NULL,
  `ngaydh` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngaydukiengiao` date DEFAULT NULL,
  `ngaythuctegiao` varchar(200) DEFAULT NULL,
  `makh` varchar(20) NOT NULL,
  `manv` varchar(20) DEFAULT NULL,
  `trangthaidh` int(11) NOT NULL DEFAULT 0,
  `ghichu` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`sodh`),
  KEY `makh` (`makh`),
  KEY `manv` (`manv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dondathang`
--

INSERT INTO `dondathang` (`sodh`, `ngaydh`, `ngaydukiengiao`, `ngaythuctegiao`, `makh`, `manv`, `trangthaidh`, `ghichu`) VALUES
('DH1', '2021-11-04 06:47:24', '2021-11-05', '2021-11-05 15:00:09', 'KH1', 'NV1', 2, NULL),
('DH10', '2021-11-07 11:47:24', '2021-11-09', '2021-11-09 09:03:19', 'KH2', 'NV1', 2, '123         '),
('DH2', '2021-11-03 06:47:24', '2021-11-04', '2021-11-04 00:00:00', 'KH1', 'NV1', 2, NULL),
('DH3', '2022-02-25 06:47:24', '2021-11-04', '26-02-2022 12:12:23 AM', 'KH2', 'NV1', 3, 'thích thì huỷ                                    '),
('DH4', '2021-11-02 12:08:38', '2021-11-02', '2021-11-02 17:32:00', 'KH1', NULL, 2, NULL),
('DH5', '2021-11-04 06:47:24', '2021-11-06', '2021-11-06 23:13:50', 'KH1', 'NV1', 2, NULL),
('DH6', '2021-11-01 06:47:24', '2021-11-03', '2021-11-03 09:59:00', 'KH1', 'NV1', 2, NULL),
('DH7', '2021-11-03 06:47:24', '2021-11-04', NULL, 'KH1', NULL, 0, NULL),
('DH8', '2021-11-03 06:47:24', '2021-11-04', '2021-11-04 08:00:00', 'KH1', NULL, 2, NULL),
('DH9', '2021-11-07 06:47:24', '2021-11-09', NULL, 'KH3', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `makh` varchar(20) NOT NULL,
  `hotenkh` varchar(255) NOT NULL,
  `gioitinh` varchar(20) NOT NULL DEFAULT '''Khác''',
  `ngaysinh` date DEFAULT NULL,
  `sdt` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `diachigiaohang` varchar(255) DEFAULT NULL,
  `ngaydangky` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` text DEFAULT NULL,
  PRIMARY KEY (`makh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`makh`, `hotenkh`, `gioitinh`, `ngaysinh`, `sdt`, `email`, `matkhau`, `diachigiaohang`, `ngaydangky`, `avatar`) VALUES
('KH1', 'Thịnh Trần', 'Nam', '2001-02-26', '0384735254', 'ngocthinh1126@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '79/8 QL 13, P26, Q. BT, TP.HCM', '2021-10-25 13:46:00', '62ce711a383c11e25613090d0bf28faf.jpeg'),
('KH2', 'Phạm Đình Lộc', 'Nam', '2000-10-15', '0345352262', 'locpham@gmail.com', '53981ee729ab8f4ee29d896489df57a8', '14 Ung Văn Khiêm, Bình Thạnh', '2021-10-25 13:46:00', '7ed8cabffbae795eacf3e7a49c95e877.jpeg'),
('KH3', 'Trần Đinh Diệu Mi', 'Nữ', '2001-09-29', '0766651677', 'mitran@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Phước Quang - Tuy Phước - Bình Định', '2021-11-07 06:42:21', 'dcd17c6e62b8f0c64e6d86de6de9e9c1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `nhacungcap`
--

DROP TABLE IF EXISTS `nhacungcap`;
CREATE TABLE IF NOT EXISTS `nhacungcap` (
  `mancc` varchar(20) NOT NULL,
  `tenncc` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sdt` varchar(50) NOT NULL,
  `fax` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mancc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nhacungcap`
--

INSERT INTO `nhacungcap` (`mancc`, `tenncc`, `diachi`, `email`, `sdt`, `fax`) VALUES
('NCC1', 'Dell', '23 Nguyễn Thị Huỳnh, Phường 8, Quận Phú Nhuận, TP.HCM', 'No support', '0838424342', ''),
('NCC2', 'FPT', 'Tòa nhà FPT Tân Thuận, Lô L29B-31B-33B,  đường số 8, KCX Tân Thuận, phường Tân Thuận Đông, quận 7, Thành phố Hồ Chí Minh, Việt Nam', 'fptshop@fpt.com.vn', '02873023456', '');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
CREATE TABLE IF NOT EXISTS `nhanvien` (
  `manv` varchar(20) NOT NULL,
  `hotennv` varchar(255) NOT NULL,
  `ngaysinh` date DEFAULT NULL,
  `gioitinh` varchar(20) NOT NULL DEFAULT 'Khác',
  `sdt` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tendangnhap` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `avatar` text DEFAULT NULL,
  `quyen` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`manv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `hotennv`, `ngaysinh`, `gioitinh`, `sdt`, `email`, `tendangnhap`, `matkhau`, `avatar`, `quyen`) VALUES
('NV1', 'Trần Ngọc Thịnh', '2001-02-26', 'Nam', '0384735254', 'ngocthinh1126@gmail.com', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'IMG_0584.JPG', 0),
('NV2', 'Trần Đinh Diệu Mi', '2021-10-19', 'Nữ', '0766651677', 'mi@gmail.com', 'mi', '29bfe372865737fe2bfcfd3618b1da7d', '3d42591a5380570ce6be43df8dac4235.jpeg', 1),
('NV3', 'Lê Huy Hoàng', '2001-12-30', 'Nam', '0938476523', 'huyhoang@gmail.com', 'hoang123', 'c4ca4238a0b923820dcc509a6f75849b', 'db5d003d09a2cefa8e15d760a55b1bd2.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `masp` varchar(20) NOT NULL,
  `mancc` varchar(20) NOT NULL,
  `tensp` varchar(255) NOT NULL,
  `maloai` varchar(20) NOT NULL,
  `giasp` float NOT NULL,
  `giakhuyenmai` float DEFAULT 0,
  `mota` text DEFAULT NULL,
  `hinhanhsp` text DEFAULT NULL,
  `ngaytao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngaycapnhat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`masp`),
  KEY `maloai` (`maloai`),
  KEY `mancc` (`mancc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`masp`, `mancc`, `tensp`, `maloai`, `giasp`, `giakhuyenmai`, `mota`, `hinhanhsp`, `ngaytao`, `ngaycapnhat`) VALUES
('CPUA3', 'NCC1', 'CPU AMD Ryzen 5 5600G (3.9GHz Upto 4.4GHz / 19MB / 6 Cores, 12 Threads / 65W / Socket AM4)', 'CPU', 6959000, 0, 'CPU Ryzen. sửa', '042eb9136d1389019c69ec5ad0bd47d1.jpeg', '2021-11-04 13:43:36', '09-11-2021 09:06:15 AM'),
('CPUA4', 'NCC1', 'CPU AMD Ryzen Threadripper 3960X (3.8GHz turbo up to 4.5GHz, 24 nhân 48 luồng, 140MB Cache, 280W) - Socket sTRX4', 'CPU', 36799000, 0, 'Thông số sản phẩm\nCPU Threadripper thế hệ thứ 3 được mong chờ của AMD\n24 nhân & 48 luồng\nXung cơ bản: 3.8 GHz\nXung tối đa (boost): 4.5 GHz\nChạy tốt trên các mainboard socket sTRX4\nPhù hợp cho những nhà sáng tạo nội dung', 'bcdd29ffd590d3b0525cf9784b7d7dfa.jpeg', '2021-11-04 13:44:11', NULL),
('CPUA5', 'NCC1', 'CPU AMD EPYC 7F52 (3.5GHz turbo up to 3.9GHz / 256MB / 16 Cores, 32 Threads / 240W / Socket SP3)', 'CPU', 100100000, 97169000, 'Thông số sản phẩm\nCPU đa nhân của AMD dành cho hệ thống sever\nTốc độ: 3.9Ghz\nSố nhân: 16\nSố luồng: 32', 'ebadec13c0be77232861faf10ab1f225.jpeg', '2021-11-04 13:45:02', NULL),
('CPUI1', 'NCC2', 'CPU Intel Core i3-10105F', 'CPU', 2699000, 0, '(3.7GHz turbo up to 4.4Ghz, 4 nhân 8 luồng, 6MB Cache, 65W)', '2631734e2304b1e4411f2c9c1ae7a337.jpeg', '2021-10-30 08:29:19', NULL),
('CPUI2', 'NCC2', 'CPU Intel Core i5-10400F', 'CPU', 4399000, 0, 'core i5 thế hệ 10', 'b17d5322e542abf50df228038da29b1e.jpeg', '2021-10-30 08:29:45', '07-11-2021 02:20:19 PM'),
('CSCM2', 'NCC2', 'Vỏ Case Cooler Master MasterCase H500P TG Mesh ARGB (Mid Tower/Màu đen/Led ARGB/Mặt lưới)', 'CS', 4069000, 0, 'Thông số sản phẩm\nHỗ trợ mainboard: Mini ITX, Micro ATX, ATX, E-ATX (tối đa 12 x 10.7 inch)\nRadiator lắp đặt tối đa: 2x280/360mm và 1 x 120/140mm\nChiều cao tản nhiệt CPU tối đa: 190mm\nChiều dài VGA: 412mm', 'fbf8de972464a8283a5a45c5ba72f677.jpeg', '2021-11-04 13:47:48', NULL),
('CSCM3', 'NCC2', 'Vỏ case Cooler Master MasterBox NR200P Purple  (Mini ITX Tower/Màu Tím)', 'CS', 2459000, 0, 'Thông số sản phẩm\nKích thước cực kỳ nhỏ gọn, dành cho những ai yêu thích không gian làm việc gọn gàng\nMặt kính bên hông sẵn sàng khoe trọn nội thất bên trong\nKhả năng hỗ trợ làm mát đa dạng\nHỗ trợ Card đồ họa 3 slot\nDễ dàng tháo lắp không cần dụng cụ\nKhả năng truy xuất phần cứng 360 độ\nHỗ trợ bo mạch chủ: Mini DTX, Mini ITX, tối đa: 244 x 226mm\nHỗ trợ tản nhiệt nước Custom\nChất liệu hoàn thiện cao cấp\nMặt hông thiết kế dạng lỗ giúp thoát nhiệt nhanh chóng\nKèm sẵn dây Riser nối dài\nPhiên bản màu tím phong cách', '6d440d98f201cd6914b582fccec4a24b.jpeg', '2021-11-04 13:48:38', NULL),
('CSCO1', 'NCC2', 'Vỏ Case Corsair 4000D TG White', 'CS', 2179000, 2008000, 'Mẫu vỏ case kích thước mid ATX, khung thép chắc chắn và đặc biệt bởi khả năng quản lý dây cáp dễ dàng.\nĐi kèm 2 quạt Corsair AirGuide 120mm cho hiệu quả làm mát vượt trội.\nMặt kính cường lực bên hông, khe dựng dọc VGA được tích hợp sẵn.\nHỗ trợ card đồ họa dài tối đa: 360mm\nHỗ trợ CPU cao tối đa: 170mm\nTông màu trắng đem lại vẻ sạch và sang trọng cho góc máy của bạn.', 'e4af5965573baf11f633de558df74d0e.jpeg', '2021-10-30 08:31:50', NULL),
('CSGI4', 'NCC2', 'Vỏ Case Gigabyte GB-AC300G Tempered Glass Gaming (Mid Tower/Màu Đen/Led RGB)', 'CS', 2589000, 0, 'Thông số sản phẩm\nKính cường lực hông 4mm\nMặt trước tích hợp cổng HDMI và cổng USB Type C 3.1\nHỗ trợ xoay, dựng dọc VGA\nTương thích hệ thống tản nước\nKhay che nguồn với logo độc đáo\nMiếng lọc bụi có thể tháo rời', '2e01c8ebc3f949f3f01bf342ccce4319.jpeg', '2021-11-04 13:51:16', NULL),
('HDDSE1', 'NCC1', 'Ổ cứng HDD Seagate SkyHawk 2TB 3.5 inch, 5900RPM, SATA3, 64MB Cache', 'HDD', 1999000, 1559000, 'Dung lượng: 2TB\nTốc độ vòng quay: 5900rpm\nBộ nhớ đệm: 64MB Cache\nKích thước: 3.5”\nChuẩn kết nối: SATA 6Gb/s', '27230a523e40b3fbb05fd49868252106.jpeg', '2021-10-30 08:33:02', NULL),
('MBAS1', 'NCC2', 'Mainboard ASUS TUF GAMING B550M-PLUS', 'MB', 3799000, 0, '', '5db630cf0fc03f41f93cb20cab8b64f3.jpeg', '2021-10-30 08:34:07', NULL),
('MBAS2', 'NCC2', 'Mainboard ASUS PRIME B550M-A', 'MB', 2899000, 2699000, '', '41946935c4d6bfffb258cde89fbb7015.jpeg', '2021-10-30 08:34:37', NULL),
('MBGI3', 'NCC2', 'Mainboard GIGABYTE X570 AORUS ELITE', 'MB', 6059000, 5559000, 'Thiết kế nhiệt tiên tiến với tản nhiệt mở rộng\nDual PCIe 4.0 M.2 với Bộ bảo vệ nhiệt đơn\nIntel ® GbE LAN với cFosSpeed\nUSB phía trước Type-C, RGB Fusion 2.0', 'de83b570c0d20eb05b1d144a13bfc60b.jpeg', '2021-10-30 08:35:19', NULL),
('MBMS4', 'NCC2', 'Mainboard MSI MEG Z590 GODLIKE', 'MB', 22999000, 0, 'Thông số sản phẩm\nBo mạch chủ Z590 cao cấp nhất của MSI\nChipset: Intel Z590\nSocket: LGA 1200\nKích thước: E-ATX\nSố khe RAM: 4\nTích hợp sẵn Wifi', '625a9a883b799c2b4904b2c972e106f4.jpeg', '2021-11-04 13:38:48', NULL),
('PWCM2', 'NCC2', 'Nguồn máy tính Cooler Master Elite V3 230V PC600 600W (Màu Đen)', 'PW', 1069000, 979000, 'Thông số sản phẩm\nCông nghệ Active PFC\nKháng nhiệt độ cao hơn\nHiệu quả công suất lên tới 75%', 'd2cb1e52359778b8a5a65fa727950218.jpeg', '2021-11-04 13:46:20', NULL),
('PWCO1', 'NCC2', 'Nguồn Corsair RM Series RM750 - 750W', 'PW', 3339000, 3019000, 'Chứng nhận 80 PLUS Gold: hoạt động hiệu quả , tiết kiệm điện năng, ít tiếng ồn và nhiệt độ mát hơn.\nTự điều chỉnh tiếng ồn khi hoạt động: quạt 140mm với đường cong quạt được tính toán đặc biệt đảm bảo tiếng ồn khi hoạt động được giữ ở mức tối thiểu, ngay cả khi hoạt động tối đa công suất\nSử dụng tụ điện 105 ° C: tụ điện cấp công nghiệp cho hiệu suất cao và hoạt động ổn định\nTương thích với chế độ chờ mới nhất của Microsoft: thời gian thức dậy cực nhanh và hiệu quả tải thấp tốt hơn.\nChế độ quạt Zero RPM: ở mức tải thấp và trung bình Quạt làm mát tắt hoàn toàn cho hoạt động gần như im lặng.', '5bdf5c20de5e68cc2009c8520e2d7320.jpeg', '2021-10-30 08:37:32', NULL),
('RACO1', 'NCC2', 'RAM Desktop CORSAIR Vengeance LPX (CMK8GX4M1A2666C16 ) 8GB (1x8GB) DDR4 2666MHz', 'RA', 1419000, 1129000, 'Chủng loại: Bộ nhớ trong\nHãng sản xuất: Corsair\nSeries: VENGEANCE® LPX\nLoại RAM: DDR4\nĐóng gói: 8GB (1x8GB)\nBus: 2666MHz\nĐộ trễ: 16-18-18-35\nĐiện áp: 1.2V\nTản nhiệt: Nhôm truyền thống.', 'a844abe629396ec72eb0d404578dd851.jpeg', '2021-10-30 08:38:06', NULL),
('RAKT2', 'NCC2', 'Ram Desktop Kingston HyperX Fury RBG (HX432C16FB3AK2/16 ) 16GB (2x8GB) DDR4 3200Mhz', 'RA', 2859000, 0, 'Thông số sản phẩm\nKiểu RAM: Ram PC\nLoại bộ nhớ: DDR4\nLED RGB\nCó tản nhiệt\nBao gồm 2 thanh 8GB.', '38040f8f1a53f9104b384ec8c163cae6.jpeg', '2021-11-07 17:48:45', NULL),
('SSDCO2', 'NCC2', 'Ổ cứng SSD Corsair MP600 PRO 1TB M.2 2280 PCIe NVMe Gen 4x4 (Đoc 7000MB/s, Ghi 5500MB/s) - (CSSD-F1000GBMP600PRO)', 'SSD', 6599000, 0, 'Thông số sản phẩm\nLoại: Ổ cứng SSD M.2 NVME\nChuẩn kết nối: PCI-E 4.0\nDung lượng: 1TB', 'fb6d389a78c1c28d78249fd0634b9522.jpeg', '2021-11-04 15:07:24', NULL),
('SSDKT1', 'NCC1', 'Ổ cứng SSD Kingston A400 120GB 2.5 inch SATA3', 'SSD', 909000, 679000, 'Dung lượng: 120GB\nKích thước: 2.5', '28afe22e47f3f647e777ba88ef3ea77c.jpeg', '2021-10-30 08:39:00', NULL),
('VGAAS1', 'NCC2', 'Card màn hình Asus ROG STRIX-LC-RTX 3080 Ti-O12G-GAMING', 'VGA', 55449000, 0, 'Thông số sản phẩm\nNhân đồ họa: Nvidia RTX 3080Ti\nSố nhân Cuda: 10240\nDung lượng VRAM: 12GB GDDR6X', '6fee48022ebe15caa64dfacdd9ae2e3b.jpeg', '2021-11-04 13:40:13', NULL),
('VGAAS2', 'NCC1', 'Card màn hình ASUS PH-GT1030-O2G (2GB GDDR5, 64-bit, DVI+HDMI', 'VGA', 2599000, 0, 'Chip đồ họa: NVIDIA GeForce GT 1030\nBộ nhớ: 2GB GDDR5 ( 64-bit )\nGPU clock Chế độ OC - Xung Tăng cường GPU : 1531 MHz , Xung Nền GPU : 1278 MHz Chế độ Chơi Game - Xung Tăng cường GPU : 1506 MHz , Xung Nền GPU : 1252 MHz\nNguồn phụ: Không nguồn phụ', 'df2682746670d19f514f7b5e0ea3c114.jpeg', '2021-11-04 13:41:48', NULL),
('VGAGI3', 'NCC2', 'Card màn hình Gigabyte RTX 3090 AORUS XTREME-24GD', 'VGA', 66999000, 0, 'Thông số sản phẩm\nDung lượng bộ nhớ: 24Gb GDDR6X\n10496 CUDA Cores\nCore Clock: 1860 MHZ\nKết nối: DisplayPort 1.4a x3, HDMI 2.1 x2\nNguồn yêu cầu: 750W', '7538bdb167ed57a2fbe2ba732005e6f8.jpeg', '2021-11-04 13:49:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

DROP TABLE IF EXISTS `theloai`;
CREATE TABLE IF NOT EXISTS `theloai` (
  `matl` varchar(20) NOT NULL,
  `tentl` varchar(255) NOT NULL,
  `mota` text DEFAULT NULL,
  `ngaytao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngaycapnhat` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`matl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`matl`, `tentl`, `mota`, `ngaytao`, `ngaycapnhat`) VALUES
('CA', 'Card Âm Thanh', '', '2021-10-30 15:21:50', '2022-02-25 22:02:10'),
('CPU', 'CPU - Bộ vi xử lý', 'cpu chất lượng cao', '2021-10-14 16:31:36', '2022-02-25 22:02:10'),
('CS', 'Case - Vỏ máy tính', 'case máy tính', '2021-10-14 16:39:17', '2022-02-25 22:02:10'),
('DW', 'ODD - Ổ Đĩa Quang', '', '2021-10-30 15:22:49', '2022-02-25 22:02:10'),
('HDD', 'Ổ cứng HDD', 'Giúp lưu trữ dữ liệu', '2021-10-14 16:38:45', '2022-02-25 22:02:10'),
('MB', 'Mainboard - Bo mạch chủ', 'mainboard', '2021-10-14 16:32:08', '2022-02-25 22:02:10'),
('PW', 'PSU - Nguồn máy tính', 'nguồn', '2021-10-14 16:43:36', '2022-02-25 22:02:10'),
('RA', 'RAM - Bộ nhớ trong', 'ram', '2021-10-14 17:27:59', '2022-02-25 22:02:10'),
('SSD', 'Ổ cứng SSD', 'ổ đĩa lưu trữ dữ liệu', '2021-10-14 16:39:05', '2022-02-25 22:02:10'),
('VGA', 'VGA - Card Màn Hình', 'vga', '2021-10-14 16:38:04', '2022-02-25 22:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `thuonghieu`
--

DROP TABLE IF EXISTS `thuonghieu`;
CREATE TABLE IF NOT EXISTS `thuonghieu` (
  `math` varchar(20) NOT NULL,
  `tenth` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '''Contact and support page''',
  `sdt` varchar(50) NOT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`math`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thuonghieu`
--

INSERT INTO `thuonghieu` (`math`, `tenth`, `diachi`, `email`, `sdt`, `fax`, `website`) VALUES
('A', 'AMD - Advanced Micro Devices', 'Tầng 9. Paxsky, 13-15-17 Trương Định, P6, quận 3, TPHCM, Việt Nam', 'hotro@amdvietnam.com.vn', '(028) 35 123 959', '', 'https://www.amdvietnam.com.vn/'),
('AS', 'ASUS', 'ASUS Computer International 800 Corporate Way Fremont, CA 94539', 'ASUS contact and support page', '(510) 739-3777', '(510) 608-4555', 'https://www.asus.com'),
('CM', 'Cooler Master', '8F., No. 788-1, Zhongzheng Rd., Zhonghe Dist., New Taipei City 23586, Taiwan (R.O.C.)', 'support@coolermaster.com.vn', '+886-2-3234-0221', '+886-2-3234-0221', 'https://www.coolermaster.com'),
('CO', 'Corsair', '47100 BAYSIDE PARKWAY FREMONT, CA 94538', 'No support', '+1 888-222-4346', '', 'https://www.corsair.com/'),
('GI', 'GIGA-BYTE TECHNOLOGY CO., LTD', 'No.6, Baoqiang Rd., Xindian Dist., New Taipei City 231, Taiwan', 'Contact and support page', '+886-2-8912-4000', '', 'https://www.gigabyte.com'),
('I', 'Intel', '2200 Mission College Blvd. Santa Clara, CA 95054-1549 USA', 'No support', '(408) 765-8080', '', 'https://www.intel.vn/'),
('KT', 'Kingston', 'No. 1-5, Li-Hsin Road., 1 Science Based Industrial Park, Hsin-Chu, Taiwan', 'asiasales@kingston.com.tw', '+886-3-564-1539', '886-3-566-6891', 'https://www.kingston.com/vn'),
('MS', 'Micro-Star INTL CO.,LTD', 'Room 605, 2F, No., 601, Yunling E. Rd., Putuo District, Shanghai, China', 'Rockyzhang@msi.com', '+86-21-22230558', '+86-21-22230599', 'http://ipc.msi.com'),
('SE', 'Seagate', '16A6 Lý Nam Đế, Hoàn Kiếm, Hà Nội', 'ntnguyet@seagatevietnam.com', '0973650696', '', 'https://seagatevietnam.com/');

-- --------------------------------------------------------

--
-- Table structure for table `thuonghieusanpham`
--

DROP TABLE IF EXISTS `thuonghieusanpham`;
CREATE TABLE IF NOT EXISTS `thuonghieusanpham` (
  `mathuonghieu` varchar(20) NOT NULL,
  `masanpham` varchar(20) NOT NULL,
  PRIMARY KEY (`mathuonghieu`,`masanpham`),
  KEY `masanpham` (`masanpham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thuonghieusanpham`
--

INSERT INTO `thuonghieusanpham` (`mathuonghieu`, `masanpham`) VALUES
('A', 'CPUA3'),
('A', 'CPUA4'),
('A', 'CPUA5'),
('AS', 'MBAS1'),
('AS', 'MBAS2'),
('AS', 'VGAAS1'),
('AS', 'VGAAS2'),
('CM', 'CSCM2'),
('CM', 'CSCM3'),
('CM', 'PWCM2'),
('CO', 'CSCO1'),
('CO', 'PWCO1'),
('CO', 'RACO1'),
('CO', 'SSDCO2'),
('GI', 'CSGI4'),
('GI', 'MBGI3'),
('GI', 'VGAGI3'),
('I', 'CPUI1'),
('I', 'CPUI2'),
('KT', 'RAKT2'),
('KT', 'SSDKT1'),
('MS', 'MBMS4'),
('SE', 'HDDSE1');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_baocaodoanhthutheongay`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_baocaodoanhthutheongay`;
CREATE TABLE IF NOT EXISTS `view_baocaodoanhthutheongay` (
`ngay` date
,`sodon` bigint(21)
,`tongtien` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_donhang`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_donhang`;
CREATE TABLE IF NOT EXISTS `view_donhang` (
`sodh` varchar(20)
,`makh` varchar(20)
,`hotenkh` varchar(255)
,`email` varchar(255)
,`sdt` varchar(50)
,`diachigiaohang` varchar(255)
,`ngaydh` timestamp
,`tongtien` double
,`trangthaidh` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `view_baocaodoanhthutheongay`
--
DROP TABLE IF EXISTS `view_baocaodoanhthutheongay`;

DROP VIEW IF EXISTS `view_baocaodoanhthutheongay`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_baocaodoanhthutheongay`  AS  select cast(`v`.`ngaydh` as date) AS `ngay`,count(`v`.`sodh`) AS `sodon`,sum(`v`.`tongtien`) AS `tongtien` from `view_donhang` `v` where `v`.`trangthaidh` <> 3 group by cast(`v`.`ngaydh` as date) ;

-- --------------------------------------------------------

--
-- Structure for view `view_donhang`
--
DROP TABLE IF EXISTS `view_donhang`;

DROP VIEW IF EXISTS `view_donhang`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_donhang`  AS  select `d`.`sodh` AS `sodh`,`d`.`makh` AS `makh`,`k`.`hotenkh` AS `hotenkh`,`k`.`email` AS `email`,`k`.`sdt` AS `sdt`,`k`.`diachigiaohang` AS `diachigiaohang`,`d`.`ngaydh` AS `ngaydh`,sum(`c`.`soluong` * `c`.`giatien` - `c`.`giamgia`) AS `tongtien`,`d`.`trangthaidh` AS `trangthaidh` from ((`dondathang` `d` join `chitietdh` `c` on(`c`.`sodh` = `d`.`sodh`)) join `khachhang` `k` on(`k`.`makh` = `d`.`makh`)) group by `d`.`sodh` ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdh`
--
ALTER TABLE `chitietdh`
  ADD CONSTRAINT `chitietdh_ibfk_1` FOREIGN KEY (`sodh`) REFERENCES `dondathang` (`sodh`),
  ADD CONSTRAINT `chitietdh_ibfk_2` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`);

--
-- Constraints for table `dondathang`
--
ALTER TABLE `dondathang`
  ADD CONSTRAINT `dondathang_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`),
  ADD CONSTRAINT `dondathang_ibfk_2` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`maloai`) REFERENCES `theloai` (`matl`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`mancc`) REFERENCES `nhacungcap` (`mancc`);

--
-- Constraints for table `thuonghieusanpham`
--
ALTER TABLE `thuonghieusanpham`
  ADD CONSTRAINT `thuonghieusanpham_ibfk_1` FOREIGN KEY (`masanpham`) REFERENCES `sanpham` (`masp`),
  ADD CONSTRAINT `thuonghieusanpham_ibfk_2` FOREIGN KEY (`mathuonghieu`) REFERENCES `thuonghieu` (`math`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
