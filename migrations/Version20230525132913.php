<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525132913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE departement CHANGE region_code region_code CHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B63AEB327AF FOREIGN KEY (region_code) REFERENCES region (code)');
        $this->addSql('CREATE INDEX IDX_C1765B63AEB327AF ON departement (region_code)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B63AEB327AF');
        $this->addSql('DROP INDEX IDX_C1765B63AEB327AF ON departement');
        $this->addSql('ALTER TABLE departement CHANGE region_code region_code INT NOT NULL');
    }
}
