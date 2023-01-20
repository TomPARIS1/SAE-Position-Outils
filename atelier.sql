-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 20 Janvier 2023 à 06:19
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `atelier`
--

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

CREATE TABLE IF NOT EXISTS `atelier` (
`id_atelier` int(11) NOT NULL,
  `plan` text NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `id_compte` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `atelier`
--

INSERT INTO `atelier` (`id_atelier`, `plan`, `x`, `y`, `id_compte`) VALUES
(1, 'images/plan1.png', 32, 40, 19),
(2, 'images/plan2.png', 20, 35, 19),
(3, 'images/plan3.png', 12, 25, 20),
(4, 'images/plan4.png', 30, 46, 20);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE IF NOT EXISTS `compte` (
`id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mdp` longtext NOT NULL,
  `niveau` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`id`, `nom`, `mdp`, `niveau`) VALUES
(19, 'test@test.com', '125d6d03b32c84d492747f79cf0bf6e179d287f341384eb5d6d3197525ad6be8e6df0116032935698f99a09e265073d1d6c32c274591bf1d0a20ad67cba921bc', 1),
(20, 'testlvl2@test.com', '125d6d03b32c84d492747f79cf0bf6e179d287f341384eb5d6d3197525ad6be8e6df0116032935698f99a09e265073d1d6c32c274591bf1d0a20ad67cba921bc', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etagere`
--

CREATE TABLE IF NOT EXISTS `etagere` (
`id` int(11) NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `id_atelier` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `etagere`
--

INSERT INTO `etagere` (`id`, `x`, `y`, `id_atelier`) VALUES
(1, 2, 2, 1),
(2, 15, 25, 2),
(3, 8, 17, 3),
(4, 29, 45, 4);

-- --------------------------------------------------------

--
-- Structure de la table `outil`
--

CREATE TABLE IF NOT EXISTS `outil` (
`id` int(11) NOT NULL,
  `id_etagere` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `nbr_utilisations` int(11) NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Contenu de la table `outil`
--

INSERT INTO `outil` (`id`, `id_etagere`, `type`, `nbr_utilisations`, `x`, `y`) VALUES
(59, 1, 'Marteau', 11, 25, 23),
(60, 1, 'Tournevis', 5, 2, 2),
(61, 1, 'Clé à molette', 16, 2, 2),
(62, 2, 'Pied à coulisse', 5, 18, 33),
(63, 2, 'Marteau', 16, 13, 26),
(64, 3, 'Tournevis', 25, 5, 20),
(65, 3, 'Pompe hydraulique', 20, 8, 10),
(66, 3, 'Equerre', 2, 10, 20),
(67, 4, 'Truelle', 50, 25, 30),
(68, 4, 'Bétonnière', 60, 15, 13),
(69, 4, 'Perceuse', 10, 7, 32),
(70, 4, 'Pelle', 2, 27, 10);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
`id_reservation` int(11) NOT NULL,
  `id_outil` int(11) NOT NULL,
  `nom_utilisateur` varchar(32) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_outil`, `nom_utilisateur`, `date_debut`, `date_fin`) VALUES
(1, 59, 'Martin', '2023-01-26 08:00:00', '2023-01-27 18:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `sav`
--

CREATE TABLE IF NOT EXISTS `sav` (
`id_sav` int(11) NOT NULL,
  `id_compte` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `issue` longtext NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `user_key`
--

CREATE TABLE IF NOT EXISTS `user_key` (
  `id_compte` int(11) NOT NULL,
  `UUID` longtext NOT NULL,
  `date_valide` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user_key`
--

INSERT INTO `user_key` (`id_compte`, `UUID`, `date_valide`) VALUES
(20, '33015941-f857-473e-a5cb-d03406d7e477', '2023-01-20 01:55:34'),
(19, '02ab4e0d-8e33-4eed-b223-57be113c080d', '2023-01-20 02:41:23'),
(19, '1c6d2844-47d6-4d55-a7c5-d89e43a94495', '2023-01-20 02:41:36'),
(19, '4a1365d5-402f-4a0a-a360-0be18aa8da91', '2023-01-20 02:42:33'),
(19, '8fb81159-b528-4cae-8bf9-b6e2b3ab12fe', '2023-01-20 02:43:09'),
(19, 'a56c4b54-cc04-4c5b-9fcb-e0766d8ca786', '2023-01-20 02:43:21'),
(19, 'c685cb7f-3850-4970-8123-e1282a366e5e', '2023-01-20 02:44:16'),
(19, 'f3393489-534c-4c63-bb7e-a061ba0fd3e9', '2023-01-20 02:44:31'),
(19, '34e09c00-c953-473b-a649-0ffd2f092e2f', '2023-01-20 02:46:11'),
(19, '3e30a0d0-20e4-4508-ad28-29cfcb5920c8', '2023-01-20 02:47:05'),
(19, 'e4c0f796-3b46-4910-99bd-4dfc6b389597', '2023-01-20 02:47:28'),
(19, 'b6468254-dadd-4bea-beb5-273833fda4f6', '2023-01-20 02:47:43'),
(19, '198a6b62-645c-420c-a852-a9479e5508ec', '2023-01-20 02:48:27'),
(19, '0931d1fd-0cf7-4d6d-8566-394aa83353aa', '2023-01-20 02:51:34'),
(19, '483d28fc-8094-458d-bf65-12c77b9542b6', '2023-01-20 03:29:08'),
(19, '9cb7ee2c-bd6c-4b56-9c04-e6a0eac66228', '2023-01-20 03:30:36'),
(19, '19569bdc-0d50-4607-be91-07830a55d552', '2023-01-20 04:33:23');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `atelier`
--
ALTER TABLE `atelier`
 ADD PRIMARY KEY (`id_atelier`), ADD KEY `id_compte` (`id_compte`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etagere`
--
ALTER TABLE `etagere`
 ADD PRIMARY KEY (`id`), ADD KEY `id_atelier` (`id_atelier`);

--
-- Index pour la table `outil`
--
ALTER TABLE `outil`
 ADD PRIMARY KEY (`id`), ADD KEY `id_etagere` (`id_etagere`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
 ADD PRIMARY KEY (`id_reservation`), ADD KEY `id_outil` (`id_outil`);

--
-- Index pour la table `sav`
--
ALTER TABLE `sav`
 ADD PRIMARY KEY (`id_sav`), ADD KEY `id_compte` (`id_compte`);

--
-- Index pour la table `user_key`
--
ALTER TABLE `user_key`
 ADD KEY `id_compte` (`id_compte`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `atelier`
--
ALTER TABLE `atelier`
MODIFY `id_atelier` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `etagere`
--
ALTER TABLE `etagere`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `outil`
--
ALTER TABLE `outil`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `sav`
--
ALTER TABLE `sav`
MODIFY `id_sav` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `atelier`
--
ALTER TABLE `atelier`
ADD CONSTRAINT `atelier_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `etagere`
--
ALTER TABLE `etagere`
ADD CONSTRAINT `etagere_ibfk_1` FOREIGN KEY (`id_atelier`) REFERENCES `atelier` (`id_atelier`);

--
-- Contraintes pour la table `outil`
--
ALTER TABLE `outil`
ADD CONSTRAINT `outil_ibfk_1` FOREIGN KEY (`id_etagere`) REFERENCES `etagere` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_outil`) REFERENCES `outil` (`id`);

--
-- Contraintes pour la table `sav`
--
ALTER TABLE `sav`
ADD CONSTRAINT `sav_key_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `user_key`
--
ALTER TABLE `user_key`
ADD CONSTRAINT `user_key_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
