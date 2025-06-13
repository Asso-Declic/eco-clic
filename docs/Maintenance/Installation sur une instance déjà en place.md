# Installation sur une instance déjà en place
Si tout le code est mis à jour sur une installation qui avait l'ancien code, sans Symfony, il faut manipuler un peu la base de données avant d'appliquer les migrations.
## Table `doctrine_migration_versions`
```sql
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230509120223',	'2023-05-10 15:40:52',	1233),
('DoctrineMigrations\\Version20230509124504',	'2023-05-10 15:40:53',	69);
```
Ça sert à indiquer à Doctrine que les deux premières migrations sont déjà appliquées. On souhaite en effet n'appliquer que les migrations suivantes afin de ne pas casser la base de données

## Propreté des données
L'état précédent de la table n'avait pas de clés étrangères. Les clés étrangères sont des contraintes en écriture et permettent des automatisations. Elles permettent de s'assurer que les données qu'on conserve sont bonnes.
Dans le dump de la preprod, on retrouve des incohérences. Il existe des entrées dans `OPSN_Departement.OPSNId` qui n'existent pas dans `OPSN.Id`. Il est inutile de garder des relations entre des données qui n'existent pas.

Des requêtes sont dans la migration Version20230510152551 et permettent de nettoyer la base de données pour que les clés étrangères fonctionnent.

## Des mots de passe réellement hashés en base de donnée
Au départ les mots de passe étaient en MD5(MD5()) en base de données. Il serait compliqué pour pas grand chose de modifier Symfony pour interpréter cette forme de hashage. Le parti pris a donc plutôt été de s'assurer que la fonctionnalité de réinitialisation de mot de passe fonctionnait pour encourager tous les utilisateurs à réinitialiser leur mot de passe. La connexion fonctionne très bien désormais !
