-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 juil. 2023 à 12:06
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`num_aut`, `nom_aut`, `prenom_aut`, `creer_le`, `est_actif`, `est_supprimer`, `maj_le`) VALUES
(24, 'Fontaine', 'Francis', '2023-07-13 12:23:18', 1, 0, NULL),
(25, 'Du Bois', 'Francis', '2023-07-13 13:50:45', 1, 0, NULL),
(26, 'Victor', 'Hugo', '2023-07-19 20:31:44', 1, 0, NULL),
(28, 'Victor', 'Herv&eacute;', '2023-07-24 09:51:02', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `auteur_secondaire`
--

DROP TABLE IF EXISTS `auteur_secondaire`;
CREATE TABLE IF NOT EXISTS `auteur_secondaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ouv` int(11) DEFAULT NULL,
  `num_aut` int(11) DEFAULT NULL,
  `nom_aut_secondaire` varchar(255) DEFAULT NULL,
  `prenom_aut_secondaire` varchar(255) DEFAULT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `est_actif` int(11) NOT NULL DEFAULT '1',
  `est_supprimer` int(11) NOT NULL DEFAULT '0',
  `maj_le` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `num_aut` (`num_aut`),
  KEY `cod_ouv` (`cod_ouv`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur_secondaire`
--

INSERT INTO `auteur_secondaire` (`id`, `cod_ouv`, `num_aut`, `nom_aut_secondaire`, `prenom_aut_secondaire`, `creer_le`, `est_actif`, `est_supprimer`, `maj_le`) VALUES
(2, NULL, NULL, 'EMEH', 'Restarick', '2023-07-20 19:03:25', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `cod_cat` int(11) NOT NULL AUTO_INCREMENT,
  `cod_dom` int(11) NOT NULL,
  `nom_cat` varchar(255) NOT NULL,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `supprimer_le` int(1) NOT NULL DEFAULT '0',
  `maj_le` timestamp NULL DEFAULT NULL,
  `est_actif` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_cat`),
  KEY `categorie_domaine_cod_dom` (`cod_dom`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`cod_cat`, `cod_dom`, `nom_cat`, `creer_le`, `supprimer_le`, `maj_le`, `est_actif`) VALUES
(8, 6, 'Decoration', '2023-07-25 10:53:59', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `date_parution`
--

DROP TABLE IF EXISTS `date_parution`;
CREATE TABLE IF NOT EXISTS `date_parution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ouv` int(11) NOT NULL,
  `cod_lang` int(11) NOT NULL,
  `dat_par` date NOT NULL,
  `creer_le` int(11) NOT NULL,
  `est_actif` int(11) NOT NULL,
  `est_supprimer` int(11) NOT NULL,
  `maj_le` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cod_ouv` (`cod_ouv`),
  KEY `cod_lang` (`cod_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`cod_dom`, `lib_dom`, `creer_le`, `est_actif`, `est_supprimer`, `maj_le`) VALUES
(5, 'Enfance et Jeunesse', '2023-07-24 09:35:54', 1, 0, '2023-07-24 07:36:05'),
(6, 'Arts, soci&eacute;t&eacute; &amp; sciences humaines', '2023-07-24 09:49:15', 1, 0, '2023-07-24 07:50:41');

-- --------------------------------------------------------

--
-- Structure de la table `domaine_ouvrage`
--

DROP TABLE IF EXISTS `domaine_ouvrage`;
CREATE TABLE IF NOT EXISTS `domaine_ouvrage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ouv` int(11) NOT NULL,
  `cod_dom` int(11) NOT NULL,
  `cod_cat` int(11) DEFAULT NULL,
  `creer_le` int(11) NOT NULL,
  `est_actif` int(11) NOT NULL,
  `est_supprimer` int(11) NOT NULL,
  `maj_le` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cod_ouv` (`cod_ouv`),
  KEY `cod_dom` (`cod_dom`),
  KEY `domaine_ouvrage_categorie_cod_cat` (`cod_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(9, 'Fran&ccedil;ais', '2023-07-24 10:06:56', 1, 0, NULL),
(10, 'Anglais', '2023-07-24 10:07:09', 1, 0, NULL),
(11, 'Allemand', '2023-07-24 10:07:15', 1, 0, NULL),
(12, 'Espagnol', '2023-07-24 10:07:18', 1, 0, NULL),
(13, 'Grec', '2023-07-24 10:07:21', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `membre_indelicat`
--

DROP TABLE IF EXISTS `membre_indelicat`;
CREATE TABLE IF NOT EXISTS `membre_indelicat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_emp` int(11) NOT NULL,
  `cod_ouv` int(11) NOT NULL,
  `dat_ret` datetime NOT NULL,
  `numero_compte` varchar(255) NOT NULL,
  `banque` varchar(255) NOT NULL,
  `creer_le` int(11) NOT NULL,
  `est_actif` int(11) NOT NULL,
  `est_supprimer` int(11) NOT NULL,
  `maj_le` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `num_emp` (`num_emp`),
  KEY `cod_ouv` (`cod_ouv`)
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
  `periodicite` varchar(255) NOT NULL,
  `num_aut` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `creer_le` int(11) NOT NULL,
  `est_actif` int(11) NOT NULL,
  `est_supprimer` int(11) NOT NULL,
  `maj_le` timestamp NOT NULL,
  PRIMARY KEY (`cod_ouv`),
  KEY `num_aut` (`num_aut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `token`
--

INSERT INTO `token` (`id`, `user_id`, `type`, `token`, `est_actif`, `est_supprimer`, `creer_le`, `maj_le`) VALUES
(28, 31, 'VALIDATION_COMPTE', 'VALIDATION_COMPTE64b2a74c4f45b', 0, 1, '2023-07-15 14:03:56', '2023-07-15 12:08:46'),
(29, 31, 'NOUVEAU_MOT_DE_PASSE', '64b2a85592c01', 0, 1, '2023-07-15 14:08:21', '2023-07-15 12:08:46');

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
  `est_actif` int(11) DEFAULT NULL,
  `est_supprimer` int(11) DEFAULT '0',
  `creer_le` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `maj_le` timestamp NULL DEFAULT NULL,
  `email_valide` int(11) DEFAULT NULL,
  `telephone_valide` int(11) DEFAULT NULL,
  `nom_utilisateur` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `email`, `telephone`, `mot_de_passe`, `profil`, `avatar`, `est_actif`, `est_supprimer`, `creer_le`, `maj_le`, `email_valide`, `telephone_valide`, `nom_utilisateur`, `adresse`) VALUES
(30, 'EMEH', 'Restarick', 'M', '1999-10-17', 'emehoceane@gmail.com', 67657013, '05b530ad0fb56286fe051d5f8be5b8453f1cd93f', 'bibliothecaire', '/soutenance/public/image/utilisateur_image/fate state.jpg', 1, 0, '2023-07-11 13:58:14', '2023-07-15 17:56:00', NULL, NULL, 'Restarick EMEH', 'Cotonou'),
(31, 'EMEH', 'Restarick', 'M', '1999-10-17', 'emehrestarick77@gmail.com', 66057342, '04f081741466827161bede82a374af0ec9a39e31', 'MEMBRE', '/soutenance/public/image/utilisateur_image/FB_IMG_1651251178570.jpg', 1, 0, '2023-07-15 14:03:56', '2023-07-24 08:09:04', NULL, NULL, 'REYES17', 'Cotonou');

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
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_domaine_cod_dom` FOREIGN KEY (`cod_dom`) REFERENCES `domaine` (`cod_dom`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `domaine_ouvrage_categorie_cod_cat` FOREIGN KEY (`cod_cat`) REFERENCES `categorie` (`cod_cat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `domaine_ouvrage_cod_ouv` FOREIGN KEY (`cod_ouv`) REFERENCES `ouvrage` (`cod_ouv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `domaine_ouvrage_domaine_cod_dom` FOREIGN KEY (`cod_dom`) REFERENCES `domaine` (`cod_dom`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_utilisateur_id` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `membre_indelicat`
--
ALTER TABLE `membre_indelicat`
  ADD CONSTRAINT `membre_indelicat_emprumt_num_emp` FOREIGN KEY (`num_emp`) REFERENCES `emprunt` (`num_emp`) ON DELETE CASCADE ON UPDATE CASCADE,
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
