<?php

class DbPreference
{

    public static function GetPreference($utilisateurId, $preferenceCode)
    {
        try
        {
            $result = '';

            $bdd = PdoHelper::getInstance();
            //on prepare la requetei
            $requete = "SELECT  `Json` FROM `preference` WHERE `UtilisateurId` = :utilisateurId and `Code` = :preferenceCode;";

            $req = $bdd->DataBase->prepare($requete);

            $req->execute(array(':utilisateurId' => $utilisateurId, ':preferenceCode' => $preferenceCode));

            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $result = $row['Json'];
            }

        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result - 1;
        }
        return $result;
    }

    public static function DeletePreference($utilisateurId, $preferenceCode)
    {        
        try
        {
            $bdd = PdoHelper::getInstance();

            if ($bdd->DataBase->inTransaction()) {
                $isTransaction = 1;
            } else {
                $isTransaction = 0;
                $bdd->DataBase->beginTransaction();
            }

            //on prepare la requete
            $req = $bdd->DataBase->prepare('DELETE FROM preference WHERE UtilisateurId = :UtilisateurId and Code = :Code ;');
            $req->execute(array(':UtilisateurId' => $utilisateurId, ':Code' => $preferenceCode));

            if ($isTransaction == 0) {
                $bdd->DataBase->commit();
            }

            $result = 1;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $bdd->DataBase->rollBack();
            $result = -1;
        }
        return $result;
    }

    public static function InsertPreference($utilisateurId, $preferenceCode, $json)
    {
        try
        {
            $success = 1;
            $bdd = PdoHelper::getInstance();

            if ($bdd->DataBase->inTransaction()) {
                $isTransaction = 1;
            } else {
                $isTransaction = 0;
                $bdd->DataBase->beginTransaction();
            }

            $success =  static::DeletePreference($utilisateurId, $preferenceCode);
            if ($success == 1) {
                //on prepare la requete
                $req = $bdd->DataBase->prepare('INSERT INTO `preference`(`UtilisateurId`, `Code`, `Json`) VALUES (:utilisateurId, :preferenceCode, :json)');
                $req->execute(array(":utilisateurId" => $utilisateurId, ":preferenceCode" => $preferenceCode, ':json' => $json));
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
