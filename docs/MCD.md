# MCD
Les MCD ont été réalisés avec [Mocodo](https://mocodo.net/)

## MCD d'origine
Avant le passage à Symfony, la base de données n'avait pas de MCD.
Dans un premier temps, il a fallu créer toutes les entités et les associations selon les tables actuelles. Ça donne un MCD sans relation puisque aucune clé étrangère n'existait. Une seule relation ManyToMany a été mise en place à cette étape, entre `OPSN` et `Departement`.

## Vers un MCD idéal
On doit supprimer la relation «classer» entre Recommandation et Category.
On peut retrouver la catégorie en joignant la table à Question à Category.
Pour des raisons des redondance, on supprime la catégorie dans Recommandation.

Malgré le semblant de redondance, on doit conserver la relation «classer» entre Question et Category. On aurait pu se dire que tous les thèmes avec une catégorie et toutes les questions avaient un thème mais c'est plus compliqué que ça. Les questions sont 

On doit supprimer la relation «associer» entre CollectiviteAnswer et Question.
On peut retrouver la question en joignant la table à Answer puis à Question.
Pour des raisons des redondance, on supprime la question dans CollectiviteAnswer.

On doit ajouter un id à Score, c'est Doctrine qui l'impose. On a désormais un BIGINT sur le champs id.

On supprime `forgotPasswordId` et `forgotPasswordAt` dans User et Admin car on a mis en place une solution proposée par Symfony.

On supprime `TemporarySiret` qui disparaîtra lorsque l'Éco-clic sera ouverte à toutes les collectivités.

## MCD Complet
En recréant les relations qui devraient apparemment exister, ça donne ça. Quand il y a un 2, c'est qu'il y a une redondance de données
```mocodo
:
:
grouper, 1N Category, 11 Theme
Category: id, name, image, description, sortOrder
:
:

:
:
Theme: id, label, category
classer2, 11 Question, 1N Category
:
proposer, 11 Answer, 1N Question

RecommandationLevel: id, label
déterminer, 11 Recommandation, 1N RecommandationLevel
découler, 11 Question, 1N Theme
Question: id, question, theme, category, multiple, definition, additionalInformation, definitionTitle, sortOrder, parent, parentAnswer
affilier, 11 Question, 1N Answer
:

positionner, 11 Recommandation, 1N RecommandationStatus
Recommandation: id, title, body, question, level, status
résoudre, 11 Recommandation, 1N Question
hyérarchiser, 11 Question, 1N Question
associer, 1N Answer, 11 CollectiviteAnswer
Answer: id, type, body, question, ponderation

RecommandationStatus: id, label
définir2, 11 CollectiviteStatus, 1N Recommandation
:
Population: id, TypeCollectivite, minPop, maxPop
CollectiviteAnswer: id, answer, collectivite, body, answeredAt
:

progresser, 11 CollectiviteStatus, 1N RecommandationStatus
CollectiviteStatus: id, recommandation, user, code
définir, 11 CollectiviteStatus, 1N Collectivite
peupler, 1N Population, 11 Collectivite
répondre, 1N Collectivite, 11 CollectiviteAnswer
TemporarySiret: siret, nom

couvrir, 1N OPSN, 1N Departement
OPSN: id, name, email, departement,active, logo, phoneNumber, postalAddress, website, siret, latitude, longitude
accompagner, 11 Collectivite, 1N OPSN
Collectivite: id, name, population, departmentCode, siret, latitude, longitude, type, opsn
typer, 11 Collectivite, 1N CollectiviteType
CollectiviteType: id, label

constituer, 11 Departement, 1N Region
Departement: code, name, regionCode
administrer, 11 Collectivite, 1N Departement
dépendre, 11 User, 1N Collectivite
enregistrer, 11 Score, 1N Collectivite
:

Region: code, name
UserPreference: user, code, _json
préférer, 11 User, 11 UserPreference
User: id, username, password, email, lastname, firstname, collectivite, admin, token, active, cguChecked, verified, superAdmin, superAdmin2, opsn
Score: id, collectivite, score, _scoredAt
:
```
