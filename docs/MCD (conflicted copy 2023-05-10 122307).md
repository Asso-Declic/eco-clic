# MCD
Les MCD ont été réalisés avec [Mocodo](https://mocodo.net/)

## MCD d'origine
Avant le passage à Symfony, la base de données n'avait pas de MCD.
Dans un premier temps, il a fallu créer toutes les entités et les associer aux 
```mocodo
Admin: id, username, password, email, lastname, firstname, token, active, forgotPasswordId, forgotPasswordAt, superAdmin, opsn
Category: id, name, image, description, sortOrder
Collectivite: id, name, population, departmentCode, siret, latitude, longitude, type, opsn
CollectiviteAnswer: id, question, answer, collectivite, body, answeredAt
CollectiviteType: id, label
Department: code, name, regionCode
OPSN: id, name, email, departement,active, logo, phoneNumber, postalAddress, website, siret, latitude, longitude
Question: id, question, theme, category, multiple, definition, additionalInformation, definitionTitle
Recommandation: id, title, body, question, category, level
RecommandationLevel: id, label
Score: collectivite, score, _scoredAt
TemporarySiret: siret, name
Theme: id, label, category
User: id, username, password, email, lastname, firstname, collectivite, admin, token, active, forgotPasswordId, forgotPasswordAt, CGU, verified
UserPreference: user, code, _json
```

