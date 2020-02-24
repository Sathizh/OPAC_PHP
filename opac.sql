-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2019 at 06:59 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opac`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookdata`
--

CREATE TABLE `bookdata` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ISBN` bigint(13) NOT NULL,
  `criteria` varchar(30) NOT NULL,
  `Qty` int(11) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookdata`
--

INSERT INTO `bookdata` (`ID`, `title`, `name`, `ISBN`, `criteria`, `Qty`, `location`) VALUES
(134, 'Mind Master: Winning Lessons from a Champion\'s Life', ' Viswanathan Anand , Susan Ninan ', 9789351951506, 'Article', 6, 'Stock Room'),
(135, 'Finding the Gaps: Transferable Skills to Be the Best You Can Be', ' Simon Taufel ', 9789389109252, 'book', 7, 'Stock Room'),
(136, 'The Barefoot CoachThe Barefoot Coach', ' Addy Upton', 9789387894983, 'book', 4, 'Stock Room'),
(137, 'Game Changer', '  Shahid Afridi  ', 9789353026714, 'book', 7, 'Store Room'),
(138, 'No Spin: My Autobiography', '  Shane Warne', 9781785037719, 'book', 13, 'Store Room'),
(139, 'How to Develop Self-Confidence & Influence People By Public Speaking', ' Dale Carnegie  ', 9788175994720, 'book', 20, 'Stock Room'),
(140, 'How to Enjoy Your Life and Your Job', ' Dale Carnegie  ', 9788175994010, 'book', 31, 'Stock Room'),
(141, 'How to Win Friends and Influence People', ' Dale Carnegie  ', 9788190646604, 'book', 18, 'Store Room'),
(142, 'How to Develop a \'Never Give Up\' Attitude', ' Dr Hardik Joshi ', 9781946390448, 'book', 10, 'Store Room'),
(143, 'Lok Vyavhar (Hindi Translation of How to Win Friends & Influence People)', ' Dale Carnegie  ', 9789352612611, 'book', 10, 'Store Room'),
(144, 'How to Attract Money ', ' Joseph Murphy  ', 9789386450746, 'book', 13, 'Store Room'),
(145, 'A Gift to Self', '  Dr Radhika Kapoor', 9781645469506, 'book', 15, 'Stock Room'),
(146, 'The Quick and Easy Way to Effective Speaking', '  Dale Carnegie', 9789388144353, 'book', 16, 'Stock Room'),
(147, 'How to Win Friends and Influence People', '  Dale Carnegie', 9788192910994, 'book', 5, 'Stock Room'),
(148, 'The 7 Habits of Highly Effective People', '  R. Stephen Covey', 9781471131820, 'book', 4, 'Stock Room'),
(149, 'Article 370: A Constitutional History of Jammu and Kashmir OIP', '  A.G. Noorani ', 9780199455263, 'book', 3, 'Stock Room'),
(150, 'Good Economics for Hard Times : Better Answers to Our Biggest Problems', ' Esther Duflo Abhijit Banerjee ', 9789353450700, 'book', 2, 'Stock Room'),
(151, 'Atomic Habits', ' James Clear  ', 9781847941831, 'book', 6, 'Stock Room'),
(152, 'Article 1-4', ' Deals With The Territory Of India, Formation Of New States, Alterations, Names Of Existing States.', 9789583058002, 'Article', 5, 'Stock Room'),
(158, 'Article 5-11', ' Deals With Various Rights Of Citizenship.', 9789583051494, 'Article', 2, 'Stock Room'),
(159, 'Article 12-35', ' Deals With Fundamental Rights Of Indian Citizen Abolition Of Untouchability And Titles.', 9781429987738, 'Article', 2, 'Stock Room'),
(160, 'Articles 36-51', ' Deals With Directive Principles Of State Policy', 9780765329585, 'Article', 2, 'Stock Room'),
(161, 'Articles 51A', ' This Part Was Added By 42nnd Amendment In 1976, Which Contains The Fundamental Duties Of The Citizens.', 9783492280020, 'Article', 4, 'Stock Room'),
(162, 'Articles 52-151', ' Deals With Government At The Centre Level.', 9781461813378, 'Article', 7, 'Stock Room'),
(163, 'PriÄe iz Davnine', ' Ivana BrliÄ‡ MaÅ¾uraniÄ‡', 9789531207430, 'Digital', 4, 'Stock Room'),
(164, '\'Sacred\' Kurral of Tiruvalluva-Nayanar', ' Thiruvalluvar', 9789536124565, 'Digital', 4, 'Stock Room'),
(165, 'Similarity and enjoyment: Predicting continuation for women in philosophy', ' Heather Demarest Et Al', 2049363012123, 'Journal', 4, 'Stock Room'),
(166, 'Colour hallucination: A new problem for externalist representationalism', ' Laura Gow', 2049363012124, 'Journal', 4, 'Stock Room'),
(167, 'Paternalism', ' Jessica Begon', 2049363012125, 'Journal', 4, 'Stock Room'),
(170, 'Sample', ' Me', 1234567890123, 'Article', 2, 'Return center');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `title` varchar(253) NOT NULL,
  `ISBN` bigint(13) NOT NULL,
  `author` varchar(255) NOT NULL,
  `type` varchar(13) NOT NULL,
  `Due` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`id`, `name`, `title`, `ISBN`, `author`, `type`, `Due`) VALUES
(26, 'Public_1', 'No Spin: My Autobiography', 9781785037719, '  Shane Warne', 'Book', '2019-Dec-03'),
(27, 'Public_1', 'The Quick and Easy Way to Effective Speaking', 9789388144353, '  Dale Carnegie', 'Book', '2019-Dec-06'),
(29, 'Public_1', 'How to Enjoy Your Life and Your Job', 9788175994010, ' Dale Carnegie  ', 'Book', '2019-Dec-16'),
(32, 'Public_1', 'Finding the Gaps: Transferable Skills to Be the Best You Can Be', 9789389109252, ' Simon Taufel ', 'Book', '2019-Dec-20');

-- --------------------------------------------------------

--
-- Table structure for table `pub_user`
--

CREATE TABLE `pub_user` (
  `name` varchar(30) NOT NULL,
  `password` varchar(225) NOT NULL,
  `ph` double NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(225) NOT NULL,
  `roll` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pub_user`
--

INSERT INTO `pub_user` (`name`, `password`, `ph`, `email`, `address`, `roll`) VALUES
('Public_2', 'ba750110a946d41978d28001af2f1596', 1234567890, 'public_2@gmail.com', 'public_2@gmail.com', 'Public'),
('Public_1', '202cb962ac59075b964b07152d234b70', 7010629484, 'public@gmail.com', 'public@gmail.com', 'Public'),
('Admin', 'fa03eb688ad8aa1db593d33dabd89bad', 9842720958, 'admin@gmail.com', '2/162-9,KPM', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookdata`
--
ALTER TABLE `bookdata`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pub_user`
--
ALTER TABLE `pub_user`
  ADD UNIQUE KEY `ph` (`ph`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookdata`
--
ALTER TABLE `bookdata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
