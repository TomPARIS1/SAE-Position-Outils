-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 03 Octobre 2022 à 07:19
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `atelier`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `niveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etagere`
--

CREATE TABLE `etagere` (
  `id` int(11) NOT NULL,
  `xMin` double NOT NULL,
  `xMax` double NOT NULL,
  `yMin` double NOT NULL,
  `yMax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `outil`
--

CREATE TABLE `outil` (
  `id` int(11) NOT NULL,
  `id_etagere` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `nbr_utilisations` int(11) NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etagere`
--
ALTER TABLE `etagere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `outil`
--
ALTER TABLE `outil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_etagere` (`id_etagere`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `etagere`
--
ALTER TABLE `etagere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `outil`
--
ALTER TABLE `outil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `outil`
--
ALTER TABLE `outil`
  ADD CONSTRAINT `outil_ibfk_1` FOREIGN KEY (`id_etagere`) REFERENCES `etagere` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
