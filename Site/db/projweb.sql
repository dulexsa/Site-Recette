-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 10 Mai 2017 à 11:58
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projweb`
--
CREATE DATABASE projweb;
USE projweb;

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie`
--

CREATE TABLE IF NOT EXISTS `t_categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `catNom` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategorie`),
  UNIQUE KEY `catNom` (`catNom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `t_categorie`
--

INSERT INTO `t_categorie` (`idCategorie`, `catNom`) VALUES
(5, 'Autre'),
(3, 'Cuisine'),
(2, 'Jeu-vidéo'),
(4, 'Musique'),
(1, 'Voyage');

-- --------------------------------------------------------

--
-- Structure de la table `t_cif`
--

CREATE TABLE IF NOT EXISTS `t_cif` (
  `idCIF` int(11) NOT NULL AUTO_INCREMENT,
  `cifNom` varchar(50) DEFAULT NULL,
  `cifDescription` varchar(255) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  `cifEval` tinyint(1) NOT NULL,
  `cifEvalUtil` float NOT NULL DEFAULT '0',
  `cifNbEval` smallint(6) NOT NULL DEFAULT '0',
  `cifCheminImage` varchar(100) NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCIF`),
  KEY `FK_t_cif_idUtilisateur` (`idUtilisateur`),
  KEY `FK_t_cif_idCategorie` (`idCategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Contenu de la table `t_cif`
--

INSERT INTO `t_cif` (`idCIF`, `cifNom`, `cifDescription`, `idCategorie`, `cifEval`, `cifEvalUtil`, `cifNbEval`, `cifCheminImage`, `idUtilisateur`) VALUES
(69, 'Aller voir les manchots', 'Aller en Antarctique afin de voir les différentes espèce d''animaux qui y vivent.', 1, 5, 3, 4, 'CIF_du_20170510102333.jpg', 18),
(70, 'Jouer à Rainbow Six Siege', 'Jouer au jeu de la saga Rainbow', 2, 4, 3.14286, 7, 'CIF_du_20170510102707.jpg', 18);

-- --------------------------------------------------------

--
-- Structure de la table `t_objet`
--

CREATE TABLE IF NOT EXISTS `t_objet` (
  `idObjet` int(11) NOT NULL AUTO_INCREMENT,
  `objNom` varchar(25) DEFAULT NULL,
  `objDescription` varchar(255) DEFAULT NULL,
  `idCIF` int(11) DEFAULT NULL,
  PRIMARY KEY (`idObjet`),
  KEY `FK_t_objet_idCIF` (`idCIF`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

--
-- Contenu de la table `t_objet`
--

INSERT INTO `t_objet` (`idObjet`, `objNom`, `objDescription`, `idCIF`) VALUES
(94, 'Des manchots', 'Le Manchot empereur (Aptenodytes forsteri), oiseau endémique de l''Antarctique, est le plus grand et le plus lourd de tous les manchots.', 69),
(95, 'Un pc', 'Un pc très puissant qui peut faire tourner les derniers jeux', 70);

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateur`
--

CREATE TABLE IF NOT EXISTS `t_utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `utiNom` varchar(50) DEFAULT NULL,
  `utiPrenom` varchar(50) DEFAULT NULL,
  `utiPseudo` varchar(25) DEFAULT NULL,
  `utiMDP` varchar(90) DEFAULT NULL,
  `utiEmail` varchar(50) DEFAULT NULL,
  `utiInscription` date DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `utiEmail` (`utiEmail`),
  UNIQUE KEY `utiPseudo` (`utiPseudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `t_utilisateur`
--

INSERT INTO `t_utilisateur` (`idUtilisateur`, `utiNom`, `utiPrenom`, `utiPseudo`, `utiMDP`, `utiEmail`, `utiInscription`) VALUES
(18, 'Dulex', 'Samuel', 'dulexsa', '$2y$10$/tLwbJ/iiBY.Rialm7pT0.8ZO/RHZbdiEB7CAoWqbb7rIs9pOQJcC', 'dulexsa@etml.educanet2.ch', '2017-05-10'),
(20, 'Dulex', 'Samuel', 'Test', '$2y$10$QK8OVeemWGcagUFhjpOhS..QpEC5c7Y6B26b8iX25m88VaRRLqrQW', 'samuel.dulex@nfdks.ch', '2017-05-10');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_cif`
--
ALTER TABLE `t_cif`
  ADD CONSTRAINT `FK_t_cif_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `t_utilisateur` (`idUtilisateur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_t_cif_idCategorie` FOREIGN KEY (`idCategorie`) REFERENCES `t_categorie` (`idCategorie`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_objet`
--
ALTER TABLE `t_objet`
  ADD CONSTRAINT `FK_t_objet_idCIF` FOREIGN KEY (`idCIF`) REFERENCES `t_cif` (`idCIF`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
