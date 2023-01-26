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


<body>
    <div class="wrapper">

        <!-- <div class="modal" id="modal_mdp" tabindex="-1">
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
        </div> -->

        <!-- Sidebar -->
        <nav id="sidebar">

            <div id="fermer-telephone" class="bouton">
                <p>x</p>
                <div>Fermer</div>
            </div>

            <div class="sidebar-header">
                <a href="collectivite.php">
                    <img id="logoEcoclic" src="../img/logoEcoclic.png" style="width: -webkit-fill-available;">
                </a>
            </div>

            <ul class="list-unstyled components">
                <li>

                    <?php // if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 1) { ?>

                        <!-- 
                        <a href="themes.php" <?php // if ($selectedNav == "themes") echo 'id="onglet_actuel"'; ?>>
                            <img class="sidebarIcons" src="../img/icons/iconesBlanc/themes.svg" alt="">
                            <span>Thèmes</span>
                        </a>
                        -->
                    <?php    // } ?>

                        <a href="collectivite.php" <?php if ($selectedNav == "collectivite") echo 'id="onglet_actuel"'; ?>>
                            <img class="sidebarIcons" src="../img/Icongraphcool.svg" alt="">
                            <span>Collectivités</span>
                        </a>

                        <a href="utilisateurs.php" <?php if ($selectedNav == "utilisateurs") echo 'id="onglet_actuel"'; ?>>
                            <img class="sidebarIcons" src="../img/Icon feather-users.svg" alt="">
                            <span>Gestion des utilisateurs</span>
                        </a>

                    <?php if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 1) { ?>
                       
                        <a href="AdminOPSN.php" <?php if ($selectedNav == "AdminOPSN") echo 'id="onglet_actuel"'; ?>>
                            <img class="sidebarIcons" src="../img/opsn.svg" alt="">
                            <span>OPSN</span>
                        </a>
                    <?php } ?>

                    <?php // if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 0) { ?>

                        <!-- <a href="OPSN.php?Id=<?php // SessionHelper::GetCurrentUserAdministrateur()->OPSNId ?>" <?php // if ($selectedNav == "OPSN") echo 'id="onglet_actuel"'; ?>>
                            <img class="sidebarIcons" src="../img/opsn.svg" alt="">
                            <span>OPSN</span>
                        </a> -->
                    <?php // } ?>

                    <a href="#" tabindex="1" id="retrecir" class="bouton" style="padding: 5px;">
                        <h3 id="retrecirBoutonG">
                            <img src="../img/Icon awesome-chevron-circle-left.svg" style="margin-left: -10px;">
                            Réduire le menu
                        </h3>
                        <img src="../img/menuBurger.svg" id="retrecirBoutonP" style="margin-left: 5px;">
                    </a>

                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content" class="container-fluid">

            <nav class="justify-content-between justify-content-lg-end navbar" style="z-index:3; background-color: #fff;">

                <div class="menuPhone ">
                    <img src="../img/menuBurger.svg" class="bouton" id="menuBurger" alt="Menu">
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
                                <a href="#" class="align-self-center d-block mx-auto" onclick="MarquerCommeLu();"><span class="vertEcoclic size15px">Tout voir</span></a>
                            </div>
                        </div>
                    </div> -->

                    <div class="traitVertical infoBarre"></div>

                    <div class="dropdown show">
                        <a class="header-menu" href="#" role="button" id="userMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../img/perso.svg" id="iconBonhomme" class="icon infoBarre" aria-label="menu utilisateur">
                            <?php echo SessionHelper::GetCurrentUser()->Prenom . ' ' . SessionHelper::GetCurrentUser()->Nom ?>
                        </a>

                        <div class="header-dropdown-menu dropdown-menu dropdown-menu-right" style="min-width: 270px !important;">
                            <a class="dropdown-item param-util text-center" href="./profil.php">
                                <span style="cursor:pointer;">Gestion du profil</span>
                            </a>
                            <!-- <a class="dropdown-item param-util text-center" href="#">
                                <span>Accessibilité</span>
                            </a> -->
                            <!-- <a class="dropdown-item param-util text-center" id="modifMDP">
                                <span style="cursor:pointer;">Modifier mon mot de passe</span>
                            </a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item param-util text-center" href="./deco.php">
                                <span>Se déconnecter</span>
                            </a>

                        </div>

                    </div>
                </div>
            </nav>
            

            <div>
                <!-- Décallage de la scrollbar -->
                <div class="page-content px-0 mx-1 scroller">

<script>
    $OPSNId = "<?php echo SessionHelper::GetCurrentUserAdministrateur()->OPSNId; ?>";
    $OPSNName = "<?php echo SessionHelper::GetCurrentUserAdministrateur()->NomOPSN ?>";
</script>