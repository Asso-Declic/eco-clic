<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607073557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE logs');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE logs (Id INT AUTO_INCREMENT NOT NULL, Username VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, Date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Type VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, Ip VARCHAR(15) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, INDEX UserId (Username), PRIMARY KEY(Id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }
}
