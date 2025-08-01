<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250616120231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recommandation_perso ADD collectivite_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE recommandation_perso ADD CONSTRAINT FK_6DBFAEF5A7991F51 FOREIGN KEY (collectivite_id) REFERENCES collectivite (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6DBFAEF5A7991F51 ON recommandation_perso (collectivite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recommandation_perso DROP FOREIGN KEY FK_6DBFAEF5A7991F51');
        $this->addSql('DROP INDEX UNIQ_6DBFAEF5A7991F51 ON recommandation_perso');
        $this->addSql('ALTER TABLE recommandation_perso DROP collectivite_id');
    }
}
