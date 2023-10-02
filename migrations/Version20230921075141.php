<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230921075141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Suppression de TemporarySiret qui était utilisé pendant la phase de test';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP TABLE temporary_siret');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TABLE temporary_siret (Siret CHAR(14) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, Nom VARCHAR(2000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(Siret)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }
}
