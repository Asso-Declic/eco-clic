<?php

class DbAdministrateur
{
    public static function GetIdAdmin($logging, $password)
    {
        $bdd = PdoHelper::getInstance();
        //on prepare la requete
        $req = $bdd->DataBase->prepare("SELECT Id as UserID FROM Administrateur WHERE  Identifiant=:login AND MotDePasse=:mdp AND Actif=1");
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

    //permet de renvoyer le dernier ticket d'un Administrateur doné
    public static function GetToken($AdministrateurId)
    {
        $bdd = PdoHelper::getInstance();
        //on prepare la requete
        $req = $bdd->DataBase->prepare("SELECT Token  FROM Administrateur WHERE Id = :AdministrateurId");
        $req->execute(array(':AdministrateurId' => $AdministrateurId));

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

    public static function SetToken($AdministrateurId, $token)
    {
        $bdd = PdoHelper::getInstance();
        $req = $bdd->DataBase->prepare("UPDATE Administrateur  SET Token = :token WHERE Id = :AdministrateurId");
        $req->bindParam(':token', $token);
        $req->bindParam(':AdministrateurId', $AdministrateurId);
        $req->execute();
    }

    public static function GetUtilisateur($utilisateurId)
    {
        try {
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT Nom, Prenom, Identifiant, lower(Mail) as Mail, Actif, SuperAdmin, OPSNId, Id FROM Administrateur WHERE Id = :utilisateurId');
            $req->execute(array(':utilisateurId' => $utilisateurId));

            $utilisateurDb = $req->fetch(PDO::FETCH_OBJ);
            $utilisateur = new Utilisateur;

            $utilisateur->Nom = AjaxHelper::ToUtf8($utilisateurDb->Nom);
            $utilisateur->Prenom = AjaxHelper::ToUtf8($utilisateurDb->Prenom);
            $utilisateur->Identifiant = AjaxHelper::ToUtf8($utilisateurDb->Identifiant);
            $utilisateur->Mail = AjaxHelper::ToUtf8($utilisateurDb->Mail);
            $utilisateur->Actif = $utilisateurDb->Actif;
            $utilisateur->SuperAdmin = $utilisateurDb->SuperAdmin;
            $utilisateur->OPSNId = $utilisateurDb->OPSNId;
            $utilisateur->Id = $utilisateurId;
            $result = $utilisateur;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result =  -1;
        }
        return $result;
    }

    public static function GetUtilisateurs()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT Id, Nom, Prenom, Identifiant, lower(Mail) as Mail, Actif, MotDePasse 
            FROM Administrateur 
            order by Nom');
            $req->execute();

            while ($AdministrateurDb = $req->fetch(PDO::FETCH_OBJ)) {
                $Administrateur = new Utilisateur;
                if ($AdministrateurDb->MotDePasse != "") {
                    $Administrateur->MotDePasse = 1;
                } else {
                    $Administrateur->MotDePasse = 0;
                }
                $Administrateur->Nom = AjaxHelper::ToUtf8($AdministrateurDb->Nom);
                $Administrateur->Prenom = AjaxHelper::ToUtf8($AdministrateurDb->Prenom);
                $Administrateur->Mail = AjaxHelper::ToUtf8($AdministrateurDb->Mail);
                $Administrateur->Id = $AdministrateurDb->Id;
                $Administrateur->Identifiant = $AdministrateurDb->Identifiant;
                if ($AdministrateurDb->Id != SessionHelper::GetCurrentUser()->Id) {
                    $Administrateur->Actif = $AdministrateurDb->Actif;
                } else {
                    $Administrateur->Actif = "self";
                }
                $result[] = $Administrateur;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result =  -1;
        }
        return $result;
    }

    public static function UpdateUtilisateur($Administrateur)
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
                $requete = ("UPDATE Administrateur
                        SET `Nom` = :AdministrateurNom,
                        `Prenom` = :AdministrateurPrenom,
                        `Identifiant` = :AdministrateurIdentifiant,
                        `Mail` = lower(:AdministrateurMail),
                        `Actif` = :AdministrateurActif
                        WHERE `Id` = :AdministrateurId");
            }

            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(
                ":AdministrateurId" => $Administrateur->Id,
                ":AdministrateurNom" => $Administrateur->Nom,
                ":AdministrateurPrenom" => $Administrateur->Prenom,
                ":AdministrateurIdentifiant" => $Administrateur->Identifiant,
                ":AdministrateurMail" => $Administrateur->Mail,
                ":AdministrateurActif" => $Administrateur->Actif
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

    public static function GetIdDisponibility($Identifiant)
    {
        try {
            $result = '';
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $bdd->DataBase->exec("SET CHARACTER SET utf8");
            $req = $bdd->DataBase->prepare("SELECT Identifiant, Id FROM `Administrateur` 
            WHERE Identifiant = :Identifiant");
            $req->execute(array(":Identifiant" => $Identifiant));

            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $result = new stdClass;
                $result->Id = $row->Id;
                $result->Identifiant = AjaxHelper::ToUtf8($row->Identifiant);
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return -1;
        }
        return $result;
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
                $requete = ("INSERT INTO Administrateur
            (`Id`,
            `Nom`,
            `Prenom`,
            `Identifiant`,
            `Actif`,
            `MotDePasse`,
            `SuperAdmin`,
            `OPSNId`,
            `Mail`)
            VALUES
            (:utilisateurId,
            :utilisateurNom,
            :utilisateurPrenom,
            :utilisateurIdentifiant,
            :utilisateurActif,
            :utilisateurPass,
            :utilisateurSuperAdmin,
            :utilisateurOPSNId,
            lower(:utilisateurMail))");
            }

            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(
                ":utilisateurId" => $uid,
                ":utilisateurNom" => $utilisateur->Nom,
                ":utilisateurPrenom" => $utilisateur->Prenom,
                ":utilisateurIdentifiant" => $utilisateur->Identifiant,
                ":utilisateurActif" => $utilisateur->Actif,
                ":utilisateurPass" => $utilisateur->Password,
                ":utilisateurSuperAdmin" => $utilisateur->SuperAdmin,
                ":utilisateurOPSNId" => $utilisateur->OPSNId,
                ":utilisateurMail" => $utilisateur->Mail
            ));

            if ($isTransaction == 0) {
                $bdd->DataBase->commit();
            }
            if ($success = 1) {
                MailHelper::SendMailInscriptionAdministrateur($utilisateur->Mail, $uid);
            }
            $return = $success;
        } catch (PDOException $e) {
            $return = -1;
            $bdd->DataBase->rollBack();
            echo 'ERROR: ' . $e->getMessage();
        }
        return $return;
    }

    public static function UpdateActif($userId, $actif)
    {
        $bdd = PdoHelper::getInstance();
        $req = $bdd->DataBase->prepare("UPDATE Administrateur  SET Actif = :actif WHERE Id = :userId");
        $req->bindParam(':userId', $userId);
        $req->bindParam(':actif', $actif);
        $req->execute();
    }

    public static function UpdatePasswordAdmin($UserId, $Password)
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
                $requete = ("UPDATE Administrateur
                        SET `MotDePasse` = :password
                        WHERE `Id` = :AdministrateurId");
            }

            $req = $bdd->DataBase->prepare($requete);
            $req->execute(array(
                ":password" => $Password,
                ":AdministrateurId" => $UserId
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

    public static function UpdateAdminProfil($utilisateur)
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
                $requete = ("UPDATE Administrateur
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

    public static function GetUtilisateursSA()
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT Id, Nom, Prenom, Identifiant, lower(Mail) as Mail, Actif, MotDePasse 
            FROM Administrateur 
            where SuperAdmin = 1
            order by Nom');
            $req->execute();

            while ($AdministrateurDb = $req->fetch(PDO::FETCH_OBJ)) {
                $Administrateur = new Utilisateur;
                if ($AdministrateurDb->MotDePasse != "") {
                    $Administrateur->MotDePasse = 1;
                } else {
                    $Administrateur->MotDePasse = 0;
                }
                $Administrateur->Nom = AjaxHelper::ToUtf8($AdministrateurDb->Nom);
                $Administrateur->Prenom = AjaxHelper::ToUtf8($AdministrateurDb->Prenom);
                $Administrateur->Mail = AjaxHelper::ToUtf8($AdministrateurDb->Mail);
                $Administrateur->Id = $AdministrateurDb->Id;
                $Administrateur->Identifiant = $AdministrateurDb->Identifiant;
                if ($AdministrateurDb->Id != SessionHelper::GetCurrentUser()->Id) {
                    $Administrateur->Actif = $AdministrateurDb->Actif;
                } else {
                    $Administrateur->Actif = "self";
                }
                $result[] = $Administrateur;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result =  -1;
        }
        return $result;
    }

    public static function GetUtilisateursOPSN($OPSNId)
    {
        try {
            $result = [];
            $bdd = PdoHelper::getInstance();
            //on prepare la requete
            $req = $bdd->DataBase->prepare('SELECT Id, Nom, Prenom, Identifiant, lower(Mail) as Mail, Actif, MotDePasse 
            FROM Administrateur 
            where SuperAdmin = 0 and OPSNId = :opsnId
            order by Nom');
            $req->execute(array("opsnId" => $OPSNId));

            while ($AdministrateurDb = $req->fetch(PDO::FETCH_OBJ)) {
                $Administrateur = new Utilisateur;
                if ($AdministrateurDb->MotDePasse != "") {
                    $Administrateur->MotDePasse = 1;
                } else {
                    $Administrateur->MotDePasse = 0;
                }
                $Administrateur->Nom = AjaxHelper::ToUtf8($AdministrateurDb->Nom);
                $Administrateur->Prenom = AjaxHelper::ToUtf8($AdministrateurDb->Prenom);
                $Administrateur->Mail = AjaxHelper::ToUtf8($AdministrateurDb->Mail);
                $Administrateur->Id = $AdministrateurDb->Id;
                $Administrateur->Identifiant = AjaxHelper::ToUtf8($AdministrateurDb->Identifiant);
                if ($AdministrateurDb->Id != SessionHelper::GetCurrentUser()->Id) {
                    $Administrateur->Actif = $AdministrateurDb->Actif;
                } else {
                    $Administrateur->Actif = "self";
                }
                $result[] = $Administrateur;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            $result =  -1;
        }
        return $result;
    }

    public static function CheckPassActuel($Id)
    {
        $bdd = PdoHelper::getInstance();
        //on prepare la requete
        $req = $bdd->DataBase->prepare("SELECT `MotDePasse` FROM `Administrateur` WHERE `Id` = :id");
        $req->execute(array(':id' => $Id));
        while ($row = $req->fetch(PDO::FETCH_OBJ)) {
            $result = $row->MotDePasse;
        }
        return $result;
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
                $req = $bdd->DataBase->prepare("UPDATE `Administrateur` SET `MotDePasse`=:password, IdMotDePasseOublie=null, DateMotDePasseOublie=null WHERE  IdMotDePasseOublie = :id");
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
                $req = $bdd->DataBase->prepare("UPDATE `Administrateur` SET `IdMotDePasseOublie`=:IdMDP,`DateMotDePasseOublie`=now() WHERE Mail = lower(:mail)");
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
}
