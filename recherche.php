            <nav class="navbar">
                <div class="menuPhone bouton" id="menuBurger">
                    <img src="img/menuBurger.svg" alt="Menu">
                    <p>Menu</p>
                </div>

                <div class="navbar-right">
                    <!-- <div class="dropdown">

                        <img src="img/Notifications.svg" data-toggle="dropdown" aria-haspopup="true" onclick="MarquerCommeVu();" aria-expanded="false" class="icon infoBarre badge1" id="notification" alt="Notification">
                        <span class="badge2"></span>
                        <div class="dropdown-menu dropdown-menu-right" id="dropdown-notification" style="min-width:300px">
                            <div class=" h60px borderNotif" id="titreTabNotification">
                                <h5 class="text-center">Notifications</h5>
                            </div>

                            <div class="row h60px borderNotif">
                                <a href="#" class="align-self-center d-block mx-auto" onclick="MarquerCommeLu();">
                                    <span class="blueAdico size15px">Tout voir</span>
                                </a>
                            </div>
                        </div>
                    </div> -->
                    <div class="traitVertical infoBarre"></div>

                    <div class="dropdown show">
                        <a class="header-menu dropdown-toggle drop infoBarre" href="#" role="button" id="userMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo SessionHelper::GetCurrentUser()->Prenom . ' ' . SessionHelper::GetCurrentUser()->Nom ?>
                        </a>
                        <img src="img/perso.svg" id="iconBonhomme" class="icon infoBarre" aria-label="menu utilisateur">
                        <div class="header-dropdown-menu dropdown-menu dropdown-menu-right" style="min-width: 270px !important;">

                            <a class="dropdown-item text-center" href="./profil.php">
                                <span style="cursor:pointer;">Gestion du profil</span>
                            </a>

                            <!-- <a class="dropdown-item param-util text-center" id="modifMDP">
                                <span style="cursor:pointer;">Modifier mon mot de passe</span>
                            </a> -->

                            <hr class="dropdown-divider" style="border-top: 1px solid #00857A;">
                            <a class="dropdown-item text-center" href="./deco.php">
                                <span style="cursor:pointer;">Se déconnecter</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Modal changement de mot de passe -->

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
                            <form action="./AjaxLoader/UpdatePasswordUser.php" method="POST">
                                <div id="form_mdp"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modalChangementMotDePasse" tabindex="-1"
                aria-labelledby="modalChangementMotDePasseLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalChangementMotDePasseLabel">
                                <?php echo SessionHelper::GetCurrentUser()->Prenom . ' ' . SessionHelper::GetCurrentUser()->Nom ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <span class="col mt-1">Changer mon mot de passe</span>
                        <div class="modal-body">
                            <div>
                                <div class="row mb-3">
                                    <div class="col-12 col-lg-7 row">
                                        <label for="currentPass" class="col-12 col-lg-4 col-form-label ">Mot de passe
                                            actuel : </label>
                                        <input type="password" name="currentPass" id="currentPass"
                                            class="col-12 col-lg-8 form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 col-lg-7 row">
                                        <label for="newPass" class="col-12 col-lg-4 col-form-label ">Nouveau mot de
                                            passe : </label>
                                        <input type="password" name="newPass" id="newPass"
                                            class="col-12 col-lg-8 form-control">
                                    </div>
                                    <div class="col-12 col-lg-5">
                                        <span>
                                            Le mot de passe doit comporter 8 caractères dont une minuscule,
                                            une majuscule, un chiffre et un caractère spécial
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 col-lg-7 row">
                                        <label for="ConfirmNewPass" class="col-12 col-lg-4 col-form-label ">Confirmer
                                            mot de passe : </label>
                                        <input type="password" name="ConfirmNewPass" id="ConfirmNewPass"
                                            class="col-12 col-lg-8 form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-white-AreaLuciole blueAdico "
                                data-dismiss="modal">Précedent</button>
                            <button type="button" class="btn btn-primary-AreaLuciole " id='valider'>Valider</button>
                        </div>
                    </div>
                </div>
            </div> -->

            <script src="./js/header.js"></script>

            <style>
                .dx-button-mode-contained.dx-button-default {
                    background-color: #08453F;
                }

                .dx-label-v-align .dx-field-item-content .dx-invalid-message > .dx-overlay-content {
                    margin-top: 45px !important;
                }

                .dx-invalid-message > .dx-overlay-content {
                    padding: 4px !important;
                }

                .dx-editor-outlined .dx-texteditor-buttons-container:last-child > .dx-button:last-child, .dx-editor-filled .dx-texteditor-buttons-container:last-child > .dx-button:last-child {
                    margin-right: 5px;
                }

                .dx-button.dx-button-has-icon:not(.dx-button-has-text):not(.dx-shape-standard) {
                    border-radius: 10%;
                }

                .dx-button {
                    height: auto;
                }
            </style>