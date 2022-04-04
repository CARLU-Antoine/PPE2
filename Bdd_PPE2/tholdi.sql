-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 27 mars 2022 à 17:38
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tholdi`
--

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis` (
  `codeDevis` int(9) NOT NULL,
  `dateDevis` varchar(20) NOT NULL,
  `montantDevis` decimal(8,2) NOT NULL,
  `volume` int(4) NOT NULL,
  `nbcontainers` int(11) NOT NULL,
  `valider` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`codeDevis`, `dateDevis`, `montantDevis`, `volume`, `nbcontainers`, `valider`) VALUES
(48, '2022-03-09', '16.00', 2, 2, 1),
(49, '2022-03-16', '16.00', 1, 2, 0),
(50, '2022-03-16', '16.00', 1, 2, 0),
(51, '2022-03-09', '16.00', 2, 2, 0),
(52, '2022-03-16', '163.00', 2, 14, 1),
(53, '2022-03-25', '4624.00', 2, 480, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `codePays` char(2) NOT NULL,
  `nomPays` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`codePays`, `nomPays`) VALUES
('AD', 'ANDORRE'),
('AE', 'EMIRATS ARABES UNIS'),
('AF', 'AFGHANISTAN'),
('AG', 'ANTIGUA-ET-BARBUDA'),
('AL', 'ALBANIE'),
('AM', 'ARMENIE'),
('AN', 'ANTILLES NEERLANDAIS'),
('AO', 'ANGOLA'),
('AR', 'ARGENTINE'),
('AT', 'AUTRICHE'),
('AU', 'AUSTRALIE'),
('AZ', 'AZERBAIDJAN'),
('BA', 'BOSNIE-HERZEGOVINE'),
('BB', 'BARBADE'),
('BD', 'BANGLADESH'),
('BE', 'BELGIQUE'),
('BF', 'BURKINA FASO'),
('BG', 'BULGARIE'),
('BH', 'BAHREIN'),
('BI', 'BURUNDI'),
('BJ', 'BENIN'),
('BM', 'BERMUDES'),
('BN', 'BRUNEI DARUSSALAM'),
('BO', 'BOLIVIE'),
('BR', 'BRESIL'),
('BS', 'BAHAMAS'),
('BT', 'BHOUTAN'),
('BW', 'BOTSWANA'),
('BY', 'BELARUS'),
('BZ', 'BELIZE'),
('CA', 'CANADA'),
('CD', 'CONGO (ZAIRE)'),
('CF', 'CENTRAFRICAINE, REPU'),
('CG', 'CONGO (BRAZZA)'),
('CH', 'SUISSE'),
('CI', 'COTE D\'IVOIRE'),
('CK', 'COOK, ILES'),
('CL', 'CHILI'),
('CM', 'CAMEROUN'),
('CN', 'CHINE'),
('CO', 'COLOMBIE'),
('CR', 'COSTA RICA'),
('CS', 'SERBIE-ET-MONTENEGRO'),
('CU', 'CUBA'),
('CV', 'CAP-VERT'),
('CY', 'CHYPRE'),
('CZ', 'TCHEQUIE'),
('DE', 'ALLEMAGNE'),
('DJ', 'DJIBOUTI'),
('DK', 'DANEMARK'),
('DM', 'DOMINIQUE'),
('DO', 'DOMINICAINE, REPUBL.'),
('DZ', 'ALGERIE'),
('EC', 'EQUATEUR'),
('EE', 'ESTONIE'),
('EG', 'EGYPTE'),
('ER', 'ERYTHREE'),
('ES', 'ESPAGNE'),
('ET', 'ETHIOPIE'),
('FI', 'FINLANDE'),
('FJ', 'FIDJI'),
('FM', 'MICRONESIE'),
('FR', 'FRANCE'),
('GA', 'GABON'),
('GB', 'GRANDE-BRETAGNE'),
('GD', 'GRENADE'),
('GE', 'GEORGIE'),
('GH', 'GHANA'),
('GI', 'GIBRALTAR'),
('GM', 'GAMBIE'),
('GN', 'GUINEE'),
('GQ', 'GUINEE EQUATORIALE'),
('GR', 'GRECE'),
('GT', 'GUATEMALA'),
('GU', 'GUAM'),
('GW', 'GUINEE-BISSAU'),
('GY', 'GUYANA'),
('HK', 'HONG-KONG'),
('HN', 'HONDURAS'),
('HR', 'CROATIE'),
('HT', 'HAITI'),
('HU', 'HONGRIE'),
('ID', 'INDONESIE'),
('IE', 'IRLANDE'),
('IL', 'ISRAEL'),
('IN', 'INDE'),
('IQ', 'IRAQ'),
('IR', 'IRAN'),
('IS', 'ISLANDE'),
('IT', 'ITALIE'),
('JM', 'JAMAIQUE'),
('JO', 'JORDANIE'),
('JP', 'JAPON'),
('KE', 'KENYA'),
('KG', 'KIRGHIZISTAN'),
('KH', 'CAMBODGE'),
('KI', 'KIRIBATI'),
('KM', 'COMORES'),
('KN', 'SAINT-KITTS-ET-NEVIS'),
('KP', 'COREE DU NORD'),
('KR', 'COREE DU SUD'),
('KW', 'KOWEIT'),
('KZ', 'KAZAKHSTAN'),
('LA', 'LAOS'),
('LB', 'LIBAN'),
('LC', 'SAINTE-LUCIE'),
('LI', 'LIECHTENSTEIN'),
('LK', 'SRI LANKA'),
('LR', 'LIBERIA'),
('LS', 'LESOTHO'),
('LT', 'LITUANIE'),
('LU', 'LUXEMBOURG'),
('LV', 'LETTONIE'),
('LY', 'LIBYE'),
('MA', 'MAROC'),
('MC', 'MONACO'),
('MD', 'MOLDAVIE'),
('MG', 'MADAGASCAR'),
('MH', 'MARSHALL, ILES'),
('MK', 'MACEDOINE'),
('ML', 'MALI'),
('MM', 'MYANMAR (BIRMANIE)'),
('MN', 'MONGOLIE'),
('MO', 'MACAO'),
('MR', 'MAURITANIE'),
('MT', 'MALTE'),
('MU', 'MAURICE'),
('MV', 'MALDIVES'),
('MW', 'MALAWI'),
('MX', 'MEXIQUE'),
('MY', 'MALAISIE'),
('MZ', 'MOZAMBIQUE'),
('NA', 'NAMIBIE'),
('NE', 'NIGER'),
('NG', 'NIGERIA'),
('NI', 'NICARAGUA'),
('NL', 'PAYS-BAS'),
('NO', 'NORVEGE'),
('NP', 'NEPAL'),
('NR', 'NAURU'),
('NU', 'NIUE'),
('NZ', 'NOUVELLE-ZELANDE'),
('OM', 'OMAN'),
('PA', 'PANAMA'),
('PE', 'PEROU'),
('PG', 'PAPOUASIE-NOUV.-GUIN'),
('PH', 'PHILIPPINES'),
('PK', 'PAKISTAN'),
('PL', 'POLOGNE'),
('PR', 'PORTO RICO'),
('PT', 'PORTUGAL'),
('PW', 'PALAOS'),
('PY', 'PARAGUAY'),
('QA', 'QATAR'),
('RO', 'ROUMANIE'),
('RU', 'RUSSIE'),
('RW', 'RWANDA'),
('SA', 'ARABIE SAOUDITE'),
('SB', 'SALOMON, ILES'),
('SC', 'SEYCHELLES'),
('SD', 'SOUDAN'),
('SE', 'SUEDE'),
('SG', 'SINGAPOUR'),
('SI', 'SLOVENIE'),
('SK', 'SLOVAQUIE'),
('SL', 'SIERRA LEONE'),
('SM', 'SAINT-MARIN'),
('SN', 'SENEGAL'),
('SO', 'SOMALIE'),
('SR', 'SURINAME'),
('ST', 'SAO TOME-ET-PRINCIPE'),
('SV', 'EL SALVADOR'),
('SY', 'SYRIE'),
('SZ', 'SWAZILAND'),
('TD', 'TCHAD'),
('TG', 'TOGO'),
('TH', 'THAILANDE'),
('TJ', 'TADJIKISTAN'),
('TL', 'TIMOR-LESTE'),
('TM', 'TURKMENISTAN'),
('TN', 'TUNISIE'),
('TO', 'TONGA'),
('TR', 'TURQUIE'),
('TT', 'TRINITE-ET-TOBAGO'),
('TV', 'TUVALU'),
('TW', 'TAIWAN'),
('TZ', 'TANZANIE'),
('UA', 'UKRAINE'),
('UG', 'OUGANDA'),
('US', 'ETATS-UNIS'),
('UY', 'URUGUAY'),
('UZ', 'OUZBEKISTAN'),
('VA', 'VATICAN'),
('VC', 'SAINT-VINCENT'),
('VE', 'VENEZUELA'),
('VN', 'VIET NAM'),
('VU', 'VANUATU'),
('WS', 'SAMOA'),
('YE', 'YEMEN'),
('ZA', 'AFRIQUE DU SUD'),
('ZM', 'ZAMBIE'),
('ZW', 'ZIMBABWE');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `codeReservation` int(15) NOT NULL,
  `dateDebutReservation` varchar(20) NOT NULL,
  `datefinReservation` varchar(20) NOT NULL,
  `dateReservation` datetime NOT NULL DEFAULT current_timestamp(),
  `volumeEstime` decimal(4,0) NOT NULL,
  `codeDevis` int(9) DEFAULT NULL,
  `codeVilleMiseDisposition` int(6) NOT NULL,
  `codeVilleRendre` int(6) NOT NULL,
  `codeUtilisateur` smallint(6) NOT NULL,
  `etat` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`codeReservation`, `dateDebutReservation`, `datefinReservation`, `dateReservation`, `volumeEstime`, `codeDevis`, `codeVilleMiseDisposition`, `codeVilleRendre`, `codeUtilisateur`, `etat`) VALUES
(121, '2022-03-16', '2022-03-08', '2022-03-27 17:15:31', '2', 0, 1, 5, 8, 'encours'),
(122, '2022-03-09', '2022-03-03', '2022-03-27 17:15:49', '2', 48, 5, 1, 8, 'encours'),
(123, '2022-03-16', '2022-03-22', '2022-03-27 17:28:28', '1', 50, 1, 3, 8, 'encours'),
(124, '2022-03-09', '2022-03-29', '2022-03-27 17:28:51', '2', 51, 1, 5, 8, 'encours'),
(125, '2022-03-16', '2022-03-08', '2022-03-27 17:35:18', '2', 52, 1, 5, 8, 'encours'),
(128, '2022-03-25', '2022-03-10', '2022-03-27 17:37:28', '2', 53, 1, 4, 8, 'encours');

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

CREATE TABLE `reserver` (
  `code` int(6) NOT NULL,
  `codeReservation` int(15) NOT NULL,
  `numTypeContainer` int(6) NOT NULL,
  `qteReserver` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reserver`
--

INSERT INTO `reserver` (`code`, `codeReservation`, `numTypeContainer`, `qteReserver`) VALUES
(9, 108, 1, 2),
(11, 108, 7, 23),
(12, 109, 5, 240),
(13, 109, 2, 250),
(15, 110, 2, 44),
(16, 110, 3, 12345),
(18, 110, 3, 1234),
(21, 111, 9, 44),
(22, 111, 1, 44),
(23, 111, 1, 2),
(24, 111, 5, 21),
(25, 111, 9, 22),
(30, 115, 7, 1),
(31, 115, 6, 1),
(32, 115, 6, 22),
(33, 115, 9, 2),
(34, 116, 1, 2),
(35, 116, 6, 1),
(36, 116, 7, 2),
(37, 117, 1, 2),
(38, 118, 1, 2),
(39, 119, 1, 2),
(40, 119, 5, 2),
(41, 120, 1, 2),
(42, 122, 1, 2),
(43, 123, 1, 2),
(44, 124, 1, 2),
(45, 125, 1, 2),
(46, 125, 6, 12),
(47, 128, 1, 2),
(48, 128, 5, 134),
(49, 128, 7, 344);

-- --------------------------------------------------------

--
-- Structure de la table `tarificationcontainer`
--

CREATE TABLE `tarificationcontainer` (
  `codeDuree` varchar(20) NOT NULL,
  `numTypeContainer` int(6) NOT NULL,
  `tarif` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tarificationcontainer`
--

INSERT INTO `tarificationcontainer` (`codeDuree`, `numTypeContainer`, `tarif`) VALUES
('ANNEE', 1, '1260.00'),
('ANNEE', 2, '1663.20'),
('ANNEE', 3, '2700.00'),
('ANNEE', 4, '1620.00'),
('ANNEE', 5, '2700.00'),
('ANNEE', 6, '2800.00'),
('ANNEE', 7, '1620.00'),
('ANNEE', 8, '2700.00'),
('ANNEE', 9, '3200.00'),
('JOUR', 1, '8.00'),
('JOUR', 2, '9.25'),
('JOUR', 3, '10.00'),
('JOUR', 4, '9.00'),
('JOUR', 5, '10.00'),
('JOUR', 6, '12.25'),
('JOUR', 7, '9.50'),
('JOUR', 8, '10.75'),
('JOUR', 9, '14.00'),
('TRIMESTRE', 1, '585.00'),
('TRIMESTRE', 2, '623.70'),
('TRIMESTRE', 3, '765.00'),
('TRIMESTRE', 4, '585.00'),
('TRIMESTRE', 5, '755.00'),
('TRIMESTRE', 6, '890.00'),
('TRIMESTRE', 7, '585.00'),
('TRIMESTRE', 8, '765.00'),
('TRIMESTRE', 9, '890.00');

-- --------------------------------------------------------

--
-- Structure de la table `typecontainer`
--

CREATE TABLE `typecontainer` (
  `numTypeContainer` int(6) NOT NULL,
  `codeTypeContainer` char(4) NOT NULL,
  `libelleTypeContainer` char(50) NOT NULL,
  `longueurCont` decimal(5,0) NOT NULL,
  `largeurCont` decimal(5,0) NOT NULL,
  `hauteurCont` decimal(4,0) NOT NULL,
  `poidsCont` decimal(5,0) DEFAULT NULL,
  `tare` decimal(4,0) DEFAULT NULL,
  `capaciteDeCharge` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typecontainer`
--

INSERT INTO `typecontainer` (`numTypeContainer`, `codeTypeContainer`, `libelleTypeContainer`, `longueurCont`, `largeurCont`, `hauteurCont`, `poidsCont`, `tare`, `capaciteDeCharge`) VALUES
(1, 'DFCS', 'Petit conteneur de fret sec', '5896', '2350', '2385', NULL, NULL, NULL),
(2, 'DFCM', 'Conteneur de fret moyen sec', '12035', '2350', '2385', NULL, NULL, NULL),
(3, 'DFCH', 'Conteneur de fret sec Hight Cube', '12035', '2350', '2697', NULL, NULL, NULL),
(4, 'FRCS', 'Petit conteneur à rack plat', '5935', '2398', '2103', NULL, NULL, NULL),
(5, 'FRCM', 'Conteneur plat moyen', '12080', '2398', '2103', NULL, NULL, NULL),
(6, 'OTCS', 'Petit conteneur à toit ouvert', '5893', '2346', '2385', NULL, NULL, NULL),
(7, 'OTCM', 'Conteneur à toit ouvert moyen', '12029', '2346', '2359', NULL, NULL, NULL),
(8, 'RCSM', 'Petit conteneur réfrigéré', '5451', '2294', '2201', NULL, NULL, NULL),
(9, 'RCME', 'Conteneur frigorifique moyen', '11577', '2294', '2210', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `code` smallint(6) NOT NULL,
  `role` varchar(20) NOT NULL,
  `raisonSociale` char(50) NOT NULL,
  `adresse` char(80) NOT NULL,
  `cp` char(5) NOT NULL,
  `ville` char(40) NOT NULL,
  `adrMel` char(100) NOT NULL,
  `telephone` char(15) NOT NULL,
  `contact` char(50) NOT NULL,
  `login` char(10) NOT NULL,
  `mdp` char(100) NOT NULL,
  `codePays` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`code`, `role`, `raisonSociale`, `adresse`, `cp`, `ville`, `adrMel`, `telephone`, `contact`, `login`, `mdp`, `codePays`) VALUES
(8, 'electricien', 'alsotel', '23 emy les près', '95240', 'Cormeilles en Parisis', 'jeremy@orange.fr', '0156854575', 'Martin Philippe', 'acar', '$2y$14$hgHiKkSIlTWNo341tXnDye.FSksw/IR9kipV4bFd/4Zfj.HtKC/K2', 'AD'),
(9, 'electricien', 'alsotel', '23 emy les près', '95240', 'Cormeilles en Parisis', 'tholdi@orange.fr', '0156854575', 'Martin Philippe', 'tholdi', '$2y$14$FjkVjRVGQDuQDd5PyLmRn.k.Ylp23kooMthO9u79i2XorFuATirlW', 'AD'),
(10, 'electricien', 'alsotel', '23 emy les près', '95240', 'Cormeilles en Parisis', 'Belle@outlook.fr', '0156854575', 'Martin Philippe', 'zerty', '$2y$14$QQLt9b2Q2kNhvPyeVQDBDuYeCdZaQXgXACjzzqOziSutBSA5oOosS', 'AD');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `codeVille` int(6) NOT NULL,
  `nomVille` char(30) NOT NULL,
  `codePays` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`codeVille`, `nomVille`, `codePays`) VALUES
(1, 'Le Havre', 'FR'),
(2, 'Marseille', 'FR'),
(3, 'Gennevilliers', 'FR'),
(4, 'Anvers', 'BE'),
(5, 'Barcelone', 'ES'),
(6, 'Hambourg', 'DE'),
(7, 'Rotterdam', 'NL');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`codeDevis`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`codePays`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`codeReservation`),
  ADD KEY `fk_Vill1` (`codeVilleRendre`),
  ADD KEY `codeDevis` (`codeDevis`);

--
-- Index pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD PRIMARY KEY (`code`),
  ADD KEY `fk_Rese` (`codeReservation`),
  ADD KEY `fk_Typei` (`numTypeContainer`);

--
-- Index pour la table `tarificationcontainer`
--
ALTER TABLE `tarificationcontainer`
  ADD PRIMARY KEY (`codeDuree`,`numTypeContainer`),
  ADD KEY `fk_Type` (`numTypeContainer`);

--
-- Index pour la table `typecontainer`
--
ALTER TABLE `typecontainer`
  ADD PRIMARY KEY (`numTypeContainer`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`code`),
  ADD KEY `fk_codeP` (`codePays`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`codeVille`),
  ADD KEY `fk_codePa` (`codePays`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `devis`
--
ALTER TABLE `devis`
  MODIFY `codeDevis` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `codeReservation` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT pour la table `reserver`
--
ALTER TABLE `reserver`
  MODIFY `code` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `typecontainer`
--
ALTER TABLE `typecontainer`
  MODIFY `numTypeContainer` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `code` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `codeVille` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_Vill1` FOREIGN KEY (`codeVilleRendre`) REFERENCES `ville` (`codeVille`),
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`codeDevis`) REFERENCES `devis` (`codeDevis`);

--
-- Contraintes pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD CONSTRAINT `fk_Rese` FOREIGN KEY (`codeReservation`) REFERENCES `reservation` (`codeReservation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Typei` FOREIGN KEY (`numTypeContainer`) REFERENCES `typecontainer` (`numTypeContainer`);

--
-- Contraintes pour la table `tarificationcontainer`
--
ALTER TABLE `tarificationcontainer`
  ADD CONSTRAINT `fk_Type` FOREIGN KEY (`numTypeContainer`) REFERENCES `typecontainer` (`numTypeContainer`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_codeP` FOREIGN KEY (`codePays`) REFERENCES `pays` (`codePays`);

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `fk_codePa` FOREIGN KEY (`codePays`) REFERENCES `pays` (`codePays`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
