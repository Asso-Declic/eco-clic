<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002163818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recommandation_resource ADD CONSTRAINT FK_10A45F1361AAE789 FOREIGN KEY (recommandation_id) REFERENCES recommandation (id)');
        $this->addSql('CREATE INDEX IDX_10A45F1361AAE789 ON recommandation_resource (recommandation_id)');
        $this->addSql('ALTER TABLE recommandation_success_indicator ADD CONSTRAINT FK_89DE30BB61AAE789 FOREIGN KEY (recommandation_id) REFERENCES recommandation (id)');
        $this->addSql('CREATE INDEX IDX_89DE30BB61AAE789 ON recommandation_success_indicator (recommandation_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recommandation_resource DROP FOREIGN KEY FK_10A45F1361AAE789');
        $this->addSql('DROP INDEX IDX_10A45F1361AAE789 ON recommandation_resource');
        $this->addSql('ALTER TABLE recommandation_success_indicator DROP FOREIGN KEY FK_89DE30BB61AAE789');
        $this->addSql('DROP INDEX IDX_89DE30BB61AAE789 ON recommandation_success_indicator');
    }
}
