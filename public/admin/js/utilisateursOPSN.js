resizeGrid();

$(window).on('resize', function() {
    resizeGrid();
})

function resizeGrid() {
    $gridHeight = $(window).height() - document.querySelector("#content > nav").clientHeight - document.querySelector("#content > div.col-md-12 > div").clientHeight - document.querySelector("#content > div.d-flex.justify-content-end.col-12").clientHeight - 50;
    $("#gridContainer").css("max-height", $gridHeight + "px");
}

$(function() {

    var makeAsyncDataSource = function() {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "id",
            load: function() {
                return $.getJSON(`/api/users`);
            }
        });
    }

    $.ajax({
        url: '/api/users/current',
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(data) {
            currentUser = data;
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });

    $("#gridContainer").dxDataGrid({
        dataSource: makeAsyncDataSource(),
        keyExpr: "id",
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
            dataField: "firstName",
            width: 150
        }, {
            caption: "Nom",
            dataField: "lastName",
            width: 150
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
                if (options.value == 1) {
                    $("<div>").append($(`<i class="fas fa-check-circle vertNumeriscore"></i>`)).appendTo(container);
                } else {
                    $("<div>").append($(`<i class="fas fa-redo-alt vertNumeriscore" style='cursor:pointer;' title="Renvoyer le mail" onclick='renvoiMail("${options.data.id}")'></i>`)).appendTo(container);
                }
            },
            width: 80
        }, {
            caption: "Actif",
            dataField: "active",
            cellTemplate: function(container, options) {
                if (options.data.id != currentUser.id) {
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
            width: 80
        }, {
            cellTemplate: function(container, options) {
                // if (options.data.active == "self") {
                    $("<div>")
                        .append($(`<i style='cursor:pointer;' onclick='openModal("${options.data.id}", "${options.data.lastName}", "${options.data.firstName}", "${options.data.username}", "${options.data.email}", "${options.data.active}")' class='fas fa-pen vertNumeriscore'></i>`))
                        .appendTo(container);
                // }
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
            readOnly: false,
            showColonAfterLabel: true,
            labelLocation: "top",
            items: [{
                dataField: "id",
                cssClass: "d-none"
            }, {
                colCount: 2,
                itemType: "group",
                items: [{
                    dataField: "user[lastName]",
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
                    dataField: "user[firstName]",
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
                        message: "Identifiant est requis"
                    }, {
                        type: "custom",
                        message: "L'identifiant est déjà utilisé",
                        validationCallback: function(params) {
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
                        message: "Email invalide"
                    }, {
                        type: "required",
                        message: "Email est requis"
                    }]
                }, {
                    dataField: "user[active]",
                    label: {
                        text: "Actif "
                    },
                    template: function(data, $itemElement) {
                        $(`<div class="custom-control custom-switch">
                        <input type="checkbox" checked name="user[active]" class="custom-control-input" id="customSwitch_modal">
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
        url: '/api/users/check-username/' + $identifiant,
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(data) {
            if (data != "") {
                valid = false;
            } else {
                valid = true;
            }
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
    if (valid == false) {
        $("[accesskey=SubmitNewUser]").addClass("dx-state-disabled");
    } else {
        $("[accesskey=SubmitNewUser]").removeClass("dx-state-disabled")
    }
    return valid;
}

function openModal(id, nom, prenom, identifiant, mail, actif) {
    $('#ModaleUtilisateurs').modal('show');

    if (currentUser.id == id) {
        actif = "self";
    }

    switch (actif) {
        case "true":
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
        formData: { id: id, lastName: nom, firstName: prenom, username: identifiant, email: mail, active: actif },
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            dataField: "id",
            cssClass: "d-none"
        }, {
            colCount: 2,
            itemType: "group",
            items: [{
                dataField: "lastName",
                label: {
                    text: "Nom"
                },
                validationRules: [{
                    type: "required",
                    message: "Nom ne peut pas être vide."
                }]
            }, {
                dataField: "firstName",
                label: {
                    text: "Prénom"
                },
                validationRules: [{
                    type: "required",
                    message: "Prénom ne peut pas être vide."
                }]
            }, {
                dataField: "username",
                label: {
                    text: "Identifiant"
                },
                validationRules: [{
                    type: "required",
                    message: "Identifiant ne peut pas être vide."
                }, {
                    type: "custom",
                    message: "L'identifiant est déjà utilisé",
                    validationCallback: function(params) {
                        // TODO : il y a un bug qui empêche de valider le formulaire si l'identifiant est déjà utilisé
                        return sendRequest(params.value);
                    }
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
                dataField: "active",
                label: {
                    text: "Actif"
                },
                template: function(data, $itemElement) {
                    console.log(check);
                    if (check != "self") {
                        $(`<div class="custom-control custom-switch">
                        <input type="checkbox" ${check} name="active" class="custom-control-input" id="customSwitch_modal">
                        <label class="custom-control-label" for="customSwitch_modal"></label>
                        </div>`).appendTo($itemElement);
                    } else {
                        $(`<div class="custom-control custom-switch">
                        <input type="checkbox" checked name="active" class="custom-control-input" disabled id="customSwitch_modal">
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

function renvoiMail(userId) {
    // userId = JSON.parse(userId.replaceAll('@|%', "'"));
    $.ajax({
        url: '/api/users/resend-email/' + userId,
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