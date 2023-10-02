<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002203327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Renommage de la table pivot';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('RENAME TABLE ref_ReponseReco TO recommandation_answer');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('RENAME TABLE recommandation_answer TO ref_ReponseReco');
    }
}
