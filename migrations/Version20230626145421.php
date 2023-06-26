<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230626145421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'On autorise le theme d\'une question à être null';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE question CHANGE theme_id theme_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE question CHANGE theme_id theme_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
    }
}
