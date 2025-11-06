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
        try {
            $responseJson = $this->httpClient->request(
                'GET',
                'https://api.insee.fr/api-sirene/3.11/siret/' . $siret,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'X-INSEE-Api-Key-Integration' => $_ENV['INSEE_API_AUTH'],
                    ],
                ]
            )->getContent();

            $response = json_decode($responseJson);

            // Vérification si le header contient un statut d'erreur
            if (isset($response->header->statut) && $response->header->statut >= 400) {
                throw new \Exception('Erreur ' . $response->header->statut . ': ' . $response->header->message);
            }

            // Retourne l'objet établissement si présent, sinon tout le retour
            return $response->etablissement ?? $response;

        } catch (\Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface $e) {
            throw new \Exception('Erreur HTTP lors de la requête à l’API INSEE : ' . $e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception('Erreur lors de la récupération des données Sirene : ' . $e->getMessage());
        }
    }
}
