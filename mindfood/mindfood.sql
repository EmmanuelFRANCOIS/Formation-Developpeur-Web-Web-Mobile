-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 28 avr. 2022 à 11:57
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
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `brand`
--

INSERT INTO `brand` (`id`, `title`, `image`, `description`, `created_on`) VALUES
(1, 'Éditions Gallimard', '1651085094.jpg', 'La célèbre maison d’édition a été créée en 1911 par André Gide, Jean Schlumberger et Gaston Gallimard. Il s’agissait alors des éditions de la NRF (Nouvelle revue Française). Aujourd’hui, elle fait partie du groupe Madrigall, 3ème pôle éditorial français.', '2022-04-27 20:35:49'),
(2, 'Éditions Flammarion', '1651085107.jpg', 'Les éditions Flammarion ont été fondées en 1875 par Ernest Flammarion. Depuis 2012, elles font partie du groupe Madrigall comme les éditions Gallimard.', '2022-04-27 20:35:49'),
(3, 'Éditions Milan', '1651085119.jpg', 'Les éditions Milan ont été créées en 1980, à Toulouse, par un groupe d’amis, Patrice Amen, Alain Oriol, Bernard Grimaud et Michel Mazéries. Elles ont été rachetées par le groupe Bayard en 2004.', '2022-04-27 20:35:50'),
(4, 'Éditions Baudelaire', '1651085129.png', 'Les éditions Baudelaire ont été créées en 2007 à Lyon. En tant que partenaire de l’éditeur, le groupe Hachette assure la distribution des ouvrages que l’éditeur publie.', '2022-04-27 20:35:50'),
(5, 'Éditions de Minuit', '1651085141.jpg', 'Les éditions de Minuit ont été créées en 1941, à Paris, pendant l’occupation allemande, par Jean Bruller et Pierre de Lescure. Leur premier livre publié est le célèbre « Le silence de la mer », écrit par Jean Bruller, sous le pseudonyme de Vercors.', '2022-04-27 20:35:50'),
(6, 'Éditions Hachette', '1651085151.png', 'Les éditions Hachette ont été créées en 1826, date de l’acquisition, par Louis Hachette, de la librairie parisienne Brédif. Depuis 1981, Hachette est l’un des deux piliers du groupe Lagardère. Sous le nom de Hachette Publishing, les activités d’édition du groupe le placent au troisième rang mondial. Hachette Publishing regroupe les marques Armand Colin, Dunod, Stock, Fayard, Grasset, Larousse, Calmann-Lévy et le Livre de Poche.', '2022-04-27 20:35:50'),
(7, 'Éditions Le léopard masqué', '1651085163.png', 'Sur la liste maison édition, le léopard masqué est un des rares éditeurs à être encore indépendant. Depuis sa création en 2004, par Gordon Zola, la maison d’édition a publié près de 80 livres.', '2022-04-27 20:35:50'),
(8, 'Éditions Privat', '1651085175.jpg', 'Les éditions Privat ont été créées à Toulouse en 1839 par Edouard Privat et bien que régionales, les éditions Privat ont un rayonnement national. Depuis 1995, elles appartiennent aux Laboratoires Pierre Fabre.', '2022-04-27 20:35:50'),
(9, 'Éditions Julliard', '1651085188.jpg', 'Fondée en 1942 par René Juillard, les éditions Juillard se sont toujours attachées à découvrir de jeunes nouveaux auteurs. Rachetées par les Presses de la cité en 1966, elles en suivent les tribulations. Aujourd’hui,  et depuis 2008, elles font partie du groupe Editis, détenu par le groupe espagnol Grupo Planeta.', '2022-04-27 20:35:50'),
(10, 'Éditions Allary', '1651085199.jpeg', 'Les éditions Allary sont une maison indépendante, lancée en 2014, par Guillaume Allary. Celui-ci est un ancien de Flammarion et de Hachette littérature. A ce jour, l’éditeur a publié plus de 60 ouvrages qui ont donné lieu à près de 200 traductions et à son catalogue figurent des auteurs connus comme Matthieu Ricard, Bernard Pivot ou Riad Sattouf.', '2022-04-27 20:35:50'),
(11, 'Editions Folio', '1651123244.png', 'Description des Editions Folio', '2022-04-28 07:18:50');

-- --------------------------------------------------------

--
-- Structure de la table `carrier`
--

CREATE TABLE `carrier` (
  `id` int NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` tinytext NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `carrier`
--

INSERT INTO `carrier` (`id`, `title`, `image`, `description`, `created_on`) VALUES
(1, 'Chronopost', '', 'Description du transporteur \"Chronopost\"...', '2022-04-27 21:14:53'),
(2, 'Collissimo', '', 'Description du transporteur \"Collissimo\"...', '2022-04-27 21:14:53'),
(3, 'DHL Express', '', 'Description du transporteur \"DHL Express\"...', '2022-04-27 21:14:53'),
(4, 'FedEx Express', '', 'Description du transporteur \"FedEx Express\"...', '2022-04-27 21:14:53'),
(5, 'UPS Express', '', 'Description du transporteur \"UPS Express\"...', '2022-04-27 21:14:53'),
(6, 'TNT Express', '', 'Description du transporteur \"TNT Express\"...', '2022-04-27 21:14:53'),
(7, 'Delivengo Easy', '', 'Description du transporteur \"Delivengo Easy\"...', '2022-04-27 21:14:53'),
(8, 'Packlink', '', 'Description du transporteur \"Packlink\"...', '2022-04-27 21:14:53'),
(9, 'Relais Colis', '', 'Description du transporteur \"Relais Colis\"...', '2022-04-27 21:14:53'),
(10, 'Mondial Relay', '', 'Description du transporteur \"Mondial Relay\"...', '2022-04-27 21:14:53');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `universe_id` int NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `season_start` date DEFAULT NULL,
  `season_end` date DEFAULT NULL,
  `metadesc` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `metakey` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `hits` int DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `universe_id`, `title`, `image`, `description`, `season_start`, `season_end`, `metadesc`, `metakey`, `hits`, `created_on`) VALUES
(1, NULL, 1, 'Cuisine et vins', 'cooking.jpg', 'Livres sur les thèmes Cuisine et vins, Cuisine au quotidien, Bases de la cuisine, Régime spécial, Cuisines du monde, Art de la table, Fêtes et Réceptions, Desserts en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Cuisine et vins, Cuisine au quotidien, Bases de la cuisine, Régime spécial, Cuisines du monde, Art de la table, Fêtes et Réceptions, Desserts en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Cuisine et vins, Cuisine au quotidien, Bases de la cuisine, Régime spécial, Cuisines du monde, Art de la table, Fêtes et Réceptions, Desserts', 0, '2022-04-18 19:06:14'),
(2, 6, 1, 'Développement personnel', 'selfdev.jpg', 'Livres sur les thèmes Connaissance de soi, développement personnel, Emotions, Communication, PNL, Sophrologie en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Connaissance de soi, développement personnel, Emotions, Communication, PNL, Sophrologie en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Connaissance de soi, développement personnel, Emotions, Communication, PNL, Sophrologie', 0, '2022-04-18 19:06:45'),
(3, NULL, 1, 'Entreprise & Management', 'management.jpg', 'Livres sur les thèmes Entreprise et Bourse, Management, Gestion et administration, Economie, Marketing, Stratégie et Publicité, Secteurs d\'activité, Bourse et finance en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Entreprise et Bourse, Management, Gestion et administration, Economie, Marketing, Stratégie et Publicité, Secteurs d\'activité, Bourse et finance en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Entreprise et Bourse, Management, Gestion et administration, Economie, Marketing, Stratégie et Publicité, Secteurs d\'activité, Bourse et finance', 0, '2022-04-18 19:07:01'),
(4, NULL, 1, 'Histoire & Géographie', 'histoire.jpg', 'Livres sur les thèmes Histoire, Monde, Biographies, Europe, Grandes Périodes de l\'Histoire, Géopolitique, Généalogie, archéologie et autres disciplines, France en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Histoire, Monde, Biographies, Europe, Grandes Périodes de l\'Histoire, Géopolitique, Généalogie, archéologie et autres disciplines, France en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Histoire, Monde, Biographies, Europe, Grandes Périodes de l\'Histoire, Géopolitique, Généalogie, archéologie et autres disciplines, France', 0, '2022-04-18 19:07:19'),
(5, NULL, 1, 'Informatique et internet', 'informatique.jpg', 'Livres sur les thèmes Informatique et internet, Programmation et langages, Internet, Entreprise, Bureautique et publication, Réseaux et télécommunication, Multimédia et graphisme en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Informatique et internet, Programmation et langages, Internet, Entreprise, Bureautique et publication, Réseaux et télécommunication, Multimédia et graphisme en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Informatique et internet, Programmation et langages, Internet, Entreprise, Bureautique et publication, Réseaux et télécommunication, Multimédia et graphisme', 0, '2022-04-18 19:07:39'),
(6, 0, 1, 'Psychologie & Psychanalyse', 'psycho.jpg', 'Livres sur les thèmes Psychologie et psychanalyse - Santé, Forme et Diététique, Par thème, Psychanalyse, Psychothérapie, Grands courants, Psychopathologie, Psychologie clinique en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Psychologie et psychanalyse - Santé, Forme et Diététique, Par thème, Psychanalyse, Psychothérapie, Grands courants, Psychopathologie, Psychologie clinique en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Psychologie et psychanalyse - Santé, Forme et Diététique, Par thème, Psychanalyse, Psychothérapie, Grands courants, Psychopathologie, Psychologie clinique', 0, '2022-04-18 19:08:01'),
(7, 12, 1, 'Littérature', 'litterature.jpg', 'Livres sur les thèmes Romans et littérature, Littérature française, Poésie, Livres de référence, Littérature américaine, Romans historiques, Biographies en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', '2022-04-06', '2022-07-07', 'Livres sur les thèmes Romans et littérature, Littérature française, Poésie, Livres de référence, Littérature américaine, Romans historiques, Biographies en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Romans et littérature, Littérature française, Poésie, Livres de référence, Littérature américaine, Romans historiques, Biographies', 0, '2022-04-18 19:08:19'),
(8, 0, 1, 'Romans policiers', 'policier.jpg', 'Livres sur les thèmes Romans policiers et polars, Romans policiers, Thrillers, Polars historiques, Romans noirs en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Romans policiers et polars, Romans policiers, Thrillers, Polars historiques, Romans noirs en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Romans policiers et polars, Romans policiers, Thrillers, Polars historiques, Romans noirs', NULL, '2022-04-18 19:08:36'),
(9, NULL, 1, 'Santé, Forme & Diététique', 'sante.jpg', 'Livres sur les thèmes Santé, Forme et Diététique, Psychologie et psychanalyse, Alimentation, régimes et diététique, Maladies et dépendances, Médecines douces, Exercice et fitness, Santé mentale en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Santé, Forme et Diététique, Psychologie et psychanalyse, Alimentation, régimes et diététique, Maladies et dépendances, Médecines douces, Exercice et fitness, Santé mentale en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Santé, Forme et Diététique, Psychologie et psychanalyse, Alimentation, régimes et diététique, Maladies et dépendances, Médecines douces, Exercice et fitness, Santé mentale', 0, '2022-04-18 19:08:52'),
(10, NULL, 1, 'Sciences & Techniques', 'sciences.jpg', 'Livres sur les thèmes Sciences, Techniques et Médecine, Personnages scientifiques, Médecine, Mathématiques, Techniques industrielles, Sciences de la vie - Biologie - Génétique, Sciences de la terre - Eau - Environnement en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Sciences, Techniques et Médecine, Personnages scientifiques, Médecine, Mathématiques, Techniques industrielles, Sciences de la vie - Biologie - Génétique, Sciences de la terre - Eau - Environnement en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Sciences, Techniques et Médecine, Personnages scientifiques, Médecine, Mathématiques, Techniques industrielles, Sciences de la vie - Biologie - Génétique, Sciences de la terre - Eau - Environnement', 0, '2022-04-18 19:15:04'),
(11, NULL, 1, 'Sports & Loisirs', 'sport.jpg', 'Livres sur les thèmes Sports, Athlétisme, gymnastique et fitness, Pêche, chasse et autres activités de plein air, Sports pour enfants et jeunes, Autres sports, Sports nautiques, Sports de combat et de self-défense en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Sports, Athlétisme, gymnastique et fitness, Pêche, chasse et autres activités de plein air, Sports pour enfants et jeunes, Autres sports, Sports nautiques, Sports de combat et de self-défense en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Sports, Athlétisme, gymnastique et fitness, Pêche, chasse et autres activités de plein air, Sports pour enfants et jeunes, Autres sports, Sports nautiques, Sports de combat et de self-défense', 0, '2022-04-18 19:15:53'),
(12, NULL, 1, 'Tourisme & voyages ', 'voyage.jpg', 'Livres sur les thèmes Tourisme et voyages, Voyages thématiques, Cartes et plans, Récits de voyages, Alimentation, hébergement et transport en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', NULL, NULL, 'Livres sur les thèmes Tourisme et voyages, Voyages thématiques, Cartes et plans, Récits de voyages, Alimentation, hébergement et transport en vente sur Kultur.com. Des milliers de livres de qualité disponibles !', 'Tourisme et voyages, Voyages thématiques, Cartes et plans, Récits de voyages, Alimentation, hébergement et transport', 0, '2022-04-18 19:16:17'),
(67, 7, 1, 'aaaaaaaaaaaaaaaaa', '1651074363.jpg', 'aaaaaaaaaaaaaaaaa', NULL, NULL, 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaa', 0, '2022-04-27 17:46:03');

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
(8, 'avatar_0.png', 'FRANCOIS', 'Emmanuel', 'efdevfr@gmail.com', '$2y$10$JugWmSgJhRrLEGymaO3cp.wCCzVh5GXBN6xUucWGBGuCOy.ql4voi', '18, rue de Paris', '94000', 'Créteil', '0303030303', '06060', '2022-04-21 20:48:47', '$2y$10$M5DZRwJgrZ8qd8hZkklxneGX5LGp81lUNVtGuP/HtdjiDQIHS.fuO'),
(9, 'avatar_1.png', 'DESCOFFIER', 'Arnaud', 'arnaud@gmail.com', '$2y$10$PSuh441F6kQyILZv47yADuSlEe9cXpFCgknCUY5sTghkkPeozwDFK', '', '', '', '', '', '2022-04-21 21:15:13', NULL),
(11, 'avatar_8.png', 'DESRUMEAUX', 'Patrick', 'patrick.desrumeaux@gmail.com', '$2y$10$sBh7Z7I/o4U4W5fuHg94se/k7ruUE2GOfx.52GRXJOmGBxRkyo9By', NULL, NULL, NULL, NULL, NULL, '2022-04-22 06:07:35', NULL),
(12, 'avatar_9.png', 'DUNOD', 'Didier', 'didier.dunod@gmail.com', '$2y$10$4R80M0967XVKL/3lr09EIeaeBZZ.6VaGSvxvxnDES3fg7tqX8qjp.', NULL, NULL, NULL, NULL, NULL, '2022-04-22 06:10:37', NULL),
(14, NULL, 'GATES', 'Bill', 'bill.gates@gmaill.com', '$2y$10$Ql.DOuSplblsMLDYlXZRqu8skYk8MdGQAWyKO2f0FfEfznj/oMeiK', NULL, NULL, NULL, NULL, NULL, '2022-04-27 07:57:42', '$2y$10$CzWtEeoRIUvC7dcrlb4jwuECma83ZE.luGacT0O64DePNvbYOuY0.');

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
  `status` enum('saved','paid','validated','prepared','send','in transit','delivered','returned','cancelled') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'saved',
  `delivery_point` enum('home','address','relay','') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'home',
  `delivery_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `carrier_id` int NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `reference` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `maker` varchar(100) DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `stock` int DEFAULT '0',
  `stock_min` int DEFAULT '0',
  `price` decimal(7,2) DEFAULT '0.00',
  `metakey` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `metadesc` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `hits` int DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `universe_id`, `category_id`, `brand_id`, `reference`, `title`, `maker`, `image`, `description`, `stock`, `stock_min`, `price`, `metakey`, `metadesc`, `hits`, `created_on`, `modified_on`) VALUES
(1, 1, 7, 1, '978-2070363735', 'La promesse de l\'aube', 'Romain GARY', '1651139168.jpeg', '\"- Tu seras un héros, tu seras général, Gabriele D\'Annunzio, Ambassadeur de France - tous ces voyous ne savent pas qui tu es !Je crois que jamais un fils n\'a haï sa mère autant que moi, à ce moment-là. Mais, alors que j\'essayais de lui expliquer dans un murmure rageur qu\'elle me compromettait irrémédiablement aux yeux de l\'Armée de l\'Air, et que je faisais un nouvel effort pour la pousser derrière le taxi, son visage prit une expression désemparée, ses lèvres se mirent à trembler, et j\'entendis une fois de plus la formule intolérable, devenue depuis longtemps classique dans nos rapports : - Alors, tu as honte de ta vieille mère ?\"', 12, 12, '50.00', 'romain gary promesse de aube amour maternel mère pour son fils guerre mondiale bien écrit chef d oeuvre hors du commun devant soi histoire d amour très beau racines du ciel beau livre ', 'Romain Gary, né Roman Kacew à Vilnius en 1914, est élevé par sa mère qui place en lui de grandes espérances, comme il le racontera dans La promesse de l\'aube. Pauvre, \"cosaque un peu tartare mâtiné de juif\", il arrive en France à l\'âge de quatorze ans et s\'installe avec sa mère à Nice...', 11, '2022-04-19 19:41:58', '2022-04-19 19:41:58');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` varchar(3) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `title`, `created_on`) VALUES
('adm', 'Administrateur', '2022-04-24 09:59:43'),
('com', 'Responsable Commercial', '2022-04-24 09:59:43'),
('cst', 'Client', '2022-04-24 09:59:43'),
('stk', 'Gestionnaire de Stocks', '2022-04-24 09:59:43'),
('sup', 'Technicien Support', '2022-04-24 09:59:43'),
('vis', 'Visiteur', '2022-04-24 09:59:43');

-- --------------------------------------------------------

--
-- Structure de la table `universe`
--

CREATE TABLE `universe` (
  `id` int NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `universe`
--

INSERT INTO `universe` (`id`, `title`, `image`, `description`, `created_on`) VALUES
(1, 'LIVRE', '', 'Oeuvre littéraire au format papier ou électronique', '2022-04-14 21:13:21'),
(2, 'DVD', '', 'Film en DVD', '2022-04-14 21:45:22'),
(3, 'CD', '', 'Oeuvre musicale sur CD', '2022-04-14 21:55:50'),
(4, 'JEU', '', 'Jeu de société', '2022-04-14 22:06:58');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `role_id` varchar(5) NOT NULL,
  `avatar` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `role_id`, `avatar`, `lastname`, `firstname`, `email`, `username`, `password`, `created_on`, `modified_on`) VALUES
(1, 'adm', '', 'GATES', 'Bill', 'bill.gates@gmaill.com', 'bill', '$2y$10$JugWmSgJhRrLEGymaO3cp.wCCzVh5GXBN6xUucWGBGuCOy.ql4voi', '2022-04-24 08:07:35', '2022-04-24 08:07:35'),
(2, 'com', '', 'JOBS', 'Steve', 'steve.jobs@gmaill.com', 'steve', '$2y$10$JugWmSgJhRrLEGymaO3cp.wCCzVh5GXBN6xUucWGBGuCOy.ql4voi', '2022-04-24 08:07:35', '2022-04-24 08:07:35'),
(3, 'sup', '', 'EINSTEIN', 'Albert', 'albert.einstein@gmaill.com', 'albert', '$2y$10$JugWmSgJhRrLEGymaO3cp.wCCzVh5GXBN6xUucWGBGuCOy.ql4voi', '2022-04-24 08:11:40', '2022-04-24 08:11:40'),
(4, 'stk', '', 'COOK', 'Tim', 'tim.cook@gmaill.com', 'tim', '$2y$10$JugWmSgJhRrLEGymaO3cp.wCCzVh5GXBN6xUucWGBGuCOy.ql4voi', '2022-04-24 08:11:40', '2022-04-24 08:11:40');

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
-- Index pour la table `customer`
--
ALTER TABLE `customer`
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
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `universe`
--
ALTER TABLE `universe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
