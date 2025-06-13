resizeGrid();

$(window).on('resize', function() {
    resizeGrid();
})

function resizeGrid() {
    $gridHeight = $(window).height() - document.querySelector("#content > nav").clientHeight - document.querySelector("#content > div.col-md-12 > div").clientHeight - 80;
    $("#gridContainer").css("max-height", $gridHeight + "px");
}

$(document).ready(function() {

    datasource();

    $("#gridContainer").dxDataGrid({
        dataSource: response,
        columnHidingEnabled: true,
        showBorders: true,
        remoteOperations: true,
        rowAlternationEnabled: true,
        allowColumnResizing: true,
        allowColumnReordering: true,
        searchPanel: {
            visible: true,
            highlightCaseSensitive: true,
            placeholder: "Rechercher",
            width: 260,
        },
        scrolling: {
            mode: 'infinite',
        },
        loadPanel: {
            text: "Chargement"
        },
        columns: [{
                caption: "Collectivité",
                dataField: "name",
            }, {
                caption: "Type",
                dataField: "type.label",
                width: 100
            }, {
                caption: "Département",
                dataField: "departement.code",
                width: 150
            },
            {
                caption: "",
                width: 150,
                cellTemplate: function(container, options) {

                    $("<div>").append($(`<div>
                        <button id="accept" class="btn btn-light" onclick='modifOPSNCol("${options.data.id}");'>
                            <i class="fa-solid fa-check"></i>
                        </button>
                        <button id="refus" class="btn btn-light" style="width: 42px;" onclick=deleteDemandeOPSN("${options.data.id}")>
                            <i class="fa-solid fa-close"></i>
                        </button>
                    </div>`)).appendTo(container);
                }
            }
        ]
    });
});

function datasource() {
    $.ajax({
        url: '/api/collectivites/demanding',
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(data) {
            response = data;
            document.getElementById('nbCol2').innerHTML = response.length;
            if (response.length <= 1) {
                document.getElementsByClassName('size13')[0].innerHTML = "Demande de rattachement";
            }
        },
        error: function(jqXhr, textStatus, errorThrown) {
            //console.error('Une erreur est survenue');
            document.getElementById('nbCol2').innerHTML = 0;
            document.getElementsByClassName('size13')[0].innerHTML = "Demande de rattachement";
        }
    });
}

function modifOPSNCol($collectiviteId) {
    $.ajax({
        url: '/api/collectivite/rattachement/accept/' + $collectiviteId,
        type: 'POST',
        async: false,
        success: function () {
            window.location.reload();
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    })
}

function deleteDemandeOPSN($collectiviteId) {
    $info = "col";
    $.ajax({
        url: '/api/collectivite/rattachement/' + $collectiviteId,
        async: false,
        type: 'DELETE',
        success: function () {
            window.location.reload();
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    })
}