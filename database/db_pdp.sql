-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 09:11 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pdp`
--
CREATE DATABASE IF NOT EXISTS `db_pdp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_pdp`;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `kode` varchar(20) NOT NULL,
  `client` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `contract` date NOT NULL,
  `logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`kode`, `client`, `alamat`, `no_telp`, `contract`, `logo`) VALUES
('CL0001', 'STMIK Bandung', 'Jl. Gatau No. 120', '+6222101020205', '2019-04-05', '9914e297729249da846f20c3aa50a773.jpg'),
('CL0002', 'Indofood', 'Jl. Teuing No. 10', '+6222555111000', '2019-04-20', '');

-- --------------------------------------------------------

--
-- Table structure for table `contrib`
--

CREATE TABLE `contrib` (
  `id` int(11) NOT NULL,
  `kode_project` varchar(25) NOT NULL,
  `id_crew` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contrib`
--

INSERT INTO `contrib` (`id`, `kode_project`, `id_crew`) VALUES
(29, 'PRO0001', 5),
(30, 'PRO0001', 7);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `kode_project` varchar(20) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE `gambar` (
  `id` int(11) NOT NULL,
  `kode_project` varchar(20) NOT NULL,
  `gambar` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`id`, `kode_project`, `gambar`) VALUES
(23, 'PRO0001', '461a4faad154461de00c924cb91af134.jpg'),
(24, 'PRO0001', 'a7706b6bbd70249208c68ac977c18d78.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kode` varchar(20) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kode`, `kategori`) VALUES
('KT0001', 'Photoshoot'),
('KT0002', 'Cinematic'),
('KT0003', 'Campaign'),
('KT0004', 'Editing');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `kode` varchar(20) NOT NULL,
  `kode_kategori` varchar(20) NOT NULL,
  `kode_client` varchar(20) NOT NULL,
  `id_manager` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `tempat` varchar(150) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `content` text NOT NULL,
  `budget_plan` varchar(30) DEFAULT NULL,
  `budget_real` varchar(30) DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`kode`, `kode_kategori`, `kode_client`, `id_manager`, `judul`, `tempat`, `start`, `end`, `content`, `budget_plan`, `budget_real`, `status`) VALUES
('PRO0001', 'KT0001', 'CL0001', 1, 'Example Project', 'Gedung STMIK Bandung', '2019-07-08', '2019-07-10', '<p style=\"text-align: justify;\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n<p style=\"text-align: justify;\">Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.</p>', '1000000', '500000', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `kode_project` varchar(20) NOT NULL,
  `id_crew` int(20) NOT NULL,
  `task` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `submitted` date NOT NULL,
  `on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `kode_project`, `id_crew`, `task`, `status`, `submitted`, `on`) VALUES
(1, 'PRO0001', 5, 'Editing gradasi warna', 'Accomplished', '2019-07-08', '03:12:17 PM'),
(2, 'PRO0001', 5, 'Editing pencahayaan gambar', 'Accomplished', '2019-07-08', '03:12:23 PM'),
(3, 'PRO0001', 5, 'Editing penyelarasan background', 'Accomplished', '2019-07-08', '03:12:23 PM'),
(4, 'PRO0001', 7, 'Shoot FO', 'Accomplished', '2019-07-08', '03:14:48 PM'),
(5, 'PRO0001', 7, 'Shoot lobby', 'Accomplished', '2019-07-08', '03:14:52 PM'),
(6, 'PRO0001', 7, 'Shoot perpustakaan', 'Ignored', '0000-00-00', '00:00:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(35) NOT NULL,
  `specs` varchar(30) DEFAULT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `alamat`, `no_telp`, `email`, `password`, `role`, `specs`, `foto`) VALUES
(1, 'Admin PDP', 'Jl. Jalan No. 100', '+6285100200300', 'admin@oproject.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Admin', NULL, '84f062c3dbe0f8f846e9a50f55cc90b9.jpg'),
(2, 'Mr. Manager', 'Jl. Kemana No. 10', '+6289300200400', 'manager@oproject.com', 'dcddbbfbecf490d79e8758c290ddb27b01837f53', 'Manager', NULL, 'fc776ac07c07ec4f74038cdf963be836.jpg'),
(3, 'Rizky Irmawan', 'Jl. Gatau No. 1', '+6285900800700', 'rzky@oproject.com', 'dcddbbfbecf490d79e8758c290ddb27b01837f53', 'Kontributor', 'Editor', 'c25f5fd9f4c5a91d7d808ffeb2f583d4.jpg'),
(5, 'Fahmi Miftah Farid', 'Jl. Gatau No. 50', '+6282500400700', 'fahmi@oproject.com', 'dcddbbfbecf490d79e8758c290ddb27b01837f53', 'Kontributor', 'Editor', '453468ac2979df5c2acba8634866f4d9.jpg'),
(7, 'Pakih Fisherman', 'Jl. Kolang Kaling No. 15', '+6285101020205', 'pakih@oproject.com', 'dcddbbfbecf490d79e8758c290ddb27b01837f53', 'Kontributor', 'Photographer', '214b17f1ada6dfd7721e069897e99b82.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `contrib`
--
ALTER TABLE `contrib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contrib`
--
ALTER TABLE `contrib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
