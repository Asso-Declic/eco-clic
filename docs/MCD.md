# MCD
Les MCD ont été réalisés avec [Mocodo](https://mocodo.net/)

## MCD d'origine
Avant le passage à Symfony, la base de données n'avait pas de MCD.
Dans un premier temps, il a fallu créer toutes les entités et les associations selon les tables actuelles. Ça donne un MCD sans relation puisque aucune clé étrangère n'existait. Une seule relation ManyToMany a été mise en place à cette étape, entre `OPSN` et `Departement`. À cette étape, les propriétés ont été renommées mais pas les champs. Ce qu'on observe ici représente plus les classes que la base de données.
```mocodo
Departement: code, name, regionCode
Couvre, 1N OPSN, 1N Departement
OPSN: id, name, email, departement,active, logo, phoneNumber, postalAddress, website, siret, latitude, longitude
Collectivite: id, name, population, departmentCode, siret, latitude, longitude, type, opsn
CollectiviteType: id, label
CollectiviteAnswer: id, question, answer, collectivite, body, answeredAt
TemporarySiret: siret, name
Score: collectivite, score, _scoredAt
Theme: id, label, category

Admin: id, username, password, email, lastname, firstname, token, active, forgotPasswordId, forgotPasswordAt, superAdmin, opsn
User: id, username, password, email, lastname, firstname, collectivite, admin, token, active, forgotPasswordId, forgotPasswordAt, cguChecked, verified
UserPreference: user, code, _json
Answer: id, type, body, question, ponderation
Question: id, question, theme, category, multiple, definition, additionalInformation, definitionTitleRecommandation: id, title, body, question, category, level
Recommandation: id, title, body, question, category, level
RecommandationLevel: id, label
Category: id, name, image, description, sortOrder
:
```

## MCD Complet
En recréant les relations qui devraient apparemment exister, ça donne ça. Quand il y a un 2, c'est qu'il y a une redondance de données
```mocodo
représenter, 11 Admin, 1N OPSN
OPSN: id, name, email, departement,active, logo, phoneNumber, postalAddress, website, siret, latitude, longitude
couvrir, 1N OPSN, 1N Departement
Departement: code, name, regionCode
administrer, 11 Collectivite, 1N Departement
typer, 11 Collectivite, 1N CollectiviteType
CollectiviteType: id, label
associer, 1N Answer, 11 CollectiviteAnswer
Answer: id, type, body, question, ponderation
proposer, 11 Answer, 1N Question
:
:

Admin: id, username, password, email, lastname, firstname, token, active, forgotPasswordId, forgotPasswordAt, superAdmin, opsn
:
:
enregistrer, 11 Score, 1N Collectivite
Collectivite: id, name, population, departmentCode, siret, latitude, longitude, type, opsn
répondre, 1N Collectivite, 11 CollectiviteAnswer
CollectiviteAnswer: id, question, answer, collectivite, body, answeredAt
associer2, 1N Question, 11 CollectiviteAnswer
Question: id, question, theme, category, multiple, definition, additionalInformation, definitionTitle
découler, 11 Question, 1N Theme
:

TemporarySiret: siret, name
accompagner, 11 Collectivite, 1N OPSN
:
Score: collectivite, score, _scoredAt
dépendre, 11 User, 1N Collectivite
User: id, username, password, email, lastname, firstname, collectivite, admin, token, active, forgotPasswordId, forgotPasswordAt, cguChecked, verified
préférer, 11 User, 11 UserPreference
UserPreference: user, code, _json
classer, 11 Question, 1N Category
Theme: id, label, category
:

:
:
:
:
:
:
:
résoudre, 11 Recommandation, 1N Question
Category: id, name, image, description, sortOrder
grouper, 1N Category, 11 Theme
:

:
:
:
RecommandationLevel: id, label
déterminer, 11 Recommandation, 1N RecommandationLevel
Recommandation: id, title, body, question, category, level
classer2, 11 Recommandation, 1N Category
```

## Vers un MCD idéal
On doit supprimer la relation «classer» entre Recommandation et Category.
On peut retrouver la catégorie en joignant la table à Question puis à Theme puis à Category.
Pour des raisons des redondance, on supprime la catégorie dans Recommandation.

On doit supprimer la relation «classer» entre Question et Category.
On peut retrouver la catégorie en joignant la table à Theme puis à Category.
Pour des raisons des redondance, on supprime la catégorie dans Question.

On doit supprimer la relation «associer» entre CollectiviteAnswer et Question.
On peut retrouver la question en joignant la table à Answer puis à Question.
Pour des raisons des redondance, on supprime la question dans CollectiviteAnswer.

On doit ajouter un id à Score, c'est Doctrine qui l'impose. On a désormais un BIGINT sur le champs id.

On supprime `forgotPasswordId` et `forgotPasswordAt` dans User et Admin car on a mis en place une solution proposée par Symfony.

## MCD Idéal
```mocodo
représenter, 11 Admin, 1N OPSN
OPSN: id, name, email, departement,active, logo, phoneNumber, postalAddress, website, siret, latitude, longitude
couvrir, 1N OPSN, 1N Departement
Departement: code, name, regionCode
administrer, 11 Collectivite, 1N Departement
typer, 11 Collectivite, 1N CollectiviteType
CollectiviteType: id, label
associer, 1N Answer, 11 CollectiviteAnswer
Answer: id, type, body, question, ponderation
proposer, 11 Answer, 1N Question
:
:

Admin: id, username, password, email, lastname, firstname, token, active, superAdmin, opsn
:
:
enregistrer, 11 Score, 1N Collectivite
Collectivite: id, name, population, departmentCode, siret, latitude, longitude, type, opsn
répondre, 1N Collectivite, 11 CollectiviteAnswer
CollectiviteAnswer: id, answer, collectivite, body, answeredAt
:
Question: id, question, theme, multiple, definition, additionalInformation, definitionTitle
découler, 11 Question, 1N Theme
:

TemporarySiret: siret, name
accompagner, 11 Collectivite, 1N OPSN
:
Score: id, collectivite, score, _scoredAt
dépendre, 11 User, 1N Collectivite
User: id, username, password, email, lastname, firstname, collectivite, admin, token, active, cguChecked, verified
préférer, 11 User, 11 UserPreference
UserPreference: user, code, _json
:
Theme: id, label, category
:

:
:
:
:
:
:
:
résoudre, 11 Recommandation, 1N Question
Category: id, name, image, description, sortOrder
grouper, 1N Category, 11 Theme
:

:
:
:
RecommandationLevel: id, label
déterminer, 11 Recommandation, 1N RecommandationLevel
Recommandation: id, title, body, question, level
:
```
