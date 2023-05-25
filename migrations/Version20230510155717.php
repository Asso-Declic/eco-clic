<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510155717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Renomme les tables pour être cohérents avec les standards';
    }

    public function up(Schema $schema): void
    {
        // $this->addSql('RENAME TABLE Administrateur to admin');
        $this->addSql('RENAME TABLE reponse to answer');
        $this->addSql('RENAME TABLE categorie to category');
        // collectivite est une table correctement nommée
        $this->addSql('RENAME TABLE historiqueScore to score');
        $this->addSql('RENAME TABLE utilisateurReponse to collectivite_answer');
        $this->addSql('RENAME TABLE ref_TypeCollectivite to collectivite_type');
        $this->addSql('RENAME TABLE Departement to departement');
        $this->addSql('RENAME TABLE OPSN to opsn');
        $this->addSql('RENAME TABLE OPSN_Departement to opsn_departement');
        // question est une table correctement nommée
        // recommandation est une table correctement nommée
        $this->addSql('RENAME TABLE ref_NiveauReco to recommandation_level');
        $this->addSql('RENAME TABLE Siret_Temporaire to temporary_siret');
        // theme est une table correctement nommée
        $this->addSql('RENAME TABLE utilisateur to user');
        $this->addSql('RENAME TABLE preference to user_preference');
        // $this->addSql('ALTER TABLE `admin` RENAME INDEX uniq_ff8f2a304f98863b TO UNIQ_880E0D764F98863B;');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_1d1c63b34f98863b TO UNIQ_8D93D6494F98863B;');
        $this->addSql('ALTER TABLE opsn_departement RENAME INDEX idx_bc35eddfbf07875a TO IDX_DB4914C6BF07875A;');
        $this->addSql('ALTER TABLE opsn_departement RENAME INDEX idx_bc35eddf839e14d2 TO IDX_DB4914C6839E14D2;');
    }

    public function down(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE `admin` RENAME INDEX UNIQ_880E0D764F98863B TO uniq_ff8f2a304f98863b;');
        $this->addSql('ALTER TABLE user RENAME INDEX UNIQ_8D93D6494F98863B TO uniq_1d1c63b34f98863b;');
        $this->addSql('ALTER TABLE opsn_departement RENAME INDEX IDX_DB4914C6BF07875A TO idx_bc35eddfbf07875a;');
        $this->addSql('ALTER TABLE opsn_departement RENAME INDEX IDX_DB4914C6839E14D2 TO idx_bc35eddf839e14d2;');
        // $this->addSql('RENAME TABLE admin to Administrateur');
        $this->addSql('RENAME TABLE answer to reponse');
        $this->addSql('RENAME TABLE category to categorie');
        $this->addSql('RENAME TABLE score to historiqueScore');
        $this->addSql('RENAME TABLE collectivite_answer to utilisateurReponse');
        $this->addSql('RENAME TABLE collectivite_type to ref_TypeCollectivite');
        $this->addSql('RENAME TABLE departement to Departement');
        $this->addSql('RENAME TABLE opsn to OPSN');
        $this->addSql('RENAME TABLE opsn_departement to OPSN_Departement');
        $this->addSql('RENAME TABLE recommandation_level to ref_NiveauReco');
        $this->addSql('RENAME TABLE temporary_siret to Siret_Temporaire');
        $this->addSql('RENAME TABLE user to utilisateur');
        $this->addSql('RENAME TABLE user_preference to preference');
    }
}
