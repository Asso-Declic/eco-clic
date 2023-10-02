<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002194803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ManyToMany Recommandation with Answer to set ref_ReponseReco';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX ReponseId ON ref_ReponseReco');
        $this->addSql('DROP INDEX RecommandationId ON ref_ReponseReco');
        $this->addSql('DROP INDEX `primary` ON ref_ReponseReco');
        $this->addSql('ALTER TABLE ref_ReponseReco CHANGE RecommandationId recommandation_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE ReponseId answer_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE ref_ReponseReco ADD CONSTRAINT FK_C4D2A9D661AAE789 FOREIGN KEY (recommandation_id) REFERENCES recommandation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ref_ReponseReco ADD CONSTRAINT FK_C4D2A9D6AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_C4D2A9D661AAE789 ON ref_ReponseReco (recommandation_id)');
        $this->addSql('CREATE INDEX IDX_C4D2A9D6AA334807 ON ref_ReponseReco (answer_id)');
        $this->addSql('ALTER TABLE ref_ReponseReco ADD PRIMARY KEY (recommandation_id, answer_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ref_ReponseReco DROP FOREIGN KEY FK_C4D2A9D661AAE789');
        $this->addSql('ALTER TABLE ref_ReponseReco DROP FOREIGN KEY FK_C4D2A9D6AA334807');
        $this->addSql('DROP INDEX IDX_C4D2A9D661AAE789 ON ref_ReponseReco');
        $this->addSql('DROP INDEX IDX_C4D2A9D6AA334807 ON ref_ReponseReco');
        $this->addSql('DROP INDEX `PRIMARY` ON ref_ReponseReco');
        $this->addSql('ALTER TABLE ref_ReponseReco CHANGE recommandation_id RecommandationId CHAR(36) NOT NULL, CHANGE answer_id ReponseId CHAR(36) NOT NULL');
        $this->addSql('CREATE INDEX ReponseId ON ref_ReponseReco (ReponseId)');
        $this->addSql('CREATE INDEX RecommandationId ON ref_ReponseReco (RecommandationId)');
        $this->addSql('ALTER TABLE ref_ReponseReco ADD PRIMARY KEY (RecommandationId, ReponseId)');
    }
}
