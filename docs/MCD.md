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

On supprime `TemporarySiret` qui disparaitra lorsque l'Éco-clic sera ouverte à toutes les collectivités.

## MCD Complet
En recréant les relations qui devraient apparemment exister, ça donne ça. Quand il y a un 2, c'est qu'il y a une redondance de données
```mocodo
:
RecommandationLevel: id, label
déterminer, 11 Recommandation, 1N RecommandationLevel
:
Theme: id, label, category
grouper, 1N Category, 11 Theme
:
:

RecommandationStatus: id, label
positionner, 11 Recommandation, 1N RecommandationStatus
Recommandation: id, title, body, question, level, status
résoudre, 11 Recommandation, 1N Question
découler, 11 Question, 1N Theme
Category: id, name, image, description, sortOrder
:
:

:
définir2, 11 UserStatus, 1N Recommandation
UserPreference: user, code, _json
hyérarchiser, 11 Question, 1N Question
Question: id, question, theme, category, multiple, definition, additionalInformation, definitionTitle, sortOrder, parent, parentAnswer
classer2, 11 Question, 1N Category
:
:

:
UserStatus: id, recommandation, user, code
préférer, 11 User, 11 UserPreference
proposer, 11 Answer, 1N Question
affilier, 11 Question, 1N Answer
:
:
:

:
définir, 11 UserStatus, 1N User
User: id, username, password, email, lastname, firstname, collectivite, admin, token, active, cguChecked, verified, superAdmin, superAdmin2, opsn
CollectiviteType: id, label
Answer: id, type, body, question, ponderation
associer, 1N Answer, 11 CollectiviteAnswer
:
:

:
:
dépendre, 11 User, 1N Collectivite
typer, 11 Collectivite, 1N CollectiviteType
répondre, 1N Collectivite, 11 CollectiviteAnswer
CollectiviteAnswer: id, answer, collectivite, body, answeredAt
:
:

:
Score: id, collectivite, score, _scoredAt
enregistrer, 11 Score, 1N Collectivite
Collectivite: id, name, population, departmentCode, siret, latitude, longitude, type, opsn
administrer, 11 Collectivite, 1N Departement
Departement: code, name, regionCode
constituer, 11 Departement, 1N Region
TemporarySiret: siret, nom

:
Population: id, TypeCollectivite, minPop, maxPop
peupler, 1N Population, 11 Collectivite
accompagner, 11 Collectivite, 1N OPSN
OPSN: id, name, email, departement,active, logo, phoneNumber, postalAddress, website, siret, latitude, longitude
couvrir, 1N OPSN, 1N Departement
Region: code, name
:
```
