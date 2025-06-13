<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230811115210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adaption pour le niveau 2';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE category CHANGE Niveau2 level_two TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE collectivite CHANGE Niveau2 level_two TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE Niveau2 level_two TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE category CHANGE level_two Niveau2 TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE collectivite CHANGE level_two Niveau2 TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE level_two Niveau2 TINYINT(1) DEFAULT 0 NOT NULL');
    }
}
