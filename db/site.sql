-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 01 Mai 2015 à 13:12
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `site`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categorieId` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(50) NOT NULL,
  `parent` varchar(50) DEFAULT '0',
  PRIMARY KEY (`categorieId`),
  UNIQUE KEY `categorie` (`categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`categorieId`, `categorie`, `parent`) VALUES
(17, 'TELEPHONE SMARTPHONE', '0'),
(18, 'PC PORTABLES', '0'),
(21, 'SUMSANG GALAXY', '17'),
(22, 'IPHONE', '17'),
(23, 'SONY EXPIRIA', '17'),
(24, 'LG', '17'),
(25, 'NOKIA', '17'),
(26, 'HTC', '17'),
(28, 'SUMSANG', '18'),
(29, 'PHOTO et CAMESCOPE', '0'),
(30, 'CANON', '29'),
(31, 'TABLETTE', '0'),
(32, 'NIKON', '29'),
(33, 'SONY Vaio', '18'),
(34, 'TOSHIBA', '18'),
(35, 'HP', '18'),
(36, 'SAMSUNG TAB', '31');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `codeClient` int(11) NOT NULL AUTO_INCREMENT,
  `civilite` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  `telephone` varchar(20) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `codepostal` varchar(5) NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `NomAdresse` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dateconnect` datetime DEFAULT CURRENT_TIMESTAMP,
  `datedisconnect` date DEFAULT NULL,
  `nbrcommandes` int(11) DEFAULT '0',
  `totalcommandes` float DEFAULT '0',
  `administrateur` int(11) DEFAULT '0',
  PRIMARY KEY (`codeClient`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`codeClient`, `civilite`, `nom`, `prenom`, `dateNaissance`, `telephone`, `ville`, `codepostal`, `Adresse`, `NomAdresse`, `Email`, `password`, `dateconnect`, `datedisconnect`, `nbrcommandes`, `totalcommandes`, `administrateur`) VALUES
(1, 'Monsieur', 'JALYL', 'Abde', '1990-03-27', '0620741867', 'Agadir', '80000', 'Erac ...', 'Maison', 'Jalyl@gmail.com', '1234', '2015-05-01 10:57:45', NULL, 3, 0, 1),
(8, 'Madame', 'Fatima', 'fatima', NULL, '0611223344', 'Agadir', '80000', 'Salam', 'Maison', 'fatima@gmail.com', '1234', '2015-04-30 12:34:36', NULL, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `numcommande` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `dateCommande` datetime DEFAULT CURRENT_TIMESTAMP,
  `totalCommande` float NOT NULL,
  PRIMARY KEY (`numcommande`),
  KEY `client` (`client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `commandes`
--

INSERT INTO `commandes` (`numcommande`, `client`, `dateCommande`, `totalCommande`) VALUES
(4, 1, '2015-04-30 10:57:50', 0),
(5, 1, '2015-04-30 11:11:29', 0),
(6, 8, '2015-04-30 13:14:25', 0),
(7, 8, '2015-04-30 13:16:04', 0),
(9, 1, '2015-04-30 21:08:25', 0);

--
-- Déclencheurs `commandes`
--
DROP TRIGGER IF EXISTS `trModifierNombreCommandesClient_AjouterCommande`;
DELIMITER //
CREATE TRIGGER `trModifierNombreCommandesClient_AjouterCommande` AFTER INSERT ON `commandes`
 FOR EACH ROW update clients set nbrcommandes = nbrcommandes + 1 Where codeClient = New.client
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trModifierNombreCommandesClient_SupprimerCommande`;
DELIMITER //
CREATE TRIGGER `trModifierNombreCommandesClient_SupprimerCommande` AFTER DELETE ON `commandes`
 FOR EACH ROW update clients set nbrcommandes = nbrcommandes - 1 Where codeClient = Old.client
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trSupprimerLignesCommande_SupprimerCommande`;
DELIMITER //
CREATE TRIGGER `trSupprimerLignesCommande_SupprimerCommande` BEFORE DELETE ON `commandes`
 FOR EACH ROW delete from lignes where numcommande = Old.numcommande
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `lignes`
--

CREATE TABLE IF NOT EXISTS `lignes` (
  `numLigne` int(11) NOT NULL AUTO_INCREMENT,
  `numCommande` int(11) DEFAULT NULL,
  `refProduit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `totalLigne` float DEFAULT NULL,
  PRIMARY KEY (`numLigne`),
  KEY `numCommande` (`numCommande`),
  KEY `refProduit` (`refProduit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `lignes`
--

INSERT INTO `lignes` (`numLigne`, `numCommande`, `refProduit`, `quantite`, `totalLigne`) VALUES
(6, 4, 9, 2, NULL),
(7, 4, 10, 1, NULL),
(8, 4, 11, 1, NULL),
(9, 4, 16, 1, NULL),
(10, 5, 16, 1, NULL),
(11, 5, 23, 2, NULL),
(12, 5, 22, 2, NULL),
(13, 5, 23, 2, NULL),
(14, 5, 9, 1, NULL),
(15, 5, 20, 1, NULL),
(16, 5, 23, 1, NULL),
(17, 6, 9, 1, NULL),
(18, 6, 10, 1, NULL),
(19, 6, 11, 1, NULL),
(20, 7, 9, 1, NULL),
(21, 7, 10, 1, NULL),
(22, 9, 23, 1, NULL),
(23, 9, 22, 1, NULL),
(24, 9, 9, 2, NULL);

--
-- Déclencheurs `lignes`
--
DROP TRIGGER IF EXISTS `trModifierStockProduit_AjouterLigne`;
DELIMITER //
CREATE TRIGGER `trModifierStockProduit_AjouterLigne` AFTER INSERT ON `lignes`
 FOR EACH ROW Update produits set stock = stock - New.quantite Where reference = New.refProduit
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trModifierStockProduit_ModifierLigne`;
DELIMITER //
CREATE TRIGGER `trModifierStockProduit_ModifierLigne` AFTER UPDATE ON `lignes`
 FOR EACH ROW update produits set stock = (stock - ( New.quantite - Old.quantite))
where reference = Old.refProduit
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trModifierStockProduit_SupprimerLigne`;
DELIMITER //
CREATE TRIGGER `trModifierStockProduit_SupprimerLigne` AFTER DELETE ON `lignes`
 FOR EACH ROW update produits set stock = stock + Old.quantite Where reference = Old.refProduit
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `lignessession`
--

CREATE TABLE IF NOT EXISTS `lignessession` (
  `numligne` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) DEFAULT NULL,
  `ref` int(11) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  PRIMARY KEY (`numligne`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE IF NOT EXISTS `marques` (
  `marqueId` int(11) NOT NULL AUTO_INCREMENT,
  `marque` varchar(50) NOT NULL,
  PRIMARY KEY (`marqueId`),
  UNIQUE KEY `marque` (`marque`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `marques`
--

INSERT INTO `marques` (`marqueId`, `marque`) VALUES
(12, 'APPLE'),
(5, 'CANON'),
(8, 'GALAXY TAB'),
(6, 'HP'),
(9, 'LENOVO'),
(10, 'NIKON'),
(4, 'SAMSUNG'),
(7, 'SONY'),
(11, 'TOSHIBA');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `reference` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `prixunitaire` float NOT NULL,
  `stock` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `marque` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`reference`),
  KEY `categorie` (`categorie`),
  KEY `marque` (`marque`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`reference`, `designation`, `prixunitaire`, `stock`, `categorie`, `marque`, `image`) VALUES
(9, ' Galaxy s5690 xcover', 1500, 13, 21, 4, 'fr_GT-S5690TAAORC_001_Front.jpg'),
(10, 'Samsung I9505 Galaxy S4', 3500, 12, 21, 4, 'gal_01.jpg'),
(11, 'Galaxy Note II', 3000, 8, 21, 4, 'GALAXY-Note-II-Product-Image-5.jpg'),
(16, 'IPhone 4s Noir', 2000, 18, 22, 12, 'Iphone4s.jpg'),
(17, 'IPhone 6', 6000, 15, 22, 12, 'iphone 6.jpg'),
(18, 'IPhone 5', 4000, 10, 22, 12, 'Iphone5.jpg'),
(20, 'HP SlateBook 14', 3999.99, 9, 35, 6, 'hp-slatebook-14-3.jpg'),
(21, 'Samsung Note PRO', 7690.99, 10, 36, 4, 'tablette1.jpg'),
(22, 'Samsung Galaxy S3 Mini', 1600, 27, 21, 4, '1207_samsung_galaxy_s3_mini_logo.jpg'),
(23, 'Samsung S6802', 1000, 34, 21, 4, 's6802.jpg'),
(24, 'Samsung Galaxy S Duos', 1200, 20, 21, 4, 'Samsung-Galaxy-S-Duos-2-MObile-LatestPriceinIndia.com_.jpg'),
(25, 'Samsung Star 3', 800, 30, 21, 4, 'be-fr_GT-S5220XKABSE_001_Front.jpg'),
(26, 'Samsung Galaxy Ace 4', 2000, 20, 21, 4, 'samsung-galaxy-ace-4_5bf86e3e02599e8a.jpg'),
(27, 'Samsung Galaxy Ace 4', 2000, 15, 21, 4, 'ace 4.jpg'),
(28, 'Samsung Galaxy S2 Plus', 2000, 20, 21, 4, '41gTlCsdVDL._SY300_.jpg'),
(29, 'Samsung Galaxy S2', 1500, 30, 21, 4, 'samsung-galaxy-s2-plus-i9105-blanc.jpg');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vproduitcommande`
--
CREATE TABLE IF NOT EXISTS `vproduitcommande` (
`numcommande` int(11)
,`datecommande` datetime
,`reference` int(11)
,`image` varchar(100)
,`designation` varchar(50)
,`prixunitaire` float
,`quantite` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vproduitlignessession`
--
CREATE TABLE IF NOT EXISTS `vproduitlignessession` (
`reference` int(11)
,`designation` varchar(50)
,`prixunitaire` float
,`image` varchar(100)
,`marque` int(11)
,`stock` int(11)
,`categorie` int(11)
,`qte` int(11)
,`session_id` varchar(100)
);
-- --------------------------------------------------------

--
-- Structure de la vue `vproduitcommande`
--
DROP TABLE IF EXISTS `vproduitcommande`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vproduitcommande` AS select `c`.`numcommande` AS `numcommande`,`c`.`dateCommande` AS `datecommande`,`p`.`reference` AS `reference`,`p`.`image` AS `image`,`p`.`designation` AS `designation`,`p`.`prixunitaire` AS `prixunitaire`,`l`.`quantite` AS `quantite` from ((`commandes` `c` join `produits` `p`) join `lignes` `l`) where ((`p`.`reference` = `l`.`refProduit`) and (`c`.`numcommande` = `l`.`numCommande`));

-- --------------------------------------------------------

--
-- Structure de la vue `vproduitlignessession`
--
DROP TABLE IF EXISTS `vproduitlignessession`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vproduitlignessession` AS select `p`.`reference` AS `reference`,`p`.`designation` AS `designation`,`p`.`prixunitaire` AS `prixunitaire`,`p`.`image` AS `image`,`p`.`marque` AS `marque`,`p`.`stock` AS `stock`,`p`.`categorie` AS `categorie`,`ls`.`qte` AS `qte`,`ls`.`session_id` AS `session_id` from (`produits` `p` join `lignessession` `ls`) where (`p`.`reference` = `ls`.`ref`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`client`) REFERENCES `clients` (`codeClient`);

--
-- Contraintes pour la table `lignes`
--
ALTER TABLE `lignes`
  ADD CONSTRAINT `lignes_ibfk_1` FOREIGN KEY (`numCommande`) REFERENCES `commandes` (`numcommande`),
  ADD CONSTRAINT `lignes_ibfk_2` FOREIGN KEY (`refProduit`) REFERENCES `produits` (`reference`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categories` (`categorieId`),
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`marque`) REFERENCES `marques` (`marqueId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
