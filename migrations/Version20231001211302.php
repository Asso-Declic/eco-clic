<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231001211302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de la demande de rattachement à une OPSN';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE collectivite ADD link_demand_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE collectivite ADD CONSTRAINT FK_CFA408A1BF77FE2D FOREIGN KEY (link_demand_id) REFERENCES opsn (id)');
        $this->addSql('CREATE INDEX IDX_CFA408A1BF77FE2D ON collectivite (link_demand_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE collectivite DROP FOREIGN KEY FK_CFA408A1BF77FE2D');
        $this->addSql('DROP INDEX IDX_CFA408A1BF77FE2D ON collectivite');
        $this->addSql('ALTER TABLE collectivite DROP link_demand_id');
    }
}
