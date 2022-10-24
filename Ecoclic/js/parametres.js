$(function() {
    $("#AddUser").on("click", function() {
        $('#modaleAddUser').modal('show');
    })

    var makeAsyncDataSource = function() {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "Id",
            load: function() {
                return $.getJSON(`./AjaxLoader/GetUtilisateursCollectivite.php`);
            }
        });
    }

    $("#gridContainer").dxDataGrid({
        dataSource: makeAsyncDataSource(),
        keyExpr: "Id",
        columnHidingEnabled: true,
        showBorders: true,
        rowAlternationEnabled: true,
        paging: {
            enabled: false
        },
        loadPanel: {
            text: "Chargement"
        },
        scrolling: {
            columnRenderingMode: "virtual"
        },
        columns: [{
            caption: "Prénom",
            dataField: "Prenom",
            width: 150
        }, {
            caption: "Nom",
            dataField: "Nom",
            width: 150
        }, {
            caption: "Identifiant",
            dataField: "Identifiant",
            width: 200
        }, {
            caption: "Mail",
            dataField: "Mail",
            // width: 300
        }, {
            caption: "isVerifié",
            dataField: "MotDePasse",
            cellTemplate: function(container, options) {
                $("#dx-col-5>.dx-datagrid-text-content.dx-text-content-alignment-right").html('<i class="fas fa-envelope"></i>')
                if (options.value == 1) {
                    $("<div>").append($(`<i class="fas fa-check-circle vertNumeriscore"></i>`)).appendTo(container);
                } else {
                    var str2 = JSON.stringify(options.data).replaceAll("\"", "\\\"").replaceAll("'", "@|%");
                    $("<div>").append($("<i class='fas fa-redo-alt vertNumeriscore' style='cursor:pointer;' title='Renvoyer le mail' onclick='renvoiMail(\`" + str2 + "\`)'></i>")).appendTo(container);
                }
            },
            width: 80
        }, {
            caption: "Actif",
            dataField: "Actif",
            cellTemplate: function(container, options) {
                if (options.data.Actif != "self") {
                    $("<div>")
                        .append($(`<div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch_${options.data.Id}" onchange='updateActif("${options.data.Id}")'>
                    <label class="custom-control-label" for="customSwitch_${options.data.Id}" style='cursor:pointer;'></label>
                    </div>`))
                        .appendTo(container);
                    if (options.data.Actif == 1) {
                        $(`#customSwitch_${options.data.Id}`).attr("checked", true);
                    }
                } else {
                    $("<div>")
                        .append($(`<div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch_${options.data.Id}" disabled>
                        <label class="custom-control-label" for="customSwitch_${options.data.Id}" style='cursor:pointer;'></label>
                        </div>`))
                        .appendTo(container);
                    $(`#customSwitch_${options.data.Id}`).attr("checked", true);
                }
            },
            width: 80
        }, {
            cellTemplate: function(container, options) {
                var str = JSON.stringify(options.data).replaceAll("\"", "\\\"").replaceAll("'", "@|%");
                $("<div>")
                    .append($("<i style='cursor:pointer;' onclick='openModal(\`" + str + "\`)' class='fas fa-pen vertNumeriscore'></i>"))
                    .appendTo(container);
            },
            width: 40,
            allowHiding: false,
            cssClass: "align-middle"
        }],
    });

    formAddUser = $("#form-modaleAddUser").dxForm({
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            dataField: "Id",
            cssClass: "d-none"
        }, {
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
                dataField: "Prenom",
                label: {
                    text: "Prénom "
                },
                validationRules: [{
                    type: "required",
                    message: "Prénom ne peut pas être vide."
                }]
            }, {
                dataField: "Identifiant",
                label: {
                    text: "Identifiant "
                },
                editorType: "dxTextBox",
                editorOptions: {
                    valueChangeEvent: "keyup",
                },
                validationRules: [{
                    type: "required",
                    message: "Identifiant ne peut pas être vide."
                }, {
                    type: "custom",
                    message: "L'identifiant est déjà utilisé",
                    validationCallback: function(params) {
                        return sendRequest(params.value);
                    }
                }]
            }, {
                dataField: "Mail",
                label: {
                    text: "Mail "
                },
                validationRules: [{
                    type: "email",
                    message: "Mail invalide."
                }, {
                    type: "required",
                    message: "Mail ne peut pas être vide."
                }]
            },{
                dataField: "Mot_de_passe",
                label: {
                    text: "Mot de passe"
                },
                editorType: "dxTextBox",
                editorOptions: {
                    valueChangeEvent: "keyup",
                },
                validationRules: [{
                    type: "required",
                    message: "Le mot de passe ne peut pas être vide."
                }]
            },{
                dataField: "Actif",
                label: {
                    text: "Actif "
                },
                template: function(data, $itemElement) {
                    $(`<div class="custom-control custom-switch">
                            <input type="checkbox" checked name="Actif" class="custom-control-input" id="customSwitchActif">
                            <label class="custom-control-label" for="customSwitchActif"></label>
                        </div>`).appendTo($itemElement);
                }
            }, {
                dataField: "Administrateur",
                label: {
                    text: "Administrateur "
                },
                template: function(data, $itemElement) {
                    $(`<div class="custom-control custom-switch">
                            <input type="checkbox" checked name="Administrateur" class="custom-control-input" id="customSwitchAdmin">
                            <label class="custom-control-label" for="customSwitchAdmin"></label>
                        </div>`).appendTo($itemElement);
                }
            }],
        }, {
            itemType: "button",
            cssClass: "mt-4",
            horizontalAlignment: "center",
            buttonOptions: {
                text: "Valider",
                type: "default",
                useSubmitBehavior: true
            }
        }],
        minColWidth: 300,
    }).dxForm("instance");
})

function openModal(data) {
    data = JSON.parse(data.replaceAll('@|%', "'"));
    $('#modaleModifUser').modal('show');

    switch (data.Actif) {
        case 1:
            var check = "checked";
            break;
        case "self":
            var check = "self";
            break;
        default:
            var check = "";
            break;
    }

    switch (data.Admin) {
        case 1:
            var check2 = "checked";
            break;
        case "self":
            var check2 = "self";
            break;
        default:
            var check2 = "";
            break;
    }

    var formModaleModifUser = $("#form-modaleModifUser").dxForm({
        formData: { Id: data.Id, Nom: data.Nom, Prenom: data.Prenom, Identifiant: data.Identifiant, Mail: data.Mail, Actif: data.Actif, Admin: data.Admin },
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            dataField: "Id",
            cssClass: "d-none"
        }, {
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
                dataField: "Prenom",
                label: {
                    text: "Prénom "
                },
                validationRules: [{
                    type: "required",
                    message: "Prénom ne peut pas être vide."
                }]
            }, {
                dataField: "Identifiant",
                label: {
                    text: "Identifiant "
                },
                validationRules: [{
                    type: "required",
                    message: "Identifiant ne peut pas être vide."
                }]
            }, {
                dataField: "Mail",
                label: {
                    text: "Mail "
                },
                validationRules: [{
                    type: "email",
                    message: "Mail invalide."
                }, {
                    type: "required",
                    message: "Mail ne peut pas être vide."
                }]
            }, {
                dataField: "Actif",
                label: {
                    text: "Actif "
                },
                template: function(data, $itemElement) {
                    if (check != "self") {
                        $(`<div class="custom-control custom-switch">
                        <input type="checkbox" ${check} name="Actif" class="custom-control-input" id="customSwitchActif2">
                        <label class="custom-control-label" for="customSwitchActif2"></label>
                        </div>`).appendTo($itemElement);
                    } else {
                        $(`<div class="custom-control custom-switch">
                        <input type="checkbox" checked name="Actif" class="custom-control-input" disabled id="customSwitchActif2">
                        <label class="custom-control-label" for="customSwitchActif2"></label>
                        </div>`).appendTo($itemElement);
                    }
                }
            }, {
                dataField: "Admin",
                label: {
                    text: "Administrateur "
                },
                template: function(data, $itemElement) {
                    if (check2 != "self") {
                        $(`<div class="custom-control custom-switch">
                        <input type="checkbox" ${check2} name="Admin" class="custom-control-input" id="customSwitchAdmin2">
                        <label class="custom-control-label" for="customSwitchAdmin2"></label>
                        </div>`).appendTo($itemElement);
                    } else {
                        $(`<div class="custom-control custom-switch">
                        <input type="checkbox" checked name="Admin" disabled class="custom-control-input" id="customSwitchAdmin2">
                        <label class="custom-control-label" for="customSwitchAdmin2"></label>
                        </div>`).appendTo($itemElement);
                    }
                }
            }],
        }, {
            itemType: "button",
            cssClass: "mt-4",
            horizontalAlignment: "center",
            buttonOptions: {
                text: "Valider",
                type: "default",
                useSubmitBehavior: true
            }
        }],
        minColWidth: 300,

    }).dxForm("instance");

    $("#s69420").submit(function(e) {
        $("[disabled]").prop("disabled", false)

    })
}

function renvoiMail(data) {
    //Id, Nom, Prenom, Identifiant, Mail
    data = JSON.parse(data.replaceAll('@|%', "'"));
    $.ajax({
        url: './AjaxLoader/ResendMailInscriptionUtilisateur.php',
        type: 'post',
        async: true,
        dataType: 'html',
        data: {
            'Id': data.Id,
            'Mail': data.Mail
        },
        success: function (data) {
            $("#gridContainer").dxDataGrid("instance").refresh();
            DevExpress.ui.notify("Le mail d'inscription a été renvoyé");
        },
        error: function (jqXhr, textStatus, errorThrown) {
            alert('Une erreur est survenue');
        }
    });
}


function updateActif(utilisateurId) {
    $.ajax({
        url: './AjaxLoader/UpdateActif.php',
        type: 'post',
        async: true,
        dataType: 'html',
        data: {
            'utilisateurId': utilisateurId,
        },
        success: function(data) {
            $("#gridContainer").dxDataGrid("instance").refresh()
        },
        error: function(jqXhr, textStatus, errorThrown) {
            alert('Une erreur est survenue');
        }
    });
}

var sendRequest = function(value) {
    var valid;
    $.ajax({
        url: './AjaxLoader/checkIdentifiant.php',
        type: 'get',
        async: false,
        dataType: 'html',
        data: {
            'Identifiant': value,
        },
        success: function(data) {
            valid = 1;
            if (value == data) {
                valid = -1;
            }
        },
        error: function(jqXhr, textStatus, errorThrown) {
            alert('Une erreur est survenue');
        }
    });
    if (valid == -1) {
        $("[accesskey=SubmitNewUser]").addClass("dx-state-disabled");
        return false
    }
    $("[accesskey=SubmitNewUser]").removeClass("dx-state-disabled")
    return true;
}