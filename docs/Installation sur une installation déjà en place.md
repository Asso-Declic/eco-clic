Si tout le code est mis à jour sur une installation qui avait l'ancien code, il faut manipuler un peu la base de données avant d'appliquer les migrations.

⚠ Toutes les requêtes sont en un seul bloc à la fin de ce doc ⚠

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

Cette requête supprime les `OPSNId` dans `OPSN_Departement` qui n'existent pas dans la table `OPSN`
```sql
DELETE FROM OPSN_Departement where OPSNId IN (
	SELECT * FROM (
		SELECT OPSNId
		FROM OPSN_Departement AS od
		LEFT JOIN OPSN AS o ON od.OPSNId = o.Id
		WHERE Id IS NULL GROUP BY OPSNId
	) as liste_a_supprimer
)
```

De même, lors du nettoyage, des identifiants en double on été trouvés dans la base de données. Voici une requête pour les supprimer. Si on suppose que les doublons existent seulement pour les utilisateurs qui n'ont pas pu vérifier leur compte (mauvaise adresse email, par exemple), et qui en aurait recréé un qui fonctionne, on supprime donc les utilisateurs dont l'Identifiant est en doublon et IsVerifie est à 0 (false)
```sql
DELETE FROM utilisateur
WHERE Identifiant IN (
SELECT Identifiant FROM (
    SELECT Identifiant, COUNT(*) AS total
    FROM utilisateur
    GROUP BY Identifiant
) AS calcul
WHERE total > 1
) AND IsVerifie = 0
```

## Les scores
La tableau initialement appelée `historiqueScore` devient `score`. Doctrine impose d'utiliser un identifiant avec toutes les entités sans exception. C'est une contrainte discutable mais on va s'y plier par simplicité. On va ajouter une colone `id` en première position et y affecter automatiquement des id.
```sql
ALTER TABLE `historiqueScore` ADD COLUMN `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL UNIQUE FIRST;
```

## En résumé
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

DELETE FROM OPSN_Departement where OPSNId IN (
	SELECT * FROM (
		SELECT OPSNId
		FROM OPSN_Departement AS od
		LEFT JOIN OPSN AS o ON od.OPSNId = o.Id
		WHERE Id IS NULL GROUP BY OPSNId
	) as liste_a_supprimer
);

DELETE FROM utilisateur
WHERE Identifiant IN (
SELECT Identifiant FROM (
    SELECT Identifiant, COUNT(*) AS total
    FROM utilisateur
    GROUP BY Identifiant
) AS calcul
WHERE total > 1
) AND IsVerifie = 0;

ALTER TABLE `historiqueScore` ADD COLUMN `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL UNIQUE FIRST;
```