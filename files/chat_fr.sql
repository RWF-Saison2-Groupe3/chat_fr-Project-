-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 22 Février 2019 à 08:54
-- Version du serveur :  5.7.25-0ubuntu0.18.04.2
-- Version de PHP :  7.2.15-1+ubuntu18.04.1+deb.sury.org+1

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
-- Structure de la table `chatg`
--

CREATE TABLE `chatg` (
  `id_mess` int(11) NOT NULL,
  `id_m` varchar(20) NOT NULL,
  `photo_m` varchar(150) NOT NULL,
  `mess_post_g` varchar(255) NOT NULL,
  `date_m_serv_g` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `chatg`
--

INSERT INTO `chatg` (`id_mess`, `id_m`, `photo_m`, `mess_post_g`, `date_m_serv_g`) VALUES
(45, 'jonas ', 'kÃ©vin.jpg', 'Bonjour,  je test le chat avec diffÃ©rent traits de caractÃ¨res comme les accents, la longueur et la ponctuation !', '2019-02-21 16:16:45'),
(46, 'jack ', 'johnny-depp-confirmed-not-to-return-as-jack-sparrow-in-disneys-pirates-of-the-caribbean-reboot-social.jpg', 'Il faudra que tu me dise comment tu fait tout Ã§a !!!! ðŸ˜Š', '2019-02-21 16:18:41'),
(47, 'jack ', 'johnny-depp-confirmed-not-to-return-as-jack-sparrow-in-disneys-pirates-of-the-caribbean-reboot-social.jpg', 'Je test le script ajax', '2019-02-21 16:30:42'),
(48, 'jack ', 'johnny-depp-confirmed-not-to-return-as-jack-sparrow-in-disneys-pirates-of-the-caribbean-reboot-social.jpg', 'Test', '2019-02-21 16:36:22'),
(49, 'jack ', 'johnny-depp-confirmed-not-to-return-as-jack-sparrow-in-disneys-pirates-of-the-caribbean-reboot-social.jpg', 'Fff', '2019-02-21 16:37:42'),
(50, 'jack ', 'johnny-depp-confirmed-not-to-return-as-jack-sparrow-in-disneys-pirates-of-the-caribbean-reboot-social.jpg', 'Gggg', '2019-02-21 16:39:29'),
(51, 'jack ', 'johnny-depp-confirmed-not-to-return-as-jack-sparrow-in-disneys-pirates-of-the-caribbean-reboot-social.jpg', 'Jskoz', '2019-02-21 16:42:09'),
(52, 'risitas ', 'Screencast_20-02-2019_19:58:45.jpg', 'Bonjour je suis risitas !!!', '2019-02-21 17:32:25'),
(53, 'jonas ', 'kÃ©vin.jpg', 'ahah c\'est drole ', '2019-02-21 17:32:47');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `humeur` varchar(255) DEFAULT NULL,
  `description` text,
  `centre_interet` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `e_mail`, `photo`, `humeur`, `description`, `centre_interet`) VALUES
(31, 'jonas ', '$2y$10$sqMv7b6ntpEo56oyserZIe1D1YOB7ofPRVRF63eqlY05w4aiMLrFy', 'aaaa@gmail.com', 'kÃ©vin.jpg', NULL, NULL, NULL),
(32, 'jack ', '$2y$10$z3eqE15.GS6P/kFKf0uUPewPN9SKOPs8Yk.8YGdp7IOuVjMdIo43q', 'aaaa@gmail.com', 'johnny-depp-confirmed-not-to-return-as-jack-sparrow-in-disneys-pirates-of-the-caribbean-reboot-social.jpg', NULL, NULL, NULL),
(35, 'ouistiti ', '$2y$10$T19aYimN6FBOY0fu42xkKuQI3f1uM1yZAWks0RyPHkF0IHjhnIQ/i', 'kevin.dagneaux1@gmail.com', '1.jpg', NULL, NULL, NULL),
(36, 'fermetagueule ', '$2y$10$xltZ0PMPu9gRkdutu9VjwecMtduVF7XJ9G4VClz1NMmuqHtrfDqKq', 'ftg@ftg.com', 'logo.png', NULL, NULL, NULL),
(37, 'q ', '$2y$10$xuyEdv5wA2Ep7KjT2oR5/O3qs5Tis2xJI57pVxL9SD1gKQ.ay5cEq', 'q@q.q', NULL, NULL, NULL, NULL),
(38, 'risitas ', '$2y$10$PnqLSS5JcvJdWlcx.rTWDe78K7Wumgu2ppc98GTNirwJ/oVZ9.pCO', 'risitas@gmail.com', 'Screencast_20-02-2019_19:58:45.jpg', NULL, NULL, NULL),
(67, 'dza ', '$2y$10$BYzFQmTA8Rs.EJ3m/CS/7Oz2lt4.VTh19KF6xYLtJLq.cRv8LAx9u', 'jonas.bertin49@gmail.com', NULL, NULL, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chatg`
--
ALTER TABLE `chatg`
  ADD PRIMARY KEY (`id_mess`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chatg`
--
ALTER TABLE `chatg`
  MODIFY `id_mess` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
