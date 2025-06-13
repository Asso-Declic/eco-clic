var modifiable = false;
$(function() {

    $.ajax({
        url: '../AjaxLoader/checkModifiable.php',
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(response) {
            (response == 1) ? modifiable = true: modifiable = false;
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    })

    if (modifiable) {
        $("#add").before('<button id="validerVersion" onclick="validerVersion()" class="bouton-numeriscore px-5 mx-3 py-3 rounded text-white">Valider la version</button>')
    }

    $('#download').on("click", function() {
        location.href = "../AjaxLoader/exportVersion.php";
    })

    $("#import").dxFileUploader({
        multiple: false,
        accept: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        name: 'File',
        dialogTrigger: "#import-button",
        visible: false,
        uploadMode: "instantly",
        uploadUrl: "../AjaxLoader/importFileVersion.php",
        invalidFileExtensionMessage: "Le type de fichier est invalide",
        labelText: "",
        selectButtonText: "Sélectionner un fichier",
        onValueChanged: function(e) {
            var files = e.value;
            if (files.length > 0) {
                $.each(files, function(i, file) {
                    //   name = file.name.replace(".svg", "")
                });
            }
            $("#blocker").html("<div class='loading'></div>")
            $("#blocker").addClass("modal-backdrop")
        },
        onFilesUploaded: function(e) {
            $.ajax({
                url: '../AjaxLoader/importVersion.php',
                type: 'get',
                async: false,
                dataType: 'html',
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    } else {
                        console.error('Une erreur est survenue');
                    }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    console.error('Une erreur est survenue');
                }
            })
        }
    });

    Version_Code = null;

    var versions = [];

    $.ajax({
        url: '../AjaxLoader/GetVersions.php',
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(response) {
            versions = response
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    })

    $.ajax({
        url: '../AjaxLoader/checkCurrentVersion.php',
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(response) {
            if (response == "-1") {
                Version_Code = versions[0].Version_Code;
            } else {
                Version_Code = response;
            }
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    })

    var selectBox = $("#selectBox").dxSelectBox({
        dataSource: new DevExpress.data.ArrayStore({
            data: versions,
            key: "Version_Code"
        }),
        displayExpr: "Label",
        valueExpr: "Version_Code",
        value: Version_Code,
        onInitialized: function(e) {

        },
        onValueChanged: function(e) {
            $("#version-ariane").text(" Version " + e.value)
            Version_Code = e.value
            datagrid.refresh().done(function() {
                $.ajax({
                    url: '../AjaxLoader/checkModifiable.php',
                    type: 'get',
                    async: false,
                    dataType: 'json',
                    success: function(response) {
                        (response == 1) ? modifiable = true: modifiable = false;
                    },
                    error: function(jqXhr, textStatus, errorThrown) {
                        console.error('Une erreur est survenue');
                    }
                })
                if (modifiable) {
                    $("#add").before('<button id="validerVersion" onclick="validerVersion()" class="bouton-numeriscore px-5 mx-3 py-3 rounded text-white">Valider la version</button>')
                } else {
                    $("#validerVersion").remove()
                }
                (!modifiable) ? $("#add").prop("disabled", true): $("#add").prop("disabled", false);
                datagrid.repaint()
            })
        },
        placeholder: "Choix de version",
    }).dxSelectBox("instance");

    var makeAsyncDataSource = function() {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "Id",
            load: function() {
                var testation
                $.ajax({
                    url: '../AjaxLoader/GetThemes.php?Version=' + Version_Code,
                    type: 'get',
                    async: false,
                    dataType: 'json',
                    success: function(response) {
                        testation = response;
                    },
                    error: function(jqXhr, textStatus, errorThrown) {
                        console.error('Une erreur est survenue');
                    }
                })
                return testation;
            },
        });
    }

    var datagrid = $("#gridContainer").dxDataGrid({
        dataSource: makeAsyncDataSource(),
        keyExpr: "Id",
        columnHidingEnabled: true,
        showBorders: true,
        rowAlternationEnabled: true,
        loadPanel: {
            text: "Chargement"
        },
        columns: [{
            caption: "Nom",
            dataField: "Nom",
            cssClass: "align-middle"

        }, {
            caption: "Icone",
            dataField: "Icone",
            cellTemplate: function(container, options) {
                $(container).html('<img src="../img/icons/iconesNoir/' + options.value + '.svg" alt="">')
            },
            cssClass: "align-middle"

        }, {
            caption: "Couleur",
            dataField: "Couleur",
            cellTemplate: function(container, options) {
                $(container).dxColorBox({
                    value: "#" + options.value,
                    readOnly: true
                });
            }
        }, {
            cellTemplate: function(container, options) {
                if (modifiable) {
                    $("<div>")
                        .append($(`<a href='./categories.php?id=${options.data.Id}' class='fas fa-pen vertNumeriscore'></a>`))
                        .appendTo(container);
                } else {
                    $("<div>")
                        .append($(`<a href='./categories.php?id=${options.data.Id}' class='fas fa-eye vertNumeriscore'></a>`))
                        .appendTo(container);
                }
            },
            width: 40,
            cssClass: "align-middle"
        }, {
            cellTemplate: function(container, options) {
                if (modifiable === true) {
                    var str = JSON.stringify(options.data).replaceAll("\"", "\\\"").replaceAll("'", "@|%");
                    $("<div>")
                        .append($("<a href='#' onclick='modaleDelete(\"" + str + "\")' class='fas fa-trash-alt vertNumeriscore'></a>"))
                        .appendTo(container);
                }
            },
            width: 40,
            cssClass: "align-middle"
        }]
    }).dxDataGrid("instance");

    (!modifiable) ? $("#add").prop("disabled", true): $("#add").prop("disabled", false);

    $("#add").on("click", function() {
        $('#modale').modal('show')
    })

    var form = $("#form-modale").dxForm({
        formData: { Id: "", Nom: "", Icone: "", Couleur: "" },
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
                colCount: 2,
                itemType: "group",
                items: [{
                    dataField: "Nom",
                    label: {
                        text: "Nom "
                    },
                    validationRules: [{
                        type: "required",
                        message: "Nom ne peut pas être vide."
                    }]
                }, {
                    dataField: "Couleur",
                    label: {
                        text: "Couleur "
                    },
                    editorType: "dxColorBox",
                    validationRules: [{
                        type: "required",
                        message: "Couleur ne peut pas être vide."
                    }]
                }]
            },
            {
                colCount: 1,
                itemType: "group",
                items: [{
                    template: function(data, itemElement) {
                        itemElement.append($("<div>").attr("id", "dfilefu1").dxFileUploader({
                            multiple: false,
                            accept: "image/svg+xml",
                            name: 'Icone',
                            uploadMode: "instantly",
                            uploadUrl: "../AjaxLoader/uploadTempFile.php",
                            invalidFileExtensionMessage: "Le type de fichier est invalide",
                            labelText: "",
                            selectButtonText: "Sélectionner un fichier",
                            onValueChanged: function(e) {
                                var files = e.value;
                                var name;
                                if (files.length > 0) {
                                    $.each(files, function(i, file) {
                                        name = file.name.replace(".svg", "")
                                    });
                                }
                            }
                        }));
                    },
                    name: "Icone",
                    label: {
                        text: "Icône "
                    },
                    validationRules: [{
                        type: "required",
                        message: "Icône ne peut pas être vide."
                    }, {
                        type: "custom",
                        message: "Type de fichier invalide.",
                        validationCallback: function(e) {
                            if (e.value[0].type === "image/svg+xml") {
                                return true
                            }
                            return false
                        }
                    }]
                }]
            }, {
                itemType: "button",
                cssClass: "mt-4",
                horizontalAlignment: "center",
                buttonOptions: {
                    text: "Valider",
                    type: "default",
                    useSubmitBehavior: true
                }
            }
        ],
        minColWidth: 300,

    }).dxForm("instance");

});

function modaleDelete(data) {
    data = JSON.parse(data.replaceAll('@|%', "'"));
    const popup = $("#confirm").dxPopup({
        contentTemplate: `<p>Voulez vraiment supprimer <b>${data.Nom}</b> ainsi que tout les éléments qui y sont liés ?</p>`,
        width: 300,
        height: 170,
        showTitle: false,
        visible: false,
        dragEnabled: false,
        shading: false,
        closeOnOutsideClick: true,
        showCloseButton: false,
        toolbarItems: [{
            widget: "dxButton",
            toolbar: "bottom",
            location: "before",
            options: {
                text: "Annuler",
                onClick: function(e) {
                    popup.hide();
                },
            }
        }, {
            widget: "dxButton",
            toolbar: "bottom",
            location: "after",
            options: {
                text: "Valider",
                type: "default",
                onClick: function(e) {
                    $.ajax({
                        url: '../AjaxLoader/suppressionAdmin.php',
                        type: 'get',
                        async: true,
                        dataType: 'html',
                        data: {
                            ThemeId: data.Id,
                            type: "Theme"
                        },
                        success: function(response) {
                            if (response == 1) {
                                DevExpress.ui.notify(`${data.Nom} à été supprimé`, "success", 2000);
                            } else {
                                DevExpress.ui.notify(`Une erreur est survenue`, "error", 2000);
                            }
                            $("#gridContainer").dxDataGrid('refresh')
                        },
                        error: function(jqXhr, textStatus, errorThrown) {
                            console.error('Une erreur est survenue');
                        }
                    })
                    popup.hide();
                }
            }
        }]
    }).dxPopup("instance");
    popup.show();
}

function validerVersion() {
    $("#blocker").html("<div class='loading'></div>")
    $("#blocker").addClass("modal-backdrop")
    $.ajax({
        url: '../AjaxLoader/validerVersion.php',
        type: 'get',
        async: true,
        dataType: 'json',
        success: function(response) {
            location.reload()
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    })
}