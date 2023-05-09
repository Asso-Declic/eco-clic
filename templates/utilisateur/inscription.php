<!DOCTYPE html>
<html lang="fr">

<head>
    <title>L'éco-clic - Inscription</title>
    <?=$view->render('partials/metas.php') ?>
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/placeholderRGAA.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="./js/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/22.1.3/css/dx.light.css">
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/22.1.3/js/dx.all.js"></script>
</head>

<body class="container-fluid">
    <div class="row ">

        <!-- TODO : Vérifier l'utilité de cette div et ajouter un commentaire en PHP si elle est utile -->
        <div class="col-lg-5 col-xl-5">
        </div>

        <div id="userSpace" class="justify-content-between col-lg-7 col-xl-7 row">
            <div class="col-12" style="padding-left: 15px;padding-right: 15px;">

                <img src="./img/logoEcoclic.png" alt="logo Ecoclic" class="top logo d-block mx-auto">

                <p class='col- text-center fs mt-4'>Veuillez renseigner les champs ci-dessous</p>

                <form id="signin_form" action="./sys_inscription.php" method="post" style="padding-inline: 85px;">
                    <div id="form"></div>
                </form>

                <!-- <div class="col-7" style="margin: 0 auto 65px auto;">
                    <a href="index.php"><button style="margin: 15px auto 0 auto;" class="d-block btn btn-blueAdico rounded-pill white col-7 col-lg-7 fs"> Annuler </button></a>
                </div> -->

                <div class="d-flex justify-content-center">
                    <footer class="text-center footer mt-auto py-3 bg-white" style="position:absolute; bottom:0;">
                        <div class="container">
                            <span class="row text-muted flex-nowrap">
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
        .col-md-6 {
            padding-right: 1px;
            padding-left: 1px;
        }

        @media (min-height: 949px) {
            #userSpace {
                height: 100vh;
            }
        }

        @media (min-width: 992px) {
            #r195624624 {
                display: flex;
                flex-wrap: wrap;
                /* justify-content: center; */
            }
        }

        @media screen and (max-width: 1600px) {
            #userSpace {
                height: inherit;
                width: inherit;
            }
        }

        .btn-blueAdico {
            height: 34px !important;
            width: 113px;
            --blue: #007bff;
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #e83e8c;
            --red: #dc3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #fff;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --primary: #007bff;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
            --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            -webkit-box-direction: normal;
            -webkit-tap-highlight-color: transparent;
            -webkit-text-size-adjust: none;
            -webkit-print-color-adjust: exact;
            font-weight: 400;
            font-size: 14px;
            font-family: "Helvetica Neue", "Segoe UI", helvetica, verdana, sans-serif;
            cursor: pointer;
            text-align: center;
            user-select: none;
            color: #fff !important;
            box-sizing: border-box;
            height: 100%;
            max-height: 100%;
            line-height: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 7px 18px 8px;
        }

        .dx-label-before {
            width: 20px !important;
        }

        .dx-editor-outlined.dx-texteditor-with-floating-label .dx-texteditor-label .dx-label-before,
        .dx-editor-outlined.dx-texteditor-with-label .dx-texteditor-label .dx-label-before {
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
            background-color: transparent !important;
        }

        .dx-button {
            border-radius: 40px !important;
        }

        .dx-button-mode-contained {
            background-color: #00857A;
            border-color: transparent !important;
            color: #fff;
            height: 60px !important;
            width: 170px !important;
            padding: 0.375rem 0.75rem;
            font-size: 15px;
        }

        .dx-button-mode-contained.dx-state-hover {
            background-color: #00857A !important;
            color: #fff !important;
        }

        .dx-button-normal.dx-state-hover {
            background-color: rgb(240, 240, 240) !important;
            color: rgb(8, 69, 63) !important;
        }

        .dx-editor-outlined.dx-texteditor-with-floating-label .dx-texteditor-label .dx-label-before,
        .dx-editor-outlined.dx-texteditor-with-label .dx-texteditor-label .dx-label-before {
            border-radius: 40px 0 0 40px !important;
            padding-left: 40px !important;
        }

        .dx-texteditor-input {
            height: 80px;
        }

        .dx-texteditor-input {
            padding: 7px 40px 8px;
        }

        .oeil {
            background-color: white !important;
            border-color: transparent !important;
            color: #fff;
            height: 60px !important;
            width: 60px !important;
            padding: 0.375rem 0.75rem;
            font-size: 15px;
        }
    </style>
    <script src="./js/placeholderRGAA.js"></script>
    <script src="./js/inscription.js"></script>
    <script src="./js/index.js"></script>
</body>
</html>