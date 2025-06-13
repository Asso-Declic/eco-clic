<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525113130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update sur Region, Population, Collectivite et Theme';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Region CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE ref_Population CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('RENAME TABLE ref_Population to population');
        $this->addSql('ALTER TABLE `population` RENAME COLUMN Id TO id');
        $this->addSql('ALTER TABLE `population` RENAME COLUMN TypeCollectivite TO collectivite_type_id');
        $this->addSql('ALTER TABLE `population` RENAME COLUMN MinPop TO min');
        $this->addSql('ALTER TABLE `population` RENAME COLUMN MaxPop TO max');
        $this->addSql('ALTER TABLE population CHANGE collectivite_type_id collectivite_type_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE population ADD CONSTRAINT FK_B449A008DC4E869 FOREIGN KEY (collectivite_type_id) REFERENCES collectivite_type (id)');
        $this->addSql('DROP INDEX TypeId ON collectivite');

        $this->addSql('RENAME TABLE Region to region');
        $this->addSql('ALTER TABLE `region` RENAME COLUMN Code TO code');
        $this->addSql('ALTER TABLE `region` RENAME COLUMN Nom TO name');
        $this->addSql('ALTER TABLE `theme` RENAME COLUMN Ordre TO sort_order');

        $this->addSql('ALTER TABLE population CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE population RENAME INDEX fk_b449a008dc4e869 TO IDX_B449A008DC4E869');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE population CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE population RENAME INDEX idx_b449a008dc4e869 TO FK_B449A008DC4E869');

        $this->addSql('ALTER TABLE `theme` RENAME COLUMN sort_order TO Ordre');
        $this->addSql('ALTER TABLE `region` RENAME COLUMN name TO Nom');
        $this->addSql('ALTER TABLE `region` RENAME COLUMN code TO Code');
        $this->addSql('RENAME TABLE region to Region');
        $this->addSql('CREATE INDEX TypeId ON collectivite (type_id)');
        $this->addSql('ALTER TABLE population DROP FOREIGN KEY FK_B449A008DC4E869');
        $this->addSql('ALTER TABLE population CHANGE collectivite_type_id collectivite_type_id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE `population` RENAME COLUMN id TO Id');
        $this->addSql('ALTER TABLE `population` RENAME COLUMN collectivite_type_id TO TypeCollectivite');
        $this->addSql('ALTER TABLE `population` RENAME COLUMN min TO MinPop');
        $this->addSql('ALTER TABLE `population` RENAME COLUMN max TO MaxPop');
        $this->addSql('RENAME TABLE population to ref_Population');
        $this->addSql('ALTER TABLE ref_Population COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE Region COLLATE utf8mb3_general_ci;');

    }
}
