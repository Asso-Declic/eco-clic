<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002190046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'RecommandationCustom';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('RENAME TABLE ref_RecoActivable TO recommandation_custom');
        $this->addSql('ALTER TABLE recommandation_custom DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE recommandation_custom ADD id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, CHANGE IdRecommandation recommandation_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE CollectiviteId collectivite_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdQuestion question_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE recommandation_custom ADD CONSTRAINT FK_74EADD0261AAE789 FOREIGN KEY (recommandation_id) REFERENCES recommandation (id)');
        $this->addSql('ALTER TABLE recommandation_custom ADD CONSTRAINT FK_74EADD02A7991F51 FOREIGN KEY (collectivite_id) REFERENCES collectivite (id)');
        $this->addSql('ALTER TABLE recommandation_custom ADD CONSTRAINT FK_74EADD021E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE recommandation_custom RENAME INDEX idrecommandation TO IDX_74EADD0261AAE789');
        $this->addSql('ALTER TABLE recommandation_custom RENAME INDEX collectiviteid TO IDX_74EADD02A7991F51');
        $this->addSql('ALTER TABLE recommandation_custom RENAME INDEX idquestion TO IDX_74EADD021E27F6BF');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recommandation_custom RENAME INDEX idx_74eadd021e27f6bf TO IdQuestion');
        $this->addSql('ALTER TABLE recommandation_custom RENAME INDEX idx_74eadd0261aae789 TO IdRecommandation');
        $this->addSql('ALTER TABLE recommandation_custom RENAME INDEX idx_74eadd02a7991f51 TO CollectiviteId');
        $this->addSql('ALTER TABLE recommandation_custom DROP FOREIGN KEY FK_74EADD0261AAE789');
        $this->addSql('ALTER TABLE recommandation_custom DROP FOREIGN KEY FK_74EADD02A7991F51');
        $this->addSql('ALTER TABLE recommandation_custom DROP FOREIGN KEY FK_74EADD021E27F6BF');
        $this->addSql('ALTER TABLE recommandation_custom CHANGE recommandation_id IdRecommandation CHAR(36) NOT NULL, CHANGE collectivite_id CollectiviteId CHAR(36) NOT NULL, CHANGE question_id IdQuestion CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE recommandation_custom DROP id');
        $this->addSql('RENAME TABLE recommandation_custom TO ref_RecoActivable');
        $this->addSql('ALTER TABLE ref_RecoActivable ADD PRIMARY KEY (IdRecommandation, CollectiviteId, IdQuestion)');
    }
}
