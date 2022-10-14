$(function() {
    var makeAsyncDataSource = function() {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "Id",
            load: function() {
                return $.getJSON(`../AjaxLoader/GetCollectivitesInfos.php`);
            }
        });
    }
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
                caption: "Type",
                dataField: "Type",
                width: 100
            }, {
                caption: "Département",
                dataField: "Departement",
                width: 150
            }, {
                caption: "Score",
                dataField: "Score",
                width: 100
            }, {
                cellTemplate: function(container, options) {
                    $("<div>")
                        .append($(`<a href='../AjaxLoader/exportReponsesCollectivite.php?CollectiviteId=${options.data.Id}&CollectiviteNom=${options.data.Nom}' class='fas fa-file-export vertNumeriscore'></a>`))

                    .appendTo(container);
                },
                width: 40,
                cssClass: "align-middle"

            },
            {
                cellTemplate: function(container, options) {
                    $("<div>")
                        .append($(`<a href='../AjaxLoader/EmulateCollectivite.php?CollectiviteId=${options.data.Id}' class='fas fa-eye vertNumeriscore'></a>`))
                        .appendTo(container);
                },
                width: 40,
                cssClass: "align-middle"
            }
        ],
        masterDetail: {
            enabled: true,
            template(container, options) {
                var Id = options.data.Id;
                $('<div>').dxDataGrid({
                    dataSource: "../AjaxLoader/GetScoreTabCollectivite.php?CollectiviteId=" + Id,
                    keyExpr: 'ID',
                    showBorders: true,
                    rowAlternationEnabled: true,
                    columns: [{
                        caption: "Thème",
                        dataField: "themeNom"
                    }, {
                        caption: "Score",
                        dataField: "themeScore"
                    }],
                    showBorders: true,
                }).appendTo(container);
            },
        }
    });
})