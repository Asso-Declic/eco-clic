## Rôles
Symfony impose qu'une classe utilisateur aie une méthode `getRoles()`. Elle doit retourner un tableau de chaines de caractères. On nomme les rôles comme on veut. Il est courant que le rôle de base soit `ROLE_USER`. Dans `config/packages/security.yaml`, on peut voir qu'il existe une hiérarchie dans cet ordre :
- `ROLE_USER`
- `ROLE_COLLECTIVITE`
- `ROLE_OPSN`
- `ROLE_SUPER_ADMIN`

Il fût un temps où les droits étaient déterminés uniquement par des booléens nommés $admin, $superAdmin et $superAdmin2. Ils ont été renommés. dans l'ordre, $adminCollectivite, $adminOpsn et $superAdmin. Le système n'a pas été modifié, il a été adapté. Le tableau fourni par `getRoles()` est construit à partir de ces trois variables.

Il existe une seule contrainte pour que tout fonctionne correctement, un utilisateur ROLE_OPSN ou ROLE_SUPER_ADMIN doit absolument être relié à une OPSN via sa propriété `$opsn`