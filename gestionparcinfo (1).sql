-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 13 Janvier 2015 à 16:13
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

--
-- Contenu de la table `caracteristique`
--

INSERT INTO `caracteristique` (`id`, `numCaracCom_id`, `numCaracLog_id`, `numCaracRes_id`) VALUES
(1, 1, 1, 1);

--
-- Contenu de la table `caracteristiquecom`
--

INSERT INTO `caracteristiquecom` (`id`, `dateAchat`, `prixAchat`, `libelleModele`, `numImmo`, `numFabricant_id`, `numRevendeur_id`) VALUES
(1, '0000-00-00', '123', 'ORDI1', '123', 1, 1),
(2, '0000-00-00', '12', 'Numero2', '182', 1, 1),
(3, '2012-12-13', '12', 'Numero2', '182', 1, 1);

--
-- Contenu de la table `caracteristiquelog`
--

INSERT INTO `caracteristiquelog` (`id`, `nomLog`, `nomEditeur`, `versionLog`, `licence`) VALUES
(1, 'windows Xp', 'Microsoft', 'service pack 3', '00371-701-7029433-06381');

--
-- Contenu de la table `caracteristiqueres`
--

INSERT INTO `caracteristiqueres` (`id`, `adressIp`, `adressMac`, `adressPasserelle`) VALUES
(1, '192.168.0.23', '6f:2d:63:98:a8:ae', '192.168.0.254');

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle_etat`) VALUES
(1, 'En service'),
(2, 'Hors service'),
(3, 'En Panne');

--
-- Contenu de la table `fabricant`
--

INSERT INTO `fabricant` (`id`, `nomFabricant`) VALUES
(1, 'HP'),
(2, 'Tochiba'),
(3, 'ACER'),
(4, 'MSI');

--
-- Contenu de la table `historique`
--

INSERT INTO `historique` (`id`, `dateIntervention`, `objet_intervention`, `desc_intervention`, `prestataire_intervention`, `cout_intervention`, `materiel_id`) VALUES
(1, '2015-01-13', 'probleme logiciel', 'modification des variable environement', 'sas berger', '866', 1);

--
-- Contenu de la table `materiel`
--

INSERT INTO `materiel` (`id`, `nom_mat`, `date_garantie`, `dateLastModif`, `numSite_id`, `numEtat_id`, `numStatut_id`, `numCarac_id`, `numType_id`) VALUES
(1, 'PC-Fabien', '2014-12-26', '0000-00-00', 5, 2, 2, 1, 1),
(2, 'PC-Germain', '2014-12-30', '0000-00-00', 3, 1, 3, NULL, 1),
(3, 'pczizou', '2015-01-02', '2015-01-06', 3, 2, 1, NULL, 1),
(4, 'pcleo', '2015-01-01', '2015-01-01', 3, 2, 1, NULL, 1);

--
-- Contenu de la table `revendeur`
--

INSERT INTO `revendeur` (`id`, `nomRevendeur`) VALUES
(1, 'FNAC'),
(2, 'BOULANGER'),
(3, 'AMAZON');

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

--
-- Contenu de la table `statut`
--

INSERT INTO `statut` (`id`, `libelle_statut`) VALUES
(1, 'A renouveler'),
(2, 'Sous garantie'),
(3, 'Garantie terminée');

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

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom_user`) VALUES
(1, 'Quentin'),
(2, 'Fabien');

--
-- Contenu de la table `utilisateurs_materiels`
--

INSERT INTO `utilisateurs_materiels` (`materiel_id`, `utilisateur_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
