# Préférences utilisateur
L'entité UserPreference permet de stocker des préférences avec une clé et une valeur. Ces préférences auraient pu être conservées côté front en LocalStorage. Toutefois, le système existe et il est resté en place au cas où ça pourrait servir plus tard.

À un certains point dans l'histoire du projet, la seule préférence utilisateur était de retenir si le menu était ouvert ou fermé au chargement de la page.

On peut manipuler ces préférences avec l'api. La route /api/users/preference permet d'obtenir la valeur d'une option en GET et de l'écrire avec POST ou PATCH. Le code est prêt pour accepter n'importe quel code pour une préférence, et une valeur arbitraire en chaîne de caractères.
