$(function() {
    var makeAsyncDataSource = function() {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "Id",
            load: function() {
                return $.getJSON(`../AjaxLoader/GetOPSNS.php`);
            }
        });
    }

    var makeAsyncDataSourceDPTM = function() {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "Code",
            load: function() {
                return $.getJSON(`../AjaxLoader/GetDepartements.php`);
            }
        });
    }

    $(function() {
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
                dataField: "Nom",
            }, {
                caption: "Département",
                dataField: "DepartementCode",
                width: 150
            }, {
                caption: "Actif",
                dataField: "Actif",
                cellTemplate: function(container, options) {
                    $("<div>")
                        .append($(`<div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch_${options.data.Id}" onchange='updateActif("${options.data.Id}")'>
                        <label class="custom-control-label" for="customSwitch_${options.data.Id}" style='cursor:pointer;'></label>
                        </div>`))
                        .appendTo(container);
                    $(`#customSwitch_${options.data.Id}`).attr("checked", (options.data.Actif == 1) ? true : false);
                },
                width: 80
            }, {
                caption: "Compte Ref",
                dataField: "MailReferant",
                cellTemplate: function(container, options) {
                    $("#dx-col-5>.dx-datagrid-text-content.dx-text-content-alignment-right").html('<i class="fas fa-envelope"></i>')
                    if (options.value == null) {
                        $("<div>").append($(`<i class="fas fa-check-circle vertNumeriscore"></i>`)).appendTo(container);
                    } else {
                        $("<div>").append($(`<i class="fas fa-redo-alt vertNumeriscore" style='cursor:pointer;' title="Renvoyer le mail" onclick='renvoiMail("${options.data.Id}", "${options.data.MailReferant}")'></i>`)).appendTo(container);
                    }
                },
                width: 100
            }, {
                cellTemplate: function(container, options) {
                    $("<div>")
                        .append($(`<a href='./modifOPSN.php?Id=${options.data.Id}' class='fas fa-pen vertNumeriscore'></a>`))
                        .appendTo(container);
                },
                width: 40,
                cssClass: "align-middle"
            }],
            masterDetail: {
                enabled: true,
                template: function(container, options) {
                    var currentOPSN = options.data;
                    $("<div>")
                        .addClass("d-flex master-detail-caption py-3")
                        .html("<span>Départements de travail de <b>" + currentOPSN.Nom + "</b> :</span>")
                        .appendTo(container);

                    $("<div>")
                        .dxDataGrid({
                            columnAutoWidth: true,
                            showBorders: true,
                            columns: [{
                                dataField: "Nom",
                            }, {
                                dataField: "DepartementCode",
                                caption: "Numéro département",
                                width: 200
                            }],
                            dataSource: new DevExpress.data.DataSource({
                                store: new DevExpress.data.ArrayStore({
                                    key: "DepartementCode",
                                    data: GetMasterDetails(currentOPSN.Id)
                                }),
                                filter: ["OPSNId", "=", options.key]
                            })
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
                    dataField: "Nom",
                    label: {
                        text: "Nom "
                    },
                    validationRules: [{
                        type: "required",
                        message: "Nom ne peut pas être vide."
                    }]
                }, {
                    dataField: "Departement",
                    label: {
                        text: "Departement "
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        dataSource: makeAsyncDataSourceDPTM(),
                        displayExpr: "Nom",
                        valueExpr: "Code",
                        itemTemplate: function(data) {
                            return "<div>" + data.Code + " - " + data.Nom + "</div>";
                        }
                    },
                    validationRules: [{
                        type: "required",
                        message: "Couleur ne peut pas être vide."
                    }]
                }]
            }, {
                dataField: "Mail",
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
                dataField: "Departement_de_travail",
                label: {
                    text: "Departement de travail "
                },
                editorType: "dxDropDownBox",
                editorOptions: {
                    valueExpr: "Code",
                    placeholder: "Département(s)...",
                    displayExpr: "Code",
                    showClearButton: true,
                    dataSource: makeAsyncDataSourceDPTM(),
                    contentTemplate: function(e) {
                        var value = e.component.option("value"),
                            $dataGrid = $("<div>").dxDataGrid({
                                dataSource: e.component.getDataSource(),
                                columns: ["Nom", "Code"],
                                hoverStateEnabled: true,
                                paging: { enabled: true, pageSize: 10 },
                                filterRow: { visible: true },
                                scrolling: { mode: "virtual" },
                                height: 345,
                                selection: { showCheckBoxesMode: "always", mode: "multiple" },
                                selectedRowKeys: value,
                                onSelectionChanged: function(selectedItems) {
                                    var keys = selectedItems.selectedRowKeys;
                                    e.component.option("value", keys);
                                }
                            });

                        dataGrid = $dataGrid.dxDataGrid("instance");

                        e.component.on("valueChanged", function(args) {
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

function GetMasterDetails(id) {
    MasterData = [];
    $.ajax({
        url: '../AjaxLoader/GetMasterDetails.php',
        type: 'GET',
        async: false,
        data: {
            Id: id
        },
        dataType: 'JSON',
        success: function(reponse) {
            MasterData = reponse
        },
        error: function(resultat, statut, erreur) {
            console.error(resultat + ' --- ' + statut + ' --- ' + erreur);
        }
    });
    return MasterData;
}

function updateActif(id) {
    $.ajax({
        url: '../AjaxLoader/UpdateActifOPSN.php',
        type: 'GET',
        async: true,
        data: {
            Id: id
        },
        dataType: 'JSON',
        success: function(reponse) {

        },
        error: function(resultat, statut, erreur) {
            console.error(resultat + ' --- ' + statut + ' --- ' + erreur);
        }
    });
}

function renvoiMail(Id, Mail) {
    window.location = "./inscription.php?Id=" + Id
    DevExpress.ui.notify("Le mail a été envoyé");
}