-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:4306
-- Generation Time: Apr 20, 2024 at 12:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Iwear`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `permission` varchar(5000) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `password`, `email`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'Rikesh', 'Shrestha ', 'manutd78', 'rikeshshrestha9841@gmail.com', 'user_create,admin_create,user_view,admin_view,po_view,supplier_view,supplier_create,po_create,report_view,product_view,product_create,admin_edit,admin_delete,user_edit,po_edit,supplier_edit,product_edit,product_delete,supplier_delete,user_delete,userOrders_view,userOrders_edit,userOrders_delete,userMsg_view,userMsg_edit,userMsg_delete,userfeedback_view,userfeedback_edit,userfeedback_delete,dashboard_view', '2024-02-15 06:43:11', '2024-04-18 01:56:34'),
(34, 'admin', 'panel', 'Admin', 'admin123@gmail.com', 'dashboard_view,report_view,product_view,product_create,product_edit,product_delete,supplier_delete,supplier_edit,supplier_create,supplier_view,po_view,user_view,po_create,user_create,po_edit,user_edit,user_delete,admin_delete,admin_edit,admin_create,admin_view,userOrders_view,userMsg_view,userfeedback_view,userOrders_edit,userMsg_edit,userfeedback_edit,userOrders_delete,userMsg_delete,userfeedback_delete', '2024-04-18 13:27:31', '2024-04-18 13:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  `message_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `phone`, `email`, `subject`, `message`, `message_at`) VALUES
(31, 'Rikesh Shrestha', '9841879297', 'rikeshshrestha@gmail.com', 'product damage', 'the product was damaged', '2024-03-05 00:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `country` varchar(20) NOT NULL,
  `review` varchar(20) NOT NULL,
  `experience` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `remember_me` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`id`, `first_name`, `last_name`, `email`, `password`, `remember_me`, `created_at`, `updated_at`) VALUES
(67, 'Rikesh', 'Shrestha ', 'rikeshshresthaabc@yahoo.com', '123', 'no', '2024-02-25 20:22:38', '2024-02-25 20:22:38'),
(72, 'Rikesh ', 'Shrestha', 'rikeshshrestha123@gmail.com', 'rikesh@123', 'no', '2024-04-18 14:08:21', '2024-04-18 14:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity_ordered` int(11) NOT NULL,
  `quantity_received` int(11) DEFAULT NULL,
  `quantity_remaining` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `batch` int(20) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `supplier`, `product`, `quantity_ordered`, `quantity_received`, `quantity_remaining`, `status`, `batch`, `created_by`, `created_at`, `updated_at`) VALUES
(38, 1, 74, 6, 5, 1, 'pending', 1709499826, 1, '2024-03-04 02:48:46', '2024-03-04 02:48:46'),
(39, 1, 74, 12, NULL, NULL, 'ordered', 1713256053, 1, '2024-04-16 14:12:33', '2024-04-16 14:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_product_history`
--

CREATE TABLE `order_product_history` (
  `id` int(11) NOT NULL,
  `order-product-Id` int(11) NOT NULL,
  `qty_received` int(11) NOT NULL,
  `date_received` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product_history`
--

INSERT INTO `order_product_history` (`id`, `order-product-Id`, `qty_received`, `date_received`, `date_updated`) VALUES
(15, 38, 5, '2024-03-04 02:49:29', '2024-03-04 02:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `price` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `img`, `stock`, `price`, `category`, `created_by`, `created_at`, `updated_at`) VALUES
(74, 'Nevaeh - L / Silver', 'The black metal rectangular frame is the basis of various shapes of frames. These rectangular glasses have a firm square structure with a black finish and silver metal, making them even more simple and elegant. Some people may think that the basic model is simple and ordinary, but sometimes, the classic is the trend.', 'product-1709092148.jpeg', 5, '340', 'Square-Shaped Spectacles', 1, '2024-02-27 12:55:59', '2024-03-25 19:12:34'),
(75, 'RayBan Top-Notch ', 'Iconic style through the lens of Ray-Ban glasses.', 'product-1709047348.jpeg', 0, '450', 'Rectangle-Shaped Spectacles', 1, '2024-02-27 16:22:28', '2024-02-29 16:32:12'),
(76, 'Eyewear Rec', 'Iconic style through the lens of Ray-Ban glasses.', 'product-1709047520.jpeg', 0, '500', 'Rectangle-Shaped Spectacles', 1, '2024-02-27 16:25:20', '2024-02-29 16:32:19'),
(77, 'O-shaped Rayz', 'Round spectacles for a classic and timeless look.', 'product-1709052211.jpeg', 0, '670', 'Round-Shaped Spectacles', 1, '2024-02-27 17:43:31', '2024-02-29 16:32:30'),
(78, 'Roundspecs223', 'Round spectacles for a classic and timeless look.', 'product-1709052354.jpeg', 0, '700', 'Round-Shaped Spectacles', 1, '2024-02-27 17:45:54', '2024-02-29 16:32:40'),
(79, 'Julbo Cham Polarized 3', 'The Julbo Cham Polarized 3 sunglasses are expertly crafted eyewear designed for outdoor adventurers seeking superior protection and style. Featuring polarized lenses, they excel in reducing glare and enhancing clarity, particularly in bright conditions, while offering high-level UV protection against harmful rays. Constructed with durability in mind, these sunglasses boast a comfortable fit with ergonomic shapes and adjustable components, ensuring a secure feel during activities. Their sleek design not only makes a fashion statement but also provides versatility, making them suitable for a wide range of outdoor pursuits from hiking to skiing. With performance-driven features and a commitment to quality, the Julbo Cham Polarized 3 sunglasses are the perfect companion for those who demand excellence in their outdoor eyewear.', 'product-1709054215.jpeg', 0, '1450', 'Customized Spectacles', 1, '2024-02-27 18:16:55', '2024-02-29 16:32:53'),
(80, 'Giv Cut Rays', 'Giv Cut Rays gives the best customized and advanced blueray to the eyes.', 'product-1709054558.jpeg', 0, '1700', 'Other New Feature Spectacles', 1, '2024-02-27 18:22:38', '2024-02-29 16:33:04'),
(81, 'Edwardian Tortoiseshel Spectacles', 'The Edwardian Tortoiseshell Spectacles with Case epitomize timeless elegance and sophistication. Crafted during the Edwardian era, these spectacles feature exquisite tortoiseshell frames meticulously shaped into a classic silhouette, reflecting the refined aesthetic of the period. Their rich, warm hues and intricate patterns exude a sense of luxury and heritage. Paired with a bespoke case, these spectacles are not only a functional accessory but also a statement of status and style. ', 'product-1709054681.jpeg', 0, '2300', 'Customized Spectacles', 1, '2024-02-27 18:24:41', '2024-02-29 16:33:16'),
(82, 'Men\'s leaf-shaped Spectacles', 'These men\'s leaf-shaped rimless fashion glasses offer a sleek and modern design, blending contemporary style with subtle sophistication. With their unique leaf-shaped frames and rimless construction, they exude a distinct flair, making them a statement piece for any fashion-forward individual.', 'product-1709054858.jpeg', 0, '1600', 'Other New Feature Spectacles', 1, '2024-02-27 18:27:38', '2024-02-29 16:34:24'),
(83, 'User Illuminated Cyber Visors', 'The illuminated cyber visors feature futuristic LED lighting embedded within a sleek, visor-style design, offering a striking and attention-grabbing accessory for tech enthusiasts and cosplay aficionados alike.\r\nThese visors not only provide eye-catching illumination but also offer a nod to cyberpunk aesthetics, perfect for enhancing costumes or adding a futuristic edge to everyday wear.', 'product-1709055070.jpeg', 0, '3050', 'Other New Feature Spectacles', 1, '2024-02-27 18:31:10', '2024-02-29 16:34:37'),
(84, 'Pharrell\'s Tiffany glasses ', 'Pharrell\'s Tiffany glasses exude a Mughal-inspired vibe with intricate detailing, offering a fusion of cultural richness and contemporary style.\r\nThis eyewear collaboration captures the essence of opulence and heritage, presenting a unique blend of fashion and cultural influence.', 'product-1709055182.jpeg', 0, '', 'Customized Spectacles', 1, '2024-02-27 18:33:02', '2024-02-27 18:33:02'),
(85, 'Rec-Specs A33', 'Customized rectangle spectacles offer personalized style and precise vision correction, combining fashion and function tailored to individual preferences.\r\nWith their sleek rectangular frames and customizable features, these spectacles provide both aesthetic appeal and optimized visual clarity for a personalized eyewear experience.', 'product-1709055710.jpeg', 0, '1500', 'Rectangle-Shaped Spectacles', 1, '2024-02-27 18:41:50', '2024-02-29 18:06:55'),
(86, 'Black Oversized Thick Square Eyeglasses', 'Behold the Piper, the uniquely shaped square eyeglasses. These oversized glasses are made to impress. They sport a thick frame in black, tortoise, caramel, and wine color and are made from lightweight, durable material. Why wear anything else when you can wear the Piper? Dare to enhance your looks with a bold fashion statement; because your eyeglasses are more than just a simple accessory.', 'product-1709092251.jpeg', 0, '999', 'Square-Shaped Spectacles', 1, '2024-02-28 04:50:51', '2024-03-03 19:56:41'),
(87, 'Eyeglasses Mys9012 - Silver', 'Upgrade your eyewear game with Bclear Men\'s Rimless Square Titanium Eyeglasses Mys9012. These stylish eyeglasses combine modern design with high-quality materials to provide you with a comfortable and fashionable eyewear option. Crafted from durable titanium, the frame of these eyeglasses is not only lightweight but also resistant to corrosion, ensuring long-lasting use. ', 'product-1709092433.jpeg', 0, '', 'Square-Shaped Spectacles', 1, '2024-02-28 04:53:53', '2024-02-28 04:53:53'),
(88, 'Wearme Pro - Polarized Pilot Style Classic Aviator Sunglasses', 'Protect your eyes with polarized sunglasses. These pilot style polarized aviators are a true classic. When a design is this neat and timeless, there\'s no point in trying to improve on it. These are a traditionally styled pair of aviator sunglasses that have been given a blacked-out design. They are a great pair of men\'s sunglasses but also perfect for women who love to rock a classic. Size- One Size.', 'product-1709092675.jpeg', 0, '', 'Aviator Spectacles', 1, '2024-02-28 04:57:55', '2024-02-28 09:46:34'),
(89, 'Ray-Ban aviator sunglasses - Black', 'Black metal aviator sunglasses from RAY-BAN featuring aviator frame, grey tinted lenses and polarized lenses.', 'product-1709092731.jpeg', 0, '', 'Aviator Spectacles', 1, '2024-02-28 04:58:51', '2024-02-28 09:46:40'),
(90, 'TOM FORD FT0836 Unisex Troy Aviator Sunglasses, Black/Grey', 'This pair of aviator sunglasses from TOM FORD are made to suit an oval-shaped face.', 'product-1709092955.jpeg', 0, '', 'Aviator Spectacles', 1, '2024-02-28 04:59:44', '2024-02-28 09:47:35'),
(91, 'Eyeglasses Women Clear Pink Full Rim Cat Eye 53 17 140 by Charles Delon - C1', 'Eyeglasses Women Clear Pink Full Rim Cat Eye 53 17 140 by Charles Delon Brand Charles Delon Type Eyeglasses Gender Women Frame Color Clear Pink Department Women Style Cat Eye Lens Color Demo Lens Frame Material Plastic Model P6099 C3 Temple Length 140 mm Color Clear Pink Age Group Adult Lens Socket Width 53 mm Vertical 42 mm Bridge Width 17 mm Frame Width 53 mm Bridge Size 17 mm Frame Shape Cat Eye UPC 657552818364 Frame Type Full Rim Shop At Megafashion Glasses', 'product-1709093145.jpeg', 0, '', 'Cat-eye Spectacles', 1, '2024-02-28 05:05:45', '2024-02-28 05:05:45'),
(92, 'Stoggles Cat Eye', 'More than a feline. Stoggles Cat Eye is a modern nod to a classic throwback. The retro shape adds spunk while the protective barrier blocks junk. Try Cat Eye to balance a round face shape or to highlight your cheekbones. Features:✓ Anti-Fog Coated Lenses✓ Blue-Light Blocking✓ ANSI Z87.1-2020 Certified✓ Side + Top Shields✓ 100% UV Blocking Lenses✓ Impact Resistant', 'product-1709093187.jpeg', 0, '', 'Cat-eye Spectacles', 1, '2024-02-28 05:06:27', '2024-02-28 05:06:27'),
(93, 'Full Rim Alloy Cat Eye Frame Eyeglasses 3006 - C1 Black', 'If you\'re looking to add some style and sophistication to your eyewear collection, look no further than the Gmei Women\'s Full Rim Alloy Cat Eye Frame Eyeglasses 3006. These eyeglasses are perfect for the modern woman who wants to make a statement with her eyewear. Made with a durable alloy frame, these eyeglasses are built to last. The cat eye shape adds a touch of elegance and femininity to any look. The solid pattern gives them a timeless appeal that will never go out of style. ', 'product-1709093295.jpeg', 0, '', 'Cat-eye Spectacles', 1, '2024-02-28 05:08:15', '2024-02-28 05:08:15'),
(94, 'Black circle glasses aesthetic', 'A ltd-edition round black glasses frame, designed and made in Scotland from 100% recycled, 100% recyclable bio-acrylic. These round black glasses are inspired by the classic round-eye spectacles that have endured the ages as one of the most iconic glasses frame styles.\r\n ', 'product-1709093652.jpeg', 0, '3000', 'Round-Shaped Spectacles', 1, '2024-02-28 05:14:12', '2024-03-04 01:33:13'),
(95, 'Round & Square Asymmetric Reading Glasses', 'Reading Glasses Acetate frame and temples. Flexible and comfortable arms, with spring hinges, which adapt to all face shapes and sizes. Frame Height: 40mm. Frame Width: 138mm. A soft microfibre cleaning pouch included. All products despatched from UK. Our reading glasses have CE Marking; Conformité Européenne (European Conformity).', 'product-1709094074.jpeg', 0, '', 'Asymmetric Spectacles', 1, '2024-02-28 05:21:14', '2024-02-28 05:21:14'),
(96, 'Asymmetric Shades', 'Made in France by Pierre Cardin, these shades are made of Cellulose Acetate plastic. Despite the asymmetry of the design, the material is used in a very traditional way, as faux tortoiseshell.\r\n ', 'product-1709094157.jpeg', 0, '', 'Asymmetric Spectacles', 1, '2024-02-28 05:22:37', '2024-02-28 10:11:01'),
(97, 'Sabine Be Val De Loire Wire - Lacquered Black', 'Be Val De Loire Wire Eyeglasses by Sabine Be. Color: Polished Pale Gold, Polished Palladium, Polished Rose Gold, Satin Dark Choco, Satin Neon Orange, Satin Neon Pink, Satin Nude, Satin Pistachio Green, Satin White, Shiny Navy Blue, Satin Blue Majorelle, Lacquered Black, Size: 50-22-145. Wire-frame spectacles carry a unique charm unlike any other, and the Be Val De Loire Wire is one of the brightest representatives within the range. Constructed from an ultra-thin metal wire, the frame is minimalist and distinctive at the same time. The narrow construction and bright metallic colors hit all the right style notes. So, whether you\'re celebrating a special occasion or simply out for a day of shopping, these oversized metal glasses with a round asymmetrical frame and the curves of the loire ', 'product-1709094328.jpeg', 0, '', 'Asymmetric Spectacles', 1, '2024-02-28 05:25:28', '2024-02-28 05:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `productsuppliers`
--

CREATE TABLE `productsuppliers` (
  `id` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productsuppliers`
--

INSERT INTO `productsuppliers` (`id`, `supplier`, `product`, `updated_at`, `created_at`) VALUES
(74, 1, 85, '2024-02-29 18:06:55', '2024-02-29 18:06:55'),
(75, 5, 85, '2024-02-29 18:06:55', '2024-02-29 18:06:55'),
(76, 6, 85, '2024-02-29 18:06:55', '2024-02-29 18:06:55'),
(77, 7, 85, '2024-02-29 18:06:55', '2024-02-29 18:06:55'),
(80, 1, 74, '2024-03-25 19:12:34', '2024-03-25 19:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(191) NOT NULL,
  `supplier_location` varchar(191) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_location`, `email`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Lenskart 2   ', 'India, delhi', 'lenkart@Gmail.com', 1, '2024-02-19 19:42:36', '2024-02-21 21:32:09'),
(5, 'bluerayeyes', 'Pakistan', 'bluerayseyes@gmail.com', 1, '2024-02-21 08:31:43', '2024-02-21 08:31:43'),
(6, 'Eyeron', 'Singapore', 'eyeron@gmail.com', 1, '2024-02-21 08:32:57', '2024-02-21 08:32:57'),
(7, 'EyeManiac ', 'USA', 'eyemaniac@yahoo.com', 1, '2024-02-21 08:36:23', '2024-02-25 20:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `usercart`
--

CREATE TABLE `usercart` (
  `id` int(11) NOT NULL,
  `users` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment method` varchar(50) DEFAULT NULL,
  `ordered_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usercart`
--

INSERT INTO `usercart` (`id`, `users`, `product`, `quantity`, `payment method`, `ordered_at`) VALUES
(44, 67, 78, 1, 'Online Payment', '2024-04-16 20:31:59'),
(46, 67, 76, 2, NULL, '2024-04-17 21:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user`, `product`) VALUES
(35, 67, 82),
(36, 67, 83);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `email_3` (`email`),
  ADD UNIQUE KEY `email_4` (`email`),
  ADD UNIQUE KEY `email_5` (`email`),
  ADD UNIQUE KEY `email_6` (`email`),
  ADD UNIQUE KEY `email_7` (`email`),
  ADD UNIQUE KEY `email_8` (`email`),
  ADD UNIQUE KEY `email_9` (`email`),
  ADD UNIQUE KEY `email_10` (`email`),
  ADD UNIQUE KEY `email_11` (`email`),
  ADD UNIQUE KEY `email_12` (`email`),
  ADD UNIQUE KEY `email_13` (`email`),
  ADD UNIQUE KEY `email_14` (`email`),
  ADD UNIQUE KEY `email_15` (`email`),
  ADD UNIQUE KEY `email_16` (`email`),
  ADD UNIQUE KEY `email_17` (`email`),
  ADD UNIQUE KEY `email_18` (`email`),
  ADD UNIQUE KEY `email_19` (`email`),
  ADD UNIQUE KEY `email_20` (`email`),
  ADD UNIQUE KEY `email_21` (`email`),
  ADD UNIQUE KEY `email_22` (`email`),
  ADD UNIQUE KEY `email_23` (`email`),
  ADD UNIQUE KEY `email_24` (`email`),
  ADD UNIQUE KEY `email_25` (`email`),
  ADD UNIQUE KEY `email_26` (`email`),
  ADD UNIQUE KEY `email_27` (`email`),
  ADD UNIQUE KEY `email_28` (`email`),
  ADD UNIQUE KEY `email_29` (`email`),
  ADD UNIQUE KEY `email_30` (`email`),
  ADD UNIQUE KEY `email_31` (`email`),
  ADD UNIQUE KEY `email_32` (`email`),
  ADD UNIQUE KEY `email_33` (`email`),
  ADD UNIQUE KEY `email_34` (`email`),
  ADD UNIQUE KEY `email_35` (`email`),
  ADD UNIQUE KEY `email_36` (`email`),
  ADD UNIQUE KEY `email_37` (`email`),
  ADD UNIQUE KEY `email_38` (`email`),
  ADD UNIQUE KEY `email_39` (`email`),
  ADD UNIQUE KEY `email_40` (`email`),
  ADD UNIQUE KEY `email_41` (`email`),
  ADD UNIQUE KEY `email_42` (`email`),
  ADD UNIQUE KEY `email_43` (`email`),
  ADD UNIQUE KEY `email_44` (`email`),
  ADD UNIQUE KEY `email_45` (`email`),
  ADD UNIQUE KEY `email_46` (`email`),
  ADD UNIQUE KEY `email_47` (`email`),
  ADD UNIQUE KEY `email_48` (`email`),
  ADD UNIQUE KEY `email_49` (`email`),
  ADD UNIQUE KEY `email_50` (`email`),
  ADD UNIQUE KEY `email_51` (`email`),
  ADD UNIQUE KEY `email_52` (`email`),
  ADD UNIQUE KEY `email_53` (`email`),
  ADD UNIQUE KEY `email_54` (`email`),
  ADD UNIQUE KEY `email_55` (`email`),
  ADD UNIQUE KEY `email_56` (`email`),
  ADD UNIQUE KEY `email_57` (`email`),
  ADD UNIQUE KEY `email_58` (`email`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier` (`supplier`),
  ADD KEY `product` (`product`),
  ADD KEY `order_product_ibfk_3` (`created_by`);

--
-- Indexes for table `order_product_history`
--
ALTER TABLE `order_product_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order-product-Id` (`order-product-Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_buyer` (`created_by`);

--
-- Indexes for table `productsuppliers`
--
ALTER TABLE `productsuppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier` (`supplier`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_ibfk_1` (`created_by`);

--
-- Indexes for table `usercart`
--
ALTER TABLE `usercart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product`),
  ADD KEY `users` (`users`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_product_history`
--
ALTER TABLE `order_product_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `productsuppliers`
--
ALTER TABLE `productsuppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usercart`
--
ALTER TABLE `usercart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_product_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `order_product_history`
--
ALTER TABLE `order_product_history`
  ADD CONSTRAINT `order_product_history_ibfk_1` FOREIGN KEY (`order-product-Id`) REFERENCES `order_product` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_buyer` FOREIGN KEY (`created_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `productsuppliers`
--
ALTER TABLE `productsuppliers`
  ADD CONSTRAINT `productsuppliers_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `productsuppliers_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`id`);

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `usercart`
--
ALTER TABLE `usercart`
  ADD CONSTRAINT `usercart_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `usercart_ibfk_2` FOREIGN KEY (`users`) REFERENCES `login_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
