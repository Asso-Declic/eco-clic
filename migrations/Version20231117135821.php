<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117135821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patch_note ADD id INT AUTO_INCREMENT NOT NULL, CHANGE title title VARCHAR(500) NOT NULL, CHANGE body body LONGTEXT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE recommandation_answer RENAME INDEX idx_c4d2a9d661aae789 TO IDX_5BB381BC61AAE789');
        $this->addSql('ALTER TABLE recommandation_answer RENAME INDEX idx_c4d2a9d6aa334807 TO IDX_5BB381BCAA334807');
        $this->addSql('ALTER TABLE user DROP info_isVu');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patch_note MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON patch_note');
        $this->addSql('ALTER TABLE patch_note DROP id, CHANGE title title VARCHAR(500) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE body body VARCHAR(5000) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE recommandation_answer RENAME INDEX idx_5bb381bc61aae789 TO IDX_C4D2A9D661AAE789');
        $this->addSql('ALTER TABLE recommandation_answer RENAME INDEX idx_5bb381bcaa334807 TO IDX_C4D2A9D6AA334807');
        $this->addSql('ALTER TABLE user ADD info_isVu TINYINT(1) DEFAULT 0 NOT NULL');
    }
}
