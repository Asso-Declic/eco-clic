<?php

class Dbutilisateur
{
    public static function GetIdDisponibility($Identifiant)
    {
        try {
            $result = '';
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT Identifiant FROM `utilisateur` 
            WHERE Identifiant = :Identifiant");
            $req->execute(array(":Identifiant" => $Identifiant));

            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $result = $row['Identifiant'];
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }
    //permet de renvoyer le dernier ticket d'un utilisateur doné
    public static function GetToken($utilisateurId)
    {
        $bdd = PdoHelper::getInstance();
        //on prepare la requete
        $req = $bdd->DataBase->prepare("SELECT Token  FROM utilisateur WHERE Id = :utilisateurId");
        $req->execute(array(':utilisateurId' => $utilisateurId));

        $nbre_lignes = $req->rowCount();

        if ($nbre_lignes == 1) {
            while ($ligne = $req->fetch(PDO::FETCH_OBJ))
                $token = $ligne->Token;
            if ($token === NULL) {
                $result = -1;
            } else {
                $result = $token;
            }
        } else {
            $result = -1;
        }

        return $result;
    }


    public static function GetId($logging, $password)
    {
        $bdd = PdoHelper::getInstance();
        //on prepare la requete
        $req = $bdd->DataBase->prepare("SELECT Id as UserID FROM utilisateur WHERE  Identifiant=:login AND MotDePasse=:mdp AND Actif=1");
        $req->execute(array(':login' => $logging, ':mdp' => $password));

        $nbre_lignes = $req->rowCount();


        if ($nbre_lignes == 1) {
            while ($ligne = $req->fetch(PDO::FETCH_OBJ)) {
                $result = $ligne->UserID;
            }
        } else {
            $result = -1;
        }

        return $result;
    }


    public static function SetToken($utilisateurId, $token)
    {
        $bdd = PdoHelper::getInstance();
        $req = $bdd->DataBase->prepare("UPDATE utilisateur  SET Token = :token WHERE Id = :utilisateurId");
        $req->bindParam(':token', $token);
        $req->bindParam(':utilisateurId', $utilisateurId);
        $req->execute();
    }

    public static function GetUtilisateur($utilisateurId)
    {
        try {
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT Nom, Prenom, lower(Mail) as Mail, Identifiant, CollectiviteId, Actif, 
            Admin, SuperAdmin FROM utilisateur WHERE Id = :utilisateurId');
            $req->execute(array(':utilisateurId' => $utilisateurId));

            $utilisateurDb = $req->fetch(PDO::FETCH_OBJ);
            $utilisateur = new utilisateur;

            $utilisateur->Nom = AjaxHelper::ToUtf8($utilisateurDb->Nom);
            $utilisateur->Prenom = AjaxHelper::ToUtf8($utilisateurDb->Prenom);
            $utilisateur->Mail = AjaxHelper::ToUtf8($utilisateurDb->Mail);
            $utilisateur->CollectiviteId = $utilisateurDb->CollectiviteId;
            $utilisateur->Identifiant = $utilisateurDb->Identifiant;
            $utilisateur->Actif = $utilisateurDb->Actif;
            $utilisateur->Admin = $utilisateurDb->Admin;
            $utilisateur->SuperAdmin = $utilisateurDb->SuperAdmin;
            $utilisateur->Id = $utilisateurId;
            $result = $utilisateur;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result =  -1;
        }
        return $result;
    }

    public static function GetUtilisateurByMail($adresseMail)
    {
        try {
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT Id, Nom, Prenom, AdresseMail FROM utilisateur WHERE AdresseMail = :adresseMail');
            $req->execute(array(':adresseMail' => $adresseMail));

            $utilisateurDb = $req->fetch(PDO::FETCH_OBJ);
            $utilisateur = new utilisateur;

            $utilisateur->Nom = AjaxHelper::ToUtf8($utilisateurDb->Nom);
            $utilisateur->Prenom = AjaxHelper::ToUtf8($utilisateurDb->Prenom);
            $utilisateur->AdresseMail = AjaxHelper::ToUtf8($utilisateurDb->AdresseMail);
            $utilisateur->Id = AjaxHelper::ToUtf8($utilisateurDb->Id);
            $utilisateur->Droits = DbDroit::GetDroits($utilisateur->Id);
            $result = $utilisateur;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result =  -1;
        }
        return $result;
    }

    public static function GetUtilisateurName($utilisateurId)
    {
        try {
            $result = '';
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT CONCAT(Prenom, " ", Nom) as Name FROM utilisateur WHERE Id = :utilisateurId');
            $req->execute(array(':utilisateurId' => $utilisateurId));

            $utilisateurDb = $req->fetch(PDO::FETCH_OBJ);


            $result = AjaxHelper::ToUtf8($utilisateurDb->Name);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result =  -1;
        }
        return $result;
    }

    public static function GetUtilisateurActif()
    {
        try {
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT Id as Code, CONCAT(Prenom, " ", Nom) As Libelle FROM utilisateur WHERE actif=1 Order by Nom, Prenom');
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $result[] =  $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result = -1;
        }
        return $result;
    }

    public static function GetUtilisateurInfos()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT Id, Nom, Prenom, AdresseMail, Actif FROM utilisateur');
            $req->execute();

            //$utilisateur = New utilisateur;

            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result =  -1;
        }
        return $result;
    }

    public static function UpdateUtilisateurActif($value, $utilisateurId)
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
                $requete = ("UPDATE utilisateur
              SET Actif = :actif
              WHERE Id = :utilisateurId");
            }

            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(":actif" => $value, ":utilisateurId" => $utilisateurId));

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

    public static function InsertUtilisateur($utilisateur)
    {
        try {
            $success = 1;
            $uid = Guid::NewGuid();

            $bdd = PdoHelper::getInstance();

            if ($bdd->DataBase->inTransaction()) {
                $isTransaction = 1;
            } else {
                $isTransaction = 0;
                $bdd->DataBase->beginTransaction();
            }

            if ($success == 1) {
                $bdd->DataBase->exec("SET CHARACTER SET utf8");
                $requete = ("INSERT INTO utilisateur
            (`Id`,
            `Nom`,
            `Prenom`,
            `Identifiant`,
            `Actif`,
            `Admin`,
            `MotDePasse`,
            `CGU`,
            `CollectiviteId`,
            `Mail`)
            VALUES
            (:utilisateurId,
            :utilisateurNom,
            :utilisateurPrenom,
            :utilisateurIdentifiant,
            :utilisateurActif,
            :utilisateurAdmin,
            :utilisateurPass,
            :utilisateurCGU,
            :utilisateurCollectiviteId,
            lower(:utilisateurMail))");
            }

            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(
                ":utilisateurId" => $uid,
                ":utilisateurNom" => $utilisateur->Nom,
                ":utilisateurPrenom" => $utilisateur->Prenom,
                ":utilisateurIdentifiant" => $utilisateur->Identifiant,
                ":utilisateurActif" => $utilisateur->Actif,
                ":utilisateurAdmin" => $utilisateur->Admin,
                ":utilisateurPass" => $utilisateur->Password,
                ":utilisateurCGU" => $utilisateur->CGU,
                ":utilisateurCollectiviteId" => $utilisateur->CollectiviteId,
                ":utilisateurMail" => $utilisateur->Mail
            ));

            if ($isTransaction == 0) {
                $bdd->DataBase->commit();
            }

            if ($success = 1) {
                MailHelper::SendMailInscriptionUtilisateur($utilisateur->Mail, $uid);
            }
            $return = $success;
        } catch (PDOException $e) {
            $return = -1;
            $bdd->DataBase->rollBack();
            echo 'ERROR: ' . $e->getMessage();
        }
        return $return;
    }

    public static function GetUtilisateurs()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT utilisateur.Id as Id, utilisateur.Nom as Nom, Collectivite.Nom as Col, Prenom, Identifiant, lower(Mail) as Mail, Actif, Admin FROM utilisateur 
            INNER JOIN Collectivite on Collectivite.Id = utilisateur.CollectiviteId order by Nom');
            $req->execute();

            while ($utilisateurDb = $req->fetch(PDO::FETCH_OBJ)) {
                $utilisateur = new utilisateur;

                $utilisateur->Nom = AjaxHelper::ToUtf8($utilisateurDb->Nom);
                $utilisateur->Prenom = AjaxHelper::ToUtf8($utilisateurDb->Prenom);
                $utilisateur->Mail = AjaxHelper::ToUtf8($utilisateurDb->Mail);
                $utilisateur->Col = $utilisateurDb->Col;
                $utilisateur->Id = $utilisateurDb->Id;
                $utilisateur->Identifiant = $utilisateurDb->Identifiant;
                $utilisateur->Actif = $utilisateurDb->Actif;
                $utilisateur->Admin = $utilisateurDb->Admin;
                $result[] = $utilisateur;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result =  -1;
        }
        return $result;
    }

    public static function UpdateUtilisateur($utilisateur)
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
                $requete = ("UPDATE utilisateur
                        SET `Nom` = :utilisateurNom,
                        `Prenom` = :utilisateurPrenom,
                        `Identifiant` = :utilisateurIdentifiant,
                        `Mail` = lower(:utilisateurMail),
                        `Actif` = :utilisateurActif,
                        `Admin` = :utilisateurAdmin
                        WHERE `Id` = :utilisateurId");
            }

            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(
                ":utilisateurId" => $utilisateur->Id,
                ":utilisateurNom" => $utilisateur->Nom,
                ":utilisateurPrenom" => $utilisateur->Prenom,
                ":utilisateurIdentifiant" => $utilisateur->Identifiant,
                ":utilisateurMail" => $utilisateur->Mail,
                ":utilisateurActif" => $utilisateur->Actif,
                ":utilisateurAdmin" => $utilisateur->Admin
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

    public static function GetUtilisateursByCollectivite($CollectiviteId)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT Id, Nom, Prenom, Identifiant, lower(Mail) as Mail, Actif, Admin, MotDePasse FROM utilisateur 
            where CollectiviteId = :collectiviteId
            order by Nom');
            $req->execute(array(":collectiviteId" => $CollectiviteId));

            while ($utilisateurDb = $req->fetch(PDO::FETCH_OBJ)) {
                $utilisateur = new utilisateur;
                if ($utilisateurDb->MotDePasse != "") {
                    $utilisateur->MotDePasse = 1;
                } else {
                    $utilisateur->MotDePasse = 0;
                }
                $utilisateur->Nom = AjaxHelper::ToUtf8($utilisateurDb->Nom);
                $utilisateur->Prenom = AjaxHelper::ToUtf8($utilisateurDb->Prenom);
                $utilisateur->Mail = AjaxHelper::ToUtf8($utilisateurDb->Mail);
                $utilisateur->Id = $utilisateurDb->Id;
                $utilisateur->Identifiant = $utilisateurDb->Identifiant;
                if ($utilisateurDb->Id != SessionHelper::GetCurrentUser()->Id) {
                    $utilisateur->Actif = $utilisateurDb->Actif;
                    $utilisateur->Admin = $utilisateurDb->Admin;
                } else {
                    $utilisateur->Actif = "self";
                    $utilisateur->Admin = "self";
                }
                $result[] = $utilisateur;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result =  -1;
        }
        return $result;
    }

    public static function UpdateActif($userId, $actif)
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
                $req = $bdd->DataBase->prepare("UPDATE utilisateur  SET Actif = :actif WHERE Id = :userId");
                $req->execute(array(':userId' => $userId, ':actif' => $actif));
            }

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

    public static function UpdateUtilisateurProfil($utilisateur)
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
                $requete = ("UPDATE utilisateur
                        SET `Nom` = :utilisateurNom,
                        `Prenom` = :utilisateurPrenom,
                        `Identifiant` = :utilisateurIdentifiant,
                        `Mail` = lower(:utilisateurMail)
                        WHERE `Id` = :utilisateurId");
            }

            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(
                ":utilisateurNom" => $utilisateur->Nom,
                ":utilisateurPrenom" => $utilisateur->Prenom,
                ":utilisateurIdentifiant" => $utilisateur->Identifiant,
                ":utilisateurMail" => $utilisateur->Mail,
                ":utilisateurId" => $utilisateur->Id
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

    public static function UpdatePasswordUser($UserId, $Password)
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
                $requete = ("UPDATE utilisateur
                        SET `MotDePasse` = :password
                        WHERE `Id` = :utilisateurId");
            }

            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(
                ":password" => $Password,
                ":utilisateurId" => $UserId
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

    public static function CheckPassActuel($Id)
    {
        $bdd = PdoHelper::getInstance();
        //on prepare la requete
        $req = $bdd->DataBase->prepare("SELECT `MotDePasse` FROM `utilisateur` WHERE `Id` = :id");
        $req->execute(array(':id' => $Id));
        while ($row = $req->fetch(PDO::FETCH_OBJ)) {
            $result = $row->MotDePasse;
        }
        return $result;
    }

    public static function InsertMDPOublie($mail, $IdMDPOublie)
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
                $req = $bdd->DataBase->prepare("UPDATE `utilisateur` SET `IdMotDePasseOublie`=:IdMDP,`DateMotDePasseOublie`=now() WHERE Mail = lower(:mail)");
                $req->execute(array(':IdMDP' => $IdMDPOublie, ':mail' => $mail));
            }

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

    public static function GetDateMDPOublie($IdMotDePasseOublie)
    {
        try {
            $result = null;
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT UNIX_TIMESTAMP(`DateMotDePasseOublie`) as IdMotDePasseOublie, MotDePasse FROM `utilisateur` WHERE `IdMotDePasseOublie` = :idMotDePasseOublie");
            $req->execute(array(':idMotDePasseOublie' => $IdMotDePasseOublie));
            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $result = $row;
            }
        } catch (PDOException $e) {
            $result = -1;
            $bdd->DataBase->rollBack();
            echo 'ERROR: ' . $e->getMessage();
        }
        return $result;
    }

    public static function UpdateMDPOublie($IdMotDePasseOublie, $password)
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
                $req = $bdd->DataBase->prepare("UPDATE `utilisateur` SET `MotDePasse`=:password, IdMotDePasseOublie=null, DateMotDePasseOublie=null WHERE IdMotDePasseOublie = :idMotDePasseOublie or Id = :id");
                $req->execute(array(':password' => $password, ':idMotDePasseOublie' => $IdMotDePasseOublie, ':id' => $IdMotDePasseOublie));
            }

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


    
    public static function SetMdp($Id, $password)
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
                $req = $bdd->DataBase->prepare("UPDATE `utilisateur` SET `MotDePasse`=:password, IdMotDePasseOublie=null, DateMotDePasseOublie=null WHERE IdMotDePasseOublie = :id");
                $req->execute(array(':password' => $password,  ':id' => $Id));
            }

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

    public static function newMdp($Id, $password)
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
                $req = $bdd->DataBase->prepare("UPDATE `utilisateur` SET `MotDePasse` = :password WHERE `utilisateur`.`Id` = :id");
                $req->execute(array(':password' => $password,  ':id' => $Id));
            }

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

    public static function getUserProgression($UserId)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT categorie.Id as CategorieId, utilisateurReponse.IdUtilisateur as UtilisateurId, count(DISTINCT(utilisateurReponse.IdQuestion)) as NbRepondu
            FROM `utilisateurReponse` 
            INNER JOIN question
            INNER JOIN categorie
            WHERE utilisateurReponse.IdQuestion = question.Id
            AND question.IdCategorie = categorie.Id
            AND utilisateurReponse.IdUtilisateur = :UserId
            GROUP BY categorie.Id");
            $req->execute(array(':UserId' => $UserId));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function getUserScore($UserId)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT SUM(reponse.Ponderation) as score, COUNT(reponse.Ponderation) as nb
                FROM `reponse`, `utilisateurReponse` 
                WHERE utilisateurReponse.IdUtilisateur = :UserId
                AND utilisateurReponse.IdReponse = reponse.Id");
            $req->execute(array(':UserId' => $UserId));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }

    public static function getUserProgressionCateg($UserId, $CategId)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare("SELECT categorie.Id as CategorieId, utilisateurReponse.IdUtilisateur as UtilisateurId, count(DISTINCT(utilisateurReponse.IdQuestion)) as NbRepondu
            FROM `utilisateurReponse` 
            INNER JOIN question
            INNER JOIN categorie
            WHERE utilisateurReponse.IdQuestion = question.Id
            AND question.IdCategorie = categorie.Id
            AND utilisateurReponse.IdUtilisateur = :UserId
            AND categorie.Id = :CategId
            GROUP BY categorie.Id");
            $req->execute(array(':UserId' => $UserId, ':CategId' => $CategId));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $result[] = $row;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
    }
    
}
