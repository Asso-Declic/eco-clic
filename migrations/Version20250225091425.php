<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250225091425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, collectivite_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', category_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', posted_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_vu TINYINT(1) NOT NULL, INDEX IDX_BF5476CA4FB6A46E (collectivite_id_id), INDEX IDX_BF5476CA9777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA4FB6A46E FOREIGN KEY (collectivite_id_id) REFERENCES collectivite (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE patch_note CHANGE posted_at posted_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA4FB6A46E');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA9777D11E');
        $this->addSql('DROP TABLE notification');
        $this->addSql('ALTER TABLE patch_note CHANGE posted_at posted_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
