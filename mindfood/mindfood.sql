-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 22 avr. 2022 à 21:09
-- Version du serveur :  8.0.28-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mindfood`
--

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE `brand` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `carrier`
--

CREATE TABLE `carrier` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `description` tinytext NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `universe_id` int NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `season_start` date DEFAULT NULL,
  `season_end` date DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `metadesc` text NOT NULL,
  `metakey` text NOT NULL,
  `hits` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `universe_id`, `title`, `image`, `description`, `season_start`, `season_end`, `created_on`, `metadesc`, `metakey`, `hits`) VALUES
(1, NULL, 1, 'Cuisine et vins', 'cooking.jpg', 'Livres sur les thèmes Cuisine et vins, Cuisine au quotidien, Bases de la cuisine, Régime spécial, Cuisines du monde, Art de la table, Fêtes et Réceptions, Desserts en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:06:14', 'Livres sur les thèmes Cuisine et vins, Cuisine au quotidien, Bases de la cuisine, Régime spécial, Cuisines du monde, Art de la table, Fêtes et Réceptions, Desserts en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Cuisine et vins, Cuisine au quotidien, Bases de la cuisine, Régime spécial, Cuisines du monde, Art de la table, Fêtes et Réceptions, Desserts', 0),
(2, 6, 1, 'Développement personnel', 'selfdev.jpg', 'Livres sur les thèmes Connaissance de soi, développement personnel, Emotions, Communication, PNL, Sophrologie en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:06:45', 'Livres sur les thèmes Connaissance de soi, développement personnel, Emotions, Communication, PNL, Sophrologie en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Connaissance de soi, développement personnel, Emotions, Communication, PNL, Sophrologie', 0),
(3, NULL, 1, 'Entreprise & Management', 'management.jpg', 'Livres sur les thèmes Entreprise et Bourse, Management, Gestion et administration, Economie, Marketing, Stratégie et Publicité, Secteurs d\'activité, Bourse et finance en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:07:01', 'Livres sur les thèmes Entreprise et Bourse, Management, Gestion et administration, Economie, Marketing, Stratégie et Publicité, Secteurs d\'activité, Bourse et finance en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Entreprise et Bourse, Management, Gestion et administration, Economie, Marketing, Stratégie et Publicité, Secteurs d\'activité, Bourse et finance', 0),
(4, NULL, 1, 'Histoire & Géographie', 'histoire.jpg', 'Livres sur les thèmes Histoire, Monde, Biographies, Europe, Grandes Périodes de l\'Histoire, Géopolitique, Généalogie, archéologie et autres disciplines, France en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:07:19', 'Livres sur les thèmes Histoire, Monde, Biographies, Europe, Grandes Périodes de l\'Histoire, Géopolitique, Généalogie, archéologie et autres disciplines, France en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Histoire, Monde, Biographies, Europe, Grandes Périodes de l\'Histoire, Géopolitique, Généalogie, archéologie et autres disciplines, France', 0),
(5, NULL, 1, 'Informatique et internet', 'informatique.jpg', 'Livres sur les thèmes Informatique et internet, Programmation et langages, Internet, Entreprise, Bureautique et publication, Réseaux et télécommunication, Multimédia et graphisme en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:07:39', 'Livres sur les thèmes Informatique et internet, Programmation et langages, Internet, Entreprise, Bureautique et publication, Réseaux et télécommunication, Multimédia et graphisme en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Informatique et internet, Programmation et langages, Internet, Entreprise, Bureautique et publication, Réseaux et télécommunication, Multimédia et graphisme', 0),
(6, NULL, 1, 'Psychologie & Psychanalyse', 'psycho.jpg', 'Livres sur les thèmes Psychologie et psychanalyse - Santé, Forme et Diététique, Par thème, Psychanalyse, Psychothérapie, Grands courants, Psychopathologie, Psychologie clinique en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:08:01', 'Livres sur les thèmes Psychologie et psychanalyse - Santé, Forme et Diététique, Par thème, Psychanalyse, Psychothérapie, Grands courants, Psychopathologie, Psychologie clinique en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Psychologie et psychanalyse - Santé, Forme et Diététique, Par thème, Psychanalyse, Psychothérapie, Grands courants, Psychopathologie, Psychologie clinique', 0),
(7, NULL, 1, 'Littérature', 'litterature.jpg', 'Livres sur les thèmes Romans et littérature, Littérature française, Poésie, Livres de référence, Littérature américaine, Romans historiques, Biographies en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:08:19', 'Livres sur les thèmes Romans et littérature, Littérature française, Poésie, Livres de référence, Littérature américaine, Romans historiques, Biographies en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Romans et littérature, Littérature française, Poésie, Livres de référence, Littérature américaine, Romans historiques, Biographies', 0),
(8, NULL, 1, 'Romans policiers', 'policier.jpg', 'Livres sur les thèmes Romans policiers et polars, Romans policiers, Thrillers, Polars historiques, Romans noirs en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:08:36', 'Livres sur les thèmes Romans policiers et polars, Romans policiers, Thrillers, Polars historiques, Romans noirs en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Romans policiers et polars, Romans policiers, Thrillers, Polars historiques, Romans noirs', 0),
(9, NULL, 1, 'Santé, Forme & Diététique', 'sante.jpg', 'Livres sur les thèmes Santé, Forme et Diététique, Psychologie et psychanalyse, Alimentation, régimes et diététique, Maladies et dépendances, Médecines douces, Exercice et fitness, Santé mentale en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:08:52', 'Livres sur les thèmes Santé, Forme et Diététique, Psychologie et psychanalyse, Alimentation, régimes et diététique, Maladies et dépendances, Médecines douces, Exercice et fitness, Santé mentale en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Santé, Forme et Diététique, Psychologie et psychanalyse, Alimentation, régimes et diététique, Maladies et dépendances, Médecines douces, Exercice et fitness, Santé mentale', 0),
(10, NULL, 1, 'Sciences & Techniques', 'sciences.jpg', 'Livres sur les thèmes Sciences, Techniques et Médecine, Personnages scientifiques, Médecine, Mathématiques, Techniques industrielles, Sciences de la vie - Biologie - Génétique, Sciences de la terre - Eau - Environnement en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:15:04', 'Livres sur les thèmes Sciences, Techniques et Médecine, Personnages scientifiques, Médecine, Mathématiques, Techniques industrielles, Sciences de la vie - Biologie - Génétique, Sciences de la terre - Eau - Environnement en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Sciences, Techniques et Médecine, Personnages scientifiques, Médecine, Mathématiques, Techniques industrielles, Sciences de la vie - Biologie - Génétique, Sciences de la terre - Eau - Environnement', 0),
(11, NULL, 1, 'Sports & Loisirs', 'sport.jpg', 'Livres sur les thèmes Sports, Athlétisme, gymnastique et fitness, Pêche, chasse et autres activités de plein air, Sports pour enfants et jeunes, Autres sports, Sports nautiques, Sports de combat et de self-défense en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:15:53', 'Livres sur les thèmes Sports, Athlétisme, gymnastique et fitness, Pêche, chasse et autres activités de plein air, Sports pour enfants et jeunes, Autres sports, Sports nautiques, Sports de combat et de self-défense en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Sports, Athlétisme, gymnastique et fitness, Pêche, chasse et autres activités de plein air, Sports pour enfants et jeunes, Autres sports, Sports nautiques, Sports de combat et de self-défense', 0),
(12, NULL, 1, 'Tourisme & voyages ', 'voyage.jpg', 'Livres sur les thèmes Tourisme et voyages, Voyages thématiques, Cartes et plans, Récits de voyages, Alimentation, hébergement et transport en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, '2022-04-18 19:16:17', 'Livres sur les thèmes Tourisme et voyages, Voyages thématiques, Cartes et plans, Récits de voyages, Alimentation, hébergement et transport en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Tourisme et voyages, Voyages thématiques, Cartes et plans, Récits de voyages, Alimentation, hébergement et transport', 0);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `order_id` int NOT NULL,
  `rating` int NOT NULL,
  `comment` tinytext NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `avatar` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `firstname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `zipcode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `city` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fixedPhone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mobilePhone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `avatar`, `lastname`, `firstname`, `email`, `password`, `address`, `zipcode`, `city`, `fixedPhone`, `mobilePhone`, `created_on`, `token`) VALUES
(8, NULL, 'FRANCOIS', 'Emmanuel', 'efdevfr@gmail.com', '$2y$10$2iBpUC.a6/5eA1ZWahofnu5a3XPRI4v/eWifu40ynZGb82Ebv.m/6', '18, rue de Paris', '94000', 'Créteil', '0303030303', '06060', '2022-04-21 20:48:47', NULL),
(9, NULL, 'DESCOFFIER', 'Arnaud', 'arnaud@gmail.com', '$2y$10$PSuh441F6kQyILZv47yADuSlEe9cXpFCgknCUY5sTghkkPeozwDFK', '', '', '', '', '', '2022-04-21 21:15:13', NULL),
(11, NULL, 'DESRUMEAUX', 'Patrick', 'patrick.desrumeaux@gmail.com', '$2y$10$sBh7Z7I/o4U4W5fuHg94se/k7ruUE2GOfx.52GRXJOmGBxRkyo9By', NULL, NULL, NULL, NULL, NULL, '2022-04-22 06:07:35', NULL),
(12, NULL, 'DUNOD', 'Didier', 'didier.dunod@gmail.com', '$2y$10$4R80M0967XVKL/3lr09EIeaeBZZ.6VaGSvxvxnDES3fg7tqX8qjp.', NULL, NULL, NULL, NULL, NULL, '2022-04-22 06:10:37', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `to_cart` tinyint(1) DEFAULT NULL,
  `order_id` int NOT NULL,
  `date_event` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `maker`
--

CREATE TABLE `maker` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `title` enum('Author','Director','Artist','Inventor') NOT NULL,
  `description` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `previous_id` int NOT NULL,
  `user_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `type` enum('Commercial Support','Technical Support','Product Return','Warranty') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `subject` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `order_no` varchar(15) NOT NULL,
  `bill_no` varchar(15) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('saved','paid','validated','prepared','send','in transit','delivered','returned','cancelled') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'saved',
  `delivery_point` enum('home','address','relay','') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'home',
  `delivery_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `carrier_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `orders_products`
--

CREATE TABLE `orders_products` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `tva` decimal(5,4) NOT NULL,
  `delivery_cost` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `universe_id` int NOT NULL,
  `category_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `maker_id` int NOT NULL,
  `reference` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `label` varchar(255) NOT NULL,
  `intro` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image_main` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `images` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `stock` int NOT NULL,
  `stock_min` int NOT NULL,
  `price` int NOT NULL,
  `price_history` tinytext NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `featured_from` date DEFAULT NULL,
  `featured_to` date DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `metakey` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `metadesc` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hits` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `universe_id`, `category_id`, `brand_id`, `maker_id`, `reference`, `label`, `intro`, `description`, `image_main`, `images`, `stock`, `stock_min`, `price`, `price_history`, `featured`, `featured_from`, `featured_to`, `created_on`, `modified_on`, `metakey`, `metadesc`, `hits`) VALUES
(1, 1, 3, 1, 1, 'HJDD654646DQS', 'Lqsdqsd iezaeoeoi zaoeiaz oiue', 'azsjkdh azkjhakz hajzkhk jhj hazkjhazke hehzaekhzekjahzezakhe azkjeh zaek haze khzaek jhazekjhazekj hazek jhazejk hazejkh azejk hazejkh az ekhzjhajek hzekj ze zkjhe jeh zjeh zejk hzke', 'hjqdqjgdhq sdgsdg qshdgsqhdqshdgqshdgsqhdghdgdhghjg dqshdgsdhgsqdgqsdgsqdh gqsdh gqsd hgqsd hg ghdsq hgqsdh gqshdg qshdg qshdg qshdgqsh gqshdg qsdghqsh dgqsdh gd ghdh gqsdhg qsdhg qsdhg qhdgqhgd qhjgd qshdgqhsgdqshgdhgshgs hgsd hgqsh dgs dgsd ghqsd ghqs dhgqsd ghqsdhgjsd hgqsd hgqsdh gqsd gqsd gqsd ghqsh jqgdqs ghdqhjgdqsdghqshdg qshdgqsh gqsh dgqshgd qshgdqsj ghdqsdghqsdghqshg d dhgqhsdgqshdgqs hgd hgqsdh gqs dhgqsd ghqsd hgqsd hgqdsh gsd qjghdqhj qgsd hjg dqsjd qgh', '', '', 25, 10, 20, '', 0, NULL, NULL, '2022-04-19 19:41:58', '2022-04-19 19:41:58', 'fs sdf sd   fsf sdfds  fd ', 'sd fsd fs fsfsdfsdfzerfezrze  zre zer ze rze rzer ze rze rzer zer zer ezr ezr zer zer zer ze rze rze rze rzer er zer zer zer zer ze ze rezr', 11);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `permission_level` int NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `universe`
--

CREATE TABLE `universe` (
  `id` int NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `maker_title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `reference_title` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `universe`
--

INSERT INTO `universe` (`id`, `title`, `image`, `description`, `maker_title`, `reference_title`, `created_on`) VALUES
(1, 'LIVRE', '', 'Oeuvre littéraire au format papier ou électronique', 'Author', 'ISBN', '2022-04-14 21:13:21'),
(2, 'DVD', '', 'Film en DVD', 'Director', 'ASIN', '2022-04-14 21:45:22'),
(3, 'CD', '', 'Oeuvre musicale sur CD', 'Artist', 'ASIN', '2022-04-14 21:55:50'),
(4, 'JEU', '', 'Jeu de société', 'Inventor', 'Référence', '2022-04-14 22:06:58');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `role_id` int NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `maker`
--
ALTER TABLE `maker`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `universe`
--
ALTER TABLE `universe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `maker`
--
ALTER TABLE `maker`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `universe`
--
ALTER TABLE `universe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
