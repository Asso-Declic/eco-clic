<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230811141337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout des ressources et indicateurs de recommandations';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE recommandation_resource (id INT AUTO_INCREMENT NOT NULL, recommandation_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', title VARCHAR(255) NOT NULL, link LONGTEXT NOT NULL, INDEX IDX_10A45F1361AAE789 (recommandation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recommandation_success_indicator (id INT AUTO_INCREMENT NOT NULL, recommandation_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', text LONGTEXT NOT NULL, INDEX IDX_89DE30BB61AAE789 (recommandation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recommandation_resource ADD CONSTRAINT FK_10A45F1361AAE789 FOREIGN KEY (recommandation_id) REFERENCES recommandation (id)');
        $this->addSql('ALTER TABLE recommandation_success_indicator ADD CONSTRAINT FK_89DE30BB61AAE789 FOREIGN KEY (recommandation_id) REFERENCES recommandation (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recommandation_resource DROP FOREIGN KEY FK_10A45F1361AAE789');
        $this->addSql('ALTER TABLE recommandation_success_indicator DROP FOREIGN KEY FK_89DE30BB61AAE789');
        $this->addSql('DROP TABLE recommandation_resource');
        $this->addSql('DROP TABLE recommandation_success_indicator');
    }
}
