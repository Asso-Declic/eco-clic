<?php
class DbOPSN
{
    public static function GetOPSNS()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT `Id`, `Nom`, `DepartementCode`, `Actif`, `Mail` FROM `OPSN`");
            $req->execute();
            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom =  AjaxHelper::ToUtf8($row->Nom);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result = -1;
        }
        return $result;
    }

    public static function GetOPSN($id)
    {
        try {
            $result = '';
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT `Id`, 
            `Nom`, 
            `DepartementCode`, 
            `Actif`, 
            `Logo`, 
            `Telephone`, 
            `Mail`, 
            `Adresse`, 
            `Site_internet`,
            `Siret`,
            `Latitude`,
            `Longitude`
            FROM `OPSN` where Id = :id");
            $req->execute(array(":id" => $id));
            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom =  AjaxHelper::ToUtf8($row->Nom);
                $result = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result = -1;
        }
        return $result;
    }

    public static function GetOPSNSDepartements($OPSNId)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT `OPSNId`, `DepartementCode`, Departement.Nom FROM `OPSN_Departement` INNER JOIN Departement ON Departement.Code = DepartementCode WHERE `OPSNId` =  :id");
            $req->execute(array(":id" => $OPSNId));
            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result = -1;
        }
        return $result;
    }
    public static function GetDepartements()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT `Code`, `Nom` FROM `Departement`");
            $req->execute();
            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result = -1;
        }
        return $result;
    }

    public static function InsertOPSN($OPSN)
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
                //on prepare la requete
                $req = $bdd->DataBase->prepare(
                    'INSERT INTO `OPSN`(`Id`, `Nom`, `Mail`, `DepartementCode`, `Actif`) 
                VALUES (:id, :nom, :mail, :departement, 1)'
                );

                $req->execute(array(':id' => $OPSN->Id, ':nom' => $OPSN->Nom, ':mail' => $OPSN->Mail, ':departement' => $OPSN->Departement));
            }

            if ($isTransaction == 0) {
                $bdd->DataBase->commit();
            }
            $result = $success;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $bdd->DataBase->rollBack();
            $result = -1;
        }
        return $result;
    }

    public static function UpdateOPSN($OPSN)
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
                //on prepare la requete
                $req = $bdd->DataBase->prepare(
                    'UPDATE `OPSN` SET `Nom`=:nom,
                    `DepartementCode`=:departement,
                    `Actif`=:actif,
                    `Logo`=:logo,
                    `Telephone`=:telephone,
                    `Mail`=:mail,
                    `Adresse`=:adresse,
                    `Site_Internet`=:site_internet,
                    `Siret`=:siret,
                    `Latitude`=:latitude,
                    `Longitude`=:longitude
                    WHERE Id = :id'
                );

                $req->execute(array(
                    ':id' => $OPSN->Id,
                    ':nom' => $OPSN->Nom,
                    ':departement' => $OPSN->Departement,
                    ':actif' => $OPSN->Actif,
                    ':logo' => $OPSN->Logo,
                    ':telephone' => $OPSN->Telephone,
                    ':mail' => $OPSN->Mail,
                    ':adresse' => $OPSN->Adresse,
                    ':site_internet' => $OPSN->Site_internet,
                    ':siret' => $OPSN->Siret,
                    ':latitude' => $OPSN->Latitude,
                    ':longitude' => $OPSN->Longitude
                ));
            }

            if ($isTransaction == 0) {
                $bdd->DataBase->commit();
            }
            $result = $success;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $bdd->DataBase->rollBack();
            $result = -1;
        }
        return $result;
    }

    public static function SetDptTravail($OPSNId, $DepartementsCodes)
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
                //on prepare la requete
                $req = $bdd->DataBase->prepare('DELETE FROM `OPSN_Departement` WHERE OPSNId = :id');

                $req->execute(array(':id' => $OPSNId));
            }

            foreach ($DepartementsCodes as &$DepartementCode) {
                if ($success == 1) {
                    $bdd->DataBase->exec("SET CHARACTER SET utf8");
                    //on prepare la requete
                    $req = $bdd->DataBase->prepare(
                        'INSERT INTO `OPSN_Departement`(`OPSNId`, `DepartementCode`) VALUES (:id,:DepartementCode)'
                    );

                    $req->execute(array(':id' => $OPSNId, ':DepartementCode' => $DepartementCode));
                }
            }

            if ($isTransaction == 0) {
                $bdd->DataBase->commit();
            }
            $result = $success;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $bdd->DataBase->rollBack();
            $result = -1;
        }
        return $result;
    }

    public static function UpdateActifOPSN($OPSNId, $actif)
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
                //on prepare la requete
                $req = $bdd->DataBase->prepare(
                    'UPDATE `OPSN` SET `Actif`=:actif WHERE Id = :id'
                );

                $req->execute(array(':id' => $OPSNId, ':actif' => $actif));
            }

            if ($isTransaction == 0) {
                $bdd->DataBase->commit();
            }
            $result = $success;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $bdd->DataBase->rollBack();
            $result = -1;
        }
        return $result;
    }

    public static function RemoveRef($OPSNId)
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
                //on prepare la requete
                $req = $bdd->DataBase->prepare(
                    'UPDATE `OPSN` SET `MailReferant`=:MailReferant WHERE Id = :id'
                );

                $req->execute(array(':id' => $OPSNId, ':MailReferant' => null));
            }

            if ($isTransaction == 0) {
                $bdd->DataBase->commit();
            }
            $result = $success;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $bdd->DataBase->rollBack();
            $result = -1;
        }
        return $result;
    }
}
