var DependancesByReponseId = [];
var modifiable = false;
var typeReco;
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

    $.ajax({
        url: '../AjaxLoader/GetTypeReco.php',
        type: 'GET',
        async: false,
        dataType: 'json',
        success: function(reponse) {
            typeReco = reponse;
        },
        error: function(resultat, statut, erreur) {
            console.error(resultat + ' --- ' + statut + ' --- ' + erreur);
        }
    });


    var makeAsyncDataSource = function() {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "Id",
            load: function() {
                return $.getJSON(`../AjaxLoader/GetReponsesByQuestionId.php?id=${getUrlParam("id")}`);
            }
        });
    }

    $("#gridContainer").dxDataGrid({
        dataSource: makeAsyncDataSource(),
        keyExpr: "Id",
        columnHidingEnabled: true,
        showBorders: true,
        rowAlternationEnabled: true,
        loadPanel: {
            text: "Chargement"
        },
        columns: [{
            caption: "Libelle",
            dataField: "Libelle",
            width: 200
        }, {
            caption: "Ponderation",
            dataField: "Ponderation",
            width: 150
        }, {
            caption: "Recommandation",
            dataField: "Recommandation",
            width: 300
        }, {
            caption: "Niveau recommandation",
            dataField: "NiveauRecoId",
            //width: 700
        }, {
            cellTemplate: function(container, options) {
                var str = JSON.stringify(options.data.Recommandation).replaceAll("\"", "\\\"").replaceAll("'", "@|%");
                if (modifiable) {
                    $("<div>")
                        .append($(`<i  onclick='modaleModifier("${options.data.Id}", "${options.data.Libelle}", "${str}", "${options.data.Ponderation}", "${options.data.NiveauRecoId}", "${options.data.NiveauReco}")' style="cursor:pointer;" class='fas fa-pen vertNumeriscore'></i>`))
                        .appendTo(container);
                } else {
                    $("<div>")
                        .append($(`<i  onclick='modaleModifier("${options.data.Id}", "${options.data.Libelle}", "${options.data.Recommandation}", "${options.data.Ponderation}", "${options.data.NiveauRecoId}", "${options.data.NiveauReco}")' style="cursor:pointer;" class='fas fa-eye vertNumeriscore'></i>`))
                        .appendTo(container);
                }
            },
            width: 40,
            cssClass: "align-middle"

        }, {
            cellTemplate: function(container, options) {
                if (modifiable) {
                    var str = JSON.stringify(options.data).replaceAll("\"", "\\\"").replaceAll("'", "@|%");
                    $("<div>")
                        .append($("<a href='#' onclick='modaleDelete(\`" + str + "\`)' class='fas fa-trash-alt vertNumeriscore'></a>"))
                        .appendTo(container);
                }
            },
            width: 40,
            cssClass: "align-middle"
        }]
    });

    (!modifiable) ? $("#add").prop("disabled", true): $("#add").prop("disabled", false);

    var form = $("#formulaire").dxForm({
        formData: formulaire(getUrlParam('id')),
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            dataField: "Id",
            disabled: true,
            cssClass: "d-none"
        }, {
            dataField: "CategorieId",
            disabled: true,
            cssClass: "d-none"
        }, {
            colCount: 1,
            itemType: "group",
            items: [{
                dataField: "Titre",
                label: {
                    text: "Titre "
                },
                validationRules: [{
                    type: "required",
                    message: "Titre ne peut pas être vide."
                }]
            }, {
                dataField: "Ordre",
                label: {
                    text: "Ordre "
                },
                disabled: modifiable ? false : true,
                validationRules: [{
                    type: "required",
                    message: "Ordre ne peut pas être vide."
                }]
            }, {
                dataField: "Commentaire",
                label: {
                    text: "Commentaire "
                },
                disabled: modifiable ? false : true,
                editorType: "dxTextArea",
            }],
        }, {
            dataField: "Visibilite",
            label: {
                text: "Visibilité "
            },
            template: function(data, itemElement) {
                itemElement.dxTreeList({
                    dataSource: "../AjaxLoader/GetRefTypeCol.php",
                    keyExpr: 'Id',
                    columnAutoWidth: true,
                    wordWrapEnabled: true,
                    showBorders: true,
                    selectedRowKeys: GetTreeListData(getUrlParam('id')),
                    selection: {
                        mode: 'multiple',
                    },
                    columns: [{
                        dataField: 'Nom',
                    }],
                    onSelectionChanged() {
                        const selectedData = this.getSelectedRowsData("all");
                        var data
                        data = JSON.stringify(selectedData)
                        $("[name=Visibilite]").val(data)
                    },
                })
                itemElement.append("<input name='Visibilite' hidden>")
            }
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

    $("#form-container").on("submit", function(e) {
        $("[disabled]").prop("disabled", false)
    });

    $("#add").on("click", function() {
        var dependancesCreation = "";
        $.ajax({
            url: `../AjaxLoader/GetQuestionSansDependance.php`,
            type: 'get',
            async: false,
            dataType: 'json',
            data: {
                Questionid: getUrlParam("id"),
            },
            success: function(data) {
                dependancesCreation = data;
            },
            error: function(jqXhr, textStatus, errorThrown) {
                console.error('Une erreur est survenue');
            }
        });

        var dataGridCreation = $("#nestedDataGridCreation").dxDataGrid({
            dataSource: dependancesCreation,
            keyExpr: "Id",
            showBorders: true,
            rowAlternationEnabled: true,
            loadPanel: {
                text: "Chargement"
            },
            selection: {
                showCheckBoxesMode: "always",
                mode: "multiple"
            },
            columns: [{
                dataField: "Titre",
            }, {
                dataField: "Commentaire",
            }],
            onSelectionChanged: function(selectedItems) {
                $("#truandageCreation").html(`<input type='text' name='SelectedRows' value='${$("#nestedDataGridCreation").dxDataGrid("instance").getSelectedRowKeys()}' class='d-none'></input>`)
            },
        }).dxDataGrid("instance");
        $('#modale').modal('show')
    })

    var formModale = $("#form-modale").dxForm({
        formData: { Id: "", Libelle: "", Recommandation: "", Ponderation: "", QuestionId: getUrlParam('id') },
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            colCount: 1,
            itemType: "group",
            items: [{
                dataField: "Libelle",
                label: {
                    text: "Libellé "
                },
                validationRules: [{
                    type: "required",
                    message: "Libelle ne peut pas être vide."
                }]
            }, {
                dataField: "Ponderation",
                label: {
                    text: "Pondération "
                },
                validationRules: [{
                    type: "required",
                    message: "Ponderation ne peut pas être vide."
                }]
            }, {
                dataField: "Recommandation",
                label: {
                    text: "Recommandation "
                },
                editorType: "dxTextArea",
                disabled: modifiable ? false : true,
            }, {
                dataField: "Niveau_de_recommandation",
                label: {
                    text: "Niveau de recommandation"
                },
                disabled: modifiable ? false : true,
                editorType: "dxSelectBox",
                editorOptions: {
                    items: typeReco,
                    displayExpr: "Libelle",
                    valueExpr: "Id",
                    fieldTemplate(data, container) {
                        if (data == null) {
                            var result = $(`<div class='custom-item d-flex'></i><div class='product-name'></div></div>`);
                        } else {
                            var result = $(`<div class='custom-item d-flex'><i class="fas px-2 py-3 fa-exclamation" style="color: #${data.Couleur}"></i><div class='product-name'></div></div>`);
                        }

                        result.find('.product-name').dxTextBox({
                            value: data && data.Libelle,
                            readOnly: true,
                        });
                        container.append(result);
                    },
                    itemTemplate(data) {
                        return `<div class='custom-item d-flex'><i class="fas px-2 fa-exclamation" style="color: #${data.Couleur}"></i><div class='product-name'>${data.Libelle}</div></div>`;
                    },

                },
                validationRules: [{
                    type: "required",
                    message: "Niveau de recommandation ne peut pas être vide."
                }]
            }, {
                dataField: "QuestionId",
                cssClass: "d-none"
            }, {
                template: function(data, $itemElement) {
                    $(`<h3 class='vertNumeriscore'>Questions dépendantes</h3><div id='truandageCreation' class='d-none'></div><div id='nestedDataGridCreation'></div>`).appendTo($itemElement);
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

    $("#form-container").on("submit", function(e) {
        $("[disabled]").prop("disabled", false)
    });

    $("#form-modif").on("submit", function(e) {
        $("[disabled]").prop("disabled", false)
    });

});

function formulaire(themeId) {
    var theme;
    $.ajax({
        url: `../AjaxLoader/GetQuestionsById.php`,
        type: 'post',
        async: false,
        dataType: 'json',
        data: { id: themeId },
        success: function(data) {
            theme = data;
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
    return theme;
}

function modaleModifier(Id, Libelle, Recommandation, Ponderation, NiveauRecoId, NiveauReco) {
    Recommandation = JSON.parse(Recommandation.replaceAll('@|%', "'"));
    var formModaleModif = $("#form-modale-modifier").dxForm({
        formData: { Id: Id, Libelle: Libelle, Recommandation: Recommandation, Ponderation: Ponderation, Niveau_de_recommandation: NiveauReco, QuestionId: getUrlParam('id') },
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            colCount: 1,
            itemType: "group",
            items: [{
                dataField: "Libelle",
                label: {
                    text: "Libellé "
                },
                validationRules: [{
                    type: "required",
                    message: "Libelle ne peut pas être vide."
                }]
            }, {
                dataField: "Ponderation",
                label: {
                    text: "Pondération "
                },
                disabled: modifiable ? false : true,
                validationRules: [{
                    type: "required",
                    message: "Ponderation ne peut pas être vide."
                }]
            }, {
                dataField: "Recommandation",
                label: {
                    text: "Recommandation "
                },
                disabled: modifiable ? false : true,
                editorType: "dxTextArea",
            }, {
                dataField: "Niveau_de_recommandation",
                label: {
                    text: "Niveau de recommandation "
                },
                disabled: modifiable ? false : true,
                editorType: "dxSelectBox",
                editorOptions: {
                    items: typeReco,
                    displayExpr: "Libelle",
                    valueExpr: "Id",
                    fieldTemplate(data, container) {
                        if (data == null) {
                            var result = $(`<div class='custom-item d-flex'></i><div class='product-name'></div></div>`);
                        } else {
                            var result = $(`<div class='custom-item d-flex'><i class="fas px-2 py-3 fa-exclamation" style="color: #${data.Couleur}"></i><div class='product-name'></div></div>`);
                        }

                        result.find('.product-name').dxTextBox({
                            value: data && data.Libelle,
                            readOnly: true,
                        });
                        container.append(result);
                    },
                    itemTemplate(data) {
                        return `<div class='custom-item d-flex'><i class="fas px-2 fa-exclamation" style="color: #${data.Couleur}"></i><div class='product-name'>${data.Libelle}</div></div>`;
                    },

                },
                validationRules: [{
                    type: "required",
                    message: "Niveau de recommandation ne peut pas être vide."
                }]
            }, {
                dataField: "QuestionId",
                cssClass: "d-none"
            }, {
                dataField: "Id",
                cssClass: "d-none"
            }, {
                template: function(data, $itemElement) {
                    $(`<h3 class='vertNumeriscore'>Questions dépendantes</h3><div id='truandage' class='d-none'></div><div id='nestedDataGrid'></div>`).appendTo($itemElement);
                }
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
        }],
        onContentReady: function(e) {
            $.ajax({
                url: `../AjaxLoader/GetQuestionsByReponseId.php`,
                type: 'get',
                async: false,
                dataType: 'json',
                data: {
                    ReponseId: $("[name=Id]").val(),
                },
                success: function(data) {
                    for (let i = 0; i < data.length; i++) {
                        DependancesByReponseId[i] = data[i].QuestionId;
                    }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    console.error('Une erreur est survenue');
                }
            });
        },
        minColWidth: 300,
    }).dxForm("instance");

    var dependances = "";
    $.ajax({
        url: `../AjaxLoader/GetQuestionSansDependance.php`,
        type: 'get',
        async: false,
        dataType: 'json',
        data: {
            Questionid: getUrlParam("id"),
        },
        success: function(data) {
            dependances = data;
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });

    var dataGrid = $("#nestedDataGrid").dxDataGrid({
        dataSource: dependances,
        keyExpr: "Id",
        showBorders: true,
        disabled: modifiable ? false : true,
        rowAlternationEnabled: true,
        loadPanel: {
            text: "Chargement"
        },
        selection: {
            showCheckBoxesMode: "always",
            mode: "multiple"
        },
        onContentReady: function(e) {
            for (let i = 0; i < DependancesByReponseId.length; i++) {
                DependancesByReponseId[i] = e.component.getRowIndexByKey(DependancesByReponseId[i])
            }
            if (!e.component.getSelectedRowKeys().length)
                e.component.selectRowsByIndexes(DependancesByReponseId);
        },
        columns: [{
            dataField: "Titre",
        }, {
            dataField: "Commentaire",
        }],
        onSelectionChanged: function(selectedItems) {
            $("#truandage").html(`<input type='text' name='SelectedRows' value='${$("#nestedDataGrid").dxDataGrid("instance").getSelectedRowKeys()}' class='d-none'></input>`)
        }
    }).dxDataGrid("instance");
    $('#modale_modifier').modal('show');
    $('.dx-select-checkboxes-hidden').removeClass('dx-select-checkboxes-hidden');
}

function modaleDelete(data) {
    data = JSON.parse(data.replaceAll('@|%', "'"));
    const popup = $("#confirm").dxPopup({
        contentTemplate: `<p>Voulez vraiment supprimer <b>${data.Libelle}</b> ainsi que tout les éléments qui y sont liés ?</p>`,
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
                            ReponseId: data.Id,
                            type: "Reponse"
                        },
                        success: function(response) {
                            if (response == 1) {
                                DevExpress.ui.notify(`${data.Libelle} à été supprimé`, "success", 2000);
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

function GetTreeListData(questionId) {
    var data;
    $.ajax({
        url: '../AjaxLoader/GetTreeViewPreselect.php',
        type: 'GET',
        async: false,
        data: {
            Type: 'Question',
            QuestionId: questionId
        },
        dataType: 'JSON',
        success: function(reponse) {
            data = reponse
        },
        error: function(resultat, statut, erreur) {
            console.error(resultat + ' --- ' + statut + ' --- ' + erreur);
        }
    });
    return data
}