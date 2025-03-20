-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 04 fév. 2025 à 13:58
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appfaq`
--

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id_faq` bigint(11) NOT NULL,
  `question` text NOT NULL,
  `reponse` text NULL,
  `dat_question` datetime NOT NULL,
  `dat_reponse` datetime NULL,
  `id_user` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

CREATE TABLE `ligue` (
  `id_ligue` bigint(11) NOT NULL,
  `lib_ligue` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`id_ligue`, `lib_ligue`, `image`, `description`) VALUES
(1, 'Toutes les ligues', 'no.png', 'no_desc'),
(2, 'Football', 'football.png', "Notre club de football dispose de plusieurs terrains d'entraînement et de matchs. Si vous souhaitez nous rencontrer, observer un entraînement ou inscrire votre enfant, vous trouverez ci-dessus l'adresse de notre terrain pour venir nous voir."),
(3, 'Basket', 'basket.png', "Notre club de basketball offre des terrains modernes pour les entraînements et les matchs. Si vous souhaitez assister à une séance d'entraînement ou inscrire votre enfant, vous trouverez ci-dessus l'adresse de notre salle de sport où nous serons heureux de vous accueillir."),
(4, 'Volley', 'volley.png', "Notre club de volleyball met à votre disposition des terrains spécialement conçus pour l'entraînement et les compétitions. Si vous souhaitez découvrir nos entraînements ou inscrire votre enfant, n'hésitez pas à venir nous rencontrer à l'adresse indiquée ci-dessus."),
(5, 'Handball', 'handball.png', "Notre club de handball propose des terrains adaptés pour les entraînements et les matchs. Si vous souhaitez voir comment se déroule un entraînement ou inscrire votre enfant, vous trouverez ci-dessus l'adresse de notre complexe sportif où nous serons ravis de vous rencontrer.");
-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(20) NOT NULL,
  `id_usertype` bigint(11) NOT NULL,
  `id_ligue` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `mdp`, `mail`, `id_usertype`, `id_ligue`) VALUES
(1, 'User', '$2y$10$zH1Ff5S68Mv1P66QgGGYMenADsP84LDMhWM06iJ.v4j5MRqft1oty', 'user@m2l.com', 1, 2),
(2, 'Admin', '$2y$10$.OiOM5sPEGMLyA6ONUurqOPgZaEHsZnq7mb2GapH74HCC7Z867.mO', 'admin@m2l.com', 2, 2),
(3, 'Super-Admin', '$2y$10$h2MmUwWo8c18iDI0asBgiOD4qDbOcMZoLphmmNjPYFGlC09KEVjHG', 'super-admin@m2l.com', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `usertype`
--

CREATE TABLE `usertype` (
  `id_usertype` bigint(11) NOT NULL,
  `lib_usertype` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `usertype`
--

INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `description`) VALUES
(1, 'Utilisateur', 'Un utilisateur peut s’inscrire, se connecter, afficher la liste des messages, poser une question et se\r\ndéconnecter. Il est associé à une et une seule ligue. S\'il pose une question, elle est aussi associée à cette ligue.'),
(2, 'Administrateur', 'Un administrateur peut s’inscrire, se connecter, afficher la liste des messages, répondre à une question,\r\nmodifier et supprimer un message. Il est associé à une et une seule ligue. Il ne peut gérer que les messages de\r\nSA ligue'),
(3, 'Super Administrateur', 'Un super administrateur a les mêmes droits qu\'un administrateur à ceci près qu\'il peut intervenir que sur les\r\nmessages de TOUTES les ligues.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`),
  ADD KEY `redige` (`id_user`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`id_ligue`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `appartient` (`id_ligue`),
  ADD KEY `est de type` (`id_usertype`);

--
-- Index pour la table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id_usertype`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `id_ligue` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id_usertype` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `redige` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `appartient` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`),
  ADD CONSTRAINT `est de type` FOREIGN KEY (`id_usertype`) REFERENCES `usertype` (`id_usertype`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
