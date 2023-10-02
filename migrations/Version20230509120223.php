<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509120223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Crée toutes les tables comme le faisait ecoclimprod.sql';
    }

    public function up(Schema $schema): void
    {
        // --------------
        // On installe toute les tables du fichier SQL d'origine
        // --------------
        // $this->addSql('CREATE TABLE `Administrateur` (
        //     `Id` char(36) NOT NULL,
        //     `Nom` varchar(150) NOT NULL,
        //     `Prenom` varchar(150) NOT NULL,
        //     `Identifiant` varchar(300) NOT NULL,
        //     `Mail` varchar(250) NOT NULL,
        //     `MotDePasse` varchar(500) NOT NULL,
        //     `Actif` tinyint(1) NOT NULL,
        //     `Token` varchar(2000) DEFAULT NULL,
        //     `IdMotDePasseOublie` char(36) DEFAULT NULL,
        //     `DateMotDePasseOublie` datetime DEFAULT NULL,
        //     `SuperAdmin` tinyint(1) NOT NULL DEFAULT \'0\',
        //     `OPSNId` char(36) DEFAULT NULL
        //   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
        $this->addSql("CREATE TABLE `categorie` (
            `Id` char(36) NOT NULL,
            `Nom` varchar(200) DEFAULT NULL,
            `Img` varchar(500) DEFAULT NULL,
            `Description` longtext,
            `Ordre` int DEFAULT NULL,
            `Niveau2` tinyint(1) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;");
        $this->addSql("CREATE TABLE `collectivite` (
          `Id` char(36) NOT NULL,
          `Nom` varchar(500) NOT NULL,
          `Population` int NOT NULL,
          `DepartementCode` char(3) NOT NULL,
          `Siret` char(14) DEFAULT NULL,
          `Latitude` varchar(500) DEFAULT NULL,
          `Longitude` varchar(500) DEFAULT NULL,
          `TypeId` char(36) NOT NULL,
          `OPSNId` char(36) DEFAULT NULL,
          `Niveau2` tinyint(1) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;");
        $this->addSql('CREATE TABLE `Departement` (
            `Code` char(3) NOT NULL,
            `Nom` varchar(100) NOT NULL,
            `CodeRegion` int(3) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;');
        $this->addSql('CREATE TABLE `historiqueScore` (
            `CollectiviteId` char(36) NOT NULL,
            `Score` int(3) NOT NULL,
            `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;');
        $this->addSql('CREATE TABLE `OPSN` (
            `Id` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `Nom` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `Mail` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
            `DepartementCode` char(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `Actif` int(1) NOT NULL,
            `Logo` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
            `Telephone` int(11) DEFAULT NULL,
            `Adresse` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
            `Site_Internet` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
            `Siret` char(14) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
            `Latitude` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
            `Longitude` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;');
        $this->addSql('CREATE TABLE `OPSN_Departement` (
            `OPSNId` char(36) NOT NULL,
            `DepartementCode` char(3) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;');
        $this->addSql('CREATE TABLE `preference` (
            `UtilisateurId` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `Code` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `Json` varchar(2000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;');
        $this->addSql("CREATE TABLE `question` (
            `Id` char(36) NOT NULL,
            `Question` varchar(500) DEFAULT NULL,
            `IdTheme` char(36) NOT NULL,
            `IdCategorie` char(36) NOT NULL,
            `Multiple` tinyint(1) NOT NULL DEFAULT '0',
            `Definition` longtext,
            `InfoComplementaire` longtext,
            `Titre_definition` longtext,
            `Ordre` int NOT NULL,
            `IdParent` char(36) DEFAULT NULL,
            `IdRepParent` char(36) DEFAULT NULL,
            `Niveau2` tinyint(1) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;");
        $this->addSql('CREATE TABLE `recommandation` (
            `Id` char(36) NOT NULL,
            `Titre` varchar(5000) DEFAULT NULL,
            `TitreReco` varchar(500) NOT NULL,
            `Text` longtext DEFAULT NULL,
            `Detail` longtext DEFAULT NULL,
            `IdQuestion` char(36) NOT NULL,
            `IdCategorie` char(36) NOT NULL,
            `NiveauReco` int(11) NOT NULL DEFAULT 1,
            `StatutReco` int(11) DEFAULT 4
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;');
        $this->addSql('CREATE TABLE `ref_NiveauReco` (
            `Id` int(11) NOT NULL,
            `Label` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `Couleur` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;');
        $this->addSql('CREATE TABLE `ref_Population` (
            `Id` int(3) NOT NULL,
            `TypeCollectivite` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `MinPop` int(8) NOT NULL,
            `MaxPop` int(8) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;');
        $this->addSql('CREATE TABLE `ref_StatutReco` (
            `Id` int(11) NOT NULL,
            `Label` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;');
        $this->addSql('CREATE TABLE `ref_TypeCollectivite` (
            `Id` char(36) NOT NULL,
            `Nom` varchar(250) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;');
        $this->addSql('CREATE TABLE `Region` (
            `Code` char(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `Nom` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;');
        $this->addSql('CREATE TABLE `reponse` (
            `Id` char(36) NOT NULL,
            `Type` varchar(50) DEFAULT NULL,
            `Text` longtext DEFAULT NULL,
            `IdQuestion` char(36) NOT NULL,
            `Ponderation` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;');
        $this->addSql('CREATE TABLE `Siret_Temporaire` (
            `Siret` char(14) NOT NULL,
            `Nom` varchar(2000) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;');
        $this->addSql('CREATE TABLE `theme` (
            `Id` char(36) NOT NULL,
            `Theme` varchar(500) DEFAULT NULL,
            `IdCategorie` char(36) NOT NULL,
            `Ordre` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;');
        $this->addSql('CREATE TABLE `utilisateur` (
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
            `CGU` tinyint(1) NOT NULL DEFAULT 0,
            `IsVerifie` tinyint(1) NOT NULL DEFAULT 0,
            `SuperAdmin` tinyint(1) NOT NULL DEFAULT 0,
            `SuperAdmin2` tinyint(1) NOT NULL DEFAULT 0,
            `OPSNId` char(36) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;');
        $this->addSql('CREATE TABLE `utilisateurReponse` (
            `Id` char(36) NOT NULL,
            `IdQuestion` char(36) NOT NULL,
            `IdReponse` char(36) NOT NULL,
            `CollectiviteId` char(36) NOT NULL,
            `InputText` longtext DEFAULT NULL,
            `Date` datetime NOT NULL DEFAULT current_timestamp()
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;');
        $this->addSql('CREATE TABLE `utilisateurStatut` (
            `Id` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `RecommandationId` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `UtilisateurId` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
            `StatutCode` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;');
        // --------------
        // Clés primaires
        // --------------
        // $this->addSql('ALTER TABLE `Administrateur`
        //     ADD PRIMARY KEY (`Id`),
        //     ADD KEY `OPSNId` (`OPSNId`),
        //     ADD KEY `Identifiant` (`Identifiant`);');
        $this->addSql('ALTER TABLE `categorie`
            ADD PRIMARY KEY (`Id`);');
        $this->addSql('ALTER TABLE `collectivite`
            ADD PRIMARY KEY (`Id`),
            ADD KEY `OPSNId` (`OPSNId`),
            ADD KEY `TypeId` (`TypeId`);');
        $this->addSql('ALTER TABLE `Departement`
            ADD KEY `Code` (`Code`),
            ADD KEY `CodeRegion` (`CodeRegion`);');
        $this->addSql('ALTER TABLE `historiqueScore`
            ADD KEY `CollectiviteId` (`CollectiviteId`) USING BTREE;');
        $this->addSql('ALTER TABLE `OPSN`
            ADD PRIMARY KEY (`Id`);');
        $this->addSql('ALTER TABLE `OPSN_Departement`
            ADD PRIMARY KEY (`OPSNId`,`DepartementCode`),
            ADD KEY `OPSNId` (`OPSNId`),
            ADD KEY `DepartementCode` (`DepartementCode`);');
        $this->addSql('ALTER TABLE `question`
            ADD PRIMARY KEY (`Id`),
            ADD KEY `IdTheme` (`IdTheme`),
            ADD KEY `IdCategorie` (`IdCategorie`);');
        $this->addSql('ALTER TABLE `recommandation`
            ADD PRIMARY KEY (`Id`),
            ADD KEY `IdCategorie` (`IdQuestion`),
            ADD KEY `IdCategorie_2` (`IdCategorie`),
            ADD KEY `StatutReco` (`StatutReco`);');
        $this->addSql('ALTER TABLE `ref_NiveauReco`
            ADD PRIMARY KEY (`Id`);');
        $this->addSql('ALTER TABLE `ref_Population`
            ADD PRIMARY KEY (`Id`);');
        $this->addSql('ALTER TABLE `ref_StatutReco`
            ADD PRIMARY KEY (`Id`);');
        $this->addSql('ALTER TABLE `ref_TypeCollectivite`
            ADD PRIMARY KEY (`Id`);');
        $this->addSql('ALTER TABLE `Region`
            ADD PRIMARY KEY (`Code`);');
        $this->addSql('ALTER TABLE `reponse`
            ADD PRIMARY KEY (`Id`),
            ADD KEY `IdQuestion` (`IdQuestion`);');
        $this->addSql('ALTER TABLE `Siret_Temporaire`
            ADD PRIMARY KEY (`Siret`);');
        $this->addSql('ALTER TABLE `theme`
            ADD PRIMARY KEY (`Id`),
            ADD KEY `IdCategorie` (`IdCategorie`);');
        $this->addSql('ALTER TABLE `utilisateur`
            ADD PRIMARY KEY (`Id`),
            ADD KEY `CollectiviteId` (`CollectiviteId`);');
        $this->addSql('ALTER TABLE `utilisateurReponse`
            ADD PRIMARY KEY (`Id`),
            ADD KEY `IdQuestion` (`IdQuestion`),
            ADD KEY `IdReponse` (`IdReponse`),
            ADD KEY `IdUtilisateur` (`CollectiviteId`);');
        $this->addSql('ALTER TABLE `utilisateurStatut`
            ADD PRIMARY KEY (`Id`),
            ADD KEY `RecommandationId` (`RecommandationId`) USING BTREE,
            ADD KEY `UtilisateurId` (`UtilisateurId`),
            ADD KEY `StatutCode` (`StatutCode`) USING BTREE;');
    }

    public function down(Schema $schema): void
    {
        // Supprime toutes les tables crées avec la méthode up()
        // $this->addSql('DROP TABLE `Administrateur`');
        $this->addSql('DROP TABLE `categorie`');
        $this->addSql('DROP TABLE `collectivite`');
        $this->addSql('DROP TABLE `Departement`');
        $this->addSql('DROP TABLE `historiqueScore`');
        $this->addSql('DROP TABLE `OPSN`');
        $this->addSql('DROP TABLE `OPSN_Departement`');
        $this->addSql('DROP TABLE `preference`');
        $this->addSql('DROP TABLE `question`');
        $this->addSql('DROP TABLE `recommandation`');
        $this->addSql('DROP TABLE `ref_NiveauReco`');
        $this->addSql('DROP TABLE `ref_Population`');
        $this->addSql('DROP TABLE `ref_StatutReco`');
        $this->addSql('DROP TABLE `ref_TypeCollectivite`');
        $this->addSql('DROP TABLE `Region`');
        $this->addSql('DROP TABLE `reponse`');
        $this->addSql('DROP TABLE `Siret_Temporaire`');
        $this->addSql('DROP TABLE `theme`');
        $this->addSql('DROP TABLE `utilisateur`');
        $this->addSql('DROP TABLE `utilisateurReponse`');
        $this->addSql('DROP TABLE `utilisateurStatut`');
    }
}
