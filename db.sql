-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le :  mar. 27 fév. 2018 à 15:12
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `picture` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table des articles';

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `user_id`, `title`, `content`, `picture`) VALUES
(3, 1, 'web', 'Le World Wide Web (WWW), littÃ©ralement la Â« toile (d\'araignÃ©e) mondiale Â», communÃ©ment appelÃ© le Web, et parfois la Toile, est un systÃ¨me hypertexte public fonctionnant sur Internet. Le Web permet de consulter, avec un navigateur, des pages accessibles sur des sites.', 'http://www.flagrantdelit.ca/wp-content/uploads/2017/12/web.png'),
(4, 1, 'php', 'Le langage PHP fut crÃ©Ã© en 1994 par Rasmus Lerdorf pour son site web. C\'Ã©tait Ã  l\'origine une bibliothÃ¨que logicielle en C7 dont il se servait pour conserver une trace des visiteurs qui venaient consulter son CV. Au fur et Ã  mesure qu\'il ajoutait de nouvelles fonctionnalitÃ©s, Rasmus a transformÃ© la bibliothÃ¨que en une implÃ©mentation capable de communiquer avec des bases de donnÃ©es et de crÃ©er des applications dynamiques et simples pour le Web. Rasmus dÃ©cida alors en 1995 de publier son code, pour que tout le monde puisse l\'utiliser et en profiter8. PHP s\'appelait alors PHP/FI (pour Personal Home Page Tools/Form Interpreter). En 1997, deux Ã©tudiants, Andi Gutmans et Zeev Suraski, redÃ©veloppÃ¨rent le cÅ“ur de PHP/FI. Ce travail aboutit un an plus tard Ã  la version 3 de PHP, devenu alors PHP: Hypertext Preprocessor. Peu de temps aprÃ¨s, Andi Gutmans et Zeev Suraski commencÃ¨rent la rÃ©Ã©criture du moteur interne de PHP.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ98PV6CV-vYpiesP50ee4SsOT5A-mkKrTTbKvg91eRkc_imYZdBQ'),
(6, 3, 'ford', 'C\'est le 16 juin 1903, qu\'Henry Ford crÃ©e la Ford Motor Company avec le soutien de onze investisseurs3 ayant rÃ©uni un capital de 28 000 dollars en espÃ¨ces4. Les premiÃ¨res voitures seront livrÃ©es le 23 juillet 19035.\r\n\r\nL\'usine est installÃ©e dans une ancienne fabrique de fiacres de DÃ©troit, elle connaÃ®t des dÃ©buts difficiles. Mais Henry Ford fourmille d\'idÃ©es : en cinq ans, il crÃ©e dix-neuf modÃ¨les diffÃ©rents. L\'entreprise importe du caoutchouc du Congo lÃ©opoldien pour la fabrication de pneus et piÃ¨ces de moteurs.', 'ford.png'),
(7, 1, 'java', 'Java est le nom dâ€™une technologie mise au point par Sun Microsystems (rachetÃ© par Oracle en 2010) qui permet de produire des logiciels indÃ©pendants de toute architecture matÃ©rielle. Cette technologie sâ€™appuie sur diffÃ©rents Ã©lÃ©ments qui, par abus de langage, sont souvent tous appelÃ©s Java', 'https://www.coaxys.com/file/competences/java/java-icon.svg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `blog` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `gender` int(11) NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table des utilisateurs';

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `blog`, `email`, `password`, `gender`, `avatar`) VALUES
(1, 'hichem', 'mon blog', 'hichem@gmail.com', '1234', 0, 'avatar1'),
(2, 'ali', 'web', 'ali@gmail.com', 'lolo', 0, 'avatar2'),
(3, 'samirb', 'voitures', 'samir@gmail.com', '1234', 0, 'avatar2'),
(4, 'ann22', 'mode ', 'ann@gmail.com', '1234', 1, 'avatar6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
