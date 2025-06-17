<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250616115727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recommandation_perso (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', question_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', level_id SMALLINT UNSIGNED DEFAULT 1 NOT NULL, status_id INT DEFAULT 4 NOT NULL, title VARCHAR(5000) NOT NULL, body LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_6DBFAEF51E27F6BF (question_id), INDEX IDX_6DBFAEF55FB14BA7 (level_id), INDEX IDX_6DBFAEF56BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recommandation_perso ADD CONSTRAINT FK_6DBFAEF51E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE recommandation_perso ADD CONSTRAINT FK_6DBFAEF55FB14BA7 FOREIGN KEY (level_id) REFERENCES recommandation_level (id)');
        $this->addSql('ALTER TABLE recommandation_perso ADD CONSTRAINT FK_6DBFAEF56BF700BD FOREIGN KEY (status_id) REFERENCES recommandation_status (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recommandation_perso DROP FOREIGN KEY FK_6DBFAEF51E27F6BF');
        $this->addSql('ALTER TABLE recommandation_perso DROP FOREIGN KEY FK_6DBFAEF55FB14BA7');
        $this->addSql('ALTER TABLE recommandation_perso DROP FOREIGN KEY FK_6DBFAEF56BF700BD');
        $this->addSql('DROP TABLE recommandation_perso');
    }
}
