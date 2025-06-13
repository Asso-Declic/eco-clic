<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510103745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Il semblerait que la BDD aie à la fois du latin-1 et de l\'utf8. Cette migration impose de l\'utf8mb4 partout.';
    }

    public function up(Schema $schema): void
    {
        // Pas besoin de convertir la base, elle est déjà en utf8mb4 mais
        // $this->addSql('ALTER TABLE Administrateur CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE Departement CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE OPSN CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE OPSN_Departement CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE Siret_Temporaire CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE categorie CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE collectivite CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE historiqueScore CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE preference CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE question CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE recommandation CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE ref_NiveauReco CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE ref_TypeCollectivite CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE reponse CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE theme CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE utilisateur CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE utilisateurReponse CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE ref_RecoRessource CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE ref_RecoIndicateur CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE ref_RecoActivable CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        $this->addSql('ALTER TABLE ref_ReponseReco CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
    }

    public function down(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE Administrateur COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE Departement COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE OPSN COLLATE latin1_swedish_ci;');
        $this->addSql('ALTER TABLE OPSN_Departement COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE Siret_Temporaire COLLATE latin1_swedish_ci;');
        $this->addSql('ALTER TABLE categorie COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE collectivite COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE historiqueScore COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE preference COLLATE latin1_swedish_ci;');
        $this->addSql('ALTER TABLE question COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE recommandation COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE ref_NiveauReco COLLATE latin1_swedish_ci;');
        $this->addSql('ALTER TABLE ref_TypeCollectivite COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE reponse COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE theme COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE utilisateur COLLATE utf8mb3_general_ci;');
        $this->addSql('ALTER TABLE utilisateurReponse COLLATE utf8mb3_general_ci;');
    }
}
