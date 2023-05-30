<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530092248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Renommage de UserStatus en CollectiviteStatus';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('RENAME TABLE user_status TO collectivite_status');
        $this->addSql('ALTER TABLE collectivite_status DROP FOREIGN KEY FK_1E527E21A76ED395');
        $this->addSql('DROP INDEX IDX_1E527E21A76ED395 ON collectivite_status');
        $this->addSql('ALTER TABLE collectivite_status CHANGE user_id collectivite_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE collectivite_status ADD CONSTRAINT FK_24351F2EA7991F51 FOREIGN KEY (collectivite_id) REFERENCES collectivite (id)');
        $this->addSql('CREATE INDEX IDX_24351F2EA7991F51 ON collectivite_status (collectivite_id)');
        $this->addSql('ALTER TABLE collectivite_status RENAME INDEX idx_1e527e2161aae789 TO IDX_24351F2E61AAE789');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE collectivite_status DROP FOREIGN KEY FK_24351F2EA7991F51');
        $this->addSql('DROP INDEX IDX_24351F2EA7991F51 ON collectivite_status');
        $this->addSql('ALTER TABLE collectivite_status CHANGE collectivite_id user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE collectivite_status ADD CONSTRAINT FK_1E527E21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1E527E21A76ED395 ON collectivite_status (user_id)');
        $this->addSql('ALTER TABLE collectivite_status RENAME INDEX idx_24351f2e61aae789 TO IDX_1E527E2161AAE789');
        $this->addSql('RENAME TABLE collectivite_status TO user_status');
    }
}
