<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510152551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Administrateur DROP INDEX Identifiant, ADD UNIQUE INDEX UNIQ_FF8F2A304F98863B (Identifiant)');
        $this->addSql('DROP INDEX OPSNId ON Administrateur');
        $this->addSql('ALTER TABLE Administrateur CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdMotDePasseOublie IdMotDePasseOublie CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE DateMotDePasseOublie DateMotDePasseOublie DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE OPSNId OPSNId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX Code ON Departement');
        $this->addSql('DROP INDEX CodeRegion ON Departement');
        $this->addSql('ALTER TABLE Departement ADD PRIMARY KEY (Code)');
        $this->addSql('ALTER TABLE OPSN CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE Actif Actif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE OPSN_Departement CHANGE OPSNId OPSNId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE OPSN_Departement ADD CONSTRAINT FK_BC35EDDFBF07875A FOREIGN KEY (OPSNId) REFERENCES OPSN (Id)');
        $this->addSql('ALTER TABLE OPSN_Departement ADD CONSTRAINT FK_BC35EDDF839E14D2 FOREIGN KEY (DepartementCode) REFERENCES Departement (Code)');
        $this->addSql('ALTER TABLE OPSN_Departement RENAME INDEX opsnid TO IDX_BC35EDDFBF07875A');
        $this->addSql('ALTER TABLE OPSN_Departement RENAME INDEX departementcode TO IDX_BC35EDDF839E14D2');
        $this->addSql('ALTER TABLE categorie CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX OPSNId ON collectivite');
        $this->addSql('ALTER TABLE collectivite CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE TypeId TypeId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE OPSNId OPSNId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX CollectiviteId ON historiqueScore');
        $this->addSql('ALTER TABLE historiqueScore CHANGE CollectiviteId CollectiviteId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE Date Date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX id ON historiqueScore;');
        $this->addSql('ALTER TABLE preference CHANGE UtilisateurId UtilisateurId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', ADD PRIMARY KEY (UtilisateurId, Code)');
        $this->addSql('DROP INDEX IdCategorie ON question');
        $this->addSql('DROP INDEX IdTheme ON question');
        $this->addSql('ALTER TABLE question CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdTheme IdTheme CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX IdCategorie ON recommandation');
        $this->addSql('DROP INDEX IdCategorie_2 ON recommandation');
        $this->addSql('ALTER TABLE recommandation CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE NiveauReco NiveauReco SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE ref_TypeCollectivite CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX IdQuestion ON reponse');
        $this->addSql('ALTER TABLE reponse CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX IdCategorie ON theme');
        $this->addSql('ALTER TABLE theme CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX CollectiviteId ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE CollectiviteId CollectiviteId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdMotDePasseOublie IdMotDePasseOublie CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE DateMotDePasseOublie DateMotDePasseOublie DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B34F98863B ON utilisateur (Identifiant)');
        $this->addSql('DROP INDEX IdQuestion ON utilisateurReponse');
        $this->addSql('DROP INDEX IdReponse ON utilisateurReponse');
        $this->addSql('DROP INDEX IdUtilisateur ON utilisateurReponse');
        $this->addSql('ALTER TABLE utilisateurReponse CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdReponse IdReponse CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE CollectiviteId CollectiviteId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE Date Date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Administrateur DROP INDEX UNIQ_FF8F2A304F98863B, ADD INDEX Identifiant (Identifiant)');
        $this->addSql('ALTER TABLE Administrateur CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdMotDePasseOublie IdMotDePasseOublie CHAR(36) DEFAULT NULL, CHANGE DateMotDePasseOublie DateMotDePasseOublie DATETIME DEFAULT NULL, CHANGE OPSNId OPSNId CHAR(36) DEFAULT NULL');
        $this->addSql('CREATE INDEX OPSNId ON Administrateur (OPSNId)');
        $this->addSql('CREATE INDEX CodeRegion ON Departement (CodeRegion)');
        $this->addSql('ALTER TABLE OPSN CHANGE Id Id CHAR(36) NOT NULL, CHANGE Actif Actif INT NOT NULL');
        $this->addSql('ALTER TABLE OPSN_Departement DROP FOREIGN KEY FK_BC35EDDFBF07875A');
        $this->addSql('ALTER TABLE OPSN_Departement DROP FOREIGN KEY FK_BC35EDDF839E14D2');
        $this->addSql('ALTER TABLE OPSN_Departement CHANGE OPSNId OPSNId CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE OPSN_Departement RENAME INDEX idx_bc35eddf839e14d2 TO DepartementCode');
        $this->addSql('ALTER TABLE OPSN_Departement RENAME INDEX idx_bc35eddfbf07875a TO OPSNId');
        $this->addSql('ALTER TABLE categorie CHANGE Id Id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE collectivite CHANGE Id Id CHAR(36) NOT NULL, CHANGE TypeId TypeId CHAR(36) NOT NULL, CHANGE OPSNId OPSNId CHAR(36) DEFAULT NULL');
        $this->addSql('CREATE INDEX OPSNId ON collectivite (OPSNId)');
        $this->addSql('DROP INDEX `primary` ON historiqueScore');
        $this->addSql('ALTER TABLE historiqueScore CHANGE CollectiviteId CollectiviteId CHAR(36) NOT NULL, CHANGE Date Date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('CREATE INDEX CollectiviteId ON historiqueScore (CollectiviteId)');
        $this->addSql('DROP INDEX `primary` ON preference');
        $this->addSql('ALTER TABLE preference CHANGE UtilisateurId UtilisateurId CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdTheme IdTheme CHAR(36) NOT NULL, CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL');
        $this->addSql('CREATE INDEX IdCategorie ON question (IdCategorie)');
        $this->addSql('CREATE INDEX IdTheme ON question (IdTheme)');
        $this->addSql('ALTER TABLE recommandation CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL, CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL, CHANGE NiveauReco NiveauReco INT DEFAULT 1 NOT NULL');
        $this->addSql('CREATE INDEX IdCategorie ON recommandation (IdQuestion)');
        $this->addSql('CREATE INDEX IdCategorie_2 ON recommandation (IdCategorie)');
        $this->addSql('ALTER TABLE ref_TypeCollectivite CHANGE Id Id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE reponse CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL');
        $this->addSql('CREATE INDEX IdQuestion ON reponse (IdQuestion)');
        $this->addSql('ALTER TABLE theme CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL');
        $this->addSql('CREATE INDEX IdCategorie ON theme (IdCategorie)');
        $this->addSql('DROP INDEX UNIQ_1D1C63B34F98863B ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur CHANGE Id Id CHAR(36) NOT NULL, CHANGE CollectiviteId CollectiviteId CHAR(36) DEFAULT NULL, CHANGE IdMotDePasseOublie IdMotDePasseOublie CHAR(36) DEFAULT NULL, CHANGE DateMotDePasseOublie DateMotDePasseOublie DATETIME DEFAULT NULL');
        $this->addSql('CREATE INDEX CollectiviteId ON utilisateur (CollectiviteId)');
        $this->addSql('ALTER TABLE utilisateurReponse CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL, CHANGE IdReponse IdReponse CHAR(36) NOT NULL, CHANGE CollectiviteId CollectiviteId CHAR(36) NOT NULL, CHANGE Date Date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('CREATE INDEX IdQuestion ON utilisateurReponse (IdQuestion)');
        $this->addSql('CREATE INDEX IdReponse ON utilisateurReponse (IdReponse)');
        $this->addSql('CREATE INDEX IdUtilisateur ON utilisateurReponse (CollectiviteId)');
    }
}
