<?php

class DbCollectivite
{

    public static function GetAvance($CollectiviteId)
    {
        try {

            $requete = "SELECT COUNT('IdQuestion') / (SELECT COUNT('question.Question') FROM `question`) *100 as avancee 
                FROM `utilisateurReponse` 
                WHERE `CollectiviteId` = :collectiviteId";
            $result = "";
            $bdd = PdoHelper::getInstance();
            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(":collectiviteId" => $CollectiviteId));
            
            $row = $req->fetch(PDO::FETCH_OBJ);
            $result = AjaxHelper::ToUtf8($row->avancee);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result = -1;
        }
        return $result;
    }

    public static function GetDetailAvance($CollectiviteId)
    {
        try {

            $requete = "SELECT categorie.Id as CategorieId, categorie.Nom as Categorie, categorie.Img,
                IFNULL((select floor((count(DISTINCT(utilisateurReponse.IdQuestion))/(select COUNT(question.IdCategorie) 
                FROM question WHERE question.IdCategorie = categorie.Id))*100) 
                FROM `categorie`
                INNER JOIN question
                INNER JOIN utilisateurReponse
                WHERE utilisateurReponse.IdQuestion = question.Id
                AND question.IdCategorie = categorie.Id
                AND utilisateurReponse.CollectiviteId = :collectiviteId
                AND categorie.Id = CategorieId
                GROUP BY categorie.Id),0) as detailAvancee
                FROM `categorie`";
            $result = [];
            $bdd = PdoHelper::getInstance();
            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(":collectiviteId" => $CollectiviteId));
            
            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Categorie = AjaxHelper::ToUtf8($row->Categorie);
                $result[] =  $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result = -1;
        }
        return $result;
    }

    public static function InsertHistoriqueScore($CollectiviteId, $score) {
        try {

            $success = 1;

            $bdd = PdoHelper::getInstance();

            if ($bdd->DataBase->inTransaction()) {
                $isTransaction = 1;
            } else {
                $isTransaction = 0;
                $bdd->DataBase->beginTransaction();
            }

            if ($success == 1) {
                $req = $bdd->DataBase->prepare("INSERT INTO historiqueScore (CollectiviteId, Score, Date) VALUES (:CollectiviteId, :Score, now())");
                $req->execute(array(":CollectiviteId" => $CollectiviteId, ":Score" => $score));
            }

            if ($isTransaction == 0) {
                $bdd->DataBase->commit();
            }
            $result = $success;

        } catch (PDOException $e) {
            $result = -1;
            $bdd->DataBase->rollBack();
            echo 'ERROR: ' . $e->getMessage();
        }
        return $result;
    }

    public static function GetScoreTotal($DepartementCode, $CodeRegion, $CollectiviteId)
    {
        try {

            $requete = 
            "SELECT (
                SELECT floor(SUM(reponse.Ponderation)/COUNT(reponse.Ponderation)*100)
                                FROM `reponse`, `utilisateurReponse`
                                WHERE utilisateurReponse.CollectiviteId = :collectiviteId
                                AND utilisateurReponse.IdReponse = reponse.Id
                                HAVING COUNT(reponse.Ponderation)=(SELECT COUNT(Question) FROM `question`))as VotreScore, 
                (SELECT floor(SUM(reponse.Ponderation)/COUNT(reponse.Ponderation)*100)
                                FROM `reponse`, `utilisateurReponse`, `collectivite`
                                WHERE collectivite.DepartementCode = :departementCode
                                AND utilisateurReponse.IdReponse = reponse.Id
                                AND utilisateurReponse.CollectiviteId = collectivite.Id
                                AND (SELECT (SUM(reponse.Ponderation)/COUNT(reponse.Ponderation)*100)
                                         FROM `reponse`, `utilisateurReponse`
                                         WHERE utilisateurReponse.IdReponse = reponse.Id
                                         AND utilisateurReponse.CollectiviteId = collectivite.Id
                                         HAVING COUNT(reponse.Ponderation)=(SELECT COUNT(Question) FROM `question`)) IS NOT NULL)as ScoreDepartemental,
                (SELECT floor(SUM(reponse.Ponderation)/COUNT(reponse.Ponderation)*100)
                                FROM `reponse`, `utilisateurReponse`, `collectivite`, `Departement`
                                WHERE Departement.CodeRegion = :codeRegion
                                AND utilisateurReponse.IdReponse = reponse.Id
                                AND Departement.Code = collectivite.DepartementCode
                                AND utilisateurReponse.CollectiviteId = collectivite.Id
                                AND (SELECT (SUM(reponse.Ponderation)/COUNT(reponse.Ponderation)*100)
                                         FROM `reponse`, `utilisateurReponse`
                                         WHERE utilisateurReponse.IdReponse = reponse.Id
                                         AND utilisateurReponse.CollectiviteId = collectivite.Id
                                         HAVING COUNT(reponse.Ponderation)=(SELECT COUNT(Question) FROM `question`)) IS NOT NULL)as ScoreRegional";
            $result = [];
            $bdd = PdoHelper::getInstance();
            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(":departementCode" => $DepartementCode, ":codeRegion" => $CodeRegion, ":collectiviteId" => $CollectiviteId));
            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                // if ($row->VotreScore == 0) {
                //     $row->VotreScore = null;
                // }
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result = -1;
        }
        return $result;
    }

    public static function InsertCollectivite($collectivite)
    {
        try {
            $success = 1;

            $bdd = PdoHelper::getInstance();

            if ($bdd->DataBase->inTransaction()) {
                $isTransaction = 1;
            } else {
                $isTransaction = 0;
                $bdd->DataBase->beginTransaction();
            }

            if ($success == 1) {
                $bdd->DataBase->exec("SET CHARACTER SET utf8");
                $requete = ("INSERT INTO collectivite
            (`Id`,
            `Nom`,
            `Siret`,
            `TypeId`,
            `DepartementCode`,
            `Latitude`,
            `Longitude`,
            `Population`)
            VALUES
            (:collectiviteId,
            :collectiviteNom,
            :collectiviteSiret,
            :collectiviteType,
            :collectiviteCP,
            :collectiviteLatitude,
            :collectiviteLongitude,
            :collectivitePopulation)");
            }

            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(
                ":collectiviteId" => $collectivite->Id,
                ":collectiviteNom" => $collectivite->Nom,
                ":collectiviteSiret" => $collectivite->Siret,
                ":collectiviteType" => $collectivite->Type,
                ":collectiviteCP" => $collectivite->CodePostal,
                ":collectiviteLatitude" => $collectivite->Latitude,
                ":collectiviteLongitude" => $collectivite->Longitude,
                ":collectivitePopulation" => $collectivite->Population
            ));

            if ($isTransaction == 0) {
                $bdd->DataBase->commit();
            }
            $return = $success;
        } catch (PDOException $e) {
            $return = -1;
            $bdd->DataBase->rollBack();
            echo 'ERROR: ' . $e->getMessage();
        }
        return $return;
    }

    public static function GetSiretDisponibility($Siret)
    {
        try {
            $result = '';
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT Siret FROM `collectivite` 
            WHERE Siret = :Siret");
            $req->execute(array(":Siret" => $Siret));

            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $result = $row['Siret'];
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function GetCodeRegionAndDepartementByCollectiviteId($CollectiviteId)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT `DepartementCode`, Departement.CodeRegion FROM `collectivite` 
            INNER JOIN Departement ON Departement.Code = collectivite.DepartementCode
            WHERE Id = :collectiviteId");
            $req->execute(array(":collectiviteId" => $CollectiviteId));

            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function GetCollectivites()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT `Id` FROM `collectivite`");
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row = $row->Id;
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function GetCollectivitesInfos()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT collectivite.Id, collectivite.Nom, `DepartementCode` as Departement, ref_TypeCollectivite.Nom as Type FROM `collectivite` 
            INNER JOIN ref_TypeCollectivite ON ref_TypeCollectivite.Id = collectivite.TypeId");
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function GetCollectivitesInfosOPSN($OPSNId)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT collectivite.Id, collectivite.Nom, `DepartementCode` as Departement, ref_TypeCollectivite.Nom as Type FROM `collectivite` 
            INNER JOIN ref_TypeCollectivite ON ref_TypeCollectivite.Id = collectivite.TypeId
            WHERE OPSNId = :OPSNId");
            $req->execute(array(":OPSNId" => $OPSNId));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function GetInfoColId($Id)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT collectivite.Id, collectivite.Siret, collectivite.Nom, `DepartementCode` as Departement, ref_TypeCollectivite.Nom as Type FROM `collectivite` 
            INNER JOIN ref_TypeCollectivite ON ref_TypeCollectivite.Id = collectivite.TypeId WHERE collectivite.Id = :id");
            $req->execute(array(":id" => $Id));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function GetRefTypeCol()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT Id, Nom FROM `ref_TypeCollectivite`");
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function GetCollectiviteType($Id)
    {
        try {
            $result = "";
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT `TypeId` FROM `collectivite` WHERE Id = :id");
            $req->execute(array(":id" => $Id));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $result = $row->TypeId;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function checkSiretConnu($Siret)
    {
        try {
            $result = '';
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT Siret FROM `Siret_Temporaire` 
            WHERE Siret = :Siret");
            $req->execute(array(":Siret" => $Siret));

            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $result = $row['Siret'];
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }
}
