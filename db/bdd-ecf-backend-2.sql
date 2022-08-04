SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id_etudiant` int(3) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `nom` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id_etudiant`, `prenom`, `nom`) VALUES
(1, 'Joseph', 'Biblo'),
(2, 'Paul', 'Bismuth'),
(3, 'Jean', 'Michel'),
(4, 'Ted', 'Bundy'),
(5, 'Caroline', 'Martinez'),
(6, 'Joséphine', 'Henry'),
(7, 'Eric', 'Duval'),
(8, 'Phil', 'Rocando'),
(9, 'Dan', 'Shefield'),
(10, 'Bill', 'Murray'),
(11, 'Catherine', 'Orvak'),
(12, 'Cindy', 'Hoper'),
(13, 'Michelle', 'Sakiro'),
(14, 'Luna', 'Ambino'),
(15, 'Jessica', 'Gianone'),
(16, 'Terry', 'Madox'),
(17, 'Marc', 'Lordon'),
(18, 'Bernard', 'Carino');

-- --------------------------------------------------------

--
-- Structure de la table `examens`
--

CREATE TABLE `examens` (
  `id` int(3) NOT NULL,
  `id_examen` int(3) NOT NULL,
  `id_etudiant` int(3) NOT NULL,
  `matiere` varchar(128) NOT NULL,
  `note` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `examens`
--

INSERT INTO `examens` (`id`, `id_examen`, `id_etudiant`, `matiere`, `note`) VALUES
(1, 45, 1, 'Histoire-Geographie', 10.5),
(2, 87, 1, 'Mathématiques', 14),
(3, 87, 2, 'Mathématiques', 4),
(4, 45, 2, 'Histoire-Geographie', 15.5),
(5, 45, 3, 'Histoire-Geographie', 8),
(6, 87, 3, 'Mathématiques', 14),
(7, 45, 4, 'Histoire-Geographie', 9.5),
(8, 45, 5, 'Histoire-Geographie', 13),
(9, 45, 6, 'Histoire-Geographie', 17),
(10, 87, 4, 'Mathématiques', 7.5),
(11, 45, 7, 'Histoire-Geographie', 10.5),
(12, 87, 5, 'Mathématiques', 14),
(13, 87, 6, 'Mathématiques', 4),
(14, 45, 8, 'Histoire-Geographie', 15.5),
(15, 87, 8, 'Mathématiques', 8),
(16, 87, 7, 'Mathématiques', 14),
(17, 45, 9, 'Histoire-Geographie', 9.5),
(18, 87, 9, 'Mathématiques', 13),
(19, 45, 10, 'Histoire-Geographie', 17),
(20, 87, 10, 'Mathématiques', 13),
(21, 87, 11, 'Mathématiques', 2),
(22, 45, 11, 'Histoire-Geographie', 15),
(23, 45, 12, 'Histoire-Geographie', 8.5),
(24, 87, 12, 'Mathématiques', 11),
(25, 45, 13, 'Histoire-Geographie', 19.5),
(26, 45, 14, 'Histoire-Geographie', 13),
(27, 45, 15, 'Histoire-Geographie', 14),
(28, 87, 13, 'Mathématiques', 7.5),
(29, 45, 17, 'Histoire-Geographie', 10.5),
(30, 87, 14, 'Mathématiques', 14.5),
(31, 87, 15, 'Mathématiques', 9),
(32, 45, 16, 'Histoire-Geographie', 13),
(33, 87, 16, 'Mathématiques', 18),
(34, 87, 17, 'Mathématiques', 16),
(35, 45, 18, 'Histoire-Geographie', 9),
(36, 87, 18, 'Mathématiques', 13.5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id_etudiant`);

--
-- Index pour la table `examens`
--
ALTER TABLE `examens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id_etudiant` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `examens`
--
ALTER TABLE `examens`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=798;

--
-- Contraintes pour les tables déchargées
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
