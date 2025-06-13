resizeGrid();

$(window).on('resize', function() {
    resizeGrid();
})

function resizeGrid() {
    $gridHeight = $(window).height() - document.querySelector("#content > nav").clientHeight - document.querySelector("#header").clientHeight;
    $("#gridContainer").css("max-height", $gridHeight + "px");
}

$(function() {
    $("#AddUser").on("click", function() {
        $('#modaleAddUser').modal('show');
    })

    var makeAsyncDataSource = function() {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "id",
            load: function() {
                return $.getJSON(`/api/users/by-collectivite`);
            }
        });
    }

    $("#gridContainer").dxDataGrid({
        dataSource: makeAsyncDataSource(),
        keyExpr: "id",
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
            dataField: "firstName",
            width: 150
        }, {
            caption: "Nom",
            dataField: "lastName",
            width: 150,
            cssClass: "maj"
        }, {
            caption: "Identifiant",
            dataField: "username",
            width: 200
        }, {
            caption: "Mail",
            dataField: "email",
            // width: 300
        }, {
            caption: "isVerifié",
            dataField: "verified",
            cellTemplate: function(container, options) {
                $("#dx-col-5>.dx-datagrid-text-content.dx-text-content-alignment-right").html('<i class="fas fa-envelope"></i>')
                if (options.value === true) {
                    $("<div>").append($(`<i class="fas fa-check-circle vertEcoclic"></i>`)).appendTo(container);
                } else {
                    var str2 = JSON.stringify(options.data).replaceAll("\"", "\\\"").replaceAll("'", "@|%");
                    $("<div>").append($("<i class='fas fa-redo-alt vertEcoclic' style='cursor:pointer;' title='Renvoyer le mail' onclick='renvoiMail(\`" + str2 + "\`)'></i>")).appendTo(container);
                }
            },
            width: 80
        }, {
            caption: "Actif / non actif",
            dataField: "active",
            cellTemplate: function(container, options) {
                if (options.data.active != "self") {
                    $("<div>")
                        .append($(`<div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch_${options.data.id}" onchange='updateActive("${options.data.id}")'>
                    <label class="custom-control-label" for="customSwitch_${options.data.id}" style='cursor:pointer;'></label>
                    </div>`))
                        .appendTo(container);
                    if (options.data.active == 1) {
                        $(`#customSwitch_${options.data.id}`).attr("checked", true);
                    }
                } else {
                    $("<div>")
                        .append($(`<div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch_${options.data.id}" disabled>
                        <label class="custom-control-label" for="customSwitch_${options.data.id}" style='cursor:pointer;'></label>
                        </div>`))
                        .appendTo(container);
                    $(`#customSwitch_${options.data.id}`).attr("checked", true);
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
            colCount: 2,
            itemType: "group",
            items: [{
                dataField: "user[lastName]",
                label: {
                    text: "Nom "
                },
                validationRules: [{
                    type: "required",
                    message: "Nom ne peut pas être vide."
                }]
            }, {
                dataField: "user[firstName]",
                label: {
                    text: "Prénom "
                },
                validationRules: [{
                    type: "required",
                    message: "Prénom ne peut pas être vide."
                }]
            }, {
                dataField: "user[username]",
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
                },
                {
                    type: "custom",
                    message: "L'identifiant est déjà utilisé",
                    validationCallback: function(params) {
                        console.log(params.value);
                        return sendRequest(params.value);
                    }
                }]
            }, {
                dataField: "user[email]",
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
            }, 
            // {
            //     dataField: "password",
            //     label: {
            //         text: "Mot de passe"
            //     },
            //     editorType: "dxTextBox",
            //     editorOptions: {
            //         valueChangeEvent: "keyup",
            //     },
            //     validationRules: [{
            //         type: "required",
            //         message: "Le mot de passe ne peut pas être vide."
            //     }]
            // },
            {
                colCount: 2,
                itemType: "group", 
                items: [{
                    dataField: "admin",
                    label: {
                        text: "Droit d\'ajout des utilisateurs "
                    },
                    template: function(data, $itemElement) {
                        $(`<div class="custom-control custom-switch" style="padding: 0 !important;">
                                <input type="checkbox" checked name="admin" id="customSwitchAdmin">
                            </div>`).appendTo($itemElement);
                    }
                },
                {
                    dataField: "user[active]",
                    label: {
                        text: "Actif "
                    },
                    template: function(data, $itemElement) {
                        $(`<div class="custom-control custom-switch">
                                <input type="checkbox" checked name="user[active]" class="custom-control-input" id="customSwitchActif">
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

    switch (data.active) {
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

    switch (data.adminCollectivite) {
        case true:
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
        formData: { id: data.id, lastName: data.lastName, firstName: data.firstName, username: data.username, email: data.email, adminCollectivite: data.adminCollectivite, active: data.active},
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        labelMode: 'floating',
        items: [{
            dataField: "id",
            cssClass: "d-none"
            },
            {
            colCount: 2,
            itemType: "group",
            items: [{
                dataField: "lastName",
                label: {
                    text: "Nom "
                },
                validationRules: [{
                    type: "required",
                    message: "Nom ne peut pas être vide."
                }]
            }, {
                dataField: "firstName",
                label: {
                    text: "Prénom "
                },
                validationRules: [{
                    type: "required",
                    message: "Prénom ne peut pas être vide."
                }]
            }, {
                dataField: "username",
                label: {
                    text: "Identifiant "
                },
                validationRules: [{
                    type: "required",
                    message: "Identifiant ne peut pas être vide."
                }]
            }, {
                dataField: "email",
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
                dataField: "adminCollectivite",
                label: {
                    text: 'Droit d\'ajout des utilisateurs',
                },
                template: function(data, $itemElement) {
                    if (check2 != "self") {
                        $(`<div class="custom-control custom-switch" style="padding: 0 !important;">
                        <input type="checkbox" ${check2} name="adminCollectivite" id="customSwitchAdmin2">
                        </div>`).appendTo($itemElement);
                    } else {
                        $(`<div class="custom-control custom-switch" style="padding: 0 !important;">
                        <input type="checkbox" checked name="adminCollectivite" disabled id="customSwitchAdmin2">
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
    data = JSON.parse(data.replaceAll('@|%', "'"));
    $.ajax({
        url: '/api/users/resend-email/' + data.id,
        type: 'post',
        async: true,
        dataType: 'json',
        success: function(data) {
            $("#gridContainer").dxDataGrid("instance").refresh();
            DevExpress.ui.notify("Le mail d'inscription a été renvoyé");
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
}


function updateActive(utilisateurId) {
    $.ajax({
        url: '/api/users/update-active/' + utilisateurId,
        type: 'patch',
        async: true,
        dataType: 'json',
        success: function(data) {
            $("#gridContainer").dxDataGrid("instance").refresh();
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
}

var sendRequest = function(value) {
    var valid;
    $identifiant = value.replaceAll('ç', 'c');
    $.ajax({
        url: '/api/users/check-username/' + value,
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(data) {
            valid = value == data ? false : true;
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
    console.log(valid);
    if (valid) {
        $("[accesskey=SubmitNewUser]").removeClass("dx-state-disabled")
    } else {
        $("[accesskey=SubmitNewUser]").addClass("dx-state-disabled");
    }
    return valid;
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
                        url: '/api/users/delete/' + data.id,
                        type: 'delete',
                        async: true,
                        dataType: 'json',
                        success: function(response, status, xhr) {
                            if (xhr.status == 201) {
                                DevExpress.ui.notify(`${data.firstName} ${data.lastName} à été supprimé`, "success", 2000);
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