<?php
include_once('../Config.php');
class Token
{
    // permet de varifier l'etat du jeton envoyé par le client (conformité, validité)
    // retourne l'ID du user si le jeton est valide
    // retourne -1 si le jeton est permié ou non conforme
    public static function CheckToken()
    {
        //on decode le jeton
        $jwt = $_COOKIE['TokenCB'];
        $decoded = JWT::decode($jwt, Config::read('token.key'), array('HS256'));
        $decoded_array = (array) $decoded;
        $exp = $decoded_array['exp'];
        $utilisateurId = $decoded_array['userId'];

        //on verifie si le jeton n'est pas perimé
        if (time() > $exp) {
            $result = -1;
        } else {
            $userToken = DbUtilisateur::GetToken($utilisateurId);
            /*print "\n\r\n\r\n\r";
            print "token2:\n";
            print_r($userToken);*/
            if ($userToken != -1) {
                //on verifie si le ticket est bien conforme
                if ($jwt != $userToken) {
                    $result = -1;
                } else {
                    $result = $utilisateurId;
                }
            } else {
                $result = -1;
            }
        }
        return $result;
    }

    //permet de generer un nouveai ticket JWT pour un user.
    //le ticket est ensuite stoké en base et dans les cookies
    public static function GeneratToken($utilisateurId)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + Config::read('token.validite');
        $payload = array(
            'userId' => $utilisateurId,
            'iat' => $issuedAt,
            'exp' => $expirationTime,
        );
        $alg = 'HS256';
        $token = JWT::encode($payload, Config::read('token.key'), $alg);
        setcookie("TokenCB", $token, time() + 3600 * 24, "/");
        //setcookie("userId", $utilisateurId, time() + 3600 * 24, "/");
        DbUtilisateur::SetToken($utilisateurId, $token);
    }

    // permet de varifier l'etat du jeton envoyé par le client (conformité, validité)
    // retourne l'ID du user si le jeton est valide
    // retourne -1 si le jeton est permié ou non conforme
    public static function CheckUserTokenValidity($utilisateurId)
    {
    
        //on decode le jeton
        $jwt = DbUtilisateur::GetToken($utilisateurId);

        if ($jwt != -1 ) {

            $decoded = JWT::decode($jwt, Config::read('token.key'), array('HS256'));
            $decoded_array = (array) $decoded;
            $exp = $decoded_array['exp'];
            $utilisateurId = $decoded_array['userId'];

            //on verifie si le jeton n'est pas perimé
            if (time() > $exp) {
                $result = -1;
            } else {
                $result = 1;
            }
        } else {
            $result = -1;
        }
        return $result;
    }

        // permet de varifier l'etat du jeton envoyé par le client (conformité, validité)
    // retourne l'ID du user si le jeton est valide
    // retourne -1 si le jeton est permié ou non conforme
    public static function CheckTokenAdmin()
    {
        //on decode le jeton
        $jwt = $_COOKIE['TokenAdmin'];
        $decoded = JWT::decode($jwt, Config::read('token.key'), array('HS256'));
        $decoded_array = (array) $decoded;
        $exp = $decoded_array['exp'];
        $utilisateurId = $decoded_array['userId'];

        //on verifie si le jeton n'est pas perimé
        if (time() > $exp) {
            $result = -1;
        } else {
            $userToken = DbAdministrateur::GetToken($utilisateurId);
            /*print "\n\r\n\r\n\r";
            print "token2:\n";
            print_r($userToken);*/
            if ($userToken != -1) {
                //on verifie si le ticket est bien conforme
                if ($jwt != $userToken) {
                    $result = -1;
                } else {
                    $result = $utilisateurId;
                }
            } else {
                $result = -1;
            }
        }
        return $result;
    }

    // Permet de verifier si le ticket a atteint la moité de sa durée de vie
    public static function CheckTokenAdminValidity()
    {
        //on decode le jeton
        $jwt = $_COOKIE['TokenAdmin'];
        $decoded = JWT::decode($jwt, Config::read('token.key'), array('HS256'));
        $decoded_array = (array) $decoded;
        $exp = $decoded_array['exp'];

        $result = 1;
        //on verifie si le jeton n'est pas perimé
        if (time()+ (Config::read('token.validite')/2) > $exp) {
            $result = -1;
        }
       
        return $result;
    }    

    //permet de generer un nouveai ticket JWT pour un user.
    //le ticket est ensuite stoké en base et dans les cookies
    public static function GeneratTokenAdmin($utilisateurId)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + Config::read('token.validite');
        $payload = array(
            'userId' => $utilisateurId,
            'iat' => $issuedAt,
            'exp' => $expirationTime,
        );
        $alg = 'HS256';
        $token = JWT::encode($payload, Config::read('token.key'), $alg);
        setcookie("TokenAdmin", $token, time() + 3600 * 24, "/");
        DbAdministrateur::SetToken($utilisateurId, $token);
    }


    // permet de varifier l'etat du jeton envoyé par le client (conformité, validité)
    // retourne l'ID du user si le jeton est valide
    // retourne -1 si le jeton est permié ou non conforme
    public static function CheckUserTokenAdminValidity($utilisateurId)
    {
    
        //on decode le jeton
        $jwt = DbAdministrateur::GetToken($utilisateurId);

        if ($jwt != -1 ) {

            $decoded = JWT::decode($jwt, Config::read('token.key'), array('HS256'));
            $decoded_array = (array) $decoded;
            $exp = $decoded_array['exp'];
            $utilisateurId = $decoded_array['userId'];

            //on verifie si le jeton n'est pas perimé
            if (time() > $exp) {
                $result = -1;
            } else {
                $result = 1;
            }
        } else {
            $result = -1;
        }
        return $result;
    }
}
