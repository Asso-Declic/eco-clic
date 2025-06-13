resizeGrid();

$(window).on('resize', function() {
    resizeGrid();
})

function resizeGrid() {
    $gridHeight = $(window).height() - document.querySelector("#content > nav").clientHeight - document.querySelector("#content > div.col-md-12 > div").clientHeight - document.querySelector("#content > div.d-flex.justify-content-end.col-12").clientHeight - 50;
    $("#gridContainer").css("max-height", $gridHeight + "px");
}

$(function () {
    var makeAsyncDataSource = function () {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "id",
            load: function () {
                return $.getJSON(`/api/opsns`);
            }
        });
    }

    var makeAsyncDataSourceDPTM = function () {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "code",
            load: function () {
                return $.getJSON(`/api/departments`);
            }
        });
    }

    $(function () {
        $("#gridContainer").dxDataGrid({
            dataSource: makeAsyncDataSource(),
            columnHidingEnabled: true,
            showBorders: true,
            rowAlternationEnabled: true,
            loadPanel: {
                text: "Chargement"
            },
            columns: [{
                caption: "Nom",
                dataField: "name",
            }, {
                caption: "Département",
                dataField: "departement",
                width: 150
            }, {
                caption: "Actif",
                dataField: "active",
                cellTemplate: function (container, options) {
                    $("<div>")
                        .append($(`<div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch_${options.data.id}" onchange='updateActif("${options.data.id}")'>
                        <label class="custom-control-label" for="customSwitch_${options.data.id}" style='cursor:pointer;'></label>
                        </div>`))
                        .appendTo(container);
                    $(`#customSwitch_${options.data.id}`).attr("checked", options.data.active);
                },
                width: 80
            }, {
                caption: "Modifier",
                dataField: "Modifier",
                cellTemplate: function (container, options) {
                    $("<div>")
                        .append($(`<a href='/admin/opsn/edit/${options.data.id}' class='fas fa-pen vertEcoclic'></a>`))
                        .appendTo(container);
                },
                width: 150,
                cssClass: "align-middle"
            },{
                caption: "Utilisateur",
                dataField: "Utilisateur",
                width: 150,
                cellTemplate: function (container, options) {
                    $("<div>")
                        .append($(`<a style="cursor: pointer;" onclick='insertUser("${options.key}")'><i class="fas fa-plus-circle vertEcoclic"></i></a>`))
                        .appendTo(container);
                },
                cssClass: "align-middle"
            }],
            masterDetail: {
                enabled: true,
                template: function (container, options) {
                    var currentOPSN = options.data;
                    $("<div>")
                        .addClass("d-flex master-detail-caption py-3")
                        .html("<span>Départements de travail de <b>" + currentOPSN.name + "</b> :</span>")
                        .appendTo(container);

                    $("<div>")
                        .dxDataGrid({
                            columnAutoWidth: true,
                            showBorders: true,
                            columns: [{
                                dataField: "name",
                                caption: "Nom",
                            }, {
                                dataField: "code",
                                caption: "Numéro département",
                                width: 200
                            }],
                            dataSource: currentOPSN.departements,
                        }).appendTo(container);
                }
            }
        });
    });

    var form = $("#form-ajout").dxForm({
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
                colCount: 2,
                itemType: "group",
                items: [{
                    dataField: "opsn[name]",
                    label: {
                        text: "Nom "
                    },
                    validationRules: [{
                        type: "required",
                        message: "Nom ne peut pas être vide."
                    }]
                }, {
                    dataField: "opsn[departement]",
                    label: {
                        text: "Departement"
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        dataSource: makeAsyncDataSourceDPTM(),
                        displayExpr: "name",
                        valueExpr: "code",
                        itemTemplate: function (data) {
                            return "<div>" + data.code + " - " + data.name + "</div>";
                        }
                    },
                    validationRules: [{
                        type: "required",
                        message: "Couleur ne peut pas être vide."
                    }]
                }]
            }, {
                dataField: "opsn[email]",
                label: {
                    text: "Mail "
                },
                validationRules: [{
                    type: "required",
                    message: "Nom ne peut pas être vide."
                }, {
                    type: "email",
                    message: "Mail invalide."
                }]
            }, {
                dataField: "opsn[departements]",
                label: {
                    text: "Departement de travail "
                },
                editorType: "dxDropDownBox",
                editorOptions: {
                    valueExpr: "code",
                    placeholder: "Département(s)...",
                    displayExpr: "Code",
                    showClearButton: true,
                    dataSource: makeAsyncDataSourceDPTM(),
                    contentTemplate: function (e) {
                        var value = e.component.option("value"),
                            $dataGrid = $("<div>").dxDataGrid({
                                dataSource: e.component.getDataSource(),
                                columns: [
                                    { dataField: "name", caption: "Nom"},
                                    { dataField: "code", caption: "Code"},
                                ],
                                hoverStateEnabled: true,
                                paging: { enabled: true, pageSize: 10 },
                                filterRow: { visible: true },
                                scrolling: { mode: "virtual" },
                                height: 345,
                                selection: { showCheckBoxesMode: "always", mode: "multiple" },
                                selectedRowKeys: value,
                                onSelectionChanged: function (selectedItems) {
                                    var keys = selectedItems.selectedRowKeys;
                                    e.component.option("value", keys);
                                }
                            });

                        dataGrid = $dataGrid.dxDataGrid("instance");

                        e.component.on("valueChanged", function (args) {
                            var value = args.value;
                            dataGrid.selectRows(value, false);
                        });

                        return $dataGrid;
                    }
                }

            },
            {
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
})

function insertUser(OPSNId) {
    $('#ModaleAjoutUtilisateurs').modal('show');
    var part1 = "";
    var part2 = "";
    var identifiant;
    var formModale = $("#form-modale-ajout").dxForm({
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            dataField: 'user[opsn]',
            cssClass: "d-none",
            editorOptions: {
                value: OPSNId,
            }
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
                    // onValueChanged: function (data) {
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
                    // onValueChanged: function (data) {
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
                    validationCallback: function (params) {
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
                template: function (data, $itemElement) {
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
}

// function GetMasterDetails(id) {
//     MasterData = [];
//     $.ajax({
//         url: '../AjaxLoader/GetMasterDetails.php',
//         type: 'GET',
//         async: false,
//         data: {
//             Id: id
//         },
//         dataType: 'JSON',
//         success: function (reponse) {
//             MasterData = reponse
//         },
//         error: function (jqXhr, textStatus, errorThrown) {
//             console.error('Une erreur est survenue');
//         }
//     });
//     return MasterData;
// }

function updateActif(id) {
    $.ajax({
        url: '/api/opsns/update-active/' + id,
        type: 'PATCH',
        async: true,
        dataType: 'JSON',
        success: function (reponse) {
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
}

var sendRequest = function (value) {
    $identifiant = value.replaceAll('ç', 'c');
    var valid;
    $.ajax({
        url: '/api/users/check-username/' + $identifiant,
        type: 'get',
        async: false,
        dataType: 'json',
        success: function (data) {
            if (data != "") {
                valid = false;
            } else {
                valid = true;
            }
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
    if (valid === false) {
        $("[accesskey=SubmitNewUser]").addClass("dx-state-disabled");
    } else {
        $("[accesskey=SubmitNewUser]").removeClass("dx-state-disabled")
    }
    return valid;
}