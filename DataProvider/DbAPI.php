<?php

class DbAPI
{ 
    public static function GetInformationBySiret($Siret)
    {

        $token = static::GetToken();

        $curl = curl_init();


        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.insee.fr/entreprises/sirene/V3/siret/'.$Siret,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Accept: application/json',
              'Authorization: Bearer '.$token,
            ),
          ));

        $responseJson = curl_exec($curl);

        $response = json_decode($responseJson);
        curl_close($curl);
        $Information = new stdClass();

        $Information->CodePostal = $response->etablissement->adresseEtablissement->codePostalEtablissement;
       

        return $Information;
    }

    public static function GetToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.insee.fr/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic dFBKdzhuSEJ0OVVRM29OU290dzN1SkFfNjNBYTpIMG5rVzNuQktRUmdEYkNsYUpaeVlQUGJQUEFh',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = json_decode(curl_exec($curl));

        return $response->access_token;

        curl_close($curl);
    }
}