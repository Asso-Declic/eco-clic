<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609144411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Renommage des trois propriétés de gestion des rôles d\'un utilisateur';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `user` RENAME COLUMN `admin` TO admin_collectivite');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN super_admin TO admin_opsn');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN super_admin2 TO super_admin');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `user` RENAME COLUMN super_admin TO super_admin2');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN admin_opsn TO super_admin');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN admin_collectivite TO `admin`');
    }
}
