-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 12 Avril 2019 à 11:34
-- Version du serveur :  5.7.25-0ubuntu0.18.04.2
-- Version de PHP :  7.2.17-1+ubuntu18.04.1+deb.sury.org+3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chat_fr`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id_amis` int(11) NOT NULL,
  `id_m_demandeur` int(11) NOT NULL,
  `id_m_receveur` int(11) NOT NULL,
  `conv_debute` int(1) NOT NULL DEFAULT '0' COMMENT '0 = non || 1 = oui',
  `statut` int(1) NOT NULL DEFAULT '0' COMMENT '0 = attente | 1 = accpt | 2 = refus'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `amis`
--

INSERT INTO `amis` (`id_amis`, `id_m_demandeur`, `id_m_receveur`, `conv_debute`, `statut`) VALUES
(63, 116, 1, 1, 1),
(64, 117, 1, 0, 1),
(65, 116, 110, 1, 1),
(66, 116, 112, 0, 1),
(67, 116, 117, 1, 1),
(68, 116, 118, 1, 1),
(69, 114, 110, 1, 1),
(70, 119, 118, 0, 0),
(71, 118, 119, 1, 3),
(72, 114, 116, 0, 1),
(73, 114, 1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `chatg`
--

CREATE TABLE `chatg` (
  `id_mess` int(11) NOT NULL,
  `id_m` varchar(20) NOT NULL,
  `id_n_m` int(10) NOT NULL,
  `photo_m` varchar(150) NOT NULL,
  `mess_post_g` varchar(255) NOT NULL,
  `date_m_serv_g` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

CREATE TABLE `signalement` (
  `id_signalement` int(10) NOT NULL,
  `id_m_signaler` int(10) NOT NULL,
  `id_mess_signaler` int(10) DEFAULT NULL,
  `statut` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL DEFAULT 'no-photo.jpg',
  `humeur` varchar(255) DEFAULT NULL,
  `description` text,
  `centre_interet` varchar(255) DEFAULT NULL,
  `fav_m` varchar(100) DEFAULT NULL,
  `all_mess` int(1) NOT NULL DEFAULT '0' COMMENT '0 = non | 1 = oui',
  `statut_m` int(11) NOT NULL DEFAULT '0' COMMENT '10 = webmaster | 9 = ADMIN | 5 = MODO | 0 = lambda user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `e_mail`, `photo`, `humeur`, `description`, `centre_interet`, `fav_m`, `all_mess`, `statut_m`) VALUES
(1, 'jonas ', '$2y$10$yTAlaO3Jykw40vs90033oOuAcbA9jMHg3EUBt7vaF/.mLLJ2KVbJO', 'jonas.bertindev@gmail.com', 'rainette.jpg', 'Je suis le webmaster', 'Bonjour,\r\n\r\nPour toute demande, veuillez me contacter par message privÃ©\r\n\r\nBonne journÃ©e sur le service', '  PHP, informatique, dÃ©veloppement, SÃ©curitÃ©', NULL, 1, 10);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id_amis`),
  ADD KEY `id_receveur` (`id_m_demandeur`);

--
-- Index pour la table `chatg`
--
ALTER TABLE `chatg`
  ADD PRIMARY KEY (`id_mess`);

--
-- Index pour la table `signalement`
--
ALTER TABLE `signalement`
  ADD PRIMARY KEY (`id_signalement`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `id_amis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT pour la table `chatg`
--
ALTER TABLE `chatg`
  MODIFY `id_mess` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT pour la table `signalement`
--
ALTER TABLE `signalement`
  MODIFY `id_signalement` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
