-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2026 at 08:43 PM
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
-- Database: `beisadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `abonementi`
--

CREATE TABLE `abonementi` (
  `ID` int(11) NOT NULL,
  `Liet_ID` int(11) NOT NULL,
  `Tips` enum('30 dienas','90 dienas','180 dienas','360 dienas') NOT NULL,
  `Sakums` datetime DEFAULT NULL,
  `Beigas` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `abonementi`
--

INSERT INTO `abonementi` (`ID`, `Liet_ID`, `Tips`, `Sakums`, `Beigas`) VALUES
(11, 2, '30 dienas', '2026-05-20 00:00:00', '2026-06-19 00:00:00'),
(12, 6, '360 dienas', '2023-05-21 00:00:00', '2024-05-16 00:00:00'),
(13, 3, '180 dienas', '2026-05-21 00:00:00', '2026-11-17 00:00:00'),
(14, 9, '180 dienas', '2026-05-21 00:00:00', '2026-11-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `atsauksmes`
--

CREATE TABLE `atsauksmes` (
  `ID` int(11) NOT NULL,
  `Liet_ID` int(11) NOT NULL,
  `Zinas_ID` int(11) NOT NULL,
  `teksts` varchar(255) NOT NULL,
  `izveidots` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atsauksmes`
--

INSERT INTO `atsauksmes` (`ID`, `Liet_ID`, `Zinas_ID`, `teksts`, `izveidots`) VALUES
(14, 16, 51, 'Manuprāt, tas ir ļoti svarīgi, jo drošība ir viena no galvenajām lietām, un ir labi, ka valsts turpi', '2026-02-23 22:05:23'),
(15, 19, 55, 'an šķiet, ka tas ir labs solis, jo ieguldījumi inovācijās un enerģētikas drošībā var palīdzēt stipri', '2026-02-23 22:05:42'),
(16, 9, 54, 'Manuprāt, ir ļoti svarīgi, ka Apvienoto Nāciju Organizācija veicina diskusijas un sadarbību, jo tika', '2026-02-23 22:06:03'),
(17, 15, 53, 'Manuprāt, šādas diskusijas Saeima ir svarīgas, jo pārdomātas nodokļu izmaiņas var palīdzēt attīstīt ', '2026-02-23 22:06:20'),
(18, 17, 56, 'Manuprāt, šis ir ļoti sarežģīts jautājums, un ir svarīgi, lai Amerikas Savienotās Valstis rastu līdz', '2026-02-23 22:06:38'),
(19, 19, 52, 'Man šķiet, ka tas ir labi, jo vēlēšanas dod iespēju iedzīvotājiem izvēlēties pārmaiņas un veicināt s', '2026-02-23 22:06:54'),
(20, 8, 50, 'Manuprāt, ir labi, ka Latvijas Republikas Ministru kabinets cenšas palīdzēt cilvēkiem un uzņēmējiem,', '2026-02-23 22:07:09'),
(21, 26, 57, 'Manuprāt, tas ir pozitīvs solis, jo Japāna ieguldījumi atjaunojamajā enerģijā var palīdzēt gan videi', '2026-02-23 22:07:25'),
(22, 22, 49, 'Manuprāt, ir svarīgi, ka Saeima rūpīgi izvērtē budžetu, jo no šiem lēmumiem būs atkarīga gan sabiedr', '2026-02-23 22:07:42'),
(23, 28, 48, 'Izskatās, ka sezona sola daudz spriedzes un emociju, un būs interesanti redzēt, kuras komandas spēs ', '2026-02-23 22:07:55'),
(24, 19, 47, 'Man šķiet, ka tas ir lieliski, jo pasākums iedrošina cilvēkus būt aktīviem un vienlaikus rada pozitī', '2026-02-23 22:08:08'),
(25, 27, 46, 'Izskatās, ka turnīrs bija ļoti aizraujošs, un pusfinālisti noteikti būs pelnījuši vietu finālā, jo s', '2026-02-23 22:08:23'),
(26, 19, 58, 'Izskatās, ka situācija ir sarežģīta, jo Apvienotā Karaliste iedzīvotājiem tas rada neērtības, bet da', '2026-02-23 22:08:43'),
(27, 13, 45, 'Manuprāt, tas ir iedvesmojoši, jo Latvija sportisti strādā smagi, lai sasniegtu labākos rezultātus g', '2026-02-23 22:08:59'),
(28, 19, 44, 'Izskatās, ka šodien gaidāmas ļoti spraigas spēles, un līdzjutējiem būs iespēja izbaudīt lielisku spo', '2026-02-23 22:09:15'),
(29, 15, 43, 'Izskatās, ka laiks būs mainīgs, tāpēc ir vērts sekot prognozēm un izvēlēties piemērotu apģērbu, kā a', '2026-02-23 22:09:37'),
(30, 26, 42, 'Izskatās, ka ziemas apstākļi prasa īpašu uzmanību, tāpēc ir labi, ka tiek aicināts rūpēties par droš', '2026-02-23 22:09:53'),
(31, 19, 41, 'Izskatās, ka Liepājā gaidāms stiprs vējš, tāpēc ir labi, ka iedzīvotāji tiek brīdināti un aicināti b', '2026-02-23 22:10:10'),
(32, 24, 40, 'Šķiet, ka Rīgā gaidāms spēcīgs sniegs, tāpēc ir labi, ka iedzīvotāji tiek brīdināti un aicināti būt ', '2026-02-23 22:10:27'),
(33, 25, 39, 'Izskatās, ka “Liepāja Wave-1” ir iespaidīgs tehnoloģisks projekts, kas izmanto atjaunojamo enerģiju ', '2026-02-23 22:10:43'),
(34, 19, 38, 'Izskatās, ka “AI Kafe” ir interesants un inovatīvs projekts, kas apvieno tehnoloģijas un kultūru, ļa', '2026-02-23 22:10:58'),
(35, 13, 37, 'Izskatās, ka jaunais gājēju un velosipēdu tilts būs gan praktisks, gan vizuāli pievilcīgs risinājums', '2026-02-23 22:11:15'),
(36, 2, 36, 'Izskatās, ka jaunā velonovietne būs liels solis Rīgas attīstībā kā draudzīgai velosipēdistiem pilsēt', '2026-02-23 22:11:34'),
(37, 12, 32, 'Izskatās, ka “Rīgas gaisa koridors” būs inovatīvs transporta risinājums, kas var paātrināt pārvietoš', '2026-02-23 22:11:50'),
(39, 20, 54, 'Sekošu līdzi!', '2026-02-23 22:14:17'),
(40, 21, 48, 'Sekošu līdzi!', '2026-02-23 22:17:33'),
(63, 18, 58, 'Man tas nepatīk', '2026-05-06 01:39:31'),
(64, 27, 58, 'Gaidīšu jaunas ziņas', '2026-05-06 01:43:50'),
(69, 12, 58, 'Ļoti interesanti!', '2026-05-07 15:52:28'),
(70, 30, 58, 'Noderīga ziņa!', '2026-05-07 21:40:01'),
(80, 3, 105, 'Apsveicu!', '2026-05-25 20:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `lietotaji`
--

CREATE TABLE `lietotaji` (
  `ID` int(11) NOT NULL,
  `Vards` varchar(30) NOT NULL,
  `epasts` varchar(50) NOT NULL,
  `parole` varchar(100) NOT NULL,
  `Loma` enum('Lietotājs','Darbinieks','Administrators') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lietotaji`
--

INSERT INTO `lietotaji` (`ID`, `Vards`, `epasts`, `parole`, `Loma`) VALUES
(2, 'kristiāns', 'kristisns.beisa@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(3, 'Darbinieks', 'darbiniekslz1@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Darbinieks'),
(6, 'Administrators', 'adminlz1@gmail.com', '$2y$10$qCB2V6.1KQMJ2mCzpf189eNDz1q0Y4MbkAb50qkYdPQ7c/ZZDdTE.', 'Administrators'),
(7, 'copikss', 'cop.privatemail@gmail.com', '$2y$10$eloWLMA0XHs8.EK/mr47VudmYBijaF5lWka2fAHKDq46YRUdg5IP6', 'Lietotājs'),
(8, 'Lietotājs57', 'Liet57@gmail.com', '$2y$10$p5DKsFSR4oylGJi6mkEmMekZTAYUiIjK3PiPTOAo3Ss', 'Lietotājs'),
(9, 'Janis', 'Janis@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(12, 'Petrs', 'Petrs@gmail.com', '$2y$10$rK5xrN9o.uFn8y/4w0Z2i.6aJG66/etnUaoQDTLArfH', 'Lietotājs'),
(13, 'spoks', 'spoks@gmail.com', '$2y$10$xnqHlzUqSMl64myBmevQHeDOzGTML43/qELD/gr30dw', 'Lietotājs'),
(14, 'citsliet', 'nezinams@gmail.com', '$2y$10$s5d34MJnHEjVOR9tbp87ZOLOjfdXhpZrM4HStuQszUQ', 'Lietotājs'),
(15, 'Anna', 'anna@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(16, 'Gregor', 'greg@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(17, 'nulliite', 'nulle@gmail.com', '$2y$10$eloWLMA0XHs8.EK/mr47VudmYBijaF5lWka2fAHKDq46YRUdg5IP6', 'Lietotājs'),
(18, 'Ozoliņš', 'ozolins@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(19, 'martinja_am', 'martja@gmail.com', '$2y$10$oULYEQFeTTsjth2iQ7hvaeKVa.Dnk7qUxp7YIrWeVrcDIhaJ26tRi', 'Lietotājs'),
(20, 'Pēterītis', 'peteritis@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(21, 'Jānīitis', 'janitis@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(22, 'nezinamais', 'unknown123@gmail.com', '$2y$10$O/oCckJCj4MYGbkXNDfKTeKyW7QGWsZNv1YVnm3D9im3n4jTeSPhe', 'Lietotājs'),
(23, 'Ainārs', 'ainar@gmail.com', '$2y$10$1yyUdbWdmBzqdnNWUR4aouuHdQHEg.Q8Ewnjuz.hQgKxVhOmbqTr6', 'Lietotājs'),
(24, 'Ieva', 'ieva@gmail.com', '$2y$10$VK9ykxdbEuUKabgvaj83IOqgOBfBSyGG7pPx27vYybu/KpEoyTFrm', 'Lietotājs'),
(25, 'Laila', 'laila@gmail.com', '$2y$10$otAuqF5Eenz//NxdoRc91.UfFnUBYeklaqi0PsaA6tw806Hpk9evK', 'Lietotājs'),
(26, 'Viktor', 'viktor@gmail.com', '$2y$10$zVlcZi9DVGimaMLOyw3bS.cec/quW3QWHZ78kPhHQvVYW1dH7mDzS', 'Lietotājs'),
(27, 'Mihails', 'mihail@hi.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(28, 'Deivids', 'deivid@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(29, 'Ričards', 'Richard@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(30, 'Linda', 'linda@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(31, 'Pērkons', 'perkons@gmail.com', '$2y$10$tuXX/P8D/EN9GbHdsXtvCevCfyqduBrr0eaFDNaLNNFiWZpgxQV7K', 'Lietotājs'),
(32, 'Stiprais', 'stiprais@gmail.com', '$2y$10$6f4dYQdXHEu.sMcjTJWGtu.8LJtwcrl6E0GTTmCbuN98VxVpwSca.', 'Lietotājs'),
(33, 'Mākonītis', 'makonis@gmail.com', '$2y$10$yZk3kxkoVseAj1dTw8.Tn.At.MHUt.FUKSmCr1D2z/zZPY3iDohHm', 'Lietotājs'),
(34, 'Labais', 'labais@gmail.com', '$2y$10$Nb9a.HDgWB3gQy2jAhkJAe0cwAq8oN1cjDOR4rOFy6c8TseoTYrJi', 'Lietotājs'),
(35, 'Sliktais', 'sliktais@gmail.com', '$2y$10$M/qCf1oshaRYCDyQCS110uKh9YGQ37KkH9QDyBnjlGjAId1LWoyVa', 'Lietotājs'),
(36, 'Krūzīte', 'kruze@gmail.com', '$2y$10$qCB2V6.1KQMJ2mCzpf189eNDz1q0Y4MbkAb50qkYdPQ7c/ZZDdTE.', 'Lietotājs');

-- --------------------------------------------------------

--
-- Table structure for table `terzetavas_zinas`
--

CREATE TABLE `terzetavas_zinas` (
  `ID` int(11) NOT NULL,
  `Liet_ID` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `teksts` varchar(100) NOT NULL,
  `izveidots` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terzetavas_zinas`
--

INSERT INTO `terzetavas_zinas` (`ID`, `Liet_ID`, `category`, `teksts`, `izveidots`) VALUES
(2, 2, 'jaunakais', 'Čau!', '2026-02-21 22:43:10'),
(79, 22, 'lietotaju_zinas', 'Labdien', '2026-03-22 14:52:23'),
(90, 6, 'jaunakais', 'Sveiki!', '2026-05-10 17:49:07'),
(116, 2, 'jaunakais', 'Kas šodien jauns?', '2026-05-25 17:29:00'),
(117, 2, 'latvija', 'Izskatās, ka šodien Latvijā nebūs daudz ziņu', '2026-05-25 17:29:41'),
(118, 2, 'sports', 'Kad būs ziņas par Latvijas hokeja izlasi?', '2026-05-25 17:30:12'),
(119, 15, 'politika', 'Man neinterisē politika', '2026-05-25 17:31:06'),
(120, 15, 'arzemes', 'Gaidu vairāk ziņas par ASV', '2026-05-25 17:31:43'),
(121, 9, 'lietotaju_zinas', 'Kā jums visiem šodien klājas?', '2026-05-25 17:33:21'),
(122, 9, 'laika_zinas', 'Šodien Rīgā ir silts laiks', '2026-05-25 13:33:41'),
(123, 9, 'jaunakais', 'Labvakar!', '2026-05-25 17:33:56'),
(124, 30, 'jaunakais', 'Sveiki visiem!', '2026-05-25 17:35:03'),
(125, 30, 'laika_zinas', 'Šodien plānoju doties atpūsties uz jūru', '2026-05-25 10:35:36'),
(126, 30, 'lietotaju_zinas', 'Man viss kārtībā', '2026-05-25 17:36:14'),
(127, 29, 'arzemes', 'Man gan vairāk interesē Eiropas ziņas', '2026-05-25 17:36:54'),
(128, 29, 'sports', 'Jā, vajag ziņas par Latvijas hokeja izlasi!', '2026-05-25 17:37:36'),
(129, 29, 'jaunakais', 'Gaidu jaunas ziņas!', '2026-05-25 18:00:38'),
(130, 26, 'politika', 'Man gan interesē un ļoti gaidu jaunas ziņas', '2026-05-25 18:01:46'),
(131, 26, 'lietotaju_zinas', 'Šodien nav interesantu ziņu', '2026-05-25 18:02:35'),
(132, 26, 'latvija', 'Vai Latvijā vispār kaut kas notiek?', '2026-05-25 18:03:11'),
(133, 18, 'arzemes', 'Ārzemēs ir interesantākas ziņas nekā Latvijā', '2026-05-25 18:04:22'),
(134, 18, 'latvija', 'Pēdējā mēnesī Latvijā bija dažas interesantas ziņas', '2026-05-25 18:05:14'),
(135, 16, 'sports', 'Gaidu ziņas par mūsējo sportistu panākumiem!', '2026-05-25 18:06:27'),
(136, 16, 'jaunakais', 'Šodien ir daudz jaunu ziņu', '2026-05-25 18:10:35'),
(137, 21, 'latvija', 'Kas šodien interesants notika Latvijā?', '2026-05-25 18:11:53'),
(138, 21, 'sports', 'Izskatās ka mūsējiem šomēnes ir labi panākumi sportā', '2026-05-25 18:12:28'),
(139, 21, 'lietotaju_zinas', 'Sveiki visiem!', '2026-05-25 18:12:53'),
(140, 20, 'laika_zinas', 'Man šodien laiks likās nedaudz vēss', '2026-05-25 18:15:11'),
(141, 20, 'politika', 'Kā domājat, kas būs nākošais Latvijas prezidents?', '2026-05-25 18:17:13'),
(142, 20, 'arzemes', 'Man vairāk interesē ziņas no austrumiem', '2026-05-25 18:19:26'),
(143, 20, 'sports', 'Man patīk sports!', '2026-05-25 18:19:54'),
(146, 20, 'lietotaju_zinas', 'Man nepatīk šis ziņu portāls', '2026-05-25 20:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `zinas`
--

CREATE TABLE `zinas` (
  `ID` int(11) NOT NULL,
  `Liet_ID` int(11) NOT NULL,
  `Kategorija` enum('Latvijā','Laika ziņas','Ārzemēs','Sports','Politika','Lietotāju ziņas') NOT NULL,
  `Nosaukums` varchar(100) NOT NULL,
  `Teksts` text NOT NULL,
  `Maksas_Teksts` text DEFAULT NULL,
  `Izveidots` datetime NOT NULL DEFAULT current_timestamp(),
  `Atjauninats` datetime DEFAULT NULL,
  `Bilde` varchar(255) NOT NULL,
  `Galerija` varchar(255) DEFAULT NULL,
  `Svarigums` int(1) NOT NULL,
  `videjais_vertejums` decimal(3,2) DEFAULT 0.00,
  `vertejumu_skaits` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zinas`
--

INSERT INTO `zinas` (`ID`, `Liet_ID`, `Kategorija`, `Nosaukums`, `Teksts`, `Maksas_Teksts`, `Izveidots`, `Atjauninats`, `Bilde`, `Galerija`, `Svarigums`, `videjais_vertejums`, `vertejumu_skaits`) VALUES
(23, 3, 'Laika ziņas', 'Šodien Rīgā būs -20 grādi', 'Šodien Rīgā gaidāms īpaši auksts laiks – gaisa temperatūra dienas laikā var pazemināties līdz pat -20 grādiem. Sinoptiķi brīdina, ka šādos apstākļos pastiprināti jāievēro piesardzība, īpaši uzturoties ārā ilgāku laiku. Iedzīvotājiem ieteicams ģērbties silti, izvēlēties vairākas apģērba kārtas un rūpēties par atbilstošu galvassegu un cimdiem.\r\n\r\nAukstuma ietekmē var veidoties apledojums uz ceļiem un ietvēm, tāpēc gan gājējiem, gan autovadītājiem jābūt īpaši uzmanīgiem. Dienas gaitā iespējams arī skaidrs laiks ar nelielu vēju, kas pastiprinās aukstuma sajūtu.', '', '2026-02-23 14:38:41', NULL, 'bildes/Šodien Rīgā būs -20 grādi/sniegparsla.webp', 'bildes/Šodien Rīgā būs -20 grādi/galerija', 1, 4.50, 2),
(32, 6, 'Latvijā', 'Rīgas dome apstiprina Gaisa taksometru “citu” līniju pār Daugavu', 'Rīga, 23. februāris, 2026 — Pēc divus gadus ilgušām debatēm Rīgas dome ar 39 balsīm “par” atbalstīja pilotprojektu “Rīgas gaisa koridors”. No 2027. gada vasaras starp Ķīpsalu un Teiku kursēs elektriskie pasažieru droni ar 4–6 sēdvietām. Brauciena ilgums — 4 minūtes, cena sākotnēji plānota 9–14 € atkarībā no diennakts laika. Kritiski noskaņotie deputāti norāda, ka trokšņa un drošības jautājumi nav pilnībā atrisināti.', NULL, '2026-02-23 16:33:43', NULL, 'bildes/Rīgas dome apstiprina Gaisa taksometru “citu” līniju pār Daugavu/citu.jpg', 'bildes/Rīgas dome apstiprina Gaisa taksometru “citu” līniju pār Daugavu/galerija', 1, 3.00, 2),
(36, 6, 'Latvijā', '2036 “Rail Baltica” stacija “Rīga Centrālā” atklās velosipēdu autostāvvietu 3200 velosipēdiem', 'Eiropas lielākā velonovietne zem viena jumta tiks atklāta jau jūnijā. Tā būs daļa no jaunās “Rail Baltica” stacijas kompleksa. Kopumā paredzēts, ka dienā to varēs izmantot līdz 8000 riteņbraucēju. “Mēs gribam, lai Rīga kļūst par Ziemeļeiropas velosipēdu galvaspilsētu,” paziņoja satiksmes ministrs.', NULL, '2026-02-23 16:41:46', NULL, 'bildes/2036 “Rail Baltica” stacija “Rīga Centrālā” atklās velosipēdu autostāvvietu 3200 velosipēdiem/railBalt.jpg', 'bildes/2036 “Rail Baltica” stacija “Rīga Centrālā” atklās velosipēdu autostāvvietu 3200 velosipēdiem/galerija', 0, 4.50, 2),
(37, 6, 'Latvijā', 'Rīgas dome apstiprina “Gaisa tilta” projektu – velosipēdu un gājēju tilts pāri Daugavai pie Vanšu ti', 'Rīgas pašvaldība pieņēmusi lēmumu būvēt jaunu 450 metru garu gājēju un velosipēdu tiltu paralēli Vanšu tiltam. Projekta izmaksas – 48 miljoni eiro, no kuriem 60 % segs Eiropas Savienības Atveseļošanas fonds. Paredzēts, ka tilts būs atvērts 2028. gada vasarā. Arhitekti sola, ka konstrukcija būs “gaisīga un zaļa” – ar integrētiem saules paneļiem un vertikālajiem dārziem.', NULL, '2026-02-23 16:44:55', NULL, 'bildes/Rīgas dome apstiprina “Gaisa tilta” projektu – velosipēdu un gājēju tilts pāri Daugavai pie Vanšu ti/gaisatilts.jpg', 'bildes/Rīgas dome apstiprina “Gaisa tilta” projektu – velosipēdu un gājēju tilts pāri Daugavai pie Vanšu ti/galerija', 0, 3.50, 2),
(38, 6, 'Latvijā', 'Daugavpilī atklāts pirmais Latgalē “Mākslīgā intelekta kafejnīca”', 'Jaunatklātajā “AI Kafe” Daugavpils Marka Rotko mākslas centrā apmeklētāji var pasūtīt kafiju, runājot latgaliski, latviski, krieviski vai lietuviski – mākslīgais intelekts atpazīst akcentu un automātiski aprēķina rēķinu. Īpašs jaunums – “Latgales dziesmu” režīms, kurā AI ģenerē īsu latgaliešu tautasdziesmu katram pasūtījumam.', NULL, '2026-02-23 16:47:09', NULL, 'bildes/Daugavpilī atklāts pirmais Latgalē “Mākslīgā intelekta kafejnīca”/MIcafe.jpg', 'bildes/Daugavpilī atklāts pirmais Latgalē “Mākslīgā intelekta kafejnīca”/galerija', 0, 3.50, 2),
(39, 6, 'Latvijā', 'Liepājā uzbūvēts pirmais peldošais “zaļais” datu centrs Eiropā', 'Liepāja, 20. februāris, 2026 — Ostas malā pie Karostas kanāla oficiāli atklāts pasaulē pirmais pilnībā uz ūdens peldošais datu centrs ar 100% atjaunojamo enerģiju no viļņiem un vēja. Komplekss “Liepāja Wave-1” spēj apkalpot mākslīgā intelekta apmācību līdz pat 40 000 GPU. Investori — liela Āzijas tehnoloģiju kompānija un Latvijas valsts fonds “Zilā nākotne”. Vietējie iedzīvotāji gan bažījas par to, kas notiks vētras laikā.', NULL, '2026-02-23 16:58:30', NULL, 'bildes/Liepājā uzbūvēts pirmais peldošais “zaļais” datu centrs Eiropā/zalais.jpg', 'bildes/Liepājā uzbūvēts pirmais peldošais “zaļais” datu centrs Eiropā/galerija', 1, 2.50, 2),
(40, 6, 'Laika ziņas', 'Šodien Rīgā gaidāms stiprs sniegs', 'Šodien Rīgā prognozēta intensīva snigšana, kas var apgrūtināt satiksmi un pārvietošanos pilsētā. Redzamība vietām var pasliktināties, tāpēc autovadītājiem ieteicams ievērot drošu distanci un izvēlēties piemērotu braukšanas ātrumu. Gājējiem jābūt uzmanīgiem uz ietvēm, jo iespējams slidens segums.', NULL, '2026-02-23 17:50:29', NULL, 'bildes/Šodien Rīgā gaidāms stiprs sniegs/stiprssniegs.jpg', 'bildes/Šodien Rīgā gaidāms stiprs sniegs/galerija', 1, 2.00, 2),
(41, 6, 'Laika ziņas', 'Liepājā rītdien gaidāms stiprs vējš', 'Sinoptiķi brīdina, ka Liepājā rītdien pūtīs spēcīgs vējš, kas var radīt diskomfortu un apgrūtināt pārvietošanos. Vēja brāzmas var būt īpaši jūtamas atklātās vietās. Iedzīvotājiem ieteicams nodrošināties pret vēja ietekmi un izvairīties no nestabilu objektu tuvuma.', NULL, '2026-02-23 17:51:48', NULL, 'bildes/Liepājā rītdien gaidāms stiprs vējš/stiprsvejs.jpg', 'bildes/Liepājā rītdien gaidāms stiprs vējš/galerija', 1, 4.00, 2),
(42, 6, 'Laika ziņas', 'Latvijā turpinās ziemai raksturīgi apstākļi', 'Latvijā turpinās ziemas sezona ar zemām gaisa temperatūrām un iespējamu snigšanu atsevišķās vietās. Iedzīvotāji tiek aicināti parūpēties par savu drošību un veselību, kā arī laikus sagatavot transportlīdzekļus ziemas apstākļiem. Komunālie dienesti strādā pie ceļu un ietvju uzturēšanas, lai nodrošinātu drošu pārvietošanos gan pilsētās, gan lauku teritorijās.', NULL, '2026-02-23 17:53:24', NULL, 'bildes/Latvijā turpinās ziemai raksturīgi apstākļi/rigaziema.jpg', 'bildes/Latvijā turpinās ziemai raksturīgi apstākļi/galerija', 1, 4.50, 2),
(43, 6, 'Laika ziņas', 'Šodien Latvijā gaidāmi mainīgi laikapstākļi', 'Šodien Latvijā prognozēti mainīgi laikapstākļi – vietām uzspīdēs saule, taču brīžiem debesis aizklās mākoņi. Atsevišķos reģionos iespējami nelieli nokrišņi. Gaisa temperatūra dienas laikā būs atšķirīga dažādos valsts novados, tāpēc iedzīvotājiem ieteicams sekot līdzi aktuālajām prognozēm un izvēlēties laikapstākļiem piemērotu apģērbu. Ceļu satiksmē aicinām būt uzmanīgiem, īpaši rīta un vakara stundās.', NULL, '2026-02-23 17:54:28', NULL, 'bildes/Šodien Latvijā gaidāmi mainīgi laikapstākļi/makoni.jpg', 'bildes/Šodien Latvijā gaidāmi mainīgi laikapstākļi/galerija', 1, 3.50, 2),
(44, 6, 'Sports', 'Šodien sporta arēnās gaidāmas aizraujošas spēles', 'Šodien vairākās sporta arēnās norisināsies svarīgas spēles, kurās komandas cīnīsies par uzvaru un turnīra punktiem. Sagaidāma sīva konkurence un līdzjutēju atbalsts tribīnēs. Sporta līdzjutēji aicināti sekot līdzi rezultātiem un spēļu gaitai tiešraidēs vai aktuālajos pārskatos.', NULL, '2026-02-23 18:48:10', NULL, 'bildes/Šodien sporta arēnās gaidāmas aizraujošas spēles/arenariga.jpg', 'bildes/Šodien sporta arēnās gaidāmas aizraujošas spēles/galerija', 1, 4.00, 2),
(45, 6, 'Sports', 'Latvijas sportisti gatavojas jaunām sacensībām', 'Latvijas sportisti turpina gatavošanos gaidāmajām sacensībām gan vietējā, gan starptautiskā līmenī. Treniņos tiek pilnveidota fiziskā sagatavotība un komandas saspēle. Sporta treneri uzsver disciplīnas un komandas darba nozīmi, lai sasniegtu augstus rezultātus.', NULL, '2026-02-23 19:30:42', NULL, 'bildes/Latvijas sportisti gatavojas jaunām sacensībām/karogs.jfif', 'bildes/Latvijas sportisti gatavojas jaunām sacensībām/galerija', 1, 4.50, 2),
(46, 6, 'Sports', 'Turnīrā noskaidroti pusfinālisti', 'Aizvadītajās spēlēs turnīrā noskaidroti pusfinālisti, kuri turpinās cīņu par galveno balvu. Spēles bija spraigas un emocijām bagātas. Komandas demonstrēja augstu meistarību, un skatītāji varēja baudīt dinamisku un aizraujošu sporta notikumu.', NULL, '2026-02-23 21:42:18', NULL, 'bildes/Turnīrā noskaidroti pusfinālisti/medalas.webp', 'bildes/Turnīrā noskaidroti pusfinālisti/galerija', 1, 5.00, 2),
(47, 6, 'Sports', 'Sporta pasākumā piedalās rekordliels dalībnieku skaits', 'Šī gada sporta pasākumā piedalās rekordliels dalībnieku skaits. Organizatori norāda, ka interese par aktīvu dzīvesveidu turpina pieaugt. Pasākums vieno dažāda vecuma sportistus un veicina veselīgu konkurenci un kopības sajūtu.', NULL, '2026-02-23 21:55:10', NULL, 'bildes/Sporta pasākumā piedalās rekordliels dalībnieku skaits/sleposana.jpg', 'bildes/Sporta pasākumā piedalās rekordliels dalībnieku skaits/galerija', 1, 4.00, 2),
(48, 6, 'Sports', 'Sezonas noslēgumā gaidāmi izšķiroši mači', 'Sporta sezonas noslēgumā gaidāmi izšķiroši mači, kas noteiks kopvērtējuma uzvarētājus. Komandas gatavojas pēdējiem izaicinājumiem, un katrs punkts būs svarīgs. Līdzjutēji tiek aicināti atbalstīt savus favorītus un sekot līdzi notikumu attīstībai.', NULL, '2026-02-23 21:55:57', NULL, 'bildes/Sezonas noslēgumā gaidāmi izšķiroši mači/football.jpg', 'bildes/Sezonas noslēgumā gaidāmi izšķiroši mači/galerija', 1, 4.50, 2),
(49, 6, 'Politika', 'Saeimā notiek debates par nākamā gada budžetu', 'Saeima šodien turpinās debates par nākamā gada valsts budžeta projektu. Deputāti diskutē par finansējuma sadalījumu veselības aprūpei, izglītībai un aizsardzībai. Opozīcija aicina pārskatīt prioritātes, savukārt koalīcijas pārstāvji uzsver fiskālās disciplīnas nozīmi.', NULL, '2026-02-23 21:58:27', NULL, 'bildes/Saeimā notiek debates par nākamā gada budžetu/debates.avif', 'bildes/Saeimā notiek debates par nākamā gada budžetu/galerija', 1, 3.67, 3),
(50, 6, 'Politika', 'Valdība vienojas par jauniem atbalsta pasākumiem iedzīvotājiem', 'Latvijas Republikas Ministru kabinets apstiprinājis virkni jaunu atbalsta pasākumu, lai mazinātu dzīves dārdzības ietekmi uz mājsaimniecībām. Plānots paplašināt sociālās palīdzības programmas un sniegt papildu atbalstu uzņēmējiem. Lēmumi stāsies spēkā pēc nepieciešamo normatīvo aktu pieņemšanas.', NULL, '2026-02-23 21:59:32', NULL, 'bildes/Valdība vienojas par jauniem atbalsta pasākumiem iedzīvotājiem/purvciems.jpg', 'bildes/Valdība vienojas par jauniem atbalsta pasākumiem iedzīvotājiem/galerija', 1, 4.50, 2),
(51, 6, 'Politika', 'Prezidents uzsver drošības jautājumu nozīmi', 'Prezidents uzsvēris, ka valsts drošība un aizsardzības stiprināšana joprojām ir viena no galvenajām prioritātēm. Viņš aicinājis stiprināt sadarbību ar starptautiskajiem partneriem un turpināt ieguldījumus aizsardzības sektorā.', NULL, '2026-02-23 22:00:51', NULL, 'bildes/Prezidents uzsver drošības jautājumu nozīmi/robezsardze.jpg', 'bildes/Prezidents uzsver drošības jautājumu nozīmi/galerija', 1, 4.50, 2),
(52, 6, 'Politika', 'Partijas sāk gatavošanos pašvaldību vēlēšanām', 'Vairākas politiskās partijas Latvijā sākušas aktīvu gatavošanos gaidāmajām pašvaldību vēlēšanām. Tiek veidoti kandidātu saraksti un izstrādātas priekšvēlēšanu programmas, īpašu uzmanību pievēršot reģionu attīstībai un infrastruktūras uzlabošanai.', NULL, '2026-02-23 22:02:46', NULL, 'bildes/Partijas sāk gatavošanos pašvaldību vēlēšanām/balsosana.jfif', 'bildes/Partijas sāk gatavošanos pašvaldību vēlēšanām/galerija', 1, 3.00, 2),
(53, 6, 'Politika', 'Saeimas komisijā apspriež izmaiņas nodokļu politikā', 'Saeimas Budžeta un finanšu (nodokļu) komisija notiek diskusijas par iespējamiem grozījumiem nodokļu politikā. Tiek vērtēti priekšlikumi par iedzīvotāju ienākuma nodokļa un uzņēmumu nodokļu izmaiņām, lai veicinātu ekonomikas izaugsmi un investīciju piesaisti.', NULL, '2026-02-23 22:03:21', NULL, 'bildes/Saeimas komisijā apspriež izmaiņas nodokļu politikā/ekonomika.jpg', 'bildes/Saeimas komisijā apspriež izmaiņas nodokļu politikā/galerija', 1, 4.00, 2),
(54, 6, 'Ārzemēs', 'ANO Ģenerālajā asamblejā apspriež globālās drošības jautājumus', 'Apvienoto Nāciju Organizācija Ģenerālajā asamblejā šonedēļ notiek plašas diskusijas par globālās drošības un klimata pārmaiņu izaicinājumiem. Dalībvalstu pārstāvji uzsver nepieciešamību stiprināt starptautisko sadarbību un meklēt kopīgus risinājumus aktuālajām krīzēm.', NULL, '2026-02-23 22:04:01', NULL, 'bildes/ANO Ģenerālajā asamblejā apspriež globālās drošības jautājumus/ano.jpg', 'bildes/ANO Ģenerālajā asamblejā apspriež globālās drošības jautājumus/galerija', 1, 4.50, 2),
(55, 6, 'Ārzemēs', 'Eiropas Savienība vienojas par jaunu ekonomikas atbalsta plānu', 'Eiropas Savienība dalībvalstis panākušas vienošanos par jaunu ekonomikas atbalsta mehānismu, kura mērķis ir veicināt izaugsmi un inovācijas. Plānā paredzēti ieguldījumi digitālajā attīstībā un enerģētikas drošībā.', NULL, '2026-02-23 22:04:37', NULL, 'bildes/Eiropas Savienība vienojas par jaunu ekonomikas atbalsta plānu/monetas.jfif', 'bildes/Eiropas Savienība vienojas par jaunu ekonomikas atbalsta plānu/galerija', 1, 3.50, 2),
(56, 6, 'Ārzemēs', 'ASV notiek asas debates par imigrācijas reformu', 'Amerikas Savienotās Valstis likumdevēji turpina diskusijas par imigrācijas politikas reformu. Priekšlikumi paredz stingrākus robežkontroles pasākumus, kā arī izmaiņas uzturēšanās atļauju piešķiršanas kārtībā. Sabiedrībā jautājums izraisījis plašas diskusijas.', NULL, '2026-02-23 22:06:07', NULL, 'bildes/ASV notiek asas debates par imigrācijas reformu/asvkarogs.jpg', 'bildes/ASV notiek asas debates par imigrācijas reformu/galerija', 1, 2.50, 2),
(57, 6, 'Ārzemēs', 'Japānā pieaug interese par atjaunojamo enerģiju', 'Japāna valdība paziņojusi par plāniem paplašināt atjaunojamās enerģijas projektus, lai mazinātu atkarību no fosilajiem kurināmajiem. Tiek apsvērta saules un vēja parku attīstība, kā arī investīcijas modernās tehnoloģijās.', '', '2026-02-23 22:07:03', NULL, 'bildes/Japānā pieaug interese par atjaunojamo enerģiju/saulespaneli.jpg', 'bildes/Japānā pieaug interese par atjaunojamo enerģiju/galerija', 1, 4.50, 2),
(58, 6, 'Ārzemēs', 'Lielbritānijā streiko sabiedriskā transporta darbinieki', 'Apvienotā Karaliste vairākās pilsētās sabiedriskā transporta darbinieki uzsākuši streiku, pieprasot algu paaugstināšanu un labākus darba apstākļus. Streiks radījis būtiskus satiksmes traucējumus un ietekmējis tūkstošiem iedzīvotāju ikdienu.', '', '2026-02-23 22:08:02', NULL, 'bildes/Lielbritānijā streiko sabiedriskā transporta darbinieki/londonbus.jpg', 'bildes/Lielbritānijā streiko sabiedriskā transporta darbinieki/galerija', 1, 5.00, 2),
(59, 6, 'Lietotāju ziņas', 'Apkārtnē atvērta jauna kafejnīca', 'Mūsu rajonā šonedēļ durvis vērusi neliela, mājīga kafejnīca, ko izveidojusi vietējā ģimene. Iedzīvotāji jau dalās ar atsauksmēm sociālajos tīklos, slavējot svaigi ceptās bulciņas un draudzīgo apkalpošanu. Jaunā vieta ātri kļuvusi par satikšanās punktu kaimiņiem.', NULL, '2026-02-23 22:09:20', NULL, 'bildes/Apkārtnē atvērta jauna kafejnīca/bars.jpeg', 'bildes/Apkārtnē atvērta jauna kafejnīca/galerija', 0, 4.00, 2),
(60, 6, 'Lietotāju ziņas', 'Parkā sakopta bērnu rotaļu zona', 'Brīvprātīgie nedēļas nogalē sakopa tuvējā parka bērnu laukumu – tika savākti atkritumi, salabotas šūpoles un nokrāsoti soliņi. Vietējie iedzīvotāji priecājas par kopīgo darbu un aicina arī citus iesaistīties apkārtnes uzlabošanā.', NULL, '2026-02-23 22:10:07', NULL, 'bildes/Parkā sakopta bērnu rotaļu zona/bernulaukums.jpg', 'bildes/Parkā sakopta bērnu rotaļu zona/galerija', 0, 4.00, 2),
(61, 6, 'Lietotāju ziņas', 'Dalos pieredzē par pārgājienu gar jūru', 'Sestdien devos pārgājienā gar jūras krastu un vēlos ieteikt šo maršrutu arī citiem. Laiks bija saulains, bet vēss, un skati – iespaidīgi. Ja plānojat doties dabā, noteikti parūpējieties par ērtu apģērbu un siltu tēju termosā.', NULL, '2026-02-23 22:10:47', NULL, 'bildes/Dalos pieredzē par pārgājienu gar jūru/jura.jpg', 'bildes/Dalos pieredzē par pārgājienu gar jūru/galerija', 0, 4.50, 2),
(63, 6, 'Lietotāju ziņas', 'Ieteikums drošībai uz ceļa tumšajā laikā', 'Pēdējā laikā vakaros kļūst tumšs agrāk, tāpēc atgādinu visiem gājējiem lietot atstarotājus. Pats nesen piedzīvoju situāciju, kad autovadītājs mani gandrīz nepamanīja. Rūpēsimies par savu un citu drošību!', NULL, '2026-02-23 22:12:16', NULL, 'bildes/Ieteikums drošībai uz ceļa tumšajā laikā/naktsiela.jpg', 'bildes/Ieteikums drošībai uz ceļa tumšajā laikā/galerija', 0, 4.00, 2),
(103, 20, 'Lietotāju ziņas', 'Nepatīk ziņu portāls', 'Nepatīk nepatīk nepatīk nepatīk nepatīk nepatīk nepatīk nepatīk nepatīk nepatīk nepatīk', NULL, '2026-01-12 20:44:34', NULL, 'bildes/Nepatīk ziņu portāls/brown.png', 'bildes/Nepatīk ziņu portāls/galerija', 0, 0.00, 0),
(105, 9, 'Lietotāju ziņas', 'RTK izlaidums 2026', 'Vēlos paziņot, ka šogad 26. jūnijā man būs izlaidums Rīgas Tehniskajā koledžā!\r\nPriecātos redzēt atbalstu un apsveikumus!', NULL, '2026-05-25 20:55:16', NULL, 'bildes/RTK izlaidums 2026_3/RTK attēls.jpg', 'bildes/RTK izlaidums 2026_3/galerija', 0, 5.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zinu_vertejumi`
--

CREATE TABLE `zinu_vertejumi` (
  `ID` int(11) NOT NULL,
  `Liet_ID` int(11) NOT NULL,
  `Zinas_ID` int(11) NOT NULL,
  `Vertejums` enum('1','2','3','4','5') NOT NULL,
  `izveidots` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zinu_vertejumi`
--

INSERT INTO `zinu_vertejumi` (`ID`, `Liet_ID`, `Zinas_ID`, `Vertejums`, `izveidots`) VALUES
(10, 6, 58, '5', '2026-04-19 16:23:51'),
(12, 6, 91, '1', '2026-05-17 01:39:49'),
(18, 2, 91, '5', '2026-05-18 00:05:36'),
(19, 2, 58, '5', '2026-05-19 18:06:08'),
(20, 9, 93, '5', '2026-05-21 22:37:53'),
(21, 9, 94, '5', '2026-05-22 00:03:00'),
(22, 6, 23, '4', '2026-05-25 16:39:24'),
(23, 6, 57, '5', '2026-05-25 16:39:34'),
(24, 6, 56, '1', '2026-05-25 16:39:37'),
(25, 6, 55, '3', '2026-05-25 16:39:40'),
(26, 6, 54, '4', '2026-05-25 16:39:44'),
(27, 6, 53, '5', '2026-05-25 16:39:47'),
(28, 6, 52, '2', '2026-05-25 16:39:52'),
(29, 6, 51, '4', '2026-05-25 16:39:56'),
(30, 6, 50, '4', '2026-05-25 16:40:00'),
(31, 6, 49, '4', '2026-05-25 16:40:06'),
(32, 6, 48, '5', '2026-05-25 16:40:10'),
(33, 6, 47, '3', '2026-05-25 16:40:15'),
(34, 6, 46, '5', '2026-05-25 16:40:19'),
(35, 6, 45, '4', '2026-05-25 16:40:23'),
(36, 6, 44, '5', '2026-05-25 16:40:29'),
(37, 6, 43, '3', '2026-05-25 16:40:35'),
(38, 6, 42, '4', '2026-05-25 16:40:39'),
(39, 6, 41, '4', '2026-05-25 16:40:44'),
(40, 6, 40, '1', '2026-05-25 16:40:51'),
(41, 6, 39, '1', '2026-05-25 16:40:56'),
(42, 6, 38, '3', '2026-05-25 16:41:01'),
(43, 6, 37, '2', '2026-05-25 16:41:07'),
(44, 6, 36, '4', '2026-05-25 16:41:12'),
(45, 6, 32, '2', '2026-05-25 16:41:17'),
(46, 6, 63, '3', '2026-05-25 16:41:38'),
(47, 6, 61, '5', '2026-05-25 16:41:41'),
(48, 6, 60, '4', '2026-05-25 16:41:44'),
(49, 6, 59, '4', '2026-05-25 16:41:48'),
(50, 2, 57, '4', '2026-05-25 17:15:46'),
(51, 2, 56, '4', '2026-05-25 17:15:52'),
(52, 2, 55, '4', '2026-05-25 17:15:56'),
(53, 2, 54, '5', '2026-05-25 17:16:00'),
(54, 2, 53, '3', '2026-05-25 17:16:05'),
(55, 2, 52, '4', '2026-05-25 17:16:20'),
(56, 2, 51, '5', '2026-05-25 17:16:26'),
(57, 15, 50, '5', '2026-05-25 17:18:04'),
(58, 15, 49, '3', '2026-05-25 17:18:11'),
(59, 15, 48, '4', '2026-05-25 17:18:16'),
(60, 15, 47, '5', '2026-05-25 17:18:21'),
(61, 15, 46, '5', '2026-05-25 17:18:29'),
(62, 15, 45, '5', '2026-05-25 17:18:33'),
(63, 9, 49, '4', '2026-05-25 17:19:00'),
(64, 9, 44, '3', '2026-05-25 17:19:08'),
(65, 9, 43, '4', '2026-05-25 17:19:13'),
(66, 9, 42, '5', '2026-05-25 17:19:18'),
(67, 9, 41, '4', '2026-05-25 17:19:25'),
(68, 9, 40, '3', '2026-05-25 17:19:30'),
(69, 9, 39, '4', '2026-05-25 17:19:35'),
(70, 9, 38, '4', '2026-05-25 17:19:41'),
(71, 9, 37, '5', '2026-05-25 17:19:47'),
(72, 9, 36, '5', '2026-05-25 17:19:53'),
(73, 9, 32, '4', '2026-05-25 17:19:59'),
(74, 9, 23, '5', '2026-05-25 17:20:04'),
(75, 9, 63, '5', '2026-05-25 17:20:11'),
(76, 9, 61, '4', '2026-05-25 17:20:16'),
(77, 9, 60, '4', '2026-05-25 17:20:19'),
(78, 9, 59, '4', '2026-05-25 17:20:22'),
(79, 6, 104, '4', '2026-05-25 20:51:10'),
(80, 3, 105, '5', '2026-05-25 20:56:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abonementi`
--
ALTER TABLE `abonementi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `lietotajs_id` (`Liet_ID`);

--
-- Indexes for table `atsauksmes`
--
ALTER TABLE `atsauksmes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `atsauksme_liet` (`Liet_ID`),
  ADD KEY `atsauksme_zinas` (`Zinas_ID`);

--
-- Indexes for table `lietotaji`
--
ALTER TABLE `lietotaji`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `terzetavas_zinas`
--
ALTER TABLE `terzetavas_zinas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `terzetava_liet` (`Liet_ID`);

--
-- Indexes for table `zinas`
--
ALTER TABLE `zinas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `zinas_liet` (`Liet_ID`);

--
-- Indexes for table `zinu_vertejumi`
--
ALTER TABLE `zinu_vertejumi`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abonementi`
--
ALTER TABLE `abonementi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `atsauksmes`
--
ALTER TABLE `atsauksmes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `lietotaji`
--
ALTER TABLE `lietotaji`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `terzetavas_zinas`
--
ALTER TABLE `terzetavas_zinas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `zinas`
--
ALTER TABLE `zinas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `zinu_vertejumi`
--
ALTER TABLE `zinu_vertejumi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `abonementi`
--
ALTER TABLE `abonementi`
  ADD CONSTRAINT `abonementi_ibfk_1` FOREIGN KEY (`Liet_ID`) REFERENCES `lietotaji` (`ID`);

--
-- Constraints for table `atsauksmes`
--
ALTER TABLE `atsauksmes`
  ADD CONSTRAINT `atsauksme_liet` FOREIGN KEY (`Liet_ID`) REFERENCES `lietotaji` (`ID`),
  ADD CONSTRAINT `atsauksme_zinas` FOREIGN KEY (`Zinas_ID`) REFERENCES `zinas` (`ID`);

--
-- Constraints for table `terzetavas_zinas`
--
ALTER TABLE `terzetavas_zinas`
  ADD CONSTRAINT `terzetava_liet` FOREIGN KEY (`Liet_ID`) REFERENCES `lietotaji` (`ID`);

--
-- Constraints for table `zinas`
--
ALTER TABLE `zinas`
  ADD CONSTRAINT `zinas_liet` FOREIGN KEY (`Liet_ID`) REFERENCES `lietotaji` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
