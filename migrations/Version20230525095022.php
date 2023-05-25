<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525095022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'On met à jour RecommandationLevel et on crée RecommandationStatus';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX StatutReco ON recommandation');
        $this->addSql('RENAME TABLE ref_StatutReco to recommandation_status');
        $this->addSql('ALTER TABLE `recommandation` RENAME COLUMN StatutReco TO status_id');
        $this->addSql('ALTER TABLE recommandation ADD CONSTRAINT FK_C7782A286BF700BD FOREIGN KEY (status_id) REFERENCES recommandation_status (id)');
        $this->addSql('CREATE INDEX IDX_C7782A286BF700BD ON recommandation (status_id)');

        $this->addSql('ALTER TABLE recommandation_level CHANGE Couleur color VARCHAR(20) DEFAULT NULL');

        $this->addSql('ALTER TABLE recommandation CHANGE status_id status_id INT DEFAULT 4 NOT NULL');
        $this->addSql('ALTER TABLE recommandation_status CHANGE Label label VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recommandation_status CHANGE label Label VARCHAR(50) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`');
        $this->addSql('ALTER TABLE recommandation CHANGE status_id status_id INT DEFAULT 4');

        $this->addSql('ALTER TABLE recommandation_level CHANGE color Couleur VARCHAR(20) DEFAULT NULL');

        $this->addSql('ALTER TABLE recommandation DROP FOREIGN KEY FK_C7782A286BF700BD');
        $this->addSql('DROP INDEX IDX_C7782A286BF700BD ON recommandation');
        $this->addSql('ALTER TABLE `recommandation` RENAME COLUMN status_id TO StatutReco');
        $this->addSql('RENAME TABLE recommandation_status to ref_StatutReco');
        $this->addSql('CREATE INDEX StatutReco ON recommandation (StatutReco)');
    }
}
