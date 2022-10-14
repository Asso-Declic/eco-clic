<?php

class DbRecommandation
{
    public static function GetRecommandations()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT recommandation.Id as 'recommandationId', recommandation.Titre, recommandation.Text, question.Question,theme.Id as themeId, theme.Theme, categorie.Id as categorieId, categorie.Nom as 'Categorie' 
                FROM `recommandation`
                INNER JOIN question
                INNER JOIN theme
                INNER JOIN categorie
                WHERE recommandation.IdQuestion = question.Id
                AND question.IdTheme = theme.Id
                AND question.IdCategorie = categorie.Id");
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Titre = AjaxHelper::ToUtf8($row->Titre);
                $row->Text = AjaxHelper::ToUtf8($row->Text);
                $row->Question = AjaxHelper::ToUtf8($row->Question);
                $row->Theme = AjaxHelper::ToUtf8($row->Theme);
                $row->Categorie = AjaxHelper::ToUtf8($row->Categorie);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function GetRecommandationsCateg($Id)
    {
        
        // requete à faire
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT recommandation.Id, recommandation.Titre, recommandation.Text, categorie.Nom 
                FROM `recommandation`, `categorie` WHERE recommandation.IdCategorie = categorie.Id AND IdCategorie = :id");
            $req->execute(array(":id" => $Id));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Titre = AjaxHelper::ToUtf8($row->Titre);
                $row->Text = AjaxHelper::ToUtf8($row->Text);
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }
}