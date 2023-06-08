<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515210304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Correction automatique des indexs et des clés par Doctrine';
    }

    public function up(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE `admin` RENAME INDEX idx_880e0d76bf07875a TO IDX_880E0D76173BE8BE');
        $this->addSql('ALTER TABLE answer RENAME INDEX idx_dadd4a25aa0960c5 TO IDX_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE collectivite RENAME INDEX idx_cfa408a1839e14d2 TO IDX_CFA408A1CCF9E01E');
        $this->addSql('ALTER TABLE collectivite RENAME INDEX idx_cfa408a19c5891a6 TO IDX_CFA408A1C54C8C93');
        $this->addSql('ALTER TABLE collectivite RENAME INDEX idx_cfa408a1bf07875a TO IDX_CFA408A1173BE8BE');
        $this->addSql('ALTER TABLE collectivite_answer RENAME INDEX idx_85e83017cdfe3796 TO IDX_85E83017AA334807');
        $this->addSql('ALTER TABLE collectivite_answer RENAME INDEX idx_85e830175e1ef114 TO IDX_85E83017A7991F51');
        $this->addSql('ALTER TABLE opsn_departement DROP FOREIGN KEY FK_BC35EDDFBF07875A');
        $this->addSql('ALTER TABLE opsn_departement ADD CONSTRAINT FK_DB4914C6173BE8BE FOREIGN KEY (opsn_id) REFERENCES opsn (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE opsn_departement RENAME INDEX idx_db4914c6bf07875a TO IDX_DB4914C6173BE8BE');
        $this->addSql('ALTER TABLE opsn_departement RENAME INDEX idx_db4914c6839e14d2 TO IDX_DB4914C66A333750');
        $this->addSql('ALTER TABLE recommandation DROP FOREIGN KEY FK_C7782A286ED7AAC0');
        $this->addSql('DROP INDEX IDX_C7782A286ED7AAC0 ON recommandation');
        $this->addSql('ALTER TABLE recommandation CHANGE recommandation_level_id level_id SMALLINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE recommandation ADD CONSTRAINT FK_C7782A285FB14BA7 FOREIGN KEY (level_id) REFERENCES recommandation_level (id)');
        $this->addSql('CREATE INDEX IDX_C7782A285FB14BA7 ON recommandation (level_id)');
        $this->addSql('ALTER TABLE recommandation RENAME INDEX idx_c7782a28aa0960c5 TO IDX_C7782A281E27F6BF');
        $this->addSql('ALTER TABLE score RENAME INDEX idx_329937515e1ef114 TO IDX_32993751A7991F51');
        $this->addSql('ALTER TABLE theme RENAME INDEX idx_9775e708330b72b5 TO IDX_9775E70812469DE2');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d6494f98863b TO UNIQ_8D93D649F85E0677');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d6495e1ef114 TO IDX_8D93D649A7991F51');
        $this->addSql('ALTER TABLE user_preference RENAME INDEX idx_fa0e76bf8290d882 TO IDX_FA0E76BFA76ED395');
    }

    public function down(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE `admin` RENAME INDEX idx_880e0d76173be8be TO IDX_880E0D76BF07875A');
        $this->addSql('ALTER TABLE answer RENAME INDEX idx_dadd4a251e27f6bf TO IDX_DADD4A25AA0960C5');
        $this->addSql('ALTER TABLE collectivite RENAME INDEX idx_cfa408a1ccf9e01e TO IDX_CFA408A1839E14D2');
        $this->addSql('ALTER TABLE collectivite RENAME INDEX idx_cfa408a1c54c8c93 TO IDX_CFA408A19C5891A6');
        $this->addSql('ALTER TABLE collectivite RENAME INDEX idx_cfa408a1173be8be TO IDX_CFA408A1BF07875A');
        $this->addSql('ALTER TABLE collectivite_answer RENAME INDEX idx_85e83017a7991f51 TO IDX_85E830175E1EF114');
        $this->addSql('ALTER TABLE collectivite_answer RENAME INDEX idx_85e83017aa334807 TO IDX_85E83017CDFE3796');
        $this->addSql('ALTER TABLE opsn_departement DROP FOREIGN KEY FK_DB4914C6173BE8BE');
        $this->addSql('ALTER TABLE opsn_departement ADD CONSTRAINT FK_BC35EDDFBF07875A FOREIGN KEY (opsn_id) REFERENCES opsn (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE opsn_departement RENAME INDEX idx_db4914c6173be8be TO IDX_DB4914C6BF07875A');
        $this->addSql('ALTER TABLE opsn_departement RENAME INDEX idx_db4914c66a333750 TO IDX_DB4914C6839E14D2');
        $this->addSql('ALTER TABLE recommandation DROP FOREIGN KEY FK_C7782A285FB14BA7');
        $this->addSql('DROP INDEX IDX_C7782A285FB14BA7 ON recommandation');
        $this->addSql('ALTER TABLE recommandation CHANGE level_id recommandation_level_id SMALLINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE recommandation ADD CONSTRAINT FK_C7782A286ED7AAC0 FOREIGN KEY (recommandation_level_id) REFERENCES recommandation_level (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C7782A286ED7AAC0 ON recommandation (recommandation_level_id)');
        $this->addSql('ALTER TABLE recommandation RENAME INDEX idx_c7782a281e27f6bf TO IDX_C7782A28AA0960C5');
        $this->addSql('ALTER TABLE score RENAME INDEX idx_32993751a7991f51 TO IDX_329937515E1EF114');
        $this->addSql('ALTER TABLE theme RENAME INDEX idx_9775e70812469de2 TO IDX_9775E708330B72B5');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d649a7991f51 TO IDX_8D93D6495E1EF114');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649f85e0677 TO UNIQ_8D93D6494F98863B');
        $this->addSql('ALTER TABLE user_preference RENAME INDEX idx_fa0e76bfa76ed395 TO IDX_FA0E76BF8290D882');
    }
}
