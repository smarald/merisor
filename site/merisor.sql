-- Database: `merisor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `adminId` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY  (`adminId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `username`, `pass`) VALUES (1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `catId` int(11) NOT NULL auto_increment,
  `catName` varchar(100) NOT NULL default '',
  `sortOrder` int(11) NOT NULL default '0',
  PRIMARY KEY  (`catId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catId`, `catName`, `sortOrder`) VALUES
(1, 'Tradiționale', 1),
(2, 'Îndrăznețe', 2),
(3, 'Lejere', 3),
(4, 'Din altă poveste', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `phpsessid` varchar(60) NOT NULL,
  `orderValue` decimal(10,2) NOT NULL,
  `orderVat` decimal(10,2) NOT NULL,
  `orderSent` tinyint(1) NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY  (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
CREATE TABLE `order_products` (
  `id` int(11) NOT NULL auto_increment,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` DECIMAL (10,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `order_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `productId` int(11) NOT NULL auto_increment,
  `catId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL default '',
  `price` decimal(10,2) NOT NULL default '0.00',
  `productDesc` text NOT NULL,
  `picSmall` varchar(255) default NULL,
  `picLarge` varchar(255) default NULL,
  PRIMARY KEY  (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

DROP TABLE IF EXISTS `workshops`;
CREATE TABLE `workshops` (
  `workshopId` int(11) NOT NULL auto_increment,
  `workshopName` varchar(255) NOT NULL default '',
  `workshopLocation` varchar(255) NOT NULL default '',
  `price` decimal(10,2) NOT NULL default '0.00',
  `workshopDesc` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`workshopId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `workshops`
--

-- --------------------------------------------------------

--
-- Table structure for table `workshop_attend`
--

DROP TABLE IF EXISTS `workshop_attend`;
CREATE TABLE `workshop_attend` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL,
  `workshopId` int(11) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `workshop_attend`
--