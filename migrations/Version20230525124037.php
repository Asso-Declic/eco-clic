<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525124037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création de UserStatus avec modification du type de code pour un int';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE utilisateurStatut CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('RENAME TABLE utilisateurStatut to user_status');
        $this->addSql('ALTER TABLE `user_status` RENAME COLUMN RecommandationId TO recommandation_id');
        $this->addSql('ALTER TABLE `user_status` RENAME COLUMN UtilisateurId TO user_id');
        $this->addSql('ALTER TABLE `user_status` RENAME COLUMN StatutCode TO code');
        $this->addSql('DROP INDEX StatutCode ON user_status');
        $this->addSql('ALTER TABLE user_status CHANGE Id id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE recommandation_id recommandation_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE user_id user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE code code INT NOT NULL');
        $this->addSql('ALTER TABLE user_status ADD CONSTRAINT FK_1E527E2161AAE789 FOREIGN KEY (recommandation_id) REFERENCES recommandation (id)');
        
        // Il y a aurait dans cette table des id qui n'existent pas dans la table user. On tente donc d'abord de la supprimer
        $this->addSql('DELETE FROM user_status
        WHERE user_id IN (
        SELECT user_id FROM (
            SELECT user_id
            FROM user_status LEFT JOIN user ON user_status.user_id = user.id
            WHERE user.id IS NULL
        ) AS listeASupprimer);');
        $this->addSql('ALTER TABLE user_status ADD CONSTRAINT FK_1E527E21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_status RENAME INDEX recommandationid TO IDX_1E527E2161AAE789');
        $this->addSql('ALTER TABLE user_status RENAME INDEX utilisateurid TO IDX_1E527E21A76ED395');
    }
    
    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user_status DROP FOREIGN KEY FK_1E527E2161AAE789');
        $this->addSql('ALTER TABLE user_status DROP FOREIGN KEY FK_1E527E21A76ED395');
        $this->addSql('ALTER TABLE user_status CHANGE id Id CHAR(36) NOT NULL, CHANGE recommandation_id recommandation_id CHAR(36) NOT NULL, CHANGE user_id user_id CHAR(36) NOT NULL, CHANGE code code CHAR(36) NOT NULL');
        $this->addSql('CREATE INDEX StatutCode ON user_status (code)');
        $this->addSql('ALTER TABLE user_status RENAME INDEX idx_1e527e2161aae789 TO RecommandationId');
        $this->addSql('ALTER TABLE user_status RENAME INDEX idx_1e527e21a76ed395 TO UtilisateurId');
        $this->addSql('ALTER TABLE `user_status` RENAME COLUMN recommandation_id TO RecommandationId');
        $this->addSql('ALTER TABLE `user_status` RENAME COLUMN user_id TO UtilisateurId');
        $this->addSql('ALTER TABLE `user_status` RENAME COLUMN code TO StatutCode');
        $this->addSql('RENAME TABLE user_status to utilisateurStatut');
        $this->addSql('ALTER TABLE utilisateurStatut COLLATE utf8mb3_general_ci;');

    }
}
