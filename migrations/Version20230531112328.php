<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230531112328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajoute une relation entre CollectiviteStatus et RecommandationStatus';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE collectivite_status CHANGE code status_id INT NOT NULL');
        $this->addSql('ALTER TABLE collectivite_status ADD CONSTRAINT FK_24351F2E6BF700BD FOREIGN KEY (status_id) REFERENCES recommandation_status (id)');
        $this->addSql('CREATE INDEX IDX_24351F2E6BF700BD ON collectivite_status (status_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE collectivite_status DROP FOREIGN KEY FK_24351F2E6BF700BD');
        $this->addSql('DROP INDEX IDX_24351F2E6BF700BD ON collectivite_status');
        $this->addSql('ALTER TABLE collectivite_status CHANGE status_id code INT NOT NULL');
    }
}
