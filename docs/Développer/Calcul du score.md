# Calcul du score

## Progression et Score
La progression constitue les informations permettant d'évaluer la complétion des questions sur le nombre total de questions.

Le score correspond à la somme des pondérations des réponses  (0 ou 1) sur le nombre de questions, ramené à un nombre sur 100.

Dans `App\Service\ScoreManager`, la méthode `assessLetter()` retourne une lettre.
Le score est une note de A à E qui situe une collectivité par rapport à l'application du référentiel.  La note est attribuée après un calcul du score sur 100.

| A         | B          | C          | D          | E           |
|-----------|------------|------------|------------|-------------|
| 99 ou 100 | de 80 à 98 | de 60 à 79 | de 40 à 59 | moins de 40 |

## Comment est stocké le score
L'entité Score a une propriété `$category` qui précise pour quelle catégorie ce score est défini. Si cette propriété est null, le score est global pour la collectivité.

Aucun score n'est supprimé ou mis à jour en base de données, on ne fait que rajouter des scores pour garder un historique.

Le score d'une catégorie est calculé et ajouté dans la table à chaque fois qu'une catégorie est finie d'être remplie. Si on modifie les réponses aux questions d'une catégorie, dès que les réponses sont à nouveau remplies, on recalcule un score pour cette catégorie.

Le score est calculé quand la progression est complète. Qu'on parle de la progression de tous le questionnaire ou de la progression d'une catégorie.
