$(function() {

    $.ajax({
        url: '../AjaxLoader/GetCollectivitesInfos.php?OPSNId='+$OPSNId,
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(data) {

            response = data;
            document.getElementById('nbCol2').innerHTML = response.data.length;
            document.getElementById('moyenne').innerHTML = response.moyenne;
            document.getElementById('OPSNName').innerHTML = $OPSNName;
                
        },
        error: function(jqXhr, textStatus, errorThrown) {
            //alert('Une erreur est survenue');

            document.getElementById('nbCol2').innerHTML = 0;
            document.getElementById('moyenne').innerHTML = "N/A";
            document.getElementById('OPSNName').innerHTML = "";
        }
    });

    $("#gridContainer").dxDataGrid({
        dataSource: response.data,
        columnHidingEnabled: true,
        showBorders: true,
        rowAlternationEnabled: false,
        allowColumnResizing: true,
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
                dataField: "Nom",
            }, {
                caption: "Type",
                dataField: "Type",
                width: 100
            }, {
                caption: "Département",
                dataField: "Departement",
                width: 150
            },{
                caption: "Avancée",
                dataField: "Avancee",
                width: 100
            }, {
                caption: "Score",
                dataField: "Score",
                width: 100
            },
        ],
        masterDetail: {
            enabled: true,
            template(container, options) {
                $avance = options.data.detailAvance;
                container.append($(`<div id="${options.data.Id}" class="masterDetail-container"></div>`));
                for (let i = 0; i < $avance.length; i++) {

                    let div1 = document.createElement('div');
                    div1.setAttribute("class", "masterDetail-div");
                    document.getElementById(options.data.Id).append(div1);

                    let img = document.createElement('img');
                    img.setAttribute("class", "masterDetail-img");
                    img.setAttribute("src", "../img/"+$avance[i].image);
                    div1.append(img);

                    let p1 = document.createElement('p');
                    p1.setAttribute("class", "masterDetail-nom");
                    p1.textContent = $avance[i].Categorie;
                    div1.append(p1);

                    let p2 = document.createElement('p');
                    p2.setAttribute("class", "masterDetail-avance");
                    p2.textContent = $avance[i].detailAvancee+" %";
                    div1.append(p2);
                }
            },
        },
    });
})