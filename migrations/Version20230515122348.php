<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515122348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajoute des clés étrangères pour matérialiser les relations entre les tables';
    }

    public function up(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76BF07875A FOREIGN KEY (OPSNId) REFERENCES opsn (id)');
        // $this->addSql('CREATE INDEX IDX_880E0D76BF07875A ON `admin` (OPSNId)');
        
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25AA0960C5 FOREIGN KEY (IdQuestion) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25AA0960C5 ON answer (IdQuestion)');
        
        $this->addSql('ALTER TABLE collectivite CHANGE DepartementCode DepartementCode CHAR(3) DEFAULT NULL, CHANGE TypeId TypeId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE collectivite ADD CONSTRAINT FK_CFA408A1839E14D2 FOREIGN KEY (DepartementCode) REFERENCES departement (Code)');
        $this->addSql('ALTER TABLE collectivite ADD CONSTRAINT FK_CFA408A19C5891A6 FOREIGN KEY (TypeId) REFERENCES collectivite_type (id)');
        $this->addSql('ALTER TABLE collectivite ADD CONSTRAINT FK_CFA408A1BF07875A FOREIGN KEY (OPSNId) REFERENCES opsn (id)');
        $this->addSql('CREATE INDEX IDX_CFA408A1839E14D2 ON collectivite (DepartementCode)');
        $this->addSql('CREATE INDEX IDX_CFA408A19C5891A6 ON collectivite (TypeId)');
        $this->addSql('CREATE INDEX IDX_CFA408A1BF07875A ON collectivite (OPSNId)');
        
        // $this->addSql('ALTER TABLE collectivite_answer CHANGE IdReponse IdReponse CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE collectivite_answer ADD CONSTRAINT FK_85E83017CDFE3796 FOREIGN KEY (IdReponse) REFERENCES answer (id)');
        $this->addSql('ALTER TABLE collectivite_answer ADD CONSTRAINT FK_85E830175E1EF114 FOREIGN KEY (CollectiviteId) REFERENCES collectivite (id)');
        $this->addSql('CREATE INDEX IDX_85E83017CDFE3796 ON collectivite_answer (IdReponse)');
        $this->addSql('CREATE INDEX IDX_85E830175E1EF114 ON collectivite_answer (CollectiviteId)');
        
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E4F0C9D89 FOREIGN KEY (IdTheme) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E12469DE2 FOREIGN KEY (IdCategorie) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E4F0C9D89 ON question (IdTheme)');
        $this->addSql('CREATE INDEX IDX_B6F7494E12469DE2 ON question (IdCategorie)');
        
        // On ajoute UNSIGNED
        $this->addSql('ALTER TABLE recommandation_level CHANGE id id SMALLINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE recommandation CHANGE NiveauReco NiveauReco SMALLINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE recommandation ADD CONSTRAINT FK_C7782A28AA0960C5 FOREIGN KEY (IdQuestion) REFERENCES question (id)');
        $this->addSql('ALTER TABLE recommandation ADD CONSTRAINT FK_C7782A286ED7AAC0 FOREIGN KEY (NiveauReco) REFERENCES recommandation_level (id)');
        $this->addSql('CREATE INDEX IDX_C7782A28AA0960C5 ON recommandation (IdQuestion)');
        $this->addSql('CREATE INDEX IDX_C7782A286ED7AAC0 ON recommandation (NiveauReco)');
        
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937515E1EF114 FOREIGN KEY (CollectiviteId) REFERENCES collectivite (id)');
        $this->addSql('CREATE INDEX IDX_329937515E1EF114 ON score (CollectiviteId)');
        
        $this->addSql('ALTER TABLE theme CHANGE IdCategorie IdCategorie CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('UPDATE theme SET IdCategorie = NULL WHERE id = \'0\'');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E708330B72B5 FOREIGN KEY (IdCategorie) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_9775E708330B72B5 ON theme (IdCategorie)');
        // On met à NULL les CollectiviteId orphelins dans user
        $this->addSql('UPDATE user SET CollectiviteId = \'404\' WHERE CollectiviteId IN (
            SELECT * FROM (
                SELECT CollectiviteId
                FROM user AS u
                LEFT JOIN collectivite AS c ON u.CollectiviteId = c.id
                WHERE c.id IS NULL
                GROUP BY CollectiviteId
            ) AS liste_a_supprimer
        );');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495E1EF114 FOREIGN KEY (CollectiviteId) REFERENCES collectivite (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6495E1EF114 ON user (CollectiviteId)');
        
        // Il y a aurait dans cette table des id qui n'existent pas dans la table user. On tente donc d'abord de la supprimer
        $this->addSql('DELETE FROM user_preference
        WHERE UtilisateurId IN (
        SELECT UtilisateurId FROM (
            SELECT UtilisateurId
            FROM user_preference LEFT JOIN user ON user_preference.UtilisateurId = user.id
            WHERE user.id IS NULL
        ) AS listeASupprimer);');
        $this->addSql('ALTER TABLE user_preference ADD CONSTRAINT FK_FA0E76BF8290D882 FOREIGN KEY (UtilisateurId) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FA0E76BF8290D882 ON user_preference (UtilisateurId)');
    }

    public function down(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76BF07875A');
        // $this->addSql('DROP INDEX IDX_880E0D76BF07875A ON `admin`');

        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25AA0960C5');
        $this->addSql('DROP INDEX IDX_DADD4A25AA0960C5 ON answer');

        $this->addSql('ALTER TABLE collectivite DROP FOREIGN KEY FK_CFA408A1839E14D2');
        $this->addSql('ALTER TABLE collectivite DROP FOREIGN KEY FK_CFA408A19C5891A6');
        $this->addSql('ALTER TABLE collectivite DROP FOREIGN KEY FK_CFA408A1BF07875A');
        $this->addSql('DROP INDEX IDX_CFA408A1839E14D2 ON collectivite');
        $this->addSql('DROP INDEX IDX_CFA408A19C5891A6 ON collectivite');
        $this->addSql('DROP INDEX IDX_CFA408A1BF07875A ON collectivite');
        $this->addSql('ALTER TABLE collectivite CHANGE DepartementCode DepartementCode CHAR(3) NOT NULL, CHANGE TypeId TypeId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');

        $this->addSql('ALTER TABLE collectivite_answer DROP FOREIGN KEY FK_85E83017CDFE3796');
        $this->addSql('ALTER TABLE collectivite_answer DROP FOREIGN KEY FK_85E830175E1EF114');
        $this->addSql('DROP INDEX IDX_85E83017CDFE3796 ON collectivite_answer');
        $this->addSql('DROP INDEX IDX_85E830175E1EF114 ON collectivite_answer');
        $this->addSql('ALTER TABLE collectivite_answer CHANGE IdReponse IdReponse CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');

        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E4F0C9D89');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E12469DE2');
        $this->addSql('DROP INDEX IDX_B6F7494E4F0C9D89 ON question');
        $this->addSql('DROP INDEX IDX_B6F7494E12469DE2 ON question');

        $this->addSql('ALTER TABLE recommandation DROP FOREIGN KEY FK_C7782A28AA0960C5');
        $this->addSql('ALTER TABLE recommandation DROP FOREIGN KEY FK_C7782A286ED7AAC0');
        $this->addSql('DROP INDEX IDX_C7782A28AA0960C5 ON recommandation');
        $this->addSql('DROP INDEX IDX_C7782A286ED7AAC0 ON recommandation');
        $this->addSql('ALTER TABLE recommandation CHANGE NiveauReco NiveauReco SMALLINT NOT NULL');

        $this->addSql('ALTER TABLE recommandation_level CHANGE id id INT NOT NULL');

        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937515E1EF114');
        $this->addSql('DROP INDEX IDX_329937515E1EF114 ON score');

        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E708330B72B5');
        $this->addSql('DROP INDEX IDX_9775E708330B72B5 ON theme');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495E1EF114');
        $this->addSql('DROP INDEX IDX_8D93D6495E1EF114 ON user');

        $this->addSql('ALTER TABLE user_preference DROP FOREIGN KEY FK_FA0E76BF8290D882');
        $this->addSql('DROP INDEX IDX_FA0E76BF8290D882 ON user_preference');
    }
}
