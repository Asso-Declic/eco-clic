<?php
include "./Autoload.php";
?>

<?php include "Common.php"?>

<?php
    if(SessionHelper::GetCurrentUser()->SuperAdmin == 0){
        header("Location: ./accueil.php");
    }
?>

<!-- Header  -->
<?php require "header.php"?>

<!-- Sidebar  -->
<?php require "menu.php"?>

<!-- Page Content  -->
<div id="content" class="container-fluid">

    <!-- Barre de recherche  -->
    <?php require "recherche.php"?>

    <div class="col-12 fil-ariane py-2 px-4">
        <img src="./img/parametres.svg" alt="">
        <a class="fil-ariane" href="./parametresAdmin.php">Paramètres administrateur</a>
        <i class="fas fa-chevron-right" style="color:#08433D"></i>
        <img src="./img/recommandations.svg" alt="">
        <a class="fil-ariane" href="./gestQuestionnaire.php">Gestion questionnaire</a>
        <i class="fas fa-chevron-right" style="color:#08433D"></i>
        <i class="fa-solid fa-question" style="color: #08453F;"></i>
        <a class="fil-ariane" href="./gestQuestion.php">Gestion recommandations</a>
    </div>

    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

    <div class="pt-5 d-flex col-12 justify-content-between">
        <span class="sous-titre">Gestion des Recommandations</span>
    </div>

    <div class="col-md-12" style="float:right; margin-top: 20px;">

        <div class="suppr">

            <button  id="togg1" class="btn btn-secondary cree reduis" style="margin-right: -10px; margin-left: 20px;">Supprimer</button>
            
            <div id="d1" class="container d1">

                <div class="col-md-12 head">

                    <div class="col-md-12">
                        <a id="togg2"><img src="img/IconeCroixAnnuler.svg" alt="annuler"></a>
                    </div>
                </div>

                <div>
                    <p id="text">Supprimer définitivement cette question ?</p>
                </div>
                
                <a href="#" id="togg3">
                    <div>
                        Confirmer
                    </div>
                </a>
            </div>
        </div>

        <a href="#" data-toggle="modal" data-target=".bd-2-modal-lg">
            <button type="submit" class="btn btn-secondary cree btnline reduis">Modifier une recommandation</button>
        </a>

        <a href="#" data-toggle="modal" data-target=".bd-1-modal-lg">
            <button type="submit" class="btn btn-secondary cree btnline reduis">+ Ajouter une recommandation</button>
        </a>

    </div>

    <!-- modal -->
    <!-- ajouter -->
    <div class="modal fade bd-1-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-show="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container">
                    <form action="" method="post">
                        <div class="form-row">
                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Recommandation</h3>
                                <div class="col-sm-12">
                                    <!-- <input type="text" class="form-control" id="recoAjout" value="" required> -->
                                    <div id="recoAjout" class="html-editor"></div>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Selectionner une catégorie</h3>

                                <div class="col-sm-12">
                                    <select name="categ1" class="form-control" id="categ-selectAjout">
                                        <option value="">--Please choose an option--</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Selectionner un thème</h3>

                                <div class="col-sm-12">
                                    <select name="theme1" class="form-control" id="theme-selectAjout">
                                        <option value="">--Please choose an option--</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Selectionner une question</h3>

                                <div class="col-sm-12">
                                    <select name="question1" class="form-control" id="question-selectAjout">
                                        <option value="">--Please choose an option--</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="droit">
                            <button type="submit" class="btn btn-secondary boutonV modalbtn">OK</button>
                            <button type="submit" class="btn btn-light boutonA modalbtn" data-dismiss="modal">Annuler</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modifier -->
    <div class="modal fade bd-2-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-show="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container">
                    <form action="" method="post">
                        <div class="form-row">
                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Recommandation</h3>
                                <div class="col-sm-12">
                                    <!-- <input type="text" class="form-control" id="recoModif" value="" required> -->
                                    <div id="recoModif" class="html-editor"></div>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Selectionner une catégorie</h3>

                                <div class="col-sm-12">
                                    <select name="categ2" class="form-control" id="categ-selectModif">
                                        <option value="">--Please choose an option--</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Selectionner un thème</h3>

                                <div class="col-sm-12">
                                    <select name="theme2" class="form-control" id="theme-selectModif">
                                        <option value="">--Please choose an option--</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Selectionner une question</h3>

                                <div class="col-sm-12">
                                    <select name="question2" class="form-control" id="question-selectModif">
                                        <option value="">--Please choose an option--</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="droit">
                            <button type="submit" class="btn btn-secondary boutonV modalbtn">OK</button>
                            <button type="submit" class="btn btn-light boutonA modalbtn" data-dismiss="modal">Annuler</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    let togg1 = document.getElementById("togg1");
    let togg2 = document.getElementById("togg2");
    let togg3 = document.getElementById("togg3");
    let d1 = document.getElementById("d1");
    togg1.addEventListener("click", () => {
        if(getComputedStyle(d1).display != "none"){
            d1.style.display = "none";
        } else {
            d1.style.display = "block";
        }
    })
    togg2.addEventListener("click", () => {
        if(getComputedStyle(d1).display != "none"){
            d1.style.display = "none";
        } else {
            d1.style.display = "block";
        }
    })
    togg3.addEventListener("click", () => {
        if(getComputedStyle(d1).display != "none"){
            d1.style.display = "none";
        } else {
            d1.style.display = "block";
        }
    })

    $(".html-editor").dxHtmlEditor({
        toolbar: {
            items: [
                "undo", "redo", "separator",
                {
                    name: "size",
                    acceptedValues: ["8pt", "10pt", "12pt", "14pt", "18pt", "24pt",
                        "36pt"
                    ]
                },
                "separator", "bold", "italic", "strike", "underline", "separator",
                "alignLeft", "alignCenter", "alignRight", "alignJustify",
                "separator",
                "orderedList", "bulletList", "separator",
                "link", "separator",
            ]
        },
        mediaResizing: {
            enabled: true
        },
    }).dxHtmlEditor('instance');
</script>