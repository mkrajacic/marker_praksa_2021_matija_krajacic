-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2021 at 11:38 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praksa`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `attribute` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `attribute`) VALUES
(1, 'Materijal'),
(2, 'Boja');

-- --------------------------------------------------------

--
-- Table structure for table `attributes_values`
--

CREATE TABLE `attributes_values` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `attributes_values`
--

INSERT INTO `attributes_values` (`id`, `attribute_id`, `value`) VALUES
(1, 1, 'Koža'),
(2, 1, 'Tekstil'),
(3, 2, 'Crna'),
(4, 2, 'Bijela');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_croatian_ci NOT NULL,
  `description` text COLLATE utf8mb4_croatian_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `description`, `active`) VALUES
(1, 'Puma', 'Puma je jedna od vodećih svjetskih tvrtki sportlifestyle obuće i odjeće. Ovaj brand nadrastao je ideju da bude samo sportski i prerastao je u pravi modni brand koji je odraz životnog stila sviju koji ga vole.', 1),
(2, 'Nike', 'Partneri Bill Bowerman i Philip Knight 1964. godine osnovali su tvrtku Blue Ribbon Sport koja 1978. godine mijenja ime u daleko poznatiji i zvučniji naziv – Nike, po grčkoj božici pobjede. Nike ima i jedan od najpoznatiji slogana u svijetu sporta \'Just Do It\' te je, također, jedan od najpoznatijih proizvođača sportske odjeće i obuće na svijetu, a sponzor je i mnogim velikim sportašima i sportskim timovima širom svijeta.', 1),
(3, 'Adidas', 'Priča o Adidasu počela je u praonici, a osvojila je svijet. U malom gradu u Bavarskoj, Adi Dasler je nakon prvih koraka u majčinoj praonici, godine 1924. osnovao „Gebrüder Dassler Schuhfabrik“. Njegova misija bila je pružanje atletičarima najbolje moguće odjeće i obuće. Zlatne medalje Line Radke 1928. u Amsterdamu te Jessea Owensa 1936. u Berlinu bile su dokaz uspješnosti tvrtke. Godine 1949. Adi Dassler pokreće novu tvrtku pod imenom „Adi Dassler Adidas Sportschuhfabrik“ i s 47 radnika kreće ispočetka. Prvog dana registrirao je tenisice s onim što će postati zaštitni i prepoznatljivi znak Adidasa – slavne Adidasove tri crte.', 1),
(4, 'Converse', 'Converse Rubber Shoe Company osnovana je 1908. godine u američkoj saveznoj državi Massachusetts, a 1917. godine tvrtka je kreirala prvu, danas veoma poularnu, \'starku\'. Tenisice su u početku zamišljene kao elitne cipele za profesionalne košarkaše. 1921. godine Charles \'Chuck\' Taylor pridružio se košarkaškoj momčadi koju je sponzorirala Converse kompanija te je dodao nekoliko promjena u postojeći model tenisice, a ona je dobila izgled koji se do dan danas nije mnogo promjenio. Starke su danas simbol mladenačkog bunta i individualnosti, a neodoljive su svima koji slave duh originalnosti.', 0),
(5, 'Dr. Martens', 'Dr. Martens 1460 čizme sa 8 rupica su dio [Core] kolekcije. Te su čizme ikona, priznate u svijetu po svojem beskompromisnom izgledu, trajnosti i udobnosti.', 1),
(6, 'Vans', 'Vans nudi kompletan asortiman obuće, odjeće i modnih dodataka za sve koji se bave ekstremnim sportovima, za one koji žele živjeti punim plućima, koji žive pomalo nesta&scaron;nim načinom života, koji uvijek žele vi&scaron;e i bolje.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `session_id` varchar(40) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `session_id`) VALUES
(20, 'vkakpt8abvblbbv6lf41kj6h2q'),
(21, '2ib3q31ejq6gg5iqnblu68i056'),
(22, 'jcco6al1ckcmlfj0af7sqq7369'),
(23, 'm40sq09l322e9qo240pk4qe9u1'),
(24, 'g3e87vp5146lgsd016ml02agsn'),
(25, 'bfe2760i0eavnotmcmb9ae754u'),
(26, 't4cavhmsl34fnnt7ff9pu9glsa');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `description` text COLLATE utf8mb4_croatian_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `main_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `active`, `main_id`) VALUES
(1, 'Tenisice', 'Tenisice su cipele prvenstveno dizajnirane za sport ili druge oblike tjelesnih vježbi, ali koje se danas također &scaron;iroko koriste za svakodnevno svakodnevno no&scaron;enje.', 1, 23),
(2, 'Cipele', 'Cipele su vrsta za&scaron;titne obuće za ljudska stopala. Postoje brojne vrste cipela koje mogu biti izrađene od različitih materijala i namijenjene za posebne potrebe.', 1, 23),
(3, 'Čizme', 'Čizma je komad obuće, koji pokriva veću ili manju dužinu nogu. Najniže čizme dosežu samo 5-10 cm iznad gležnja i zovu se gležnjače, dok su čizme iznad koljena i ribarske čizme najduže.  Čizme se nose u raznim prigodama, dizajnirane su, da &scaron;tite i griju noge te služe i kao modni dodatak.', 1, 23),
(23, 'Obuća', 'Obuća je pokrivalo za noge, koje se nosi radi za&scaron;tite nogu i u modne svrhe.', 1, 0),
(24, 'Odjeća', 'Odjevni predmeti namijenjeni za&scaron;titi čovjekovog tijela od klimatskih i drugih vanjskih utjecaja.', 1, 0),
(25, 'Modni dodaci', 'Za upotpunjavanje modnih kombinacija', 1, 0),
(26, 'Hlače', 'Hlače su dio odjeće, kojom se prekriva donji dio tijela. U zapadnom svijetu se nose od 16. stoljeća. Pogotovo od druge polovice dvadesetog stoljeća je postalo običajno, da mu&scaron;karci nose hlače i kasnije su ih počele nositi i žene.', 1, 24),
(27, 'Čarape', 'Čarapa je odjevni predmet, koji se nosi na nogama. U hladnom dijelu godine, služi zadržavanju topline, a u toplom dijelu godine spriječava znojenje nogu.', 1, 24),
(28, 'Jakne', 'Jakna je odjevni predmet za gornji dio tijela, obično se proteže ispod bokova. ', 1, 24),
(29, 'Majice', 'Majica je dio odjeće, koji se koristi za gornji dio tijela. Izrez majica je obično okrugao ili u obliku slova V, gumbi i džepova. U biti majica ima oblik sličan ko&scaron;ulje s kratkim rukavima, iako postoje i majice s dugim rukavima. Majice se smatraju manje formalnom vrstom odjeće od ko&scaron;ulja.', 1, 24),
(30, 'Torbe', 'Torba je neizostavni dodatak svakog outfita jer ga ima moć učiniti posebnim. Vrlo često se dogodi da upravo promjena torbe čini razliku odjevne kombinacije.', 1, 25),
(31, 'Naočale', 'Naočale su onaj nezamjenjivi modni dodatak koji spaja skoro pa sve uzbudljive kombinacije.', 1, 25),
(32, 'Traperice', 'Jeans je dobio naziv traperice zbog amerčkih trapera i farmera koji su ih popularizirali, iako su to zapravo prije njih učinili rudari i tragači za zlatom na američkom Divljem zapadu.', 1, 26),
(33, 'Slim fit', 'Traperice uz struk i bokove do koljena, sužene od koljena do gležnja', 1, 32);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_croatian_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_croatian_ci NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_croatian_ci NOT NULL,
  `surname` varchar(80) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `password`, `name`, `surname`) VALUES
(1, 'ivanhorvat@gmail.com', '600aecbae1480e2e458396bf65fa7d2b', 'Ivan', 'Horvat'),
(2, 'mariom@gmail.com', '5c04e3c5c87c1315d199dff6736e07f4', 'Mario', 'Marić'),
(3, 'nnina@gmail.com', 'bd31cf195e0f6dc41072223a07a3b62b', 'Nina', 'Ninić');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_croatian_ci NOT NULL,
  `surname` varchar(80) COLLATE utf8mb4_croatian_ci NOT NULL,
  `address` varchar(80) COLLATE utf8mb4_croatian_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_croatian_ci NOT NULL,
  `time_created` date NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(2) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `surname`, `address`, `email`, `time_created`, `status`) VALUES
(1, 'Mario', 'Marić', 'Zagrebačka 13,  Varaždin', 'mariom@gmail.com', '2021-03-03', 2),
(3, 'Lana', 'Anić', 'Prelo&scaron;ka 7,  Čakovec', 'lanaa@gmail.com', '2021-03-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` tinyint(2) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_croatian_ci NOT NULL,
  `description` text COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status`, `description`) VALUES
(1, 'Izvršeno', 'Narudžba je obrađena i uspješno izvršena'),
(2, 'U obradi', 'Narudžba je zaprimljena i obrađuje se'),
(3, 'Otkazano', 'Narudžba je otkazana');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_croatian_ci NOT NULL,
  `brand_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_croatian_ci NOT NULL,
  `price_base` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `price_final` decimal(10,2) NOT NULL,
  `available` int(11) NOT NULL,
  `forbidden` tinyint(1) NOT NULL,
  `special` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `brand_id`, `description`, `price_base`, `discount`, `price_final`, `available`, `forbidden`, `special`, `active`) VALUES
(1, 'FAME METALLIC black gold', 1, 'Materijali: koža, tekstil', '690.00', 6, '650.00', 23, 0, 0, 1),
(2, 'Cali Arctic Jr white', 1, 'Materijali: koža, tekstil', '540.00', 7, '500.00', 12, 0, 1, 1),
(3, '1460 cherry red smooth', 5, 'Svi modeli iz [Core] kolekcije utjelovljuju sve što je jedinstveno za brand Dr.Martens.', '1440.00', 20, '1150.00', 0, 1, 0, 0),
(4, 'Vans app acc 66 SUPPLY black', 6, 'Sastav: 76% pamuk, 24% poliester', '570.00', 3, '540.00', 45, 0, 1, 1),
(5, 'Puma app acc TFS Worldhood Track black', 1, 'Sastav: 100% pamuk', '500.00', 3, '475.00', 56, 0, 0, 1),
(6, 'Vans app acc OFF THE WALL CLASSIC GRAPHIC LS cool pnk', 6, 'Sastav: 100% pamuk', '300.00', 3, '284.00', 12, 0, 0, 1),
(7, 'Puma app acc Rebel Tee 5 Continents black', 1, 'Sastav: 100% pamuk', '190.00', 2, '180.00', 7, 0, 0, 1),
(8, 'Puma app acc Classics Logo Hoodie black', 1, 'Sastav: 100% pamuk', '460.00', 4, '435.00', 15, 0, 0, 1),
(9, 'Vans app acc Spicoli 4 Shades blk frosted transl', 6, 'sastav : umjetni materijali ( polikarbonat)', '170.00', 15, '128.00', 4, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_values`
--

CREATE TABLE `product_attributes_values` (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `product_attributes_values`
--

INSERT INTO `product_attributes_values` (`product_id`, `attribute_id`, `value_id`) VALUES
(1, 2, 3),
(2, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_cart`
--

CREATE TABLE `product_cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `product_cart`
--

INSERT INTO `product_cart` (`cart_id`, `product_id`, `quantity`) VALUES
(20, 1, 1),
(21, 4, 2),
(20, 7, 4),
(25, 4, 2),
(25, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 3),
(1, 23),
(2, 23),
(4, 26),
(5, 26),
(6, 29),
(7, 29),
(8, 29),
(9, 31),
(3, 23),
(4, 24),
(5, 24),
(6, 24),
(7, 24),
(8, 24),
(9, 25);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_id`, `photo`) VALUES
(1, 'puma_fame_metallic1.jpg'),
(1, 'puma_fame_metallic2.jpg'),
(2, 'puma_cali_arctic_jr.jpg'),
(4, 'vans_app1.jpg'),
(4, 'vans_app2.jpg'),
(5, 'puma_app_acc1.jpg'),
(5, 'puma_app_acc2.jpg'),
(5, 'puma_app_acc3.jpg'),
(6, 'vans_cool_pink1.jpg'),
(6, 'vans_cool_pink2.jpg'),
(7, 'puma_rebel_tee1.jpg'),
(7, 'puma_rebel_tee2.jpg'),
(8, 'puma_classic_black1.jpg'),
(8, 'puma_classic_black1.jpg'),
(9, 'vans_spicoli1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 2, 1, '600.00'),
(3, 1, 2, '1000.00'),
(1, 3, 1, '1000.00'),
(3, 2, 1, '400.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes_values`
--
ALTER TABLE `attributes_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_status` (`status`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_brand_id` (`brand_id`);

--
-- Indexes for table `product_attributes_values`
--
ALTER TABLE `product_attributes_values`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `value_id` (`value_id`);

--
-- Indexes for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD KEY `fk_cart_id_cart` (`cart_id`),
  ADD KEY `fk_product_id_cart` (`product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD KEY `fk_product_id_category` (`product_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD KEY `fk_product_id` (`product_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD KEY `fk_product_id_order` (`product_id`),
  ADD KEY `fk_order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attributes_values`
--
ALTER TABLE `attributes_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributes_values`
--
ALTER TABLE `attributes_values`
  ADD CONSTRAINT `attributes_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`status`) REFERENCES `order_status` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_brand_id` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Constraints for table `product_attributes_values`
--
ALTER TABLE `product_attributes_values`
  ADD CONSTRAINT `product_attributes_values_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_values_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_values_ibfk_3` FOREIGN KEY (`value_id`) REFERENCES `attributes_values` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD CONSTRAINT `fk_cart_id_cart` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product_id_cart` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product_id_category` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_product_id_order` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
