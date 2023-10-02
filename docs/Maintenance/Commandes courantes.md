## Mettre un mot de passe à jour manuellement
Il est possible de demander à Symfony de hasher un mot de passe grâce à la commande `bin/console security:hash-password`. On peut prendre la valeur donnée et la mettre manuellement en lieu et place du mot de passe utilisateur actuel.

## Vider les requêtes expirées de réinitialisation de mot de passe
`bin/console reset-password:remove-expired`
Cette commande pourrait être dans une cron task hebdomadaire ou mensuelle pour éviter que la table ne soient remplies de requêtes inutiles et expirées.

