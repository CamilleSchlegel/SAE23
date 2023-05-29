-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 29 mai 2023 à 21:08
-- Version du serveur : 8.0.33-0ubuntu0.22.04.2
-- Version de PHP : 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idclient` int NOT NULL,
  `nom` varchar(16) NOT NULL,
  `prenom` varchar(16) NOT NULL,
  `adresse` varchar(64) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `code_postal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idclient`, `nom`, `prenom`, `adresse`, `longitude`, `latitude`, `code_postal`) VALUES
(1, 'robert', 'equerre', '3 rue des blaireaux', 3.14, 40, 34500);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `idcommande` int NOT NULL,
  `idclient` int NOT NULL,
  `status` varchar(24) NOT NULL DEFAULT 'Commandé',
  `date_commande` date NOT NULL,
  `date_livraison` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`idcommande`, `idclient`, `status`, `date_commande`, `date_livraison`) VALUES
(1, 1, 'Livré', '2023-05-23', '2023-05-23');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'michel@gmail.com', '098f6bcd4621d373cade4e832627b4f6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
