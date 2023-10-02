# Développer L'éco-clic

[Installation du projet](Installation%20pour%20les%20devs.md)
[Installation sur une instance avec l'ancien code](Installation%20sur%20une%20instance%20déjà%20en%20place.md), sans Symfony

[Structure du code](Développer/Structure%20du%20code.md)
Structure des données : [MCD](MCD.md) 
[Gestion des droits](Gestion%20des%20droits.md)

[Le fonctionnement de l'application](Fonctionnement.md)

## Fin de la phase de test
Lorsque la phase de test sera finie, il ne sera plus nécessaire de vérifier le SIRET des collectivités pour s'assurer qu'elles font partie des testeurs de l'Éco-clic.

Il faudra donc
- [x] Supprimer l'entité `TemporarySiret` et le repository `TemporarySiretRepository`
- [x] Supprimer le test lancé en JS dans inscription.js (code «temporaire»)
- [x] Supprimer la route `/check-siret-connu` dans `CollectiviteController`
- [x] Créer une migration qui supprimer la table `temporary_siret` avec `bin/console make:migration`
