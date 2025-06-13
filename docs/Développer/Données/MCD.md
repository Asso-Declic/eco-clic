# MCD
Le MCD a été réalisé avec [Mocodo](https://mocodo.net/).

En recréant les relations qui devraient exister, ça donne ça. On représente ici les entités. Attention, lorsqu'elle sont traduites en tables, certains champs n'existent pas dans la table grâce aux relations ! De plus, les tables créées pas Symfony ne figurent pas dans ce MCD.
```mocodo
:
:
:
RecommandationLevel: id, label, recommandations, color
RecommandationResource: id, title, link
RecommandationSuccessIndicator: id, text
:
:
UserPreference: user, _code, json
:
:

:
:
résoudre, 11 Recommandation, 1N Question
déterminer, 11 Recommandation, 1N RecommandationLevel
informe, 11 RecommandationResource, 1N Recommandation
précise, 11 RecommandationSuccessIndicator, 1N Recommandation
:
:
préférer, 11 User, 11 UserPreference
:
:

:
:
:
positionner, 11 Recommandation, 1N RecommandationStatus
Recommandation: id, title, body, question, level, status, resources, indicators
définir2, 11 CollectiviteStatus, 1N Recommandation
Population: id, collectiviteType, min, max
dépendre, 11 User, 1N Collectivite
User: id, username, password, email, lastname, firstname, collectivite, adminCollectivite, token, active, cguChecked, verified, userPreferences, adminOpsn, superAdmin, opsn
:
:

:
Category: id, name, image, description, sortOrder, themes, questions, levelTwo
:
RecommandationStatus: id, label
progresser, 11 CollectiviteStatus, 1N RecommandationStatus
CollectiviteStatus: id, recommandation, collectivite, status
définir, 11 CollectiviteStatus, 1N Collectivite
peupler, 1N Population, 11 Collectivite
accompagner, 11 Collectivite, 1N OPSN
OPSN: id, name, email, departement, active, logo, phoneNumber, postalAddress, website, siret, latitude, longitude, departements, collectivites, users
:

grouper, 1N Category, 11 Theme
classer2, 11 Question, 1N Category
Question: id, question, theme, category, multiple, definition, additionalInformation, definitionTitle, answers, recommandations, sortOrder, parent, children, parentAnswer, levelTwo
affilier, 11 Question, 1N Answer
Answer: id, type, body, question, ponderation, collectiviteAnswers, dependentQuestions, recommandation
associer, 1N Answer, 11 CollectiviteAnswer
CollectiviteAnswer: id, answer, collectivite, body, answeredAt
répondre, 1N Collectivite, 11 CollectiviteAnswer
Collectivite: id, name, population, department, siret, latitude, longitude, type, opsn, scores, collectiviteAnswers, users, statuses, postalCode, levelTwo
couvrir, 1N OPSN, 1N Departement
Region: code, name, departements

Theme: id, label, category, questions
découler, 11 Question, 1N Theme
hyérarchiser, 11 Question, 1N Question
proposer, 11 Answer, 1N Question
Score: id, collectivite, score, _scoredAt
enregistrer, 11 Score, 1N Collectivite
CollectiviteType: id, label, collectivites, populations
typer, 11 Collectivite, 1N CollectiviteType
administrer, 11 Collectivite, 1N Departement
Departement: code, name, region, OPSNs, collectivites
constituer, 11 Departement, 1N Region
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
Voir [Préférences utilisateur](Préférences%20utilisateur.md)

### Progression et Score
Voir  [Calcul du score](Calcul%20du%20score.md)