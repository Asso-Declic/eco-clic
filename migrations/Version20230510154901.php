<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510154901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'On renomme tous les champs Id en id';
    }

    public function up(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE Administrateur RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE OPSN RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE categorie RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE collectivite RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE question RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE recommandation RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE ref_NiveauReco RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE ref_TypeCollectivite RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE reponse RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE theme RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE utilisateur RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE utilisateurReponse RENAME COLUMN Id TO id');
    }

    public function down(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE Administrateur RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE OPSN RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE categorie RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE collectivite RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE question RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE recommandation RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE ref_NiveauReco RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE ref_TypeCollectivite RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE reponse RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE theme RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE utilisateur RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE utilisateurReponse RENAME COLUMN id TO Id');
    }
}
