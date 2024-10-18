-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 10 fév. 2024 à 12:00
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `num_aut` int(11) NOT NULL AUTO_INCREMENT,
  `nom_aut` varchar(255) NOT NULL,
  `prenom_aut` varchar(255) NOT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `est_actif` int(11) NOT NULL DEFAULT '1',
  `est_supprimer` int(11) NOT NULL DEFAULT '0',
  `maj_le` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`num_aut`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `auteur_secondaire`
--

DROP TABLE IF EXISTS `auteur_secondaire`;
CREATE TABLE IF NOT EXISTS `auteur_secondaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ouv` int(11) DEFAULT NULL,
  `num_aut` int(11) DEFAULT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `est_actif` int(11) NOT NULL DEFAULT '1',
  `est_supprimer` int(11) NOT NULL DEFAULT '0',
  `maj_le` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `num_aut` (`num_aut`),
  KEY `cod_ouv` (`cod_ouv`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `date_parution`
--

DROP TABLE IF EXISTS `date_parution`;
CREATE TABLE IF NOT EXISTS `date_parution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ouv` int(11) NOT NULL,
  `cod_lang` int(11) NOT NULL,
  `dat_par` int(11) NOT NULL,
  `nb_ex_lang` int(11) NOT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `est_actif` int(11) NOT NULL DEFAULT '1',
  `est_supprimer` int(11) NOT NULL DEFAULT '0',
  `maj_le` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cod_ouv` (`cod_ouv`),
  KEY `cod_lang` (`cod_lang`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

DROP TABLE IF EXISTS `domaine`;
CREATE TABLE IF NOT EXISTS `domaine` (
  `cod_dom` int(11) NOT NULL AUTO_INCREMENT,
  `lib_dom` varchar(255) NOT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `est_actif` int(11) NOT NULL DEFAULT '1',
  `est_supprimer` int(11) NOT NULL DEFAULT '0',
  `maj_le` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_dom`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `domaine_ouvrage`
--

DROP TABLE IF EXISTS `domaine_ouvrage`;
CREATE TABLE IF NOT EXISTS `domaine_ouvrage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ouv` int(11) NOT NULL,
  `cod_dom` int(11) NOT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `est_actif` int(11) NOT NULL DEFAULT '1',
  `est_supprimer` int(11) NOT NULL DEFAULT '0',
  `maj_le` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cod_ouv` (`cod_ouv`),
  KEY `cod_dom` (`cod_dom`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `num_emp` int(11) NOT NULL AUTO_INCREMENT,
  `dat_emp` datetime NOT NULL,
  `id` int(11) NOT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `est_actif` int(11) NOT NULL,
  `est_supprimer` int(11) NOT NULL,
  `maj_le` timestamp NOT NULL,
  PRIMARY KEY (`num_emp`),
  KEY `num_mem` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `emprunt_ouvrage`
--

DROP TABLE IF EXISTS `emprunt_ouvrage`;
CREATE TABLE IF NOT EXISTS `emprunt_ouvrage` (
  `id_emp_ouvrage` int(11) NOT NULL AUTO_INCREMENT,
  `num_emp` int(11) NOT NULL,
  `cod_ouv` int(11) NOT NULL,
  `cod_lang` int(11) NOT NULL,
  `dat_emp` datetime NOT NULL,
  `dat_ret` datetime DEFAULT NULL,
  `etat_ouvrage` varchar(255) DEFAULT NULL,
  `dat_butoir` datetime NOT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `est_supprime` int(11) NOT NULL DEFAULT '0',
  `maj_le` timestamp NULL DEFAULT NULL,
  `est_actif` int(11) NOT NULL,
  PRIMARY KEY (`id_emp_ouvrage`),
  KEY `emprunt_ouvrage_num_emp` (`num_emp`),
  KEY `emprunt_ouvrage_cod_ouv` (`cod_ouv`),
  KEY `emprunt_ouvrage_langue_cod_lang` (`cod_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

DROP TABLE IF EXISTS `langue`;
CREATE TABLE IF NOT EXISTS `langue` (
  `cod_lang` int(11) NOT NULL AUTO_INCREMENT,
  `lib_lang` varchar(255) NOT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `est_actif` int(11) NOT NULL DEFAULT '1',
  `est_supprimer` int(11) NOT NULL DEFAULT '0',
  `maj_le` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cod_lang`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `langue`
--

INSERT INTO `langue` (`cod_lang`, `lib_lang`, `creer_le`, `est_actif`, `est_supprimer`, `maj_le`) VALUES
(10, 'Anglais', '2023-07-24 10:07:09', 1, 0, '2023-09-08 17:49:09'),
(11, 'Allemand', '2023-07-24 10:07:15', 1, 0, NULL),
(12, 'Espagnol', '2023-07-24 10:07:18', 1, 0, NULL),
(13, 'Français', '2023-09-08 17:51:33', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `membre_indelicat`
--

DROP TABLE IF EXISTS `membre_indelicat`;
CREATE TABLE IF NOT EXISTS `membre_indelicat` (
  `id_indelicat` int(11) NOT NULL AUTO_INCREMENT,
  `num_emp` int(11) NOT NULL,
  `cod_ouv` int(11) NOT NULL,
  `cod_lang` int(11) NOT NULL,
  `dat_emp` datetime NOT NULL,
  `dat_ret` datetime NOT NULL,
  `etat_ouvrage` varchar(255) NOT NULL,
  `dat_butoir` datetime NOT NULL,
  `numero_compte` varchar(255) NOT NULL,
  `banque` varchar(255) NOT NULL,
  `creer_le` timestamp NOT NULL,
  `est_actif` int(11) NOT NULL,
  `est_supprimer` int(11) NOT NULL,
  `maj_le` timestamp NOT NULL,
  PRIMARY KEY (`id_indelicat`),
  KEY `num_emp` (`num_emp`),
  KEY `cod_ouv` (`cod_ouv`),
  KEY `membre_indelicat_langue_cod_lang` (`cod_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

DROP TABLE IF EXISTS `ouvrage`;
CREATE TABLE IF NOT EXISTS `ouvrage` (
  `cod_ouv` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `nb_ex` int(11) NOT NULL,
  `periodicite` varchar(255) DEFAULT NULL,
  `num_aut` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `est_actif` int(11) NOT NULL DEFAULT '1',
  `est_supprimer` int(11) NOT NULL DEFAULT '0',
  `maj_le` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cod_ouv`),
  KEY `num_aut` (`num_aut`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `est_actif` tinyint(4) NOT NULL DEFAULT '1',
  `est_supprimer` tinyint(11) NOT NULL DEFAULT '0',
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `maj_le` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(1) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `profil` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'Non defini',
  `est_actif` int(11) DEFAULT '0',
  `est_supprimer` int(11) DEFAULT '0',
  `creer_le` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `maj_le` timestamp NULL DEFAULT NULL,
  `email_valide` int(11) DEFAULT NULL,
  `telephone_valide` int(11) DEFAULT NULL,
  `nom_utilisateur` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `auteur_secondaire`
--
ALTER TABLE `auteur_secondaire`
  ADD CONSTRAINT `auteur_secondaire_auteur_num_aut` FOREIGN KEY (`num_aut`) REFERENCES `auteur` (`num_aut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auteur_secondaire_ouvrage_cod_ouv` FOREIGN KEY (`cod_ouv`) REFERENCES `ouvrage` (`cod_ouv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `date_parution`
--
ALTER TABLE `date_parution`
  ADD CONSTRAINT `date_parution_langue_cod_lang` FOREIGN KEY (`cod_lang`) REFERENCES `langue` (`cod_lang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `date_parution_ouvrage_cod_ouv` FOREIGN KEY (`cod_ouv`) REFERENCES `ouvrage` (`cod_ouv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `domaine_ouvrage`
--
ALTER TABLE `domaine_ouvrage`
  ADD CONSTRAINT `domaine_ouvrage_cod_ouv` FOREIGN KEY (`cod_ouv`) REFERENCES `ouvrage` (`cod_ouv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `domaine_ouvrage_domaine_cod_dom` FOREIGN KEY (`cod_dom`) REFERENCES `domaine` (`cod_dom`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_utilisateur_id` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `emprunt_ouvrage`
--
ALTER TABLE `emprunt_ouvrage`
  ADD CONSTRAINT `emprunt_ouvrage_cod_ouv` FOREIGN KEY (`cod_ouv`) REFERENCES `ouvrage` (`cod_ouv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emprunt_ouvrage_langue_cod_lang` FOREIGN KEY (`cod_lang`) REFERENCES `langue` (`cod_lang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emprunt_ouvrage_num_emp` FOREIGN KEY (`num_emp`) REFERENCES `emprunt` (`num_emp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `membre_indelicat`
--
ALTER TABLE `membre_indelicat`
  ADD CONSTRAINT `membre_indelicat_emprunt_num_emp` FOREIGN KEY (`num_emp`) REFERENCES `emprunt` (`num_emp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membre_indelicat_langue_cod_lang` FOREIGN KEY (`cod_lang`) REFERENCES `langue` (`cod_lang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membre_indelicat_ouvrage_cod_ouv` FOREIGN KEY (`cod_ouv`) REFERENCES `ouvrage` (`cod_ouv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD CONSTRAINT `ouvrage_auteur_num_aut` FOREIGN KEY (`num_aut`) REFERENCES `auteur` (`num_aut`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
