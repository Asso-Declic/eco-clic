<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515210707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Suppression des redondances dans 2 tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE collectivite_answer DROP IdQuestion');
        $this->addSql('ALTER TABLE recommandation DROP IdCategorie');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE collectivite_answer ADD IdQuestion CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE recommandation ADD IdCategorie CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
    }
}
