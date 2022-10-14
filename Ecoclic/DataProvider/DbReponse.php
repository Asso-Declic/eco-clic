<?php

class DbReponse
{

    public static function GetReponse($IdQuestion)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT reponse.Id, reponse.Type, reponse.Text, reponse.IdQuestion
                FROM `reponse`
                WHERE reponse.IdQuestion = :IdQuestion");
            $req->execute(array(":IdQuestion" => $IdQuestion));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Type = AjaxHelper::ToUtf8($row->Type);
                $row->Text = AjaxHelper::ToUtf8($row->Text);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;

    }

    public static function GetReponseUser($IdQuestion, $IdUtilisateur)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT utilisateurReponse.Id, utilisateurReponse.IdReponse, utilisateurReponse.InputText, utilisateurReponse.IdQuestion
                FROM `utilisateurReponse`
                WHERE utilisateurReponse.IdQuestion = :IdQuestion 
                AND utilisateurReponse.IdUtilisateur = :IdUtilisateur");
            $req->execute(array(":IdQuestion" => $IdQuestion, ":IdUtilisateur" => $IdUtilisateur));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Text = AjaxHelper::ToUtf8($row->InputText);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;

    }

    public static function InsertReponse($reponse)
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
                $req = $bdd->DataBase->prepare("INSERT INTO utilisateurReponse (Id, IdQuestion, IdReponse, IdUtilisateur, InputText) VALUES (UUID(), :IdQuestion,:IdReponse, :IdUtilisateur, :InputText)");
                $req->execute(array(":IdQuestion" => $reponse->QuestionId, ":IdReponse" => $reponse->ReponseId, ":IdUtilisateur" => $reponse->UserId, ":InputText" => $reponse->InputText));
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

    public static function DeleteReponse($reponse)
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
                $req = $bdd->DataBase->prepare("DELETE FROM `utilisateurReponse` WHERE IdQuestion = :IdQuestion AND IdUtilisateur = :IdUtilisateur");
                $req->execute(array(":IdQuestion" => $reponse->QuestionId, ":IdUtilisateur" => $reponse->UserId));
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