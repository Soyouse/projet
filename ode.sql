-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 23 mai 2024 à 13:44
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ode`
--

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

DROP TABLE IF EXISTS `offres`;
CREATE TABLE IF NOT EXISTS `offres` (
  `ID_Offre` int NOT NULL AUTO_INCREMENT,
  `Titre` varchar(255) NOT NULL,
  `ID_Type` int DEFAULT NULL,
  `ID_Type_Salaire` int DEFAULT NULL,
  `Salaire` varchar(255) DEFAULT NULL,
  `Description` text NOT NULL,
  `Competences` text,
  `Niveau_Etudes` varchar(255) DEFAULT NULL,
  `Localisation` varchar(255) DEFAULT NULL,
  `Date_Publication` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_Offre`),
  KEY `ID_Type` (`ID_Type`),
  KEY `ID_Type_Salaire` (`ID_Type_Salaire`)
) ;

--
-- Déchargement des données de la table `offres`
--

INSERT INTO `offres` (`ID_Offre`, `Titre`, `ID_Type`, `ID_Type_Salaire`, `Salaire`, `Description`, `Competences`, `Niveau_Etudes`, `Localisation`, `Date_Publication`) VALUES
(60, 'Lorem ipsum', 1, 1, '1200-2000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Nulla facilisi. Ut scelerisque, ex ut sollicitudin convallis, libero sapien malesuada nisi, at ullamcorper mauris elit non risus. Fusce a cursus nisl. Integer cursus orci non justo dictum, vel tincidunt lectus tempor. Curabitur euismod sem sit amet dolor aliquet, ac pretium quam vehicula. Donec sed purus et libero faucibus feugiat vel non mauris. Cras vitae purus nisi. Proin non sem et sapien interdum suscipit. Maecenas aliquam sagittis interdum. Duis bibendum dui ut nisl vehicula, ut vestibulum nisi pulvinar.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Nulla facilisi. Ut scelerisque, ex ut sollicitudin convallis, libero sapien malesuada nisi, at ullamcorper mauris elit non risus.', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '2024-05-21 01:03:12'),
(61, 'Lorem', NULL, NULL, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Nulla facilisi. Ut scelerisque, ex ut sollicitudin convallis, libero sapien malesuada nisi, at ullamcorper mauris elit non risus. Fusce a cursus nisl. Integer cursus orci non justo dictum, vel tincidunt lectus tempor. Curabitur euismod sem sit amet dolor aliquet, ac pretium quam vehicula. Donec sed purus et libero faucibus feugiat vel non mauris. Cras vitae purus nisi. Proin non sem et sapien interdum suscipit. Maecenas aliquam sagittis interdum. Duis bibendum dui ut nisl vehicula, ut vestibulum nisi pulvinar.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Nulla facilisi. Ut scelerisque, ex ut sollicitudin convallis, libero sapien malesuada nisi, at ullamcorper mauris elit non risus. Fusce a cursus nisl. Integer cursus orci non justo dictum, vel tincidunt lectus tempor. Curabitur euismod sem sit amet dolor aliquet, ac pretium quam vehicula. Donec sed purus et libero faucibus feugiat vel non mauris. Cras vitae purus nisi. Proin non sem et sapien interdum suscipit. Maecenas aliquam sagittis interdum. Duis bibendum dui ut nisl vehicula, ut vestibulum nisi pulvinar.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Nulla facilisi. Ut scelerisque, ex ut sollicitudin convallis, libero sapien malesuada nisi, at ullamcorper mauris ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Nulla facilisi. Ut scelerisque, ex ut sollicitudin convallis, libero sapien malesuada nisi, at ullamcorper mauris ', '2024-05-21 01:05:19'),
(62, 'Proin non sem', NULL, NULL, '1200', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Nulla facilisi. Ut scelerisque, ex ut sollicitudin convallis, libero sapien malesuada nisi, at ullamcorper mauris elit non risus. Fusce a cursus nisl. Integer cursus orci non justo dictum, vel tincidunt lectus tempor. Curabitur euismod sem sit amet dolor aliquet, ac pretium quam vehicula. Donec sed purus et libero faucibus feugiat vel non mauris. Cras vitae purus nisi. Proin non sem et sapien interdum suscipit. Maecenas aliquam sagittis interdum. Duis bibendum dui ut nisl vehicula, ut vestibulum nisi pulvinar.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Nulla facilisi. Ut scelerisque, ex ut sollicitudin convallis, libero sapien malesuada nisi, at ullamcorper mauris elit non risus. Fusce a cursus nisl. Integer cursus orci non justo dictum, vel tincidunt lectus tempor. Curabitur euismod sem sit amet dolor aliquet, ac pretium quam vehicula. Donec sed purus et libero faucibus feugiat vel non mauris. Cras vitae purus nisi. Proin non sem et sapien interdum suscipit. Maecenas aliquam sagittis interdum. Duis bibendum dui ut nisl vehicula, ut vestibulum nisi pulvinar.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Nulla facilisi. Ut scelerisque, ex ut sollicitudin convallis, libero sapien malesuada nisi, at ullamcorper mauris ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Nulla facilisi. Ut scelerisque, ex ut sollicitudin convallis, libero sapien malesuada nisi, at ullamcorper mauris ', '2024-05-21 01:05:42');

-- --------------------------------------------------------

--
-- Structure de la table `salaire_type`
--

DROP TABLE IF EXISTS `salaire_type`;
CREATE TABLE IF NOT EXISTS `salaire_type` (
  `ID_Type_Salaire` int NOT NULL AUTO_INCREMENT,
  `Type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID_Type_Salaire`),
  UNIQUE KEY `Type` (`Type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `salaire_type`
--

INSERT INTO `salaire_type` (`ID_Type_Salaire`, `Type`) VALUES
(1, 'brut'),
(2, 'net');

-- --------------------------------------------------------

--
-- Structure de la table `types_contrats`
--

DROP TABLE IF EXISTS `types_contrats`;
CREATE TABLE IF NOT EXISTS `types_contrats` (
  `ID_Type` int NOT NULL AUTO_INCREMENT,
  `Type_Contrat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Type`),
  UNIQUE KEY `Type_Contrat` (`Type_Contrat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `types_contrats`
--

INSERT INTO `types_contrats` (`ID_Type`, `Type_Contrat`) VALUES
(2, 'CDD'),
(1, 'CDI'),
(4, 'Contrat d\'apprentissage'),
(3, 'Contrat professionnel');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$fzlfk.Z9nwe3hklLGA1hKOcjyR4YTmJpCoK7/v9mDqJYbx0wYXx7u', '2024-05-19 16:07:03'),
(4, 'admin123', '$2y$10$UnSd0tagWi490qJ./4RK4eErZb1nKhWYLrs2gP2dVGpxKtzDPv0Ne', '2024-05-19 16:29:50'),
(6, 'admin4321', '$2y$10$/hIAyZQZY.GSUWLX2PNzmOnAaLcM4Tr8Y2ZdO8omhdEHelClbsQhS', '2024-05-19 17:14:38'),
(7, 'dddd', '$2y$10$6uQQ.zaQuqkmZJAkScm7gOtV4Ghzo9wAlFZpZYzaPCESXhMw8F/TC', '2024-05-20 21:21:42');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `offres_ibfk_1` FOREIGN KEY (`ID_Type`) REFERENCES `types_contrats` (`ID_Type`),
  ADD CONSTRAINT `offres_ibfk_2` FOREIGN KEY (`ID_Type_Salaire`) REFERENCES `salaire_type` (`ID_Type_Salaire`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
