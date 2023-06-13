<?php

namespace App\Service;

class InseeService
{
    public function getPostalCode(string $siret)
    {
        $response = $this->getInformationFomSiret($siret);

        $informations = [];
        if (isset($response->etablissement)) {
            $informations['CodePostal'] = $response->etablissement->adresseEtablissement->codePostalEtablissement;
        } else {
            $informations = $response;
        }

        return $informations;
    }

    public function getInformationFomSiret(string $siret)
    {
        $token = $this->getToken();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.insee.fr/entreprises/sirene/V3/siret/' . $siret,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Accept: application/json',
              'Authorization: Bearer ' . $token,
            ),
          ));
        $responseJson = curl_exec($curl);
        $response = json_decode($responseJson);
        curl_close($curl);

        return $response;
    }

    public function getToken()
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
            'Authorization: Basic ' . $_ENV['INSEE_API_AUTH'],
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = json_decode(curl_exec($curl));
        curl_close($curl);
        return $response->access_token;
    }
}