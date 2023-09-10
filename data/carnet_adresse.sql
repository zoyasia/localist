-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : dim. 10 sep. 2023 à 16:00
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `carnet_adresse`
--

-- --------------------------------------------------------

--
-- Structure de la table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `addressName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `picture` varchar(2083) NOT NULL,
  `comment` text NOT NULL,
  `street` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `zipcode` int NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `website` varchar(2083) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `category_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `status_id` (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `addresses`
--

INSERT INTO `addresses` (`id`, `addressName`, `picture`, `comment`, `street`, `zipcode`, `city`, `phone`, `website`, `category_id`, `user_id`, `status_id`) VALUES
(1, 'Le Bernard l\'Hermite', 'bernard.jpg', 'restaurant de fruits de mer, très bonnes moules au gorgonzola!', '20 place ronde', 44380, 'Pornichet', '09 50 34 87 ', 'https://www.instagram.com/le_bernard_lhermite/', 1, 25, 2),
(2, 'Le poivron bleu', 'poivron.jpg', 'restaurant avec formule unique', '2 rue des Lilas', 69006, 'Lyon', NULL, NULL, 1, 25, 2),
(3, 'Tigermilk', 'tiger.jpg', 'Meilleur ceviche testé à Lyon', '43 avenue Lumière', 69001, 'Lyon', NULL, NULL, 1, 25, 1),
(29, 'Le drink', '', '', '87 cours docteur long', 69003, 'Lyon', '', '', 3, 22, 1),
(27, 'Kosem', '', 'Kebab au top!', '10 avenue lacassagne', 69003, 'Lyon', '', '', 1, 22, 2),
(40, 'La Cafétoria', '', 'recommandé par Jeanne', '23 Bd Jacquard', 62100, 'Calais', '', '', 2, 25, 1),
(71, 'Flower Power', 'flowers.jpg', 'Super fleuriste, fleurs françaises!', '42 rue de Marseille', 69322, 'Lorient', '', '', 4, 25, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `color`) VALUES
(1, 'restaurant', '#88040F'),
(2, 'café', '#DFBE99'),
(3, 'bar', '#5E8C61'),
(4, 'boutique', '#729EA1');

-- --------------------------------------------------------

--
-- Structure de la table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `picture` varchar(2083) DEFAULT NULL,
  `status` enum('public','privé') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `city` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `profiles`
--

INSERT INTO `profiles` (`id`, `username`, `picture`, `status`, `city`, `bio`) VALUES
(12, NULL, NULL, NULL, NULL, NULL),
(2, 'rems', NULL, NULL, 'Clermont-Ferrand', NULL),
(3, 'Lenka', NULL, NULL, 'Lyon', 'Sushi lover'),
(11, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL),
(13, NULL, NULL, NULL, NULL, NULL),
(14, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `teststatus`
--

DROP TABLE IF EXISTS `teststatus`;
CREATE TABLE IF NOT EXISTS `teststatus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `teststatus`
--

INSERT INTO `teststatus` (`id`, `status`) VALUES
(1, 'à tester'),
(2, 'déjà testé');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profile_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `pwd`, `profile_id`) VALUES
(22, 'Rémy', 'Salmon', 'rems@rems.com', '$2y$10$0hGkDY5BqEjSA3DOqlX6WOuqUHFxFlKYKHxiN.USxxRFaOYOvcNOO', 2),
(25, 'Léna', 'Dazy', 'lena@lena.com', '$2y$10$1CUvKuVrc4IKcOuGNnaW9O1hVH0wnw5oUsgu8Trx4R8q1wCpSkbSm', 3),
(35, 'o', 'o', 'er@ht.com', '$2y$10$z2C9rfkE0VuocxzDWIc.SuskhyWeNCKxrIBtfCvf2jnDJmBnbvE1q', 13),
(36, 'q', 'q', 'q@q.com', '$2y$10$Czauw0KnXNSkW/ZRQ3E5oeGWlXYBh/bdTlfufZ4nc8w0.QABLgksq', 14);

--
-- Déclencheurs `users`
--
DROP TRIGGER IF EXISTS `assign_profile_id`;
DELIMITER $$
CREATE TRIGGER `assign_profile_id` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
  IF NEW.profile_id IS NULL THEN
    INSERT INTO profiles (id) VALUES (NULL);
    SET NEW.profile_id = LAST_INSERT_ID();
  END IF;
END
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
