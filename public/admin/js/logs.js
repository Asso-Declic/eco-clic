resizeGrid();

$(window).on('resize', function() {
    resizeGrid();
})

function resizeGrid() {
    $gridHeight = $(window).height() - document.querySelector("#content > nav").clientHeight - document.querySelector("#content > div.col-md-12 > div").clientHeight - 50;
    $("#gridContainer").css("max-height", $gridHeight + "px");
}

$(function () {
    var makeAsyncDataSource = function () {
        return new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: "id",
            load: function () {
                return $.getJSON(`/api/log/all`);
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
                dataField: "username",
            }, {
                caption: "Date",
                cellTemplate: function (container, options) {
                    $date = new Date(options.data.createdAt).toLocaleDateString("fr") + " " + "|"+ " " + new Date(options.data.createdAt).toLocaleTimeString("fr");
                    $("<div>")
                    .append($(`<p>${$date}</p>`))
                    .appendTo(container);
                }
            }, {
                caption: "Type",
                dataField: "type",
            }]
        });
    });
})