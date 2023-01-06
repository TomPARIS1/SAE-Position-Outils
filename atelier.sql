-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 06 Janvier 2023 à 09:47
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
-- Structure de la table `atelier`
--

CREATE TABLE `atelier` (
  `id_atelier` int(11) NOT NULL,
  `plan` text NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `id_compte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `atelier`
--

INSERT INTO `atelier` (`id_atelier`, `plan`, `x`, `y`, `id_compte`) VALUES
(1, 'images/plan1.png', 32, 40, 1),
(2, 'images/plan2.png', 20, 35, 1),
(3, 'images/plan3.png', 12, 25, 2),
(4, 'images/plan4.png', 30, 46, 2);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mdp` longtext NOT NULL,
  `niveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`id`, `nom`, `mdp`, `niveau`) VALUES
(1, 'Jean Batiment', 'btp4ever', 2),
(2, 'Antonio Carrosserie', 'vroumvroum', 1),
(5, 'nom', '2118c37356b669d52c22510c0287642551fcdc1b9b27517999e040ad56d1ad678cb71496eb4da19832143ae14ef1ceabf1824349bd608176a91f22f7088a5427', 1),
(6, 'mickael.andrieu@exemple.comaa', '1b86355f13a7f0b90c8b6053c0254399994dfbb3843e08d603e292ca13b8f672ed5e58791c10f3e36daec9699cc2fbdc88b4fe116efa7fce016938b787043818', 1),
(13, 'mickael.andrieu@exemple.coma', '1b86355f13a7f0b90c8b6053c0254399994dfbb3843e08d603e292ca13b8f672ed5e58791c10f3e36daec9699cc2fbdc88b4fe116efa7fce016938b787043818', 1),
(17, 'prout@prout.com', 'f627e2532c18641619339f2586b4d05face298d1be5fa9c8b4adbee8536eda944b165978f4063713cf2133a112c7ee3366e9d7e894d5c73e9559c6b4243a65f5', 1),
(18, 'aa@a.a', '1f40fc92da241694750979ee6cf582f2d5d7d28e18335de05abc54d0560e0f5302860c652bf08d560252aa5e74210546f369fbbbce8c12cfc7957b2652fe9a75', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etagere`
--

CREATE TABLE `etagere` (
  `id` int(11) NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `id_atelier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id_historique` int(11) NOT NULL,
  `id_outil` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `date` date NOT NULL
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
-- Contenu de la table `outil`
--

INSERT INTO `outil` (`id`, `id_etagere`, `type`, `nbr_utilisations`, `x`, `y`) VALUES
(59, 1, 'Marteau', 11, 25, 23),
(60, 1, 'Tournevis', 5, 2, 2),
(61, 1, 'Clé à molette', 16, 2, 2),
(62, 2, 'Pied à coulisse', 5, 18, 33),
(63, 2, 'Marteau', 16, 13, 26),
(64, 3, 'Tournevis', 25, 8, 17),
(65, 3, 'Pompe hydraulique', 20, 8, 17),
(66, 3, 'Equerre', 2, 8, 17),
(67, 4, 'Truelle', 50, 28, 40),
(68, 4, 'Bétonnière', 60, 15, 13),
(69, 4, 'Perceuse', 10, 2, 32),
(70, 4, 'Pelle', 2, 29, 45);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_outil` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user_key`
--

CREATE TABLE `user_key` (
  `id_compte` int(11) NOT NULL,
  `UUID` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `atelier`
--
ALTER TABLE `atelier`
  ADD PRIMARY KEY (`id_atelier`),
  ADD KEY `id_compte` (`id_compte`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etagere`
--
ALTER TABLE `etagere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_atelier` (`id_atelier`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id_historique`),
  ADD KEY `id_outil` (`id_outil`);

--
-- Index pour la table `outil`
--
ALTER TABLE `outil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_etagere` (`id_etagere`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_outil` (`id_outil`);

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
  MODIFY `id_atelier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `etagere`
--
ALTER TABLE `etagere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `outil`
--
ALTER TABLE `outil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT;
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
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`id_outil`) REFERENCES `outil` (`id`);

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
-- Contraintes pour la table `user_key`
--
ALTER TABLE `user_key`
  ADD CONSTRAINT `user_key_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
