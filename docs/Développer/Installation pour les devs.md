# Installation pour les devs
## Installation
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
composer install
```
Tous les fichiers PHP nécessaires au fonctionnement du projet sont là. Les dépendances de dev contiennent quelques librairies supplémentaires qui aident à développer avec Symfony.

### Configuration
Il faut créer un fichier nommé `.env.local` à la racine du projet. Il est bien important que vous utilisiez le fichier .env.local et surtout pas le fichier .env. Le fichier .env.local ne sera pas commité, il vous permet de configurer votre instance pour vos besoins sur votre machine.

Il faudra également configurer l'accès au serveur de mails. Ajoutez cette variable dans `.env.local` :
```dotenv
MAILER_DSN=""
```
Les informations sur la valeur à mettre se trouve sur [la documentation de Symfony](https://symfony.com/doc/current/mailer.html). Pour le cas où vous ne souhaitez pas envoyer d'email dans le cadre du développement, la valeur à entrer est `"null://null"`.

### Base de données
Installons la base de données. Le code utilise MySQL. Configurez l'accès à la base de données. Copiez la variable `DATABASE_URL`  dans votre fichier `.env.local` et adaptez-la à votre serveur MySQL.
```dotenv
DATABASE_URL="mysql://bduser:bdpass@bdserver:3306/bdname?serverVersion=5.7&charset=utf8mb4"
```
Il n'est pas nécessaire de créer la base de donnée vous même au préalable. Si vos identifiants le permettent et que vous souhaitez créer la base de donnée pour cette nouvelle instance, exécutez `bin/console doctrine:database:create` et la console de Symfony se chargera de créer la base de données pour vous sans devoir ouvrir PhpMyAdmin, Adminer ou mysql-cli.

La connexion à la bdd fonctionne, on demande donc à Symfony de créer les tables. Il faut créer la structure des tables puis y mettre des données. La structure de la base de données est décrite dans les migrations. Les migrations sont une forme d'historique de la base de données, elle décrivent comment on passe d'une version à l'autre de nos tables. Elles permettent donc de revenir en arrière en cas de mise à jour hasardeuse. Nous y avons également mis certaines données de départ qui permettent de démarrer une instance. Pour les appliquer :
```bash
bin/console doctrine:migrations:migrate
```

## Mise à jour
Il faut mettre le code à jour depuis le dépôt git distant, puis mettre les dépendances à jour et appliquer les potentielles migrations.
```bash
git pull
composer install
bin/console doctrine:migrations:migrate
```
