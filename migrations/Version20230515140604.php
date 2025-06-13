<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515140604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'On renomme les champs pour utiliser les conventions de nommage de SQL et Doctrine en snake_case';
    }

    public function up(Schema $schema): void
    {
        // $this->addSql('DROP INDEX UNIQ_880E0D764F98863B ON `admin`');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN Identifiant TO username');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76F85E0677 ON `admin` (username)');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN MotDePasse TO `password`');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN Mail TO email');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN Nom TO last_name');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN Prenom TO first_name');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN Token TO token');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN Actif TO active');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN SuperAdmin TO super_admin');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN OPSNId TO opsn_id');
        $this->addSql('ALTER TABLE `answer` RENAME COLUMN `Type` TO `type`');
        $this->addSql('ALTER TABLE `answer` RENAME COLUMN `Text` TO body');
        $this->addSql('ALTER TABLE `answer` RENAME COLUMN IdQuestion TO question_id');
        $this->addSql('ALTER TABLE `answer` RENAME COLUMN Ponderation TO ponderation');
        $this->addSql('ALTER TABLE `category` RENAME COLUMN Nom TO `name`');
        $this->addSql('ALTER TABLE `category` RENAME COLUMN Img TO `image`');
        $this->addSql('ALTER TABLE `category` RENAME COLUMN `Description` TO `description`');
        $this->addSql('ALTER TABLE `category` RENAME COLUMN Ordre TO sort_order');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN `Nom` TO `name`');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN `Population` TO `population`');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN DepartementCode TO departement_id');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN Siret TO siret');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN Latitude TO latitude');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN Longitude TO longitude');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN TypeId TO type_id');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN OPSNId TO opsn_id');
        $this->addSql('ALTER TABLE `collectivite_answer` RENAME COLUMN IdReponse TO answer_id');
        $this->addSql('ALTER TABLE `collectivite_answer` RENAME COLUMN CollectiviteId TO collectivite_id');
        $this->addSql('ALTER TABLE `collectivite_answer` RENAME COLUMN InputText TO body');
        $this->addSql('ALTER TABLE `collectivite_answer` RENAME COLUMN `Date` TO answered_at');
        $this->addSql('ALTER TABLE `collectivite_type` RENAME COLUMN Nom TO label');
        $this->addSql('ALTER TABLE `departement` RENAME COLUMN Code TO code');
        $this->addSql('ALTER TABLE `departement` RENAME COLUMN Nom TO `name`');
        $this->addSql('ALTER TABLE `departement` RENAME COLUMN CodeRegion TO region_code');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN Nom TO `name`');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN Mail TO email');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN DepartementCode TO departement');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN Actif TO active');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN Logo TO logo');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN Telephone TO phone_number');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN Adresse TO postal_address');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN Site_Internet TO website');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN Siret TO siret');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN Latitude TO latitude');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN Longitude TO longitude');
        $this->addSql('ALTER TABLE `opsn_departement` RENAME COLUMN OPSNId TO opsn_id');
        $this->addSql('ALTER TABLE `opsn_departement` RENAME COLUMN DepartementCode TO departement_code');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN Question TO question');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN IdTheme TO theme_id');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN IdCategorie TO category_id');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN Multiple TO multiple');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN `Definition` TO `definition`');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN InfoComplementaire TO additional_information');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN Titre_definition TO definition_title');
        $this->addSql('ALTER TABLE `recommandation` RENAME COLUMN Titre TO title');
        $this->addSql('ALTER TABLE `recommandation` RENAME COLUMN `Text` TO body');
        $this->addSql('ALTER TABLE `recommandation` RENAME COLUMN IdQuestion TO question_id');
        $this->addSql('ALTER TABLE `recommandation` RENAME COLUMN NiveauReco TO recommandation_level_id');
        $this->addSql('ALTER TABLE `recommandation_level` RENAME COLUMN Label TO label');
        $this->addSql('ALTER TABLE `score` RENAME COLUMN CollectiviteId TO collectivite_id');
        $this->addSql('ALTER TABLE `score` RENAME COLUMN Score TO score');
        $this->addSql('ALTER TABLE `score` RENAME COLUMN `Date` TO scored_at');
        $this->addSql('ALTER TABLE `theme` RENAME COLUMN Theme TO label');
        $this->addSql('ALTER TABLE `theme` RENAME COLUMN IdCategorie TO category_id');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN Identifiant TO username');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN MotDePasse TO `password`');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN Mail TO email');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN Nom TO last_name');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN Prenom TO first_name');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN CollectiviteId TO collectivite_id');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN `Admin` TO `admin`');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN Token TO token');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN Actif TO active');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN CGU TO cgu_checked');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN IsVerifie TO verified');
        $this->addSql('ALTER TABLE `user_preference` RENAME COLUMN UtilisateurId TO user_id');
        $this->addSql('ALTER TABLE `user_preference` RENAME COLUMN Code TO code');
        $this->addSql('ALTER TABLE `user_preference` RENAME COLUMN `Json` TO `json`');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `user_preference` RENAME COLUMN `json` TO `Json`');
        $this->addSql('ALTER TABLE `user_preference` RENAME COLUMN code TO Code');
        $this->addSql('ALTER TABLE `user_preference` RENAME COLUMN user_id TO UtilisateurId');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN verified TO IsVerifie');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN cgu_checked TO CGU');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN active TO Actif');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN token TO Token');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN `admin` TO `Admin`');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN collectivite_id TO CollectiviteId');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN first_name TO Prenom');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN last_name TO Nom');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN email TO Mail');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN `password` TO MotDePasse');
        $this->addSql('ALTER TABLE `user` RENAME COLUMN username TO Identifiant');
        $this->addSql('ALTER TABLE `theme` RENAME COLUMN category_id TO IdCategorie');
        $this->addSql('ALTER TABLE `theme` RENAME COLUMN label TO Theme');
        $this->addSql('ALTER TABLE `score` RENAME COLUMN scored_at TO `Date`');
        $this->addSql('ALTER TABLE `score` RENAME COLUMN score TO Score');
        $this->addSql('ALTER TABLE `score` RENAME COLUMN collectivite_id TO CollectiviteId');
        $this->addSql('ALTER TABLE `recommandation_level` RENAME COLUMN label TO Label');
        $this->addSql('ALTER TABLE `recommandation` RENAME COLUMN recommandation_level_id TO NiveauReco');
        $this->addSql('ALTER TABLE `recommandation` RENAME COLUMN question_id TO IdQuestion');
        $this->addSql('ALTER TABLE `recommandation` RENAME COLUMN body TO `Text`');
        $this->addSql('ALTER TABLE `recommandation` RENAME COLUMN title TO Titre');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN definition_title TO Titre_definition');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN additional_information TO InfoComplementaire');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN `definition` TO `Definition`');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN multiple TO Multiple');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN category_id TO IdCategorie');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN theme_id TO IdTheme');
        $this->addSql('ALTER TABLE `question` RENAME COLUMN question TO Question');
        $this->addSql('ALTER TABLE `opsn_departement` RENAME COLUMN departement_code TO DepartementCode');
        $this->addSql('ALTER TABLE `opsn_departement` RENAME COLUMN opsn_id TO OPSNId');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN longitude TO Longitude');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN latitude TO Latitude');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN siret TO Siret');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN website TO Site_Internet');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN postal_address TO Adresse');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN phone_number TO Telephone');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN logo TO Logo');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN active TO Actif');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN departement TO DepartementCode');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN email TO Mail');
        $this->addSql('ALTER TABLE `opsn` RENAME COLUMN `name` TO Nom');
        $this->addSql('ALTER TABLE `departement` RENAME COLUMN region_code TO CodeRegion');
        $this->addSql('ALTER TABLE `departement` RENAME COLUMN name TO Nom');
        $this->addSql('ALTER TABLE `departement` RENAME COLUMN code TO Code');
        $this->addSql('ALTER TABLE `collectivite_type` RENAME COLUMN label TO Nom');
        $this->addSql('ALTER TABLE `collectivite_answer` RENAME COLUMN answered_at TO `Date`');
        $this->addSql('ALTER TABLE `collectivite_answer` RENAME COLUMN body TO InputText');
        $this->addSql('ALTER TABLE `collectivite_answer` RENAME COLUMN collectivite_id TO CollectiviteId');
        $this->addSql('ALTER TABLE `collectivite_answer` RENAME COLUMN answer_id TO IdReponse');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN opsn_id TO OPSNId');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN type_id TO TypeId');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN longitude TO Longitude');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN latitude TO Latitude');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN siret TO Siret');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN departement_id TO DepartementCode');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN `population` TO `Population`');
        $this->addSql('ALTER TABLE `collectivite` RENAME COLUMN `name` TO `Nom`');
        $this->addSql('ALTER TABLE `category` RENAME COLUMN sort_order TO Ordre');
        $this->addSql('ALTER TABLE `category` RENAME COLUMN `description` TO `Description`');
        $this->addSql('ALTER TABLE `category` RENAME COLUMN `image` TO Img');
        $this->addSql('ALTER TABLE `category` RENAME COLUMN `name` TO Nom');
        $this->addSql('ALTER TABLE `answer` RENAME COLUMN ponderation TO Ponderation');
        $this->addSql('ALTER TABLE `answer` RENAME COLUMN `type` TO `Type`');
        $this->addSql('ALTER TABLE `answer` RENAME COLUMN body TO `Text`');
        $this->addSql('ALTER TABLE `answer` RENAME COLUMN question_id TO IdQuestion');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN `password` TO MotDePasse');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN email TO Mail');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN opsn_id TO OPSNId');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN last_name TO Nom');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN first_name TO Prenom');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN token TO Token');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN active TO Actif');
        // $this->addSql('ALTER TABLE `admin` RENAME COLUMN super_admin TO SuperAdmin');
        // $this->addSql('DROP INDEX UNIQ_880E0D76F85E0677 ON `admin`');
        // $this->addSql('ALTER TABLE `admin` CHANGE username Identifiant VARCHAR(300) NOT NULL');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D764F98863B ON `admin` (Identifiant)');
    }
}
