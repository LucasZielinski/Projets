-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 21 Mai 2021 à 18:40
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `vizimmoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `bien`
--

GRANT USAGE ON *.* TO 'APMission3'@'localhost';

GRANT ALL PRIVILEGES ON `vizimmo`.* TO 'APMission3'@'localhost' WITH GRANT OPTION;

CREATE TABLE `bien` (
  `ref` varchar(5) NOT NULL,
  `rue` varchar(35) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(25) NOT NULL,
  `prix` int(9) NOT NULL,
  `type` int(2) NOT NULL,
  `jardin` tinyint(1) DEFAULT NULL,
  `surface` int(6) DEFAULT NULL,
  `nbpiece` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bien`
--

INSERT INTO `bien` (`ref`, `rue`, `cp`, `ville`, `prix`, `type`, `jardin`, `surface`, `nbpiece`) VALUES
('A1', '85 rue de Cambrai', '59000', 'Lille', 108000, 1, 0, 17, 2),
('A2', '52 rue de Tourcoing', '59100', 'Roubaix', 81750, 1, 0, 45, 4),
('A3', '69 rue Voltaire', '59150', 'Wattrelos', 199000, 1, 0, 45, 4),
('A4', '45 rue du Creusot', '59170', 'Croix', 155000, 1, 0, 41, 4),
('A5', '20 rue Briet', '59510', 'Hem', 155000, 1, 0, 60, 4),
('A6', '105 rue de l\'Epeule', '59100', 'Roubaix', 78000, 1, 0, 97, 4),
('A7', '75 rue du Ballon', '59000', 'Lille', 483000, 1, 0, 96, 5),
('I1', '45 rue de la Barre', '59000', 'Lille', 1050000, 2, 0, 245, 12),
('I2', '54 rue du Molinel', '59000', 'Lille', 3045000, 2, 0, 950, 24),
('L1', '98 rue Gustave Delory', '59000', 'Lille', 169000, 3, 0, 35, 1),
('L2', '85 rue du Blanqui', '59000', 'Lille', 536000, 3, 0, 328, 10),
('L3', '32 rue Sainte-Catherine', '59000', 'Lille', 1152000, 3, 0, 475, 20),
('M1', '50 rue Victor Hugo', '59115', 'Leers', 490000, 4, 1, 500, 9),
('M2', '55 rue des Glycines', '59390', 'Toufflers', 293000, 4, 1, 88, 6),
('M3', '29 rue Jules Guesde', '59100', 'Roubaix', 88000, 4, 1, 70, 5),
('M4', '47 rue Jouffroy', '59100', 'Roubaix', 239000, 4, 1, 250, 7),
('M5', '25 rue Nationale', '59200', 'Tourcoing', 148000, 4, 1, 73, 5),
('T1', '33 rue Marceau', '59125', 'Trith Saint Leger', 85900, 5, 1, 723, 0),
('T2', '25 rue de Fretin', '59242', 'Templeuve', 136500, 5, 1, 500, 0),
('T3', '158 rue Henri Durre', '59255', 'Haveluy', 50000, 5, 1, 300, 0),
('T4', '146 rue du Chemin des Vaches', '59144', 'Wargnies le petit', 126000, 5, 1, 900, 0);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(3) NOT NULL,
  `ref` varchar(5) NOT NULL,
  `codeimg` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `ref`, `codeimg`) VALUES
(1, 'A1', '../img/Appart/A1/1.jpg'),
(2, 'A1', '../img/Appart/A1/2.jpg'),
(3, 'A1', '../img/Appart/A1/3.jpg'),
(4, 'A2', '../img/Appart/A2/1.jpg'),
(5, 'A2', '../img/Appart/A2/2.jpg'),
(6, 'A2', '../img/Appart/A2/3.jpg'),
(7, 'A3', '../img/Appart/A3/1.jpg'),
(8, 'A3', '../img/Appart/A3/2.jpg'),
(9, 'A3', '../img/Appart/A3/3.jpg'),
(10, 'A4', '../img/Appart/A4/1.jpg'),
(11, 'A4', '../img/Appart/A4/2.jpg'),
(12, 'A4', '../img/Appart/A4/3.jpg'),
(13, 'A5', '../img/Appart/A5/1.jpg'),
(14, 'A5', '../img/Appart/A5/2.jpg'),
(15, 'A5', '../img/Appart/A5/3.jpg'),
(16, 'A6', '../img/Appart/A6/1.jpg'),
(17, 'A6', '../img/Appart/A6/2.jpg'),
(18, 'A6', '../img/Appart/A6/3.jpg'),
(19, 'A7', '../img/Appart/A7/1.png'),
(20, 'A7', '../img/Appart/A7/2.png'),
(21, 'A7', '../img/Appart/A7/3.png'),
(22, 'I1', '../img/Immeuble/I1/1.jpg'),
(23, 'I1', '../img/Immeuble/I1/2.jpg'),
(24, 'I1', '../img/Immeuble/I1/3.jpg'),
(25, 'I2', '../img/Immeuble/I2/1.jpg'),
(26, 'I2', '../img/Immeuble/I2/2.jpg'),
(27, 'I2', '../img/Immeuble/I2/3.jpg'),
(28, 'L1', '../img/Local/L1/1.jpg'),
(29, 'L1', '../img/Local/L1/2.jpg'),
(30, 'L1', '../img/Local/L1/3.jpg'),
(31, 'L2', '../img/Local/L2/1.png'),
(32, 'L2', '../img/Local/L2/2.png'),
(33, 'L2', '../img/Local/L2/3.png'),
(34, 'L3', '../img/Local/L3/1.png'),
(35, 'L3', '../img/Local/L3/2.png'),
(36, 'L3', '../img/Local/L3/3.png'),
(37, 'M1', '../img/Maison/M1/1.jpg'),
(38, 'M1', '../img/Maison/M1/2.jpg'),
(39, 'M1', '../img/Maison/M1/3.jpg'),
(40, 'M2', '../img/Maison/M2/1.jpg'),
(41, 'M2', '../img/Maison/M2/2.jpg'),
(42, 'M2', '../img/Maison/M2/3.jpg'),
(43, 'M3', '../img/Maison/M3/1.jpg'),
(44, 'M3', '../img/Maison/M3/2.jpg'),
(45, 'M3', '../img/Maison/M3/3.jpg'),
(46, 'M4', '../img/Maison/M4/1.jpg'),
(47, 'M4', '../img/Maison/M4/2.jpg'),
(48, 'M4', '../img/Maison/M4/3.jpg'),
(49, 'M5', '../img/Maison/M5/1.jpg'),
(50, 'M5', '../img/Maison/M5/2.jpg'),
(51, 'M5', '../img/Maison/M5/3.jpg'),
(52, 'T1', '../img/Terrains/T1/1.jpg'),
(53, 'T1', '../img/Terrains/T1/2.jpg'),
(54, 'T2', '../img/Terrains/T2/1.jpg'),
(55, 'T3', '../img/Terrains/T3/1.jpg'),
(56, 'T3', '../img/Terrains/T3/2.jpg'),
(57, 'T3', '../img/Terrains/T3/3.jpg'),
(58, 'T4', '../img/Terrains/T4/1.jpg'),
(59, 'T4', '../img/Terrains/T4/2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `recuperation`
--

CREATE TABLE `recuperation` (
  `id` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `code` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statistiques`
--

CREATE TABLE `statistiques` (
  `id` int(5) NOT NULL,
  `ville` varchar(25) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `statistiques`
--

INSERT INTO `statistiques` (`id`, `ville`, `date`) VALUES
(1, 'Croix', '2021-05-21'),
(2, 'Croix', '2021-05-21'),
(3, 'Croix', '2021-05-21'),
(4, 'Tourcoing', '2021-05-21'),
(5, 'Trith Saint Leger', '2021-05-21'),
(6, 'Wargnies le petit', '2021-05-21'),
(7, 'Croix', '2021-05-21'),
(8, 'Croix', '2021-05-21'),
(9, 'Wattrelos', '2021-05-21'),
(10, 'Wargnies le petit', '2021-05-21'),
(11, 'Lille', '2021-05-21'),
(12, 'Croix', '2021-05-21'),
(13, '', '2021-05-21'),
(14, '', '2021-05-21'),
(15, 'Croix', '2021-05-21');

-- --------------------------------------------------------

--
-- Structure de la table `typebien`
--

CREATE TABLE `typebien` (
  `id` int(2) NOT NULL,
  `libelle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typebien`
--

INSERT INTO `typebien` (`id`, `libelle`) VALUES
(1, 'appartement'),
(2, 'immeuble'),
(3, 'local'),
(4, 'maison'),
(5, 'terrain');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(3) NOT NULL,
  `login` varchar(20) NOT NULL,
  `mdp` varchar(90) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `mdp`, `mail`) VALUES
(5, 'agent1', '$2y$10$aKJlUiOQrIuERKIoY3dBGO0EwrTYykYLszGGP3URHK9EdVSoZvb.O', 'infeltaelliot@gmail.com');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bien`
--
ALTER TABLE `bien`
  ADD PRIMARY KEY (`ref`),
  ADD KEY `type` (`type`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref` (`ref`);

--
-- Index pour la table `recuperation`
--
ALTER TABLE `recuperation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statistiques`
--
ALTER TABLE `statistiques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typebien`
--
ALTER TABLE `typebien`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT pour la table `recuperation`
--
ALTER TABLE `recuperation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `statistiques`
--
ALTER TABLE `statistiques`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bien`
--
ALTER TABLE `bien`
  ADD CONSTRAINT `ce_bien_typebien` FOREIGN KEY (`type`) REFERENCES `typebien` (`id`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`ref`) REFERENCES `bien` (`ref`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
