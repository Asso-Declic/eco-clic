# Structure du code
## Les bases de Symfony
- `/bin`
  Contient des exécutables fournis par Symfony.
- `/config`
  Toute la configuration du Symfony. Presque tous les fichiers sont en YAML.
- `/docs`
  Ce n'est pas un dossier de Symfony, il a été créé pour contenir la documentation que vous lisez.
- `/migrations`
  Les migrations permettent de modifier la base de données comme un historique et permettent de revenir en arrière si besoin.
- `/public`
  C'est ici que commence l'exécution du code PHP avec `index.php`. Tous les assets se trouvent donc ici.
- `/src`
  Tous les fichiers PHP du projet sont ici. C'est surtout ici qu'on code. 
- `/templates`
  Tous les fichiers de templates qui génèrent du HTML sont ici. On ne génère du code HTML qu'avec ces fichiers
- `/tests`
  Il n'y pas de tests unitaires ni de tests fonctionnels dans le projet mais ils se trouveraient ici.
- `/translations`
  Pour le cas où des fonctionnalités de traductions sont utilisées dans le projet, ce dossier contient les traductions pour toutes les langues actives. 
- `/var`
  Contient des logs et du cache créés par Symfony. Ce dossier n'est pas commité.
- `/vendor`
  Contient toutes les dépendances du projet. Il ne faut en aucun cas modifier le moindre fichier ici ! Les modifications ne pourraient pas apparaître dans les commits.
- `.env`, `.env.local`, `.env.test`
  La configuration du projet tient dans des variables d'environnement. La philosophie est de conserver dans ces fichiers toutes les informations confidentielles comme l'accès à la base de données ou les clés API alors que le dossier `config` permet de spécifier certains comportements du projet.
  Le fichier `.env` est lu en premier, on y déclare certaines variables. Le fichier `.env.local` est lu ensuite, il contient les informations confidentielles, il n'est pas commité pour cette raison. Les variables déclarées dans `.env.local` écrasent celle du fichier `.env`.
  Quant au fichier `.env.test`, il est utilisé dans le cadre des tests.
- `.gitignore`
  Il indique à git que certains fichiers ne doivent pas être inclus dans les commits. Ça permet de ne pas commiter les dossiers qui n'ont rien à voir avec le code du projet. Le dossier `vendor` ne contient que du code qui provient d'autres développeurs, le dossier `var` ne contient que des fichiers créés par Symfony, le fichier `.env.local` contient des informations de configuration tels que des mots de passe ou des clés API qui ne doivent pas être divulguées pour des raisons de sécurité.
- `composer.json`, `composer.lock`, `symfony.lock`
  Ce sont les fichiers qui gèrent les dépendances du projet. Le fichier json liste les dépendances et les fichiers .lock enregistrent les versions exactes qui sont installées ainsi que quelques informations supplémentaires. On peut modifier le fichier json mais pas les deux autres ! Si on modifie le fichier json, il faut impérativement exécuter `composer update` pour mettre les dépendances et la configuration à jour.
- `docker-composer.yml` et `docker-composer.override.yml`
  Ces deux fichiers ont été créé par Symfony lors de l'initialisation du projet et n'ont pas été modifiés depuis. Ils pourraient servir à exécuter le code dans un container, d'abord pour développer mais aussi pour la mise en production. 
- `phpunit.xml.dist`
  Un fichier de configuration des tests, il va de pair avec le dossier `/tests`


## /src
- Controller
  Tous les contrôleurs sont organisés par entités puis par fonctionnalités.
  À la racine on retrouve tous les contrôleurs de l'application, les pages utilisées par un utilisateur. Le dossier Admin a le même fonctionnement mais ne concerne que l'interface d'administration. Le dossier API et ses routes fonctionnent au plus près possible d'une API Rest. Chaque route fait appel à une entité. Il y a quelques entorses faites au concept «Restful» avec des routes faites pour rechercher des entités selon des critères. Le critère apparaît dans la route et n'est pas géré par un filtre en GET
- Entity
  Les entités représentent les tables en base de données et leurs relations. Chaque classe décrit une entité, chaque propriété correspond à un champs d'une table. Les relations entre les entités sont décrites dans [MCD](MCD.md).
- Form
  Les FormTypes décrivent un formulaire qu'on peut afficher en HTML. Ils permettent de faire le lien entre les entités et les formulaires. Ils permettent même de lier automatiquement du JSON avec les entités si le JSON est correctement formé.
- Repository
  Chaque entité a son repository, il est obligatoire. Une classe repository contient toutes les requêtes qui permettent de manipuler nos entités, surtout les requêtes SELECT un peu complexes.
- Security
  Ici on retrouve ce qui permet de connecter un utilisateur et de le rediriger vers une page après sa connexion
- Service
  Les services sont des classes qui font des tâches précises et qui n'auraient pas leur place dans un contrôleur. Elles sont aveugles du reste du code. Un manager est un type de service qui permet d'ajouter une couche de complexité dans les manipulations des entités. «Progression» n'est pas une entité mais on calcule la progression à partir de résultats de requêtes.

## Dans un repository
Dans la mesure du possible, on nomme les méthodes avec «find» quand elles retournent un ou plusieurs objets de l'entité du repository. Si on cherche une donnée différente, on utilise plutôt «get».
Dans tous les cas, une méthode du repository retourne le résultat d'une requête SQL ou alors un objet de la classe `QueryBuilder` mais elle ne fait aucun calcul supplémentaire. C'est pour ces calculs qu'on a des managers.

## Dans un manager
Le manager est là pour manipuler des données de manière plus complexe, là où un repository ne fait qu'exécuter des requêtes dans la table de son entité. Il n'y a pas d'entité Progression, le `ProgressionManager` sert à demander à d'autres repository de récupérer des données pour déterminer la progression. Il y a bien une entité Score et un `ScoreRepository` associé mais le score se calcule de manière plus complexe. Le `ScoreManager` est donc appelé à la place du `ScoreRepository` dans les contrôleurs. Cette manœuvre permet plus de clarté dans le code et dans le nommage des méthodes.

De même, pour manipuler les statistiques, on utilise un contrôleur qui n'est pas lié à une entité. Les différents moyens de recueillir les statistiques sont dans `StatsManager`.

## API Interne
Il existe une API interne utilisée par l'interface en front. Elle est accessible uniquement depuis l'application. Toutes les routes de l'API vérifient la session de l'utilisateur de la même manière qu'une route qui retourne une réponse en HTML.

On peut lister toutes les routes avec la commande :
```bash
bin/console debug:router
```

Les routes API respectent, dans la mesure du possible, les concepts de l'API Rest (https://restfulapi.net). Chaque route pointe vers une «ressource» et les méthodes HTTP précisent l'action qu'on souhaite faire sur cette ressource. Parfois, la route est complétée pour préciser l'action.

Chaque route a été créée pour le fonctionnement de l'application. Ce qui explique qu'il n'y a pas d'implémentation de toutes les méthodes HTTP.

