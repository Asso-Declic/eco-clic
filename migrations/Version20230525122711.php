<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525122711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Mise à jour de User pour unifier User et Admin';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `user` RENAME COLUMN SuperAdmin TO super_admin');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN SuperAdmin2 TO super_admin2');
        $this->addSql('ALTER TABLE user CHANGE OPSNId opsn_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649173BE8BE FOREIGN KEY (opsn_id) REFERENCES opsn (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649173BE8BE ON user (opsn_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `user` RENAME COLUMN super_admin TO SuperAdmin');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN super_admin2 TO SuperAdmin2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649173BE8BE');
        $this->addSql('DROP INDEX IDX_8D93D649173BE8BE ON user');
        $this->addSql('ALTER TABLE user CHANGE opsn_id OPSNId CHAR(36) DEFAULT NULL');
    }
}
