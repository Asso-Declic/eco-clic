<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230929084227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Changement de OPSN::$phoneNumber en string';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE opsn CHANGE phone_number phone_number VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE opsn CHANGE phone_number phone_number INT DEFAULT NULL');
    }
}
