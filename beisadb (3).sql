-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2026 at 09:21 PM
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
(14, 19, 51, 'Manuprāt, tas ir ļoti svarīgi, jo drošība ir viena no galvenajām lietām, un ir labi, ka valsts turpi', '2026-02-23 22:05:23'),
(15, 19, 55, 'an šķiet, ka tas ir labs solis, jo ieguldījumi inovācijās un enerģētikas drošībā var palīdzēt stipri', '2026-02-23 22:05:42'),
(16, 19, 54, 'Manuprāt, ir ļoti svarīgi, ka Apvienoto Nāciju Organizācija veicina diskusijas un sadarbību, jo tika', '2026-02-23 22:06:03'),
(17, 19, 53, 'Manuprāt, šādas diskusijas Saeima ir svarīgas, jo pārdomātas nodokļu izmaiņas var palīdzēt attīstīt ', '2026-02-23 22:06:20'),
(18, 19, 56, 'Manuprāt, šis ir ļoti sarežģīts jautājums, un ir svarīgi, lai Amerikas Savienotās Valstis rastu līdz', '2026-02-23 22:06:38'),
(19, 19, 52, 'Man šķiet, ka tas ir labi, jo vēlēšanas dod iespēju iedzīvotājiem izvēlēties pārmaiņas un veicināt s', '2026-02-23 22:06:54'),
(20, 19, 50, 'Manuprāt, ir labi, ka Latvijas Republikas Ministru kabinets cenšas palīdzēt cilvēkiem un uzņēmējiem,', '2026-02-23 22:07:09'),
(21, 19, 57, 'Manuprāt, tas ir pozitīvs solis, jo Japāna ieguldījumi atjaunojamajā enerģijā var palīdzēt gan videi', '2026-02-23 22:07:25'),
(22, 19, 49, 'Manuprāt, ir svarīgi, ka Saeima rūpīgi izvērtē budžetu, jo no šiem lēmumiem būs atkarīga gan sabiedr', '2026-02-23 22:07:42'),
(23, 19, 48, 'Izskatās, ka sezona sola daudz spriedzes un emociju, un būs interesanti redzēt, kuras komandas spēs ', '2026-02-23 22:07:55'),
(24, 19, 47, 'Man šķiet, ka tas ir lieliski, jo pasākums iedrošina cilvēkus būt aktīviem un vienlaikus rada pozitī', '2026-02-23 22:08:08'),
(25, 19, 46, 'Izskatās, ka turnīrs bija ļoti aizraujošs, un pusfinālisti noteikti būs pelnījuši vietu finālā, jo s', '2026-02-23 22:08:23'),
(26, 19, 58, 'Izskatās, ka situācija ir sarežģīta, jo Apvienotā Karaliste iedzīvotājiem tas rada neērtības, bet da', '2026-02-23 22:08:43'),
(27, 19, 45, 'Manuprāt, tas ir iedvesmojoši, jo Latvija sportisti strādā smagi, lai sasniegtu labākos rezultātus g', '2026-02-23 22:08:59'),
(28, 19, 44, 'Izskatās, ka šodien gaidāmas ļoti spraigas spēles, un līdzjutējiem būs iespēja izbaudīt lielisku spo', '2026-02-23 22:09:15'),
(29, 19, 43, 'Izskatās, ka laiks būs mainīgs, tāpēc ir vērts sekot prognozēm un izvēlēties piemērotu apģērbu, kā a', '2026-02-23 22:09:37'),
(30, 19, 42, 'Izskatās, ka ziemas apstākļi prasa īpašu uzmanību, tāpēc ir labi, ka tiek aicināts rūpēties par droš', '2026-02-23 22:09:53'),
(31, 19, 41, 'Izskatās, ka Liepājā gaidāms stiprs vējš, tāpēc ir labi, ka iedzīvotāji tiek brīdināti un aicināti b', '2026-02-23 22:10:10'),
(32, 19, 40, 'Šķiet, ka Rīgā gaidāms spēcīgs sniegs, tāpēc ir labi, ka iedzīvotāji tiek brīdināti un aicināti būt ', '2026-02-23 22:10:27'),
(33, 19, 39, 'Izskatās, ka “Liepāja Wave-1” ir iespaidīgs tehnoloģisks projekts, kas izmanto atjaunojamo enerģiju ', '2026-02-23 22:10:43'),
(34, 19, 38, 'Izskatās, ka “AI Kafe” ir interesants un inovatīvs projekts, kas apvieno tehnoloģijas un kultūru, ļa', '2026-02-23 22:10:58'),
(35, 19, 37, 'Izskatās, ka jaunais gājēju un velosipēdu tilts būs gan praktisks, gan vizuāli pievilcīgs risinājums', '2026-02-23 22:11:15'),
(36, 19, 36, 'Izskatās, ka jaunā velonovietne būs liels solis Rīgas attīstībā kā draudzīgai velosipēdistiem pilsēt', '2026-02-23 22:11:34'),
(37, 19, 32, 'Izskatās, ka “Rīgas gaisa koridors” būs inovatīvs transporta risinājums, kas var paātrināt pārvietoš', '2026-02-23 22:11:50'),
(38, 2, 58, 'Interesanti...', '2026-02-23 22:13:23'),
(39, 20, 54, 'Sekošu līdzi!', '2026-02-23 22:14:17'),
(40, 21, 48, 'Sekošu līdzi!', '2026-02-23 22:17:33');

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
(3, 'Darbinieks', 'abols@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Darbinieks'),
(6, 'Admin', 'hi@hi.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Administrators'),
(7, '..............', 'cop.privatemail@gmail.com', '$2y$10$eloWLMA0XHs8.EK/mr47VudmYBijaF5lWka2fAHKDq46YRUdg5IP6', 'Lietotājs'),
(8, 'Liet', 'Liet@gmail.com', '$2y$10$p5DKsFSR4oylGJi6mkEmMekZTAYUiIjK3PiPTOAo3Ss', 'Lietotājs'),
(9, 'Janis', 'Janis@gmail.com', '$2y$10$M1Isg2AhsMKh7t0T7vznsu47wZlNODmrmzOAe8JWEOt', 'Lietotājs'),
(12, 'Petrs', 'Petrs@gmail.com', '$2y$10$rK5xrN9o.uFn8y/4w0Z2i.6aJG66/etnUaoQDTLArfH', 'Lietotājs'),
(13, 'spoks', 'spoks@gmail.com', '$2y$10$xnqHlzUqSMl64myBmevQHeDOzGTML43/qELD/gr30dw', 'Lietotājs'),
(14, 'citsliet', 'nezinams@gmail.com', '$2y$10$s5d34MJnHEjVOR9tbp87ZOLOjfdXhpZrM4HStuQszUQ', 'Lietotājs'),
(15, 'Anna', 'anna@gmail.com', '$2y$10$rK5xrN9o.uFn8y/4w0Z2i.6aJG66/etnUaoQDTLArfH', 'Lietotājs'),
(16, 'Gregor', 'greg@gmail.com', '$2y$10$CypUhY2/G9S3Q/0O5/MFNO7UyooOzZN6mOcX.BtvZ2lwPupjralTq', 'Lietotājs'),
(17, 'nulliite', 'nulle@gmail.com', '$2y$10$eloWLMA0XHs8.EK/mr47VudmYBijaF5lWka2fAHKDq46YRUdg5IP6', 'Lietotājs'),
(18, 'Ozoliņš', 'ozolins@gmail.com', '$2y$10$QZyPUmVdPKWG9o.ut5vW0eMGZTdf61nudbIygZQWb3hPI1mGpC2ya', 'Lietotājs'),
(19, 'martinja_am', 'eeeeeee@gmail.com', '$2y$10$oULYEQFeTTsjth2iQ7hvaeKVa.Dnk7qUxp7YIrWeVrcDIhaJ26tRi', 'Lietotājs'),
(20, 'Pēterītis', 'peteritis@gmail.com', '$2y$10$TrqfFDaS3xFSAxLhZX4n.uKsIH3us0Zl7X7z9RBpy8kuqnRL9k4gO', 'Lietotājs'),
(21, 'Jānīitis', 'janitis@gmail.com', '$2y$10$LYakFcvlrRm9XVx/tCiRCOsyKw.q8mg2FFUIhkCid3BMLyVNdMlk2', 'Lietotājs');

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
(2, 2, 'jaunakais', 'Čau!', '2026-02-21 22:43:10');

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
  `Izveidots` datetime NOT NULL DEFAULT current_timestamp(),
  `Atjauninats` datetime DEFAULT NULL,
  `Bilde` varchar(255) NOT NULL,
  `Svarigums` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zinas`
--

INSERT INTO `zinas` (`ID`, `Liet_ID`, `Kategorija`, `Nosaukums`, `Teksts`, `Izveidots`, `Atjauninats`, `Bilde`, `Svarigums`) VALUES
(23, 3, 'Laika ziņas', 'Šodien Rīgā būs -20 grādi', 'Šodien Rīgā gaidāms īpaši auksts laiks – gaisa temperatūra dienas laikā var pazemināties līdz pat -20 grādiem. Sinoptiķi brīdina, ka šādos apstākļos pastiprināti jāievēro piesardzība, īpaši uzturoties ārā ilgāku laiku. Iedzīvotājiem ieteicams ģērbties silti, izvēlēties vairākas apģērba kārtas un rūpēties par atbilstošu galvassegu un cimdiem.\n\nAukstuma ietekmē var veidoties apledojums uz ceļiem un ietvēm, tāpēc gan gājējiem, gan autovadītājiem jābūt īpaši uzmanīgiem. Dienas gaitā iespējams arī skaidrs laiks ar nelielu vēju, kas pastiprinās aukstuma sajūtu.', '2026-02-23 14:38:41', NULL, 'https://static.scientificamerican.com/sciam/cache/file/EECA342A-FFBE-4B06-B2AD105DAB129CE9_source.jpg?w=1200', 1),
(32, 6, 'Latvijā', 'Rīgas dome apstiprina Gaisa taksometru “citu” līniju pār Daugavu', 'Rīga, 23. februāris, 2026 — Pēc divus gadus ilgušām debatēm Rīgas dome ar 39 balsīm “par” atbalstīja pilotprojektu “Rīgas gaisa koridors”. No 2027. gada vasaras starp Ķīpsalu un Teiku kursēs elektriskie pasažieru droni ar 4–6 sēdvietām. Brauciena ilgums — 4 minūtes, cena sākotnēji plānota 9–14 € atkarībā no diennakts laika. Kritiski noskaņotie deputāti norāda, ka trokšņa un drošības jautājumi nav pilnībā atrisināti.', '2026-02-23 16:33:43', NULL, 'https://assets.grok.com/users/baa1d5c8-b237-4428-b40d-406bc019a5f1/generated/7f2d19f7-146b-449f-8f4d-6521a238ecd0/image.jpg', 1),
(36, 6, 'Latvijā', '2036 “Rail Baltica” stacija “Rīga Centrālā” atklās velosipēdu autostāvvietu 3200 velosipēdiem', 'Eiropas lielākā velonovietne zem viena jumta tiks atklāta jau jūnijā. Tā būs daļa no jaunās “Rail Baltica” stacijas kompleksa. Kopumā paredzēts, ka dienā to varēs izmantot līdz 8000 riteņbraucēju. “Mēs gribam, lai Rīga kļūst par Ziemeļeiropas velosipēdu galvaspilsētu,” paziņoja satiksmes ministrs.', '2026-02-23 16:41:46', NULL, 'https://assets.grok.com/users/baa1d5c8-b237-4428-b40d-406bc019a5f1/generated/7ad481b2-0c42-485e-8ece-9cce18f6395f/image.jpg', 0),
(37, 6, 'Latvijā', 'Rīgas dome apstiprina “Gaisa tilta” projektu – velosipēdu un gājēju tilts pāri Daugavai pie Vanšu ti', 'Rīgas pašvaldība pieņēmusi lēmumu būvēt jaunu 450 metru garu gājēju un velosipēdu tiltu paralēli Vanšu tiltam. Projekta izmaksas – 48 miljoni eiro, no kuriem 60 % segs Eiropas Savienības Atveseļošanas fonds. Paredzēts, ka tilts būs atvērts 2028. gada vasarā. Arhitekti sola, ka konstrukcija būs “gaisīga un zaļa” – ar integrētiem saules paneļiem un vertikālajiem dārziem.', '2026-02-23 16:44:55', NULL, 'https://assets.grok.com/users/baa1d5c8-b237-4428-b40d-406bc019a5f1/generated/61117ece-e303-4c1b-9399-30871bd7f26e/image.jpg', 0),
(38, 6, 'Latvijā', 'Daugavpilī atklāts pirmais Latgalē “Mākslīgā intelekta kafejnīca”', 'Jaunatklātajā “AI Kafe” Daugavpils Marka Rotko mākslas centrā apmeklētāji var pasūtīt kafiju, runājot latgaliski, latviski, krieviski vai lietuviski – mākslīgais intelekts atpazīst akcentu un automātiski aprēķina rēķinu. Īpašs jaunums – “Latgales dziesmu” režīms, kurā AI ģenerē īsu latgaliešu tautasdziesmu katram pasūtījumam.', '2026-02-23 16:47:09', NULL, 'https://assets.grok.com/users/baa1d5c8-b237-4428-b40d-406bc019a5f1/generated/df5ce650-3258-45f1-b47a-0dda7a6b3a2e/image.jpg', 0),
(39, 6, 'Latvijā', 'Liepājā uzbūvēts pirmais peldošais “zaļais” datu centrs Eiropā', 'Liepāja, 20. februāris, 2026 — Ostas malā pie Karostas kanāla oficiāli atklāts pasaulē pirmais pilnībā uz ūdens peldošais datu centrs ar 100% atjaunojamo enerģiju no viļņiem un vēja. Komplekss “Liepāja Wave-1” spēj apkalpot mākslīgā intelekta apmācību līdz pat 40 000 GPU. Investori — liela Āzijas tehnoloģiju kompānija un Latvijas valsts fonds “Zilā nākotne”. Vietējie iedzīvotāji gan bažījas par to, kas notiks vētras laikā.', '2026-02-23 16:58:30', NULL, 'https://assets.grok.com/users/baa1d5c8-b237-4428-b40d-406bc019a5f1/generated/d79c1568-cc28-4bc4-bf42-6f92b7ca861e/image.jpg', 1),
(40, 6, 'Laika ziņas', 'Šodien Rīgā gaidāms stiprs sniegs', 'Šodien Rīgā prognozēta intensīva snigšana, kas var apgrūtināt satiksmi un pārvietošanos pilsētā. Redzamība vietām var pasliktināties, tāpēc autovadītājiem ieteicams ievērot drošu distanci un izvēlēties piemērotu braukšanas ātrumu. Gājējiem jābūt uzmanīgiem uz ietvēm, jo iespējams slidens segums.', '2026-02-23 17:50:29', NULL, 'https://ziemellatvija.lv/wp-content/uploads/2025/07/antitrust-blizzard-1000x750-1-10.jpg', 1),
(41, 6, 'Laika ziņas', 'Liepājā rītdien gaidāms stiprs vējš', 'Sinoptiķi brīdina, ka Liepājā rītdien pūtīs spēcīgs vējš, kas var radīt diskomfortu un apgrūtināt pārvietošanos. Vēja brāzmas var būt īpaši jūtamas atklātās vietās. Iedzīvotājiem ieteicams nodrošināties pret vēja ietekmi un izvairīties no nestabilu objektu tuvuma.', '2026-02-23 17:51:48', NULL, 'https://www.radio1.lv/userfiles/news/2020/03/121577cce51297cddcd439b3444c480584.jpg', 1),
(42, 6, 'Laika ziņas', 'Latvijā turpinās ziemai raksturīgi apstākļi', 'Latvijā turpinās ziemas sezona ar zemām gaisa temperatūrām un iespējamu snigšanu atsevišķās vietās. Iedzīvotāji tiek aicināti parūpēties par savu drošību un veselību, kā arī laikus sagatavot transportlīdzekļus ziemas apstākļiem. Komunālie dienesti strādā pie ceļu un ietvju uzturēšanas, lai nodrošinātu drošu pārvietošanos gan pilsētās, gan lauku teritorijās.', '2026-02-23 17:53:24', NULL, 'https://pic.la.lv/2021/12/sniegs_Riga_LETA.jpg', 1),
(43, 6, 'Laika ziņas', 'Šodien Latvijā gaidāmi mainīgi laikapstākļi', 'Šodien Latvijā prognozēti mainīgi laikapstākļi – vietām uzspīdēs saule, taču brīžiem debesis aizklās mākoņi. Atsevišķos reģionos iespējami nelieli nokrišņi. Gaisa temperatūra dienas laikā būs atšķirīga dažādos valsts novados, tāpēc iedzīvotājiem ieteicams sekot līdzi aktuālajām prognozēm un izvēlēties laikapstākļiem piemērotu apģērbu. Ceļu satiksmē aicinām būt uzmanīgiem, īpaši rīta un vakara stundās.', '2026-02-23 17:54:28', NULL, 'https://static.lsm.lv/media/2020/04/large/1/cxqq.jpg', 1),
(44, 6, 'Sports', 'Šodien sporta arēnās gaidāmas aizraujošas spēles', 'Šodien vairākās sporta arēnās norisināsies svarīgas spēles, kurās komandas cīnīsies par uzvaru un turnīra punktiem. Sagaidāma sīva konkurence un līdzjutēju atbalsts tribīnēs. Sporta līdzjutēji aicināti sekot līdzi rezultātiem un spēļu gaitai tiešraidēs vai aktuālajos pārskatos.', '2026-02-23 18:48:10', NULL, 'https://www.lhf.lv/uploads/public/arenas/px856/arena-riga.jpg', 1),
(45, 6, 'Sports', 'Latvijas sportisti gatavojas jaunām sacensībām', 'Latvijas sportisti turpina gatavošanos gaidāmajām sacensībām gan vietējā, gan starptautiskā līmenī. Treniņos tiek pilnveidota fiziskā sagatavotība un komandas saspēle. Sporta treneri uzsver disciplīnas un komandas darba nozīmi, lai sasniegtu augstus rezultātus.', '2026-02-23 19:30:42', NULL, 'https://lvportals.lv/wwwraksti//TEMAS/2024/NOVEMBRIS/BILDES/76AN2KVB3.JPEG', 1),
(46, 6, 'Sports', 'Turnīrā noskaidroti pusfinālisti', 'Aizvadītajās spēlēs turnīrā noskaidroti pusfinālisti, kuri turpinās cīņu par galveno balvu. Spēles bija spraigas un emocijām bagātas. Komandas demonstrēja augstu meistarību, un skatītāji varēja baudīt dinamisku un aizraujošu sporta notikumu.', '2026-02-23 21:42:18', NULL, 'https://www.myknowledgebroker.com/hs-fs/hubfs/iStock-1169144593.jpg?width=3835&name=iStock-1169144593.jpg', 1),
(47, 6, 'Sports', 'Sporta pasākumā piedalās rekordliels dalībnieku skaits', 'Šī gada sporta pasākumā piedalās rekordliels dalībnieku skaits. Organizatori norāda, ka interese par aktīvu dzīvesveidu turpina pieaugt. Pasākums vieno dažāda vecuma sportistus un veicina veselīgu konkurenci un kopības sajūtu.', '2026-02-23 21:55:10', NULL, 'https://www.infoski.lv/files/priekuli_loppet_297bc.jpg', 1),
(48, 6, 'Sports', 'Sezonas noslēgumā gaidāmi izšķiroši mači', 'Sporta sezonas noslēgumā gaidāmi izšķiroši mači, kas noteiks kopvērtējuma uzvarētājus. Komandas gatavojas pēdējiem izaicinājumiem, un katrs punkts būs svarīgs. Līdzjutēji tiek aicināti atbalstīt savus favorītus un sekot līdzi notikumu attīstībai.', '2026-02-23 21:55:57', NULL, 'https://sportsandgames.co.tt/wp-content/uploads/2022/05/blog_football.jpg', 1),
(49, 6, 'Politika', 'Saeimā notiek debates par nākamā gada budžetu', 'Saeima šodien turpinās debates par nākamā gada valsts budžeta projektu. Deputāti diskutē par finansējuma sadalījumu veselības aprūpei, izglītībai un aizsardzībai. Opozīcija aicina pārskatīt prioritātes, savukārt koalīcijas pārstāvji uzsver fiskālās disciplīnas nozīmi.', '2026-02-23 21:58:27', NULL, 'https://img.freepik.com/premium-vector/political-debates-discussions-with-candidates-public-speaking-front-audience_651182-1065.jpg', 1),
(50, 6, 'Politika', 'Valdība vienojas par jauniem atbalsta pasākumiem iedzīvotājiem', 'Latvijas Republikas Ministru kabinets apstiprinājis virkni jaunu atbalsta pasākumu, lai mazinātu dzīves dārdzības ietekmi uz mājsaimniecībām. Plānots paplašināt sociālās palīdzības programmas un sniegt papildu atbalstu uzņēmējiem. Lēmumi stāsies spēkā pēc nepieciešamo normatīvo aktu pieņemšanas.', '2026-02-23 21:59:32', NULL, 'https://urbantreetops.com/wp-content/uploads/2017/05/beautiful-skyline-of-purviems-riga.jpg', 1),
(51, 6, 'Politika', 'Prezidents uzsver drošības jautājumu nozīmi', 'Prezidents uzsvēris, ka valsts drošība un aizsardzības stiprināšana joprojām ir viena no galvenajām prioritātēm. Viņš aicinājis stiprināt sadarbību ar starptautiskajiem partneriem un turpināt ieguldījumus aizsardzības sektorā.', '2026-02-23 22:00:51', NULL, 'https://www.sargs.lv/sites/default/files/styles/article_large/public/2020-07/Nr6%20Opoli.jpg?h=6f3285a6&itok=nukUBCDG', 1),
(52, 6, 'Politika', 'Partijas sāk gatavošanos pašvaldību vēlēšanām', 'Vairākas politiskās partijas Latvijā sākušas aktīvu gatavošanos gaidāmajām pašvaldību vēlēšanām. Tiek veidoti kandidātu saraksti un izstrādātas priekšvēlēšanu programmas, īpašu uzmanību pievēršot reģionu attīstībai un infrastruktūras uzlabošanai.', '2026-02-23 22:02:46', NULL, 'https://lvportals.lv/wwwraksti//TEMAS/2017/JUNIJS/BILDES_LIELAS/VOTE.JPG', 1),
(53, 6, 'Politika', 'Saeimas komisijā apspriež izmaiņas nodokļu politikā', 'Saeimas Budžeta un finanšu (nodokļu) komisija notiek diskusijas par iespējamiem grozījumiem nodokļu politikā. Tiek vērtēti priekšlikumi par iedzīvotāju ienākuma nodokļa un uzņēmumu nodokļu izmaiņām, lai veicinātu ekonomikas izaugsmi un investīciju piesaisti.', '2026-02-23 22:03:21', NULL, 'https://pic.la.lv/2018/03/nodokli_Sh.jpg', 1),
(54, 6, '', 'ANO Ģenerālajā asamblejā apspriež globālās drošības jautājumus', 'Apvienoto Nāciju Organizācija Ģenerālajā asamblejā šonedēļ notiek plašas diskusijas par globālās drošības un klimata pārmaiņu izaicinājumiem. Dalībvalstu pārstāvji uzsver nepieciešamību stiprināt starptautisko sadarbību un meklēt kopīgus risinājumus aktuālajām krīzēm.', '2026-02-23 22:04:01', NULL, 'https://cilvektiesibas.org.lv/media/cache/dd/55/dd55d9097ee969119bf8965a578c7c40.jpg', 1),
(55, 6, '', 'Eiropas Savienība vienojas par jaunu ekonomikas atbalsta plānu', 'Eiropas Savienība dalībvalstis panākušas vienošanos par jaunu ekonomikas atbalsta mehānismu, kura mērķis ir veicināt izaugsmi un inovācijas. Plānā paredzēti ieguldījumi digitālajā attīstībā un enerģētikas drošībā.', '2026-02-23 22:04:37', NULL, 'https://lvportals.lv/wwwraksti//PR/2025/MAIJS/BILDES/76EYK8KNS.JPEG', 1),
(56, 6, '', 'ASV notiek asas debates par imigrācijas reformu', 'Amerikas Savienotās Valstis likumdevēji turpina diskusijas par imigrācijas politikas reformu. Priekšlikumi paredz stingrākus robežkontroles pasākumus, kā arī izmaiņas uzturēšanās atļauju piešķiršanas kārtībā. Sabiedrībā jautājums izraisījis plašas diskusijas.', '2026-02-23 22:06:07', NULL, 'https://radio1.lv/userfiles/news/2019/09/300919187c4745eb7445f3b4942f040443.jpg', 1),
(57, 6, '', 'Japānā pieaug interese par atjaunojamo enerģiju', 'Japāna valdība paziņojusi par plāniem paplašināt atjaunojamās enerģijas projektus, lai mazinātu atkarību no fosilajiem kurināmajiem. Tiek apsvērta saules un vēja parku attīstība, kā arī investīcijas modernās tehnoloģijās.', '2026-02-23 22:07:03', NULL, 'https://eastasiaforum.org/wp-content/uploads/2020/03/2016-07-22T120000Z_1504718535_S1AETRADWUAA_RTRMADP_3_JAPAN-ENERGY-scaled.jpg', 1),
(58, 6, '', 'Lielbritānijā streiko sabiedriskā transporta darbinieki', 'Apvienotā Karaliste vairākās pilsētās sabiedriskā transporta darbinieki uzsākuši streiku, pieprasot algu paaugstināšanu un labākus darba apstākļus. Streiks radījis būtiskus satiksmes traucējumus un ietekmējis tūkstošiem iedzīvotāju ikdienu.', '2026-02-23 22:08:02', NULL, 'https://upload.wikimedia.org/wikipedia/commons/8/84/LTZ1328-19-20241030-160332.jpg', 1),
(59, 6, 'Lietotāju ziņas', 'Apkārtnē atvērta jauna kafejnīca', 'Mūsu rajonā šonedēļ durvis vērusi neliela, mājīga kafejnīca, ko izveidojusi vietējā ģimene. Iedzīvotāji jau dalās ar atsauksmēm sociālajos tīklos, slavējot svaigi ceptās bulciņas un draudzīgo apkalpošanu. Jaunā vieta ātri kļuvusi par satikšanās punktu kaimiņiem.', '2026-02-23 22:09:20', NULL, 'https://www.jrt.lv/media/__sized__/pages/kafejnica-1736770291-thumbnail-616x1232-70.jpeg', 1),
(60, 6, 'Lietotāju ziņas', 'Parkā sakopta bērnu rotaļu zona', 'Brīvprātīgie nedēļas nogalē sakopa tuvējā parka bērnu laukumu – tika savākti atkritumi, salabotas šūpoles un nokrāsoti soliņi. Vietējie iedzīvotāji priecājas par kopīgo darbu un aicina arī citus iesaistīties apkārtnes uzlabošanā.', '2026-02-23 22:10:07', NULL, 'https://www.riga.lv/sites/riga/files/styles/image_cut_from_bottom/public/gallery_images/uzvaras-parks_4.jpg?itok=4Xg9Qsn7', 1),
(61, 6, 'Lietotāju ziņas', 'Dalos pieredzē par pārgājienu gar jūru', 'Sestdien devos pārgājienā gar jūras krastu un vēlos ieteikt šo maršrutu arī citiem. Laiks bija saulains, bet vēss, un skati – iespaidīgi. Ja plānojat doties dabā, noteikti parūpējieties par ērtu apģērbu un siltu tēju termosā.', '2026-02-23 22:10:47', NULL, 'https://upload.wikimedia.org/wikipedia/lv/3/3a/2004_0828_014009AA.jpg', 1),
(62, 6, 'Lietotāju ziņas', 'Meklējam pazudušu kaķi', 'Vakar vakarā mūsu pagalmā pazuda pelēks kaķis ar baltām ķepiņām. Ja kāds viņu redzējis vai zina, kur viņš varētu atrasties, lūdzu, dodiet ziņu. Būsim pateicīgi par jebkādu informāciju.', '2026-02-23 22:11:49', NULL, 'https://lh4.googleusercontent.com/proxy/8yjsOnpBLMrde9Pjon8W6Ndp-Msh1UFyl4r5goMELsoaskH272f7pufuom-J3MdEB6q4Qp5n-_M3iRAFkjfGoT84bmwwAlATl4NuXlHXcn8SoKrakxc', 0),
(63, 6, 'Lietotāju ziņas', 'Ieteikums drošībai uz ceļa tumšajā laikā', 'Pēdējā laikā vakaros kļūst tumšs agrāk, tāpēc atgādinu visiem gājējiem lietot atstarotājus. Pats nesen piedzīvoju situāciju, kad autovadītājs mani gandrīz nepamanīja. Rūpēsimies par savu un citu drošību!', '2026-02-23 22:12:16', NULL, 'https://i.jauns.lv/t/2017/08/29/1211564/490x350.jpg?v=1503989639', 0);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atsauksmes`
--
ALTER TABLE `atsauksmes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `lietotaji`
--
ALTER TABLE `lietotaji`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `terzetavas_zinas`
--
ALTER TABLE `terzetavas_zinas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `zinas`
--
ALTER TABLE `zinas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

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
