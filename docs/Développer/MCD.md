# MCD
Le MCD a été réalisé avec [Mocodo](https://mocodo.net/).

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
