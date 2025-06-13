<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510152551 extends AbstractMigration
{
    /**
     * Documentation de la transition de l'ancien code vers Symfony
     * 
     * ## MCD d'origine
     * Avant le passage à Symfony, la base de données n'avait pas de MCD.
     * Dans un premier temps, il a fallu créer toutes les entités et les associations selon les tables actuelles.
     * Ça donne un MCD sans relation puisque aucune clé étrangère n'existait. Une seule relation ManyToMany a
     * été mise en place à cette étape, entre `OPSN` et `Departement`.
     * 
     * ## Vers un MCD idéal
     * On doit supprimer la relation «classer» entre Recommandation et Category.
     * On peut retrouver la catégorie en joignant la table à Question puis à Category.
     * Pour des raisons des redondance, on supprime la catégorie dans Recommandation.
     * 
     * Malgré le semblant de redondance, on doit conserver la relation «classer» entre Question et Category.
     * On aurait pu se dire que tous les thèmes ont une catégorie et toutes les questions ont un thème
     * mais c'est plus compliqué que ça. Les questions sont forcément liées à une catégorie et sont parfois
     * liées à un thème. Les thèmes sont des sortes de sous-catégories. On aurait aussi pu imaginer que les
     * catégories puissent être organisées en arborescence.
     * 
     * On doit supprimer la relation «associer» entre CollectiviteAnswer et Question.
     * On peut retrouver la question en joignant la table à Answer puis à Question.
     * Pour des raisons des redondance, on supprime la question dans CollectiviteAnswer.
     * 
     * On doit ajouter un id à Score, c'est Doctrine qui l'impose. On a désormais un BIGINT sur le champs id.
     * 
     * On supprime `forgotPasswordId` et `forgotPasswordAt` dans User et Admin car on a mis en place une solution proposée par Symfony.
     * 
     * On supprime `TemporarySiret` qui disparaîtra lorsque l'Éco-clic sera ouverte à toutes les collectivités.
     */

    public function getDescription(): string
    {
        return 'Normalisation des tables après la création des entités';
    }
    
    public function up(Schema $schema): void
    {
        // Les quatre prochaines requêtes sont irréversibles, elles n'ont pas d'équivalent dans down()
        // On en profite pour supprimer les OPSNId dans OPSN_Departement qui n'existent pas dans la table OPSN
        $this->addSql('DELETE FROM OPSN_Departement where OPSNId IN (
            SELECT * FROM (
                SELECT OPSNId
                FROM OPSN_Departement AS od
                LEFT JOIN OPSN AS o ON od.OPSNId = o.Id
                WHERE Id IS NULL GROUP BY OPSNId
            ) AS liste_a_supprimer
        );');
        // On supprime les CollectiviteID qui n'existenet pas dans
        $this->addSql('DELETE FROM utilisateurReponse where CollectiviteId IN (
            SELECT * FROM (
                SELECT CollectiviteId
                FROM utilisateurReponse AS ca
                LEFT JOIN collectivite AS c ON ca.CollectiviteId = c.id
                WHERE c.id IS NULL
                GROUP BY CollectiviteId
            ) AS liste_a_supprimer
        );');
        // On supprime les réponses de collectivités dont l'id de la réponse n'existe pas dans la table Reponse
        $this->addSql('DELETE FROM utilisateurReponse where IdReponse IN (
            SELECT * FROM (
                SELECT ca.IdReponse as IdReponse
                FROM utilisateurReponse AS ca
                LEFT JOIN reponse AS a ON ca.IdReponse = a.id
                WHERE a.id IS NULL
                GROUP BY ca.id
            ) AS liste_a_supprimer
        );');
        // Pareil pour historiqueScore
        $this->addSql('DELETE FROM historiqueScore where CollectiviteId IN (
            SELECT * FROM (
                SELECT CollectiviteId
                FROM historiqueScore AS ca
                LEFT JOIN collectivite AS c ON ca.CollectiviteId = c.id
                WHERE c.id IS NULL
                GROUP BY CollectiviteId
            ) AS liste_a_supprimer
        );');
        // Lors du nettoyage, des identifiants en double on été trouvés dans la base de données. Voici une requête pour les supprimer. Si on suppose que les doublons existent seulement pour les utilisateurs qui n'ont pas pu vérifier leur compte (mauvaise adresse email, par exemple), et qui en aurait recréé un qui fonctionne, on supprime donc les utilisateurs dont l'Identifiant est en doublon et IsVerifie est à 0 (false)
        $this->addSql('DELETE FROM utilisateur
        WHERE Identifiant IN (
        SELECT Identifiant FROM (
            SELECT Identifiant, COUNT(*) AS total
            FROM utilisateur
            GROUP BY Identifiant
        ) AS calcul
        WHERE total > 1
        ) AND IsVerifie = 0;');
        $this->addSql('DELETE FROM reponse where Id IN (
            SELECT * FROM (
                select reponse.Id
                from reponse
                left join question on question.Id = reponse.IdQuestion
                WHERe question.Id IS null
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM collectivite where Id IN (
            SELECT * FROM (
                SELECT collectivite.Id
                FROM collectivite
                LEFT JOIN OPSN ON collectivite.OPSNId = OPSN.Id
                WHERE OPSN.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM utilisateurReponse where Id IN (
            SELECT * FROM (
                SELECT utilisateurReponse.Id
                FROM utilisateurReponse
                LEFT JOIN reponse ON utilisateurReponse.IdReponse = reponse.Id
                WHERE reponse.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM utilisateurReponse where Id IN (
            SELECT * FROM (
                SELECT utilisateurReponse.Id
                FROM utilisateurReponse
                LEFT JOIN collectivite ON utilisateurReponse.CollectiviteId = collectivite.Id
                WHERE collectivite.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM utilisateurReponse where Id IN (
            SELECT * FROM (
                SELECT utilisateurReponse.Id
                FROM utilisateurReponse
                LEFT JOIN question ON utilisateurReponse.IdQuestion = question.Id
                WHERE question.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM recommandation where Id IN (
            SELECT * FROM (
                SELECT recommandation.Id
                FROM recommandation
                LEFT JOIN question ON recommandation.IdQuestion = question.Id
                WHERE question.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM question where Id IN (
            SELECT * FROM (
                SELECT question.Id
                FROM question
                LEFT JOIN question q2 ON question.IdParent = q2.Id
                WHERE question.IdParent is not null and q2.Id IS NULL 
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM reponse where Id IN (
            SELECT * FROM (
                select reponse.Id
                from reponse
                left join question on question.Id = reponse.IdQuestion
                WHERe question.Id IS null
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM recommandation where Id IN (
            SELECT * FROM (
                SELECT recommandation.Id
                FROM recommandation
                LEFT JOIN question ON recommandation.IdQuestion = question.Id
                WHERE question.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM recommandation where Id IN (
            SELECT * FROM (
                SELECT recommandation.Id
                FROM recommandation
                LEFT JOIN question ON recommandation.IdQuestion = question.Id
                WHERE question.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM ref_Population where Id IN (
            SELECT * FROM (
                SELECT ref_Population.Id
                FROM ref_Population
                LEFT JOIN ref_TypeCollectivite ON ref_Population.TypeCollectivite = ref_TypeCollectivite.Id
                WHERE ref_TypeCollectivite.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM utilisateurStatut where Id IN (
            SELECT * FROM (
                SELECT utilisateurStatut.Id
                FROM utilisateurStatut
                LEFT JOIN recommandation ON utilisateurStatut.RecommandationId = recommandation.Id
                WHERE recommandation.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM utilisateurReponse where Id IN (
            SELECT * FROM (
                SELECT utilisateurReponse.Id
                FROM utilisateurReponse
                LEFT JOIN utilisateur ON utilisateurReponse.UtilisateurId = utilisateur.Id
                WHERE utilisateur.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM ref_RecoIndicateur where Id IN (
            SELECT * FROM (
                SELECT ref_RecoIndicateur.Id
                FROM ref_RecoIndicateur
                LEFT JOIN recommandation ON ref_RecoIndicateur.RecommandationId = recommandation.Id
                WHERE recommandation.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM ref_RecoActivable where IdRecommandation IN (
            SELECT * FROM (
                select ref_RecoActivable.IdRecommandation FROM ref_RecoActivable
                LEFT JOIN recommandation ON ref_RecoActivable.IdRecommandation = recommandation.Id
                WHERE recommandation.id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM ref_RecoActivable where CollectiviteId IN (
            SELECT * FROM (
                select ref_RecoActivable.CollectiviteId FROM ref_RecoActivable
                LEFT JOIN collectivite ON ref_RecoActivable.CollectiviteId = collectivite.Id
                WHERE collectivite.id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM ref_RecoActivable where IdRecommandation IN (
            SELECT * FROM (
                select ref_RecoActivable.IdRecommandation FROM ref_RecoActivable
                LEFT JOIN recommandation ON ref_RecoActivable.IdRecommandation = recommandation.Id
                WHERE recommandation.id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM ref_RecoActivable where IdQuestion IN (
            SELECT * FROM (
                select ref_RecoActivable.IdQuestion FROM ref_RecoActivable
                LEFT JOIN question ON ref_RecoActivable.IdQuestion = question.Id
                WHERE question.id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM ref_ReponseReco where RecommandationId IN (
            SELECT * FROM (
                SELECT ref_ReponseReco.RecommandationId FROM ref_ReponseReco
                LEFT JOIN recommandation ON ref_ReponseReco.RecommandationId = recommandation.Id
                WHERE recommandation.Id IS NULL
            ) AS liste_a_supprimer
        );');
        $this->addSql('DELETE FROM ref_ReponseReco where ReponseId IN (
            SELECT * FROM (
                SELECT ref_ReponseReco.ReponseId FROM ref_ReponseReco
                LEFT JOIN reponse ON ref_ReponseReco.ReponseId = reponse.Id
                WHERE reponse.Id IS NULL
            ) AS liste_a_supprimer
        );');

        // Le tableau initialement appelée `historiqueScore` devient `score`. 
        // Doctrine impose d'utiliser un identifiant avec toutes les entités sans exception.
        // C'est une contrainte discutable mais on va s'y plier par simplicité.
        // On va ajouter une colone `id` en première position et y affecter automatiquement des id.
        $this->addSql('ALTER TABLE `historiqueScore` ADD COLUMN `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL UNIQUE FIRST;');

        // Reprise de la migration auto-générée
        // $this->addSql('ALTER TABLE Administrateur DROP INDEX Identifiant, ADD UNIQUE INDEX UNIQ_FF8F2A304F98863B (Identifiant)');
        // $this->addSql('DROP INDEX OPSNId ON Administrateur');
        // $this->addSql('ALTER TABLE Administrateur CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdMotDePasseOublie IdMotDePasseOublie CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE DateMotDePasseOublie DateMotDePasseOublie DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE OPSNId OPSNId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX Code ON Departement');
        $this->addSql('DROP INDEX CodeRegion ON Departement');
        $this->addSql('ALTER TABLE Departement ADD PRIMARY KEY (Code)');
        $this->addSql('ALTER TABLE OPSN CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE Actif Actif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE OPSN_Departement CHANGE OPSNId OPSNId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE OPSN_Departement ADD CONSTRAINT FK_BC35EDDFBF07875A FOREIGN KEY (OPSNId) REFERENCES OPSN (Id)');
        $this->addSql('ALTER TABLE OPSN_Departement ADD CONSTRAINT FK_BC35EDDF839E14D2 FOREIGN KEY (DepartementCode) REFERENCES Departement (Code)');
        $this->addSql('ALTER TABLE OPSN_Departement RENAME INDEX opsnid TO IDX_BC35EDDFBF07875A');
        $this->addSql('ALTER TABLE OPSN_Departement RENAME INDEX departementcode TO IDX_BC35EDDF839E14D2');
        $this->addSql('ALTER TABLE categorie CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX OPSNId ON collectivite');
        $this->addSql('ALTER TABLE collectivite CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE TypeId TypeId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE OPSNId OPSNId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX CollectiviteId ON historiqueScore');
        $this->addSql('ALTER TABLE historiqueScore CHANGE CollectiviteId CollectiviteId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE Date Date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX id ON historiqueScore;');
        $this->addSql('ALTER TABLE preference CHANGE UtilisateurId UtilisateurId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', ADD PRIMARY KEY (UtilisateurId, Code)');
        $this->addSql('DROP INDEX IdCategorie ON question');
        $this->addSql('DROP INDEX IdTheme ON question');
        $this->addSql('ALTER TABLE question CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdTheme IdTheme CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX IdCategorie ON recommandation');
        $this->addSql('DROP INDEX IdCategorie_2 ON recommandation');
        $this->addSql('ALTER TABLE recommandation CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE NiveauReco NiveauReco SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE ref_TypeCollectivite CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX IdQuestion ON reponse');
        $this->addSql('ALTER TABLE reponse CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX IdCategorie ON theme');
        $this->addSql('ALTER TABLE theme CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX CollectiviteId ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE CollectiviteId CollectiviteId CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdMotDePasseOublie IdMotDePasseOublie CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE DateMotDePasseOublie DateMotDePasseOublie DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B34F98863B ON utilisateur (Identifiant)');
        $this->addSql('DROP INDEX IdQuestion ON utilisateurReponse');
        $this->addSql('DROP INDEX IdReponse ON utilisateurReponse');
        $this->addSql('DROP INDEX IdUtilisateur ON utilisateurReponse');
        $this->addSql('ALTER TABLE utilisateurReponse CHANGE Id Id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE IdReponse IdReponse CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE CollectiviteId CollectiviteId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE Date Date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE `historiqueScore` DROP PRIMARY KEY;');        
        $this->addSql('ALTER TABLE `historiqueScore` DROP `Id`;');        
        // $this->addSql('ALTER TABLE Administrateur DROP INDEX UNIQ_FF8F2A304F98863B, ADD INDEX Identifiant (Identifiant)');
        // $this->addSql('ALTER TABLE Administrateur CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdMotDePasseOublie IdMotDePasseOublie CHAR(36) DEFAULT NULL, CHANGE DateMotDePasseOublie DateMotDePasseOublie DATETIME DEFAULT NULL, CHANGE OPSNId OPSNId CHAR(36) DEFAULT NULL');
        // $this->addSql('CREATE INDEX OPSNId ON Administrateur (OPSNId)');
        $this->addSql('CREATE INDEX Code ON Departement (Code)');
        $this->addSql('CREATE INDEX CodeRegion ON Departement (CodeRegion)');
        $this->addSql('ALTER TABLE Departement DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE OPSN CHANGE Id Id CHAR(36) NOT NULL, CHANGE Actif Actif INT NOT NULL');
        $this->addSql('ALTER TABLE OPSN_Departement DROP FOREIGN KEY FK_BC35EDDFBF07875A');
        $this->addSql('ALTER TABLE OPSN_Departement DROP FOREIGN KEY FK_BC35EDDF839E14D2');
        $this->addSql('ALTER TABLE OPSN_Departement CHANGE OPSNId OPSNId CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE OPSN_Departement RENAME INDEX idx_bc35eddf839e14d2 TO DepartementCode');
        $this->addSql('ALTER TABLE OPSN_Departement RENAME INDEX idx_bc35eddfbf07875a TO OPSNId');
        $this->addSql('ALTER TABLE categorie CHANGE Id Id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE collectivite CHANGE Id Id CHAR(36) NOT NULL, CHANGE TypeId TypeId CHAR(36) NOT NULL, CHANGE OPSNId OPSNId CHAR(36) DEFAULT NULL');
        $this->addSql('CREATE INDEX OPSNId ON collectivite (OPSNId)');
        $this->addSql('ALTER TABLE historiqueScore CHANGE CollectiviteId CollectiviteId CHAR(36) NOT NULL, CHANGE Date Date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('CREATE INDEX CollectiviteId ON historiqueScore (CollectiviteId)');
        $this->addSql('DROP INDEX `primary` ON preference');
        $this->addSql('ALTER TABLE preference CHANGE UtilisateurId UtilisateurId CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdTheme IdTheme CHAR(36) NOT NULL, CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL');
        $this->addSql('CREATE INDEX IdCategorie ON question (IdCategorie)');
        $this->addSql('CREATE INDEX IdTheme ON question (IdTheme)');
        $this->addSql('ALTER TABLE recommandation CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL, CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL, CHANGE NiveauReco NiveauReco INT DEFAULT 1 NOT NULL');
        $this->addSql('CREATE INDEX IdCategorie ON recommandation (IdQuestion)');
        $this->addSql('CREATE INDEX IdCategorie_2 ON recommandation (IdCategorie)');
        $this->addSql('ALTER TABLE ref_TypeCollectivite CHANGE Id Id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE reponse CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL');
        $this->addSql('CREATE INDEX IdQuestion ON reponse (IdQuestion)');
        $this->addSql('UPDATE theme SET IdCategorie = \'\' WHERE IdCategorie IS NULL');
        $this->addSql('ALTER TABLE theme CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdCategorie IdCategorie CHAR(36) NOT NULL');
        $this->addSql('CREATE INDEX IdCategorie ON theme (IdCategorie)');
        $this->addSql('DROP INDEX UNIQ_1D1C63B34F98863B ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur CHANGE Id Id CHAR(36) NOT NULL, CHANGE CollectiviteId CollectiviteId CHAR(36) DEFAULT NULL, CHANGE IdMotDePasseOublie IdMotDePasseOublie CHAR(36) DEFAULT NULL, CHANGE DateMotDePasseOublie DateMotDePasseOublie DATETIME DEFAULT NULL');
        $this->addSql('CREATE INDEX CollectiviteId ON utilisateur (CollectiviteId)');
        $this->addSql('ALTER TABLE utilisateurReponse CHANGE Id Id CHAR(36) NOT NULL, CHANGE IdQuestion IdQuestion CHAR(36) NOT NULL, CHANGE IdReponse IdReponse CHAR(36) NOT NULL, CHANGE CollectiviteId CollectiviteId CHAR(36) NOT NULL, CHANGE Date Date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('CREATE INDEX IdQuestion ON utilisateurReponse (IdQuestion)');
        $this->addSql('CREATE INDEX IdReponse ON utilisateurReponse (IdReponse)');
        $this->addSql('CREATE INDEX IdUtilisateur ON utilisateurReponse (CollectiviteId)');
    }
}
