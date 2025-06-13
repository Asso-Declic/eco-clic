$(function() {

    var makeAsyncDataSource = function() {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "Id",
            load: function() {
                return $.getJSON(`../AjaxLoader/GetUtilisateursSA.php`);
            }
        });
    }

    $("#gridContainer").dxDataGrid({
        dataSource: makeAsyncDataSource(),
        keyExpr: "Id",
        columnHidingEnabled: true,
        showBorders: true,
        rowAlternationEnabled: false,
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
                $("<div>")
                    .append($(`<i style='cursor:pointer;' onclick='openModal("${options.data.Id}", "${options.data.Nom}", "${options.data.Prenom}", "${options.data.Identifiant}", "${options.data.Mail}", "${options.data.Actif}")' class='fas fa-pen vertNumeriscore'></i>`))
                    .appendTo(container);
            },
            width: 40,
            allowHiding: false,
            cssClass: "align-middle"

        }],
    });

    $("#add").click(function() {
        $('#ModaleAjoutUtilisateurs').modal('show');
        var part1 = "";
        var part2 = "";
        var identifiant;
        var formModale = $("#form-modale-ajout").dxForm({
            formData: { Id: "", Nom: "", Prenom: "", Identifiant: "", Mail: "", Actif: "1" },
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
                    editorType: "dxTextBox",
                    editorOptions: {
                        valueChangeEvent: "keyup",
                        // onValueChanged: function(data) {
                        //     part1 = data.value;
                        //     identifiant = `${part2}.${part1}`;
                        //     $("[name=Identifiant]").val(identifiant.replace(/\s/g, "").toLowerCase())
                        // }
                    },
                    validationRules: [{
                        type: "required",
                        message: "Nom est requis"
                    }]
                }, {
                    dataField: "Prenom",
                    label: {
                        text: "Prénom "
                    },
                    editorType: "dxTextBox",
                    editorOptions: {
                        valueChangeEvent: "keyup",
                        // onValueChanged: function(data) {
                        //     part2 = data.value;
                        //     identifiant = `${part2}.${part1}`
                        //     $("[name=Identifiant]").val(identifiant.replace(/\s/g, "").toLowerCase())
                        // }
                    },
                    validationRules: [{
                        type: "required",
                        message: "Prénom est requis"
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
                        message: "Identifiant est requis"
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
                        message: "Email invalide"
                    }, {
                        type: "required",
                        message: "Email est requis"
                    }]
                }, {
                    dataField: "Actif",
                    label: {
                        text: "Actif "
                    },
                    template: function(data, $itemElement) {
                        $(`<div class="custom-control custom-switch">
                        <input type="checkbox" checked name="Actif" class="custom-control-input" id="customSwitch_modal">
                        <label class="custom-control-label" for="customSwitch_modal"></label>
                        </div>`).appendTo($itemElement);
                    }
                }],
            }, {
                itemType: "button",
                cssClass: "mt-4",
                horizontalAlignment: "center",
                buttonOptions: {
                    accessKey: "SubmitNewUser",
                    text: "Valider",
                    type: "default",
                    useSubmitBehavior: true
                }
            }],
            minColWidth: 300,

        }).dxForm("instance");
    })

    $("#s69420").submit(function(e) {
        $("[disabled]").prop("disabled", false)

    })
})
var sendRequest = function(value) {
    $identifiant = value.replaceAll('ç', 'c');
    var valid;
    $.ajax({
        url: '../AjaxLoader/checkIdentifiant.php',
        type: 'get',
        async: false,
        dataType: 'html',
        data: {
            'Identifiant': $identifiant,
        },
        success: function(data) {
            if (data != "") {
                valid = -1;
            } else {
                valid = "";
            }
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
    if (valid == -1) {
        $("[accesskey=SubmitNewUser]").addClass("dx-state-disabled");
        return false;
    }
    $("[accesskey=SubmitNewUser]").removeClass("dx-state-disabled")
    return true;
}

function openModal(id, nom, prenom, identifiant, mail, actif) {
    $('#ModaleUtilisateurs').modal('show');
    switch (actif) {
        case "1":
            var check = "checked";
            break;
        case "self":
            var check = "self";
            break;
        default:
            var check = "";
            break;
    }

    var formModale = $("#form-modale").dxForm({
        formData: { Id: id, Nom: nom, Prenom: prenom, Identifiant: identifiant, Mail: mail, Actif: actif },
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
                dataField: "Actif",
                label: {
                    text: "Actif "
                },
                template: function(data, $itemElement) {
                    if (check != "self") {
                        $(`<div class="custom-control custom-switch">
                        <input type="checkbox" ${check} name="Actif" class="custom-control-input" id="customSwitch_modal">
                        <label class="custom-control-label" for="customSwitch_modal"></label>
                        </div>`).appendTo($itemElement);
                    } else {
                        $(`<div class="custom-control custom-switch">
                        <input type="checkbox" checked name="Actif" class="custom-control-input" disabled id="customSwitch_modal">
                        <label class="custom-control-label" for="customSwitch_modal"></label>
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
}

function renvoiMail(data) {
    //Id, Nom, Prenom, Identifiant, Mail
    data = JSON.parse(data.replaceAll('@|%', "'"));
    $.ajax({
        url: '../AjaxLoader/ResendMailInscriptionUtilisateurAdmin.php',
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
            console.error('Une erreur est survenue');
        }
    });
}

function updateActif(utilisateurId) {
    $.ajax({
        url: '../AjaxLoader/UpdateActif.php',
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
            console.error('Une erreur est survenue');
        }
    });
}