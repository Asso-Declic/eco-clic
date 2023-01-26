<?php
include './Autoload.php';

if (isset($_GET['i'])) {
    $i = $_GET['i'];
} else {
    $i=0;
}

if (isset($_GET['Id'])) {
    $idMdp = $_GET['Id'];
    $utilisateurId = DbUtilisateur::CheckIdMotDePasseOublie($idMdp);

    if ($utilisateurId == -1) {
        echo "
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <link href='http://www.jqueryscript.net/css/jquerysctipttop.css' rel='stylesheet' type='text/css'>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI' crossorigin='anonymous'></script>
        <link rel='stylesheet' href='./css/index.css'>
         <link rel='stylesheet' href='./css/placeholderRGAA.css'>
         <link rel='icon' type='image/x-icon' href='img/favicon.png'>

         <body class='container-fluid' style='padding-left: 0;'>
             <div id='contenu' class='row'>
                 <div class='col-lg-5 col-xl-5'></div>
                 <div id='userSpace' class='justify-content-between col-lg-7 col-xl-7 row center'>
                        <div class='col-12 mx-auto' style='margin-top: 90px !important;'>
                         <img src='./img/logoEcoclic.png' alt='logo Ecoclic, design' class='top col-5 logo d-block mx-auto'>
                         <p class='col-6 text-center mt-5'> Erreur lien invalide ou expiré </p>

                         <div class='d-flex justify-content-center'>
                            <footer class='text-center footer mt-auto py-3 bg-white' style='position: fixed;bottom: 0;'>
                                <div class='container'>
                                    <span class='row text-muted'>
                                        <a href='#' class='px-1'>Mentions légales</a>
                                        <div class='traitVertical'></div>
                                        <a href='#' class='px-1'>Accessibilité : Partiellement conforme</a>
                                        <div class='traitVertical'></div>
                                        <a href='#' data-toggle='modal' data-target='#exampleModal' class='px-1'>Conditions générales d'utilisation</a>
                                        <div class='traitVertical'></div>
                                        <a href='#' class='px-1'>Aide</a>
                                        <div class='traitVertical'></div>
                                        <a href='#' class='px-1'>À propos de</a>
                                    </span>
                                </div>
                            </footer>
                        </div>

                        <!-- Modal -->
                        <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-scrollable modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>CONDITIONS GÉNÉRALES</h5>
                                    </div>
                                    <div class='modal-body' style='margin: 10px; border: 1px solid #08453F;'>
                                        <h1>Titre</h1>
                                        <p>Titre Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 1 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 2 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem.</p>
                                        <h4>Sous titre 1</h4>
                                        <p>Titre Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 1 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 2 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem.</p>
                                        <h4>Sous titre 2</h4>
                                        <p>Titre Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 1 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 2 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem.</p>
                                    </div>
                                    <div class='modal-footer'>
                                        <button style='border: 1px solid grey; color: #08453F;' type='button' class='btn btn-light' data-dismiss='modal'>Retour</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
        
                 </div>
             </div>

             <script src='./js/placeholderRGAA.js'></script>
             <script src='./js/changementMdp.js'></script>
             <script src='./js/index.js'></script>
         </body>";
    } else {
        echo " 
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <link href='http://www.jqueryscript.net/css/jquerysctipttop.css' rel='stylesheet' type='text/css'>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI' crossorigin='anonymous'></script>
        <link rel='stylesheet' href='./css/index.css'>
        <link rel='stylesheet' href='./css/placeholderRGAA.css'>
        <link rel='icon' type='image/x-icon' href='img/favicon.png'>
        
        <body class='container-fluid' style='padding-left: 0;'>
            <div id='contenu' class='row'>
                <div class='col-lg-5 col-xl-5'></div>
                <div id='userSpace' class='justify-content-between col-lg-7 col-xl-7 row center'>
                    <div class='col-12 mx-auto' style='margin-top: 90px !important;'>
                        <img src='./img/logoEcoclic.png' alt='logo Ecoclic, design' class='top logo d-block mx-auto'>
                        <form action=" . Config::read('domaine') . "ClearMotDePasseOublie.php?Id=$idMdp method='post' class='col-xs-12 col-sm-12 col-md-12 col-lg-7'>
                            <p class='col- text-center fs mt-4'>Saisir votre nouveau mot de passe ci-dessous</p>
        
                            <fieldset>
        
                               <!-- Nouveau mot de passe -->
                               <fieldset class='formRow mt-4'>
                                   <div class='formRow--item'>
                                      <p> Nouveau mot de passe *: </p>
                                       <label for='new_pass' class='formRow--input-wrapper js-inputWrapper'>
                                           <input type='password' class='formRow--input js-input form-input' id='new_pass' placeholder='Nouveau mot de passe' 
                                           pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&])[A-Za-z\d@$!%*?#&]{8,}$' required name='new_pass'>
                                           <span class='iconPass' title='Afficher mot de passe'><img class='iconPassSize' src='./img/Oeil.svg' alt=''></span>
                                       </label>
                                   </div>
                               </fieldset>

                               <!-- Règles mdp -->
                               <div class='col-12 mb-4 d-flex'>
                                   <img src='./img/Icone_alerte.svg' alt='Iconne alerte' class='iconAlert' style='height: 1.5em;'>
                                   <p class='passRules px-1'>
                                       Le mot de passe doit comporter 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial
                                   </p>
                               </div>
        
                               <!-- Confirmation nouveau mot de passe -->
                               <fieldset class='formRow'>
                                   <div class='formRow--item'>
                                      <p> Confirmer le nouveau mot de passe *: </p>
                                       <label for='conf_new_pass' class='formRow--input-wrapper js-inputWrapper'>
                                           <input type='password' class='formRow--input js-input form-input' id='conf_new_pass' placeholder='Confirmer le nouveau mot de passe' 
                                           required name='conf_new_pass'>
                                       </label>
                                   </div>
                               </fieldset>
                               <p class='text-right col-12'> * Champs obligatoires </p>

                               <span hidden id='pswConfirm' style='margin-bottom:10px !important;' class='text-danger alerts col-12 row mb-3'>Veuillez entrer les mêmes mot de passe</span>
        
                               <div class='col-6 mt-5'>
                                   <button type='submit' class='btn btn-blueAdico col-12 d-block fs rounded-pill white'> Valider </button>
                               </div>
                            </fieldset>
                        </form>

                        <div class='d-flex justify-content-center'>
                            <footer class='text-center footer mt-auto py-3 bg-white' style='position: fixed;bottom: 0;'>
                                <div class='container'>
                                    <span class='row text-muted'>
                                        <a href='#' class='px-1'>Mentions légales</a>
                                        <div class='traitVertical'></div>
                                        <a href='#' class='px-1'>Accessibilité : Partiellement conforme</a>
                                        <div class='traitVertical'></div>
                                        <a href='#' data-toggle='modal' data-target='#exampleModal' class='px-1'>Conditions générales d'utilisation</a>
                                        <div class='traitVertical'></div>
                                        <a href='#' class='px-1'>Aide</a>
                                        <div class='traitVertical'></div>
                                        <a href='#' class='px-1'>À propos de</a>
                                    </span>
                                </div>
                            </footer>
                        </div>

                        <!-- Modal -->
                        <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-scrollable modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>CONDITIONS GÉNÉRALES</h5>
                                    </div>
                                    <div class='modal-body' style='margin: 10px; border: 1px solid #08453F;'>
                                        <h1>Titre</h1>
                                        <p>Titre Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 1 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 2 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem.</p>
                                        <h4>Sous titre 1</h4>
                                        <p>Titre Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 1 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 2 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem.</p>
                                        <h4>Sous titre 2</h4>
                                        <p>Titre Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 1 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem. Sous titre 2 Dolor sit amet, consectetur adipiscing elit. Aenean ac auctor ex. Ut dictum diam sit amet porttitor iaculis. Fusce ut tellus vitae elit consectetur aliquam. Quisque sit amet magna quis arcu vestibulum fermentum eu ac nisl. Aenean non tortor id eros condimentum interdum. Morbi vulputate mattis eros eget scelerisque. Fusce id tortor elit. Nullam nunc sapien, faucibus vitae laoreet at, blandit nec sapien. Quisque eu nibh facilisis, aliquet turpis euismod, iaculis lorem.</p>
                                    </div>
                                    <div class='modal-footer'>
                                        <button style='border: 1px solid grey; color: #08453F;' type='button' class='btn btn-light' data-dismiss='modal'>Retour</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
        
                </div>
            </div>
            <script src='./js/placeholderRGAA.js'></script>
            <script src='./js/changementMdp.js'></script>
            <script src='./js/index.js'></script>
            <script>
                if(".$i." == 1) {
                    document.getElementById('pswConfirm').removeAttribute('hidden')
                }
            </script>
        </body> <title>L'éco-clic - Mot de passe oublié</title>";
    }
}
