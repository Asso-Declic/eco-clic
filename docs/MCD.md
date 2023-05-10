# MCD
Les MCD ont été réalisés avec [Mocodo](https://mocodo.net/)

## MCD d'origine
Avant le passage à Symfony, la base de données n'avait pas de MCD.
Dans un premier temps, il a fallu créer toutes les entités et les asstables actuelles. Ça donne un MCD sans relation puisque aucune clé étrangère n'existait. Une seule relation ManyToMany a été mise en place à cette étape, entre `OPSN` et `Departement`. À cette étape, les propriétés ont été renommées mais pas les champs. Ce qu'on observe ici représente plus les classes que la base de données.
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
RecommandationLevel: id, label
Category: id, name, image, description, sortOrder
:
```

## MCD Complet
