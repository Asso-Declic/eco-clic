<?php

class DbCollectivite
{

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
}
