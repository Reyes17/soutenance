-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 25 mai 2023 à 14:05
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion-bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
                        `num_aut` int(11) NOT NULL,
                        `nom_aut` varchar(255) NOT NULL,
                        `creer_le` int(11) NOT NULL,
                        `est_actif` int(11) NOT NULL,
                        `est_supprimer` int(11) NOT NULL,
                        `maj_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `auteur_secondaire`
--

CREATE TABLE `auteur_secondaire` (
                                   `id` int(11) NOT NULL,
                                   `cod_ouv` int(11) NOT NULL,
                                   `num_aut` int(11) NOT NULL,
                                   `creer_le` int(11) NOT NULL,
                                   `est_actif` int(11) NOT NULL,
                                   `est_supprimer_` int(11) NOT NULL,
                                   `maj_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `date_parution`
--

CREATE TABLE `date_parution` (
                               `id` int(11) NOT NULL,
                               `cod_ouv` int(11) NOT NULL,
                               `cod_lang` int(11) NOT NULL,
                               `dat_par` date NOT NULL,
                               `creer_le` int(11) NOT NULL,
                               `est_actif` int(11) NOT NULL,
                               `est_supprimer` int(11) NOT NULL,
                               `maj_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
                         `cod_dom` int(11) NOT NULL,
                         `lib_dom` varchar(255) NOT NULL,
                         `creer_le` int(11) NOT NULL,
                         `est_actif` int(11) NOT NULL,
                         `est_supprimer` int(11) NOT NULL,
                         `maj_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `domaine_ouvrage`
--

CREATE TABLE `domaine_ouvrage` (
                                 `id` int(11) NOT NULL,
                                 `cod_ouv` int(11) NOT NULL,
                                 `cod_dom` int(11) NOT NULL,
                                 `creer_le` int(11) NOT NULL,
                                 `est_actif` int(11) NOT NULL,
                                 `est_supprimer` int(11) NOT NULL,
                                 `maj_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `emprumt`
--

CREATE TABLE `emprumt` (
                         `num_emp` int(11) NOT NULL,
                         `dat_emp` datetime NOT NULL,
                         `id` int(11) NOT NULL,
                         `creer_le` int(11) NOT NULL,
                         `est_actif` int(11) NOT NULL,
                         `est_supprimer` int(11) NOT NULL,
                         `maj_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

CREATE TABLE `langue` (
                        `cod_lang` int(11) NOT NULL,
                        `lib_lang` varchar(255) NOT NULL,
                        `creer_le` int(11) NOT NULL,
                        `est_actif` int(11) NOT NULL,
                        `est_supprimer` int(11) NOT NULL,
                        `maj_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
                        `id` int(11) NOT NULL,
                        `nom_mem` varchar(255) NOT NULL,
                        `adr_mem` varchar(255) NOT NULL,
                        `telephone` varchar(255) NOT NULL,
                        `email` varchar(255) NOT NULL,
                        `est _actif` int(1) NOT NULL,
                        `est_supprimer` int(1) NOT NULL,
                        `creer_le` int(11) NOT NULL,
                        `maj_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre_indelicat`
--

CREATE TABLE `membre_indelicat` (
                                  `id` int(11) NOT NULL,
                                  `num_emp` int(11) NOT NULL,
                                  `cod_ouv` int(11) NOT NULL,
                                  `dat_ret` datetime NOT NULL,
                                  `numero_compte` varchar(255) NOT NULL,
                                  `banque` varchar(255) NOT NULL,
                                  `creer_le` int(11) NOT NULL,
                                  `est_actif` int(11) NOT NULL,
                                  `est_supprimer` int(11) NOT NULL,
                                  `maj_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE `ouvrage` (
                         `cod_ouv` int(11) NOT NULL,
                         `titre` varchar(255) NOT NULL,
                         `nb_ex` int(11) NOT NULL,
                         `periodicite` varchar(255) NOT NULL,
                         `num_aut` int(11) NOT NULL,
                         `creer_le` int(11) NOT NULL,
                         `est_actif` int(11) NOT NULL,
                         `est_supprimer` int(11) NOT NULL,
                         `maj_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

CREATE TABLE `token` (
                       `id` int(11) NOT NULL,
                       `user_id` int(11) NOT NULL,
                       `type` varchar(255) NOT NULL,
                       `token` varchar(255) NOT NULL,
                       `est_actif` tinyint(4) NOT NULL DEFAULT '1',
                       `est_supprimer` tinyint(11) NOT NULL DEFAULT '0',
                       `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                       `maj_le` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
                             `id` int(11) NOT NULL,
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
                             `est_supprimer` int(11) DEFAULT NULL,
                             `creer_le` timestamp NULL DEFAULT NULL,
                             `maj_le` timestamp NULL DEFAULT NULL,
                             `email_valide` int(11) DEFAULT NULL,
                             `telephone_valide` int(11) DEFAULT NULL,
                             `nom_utilisateur` varchar(255) NOT NULL,
                             `adresse` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`num_aut`);

--
-- Index pour la table `auteur_secondaire`
--
ALTER TABLE `auteur_secondaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_aut` (`num_aut`),
  ADD KEY `cod_ouv` (`cod_ouv`);

--
-- Index pour la table `date_parution`
--
ALTER TABLE `date_parution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cod_ouv` (`cod_ouv`),
  ADD KEY `cod_lang` (`cod_lang`);

--
-- Index pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD PRIMARY KEY (`cod_dom`);

--
-- Index pour la table `domaine_ouvrage`
--
ALTER TABLE `domaine_ouvrage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cod_ouv` (`cod_ouv`),
  ADD KEY `cod_dom` (`cod_dom`);

--
-- Index pour la table `emprumt`
--
ALTER TABLE `emprumt`
  ADD PRIMARY KEY (`num_emp`),
  ADD KEY `num_mem` (`id`);

--
-- Index pour la table `langue`
--
ALTER TABLE `langue`
  ADD PRIMARY KEY (`cod_lang`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membre_indelicat`
--
ALTER TABLE `membre_indelicat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_emp` (`num_emp`),
  ADD KEY `cod_ouv` (`cod_ouv`);

--
-- Index pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD PRIMARY KEY (`cod_ouv`),
  ADD KEY `num_aut` (`num_aut`);

--
-- Index pour la table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `num_aut` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `auteur_secondaire`
--
ALTER TABLE `auteur_secondaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `date_parution`
--
ALTER TABLE `date_parution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `cod_dom` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `domaine_ouvrage`
--
ALTER TABLE `domaine_ouvrage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `emprumt`
--
ALTER TABLE `emprumt`
  MODIFY `num_emp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `langue`
--
ALTER TABLE `langue`
  MODIFY `cod_lang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre_indelicat`
--
ALTER TABLE `membre_indelicat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  MODIFY `cod_ouv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Contraintes pour la table `emprumt`
--
ALTER TABLE `emprumt`
  ADD CONSTRAINT `emprumt_membre_id` FOREIGN KEY (`id`) REFERENCES `membre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `membre_indelicat`
--
ALTER TABLE `membre_indelicat`
  ADD CONSTRAINT `membre_indelicat_emprumt_num_emp` FOREIGN KEY (`num_emp`) REFERENCES `emprumt` (`num_emp`) ON DELETE CASCADE ON UPDATE CASCADE,
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
