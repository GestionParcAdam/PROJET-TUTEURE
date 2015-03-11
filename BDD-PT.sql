-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 11 Mars 2015 à 15:07
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gestionparcinfo`
--

--
-- Contenu de la table `caracteristique`
--

INSERT INTO `caracteristique` (`id`, `numCaracCom_id`, `numCaracRes_id`) VALUES
(1, 1, 1),
(2, 11, 2),
(3, 12, 3),
(4, 15, 6),
(5, 16, 7),
(6, 17, 8),
(7, 18, 9),
(8, 19, 10),
(9, 20, 11),
(10, 21, 12),
(11, 22, 13),
(12, 23, 14),
(13, 24, 15),
(14, 25, 16),
(15, 26, 17),
(16, 27, 18),
(17, 28, 19),
(18, 29, 20),
(19, 30, 21),
(20, 31, 22);

--
-- Contenu de la table `caracteristiquecom`
--

INSERT INTO `caracteristiquecom` (`id`, `dateAchat`, `prixAchat`, `numFacture`, `libelleModele`, `numImmo`, `numFabricant_id`, `numRevendeur_id`) VALUES
(1, '2015-01-30', '123', '125456', 'ORDI2', '12345654848', 3, 3),
(2, '0000-00-00', '12', '', 'Numero2', '182', 1, 1),
(3, '2012-12-13', '12', '', 'Numero2', '182', 1, 1),
(4, '2015-01-15', '1', '1', '1', '1', 1, 1),
(5, '2015-01-15', '1', '1', '1', '1', 1, 1),
(6, '2015-01-15', '1', '1', '1', '1', 1, 1),
(7, '2015-01-15', '1', '1', '1', '1', 1, 1),
(8, '2015-01-15', '1', '1', '1', '1', 1, 1),
(9, '2015-01-15', '1', '1', '1', '1', 1, 1),
(10, '2015-01-15', '100', '1', '1', '1', 1, 1),
(11, '2015-01-15', '100', '1', '1', '1', 1, 1),
(12, '2015-01-15', '1', '1', '1', '1', 1, 1),
(13, '2015-01-15', '1', '1', '1', '1', 1, 1),
(14, '2015-01-15', '1', '1', '1', '1', 1, 1),
(15, '2015-01-15', '1', '1', '1', '1', 1, 1),
(16, '2015-01-15', '100', '1', '1', '1', 1, 1),
(17, '2015-01-15', '100', '1', '1', '1', 1, 1),
(18, '2015-01-15', '1', '1', '1', '1', 1, 1),
(19, '2015-01-15', '1', '1', '1', '1', 1, 1),
(20, '2015-01-15', '1', '1', '1', '1', 1, 1),
(21, '2015-01-15', '1', '1', '1', '1', 1, 1),
(22, '2015-01-15', '1', '1', '1', '1', 1, 1),
(23, '2015-01-31', '1', '1', '1', '1', 1, 1),
(24, '2015-01-16', '1', '1', '1', '1', 1, 1),
(25, '2015-01-16', '1', '1', '1', '1', 1, 1),
(26, '2015-02-09', '1', '1', '1', '1', 1, 1),
(27, '2015-02-09', '1', '1', '1', '1', 1, 1),
(28, '2015-02-09', '1', '1', '1', '1', 1, 1),
(29, '2015-02-09', '1', '1', '1', '1', 1, 1),
(30, '2015-02-11', '0', '0', '0', '0', 1, 1),
(31, '2015-02-13', '1', '1', '1', '1', 1, 1);

--
-- Contenu de la table `caracteristiquelog`
--

INSERT INTO `caracteristiquelog` (`id`, `carac_id`, `nomLog`, `nomEditeur`, `versionLog`, `licence`) VALUES
(1, NULL, 'windows Xp', 'Microsoft', 'service pack 3', '00371-701-7029433-06381'),
(2, 2, 'log1', 'log1', 'log1', 'log1'),
(3, 2, 'log1', 'log1', 'log1', 'log1'),
(4, 2, 'log1', 'log1', 'log1', 'log1'),
(5, 2, 'log1', 'log1', 'log1', 'log1'),
(6, 2, 'log2', 'log2', 'log2', 'log2'),
(7, 2, 'log2', 'log2', 'log2', 'log2'),
(8, 2, 'log2', 'log2', 'log2', 'log2'),
(9, 2, 'log2', 'log2', 'log2', 'log2'),
(10, 3, 'logiciel1', 'logiciel1', 'logiciel1', 'logiciel1'),
(11, 3, 'logiciel1', 'logiciel1', 'logiciel1', 'logiciel1'),
(12, 3, 'logiciel1', 'logiciel1', 'logiciel1', 'logiciel1'),
(13, 3, 'logiciel1', 'logiciel1', 'logiciel1', 'logiciel1'),
(14, 3, 'logiciel2', 'logiciel2', 'logiciel2', 'logiciel2'),
(15, 3, 'logiciel2', 'logiciel2', 'logiciel2', 'logiciel2'),
(16, 3, 'logiciel2', 'logiciel2', 'logiciel2', 'logiciel2'),
(17, 3, 'logiciel2', 'logiciel2', 'logiciel2', 'logiciel2'),
(18, 4, 'Microsoft', 'office', '1.2', '123456'),
(19, 4, 'APPLE', 'OS', '1.2', '1254681'),
(20, 5, 'microsoft', '1', '1', '1'),
(21, 5, 'TOTO', '1', '1', '1'),
(22, 7, 'toto', '1', '1', '1'),
(23, 8, 'Micro', 'editeur', '1', '1'),
(24, 9, 'Micro', 'editeur', '1', '1'),
(25, 10, 'Micro', 'editeur', '1', '1'),
(26, 11, 'uoifze', 'fezgz', 'teztez', 'teztz'),
(27, 11, 'getherhet266262', '62ze21ez6', '2e6zrze62', '26ez26rz'),
(28, 12, '1', '1', '1', '1'),
(29, 13, '1', '1', '1', '1'),
(30, 14, '1', '1', '1', '1'),
(31, 14, '2', '2', '2', '1'),
(32, 15, '1', '1', '1', '1'),
(33, 17, '1', '1', '1', '1'),
(34, 18, '1', '1', '1', '1'),
(37, 19, '1', '1', '1', '1'),
(38, 20, '1', '1', '1', '1');

--
-- Contenu de la table `caracteristiqueres`
--

INSERT INTO `caracteristiqueres` (`id`, `adressIp`, `adressMac`, `adressPasserelle`) VALUES
(1, '8.8.8.8', '6f:2d:63:98:a8:ae', '192.168.0.254'),
(2, '8.8.8.8', '1', '1'),
(3, '8.8.8.8', '1', '1'),
(4, '1', '1', '1'),
(5, '1', '1', '1'),
(6, '1', '1', '1'),
(7, '1', '1', '1'),
(8, '1', '1', '1'),
(9, '1', '1', '1'),
(10, '1', '1', '1'),
(11, '1', '1', '1'),
(12, '1', '1', '1'),
(13, '1', '1', '1'),
(14, '1', '1', '1'),
(15, '1', '1', '1'),
(16, '8.8.8.8', '1', '1'),
(17, '192.168.1.1', 'ee:ee:ee:ee:ee', '192.168.1.254'),
(18, '192.168.1.1', 'ee:ee:ee:ee:ee', '192.168.1.254'),
(19, '1', '1', '1'),
(20, '1', '1', '1'),
(21, '0', '0', '0'),
(22, '1', 'ee:ee:ee:ee:ee', '1');

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
(3, 'ACER'),
(4, 'MSI');

--
-- Contenu de la table `historique`
--

INSERT INTO `historique` (`id`, `materiel_id`, `dateIntervention`, `objet_intervention`, `desc_intervention`, `prestataire_intervention`, `cout_intervention`) VALUES
(1, 5, '2015-01-15', '1', '1', '1', '1'),
(2, 6, '2015-01-15', '1', '1', '1', '1'),
(3, 7, '2015-01-15', '1', '1', '1', '1'),
(4, 13, '2015-01-31', '1er', '1', '1', '1'),
(5, 14, '2015-01-15', '1ermaintenance', '15115', '115', '651'),
(6, 15, '2015-01-16', '1er', '1', '1', '1'),
(7, 15, '2015-01-16', '2eme', '21', '2', '2'),
(8, 16, '2015-01-16', '1er', '1', '1', '1'),
(9, 16, '2015-01-16', '2eme', '2', '1', '2'),
(10, 17, '2015-01-16', '1er', '1', '1', '1'),
(11, 17, '2015-01-16', '2eme', '2', '2', '2'),
(12, 18, '2015-02-09', '1', '1', '1', '1'),
(13, 20, '2015-02-09', '1', '1', '1', '1'),
(14, 21, '2015-02-09', '1', '1', '1', '1'),
(17, 22, '2015-02-12', '0', '0', '0', '0'),
(18, 23, '2015-02-13', '1', '1', '1', '1');

--
-- Contenu de la table `materiel`
--

INSERT INTO `materiel` (`id`, `nom_mat`, `date_garantie`, `dateLastModif`, `numSite_id`, `numEtat_id`, `numStatut_id`, `numCarac_id`, `numType_id`) VALUES
(1, 'PC-Fabien', '2015-01-30', '2015-02-07', 4, 1, 2, 1, 1),
(2, 'PC-Germain', '2014-12-30', '0000-00-00', 3, 1, 3, NULL, 1),
(3, 'pczizou', '2015-01-02', '2015-01-06', 3, 2, 1, NULL, 1),
(4, 'pcleo', '2015-01-01', '2015-01-01', 3, 2, 1, NULL, 1),
(5, 'TESTETERETET9', '2015-01-31', '2015-01-30', 1, 1, 1, 2, 4),
(6, 'TESTQUIMARCHE', '2015-01-31', '2015-03-08', 1, 2, 1, 3, 1),
(7, 'MULTILOGICIEL', '2015-01-31', '2015-02-13', 1, 3, 1, 4, 1),
(8, 'TESTMULTIMAINT', '2015-01-31', '2015-01-15', 1, 1, 1, 5, 1),
(9, 'TESTMULTIMAINT', '2015-01-31', '2015-01-15', 1, 1, 1, 6, 1),
(10, 'TPTP', '2015-01-31', '2015-01-15', 1, 1, 1, 7, 1),
(11, 'BIDULE', '2015-01-31', '2015-01-15', 1, 1, 1, 8, 1),
(12, 'BIDULE', '2015-01-31', '2015-01-15', 1, 1, 1, 9, 1),
(13, 'BIDULE', '2015-01-31', '2015-01-15', 1, 1, 1, 10, 1),
(14, 'TESTMAINENANCE', '2015-01-31', '2015-01-15', 1, 1, 1, 11, 1),
(15, 'MAINTENANCEMULTIPLE', '2015-01-31', '2015-01-16', 1, 1, 1, 12, 1),
(16, 'MAINTENANCEMULTIPLE2', '2015-01-31', '2015-01-16', 1, 1, 1, 13, 1),
(17, 'blabla', '2015-01-31', '2015-01-16', 1, 1, 1, 14, 1),
(18, 'testAjout', '2015-02-09', '2015-02-09', 1, 1, 1, 15, 1),
(19, 'testAjout', '2015-02-09', '2015-02-09', 1, 1, 1, 16, 1),
(20, 'testAjout2', '2015-02-09', '2015-02-09', 1, 1, 1, 17, 1),
(21, 'TestPC3', '2015-02-09', '2015-02-09', 1, 2, 1, 18, 1),
(22, 'testAjax', '2015-02-13', '2015-02-11', 1, 1, 1, 19, 1),
(23, 'PC-HS', '2015-02-13', '2015-02-13', 3, 1, 1, 20, 1);

--
-- Contenu de la table `revendeur`
--

INSERT INTO `revendeur` (`id`, `nomRevendeur`) VALUES
(1, 'FNAC'),
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
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'root', 'root', 'root@wanadoo.fr', 'root@wanadoo.fr', 1, 'hjixanyw19ckwo0okccwgw4gcg840oc', 'rptg1TaLK+skI94wcu72OrkoKbNOq/b7kLp70oXGWlCrwXlgW0lo/+PT6z0YTBthCC4AXlkM7FgEt3SUKVBt0A==', '2015-03-09 11:50:59', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL);

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom_user`) VALUES
(2, 'germain'),
(3, 'User1111'),
(4, 'User2222'),
(5, 'USR1'),
(7, 'USrzaer'),
(8, 'fabien');

--
-- Contenu de la table `utilisateurs_materiels`
--

INSERT INTO `utilisateurs_materiels` (`materiel_id`, `utilisateur_id`) VALUES
(5, 2),
(6, 3),
(6, 4),
(7, 5),
(8, 7),
(22, 2),
(22, 5),
(22, 8),
(23, 2),
(23, 8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
