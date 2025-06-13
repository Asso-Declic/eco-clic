$(function() {

    var modifiable = false;
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

    var champs = null
    $.ajax({
            type: 'get',
            async: false,
            url: `../AjaxLoader/GetQuestionsByCategorieId.php?id=${getUrlParam("id")}`,
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        })
        .done(function(response, textStatus, jqXHR) {
            champs = response;
        });

    var treeList = $("#gridContainer").dxTreeList({
        dataSource: champs,
        keyExpr: "Id",
        parentIdExpr: "QuestionIdParent",
        columnAutoWidth: true,
        showBorders: true,
        rowAlternationEnabled: true,
        showRowLines: true,
        rowDragging: {
            allowDropInsideItem: false,
            allowReordering: true,
            dropFeedbackMode: "push",
            onDragChange: function(e) {
                var visibleRows = treeList.getVisibleRows(),
                    sourceNode = treeList.getNodeByKey(e.itemData.Id),
                    targetNode = visibleRows[e.toIndex].node;

                while (targetNode && targetNode.data) {
                    if (targetNode.data.Id === sourceNode.data.Id) {
                        e.cancel = true;
                        break;
                    }
                    targetNode = targetNode.parent;
                }
            },
            onReorder: function(e) {
                var visibleRows = e.component.getVisibleRows();

                if (e.dropInsideItem) {
                    e.itemData.Head_ID = visibleRows[e.toIndex].key;
                } else {
                    var sourceData = e.itemData,
                        toIndex = e.fromIndex > e.toIndex ? e.toIndex - 1 : e.toIndex,
                        targetData = toIndex >= 0 ? visibleRows[toIndex].node.data : null;

                    if (targetData && e.component.isRowExpanded(targetData.Id)) {
                        sourceData.Head_ID = targetData.Id;
                        targetData = null;
                    } else {
                        sourceData.Head_ID = targetData ? targetData.Head_ID : e.component.option('rootValue');
                    }

                    var sourceIndex = champs.indexOf(sourceData);
                    champs.splice(sourceIndex, 1);

                    var targetIndex = champs.indexOf(targetData) + 1;
                    champs.splice(targetIndex, 0, sourceData);
                }
                var i = 1;
                var champs2 = [];
                champs.forEach(champ => {
                    champ.Ordre = i;
                    i = i + 1;
                    champs2.push(champ);
                });

                var jsonChamps = JSON.stringify(champs2);
                $.ajax({
                        type: 'get',
                        async: false,
                        url: '../AjaxLoader/ReorderChampPerso.php',
                        data: {
                            "champs": jsonChamps
                        },
                        dataType: "json",
                        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    })
                    .done(function(response, textStatus, jqXHR) {});
                e.component.refresh();
            }
        },
        columns: [{
            caption: "Titre",
            dataField: "Titre",
            width: "50%"
        }, {
            caption: "Ordre",
            dataField: "Ordre",
            width: 80
        }, {
            caption: "Commentaire",
            dataField: "Commentaire",
            wordWrapEnabled: true,
            height: 50,
            width: 700
        }, {
            cellTemplate: function(container, options) {
                if (modifiable) {
                    $("<div>")
                        .append($(`<a href='./reponses.php?id=${options.data.Id}' class='fas fa-pen vertNumeriscore'></a>`))
                        .appendTo(container);
                } else {
                    $("<div>")
                        .append($(`<a href='./reponses.php?id=${options.data.Id}' class='fas fa-eye vertNumeriscore'></a>`))
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
    }).dxTreeList("instance");

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
            dataField: "ThemeId",
            disabled: true,
            cssClass: "d-none"
        }, {
            colCount: 1,
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
                dataField: "TempsDeReponse",
                label: {
                    text: "Temps de réponse "
                },
            }, {
                dataField: "Description",
                label: {
                    text: "Description "
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
        $('#modale').modal('show')
    })

    var formModale = $("#form-modale").dxForm({
        formData: { Id: "", Titre: "", Commentaire: "", Ordre: getLastOrdre(), CategorieId: getUrlParam('id') },
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            colCount: 2,
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
                dataField: "Commentaire",
                label: {
                    text: "Commentaire "
                },
            }, {
                dataField: "Ordre",
                label: {
                    text: "Ordre "
                },
                validationRules: [{
                    type: "required",
                    message: "Ordre ne peut pas être vide."
                }]
            }, {
                dataField: "CategorieId",
                cssClass: "d-none"
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
});

function formulaire(themeId) {
    var theme;
    $.ajax({
        url: `../AjaxLoader/GetCategoriesByIdAdmin.php`,
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

function modaleDelete(data) {
    data = JSON.parse(data.replaceAll('@|%', "'"));
    const popup = $("#confirm").dxPopup({
        contentTemplate: `<p>Voulez vraiment supprimer <b>${data.Titre}</b> ainsi que tout les éléments qui y sont liés ?</p>`,
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
                            QuestionId: data.Id,
                            type: "Question"
                        },
                        success: function(response) {
                            if (response == 1) {
                                DevExpress.ui.notify(`${data.Titre} à été supprimé`, "success", 2000);
                            } else {
                                DevExpress.ui.notify(`Une erreur est survenue`, "error", 2000);
                            }
                            $("#gridContainer").dxTreeList('refresh')
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

function getLastOrdre() {
    var ordre = ""
    $.ajax({
        url: '../AjaxLoader/GetLastOrdre.php',
        type: 'get',
        async: false,
        dataType: 'html',
        data: {
            CategorieId: getUrlParam('id')
        },
        success: function(response) {
            ordre = response;
        },
        error: function(jqXhr, textStatus, errorThrown) {
            DevExpress.ui.notify(`Une erreur est survenue`, "error", 2000);
        }
    })
    return ordre
}

function GetTreeListData(categorieId) {
    var data;
    $.ajax({
        url: '../AjaxLoader/GetTreeViewPreselect.php',
        type: 'GET',
        async: false,
        data: {
            Type: 'Categorie',
            CategorieId: categorieId
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