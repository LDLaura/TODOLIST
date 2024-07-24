-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 24 juil. 2024 à 10:44
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `to_do_list`
--

-- --------------------------------------------------------

--
-- Structure de la table `list`
--

DROP TABLE IF EXISTS `list`;
CREATE TABLE IF NOT EXISTS `list` (
  `idListe` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `idUsers` int NOT NULL,
  PRIMARY KEY (`idListe`),
  KEY `FK_LIST_idUsers` (`idUsers`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `list`
--

INSERT INTO `list` (`idListe`, `title`, `content`, `createdAt`, `idUsers`) VALUES
(46, 'aaaaaaaa', 'cffffffffffff', '2024-07-23 16:02:38', 22),
(26, 'test2', 'Lorem ipsum dolor sit amet. Et mollitia voluptas sit veniam error aut saepe reiciendis.', '2024-07-19 09:24:33', 10),
(27, 'test2', 'Lorem ipsum dolor sit amet. Et mollitia voluptas sit veniam error aut saepe reiciendis.', '2024-07-19 09:29:32', 10),
(40, 'ttttttttttttt', 'tttttttttttthhhtttttt', '2024-07-23 14:51:52', 22),
(35, 'testtCC', 'etetCCCW', '2024-07-19 22:33:45', 19),
(39, 'ttttttttttttt', 'tttttttttttthhhtttttt', '2024-07-23 14:51:18', 22);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(22, 'laulau', '$2y$10$yvz3RNSw9L56Ja4fGaySteU6BL7CC6Yziuuwv090lsdJ6PTEM7I4e');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
