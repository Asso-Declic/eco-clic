-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : ecoclimprod.mysql.db
-- Généré le : mar. 28 fév. 2023 à 16:36
-- Version du serveur : 5.7.41-log
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecoclimprod`
--

-- --------------------------------------------------------

--
-- Structure de la table `Administrateur`
--

CREATE TABLE `Administrateur` (
  `Id` char(36) NOT NULL,
  `Nom` varchar(150) NOT NULL,
  `Prenom` varchar(150) NOT NULL,
  `Identifiant` varchar(300) NOT NULL,
  `Mail` varchar(250) NOT NULL,
  `MotDePasse` varchar(500) NOT NULL,
  `Actif` tinyint(1) NOT NULL,
  `Token` varchar(2000) DEFAULT NULL,
  `IdMotDePasseOublie` char(36) DEFAULT NULL,
  `DateMotDePasseOublie` datetime DEFAULT NULL,
  `SuperAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `OPSNId` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `Id` char(36) NOT NULL,
  `Nom` varchar(200) DEFAULT NULL,
  `Img` varchar(500) DEFAULT NULL,
  `Description` longtext,
  `Ordre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`Id`, `Nom`, `Img`, `Description`, `Ordre`) VALUES
('38e51811-4329-11ed-af88-040300000000', 'Sensibilisation Formation', 'Formation.svg', 'La sensibilisation et la formation sont le socle indispensable de l\'adhésion de tous à une démarche d\'amélioration continue. Les réponses apportées aux questions suivantes permettront de déterminer votre niveau de maturité en la matière. ', 2),
('54aa9a19-432e-11ed-af88-040300000000', 'Usages', 'Usages.svg', 'Il est important d\'impliquer l\'ensemble des utilisateurs dans la démarche. Cela passe par le questionnement de leurs usages au quotidien. ', 6),
('708d624a-432f-11ed-af88-040300000000', 'Écoconception et sobriété éditoriale', 'EcoConception.svg', 'L\'écoconception et la sobriété éditoriale visent la production de services numériques, contenus et supports de communication plus sobres. Il s\'agit de prendre en compte et de minimiser autant que possible leur impact environnemental dès la phase de conception et tout au long de leur cycle de vie.', 7),
('8444bdb4-432a-11ed-af88-040300000000', 'Gestion du parc numérique ', 'ParcNumerique2.svg', 'La connaissance de votre parc numérique est le préalable nécessaire à la mise en oeuvre des actions le concernant. Cela permettra en effet de cibler plus efficacement les axes d\'amélioration pour une gestion optimale. \r\nEn parallèle, l\'allongement de la durée de vie des équipements numériques est essentiel à une démarche vers un numérique plus sobre. De ce fait, il est important de connaître les pratiques de votre structure qui y contribuent ou, au contraire, y font obstacle. \r\nDe même, l\'impact environnemental et dans une moindre mesure la consommation d\'énergie du numérique sont des facettes importantes de la démarche. La mise en place de bonnes pratiques couplée au suivi de certains indicateurs permet de les maîtriser. \r\nEnfin, la bonne gestion des DEEE est indispensable à plus d\'un titre. Tant en raison des risques de pollution et pour la santé liés à leur fin de vie, que pour les ressources réutilisables et recyclables qu\'ils contiennent. Il convient aussi de tenir compte du papier d\'impression pour avoir une vision complète des déchets liés au numérique.', 4),
('b5aa2df1-4328-11ed-af88-040300000000', 'Gouvernance', 'Gouvernance.svg', 'La mise en place d\'une gouvernance est un facteur déterminant du bon déroulé de toute démarche d\'amélioration continue. Ainsi, les questions suivantes interrogent l\'organisation mise en place à l\'échelle de votre structure pour la mener à bien. ', 1),
('d573027d-432d-11ed-af88-040300000000', 'Réseaux et données', 'Reseaux.svg', 'Face à l\'augmentation exponentielle des données numériques traitées, les réseaux et centres de données sont de plus en plus sollicités et s\'adaptent en conséquence. Les questions ci-après ont vocation à déterminer la gestion des données de votre structure, et notamment leur stockage, leur sauvegarde, leur transfert. ', 5),
('e4a990cd-4329-11ed-af88-040300000000', 'Achats Location', 'Achat.svg', 'Les achats publics sont sans équivoque l\'un des principaux leviers de la maîtrise de l\'empreinte environnementale du numérique.  À ce titre, vos pratiques d\'achats et locations en la matière doivent être analysées (équipements numériques, impressions et papier, énergie).', 3);

-- --------------------------------------------------------

--
-- Structure de la table `collectivite`
--

CREATE TABLE `collectivite` (
  `Id` char(36) NOT NULL,
  `Nom` varchar(500) NOT NULL,
  `Population` int(11) NOT NULL,
  `DepartementCode` char(3) NOT NULL,
  `Siret` char(14) NOT NULL,
  `Latitude` varchar(500) NOT NULL,
  `Longitude` varchar(500) NOT NULL,
  `TypeId` char(36) NOT NULL,
  `OPSNId` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `collectivite`
--

INSERT INTO `collectivite` (`Id`, `Nom`, `Population`, `DepartementCode`, `Siret`, `Latitude`, `Longitude`, `TypeId`, `OPSNId`) VALUES
('15940a2b-a2de-11ed-ac2a-0242ac110004', 'LOUDÉAC COMMUNAUTÉ', 51202, '22', '20006746000010', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '51adc0d2-8cd1-11ed-b934-0242ac110006'),
('1dbfd41d-a2e2-11ed-ac2a-0242ac110004', 'CAZÈRES-SUR-L\'ADOUR', 1128, '40', '21400080400010', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('1dbfe715-a2e2-11ed-ac2a-0242ac110004', 'CC DU PAYS GRENADOIS', 7689, '40', '24400082400064', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('1ef63d99-7ac8-11ed-8685-0242ac110006', 'ADICO', 0, '60', '38445261100047', '1', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '927cdac4-9316-11ed-97b8-0242ac110004'),
('24c813d9-a2e1-11ed-ac2a-0242ac110004', 'ADACL', 0, '40', '25400227200048', '', '', '73097104-8c33-11ed-97b8-0242ac110004', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('24c8238e-a2e1-11ed-ac2a-0242ac110004', 'CIAS D\'AIRE SUR L\'ADOUR', 12408, '40', '26400430000010', '', '', '73097104-8c33-11ed-97b8-0242ac110004', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('2ce1b465-a2e0-11ed-ac2a-0242ac110004', 'CDC VALS DE SAINTONGE', 51999, '17', '20004168900015', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '7c0b0032-8cd2-11ed-b934-0242ac110006'),
('345856be-8cf7-11ed-b934-0242ac110006', 'MAIRIE DE SAINT-QUENTIN', 53100, '02', '21020666000016', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '92526e7d-8cfd-11ed-b934-0242ac110006'),
('3501a5ee-8cf6-11ed-b934-0242ac110006', 'COMMUNAUTÉ D\'AGGLOMÉRATION DU PAYS AJACCIEN', 88483, '2A', '24201005600073', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '92526e7d-8cfd-11ed-b934-0242ac110006'),
('37e37945-a2df-11ed-ac2a-0242ac110004', 'COMMUNAUTÉ DE COMMUNES DU THOUARSAIS', 0, '79', '24790079800031', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '5d48a267-8cd2-11ed-b934-0242ac110006'),
('3a936335-8cd4-11ed-b934-0242ac110006', 'COMMUNAUTÉ DE COMMUNE DES SABLONS', 38511, '60', '24600058200014', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '927cdac4-9316-11ed-97b8-0242ac110004'),
('3b9f5071-9e2e-11ed-9c59-0242ac110004', 'REDON AGGLOMÉRATION', 66655, '35', '24350074100232', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '51adc0d2-8cd1-11ed-b934-0242ac110006'),
('3b9f6370-9e2e-11ed-9c59-0242ac110004', 'PAYS D\'IROISE COMMUNAUTÉ', 48630, '29', '24290007400178', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '51adc0d2-8cd1-11ed-b934-0242ac110006'),
('404', 'COMMUNE TEST', 1, '80', '00000000000000', '40', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '927cdac4-9316-11ed-97b8-0242ac110004'),
('48369be4-b646-43e5-bb04-5de8401694ce', 'Collectivité DEMO', 1816, '02', '00000000000000', '49.603852', '3.5148', '57482110-fe97-11eb-acf0-0cc47a0ad120', '927cdac4-9316-11ed-97b8-0242ac110004'),
('4bfd57d7-8cf7-11ed-b934-0242ac110006', 'MAIRIE DE VALENCE', 64431, '26', '21260362500014', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '92526e7d-8cfd-11ed-b934-0242ac110006'),
('5a15eef2-a2de-11ed-ac2a-0242ac110004', 'BAULE', 2104, '45', '21450024100010', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '1d071332-8cd2-11ed-b934-0242ac110006'),
('5ec338a9-7ac5-11ed-8685-0242ac110006', 'SITIV', 0, '02', '25691018300027', '17', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', 'df55abd4-8cd0-11ed-b934-0242ac110006'),
('63158588-8cf6-11ed-b934-0242ac110006', 'GRAND CHAMBÉRY', 125778, '73', '20006911000019', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '92526e7d-8cfd-11ed-b934-0242ac110006'),
('663be6ee-7a30-11ed-8685-0242ac110006', 'MÉGALIS BRETAGNE', 1, '35', '25351449100047', '15', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '51adc0d2-8cd1-11ed-b934-0242ac110006'),
('66ede059-a2e2-11ed-ac2a-0242ac110004', 'CC PAYS D\'ORTHE ET ARRIGANS', 24014, '40', '20006941700067', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('66edf35e-a2e2-11ed-ac2a-0242ac110004', 'GRENADE-SUR-L\'ADOUR', 2443, '40', '21400117400017', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('671a7c1c-a2e1-11ed-ac2a-0242ac110004', 'SAINT PAUL EN BORN', 977, '40', '21400278400012', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('671a89cb-a2e1-11ed-ac2a-0242ac110004', 'AURÉILHAN', 1068, '40', '21400019200010', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('696421c4-7aca-11ed-8685-0242ac110006', 'ATD24', 0, '02', '25240514700015', '6', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '665d82cf-8cd1-11ed-b934-0242ac110006'),
('6b9c1b97-931a-11ed-97b8-0242ac110004', 'COMMUNAUTÉ DE COMMUNES THELLOISE', 60670, '60', '20006797300012', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '927cdac4-9316-11ed-97b8-0242ac110004'),
('6d6c6c1f-a920-11ed-83f5-0242ac110004', 'VITRÉ COMMUNAUTÉ', 81689, '35', '20003902200013', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '51adc0d2-8cd1-11ed-b934-0242ac110006'),
('7e9204d0-a2e1-11ed-ac2a-0242ac110004', 'LIPOSTHEY', 566, '40', '21400156200013', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('814cd024-8cf6-11ed-b934-0242ac110006', 'VALENCE ROMANS AGGLO', 223826, '26', '20006878100166', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '92526e7d-8cfd-11ed-b934-0242ac110006'),
('8422009e-7acd-11ed-8685-0242ac110006', 'AGATE TERRITOIRE', 0, '02', '30942144400055', '2', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', 'c9319a04-8cd1-11ed-b934-0242ac110006'),
('8423e3da-7acd-11ed-8685-0242ac110006', 'ALPI', 0, '02', '25400330400030', '3', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('8425a6a4-7acd-11ed-8685-0242ac110006', 'ANCT', 0, '02', '13002603200016', '4', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '1c2f6fd4-8c31-11ed-b934-0242ac110006'),
('84272696-7acd-11ed-8685-0242ac110006', 'ATD 16', 0, '02', '13002603200016', '5', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '04c8fd3a-8cd2-11ed-b934-0242ac110006'),
('8853bc6f-a2e0-11ed-ac2a-0242ac110004', 'MONT DE MARSAN AGGLOMÉRATION', 29953, '40', '21400192700018', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('8853cc87-a2e0-11ed-ac2a-0242ac110004', 'CÔTE LANDES NATURE TOURISME', 10417, '40', '79074163100010', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('885de2e7-9e2d-11ed-9c59-0242ac110004', 'SAINT AVÉ', 11895, '56', '21560206100016', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '51adc0d2-8cd1-11ed-b934-0242ac110006'),
('90a0b1ff-8cd5-11ed-b934-0242ac110006', 'GRAND SOISSONS AGGLOMÉRATION ET VILLE DE SOISSONS', 52415, '02', '24020047700026', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '927cdac4-9316-11ed-97b8-0242ac110004'),
('9253fdcd-8cf5-11ed-b934-0242ac110006', 'VAULX EN VEXIN', 47313, '69', '21690256900013', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', 'df55abd4-8cd0-11ed-b934-0242ac110006'),
('9ba053bc-7acd-11ed-8685-0242ac110006', 'CDG 35', 0, '02', '28350356300035', '8', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '8fc73706-8cd1-11ed-b934-0242ac110006'),
('9ba3081a-7acd-11ed-8685-0242ac110006', 'CDG 79', 0, '02', '28790034400014', '9', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '5d48a267-8cd2-11ed-b934-0242ac110006'),
('9ba45fee-7acd-11ed-8685-0242ac110006', 'COGITIS', 0, '02', '25340321600026', '10', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', 'e69aadaf-8cd1-11ed-b934-0242ac110006'),
('9ba5edef-7acd-11ed-8685-0242ac110006', 'E COLLECTIVITÉS ', 0, '02', '20004311500019', '11', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', 'a7c0d097-8cd1-11ed-b934-0242ac110006'),
('9ba7ad84-7acd-11ed-8685-0242ac110006', 'LA FIBRE64', 0, '02', '20008126300010', '12', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', 'b2c51ad5-8cd0-11ed-b934-0242ac110006'),
('9ba904f4-7acd-11ed-8685-0242ac110006', 'GIRONDE NUMÉRIQUE', 0, '02', '20001004900076', '13', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '12655322-8cd1-11ed-b934-0242ac110006'),
('9baa58f1-7acd-11ed-8685-0242ac110006', 'INGÉNIERIE 70', 0, '02', '20002647400045', '14', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', 'ff109e0e-8cf7-11ed-b934-0242ac110006'),
('a056672e-a2e2-11ed-ac2a-0242ac110004', 'CC COEUR HAUTE LANDE', 15811, '40', '20006965600011', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('a0567a2f-a2e2-11ed-ac2a-0242ac110004', 'SAINT-VINCENT-DE-PAUL', 3337, '40', '21400283400015', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('ac11a3bf-8cf6-11ed-b934-0242ac110006', 'MAIRIE DE NIORT', 58966, '79', '21790191700013', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '92526e7d-8cfd-11ed-b934-0242ac110006'),
('b19381da-9e2e-11ed-9c59-0242ac110004', 'ANGLIERS', 1258, '17', '21170009100013', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '7c0b0032-8cd2-11ed-b934-0242ac110006'),
('b193984d-9e2e-11ed-9c59-0242ac110004', 'ST PIERRE DE L\'ISLE', 258, '17', '21170384800013', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '7c0b0032-8cd2-11ed-b934-0242ac110006'),
('b2b4a0d4-7acd-11ed-8685-0242ac110006', 'GIP RECIA', 0, '02', '18450311800020', '16', '0', '73097104-8c33-11ed-97b8-0242ac110004', '1d071332-8cd2-11ed-b934-0242ac110006'),
('b2b71dc1-7acd-11ed-8685-0242ac110006', 'SOLURIS', 0, '02', '25170232000051', '18', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '7c0b0032-8cd2-11ed-b934-0242ac110006'),
('b2b88dff-7acd-11ed-8685-0242ac110006', 'SYANE', 0, '02', '25740008500078', '19', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', 'fc098862-8cd2-11ed-b934-0242ac110006'),
('b2b9fecb-7acd-11ed-8685-0242ac110006', 'DÉCLIC', 0, '02', '88171973600012', '20', '0', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '2aef700c-76f9-11ed-8685-0242ac110006'),
('b35fb061-a2df-11ed-ac2a-0242ac110004', 'COMMUNE DE FRESSINES', 0, '79', '21790129700044', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '5d48a267-8cd2-11ed-b934-0242ac110006'),
('b80c1779-9e2d-11ed-9c59-0242ac110004', 'LAMBALLE TERRE ET MER', 67875, '22', '20006939100015', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '51adc0d2-8cd1-11ed-b934-0242ac110006'),
('c464c0d5-a2e1-11ed-ac2a-0242ac110004', 'SIETOM DE CHALOSSE', 75858, '40', '25400083900046', '', '', '73097104-8c33-11ed-97b8-0242ac110004', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('c464d6e1-a2e1-11ed-ac2a-0242ac110004', 'SAUGNAC ET MURET', 1130, '40', '21400295800012', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('c5d4d9a1-9e2e-11ed-9c59-0242ac110004', 'LA FLOTTE', 2747, '17', '21170161000019', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '7c0b0032-8cd2-11ed-b934-0242ac110006'),
('c74a4778-8cd5-11ed-b934-0242ac110006', 'COMMUNAUTÉ DE COMMUNES NORD EST BÉARN', 35000, '64', '20006729600018', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', 'b2c51ad5-8cd0-11ed-b934-0242ac110006'),
('cd629cd2-a2e0-11ed-ac2a-0242ac110004', 'BÉNESSE-LÈS-DAX', 569, '40', '21400035800017', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('d2fc4198-8cd4-11ed-b934-0242ac110006', 'COMMUNAUTÉ URBAINE ET VILLE D\'ARRAS', 108347, '62', '20003357900018', '', '', '73097104-8c33-11ed-97b8-0242ac110004', '927cdac4-9316-11ed-97b8-0242ac110004'),
('d8b43b24-a2e1-11ed-ac2a-0242ac110004', 'MIMBASTE', 965, '40', '21400183600011', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', 'e744130a-8cd2-11ed-b934-0242ac110006'),
('df4c07da-bbbf-4d45-ac54-af002174e751', 'AGENCE TECHNIQUE DEPARTEMENTALE DE LA CHARENTE', 41603, '16', '20004454300011', '45.645692', '0.157959', '8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', '04c8fd3a-8cd2-11ed-b934-0242ac110006'),
('f21683e7-9e2e-11ed-9c59-0242ac110004', 'SAINT-GEORGES DES COTEAUX', 2796, '17', '21170336800012', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '7c0b0032-8cd2-11ed-b934-0242ac110006'),
('f21691c2-9e2e-11ed-9c59-0242ac110004', 'CDA LA ROCHELLE', 174277, '17', '24170043400020', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '7c0b0032-8cd2-11ed-b934-0242ac110006'),
('f7296192-9e2d-11ed-9c59-0242ac110004', 'BRETAGNE PORTE DE LOIRE', 32191, '35', '20007066200016', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '51adc0d2-8cd1-11ed-b934-0242ac110006'),
('f7296e58-9e2d-11ed-9c59-0242ac110004', 'LORIENT AGGLOMÉRATION', 205008, '56', '20004217400090', '', '', '7ab89f99-8c33-11ed-97b8-0242ac110004', '51adc0d2-8cd1-11ed-b934-0242ac110006'),
('f8fd1ec3-a2de-11ed-ac2a-0242ac110004', 'VILLE DE SAINT-MAIXENT-L\'ECOLE', 7243, '79', '21790270900013', '', '', '57482110-fe97-11eb-acf0-0cc47a0ad120', '5d48a267-8cd2-11ed-b934-0242ac110006');

-- --------------------------------------------------------

--
-- Structure de la table `Departement`
--

CREATE TABLE `Departement` (
  `Code` char(3) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `CodeRegion` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Departement`
--

INSERT INTO `Departement` (`Code`, `Nom`, `CodeRegion`) VALUES
('01', 'Ain', 84),
('02', 'Aisne', 32),
('03', 'Allier', 84),
('04', 'Alpes-de-Haute-Provence', 93),
('05', 'Hautes-Alpes', 93),
('06', 'Alpes-Maritimes', 93),
('07', 'Ardèche', 84),
('08', 'Ardennes', 44),
('09', 'Ariège', 76),
('10', 'Aube', 44),
('11', 'Aude', 76),
('12', 'Aveyron', 76),
('13', 'Bouches-du-Rhône', 93),
('14', 'Calvados', 28),
('15', 'Cantal', 84),
('16', 'Charente', 75),
('17', 'Charente-Maritime', 75),
('18', 'Cher', 24),
('19', 'Corrèze', 75),
('21', 'Côte-d\'Or', 27),
('22', 'Côtes-d\'Armor', 53),
('23', 'Creuse', 75),
('24', 'Dordogne', 75),
('25', 'Doubs', 27),
('26', 'Drôme', 84),
('27', 'Eure', 28),
('28', 'Eure-et-Loir', 24),
('29', 'Finistère', 53),
('2A', 'Corse-du-Sud', 94),
('2B', 'Haute-Corse', 94),
('30', 'Gard', 76),
('31', 'Haute-Garonne', 76),
('32', 'Gers', 76),
('33', 'Gironde', 75),
('34', 'Hérault', 76),
('35', 'Ille-et-Vilaine', 53),
('36', 'Indre', 24),
('37', 'Indre-et-Loire', 24),
('38', 'Isère', 84),
('39', 'Jura', 27),
('40', 'Landes', 75),
('41', 'Loir-et-Cher', 24),
('42', 'Loire', 84),
('43', 'Haute-Loire', 84),
('44', 'Loire-Atlantique', 52),
('45', 'Loiret', 24),
('46', 'Lot', 76),
('47', 'Lot-et-Garonne', 75),
('48', 'Lozère', 76),
('49', 'Maine-et-Loire', 52),
('50', 'Manche', 28),
('51', 'Marne', 44),
('52', 'Haute-Marne', 44),
('53', 'Mayenne', 52),
('54', 'Meurthe-et-Moselle', 44),
('55', 'Meuse', 44),
('56', 'Morbihan', 53),
('57', 'Moselle', 44),
('58', 'Nièvre', 27),
('59', 'Nord', 32),
('60', 'Oise', 32),
('61', 'Orne', 28),
('62', 'Pas-de-Calais', 32),
('63', 'Puy-de-Dôme', 84),
('64', 'Pyrénées-Atlantiques', 75),
('65', 'Hautes-Pyrénées', 76),
('66', 'Pyrénées-Orientales', 76),
('67', 'Bas-Rhin', 44),
('68', 'Haut-Rhin', 44),
('69', 'Rhône', 84),
('70', 'Haute-Saône', 27),
('71', 'Saône-et-Loire', 27),
('72', 'Sarthe', 52),
('73', 'Savoie', 84),
('74', 'Haute-Savoie', 84),
('75', 'Paris', 11),
('76', 'Seine-Maritime', 28),
('77', 'Seine-et-Marne', 11),
('78', 'Yvelines', 11),
('79', 'Deux-Sèvres', 75),
('80', 'Somme', 32),
('81', 'Tarn', 76),
('82', 'Tarn-et-Garonne', 76),
('83', 'Var', 93),
('84', 'Vaucluse', 93),
('85', 'Vendée', 52),
('86', 'Vienne', 75),
('87', 'Haute-Vienne', 75),
('88', 'Vosges', 44),
('89', 'Yonne', 27),
('90', 'Territoire de Belfort', 27),
('91', 'Essonne', 11),
('92', 'Hauts-de-Seine', 11),
('93', 'Seine-Saint-Denis', 11),
('94', 'Val-de-Marne', 11),
('95', 'Val-d\'Oise', 11),
('971', 'Guadeloupe', 1),
('972', 'Martinique', 2),
('973', 'Guyane', 3),
('974', 'La Réunion', 4),
('976', 'Mayotte', 6);

-- --------------------------------------------------------

--
-- Structure de la table `historiqueScore`
--

CREATE TABLE `historiqueScore` (
  `CollectiviteId` char(36) NOT NULL,
  `Score` int(3) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `OPSN`
--

CREATE TABLE `OPSN` (
  `Id` char(36) CHARACTER SET utf8 NOT NULL,
  `Nom` varchar(500) CHARACTER SET utf8 NOT NULL,
  `Mail` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `DepartementCode` char(3) CHARACTER SET utf8 NOT NULL,
  `Actif` int(1) NOT NULL,
  `Logo` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `Telephone` int(11) DEFAULT NULL,
  `Adresse` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `Site_Internet` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `Siret` char(14) CHARACTER SET utf8 DEFAULT NULL,
  `Latitude` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `Longitude` varchar(500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `OPSN_Departement`
--

CREATE TABLE `OPSN_Departement` (
  `OPSNId` char(36) NOT NULL,
  `DepartementCode` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `preference`
--

CREATE TABLE `preference` (
  `UtilisateurId` char(36) CHARACTER SET utf8 NOT NULL,
  `Code` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Json` varchar(2000) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `Id` char(36) NOT NULL,
  `Question` varchar(500) DEFAULT NULL,
  `IdTheme` char(36) NOT NULL,
  `IdCategorie` char(36) NOT NULL,
  `Multiple` tinyint(1) NOT NULL DEFAULT '0',
  `Definition` longtext,
  `InfoComplementaire` longtext,
  `Titre_definition` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`Id`, `Question`, `IdTheme`, `IdCategorie`, `Multiple`, `Definition`, `InfoComplementaire`, `Titre_definition`) VALUES
('0c983ebb-432d-11ed-af88-040300000000', 'Connaissez-vous les obligations de votre structure en matière de traitement des DEEE ? ', '0c97c89c-432d-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 0, 'Les DEEE ou D3E sont les déchets d\'équipements électriques et électroniques (EEE) en fin de vie. Ils sont considérés par la réglementation environnementale en vigueur comme étant des déchets dangereux car ils contiennent des substances réglementées. Le code de l\'environnement définit les équipements électriques et électroniques comme étant des équipements « fonctionnant grâce à des courants électriques ou à des champs électromagnétiques, ainsi que les équipements de production, de transfert et de mesure de ces courants et champs, conçus pour être utilisés à une tension ne dépassant pas 1 000 volts en courant alternatif et 1 500 volts en courant continu. »\nIls contiennent par ailleurs des ressources qui peuvent être réutilisées ou recyclées. - Perte de matériaux réutilisables ; \n- Pollution de l\'air et des sols ; \n- Favorisation des trafics mondiaux liés aux DEEE ; \n- Pollution et impacts sociaux au sein des tiers pays où sont envoyés les DEEE pour traitement...', 'Une mauvaise gestion des EEE encore fonctionnels et DEEE est source de nombreux impacts négatifs, notamment : \n- Perte de matériaux réutilisables ; \n- Pollution de l\'air et des sols ; \n- Favorisation des trafics mondiaux liés aux DEEE ; \n- Pollution et impacts sociaux au sein des tiers pays où sont envoyés les DEEE pour traitement...', NULL),
('10eeee49-432a-11ed-af88-040300000000', 'Des mesures permettant de favoriser la sobriété numérique dans les achats et locations d\'équipements numériques ainsi que de logiciels ont-elles été prises (ajout de clauses contractuelles, prise en compte des écolabels , de l\'indice de réparabilité , de l\'éco-conception , achat/location d\'équipements issus du réemploi ou de la réutilisation...) ? ', '0', 'e4a990cd-4329-11ed-af88-040300000000', 0, 'Écolabel : Le terme « écolabel » est réservé aux labels environnementaux qui répondent à la norme ISO 14024, c\'est-à-dire respectant des exigences très précises prenant en compte les impacts environnementaux des produits tout au long de leur cycle de vie.\r\nLes produits sont certifiés par un organisme indépendant, garantissant la conformité du produit aux critères d\'un référentiel, préalablement élaboré en commun par des professionnels, des associations de consommateurs et de protection de l\'environnement et les pouvoirs publics. \r\n\r\nIndice de réparabilité : L\'indice de réparabilité est une information transmise à l\'acheteur d\'un équipement électroménagers et électroniques sur la capacité à réparer le produit acheté. Les critères et les modalités de calcul de l\'indice de réparabilité incluent notamment la démontabilité du produit, la disponibilité des conseils d\'utilisation et d\'entretien, encore la disponibilité et le prix des pièces détachées nécessaires au bon fonctionnement du produit. Prévu par la loi anti-gaspillage et l\'article L. 541-9-2 du code de l\'environnement, l\'indice de réparabilité est obligatoire depuis le 1er janvier 2021. Il concerne 5 catégories d\'équipements électroménagers et électroniques, notamment les ordinateurs et les smartphones.\r\n\r\nÉcoconception : L\'éco-conception est un standard pour réduire les impacts environnementaux d\'un produit ou d\'un service défini par la norme ISO 14062 qui intègre des contraintes environnementales dans la conception de produits et services selon une approche globale et multicritères. \r\n\r\nRéemploi : Toute opération par laquelle des substances, matières ou produits qui ne sont pas des déchets sont utilisés de nouveau pour un usage identique à celui pour lequel ils avaient été conçus. \r\n\r\nRéutilisation : Toute opération par laquelle des substances, matières ou produits qui sont devenus des déchets sont utilisés de nouveau.', NULL, NULL),
('1d75bed8-432f-11ed-af88-040300000000', 'Avez-vous mis en place des consignes particulières favorisant la sobriété numérique en matière d\'impression de documents (police imposée, nombre limité d\'impressions...) ? ', '0', '54aa9a19-432e-11ed-af88-040300000000', 0, NULL, 'En moyenne, un français imprime 20 pages par jour, ce qui représente, notamment, par personne et par an : \r\n- 6 600 pages imprimées ; \r\n- 1 arbre utilisé ; \r\n- 12 500 litres d\'eau consommés. \r\nOr, derrière ces chiffres, il faut tenir compte du fait que : \r\n- les e-mails représentent 10 à 38% du volume d\'impression ; \r\n- 16% des impressions ne sont jamais lues et 65% pourraient être lues sur un écran ; \r\n- ¼ des impressions sont jetées dans les 5 minutes suivant l\'impression.\r\nIl est donc nécessaire d\'agir pour réduire l\'impact des impressions. ', NULL),
('29ebe668-432a-11ed-af88-040300000000', 'Des mesures permettant de favoriser la sobriété numérique dans les achats pour l\'impression ont-elles été prises (choix du papier, de l\'encre et des toners...) ?', '0', 'e4a990cd-4329-11ed-af88-040300000000', 0, NULL, NULL, NULL),
('2dac1dd2-432c-11ed-af88-040300000000', 'Qu\'advient-il du matériel encore fonctionnel remplacé (plusieurs réponses possibles) ?', '723a6705-432b-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1, NULL, 'L\'allongement de la durée de vie des équipements numériques est la priorité compte tenu de l\'impact de leur fabrication. Opter pour le réemploi du matériel numérique encore fonctionnel permet d\'y contribuer en lui offrant une nouvelle vie. ', NULL),
('38e7f306-4329-11ed-af88-040300000000', 'Des actions de sensibilisation sont-elles menées auprès du personnel sur les enjeux et bonnes pratiques en matière de sobriété numérique ? ', '0', '38e51811-4329-11ed-af88-040300000000', 0, NULL, 'La sensibilisation peut être assurée par le relai d\'informations (celles produites par l\'ADEME ou encore l\'INR), l\'organisation d\'évènements thématiques (par exemple la Fresque du numérique ou du climat ou le World Clean Up Day). Elle vise à alerter et apporter un premier niveau de connaissances sur le sujet. \nUne bonne compréhension des enjeux et bonnes pratiques de la sobriété numérique est un préalable indispensable à la mise en oeuvre du plan d\'action défini. Elle est le gage d\'une meilleure adhésion à la démarche de chacune des parties prenantes. \nLa diversification des supports de sensibilisation assure une diffusion optimale des enjeux et bonnes pratiques de la sobriété numérique auprès de différents utilisateurs. ', NULL),
('3d36ff72-432f-11ed-af88-040300000000', 'La collecte et le recyclage du papier sont-ils réalisés au sein de votre structure ? ', '0', '54aa9a19-432e-11ed-af88-040300000000', 0, NULL, 'Décret Tri 5 flux : \r\nDans le prolongement de la loi sur la transition énergétique, et en complément de l\'obligation sur le tri et la valorisation des emballages professionnels (Art. R 543-66 à 72 du code de l\'Environnement), le décret n°2016-288 du 10 mars 2016 oblige depuis le 1er juillet 2016 au tri à la source et à la valorisation de 5 flux de déchets (Art. D 543 à 287 du code de l\'Environnement), à savoir : papier/carton, métal, plastique, verre et bois.', NULL),
('4aa285ba-432a-11ed-af88-040300000000', 'Faîtes-vous appel à des fournisseurs d\'énergie dite « verte »/renouvelable ? ', '0', 'e4a990cd-4329-11ed-af88-040300000000', 0, 'Énergies primaires : L\'énergie primaire est celle qui sert notamment à fabriquer l\'électricité que nous consommons, appelée quant à elle « énergie finale » (nucléaire, hydraulique, solaire, gaz, pétrole, charbon...). \r\nÉnergies renouvelables/fossiles : Une énergie est dite renouvelable lorsqu\'elle provient de sources que la nature renouvelle en permanence, par opposition à une énergie non renouvelable dont les stocks s\'épuisent, ce qui est le cas des énergies fossiles. ', 'Les énergies primaires dites fossiles utilisées pour la production de l\'électricité nécessaire au fonctionnement du parc numérique ont un impact environnemental supérieur aux énergies dites renouvelables. \r\nL\'achat de ce type d\'énergie consiste à l\'obtention d\'un certificat attestant qu\'une quantité d\'énergie équivalente à la consommation du client produite à partir de sources d\'énergies renouvelables a été injectée dans le réseau de distribution. Il n\'est en effet pas possible de déterminer la nature de l\'énergie effectivement consommée à la prise électrique : toutes les productions se confondent une fois qu\'elles ont rejoint le réseau de distribution. \r\nLe but est d\'aider au développement des filières renouvelables afin que la part de production qui en est issue augmente, entrainant une baisse des impacts environnementaux liés aux énergies fossiles. ', NULL),
('54ac56c5-432e-11ed-af88-040300000000', 'Des obligations et/ou bonnes pratiques favorisant la sobriété numérique (gestion et tri des boîtes de messagerie, espaces de stockage en ligne, mise en veille et extinction des outils numériques...) ont-elles été mises en place via la charte informatique ou tout autre support ou format ? ', '0', '54aa9a19-432e-11ed-af88-040300000000', 0, NULL, 'La charte informatique est le document indiqué pour assurer la diffusion et l\'opposabilité des règles et pratiques communes définies par la structure concernant le numérique (sécurité informatique, protection des données, usages autorisés, sanctions, etc.). ', NULL),
('70900c22-432f-11ed-af88-040300000000', 'Les solutions logicielles et applications utilisées sont-elles écoconçues ? ', '0', '708d624a-432f-11ed-af88-040300000000', 0, NULL, 'Selon la Mission interministérielle Numérique Écoresponsable (MiNumÉco) : \"L\'écoconception des services numériques n\'est pas uniquement une recherche d\'optimisation, d\'efficience ou de performance mais une réflexion plus globale sur l\'usage des technologies. Il est important d\'intégrer les impacts environnementaux du numérique dans la conception des services numériques en visant directement ou indirectement à allonger la durée des vies des équipements numériques, à réduire la consommation de ressources informatiques et énergétiques des terminaux, des réseaux et des centres de données.\"\r\nPar exemple, lorsqu\'un service de communication en ligne présente des erreurs dans son code ou que celui-ci est rédigé de façon complexe, les navigateurs internet prennent plus de temps pour en charger le contenu car ils doivent au préalable compenser ces erreurs et déchiffrer l\'ensemble, ce qui implique un impact environnemental plus important. ', NULL),
('723af67d-432b-11ed-af88-040300000000', 'Avez-vous mis en place des consignes et pratiques de nature à allonger la durée de vie de vos équipements numériques (favoriser la réparation avant le remplacement, dissocier le remplacement des équipements selon les besoins, maintenance...) ?', '723a6705-432b-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 0, NULL, 'La mise en place d\'un document centralisant ces éléments d\'information permettra une meilleure gestion du parc numérique. ', NULL),
('77eb5ab7-4329-11ed-af88-040300000000', 'Le personnel de votre structure a-t-il été formé aux enjeux et bonnes pratiques en matière de sobriété numérique ? ', '0', '38e51811-4329-11ed-af88-040300000000', 0, NULL, 'La formation vient en complément de la sensibilisation afin d\'apporter les compétences nécessaires à la bonne mise en oeuvre du plan d\'actions (par exemple formation aux achats responsables pour les acheteurs publics, aux enjeux et bonnes pratiques de la sobriété numérique pour le référent ou encore à l\'écoconception pour le service informatique). \nLa formation des responsables et/ou agents et autres personnes les plus concernés est l\'assurance que les enjeux et bonnes pratiques de la sobriété numérique soient bien systématiquement pris en compte et intégrés aux divers projets qu\'ils mènent à bien. Cela contribue par ailleurs à la sensibilisation des équipes dans lesquelles ils évoluent ou avec lesquelles ils collaborent, et donc à l\'acculturation de l\'ensemble de la structure. ', NULL),
('844646f7-432a-11ed-af88-040300000000', 'Disposez-vous d\'un inventaire du parc numérique de votre structure (postes informatiques et écrans, téléphones, tablettes, supports de sauvegardes amovibles, vidéoprojecteurs...) ? ', '8445cf29-432a-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 0, NULL, 'Une gestion optimale du parc numérique implique d\'en connaître la composition de manière à affecter au mieux les ressources existantes tout en limitant les acquisitions au strict nécessaire, avec tous les impacts environnementaux que cela permet d\'éviter. ', NULL),
('8e6521c5-432d-11ed-af88-040300000000', 'Une politique de gestion des DEEE est-elle en place (postes informatiques, téléphones, imprimantes/scanners, cartouches d\'encre et toner...) ? ', '0c97c89c-432d-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1, NULL, NULL, NULL),
('95de2d83-4329-11ed-af88-040300000000', 'Des actions de sensibilisation sont-elles menées auprès des élus sur les enjeux et bonnes pratiques en matière de sobriété numérique ? ', '0', '38e51811-4329-11ed-af88-040300000000', 0, NULL, NULL, NULL),
('96bb7d32-432e-11ed-af88-040300000000', 'Votre structure fait-elle un usage régulier de la visioconférence ? ', '0', '54aa9a19-432e-11ed-af88-040300000000', 0, NULL, 'Tout comme les déplacements, la visioconférence a des impacts environnementaux qu\'il faut prendre en compte pour définir le format le plus approprié pour la tenue d\'une réunion (terminaux utilisés pour y participer, réseaux utilisés, nombre de participants, durée de la réunion...). \nÀ noter que d\'après une étude menée par des chercheurs de l\'université Purdue, de l\'université de Yale et du Massachusetts Institute of Technology, désactiver la webcam réduit de 96% l\'impact environnemental lié à la visioconférence.À noter que d\'après une étude menée par des chercheurs de l\'université Purdue, de l\'université de Yale et du Massachusetts Institute of Technology, désactiver la webcam réduit de 96% l\'impact environnemental lié à la visioconférence.', NULL),
('ae77a55d-432c-11ed-af88-040300000000', 'Avez-vous mis en place des consignes et pratiques de nature à réduire la consommation d\'énergie de votre parc numérique (mise en veille, extinction des équipements, paramétrage de la luminosité, suivi des consommations...) ? ', 'ae7714cd-432c-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 0, NULL, NULL, NULL),
('b5abe326-4328-11ed-af88-040300000000', 'Votre structure a-t-elle pris en compte la sobriété numérique et la transition environnementale dans ses actions et projets en lien avec le numérique ? ', '0', 'b5aa2df1-4328-11ed-af88-040300000000', 0, 'Sobriété numérique : Démarche d\'amélioration continue visant à maîtriser l\'empreinte environnementale du numérique par l\'adoption d\'un usage et de pratiques raisonnées en la matière. \r\n\r\nTransition environnementale : La transition environnementale est une évolution vers un nouveau modèle économique et social, un modèle de développement durable qui renouvelle nos façons de consommer, de produire, de travailler, de vivre ensemble pour répondre aux grands enjeux environnementaux, ceux du changement climatique, de la rareté des ressources, de la perte accélérée de la biodiversité et de la multiplication des risques sanitaires environnementaux. ', NULL, NULL),
('b8a7c8bd-432b-11ed-af88-040300000000', 'Utilisez-vous des solutions logicielles et systèmes d\'exploitation libres ?', '723a6705-432b-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 0, NULL, 'Le libre, par son mode de fonctionnement basé sur une contribution communautaire, est plus vertueux en ce qu\'il favorise moins l\'obsolescence logicielle que les solutions logicielles et systèmes d\'exploitation reposant sur un écosystème propriétaire et fermé. \r\nPar exemple, le système d\'exploitation Linux est reconnu pour permettre le prolongement de la durée de vie de poste informatique ancien.', NULL),
('b8da12ea-432a-11ed-af88-040300000000', 'Assurez-vous la traçabilité des attributions et besoins en outils informatiques en interne ? ', '8445cf29-432a-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 0, NULL, NULL, NULL),
('ba309c8c-432f-11ed-af88-040300000000', 'Vos services de communication au public en ligne (principalement sites internet et applications mobiles) sont-ils écoconçus ?', '0', '708d624a-432f-11ed-af88-040300000000', 1, 'Services de communication au public en ligne : Selon le Référentiel Général d\'Amélioration de l\'Accessibilité (RGAA), \"Les services de communication au public en ligne sont définis comme toute mise à disposition du public ou de catégories de public, par un procédé de communication électronique, de signes, de signaux, d\'écrits, d\'images, de sons ou de messages de toute nature qui n\'ont pas le caractère d\'une correspondance privée (article 1er de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l\'économie numérique). Conformément au II de l\'article 47 de la loi du 11 février 2005, ils comprennent notamment :\r\nles sites internet, intranet, extranet ; les progiciels, dès lors qu\'ils constituent des applications utilisées au travers d\'un navigateur web ou d\'une application mobile ;\r\nles applications mobiles qui sont définies comme tout logiciel d\'application conçu et développé en vue d\'être utilisé sur des appareils mobiles, tels que des téléphones intelligents (smartphones) et des tablettes, hors système d\'exploitation ou matériel ;\r\nle mobilier urbain numérique, pour leur partie applicative ou interactive, hors système d\'exploitation ou matériel.\"', NULL, NULL),
('cc68db7c-432a-11ed-af88-040300000000', 'L\'utilisation des outils professionnels à des fins personnelles et/ou l\'utilisation d\'outils personnels à des fins professionnelles est-elle autorisée ?', '8445cf29-432a-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 0, NULL, 'La mutualisation des usages permet la réduction du taux d\'équipement et impacts liés à la démultiplication des outils numériques. \r\nConcernant par exemple les téléphones et ordinateurs portables, les impacts environnementaux liés à ces derniers sont nombreux tout au long de son cycle de vie, aussi est-il préférable de ne pas faire doublon avec un terminal professionnel et un autre personnel lorsque cela est possible. ', NULL),
('d0ba97c8-432f-11ed-af88-040300000000', 'Les personnes en charge de la communication sont-elles au fait des principes de la sobriété éditoriale ? ', '0', '708d624a-432f-11ed-af88-040300000000', 1, NULL, 'D\'après le Shift Project, \"le trafic de données est responsable de plus de la moitié de l\'impact énergétique mondial du numérique, avec 55 % de sa consommation d\'énergie annuelle. Chaque octet transféré ou stocké sollicite des terminaux et des infrastructures de grande envergure, gourmandes en énergie (centres de données, réseaux).\" \nEn 2018, les flux vidéo représentaient 80 % des flux de données mondiaux et 80 % de l\'augmentation de leur volume annuel. Les 20 % restants étaient constitués de sites web, de données, de jeux vidéo, etc. La croissance rapide du volume total de données - donc de la consommation d\'énergie et des émissions de gaz à effet de serre associées - est ainsi en très large partie due à la vidéo.\nLa sobriété éditoriale vise à réduire ces différents impacts par la mise en place d\'une communication raisonnée et adaptée aux besoins de votre structure et des personnes auxquelles elle s\'adresse. ', NULL),
('d577dd6e-432d-11ed-af88-040300000000', 'Selon quelles modalités les outils numériques sont-ils reliés au réseau internet ? (plusieurs réponses possibles)', '0', 'd573027d-432d-11ed-af88-040300000000', 1, NULL, 'Plusieurs études ont démontré que les réseaux mobiles (2G/3G4G/5G) présentent un impact environnemental largement supérieur aux autres (filaire et Wi-Fi). Voir notamment la note de synthèse de l\'étude corédigée par l\'Arcep et l\'ADEME de janvier 2022 (Évaluation de l\'impact environnemental du numérique en France et analyse prospective) : \"Par ailleurs, les réseaux fixes concentrent la majorité des impacts (entre 75 et 90 % des impacts suivant l\'indicateur). Mais, rapporté à la quantité de Go consommée sur chaque réseau, l\'impact environnemental des réseaux fixes devient inférieur à celui des réseaux mobiles. Par Go consommé, les réseaux mobiles ont près de trois fois plus d\'impact que les réseaux fixes pour l\'ensemble des indicateurs environnementaux étudiés. \" ', NULL),
('df2d0860-432c-11ed-af88-040300000000', 'Avez-vous mis en place des paramétrages favorisant la sobriété numérique en matière d\'impression de documents (impression en noir et blanc, recto/verso, protégée...) ? ', 'ae7714cd-432c-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 0, NULL, NULL, NULL),
('e4abe8ce-4329-11ed-af88-040300000000', 'Votre structure a-t-elle recours à la location de matériels numériques ? ', '0', 'e4a990cd-4329-11ed-af88-040300000000', 0, NULL, 'Selon le Guide des achats numériques responsables de la Direction des Achats de l\'État (DAE) : \"La location est une alternative à l\'achat des équipements numériques. Cette pratique permet à l\'organisation d\'ajuster son parc au besoin de chaque utilisateur et de faire face à des urgences ou à des besoins ponctuels. Cette approche est un des axes forts de l\'économie circulaire : «l\'économie de la fonctionnalité» c\'est à dire acheter l\'usage plutôt que le bien.\"\r\nPour autant, son impact bénéfique reste conditionné au fait que le matériel loué \"soit réintroduit dans un cycle de vie prolongé par l\'opérateur.\"', NULL),
('eb7b6a37-432e-11ed-af88-040300000000', 'Le télétravail est-il en place ? ', '0', '54aa9a19-432e-11ed-af88-040300000000', 0, NULL, 'Bien que la mise en place du télétravail implique de nouveaux impacts qu\'il est nécessaire de prendre en compte dans son déploiement afin d\'éviter le phénomène des \"effets de rebond\", sa mise en place permet, dans de nombreux contextes, de réduire les émissions de gaz à effets de serre liées aux déplacements. Selon une récente étude de l\'ADEME (2020) : \"En conclusion, l\'ensemble des effets rebond identifiés (déplacements supplémentaires, relocalisation du domicile, usage de la visioconférence, consommations énergétiques du domicile...) peuvent réduire en moyenne de 31 % les bénéfices environnementaux du télétravail. Cependant, si l\'on prend en compte également les effets positifs induits - en particulier ceux générés par le flex office organisé, nous obtenons une balance positive de + 52 %. Ces bénéfices sont significatifs et justifient l\'encouragement du développement du télétravail, dans un contexte où il est par ailleurs plébiscité par les salariés eux-mêmes en raison de ses avantages individuels (qualité de vie, gain de temps et d\'argent, etc.).\"', NULL),
('f31818e9-432d-11ed-af88-040300000000', 'Une politique de gestion des données numériques (suppression des doublons, mutualisation des données, durée de conservation limitée, archivage intermédiaire et définitif, système d\'archivage électronique (SAE), etc.) est-elle en place ?', '0', 'd573027d-432d-11ed-af88-040300000000', 0, NULL, 'Selon le Livre blanc de l\'action GreenConcept : \"Chaque octet a un impact. Il faut donc réduire au maximum la quantité de données produites, traitées, transportées et stockées.\"\r\nLa donnée est en effet au cœur du sujet de la sobriété numérique puisque c\'est afin de la traiter, de la stocker, ou encore de la transférer que les infrastructures numériques sont mises en place. ', NULL),
('ff534475-4328-11ed-af88-040300000000', 'Votre structure a-t-elle mis en place une gouvernance pour la sobriété numérique (désignation d\'un référent, prise d\'engagements, définition d\'objectifs, mise en place d\'actions...) ', '0', 'b5aa2df1-4328-11ed-af88-040300000000', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recommandation`
--

CREATE TABLE `recommandation` (
  `Id` char(36) NOT NULL,
  `Titre` varchar(5000) DEFAULT NULL,
  `Text` longtext,
  `IdQuestion` char(36) NOT NULL,
  `IdCategorie` char(36) NOT NULL,
  `NiveauReco` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recommandation`
--

INSERT INTO `recommandation` (`Id`, `Titre`, `Text`, `IdQuestion`, `IdCategorie`, `NiveauReco`) VALUES
('0c99960c-432d-11ed-af88-040300000000', 'Connaissez-vous les obligations de votre structure en matière de traitement des DEEE ? ', 'Organiser la collecte et assurer le recyclage des DEEE : \r\n-	Ne considérer le recyclage qu\'en dernier ressort et étudier la possibilité de réparer, réemployer ou réutiliser les EEE ainsi que leurs déchets collectés : à noter que les équipements informatiques fonctionnels de moins de 10 ans doivent désormais rejoindre les filières du réemploi et de la réutilisation (précisions à venir par l\'adoption d\'un décret d\'application qui précisera les modalités, les quantités et le calendrier) ; \r\n-	Mettre en place de façon systématique et optimiser le tri des DEEE ; \r\n-	Choisir un éco-organisme agréé pour la prise en charge de ses DEEE ; \r\n-	Assurer une traçabilité des DEEE et notamment obtenir des attestations de bon traitement des prestataires externes chargés de leur reprise.', '0c983ebb-432d-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('10f05e41-432a-11ed-af88-040300000000', 'Des mesures permettant de favoriser la sobriété numérique dans les achats et locations d\'équipements numériques ainsi que de logiciels ont-elles été prises (ajout de clauses contractuelles, prise en compte des écolabels , de l\'indice de réparabilité , de l\'éco-conception , achat/location d\'équipements issus du réemploi ou de la réutilisation...) ? ', 'Mettre en place des mesures permettant de favoriser la sobriété numérique dans les achats et locations d\'équipements numériques ainsi que de logiciels (ajout de clauses contractuelles, prise en compte des écolabels, de l\'indice de réparabilité, de l\'éco-conception, achat/location d\'équipements issus du réemploi ou de la réutilisation...).', '10eeee49-432a-11ed-af88-040300000000', 'e4a990cd-4329-11ed-af88-040300000000', 1),
('1d828c9d-432f-11ed-af88-040300000000', 'Avez-vous mis en place des consignes particulières favorisant la sobriété numérique en matière d\'impression de documents (police imposée, nombre limité d\'impressions...) ? ', 'Inviter les utilisateurs à adopter les principes de sobriété numérique en matière d\'impression (quotas, suivi des impressions, paramétrages, etc.).', '1d75bed8-432f-11ed-af88-040300000000', '54aa9a19-432e-11ed-af88-040300000000', 1),
('29ed69ef-432a-11ed-af88-040300000000', 'Des mesures permettant de favoriser la sobriété numérique dans les achats pour l\'impression ont-elles été prises (choix du papier, de l\'encre et des toners...) ?', 'Mettre en place des mesures permettant de favoriser la sobriété numérique dans les achats pour l\'impression (choix du papier, de l\'encre et des toners...). ', '29ebe668-432a-11ed-af88-040300000000', 'e4a990cd-4329-11ed-af88-040300000000', 1),
('38e9cb83-4329-11ed-af88-040300000000', 'Des actions de sensibilisation sont-elles menées auprès du personnel sur les enjeux et bonnes pratiques en matière de sobriété numérique ? ', 'Assurer une sensibilisation régulière des agents et autres personnels de votre structure, aux enjeux et bonnes pratiques de la sobriété numérique.\r\nEn complément de sessions de sensibilisation, diffuser ces enjeux en interne via différents supports physiques et numériques (note d\'organisation, affichage, lettre d\'information interne...).', '38e7f306-4329-11ed-af88-040300000000', '38e51811-4329-11ed-af88-040300000000', 1),
('3d385289-432f-11ed-af88-040300000000', 'La collecte et le recyclage du papier sont-ils réalisés au sein de votre structure ? ', 'Assurer la collecte et le recyclage du papier. \r\nInviter les personnes à ne pas froisser le papier destiné au recyclage afin de ne pas entraver le bon déroulement de ce processus. \r\nLes documents papiers contenant des données personnelles doivent être passés au destructeur de documents afin d\'en préserver la confidentialité.', '3d36ff72-432f-11ed-af88-040300000000', '54aa9a19-432e-11ed-af88-040300000000', 1),
('4aa40dcd-432a-11ed-af88-040300000000', 'Faîtes-vous appel à des fournisseurs d\'énergie dite « verte »/renouvelable ? ', 'Alimenter le système d\'information (SI) de préférence avec de l\'énergie renouvelable ou dite \'\'décarbonée\'\' ou encore \'\'verte\'\'.', '4aa285ba-432a-11ed-af88-040300000000', 'e4a990cd-4329-11ed-af88-040300000000', 1),
('54addb73-432e-11ed-af88-040300000000', 'Des obligations et/ou bonnes pratiques favorisant la sobriété numérique (gestion et tri des boîtes de messagerie, espaces de stockage en ligne, mise en veille et extinction des outils numériques...) ont-elles été mises en place via la charte informatique ou tout autre support ou format ? ', 'Reco 1 : Appliquer et diffuser les principes de la sobriété numérique à la gestion des boîtes mail (rédaction, pièces jointes, tri, paramétrages, etc.), à la navigation en ligne (choix du navigateur, recherches, etc.) ou encore à l\'écoute de musique et autres contenus audiovisuels durant le temps de travail (streaming, choix du média, etc.).', '54ac56c5-432e-11ed-af88-040300000000', '54aa9a19-432e-11ed-af88-040300000000', 1),
('54b36bdc-432e-11ed-af88-040300000000', 'Des obligations et/ou bonnes pratiques favorisant la sobriété numérique (gestion et tri des boîtes de messagerie, espaces de stockage en ligne, mise en veille et extinction des outils numériques...) ont-elles été mises en place via la charte informatique ou tout autre support ou format ? ', 'Reco 2 : Intégrer les enjeux et bonnes pratiques de la sobriété numérique à la charte informatique de votre structure si elle existe. À défaut, les diffuser via un document dédié à faire signer par les utilisateurs pour en assurer l\'opposabilité.', '54ac56c5-432e-11ed-af88-040300000000', '54aa9a19-432e-11ed-af88-040300000000', 1),
('70919517-432f-11ed-af88-040300000000', 'Les solutions logicielles et applications utilisées sont-elles écoconçues ? ', 'Conformément aux dispositions de la loi AGEC, favoriser les solutions logicielles et applications écoconçues.', '70900c22-432f-11ed-af88-040300000000', '708d624a-432f-11ed-af88-040300000000', 1),
('723c94e3-432b-11ed-af88-040300000000', 'Avez-vous mis en place des consignes et pratiques de nature à allonger la durée de vie de vos équipements numériques (favoriser la réparation avant le remplacement, dissocier le remplacement des équipements selon les besoins, maintenance...) ?', 'Reco 1 : Mettre en place des consignes et pratiques de nature à allonger la durée de vie de vos équipements numériques (favoriser la réparation avant le remplacement, dissocier le remplacement des équipements selon les besoins, assurer une maintenance régulière...).', '723af67d-432b-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('723d1cb7-432b-11ed-af88-040300000000', 'Avez-vous mis en place des consignes et pratiques de nature à allonger la durée de vie de vos équipements numériques (favoriser la réparation avant le remplacement, dissocier le remplacement des équipements selon les besoins, maintenance...) ?', 'Reco 2 : Mettre en place une politique de gestion du parc numérique intégrant les principes de la sobriété numérique (l\'identification des besoins utilisateurs par profils-types, le cycle de vie des différents outils et notamment  le potentiel réemploi interne ou externe de matériels en fin de vie, la durée d\'amortissement, ou encore la méthodologie choisie pour sa réparabilité (interne ou externalisation), son impact environnemental (GES ou ACV), ses bonnes pratiques d\'usage (extinction, veille, allumage, etc...)).', '723af67d-432b-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('77ed821d-4329-11ed-af88-040300000000', 'Le personnel de votre structure a-t-il été formé aux enjeux et bonnes pratiques en matière de sobriété numérique ? ', 'Former les responsables et/ou agents et autres personnels les plus concernés aux enjeux et bonnes pratiques de la sobriété numérique (DSI/service informatique, achats & marchés publics, communication...).', '77eb5ab7-4329-11ed-af88-040300000000', '38e51811-4329-11ed-af88-040300000000', 1),
('8447a8da-432a-11ed-af88-040300000000', 'Disposez-vous d\'un inventaire du parc numérique de votre structure (postes informatiques et écrans, téléphones, tablettes, supports de sauvegardes amovibles, vidéoprojecteurs...) ? ', 'Tenir un inventaire du parc numérique de votre structure (postes informatiques et écrans, téléphones, tablettes, supports de sauvegardes amovibles, vidéoprojecteurs...). Celui-ci est un élément indispensable de la cartographie de son système d\'information (SI). ', '844646f7-432a-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('8e712593-432d-11ed-af88-040300000000', 'Une politique de gestion des DEEE est-elle en place (postes informatiques, téléphones, imprimantes/scanners, cartouches d\'encre et toner...) ? ', 'Organiser la collecte et assurer le recyclage des DEEE : \r\n-	Ne considérer le recyclage qu\'en dernier ressort et étudier la possibilité de réparer, réemployer ou réutiliser les EEE ainsi que leurs déchets collectés : à noter que les équipements informatiques fonctionnels de moins de 10 ans doivent désormais rejoindre les filières du réemploi et de la réutilisation (précisions à venir par l\'adoption d\'un décret d\'application qui précisera les modalités, les quantités et le calendrier) ; \r\n-	Mettre en place de façon systématique et optimiser le tri des DEEE ; \r\n-	Choisir un éco-organisme agréé pour la prise en charge de ses DEEE ; \r\n-	Assurer une traçabilité des DEEE et notamment obtenir des attestations de bon traitement des prestataires externes chargés de leur reprise.', '8e6521c5-432d-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('95dfa52b-4329-11ed-af88-040300000000', 'Des actions de sensibilisation sont-elles menées auprès des élus sur les enjeux et bonnes pratiques en matière de sobriété numérique ? ', 'Assurer une sensibilisation régulière des élus et membres des instances dirigeantes de votre structure, aux enjeux et bonnes pratiques de la sobriété numérique.', '95de2d83-4329-11ed-af88-040300000000', '38e51811-4329-11ed-af88-040300000000', 1),
('96bd2d0a-432e-11ed-af88-040300000000', 'Votre structure fait-elle un usage régulier de la visioconférence ? ', 'Reco 1 : Évaluer la pertinence d\'organiser une visioconférence. Si elle permet parfois d\'éviter des déplacements superflus et impactants pour l\'environnement, il est parfois préférable d\'opter pour un format en présentiel ou une conférence téléphonique selon les besoins. ', '96bb7d32-432e-11ed-af88-040300000000', '54aa9a19-432e-11ed-af88-040300000000', 1),
('acca306a-7796-11ed-8685-0242ac110006', 'Commencer ou poursuivre la mise en conformité RGPD/LIL', 'Commencer ou poursuivre la mise en conformité de la structure aux règles relatives à la protection des données, à commencer par le RGPD (Règlement Général sur la Protection des Données) et la LIL (Loi Informatique et Libertés). ', '451bcb28-7795-11ed-8685-0242ac110006', 'f1335739-7793-11ed-8685-0242ac110006', 1),
('ae791a0a-432c-11ed-af88-040300000000', 'Avez-vous mis en place des consignes et pratiques de nature à réduire la consommation d\'énergie de votre parc numérique (mise en veille, extinction des équipements, paramétrage de la luminosité, suivi des consommations...) ? ', 'Reco 1 : Appliquer et diffuser les bonnes pratiques favorisant les économies d\'énergie dans l\'utilisation des équipements numériques. Cela contribuera également à allonger la durée de vie de leur batterie et donc des équipements eux-mêmes.', 'ae77a55d-432c-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('ae7e8fa9-432c-11ed-af88-040300000000', 'Avez-vous mis en place des consignes et pratiques de nature à réduire la consommation d\'énergie de votre parc numérique (mise en veille, extinction des équipements, paramétrage de la luminosité, suivi des consommations...) ? ', 'Reco 2 : Sauf contrainte technique ou organisationnelle, déconnecter ou débrancher tous les outils numériques en fin de journée. Le faire a minima avant les week-ends et absences prolongées. \r\nCette opération peut être facilitée par l\'installation de multiprises, voire la mise en place d\'un logiciel de power management. ', 'ae77a55d-432c-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('b5ad3ef7-4328-11ed-af88-040300000000', 'Votre structure a-t-elle pris en compte la sobriété numérique et la transition environnementale dans ses actions et projets en lien avec le numérique ? ', 'Mettre en place une gouvernance de la démarche vers un numérique plus sobre (désignation d\'un référent opérationnel/élu, création d\'un comité de pilotage, rédaction d\'un plan d\'actions...).', 'b5abe326-4328-11ed-af88-040300000000', 'b5aa2df1-4328-11ed-af88-040300000000', 1),
('b8b45aea-432b-11ed-af88-040300000000', 'Utilisez-vous des solutions logicielles et systèmes d\'exploitation libres ?', 'Lorsque cela est possible, privilégier l\'utilisation de solutions logicielles et systèmes d\'exploitation libres.', 'b8a7c8bd-432b-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('b8dbd094-432a-11ed-af88-040300000000', 'Assurez-vous la traçabilité des attributions et besoins en outils informatiques en interne ? ', 'Assurer le suivi des attributions d\'outils numériques : \r\n-	Mettre en place une documentation assurant la traçabilité des attributions et restitutions d\'outils ; \r\n-	Effectuer une revue annuelle des besoins et attributions ; \r\n-	Inviter les utilisateurs à restituer le matériel non-utilisé pour réaffectation selon les besoins internes.', 'b8da12ea-432a-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('ba3d8457-432f-11ed-af88-040300000000', 'Vos services de communication au public en ligne (principalement sites internet et applications mobiles) sont-ils écoconçus ?', 'Appliquer les principes de l\'écoconception aux sites internet, applications mobiles et autres services de communication au public en ligne développés en interne ou par le biais de prestataires externes.', 'ba309c8c-432f-11ed-af88-040300000000', '708d624a-432f-11ed-af88-040300000000', 1),
('c222a79d-432e-11ed-af88-040300000000', 'Votre structure fait-elle un usage régulier de la visioconférence ? ', 'Reco 2 : Désactiver les webcams lors des visioconférences lorsqu\'il n\'est pas pertinent de les garder allumées (lorsque l\'animateur projette une présentation ou qu\'une participation active n\'est pas attendue par exemple). Le but est de trouver le juste équilibre entre convivialité et maîtrise des impacts liés à l\'utilisation des webcams. ', '96bb7d32-432e-11ed-af88-040300000000', '54aa9a19-432e-11ed-af88-040300000000', 1),
('cc6a2e7a-432a-11ed-af88-040300000000', 'L\'utilisation des outils professionnels à des fins personnelles et/ou l\'utilisation d\'outils personnels à des fins professionnelles est-elle autorisée ?', 'Reco 1 : Autoriser l\'utilisation des outils numériques professionnels sur le temps personnel et/ou favoriser la pratique du BYOD (Bring Your Own Device). À noter toutefois que cette dernière est fortement déconseillée par l\'ANSSI (Agence nationale de la sécurité des systèmes d\'information) pour des raisons de sécurité du système d\'information. Elle peut toutefois être mise en place sous réserve de bien l\'encadrer. \r\nCes pratiques doivent dans tous les cas être encadrées par un document de type charte informatique afin de ne pas remettre en cause la sécurité du système d\'information, la protection des données personnelles, ainsi que le nécessaire cloisonnement entre vie privée et vie professionnelle. Consulter les ressources humaines, le DPO et/ou le RSSI de votre structure pour un accompagnement. ', 'cc68db7c-432a-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('d0bcdd62-432f-11ed-af88-040300000000', 'Les personnes en charge de la communication sont-elles au fait des principes de la sobriété éditoriale ? ', 'Tenir compte des principes de la sobriété éditoriale dans le cadre de la production des supports et la politique de communication de la structure.', 'd0ba97c8-432f-11ed-af88-040300000000', '708d624a-432f-11ed-af88-040300000000', 1),
('d579472b-432d-11ed-af88-040300000000', 'Selon quelles modalités les outils numériques sont-ils reliés au réseau internet ? (plusieurs réponses possibles)', 'Privilégier la connexion réseau en filaire ou via Wi-Fi à défaut. L\'utilisation de la 2G/3G/4G/5G doit être réduite au strict minimum (par exemple en désactivant le transfert de données mobiles une fois la tâche accomplie).', 'd577dd6e-432d-11ed-af88-040300000000', 'd573027d-432d-11ed-af88-040300000000', 1),
('df651a87-432c-11ed-af88-040300000000', 'Avez-vous mis en place des paramétrages favorisant la sobriété numérique en matière d\'impression de documents (impression en noir et blanc, recto/verso, protégée...) ? ', 'Modifier les paramètres d\'impression par défaut des postes informatiques et imprimantes (mode éco, noir et blanc, etc.).', 'df2d0860-432c-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('e4ad88c8-4329-11ed-af88-040300000000', 'Votre structure a-t-elle recours à la location de matériels numériques ? ', 'Privilégier la location d\'équipements numériques à l\'achat. \r\nVeiller toutefois à ce que le prestataire prenne des engagements favorisant effectivement l\'allongement de la durée de vie du matériel loué (matériel écolabellisé et durable, réemployé à l\'issue du contrat...). Il est par exemple possible de fixer un seuil minimum de réemploi du matériel loué à cette fin. ', 'e4abe8ce-4329-11ed-af88-040300000000', 'e4a990cd-4329-11ed-af88-040300000000', 1),
('eb7d1264-432e-11ed-af88-040300000000', 'Le télétravail est-il en place ? ', 'Étudier la pertinence de déployer le télétravail au sein de votre structure.', 'eb7b6a37-432e-11ed-af88-040300000000', '54aa9a19-432e-11ed-af88-040300000000', 1),
('f31e2143-432d-11ed-af88-040300000000', 'Une politique de gestion des données numériques (suppression des doublons, mutualisation des données, durée de conservation limitée, archivage intermédiaire et définitif, système d\'archivage électronique (SAE), etc.) est-elle en place ?', 'Mettre en place une politique de gestion de la donnée afin d\'en limiter la quantité stockée sur les supports dédiés (gestion de la collecte, de la conservation, de l\'archivage des données, etc.). \r\nVeiller à tenir compte des règles propres à l\'archivage public dans ce processus. Se rapprocher du service des archives compétent, ainsi que des archives départementales pour un accompagnement. \r\nIl convient en outre d\'associer le délégué à la protection des données (DPO) de votre structure, s\'il y en a un, pour les questions relatives aux données personnelles.', 'f31818e9-432d-11ed-af88-040300000000', 'd573027d-432d-11ed-af88-040300000000', 1),
('fe69740d-432a-11ed-af88-040300000000', 'L\'utilisation des outils professionnels à des fins personnelles et/ou l\'utilisation d\'outils personnels à des fins professionnelles est-elle autorisée ?', 'Reco 2 : Favoriser le recours à la double carte SIM afin de réduire les doublons téléphones portables professionnel/personnel.', 'cc68db7c-432a-11ed-af88-040300000000', '8444bdb4-432a-11ed-af88-040300000000', 1),
('ff78485d-4328-11ed-af88-040300000000', 'Votre structure a-t-elle mis en place une gouvernance pour la sobriété numérique (désignation d\'un référent, prise d\'engagements, définition d\'objectifs, mise en place d\'actions...) ', 'Mettre en place une gouvernance de la démarche vers un numérique plus sobre (désignation d\'un référent opérationnel/élu, création d\'un comité de pilotage, rédaction d\'un plan d\'actions...).', 'ff534475-4328-11ed-af88-040300000000', 'b5aa2df1-4328-11ed-af88-040300000000', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ref_NiveauReco`
--

CREATE TABLE `ref_NiveauReco` (
  `Id` int(11) NOT NULL,
  `Label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ref_NiveauReco`
--

INSERT INTO `ref_NiveauReco` (`Id`, `Label`) VALUES
(0, 'Faible'),
(1, 'Normal'),
(2, 'Élevé');

-- --------------------------------------------------------

--
-- Structure de la table `ref_TypeCollectivite`
--

CREATE TABLE `ref_TypeCollectivite` (
  `Id` char(36) NOT NULL,
  `Nom` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ref_TypeCollectivite`
--

INSERT INTO `ref_TypeCollectivite` (`Id`, `Nom`) VALUES
('3e85465a-ffff-11eb-acf0-0cc47a0ad120', 'CA'),
('57482110-fe97-11eb-acf0-0cc47a0ad120', 'Mairie'),
('5748268d-fe97-11eb-acf0-0cc47a0ad120', 'COMCOM'),
('73097104-8c33-11ed-97b8-0242ac110004', 'Autre'),
('7ab89f99-8c33-11ed-97b8-0242ac110004', 'EPCI'),
('8f9d4a91-fff3-11eb-acf0-0cc47a0ad120', 'OPSN');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `Id` char(36) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Text` longtext,
  `IdQuestion` char(36) NOT NULL,
  `Ponderation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`Id`, `Type`, `Text`, `IdQuestion`, `Ponderation`) VALUES
('0c98b193-432d-11ed-af88-040300000000', 'button', 'Oui', '0c983ebb-432d-11ed-af88-040300000000', 1),
('0c9924cd-432d-11ed-af88-040300000000', 'button', 'Non', '0c983ebb-432d-11ed-af88-040300000000', 0),
('10ef5e62-432a-11ed-af88-040300000000', 'button', 'Oui', '10eeee49-432a-11ed-af88-040300000000', 1),
('10efd08c-432a-11ed-af88-040300000000', 'button', 'Non', '10eeee49-432a-11ed-af88-040300000000', 0),
('1d762bd3-432f-11ed-af88-040300000000', 'button', 'Oui', '1d75bed8-432f-11ed-af88-040300000000', 1),
('1d769738-432f-11ed-af88-040300000000', 'button', 'Non', '1d75bed8-432f-11ed-af88-040300000000', 0),
('29ec5734-432a-11ed-af88-040300000000', 'button', 'Oui', '29ebe668-432a-11ed-af88-040300000000', 1),
('29ecc7c8-432a-11ed-af88-040300000000', 'button', 'Non', '29ebe668-432a-11ed-af88-040300000000', 0),
('2dac8e50-432c-11ed-af88-040300000000', 'button', 'Réemploi en interne', '2dac1dd2-432c-11ed-af88-040300000000', 1),
('2dacfe7b-432c-11ed-af88-040300000000', 'button', 'Réemploi en externe', '2dac1dd2-432c-11ed-af88-040300000000', 1),
('38e86c82-4329-11ed-af88-040300000000', 'button', 'Oui', '38e7f306-4329-11ed-af88-040300000000', 1),
('38e90479-4329-11ed-af88-040300000000', 'button', 'Non', '38e7f306-4329-11ed-af88-040300000000', 0),
('3d377053-432f-11ed-af88-040300000000', 'button', 'Oui', '3d36ff72-432f-11ed-af88-040300000000', 1),
('3d37e0f6-432f-11ed-af88-040300000000', 'button', 'Non', '3d36ff72-432f-11ed-af88-040300000000', 0),
('4aa32bfd-432a-11ed-af88-040300000000', 'button', 'Oui', '4aa285ba-432a-11ed-af88-040300000000', 1),
('4aa3a083-432a-11ed-af88-040300000000', 'button', 'Non', '4aa285ba-432a-11ed-af88-040300000000', 0),
('54acd04a-432e-11ed-af88-040300000000', 'button', 'Oui', '54ac56c5-432e-11ed-af88-040300000000', 1),
('54ad4c51-432e-11ed-af88-040300000000', 'button', 'Non', '54ac56c5-432e-11ed-af88-040300000000', 0),
('5b9565a3-432c-11ed-af88-040300000000', 'button', 'Mise aux rebuts/recyclage', '2dac1dd2-432c-11ed-af88-040300000000', 0),
('5b95e6e4-432c-11ed-af88-040300000000', 'button', 'Pas de gestion', '2dac1dd2-432c-11ed-af88-040300000000', 0),
('5bab8591-432c-11ed-af88-040300000000', 'button', 'Je ne sais pas', '2dac1dd2-432c-11ed-af88-040300000000', 0),
('7090915f-432f-11ed-af88-040300000000', 'button', 'Oui', '70900c22-432f-11ed-af88-040300000000', 1),
('709116b3-432f-11ed-af88-040300000000', 'button', 'Non', '70900c22-432f-11ed-af88-040300000000', 0),
('723b8414-432b-11ed-af88-040300000000', 'button', 'Oui', '723af67d-432b-11ed-af88-040300000000', 1),
('723c0ca4-432b-11ed-af88-040300000000', 'button', 'Non', '723af67d-432b-11ed-af88-040300000000', 0),
('77ec4bc6-4329-11ed-af88-040300000000', 'button', 'Oui', '77eb5ab7-4329-11ed-af88-040300000000', 1),
('77ed08fa-4329-11ed-af88-040300000000', 'button', 'Non', '77eb5ab7-4329-11ed-af88-040300000000', 0),
('8446bd3e-432a-11ed-af88-040300000000', 'button', 'Oui', '844646f7-432a-11ed-af88-040300000000', 1),
('84473309-432a-11ed-af88-040300000000', 'button', 'Non', '844646f7-432a-11ed-af88-040300000000', 0),
('8e659a9d-432d-11ed-af88-040300000000', 'button', 'Oui, les DEEE sont traités en interne', '8e6521c5-432d-11ed-af88-040300000000', 1),
('8e7088d3-432d-11ed-af88-040300000000', 'button', ' Oui, les DEEE sont traités par une structure tierce (prestataire privé, association...)', '8e6521c5-432d-11ed-af88-040300000000', 1),
('8e79502a-432d-11ed-af88-040300000000', 'button', 'Non', '8e6521c5-432d-11ed-af88-040300000000', 0),
('8e79e77a-432d-11ed-af88-040300000000', 'button', 'Je ne sais pas', '8e6521c5-432d-11ed-af88-040300000000', 0),
('95deb17b-4329-11ed-af88-040300000000', 'button', 'Oui', '95de2d83-4329-11ed-af88-040300000000', 1),
('95df32b4-4329-11ed-af88-040300000000', 'button', 'Non', '95de2d83-4329-11ed-af88-040300000000', 0),
('96bbf4ea-432e-11ed-af88-040300000000', 'button', 'Oui', '96bb7d32-432e-11ed-af88-040300000000', 1),
('96bcb2a1-432e-11ed-af88-040300000000', 'button', 'Non', '96bb7d32-432e-11ed-af88-040300000000', 0),
('ae781cae-432c-11ed-af88-040300000000', 'button', 'Oui', 'ae77a55d-432c-11ed-af88-040300000000', 1),
('ae789a55-432c-11ed-af88-040300000000', 'button', 'Non', 'ae77a55d-432c-11ed-af88-040300000000', 0),
('b5ac58f0-4328-11ed-af88-040300000000', 'button', 'Oui', 'b5abe326-4328-11ed-af88-040300000000', 1),
('b5accc4a-4328-11ed-af88-040300000000', 'button', 'Non', 'b5abe326-4328-11ed-af88-040300000000', 0),
('b8b08fe1-432b-11ed-af88-040300000000', 'button', 'Oui', 'b8a7c8bd-432b-11ed-af88-040300000000', 1),
('b8b377c5-432b-11ed-af88-040300000000', 'button', 'Non', 'b8a7c8bd-432b-11ed-af88-040300000000', 0),
('b8dad256-432a-11ed-af88-040300000000', 'button', 'Oui', 'b8da12ea-432a-11ed-af88-040300000000', 1),
('b8db5c4d-432a-11ed-af88-040300000000', 'button', 'Non', 'b8da12ea-432a-11ed-af88-040300000000', 0),
('ba311210-432f-11ed-af88-040300000000', 'button', 'La structure n\'est pas concernée', 'ba309c8c-432f-11ed-af88-040300000000', 1),
('ba319043-432f-11ed-af88-040300000000', 'button', 'Oui', 'ba309c8c-432f-11ed-af88-040300000000', 1),
('ba40fd79-432f-11ed-af88-040300000000', 'button', 'Je ne sais pas', 'ba309c8c-432f-11ed-af88-040300000000', 0),
('ba4196e4-432f-11ed-af88-040300000000', 'button', 'Non', 'ba309c8c-432f-11ed-af88-040300000000', 0),
('cc69507c-432a-11ed-af88-040300000000', 'button', 'Oui', 'cc68db7c-432a-11ed-af88-040300000000', 1),
('cc69c170-432a-11ed-af88-040300000000', 'button', 'Non', 'cc68db7c-432a-11ed-af88-040300000000', 0),
('d0bb3dbc-432f-11ed-af88-040300000000', 'button', 'La structure n\'est pas concernée', 'd0ba97c8-432f-11ed-af88-040300000000', 1),
('d0bbec24-432f-11ed-af88-040300000000', 'button', 'Oui', 'd0ba97c8-432f-11ed-af88-040300000000', 1),
('d0c06cee-432f-11ed-af88-040300000000', 'button', 'Je ne sais pas', 'd0ba97c8-432f-11ed-af88-040300000000', 0),
('d0c10b70-432f-11ed-af88-040300000000', 'button', 'Non', 'd0ba97c8-432f-11ed-af88-040300000000', 0),
('d57851c9-432d-11ed-af88-040300000000', 'button', 'Connexion Wifi ', 'd577dd6e-432d-11ed-af88-040300000000', 1),
('d578c991-432d-11ed-af88-040300000000', 'button', 'Connexion filaire', 'd577dd6e-432d-11ed-af88-040300000000', 1),
('d57d8290-432d-11ed-af88-040300000000', 'button', 'Réseau 2G/3G/4G', 'd577dd6e-432d-11ed-af88-040300000000', 0),
('d57e1b73-432d-11ed-af88-040300000000', 'button', 'Je ne sais pas', 'd577dd6e-432d-11ed-af88-040300000000', 0),
('df63f0d9-432c-11ed-af88-040300000000', 'button', 'Oui', 'df2d0860-432c-11ed-af88-040300000000', 1),
('df64a226-432c-11ed-af88-040300000000', 'button', 'Non', 'df2d0860-432c-11ed-af88-040300000000', 0),
('e4ac8719-4329-11ed-af88-040300000000', 'button', 'Oui', 'e4abe8ce-4329-11ed-af88-040300000000', 1),
('e4ad080e-4329-11ed-af88-040300000000', 'button', 'Non', 'e4abe8ce-4329-11ed-af88-040300000000', 0),
('eb7c0962-432e-11ed-af88-040300000000', 'button', 'Oui', 'eb7b6a37-432e-11ed-af88-040300000000', 1),
('eb7c9a83-432e-11ed-af88-040300000000', 'button', 'Non', 'eb7b6a37-432e-11ed-af88-040300000000', 0),
('f31af4d0-432d-11ed-af88-040300000000', 'button', 'Oui', 'f31818e9-432d-11ed-af88-040300000000', 1),
('f31d605a-432d-11ed-af88-040300000000', 'button', 'Non', 'f31818e9-432d-11ed-af88-040300000000', 0),
('ff53bd6a-4328-11ed-af88-040300000000', 'button', 'Oui', 'ff534475-4328-11ed-af88-040300000000', 1),
('ff543180-4328-11ed-af88-040300000000', 'button', 'Non', 'ff534475-4328-11ed-af88-040300000000', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Siret_Temporaire`
--

CREATE TABLE `Siret_Temporaire` (
  `Siret` char(14) NOT NULL,
  `Nom` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `Id` char(36) NOT NULL,
  `Theme` varchar(500) DEFAULT NULL,
  `IdCategorie` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`Id`, `Theme`, `IdCategorie`) VALUES
('0', NULL, ''),
('0c97c89c-432d-11ed-af88-040300000000', 'Déchets d\'Équipements Électriques et Électroniques (DEEE ou D3E)', '8444bdb4-432a-11ed-af88-040300000000'),
('723a6705-432b-11ed-af88-040300000000', 'Allongement de la durée de vie ', '8444bdb4-432a-11ed-af88-040300000000'),
('8445cf29-432a-11ed-af88-040300000000', 'Connaissance du parc numérique', '8444bdb4-432a-11ed-af88-040300000000'),
('ae7714cd-432c-11ed-af88-040300000000', 'Énergie et impact environnemental', '8444bdb4-432a-11ed-af88-040300000000');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `Id` char(36) NOT NULL,
  `Mail` varchar(200) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `MotDePasse` varchar(200) DEFAULT NULL,
  `CollectiviteId` char(36) DEFAULT NULL,
  `Admin` tinyint(1) NOT NULL,
  `Token` varchar(500) DEFAULT NULL,
  `Identifiant` varchar(300) NOT NULL,
  `Actif` tinyint(1) NOT NULL,
  `IdMotDePasseOublie` char(36) DEFAULT NULL,
  `DateMotDePasseOublie` datetime DEFAULT NULL,
  `CGU` tinyint(1) NOT NULL DEFAULT '0',
  `IsVerifie` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurReponse`
--

CREATE TABLE `utilisateurReponse` (
  `Id` char(36) NOT NULL,
  `IdQuestion` char(36) NOT NULL,
  `IdReponse` char(36) NOT NULL,
  `CollectiviteId` char(36) NOT NULL,
  `InputText` longtext,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Administrateur`
--
ALTER TABLE `Administrateur`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OPSNId` (`OPSNId`),
  ADD KEY `Identifiant` (`Identifiant`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `collectivite`
--
ALTER TABLE `collectivite`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OPSNId` (`OPSNId`);

--
-- Index pour la table `Departement`
--
ALTER TABLE `Departement`
  ADD KEY `Code` (`Code`),
  ADD KEY `CodeRegion` (`CodeRegion`);

--
-- Index pour la table `historiqueScore`
--
ALTER TABLE `historiqueScore`
  ADD KEY `CollectiviteId` (`CollectiviteId`) USING BTREE;

--
-- Index pour la table `OPSN`
--
ALTER TABLE `OPSN`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `OPSN_Departement`
--
ALTER TABLE `OPSN_Departement`
  ADD PRIMARY KEY (`OPSNId`,`DepartementCode`),
  ADD KEY `OPSNId` (`OPSNId`),
  ADD KEY `DepartementCode` (`DepartementCode`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdTheme` (`IdTheme`),
  ADD KEY `IdCategorie` (`IdCategorie`);

--
-- Index pour la table `recommandation`
--
ALTER TABLE `recommandation`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdCategorie` (`IdQuestion`),
  ADD KEY `IdCategorie_2` (`IdCategorie`);

--
-- Index pour la table `ref_NiveauReco`
--
ALTER TABLE `ref_NiveauReco`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `ref_TypeCollectivite`
--
ALTER TABLE `ref_TypeCollectivite`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdQuestion` (`IdQuestion`);

--
-- Index pour la table `Siret_Temporaire`
--
ALTER TABLE `Siret_Temporaire`
  ADD PRIMARY KEY (`Siret`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdCategorie` (`IdCategorie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CollectiviteId` (`CollectiviteId`);

--
-- Index pour la table `utilisateurReponse`
--
ALTER TABLE `utilisateurReponse`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdQuestion` (`IdQuestion`),
  ADD KEY `IdReponse` (`IdReponse`),
  ADD KEY `IdUtilisateur` (`CollectiviteId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
