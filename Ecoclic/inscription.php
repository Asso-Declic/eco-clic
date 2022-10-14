<!DOCTYPE html>
<html lang="fr">

<head>
    <title>L'éco-clic - Inscription</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="./js/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="./css/placeholderRGAA.css">
    <link rel="stylesheet" href="./css/index.css">
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/22.1.3/css/dx.light.css">
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/22.1.3/js/dx.all.js"></script>
</head>

<body class="container-fluid">
    <div class="row ">

        <div class="col-lg-5 col-xl-5">
        </div>

        <div id="userSpace" class="justify-content-between col-lg-7 col-xl-7 row">
            <div class="col-12" style="padding-left: 15px;padding-right: 15px;">
            
                <img src="./img/logoEcoclic.png" alt="logo Ecoclic" class="top logo d-block mx-auto">

                <form id="signin_form" action="./sys_inscription.php" method="post">
                    <div id="form"></div>
                </form>

				<div class="d-flex justify-content-center">
                    <footer class="text-center footer mt-auto py-3 bg-white" style="position:absolute; bottom:0;">
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

            </div>
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
    
    <style>
        .col-md-6{
            padding-right: 1px;
            padding-left: 1px;
        }

        @media (min-height: 949px) {
            #userSpace
            {
                height: 100vh;
            }
        }

        @media screen and (max-width: 1600px)
        {
            #userSpace{
                height: inherit;
                width: inherit;
            }
        }

        .dx-label-before {
            width: 20px !important;
        }

        .dx-editor-outlined.dx-texteditor-with-floating-label .dx-texteditor-label .dx-label-before, .dx-editor-outlined.dx-texteditor-with-label .dx-texteditor-label .dx-label-before {
            border-radius: 40px 0 0 40px !important;
        }

        .dx-editor-outlined .dx-texteditor-label .dx-label-after {
            border-radius: 0 40px 40px 0 !important;
        }

        .dx-button-mode-contained.dx-button-default {
            background-color: transparent !important;
        }

        .dx-button-mode-contained.dx-button-default.dx-state-focused {
            background-color: transparent !important;
        }

        .dx-checkbox-indeterminate .dx-checkbox-icon::before {
            background-color : transparent !important;
        }

        .dx-button {
            border-radius: 40px !important;
        }

        .dx-button-mode-contained {
            background-color: #00857A !important;
            border-color: #transparent !important;
            color: #fff !important;
        }
    </style>

	<script src="./js/placeholderRGAA.js"></script>
    <script src="./js/inscription.js"></script>
	<script src="./js/index.js"></script>

</body>