$(function() {

    // var makeAsyncDataSource = function() {
    //     return new DevExpress.data.CustomStore({
    //         loadMode: "raw",
    //         key: "Id",
    //         load: function() {
    //             return $.getJSON(`../AjaxLoader/GetQuestionsByCategorieId.php?id=${getUrlParam("id")}`);
    //         }
    //     });
    // }
    //var champs = makeAsyncDataSource()
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

    $("#gridContainer").dxDataGrid({
        dataSource: champs,
        keyExpr: "Id",
        scrolling: {
            mode: "virtual"
        },
        showBorders: true,
        rowAlternationEnabled: true,
        rowDragging: {
            allowReordering: true,
            onReorder: function(e) {
                var visibleRows = e.component.getVisibleRows(),
                    toIndex = champs.indexOf(visibleRows[e.toIndex].data),
                    fromIndex = champs.indexOf(e.itemData);

                champs.splice(fromIndex, 1);
                champs.splice(toIndex, 0, e.itemData);
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
        }, {
            caption: "Ordre",
            dataField: "Ordre",
            width: 80
        }, {
            caption: "Commentaire",
            dataField: "Commentaire",
            width: 700
        }, {
            cellTemplate: function(container, options) {
                $("<div>")
                    .append($(`<a href='./reponses.php?id=${options.data.Id}' class='fas fa-pen vertNumeriscore'></a>`))
                    .appendTo(container);
            },
            width: 40,
            cssClass: "align-middle"

        }]
    });



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
                dataField: "Nom"
            }, {
                dataField: "Description",
                editorType: "dxTextArea",
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

    });

    $("#add").on("click", function() {
        $('#modale').modal('show')
    })

    var formModale = $("#form-modale").dxForm({
        formData: { Id: "", Titre: "", Commentaire: "", Ordre: "", CategorieId: getUrlParam('id') },
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            colCount: 2,
            itemType: "group",
            items: [{
                dataField: "Titre"
            }, {
                dataField: "Commentaire"
            }, {
                dataField: "Ordre"
            }, {
                dataField: "CategorieId",
                cssClass: "d-none"
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
});

function formulaire(themeId) {
    var theme;
    $.ajax({
        url: `../AjaxLoader/GetCategoriesById.php`,
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