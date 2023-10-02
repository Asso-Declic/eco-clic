<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231001205241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recommandation_activatable (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recommandation_custom (id INT AUTO_INCREMENT NOT NULL, recommandation_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', collectivite_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', question_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_74EADD0261AAE789 (recommandation_id), INDEX IDX_74EADD02A7991F51 (collectivite_id), INDEX IDX_74EADD021E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recommandation_custom ADD CONSTRAINT FK_74EADD0261AAE789 FOREIGN KEY (recommandation_id) REFERENCES recommandation (id)');
        $this->addSql('ALTER TABLE recommandation_custom ADD CONSTRAINT FK_74EADD02A7991F51 FOREIGN KEY (collectivite_id) REFERENCES collectivite (id)');
        $this->addSql('ALTER TABLE recommandation_custom ADD CONSTRAINT FK_74EADD021E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE opsn CHANGE phone_number phone_number CHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recommandation_custom DROP FOREIGN KEY FK_74EADD0261AAE789');
        $this->addSql('ALTER TABLE recommandation_custom DROP FOREIGN KEY FK_74EADD02A7991F51');
        $this->addSql('ALTER TABLE recommandation_custom DROP FOREIGN KEY FK_74EADD021E27F6BF');
        $this->addSql('DROP TABLE recommandation_activatable');
        $this->addSql('DROP TABLE recommandation_custom');
        $this->addSql('ALTER TABLE opsn CHANGE phone_number phone_number VARCHAR(255) DEFAULT NULL');
    }
}
