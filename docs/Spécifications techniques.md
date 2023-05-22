# Spécifications techniques

## Sécurité (accès aux routes selon les rôles)

## API Interne
Il existe une API interne utilisée par l'interface en front. Elle est accessible uniquement depuis l'application.

API Rest, avec son standard
https://restfulapi.net/


### Authentification 
L'authentification se fait par la session. Les règles dans `security.yaml` définissent donc que les pages et les routes API sont accessibles uniquement en étant connecté, sauf pour `/inscription`, `/connexion` et `/déconnexion`