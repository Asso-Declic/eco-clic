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

#### Sur une instance déjà en cours, sans Symfony

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

## Changelog

Premier dépôt pour utilisation du GitLab par l'équipe R&D | 30/08/2023

Push du code concernant les modifications des fonctionnalités suivantes :

- Modification du TdB et du plan d'action : Ajout des mentions "Première notation et Dernière Modification" | 22/09/2023
- Le Niveau 2 : Recommandations dynamiques | 22/09/2023
- Rattachement OPSN | 22/09/2023
- Rattachement OPSN : affichage des OPSN | 26/09/2023
- MailHelper : Mailing de rattachement OPSN | 26/09/2023
- Categorie : Correction de l'affichage d'une question enfant | 26/09/2023
- Correction de l'affichage du score | 26/09/2023
- Admin : Affichage des questions de niveau 2 selon le niveau de la col | 26/09/2023
- Correction du probleme des reco de niveau 2 | 26/09/2023
- Maj des regex | 26/09/2023
- Bandeau "connecté en tant qu'OPSN" | 26/09/2023
- Message quand il n'y a pas de reco | 26/09/2023
- Design des reco dans le détail | 26/09/2023
- Cacher le bouton "s'enregistrer" après le clique | 28/09/2023
- ajout fonctionnalité pour annuler le rattachement OPSN coté admin | 28/09/2023
- Correction map de rattachement OPSN | 29/09/2023
- Correction des bug lors de la modif du profil utilisateur/admin | 29/09/2023

## Documentations

La documentation utilisateur se trouve sur Gitbook : https://asso-declic.gitbook.io/guide-utilisateur-leco-clic/presentation-generale/leco-clic

La documentation pour les développeurs est ici-même dans le dossier `docs`.

## Licence Open Source

Ce logiciel est édité par [Déclic](https://www.asso-declic.fr/) qui en détient la paternité. Copyright 2023
Le code de ce logiciel ainsi que les questions de niveau 1 sont distribués sous la [licence AGPL v3](LICENSE.md).

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>
