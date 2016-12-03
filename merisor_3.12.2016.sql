-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2016 at 06:50 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merisor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `Nume` varchar(20) NOT NULL,
  `Prenume` varchar(30) NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `username`, `pass`, `Nume`, `Prenume`) VALUES
(1, 'admin', 'admin', '', ''),
(10, 'Priceputul', 'admin1pricep', 'Florin', 'Stroe'),
(11, 'Priceputa', 'admin2pricep', 'Ana', 'Palade'),
(12, 'Editorul', 'copywriter1', 'Ligia', 'Eftimie');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(100) NOT NULL DEFAULT '',
  `sortOrder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catId`, `catName`, `sortOrder`) VALUES
(1, 'Traditionale', 1),
(2, 'Indraznete', 2),
(3, 'Lejere', 3),
(4, 'Din alta poveste', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `phpsessid` varchar(60) NOT NULL,
  `orderValue` decimal(10,2) NOT NULL,
  `orderVat` decimal(10,2) NOT NULL,
  `orderSent` tinyint(1) NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
CREATE TABLE IF NOT EXISTS `order_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `catId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL DEFAULT '',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productDesc` text NOT NULL,
  `picSmall` varchar(255) DEFAULT NULL,
  `picLarge` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `catId`, `productName`, `price`, `productDesc`, `picSmall`, `picLarge`) VALUES
(1, 1, 'Dulceata de capsune', '5.00', 'Dulceata de capsune este una dintre preferatele copiilor, fiecare familie in care exista o bunica gospodina stie asta. Textura si savoarea acestui produs cu siguranta iti vor aduce aminte de copilarie.', '', 'dulceata-capsune.jpg'),
(2, 1, 'Dulceata de zmeura', '8.00', 'Fabricata din fructe gatite intregi, dulceata contine semintele de zmeura care ii dau un farmec aparte. Are un gust intepator si un parfum aparte. Se consuma deseori la micul dejun.', '', 'dulceata-zmeura.jpg'),
(3, 1, 'Dulceata de piersici', '5.00', 'Dulceata de piersici este lejera si parfumata, fiind usor de consumat de catre persoanele carora nu le plac produsele foarte dulci. Contine bucati mari de fruct.', '', 'dulceata-piersici.jpg'),
(4, 1, 'Dulceata de caise', '4.00', 'Dulceata de caise este una parfumata si legera, la prepararea ei intra fructe cu un aport caloric redus si cu un continut bogat in fibre. Se foloseste atat la prajituri cat si la retetele cu carne de rata. ', '', 'dulceata-caise.jpg'),
(5, 1, 'Dulceata de afine', '8.00', 'Dulceata de afine are un gust placut, usor parfumat, in acord cu fructul slab caloric. Se potriveste de minune in iaurt sau clatite, desi amatorii de nou o folosesc si pentru sandvisurile cu unt de arahide.', '', NULL),
(6, 1, 'Dulceata de cirese', '7.00', 'Parfumata si cu gust putin intepator, dulceata de cireste completeaza foarte bine un iaurt sau o branza alba slaba. Are o textura mai neomogena datorata bucatilor de fruct.', '', 'dulceata-cirese.jpg'),
(7, 1, 'Dulceata de nuci', '8.00', 'Pe langa savoarea aparte, dulceat de nuci verzi are si multiple beneficii pentru organism: creste imunitatea, este energizanta si ajuta la prevenirea aparitiei bolilor cardio-vasculare.', '', 'dulceata-nuci.jpg'),
(8, 1, 'Dulceata de prune', '7.00', 'Dulceata de prune este un produs de top pentru care nu folosim nicio sursa suplimentara de indulcire. Contine 100% fruct si are o textura placuta care o face usor de folosit in prepararea prajiturilor.', '', 'dulceata-prune.jpg'),
(9, 2, 'Dulceata de zmeura cu trandafiri', '12.00', 'O combinatie cu aroma de Orient, dulceata de zmeura si trandafiri transforma micul dejun intr-o incantare. Iti incepi ziua binedispus si cu doza de antioxidanti deja luata.', '', 'dulceata-trandafiri-zmeura.jpg'),
(10, 2, 'Dulceata de pere cu nuci si scortisoara', '10.00', 'Dulceata de pere imbogatita cu nuca si scortisoara are o aroma deosebita care aminteste de sarbatorile de iarna si de bunatatile specifice Craciunului.', '', 'dulceata-pere-nuci-scortisoara.jpg'),
(11, 2, 'Dulceata de castane cu vanilie', '9.00', 'Dulceata de castane este o alegere buna la micul dejun, cu biscuiti sau iaurt. Are un continut redus de zahar, dar parfumul de vanilie o face mai dulce.', '', 'dulceata-castane.jpg'),
(12, 3, 'Dulceata detox din fructe exotice ', '11.00', 'Dulceata din fructe exotice este prin natura ei un produs detox, care faciliteaza digestia si favorizeaza eliminarea deseurilor si a toxinelor. Este bogata in fibre si are proprietati antioxidante. ', '', 'dulceata-ananas-kiwi.jpg'),
(13, 3, 'Dulceata de nectarine', '7.00', 'Bucati mari de nectarine asezonate cu frunze de menta proaspata si indulcite cu putina fructoza: o dulceata delicata care merge la inghetata sau chiar la un sandvis cu piept de pui.', '', 'dulceat-nectarine.jpg'),
(14, 3, 'Dulceata de citrice', '6.00', 'Asociere delicioasa de trei citrice, mandarine, portocale si lamai, cu index glicemic scazut. Merge de minune cu tarte si clatite sau chiar peteuri de ficat. Este un produs care poate fi consumat si de catre diabetici.', '', 'dulceata-citrice.jpg'),
(15, 3, 'Dulceata de dovleac', '5.00', 'Pentru cei care cred ca placinta de dovleac ar fi mai buna fara foi, am inventat dulceata de dovleac. Ca sa fie si mai dietetica, am inlocuit zaharul cu fructoza.', '', 'dulceata-dovleac.jpg'),
(16, 4, 'Dulceata de lapte', '9.00', 'Dulceata de lapte artizanala face casa buna cu bananele, biscuitii cu unt si gaufrele. Produsul este fabricat la foc mic, are o textura fina si densa si poate fi consumat atat la micul dejun cat si la o gustare.', '', 'dulceata-lapte.jpg'),
(18, 4, 'Crema de caramel', '9.00', 'Fanii caramelului vor fi foarte incantati de aceasta dulceata care merge consumata in special cu inghetata de vanilie si clatite fierbinti. Amestecul de zahar caramelizat, smantana si unt este una dintre specialitatile franzuzesti dintre cele mai apreciate.', '', 'dulceata-caramel.jpg'),
(19, 4, 'Crema de cafea', '9.00', 'Redescopera cafeaua sub o alta forma: o crema tartinabila care aduce a tiramisu. Este o dulceata artizanala pe baza de cafea infuzata lent si fabricata in cantitati mici.', '', 'dulceata-cafea.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `pass`, `firstName`, `lastName`, `phone`, `email`, `dateAdded`) VALUES
(1, 'epopa', 'PopaXX22', 'Emanuel', 'Popa', '755437743', 'emanuel.popa@yahoo.com', '2016-08-11 00:00:00'),
(2, 'vivianac', 'vivi256ana', 'Viviana', 'Cazacu', '789456723', 'vivianac@gmail.com', '2016-11-14 00:00:00'),
(3, 'gstancu', 'stan444*', 'George', 'Stancu', '766545454', 'george.stancu@gmail.com', '2016-10-11 00:00:00'),
(4, 'lorenaminc', 'minculescuL8', 'Lorena', 'Minculescu', '767248258', 'lorenaminc@yahoo.com', '2016-09-14 00:00:00'),
(5, 'robarsenie', 'ArsenieRob#', 'Robert Marius', 'Arsenie', '766597329', 'arsenier@gmail.com', '2015-11-17 00:00:00'),
(6, 'Cata', 'Cata000prescu', 'Catalin', 'Oprescu', '756848484', 'batman72@yahoo.com', '2016-07-07 00:00:00'),
(7, 'imarcu', 'marcuIoana12', 'Ioana', 'Marcu', '743256789', 'marcuio@yahoo.com', '2016-03-20 00:00:00'),
(8, 'Sonica', 'cristescu257', 'Sonia', 'Cristescu', '744675787', 'soniacristescu@gmail.com', '2016-12-05 00:00:00'),
(9, 'Ele2016', 'NiculaeEle2016', 'Elena Iza', 'Niculae', '723355893', 'elena.niculae@gmail.com', '2016-05-25 00:00:00'),
(10, 'Serban17', 'vs754601', 'Serban', 'Vulpe', '755398456', 'vulpeavicleana@yahoo.com', '2016-02-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

DROP TABLE IF EXISTS `workshops`;
CREATE TABLE IF NOT EXISTS `workshops` (
  `workshopId` int(11) NOT NULL AUTO_INCREMENT,
  `workshopName` varchar(255) NOT NULL DEFAULT '',
  `workshopLocation` varchar(255) NOT NULL DEFAULT '',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `workshopDesc` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`workshopId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`workshopId`, `workshopName`, `workshopLocation`, `price`, `workshopDesc`, `date`) VALUES
(1, 'Dulciuri de iarna', 'Ceainaria "Ceai la Vlaicu"', '35.00', 'Ati mancat vreodata prajitura Figaro? Dar galuste cu prune? Invatati sa gatiti 5 tipuri de prajituri de iarna care folosesc dulceturi traditionale.', '2016-12-20 00:00:00'),
(2, 'Smoothie la putere', 'Taverna "La Calinescu"', '50.00', 'Ceva usor, de pirmavara? Hai sa pregatim impreuna cateva smoothies satioase si delicioase: cu iaurt, dulceata de capsune, fulgi de ovaz si alte combinatii...lejere.', '2017-03-25 00:00:00'),
(3, 'Festivalul cireselor', 'Terasa "Fabrica"', '30.00', 'Au inflorit ciresii! Sa ne adunam sa vorbim despre beneficiile cireselor si ale visinelor, despre ce bunatati putem gati cu ele.', '2017-05-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_attend`
--

DROP TABLE IF EXISTS `workshop_attend`;
CREATE TABLE IF NOT EXISTS `workshop_attend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `workshopId` int(11) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
