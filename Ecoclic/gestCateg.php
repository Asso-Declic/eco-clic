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
        <img class="iconMenu" src="img/bubble.svg">
        <a class="fil-ariane" href="./gestQuestion.php">Gestion Catégories</a>
    </div>

    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

    <div class="pt-5 d-flex col-12 justify-content-between">
        <span class="sous-titre">Gestion des catégories</span>
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
                    <p id="text">Supprimer définitivement cette catégorie ?</p>
                </div>
                
                <a href="#" onclick="suprrimer()" id="togg3">
                    <div>
                        Confirmer
                    </div>
                </a>
            </div>
        </div>

        <a href="#" data-toggle="modal" data-target=".bd-2-modal-lg">
            <button type="submit" id="modifier" onclick="editor()" class="btn btn-secondary cree btnline reduis" disabled>Modifier une catégorie</button>
        </a>

        <a href="#" data-toggle="modal" data-target=".bd-1-modal-lg">
            <button type="submit" id="ajouter" class="btn btn-secondary cree btnline reduis">+ Ajouter une catégorie</button>
        </a>

    </div>

    <p id="select"></p>

    <div class="col-md-12" style="display:flex; margin-top:100px; margin-bottom:50px;">
        <div id="listeCateg" class="col-md-8" style="margin: 0 auto;"></div>
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
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Nom de la catégorie</h3>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nomCategAjout" value="" required>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Description</h3>
                                <div class="col-sm-12">
                                    <div id="descAjout" class="html-editor"></div>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Image de la catégorie</h3>
                                <div class="categ" id="file-etape2">
                                    <div id="imgCateg"></div> 
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
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Nom de la catégorie</h3>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nomCategModif" value="" required>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Description</h3>
                                <div class="col-sm-12">
                                    <div id="descModif" class="html-editor2"></div>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <h3 class="col-md-12 col-form-label" style="color:#4D4F5C">Image de la catégorie</h3>
                                <div class="categ" id="file-etape1">
                                    <div id="imgCateg2"></div>
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
            url: './AjaxLoader/SupCateg.php',
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

    $idCateg = guid();

    function ajouter() {
        $titre = document.getElementById("nomCategAjout").value;
        if ($(".html-editor").dxHtmlEditor("instance").option("value") != '') {
            $description = $(".html-editor").dxHtmlEditor("instance").option("value");
        } else {
            $description = "";
        }

        if ($("#imgCateg").dxFileUploader("instance").option("value") != 0) {
            const myArray = $("#imgCateg").dxFileUploader("instance").option("value")[0].name.split(".");
            $extension = myArray[1];
            $image = $idCateg + "." + $extension;
        } else {
            $image = "";
        }

        $jsonCategId = JSON.stringify($idCateg);
        $jsonDescCateg = JSON.stringify($description);
        $jsonTitreCateg = JSON.stringify($titre);
        $jsonImgCateg = JSON.stringify($image);
        $.ajax({
            url: './AjaxLoader/InsertCateg.php',
            type: 'post',
            async: false,
            dataType: 'json',
            data: {
                'categId': $jsonCategId,
                'descCateg': $jsonDescCateg,
                'titreCateg': $jsonTitreCateg,
                'imgCateg': $jsonImgCateg
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
        $titre = document.getElementById("nomCategModif").value;
        if ($(".html-editor2").dxHtmlEditor("instance").option("value") != '') {
            $description = $(".html-editor2").dxHtmlEditor("instance").option("value");
        } else {
            $description = "";
        }

        if ($("#imgCateg2").dxFileUploader("instance").option("value") != 0) {
            const myArray = $("#imgCateg2").dxFileUploader("instance").option("value")[0].name.split(".");
            $extension = myArray[1];
            $image = $check[0].Id + "." + $extension;
        } else {
            $image = "";
        }

        $jsonCategId = JSON.stringify($check[0].Id);
        $jsonDescCateg = JSON.stringify($description);
        $jsonTitreCateg = JSON.stringify($titre);
        $jsonImgCateg = JSON.stringify($image);
        $.ajax({
            url: './AjaxLoader/UpdateCateg.php',
            type: 'post',
            async: false,
            dataType: 'json',
            data: {
                'categId': $jsonCategId,
                'descCateg': $jsonDescCateg,
                'titreCateg': $jsonTitreCateg,
                'imgCateg': $jsonImgCateg
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
    
    function editor() {
        document.getElementById("nomCategModif").value = $check[0].Nom;

        $(".html-editor2").dxHtmlEditor({
            value: $check[0].Description,
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
    }

    $chunkSize = 400000;
    $(function() {
        var fileUploader = $("#imgCateg").dxFileUploader({
            name: "file",
            multiple: false,
            accept: "*",
            value: [],
            uploadMode: "instantly",
            uploadUrl: "Php_Upload/UploadAjaxABCI_Upload_Basique.php",
            chunkSize: $chunkSize,
            selectButtonText: "Selectionner votre fichier",
            labelText: "ou déposer votre fichier ici",
            uploadedMessage: "Fichier envoyer",
            uploadFailedMessage: "L'envoi a échoué",
            uploadAbortedMessage: "Evoie annulé",
            onUploaded: function(e) {
                $sousdossier = "imgCateg";
                $.ajax({
                    url: 'Php_Upload/UploadAjaxABCI_Upload_Basique.php',
                    type: 'POST',
                    async: false,
                    data: {
                        'sousdossier': $sousdossier,
                        'IdCateg': $idCateg
                    }
                });
            }
        }).dxFileUploader("instance");

        var fileUploader = $("#imgCateg2").dxFileUploader({
            name: "file",
            multiple: false,
            accept: "*",
            value: [],
            uploadMode: "instantly",
            uploadUrl: "Php_Upload/UploadAjaxABCI_Upload_Basique.php",
            chunkSize: $chunkSize,
            selectButtonText: "Selectionner votre fichier",
            labelText: "ou déposer votre fichier ici",
            uploadedMessage: "Fichier envoyer",
            uploadFailedMessage: "L'envoi a échoué",
            uploadAbortedMessage: "Evoie annulé",
            onUploaded: function(e) {
                $sousdossier = "imgCateg";
                $.ajax({
                    url: 'Php_Upload/UploadAjaxABCI_Upload_Basique.php',
                    type: 'POST',
                    async: false,
                    data: {
                        'sousdossier': $sousdossier,
                        'IdCateg': $check[0].Id
                    }
                });
            }
        }).dxFileUploader("instance");
    });

    $(document).ready(function(){
        urlDocEnteteAjax = "./AjaxLoader/getCateg.php";
        $(function()
        {
            $("#listeCateg").dxDataGrid({
                dataSource : urlDocEnteteAjax,
                showBorders: true,
                searchPanel: {
                    visible: true,
                    width: 260,
                    placeholder: "Rechercher une catégorie"
                },
                selection: {
                    mode: "multiple"
                },
                rowAlternationEnabled: true,
                columns:
                [
                    {
                        caption: "Nom de la catégorie",
                        dataField: "Nom",
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
                        $("#text").text("Supprimer définitivement cette catégorie ?");
                        document.getElementById("modifier").removeAttribute("disabled");

                        $("#select").text("Vous avez actuellement sélectionné " + $check.length + " catégorie.");
                    }

                    if($check.length > 1) {
                        document.getElementById("togg1").removeAttribute("disabled");
                        $("#text").text("Supprimer définitivement ces catégories ?");
                        document.getElementById("modifier").setAttribute("disabled", "disabled");

                        $("#select").text("Vous avez actuellement sélectionné " + $check.length + " catégories.");
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
        $w = $('#listeCateg').height();
        var newHeight = $(window).height() - $('#content').position().top - $('#listeCateg').height() - 227 - $('#togg1').height();
        $('#listeCateg').height(newHeight);

        if($(window).height() <= 620) {
            $('#listeCateg').height(245);
        }
        
    }

    $(window).on('resize', function() {
        var newHeight = $(window).height() - $('#content').position().top - $w - 227 - $('#togg1').height();
        $('#listeCateg').height(newHeight);

        if($(window).height() <= 620) {
            $('#listeCateg').height(245);
        }
    });

    function deplace(){
    $(".dx-datagrid-search-panel").insertBefore("#buttons");
}
</script>