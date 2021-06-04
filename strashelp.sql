-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 04 juin 2021 à 11:10
-- Version du serveur :  8.0.25-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `strashelp`
--

-- --------------------------------------------------------
SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
--
-- Structure de la table `advert`
--

CREATE TABLE `advert` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` varchar(200) NOT NULL,
  `disponibility_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `advert`
--

INSERT INTO `advert` (`id`, `category_id`, `user_id`, `title`, `description`, `disponibility_id`) VALUES
(1, 15, 4, 'Dressage ', 'Experience de plus de 20 ans dans le domaine notament à l\'international', 6),
(2, 6, 4, 'Coeur de JavaScript', 'Cours de programmation sur le plus beau  language.\r\nLe JavaScript', 5),
(4, 5, 13, 'jardins aménagement', 'je propose mes services pour vous aider a aménager votre extérieur.', 2),
(5, 4, 8, 'Decoration de tapis', 'Je dispose d\'une large gamme de tapis pour décorer vos interieur.', 8),
(6, 9, 8, 'Cuisinier', 'Je propose des cours de cuisine en communn pour les personnes de mon entourages !  \r\n', 9),
(7, 7, 12, 'Gestion du temp', 'Je vous propose mon aide afin de mieux gérer votre emploi du temp.', 9),
(8, 8, 10, 'Gestion des finances', 'etant passer  dans une mauvaise passe je propose mon aide et quelque conseil pour gérer son budget.', 2),
(55, 10, 12, 'entretien', 'Cours de mécanique , comment faire l\'entretien de sa voiture soi même ? ', 7),
(56, 13, 13, 'informatique', 'Je me propose de vous aider dans vos problémes d\'informatique a la maison ! ', 3),
(57, 14, 12, 'Seance de sport en commun', 'etant coach sportif je propose une séance de sport par semaine pour les personne de mon quartier.', 10),
(58, 16, 8, 'Balade a cheval', 'Je propose des balades a cheval dans l\'optique d\'habituer mon cheval a l\'humain.', 9);

-- --------------------------------------------------------

--
-- Structure de la table `adverthelp`
--

CREATE TABLE `adverthelp` (
  `id` int NOT NULL,
  `advert_id` int NOT NULL,
  `user_id` int NOT NULL,
  `message` varchar(255) NOT NULL,
  `isValidate` tinyint(1) NOT NULL,
  `date` varchar(100) NOT NULL,
  `id_chat` varchar(255) NOT NULL,
  `id_author` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `adverthelp`
--

INSERT INTO `adverthelp` (`id`, `advert_id`, `user_id`, `message`, `isValidate`, `date`, `id_chat`, `id_author`) VALUES
(75, 2, 4, 'Bonjour je souhaite apprendre le plus beau language de programmation du monde, seriez vous disponible tres prochainement ?', 0, '2021 , 05 ,02 , 16:37:18', '608ed53e2e8e4', 13),
(76, 2, 4, 'Avec plaisire, ok pour samedis ?', 0, '2021 , 05 , 02, 16:38:24', '608ed53e2e8e4', 4),
(78, 4, 13, 'Bonjour, mon concurent heberge chez ovh, j\'aurais besoins d un petit incendi.', 0, '2021 , 05 ,02 , 16:41:26', '608ed63679291', 4),
(79, 4, 13, 'Super feu de la saint jean Merci encore', 1, '2021 , 05 , 02, 16:41:52', '608ed63679291', 4),
(87, 5, 8, 'Bonjour je souhaiterais faire l\'acquisitions d\'un jolie tapis.', 0, '2021 , 05 ,02 , 16:56:28', '608ed9bccd6ea', 4),
(88, 5, 8, 'Meric beaucoup', 1, '2021 , 05 , 02, 16:57:09', '608ed9bccd6ea', 4),
(91, 1, 4, 'Need help please.', 0, '2021 , 05 ,03 , 05:13:33', '608f867df410b', 10),
(92, 1, 4, 'Really nice thanks.', 1, '2021 , 05 , 03, 05:13:45', '608f867df410b', 10),
(93, 1, 4, 'Bonjourno, yé besoins d\'une coup de mano.', 0, '2021 , 05 ,03 , 05:15:18', '608f86e667372', 12),
(94, 1, 4, 'Magnifico', 1, '2021 , 05 , 03, 05:15:26', '608f86e667372', 12);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(4, 'Travaux d\'intérieur'),
(5, 'Travaux d\'extérieur'),
(6, 'Education'),
(7, 'Gestion'),
(8, 'Finances'),
(9, 'Cuisine'),
(10, 'Mécanique'),
(13, 'Informatique'),
(14, 'sport'),
(15, 'animaux'),
(16, 'Loisir');

-- --------------------------------------------------------

--
-- Structure de la table `disponibility`
--

CREATE TABLE `disponibility` (
  `id` int NOT NULL,
  `timeTable` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `disponibility`
--

INSERT INTO `disponibility` (`id`, `timeTable`) VALUES
(2, 'En journée --La semaine'),
(3, 'En journée --Le week-end'),
(5, 'En soirée --Le week-end'),
(6, 'Soir et Week-End'),
(7, 'Samedi'),
(8, 'Dimanche'),
(9, 'Autres'),
(10, 'En Soirée -- La Semaine');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `advert_id` int NOT NULL,
  `user_id` int NOT NULL,
  `advertHelp_id` int NOT NULL,
  `rate` int NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `advert_id`, `user_id`, `advertHelp_id`, `rate`, `comment`, `date`) VALUES
(25, 4, 4, 79, 5, 'Magnifique prestation, Mr Kuttuk est un vrais professionnel', '2021 , 05 , 16:42:16'),
(28, 5, 4, 88, 1, 'Personne nonchalente ayant très peu de gout .', '2021 , 05 , 16:57:37'),
(30, 1, 10, 92, 5, 'The best.', '2021 , 05 , 05:13:55'),
(31, 1, 12, 94, 5, 'Magnifico', '2021 , 05 , 05:15:34');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `lastName` varchar(80) NOT NULL,
  `firstName` varchar(80) NOT NULL,
  `age` date NOT NULL,
  `mail` varchar(80) NOT NULL,
  `phoneNumber` int NOT NULL,
  `password` varchar(80) NOT NULL,
  `adresseNumber` int NOT NULL,
  `adresseStreet` varchar(80) NOT NULL,
  `adresseCity` varchar(80) NOT NULL,
  `adressePostal` int NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `rang` int NOT NULL DEFAULT '0',
  `badge` int NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `lastName`, `firstName`, `age`, `mail`, `phoneNumber`, `password`, `adresseNumber`, `adresseStreet`, `adresseCity`, `adressePostal`, `avatar`, `isAdmin`, `rang`, `badge`) VALUES
(4, 'Klipfel', 'Nicolas', '1986-07-26', 'nos@gmail.com', 923564178, '$2y$10$F39NCIMqIVTjUJyj/TPJYueLw.3z3PuB2eTzga7lHebzCrbSlREAa', 3, 'place de l\'eglise', 'Obernai', 67210, '60828c88e96a2.jpg', 1, 2, 5),
(8, 'Lebowski', 'Jeffrey', '1963-09-15', 'lebowski@boowling.com', 987654123, '$2y$10$oaEdrm1usbruT6oRC9RjbefWLTM/V75AQfEVu8t/Cu9pqVGz9/SJm', 956, 'Long Street', 'Los Angeles', 998745, '60812f408e84c.jpeg', 0, 0, 3),
(10, 'Winnfield', 'Jules', '1973-08-07', 'winnfield@pulp.com', 53560, '$2y$10$c/vAiMisTccP.wCtN1.aM.SoHftEzDnJjCk0Q0WaRZKySmJqnQsuS', 44, 'Long Beach', 'Los Angeles', 7778585, '608278618624f.jpeg', 0, 1, 2),
(12, 'Pesci', 'joe', '1951-09-28', 'affranchis@gmail.com', 55566884, '$2y$10$o2Qwlx8DxKvHWxmf0XT23e/6r0d055Y6teXdYuiVCZ7UySVjOSVIS', 31, 'Brooklyn Street', 'New York', 369852, '60828d2c64a57.jpeg', 0, 0, 1),
(13, 'Kuttuk', 'Yavuz', '1975-02-23', 'kuttuk@gmail.com', 626541983, '$2y$10$yqOGrCtn0D7i1KwoRE/6GOIdqIxcKi7e5saKWORnCBiNPH/Pg/8hS', 32, 'rue du fleuve', 'Strasbourg', 67100, '608ba1a5f24fd.jpg', 0, 0, 3),
(48, 'Kuntz', 'Antoine', '1999-12-30', 'Antoine.kuntz113@gmail.com', 638743706, '$2y$10$LsRMBC5sAw0P/n5XVfffee9rXCnTPBb2RShKVUQYnnuK5an8ZCgpm', 10, 'rue des jardins', 'Kolbsheim', 67120, '60b9e8e11e12a.jpg', 1, 0, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`id`,`category_id`,`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `advert_ibfk_3` (`disponibility_id`);

--
-- Index pour la table `adverthelp`
--
ALTER TABLE `adverthelp`
  ADD PRIMARY KEY (`id`,`advert_id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `advert_id` (`advert_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `disponibility`
--
ALTER TABLE `disponibility`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`,`advert_id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `advertHelp_id` (`advert_id`),
  ADD KEY `reviews_ibfk_3` (`advertHelp_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `advert`
--
ALTER TABLE `advert`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `adverthelp`
--
ALTER TABLE `adverthelp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `disponibility`
--
ALTER TABLE `disponibility`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `advert`
--
ALTER TABLE `advert`
  ADD CONSTRAINT `advert_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advert_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advert_ibfk_3` FOREIGN KEY (`disponibility_id`) REFERENCES `disponibility` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `adverthelp`
--
ALTER TABLE `adverthelp`
  ADD CONSTRAINT `adverthelp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adverthelp_ibfk_2` FOREIGN KEY (`advert_id`) REFERENCES `advert` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`advert_id`) REFERENCES `advert` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`advertHelp_id`) REFERENCES `adverthelp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
