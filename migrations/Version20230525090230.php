<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525090230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE question CHANGE IdParent IdParent CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdRepParent IdRepParent CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EA7E9AA83 FOREIGN KEY (IdParent) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBDA9E152 FOREIGN KEY (IdRepParent) REFERENCES answer (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EA7E9AA83 ON question (IdParent)');
        $this->addSql('CREATE INDEX IDX_B6F7494EBDA9E152 ON question (IdRepParent)');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN Ordre TO sort_order');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN IdParent TO parent_id');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN IdRepParent TO parent_answer_id');
        $this->addSql('ALTER TABLE question RENAME INDEX idx_b6f7494ea7e9aa83 TO IDX_B6F7494E727ACA70');
        $this->addSql('ALTER TABLE question RENAME INDEX idx_b6f7494ebda9e152 TO IDX_B6F7494E5B7867E9');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE question RENAME INDEX idx_b6f7494e5b7867e9 TO IDX_B6F7494EBDA9E152');
        $this->addSql('ALTER TABLE question RENAME INDEX idx_b6f7494e727aca70 TO IDX_B6F7494EA7E9AA83');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN sort_order TO Ordre');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN parent_id TO IdParent');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN parent_answer_id TO IdRepParent');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EA7E9AA83');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EBDA9E152');
        $this->addSql('DROP INDEX IDX_B6F7494EA7E9AA83 ON question');
        $this->addSql('DROP INDEX IDX_B6F7494EBDA9E152 ON question');
        $this->addSql('ALTER TABLE question CHANGE IdParent IdParent CHAR(36) DEFAULT NULL, CHANGE IdRepParent IdRepParent CHAR(36) DEFAULT NULL');

    }
}
