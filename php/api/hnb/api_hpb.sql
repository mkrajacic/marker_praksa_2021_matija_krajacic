-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 04:42 PM
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
-- Database: `api_hpb`
--

-- --------------------------------------------------------

--
-- Table structure for table `valuta`
--

CREATE TABLE `valuta` (
  `broj_tecajnice` tinyint(4) NOT NULL,
  `datum_primjene` date NOT NULL,
  `drzava` varchar(40) COLLATE utf8mb4_croatian_ci NOT NULL,
  `sifra_valute` smallint(6) NOT NULL,
  `valuta` varchar(5) COLLATE utf8mb4_croatian_ci NOT NULL,
  `jedinica` tinyint(4) NOT NULL,
  `kupovni_devize` decimal(10,6) NOT NULL,
  `srednji_devize` decimal(10,6) NOT NULL,
  `prodajni_devize` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
