<!DOCTYPE html>
<html lang="fr">

<head>
    <title>L'éco-clic - Mot de passe oublié</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="./css/placeholderRGAA.css">
    <link rel="stylesheet" href="./css/index.css">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel='icon' type='image/x-icon' href='img/favicon.png'>

</head>

<body class="container-fluid" style="padding-left: 0;">
    <div id="contenu" class="row ">

        <div id="espace" class="col-lg-5 col-xl-5">
        </div>

        <div id="userSpace" class="justify-content-between col-lg-7 col-xl-7 row center">
            <div class="col-12 mx-auto" style="margin-top: 90px !important;">

                <img src="./img/logoEcoclic.png" alt="logo Ecoclic" class="top logo d-block mx-auto">

                <form action="./sys_motdepasse_oublie.php" method="post" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">

                    <?php
                        include "./Autoload.php";
                    ?>

                    <p class="text-center fs mt-5" style="margin-bottom: 65px;">Modifier votre mot de passe</br>Veuillez renseigner votre adresse email ci-dessous</p>

                    <fieldset>

                        <!-- Email -->
                        <fieldset class="formRow">
                            <div class="formRow--item col-12">
                                <p>Adresse Email* :</p>
                                <label for="email_input" class="formRow--input-wrapper js-inputWrapper">
                                    <input type="text" class="formRow--input js-input form-input" id="email_input" required name="email_input" placeholder="Email*">
                                </label>
                            </div>
                        </fieldset>

                        <p class="text-right d-block col-12">*Champs obligatoires</p>
                    
                        <div class="col-12 row align-items-baseline" style="margin-bottom: 65px;">
                            <button type="button" id="annuler" class="d-block btn btn-blueAdico rounded-pill white col-12 col-lg-5 fs" style=" background-color: #F0F0F0;color: #08453F"> Annuler </button>
                            <button type="submit" class="d-block btn btn-blueAdico rounded-pill white col-12 col-lg-5 fs" style="margin-top: 20%;"> Valider </button>
                        </div>

                    </fieldset>
                </form>


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
        @media (min-height: 609px) {
            #userSpace {
                height: 100vh;
            }
        }

        #annuler:hover {
            color: #000 !important;
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

            document.getElementById("espace").style.height = $(document).height() + "px";
        });
    </script>

    <script src="http://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="./js/placeholderRGAA.js"></script>
    <script src="./js/index.js"></script>
</body>