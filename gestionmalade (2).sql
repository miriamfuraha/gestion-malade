-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 sep. 2022 à 08:55
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionmalade`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `idag` int(11) NOT NULL AUTO_INCREMENT,
  `nomsagent` varchar(25) NOT NULL,
  `sexeag` varchar(10) NOT NULL,
  `phoneag` varchar(20) NOT NULL,
  `serviceag` varchar(25) NOT NULL,
  PRIMARY KEY (`idag`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`idag`, `nomsagent`, `sexeag`, `phoneag`, `serviceag`) VALUES
(1, 'Samuel maliro erick', 'M', '0974567567', 'comptabilitÃ©'),
(3, 'wera matabaro sandra', 'F', '0899876567', 'comptailite');

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `idchambre` int(11) NOT NULL AUTO_INCREMENT,
  `designationchambre` varchar(35) NOT NULL,
  `prixchambre` int(10) NOT NULL,
  `categoriechambre` varchar(10) NOT NULL,
  PRIMARY KEY (`idchambre`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`idchambre`, `designationchambre`, `prixchambre`, `categoriechambre`) VALUES
(1, 'acouchement', 100, 'privee'),
(19, 'salle de rÃ©animation', 3, 'privÃ©e'),
(20, 'salle des femmes', 20, 'commune');

-- --------------------------------------------------------

--
-- Structure de la table `consommer`
--

DROP TABLE IF EXISTS `consommer`;
CREATE TABLE IF NOT EXISTS `consommer` (
  `idconsommer` int(11) NOT NULL AUTO_INCREMENT,
  `idmala` int(11) NOT NULL,
  `idmedi` int(11) NOT NULL,
  `qteconsom` int(10) NOT NULL,
  `dateconsom` date NOT NULL,
  PRIMARY KEY (`idconsommer`),
  KEY `fk_malade3` (`idmala`),
  KEY `fk_medicament` (`idmedi`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `consommer`
--

INSERT INTO `consommer` (`idconsommer`, `idmala`, `idmedi`, `qteconsom`, `dateconsom`) VALUES
(13, 4, 1, 23, '2022-09-24'),
(14, 5, 17, 2, '2022-09-14'),
(15, 1, 17, 3, '2022-09-25'),
(16, 6, 17, 3, '2022-09-25'),
(17, 7, 1, 12, '2022-09-16');

-- --------------------------------------------------------

--
-- Structure de la table `consulter`
--

DROP TABLE IF EXISTS `consulter`;
CREATE TABLE IF NOT EXISTS `consulter` (
  `idconsulter` int(11) NOT NULL AUTO_INCREMENT,
  `idmala` int(11) NOT NULL,
  `idmed` int(11) NOT NULL,
  `symptome` varchar(200) NOT NULL,
  `diagnostic` varchar(200) NOT NULL,
  `dateconsultation` date NOT NULL,
  PRIMARY KEY (`idconsulter`),
  KEY `idmala` (`idmala`),
  KEY `idmed` (`idmed`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `consulter`
--

INSERT INTO `consulter` (`idconsulter`, `idmala`, `idmed`, `symptome`, `diagnostic`, `dateconsultation`) VALUES
(1, 1, 1, 'toux et vomissement ', 'nous proposons la patiente Furaha de faire un test de karuho', '2022-09-09'),
(6, 4, 23, 'Apparition de la fiÃ¨vre, La toux prolongÃ©e, Manque d\'appÃ©tit, La grippe ', 'Nous supposons que le patient paul souffre de la malaria, il va faire un prÃ©lÃ¨vement du sang', '2022-09-16'),
(8, 5, 23, 'Augmentation de la fiÃ¨vre', 'le patient geremi souffre de la typhoÃ¯de   ', '2022-09-20'),
(10, 7, 23, 'mot du dos \r\ntoux\r\nestomac', 'le poison, faire un test du poison', '2022-09-10');

-- --------------------------------------------------------

--
-- Structure de la table `interner`
--

DROP TABLE IF EXISTS `interner`;
CREATE TABLE IF NOT EXISTS `interner` (
  `idinterner` int(11) NOT NULL AUTO_INCREMENT,
  `idmala` int(11) NOT NULL,
  `idchambre` int(11) NOT NULL,
  `services` varchar(40) NOT NULL,
  `statut` varchar(40) NOT NULL,
  `dateentree` date NOT NULL,
  `datesortie` date NOT NULL,
  PRIMARY KEY (`idinterner`),
  KEY `fk_malade4` (`idmala`),
  KEY `fk_chambre` (`idchambre`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `interner`
--

INSERT INTO `interner` (`idinterner`, `idmala`, `idchambre`, `services`, `statut`, `dateentree`, `datesortie`) VALUES
(23, 4, 1, 'rrtyiii', 'sdfghj', '2022-09-25', '2022-09-29'),
(24, 1, 19, 'ERTYR', 'WFSJSI', '2022-09-17', '2022-09-21'),
(26, 5, 19, 'asdfghjk', 'Ambulatoirewertyu', '2022-09-25', '2022-09-29'),
(27, 6, 19, 'weryi', 'Ambulatoirewertyu', '2022-09-15', '2022-09-17');

-- --------------------------------------------------------

--
-- Structure de la table `malade`
--

DROP TABLE IF EXISTS `malade`;
CREATE TABLE IF NOT EXISTS `malade` (
  `idmala` int(11) NOT NULL AUTO_INCREMENT,
  `nomsmalade` varchar(25) NOT NULL,
  `datenaissancemala` date NOT NULL,
  `etatcivilmala` varchar(20) NOT NULL,
  `sexemala` varchar(10) NOT NULL,
  `professionmala` varchar(25) NOT NULL,
  `adresse` varchar(25) NOT NULL,
  `telmala` varchar(20) NOT NULL,
  `poidsmala` varchar(10) NOT NULL,
  `taillemala` varchar(10) NOT NULL,
  `tamala` varchar(10) NOT NULL,
  `frmala` varchar(10) NOT NULL,
  `fcmala` varchar(10) NOT NULL,
  `poulsmala` varchar(10) DEFAULT NULL,
  `tmala` varchar(10) NOT NULL,
  PRIMARY KEY (`idmala`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `malade`
--

INSERT INTO `malade` (`idmala`, `nomsmalade`, `datenaissancemala`, `etatcivilmala`, `sexemala`, `professionmala`, `adresse`, `telmala`, `poidsmala`, `taillemala`, `tamala`, `frmala`, `fcmala`, `poulsmala`, `tmala`) VALUES
(1, 'FURAHA BAENI esther', '2022-11-30', 'celibataire', 'F', '        -', 'Ndosho Kako 121', '0994371036', '50n', '1m30', '135mmHg', '16cycle', '75bpm', '67bpm', ' 43k'),
(4, 'ESPOIR BEBUKYA Paul', '1999-08-20', 'celibataire', 'M', '         -', 'Ndosho Kako 54', '0995434456', '60n', '1m50', '65mmHg', '60cycle', '160bpm', '60bpm', '40k'),
(5, 'GEREMI MAOMBI louis', '1996-08-12', 'mariÃ©', 'M', 'Enseignant', 'Kyeshero kituku 36', '0856453765', '58n', '1M65', '120mmHg', '65cycle', '60bpm', '67bpm', '42k'),
(6, 'DEBORA KANDEKE Lynda', '2004-06-08', 'celibataire', 'F', '-', 'Katoy av. de technicien', '0973245345', '49n', '1m50', '65mmHg', '16cycle', '160bpm', '76bpm', ' 43k'),
(7, 'AMINA MAENDELEO', '2022-09-14', 'marie', 'F', 'DG', 'Ndosho Kako 50', '0972939378', '50n', '1m30', '135mmHg', '65cycle', '60bpm', '60bpm', '40k');

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `idmed` int(11) NOT NULL AUTO_INCREMENT,
  `nomsmed` varchar(25) NOT NULL,
  `sexemed` varchar(10) NOT NULL,
  `phonemed` varchar(20) NOT NULL,
  `titremed` varchar(25) NOT NULL,
  `specialitemed` varchar(25) NOT NULL,
  PRIMARY KEY (`idmed`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`idmed`, `nomsmed`, `sexemed`, `phonemed`, `titremed`, `specialitemed`) VALUES
(1, 'ROSE CHIMESHULA amina', 'M', '0977909009', 'ct', 'gynÃ©cologue'),
(23, 'BAHATI BALUME heritier', 'M', '0972020237', 'SecrÃ©taire', 'AnesthÃ©siste'),
(24, 'FAUSTIN BIRINDWA Abel', 'M', '0973567556', 'IT', 'gynÃ©cologue');

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

DROP TABLE IF EXISTS `medicament`;
CREATE TABLE IF NOT EXISTS `medicament` (
  `idmedi` int(11) NOT NULL AUTO_INCREMENT,
  `designationmedi` varchar(35) NOT NULL,
  `pumedi` int(10) NOT NULL,
  `dateexpimedi` varchar(10) NOT NULL,
  PRIMARY KEY (`idmedi`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`idmedi`, `designationmedi`, `pumedi`, `dateexpimedi`) VALUES
(1, 'paracetamol', 5, '2022-08-20'),
(17, 'antiramine', 500, '2022-09-16'),
(18, 'paracet', 5, '2022-10-08');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `idpaiement` int(11) NOT NULL AUTO_INCREMENT,
  `idmala` int(11) NOT NULL,
  `idag` int(11) NOT NULL,
  `montant` int(10) NOT NULL,
  `motif` varchar(35) DEFAULT NULL,
  `datepaiement` date DEFAULT NULL,
  PRIMARY KEY (`idpaiement`),
  KEY `fk_malade1` (`idmala`),
  KEY `fk_ag` (`idag`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`idpaiement`, `idmala`, `idag`, `montant`, `motif`, `datepaiement`) VALUES
(7, 1, 3, 1512, 'hospitalisation plus mÃ©dicament', '2022-11-30'),
(8, 5, 3, 1012, 'mÃ©dicament et hospitalisation ', '2022-09-17');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nomutilisateur` varchar(100) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  PRIMARY KEY (`idutilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `nomutilisateur`, `motdepasse`) VALUES
(1, 'miriam', '12345');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `consommer`
--
ALTER TABLE `consommer`
  ADD CONSTRAINT `fk_malade3` FOREIGN KEY (`idmala`) REFERENCES `malade` (`idmala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_medicament` FOREIGN KEY (`idmedi`) REFERENCES `medicament` (`idmedi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `consulter`
--
ALTER TABLE `consulter`
  ADD CONSTRAINT `fk_mal` FOREIGN KEY (`idmala`) REFERENCES `malade` (`idmala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_med` FOREIGN KEY (`idmed`) REFERENCES `medecin` (`idmed`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `interner`
--
ALTER TABLE `interner`
  ADD CONSTRAINT `fk_chambre` FOREIGN KEY (`idchambre`) REFERENCES `chambre` (`idchambre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_malade4` FOREIGN KEY (`idmala`) REFERENCES `malade` (`idmala`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `fk_ag` FOREIGN KEY (`idag`) REFERENCES `agent` (`idag`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_malade1` FOREIGN KEY (`idmala`) REFERENCES `malade` (`idmala`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
