<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926215720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout des dates de la première et dernière réponse';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE collectivite ADD first_answered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD last_answered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE collectivite DROP first_answered_at, DROP last_answered_at');
    }
}
