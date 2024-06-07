
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(7) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `colour` varchar(25) NOT NULL,
  `year` int(11) NOT NULL,
  `fuel_type` varchar(100) NOT NULL,
  `registration` varchar(10) NOT NULL,
  `mileage` int(11) NOT NULL,
  `transmission_type` varchar(15) NOT NULL,
  `car_condition` varchar(4) NOT NULL,
  `category_id` int(4) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `manufacturer`, `model`, `colour`, `year`, `fuel_type`, `registration`, `mileage`, `transmission_type`, `car_condition`, `category_id`, `price`, `description`) VALUES
(1, 'Mitsubishi', 'Eclipse GSX', 'White', 2005, 'Pertamax', 'ABC111', 105000, 'ManuaL', 'Used', 3, 12000, 'Mitsubishi Eclipse adalah mobil sport kompak yang telah menjadi favorit di pasar otomotif sejak diperkenalkan pada tahun 1989. Dikenal karena desainnya yang sporty dan performa dinamis, Eclipse telah menjadi pilihan bagi mereka yang mencari pengalaman berkendara yang menyenangkan dan mengasyikkan.\r\n\r\nDesain yang Menawan:\r\nEclipse menampilkan desain yang menawan dengan bodi coupe dua pintu yang aerodinamis dan garis-garis yang tajam. Detail-desain seperti spoiler belakang, gril depan yang menonjol, dan lampu depan yang ikonik memberikan karakter yang unik dan menarik.\r\n\r\nPerforma yang Mengagumkan:\r\nDengan sejarahnya yang dipenuhi dengan varian bertenaga dan sporty, Eclipse menawarkan performa yang mengagumkan di jalan raya. Mesin yang bertenaga, terutama varian turbocharged, memberikan akselerasi yang cepat dan responsif, sementara sistem suspensi yang dikalibrasi dengan baik memberikan stabilitas dan kelincahan di setiap tikungan.\r\n\r\nFitur dan Teknologi Terbaru:\r\nMitsubishi Eclipse dilengkapi dengan berbagai fitur dan teknologi terbaru untuk meningkatkan kenyamanan, keamanan, dan hiburan. Sistem multimedia canggih, kontrol iklim otomatis, dan fitur-fitur keselamatan seperti pengereman darurat otomatis dan pengawasan titik buta menambah nilai dan daya tarik mobil ini.\r\n\r\nWarisan dan Reputasi:\r\nSebagai salah satu mobil sport kompak yang paling diingat dalam sejarah otomotif, Mitsubishi Eclipse memiliki warisan yang kaya dan reputasi yang kuat di kalangan penggemar mobil. Meskipun produksi resminya berakhir, Eclipse tetap menjadi simbol kekuatan, gaya, dan kegembiraan di dunia otomotif.'),
(2, 'Ford', 'GT', 'White Blue', 2011, 'Pertamax', 'ABC2', 95000, 'Manual', 'Used', 3, 25000, 'Ford GT adalah sebuah karya seni otomotif yang memadukan warisan legendaris dengan teknologi terkini, menghadirkan pengalaman berkendara yang luar biasa. Berikut adalah beberapa poin yang menyoroti keistimewaan Ford GT:\r\n\r\nEksklusivitas Tinggi:\r\n\r\nFord GT diproduksi dalam jumlah yang sangat terbatas, menambah eksklusivitasnya di pasar otomotif. Setiap unit dirancang dan dibangun dengan perhatian terhadap detail yang luar biasa, menjadikannya sebagai simbol kemewahan dan prestise.\r\nDesain Ikonik:\r\n\r\nMenggabungkan elemen desain klasik dari mobil balap GT40 dengan sentuhan kontemporer, Ford GT menampilkan siluet yang rendah, garis-garis aerodinamis, dan detail-desain yang menawan. Setiap elemen dirancang untuk memberikan penampilan yang memukau di jalan raya.\r\nPerforma Luar Biasa:\r\n\r\nDitenagai oleh mesin V6 twin-turbocharged yang sangat bertenaga, Ford GT menawarkan akselerasi yang cepat dan responsif. Sistem suspensi yang canggih dan sistem rem yang kuat memberikan kelincahan dan kestabilan yang optimal di setiap tikungan.'),
(3, 'Nissan', 'SkyLine GTR', 'White Blue', 2008, 'Hybrid', 'ABC3', 30000, 'Manual', 'Used', 3, 30000, 'Nissan Skyline adalah mobil legendaris yang telah menjadi ikon dalam dunia otomotif sejak pertama kali diperkenalkan. Berikut adalah beberapa poin yang menyoroti keistimewaan Nissan Skyline:Dikenal dengan performa yang mengesankan, Skyline menawarkan berbagai pilihan mesin yang bertenaga dan responsif. Dari mesin inline-six legendaris hingga varian bertenaga tinggi seperti GT-R, Skyline memberikan pengalaman berkendara yang memukau.\r\nTeknologi Terbaru:\r\n\r\nDilengkapi dengan fitur-fitur teknologi terbaru, seperti sistem kontrol traksi yang canggih dan sistem infotainment mutakhir, Nissan Skyline memastikan kenyamanan, keselamatan, dan hiburan yang optimal bagi pengemudi dan penumpangnya.\r\nKeunggulan Balap:\r\n\r\nNissan Skyline memiliki sejarah yang gemilang di lintasan balap, terutama melalui varian legendaris seperti Skyline GT-R. Keandalan, kecepatan, dan ketangguhan Skyline membuatnya menjadi pilihan favorit di berbagai ajang balap dunia.'),
(4, 'Mazda', 'MIATA', 'Green', 2018, 'Diesel', 'ABC5', 60000, 'Automatic', 'Used', 3, 32000, 'Mazda Miata, yang juga dikenal dengan nama Mazda MX-5, adalah mobil sport kompak yang telah memenangkan hati penggemar otomotif di seluruh dunia. Berikut adalah beberapa poin yang menyoroti keistimewaan Mazda Miata:\r\n\r\nDesain Ikonik:\r\n\r\nMazda Miata menampilkan desain yang klasik dan ikonik, dengan proporsi yang proporsional dan garis-garis yang aerodinamis. Siluet yang rendah, kap depan yang pendek, dan jendela bergaya roadster memberikan tampilan yang menarik dan sporty.Meskipun memiliki dimensi yang kompak, Mazda Miata menawarkan kualitas konstruksi yang tinggi dan kekuatan struktural yang solid. Bahan-bahan berkualitas dan teknik pembuatan yang canggih menjadikannya sebagai mobil sport yang andal dan tahan lama.\r\nPilihan Mesin yang Bertenaga:\r\n\r\nMiata tersedia dengan berbagai pilihan mesin yang bertenaga, mulai dari mesin empat silinder yang efisien hingga varian yang lebih bertenaga seperti versi turbocharged. Setiap mesin memberikan kombinasi antara performa yang memadai dan efisiensi bahan bakar yang baik.'),
(5, 'Suzuki', 'Samurai', 'Black', 2014, 'Electric', 'ABC6', 59000, 'Automatic', 'Used', 3, 18400, ''),
(6, 'Toyota', 'Supra', 'Blue', 2007, 'Petrol', 'ABC12', 55000, 'Manual', 'Used', 3, 23900, '\r\nPenjelasan Penjualan Toyota Supra:\r\n\r\nToyota Supra adalah mobil sport legendaris yang telah memikat hati penggemar otomotif selama beberapa dekade. Berikut adalah beberapa poin yang menyoroti keistimewaan Toyota Supra:\r\n\r\nWarisan Balap yang Gemilang:\r\n\r\nToyota Supra memiliki warisan balap yang kaya, terutama melalui partisipasinya dalam ajang balap seperti Grup A, GT500, dan ajang balap drag. Reputasinya yang kuat di dunia balap memastikan bahwa Supra diakui sebagai salah satu mobil sport terbaik dalam sejarah.\r\nDesain yang Menggoda:\r\n\r\nDikenal dengan garis-garis yang agresif dan proporsi yang proporsional, Toyota Supra menampilkan desain yang menggoda dan memikat. Siluet yang rendah, grille depan yang besar, dan lampu belakang yang ikonik memberikan penampilan yang unik dan menarik.\r\nPerforma yang Luar Biasa:\r\n\r\nDilengkapi dengan mesin yang bertenaga dan sistem suspensi yang canggih, Toyota Supra menawarkan performa yang luar biasa di jalan raya maupun lintasan balap. Akselerasi yang cepat, handling yang presisi, dan kestabilan yang optimal menjadikannya sebagai mobil sport yang memikat para pengemudi.'),
(7, 'Armastrong', 'Mini Cooper', 'Metal Black', 2021, 'Petrol', 'ASE32', 0, 'Automatic', 'New', 1, 29500, NULL),
(8, 'Jeep', 'Wrangler Sand Trooper II Concept', 'White', 2020, 'Diesel', 'ABC12', 20000, 'Automatic', 'Used', 3, 17500, 'Jeep Wrangler Sand Trooper dirancang untuk menunjukkan kemungkinan pembuatan Jeep Wrangler versi hardcore. Jeep berwarna cokelat ini mendapatkan keuntungan dari pertukaran mesin yang menggantikan mesin V-6 3,6 liter standar dengan Hemi V-8 5,7 liter berkekuatan 375 hp, bersama dengan poros portal khusus yang membantu menambah ground clearance lima inci lagi, dan raksasa 42 Ban off-road -inci dengan velg hitam matte. Pelat selip baru, komponen suspensi Fox Shox, rel batu, winch bertenaga, dan bumper off-road yang unik membantu memberikan kemampuan lebih saat meninggalkan jalan beraspal. Interiornya mendapat jok kulit Katzkin, radio CB, dan kamera cadangan.'),
(9, 'Lexus', 'F-Sport', 'Grey', 2021, 'Hybrid', 'ABC38', 0, 'Automatic', 'New', 3, 44500, ''),
(10, 'Holden', 'SZ1', 'Pearl White', 2009, 'Diesel', 'XYZ123', 76000, 'Manual', 'Used', 2, 16200, NULL),
(11, 'Kia', 'Sorento', 'Dark Green', 2021, 'Petrol', 'ABC87', 0, 'Automatic', 'New', 1, 26250, NULL),
(12, 'Ford', 'Fiesta', 'Black', 2011, 'Petrol', 'ABC123', 55000, 'Manual', 'Used', 2, 7500, NULL),
(13, 'Nissan', 'Maxima', 'Metal Black', 2021, 'Electric', 'ABC32', 0, 'Automatic', 'New', 1, 24250, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `car_images`
--

CREATE TABLE `car_images` (
  `id` int(11) NOT NULL,
  `car_id` int(7) NOT NULL,
  `file_name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_images`
--

INSERT INTO `car_images` (`id`, `car_id`, `file_name`) VALUES
(17, 1, 'image_0_1709708335.png'),
(18, 2, 'image_0_1709712196.png'),
(19, 3, 'image_0_1709712688.png'),
(20, 4, 'image_0_1709715257.png'),
(21, 6, 'image_0_1709715615.png'),
(22, 5, 'image_0_1709716311.png'),
(23, 7, 'image_0_1709719274.png'),
(24, 8, 'image_0_1709783454.png'),
(27, 9, 'image_0_1709783841.png'),
(29, 11, 'image_0_1709784114.png'),
(31, 13, 'image_0_1709784301.png'),
(32, 10, 'image_0_1709784456.png'),
(34, 12, 'image_0_1709784638.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(4) NOT NULL,
  `category_type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_type`) VALUES
(1, 'Luxury'),
(2, 'Family'),
(3, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `commission_id` int(6) NOT NULL,
  `amount` decimal(5,0) NOT NULL,
  `employee_id` int(6) NOT NULL,
  `month` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`commission_id`, `amount`, `employee_id`, `month`) VALUES
(1, 8750, 2, 12),
(2, 1500, 3, 9),
(3, 1600, 4, 5),
(4, 9800, 5, 7),
(5, 8400, 6, 12);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(7) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile_no` int(10) NOT NULL,
  `driver_license_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `address`, `mobile_no`, `driver_license_no`) VALUES
(1, 'Jon', 'Ray', '4A,Wilson Street, Tauranga, Newzealand', 2109312189, 'xyzwe1234'),
(2, 'Ella', 'Green', '25, Miles Bay, Nelson, Newzealand', 223897705, 'njhtuy878'),
(3, 'Maria', 'Joe', '123, Biliards Height, Taupo, NewZealand', 226547899, 'abdht567'),
(4, 'Sam', 'Desouza', '238, Westlake, NewZealand', 2109342123, 'njhtuy980'),
(5, 'Rosa', 'Dell', '5 Marina Beach, Akaroa, NewZealnd ', 218721345, 'abdht5098');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `employee_role_id` int(3) NOT NULL,
  `mobile_number` int(10) NOT NULL,
  `salary` decimal(6,0) NOT NULL,
  `branch` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `employee_role_id`, `mobile_number`, `salary`, `branch`) VALUES
(1, 'Jacquie', 'Shawn', 1, 2134345467, 60000, 'Auckland'),
(2, 'Jim', 'Gill', 2, 226789767, 110000, 'Auckland'),
(3, 'Kanak', 'Gore', 3, 2143565678, 70000, 'Hamilton'),
(4, 'Hemish', 'Shaw', 1, 223458787, 80000, 'Wellington'),
(5, 'Ben', 'Martin', 2, 2121678987, 130000, 'Wellington'),
(6, 'Shaan', 'Norway', 3, 232145678, 90000, 'Hamilton');

-- --------------------------------------------------------

--
-- Table structure for table `employee_role`
--

CREATE TABLE `employee_role` (
  `Role_id` int(3) NOT NULL,
  `Role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_role`
--

INSERT INTO `employee_role` (`Role_id`, `Role`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Salesperson');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(6) NOT NULL,
  `amount` decimal(7,0) NOT NULL,
  `invoice_date` date NOT NULL,
  `customer_id` int(6) NOT NULL,
  `sale_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `amount`, `invoice_date`, `customer_id`, `sale_id`) VALUES
(1, 95000, '2011-03-03', 2, 1),
(2, 30000, '2019-12-01', 2, 2),
(3, 32000, '2020-06-15', 4, 4),
(4, 140000, '2021-07-01', 5, 5),
(5, 30000, '2019-05-21', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

CREATE TABLE `performance` (
  `performance_id` int(6) NOT NULL,
  `employee_id` int(6) NOT NULL,
  `bonus` decimal(6,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performance`
--

INSERT INTO `performance` (`performance_id`, `employee_id`, `bonus`) VALUES
(1, 5, 1221),
(2, 2, 1100),
(3, 6, 900);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(6) NOT NULL,
  `car_id` int(6) NOT NULL,
  `sale_amount` decimal(7,0) NOT NULL,
  `employee_id` int(5) NOT NULL,
  `customer_id` int(6) NOT NULL,
  `sales_date` date NOT NULL,
  `warranty_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `car_id`, `sale_amount`, `employee_id`, `customer_id`, `sales_date`, `warranty_id`) VALUES
(1, 2, 95000, 2, 2, '2011-03-03', 3),
(2, 3, 30000, 2, 2, '2019-12-01', 2),
(3, 3, 30000, 3, 3, '2019-05-21', 3),
(4, 4, 32000, 4, 4, '2020-06-15', 2),
(5, 7, 140000, 5, 5, '2021-07-01', 4),
(6, 11, 120000, 6, 1, '2021-10-05', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sales_person_of_the_year`
--

CREATE TABLE `sales_person_of_the_year` (
  `salespersonoftheyear_id` int(6) NOT NULL,
  `employee_id` int(6) NOT NULL,
  `year` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_person_of_the_year`
--

INSERT INTO `sales_person_of_the_year` (`salespersonoftheyear_id`, `employee_id`, `year`) VALUES
(1, 2, 2020),
(2, 2, 2021);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(12) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `enabled`) VALUES
(1, 'ajit.musalgavkar@gmail.com', '$2y$10$kN/ATGX25rVVGmMUTF.zi.btpaxEKWgFOK5P5zOlEc8C1i72H9baK', '', 0),
(2, 'dafibagas583@gmail.com', 'dapi321', '', 0),
(3, 'dafibagas2307@gmail.com', '$2y$10$dVL0ox4bIQVzUtqukRdD6ubJmJ9LWD5sAYLXs7aXVt/1nPzEW4PLW', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `warranties`
--

CREATE TABLE `warranties` (
  `warranty_id` int(6) NOT NULL,
  `years` int(2) NOT NULL,
  `cost` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warranties`
--

INSERT INTO `warranties` (`warranty_id`, `years`, `cost`) VALUES
(1, 4, 1800),
(2, 2, 1200),
(3, 3, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `car_id`) VALUES
(3, 3, 1),
(4, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `category_fk` (`category_id`);

--
-- Indexes for table `car_images`
--
ALTER TABLE `car_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_fk3` (`car_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`commission_id`),
  ADD KEY `employee_fk1` (`employee_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_role_fk` (`employee_role_id`);

--
-- Indexes for table `employee_role`
--
ALTER TABLE `employee_role`
  ADD PRIMARY KEY (`Role_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD UNIQUE KEY `id` (`invoice_id`),
  ADD KEY `sales_fk` (`sale_id`),
  ADD KEY `customer_fk` (`customer_id`);

--
-- Indexes for table `performance`
--
ALTER TABLE `performance`
  ADD PRIMARY KEY (`performance_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `employee_fk` (`employee_id`),
  ADD KEY `customer_fk2` (`customer_id`),
  ADD KEY `car_fk1` (`car_id`);

--
-- Indexes for table `sales_person_of_the_year`
--
ALTER TABLE `sales_person_of_the_year`
  ADD PRIMARY KEY (`salespersonoftheyear_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warranties`
--
ALTER TABLE `warranties`
  ADD PRIMARY KEY (`warranty_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `car_images`
--
ALTER TABLE `car_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `commission_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee_role`
--
ALTER TABLE `employee_role`
  MODIFY `Role_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `performance`
--
ALTER TABLE `performance`
  MODIFY `performance_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales_person_of_the_year`
--
ALTER TABLE `sales_person_of_the_year`
  MODIFY `salespersonoftheyear_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warranties`
--
ALTER TABLE `warranties`
  MODIFY `warranty_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `car_images`
--
ALTER TABLE `car_images`
  ADD CONSTRAINT `car_fk3` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`);

--
-- Constraints for table `commission`
--
ALTER TABLE `commission`
  ADD CONSTRAINT `employee_fk1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_role_fk` FOREIGN KEY (`employee_role_id`) REFERENCES `employee_role` (`Role_id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `customer_fk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `sales_fk` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sales_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `car_fk1` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`),
  ADD CONSTRAINT `customer_fk2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `employee_fk` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
