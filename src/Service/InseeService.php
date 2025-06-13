<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class InseeService
{
    public function __construct(
        private HttpClientInterface $httpClient,
    )
    {}

    public function getPostalCode(string $siret)
    {
        $response = $this->getInformationFomSiret($siret);

        $informations = [];
        if (isset($response->adresseEtablissement)) {
            $informations['CodePostal'] = $response->adresseEtablissement->codePostalEtablissement;
        } else {
            $informations = $response;
        }

        return $informations;
    }

    public function getInformationFomSiret(string $siret)
    {
        $token = $this->getToken();
        $responseJson = $this->httpClient->request(
            'GET',
            'https://api.insee.fr/entreprises/sirene/V3.11/siret/' . $siret,
            [
                'headers' => [
                    'Accept: application/json',
                    'Authorization: Bearer ' . $token,
                ],
                'body' => ['grant_type' => 'client_credentials'],
            ]
        )->getContent();
        $response = json_decode($responseJson);

        if ($response->header->statut >= 400) {
            throw new \Exception('Erreur ' . $response->header->statut . ': ' . $response->header->message);
        }

        return $response->etablissement;
    }

    public function getToken()
    {
        $responseJson = $this->httpClient->request(
            'POST',
            'https://api.insee.fr/token',
            [
                'headers' => [
                    'Authorization: Basic ' . $_ENV['INSEE_API_AUTH'],
                    'Content-Type: application/x-www-form-urlencoded'
                ],
                'body' => ['grant_type' => 'client_credentials'],
            ]
        )->getContent();

        $response = json_decode($responseJson);
        return $response->access_token;
    }
}