<?php

class SessionHelper
{
    public static function InitSession($utilisateurId) {
        if(session_status() != PHP_SESSION_ACTIVE) 
        {
            session_start();
        }           

        $utilisateur = new Utilisateur;
        $utilisateur = DbUtilisateur::GetUtilisateur($utilisateurId);
        $_SESSION['CurrentUser'] = serialize($utilisateur);
        //RightHelper::LoadRights();
    }    
    
    public static function GetCurrentUser()
    {
        if(session_status() != PHP_SESSION_ACTIVE) 
        {
            session_start();
        }
        
        $utilisateur = new Utilisateur;
        $utilisateur = unserialize($_SESSION['CurrentUser']);
        if(!isset($utilisateur->Id) || $utilisateur->Id == null)
        {
            $utilisateurId = Token::CheckToken();
            static::InitSession($utilisateurId);
            $utilisateur = unserialize($_SESSION['CurrentUser']);
        }
       
        return $utilisateur;
    }

    public static function GetCurrentUserAdministrateur()
    {
        
        $utilisateur = new Utilisateur;
        $utilisateur = unserialize($_SESSION['CurrentUser']);
        if(!isset($utilisateur->Id) ||  $utilisateur->Id == null)
        {
            $utilisateurId = Token::CheckTokenAdmin();
            static::InitSessionAdmin($utilisateurId);
            $utilisateur = unserialize($_SESSION['CurrentUser']);
        }
        return $utilisateur;
    }

    public static function InitSessionAdmin($utilisateurId) {
        if(session_status() != PHP_SESSION_ACTIVE) 
        {
            session_start();
        }           

        $utilisateur = new Utilisateur;
        $utilisateur = DbAdministrateur::GetUtilisateur($utilisateurId);
        $_SESSION['CurrentUser'] = serialize($utilisateur);
        //RightHelper::LoadRights();
    }
}
?>