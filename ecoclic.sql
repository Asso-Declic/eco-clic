-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : lun. 07 juil. 2025 à 08:32
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecoclic`
--

-- --------------------------------------------------------

--
-- Structure de la table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `question_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `ponderation` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DADD4A251E27F6BF` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `answer`
--

INSERT INTO `answer` (`id`, `type`, `body`, `question_id`, `ponderation`) VALUES
('01a8eb61-4af5-11ee-b615-0cc47a39c2c2', 'button', 'Oui', '6c5a609b-4af4-11ee-b615-0cc47a39c2c2', 3),
('01aa8539-4af5-11ee-b615-0cc47a39c2c2', 'button', 'Non', '6c5a609b-4af4-11ee-b615-0cc47a39c2c2', 0),
('02406b9e-06c9-11ee-b776-0cc47a39c2c0', 'button', 'Non, nous n\'avons pas connaissance de ce sujet', 'eaf0bf23-06bc-11ee-b776-0cc47a39c2c0', 0),
('024242f1-06c9-11ee-b776-0cc47a39c2c0', 'button', 'Non et nous ne souhaitons pas engager cette démarche', 'eaf0bf23-06bc-11ee-b776-0cc47a39c2c0', 0),
('025a8310-06c9-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eaf0bf23-06bc-11ee-b776-0cc47a39c2c0', 0),
('034c3d5b-4b00-11ee-b615-0cc47a39c2c2', 'button', 'Oui', 'a950ed4d-4aff-11ee-b615-0cc47a39c2c2', 2),
('03614917-4b00-11ee-b615-0cc47a39c2c2', 'button', 'Non', 'a950ed4d-4aff-11ee-b615-0cc47a39c2c2', 0),
('03d55304-06c7-11ee-b776-0cc47a39c2c0', 'button', 'Via des dossiers partagés en réseau', 'eaea20ae-06bc-11ee-b776-0cc47a39c2c0', 0),
('03d629c1-06c7-11ee-b776-0cc47a39c2c0', 'button', 'Via messagerie instantanée', 'eaea20ae-06bc-11ee-b776-0cc47a39c2c0', 0),
('03d6c32a-06c7-11ee-b776-0cc47a39c2c0', 'button', 'Via un outil de partage en ligne', 'eaea20ae-06bc-11ee-b776-0cc47a39c2c0', 0),
('03d7750e-06c7-11ee-b776-0cc47a39c2c0', 'button', 'Via un support externe (clé USB, disque dur...)', 'eaea20ae-06bc-11ee-b776-0cc47a39c2c0', 0),
('03d7fc2e-06c7-11ee-b776-0cc47a39c2c0', 'button', 'Autre', 'eaea20ae-06bc-11ee-b776-0cc47a39c2c0', 0),
('0a7ae8a6-06c2-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eadfd1c0-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d00b3ab-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'ead873c4-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d00c687-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'ead873c4-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d011766-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'ead8cae7-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0129c9-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (quelles missions, depuis combien de temps, combien de personnes sont-elles concernées ?...).', 'ead8cae7-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d016da0-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'ead8f657-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0184d1-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si non, quelles sont leurs autres fonctions ?', 'ead8f657-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d01c8c3-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'ead9205e-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d01dd27-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (quelles missions, depuis combien de temps, combien de personnes sont-elles concernées ?...).', 'ead9205e-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d022375-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'ead94a96-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0237ab-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, indiquez son identité.', 'ead94a96-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d027aa7-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'ead9753f-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d028dad-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si non, précisez (date de création, composition, missions, modalités/fréquence de réunion, moyens humains et financiers alloués...).', 'ead9753f-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d02d405-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'ead99d87-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d02e7dd-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (date et nature des engagements...) et fournissez la documentation le cas échéant.', 'ead99d87-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d03348d-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'ead9ca87-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d034bb1-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (date et nature des engagements, format de diffusion...) et fournissez la documentation le cas échéant.', 'ead9ca87-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d03a024-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'ead9ef35-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d03b4b6-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'ead9ef35-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d040769-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eada1203-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d041d9f-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (actions planifiées, échéances, indices de suivi...) et fournissez la documentation le cas échéant.', 'eada1203-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d047152-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eada3460-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d04862b-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eada3460-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d04c49b-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eada5694-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d04dcc7-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eada5694-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d052c17-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eada8fd0-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d0541dd-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eada8fd0-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d059229-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eadacc92-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d05a7d3-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadacc92-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d05f666-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eadb0117-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d060d39-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadb0117-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d065fb8-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eadb3a87-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d067457-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadb3a87-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d06d955-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadb8410-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d06edfe-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (types de matériel concernés, quantité estimée...).', 'eadb8410-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d073fa2-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadbba62-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d075418-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (types de matériel concernés, quantité estimée...).', 'eadbba62-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d07a68d-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadbf343-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d07bb72-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (types de marché disposant de clauses-types, nature des clauses, poids dans la notation...) et fournissez la documentation le cas échéant.', 'eadbf343-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d080dc0-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadc2bc8-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0822db-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (écolabels privilégiés, quantité estimée...).', 'eadc2bc8-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0872c4-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadc66b4-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d088996-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eadc66b4-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d08db87-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadc9d71-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d08f147-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez et fournissez la documentation le cas échéant.', 'eadc9d71-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d092c84-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eadcd379-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d09428d-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadcd379-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d09aa05-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eade5b21-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d09c088-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (écolabels privilégiés, quantité estimée...).', 'eade5b21-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0a0e7b-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eade9913-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0a23d5-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (types privilégiés, quantité estimée...).', 'eade9913-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0a707b-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadec861-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0a85e7-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eadec861-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0ac21c-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eadefc43-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d0ad899-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadefc43-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0b296c-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eadf40b1-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d0b404c-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadf40b1-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0ba279-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadf7764-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0c0532-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eadfd1c0-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0c1a6b-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Précisez.', 'eadfd1c0-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0c8006-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Réponse', 'eae0041e-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0cce70-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eae03ede-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0ce412-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Réponse', 'eae03ede-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0d360c-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eae07ac9-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0d4d43-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Réponse', 'eae07ac9-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0d8749-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eae0b739-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d0d9df3-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae0b739-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0e057a-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae0efce-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0e2006-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eae0efce-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0e724b-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Nombre moyen d\'écrans/utilisateur', 'eae128ef-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0e89f0-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Taille moyenne des écrans mis à disposition', 'eae128ef-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0faab9-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Nombre de téléphones professionnels', 'eae2025d-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d0fc18c-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Types de téléphones mis à disposition', 'eae2025d-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1011b0-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eae246b3-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d102972-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae246b3-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d107c20-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eae2877c-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d109285-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae2877c-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d10fda7-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae2c4d3-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1113ef-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eae2c4d3-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1163a4-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae300f3-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1178eb-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, selon quelle méthode estimez-vous les besoins ?', 'eae300f3-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d11dcbd-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Précisez pour chaque.', 'eae33bb4-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d13842e-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae37420-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d139a95-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (nature des profils identifiés, différences dans les paramétrages...).', 'eae37420-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d13f452-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae3aeb4-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d140a83-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si nécessaire, précisez.', 'eae3aeb4-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d14646e-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae3ecd0-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d147b0e-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si nécessaire, précisez.', 'eae3ecd0-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d14cf80-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae42705-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d14e89c-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si nécessaire, précisez.', 'eae42705-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1538cc-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae46319-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d154f00-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si nécessaire, précisez.', 'eae46319-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d159f38-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae4a1db-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d15b4e2-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si nécessaire, précisez.', 'eae4a1db-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d15ec94-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eae4daaa-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d1602d6-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae4daaa-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1650f4-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Réemploi en interne', 'eae51626-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d16683e-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Réemploi en externe', 'eae51626-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d16bb01-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eae552de-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d16dd22-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae552de-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1755e5-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae58bfd-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d177152-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez les paramétrages implémentés.', 'eae58bfd-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d17cbcc-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae5ca98-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d17e486-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez et fournissez la documentation le cas échéant.', 'eae5ca98-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d183f96-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae6072c-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d18578b-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eae6072c-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d18b903-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae642ee-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d18d51e-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eae642ee-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d192995-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae67ca7-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1940a7-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eae67ca7-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1993f0-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae6b4b3-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d19aa20-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eae6b4b3-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d19e910-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eae6f0c0-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d19fe62-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae6f0c0-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1a4a0c-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eae72d87-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d1a60ca-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae72d87-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1abd7a-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui, les DEEE sont traités en interne', 'eae791b1-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d1ad80e-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui, les DEEE sont traités par une structure tierce (prestataire privé, association...)', 'eae791b1-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d1b6b8b-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Réponse', 'eae7cc9e-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1bae19-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Connexion Wifi', 'eae80242-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d1bc721-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Connexion filaire', 'eae80242-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d1c1d6f-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eae84289-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d1c35db-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae84289-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1ca6c8-06bd-11ee-b776-0cc47a39c2c0', 'button', 'En interne et/ou prestataire(s)', 'eae87dc3-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1cba07-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Précisez votre politique de sauvegarde et fournissez la documentation le cas échéant (contrats, CGV, politique RSE ou autres formes d\'engagement environnemental, notamment PUE (Power Usage Effectiveness) et autres indicateurs de performance des datas centers si connus)).', 'eae87dc3-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1d04f0-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae8bb58-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1d3f2f-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eae8bb58-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1dba19-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae8f743-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1dcffe-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez et fournissez la documentation le cas échéant.', 'eae8f743-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1e3b2b-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez', 'eae938d8-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1e9d1b-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Réponse', 'eae9732c-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1eea74-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae9ad81-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1f00fe-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eae9ad81-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1f6773-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Réponse', 'eae9e800-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1fb128-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Via mail', 'eaea20ae-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d1fc815-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Précisez', 'eaea20ae-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d201f93-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaea5d42-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2035eb-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaea5d42-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d20705a-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eaea942d-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d2086cf-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaea942d-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d20d4d0-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eaead655-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d20ecf0-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaead655-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d213da0-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eaeb0f2f-06bc-11ee-b776-0cc47a39c2c0', 1),
('0d21529c-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaeb0f2f-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d219db3-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eaeb4f85-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d21b662-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaeb4f85-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d220602-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eaeb8dc2-06bc-11ee-b776-0cc47a39c2c0', 3),
('0d221b88-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaeb8dc2-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d22698c-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eaebdb76-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d22805d-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaebdb76-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d22ccc7-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eaec1930-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d22e28b-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaec1930-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2346f4-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaec7d75-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d235cea-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaec7d75-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d239682-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui', 'eaecba23-06bc-11ee-b776-0cc47a39c2c0', 2),
('0d23adad-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaecba23-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d240ee7-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaecfa36-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d242427-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaecfa36-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2472a3-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaed3454-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d248712-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez et fournissez la documentation le cas échéant.', 'eaed3454-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d24cf74-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaed725d-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d253451-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaedab44-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d254753-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez et fournissez la documentation le cas échéant.', 'eaedab44-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d259440-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaede4b2-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d25aa81-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez (types de marché disposant de clauses-types, nature des clauses, poids dans la notation...) et fournissez la documentation le cas échéant.', 'eaede4b2-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d25f156-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaee2338-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d26077c-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaee2338-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d26576c-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaee6416-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d266cfe-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaee6416-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d26bdc5-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non, mais c\'est en projet ', 'eaee9d7f-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d26d2f0-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Précisez', 'eaee9d7f-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2725c3-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaeed982-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d273ba9-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaeed982-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2786ce-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaef0f77-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d279bfb-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaef0f77-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d27ebac-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaef4a05-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d28034c-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaef4a05-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d285121-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaef89eb-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2867ff-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaef89eb-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d28b4e7-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaefc832-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d28cbfc-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaefc832-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2922ed-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaf00a4e-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d293c3a-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaf00a4e-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d29904b-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaf0418a-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d29a69a-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaf0418a-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d29fc1a-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Oui, seulement à l\'externe, pour notre public', 'eaf0788d-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2a13d8-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Précisez', 'eaf0788d-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2a63da-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non, mais c\'est en projet ', 'eaf0bf23-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2a774e-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Précisez', 'eaf0bf23-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2c33fe-06bd-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaf1cc7a-06bc-11ee-b776-0cc47a39c2c0', 0),
('0d2c4a47-06bd-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez.', 'eaf1cc7a-06bc-11ee-b776-0cc47a39c2c0', 0),
('36df8b00-06c8-11ee-b776-0cc47a39c2c0', 'button', 'Non, nous n\'avons pas connaissance de ce sujet', 'eaee9d7f-06bc-11ee-b776-0cc47a39c2c0', 0),
('36e45077-06c8-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eaee9d7f-06bc-11ee-b776-0cc47a39c2c0', 0),
('36e51fa9-06c8-11ee-b776-0cc47a39c2c0', 'button', 'Non et nous ne souhaitons pas engager cette démarche', 'eaee9d7f-06bc-11ee-b776-0cc47a39c2c0', 0),
('37015445-d159-11ee-a424-0242ac110009', 'button', 'Recyclage', 'eae51626-06bc-11ee-b776-0cc47a39c2c0', 0),
('5f99e1f3-06c5-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eae791b1-06bc-11ee-b776-0cc47a39c2c0', 0),
('5f9d3105-06c5-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eae791b1-06bc-11ee-b776-0cc47a39c2c0', 0),
('7614306c-06ce-11ee-b776-0cc47a39c2c0', 'button', 'Non', 'eaf0fe3d-06bc-11ee-b776-0cc47a39c2c0', 0),
('76143449-06ce-11ee-b776-0cc47a39c2c0', 'input', 'Si oui, précisez', 'eaf0fe3d-06bc-11ee-b776-0cc47a39c2c0', 0),
('9698e525-06c8-11ee-b776-0cc47a39c2c0', 'button', 'Oui, seulement en interne, pour notre personnel', 'eaf0788d-06bc-11ee-b776-0cc47a39c2c0', 0),
('969bf392-06c8-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eaf0788d-06bc-11ee-b776-0cc47a39c2c0', 0),
('969cb496-06c8-11ee-b776-0cc47a39c2c0', 'button', 'Non et nous ne souhaitons pas engager cette démarche', 'eaf0788d-06bc-11ee-b776-0cc47a39c2c0', 0),
('969d2e24-06c8-11ee-b776-0cc47a39c2c0', 'button', 'Non, mais c\'est en projet', 'eaf0788d-06bc-11ee-b776-0cc47a39c2c0', 0),
('98ff6a77-06c7-11ee-b776-0cc47a39c2c0', 'button', 'La structure n\'est pas concernée', 'eaec1930-06bc-11ee-b776-0cc47a39c2c0', 2),
('990116a4-06c7-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eaec1930-06bc-11ee-b776-0cc47a39c2c0', 0),
('9c56ac2f-06c4-11ee-b776-0cc47a39c2c0', 'button', 'Mise au rebut', 'eae51626-06bc-11ee-b776-0cc47a39c2c0', 0),
('9c5a6757-06c4-11ee-b776-0cc47a39c2c0', 'button', 'Pas de gestion', 'eae51626-06bc-11ee-b776-0cc47a39c2c0', 0),
('9c5b15e9-06c4-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eae51626-06bc-11ee-b776-0cc47a39c2c0', 0),
('b4eb72a5-06c7-11ee-b776-0cc47a39c2c0', 'button', 'La structure n\'est pas concernée', 'eaecba23-06bc-11ee-b776-0cc47a39c2c0', 2),
('b4ed52b0-06c7-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eaecba23-06bc-11ee-b776-0cc47a39c2c0', 0),
('be48c3ee-06c8-11ee-b776-0cc47a39c2c0', 'button', 'Non, nous n\'avons pas connaissance de ce sujet', 'eaf0788d-06bc-11ee-b776-0cc47a39c2c0', 0),
('cf2da61c-06c5-11ee-b776-0cc47a39c2c0', 'button', 'Réseau 2G/3G/4G', 'eae80242-06bc-11ee-b776-0cc47a39c2c0', 0),
('cf2f11b9-06c5-11ee-b776-0cc47a39c2c0', 'button', 'Je ne sais pas', 'eae80242-06bc-11ee-b776-0cc47a39c2c0', 0),
('f57fb8bb-4af9-11ee-b615-0cc47a39c2c2', 'input', 'Nombre d\'imprimantes/copieurs de votre structure', 'fd893fe8-4af6-11ee-b615-0cc47a39c2c2', 0),
('f5809570-4af9-11ee-b615-0cc47a39c2c2', 'input', 'Modalités de répartition (un appareil par utilisateur/service, étage...)', 'fd893fe8-4af6-11ee-b615-0cc47a39c2c2', 0);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_level2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int DEFAULT NULL,
  `level_two` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `description`, `description_level2`, `sort_order`, `level_two`) VALUES
('38e51811-4329-11ed-af88-040300000000', 'Sensibilisation et formation', 'Formation.svg', 'La sensibilisation et la formation sont le socle indispensable de l\'adhésion de tous à une démarche d\'amélioration continue. Les réponses apportées aux questions suivantes permettront de déterminer votre niveau de maturité en la matière. ', 'La sensibilisation et la formation sont le socle indispensable de l\'adhésion de tous à une démarche d\'amélioration continue. Les réponses apportées aux questions suivantes permettront de déterminer votre niveau de maturité en la matière. Afin d\'y répondre, pensez à réunir, s\'ils existent, les documents relatifs aux sensibilisations et formations réalisées en matière de sobriété numérique (descriptifs voire supports de présentation/communication, liste des participants, attestations ou plan de formation...). ', 2, 0),
('54aa9a19-432e-11ed-af88-040300000000', 'Usages', 'Usages.svg', 'Il est important d\'impliquer l\'ensemble des utilisateurs dans la démarche. Cela passe par le questionnement de leurs usages au quotidien. ', 'Il est important d\'impliquer l\'ensemble des utilisateurs dans la démarche. Cela passe par le questionnement de leurs usages au quotidien. Munissez-vous, si vous en disposez, de la charte informatique et autres documents encadrant les pratiques numériques pour répondre aux questions suivantes.', 6, 0),
('708d624a-432f-11ed-af88-040300000000', 'Écoconception et sobriété éditoriale', 'EcoConception.svg', 'L\'écoconception et la sobriété éditoriale visent la production de services numériques, contenus et supports de communication plus sobres. Il s\'agit de prendre en compte et de minimiser autant que possible leur impact environnemental dès la phase de conception et tout au long de leur cycle de vie.', 'L\'écoconception et la sobriété éditoriale visent la production de services numériques, contenus et supports de communication plus sobres. Il s\'agit de prendre en compte et de minimiser autant que possible leur impact environnemental dès la phase de conception et tout au long de leur cycle de vie. Pour répondre aux questions suivantes, vous pourriez avoir besoin, s\'ils existent, des documents d\'achats/techniques de vos logiciels, applications et services de communication en ligne (site internet, extranet, intranet, progiciel web ou mobile et mobilier urbain numérique). Il vous faudra également ceux centralisant les règles éditoriales et graphiques de votre structure (charte graphique par exemple). ', 7, 0),
('8444bdb4-432a-11ed-af88-040300000000', 'Gestion du parc informatique', 'ParcNumerique2.svg', 'La connaissance de votre parc numérique est le préalable nécessaire à la mise en oeuvre des actions le concernant. Cela permettra en effet de cibler plus efficacement les axes d\'amélioration pour une gestion optimale. \r\nEn parallèle, l\'allongement de la durée de vie des équipements numériques est essentiel à une démarche vers un numérique plus sobre. De ce fait, il est important de connaître les pratiques de votre structure qui y contribuent ou, au contraire, y font obstacle. \r\nDe même, l\'impact environnemental et dans une moindre mesure la consommation d\'énergie du numérique sont des facettes importantes de la démarche. La mise en place de bonnes pratiques couplée au suivi de certains indicateurs permet de les maîtriser. \r\nEnfin, la bonne gestion des DEEE est indispensable à plus d\'un titre. Tant en raison des risques de pollution et pour la santé liés à leur fin de vie, que pour les ressources réutilisables et recyclables qu\'ils contiennent. Il convient aussi de tenir compte du papier d\'impression pour avoir une vision complète des déchets liés au numérique.', 'La connaissance de votre parc numérique est le préalable nécessaire à la mise en œuvre des actions le concernant. Cela permettra en effet de cibler plus efficacement les axes d\'amélioration pour une gestion optimale. Afin de répondre aux questions suivantes, vous aurez besoin, si vous en disposez, des documents relatifs à votre parc numérique (inventaire, cartographie, bons de remise, fiches techniques...). \nEn parallèle, l\'allongement de la durée de vie des équipements numériques est essentiel à une démarche vers un numérique plus sobre. De ce fait, il est important de connaître les pratiques de votre structure qui y contribuent ou, au contraire, y font obstacle. Afin de répondre aux questions ci-après, préparez les éventuels consignes et documents diffusés à ce sujet, ainsi que vos contrats de maintenance informatique ou procédures internes, mais aussi conventions de partenariat avec des tiers du réemploi et de la réutilisation. \nDe même, l\'impact environnemental et dans une moindre mesure la consommation d\'énergie du numérique sont des facettes importantes de la démarche. La mise en place de bonnes pratiques couplée au suivi de certains indicateurs permet de les maîtriser. Afin de répondre aux questions suivantes, réunissez les données chiffrées en votre possession sur l\'impact environnemental et la consommation d\'énergie de votre parc numérique et les paramétrages y afférent, voire les références des outils ainsi que les procédures mises en place en la matière. \nEnfin, la bonne gestion des DEEE est indispensable à plus d\'un titre. Tant en raison des risques de pollution et pour la santé liés à leur fin de vie, que pour les ressources réutilisables et recyclables qu\'ils contiennent. Il convient aussi de tenir compte du papier d\'impression pour avoir une vision complète des déchets liés au numérique. Veuillez-vous munir, si vous en disposez, de vos contrats de prestation ou conventions avec vos partenaires en charge de la prise en charge des DEEE et du papier et autres documents liés au suivi de ces déchets.', 4, 0),
('b5aa2df1-4328-11ed-af88-040300000000', 'Gouvernance', 'Gouvernance.svg', 'La mise en place d\'une gouvernance est un facteur déterminant du bon déroulé de toute démarche d\'amélioration continue. Ainsi, les questions suivantes interrogent l\'organisation mise en place à l\'échelle de votre structure pour la mener à bien.', 'La mise en place d\'une gouvernance est un facteur déterminant du bon déroulé de toute démarche d\'amélioration continue. Ainsi, les questions suivantes interrogent l\'organisation mise en place à l\'échelle de votre structure pour la mener à bien. Pour y répondre, vous pourriez avoir besoin de différents documents que nous invitons à préparer en amont, s\'ils existent (organigramme, fiches de postes, plan d\'actions, engagements écrits, budgets... en lien avec la sobriété numérique).', 1, 0),
('d573027d-432d-11ed-af88-040300000000', 'Réseaux et données', 'Reseaux.svg', 'Face à l\'augmentation exponentielle des données numériques traitées, les réseaux et centres de données sont de plus en plus sollicités et s\'adaptent en conséquence. Les questions ci-après ont vocation à déterminer la gestion des données de votre structure, et notamment leur stockage, leur sauvegarde, leur transfert. ', 'Face à l\'augmentation exponentielle des données numériques traitées, les réseaux et centres de données sont de plus en plus sollicités et s\'adaptent en conséquence. Les questions ci-après ont vocation à déterminer la gestion des données de votre structure, et notamment leur stockage, leur sauvegarde, leur transfert. Pour y répondre, vous pourriez avoir besoin, s\'ils existent, des contrats et autres documents relatifs à la sauvegarde de vos données (des postes de travail, serveurs, datas centers, mais aussi des logiciels hébergés le cas échéant), mais aussi logiciels de partage/travail collaboratif. En complément, pensez à votre registre des traitements ou autre document de suivi des durées d\'utilité administrative (DUA) et de l\'archivage.', 5, 0),
('e4a990cd-4329-11ed-af88-040300000000', 'Achats et locations', 'Achat.svg', 'Les achats publics sont sans équivoque l\'un des principaux leviers de la maîtrise de l\'empreinte environnementale du numérique.  À ce titre, vos pratiques d\'achats et locations en la matière doivent être analysées (équipements numériques, impressions et papier, énergie).', 'Les achats publics sont sans équivoque l\'un des principaux leviers de la maîtrise de l\'empreinte environnementale du numérique. À ce titre, vos pratiques d\'achats et locations en la matière doivent être analysées (équipements numériques, impressions et papier, énergie). Pour ce faire, munissez-vous de vos contrats, cahiers des charges, appels d\'offres et autres documents y afférent en votre possession (politiques d\'achat, clausiers/clauses-types...).', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `collectivite`
--

DROP TABLE IF EXISTS `collectivite`;
CREATE TABLE IF NOT EXISTS `collectivite` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `population` int NOT NULL,
  `departement_id` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siret` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `opsn_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `level_two` tinyint(1) NOT NULL DEFAULT '0',
  `postal_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_answered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `last_answered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `link_demand_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`),
  KEY `IDX_CFA408A1CCF9E01E` (`departement_id`),
  KEY `IDX_CFA408A1C54C8C93` (`type_id`),
  KEY `IDX_CFA408A1173BE8BE` (`opsn_id`),
  KEY `IDX_CFA408A1BF77FE2D` (`link_demand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `collectivite`
--

INSERT INTO `collectivite` (`id`, `name`, `population`, `departement_id`, `siret`, `latitude`, `longitude`, `type_id`, `opsn_id`, `level_two`, `postal_code`, `first_answered_at`, `last_answered_at`, `link_demand_id`) VALUES
('403', 'opsnAdmin1', 0, NULL, NULL, NULL, NULL, '73097104-8c33-11ed-97b8-0242ac110004', '403', 0, NULL, NULL, NULL, NULL),
('404', 'opsnAdmin2', 0, NULL, NULL, NULL, NULL, '73097104-8c33-11ed-97b8-0242ac110004', '404', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `collectivite_answer`
--

DROP TABLE IF EXISTS `collectivite_answer`;
CREATE TABLE IF NOT EXISTS `collectivite_answer` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `answer_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `collectivite_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `answered_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`),
  KEY `IDX_85E83017AA334807` (`answer_id`),
  KEY `IDX_85E83017A7991F51` (`collectivite_id`),
  KEY `IDX_85E83017A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `collectivite_status`
--

DROP TABLE IF EXISTS `collectivite_status`;
CREATE TABLE IF NOT EXISTS `collectivite_status` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `recommandation_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `collectivite_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_24351F2E61AAE789` (`recommandation_id`) USING BTREE,
  KEY `IDX_24351F2EA7991F51` (`collectivite_id`),
  KEY `IDX_24351F2E6BF700BD` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `collectivite_type`
--

DROP TABLE IF EXISTS `collectivite_type`;
CREATE TABLE IF NOT EXISTS `collectivite_type` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `label` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `collectivite_type`
--

INSERT INTO `collectivite_type` (`id`, `label`) VALUES
('3e85465a-ffff-11eb-acf0-0cc47a0ad120', 'CA'),
('57482110-fe97-11eb-acf0-0cc47a0ad120', 'MAIRIE'),
('5748268d-fe97-11eb-acf0-0cc47a0ad120', 'COMCOM'),
('73097104-8c33-11ed-97b8-0242ac110004', 'AUTRE'),
('7ab89f99-8c33-11ed-97b8-0242ac110004', 'EPCI');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `code` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_code` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`code`),
  KEY `IDX_C1765B63AEB327AF` (`region_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`code`, `name`, `region_code`) VALUES
('01', 'Ain', '84'),
('02', 'Aisne', '32'),
('03', 'Allier', '84'),
('04', 'Alpes-de-Haute-Provence', '93'),
('05', 'Hautes-Alpes', '93'),
('06', 'Alpes-Maritimes', '93'),
('07', 'Ardèche', '84'),
('08', 'Ardennes', '44'),
('09', 'Ariège', '76'),
('10', 'Aube', '44'),
('11', 'Aude', '76'),
('12', 'Aveyron', '76'),
('13', 'Bouches-du-Rhône', '93'),
('14', 'Calvados', '28'),
('15', 'Cantal', '84'),
('16', 'Charente', '75'),
('17', 'Charente-Maritime', '75'),
('18', 'Cher', '24'),
('19', 'Corrèze', '75'),
('21', 'Côte-d\'Or', '27'),
('22', 'Côtes-d\'Armor', '53'),
('23', 'Creuse', '75'),
('24', 'Dordogne', '75'),
('25', 'Doubs', '27'),
('26', 'Drôme', '84'),
('27', 'Eure', '28'),
('28', 'Eure-et-Loir', '24'),
('29', 'Finistère', '53'),
('2A', 'Corse-du-Sud', '94'),
('2B', 'Haute-Corse', '94'),
('30', 'Gard', '76'),
('31', 'Haute-Garonne', '76'),
('32', 'Gers', '76'),
('33', 'Gironde', '75'),
('34', 'Hérault', '76'),
('35', 'Ille-et-Vilaine', '53'),
('36', 'Indre', '24'),
('37', 'Indre-et-Loire', '24'),
('38', 'Isère', '84'),
('39', 'Jura', '27'),
('40', 'Landes', '75'),
('41', 'Loir-et-Cher', '24'),
('42', 'Loire', '84'),
('43', 'Haute-Loire', '84'),
('44', 'Loire-Atlantique', '52'),
('45', 'Loiret', '24'),
('46', 'Lot', '76'),
('47', 'Lot-et-Garonne', '75'),
('48', 'Lozère', '76'),
('49', 'Maine-et-Loire', '52'),
('50', 'Manche', '28'),
('51', 'Marne', '44'),
('52', 'Haute-Marne', '44'),
('53', 'Mayenne', '52'),
('54', 'Meurthe-et-Moselle', '44'),
('55', 'Meuse', '44'),
('56', 'Morbihan', '53'),
('57', 'Moselle', '44'),
('58', 'Nièvre', '27'),
('59', 'Nord', '32'),
('60', 'Oise', '32'),
('61', 'Orne', '28'),
('62', 'Pas-de-Calais', '32'),
('63', 'Puy-de-Dôme', '84'),
('64', 'Pyrénées-Atlantiques', '75'),
('65', 'Hautes-Pyrénées', '76'),
('66', 'Pyrénées-Orientales', '76'),
('67', 'Bas-Rhin', '44'),
('68', 'Haut-Rhin', '44'),
('69', 'Rhône', '84'),
('70', 'Haute-Saône', '27'),
('71', 'Saône-et-Loire', '27'),
('72', 'Sarthe', '52'),
('73', 'Savoie', '84'),
('74', 'Haute-Savoie', '84'),
('75', 'Paris', '11'),
('76', 'Seine-Maritime', '28'),
('77', 'Seine-et-Marne', '11'),
('78', 'Yvelines', '11'),
('79', 'Deux-Sèvres', '75'),
('80', 'Somme', '32'),
('81', 'Tarn', '76'),
('82', 'Tarn-et-Garonne', '76'),
('83', 'Var', '93'),
('84', 'Vaucluse', '93'),
('85', 'Vendée', '52'),
('86', 'Vienne', '75'),
('87', 'Haute-Vienne', '75'),
('88', 'Vosges', '44'),
('89', 'Yonne', '27'),
('90', 'Territoire de Belfort', '27'),
('91', 'Essonne', '11'),
('92', 'Hauts-de-Seine', '11'),
('93', 'Seine-Saint-Denis', '11'),
('94', 'Val-de-Marne', '11'),
('95', 'Val-d\'Oise', '11'),
('971', 'Guadeloupe', '1'),
('972', 'Martinique', '2'),
('973', 'Guyane', '3'),
('974', 'La Réunion', '4'),
('976', 'Mayotte', '6');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230509120223', '2023-05-10 15:40:52', 1233),
('DoctrineMigrations\\Version20230509124504', '2023-05-10 15:40:53', 69),
('DoctrineMigrations\\Version20230510103745', '2023-10-02 19:58:07', 1700),
('DoctrineMigrations\\Version20230510152551', '2023-10-02 19:58:09', 1151),
('DoctrineMigrations\\Version20230510153651', '2023-10-02 19:58:10', 42),
('DoctrineMigrations\\Version20230510154901', '2023-10-02 19:58:10', 180),
('DoctrineMigrations\\Version20230510155717', '2023-10-02 19:58:10', 734),
('DoctrineMigrations\\Version20230515080056', '2023-10-02 19:58:11', 339),
('DoctrineMigrations\\Version20230515122348', '2023-10-02 19:58:11', 6848),
('DoctrineMigrations\\Version20230515140604', '2023-10-02 19:58:18', 5358),
('DoctrineMigrations\\Version20230515210304', '2023-10-02 19:58:24', 2017),
('DoctrineMigrations\\Version20230515210707', '2023-10-02 19:58:26', 138),
('DoctrineMigrations\\Version20230515211201', '2023-10-02 19:58:26', 116),
('DoctrineMigrations\\Version20230517094230', '2023-10-02 19:58:26', 560),
('DoctrineMigrations\\Version20230525081523', '2023-10-02 19:58:27', 0),
('DoctrineMigrations\\Version20230525090230', '2023-10-02 19:58:27', 1574),
('DoctrineMigrations\\Version20230525095022', '2023-10-02 19:58:28', 1754),
('DoctrineMigrations\\Version20230525113130', '2023-10-02 19:58:30', 1875),
('DoctrineMigrations\\Version20230525122711', '2023-10-02 19:58:32', 854),
('DoctrineMigrations\\Version20230525124037', '2023-10-02 19:58:33', 3645),
('DoctrineMigrations\\Version20230525132913', '2023-10-02 19:58:36', 610),
('DoctrineMigrations\\Version20230530092248', '2023-10-02 19:58:37', 712),
('DoctrineMigrations\\Version20230531112328', '2023-10-02 19:58:38', 523),
('DoctrineMigrations\\Version20230609144411', '2023-10-02 19:58:38', 212),
('DoctrineMigrations\\Version20230613131229', '2023-10-02 19:58:39', 77),
('DoctrineMigrations\\Version20230626145421', '2023-10-02 19:58:39', 469),
('DoctrineMigrations\\Version20230630120704', '2023-10-02 19:58:39', 58),
('DoctrineMigrations\\Version20230630122719', '2023-10-02 19:58:39', 492),
('DoctrineMigrations\\Version20230811114416', '2023-10-02 19:58:40', 45),
('DoctrineMigrations\\Version20230811115210', '2023-10-02 19:58:40', 234),
('DoctrineMigrations\\Version20230921075141', '2023-10-02 19:58:40', 58),
('DoctrineMigrations\\Version20230926215720', '2023-10-02 19:58:40', 108),
('DoctrineMigrations\\Version20230929084227', '2023-10-02 19:58:40', 283),
('DoctrineMigrations\\Version20231001205241', '2023-10-02 19:58:41', 220),
('DoctrineMigrations\\Version20231001211302', '2023-10-02 19:58:41', 631),
('DoctrineMigrations\\Version20231002133006', '2023-10-02 19:58:41', 400),
('DoctrineMigrations\\Version20231002153040', '2023-10-02 19:58:42', 2013),
('DoctrineMigrations\\Version20231002163818', '2023-10-02 19:58:44', 954),
('DoctrineMigrations\\Version20231002190046', '2023-10-02 19:58:45', 1822),
('DoctrineMigrations\\Version20231002194803', '2023-10-02 19:58:47', 1301),
('DoctrineMigrations\\Version20231002203327', '2023-10-02 20:34:45', 29),
('DoctrineMigrations\\Version20231117135821', '2023-11-17 14:59:26', 86),
('DoctrineMigrations\\Version20231120091631', '2023-11-20 10:16:35', 10),
('DoctrineMigrations\\Version20231120131242', '2023-11-20 14:12:51', 42),
('DoctrineMigrations\\Version20240604131832', '2024-06-04 15:18:54', 13),
('DoctrineMigrations\\Version20250225091425', '2025-02-25 10:16:10', 159),
('DoctrineMigrations\\Version20250616115727', '2025-06-17 11:09:28', 117),
('DoctrineMigrations\\Version20250616120231', '2025-06-17 11:09:28', 68);

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `collectivite_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `category_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `posted_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_BF5476CAA7991F51` (`collectivite_id`),
  KEY `IDX_BF5476CA12469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `opsn`
--

DROP TABLE IF EXISTS `opsn`;
CREATE TABLE IF NOT EXISTS `opsn` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `logo` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siret` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `opsn`
--

INSERT INTO `opsn` (`id`, `name`, `email`, `departement`, `active`, `logo`, `phone_number`, `postal_address`, `website`, `siret`, `latitude`, `longitude`) VALUES
('403', 'opsnAdmin1', NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('404', 'opsnAdmin2', NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `opsn_departement`
--

DROP TABLE IF EXISTS `opsn_departement`;
CREATE TABLE IF NOT EXISTS `opsn_departement` (
  `opsn_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `departement_code` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`opsn_id`,`departement_code`),
  KEY `IDX_DB4914C6173BE8BE` (`opsn_id`),
  KEY `IDX_DB4914C66A333750` (`departement_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `opsn_departement`
--

INSERT INTO `opsn_departement` (`opsn_id`, `departement_code`) VALUES
('403', '32'),
('404', '32');

-- --------------------------------------------------------

--
-- Structure de la table `patch_note`
--

DROP TABLE IF EXISTS `patch_note`;
CREATE TABLE IF NOT EXISTS `patch_note` (
  `title` varchar(500) NOT NULL,
  `body` longtext NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `posted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `population`
--

DROP TABLE IF EXISTS `population`;
CREATE TABLE IF NOT EXISTS `population` (
  `id` int NOT NULL AUTO_INCREMENT,
  `collectivite_type_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `min` int NOT NULL,
  `max` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B449A008DC4E869` (`collectivite_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `population`
--

INSERT INTO `population` (`id`, `collectivite_type_id`, `min`, `max`) VALUES
(9, '57482110-fe97-11eb-acf0-0cc47a0ad120', 0, 499),
(10, '57482110-fe97-11eb-acf0-0cc47a0ad120', 500, 999),
(11, '57482110-fe97-11eb-acf0-0cc47a0ad120', 1000, 3499),
(12, '57482110-fe97-11eb-acf0-0cc47a0ad120', 3500, 4999),
(13, '57482110-fe97-11eb-acf0-0cc47a0ad120', 5000, 9999),
(14, '57482110-fe97-11eb-acf0-0cc47a0ad120', 10000, 19999),
(15, '57482110-fe97-11eb-acf0-0cc47a0ad120', 20000, 49999),
(16, '57482110-fe97-11eb-acf0-0cc47a0ad120', 50000, 99999),
(17, '57482110-fe97-11eb-acf0-0cc47a0ad120', 100000, 1000000000);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `question` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `category_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `multiple` tinyint(1) NOT NULL DEFAULT '0',
  `definition` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `additional_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `definition_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL,
  `parent_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `parent_answer_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `level_two` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E12469DE2` (`category_id`),
  KEY `IDX_B6F7494E727ACA70` (`parent_id`),
  KEY `IDX_B6F7494E5B7867E9` (`parent_answer_id`),
  KEY `IDX_B6F7494E59027487` (`theme_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `question`, `theme_id`, `category_id`, `multiple`, `definition`, `additional_information`, `definition_title`, `sort_order`, `parent_id`, `parent_answer_id`, `level_two`) VALUES
('6c5a609b-4af4-11ee-b615-0cc47a39c2c2', 'À votre connaissance, votre structure a-t-elle pris en compte la sobriété numérique et la transition environnementale dans ses actions et projets en lien avec le numérique ? ', '0', 'b5aa2df1-4328-11ed-af88-040300000000', 0, 'Sobriété numérique : Démarche d\'amélioration continue visant à maîtriser l\'empreinte environnementale du numérique par l\'adoption d\'un usage et de pratiques raisonnées en la matière. \n\nTransition environnementale : La transition environnementale est une évolution vers un nouveau modèle économique et social, un modèle de développement durable qui renouvelle nos façons de consommer, de produire, de travailler, de vivre ensemble pour répondre aux grands enjeux environnementaux, ceux du changement climatique, de la rareté des ressources, de la perte accélérée de la biodiversité et de la multiplication des risques sanitaires environnementaux.', '', NULL, 1, NULL, NULL, 0),
('a950ed4d-4aff-11ee-b615-0cc47a39c2c2', 'Les élus de votre structure ont-ils été formés aux enjeux et bonnes pratiques en matière de sobriété numérique ?', '0', '38e51811-4329-11ed-af88-040300000000', 0, '', '', NULL, 4, NULL, NULL, 0),
('ead873c4-06bc-11ee-b776-0cc47a39c2c0', 'Votre structure a-t-elle mis en place une gouvernance pour la sobriété numérique (désignation d\'un référent, prise d\'engagements, définition d\'objectifs, mise en place d\'actions...)?', '0', 'b5aa2df1-4328-11ed-af88-040300000000', 0, '', '', NULL, 2, '6c5a609b-4af4-11ee-b615-0cc47a39c2c2', '01a8eb61-4af5-11ee-b615-0cc47a39c2c2', 0),
('eada5694-06bc-11ee-b776-0cc47a39c2c0', 'Des actions de sensibilisation sont-elles menées auprès du personnel sur les enjeux et bonnes pratiques en matière de sobriété numérique? ', '0', '38e51811-4329-11ed-af88-040300000000', 0, '', ' La sensibilisation peut être assurée par le relai d\'informations (celles produites par l\'ADEME ou encore l\'INR), l\'organisation d\'évènements thématiques (par exemple la Fresque du numérique ou du climat ou le World Clean Up Day). Elle vise à alerter et apporter un premier niveau de connaissances sur le sujet. \nUne bonne compréhension des enjeux et bonnes pratiques de la sobriété numérique est un préalable indispensable à la mise en oeuvre du plan d\'action défini. Elle est le gage d\'une meilleure adhésion à la démarche de chacune des parties prenantes. \nLa diversification des supports de sensibilisation assure une diffusion optimale des enjeux et bonnes pratiques de la sobriété numérique auprès de différents utilisateurs. ', NULL, 1, NULL, NULL, 0),
('eada8fd0-06bc-11ee-b776-0cc47a39c2c0', 'Le personnel de votre structure a-t-il été formé aux enjeux et bonnes pratiques en matière de sobriété numérique? ', '0', '38e51811-4329-11ed-af88-040300000000', 0, '', ' La formation vient en complément de la sensibilisation afin d\'apporter les compétences nécessaires à la bonne mise en oeuvre du plan d\'actions (par exemple formation aux achats responsables pour les acheteurs publics, aux enjeux et bonnes pratiques de la sobriété numérique pour le référent ou encore à l\'écoconception pour le service informatique). \nLa formation des responsables et/ou agents et autres personnes les plus concernés est l\'assurance que les enjeux et bonnes pratiques de la sobriété numérique soient bien systématiquement pris en compte et intégrés aux divers projets qu\'ils mènent à bien. Cela contribue par ailleurs à la sensibilisation des équipes dans lesquelles ils évoluent ou avec lesquelles ils collaborent, et donc à l\'acculturation de l\'ensemble de la structure. ', NULL, 2, NULL, NULL, 0),
('eadacc92-06bc-11ee-b776-0cc47a39c2c0', 'Des actions de sensibilisation sont-elles menées auprès des élus sur les enjeux et bonnes pratiques en matière de sobriété numérique? ', '0', '38e51811-4329-11ed-af88-040300000000', 0, '', '', NULL, 3, NULL, NULL, 0),
('eadb0117-06bc-11ee-b776-0cc47a39c2c0', 'Votre structure a-t-elle recours à la location de matériels numériques? ', '0', 'e4a990cd-4329-11ed-af88-040300000000', 0, '', ' Selon le Guide des achats numériques responsables de la Direction des Achats de l\'État (DAE) : La location est une alternative à l\'achat des équipements numériques. Cette pratique permet à l\'organisation d\'ajuster son parc au besoin de chaque utilisateur et de faire face à des urgences ou à des besoins ponctuels. Cette approche est un des axes forts de l\'économie circulaire : «l\'économie de la fonctionnalité» c\'est à dire acheter l\'usage plutôt que le bien.\r\nPour autant, son impact bénéfique reste conditionné au fait que le matériel loué soit réintroduit dans un cycle de vie prolongé par l\'opérateur.', NULL, 1, NULL, NULL, 0),
('eadb3a87-06bc-11ee-b776-0cc47a39c2c0', 'Votre structure a-t-elle pris des mesures permettant de favoriser la sobriété numérique dans les achats et locations d\'équipements et services numériques telles que l\'ajout de clauses contractuelles, une prise en compte des écolabels, des indices de réparabilité, d\'éco-conception, d\'achat ou de location d\'équipements issus du réemploi ou de la réutilisation ?', '0', 'e4a990cd-4329-11ed-af88-040300000000', 0, 'Écolabel : Le terme « écolabel » est réservé aux labels environnementaux qui répondent à la norme ISO 14024, c\'est-à-dire respectant des exigences très précises prenant en compte les impacts environnementaux des produits tout au long de leur cycle de vie.\r\nLes produits sont certifiés par un organisme indépendant, garantissant la conformité du produit aux critères d\'un référentiel, préalablement élaboré en commun par des professionnels, des associations de consommateurs et de protection de l\'environnement et les pouvoirs publics. \r\n\r\nIndice de réparabilité : L\'indice de réparabilité est une information transmise à l\'acheteur d\'un équipement électroménagers et électroniques sur la capacité à réparer le produit acheté. Les critères et les modalités de calcul de l\'indice de réparabilité incluent notamment la démontabilité du produit, la disponibilité des conseils d\'utilisation et d\'entretien, encore la disponibilité et le prix des pièces détachées nécessaires au bon fonctionnement du produit. Prévu par la loi anti-gaspillage et l\'article L. 541-9-2 du code de l\'environnement, l\'indice de réparabilité est obligatoire depuis le 1er janvier 2021. Il concerne 5 catégories d\'équipements électroménagers et électroniques, notamment les ordinateurs et les smartphones.\r\n\r\nÉcoconception : L\'éco-conception est un standard pour réduire les impacts environnementaux d\'un produit ou d\'un service défini par la norme ISO 14062 qui intègre des contraintes environnementales dans la conception de produits et services selon une approche globale et multicritères. \r\n\r\nRéemploi : Toute opération par laquelle des substances, matières ou produits qui ne sont pas des déchets sont utilisés de nouveau pour un usage identique à celui pour lequel ils avaient été conçus. \r\n\r\nRéutilisation : Toute opération par laquelle des substances, matières ou produits qui sont devenus des déchets sont utilisés de nouveau.', '', NULL, 2, NULL, NULL, 0),
('eadcd379-06bc-11ee-b776-0cc47a39c2c0', 'Votre structure a-t-elle pris des mesures permettant de favoriser la sobriété numérique dans les achats pour l\'impression telles que le choix du papier, de l\'encre et des toners ?', '0', 'e4a990cd-4329-11ed-af88-040300000000', 0, '', '', NULL, 9, NULL, NULL, 0),
('eadefc43-06bc-11ee-b776-0cc47a39c2c0', 'Faîtes-vous appel à des fournisseurs d\'énergie dite « verte »/renouvelable? ', '0', 'e4a990cd-4329-11ed-af88-040300000000', 0, 'Énergies primaires : L\'énergie primaire est celle qui sert notamment à fabriquer l\'électricité que nous consommons, appelée quant à elle « énergie finale » (nucléaire, hydraulique, solaire, gaz, pétrole, charbon...). \nÉnergies renouvelables/fossiles : Une énergie est dite renouvelable lorsqu\'elle provient de sources que la nature renouvelle en permanence, par opposition à une énergie non renouvelable dont les stocks s\'épuisent, ce qui est le cas des énergies fossiles. Si non applicable pour votre structure, mettre “non” (ex : Pas gestionnaire du contrat d’électricité).', ' Les énergies primaires dites fossiles utilisées pour la production de l\'électricité nécessaire au fonctionnement du parc numérique ont un impact environnemental supérieur aux énergies dites renouvelables. \r\nL\'achat de ce type d\'énergie consiste à l\'obtention d\'un certificat attestant qu\'une quantité d\'énergie équivalente à la consommation du client produite à partir de sources d\'énergies renouvelables a été injectée dans le réseau de distribution. Il n\'est en effet pas possible de déterminer la nature de l\'énergie effectivement consommée à la prise électrique : toutes les productions se confondent une fois qu\'elles ont rejoint le réseau de distribution. \r\nLe but est d\'aider au développement des filières renouvelables afin que la part de production qui en est issue augmente, entrainant une baisse des impacts environnementaux liés aux énergies fossiles. ', NULL, 13, NULL, NULL, 0),
('eadf40b1-06bc-11ee-b776-0cc47a39c2c0', 'Disposez-vous d\'un inventaire du parc numérique de votre structure (postes informatiques et écrans, téléphones, tablettes, supports de sauvegardes amovibles, vidéoprojecteurs...)? ', 'b11043a2-0453-11ee-b776-0cc47a39c2c0', '8444bdb4-432a-11ed-af88-040300000000', 0, '', ' Une gestion optimale du parc numérique implique d\'en connaître la composition de manière à affecter au mieux les ressources existantes tout en limitant les acquisitions au strict nécessaire, avec tous les impacts environnementaux que cela permet d\'éviter. ', NULL, 1, NULL, NULL, 0),
('eae0b739-06bc-11ee-b776-0cc47a39c2c0', 'Assurez-vous la traçabilité des attributions et besoins en outils informatiques en interne? ', 'b11043a2-0453-11ee-b776-0cc47a39c2c0', '8444bdb4-432a-11ed-af88-040300000000', 0, '', '', NULL, 7, NULL, NULL, 0),
('eae246b3-06bc-11ee-b776-0cc47a39c2c0', 'L\'utilisation des outils professionnels à des fins personnelles et/ou l\'utilisation d\'outils personnels à des fins professionnelles est-elle autorisée?', 'b11043a2-0453-11ee-b776-0cc47a39c2c0', '8444bdb4-432a-11ed-af88-040300000000', 0, 'L\'acronyme \"BYOD\" signifie \"Bring Your Own Device\" (en français : \"Apportez Votre Equipement Personnel de Communication\" ou AVEC). Cela désigne l\'usage d\'équipements informatiques dans un contexte professionnel.', ' La mutualisation des usages permet la réduction du taux d\'équipement et impacts liés à la démultiplication des outils numériques. \nConcernant par exemple les téléphones et ordinateurs portables, les impacts environnementaux liés à ces derniers sont nombreux touts au long de son cycle de vie, aussi est-il préférable de ne pas faire doublon avec un terminal professionnel et un autre personnel lorsque cela est possible. L\'ANSSI (Agence Nationale de Sécurité des Systèmes d\'Information) indique que cette pratique du BYOD est à proscrire (se référer à son guide du nomadisme de 2018). La CNIL (Commission Nationale de l\'informatique et des libertés est plus mesurée (avec les bonnes mesures de sécurité la pratique n\'est pas systématiquement à éviter).\n\nDans tous cas, s\'assurer de prendre en compte les composantes de cybersécurité avant toute action en la matière.', NULL, 14, NULL, NULL, 0),
('eae2877c-06bc-11ee-b776-0cc47a39c2c0', 'Avez-vous mis en place des consignes et pratiques de nature à allonger la durée de vie de vos équipements numériques (favoriser la réparation avant le remplacement, dissocier le remplacement des équipements selon les besoins, maintenance...)?', 'b11106a0-0453-11ee-b776-0cc47a39c2c0', '8444bdb4-432a-11ed-af88-040300000000', 0, '', 'La mise en place d\'un document centralisant ces éléments d\'information permettra une meilleure gestion du parc numérique. ', NULL, 1, NULL, NULL, 0),
('eae4daaa-06bc-11ee-b776-0cc47a39c2c0', 'Utilisez-vous des solutions logicielles et systèmes d\'exploitation libres?', 'b11106a0-0453-11ee-b776-0cc47a39c2c0', '8444bdb4-432a-11ed-af88-040300000000', 0, '', ' Le libre, par son mode de fonctionnement basé sur une contribution communautaire, est plus vertueux en ce qu\'il favorise moins l\'obsolescence logicielle que les solutions logicielles et systèmes d\'exploitation reposant sur un écosystème propriétaire et fermé. \r\nPar exemple, le système d\'exploitation Linux est reconnu pour permettre le prolongement de la durée de vie de poste informatique ancien.', NULL, 10, NULL, NULL, 0),
('eae51626-06bc-11ee-b776-0cc47a39c2c0', 'Qu\'advient-il en règle générale du matériel encore fonctionnel remplacé ?', 'b11106a0-0453-11ee-b776-0cc47a39c2c0', '8444bdb4-432a-11ed-af88-040300000000', 0, '', ' L\'allongement de la durée de vie des équipements numériques est la priorité compte tenu de l\'impact de leur fabrication. Opter pour le réemploi du matériel numérique encore fonctionnel permet d\'y contribuer en lui offrant une nouvelle vie. ', NULL, 11, NULL, NULL, 0),
('eae552de-06bc-11ee-b776-0cc47a39c2c0', 'Avez-vous mis en place des consignes et pratiques de nature à réduire la consommation d\'énergie de votre parc informatique (mise en veille, extinction des équipements, paramétrage de la luminosité, suivi des consommations...)?', 'b111b80e-0453-11ee-b776-0cc47a39c2c0', '8444bdb4-432a-11ed-af88-040300000000', 0, '', '', NULL, 1, NULL, NULL, 0),
('eae6f0c0-06bc-11ee-b776-0cc47a39c2c0', 'Avez-vous mis en place des paramétrages favorisant la sobriété numérique en matière d\'impression de documents (impression en noir et blanc, recto/verso, protégée...)? ', 'b111b80e-0453-11ee-b776-0cc47a39c2c0', '8444bdb4-432a-11ed-af88-040300000000', 0, '', '', NULL, 8, NULL, NULL, 0),
('eae72d87-06bc-11ee-b776-0cc47a39c2c0', 'Connaissez-vous les obligations de votre structure en matière de traitement des DEEE? ', 'b112172d-0453-11ee-b776-0cc47a39c2c0', '8444bdb4-432a-11ed-af88-040300000000', 0, 'Les DEEE ou D3E sont les déchets d\'équipements électriques et électroniques (EEE) en fin de vie. Ils sont considérés par la réglementation environnementale en vigueur comme étant des déchets dangereux car ils contiennent des substances réglementées. Le code de l\'environnement définit les équipements électriques et électroniques comme étant des équipements « fonctionnant grâce à des courants électriques ou à des champs électromagnétiques, ainsi que les équipements de production, de transfert et de mesure de ces courants et champs, conçus pour être utilisés à une tension ne dépassant pas 1 000 volts en courant alternatif et 1 500 volts en courant continu. »\r\nIls contiennent par ailleurs des ressources qui peuvent être réutilisées ou recyclées. ', ' Une mauvaise gestion des EEE encore fonctionnels et DEEE est source de nombreux impacts négatifs, notamment : \r\n- Perte de matériaux réutilisables ; \r\n- Pollution de l\'air et des sols ; \r\n- Favorisation des trafics mondiaux liés aux DEEE ; \r\n- Pollution et impacts sociaux au sein des tiers pays où sont envoyés les DEEE pour traitement...', NULL, 1, NULL, NULL, 0),
('eae791b1-06bc-11ee-b776-0cc47a39c2c0', 'Une politique de gestion des DEEE est-elle en place (postes informatiques, téléphones, imprimantes/scanners, cartouches d\'encre et toner...)? ', 'b112172d-0453-11ee-b776-0cc47a39c2c0', '8444bdb4-432a-11ed-af88-040300000000', 0, '', '', NULL, 2, 'eae72d87-06bc-11ee-b776-0cc47a39c2c0', '0d1a4a0c-06bd-11ee-b776-0cc47a39c2c0', 0),
('eae80242-06bc-11ee-b776-0cc47a39c2c0', 'Selon quelle modalité les outils numériques sont-ils généralement reliés au réseau internet ?', '0', 'd573027d-432d-11ed-af88-040300000000', 0, '', ' Plusieurs études ont démontré que les réseaux mobiles (2G/3G4G/5G) présentent un impact environnemental largement supérieur aux autres (filaire et Wi-Fi). Voir notamment la note de synthèse de l\'étude corédigée par l\'Arcep et l\'ADEME de janvier 2022 (Évaluation de l\'impact environnemental du numérique en France et analyse prospective) : Par ailleurs, les réseaux fixes concentrent la majorité des impacts (entre 75 et 90 % des impacts suivant l\'indicateur). Mais, rapporté à la quantité de Go consommée sur chaque réseau, l\'impact environnemental des réseaux fixes devient inférieur à celui des réseaux mobiles. Par Go consommé, les réseaux mobiles ont près de trois fois plus d\'impact que les réseaux fixes pour l\'ensemble des indicateurs environnementaux étudiés.  ', NULL, 1, NULL, NULL, 0),
('eae84289-06bc-11ee-b776-0cc47a39c2c0', 'Une politique de gestion des données numériques (suppression des doublons, mutualisation des données, durée de conservation limitée, archivage intermédiaire et définitif, système d\'archivage électronique (SAE), etc.) est-elle en place?', '0', 'd573027d-432d-11ed-af88-040300000000', 0, '', ' Selon le Livre blanc de l\'action GreenConcept : Chaque octet a un impact. Il faut donc réduire au maximum la quantité de données produites, traitées, transportées et stockées.\r\nLa donnée est en effet au cœur du sujet de la sobriété numérique puisque c\'est afin de la traiter, de la stocker, ou encore de la transférer que les infrastructures numériques sont mises en place. ', NULL, 2, NULL, NULL, 0),
('eaea942d-06bc-11ee-b776-0cc47a39c2c0', 'Des obligations et/ou bonnes pratiques favorisant la sobriété numérique (gestion et tri des boîtes de messagerie, espaces de stockage en ligne, mise en veille et extinction des outils numériques...) ont-elles été mises en place via la charte informatique ou tout autre support ou format? ', '0', '54aa9a19-432e-11ed-af88-040300000000', 0, '', ' La charte informatique est le document indiqué pour assurer la diffusion et l\'opposabilité des règles et pratiques communes définies par la structure concernant le numérique (sécurité informatique, protection des données, usages autorisés, sanctions, etc.). ', NULL, 1, NULL, NULL, 0),
('eaead655-06bc-11ee-b776-0cc47a39c2c0', 'Votre structure fait-elle un usage régulier de la visioconférence? ', '0', '54aa9a19-432e-11ed-af88-040300000000', 0, '', ' Tout comme les déplacements, la visioconférence a des impacts environnementaux qu\'il faut prendre en compte pour définir le format le plus approprié pour la tenue d\'une réunion (terminaux utilisés pour y participer, réseaux utilisés, nombre de participants, durée de la réunion...). \r\nÀ noter que d\'après une étude menée par des chercheurs de l\'université Purdue, de l\'université de Yale et du Massachusetts Institute of Technology, désactiver la webcam réduit de 96% l\'impact environnemental lié à la visioconférence.', NULL, 2, NULL, NULL, 0),
('eaeb0f2f-06bc-11ee-b776-0cc47a39c2c0', 'Le télétravail est-il en place? ', '0', '54aa9a19-432e-11ed-af88-040300000000', 0, '', ' Bien que la mise en place du télétravail implique de nouveaux impacts qu\'il est nécessaire de prendre en compte dans son déploiement afin d\'éviter le phénomène des effets de rebond, sa mise en place permet, dans de nombreux contextes, de réduire les émissions de gaz à effets de serre liées aux déplacements. Selon une récente étude de l\'ADEME (2020) : En conclusion, l\'ensemble des effets rebond identifiés (déplacements supplémentaires, relocalisation du domicile, usage de la visioconférence, consommations énergétiques du domicile...) peuvent réduire en moyenne de 31 % les bénéfices environnementaux du télétravail. Cependant, si l\'on prend en compte également les effets positifs induits - en particulier ceux générés par le flex office organisé, nous obtenons une balance positive de + 52 %. Ces bénéfices sont significatifs et justifient l\'encouragement du développement du télétravail, dans un contexte où il est par ailleurs plébiscité par les salariés eux-mêmes en raison de ses avantages individuels (qualité de vie, gain de temps et d\'argent, etc.).', NULL, 3, NULL, NULL, 0),
('eaeb4f85-06bc-11ee-b776-0cc47a39c2c0', 'Avez-vous mis en place des consignes particulières favorisant la sobriété numérique en matière d\'impression de documents (police imposée, nombre limité d\'impressions...)? ', '0', '54aa9a19-432e-11ed-af88-040300000000', 0, '', ' En moyenne, un français imprime 20 pages par jour, ce qui représente, notamment, par personne et par an : \n- 6 600 pages imprimées ; \n- 1 arbre utilisé ; \n- 12 500 litres d\'eau consommés. \nOr, derrière ces chiffres, il faut tenir compte du fait que : \n- les e-mails représentent 10 à 38% du volume d\'impression ; \n- 16% des impressions ne sont jamais lues et 65% pourraient être lues sur un écran ; \n- ¼ des impressions sont jetées dans les 5 minutes suivant l\'impression.\nIl est donc nécessaire d\'agir pour réduire l\'impact des impressions. ', NULL, 4, NULL, NULL, 0),
('eaeb8dc2-06bc-11ee-b776-0cc47a39c2c0', 'La collecte et le recyclage du papier sont-ils réalisés au sein de votre structure? ', '0', '54aa9a19-432e-11ed-af88-040300000000', 0, '', ' Décret Tri 5 flux : \r\nDans le prolongement de la loi sur la transition énergétique, et en complément de l\'obligation sur le tri et la valorisation des emballages professionnels (Art. R 543-66 à 72 du code de l\'Environnement), le décret n°2016-288 du 10 mars 2016 oblige depuis le 1er juillet 2016 au tri à la source et à la valorisation de 5 flux de déchets (Art. D 543 à 287 du code de l\'Environnement), à savoir : papier/carton, métal, plastique, verre et bois.', NULL, 5, NULL, NULL, 0),
('eaebdb76-06bc-11ee-b776-0cc47a39c2c0', 'Les services numériques (logiciels, applications...) utilisés sont-ils écoconçus? ', '0', '708d624a-432f-11ed-af88-040300000000', 0, '', ' Selon la Mission interministérielle Numérique Écoresponsable (MiNumÉco) : L\'écoconception des services numériques n\'est pas uniquement une recherche d\'optimisation, d\'efficience ou de performance mais une réflexion plus globale sur l\'usage des technologies. Il est important d\'intégrer les impacts environnementaux du numérique dans la conception des services numériques en visant directement ou indirectement à allonger la durée des vies des équipements numériques, à réduire la consommation de ressources informatiques et énergétiques des terminaux, des réseaux et des centres de données.\r\nPar exemple, lorsqu\'un service de communication en ligne présente des erreurs dans son code ou que celui-ci est rédigé de façon complexe, les navigateurs internet prennent plus de temps pour en charger le contenu car ils doivent au préalable compenser ces erreurs et déchiffrer l\'ensemble, ce qui implique un impact environnemental plus important. ', NULL, 1, NULL, NULL, 0),
('eaec1930-06bc-11ee-b776-0cc47a39c2c0', 'Vos services de communication au public en ligne (principalement sites internet et applications mobiles) sont-ils écoconçus?', '0', '708d624a-432f-11ed-af88-040300000000', 0, 'Services de communication au public en ligne : Selon le Référentiel Général d\'Amélioration de l\'Accessibilité (RGAA), \'\'Les services de communication au public en ligne sont définis comme toute mise à disposition du public ou de catégories de public, par un procédé de communication électronique, de signes, de signaux, d\'écrits, d\'images, de sons ou de messages de toute nature qui n\'ont pas le caractère d\'une correspondance privée (article 1er de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l\'économie numérique). Conformément au II de l\'article 47 de la loi du 11 février 2005, ils comprennent notamment :\r\nles sites internet, intranet, extranet ; les progiciels, dès lors qu\'ils constituent des applications utilisées au travers d\'un navigateur web ou d\'une application mobile ;\r\nles applications mobiles qui sont définies comme tout logiciel d\'application conçu et développé en vue d\'être utilisé sur des appareils mobiles, tels que des téléphones intelligents (smartphones) et des tablettes, hors système d\'exploitation ou matériel ;\r\nle mobilier urbain numérique, pour leur partie applicative ou interactive, hors système d\'exploitation ou matériel.\'\'', '', NULL, 2, NULL, NULL, 0),
('eaecba23-06bc-11ee-b776-0cc47a39c2c0', 'Les personnes en charge de la communication sont-elles au fait des principes de la sobriété éditoriale? ', '0', '708d624a-432f-11ed-af88-040300000000', 0, '', ' D\'après le Shift Project, le trafic de données est responsable de plus de la moitié de l\'impact énergétique mondial du numérique, avec 55 % de sa consommation d\'énergie annuelle. Chaque octet transféré ou stocké sollicite des terminaux et des infrastructures de grande envergure, gourmandes en énergie (centres de données, réseaux). \nEn 2018, les flux vidéo représentaient 80 % des flux de données mondiaux et 80 % de l\'augmentation de leur volume annuel. Les 20 % restants étaient constitués de sites web, de données, de jeux vidéo, etc. La croissance rapide du volume total de données - donc de la consommation d\'énergie et des émissions de gaz à effet de serre associées – est ainsi en très large partie due à la vidéo.\nLa sobriété éditoriale vise à réduire ces différents impacts par la mise en place d\'une communication raisonnée et adaptée aux besoins de votre structure et des personnes auxquelles elle s\'adresse. ', NULL, 3, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `recommandation`
--

DROP TABLE IF EXISTS `recommandation`;
CREATE TABLE IF NOT EXISTS `recommandation` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `title` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `question_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `level_id` smallint UNSIGNED NOT NULL,
  `status_id` int NOT NULL DEFAULT '4',
  PRIMARY KEY (`id`),
  KEY `IDX_C7782A281E27F6BF` (`question_id`),
  KEY `IDX_C7782A285FB14BA7` (`level_id`),
  KEY `IDX_C7782A286BF700BD` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recommandation`
--

INSERT INTO `recommandation` (`id`, `title`, `short_title`, `body`, `details`, `question_id`, `level_id`, `status_id`) VALUES
('01ab58b1-4af5-11ee-b615-0cc47a39c2c2', 'À votre connaissance, votre structure a-t-elle pris en compte la sobriété numérique et la transition environnementale dans ses actions et projets en lien avec le numérique ?', 'Mettre en place une gouvernance', 'Mettre en place une gouvernance de la démarche vers un numérique plus sobre (désignation d\'un référent opérationnel/élu, création d\'un comité de pilotage, rédaction d\'un plan d\'actions...).', '', '6c5a609b-4af4-11ee-b615-0cc47a39c2c2', 2, 4),
('036c12fc-4b00-11ee-b615-0cc47a39c2c2', 'Les élus de votre structure ont-ils été formés aux enjeux et bonnes pratiques en matière de sobriété numérique ?', 'Formation des élus', 'Former les élus les plus concernés aux enjeux et bonnes pratiques de la sobriété numérique.', NULL, 'a950ed4d-4aff-11ee-b615-0cc47a39c2c2', 0, 4),
('10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'L\'utilisation des outils professionnels à des fins personnelles et/ou l\'utilisation d\'outils personnels à des fins professionnelles est-elle autorisée ?', 'Mutualisation des usages professionnels et personnels', 'Autoriser l\'utilisation des outils numériques professionnels sur le temps personnel et/ou favoriser la pratique du BYOD (Bring Your Own Device). À noter toutefois que cette dernière est fortement déconseillée par l\'ANSSI (Agence nationale de la sécurité des systèmes d\'information) pour des raisons de sécurité du système d\'information. Sa mise en place est envisageable sous réserve de bien l\'encadrer. \nCes pratiques doivent dans tous les cas être encadrées par un document de type charte informatique afin de ne pas remettre en cause la sécurité du système d\'information, la protection des données personnelles, ainsi que le nécessaire cloisonnement entre vie privée et vie professionnelle. Consulter les ressources humaines, le DPO et/ou le RSSI de votre structure pour un accompagnement.', '', 'eae246b3-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('1002624a-09ba-11ee-b881-0cc47a39c2c2', 'Avez-vous mis en place des consignes et pratiques de nature à allonger la durée de vie de vos équipements numériques (favoriser la réparation avant le remplacement, dissocier le remplacement des équipements selon les besoins, maintenance...) ?', 'Consignes et pratiques pour allonger de la durée de vie des équipements numériques', 'Mettre en place des consignes et pratiques de nature à allonger la durée de vie de vos équipements numériques (favoriser la réparation avant le remplacement, dissocier le remplacement des équipements selon les besoins, assurer une maintenance régulière...).', '', 'eae2877c-06bc-11ee-b776-0cc47a39c2c0', 1, 4),
('100268ee-09ba-11ee-b881-0cc47a39c2c2', 'Avez-vous mis en place des consignes et pratiques de nature à réduire la consommation d\'énergie de votre parc informatique (mise en veille, extinction des équipements, paramétrage de la luminosité, suivi des consommations...) ? ', 'Économie d\'énergie du parc numérique', 'Appliquer et diffuser les bonnes pratiques favorisant les économies d\'énergie dans l\'utilisation des équipements numériques. Cela contribuera également à allonger la durée de vie de leur batterie et donc des équipements eux-mêmes.', 'Appliquer et diffuser les bonnes pratiques favorisant les économies d\'énergie dans l\'utilisation des équipements numériques afin d\'allonger la durée de vie de leur batterie et donc la durée de vie des équipements eux-mêmes :  - Privilégier le mode d\'alimentation le plus économique/écologique (paramétrage de la batterie, mode économie d\'énergie par exemple).  - Mettre en veille les équipements numériques dès qu\'ils ne sont pas utilisés ou les éteindre en cas d\'inactivité prolongée (30 minutes à une heure d\'inactivité environ).  - Adapter la luminosité de l\'écran selon les besoins.  - Limiter le nombre de programmes ouverts et inutilisés. Les fermer en cas d\'absence (pause du midi notamment) afin d\'éviter l\'envoi de requêtes inutiles.  - Désactiver les fonctions GPS, Wifi, Bluetooth et autres lorsqu\'elles ne sont pas utilisées.  - Éteindre les écrans et autres équipements non utilisés.', 'eae552de-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('100274d4-09ba-11ee-b881-0cc47a39c2c2', 'Des obligations et/ou bonnes pratiques favorisant la sobriété numérique (gestion et tri des boîtes de messagerie, espaces de stockage en ligne, mise en veille et extinction des outils numériques...) ont-elles été mises en place via la charte informatique ou tout autre support ou format ? ', 'Diffusion des bonnes pratiques en interne', 'Appliquer et diffuser les principes de la sobriété numérique à la gestion des boîtes mail (rédaction, pièces jointes, , tri, paramétrages, etc.), à la navigation en ligne (choix du navigateur, recherches, etc.) ou encore à l\'écoute de musique et autres contenus audiovisuels durant le temps de travail (streaming, choix du média, etc...).', 'Appliquer et diffuser les principes de la sobriété numérique à la gestion des boîtes mail :  - Assurer un tri régulier de sa boîte mail, dans le respect des durées de conservation et règles d\'archivage qui s\'imposent à la structure ;  - Se désabonner des newsletters inutiles ;  - Installer un anti-spams ; - Réduire autant que possible le nombre d\'emails envoyés : il préférable, lorsqu\'il peut être évité, de privilégier un canal de transmission d\'informations moins impactant (SMS, appel...) ;  - Privilégier le format texte au format HTML pour la rédaction d\'emails. Ce dernier format ne doit être utilisé que lorsque cela est indispensable ;  - Réduire le contenu de l\'email à l\'essentiel afin de réduire les temps d\'écriture et de lecture ;  - A l\'externe : Partager un lien vers le lieu de stockage en ligne institutionnel ou temporaire (cloud interne ou plateforme de partage en ligne) d\'un document plutôt que d\'en joindre une copie au mail envoyé. A défaut, compresser la taille des pièces jointes ; A l\'interne : privilégier le partage via serveur ou messagerie instantanée ;   - Bien cibler ses destinataires et n\'utiliser la fonctionnalité \"Répondre à tous\" que lorsque cela est réellement nécessaire ;  - Créer une signature sans image ni logo au moins pour les échanges internes ;  - Supprimer les pièces jointes des emails transférés ou auxquels une réponse est envoyée.  Appliquer et diffuser les principes de la sobriété numérique à la navigation en ligne :  - Fermer les pages et onglets inutilisés ;  - Vider le cache, supprimer les cookies et historique de navigation des navigateurs ; - Ajouter une solution bloquant la recharge des onglets ;  - Mettre en favoris/marque-pages les sites régulièrement consultés ;  - Choisir un navigateur internet moins énergivore (Chrome serait l\'un des plus gourmands devant Internet Explorer et Firefox) ;  - Se rendre directement sur le site en tapant l\'adresse dans la barre d\'url ou via les favoris et l\'historique plutôt que de lancer une recherche via un moteur de recherches ;  - Utiliser les mots clés les plus précis possible pour les recherches en ligne.   Ecoute de musique et autres contenus audiovisuels durant le temps de travail :  - Eviter le streaming vidéo (clips ou autres) ou réduire la qualité vidéo au minimum proposé/nécessaire pour la bonne compréhension de la vidéo ;  - Privilégier la radio ou les sites et applications de streaming audio et la fonctionnalité de téléchargement que ces outils proposent si possible.', 'eaea942d-06bc-11ee-b776-0cc47a39c2c0', 1, 4),
('10027797-09ba-11ee-b881-0cc47a39c2c2', 'Votre structure fait-elle un usage régulier de la visioconférence ? ', '', 'Désactiver les webcams lors des visioconférences lorsqu\'il n\'est pas pertinent de les garder allumées (lorsque l\'animateur projette une présentation ou qu\'une participation active n\'est pas attendue par exemple). Le but est de trouver le juste équilibre entre convivialité et maîtrise des impacts liés à l\'utilisation des webcams. ', '', 'eaead655-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e0a1b0d-06bd-11ee-b776-0cc47a39c2c0', 'Votre structure a-t-elle mis en place une gouvernance pour la sobriété numérique (désignation d\'un référent, prise d\'engagements, définition d\'objectifs, mise en place d\'actions...) ', 'Mettre en place une gouvernance', 'Une gouvernance de la démarche vers un numérique plus sobre contient tout ou partie de ces exemples d\'actions : \n- désignation d\'un référent opérationnel/élu, \n- création d\'un comité de pilotage, \n- rédaction d\'un plan d\'action,\n- sélection d\'indicateurs environnementaux et définition d\'objectifs,\n- attribution des critères de suivi et d\'atteinte des objectifs environnementaux,\n- organisation de points de suivi réguliers afin d\'approfondir progressivement les objectifs et/ou d\'élargir les indicateurs pris en compte.', '', 'ead873c4-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('5e0d053a-06bd-11ee-b776-0cc47a39c2c0', 'Des actions de sensibilisation sont-elles menées auprès du personnel sur les enjeux et bonnes pratiques en matière de sobriété numérique ? ', 'Sensibilisation des agents et autres personnels', 'Assurer une sensibilisation régulière des agents et autres personnels de votre structure, aux enjeux et bonnes pratiques de la sobriété numérique.\nEn complément de sessions de sensibilisation, diffuser ces enjeux en interne via différents supports physiques et numériques (note d\'organisation, affichage, lettre d\'information interne...).', '', 'eada5694-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('5e0d4df5-06bd-11ee-b776-0cc47a39c2c0', 'Le personnel de votre structure a-t-il été formé aux enjeux et bonnes pratiques en matière de sobriété numérique ? ', 'Formation du personnel', 'Former les responsables et/ou agents et autres personnels les plus concernés aux enjeux et bonnes pratiques de la sobriété numérique (DSI/service informatique, achats & marchés publics, communication...).', '', 'eada8fd0-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e0d96a4-06bd-11ee-b776-0cc47a39c2c0', 'Des actions de sensibilisation sont-elles menées auprès des élus sur les enjeux et bonnes pratiques en matière de sobriété numérique ? ', 'Sensibilisation des élus et membres des instances dirigeantes', 'Assurer une sensibilisation régulière des élus et membres des instances dirigeantes de votre structure, aux enjeux et bonnes pratiques de la sobriété numérique.', '', 'eadacc92-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e0ddf42-06bd-11ee-b776-0cc47a39c2c0', 'Votre structure a-t-elle recours à la location de matériels numériques ? ', '', 'Privilégier la location d\'équipements numériques à l\'achat. \r\nVeiller toutefois à ce que le prestataire prenne des engagements favorisant effectivement l\'allongement de la durée de vie du matériel loué (matériel écolabellisé et durable, réemployé à l\'issue du contrat...). Il est par exemple possible de fixer un seuil minimum de réemploi du matériel loué à cette fin. ', '', 'eadb0117-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e0e3065-06bd-11ee-b776-0cc47a39c2c0', 'Votre structure a-t-elle pris des mesures permettant de favoriser la sobriété numérique dans les achats et locations d\'équipements et services numériques telles que l\'ajout de clauses contractuelles, une prise en compte des écolabels, des indices de réparabilité, d\'éco-conception, d\'achat ou de location d\'équipements issus du réemploi ou de la réutilisation ?', '', 'Mettre en place des mesures permettant de favoriser la sobriété numérique dans les achats et locations d\'équipements et services numériques (ajout de clauses contractuelles, prise en compte des écolabels, de l\'indice de réparabilité, de l\'éco-conception, achat/location d\'équipements issus du réemploi ou de la réutilisation ...).', '', 'eadb3a87-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('5e11ca07-06bd-11ee-b776-0cc47a39c2c0', 'Votre structure a-t-elle pris des mesures permettant de favoriser la sobriété numérique dans les achats pour l\'impression telles que le choix du papier, de l\'encre et des toners ?', '', 'Mettre en place des mesures permettant de favoriser la sobriété numérique dans les achats pour l\'impression (choix du papier, de l\'encre et des toners...). ', '', 'eadcd379-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('5e13362e-06bd-11ee-b776-0cc47a39c2c0', 'Faîtes-vous appel à des fournisseurs d\'énergie dite « verte »/renouvelable ? ', 'Origine de l\'énergie alimentant le système d\'information', 'Alimenter le système d\'information (SI) de préférence avec de l\'énergie renouvelable ou dite \"décarbonée\" ou encore \"verte\".', '', 'eadefc43-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e13858c-06bd-11ee-b776-0cc47a39c2c0', 'Disposez-vous d\'un inventaire du parc numérique de votre structure (postes informatiques et écrans, téléphones, tablettes, supports de sauvegardes amovibles, vidéoprojecteurs...) ? ', 'Inventaire du parc numérique', 'Tenir un inventaire du parc numérique de votre structure (postes informatiques et écrans, téléphones, tablettes, supports de sauvegardes amovibles, vidéoprojecteurs...). Celui-ci est un élément indispensable de la cartographie de son système d\'information (SI).', '', 'eadf40b1-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e154e7f-06bd-11ee-b776-0cc47a39c2c0', 'Assurez-vous la traçabilité des attributions et besoins en outils informatiques en interne ? ', 'Suivi des attributions d\'équipements numériques', 'Assurer le suivi des attributions d\'équipements numériques : \n-        Mettre en place une documentation assurant la traçabilité des attributions et restitutions d\'outils ; \n-        Effectuer une revue annuelle des besoins et attributions ; \n-        Inviter les utilisateurs à restituer le matériel non-utilisé pour réaffectation selon les besoins internes.', '', 'eae0b739-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e1718ce-06bd-11ee-b776-0cc47a39c2c0', 'L\'utilisation des outils professionnels à des fins personnelles et/ou l\'utilisation d\'outils personnels à des fins professionnelles est-elle autorisée ?', 'Double carte SIM', 'Favoriser le recours à la double carte SIM afin de réduire les doublons téléphones portables professionnel/personnel.', '', 'eae246b3-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('5e176a1a-06bd-11ee-b776-0cc47a39c2c0', 'Avez-vous mis en place des consignes et pratiques de nature à allonger la durée de vie de vos équipements numériques (favoriser la réparation avant le remplacement, dissocier le remplacement des équipements selon les besoins, maintenance...) ?', 'Politique de gestion du parc numérique', 'Mettre en place une politique de gestion du parc numérique intégrant les principes de la sobriété numérique :\n- identification des besoins utilisateurs par profils-types, \n- cycle de vie des différents outils et notamment le potentiel réemploi interne ou externe de matériels en fin de vie, \n- durée d’amortissement,\n- méthodologie choisie pour sa réparabilité (interne ou externalisation), son impact environnemental (GES ou ACV), ses bonnes pratiques d’usage (extinction, veille, allumage, etc...).', '', 'eae2877c-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('5e1a8fcc-06bd-11ee-b776-0cc47a39c2c0', 'Utilisez-vous des solutions logicielles et systèmes d\'exploitation libres ?', 'Favoriser le libre', 'Lorsque cela est possible, privilégier l\'utilisation de solutions logicielles et systèmes d\'exploitation libres.', '', 'eae4daaa-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e1af44e-06bd-11ee-b776-0cc47a39c2c0', 'Qu\'advient-il du matériel encore fonctionnel remplacé ?', 'Réemploi en externe', 'Concernant le réemploi en externe : \nPour les équipements numériques (écrans, moniteurs et équipements comprenant des écrans d\'une surface supérieure à 100 cm2, ainsi que les petits équipements informatiques et de télécommunications) encore fonctionnels (moins de 10 ans), à défaut d\'un réemploi en interne (réaffectation à un autre utilisateur), ils doivent rejoindre les filières du réemploi et de la réutilisation. Respecter a minima les quotas réglementaires :\n<ul>\n            <li>Pour l\'année 2023, 25% des équipements numériques réformés orientés vers le réemploi et la réutilisation</li>\n            <li>Pour l\'année 2024, 35% des équipements numériques réformés orientés vers le réemploi et la réutilisation</li>\n<li>À partir de 2025, 50% des équipements numériques réformés orientés vers le réemploi et la réutilisation</li>\n        </ul>\nS\'agissant donc de vendre ou donner le bien, cela constitue un acte de cession qui peut être à titre gratuit, ou à titre onéreux. Il doit être établit selon les selon les conditions applicables en la matière. Il est dans tous les cas conseillé d\'établir une convention de cession ou un acte de vente à titre gratuit ou onéreux qui matérialise le transfert de propriété et par conséquent de responsabilité du bien. ', 'Concernant le réemploi en externe :  Pour les équipements numériques (écrans, moniteurs et équipements comprenant des écrans d\'une surface supérieure à 100 cm2, ainsi que les petits équipements informatiques et de télécommunications) encore fonctionnels (moins de 10 ans), à défaut d\'un réemploi en interne (réaffectation à un autre utilisateur), ils doivent rejoindre les filières du réemploi et de la réutilisation. Respecter a minima les quotas réglementaires :  <ul>             <li>Pour l\'année 2023, 25% des équipements numériques réformés orientés vers le réemploi et la réutilisation</li>             <li>Pour l\'année 2024, 35% des équipements numériques réformés orientés vers le réemploi et la réutilisation</li> <li>À partir de 2025, 50% des équipements numériques réformés orientés vers le réemploi et la réutilisation</li>         </ul> S\'agissant donc de vendre ou donner le bien, cela constitue un acte de cession qui peut être à titre gratuit (selon les conditions applicables pour les organismes publics), ou à titre onéreux :  La cession à titre gratuit, le don, est très encadrée pour les personnes publiques, en effet elle ne peut être qu\'à destination du personnel ou d\'une association (pour le détail, voir l\'article L3212-3 du Code général de la propriété des personnes publiques, renvoyant à l\'article précédent, L3212-2 concernant les biens de l\'État et de ses établissements publics). Sachant que le seuil de la valeur résiduelle unitaire du bien à céder a été fixée par décret à 300 euros (Décret n° 2009-1751 du 17/01/2019). Si la valeur du bien est supérieure à 300 euros, il doit faire l\'objet d\'une vente dans le respect des règles de la concurrence.  Il est dans tous les cas conseillé d\'établir une convention de cession ou un acte de vente à titre gratuit ou onéreux qui matérialise le transfert de propriété et par conséquent de responsabilité du bien. Cet acte permet d\'attester de la sortie du parc d\'équipements sans que celui-ci ne soit suivi comme déchet. Charge au nouveau propriétaire de gérer dans le futur sa fin d\'usage par un nouveau don ou par l\'abandon en déchets. En cas de don, il devra aussi mentionner l\'engagement du personnel ou du tiers à ne pas revendre l\'équipement ou l\'engagement de l\'association à n\'utiliser l\'équipement qui lui est cédé que pour l\'objet prévu par ses statuts, à l\'exclusion de tout autre, et notamment qu\'elle ne peut pas revendre l\'équipement. A noter toutefois l\'exception introduite par la loi 3DS du 21 février 2022 pour les associations reconnues d\'utilité publique ou d\'intérêt général : ces associations peuvent procéder à la cession, à un prix solidaire ne pouvant dépasser un seuil défini par décret, des biens ainsi alloués à destination de personnes en situation de précarité ou à des associations oeuvrant en faveur de telles personnes. ', 'eae51626-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('5e1b49da-06bd-11ee-b776-0cc47a39c2c0', 'Avez-vous mis en place des consignes et pratiques de nature à réduire la consommation d\'énergie de votre parc informatique (mise en veille, extinction des équipements, paramétrage de la luminosité, suivi des consommations...) ? ', 'Déconnexion des outils', 'Sauf contrainte technique ou organisationnelle, déconnecter ou débrancher tous les outils numériques en fin de journée. Le faire a minima avant les week-ends et absences prolongées. \nCette opération peut être facilitée par l\'installation de multiprises, voire la mise en place d\'un logiciel de power management. Les bénéfices sont la réduction de la consommation électrique de la struture.', '', 'eae552de-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e1e096e-06bd-11ee-b776-0cc47a39c2c0', 'Avez-vous mis en place des paramétrages favorisant la sobriété numérique en matière d\'impression de documents (impression en noir et blanc, recto/verso, protégée...) ? ', 'Paramètres d\'impression par défaut', 'Modifier les paramètres d\'impression par défaut des postes informatiques et imprimantes (mode éco, noir et blanc, etc.).', 'Modifier les paramètres d\'impression par défaut des postes informatiques et imprimantes :  - Paramétrer par défaut les imprimantes en mode éco ; - Paramétrer par défaut l\'impression en noir et blanc et recto/verso ;  - Privilégier l\'impression en niveaux de gris et optimiser l\'utilisation d\'encre ;  - Paramétrer le mode « Suppression des pages blanches » en standard ;  - Mettre en place le mode épreuve pour limiter les impressions « ratées » ;  - Mettre en place un logiciel de suivi des impressions pour étudier et rationaliser les pratiques ;  - Mettre en place l\'impression sécurisée (consistant à ne libérer l\'impression du document que si l\'agent s\'identifie et indique son code confidentiel).', 'eae6f0c0-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e1e6525-06bd-11ee-b776-0cc47a39c2c0', 'Connaissez-vous les obligations de votre structure en matière de traitement des DEEE ? ', 'Collecte des DEEE', 'Organiser la collecte et assurer le recyclage des DEEE : \n-        Ne considérer le recyclage qu\'en dernier ressort et étudier la possibilité de réparer, réemployer ou réutiliser les EEE ainsi que leurs déchets collectés : à noter que les équipements informatiques fonctionnels de moins de 10 ans doivent désormais rejoindre les filières du réemploi et de la réutilisation (cf. Décret n° 2023-266 du 12 avril 2023 fixant les objectifs et modalités de réemploi et de réutilisation des matériels informatiques réformés par l\'Etat et les collectivités territoriales) ; \n-        Mettre en place de façon systématique et optimiser le tri des DEEE ; \n-        Choisir un éco-organisme agréé pour leur prise en charge ; \n-        Assurer une traçabilité des DEEE et notamment obtenir des attestations de bon traitement des prestataires externes chargés de leur reprise.', '', 'eae72d87-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('5e1eb9c5-06bd-11ee-b776-0cc47a39c2c0', 'Une politique de gestion des DEEE est-elle en place (postes informatiques, téléphones, imprimantes/scanners, cartouches d\'encre et toner...) ? ', 'Collecte des DEEE', 'Organiser la collecte et assurer le recyclage des DEEE : \n<ul>\n    <li>Ne considérer le recyclage qu\'en dernier ressort et étudier la possibilité de réparer, réemployer ou réutiliser les EEE ainsi que leurs déchets collectés : à noter que les équipements informatiques fonctionnels de moins de 10 ans doivent désormais rejoindre les filières du réemploi et de la réutilisation (précisions à venir par l\'adoption d\'un décret d\'application qui précisera les modalités, les quantités et le calendrier)</li>\n    <li>Mettre en place de façon systématique et optimiser le tri des DEEE</li>\n    <li>Choisir un éco-organisme agréé pour leur prise en charge</li>\n    <li>Assurer une traçabilité des DEEE et notamment obtenir des attestations de bon traitement des prestataires externes chargés de leur reprise.</li>\n</ul>', '', 'eae791b1-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('5e1f6813-06bd-11ee-b776-0cc47a39c2c0', 'Selon quelles modalités les outils numériques sont-ils reliés au réseau internet ?', '', 'Privilégier la connexion réseau en filaire ou via Wi-Fi à défaut. L\'utilisation des réseaux mobiles (2G/3G/4G/5G) doit être réduite au strict minimum (par exemple en désactivant le transfert de données mobiles une fois la tâche accomplie).', '', 'eae80242-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e1fc3ee-06bd-11ee-b776-0cc47a39c2c0', 'Une politique de gestion des données numériques (suppression des doublons, mutualisation des données, durée de conservation limitée, archivage intermédiaire et définitif, système d\'archivage électronique (SAE), etc.) est-elle en place ?', '', 'Mettre en place une politique de gestion de la donnée afin d\'en limiter la quantité stockée sur les supports dédiés (gestion de la collecte, de la conservation, de l\'archivage des données, etc.). \nVeiller à tenir compte des règles propres à l\'archivage public dans ce processus. Se rapprocher du service des archives compétent, ainsi que des archives départementales pour un accompagnement. \nIl convient en outre d\'associer le délégué à la protection des données (DPO) de votre structure, s\'il y en a un, pour les questions relatives aux données personnelles. ', 'Mettre en place une politique de gestion de la donnée afin d\'en limiter la quantité stockée sur les supports dédiés : <ul>     <li>Appliquer le principe de pertinence et de minimisation des données collectées dans l\'ensemble des missions de la structure.  Envisager la mutualisation des données afin de prévenir la collecte et le stockage en double lorsque cela est pertinent et dans le respect des règles relatives à la protection des données personnelles le cas échéant (sécurité des données, information des personnes voire obtention préalable du consentement si nécessaire).  Il convient d\'associer le délégué à la protection des données (DPO) de votre structure, s\'il y en a un, pour les questions relatives aux données personnelles</li>     <li>Appliquer le principe de durée de conservation limitée des données dans l\'ensemble des missions de la structure et inviter les utilisateurs à trier leurs données numériques régulièrement afin de ne pas conserver des données qui ne sont plus pertinentes.  Veiller toutefois à tenir compte des règles propres à l\'archivage public dans ce processus, et notamment des Durée d\'Utilité Administrative (DUA) applicables ainsi que des règles liées au versement et à la destruction des documents administratifs.  Se rapprocher du service d\'archivage compétent, ainsi que des archives départementales pour un accompagnement</li>     <li>Appliquer les principes de l\'archivage intermédiaire et définitif à vos données numériques (par exemple via un Système d\'Archivage Électronique (SAE))</li>     <li>Refondre l\'arborescence des espaces de stockage afin d\'en optimiser la gestion (réduction des doublons, meilleure gestion des données et de l\'archivage, des habilitations et droits d\'accès...)</li> </ul>', 'eae84289-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e23c64a-06bd-11ee-b776-0cc47a39c2c0', 'Des obligations et/ou bonnes pratiques favorisant la sobriété numérique (gestion et tri des boîtes de messagerie, espaces de stockage en ligne, mise en veille et extinction des outils numériques...) ont-elles été mises en place via la charte informatique ou tout autre support ou format ? ', 'Charte informatique et sobriété numérique', 'Intégrer les enjeux et bonnes pratiques de la sobriété numérique à la charte informatique de votre structure si elle existe. À défaut, les diffuser via un document dédié à faire signer par les utilisateurs pour en assurer l\'opposabilité.', '', 'eaea942d-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e242297-06bd-11ee-b776-0cc47a39c2c0', 'Votre structure fait-elle un usage régulier de la visioconférence ? ', '', 'Évaluer la pertinence d\'organiser une visioconférence. Si elle permet parfois d\'éviter des déplacements superflus et impactants pour l\'environnement, il est parfois préférable d\'opter pour un format en présentiel ou une conférence téléphonique selon les besoins.', '', 'eaead655-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e2474eb-06bd-11ee-b776-0cc47a39c2c0', 'Le télétravail est-il en place ? ', 'Mise en place du télétravail', 'Étudier la pertinence de déployer le télétravail au sein de votre structure.\n', '', 'eaeb0f2f-06bc-11ee-b776-0cc47a39c2c0', 1, 4),
('5e24dd53-06bd-11ee-b776-0cc47a39c2c0', 'Avez-vous mis en place des consignes particulières favorisant la sobriété numérique en matière d\'impression de documents (police imposée, nombre limité d\'impressions...) ? ', 'Bonnes pratiques pour les impressions', 'Inviter les utilisateurs à adopter les principes de sobriété numérique en matière d\'impression (quotas, suivi des impressions, paramétrages, etc...).', 'Inviter les utilisateurs à adopter les principes de sobriété numérique en matière d\'impression :  - Inviter les utilisateurs à réduire leurs impressions au strict nécessaire (notamment les emails qui n\'ont, en principe, pas vocation à être imprimés). Dans de nombreux cas, l\'enregistrement au format PDF peut pallier le besoin d\'imprimer.  - L\'instauration d\'un quota d\'impressions, ou encore la mise en place de l\'impression protégée sont de nature à favoriser cette réduction.  - Lorsque l\'impression est nécessaire, réduire le contenu imprimé au strict nécessaire (sélectionner uniquement le contenu utile, ne pas imprimer les pages vides, effacer les pubs, éléments d\'interface des pages web, signatures email, images non porteuses d\'information et autres éléments non pertinents). A noter que des applications permettant d\'épurer le document avant impression existent.  - Opter pour l\'impression recto/verso en noir et blanc sauf besoin particulier.  - La réduction de la taille des caractères, le choix d\'une police de caractère adéquate (voir la recommandation dédiée), ainsi que de la largeur des marges peuvent être source d\'économies d\'encre et de papier.  - Privilégier un format standard (A4, A5...).  - Pour optimiser le résultat, utiliser la fonction \"aperçu avant impression\".  - En complément, le recours au mode \"brouillon\".', 'eaeb4f85-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'La collecte et le recyclage du papier sont-ils réalisés au sein de votre structure ? ', 'Collecte du papier', 'Assurer la collecte et le recyclage du papier. \nInviter les personnes à ne pas froisser le papier destiné au recyclage afin de ne pas entraver le bon déroulement de ce processus. \nLes documents papiers contenant des données personnelles doivent être passés au destructeur de documents afin d\'en préserver la confidentialité.', NULL, 'eaeb8dc2-06bc-11ee-b776-0cc47a39c2c0', 2, 4),
('5e25aac6-06bd-11ee-b776-0cc47a39c2c0', 'Les services numériques (logiciels, applications...) utilisés sont-ils écoconçus ? ', '', 'Conformément aux dispositions de la loi AGEC, favoriser les services numériques (logiciels, applications...) écoconçus.\n\n', 'Favoriser les solutions logicielles et applications écoconçues.   Cf. l\'alinéa 2 de l\'article 55 de la loi AGEC : Lorsque le bien acquis est un logiciel, les administrations mentionnées au premier alinéa de l\'article L. 300-2 du code des relations entre le public et l\'administration promeuvent le recours à des logiciels dont la conception permet de limiter la consommation énergétique associée à leur utilisation.', 'eaebdb76-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e26131f-06bd-11ee-b776-0cc47a39c2c0', 'Vos services de communication au public en ligne (principalement sites internet et applications mobiles) sont-ils écoconçus ?', '', 'Appliquer les principes de l\'écoconception aux sites internet, applications mobiles et autres services de communication au public en ligne développés en interne ou par le biais de prestataires externes.', '', 'eaec1930-06bc-11ee-b776-0cc47a39c2c0', 0, 4),
('5e26b458-06bd-11ee-b776-0cc47a39c2c0', 'Les personnes en charge de la communication sont-elles au fait des principes de la sobriété éditoriale ? ', '', 'Tenir compte des principes de la sobriété éditoriale dans le cadre de la production des supports et la politique de communication de la structure.', 'Tenir compte des principes de la sobriété éditoriale dans le cadre de la production des supports de communication de la structure :  <ul> <li>Choisir le format le plus adapté pour la communication envisagée (papier ou numérique : si une information a une durée de vie courte, il est préférable de communiquer au format numérique)</li> <li>Adapter la taille et format des images et les utiliser avec parcimonie</li> <li>Ne pas multiplier les contenus vidéo et prêter attention à la méthode de diffusion (préférer par exemple une image-lien renvoyant vers la plateforme-tierce de diffusion que d\'insérer un lecteur média sur le site, prévoir une retranscription textuelle ou un résumé afin qu\'elle ne soit pas lancée inutilement, trouver la résolution optimale : la plus faible possible sans altérer la bonne transmission d\'information...)</li> <li>Pour les documents à télécharger : opter pour le format le plus adapté et le plus léger (le format PDF est réputé plus léger, ce qui n\'est pas toujours le cas de ceux produits via des logiciels de graphisme ; Ce format pose toutefois des difficultés en termes d\'accessibilité numérique). Les logiciels de suite bureautique prévoient à cet effet des options visant à réduire le poids des fichiers qu\'il convient d\'utiliser. A noter cependant qu\'un contenu au format HTML (directement intégré au site) reste plus léger qu\'un fichier en téléchargement</li> <li>Cibler au mieux les destinataires afin de maximiser le taux de lecture et ainsi prévenir les envois qui ne seront pas lus</li> <li>Rédiger le message de façon claire et simple en évitant les contenus superflus</li> <li>Appliquer les bonnes pratiques en matière d\'impression (éviter les aplats de couleurs et l\'utilisation du pelliculage ou du vernissage, opter pour des couleurs composées à partir d\'une ou plusieurs couleurs de base de la quadrichromie et éviter les couleurs à effet métallique qui nécessitent l\'emploi d\'encres auxquelles sont ajoutées des métaux notamment ou encore choisir un papier écolabellisé et/ou recyclé)</li> <li>Favoriser les pliages et découpages ainsi que les colles végétales à base d\'eau. Eviter en revanche les matériaux susceptibles de gêner le recyclage (agrafes, spirales...)</li> <li>Rédiger le contenu de manière à ce qu\'il ne se périme pas rapidement</li>         </ul>', 'eaecba23-06bc-11ee-b776-0cc47a39c2c0', 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `recommandation_answer`
--

DROP TABLE IF EXISTS `recommandation_answer`;
CREATE TABLE IF NOT EXISTS `recommandation_answer` (
  `recommandation_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `answer_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`recommandation_id`,`answer_id`),
  KEY `IDX_5BB381BC61AAE789` (`recommandation_id`),
  KEY `IDX_5BB381BCAA334807` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recommandation_answer`
--

INSERT INTO `recommandation_answer` (`recommandation_id`, `answer_id`) VALUES
('01ab58b1-4af5-11ee-b615-0cc47a39c2c2', '01aa8539-4af5-11ee-b615-0cc47a39c2c2'),
('036c12fc-4b00-11ee-b615-0cc47a39c2c2', '03614917-4b00-11ee-b615-0cc47a39c2c2'),
('10025f8d-09ba-11ee-b881-0cc47a39c2c2', '0d102972-06bd-11ee-b776-0cc47a39c2c0'),
('1002624a-09ba-11ee-b881-0cc47a39c2c2', '0d109285-06bd-11ee-b776-0cc47a39c2c0'),
('100268ee-09ba-11ee-b881-0cc47a39c2c2', '0d16dd22-06bd-11ee-b776-0cc47a39c2c0'),
('100274d4-09ba-11ee-b881-0cc47a39c2c2', '0d2086cf-06bd-11ee-b776-0cc47a39c2c0'),
('10027797-09ba-11ee-b881-0cc47a39c2c2', '0d20ecf0-06bd-11ee-b776-0cc47a39c2c0'),
('5e0a1b0d-06bd-11ee-b776-0cc47a39c2c0', '0d00c687-06bd-11ee-b776-0cc47a39c2c0'),
('5e0d053a-06bd-11ee-b776-0cc47a39c2c0', '0d04dcc7-06bd-11ee-b776-0cc47a39c2c0'),
('5e0d4df5-06bd-11ee-b776-0cc47a39c2c0', '0d0541dd-06bd-11ee-b776-0cc47a39c2c0'),
('5e0d96a4-06bd-11ee-b776-0cc47a39c2c0', '0d05a7d3-06bd-11ee-b776-0cc47a39c2c0'),
('5e0ddf42-06bd-11ee-b776-0cc47a39c2c0', '0d060d39-06bd-11ee-b776-0cc47a39c2c0'),
('5e0e3065-06bd-11ee-b776-0cc47a39c2c0', '0d067457-06bd-11ee-b776-0cc47a39c2c0'),
('5e11ca07-06bd-11ee-b776-0cc47a39c2c0', '0d09428d-06bd-11ee-b776-0cc47a39c2c0'),
('5e13362e-06bd-11ee-b776-0cc47a39c2c0', '0d0ad899-06bd-11ee-b776-0cc47a39c2c0'),
('5e13858c-06bd-11ee-b776-0cc47a39c2c0', '0d0b404c-06bd-11ee-b776-0cc47a39c2c0'),
('5e154e7f-06bd-11ee-b776-0cc47a39c2c0', '0d0d9df3-06bd-11ee-b776-0cc47a39c2c0'),
('5e1718ce-06bd-11ee-b776-0cc47a39c2c0', '0d102972-06bd-11ee-b776-0cc47a39c2c0'),
('5e176a1a-06bd-11ee-b776-0cc47a39c2c0', '0d109285-06bd-11ee-b776-0cc47a39c2c0'),
('5e1a8fcc-06bd-11ee-b776-0cc47a39c2c0', '0d1602d6-06bd-11ee-b776-0cc47a39c2c0'),
('5e1af44e-06bd-11ee-b776-0cc47a39c2c0', '9c56ac2f-06c4-11ee-b776-0cc47a39c2c0'),
('5e1af44e-06bd-11ee-b776-0cc47a39c2c0', '9c5a6757-06c4-11ee-b776-0cc47a39c2c0'),
('5e1af44e-06bd-11ee-b776-0cc47a39c2c0', '9c5b15e9-06c4-11ee-b776-0cc47a39c2c0'),
('5e1b49da-06bd-11ee-b776-0cc47a39c2c0', '0d16dd22-06bd-11ee-b776-0cc47a39c2c0'),
('5e1e096e-06bd-11ee-b776-0cc47a39c2c0', '0d19fe62-06bd-11ee-b776-0cc47a39c2c0'),
('5e1e6525-06bd-11ee-b776-0cc47a39c2c0', '0d1a60ca-06bd-11ee-b776-0cc47a39c2c0'),
('5e1eb9c5-06bd-11ee-b776-0cc47a39c2c0', '5f99e1f3-06c5-11ee-b776-0cc47a39c2c0'),
('5e1eb9c5-06bd-11ee-b776-0cc47a39c2c0', '5f9d3105-06c5-11ee-b776-0cc47a39c2c0'),
('5e1f6813-06bd-11ee-b776-0cc47a39c2c0', 'cf2da61c-06c5-11ee-b776-0cc47a39c2c0'),
('5e1f6813-06bd-11ee-b776-0cc47a39c2c0', 'cf2f11b9-06c5-11ee-b776-0cc47a39c2c0'),
('5e1fc3ee-06bd-11ee-b776-0cc47a39c2c0', '0d1c35db-06bd-11ee-b776-0cc47a39c2c0'),
('5e23c64a-06bd-11ee-b776-0cc47a39c2c0', '0d2086cf-06bd-11ee-b776-0cc47a39c2c0'),
('5e242297-06bd-11ee-b776-0cc47a39c2c0', '0d20ecf0-06bd-11ee-b776-0cc47a39c2c0'),
('5e2474eb-06bd-11ee-b776-0cc47a39c2c0', '0d21529c-06bd-11ee-b776-0cc47a39c2c0'),
('5e24dd53-06bd-11ee-b776-0cc47a39c2c0', '0d21b662-06bd-11ee-b776-0cc47a39c2c0'),
('5e252e66-06bd-11ee-b776-0cc47a39c2c0', '0d221b88-06bd-11ee-b776-0cc47a39c2c0'),
('5e25aac6-06bd-11ee-b776-0cc47a39c2c0', '0d22805d-06bd-11ee-b776-0cc47a39c2c0'),
('5e26131f-06bd-11ee-b776-0cc47a39c2c0', '0d22e28b-06bd-11ee-b776-0cc47a39c2c0'),
('5e26131f-06bd-11ee-b776-0cc47a39c2c0', '990116a4-06c7-11ee-b776-0cc47a39c2c0'),
('5e26b458-06bd-11ee-b776-0cc47a39c2c0', '0d23adad-06bd-11ee-b776-0cc47a39c2c0'),
('5e26b458-06bd-11ee-b776-0cc47a39c2c0', 'b4ed52b0-06c7-11ee-b776-0cc47a39c2c0');

-- --------------------------------------------------------

--
-- Structure de la table `recommandation_custom`
--

DROP TABLE IF EXISTS `recommandation_custom`;
CREATE TABLE IF NOT EXISTS `recommandation_custom` (
  `recommandation_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `collectivite_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `question_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `IDX_74EADD0261AAE789` (`recommandation_id`),
  KEY `IDX_74EADD02A7991F51` (`collectivite_id`),
  KEY `IDX_74EADD021E27F6BF` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recommandation_level`
--

DROP TABLE IF EXISTS `recommandation_level`;
CREATE TABLE IF NOT EXISTS `recommandation_level` (
  `id` smallint UNSIGNED NOT NULL,
  `label` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recommandation_level`
--

INSERT INTO `recommandation_level` (`id`, `label`, `color`) VALUES
(0, 'Nécessaire', '#EEFFE5'),
(1, 'Recommandé', '#FFF5E5'),
(2, 'Prioritaire', '#F2D8AD');

-- --------------------------------------------------------

--
-- Structure de la table `recommandation_perso`
--

DROP TABLE IF EXISTS `recommandation_perso`;
CREATE TABLE IF NOT EXISTS `recommandation_perso` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `question_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `level_id` smallint UNSIGNED NOT NULL DEFAULT '1',
  `status_id` int NOT NULL DEFAULT '4',
  `title` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `collectivite_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6DBFAEF51E27F6BF` (`question_id`),
  UNIQUE KEY `UNIQ_6DBFAEF5A7991F51` (`collectivite_id`),
  KEY `IDX_6DBFAEF55FB14BA7` (`level_id`),
  KEY `IDX_6DBFAEF56BF700BD` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recommandation_resource`
--

DROP TABLE IF EXISTS `recommandation_resource`;
CREATE TABLE IF NOT EXISTS `recommandation_resource` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `recommandation_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_10A45F1361AAE789` (`recommandation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recommandation_resource`
--

INSERT INTO `recommandation_resource` (`id`, `recommandation_id`, `title`, `link`) VALUES
('13add36e-4bc3-11ee-b615-0cc47a39c2c2', '5e0d96a4-06bd-11ee-b776-0cc47a39c2c0', 'Voir le label \"VertVolt\" proposé par l\'ADEME\r\n', 'https://agirpourlatransition.ademe.fr/particuliers/vertvolt'),
('22a9f25a-4bc9-11ee-b615-0cc47a39c2c2', '100268ee-09ba-11ee-b881-0cc47a39c2c2', 'Des initiatives contribuent à la sensibilisation, voir notamment : \r\n- La Fresque du Numérique : ', 'https://www.fresquedunumerique.org/'),
('22a9f709-4bc9-11ee-b615-0cc47a39c2c2', '100268ee-09ba-11ee-b881-0cc47a39c2c2', '- Les MOOC de l\'Institut du Numérique Responsable : ', 'https://www.academie-nr.org/'),
('22a9f9fc-4bc9-11ee-b615-0cc47a39c2c2', '100268ee-09ba-11ee-b881-0cc47a39c2c2', '- Le MOOC de l\'INRIA :', 'https://www.fun-mooc.fr/fr/cours/impacts-environnementaux-du-numerique/'),
('22a9fc88-4bc9-11ee-b615-0cc47a39c2c2', '100268ee-09ba-11ee-b881-0cc47a39c2c2', 'Voir le kit de sensibilisation pour un numérique plus responsable au travail de l\'ADEME : ', 'https://longuevieauxobjets.gouv.fr/entreprise/numerique-responsable/kit'),
('22aa00a8-4bc9-11ee-b615-0cc47a39c2c2', '100268ee-09ba-11ee-b881-0cc47a39c2c2', '- Le \"serious game\" Econ[u]m : \r\n', 'https://ddemain.com/econum/jeu/'),
('3dfe226b-4bd5-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', '\"En vertu de l\'article 16 de la loi REEN du 15 novembre 2021, les filières du réemploi et de la réutilisation deviennent incontournables pour les équipements informatiques encore fonctionnels : ', 'https://www.legifrance.gouv.fr/jorf/article_jo/JORFARTI000044327293'),
('3dfe2770-4bd5-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Article L3212-2 et suivants du Code général de la propriété des personnes publiques : ', 'https://www.legifrance.gouv.fr/codes/section_lc/LEGITEXT000006070299/LEGISCTA000006164247/#LEGISCTA000006164247'),
('3dfe2ab0-4bd5-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Décret n° 2009-1751 du 30 décembre 2009 relatif aux cessions gratuites de matériels informatiques : ', 'https://www.legifrance.gouv.fr/loda/id/LEGIARTI000021679223/#LEGIARTI000021679223'),
('3dfe2d85-4bd5-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Article D3212-3 et suivants : ', 'https://www.legifrance.gouv.fr/codes/section_lc/LEGITEXT000006070299/LEGISCTA000024885751/#LEGISCTA000024885751'),
('3dfe3036-4bd5-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Art 178 de la loi 3DS du 21 février 2022 : ', 'https://www.legifrance.gouv.fr/jorf/article_jo/JORFARTI000045197631'),
('3dfe3500-4bd5-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Voir le mémento de la Direction National d\'Interventions Domaniales (DNID), à noter qu\'il n\'est pas à jour de l\'ajout de la loi 3DS : ', 'https://www.associations.gouv.fr/IMG/pdf/memento_dnid_v4_page_simple_16112019b.pdf'),
('3dfe37ef-4bd5-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Décret n° 2022-1413 du 7 novembre 2022 fixant des prix solidaires pour la revente des matériels informatiques réformés et cédés à titre gratuit à certaines associations par les administrations : ', 'https://www.legifrance.gouv.fr/jorf/id/JORFTEXT000046538108'),
('3dfe3ac4-4bd5-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Décret n° 2023-266 du 12 avril 2023 fixant les objectifs et modalités de réemploi et de réutilisation des matériels informatiques réformés par l\'Etat et les collectivités territoriales : ', 'https://www.legifrance.gouv.fr/jorf/id/JORFTEXT000047439314'),
('3dfe3ece-4bd5-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Voir le programme LaCollecte.tech d\'Emmaüs Connect : ', 'https://lacollecte.tech/\"'),
('436cc686-4bc7-11ee-b615-0cc47a39c2c2', '5e176a1a-06bd-11ee-b776-0cc47a39c2c0', 'Des initiatives contribuent à la sensibilisation, voir notamment : \r\n- La Fresque du Numérique : ', 'https://www.fresquedunumerique.org/'),
('436ccc62-4bc7-11ee-b615-0cc47a39c2c2', '5e176a1a-06bd-11ee-b776-0cc47a39c2c0', '- Les MOOC de l\'Institut du Numérique Responsable : \r\n', 'https://www.academie-nr.org/'),
('436ccfe2-4bc7-11ee-b615-0cc47a39c2c2', '5e176a1a-06bd-11ee-b776-0cc47a39c2c0', '- Le MOOC de l\'INRIA : \r\n', 'https://www.fun-mooc.fr/fr/cours/impacts-environnementaux-du-numerique/'),
('436cd2fe-4bc7-11ee-b615-0cc47a39c2c2', '5e176a1a-06bd-11ee-b776-0cc47a39c2c0', 'Voir le kit de sensibilisation pour un numérique plus responsable au travail de l\'ADEME : \r\n\r\n', 'https://longuevieauxobjets.gouv.fr/entreprise/numerique-responsable/kit'),
('436cd5fe-4bc7-11ee-b615-0cc47a39c2c2', '5e176a1a-06bd-11ee-b776-0cc47a39c2c0', '- Le \"serious game\" Econ[u]m : \r\n', 'https://ddemain.com/econum/jeu/'),
('7a3dfea4-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', 'France Num, initiative gouvernementale pour la transformation numérique des TPE/PME, propose un guide sur les logiciels libres tout aussi pertinent pour les organismes publics, accompagné d\'une liste ', 'https://www.francenum.gouv.fr/guides-et-conseils/pilotage-de-lentreprise/logiciels-de-gestion-de-lentreprise/ou-trouver-des'),
('7a3e04c3-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', '- Le comptoir du libre de l\'Adullact :', 'https://comptoir-du-libre.org/fr/ '),
('7a3e07c2-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', '- L\'annuaire du libre Framalibre, et notamment la suite de solutions Framasoft ou encore LibreOffice : ', 'https://framalibre.org/ '),
('7a3e0a62-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', '- Le Socle Interministériel de Logiciels Libres d\'Etalab (DINUM) : ', 'https://sill.etalab.gouv.fr/fr/software'),
('7a3e0ce6-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', 'Voir également le projet EOLE, développé par le Pôle de Compétence Logiciels libres du Ministère de l’Éducation, avec le soutien du Ministère de la Transition écologique et solidaire, qui vise à favor', 'https://pcll.ac-dijon.fr/eole/'),
('9fbff705-4bcc-11ee-b615-0cc47a39c2c2', '5e1b49da-06bd-11ee-b776-0cc47a39c2c0', 'Des initiatives contribuent à la sensibilisation, voir notamment : \r\n- La Fresque du Numérique : ', 'https://www.fresquedunumerique.org/'),
('9fbffc2c-4bcc-11ee-b615-0cc47a39c2c2', '5e1b49da-06bd-11ee-b776-0cc47a39c2c0', '- Les MOOC de l\'Institut du Numérique Responsable : ', 'https://www.academie-nr.org/'),
('9fc0000a-4bcc-11ee-b615-0cc47a39c2c2', '5e1b49da-06bd-11ee-b776-0cc47a39c2c0', '- Le MOOC de l\'INRIA : ', 'https://www.fun-mooc.fr/fr/cours/impacts-environnementaux-du-numerique/'),
('9fc002ad-4bcc-11ee-b615-0cc47a39c2c2', '5e1b49da-06bd-11ee-b776-0cc47a39c2c0', 'Voir le kit de sensibilisation pour un numérique plus responsable au travail de l\'ADEME : ', 'https://longuevieauxobjets.gouv.fr/entreprise/numerique-responsable/kit'),
('9fc00529-4bcc-11ee-b615-0cc47a39c2c2', '5e1b49da-06bd-11ee-b776-0cc47a39c2c0', '- Le \"serious game\" Econ[u]m : ', 'https://ddemain.com/econum/jeu/'),
('b722e253-4bcc-11ee-b615-0cc47a39c2c2', '1002624a-09ba-11ee-b881-0cc47a39c2c2', 'Voir le Programme de Micro-Learning en accès libre sur les achats durables mis à disposition via le réseau RAPIDD : ', 'https://rapidd.developpement-durable.gouv.fr/article/8231'),
('b722e8c0-4bcc-11ee-b615-0cc47a39c2c2', '1002624a-09ba-11ee-b881-0cc47a39c2c2', 'Voir le cours sur la communication responsable en libre accès proposé par l\'AACC et l’ADEME : ', 'https://www.aacc.fr/actualites-et-evenements/commissions/rse/communication-responsable'),
('d7ec5d67-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', 'Référentiel Général d\'Écoconception des Services Numériques (RGESN) co-rédigé par la Direction interministérielle du numérique (DINUM) et le ministère de la Transition écologique, mais aussi l\'ADEME (', 'https://ecoresponsable.numerique.gouv.fr/publications/referentiel-general-ecoconception/'),
('d7ec64f5-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', 'Norme AFNOR SPEC 2201, disponible gratuitement sur le site de l\'AFNOR sous réserve de créer un compte utilisateur : \r\n', 'https://www.boutique.afnor.org/fr-fr/norme/afnor-spec-2201/ecoconception-des-services-numeriques/fa203506/323315'),
('d7ec6912-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', '115 bonnes pratiques de l\'éco-conception Web du collectif GreenIT (à noter que ce référentiel a été décliné en livre) : \r\nhttps://collectif.greenit.fr/ecoconception-web/115-bonnes-pratiques-eco-concep', 'https://github.com/cnumr/best-practices'),
('d7ec6d41-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', 'Référentiel du CNRS \"Je code : les bonnes pratiques en éco-conception de  service numérique à destination des développeurs de logiciels\" : \r\n', 'https://hal.science/hal-03009741v5/document'),
('d7ec7209-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', 'Guide d’éco-conception de services numériques des Designers Éthiques : \r\n', 'https://eco-conception.designersethiques.org/guide/fr/'),
('d7ec7507-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', 'Pour aller plus loin (numérique responsable tenant compte des volets sociaux et économiques en plus des considérations environnementales) : \r\n- au GR491, le guide de référence de conception responsabl', 'https://gr491.isit-europe.org/'),
('d7ec77e3-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', 'Pour en vérifier la bonne application, voir les outils suivants : - ecoIndex (outil en ligne du collectif GreenIT) :  ', 'https://www.ecoindex.fr/'),
('d7ec7ab5-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', '- Kastor (outil en ligne basé sur le référentiel de l\'INR) ; ', 'https://kastor.green/'),
('d7ec7d83-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', '- NumÉcoDiag (outil d\'audit basé sur le RGESN) ; ', 'https://ecoresponsable.numerique.gouv.fr/publications/referentiel-general-ecoconception/numecodiag/'),
('d7ec804d-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', '- ecometer (outil en ligne développé avec le soutien de l\'ADEME) ; ', 'http://ecometer.org/'),
('d7ec8313-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', '- GreenIT-Analysis (outil d\'analyse automatisée - extension navigateur) ;', ''),
('d7ec85d3-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', '- Lighthouse (outil d\'analyse automatisée - extension navigateur) ;', ''),
('d7ec89a2-4bc4-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', '- Yellow Lab Tools (site web : - outil d\'analyse automatisée). ', 'https://yellowlab.tools/');

-- --------------------------------------------------------

--
-- Structure de la table `recommandation_status`
--

DROP TABLE IF EXISTS `recommandation_status`;
CREATE TABLE IF NOT EXISTS `recommandation_status` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recommandation_status`
--

INSERT INTO `recommandation_status` (`Id`, `label`) VALUES
(0, 'Planifiée'),
(1, 'En cours'),
(2, 'Réalisée'),
(3, 'À planifier'),
(4, 'À définir');

-- --------------------------------------------------------

--
-- Structure de la table `recommandation_success_indicator`
--

DROP TABLE IF EXISTS `recommandation_success_indicator`;
CREATE TABLE IF NOT EXISTS `recommandation_success_indicator` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `recommandation_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_89DE30BB61AAE789` (`recommandation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recommandation_success_indicator`
--

INSERT INTO `recommandation_success_indicator` (`id`, `recommandation_id`, `text`) VALUES
('12d783af-4bcc-11ee-b615-0cc47a39c2c2', '5e13858c-06bd-11ee-b776-0cc47a39c2c0', 'Autorisation du recours à la double SIM encadrée via la charte informatique : oui / non ; '),
('12d789c1-4bcc-11ee-b615-0cc47a39c2c2', '5e13858c-06bd-11ee-b776-0cc47a39c2c0', '% d\'utilisateurs ayant recours à la double SIM ; '),
('12d78d2d-4bcc-11ee-b615-0cc47a39c2c2', '5e13858c-06bd-11ee-b776-0cc47a39c2c0', '% d’agents équipés d’un smartphone professionnel ; '),
('1b381caa-4bd1-11ee-b615-0cc47a39c2c2', '5e1e6525-06bd-11ee-b776-0cc47a39c2c0', '% de papiers recyclés et/ou écolabellisés'),
('1b3821a6-4bd1-11ee-b615-0cc47a39c2c2', '5e1e6525-06bd-11ee-b776-0cc47a39c2c0', '% de cartouches d\'encre et toner issus du réemploi ou de la réutilisation ; '),
('1b4d8d9c-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Existence de la documentation : oui / non ; '),
('1b4d93cc-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Durée de vie moyenne des équipements numériques ;'),
('1b4d987d-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Durée de vie moyenne des équipements par type ; '),
('1b4d9d0d-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Durée de vie moyenne des équipements par modèle ; '),
('1b4da0ff-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Durée effective d’utilisation des matériels ; '),
('1b4da4c5-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Durée de garantie souscrite (minimum pris en compte à l’achat) ; '),
('1b4daaec-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Taux de casse par an ;'),
('1b4dafaa-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', '% de retours SAV ;'),
('1b4db3cd-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Nombre de réparations réalisées sur une période donnée ; '),
('1b4db798-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Nombre d\'équipements informatiques remis en état ou à niveau ;'),
('1b4dbb57-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', '% des DEEE évités par les remises en état / à niveau par rapport au poids total des DEEE générés ;'),
('1b4dbf0c-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Taux de panne des équipements par modèle et par an ;'),
('1b4dc2ae-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Taux de remplacement des matériels ; '),
('1b4dc64e-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Taux de remplacement en lien avec la durée de garantie ; '),
('1b4dc9e7-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', '% du parc numérique mis à niveau plutôt que renouvelé/durée moyenne de l\'allongement en résultant ; '),
('1b4dceec-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Nombre, pourcentage et/ou poids des matériels en état qui ont été donnés ou vendus ;'),
('1b4dd2af-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Présence d\'une stratégie de décommissionnement des équipements numériques : oui / non'),
('1b4dd646-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Présence d\'une stratégie de décommissionnement des services numériques : oui / non'),
('1b4dd9d9-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Indice de réparabilité des équipements numériques acquis ; '),
('1b4ddd6c-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', '% du parc numérique issu du réemploi ou de la réutilisation ou contenant des matériaux recyclés ;'),
('1b4de100-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', '% de solutions logicielles et applications écoconçues ; '),
('1b4de497-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', '% d\'équipements numériques écolabellisés ; '),
('1b4de830-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', '% d\'équipements numériques loués ; '),
('1b4debc1-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Quantité qu\'équipements numériques non-attribués '),
('1b4def54-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Taux d\'équipement moyen des utilisateurs ;'),
('1b4df2da-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Nombre moyen d’écrans par utilisateur ;'),
('1b4df724-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Taille moyenne des écrans ; '),
('1b4dfac2-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Durée moyenne de stockage des équipements ; '),
('1b4dfe4e-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', '% d’agents équipés d’un smartphone/téléphone professionnel ; '),
('1b4e01e1-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', '% d\'utilisateurs ayant recours à la pratique du BYOD ; '),
('1b4e05d5-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', '% d\'utilisateurs ayant recours à la double SIM ; '),
('1b4e0973-4bd3-11ee-b615-0cc47a39c2c2', '10025f8d-09ba-11ee-b881-0cc47a39c2c2', 'Taux moyen de renouvellement des équipements numériques ; '),
('1d94b9e5-4bc3-11ee-b615-0cc47a39c2c2', '5e0d96a4-06bd-11ee-b776-0cc47a39c2c0', '% d\'électricité issue d\'énergies primaires renouvelables ;'),
('25a72232-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', 'Durée de vie moyenne des équipements numériques ;'),
('25a72727-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', 'Durée de vie moyenne des équipements par type ; '),
('25a72afe-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', 'Durée de vie moyenne des équipements par modèle ; '),
('25a72fbc-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', 'Durée effective d’utilisation des matériels ; '),
('25a732e9-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', '% équipements protégés ;'),
('25a73671-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', 'Taux de casse par an ;'),
('25a73aaa-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', '% de retours SAV ;'),
('25a73d27-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', 'Nombre de réparations réalisées sur une période donnée ; '),
('25a73f81-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', 'Taux de panne des équipements par modèle et par an ;'),
('25a7427f-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', 'Taux de remplacement des matériels ; '),
('25a744ee-4bcf-11ee-b615-0cc47a39c2c2', '5e13362e-06bd-11ee-b776-0cc47a39c2c0', 'Taux moyen de renouvellement des équipements numériques ; '),
('2f5c593e-4bc5-11ee-b615-0cc47a39c2c2', '5e26131f-06bd-11ee-b776-0cc47a39c2c0', 'Impact environnemental/score des services numériques'),
('360b1ad9-1c59-11f0-85e4-0242ac11000b', '5e11ca07-06bd-11ee-b776-0cc47a39c2c0', '% de papiers recyclés et/ou écolabellisés'),
('360b2997-1c59-11f0-85e4-0242ac11000b', '5e11ca07-06bd-11ee-b776-0cc47a39c2c0', '% de cartouches d\'encre et toner issus du réemploi ou de la réutilisation ;'),
('4e53390a-4bc7-11ee-b615-0cc47a39c2c2', '5e176a1a-06bd-11ee-b776-0cc47a39c2c0', 'Nombre d\'agents et autres personnels, ainsi que d\'élus et autres membres des instances délibérantes sensibilisés ;'),
('4e533d25-4bc7-11ee-b615-0cc47a39c2c2', '5e176a1a-06bd-11ee-b776-0cc47a39c2c0', ' Sensibilisation sur les impacts environnementaux du numérique des nouveaux arrivants dans l\'organisation : oui / non ;'),
('670054ae-4bd4-11ee-b615-0cc47a39c2c2', '5e0d4df5-06bd-11ee-b776-0cc47a39c2c0', 'Consommation d\'électricité moyenne ; '),
('670058fa-4bd4-11ee-b615-0cc47a39c2c2', '5e0d4df5-06bd-11ee-b776-0cc47a39c2c0', 'Part du SI dans la consommation totale d\'énergie ;'),
('6aaa9171-4bcc-11ee-b615-0cc47a39c2c2', '5e1b49da-06bd-11ee-b776-0cc47a39c2c0', 'Nombre de personnes formées ; '),
('6aaa95f6-4bcc-11ee-b615-0cc47a39c2c2', '5e1b49da-06bd-11ee-b776-0cc47a39c2c0', 'Certificat de formation ou de connaissances des personnes chargées de la démarche ;'),
('7ff40763-4be5-11ee-b615-0cc47a39c2c2', '5e2474eb-06bd-11ee-b776-0cc47a39c2c0', 'Consommation d\'électricité moyenne ; '),
('7ff40c66-4be5-11ee-b615-0cc47a39c2c2', '5e2474eb-06bd-11ee-b776-0cc47a39c2c0', 'Part du SI dans la consommation totale d\'énergie ;'),
('8ac3b854-4be1-11ee-b615-0cc47a39c2c2', '036c12fc-4b00-11ee-b615-0cc47a39c2c2', 'Nombre moyen d\'impressions/utilisateur sur une période donnée ;'),
('8ac3bd7d-4be1-11ee-b615-0cc47a39c2c2', '036c12fc-4b00-11ee-b615-0cc47a39c2c2', 'Nombre de feuilles, toner et cartouches d\'encre consommés ; '),
('8ac3c494-4be1-11ee-b615-0cc47a39c2c2', '036c12fc-4b00-11ee-b615-0cc47a39c2c2', 'Quantité de papier collectée/recyclée ; '),
('8ac3c7e9-4be1-11ee-b615-0cc47a39c2c2', '036c12fc-4b00-11ee-b615-0cc47a39c2c2', '% du poids du papier collecté par rapport au poids du papier acheté ; '),
('8ac3cabc-4be1-11ee-b615-0cc47a39c2c2', '036c12fc-4b00-11ee-b615-0cc47a39c2c2', 'Durée de vie moyenne des imprimantes, scanners ; '),
('a3852c7d-4bc5-11ee-b615-0cc47a39c2c2', '5e23c64a-06bd-11ee-b776-0cc47a39c2c0', 'Existence de la documentation : oui/non ; '),
('a3853098-4bc5-11ee-b615-0cc47a39c2c2', '5e23c64a-06bd-11ee-b776-0cc47a39c2c0', 'Quantité qu\'équipements numériques non-attribués'),
('a3853420-4bc5-11ee-b615-0cc47a39c2c2', '5e23c64a-06bd-11ee-b776-0cc47a39c2c0', 'Taux d\'équipement moyen des utilisateurs ;'),
('a38536e8-4bc5-11ee-b615-0cc47a39c2c2', '5e23c64a-06bd-11ee-b776-0cc47a39c2c0', 'Nombre d’écrans par utilisateur ;'),
('a3853968-4bc5-11ee-b615-0cc47a39c2c2', '5e23c64a-06bd-11ee-b776-0cc47a39c2c0', 'Taille moyenne des écrans ;'),
('a3853baa-4bc5-11ee-b615-0cc47a39c2c2', '5e23c64a-06bd-11ee-b776-0cc47a39c2c0', '% d’équipements en stock ;'),
('a3853dc7-4bc5-11ee-b615-0cc47a39c2c2', '5e23c64a-06bd-11ee-b776-0cc47a39c2c0', 'Durée moyenne de stockage des équipements ;'),
('a385406b-4bc5-11ee-b615-0cc47a39c2c2', '5e23c64a-06bd-11ee-b776-0cc47a39c2c0', '% d’agents équipés d’un smartphone/téléphone professionnel ;'),
('a51da9cc-4be6-11ee-b615-0cc47a39c2c2', '5e0d053a-06bd-11ee-b776-0cc47a39c2c0', 'Documentation mise en place : oui/non ;'),
('b087ef9b-4be3-11ee-b615-0cc47a39c2c2', '5e24dd53-06bd-11ee-b776-0cc47a39c2c0', '% d\'équipements numériques loués ; '),
('b4ccb979-4bd0-11ee-b615-0cc47a39c2c2', '5e1e096e-06bd-11ee-b776-0cc47a39c2c0', '% du parc numérique issu du réemploi ou de la réutilisation ou contenant des matériaux recyclés ;'),
('b4ccbdcc-4bd0-11ee-b615-0cc47a39c2c2', '5e1e096e-06bd-11ee-b776-0cc47a39c2c0', '% des achats annuels HT des catégories de produits concernés ; '),
('b4ccc094-4bd0-11ee-b615-0cc47a39c2c2', '5e1e096e-06bd-11ee-b776-0cc47a39c2c0', '% de solutions logicielles et applications écoconçues ; '),
('b4ccc304-4bd0-11ee-b615-0cc47a39c2c2', '5e1e096e-06bd-11ee-b776-0cc47a39c2c0', '% d\'équipements numériques écolabellisés ; '),
('b4ccc5e7-4bd0-11ee-b615-0cc47a39c2c2', '5e1e096e-06bd-11ee-b776-0cc47a39c2c0', 'Clauses intégrées dans le cadre des marchés numériques : oui/non'),
('b4ccc811-4bd0-11ee-b615-0cc47a39c2c2', '5e1e096e-06bd-11ee-b776-0cc47a39c2c0', '% d\'équipements numériques loués ; '),
('b4ccca36-4bd0-11ee-b615-0cc47a39c2c2', '5e1e096e-06bd-11ee-b776-0cc47a39c2c0', 'Objectifs liés aux achats numériques : oui/non'),
('b4cccc5c-4bd0-11ee-b615-0cc47a39c2c2', '5e1e096e-06bd-11ee-b776-0cc47a39c2c0', 'Indice de réparabilité des équipements numériques acquis ; '),
('b4ccce86-4bd0-11ee-b615-0cc47a39c2c2', '5e1e096e-06bd-11ee-b776-0cc47a39c2c0', 'Durée de garantie souscrite (minimum pris en compte à l’achat) ;'),
('bffa8613-4bc7-11ee-b615-0cc47a39c2c2', '100274d4-09ba-11ee-b881-0cc47a39c2c2', 'Autorisation de l\'utilisation du matériel professionnel à des fins personnelles encadrée via la charte informatique : oui / non ;'),
('bffa8aaf-4bc7-11ee-b615-0cc47a39c2c2', '100274d4-09ba-11ee-b881-0cc47a39c2c2', 'Autorisation de la pratique du BYOD encadrée via la charte informatique : oui / non ;'),
('bffa8daf-4bc7-11ee-b615-0cc47a39c2c2', '100274d4-09ba-11ee-b881-0cc47a39c2c2', '% d\'utilisateurs ayant recours à la pratique du BYOD ;'),
('bffa9050-4bc7-11ee-b615-0cc47a39c2c2', '100274d4-09ba-11ee-b881-0cc47a39c2c2', '% d’agents équipés d’un smartphone professionnel ;'),
('c2b3f371-4bcc-11ee-b615-0cc47a39c2c2', '1002624a-09ba-11ee-b881-0cc47a39c2c2', 'Nombre de personnes formées ; '),
('c2b3f7c8-4bcc-11ee-b615-0cc47a39c2c2', '1002624a-09ba-11ee-b881-0cc47a39c2c2', 'Certificat de formation ou de connaissances des personnes chargées de la démarche ;'),
('c7892757-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', 'Durée de vie moyenne des équipements numériques ;'),
('c7892d25-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', 'Durée de vie moyenne des équipements par type ;'),
('c7893024-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', 'Durée de vie moyenne des équipements par modèle ;'),
('c78932bc-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', 'Durée effective d’utilisation des matériels ; '),
('c7893538-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', 'Taux de remplacement des matériels ; '),
('c78937a1-4bce-11ee-b615-0cc47a39c2c2', '5e1718ce-06bd-11ee-b776-0cc47a39c2c0', 'Taux moyen de renouvellement des équipements numériques ; '),
('e5200b93-4bd4-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Nombre, pourcentage et/ou poids des matériels en état qui ont été donnés ou vendus ;'),
('e52010ff-4bd4-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Taux de remplacement des matériels ; '),
('e5201534-4bd4-11ee-b615-0cc47a39c2c2', '5e252e66-06bd-11ee-b776-0cc47a39c2c0', 'Taux moyen de renouvellement des équipements numériques ;');

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `code` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`code`, `name`) VALUES
('1', 'Guadeloupe'),
('11', 'Île-de-France'),
('2', 'Martinique'),
('24', 'Centre-Val de Loire'),
('27', 'Bourgogne-Franche-Comté'),
('28', 'Normandie'),
('3', 'Guyane'),
('32', 'Hauts-de-France'),
('4', 'La Réunion'),
('44', 'Grand Est'),
('52', 'Pays de la Loire'),
('53', 'Bretagne'),
('6', 'Mayotte'),
('75', 'Nouvelle-Aquitaine'),
('76', 'Occitanie'),
('84', 'Auvergne-Rhône-Alpes'),
('93', 'Provence-Alpes-Côte d’Azur'),
('94', 'Corse');

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `selector` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `collectivite_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `score` int NOT NULL,
  `scored_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `category_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`),
  KEY `IDX_32993751A7991F51` (`collectivite_id`),
  KEY `IDX_3299375112469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `label` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `sort_order` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9775E70812469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `label`, `category_id`, `sort_order`) VALUES
('0', NULL, NULL, 0),
('b11043a2-0453-11ee-b776-0cc47a39c2c0', 'Connaissance du parc numérique', '8444bdb4-432a-11ed-af88-040300000000', 1),
('b11106a0-0453-11ee-b776-0cc47a39c2c0', 'Allongement de la durée de vie ', '8444bdb4-432a-11ed-af88-040300000000', 2),
('b111b80e-0453-11ee-b776-0cc47a39c2c0', 'Énergie et impact environnemental', '8444bdb4-432a-11ed-af88-040300000000', 3),
('b112172d-0453-11ee-b776-0cc47a39c2c0', 'Déchets d\'Équipements Électriques et Électroniques (DEEE ou D3E)', '8444bdb4-432a-11ed-af88-040300000000', 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collectivite_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `admin_collectivite` tinyint(1) NOT NULL,
  `token` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `cgu_checked` tinyint(1) NOT NULL DEFAULT '0',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `admin_opsn` tinyint(1) NOT NULL DEFAULT '0',
  `super_admin` tinyint(1) NOT NULL DEFAULT '0',
  `opsn_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `is_vu` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  KEY `IDX_8D93D649A7991F51` (`collectivite_id`),
  KEY `IDX_8D93D649173BE8BE` (`opsn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `last_name`, `first_name`, `password`, `collectivite_id`, `admin_collectivite`, `token`, `username`, `active`, `cgu_checked`, `verified`, `admin_opsn`, `super_admin`, `opsn_id`, `is_vu`) VALUES
('a75b0e12-5b02-11f0-9376-3822e20d3cc2', 'demo@demo.fr', 'demo', 'demo', NULL, '404', 1, NULL, 'demo.demo', 1, 1, 1, 1, 1, '404', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_preference`
--

DROP TABLE IF EXISTS `user_preference`;
CREATE TABLE IF NOT EXISTS `user_preference` (
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `json` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`,`code`),
  KEY `IDX_FA0E76BFA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `FK_DADD4A25AA0960C5` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `collectivite`
--
ALTER TABLE `collectivite`
  ADD CONSTRAINT `FK_CFA408A1839E14D2` FOREIGN KEY (`departement_id`) REFERENCES `departement` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_CFA408A19C5891A6` FOREIGN KEY (`type_id`) REFERENCES `collectivite_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_CFA408A1BF07875A` FOREIGN KEY (`opsn_id`) REFERENCES `opsn` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_CFA408A1BF77FE2D` FOREIGN KEY (`link_demand_id`) REFERENCES `opsn` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `collectivite_answer`
--
ALTER TABLE `collectivite_answer`
  ADD CONSTRAINT `FK_85E830175E1EF114` FOREIGN KEY (`collectivite_id`) REFERENCES `collectivite` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_85E83017A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_85E83017CDFE3796` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `collectivite_status`
--
ALTER TABLE `collectivite_status`
  ADD CONSTRAINT `FK_1E527E2161AAE789` FOREIGN KEY (`recommandation_id`) REFERENCES `recommandation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_24351F2E6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `recommandation_status` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_24351F2EA7991F51` FOREIGN KEY (`collectivite_id`) REFERENCES `collectivite` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `FK_C1765B63AEB327AF` FOREIGN KEY (`region_code`) REFERENCES `region` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_BF5476CA4FB6A46E` FOREIGN KEY (`collectivite_id`) REFERENCES `collectivite` (`id`),
  ADD CONSTRAINT `FK_BF5476CA9777D11E` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `opsn_departement`
--
ALTER TABLE `opsn_departement`
  ADD CONSTRAINT `FK_BC35EDDF839E14D2` FOREIGN KEY (`departement_code`) REFERENCES `departement` (`code`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_DB4914C6173BE8BE` FOREIGN KEY (`opsn_id`) REFERENCES `opsn` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `population`
--
ALTER TABLE `population`
  ADD CONSTRAINT `FK_B449A008DC4E869` FOREIGN KEY (`collectivite_type_id`) REFERENCES `collectivite_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_B6F7494E4F0C9D89` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_B6F7494EA7E9AA83` FOREIGN KEY (`parent_id`) REFERENCES `question` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_B6F7494EBDA9E152` FOREIGN KEY (`parent_answer_id`) REFERENCES `answer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `recommandation`
--
ALTER TABLE `recommandation`
  ADD CONSTRAINT `FK_C7782A285FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `recommandation_level` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_C7782A286BF700BD` FOREIGN KEY (`status_id`) REFERENCES `recommandation_status` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_C7782A28AA0960C5` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `recommandation_answer`
--
ALTER TABLE `recommandation_answer`
  ADD CONSTRAINT `FK_C4D2A9D661AAE789` FOREIGN KEY (`recommandation_id`) REFERENCES `recommandation` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_C4D2A9D6AA334807` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `recommandation_custom`
--
ALTER TABLE `recommandation_custom`
  ADD CONSTRAINT `FK_74EADD021E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_74EADD0261AAE789` FOREIGN KEY (`recommandation_id`) REFERENCES `recommandation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_74EADD02A7991F51` FOREIGN KEY (`collectivite_id`) REFERENCES `collectivite` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `recommandation_perso`
--
ALTER TABLE `recommandation_perso`
  ADD CONSTRAINT `FK_6DBFAEF51E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `FK_6DBFAEF55FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `recommandation_level` (`id`),
  ADD CONSTRAINT `FK_6DBFAEF56BF700BD` FOREIGN KEY (`status_id`) REFERENCES `recommandation_status` (`Id`),
  ADD CONSTRAINT `FK_6DBFAEF5A7991F51` FOREIGN KEY (`collectivite_id`) REFERENCES `collectivite` (`id`);

--
-- Contraintes pour la table `recommandation_resource`
--
ALTER TABLE `recommandation_resource`
  ADD CONSTRAINT `FK_10A45F1361AAE789` FOREIGN KEY (`recommandation_id`) REFERENCES `recommandation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `recommandation_success_indicator`
--
ALTER TABLE `recommandation_success_indicator`
  ADD CONSTRAINT `FK_89DE30BB61AAE789` FOREIGN KEY (`recommandation_id`) REFERENCES `recommandation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `FK_3299375112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_329937515E1EF114` FOREIGN KEY (`collectivite_id`) REFERENCES `collectivite` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `FK_9775E708330B72B5` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649173BE8BE` FOREIGN KEY (`opsn_id`) REFERENCES `opsn` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_8D93D6495E1EF114` FOREIGN KEY (`collectivite_id`) REFERENCES `collectivite` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `user_preference`
--
ALTER TABLE `user_preference`
  ADD CONSTRAINT `FK_FA0E76BF8290D882` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
