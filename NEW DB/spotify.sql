-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 14 nov. 2021 à 23:44
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `spotify`
--

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `gender` enum('male','female','other','') NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`artist_id`, `name`, `bio`, `gender`, `date_of_birth`) VALUES
(1, 'Lady Gaga', 'Stefani Joanne Angelina Germanotta, known professionally as Lady Gaga, is an American singer, songwriter, and actress. She is known for her image reinventions and musical versatility. Gaga began performing as a teenager, singing at open mic nights, and ac', 'female', '1986-03-28'),
(2, 'Eminem', 'Marshall Bruce Mathers III, known professionally as Eminem, is an American rapper, songwriter, and record producer. Eminem is among the best-selling music artists of all time, with estimated worldwide sales of over 220 million records.', 'male', '1972-10-17'),
(3, 'Neil Young', 'Neil Percival Young OC OM is a Canadian-American singer-songwriter, musician, and activist. After embarking on a music career in Winnipeg in the 1960s, Young moved to Los Angeles, joining Buffalo Springfield with Stephen Stills, Richie Furay and others. ', 'male', '1945-11-12'),
(4, 'Tina Turner', 'Tina Turner is an American-born Swiss singer, songwriter, and actress. Widely referred to as the \"Queen of Rock \'n\' Roll\", she is regarded as one of the greatest music artists of the 20th century.', 'female', '1939-11-26'),
(5, 'Justin Bieber', 'Justin Drew Bieber is a Canadian singer. He was discovered by American record executive Scooter Braun and signed with RBMG Records in 2008, gaining recognition with the release of his debut seven-track EP My World and soon establishing himself as a teen i', 'male', '1994-03-01'),
(6, 'Taylor Swift', 'Taylor Alison Swift is an American singer-songwriter. Her narrative songwriting, which is often inspired by her personal life, has received widespread media coverage and critical praise. Born in West Reading, Pennsylvania, Swift relocated to Nashville, Te', 'female', '1989-12-13'),
(7, 'Peppermint', 'Peppermint, or Miss Peppermint, is an American actress, singer, songwriter, television personality, drag queen, and activist from New York City. She is best known from the nightlife scene and, in 2017, as the runner-up on the ninth season of RuPaul\'s Drag', 'other', '0000-00-00'),
(8, 'Ryan Cassata', 'Ryan Otto Cassata is an American musician, public speaker, writer, filmmaker, and actor. Cassata speaks at high schools and universities on the subject of gender dysphoria, being transgender, bullying and his personal transition from female to male, inclu', 'other', '1993-12-13'),
(9, 'Deadmau5', 'Joel Thomas Zimmerman, known professionally as Deadmau5, is a Canadian electronic music producer, DJ, and musician. He mainly produces progressive house music, though he also produces and DJs other genres of electronic music, including techno under the al', 'male', '1981-01-05'),
(10, 'Monika Kruse', 'Monika Kruse is a German techno DJ/producer and record label owner, with a career in electronic music spanning more than 25 years.', 'female', '1971-07-23');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `categ_id` int(11) NOT NULL,
  `categ_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categ_id`, `categ_name`) VALUES
(1, 'pop'),
(2, 'rock'),
(3, 'rap'),
(4, 'hip-hop'),
(5, 'electro'),
(6, 'oldies');

-- --------------------------------------------------------

--
-- Structure de la table `playlists`
--

CREATE TABLE `playlists` (
  `playlist_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `creation_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `playlists`
--

INSERT INTO `playlists` (`playlist_id`, `title`, `creation_date`, `user_id`) VALUES
(1, 'chill', '2021-10-25', 1),
(2, 'What up!?', '2021-08-10', 3),
(3, 'Are you nuts?', '2021-04-15', 4),
(4, 'Only for today', '2016-11-16', 7),
(5, 'Top 2021', '2021-10-25', 1),
(6, 'Afterwork', '2021-08-10', 3),
(7, 'Weekend vibes', '2021-04-15', 4),
(8, 'Hits  2016', '2016-11-16', 7);

-- --------------------------------------------------------

--
-- Structure de la table `playlist_content`
--

CREATE TABLE `playlist_content` (
  `playlist_content_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

CREATE TABLE `songs` (
  `song_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `release_date` date NOT NULL,
  `categ_id` int(11) DEFAULT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`song_id`, `title`, `release_date`, `categ_id`, `artist_id`) VALUES
(1, 'Strobe', '2009-09-03', 5, 9),
(2, 'Golden Eye', '1995-11-06', 6, 4),
(3, 'Shake That', '2006-01-17', 3, 2),
(4, 'Pokerface', '2008-09-23', 1, 1),
(5, 'Strobe', '2009-09-03', 5, 9),
(6, 'We Don\'t Need Another Hero', '1985-05-13', 6, 4),
(7, 'Lose yourself', '2002-01-17', 3, 2),
(8, 'Papparazzi', '2008-09-23', 1, 1),
(9, 'sands', '2009-09-03', 5, 9),
(10, 'There Might Be Coffee', '2012-09-03', 5, 9);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Jempi', 'Drucker', 'jempi@gmail.com', '21564'),
(3, 'Pierrette', 'Girardin', 'pierrette55@gmail.com', '454684'),
(4, 'Jerry', 'Detz', 'jerry.cool@gmail.com', '458631'),
(7, 'Thierry', 'Bonnevoie', 'thierry@gmail.com', '892471');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categ_id`);

--
-- Index pour la table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Index pour la table `playlist_content`
--
ALTER TABLE `playlist_content`
  ADD PRIMARY KEY (`playlist_content_id`),
  ADD KEY `playlist_id` (`playlist_id`) USING BTREE,
  ADD KEY `song_id` (`song_id`) USING BTREE;

--
-- Index pour la table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `categ_id` (`categ_id`) USING BTREE,
  ADD KEY `artist_id` (`artist_id`) USING BTREE;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `categ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `playlist_content`
--
ALTER TABLE `playlist_content`
  MODIFY `playlist_content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `playlist_content`
--
ALTER TABLE `playlist_content`
  ADD CONSTRAINT `playlist_content_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`playlist_id`),
  ADD CONSTRAINT `playlist_content_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);

--
-- Contraintes pour la table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`categ_id`) REFERENCES `categories` (`categ_id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
