<?php
include "../Autoload.php";
include "./Common.php";

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
$utilisateurId = SessionHelper::GetCurrentUserAdministrateur()->Id;
$js_include = false;


//$sideBarActive = DbPreference::GetPreference($utilisateurId, 'SIDEBAR');
$sideBarActive = ''
?>
<?php include "./head.php"; ?>
<title><?= $Arianne[0]->Libelle;
        if (isset($Arianne[1])) {
            echo " - " . $Arianne[1]->Libelle;
        }
        if (isset($Arianne[2])) {
            echo " - " . $Arianne[2]->Libelle;
        }
        if (isset($Arianne[3])) {
            echo " - " . $Arianne[3]->Libelle;
        } ?></title>

<body>
    <div class="wrapper">

        <div class="modal" id="modal_mdp" tabindex="-1">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier mon mot de passe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../AjaxLoader/UpdatePasswordAdmin.php" method="POST">
                            <div id="form_mdp"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <nav id="sidebar" style="z-index:204; overflow:hidden;" class=<?php echo $sideBarActive; ?>>
            <div id="fermer-telephone" class="bouton">
                <p>x</p>
                <div>Fermer</div>
            </div>
            <div class="sidebar-header">
                <a href="utilisateurs.php">
                    <img id="logoNumeriscore" src="../img/logo_blanc.png" alt="logo" width="166">
                </a>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="#" id="retrecir" class="bouton text-center">
                        <h3 id="retrecirBoutonG">Rétrécir<img src="../img/icons/fleche.svg" alt="Rétrécir" style="margin-left: 20px"></h3>
                        <img src="../img/icons/menu-burger.svg" id="retrecirBoutonP" alt="Menu" class="m-0">
                    </a>
                </li>

                <li>
                    <a href="utilisateurs.php" <?php if ($selectedNav == "utilisateurs") echo 'id="onglet_actuel"'; ?>>
                        <img class="sidebarIcons" src="../img/icons/iconesBlanc/utilisateurs.svg" alt="">
                        <span class="col-10">Utilisateurs</span>
                    </a>
                </li>

                <?php if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 1) { ?>

                    <li>
                        <a href="themes.php" <?php if ($selectedNav == "themes") echo 'id="onglet_actuel"'; ?>>
                            <img class="sidebarIcons" src="../img/icons/iconesBlanc/themes.svg" alt="">
                            <span class="col-10">Thèmes</span>
                        </a>
                    </li>
                <?php    } ?>
                <li>
                    <a href="collectivite.php" <?php if ($selectedNav == "collectivite") echo 'id="onglet_actuel"'; ?>>
                        <img class="sidebarIcons" src="../img/icons/iconesBlanc/collectivite.svg" alt="">
                        <span class="col-10">Collectivités</span>
                    </a>
                </li>

                <?php if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 1) { ?>
                    <li>
                        <a href="AdminOPSN.php" <?php if ($selectedNav == "AdminOPSN") echo 'id="onglet_actuel"'; ?>>
                            <img class="sidebarIcons" src="../img/icons/iconesBlanc/opsn.svg" alt="">
                            <span class="col-10">OPSN</span>
                        </a>
                    </li>
                <?php    } ?>

                <?php if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 0) { ?>

                    <li>
                        <a href="OPSN.php?Id=<?= SessionHelper::GetCurrentUserAdministrateur()->OPSNId ?>" <?php if ($selectedNav == "OPSN") echo 'id="onglet_actuel"'; ?>>
                            <img class="sidebarIcons" src="../img/icons/iconesBlanc/opsn.svg" alt="">
                            <span class="col-10">OPSN</span>
                        </a>
                    </li>
                <?php    } ?>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content" class="container-fluid">

            <nav class="justify-content-between justify-content-lg-end navbar row" style="z-index:3;">

                <div class="menuPhone ">
                    <img src="../img/icons/menu-burger.svg" class="bouton" id="menuBurger" alt="Menu">
                    <p>Menu</p>
                </div>

                <!-- <div class="navbar-left col">
                    <img src="../img/icons/recherche.svg" id="iconRecherche" alt="Recherche">
                    <div class="infoBarre" id="searchBar"></div>
                </div> -->


                <div class="navbar-right">

                    <!-- <div class="dropdown">

                        <img src="../img/icons/cloche.svg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="icon infoBarre badge1" id="notification" onclick="MarquerCommeVu();" alt="Notification">
                        <span class="badge2"></span>
                        <div class="dropdown-menu dropdown-menu-right" id="dropdown-notification">
                            <div class="row h60px borderNotif" id="titreTabNotification">
                                <h5 class="mx-auto align-self-center greyArea">Notifications</h5>
                            </div>

                            <div class="row" id="liste_notification">

                            </div>

                            <div class="row h60px borderNotif">
                                <a href="#" class="align-self-center d-block mx-auto" onclick="MarquerCommeLu();"><span class="vertNumeriscore size15px">Tout voir</span></a>
                            </div>
                        </div>
                    </div> -->

                    <div class="traitVertical infoBarre"></div>

                    <div class="dropdown show">
                        <a class="header-menu" href="#" role="button" id="userMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user"></i>
                            <?php echo SessionHelper::GetCurrentUser()->Prenom . ' ' . SessionHelper::GetCurrentUser()->Nom ?>
                        </a>

                        <div class="header-dropdown-menu dropdown-menu dropdown-menu-right" style="min-width: 270px !important;">
                            <a class="dropdown-item param-util text-center" href="./profil.php">
                                <span style="cursor:pointer;">Mon profil</span>
                            </a>
                            <!-- <a class="dropdown-item param-util text-center" href="#">
                                <span>Accessibilité</span>
                            </a> -->
                            <a class="dropdown-item param-util text-center" id="modifMDP">
                                <span style="cursor:pointer;">Modifier mon mot de passe</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item param-util text-center" href="./deco.php">
                                <span>Se déconnecter</span>
                            </a>

                        </div>

                    </div>
                </div>
            </nav>
            <!--------------- FIL D'ARIANE -------------->
            <div class="col-12 py-2 px-4 mx-1">
                <?php
                $FilArianne = "";
                for ($i = 0; $i < count($Arianne); $i++) {
                    if ($i == count($Arianne) - 1) { //Si dernier élément, texte et icone vert numériscore
                        if (isset($Arianne[$i]->Icone)) {
                            $FilArianne = $FilArianne . "<img style='max-height:20px' src='../img/icons/iconesVert/" . $Arianne[$i]->Icone . ".svg' alt=''>";
                        }
                        $FilArianne = $FilArianne . " " . "<a class='fil-ariane' href='" . $Arianne[$i]->Lien . "'>" . $Arianne[$i]->Libelle . "</a>";
                    } else { //Sinon gris numériscore
                        if (isset($Arianne[$i]->Icone)) {
                            $FilArianne = $FilArianne . "<img style='max-height:20px' src='../img/icons/iconesGris/" . $Arianne[$i]->Icone . ".svg' alt=''>";
                        }
                        $FilArianne = $FilArianne . " " . "<a class='fil-ariane-ancien' href='" . $Arianne[$i]->Lien . "'>" . $Arianne[$i]->Libelle . "</a>";
                    }
                    if ($i != count($Arianne) - 1) {
                        $FilArianne = $FilArianne . " <i class='vertNumeriscore fas fa-chevron-right'></i>";
                    }
                }
                echo $FilArianne;
                if (isset($_SESSION['Version']) && $selectedNav == "themes") {
                    echo " <i class='vertNumeriscore fas fa-chevron-right'></i><span class='fil-ariane' id='version-ariane'> Version " . $_SESSION['Version'] . "</span>";
                }
                ?>
            </div>

            <div class="px-2">
                <!-- Décallage de la scrollbar -->
                <div class="page-content px-0 mx-1 scroller">