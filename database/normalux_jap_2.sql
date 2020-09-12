-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 12 sep. 2020 à 16:29
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `normalux_jap_2`
--

-- --------------------------------------------------------

--
-- Structure de la table `alphabet`
--

CREATE TABLE `alphabet` (
  `id` int(11) NOT NULL,
  `fk_word` int(11) NOT NULL,
  `letter` char(1) NOT NULL,
  `kana` varchar(255) NOT NULL,
  `language` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `fk_parent_cat` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `order_by` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `kana`
--

CREATE TABLE `kana` (
  `id` int(11) NOT NULL,
  `fk_word` int(11) NOT NULL,
  `romaji` varchar(255) NOT NULL,
  `kana` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `kanji`
--

CREATE TABLE `kanji` (
  `id` int(11) NOT NULL,
  `fk_word` int(11) NOT NULL,
  `kanji` varchar(255) NOT NULL,
  `onyomi` varchar(255) NOT NULL,
  `kunyomi` varchar(255) NOT NULL,
  `meaning` varchar(255) NOT NULL,
  `strokes` int(11) NOT NULL,
  `jouyou` char(1) NOT NULL,
  `jlpt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `kdlt`
--

CREATE TABLE `kdlt` (
  `id` int(11) NOT NULL,
  `fk_word` int(11) NOT NULL,
  `kdlt` float NOT NULL,
  `chapter` int(11) NOT NULL,
  `kanji` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `story` text NOT NULL,
  `note` text NOT NULL,
  `component` text NOT NULL,
  `strokes` int(11) NOT NULL,
  `jouyou` char(1) NOT NULL,
  `jlpt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_word` int(11) NOT NULL,
  `note` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `next_revision` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `incription` datetime NOT NULL DEFAULT current_timestamp(),
  `fk_user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `incription`, `fk_user_type`) VALUES
(1, 'aestetica', 'info@normalux.ch', '$2y$10$/23stFZuBfCNmIxwWiDDD.5.FLj.OMMcYHDpiOMm1FuSEY2B92dkK', '2020-09-12 12:16:03', 4);

-- --------------------------------------------------------

--
-- Structure de la table `users_types`
--

CREATE TABLE `users_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users_types`
--

INSERT INTO `users_types` (`id`, `type`, `level`) VALUES
(1, 'Visiteur', 1),
(2, 'Utilisateur', 2),
(3, 'Modérateur', 4),
(4, 'Administrateur', 8);

-- --------------------------------------------------------

--
-- Structure de la table `vocabulary`
--

CREATE TABLE `vocabulary` (
  `id` int(11) NOT NULL,
  `fk_word` int(11) NOT NULL,
  `kana` varchar(255) NOT NULL,
  `kanji` varchar(255) NOT NULL,
  `translation` varchar(255) NOT NULL,
  `jlpt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `words`
--

CREATE TABLE `words` (
  `id` int(11) NOT NULL,
  `fk_word_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `words_categories`
--

CREATE TABLE `words_categories` (
  `id` int(11) NOT NULL,
  `fk_word` int(11) NOT NULL,
  `fk_category` int(11) NOT NULL,
  `order_by` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `words_types`
--

CREATE TABLE `words_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alphabet`
--
ALTER TABLE `alphabet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_word` (`fk_word`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parent_cat` (`fk_parent_cat`);

--
-- Index pour la table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Index pour la table `kana`
--
ALTER TABLE `kana`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_word` (`fk_word`);

--
-- Index pour la table `kanji`
--
ALTER TABLE `kanji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_word` (`fk_word`);

--
-- Index pour la table `kdlt`
--
ALTER TABLE `kdlt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_word` (`fk_word`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`),
  ADD KEY `fk_word` (`fk_word`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_type` (`fk_user_type`);

--
-- Index pour la table `users_types`
--
ALTER TABLE `users_types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vocabulary`
--
ALTER TABLE `vocabulary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_word` (`fk_word`);

--
-- Index pour la table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_word_type` (`fk_word_type`);

--
-- Index pour la table `words_categories`
--
ALTER TABLE `words_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_word` (`fk_word`),
  ADD KEY `fk_category` (`fk_category`);

--
-- Index pour la table `words_types`
--
ALTER TABLE `words_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alphabet`
--
ALTER TABLE `alphabet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `kana`
--
ALTER TABLE `kana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `kanji`
--
ALTER TABLE `kanji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `kdlt`
--
ALTER TABLE `kdlt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users_types`
--
ALTER TABLE `users_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vocabulary`
--
ALTER TABLE `vocabulary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `words`
--
ALTER TABLE `words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `words_categories`
--
ALTER TABLE `words_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `words_types`
--
ALTER TABLE `words_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alphabet`
--
ALTER TABLE `alphabet`
  ADD CONSTRAINT `alphabet_ibfk_1` FOREIGN KEY (`fk_word`) REFERENCES `words` (`id`);

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`fk_parent_cat`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `kana`
--
ALTER TABLE `kana`
  ADD CONSTRAINT `kana_ibfk_1` FOREIGN KEY (`fk_word`) REFERENCES `words` (`id`);

--
-- Contraintes pour la table `kanji`
--
ALTER TABLE `kanji`
  ADD CONSTRAINT `kanji_ibfk_1` FOREIGN KEY (`fk_word`) REFERENCES `words` (`id`);

--
-- Contraintes pour la table `kdlt`
--
ALTER TABLE `kdlt`
  ADD CONSTRAINT `kdlt_ibfk_1` FOREIGN KEY (`fk_word`) REFERENCES `words` (`id`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`fk_word`) REFERENCES `words` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_user_type`) REFERENCES `users_types` (`id`);

--
-- Contraintes pour la table `vocabulary`
--
ALTER TABLE `vocabulary`
  ADD CONSTRAINT `vocabulary_ibfk_1` FOREIGN KEY (`fk_word`) REFERENCES `words` (`id`);

--
-- Contraintes pour la table `words`
--
ALTER TABLE `words`
  ADD CONSTRAINT `words_ibfk_1` FOREIGN KEY (`fk_word_type`) REFERENCES `words_types` (`id`);

--
-- Contraintes pour la table `words_categories`
--
ALTER TABLE `words_categories`
  ADD CONSTRAINT `words_categories_ibfk_1` FOREIGN KEY (`fk_word`) REFERENCES `words` (`id`),
  ADD CONSTRAINT `words_categories_ibfk_2` FOREIGN KEY (`fk_category`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
