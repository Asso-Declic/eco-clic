<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525081523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Suppression de l\'entité Administrateur';
    }

    public function up(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76BF07875A');
        // $this->addSql('DROP TABLE `admin`');
    }

    public function down(Schema $schema): void
    {
        // $this->addSql('CREATE TABLE `admin` (id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', opsn_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', last_name VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, first_name VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, username VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, active TINYINT(1) NOT NULL, token VARCHAR(2000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, super_admin TINYINT(1) DEFAULT 0 NOT NULL, INDEX IDX_880E0D76173BE8BE (opsn_id), UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        // $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76BF07875A FOREIGN KEY (opsn_id) REFERENCES opsn (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
