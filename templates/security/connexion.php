<!DOCTYPE html>
<html lang="fr">
<head>
    <title>L'éco-clic - Connexion</title>
    <?=$view->render('partials/metas.php') ?>
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/placeholderRGAA.css">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body class="container-fluid" style="padding-left: 0;">
    <div id="contenu" class="row ">
        <div id="espace" class="col-lg-5 col-xl-5 d-none d-lg-block">
        </div>
        <div id="userSpace" class="justify-content-between col-lg-7 col-xl-7 row center">
            <div class="col-12 mx-auto" style="margin-top: 90px !important;">
                <img src="./img/logoEcoclic.png" alt="logo Ecoclic" class="top logo d-block mx-auto">
                <form action="<?=$urlGenerator->generate('security_login_post') ?>" method="post" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                    <p class="text-center fs mt-4">Saisir vos informations ci-dessous</p>
                    <fieldset>
                        <!-- Identifiant -->
                        <fieldset class="formRow mb-3">
                            <div class="formRow--item col-12">
                                <label for="username_input_login" class="formRow--input-wrapper js-inputWrapper">
                                    <input type="text" class="formRow--input js-input form-input iconIdentifiant" id="username_input_login" name="username_input_login" placeholder="Identifiant">
                                    <span class="iconPass4"><img class="iconPassSize" src="./img/coche_verte.svg" alt=""></span>
                                </label>
                            </div>
                        </fieldset>

                        <!-- Mot de passe -->
                        <fieldset class="formRow mb-3">
                            <div class="formRow--item col-12">
                                <label for="password_input_eyes" class="formRow--input-wrapper js-inputWrapper">
                                    <input type="password" class="formRow--input js-input form-input iconMDP" id="password_input_eyes" name="password_input_eyes" placeholder="Mot de passe">
                                    <span class="iconPass" title="Afficher mot de passe"><img class="iconPassSize" src="./img/Oeil.svg" alt=""></span>
                                </label>
                            </div>
                        </fieldset>

                        <a href="./motdepasse_oublie.php" class="text-right d-block col-12">
                            <span id="forgotPass" class="opa80 fs">
                                Mot de passe oublié ?
                            </span>
                        </a>

                        <div class="col-7">
                            <button type="submit" class="d-block btn btn-blueAdico rounded-pill white mt-10 col-12 col-lg-12 fs"> Se connecter </button>
                        </div>

                    </fieldset>
                </form>

                <p class="opa80 text-center mt-10 fs" style="margin-bottom: 65px;">
                    Vous n'êtes pas encore inscrit ?
                    <a href="<?=$urlGenerator->generate('utilisateur_inscription') ?>" class="blueAdico sousligne">
                        Créer un compte
                    </a>
                </p>

                <div id="declic">
                    <p>Fièrement propulsé par Déclic</p>
                    <img src="./img/LOGO_DECLIC_2018_rvb.jpg" alt="logo Déclic">
                </div>

                <div class="d-flex justify-content-center">
                    <footer class="text-center footer mt-auto py-3 bg-white" style="position: absolute;bottom: 0;">
                        <div class="container">
                            <span class="row text-muted">
                                <a href="#" class="px-1">Mentions légales</a>
                                <div class="traitVertical "></div>
                                <a href="#" class="px-1">Accessibilité : Partiellement conforme</a>
                                <div class="traitVertical "></div>
                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="px-1">Conditions générales d'utilisation</a>
                                <div class="traitVertical "></div>
                                <a href="#" class="px-1">Aide</a>
                                <div class="traitVertical "></div>
                                <a href="#" class="px-1">À propos de</a>
                            </span>
                        </div>
                    </footer>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">CONDITIONS GÉNÉRALES</h5>
                            </div>
                            <div class="modal-body" style="margin: 10px; border: 1px solid #08453F;">
                                <h1>Titre</h1>
                                <p>Titre Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 1 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 2 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem.</p>
                                <h4>Sous titre 1</h4>
                                <p>Titre Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 1 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 2 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem.</p>
                                <h4>Sous titre 2</h4>
                                <p>Titre Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 1 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 2 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem.</p>
                            </div>
                            <div class="modal-footer">
                                <button style="border: 1px solid grey; color: #08453F;" type="button" class="btn btn-light" data-dismiss="modal">Retour</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        @media (min-height: 717px) {
            #userSpace {
                height: 100vh;
            }
        }
    </style>

    <script>
        $(document).ready(function() {
            $(window).on('resize', function() {
                if ($(document).height() > $(window).height()) {
                    document.querySelector(".footer").style.position = "inherit";
                } else {
                    document.querySelector(".footer").style.position = "absolute";
                }
                document.getElementById("espace").style.height = $(document).height() + "px";
            });

            if ($(document).height() > $(window).height()) {
                document.querySelector(".footer").style.position = "inherit";
            } else {
                document.querySelector(".footer").style.position = "absolute";
            }

            // document.getElementById("espace").style.height = $(document).height()+"px";
        });
    </script>

    <script src="http://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="./js/placeholderRGAA.js"></script>
    <script src="./js/index.js"></script>
</body>
</html>