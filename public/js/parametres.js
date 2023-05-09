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
        rowAlternationEnabled: false,
        allowColumnResizing: true,
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
                    $("<div>").append($(`<i class="fas fa-check-circle vertEcoclic"></i>`)).appendTo(container);
                } else {
                    var str2 = JSON.stringify(options.data).replaceAll("\"", "\\\"").replaceAll("'", "@|%");
                    $("<div>").append($("<i class='fas fa-redo-alt vertEcoclic' style='cursor:pointer;' title='Renvoyer le mail' onclick='renvoiMail(\`" + str2 + "\`)'></i>")).appendTo(container);
                }
            },
            width: 80
        }, {
            caption: "Actif / non actif",
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
            width: 150
        }, {
            cellTemplate: function(container, options) {
                var str = JSON.stringify(options.data).replaceAll("\"", "\\\"").replaceAll("'", "@|%");
                $("<div>")
                    .append($("<i style='cursor:pointer;' onclick='openModal(\`" + str + "\`)' class='fas fa-pen vertEcoclic'></i>"))
                    .appendTo(container);
            },
            width: 40,
            allowHiding: false,
            cssClass: "align-middle"
        }, {
            cellTemplate: function(container, options) {
                var str = JSON.stringify(options.data).replaceAll("\"", "\\\"").replaceAll("'", "@|%");
                $("<div>")
                    .append($("<i style='cursor:pointer;' onclick='deleteUser(\`" + str + "\`)' class='fas fa-trash vertEcoclic'></i>"))
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
            }, {
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
                colCount: 2,
                itemType: "group", 
                items: [{
                    dataField: "Administrateur",
                    label: {
                        text: "Droit d\'ajout des utilisateurs "
                    },
                    template: function(data, $itemElement) {
                        $(`<div class="custom-control custom-switch" style="padding: 0 !important;">
                                <input type="checkbox" checked name="Administrateur" id="customSwitchAdmin">
                            </div>`).appendTo($itemElement);
                    }
                },
                {
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
                }]
            },
            {
                template: function(data, $itemElement) {
                    $(`<span class="chapms-obligatoires"><span class="dx-field-item-required-mark">*</span> Champs Obligatoires</span>`).appendTo($itemElement);
                }
            }
        ],
        }, {
            colCount: 2,
            itemType: "group",
            items: [{
                itemType: "button",
                cssClass: "buttonForm",
                horizontalAlignment: "center",
                buttonOptions: {
                    accessKey: "return",
                    text: "Annuler",
                }
            }, {
                itemType: "button",
                cssClass: "buttonForm",
                horizontalAlignment: "center",
                buttonOptions: {
                    text: "Enregistrer",
                    accessKey: "submit",
                    type: "default",
                    useSubmitBehavior: true
                }
            }]
        }],
        minColWidth: 300,
    }).dxForm("instance");

    $("[accesskey=return]").on("click", function() {
        $('#modaleAddUser').modal('hide');
    })

    $("[accesskey=return]").addClass("buttonForm");
    $("[accesskey=return]").css("border-radius", "50px !important;");

    $("[accesskey=submit]").css("border-radius", "50px !important;");
    $("[accesskey=submit]").addClass("buttonForm");
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
        formData: { Id: data.Id, Nom: data.Nom, Prenom: data.Prenom, Identifiant: data.Identifiant, Mail: data.Mail, Admin: data.Admin, Actif: data.Actif},
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        labelMode: 'floating',
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
                dataField: "Admin",
                
                label: {
                    text: 'Droit d\'ajout des utilisateurs',
                },
                template: function(data, $itemElement) {
                    if (check2 != "self") {
                        $(`<div class="custom-control custom-switch" style="padding: 0 !important;">
                        <input type="checkbox" ${check2} name="Admin" id="customSwitchAdmin2">
                        </div>`).appendTo($itemElement);
                    } else {
                        $(`<div class="custom-control custom-switch" style="padding: 0 !important;">
                        <input type="checkbox" checked name="Admin" disabled id="customSwitchAdmin2">
                        </div>`).appendTo($itemElement);
                    }
                }
            }, 
            // {
            //     dataField: "Actif",
            //     label: {
            //         text: "Actif "
            //     },
            //     template: function(data, $itemElement) {
            //         if (check != "self") {
            //             $(`<div class="custom-control custom-switch">
            //             <input type="checkbox" ${check} name="Actif" class="custom-control-input" id="customSwitchActif2">
            //             <label class="custom-control-label" for="customSwitchActif2"></label>
            //             </div>`).appendTo($itemElement);
            //         } else {
            //             $(`<div class="custom-control custom-switch">
            //             <input type="checkbox" checked name="Actif" class="custom-control-input" disabled id="customSwitchActif2">
            //             <label class="custom-control-label" for="customSwitchActif2"></label>
            //             </div>`).appendTo($itemElement);
            //         }
            //     }
            // },
            {
                template: function(data, $itemElement) {
                    $(`<span class="chapms-obligatoires"><span class="dx-field-item-required-mark">*</span> Champs Obligatoires</span>`).appendTo($itemElement);
                }
            }],
        }, {
            colCount: 2,
            itemType: "group",
            items: [{
                itemType: "button",
                cssClass: "buttonForm",
                horizontalAlignment: "center",
                buttonOptions: {
                    accessKey: "return",
                    text: "Annuler",
                }
            }, {
                itemType: "button",
                cssClass: "buttonForm",
                horizontalAlignment: "center",
                buttonOptions: {
                    text: "Enregistrer",
                    accessKey: "submit",
                    type: "default",
                    useSubmitBehavior: true
                }
            }]
        }],
        minColWidth: 300,

    }).dxForm("instance");

    $("[accesskey=return]").on("click", function() {
        $('#modaleModifUser').modal('hide');
    })
    $("[accesskey=return]").css('background-color', '#F0F0F0');
    $("[accesskey=return]").css("color", "#08453F");
    $("[accesskey=return]").addClass("buttonForm");
    $("[accesskey=return]").css("border-radius", "50px !important;");

    $("[accesskey=submit]").css("border-radius", "50px !important;");
    $("[accesskey=submit]").addClass("buttonForm");

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
        success: function(data) {
            $("#gridContainer").dxDataGrid("instance").refresh();
            DevExpress.ui.notify("Le mail d'inscription a été renvoyé");
        },
        error: function(jqXhr, textStatus, errorThrown) {
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

function deleteUser(data) {
    data = JSON.parse(data.replaceAll('@|%', "'"));
    const popup = $("#confirm").dxPopup({
        title: 'SUPPRESSION D\'UN UTILISATEUR',
        contentTemplate: `<p style="text-align:center;">Êtes vous sûr de vouloir supprimer cet utilisateur ?</p>`,
        width: 500,
        height: 250,
        showTitle: true,
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
                text: "Oui",
                type: "default",
                onClick: function(e) {
                    $.ajax({
                        url: './AjaxLoader/deleteUser.php',
                        type: 'post',
                        async: true,
                        dataType: 'html',
                        data: {
                            userId: data.Id
                        },
                        success: function(response) {
                            if (response == 1) {
                                DevExpress.ui.notify(`${data.Prenom} ${data.Nom} à été supprimé`, "success", 2000);
                            } else {
                                DevExpress.ui.notify(`Une erreur est survenue`, "error", 2000);
                            }
                            $("#gridContainer").dxDataGrid('refresh')
                        },
                        error: function(jqXhr, textStatus, errorThrown) {
                            alert('Une erreur est survenue');
                        }
                    })
                    popup.hide();
                }
            }
        }]
    }).dxPopup("instance");
    popup.show();
}