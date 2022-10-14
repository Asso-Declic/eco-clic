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
        <i class="fa-solid fa-vr-cardboard" style="color: #08453F;"></i>
        <a class="fil-ariane" href="./gestQuestion.php">Gestion Thèmes</a>
    </div>

    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

    <div class="pt-5 d-flex col-12 justify-content-between">
        <span class="sous-titre">Gestion des thèmes</span>
    </div>

    <div id="buttons" class="col-md-12" style="float:right; margin-top: 20px;">

        <div class="suppr">

            <button  id="togg1" class="btn btn-secondary cree reduis" style="margin-right: -10px; margin-left: 20px;" disabled>Supprimer</button>
            
            <div id="d1" class="container d1">

                <div class="col-md-12 head">

                    <div class="col-md-12">
                        <a id="togg2"><img src="img/IconeCroixAnnuler.svg" alt="annuler"></a>
                    </div>
                </div>

                <div>
                    <p id="text">Supprimer définitivement ce thème ?</p>
                </div>
                
                <a href="#" onclick="suprrimer()" id="togg3">
                    <div>
                        Confirmer
                    </div>
                </a>
            </div>
        </div>

        <a href="#" data-toggle="modal" data-target=".bd-2-modal-lg">
            <button type="submit" onclick="RemplirModalModif()" id="modifier" class="btn btn-secondary cree btnline reduis" disabled>Modifier un thème</button>
        </a>

        <a href="#" data-toggle="modal" data-target=".bd-1-modal-lg">
            <button type="submit" id="ajouter" class="btn btn-secondary cree btnline reduis">+ Ajouter un thème</button>
        </a>

    </div>

    <p id="select"></p>

    <div class="col-md-12" style="display:flex; margin-top:100px; margin-bottom:50px;">
        <div id="listeTheme" class="col-md-8" style="margin: 0 auto;"></div>
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
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Nom du thème</h3>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nomThemeAjout" value="" required>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Selectionner une thème</h3>

                                <div class="col-sm-12">
                                    <select name="categ1" required class="form-control" id="categ-selectAjout">
                                        <option value="">Veuillez selectionner une catégorie</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="droit">
                            <button type="submit" onclick="ajouter()" class="btn btn-secondary boutonV modalbtn">OK</button>
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
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Nom du thème</h3>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nomThemeModif" value="" required>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Selectionner une catégorie</h3>

                                <div class="col-sm-12">
                                    <select name="categ2" required class="form-control" id="categ-selectModif">
                                        <option value="">Veuillez selectionner une catégorie</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="droit">
                            <button type="submit" onclick="modifier()" class="btn btn-secondary boutonV modalbtn">OK</button>
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

    function suprrimer() {
        $IdSup = [];
        for (let i = 0; i < $check.length; i++) {
            $IdSup.push($check[i].Id);
        }

        $jsonIdSup = JSON.stringify($IdSup);
        $.ajax({
            url: './AjaxLoader/SupTheme.php',
            type: 'post',
            async: false,
            dataType: 'json',
            data: {
                'IdSup': $jsonIdSup
            },
            success: function(data) {
                location.reload();
                if (data != 1) {
                    alert('Une erreur est survenue');
                }
            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('Une erreur est survenue');
            }
        });
    }

    $(document).ready(function(){
        urlDocEnteteAjax = "./AjaxLoader/getTheme.php";
        $(function()
        {
            $("#listeTheme").dxDataGrid({
                dataSource : urlDocEnteteAjax,
                showBorders: true,
                searchPanel: {
                    visible: true,
                    width: 260,
                    placeholder: "Rechercher un thème"
                },
                selection: {
                    mode: "multiple"
                },
                rowAlternationEnabled: true,
                columns:
                [
                    {
                        caption: "Nom du thème",
                        dataField: "Theme",
                    }
                ],
                allowColumnReordering: true,
                allowColumnResizing: true,
                showBorders: false,
                showColumnLines: false,
                showRowLines: true,
                rowAlternationEnabled: true,
                columnChooser: {
                    enabled: false
                },
                columnFixing: {
                    enabled: false
                },
                paging: {
                    enabled: false
                },
                columnResizingMode: "widget",
                columnMinWidth: 70,

                onSelectionChanged: function(selectedItems) {
                    $check = selectedItems.selectedRowsData;

                    changedBySelectBox = false;
                    
                    if($check.length == 0) {
                        document.getElementById("togg1").setAttribute("disabled", "disabled");
                        document.getElementById("d1").style.display = 'none';
                        document.getElementById("modifier").setAttribute("disabled", "disabled");

                        $("#select").text("");
                    }

                    if($check.length == 1) {
                        document.getElementById("togg1").removeAttribute("disabled");
                        $("#text").text("Supprimer définitivement ce thème ?");
                        document.getElementById("modifier").removeAttribute("disabled");

                        $("#select").text("Vous avez actuellement sélectionné " + $check.length + " thème.");
                    }

                    if($check.length > 1) {
                        document.getElementById("togg1").removeAttribute("disabled");
                        $("#text").text("Supprimer définitivement ces thèmes ?");
                        document.getElementById("modifier").setAttribute("disabled", "disabled");

                        $("#select").text("Vous avez actuellement sélectionné " + $check.length + " thèmes.");
                    }
                }
            }).dxDataGrid("instance");
                        
            var clearButton = $("#gridClearSelection").dxButton({
                text: "Clear Selection",
                disabled: true,
                onClick: function () {
                    dataGrid.clearSelection();
                }
            }).dxButton("instance");
            size();
            deplace();
        });
    });

    $w = 0;
    function size(){
        $w = $('#listeTheme').height();
        var newHeight = $(window).height() - $('#content').position().top - $('#listeTheme').height() - 227 - $('#togg1').height();
        $('#listeTheme').height(newHeight);

        if($(window).height() <= 620) {
            $('#listeTheme').height(245);
        }
        
    }

    $(window).on('resize', function() {
        var newHeight = $(window).height() - $('#content').position().top - $w - 227 - $('#togg1').height();
        $('#listeTheme').height(newHeight);

        if($(window).height() <= 620) {
            $('#listeTheme').height(245);
        }
    });

    function deplace(){
        $(".dx-datagrid-search-panel").insertBefore("#buttons");
    }

    $categories = "";
    $.ajax({
        url: './AjaxLoader/getCateg.php' ,
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(data) {
            for (let i = 0; i < data['data'].length; i++) {
                let option = document.createElement('option');
                option.setAttribute("value", data['data'][i].Id);
                option.textContent = data['data'][i].Nom;
                document.getElementById('categ-selectModif').append(option);
                
                let option2 = document.createElement('option');
                option2.setAttribute("value", data['data'][i].Id);
                option2.textContent = data['data'][i].Nom;
                document.getElementById('categ-selectAjout').append(option2);
            }
        },
        error: function(jqXhr, textStatus, errorThrown) {
            alert('Une erreur est survenue');
        }
    });

    function ajouter() {
        $theme = document.getElementById("nomThemeAjout").value;
        $categ = document.getElementById('categ-selectAjout').value;

        $jsontheme = JSON.stringify($theme);
        $jsonCateg = JSON.stringify($categ);
        $.ajax({
            url: './AjaxLoader/InsertTheme.php',
            type: 'post',
            async: false,
            dataType: 'json',
            data: {
                'theme': $jsontheme,
                'categId': $jsonCateg
            },
            success: function(data) {
                
                if (data != 1) {
                    alert('Une erreur est survenue');
                }
            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('Une erreur est survenue');
            }
        });
    }

    function modifier() {
        $theme2 = document.getElementById("nomThemeModif").value;
        $categ2 = document.getElementById('categ-selectModif').value;

        $jsonthemeId2 = JSON.stringify($check[0].Id);
        $jsontheme2 = JSON.stringify($theme2);
        $jsonCateg2 = JSON.stringify($categ2);
        $.ajax({
            url: './AjaxLoader/UpdateTheme.php',
            type: 'post',
            async: false,
            dataType: 'json',
            data: {
                'themeId': $jsonthemeId2,
                'theme': $jsontheme2,
                'categId': $jsonCateg2
            },
            success: function(data) {
                
                if (data != 1) {
                    alert('Une erreur est survenue');
                }
            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('Une erreur est survenue');
            }
        });
    }

    function RemplirModalModif() {
        document.getElementById("nomThemeModif").value = $check[0].Theme;
        document.getElementById('categ-selectModif').value = $check[0].IdCategorie;
    }
</script>