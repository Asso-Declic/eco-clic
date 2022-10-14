<?php

class DbQuestion
{

    public static function GetQuestionCateg($IdCateg)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT question.Id, question.Question, question.Definition, theme.Theme, categorie.Nom as 'Categorie', question.Multiple, question.InfoComplementaire
                FROM `question` 
                INNER JOIN theme
                INNER JOIN categorie
                WHERE question.IdTheme = theme.Id
                AND question.IdCategorie = categorie.Id
                AND question.IdCategorie = :IdCateg");
            $req->execute(array(":IdCateg" => $IdCateg));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Question = AjaxHelper::ToUtf8($row->Question);
                $row->Definition = AjaxHelper::ToUtf8($row->Definition);
                $row->InfoComplementaire = AjaxHelper::ToUtf8($row->InfoComplementaire);
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
    
}