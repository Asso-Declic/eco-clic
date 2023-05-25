<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515211201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE `admin` DROP IdMotDePasseOublie, DROP DateMotDePasseOublie');
        $this->addSql('ALTER TABLE user DROP IdMotDePasseOublie, DROP DateMotDePasseOublie');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE `admin` ADD IdMotDePasseOublie CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', ADD DateMotDePasseOublie DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user ADD IdMotDePasseOublie CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', ADD DateMotDePasseOublie DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
