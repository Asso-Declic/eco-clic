<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002153040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adaptation des ressources et liens de recommandations';
    }

    public function up(Schema $schema): void
    {        
        $this->addSql('RENAME TABLE ref_RecoRessource TO recommandation_resource');
        $this->addSql('RENAME TABLE ref_RecoIndicateur TO recommandation_success_indicator');
        $this->addSql('ALTER TABLE collectivite_answer CHANGE UtilisateurId user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        
        $this->addSql('DROP TABLE rattachement_OPSN');
        $this->addSql('DROP INDEX IdCollectivite ON collectivite_answer');
        $this->addSql('ALTER TABLE collectivite_answer ADD CONSTRAINT FK_85E83017A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_85E83017A76ED395 ON collectivite_answer (user_id)');

        $this->addSql('DROP INDEX RecommandationId ON recommandation_resource');
        $this->addSql('ALTER TABLE recommandation_resource CHANGE RecommandationId recommandation_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE Titre title VARCHAR(255) NOT NULL, CHANGE Lien link LONGTEXT NOT NULL, CHANGE Id id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');

        $this->addSql('DROP INDEX RecommandationId ON recommandation_success_indicator');
        $this->addSql('ALTER TABLE recommandation_success_indicator CHANGE RecommandationId recommandation_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE Texte text LONGTEXT NOT NULL, CHANGE Id id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recommandation_resource CHANGE recommandation_id RecommandationId CHAR(36) NOT NULL, CHANGE title Titre VARCHAR(200) NOT NULL, CHANGE link Lien VARCHAR(1000) NOT NULL, CHANGE id Id CHAR(36) NOT NULL');
        $this->addSql('CREATE INDEX RecommandationId ON recommandation_resource (RecommandationId)');
        $this->addSql('ALTER TABLE recommandation_success_indicator DROP FOREIGN KEY FK_89DE30BB61AAE789');
        $this->addSql('DROP INDEX IDX_89DE30BB61AAE789 ON recommandation_success_indicator');

        $this->addSql('ALTER TABLE recommandation_success_indicator CHANGE recommandation_id RecommandationId CHAR(36) NOT NULL, CHANGE text Texte VARCHAR(200) NOT NULL, CHANGE id Id CHAR(36) NOT NULL');
        $this->addSql('CREATE INDEX RecommandationId ON recommandation_success_indicator (RecommandationId)');
        $this->addSql('ALTER TABLE recommandation_resource DROP FOREIGN KEY FK_10A45F1361AAE789');
        $this->addSql('DROP INDEX IDX_10A45F1361AAE789 ON recommandation_resource');
        $this->addSql('ALTER TABLE collectivite_answer DROP FOREIGN KEY FK_85E83017A76ED395');
        $this->addSql('DROP INDEX IDX_85E83017A76ED395 ON collectivite_answer');

        $this->addSql('CREATE TABLE rattachement_OPSN (CollectiviteId CHAR(36) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, OPSNId CHAR(36) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, UNIQUE INDEX CollectiviteId_2 (CollectiviteId), INDEX CollectiviteId (CollectiviteId, OPSNId), PRIMARY KEY(CollectiviteId)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE INDEX IdCollectivite ON collectivite_answer (collectivite_id)');
        $this->addSql('ALTER TABLE collectivite_answer CHANGE user_id UtilisateurId CHAR(36) NOT NULL');

        $this->addSql('RENAME TABLE recommandation_resource TO ref_RecoRessource');
        $this->addSql('RENAME TABLE recommandation_success_indicator TO ref_RecoIndicateur');
    }
}
