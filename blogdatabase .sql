-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 05 juil. 2021 à 08:56
-- Version du serveur :  8.0.23
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blogdatabase`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `articleId` int NOT NULL AUTO_INCREMENT,
  `author` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `chapo` varchar(100) NOT NULL,
  `categoryId` int NOT NULL,
  `content` text NOT NULL,
  `readTime` tinyint NOT NULL,
  `imgUrl` varchar(100) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`articleId`),
  KEY `categoryId` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`articleId`, `author`, `title`, `chapo`, `categoryId`, `content`, `readTime`, `imgUrl`, `createdAt`, `updatedAt`) VALUES
(1, 'Florent Ascensio', 'mon premier article du blog', 'c\'est mon premier article du blog', 1, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n&#39;a pas fait que survivre cinq siècles, mais s&#39;est aussi adapté à la bureautique informatique, sans que son contenu n&#39;en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 2, 'blue', '2021-06-07 13:18:37', '2021-06-09 13:32:32'),
(10, 'Florent Ascensio', 'mon nouveau titre', 'c\'est super ce nouveau titre ', 2, 'Contrairement à une opinion répandue, le Lorem Ipsum n&#39;est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s&#39;est intéressé à un des mots latins les plus obscurs, consectetur, extrait d&#39;un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du &#34;De Finibus Bonorum et Malorum&#34; (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l&#39;éthique. Les premières lignes du Lorem Ipsum, &#34;Lorem ipsum dolor sit amet...&#34;, proviennent de la section 1.10.32.', 5, 'brown', '2021-06-07 14:44:39', '2021-06-07 14:44:39'),
(17, 'Florent Ascensio', 'le titre de mon autre article', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum del', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in', 2, 'purple', '2021-06-18 14:34:57', '2021-06-18 14:34:57'),
(18, 'Florent Ascensio', 'mon cinquieme article au top', 'c\'est un nouveau chapo super interressant', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, 'brown', '2021-06-23 09:09:58', '2021-06-23 13:15:05'),
(21, 'Florent Ascensio', 'mon cinquieme article au top', 'c\'est un nouveau chapo super interressant', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, 'blue', '2021-06-23 09:25:45', '2021-06-23 09:25:45'),
(25, 'Florent Ascensio', 'mon nouveau titre', 'c\'est super ce nouveau titre encore', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, 'green', '2021-06-23 09:31:15', '2021-06-23 13:17:02'),
(26, 'Florent Ascensio', 'mon 4ieme article', 'voici le chapo de mon troisième article', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 5, 'orange', '2021-06-23 09:36:44', '2021-06-23 11:40:51');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `createdAt`) VALUES
(1, 'Development', '2021-06-07 10:04:17'),
(2, 'UI design', '2021-06-08 13:39:48'),
(3, 'UX design', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `commentId` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `articleId` int NOT NULL,
  `content` text NOT NULL,
  `isValid` tinyint NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` date NOT NULL,
  PRIMARY KEY (`commentId`),
  KEY `comment_ibfk_2` (`articleId`),
  KEY `comment_ibfk_1` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`commentId`, `userId`, `articleId`, `content`, `isValid`, `createdAt`, `updatedAt`) VALUES
(1, 1, 1, 'comment ça va !!', 1, '2021-06-09 10:36:31', '2021-06-15'),
(16, 2, 10, 'je laisse un premier commentaire !!', 1, '2021-06-15 11:50:51', '2021-06-15'),
(17, 2, 10, 'je laisse un autre commentaire', 1, '2021-06-15 11:51:38', '2021-06-15'),
(18, 1, 10, 'c\'est un article interressant !!!', 1, '2021-06-15 11:52:26', '2021-06-15'),
(21, 1, 1, 'ceci est un commentaire !!', 1, '2021-06-17 10:38:53', '2021-06-17'),
(23, 1, 1, 'ceci est un commentaire d\'aujourdhui !!', 1, '2021-06-17 17:52:31', '2021-06-29'),
(24, 1, 1, 'waou !! c\'est genial !!', 0, '2021-06-18 05:02:09', '2021-06-18'),
(25, 8, 26, 'je laisse un commentaire de ouf !!!', 1, '2021-07-03 15:23:36', '2021-07-03'),
(26, 8, 26, 'second commentaire laissé', 0, '2021-07-03 15:30:22', '2021-07-03');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`userId`, `username`, `email`, `password`, `isAdmin`, `createdAt`, `updatedAt`) VALUES
(1, 'flo654', 'flo654@hotmail.com', '123456', 1, '2021-06-09 09:38:54', '2021-06-09 09:38:54'),
(2, 'bob1973', 'bob@bob.com', '$2y$10$Flu.oxF.cH3pic5hqdRN5uN9L5q8o71c8bpOJGG3GnDPj5rqYiXuC', 0, '2021-06-09 16:10:44', '2021-06-09 16:10:44'),
(8, 'admin', 'admin@admin.com', '$2y$10$4kAGChbBjbnAZRe8trI./u1ZAxLmoHZkMxetqI1Jw1MPo8h0/tQvq', 1, '2021-07-03 15:15:38', '2021-07-03 15:15:38');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`articleId`) REFERENCES `article` (`articleId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
