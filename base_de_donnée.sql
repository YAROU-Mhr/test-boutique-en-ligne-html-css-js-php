-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 12 avr. 2024 à 09:55
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `testboutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `code` varchar(50) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`code`, `libelle`) VALUES
('CAT1', 'Categorie 11'),
('CAT2', 'Categorie 2');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `numcli` int NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`numcli`, `nom`, `prenom`, `adresse`, `telephone`, `email`) VALUES
(1, 'YAROU', 'Mouhêmirou', 'cotonou', '+29953044860', 'y@gmail.com'),
(4, 'YAROU2', 'Mhr2', 'Ctn', '+2295304486000', 'z@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `numcmd` int NOT NULL,
  `date` date DEFAULT NULL,
  `etat` varchar(50) DEFAULT NULL,
  `qte` int DEFAULT NULL,
  `numcli` int DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`numcmd`, `date`, `etat`, `qte`, `numcli`, `ref`) VALUES
(2, '2024-03-01', 'Validé', 5, 1, 'BB'),
(3, '2024-03-14', 'Non ', 10, 1, 'CA100'),
(4, '2024-04-12', 'en cours', 1, 1, 'CA100');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `ref` varchar(50) NOT NULL,
  `design` varchar(255) DEFAULT NULL,
  `pu` decimal(10,2) DEFAULT NULL,
  `imageprod` varchar(255) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`ref`, `design`, `pu`, `imageprod`, `code`) VALUES
('BB', 'Bon Bien BREF', '555.00', 'uploads/bref.png', 'CAT1'),
('BI', 'BIC', '100.00', 'uploads/obito.jpg', 'CAT2'),
('CA100', 'Cahier de 100 pages', '150.00', 'uploads/couberture_dev_group.jpg', 'CAT1');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `iduser` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `profil` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`iduser`, `email`, `mdp`, `profil`) VALUES
(1, 'admin@gmail.com', '12345678', 'Admin'),
(2, 'user@gmail.com', '12345678', 'Client'),
(4, 'y@gmail.com', '12345678', 'Client'),
(5, 'z@gmail.com', '123456789', 'Client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`numcli`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`numcmd`),
  ADD KEY `numcli` (`numcli`),
  ADD KEY `ref` (`ref`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`ref`),
  ADD UNIQUE KEY `ref` (`ref`),
  ADD KEY `code` (`code`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `numcli` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `numcmd` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`numcli`) REFERENCES `client` (`numcli`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`ref`) REFERENCES `produit` (`ref`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`code`) REFERENCES `categorie` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
