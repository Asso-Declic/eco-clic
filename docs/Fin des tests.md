Lorsque les tests seront finis, il ne sera plus nécessaire de vérifier le SIRET des collectivités pour s'assurer qu'elles font partie des testeurs de l'Éco-clic.

Il faudra donc
- Supprimer l'entité `TemporarySiret` et le repository `TemporarySiretRepository`
- Supprimer le test lancé en JS dans inscription.js
- Supprimer la route `/check-siret-connu` dans `CollectiviteController`
- Créer une migration qui supprimer la table `temporary_siret` avec `bin/console make:migration`
- 