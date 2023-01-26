<?php

class DbRecommandation
{
    public static function GetRecomandationFiltres()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("select categorie.Id, categorie.Nom, null as IdCategorie, Ordre from categorie
                UNION
                Select theme.Id, theme.Theme, theme.IdCategorie, null from theme
                WHERE theme.Id != '0'
                order by Ordre");
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

    public static function GetRecommandations()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT recommandation.Id as 'recommandationId', recommandation.Titre, recommandation.Text, question.Question,theme.Id as themeId, theme.Theme, categorie.Id as categorieId, categorie.Nom as 'Categorie', categorie.Img as Img 
                FROM `recommandation`
                INNER JOIN question
                INNER JOIN theme
                INNER JOIN categorie
                WHERE recommandation.IdQuestion = question.Id
                AND question.IdTheme = theme.Id
                AND question.IdCategorie = categorie.Id
                Order by categorie.Ordre");
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Titre = AjaxHelper::ToUtf8($row->Titre);
                $row->Text = AjaxHelper::ToUtf8($row->Text);
                $row->Question = AjaxHelper::ToUtf8($row->Question);
                $row->Theme = AjaxHelper::ToUtf8($row->Theme);
                $row->Categorie = AjaxHelper::ToUtf8($row->Categorie);
                $row->Img = AjaxHelper::ToUtf8($row->Img);
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function GetRecommandationsCateg($Id, $CollectiviteId)
    {
        
        // requete à faire
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT recommandation.Id, recommandation.Titre, recommandation.Text, categorie.Nom
            FROM `recommandation`
            INNER JOIN categorie ON recommandation.IdCategorie = categorie.Id
            INNER JOIN utilisateurReponse ON recommandation.IdQuestion = utilisateurReponse.IdQuestion
            INNER JOIN reponse ON utilisateurReponse.IdReponse = reponse.Id
            WHERE IdCategorie = :id
            AND utilisateurReponse.CollectiviteId = :CollectiviteId
            AND reponse.Ponderation = 0");
            $req->execute(array(":id" => $Id, ":CollectiviteId" => $CollectiviteId));

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