# L'éco-clic
L'éco-clic est une solution de Pilotage de la sobriété numérique, distribuée en mode SaaS par l'association [Déclic](https://www.asso-declic.fr/) pour ses OPSN membres, ses partenaires, et pour les collectivités locales.

Retrouvez le guide utilisateur : https://asso-declic.gitbook.io/guide-utilisateur-leco-clic/presentation-generale/leco-clic

Retrouvez le code source : https://github.com/Asso-Declic/eco-clic

### Technos
- PHP >= 8.1
- MySQL == 5.7
- git
- composer

## Installation
L'éco-clic s'utilise directement sur nos serveurs. Vous pouvez contribuer au code ou juste apprendre comment il fonctionne. Si vous ne souhaitez pas utiliser le service SaaS proposé par Déclic, vous pouvez déployer votre propre instance indépendante.

Ces instructions d'installations sont destinées à la mise en production du projet. Il existe une version [pour les développeurs](Installation%20pour%20les%20devs.md)

### Code
L'éco-clic est développé avec Symfony et versionné avec git. Il faudra d'abord cloné le dépôt sur votre serveur :
```bash
# en HTTPS
git clone https://github.com/Asso-Declic/eco-clic.git
# en SSH
git@github.com:Asso-Declic/eco-clic.git
```
Une fois cloné, déplacez-vous dans le dossier du dépôt.
```bash
cd eco-clic
```
Il vous faudra utiliser [composer](https://getcomposer.org/download/) pour installer les dépendances PHP. S'il est bien installé sur votre système, téléchargez les dépendances :
```bash
composer install --no-dev
```
Tous les fichiers PHP nécessaires au fonctionnement du projet sont là. Nous n'avons pas installé les dépendances de dev qui sont inutiles en production.

### Configuration
Il faut créer un fichier nommé `.env.local` à la racine du projet. Ajoutez la variable APP_ENV :
```dotenv
APP_ENV=prod
```
Il est bien important que vous utilisiez le fichier .env.local et surtout pas le fichier .env

Il faudra également configurer l'accès au serveur de mails. Ajoutez cette variable dans `.env.local` :
```dotenv
MAILER_DSN=""
```
Les informations sur la valeur à mettre se trouve sur [la documentation de Symfony](https://symfony.com/doc/current/mailer.html). 

### Base de données
Installons la base de données. Le code utilise MySQL. Grâce à Symfony. Il y a peu de choses à faire. Il faut d'abord configurer l'accès à la base de données. Copiez la variable `DATABASE_URL`  dans votre fichier `.env.local` et adaptez-la à votre serveur MySQL.
```dotenv
DATABASE_URL="mysql://bduser:bdpass@bdserver:3306/bdname?serverVersion=5.7&charset=utf8mb4"
```
Il n'est pas nécessaire de créer la base de donnée vous même au préalable. Si vos identifiants le permettent et que vous souhaitez créer la base de donnée pour cette nouvelle instance, exécutez `bin/console doctrine:database:create` et la console de Symfony se chargera de créer la base de données pour vous sans devoir ouvrir PhpMyAdmin, Adminer ou mysql en ligne de commande.

#### Sur instance déjà en cours, sans Symfony
Au début du projet, le code n'utilisait pas le framework Symfony. Le choix de passer à ce framework demande quelques adaptations. Des migrations ont été mises en place et il faudra les initialiser. Plus d'informations sur [Installation sur une instance déjà en place](Installation%20sur%20une%20instance%20déjà%20en%20place.md)

#### Migrations
La connexion à la bdd fonctionne, on demande donc à Symfony de créer les tables. Il faut créer la structure des tables puis y mettre des données. La structure de la base de données est décrite dans les migrations. Les migrations sont une forme d'historique de la base de données, elle décrivent comment on passe d'une version à l'autre de nos tables. Elles permettent donc de revenir en arrière en cas de mise à jour hasardeuse. Nous y avons également mis certaines données de départ qui permettent de démarrer une instance. Pour les appliquer :
```bash
bin/console doctrine:migrations:migrate
```

## Mise à jour
### Code
Déplacez-vous dans le dossier de votre instance de L'éco-clic avec `cd` et mettez le code à jour avec
```bash
git pull
```
Il est possible que la commande soit à compléter si vous devez récupérer une certaine version.
Bravo, votre code est à jour. Mais il faut encore quelques étapes pour terminer la mise à jour.

Il n'y a pas, pour le moment, de stratégie de versions qui utiliserait des tags. Un simple `git pull` sans plus d'option devrait suffire.

### Dépendances
Peut-être que la mise à jour a modifié les dépendances. Pour les mettre à jour il faut exécuter :
```bash
composer install
```
Attention à surtout utiliser la commande `install` et pas `update` . Si vous avez l'impression que rien ne se passe, c'est sûrement parce qu'il n'y a pas de modifications à faire.

### Cache
En production, le cache de Symfony n'est pas régulièrement mis à jour, notamment le cache contenant les templates. Il faut le vider quand le code a été modifié :
```bash
bin/console cache:clear
```

### Base de données
La base de données a peut-être évoluée depuis votre dernière mise à jour. Pour la modifier il suffit d'exécuter les migrations. Elles renferment les requêtes SQL qui manipulent la structure de la base de données.
```bash
bin/console doctrine:migrations:migrate
```
S'il n'y a pas de migrations à appliquer, la commande ne fera aucun changement.

## Documentations
La documentation utilisateur se trouve sur Gitbook : https://asso-declic.gitbook.io/guide-utilisateur-leco-clic/presentation-generale/leco-clic

La documentation pour les développeurs est ici-même dans le dossier `docs`.

## Licence Open Source