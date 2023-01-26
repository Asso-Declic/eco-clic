<?php

class DbTheme
{
    public static function getThemes()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT * FROM `theme`");
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Theme = AjaxHelper::ToUtf8($row->Theme);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function InsertTheme($reponse)
    {
        try {

            // $uid = Guid::NewGuid();
            $success = 1;

            $bdd = PdoHelper::getInstance();

            if ($bdd->DataBase->inTransaction()) {
                $isTransaction = 1;
            } else {
                $isTransaction = 0;
                $bdd->DataBase->beginTransaction();
            }

            if ($success == 1) {
                $req = $bdd->DataBase->prepare("INSERT INTO theme (Id, Theme, IdCategorie) VALUES (UUID(), :theme, :categId)");
                $req->execute(array(":theme" => $reponse->theme, ":categId" => $reponse->categId));
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

    public static function UpdateTheme($reponse)
    {
        try {

            // $uid = Guid::NewGuid();
            $success = 1;

            $bdd = PdoHelper::getInstance();

            if ($bdd->DataBase->inTransaction()) {
                $isTransaction = 1;
            } else {
                $isTransaction = 0;
                $bdd->DataBase->beginTransaction();
            }

            if ($success == 1) {
                $req = $bdd->DataBase->prepare("UPDATE theme SET Theme = :theme, IdCategorie = :categId WHERE Id = :themeId");
                $req->execute(array(":theme" => $reponse->theme, ":categId" => $reponse->categId, ":themeId" => $reponse->themeId));
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

    public static function SupTheme($IdSup)
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
                for ($i=0; $i < count($IdSup); $i++) { 
                    $req = $bdd->DataBase->prepare("DELETE FROM theme WHERE Id = :themeId");
                    $req->execute(array(":themeId" => $IdSup[$i]));
                }
                
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
}