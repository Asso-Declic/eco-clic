Si tout le code est mis à jour sur une installation qui avait l'ancien code, il faut manipuler un peu la base de données avant de lancer une commande
```sql
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230509120223',	'2023-05-10 15:40:52',	1233),
('DoctrineMigrations\\Version20230509124504',	'2023-05-10 15:40:53',	69);
```
Ça sert à indiquer à Doctrine que les deux premières migrations sont déjà appliquées. On souhaite en effet n'appliquer que les migrations suivantes afin de ne pas casser la base de données