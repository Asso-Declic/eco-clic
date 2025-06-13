<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002133006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adaptation suite à un nouvel import de l\'ancien code';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE answer CHANGE ponderation ponderation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recommandation CHANGE TitreReco short_title VARCHAR(255) DEFAULT NULL, CHANGE Detail details LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE answer CHANGE ponderation ponderation INT NOT NULL');
        $this->addSql('ALTER TABLE recommandation CHANGE short_title TitreReco VARCHAR(500) NOT NULL, CHANGE details Detail LONGTEXT DEFAULT NULL');
    }
}
