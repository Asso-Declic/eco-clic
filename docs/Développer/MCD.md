# MCD
Le MCD a été réalisé avec [Mocodo](https://mocodo.net/).

En recréant les relations qui devraient apparemment exister, ça donne ça. On représente ici les entités. Lorsqu'elle sont traduites en tables, certains champs n'existent pas !
```mocodo
:
:
grouper, 1N Category, 11 Theme
Category: id, name, image, description, sortOrder, themes, questions
:
:

:
:
Theme: id, label, category, questions
classer2, 11 Question, 1N Category
:
proposer, 11 Answer, 1N Question

RecommandationLevel: id, label, recommandations, color
déterminer, 11 Recommandation, 1N RecommandationLevel
découler, 11 Question, 1N Theme
Question: id, question, theme, category, multiple, definition, additionalInformation, definitionTitle, answers, recommandations, sortOrder, parent, children, parentAnswer
affilier, 11 Question, 1N Answer
:

positionner, 11 Recommandation, 1N RecommandationStatus
Recommandation: id, title, body, question, level, status
résoudre, 11 Recommandation, 1N Question
hyérarchiser, 11 Question, 1N Question
associer, 1N Answer, 11 CollectiviteAnswer
Answer: id, type, body, question, ponderation, collectiviteAnswers, dependentQuestions

RecommandationStatus: id, label
définir2, 11 CollectiviteStatus, 1N Recommandation
:
Population: id, collectiviteType, min, max
CollectiviteAnswer: id, answer, collectivite, body, answeredAt
:

progresser, 11 CollectiviteStatus, 1N RecommandationStatus
CollectiviteStatus: id, recommandation, collectivite, status
définir, 11 CollectiviteStatus, 1N Collectivite
peupler, 1N Population, 11 Collectivite
répondre, 1N Collectivite, 11 CollectiviteAnswer
TemporarySiret: siret, name

couvrir, 1N OPSN, 1N Departement
OPSN: id, name, email, departement, active, logo, phoneNumber, postalAddress, website, siret, latitude, longitude, departements, collectivites, users
accompagner, 11 Collectivite, 1N OPSN
Collectivite: id, name, population, department, siret, latitude, longitude, type, opsn, scores, collectiviteAnswers, users, statuses
typer, 11 Collectivite, 1N CollectiviteType
CollectiviteType: id, label, collectivites, populations

constituer, 11 Departement, 1N Region
Departement: code, name, region, OPSNs, collectivites
administrer, 11 Collectivite, 1N Departement
dépendre, 11 User, 1N Collectivite
enregistrer, 11 Score, 1N Collectivite
:

Region: code, name, departements
UserPreference: user, _code, json
préférer, 11 User, 11 UserPreference
User: id, username, password, email, lastname, firstname, collectivite, adminCollectivite, token, active, cguChecked, verified, userPreferences, adminOpsn, superAdmin, opsn
Score: id, collectivite, score, _scoredAt
:
```

## Précisions sur la structure des données

### Questions, catégories et thèmes
Une question peut être dans un thème et une catégorie. Les thèmes sont un peu comme des sous-catégories. Une question peut donc être directement dans une catégorie ou alors apparaître dans un thème. Dans ce cas, la question a à la fois une valeur dans $theme et une valeur dans $category. Sinon, $theme vaut null.

### Recommandations
L'entité `RecommandationStatus` liste les statuts possibles pour une recommandation. Grâce à la relation avec `Recommandation`, elle permet de mettre un statut par défaut pour une recommandation. La relation avec `CollectiviteStatus` permet de déterminer le statut d'une recommandation dans le parcours d'application du référentiel par une collectivité.

On doit se servir de `RecommandationStatus` pour lister les statuts possibles dans un select et on joue ensuite avec la valeur dans `Recommandation` pour déterminer quel est le statut par défaut puis avec la valeur dans `CollectiviteStatut` pour afficher l'état actuel de cette recommandation dans le plan de la collectivité.

### Collectivité, Types et Populations
Les collectivités ont une relation vers `CollectiviteType` et une relation vers `Population`.
(redondance ici ??)

### Utilisateurs et préférences
Voir [Préférences utilisateur](Préférences%20utilisateur.md) pour les détails

### Progression et Score
La progression constitue les informations permettant d'évaluer la complétion des questions sur le nombre total de questions.

Le score est une note de A à E qui situe une collectivité par rapport à l'application du référentiel. Le score est calculé quand la progression est complète. La note est attribuée après un calcul du score sur 100.

| A         | B          | C          | D          | E           |
|-----------|------------|------------|------------|-------------|
| 99 ou 100 | de 80 à 98 | de 60 à 79 | de 40 à 59 | moins de 40 |
