-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 12 Janvier 2015 à 14:47
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gestionparcinfo`
--
CREATE DATABASE IF NOT EXISTS `gestionparcinfo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gestionparcinfo`;

-- --------------------------------------------------------

--
-- Structure de la table `affecte`
--

CREATE TABLE IF NOT EXISTS `affecte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numUser_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_872D947428C15A32` (`numUser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `caracteristique`
--

CREATE TABLE IF NOT EXISTS `caracteristique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numCaracCom_id` int(11) NOT NULL,
  `numCaracLog_id` int(11) NOT NULL,
  `numCaracRes_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_598A80154CFCA713` (`numCaracCom_id`),
  KEY `IDX_598A8015D217F5A2` (`numCaracLog_id`),
  KEY `IDX_598A80157E004E20` (`numCaracRes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiquecom`
--

CREATE TABLE IF NOT EXISTS `caracteristiquecom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateAchat` date NOT NULL,
  `prixAchat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `libelleModele` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numImmo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `caracteristiquecom`
--

INSERT INTO `caracteristiquecom` (`id`, `dateAchat`, `prixAchat`, `libelleModele`, `numImmo`) VALUES
(1, '0000-00-00', '123', 'ORDI1', '123'),
(2, '0000-00-00', '12', 'Numero2', '182'),
(3, '2012-12-13', '12', 'Numero2', '182');

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiquelog`
--

CREATE TABLE IF NOT EXISTS `caracteristiquelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomLog` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `versionLog` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numFabricant_id` int(11) NOT NULL,
  `numRevendeur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9B71BD92F7C38E5D` (`numFabricant_id`),
  KEY `IDX_9B71BD92C848A9B8` (`numRevendeur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiqueres`
--

CREATE TABLE IF NOT EXISTS `caracteristiqueres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adressIp` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `adressMac` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `adressPasserelle` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_etat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle_etat`) VALUES
(1, 'En service'),
(2, 'Hors service'),
(3, 'En Panne');

-- --------------------------------------------------------

--
-- Structure de la table `fabricant`
--

CREATE TABLE IF NOT EXISTS `fabricant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomFabricant` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `fabricant`
--

INSERT INTO `fabricant` (`id`, `nomFabricant`) VALUES
(1, 'HP'),
(2, 'Tochiba'),
(3, 'ACER'),
(4, 'MSI');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE IF NOT EXISTS `historique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateIntervention` date NOT NULL,
  `objet_intervention` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc_intervention` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prestataire_intervention` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cout_intervention` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE IF NOT EXISTS `materiel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_mat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_garantie` date NOT NULL,
  `numSite_id` int(11) NOT NULL,
  `numEtat_id` int(11) NOT NULL,
  `numStatut_id` int(11) NOT NULL,
  `numHistorique_id` int(11) DEFAULT NULL,
  `numCarac_id` int(11) DEFAULT NULL,
  `numType_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_18D2B09179129FE1` (`numSite_id`),
  KEY `IDX_18D2B09182F10F58` (`numEtat_id`),
  KEY `IDX_18D2B0918302A601` (`numStatut_id`),
  KEY `IDX_18D2B09126A6D505` (`numHistorique_id`),
  KEY `IDX_18D2B091C91105A` (`numCarac_id`),
  KEY `IDX_18D2B0914AE30534` (`numType_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `materiel`
--

INSERT INTO `materiel` (`id`, `nom_mat`, `date_garantie`, `numSite_id`, `numEtat_id`, `numStatut_id`, `numHistorique_id`, `numCarac_id`, `numType_id`) VALUES
(1, 'PC-Fabien', '2014-12-26', 5, 2, 2, NULL, NULL, NULL),
(2, 'PC-Germain', '2014-12-30', 3, 1, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `revendeur`
--

CREATE TABLE IF NOT EXISTS `revendeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomRevendeur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `revendeur`
--

INSERT INTO `revendeur` (`id`, `nomRevendeur`) VALUES
(1, 'FNAC'),
(2, 'BOULANGER'),
(3, 'AMAZON');

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_site` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adresse_site` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `site`
--

INSERT INTO `site` (`id`, `nom_site`, `adresse_site`) VALUES
(1, 'Agen', ''),
(2, 'Bordeaux', ''),
(3, 'Limoges', ''),
(4, 'St Agnant de Versillat', ''),
(5, 'Châteauroux', ''),
(6, 'Guéret', ''),
(7, 'Montluçon', ''),
(8, 'St Junien', '');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE IF NOT EXISTS `statut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_statut` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `statut`
--

INSERT INTO `statut` (`id`, `libelle_statut`) VALUES
(1, 'A renouveler'),
(2, 'Sous garantie'),
(3, 'Garantie terminée');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`id`, `libelle_type`) VALUES
(1, 'Ordinateur'),
(2, 'Serveur'),
(3, 'Fax'),
(4, 'Imprimante'),
(5, 'Clé 3G'),
(7, 'Routeur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `affecte`
--
ALTER TABLE `affecte`
  ADD CONSTRAINT `FK_872D947428C15A32` FOREIGN KEY (`numUser_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `caracteristique`
--
ALTER TABLE `caracteristique`
  ADD CONSTRAINT `FK_598A80154CFCA713` FOREIGN KEY (`numCaracCom_id`) REFERENCES `caracteristiquecom` (`id`),
  ADD CONSTRAINT `FK_598A80157E004E20` FOREIGN KEY (`numCaracRes_id`) REFERENCES `caracteristiqueres` (`id`),
  ADD CONSTRAINT `FK_598A8015D217F5A2` FOREIGN KEY (`numCaracLog_id`) REFERENCES `caracteristiquelog` (`id`);

--
-- Contraintes pour la table `caracteristiquelog`
--
ALTER TABLE `caracteristiquelog`
  ADD CONSTRAINT `FK_9B71BD92C848A9B8` FOREIGN KEY (`numRevendeur_id`) REFERENCES `revendeur` (`id`),
  ADD CONSTRAINT `FK_9B71BD92F7C38E5D` FOREIGN KEY (`numFabricant_id`) REFERENCES `fabricant` (`id`);

--
-- Contraintes pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD CONSTRAINT `FK_18D2B09126A6D505` FOREIGN KEY (`numHistorique_id`) REFERENCES `historique` (`id`),
  ADD CONSTRAINT `FK_18D2B0914AE30534` FOREIGN KEY (`numType_id`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `FK_18D2B09179129FE1` FOREIGN KEY (`numSite_id`) REFERENCES `site` (`id`),
  ADD CONSTRAINT `FK_18D2B09182F10F58` FOREIGN KEY (`numEtat_id`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `FK_18D2B0918302A601` FOREIGN KEY (`numStatut_id`) REFERENCES `statut` (`id`),
  ADD CONSTRAINT `FK_18D2B091C91105A` FOREIGN KEY (`numCarac_id`) REFERENCES `caracteristique` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
