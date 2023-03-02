# eco-clic
Solution L'éco-clic: Pilotage de la sobriété numérique 

## Hébergemement de la solution sur une pile LAMP
### Serveur 
Pour le serveur, il est recommandé d'utiliser Linux et Apache 
### Base de données 
MySQL 
### Version de PHP 
La version de PHP utilisée pour l'application L'éco-clic est PHP 7.2 

Une fois l’infrastructure système prête, voici le déroulé pour pouvoir déployer la solution de l’éco-clic.
  
## Récupération du code
Il faut d’abord récupérer les sources du projet qui se trouve sur GitHub à l’emplacement suivant : https://github.com/Asso-Declic/eco-clic

## Dépôt des sources
Après récupération des sources du projet, dézipper les sources et de déposer le contenu du zip à l’emplacement souhaité (cet emplacement doit être accessible depuis le web). 

## Création de la base de données
Après récupération des sources, importer le script de création de base de données (ecoclimprod.sql) dans un outil dédié (PhpMyAdmin par ex) 

## Modification des éléments de connexion à la base de données
Une fois la base de données créée, se rendre dans les sources dans le fichier Config.php qui se trouve à la racine du projet, puis modifier le fichier afin de renseigner les informations de connexion à la base de données. 

Dans ce fichier, il faudra par ailleurs renseigner les éléments suivants : 
- information du serveur de mail
- nom de domaine.  

## Dépôt sur le serveur
Une fois les modifications apportées permettant la connexion à la base de données, déposer le dossier complet de la solution sur un serveur. 
