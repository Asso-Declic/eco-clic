<?php

class DbCategorie
{
    public static function GetCategories()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT * FROM `categorie` order by `Ordre`");
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $row->Img = AjaxHelper::ToUtf8($row->Img);
                $row->Description = AjaxHelper::ToUtf8($row->Description);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function InsertCateg($reponse)
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
                $req = $bdd->DataBase->prepare("INSERT INTO categorie (Id, Nom, Img, Description) VALUES (:categId, :titreCateg, :imgCateg, :descCateg)");
                $req->execute(array(":categId" => $reponse->categId, ":descCateg" => $reponse->descCateg, ":titreCateg" => $reponse->titreCateg, ":imgCateg" => $reponse->imgCateg));
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

    public static function UpdateCateg($reponse)
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
                $req = $bdd->DataBase->prepare("UPDATE categorie SET Nom = :titreCateg, Img = :imgCateg, Description = :descCateg WHERE Id = :categId");
                $req->execute(array(":categId" => $reponse->categId, ":descCateg" => $reponse->descCateg, ":titreCateg" => $reponse->titreCateg, ":imgCateg" => $reponse->imgCateg));
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

    public static function SupCateg($IdSup)
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
                    $req = $bdd->DataBase->prepare("DELETE FROM categorie WHERE Id = :categId");
                    $req->execute(array(":categId" => $IdSup[$i]));
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

    public static function getCategorieInfo()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT categorie.Id, categorie.Nom, categorie.Img, COUNT(question.IdCategorie) as nbQuestion, 
                (SELECT COUNT(recommandation.IdCategorie) FROM `recommandation` where recommandation.IdCategorie = categorie.Id) as nbReco
                FROM `categorie`
                INNER JOIN `question`
                WHERE question.IdCategorie = categorie.Id 
                GROUP BY question.IdCategorie
                Order by categorie.Ordre");
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $row->Img = AjaxHelper::ToUtf8($row->Img);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;

    }

    public static function GetCategId($Id)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT * FROM `categorie` WHERE Id = :id");
            $req->execute(array(":id" => $Id));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $row->Img = AjaxHelper::ToUtf8($row->Img);
                $row->Description = AjaxHelper::ToUtf8($row->Description);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;

    }
    
}