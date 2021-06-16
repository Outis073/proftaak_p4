-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 jun 2021 om 16:02
-- Serverversie: 10.4.18-MariaDB
-- PHP-versie: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vitaebikes`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPAddBikeToBasket` (IN `pUserID` INT(11), IN `pModelID` INT(11))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN
INSERT INTO bikes (model_id) VALUES (pModelID);
SET @id = LAST_INSERT_ID();
INSERT INTO basket (user_id, bike_id) VALUES (pUserID, (SELECT @id));
SELECT @id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPAddModel` (IN `pName` VARCHAR(255), IN `pDescription` VARCHAR(255), IN `pPrice` DECIMAL)  MODIFIES SQL DATA
    SQL SECURITY INVOKER
INSERT INTO models (name, description, price, active) VALUES (pName, pDescription, pPrice, 1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPAddOptionsToBike` (IN `pBikeID` INT(11), IN `pOptionID` INT(11))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
INSERT INTO bikes_options (bike_id, option_id) VALUES (pBikeID, pOptionID)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPAddReview` (IN `pUserID` INT(11), IN `pModelID` INT(11), IN `pRating` INT(1), IN `pText` VARCHAR(255))  BEGIN
    INSERT INTO reviews (user_id, model_id, rating, text, date)
    VALUES (pUserID, pModelID, pRating, pText, NOW());
    SELECT * FROM reviews WHERE ID = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPChangeModelPrice` (IN `InID` INT(11), IN `InPrice` DECIMAL(9,2))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN 
CREATE TEMPORARY TABLE temp_table AS (SELECT * FROM models WHERE id = InID);
UPDATE models SET active = 0 WHERE id = InID;
ALTER TABLE temp_table DROP id;
UPDATE temp_table SET price = InPrice;
INSERT INTO models (name, description, price, image, active) SELECT * FROM temp_table;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPChangeOptionPrice` (IN `InID` INT(11), IN `InPrice` DECIMAL(9,2))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN 
CREATE TEMPORARY TABLE temp_table AS (SELECT * FROM options WHERE id = InID);
UPDATE options SET active = 0 WHERE id = InID;
ALTER TABLE temp_table DROP id;
UPDATE temp_table SET price = InPrice;
INSERT INTO options (name, price, category, image, active) SELECT * FROM temp_table;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPCreateOrder` (IN `pID` INT(11), IN `pDeliveryMethod` VARCHAR(255), IN `pPaymentOption` VARCHAR(255))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN
INSERT INTO orders (user_id, date, delivery_method, payment_option) VALUES (pID, NOW(), pDeliveryMethod, pPaymentOption);
UPDATE BIKES SET order_id = (SELECT LAST_INSERT_ID()) WHERE id IN (SELECT bike_id FROM basket WHERE user_id = pID);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPDeactivateUser` (IN `pID` INT(11))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
UPDATE USER SET active = 0 WHERE id = pID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPEmptyBasket` (IN `pID` INT(11))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
DELETE FROM Basket WHERE user_id = pID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPFindOrderByID` (IN `pOrderID` INT(11))  BEGIN
	SELECT *
    FROM orders
    WHERE id = pOrderID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPGetBikeOptions` (IN `pID` INT(11))  READS SQL DATA
    SQL SECURITY INVOKER
SELECT id, name, price, category, image FROM options WHERE id in (SELECT option_id FROM bikes_options WHERE bike_id = pID)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPGetBikesFromBasket` (IN `pID` INT(11))  READS SQL DATA
    SQL SECURITY INVOKER
SELECT id, model_id FROM bikes WHERE id in (SELECT bike_id FROM basket WHERE user_id = pID)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPGetFailedSearches` ()  READS SQL DATA
    SQL SECURITY INVOKER
SELECT * FROM searches$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPGetIDFromEmail` (IN `INEmail` VARCHAR(255))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN 
SELECT id FROM users WHERE email = INEmail;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPGetModels` ()  READS SQL DATA
    SQL SECURITY INVOKER
SELECT id, name, description, price, image FROM models where active = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPGetOptions` ()  READS SQL DATA
    SQL SECURITY INVOKER
SELECT id, name, price, category, image FROM options WHERE active = 1 order by category$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPGetOrderHistoryUser` (IN `pUserId` INT)  BEGIN
    SELECT id, date, delivery_date, payment_option, status
    FROM orders
    WHERE user_id = pUserId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPGetSalesModels` (IN `pStartDate` DATETIME, IN `pEndDate` DATETIME)  READS SQL DATA
    SQL SECURITY INVOKER
SELECT bikes.model_id, models.name, models.price, COUNT(bikes.id) AS sales FROM bikes INNER JOIN models ON bikes.model_id = models.id WHERE order_id IN (SELECT id FROM orders WHERE orders.date BETWEEN pStartDate AND pEndDate) GROUP BY model_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPGetSalesOptions` (IN `pStartDate` DATETIME, IN `pEndDate` DATETIME)  BEGIN
	SELECT options.id, options.name, count(options.id) As options_sales
	FROM options
		INNER JOIN bikes_options ON bikes_options.option_id = options.id
		INNER JOIN bikes ON bikes.id = bikes_options.bike_id
		INNER JOIN orders ON orders.id = bikes.order_id
	WHERE orders.date BETWEEN pStartDate AND pEndDate
	GROUP BY options.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPInsertUser` (IN `InEmail` VARCHAR(255), IN `InPasswordSalt` VARCHAR(255), IN `InPasswordHash` VARCHAR(255), IN `InFirstName` VARCHAR(255), IN `InLastName` VARCHAR(255), IN `InStreet` VARCHAR(255), IN `InHouseNumber` VARCHAR(6), IN `InPostalCode` VARCHAR(6), IN `InCity` VARCHAR(255), IN `InPhone` VARCHAR(15))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
INSERT INTO Users (email, password_salt, password_hash, first_name, last_name, street, house_number, postal_code, city, phone, active) VALUES (InEmail, InPasswordSalt, InPasswordHash, InFirstName, InLastName, InStreet, InHouseNumber, InPostalCode, InCity, InPhone, 1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPLogin` (IN `pID` INT(11), IN `pPassword` VARCHAR(255))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN 
SELECT IF((SELECT `password_hash` AS correctPassword FROM users WHERE id = pID)=pPassword, (SELECT function FROM users where id = pID), 0);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPRemoveBikeFromBasket` (IN `pID` INT(11))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN
DELETE FROM bikes WHERE id = pID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPRemoveOptionFromBasket` (IN `pBikeID` INT(11), IN `pOptionID` INT(11))  SQL SECURITY INVOKER
DELETE FROM bikes_options WHERE bike_id = pBikeID AND option_id = pOptionID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPRemoveSearch` (IN `pID` INT(11))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
DELETE FROM searches WHERE id = pID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPSearch` (IN `pTerm` VARCHAR(255))  READS SQL DATA
    SQL SECURITY INVOKER
BEGIN
IF (SELECT COUNT(*) FROM models WHERE (name LIKE CONCAT('%', pTerm, '%') OR description LIKE CONCAT('%', pTerm, '%')) AND active = 1 > 0)
THEN (SELECT * FROM models WHERE (name LIKE CONCAT('%', pTerm, '%') OR description LIKE CONCAT('%', pTerm, '%')) AND active = 1);
ELSE INSERT INTO Searches (term, date) VALUES (pTerm, NOW());
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPSelectBikesInOrder` (IN `pID` INT(11))  SQL SECURITY INVOKER
SELECT * FROM bikes WHERE order_id = pID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPSendContactForm` (IN `pFirstName` VARCHAR(255), IN `pLastName` VARCHAR(255), IN `pEmail` VARCHAR(255), IN `pText` VARCHAR(255))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN
    INSERT INTO contact (firstname, lastname, email, contacttext)
    VALUES (pFirstName, pLastName, pEmail, pText);
END$$

--
-- Functies
--
CREATE DEFINER=`root`@`localhost` FUNCTION `FGetSalt` (`pID` INT(11)) RETURNS VARCHAR(255) CHARSET utf8mb4 READS SQL DATA
    SQL SECURITY INVOKER
RETURN (SELECT password_salt FROM users WHERE id = pID)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `basket`
--

CREATE TABLE `basket` (
  `user_id` int(11) NOT NULL,
  `bike_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `basket`
--

INSERT INTO `basket` (`user_id`, `bike_id`) VALUES
(1, 164),
(1, 165);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bikes`
--

CREATE TABLE `bikes` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bikes`
--

INSERT INTO `bikes` (`id`, `model_id`, `order_id`, `status`) VALUES
(1, 1, 1, ''),
(2, 3, 2, ''),
(3, 5, 3, ''),
(4, 6, 3, ''),
(5, 6, 4, ''),
(6, 4, 5, ''),
(7, 4, 6, ''),
(8, 1, 7, ''),
(9, 2, 8, ''),
(10, 6, 8, ''),
(11, 4, 8, ''),
(12, 5, 9, ''),
(13, 4, 10, ''),
(14, 6, 11, ''),
(15, 6, 11, ''),
(16, 4, 12, ''),
(17, 1, 1, 'hoi'),
(18, 1, 1, 'hoi'),
(22, 27, NULL, ''),
(23, 3, NULL, ''),
(24, 5, NULL, ''),
(25, 31, NULL, ''),
(26, 6, NULL, ''),
(29, 3, NULL, ''),
(30, 5, NULL, ''),
(32, 6, NULL, ''),
(35, 3, NULL, ''),
(36, 5, NULL, ''),
(38, 6, NULL, ''),
(41, 3, NULL, ''),
(42, 5, NULL, ''),
(45, 6, NULL, ''),
(47, 3, NULL, ''),
(48, 5, NULL, ''),
(50, 6, NULL, ''),
(53, 3, NULL, ''),
(54, 5, NULL, ''),
(57, 6, NULL, ''),
(59, 5, NULL, ''),
(62, 6, NULL, ''),
(63, 5, NULL, ''),
(65, 3, NULL, ''),
(66, 5, NULL, ''),
(68, 4, NULL, ''),
(71, 3, NULL, ''),
(72, 5, NULL, ''),
(74, 4, NULL, ''),
(77, 3, NULL, ''),
(80, 4, NULL, ''),
(82, 3, NULL, ''),
(83, 6, NULL, ''),
(85, 3, NULL, ''),
(87, 5, NULL, ''),
(88, 5, NULL, ''),
(90, 5, NULL, ''),
(93, 3, NULL, ''),
(94, 6, NULL, ''),
(96, 6, NULL, ''),
(101, 3, NULL, ''),
(102, 6, NULL, ''),
(107, 6, NULL, ''),
(109, 27, 37, ''),
(110, 4, NULL, ''),
(111, 31, 37, ''),
(112, 6, NULL, ''),
(114, 27, NULL, ''),
(115, 3, NULL, ''),
(116, 32, NULL, ''),
(118, 6, NULL, ''),
(119, 27, NULL, ''),
(120, 31, NULL, ''),
(121, 27, 38, ''),
(122, 31, 38, ''),
(123, 41, NULL, ''),
(125, 22, NULL, ''),
(126, 27, 40, ''),
(127, 31, 40, ''),
(128, 22, NULL, ''),
(129, 1, NULL, ''),
(130, 27, NULL, ''),
(131, 31, NULL, ''),
(132, 27, NULL, ''),
(133, 31, NULL, ''),
(134, 27, NULL, ''),
(135, 31, NULL, ''),
(136, 27, 41, ''),
(137, 31, 41, ''),
(138, 27, 41, ''),
(139, 31, 41, ''),
(140, 27, 42, ''),
(141, 27, NULL, ''),
(142, 27, NULL, ''),
(143, 27, 43, ''),
(144, 31, 43, ''),
(145, 27, NULL, ''),
(146, 27, NULL, ''),
(147, 27, NULL, ''),
(148, 27, NULL, ''),
(149, 27, NULL, ''),
(150, 27, NULL, ''),
(151, 27, NULL, ''),
(152, 27, NULL, ''),
(153, 27, NULL, ''),
(154, 27, NULL, ''),
(155, 1, NULL, ''),
(156, 1, 44, ''),
(157, 2, 46, ''),
(158, 1, NULL, ''),
(159, 1, NULL, ''),
(160, 1, NULL, ''),
(161, 1, NULL, ''),
(162, 1, NULL, ''),
(163, 1, NULL, ''),
(164, 1, NULL, ''),
(165, 1, NULL, ''),
(166, 1, NULL, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bikes_options`
--

CREATE TABLE `bikes_options` (
  `bike_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bikes_options`
--

INSERT INTO `bikes_options` (`bike_id`, `option_id`) VALUES
(1, 1),
(1, 2),
(1, 6),
(5, 2),
(5, 3),
(5, 7),
(10, 3),
(12, 5),
(15, 3),
(15, 5),
(22, 7),
(130, 1),
(136, 2),
(136, 5),
(137, 7),
(138, 3),
(139, 6),
(139, 7),
(140, 5),
(142, 3),
(142, 5),
(143, 3),
(143, 5),
(144, 2),
(145, 3),
(146, 4),
(147, 4),
(148, 4),
(149, 4),
(150, 4),
(151, 5),
(152, 4),
(153, 5),
(154, 5),
(156, 3),
(156, 5),
(157, 3),
(158, 3),
(159, 3),
(160, 3),
(161, 3),
(162, 3),
(163, 3),
(164, 3),
(165, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contacttext` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`id`, `firstname`, `lastname`, `email`, `contacttext`) VALUES
(1, 'test', 'test', 'test', 'test'),
(2, '111', '111', '111', '1111'),
(3, '111', '111', '111', '1111'),
(4, '', 'awdfa', '', ''),
(5, '', 'awdfa', '', ''),
(6, '', 'awawf', '', ''),
(7, 'qwdq', 'qwfq', 'wqfwf@awfqwf', 'qwfqw'),
(8, 'dssdfsd', 'sdfsdf', 'fdsfsdf@aa.nl', 'asdasdasdas');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `models`
--

INSERT INTO `models` (`id`, `name`, `description`, `price`, `image`, `active`) VALUES
(1, 'Vita-S', 'Morbi lacinia commodo mauris a lacinia. Ut blandit non dolor ut elementum. Duis sed sodales tortor, at tincidunt quam. Integer congue erat sit amet nibh ultricies, pharetra pharetra mauris scelerisque. Donec quis magna at sem pharetra commodo. Etiam in po', '850.00', 'xvita-s.png', b'1'),
(2, 'Vita-X', 'Suspendisse ac commodo est, sed rhoncus metus. Donec mattis, ante et ultrices mollis, ipsum elit vehicula urna, nec tristique risus augue non nulla. In tellus nunc, gravida sed ligula vitae, aliquam aliquam justo. Aenean a sagittis elit.', '1375.00', 'xvita-x.png', b'1'),
(3, 'Vita-L', 'Suspendisse augue odio, placerat id nulla sit amet, feugiat vulputate purus. Vestibulum a rutrum elit. Praesent at ex vitae felis pretium volutpat. Phasellus commodo cursus nisi eu luctus.', '2000.00', 'xvita-l.png', b'1'),
(4, 'Vita-S', 'goede fiets', '900.00', '', b'0'),
(5, 'Vita-X', '', '1500.00', '', b'0'),
(6, 'Vita-L', '', '2100.00', '', b'0'),
(12, 'Vita-X', '', '6.00', 'popcat popcorn.gif', b'0'),
(13, 'Vita-L', '', '6.00', '', b'0'),
(14, 'Vita-S', 'goede fiets', '9.00', 'jerma rat gif.gif', b'0'),
(15, 'Vita-S', 'goede fiets', '9.00', '', b'0'),
(16, 'Vita-L', '', '8.00', 'ratmod.gif', b'0'),
(17, 'Vita-S', 'goede fiets', '10.00', 'emu.png', b'0'),
(18, 'testname', 'testdescription', '4.00', '', b'0'),
(19, 'Vita-X', 'Descriptie', '5.00', 'popcat popcorn.gif', b'0'),
(33, 'nieuw model 3', 'Description 3', '3.00', '', b'0'),
(34, 'nieuw model 3', 'Description 3', '17.00', '', b'0'),
(35, 'nieuw model 3', 'Description 3', '364.00', '', b'0'),
(36, 'nieuw model 3', 'Description 3', '151.00', '', b'0');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `category` varchar(40) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `options`
--

INSERT INTO `options` (`id`, `name`, `price`, `category`, `image`, `active`) VALUES
(1, 'Fietstas model A', '65.00', 'Tassen', 'jerma rat gif.gif', b'0'),
(2, 'Fietstas model B', '43.00', 'Tassen', 'Fietstas model B.jpg', b'1'),
(3, 'Fietscomputer Extra', '125.00', 'Computers', 'Fietscomputer.jpg', b'1'),
(4, 'Stuur model A', '78.00', 'Sturen', 'Fietsstuur 1.jpg', b'1'),
(5, 'Kleur frame Wit metalic', '75.00', 'Frame', 'Wit metalic.jpg', b'1'),
(6, 'Kleur frame Rood metalic', '75.00', 'Frame', 'Rood metalic.jpg', b'1'),
(7, 'Kleur frame Blauw metalic', '75.00', 'Frame', 'Blauw metalic.jpg', b'1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `delivery_method` varchar(40) NOT NULL,
  `payment_option` varchar(40) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `delivery_date`, `delivery_method`, `payment_option`, `status`) VALUES
(1, 1, '2020-09-05 00:00:00', '2020-09-21 00:00:00', 'Post', 'Mastercard', 'delivered'),
(2, 5, '2020-12-31 00:00:00', '2021-01-06 00:00:00', 'Post', 'iDeal', 'delivered'),
(3, 2, '2021-03-05 00:00:00', '2021-03-10 00:00:00', 'Post', 'iDeal', 'delivered'),
(4, 4, '2021-02-12 00:00:00', '2021-02-17 00:00:00', 'DHL', 'iDeal', 'delivered'),
(5, 1, '2021-02-18 00:00:00', '2021-02-28 00:00:00', 'DHL', 'Mastercard', 'delivered'),
(6, 9, '2021-03-05 00:00:00', '2021-03-10 00:00:00', 'Post', 'Visa', 'delivered'),
(7, 1, '2020-10-25 00:00:00', '2020-11-02 00:00:00', 'DHL', 'iDeal', 'delivered'),
(8, 8, '2020-11-08 00:00:00', '2020-11-14 00:00:00', 'Post', 'Mastercard', 'delivered'),
(9, 7, '2021-01-19 00:00:00', '2021-01-25 00:00:00', 'DHL', 'Mastercard', 'delivered'),
(10, 7, '2021-03-18 00:00:00', '0000-00-00 00:00:00', '', 'Visa', 'open'),
(11, 3, '2021-03-19 00:00:00', '0000-00-00 00:00:00', '', 'iDeal', 'open'),
(12, 6, '2021-03-18 00:00:00', '0000-00-00 00:00:00', '', 'iDeal', 'open'),
(13, 1, '2021-06-15 05:17:47', '0000-00-00 00:00:00', 'q', 'aw', ''),
(14, 1, '2021-06-15 05:17:59', '0000-00-00 00:00:00', 'q', 'aw', ''),
(15, 1, '2021-06-15 05:23:53', '0000-00-00 00:00:00', 'eq', 'qew', ''),
(16, 1, '2021-06-15 05:25:43', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(17, 1, '2021-06-15 19:18:00', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(18, 1, '2021-06-15 19:19:32', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(19, 1, '2021-06-15 19:20:32', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(20, 1, '2021-06-15 19:20:38', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(21, 1, '2021-06-15 20:00:49', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(22, 1, '2021-06-15 20:26:33', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(23, 1, '2021-06-15 20:27:15', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(24, 1, '2021-06-15 20:29:59', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(25, 1, '2021-06-15 20:38:42', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(26, 1, '2021-06-15 20:42:32', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(27, 1, '2021-06-15 20:46:54', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(28, 1, '2021-06-15 20:48:18', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(29, 1, '2021-06-15 20:49:07', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(30, 1, '2021-06-15 20:50:14', '0000-00-00 00:00:00', 'test', 'test', ''),
(31, 1, '2021-06-15 20:53:46', '0000-00-00 00:00:00', 'qwdq', 'qq w', ''),
(32, 1, '2021-06-15 20:57:37', '0000-00-00 00:00:00', 'qwdq', 'qq w', ''),
(33, 1, '2021-06-15 20:57:57', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(34, 1, '2021-06-15 21:01:51', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(35, 1, '2021-06-15 21:08:27', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(36, 1, '2021-06-15 21:13:19', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(37, 1, '2021-06-15 21:15:00', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(38, 1, '2021-06-15 21:20:35', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(39, 1, '2021-06-15 21:23:04', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(40, 1, '2021-06-15 21:27:58', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(41, 1, '2021-06-15 21:38:23', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(42, 1, '2021-06-15 21:39:17', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(43, 1, '2021-06-15 21:41:58', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(44, 1, '2021-06-16 09:37:50', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(45, 1, '2021-06-16 13:20:55', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(46, 1, '2021-06-16 13:21:11', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', ''),
(47, 2, '2021-06-16 16:00:53', '0000-00-00 00:00:00', 'Just throw it really hard', 'I.O.U.', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `rating` int(2) NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `model_id`, `rating`, `text`, `date`) VALUES
(1, 1, 1, 4, 'Top fiets. Loopt lekker ligt. Levertijd zou korter mogen.', '2020-09-28 00:00:00'),
(2, 4, 6, 5, 'Wat een fijne fiets. Je hoeft bijna niet meer zalf te trappen :-)', '2021-02-21 00:00:00'),
(3, 8, 2, 5, 'Complete fiets. Stevig en solide. Motor maakt weinig geluid.', '2020-11-21 00:00:00'),
(4, 9, 4, 3, 'Moest de banden zelf nog oppompen. Verder zeer mooie fiets.', '2021-03-11 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `searches`
--

CREATE TABLE `searches` (
  `id` int(11) NOT NULL,
  `term` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `searches`
--

INSERT INTO `searches` (`id`, `term`, `date`) VALUES
(14, 'asdfsdfsdfsdfsdf', '2021-06-16 09:42:51');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_salt` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house_number` varchar(6) NOT NULL,
  `postal_code` varchar(6) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `active` bit(1) NOT NULL,
  `function` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password_salt`, `password_hash`, `first_name`, `last_name`, `street`, `house_number`, `postal_code`, `city`, `phone`, `active`, `function`) VALUES
(1, 'jjansen@webbie.nl', 'testsalt', '$2y$10$avVYCMrOxzGJPjW1/j4hHeJkR0wCismR4gaPnlqaBvBCGI0.6IUNq', 'Bennie', 'Striker', 'Beatrixstraat', '5', '4824AJ', 'Tilburg', '', b'1', 'customer'),
(2, 'keesie1234@kpnmail.nl', '', '$2y$10$avVYCMrOxzGJPjW1/j4hHeJkR0wCismR4gaPnlqaBvBCGI0.6IUNq', 'Bennie', 'Striker', 'Schoolstraat', '2', '4531AK', 'Terneuzen', '', b'1', 'admin'),
(3, 'bouwensk@tester.com', '', '', 'Bennie', 'Striker', 'Sportlaan', '45', '4401KR', 'Goes', '', b'1', ''),
(4, 'nel.van.der.ven@gmailer.com', '', '', 'Bennie', 'Striker', 'Molenweg', '17', '4611CE', 'Bergen op Zoom', '', b'1', ''),
(5, 'martinv@mailie.nl', '', '', 'Martin', 'Verstappe', 'Nieuwstraat', '99', '1083XX', 'Rotterdam', '', b'0', ''),
(6, 'K.toets@gmail.com', '', '', 'Bennie', 'Striker', 'Stadspark', '23', '5674GH', 'Roosendaal', '', b'1', ''),
(7, 'Juul@gmail.com', '', '', 'Bennie', 'Striker', 'De Grote Markt', '23A', '5223BA', '\'s - Hertogenbosch', '', b'1', ''),
(8, 'a.vd.ven@hotmail.nl', '', '', 'Bennie', 'Striker', 'Singel', '3', '2596LL', 'Zaandam', '', b'1', ''),
(9, 'b_strijker@hotmail.com', '', '', 'Bennie', 'Striker', 'Strijkstok', '1', '2345AB', 'Breukelen', '', b'0', ''),
(10, 'Nep.Email@haha.com', '', '$2y$10$avVYCMrOxzGJPjW1/j4hHeJkR0wCismR4gaPnlqaBvBCGI0.6IUNq', 'Nep voornaam', 'Nep achternaam', 'Nepstraat', '1', '1234AB', 'Eindhoven', '12345678', b'1', 'customer'),
(11, 'testmail@test.com', '', '$2y$10$AGMlk8C5PvP2zj8x4NfV/ulfunJ.SNbMbYe4jGCv3LahPsdDEQnBq', 'test', 'test', 'test', '12', '1234BC', 'Eindhoven', '12345678', b'1', 'customer'),
(12, 'peter.moorthamer@outlook.com', '', '$2y$10$tNs1YwK8gFUDKCNSoPNyG.RuYgEftCM8kE8MyE6N2pOaIV7qKRd2q', 'Peter', 'Moorthamer', 'Van Middelhovenstraat', '91', '4571AC', 'Axel', '+31115720114', b'1', 'customer');

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `viewname`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `viewname` (
`first_name` varchar(255)
,`last_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `vmodels`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `vmodels` (
`id` int(11)
,`name` varchar(40)
,`price` decimal(9,2)
,`image` varchar(255)
,`active` bit(1)
);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `voptions`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `voptions` (
`id` int(11)
,`name` varchar(40)
,`price` decimal(9,2)
,`category` varchar(40)
,`image` varchar(255)
,`active` bit(1)
);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `vorders`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `vorders` (
`first_name` varchar(255)
,`last_name` varchar(255)
,`postal_code` varchar(6)
,`house_number` varchar(6)
,`id` int(11)
,`user_id` int(11)
,`date` datetime
,`delivery_date` datetime
,`delivery_method` varchar(40)
,`payment_option` varchar(40)
,`status` varchar(255)
);

-- --------------------------------------------------------

--
-- Structuur voor de view `viewname`
--
DROP TABLE IF EXISTS `viewname`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewname`  AS SELECT `users`.`first_name` AS `first_name`, `users`.`last_name` AS `last_name` FROM `users` WHERE `users`.`active` = 0 ;

-- --------------------------------------------------------

--
-- Structuur voor de view `vmodels`
--
DROP TABLE IF EXISTS `vmodels`;

CREATE ALGORITHM=UNDEFINED DEFINER=`VModels`@`%` SQL SECURITY INVOKER VIEW `vmodels`  AS SELECT `models`.`id` AS `id`, `models`.`name` AS `name`, `models`.`price` AS `price`, `models`.`image` AS `image`, `models`.`active` AS `active` FROM `models` ;

-- --------------------------------------------------------

--
-- Structuur voor de view `voptions`
--
DROP TABLE IF EXISTS `voptions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`VOptions`@`%` SQL SECURITY INVOKER VIEW `voptions`  AS SELECT `options`.`id` AS `id`, `options`.`name` AS `name`, `options`.`price` AS `price`, `options`.`category` AS `category`, `options`.`image` AS `image`, `options`.`active` AS `active` FROM `options` ;

-- --------------------------------------------------------

--
-- Structuur voor de view `vorders`
--
DROP TABLE IF EXISTS `vorders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vorders`  AS SELECT `users`.`first_name` AS `first_name`, `users`.`last_name` AS `last_name`, `users`.`postal_code` AS `postal_code`, `users`.`house_number` AS `house_number`, `orders`.`id` AS `id`, `orders`.`user_id` AS `user_id`, `orders`.`date` AS `date`, `orders`.`delivery_date` AS `delivery_date`, `orders`.`delivery_method` AS `delivery_method`, `orders`.`payment_option` AS `payment_option`, `orders`.`status` AS `status` FROM (`orders` join `users` on(`orders`.`user_id` = `users`.`id`)) ;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `basket`
--
ALTER TABLE `basket`
  ADD KEY `FK_basket_bikes` (`bike_id`),
  ADD KEY `FK_basket_users` (`user_id`);

--
-- Indexen voor tabel `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `OrderID` (`order_id`),
  ADD KEY `ModelID` (`model_id`);

--
-- Indexen voor tabel `bikes_options`
--
ALTER TABLE `bikes_options`
  ADD PRIMARY KEY (`bike_id`,`option_id`),
  ADD KEY `ModelOrderID` (`bike_id`),
  ADD KEY `OptionID` (`option_id`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserID` (`user_id`);

--
-- Indexen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_reviews_users` (`user_id`),
  ADD KEY `FK_reviews_models` (`model_id`);

--
-- Indexen voor tabel `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bikes`
--
ALTER TABLE `bikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT voor een tabel `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `searches`
--
ALTER TABLE `searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bikes_options`
--
ALTER TABLE `bikes_options`
  ADD CONSTRAINT `FK_bikesoptions_bikes` FOREIGN KEY (`bike_id`) REFERENCES `bikes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bikesoptions_options` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_models` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
