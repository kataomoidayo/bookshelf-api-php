-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 06:58 PM
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
-- Database: `bookshelf`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` varchar(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `summary` varchar(500) NOT NULL,
  `inserted_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`, `publisher`, `summary`, `inserted_at`, `updated_at`) VALUES
('65a8139a1be69', '雪国', '川端康成', '1937', '創元社', '新緑の山あいの温泉で、島村は駒子という美しい娘に出会う。駒子の肌は陶器のように白く、唇はなめらかで、三味線が上手だった。その年の暮れ、彼女に再び会うために、島村は汽車へと乗り込む。すると同じ車両にいた葉子という娘が気になり……じつは葉子と駒子の間には、ある秘密が隠されていたのだ。徹底した情景描写で日本的な「美」を結晶化させた世界的名作。ノーベル文学賞対象作品。', '2024-01-18 01:51:22', '2024-01-18 01:51:22'),
('65a8139fe39d2', 'タナトスの誘惑', '星野 舞夜', '2019', 'monogatary.com', '8月15日。もうとっくに日は沈んだというのに、辺りには蒸し暑い空気が漂っている。マンションの階段を駆け上がる僕の体からは、汗が止めどなく噴き出していた。「さよなら」たった４文字の彼女からのLINE。それが何を意味しているのか、僕にはすぐに分かった。御盆の時期にも関わらず職場で仕事をしていた僕は、帰り支度をしたあと急いで自宅のあるマンションに向かった。そして、マンションの屋上、フェンスの外側に、虚ろな目をした彼女が立っているのを見つけた。飛び降り自殺を図ろうとする彼女の姿を見たのは、実はこれでもう4回目だ。YOASOBIの『夜に駆ける』、『あの夢をなぞって』、『たぶん』、『アンコール』の4つの楽曲の原作小説を収録した短編小説集である。原作小説の他に、YOASOBIのAyaseとikuraの特別インタビューも収録されている', '2024-01-18 01:51:27', '2024-01-18 01:51:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
