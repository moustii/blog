-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : mar. 08 mars 2022 à 12:18
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jeremyibert_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `pseudo` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(256) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `pseudo`, `password`) VALUES
(1, 'Reese', '$2y$10$P1SVUx7dTkX54NLt5gMzS.dEULD7NhVfll4S5zpDLNGgbkPu.4KFy');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) NOT NULL,
  `titre` varchar(256) COLLATE utf8_bin NOT NULL,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `date`, `id_auteur`, `id_cat`, `image`) VALUES
(6, 'Canicule', 'Forte chaleur ressentie au sud-ouest', '2022-03-02 16:48:14', 1, 1, ''),
(7, 'psg', 'ce soir c\'est match', '2022-03-03 13:56:18', 1, 1, ''),
(14, 'Foot', 'Terrain', '2022-03-04 11:26:24', 1, 1, 'pitch.jpg'),
(34, 'Real Madrid - PSG', 'Match retour de la champions league...', '2022-03-07 14:47:20', 1, 1, 'pitch2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE `auteurs` (
  `id` int(10) NOT NULL,
  `nom` varchar(250) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`id`, `nom`, `prenom`) VALUES
(1, 'kitty', 'marchand'),
(2, 'hello', 'reese');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `nom_cat` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom_cat`) VALUES
(1, 'actualites'),
(2, 'economie');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(10) NOT NULL,
  `id_article` int(11) NOT NULL,
  `pseudo` varchar(250) COLLATE utf8_bin NOT NULL,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_article`, `pseudo`, `contenu`, `date`) VALUES
(58, 34, 'footix', 'vamos', '2022-03-07 14:47:41'),
(59, 34, 'sportifdudimanche', 'Ouai hate', '2022-03-07 14:48:01'),
(60, 34, 'parisien', 'On va les taper !', '2022-03-07 14:48:23'),
(61, 34, 'tyo', 'Chaud chaud', '2022-03-07 14:48:43'),
(62, 34, 'okyri', 'Messi : Goat', '2022-03-07 14:49:03'),
(63, 34, 'Pessi', 'Messi : nul', '2022-03-07 14:49:17'),
(64, 7, 'Pa\'m', 'nan c\'est mercredi !', '2022-03-07 22:01:03'),
(65, 14, 'kali', 'Wah pas de lumiere', '2022-03-07 22:15:22'),
(66, 14, 'Tili', 'Serieux ?', '2022-03-07 22:15:36'),
(67, 6, 'hotman', 'ah ouai chaud', '2022-03-07 22:49:21'),
(68, 34, 'manu', 'yeeess', '2022-03-07 21:50:51'),
(69, 34, 'yoshi', 'hey man', '2022-03-07 22:55:58'),
(70, 34, 'uoi', 'fjkffd', '2022-03-07 21:59:28'),
(71, 34, 'fdfdffd', 'sfdf', '2022-03-07 23:00:07');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_auteur` (`id_auteur`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_article`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
