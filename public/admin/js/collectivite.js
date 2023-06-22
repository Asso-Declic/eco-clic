$(function() {
    $.ajax({
        url: '/api/score/by-opsn',
        type: 'GET',
        async: false,
        dataType: 'json',
        success: function(response) {
            document.getElementById('moyenne').innerHTML = Math.round((parseFloat(response) * 100))/100;
        },
        error: function(jqXhr, textStatus, errorThrown) {
            document.getElementById('moyenne').innerHTML = "N/A";
        }
    });

    $.ajax({
        url: '/api/collectivite/by-opsn',
        type: 'GET',
        async: false,
        dataType: 'json',
        success: function(data) {
            response = data;
            document.getElementById('nbCol2').innerHTML = response.length;
            document.getElementById('OPSNName').innerHTML = $OPSNName;
        },
        error: function(jqXhr, textStatus, errorThrown) {
            document.getElementById('nbCol2').innerHTML = 0;
            document.getElementById('OPSNName').innerHTML = "";
        }
    });

    $("#gridContainer").dxDataGrid({
        dataSource: response,
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
                dataField: "collectivite.name",
            }, {
                caption: "Type",
                dataField: "collectivite.type.label",
                width: 100
            }, {
                caption: "Département",
                dataField: "collectivite.departement.code",
                width: 150
            },{
                caption: "Avancée",
                dataField: "progression",
                width: 100
            }, {
                caption: "Score",
                dataField: "score",
                width: 100
            },
        ],
        masterDetail: {
            enabled: true,
            template(container, options) {
                $avance = options.data.progressionDetails;
                container.append($(`<div id="${options.data.collectivite.id}" class="masterDetail-container"></div>`));

                //On récupère le nombre de recommandation disponibles que le user a au total que l'on vas afficher séparément sur chaque catégories 
                let nbRecommandationUser = [];
                $.ajax({
                    url: '/api/recommandation/by-collectivite/' + options.data.collectivite.id,
                    type: 'GET',
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        nbRecommandationUser = data.map(elm => elm.nb_recommandation);
                    }
                });
                console.log(nbRecommandationUser, options.data)

                for (let i = 0; i < $avance.length; i++) {

                    let div1 = document.createElement('div');
                    div1.setAttribute("class", "masterDetail-div");
                    document.getElementById(options.data.collectivite.id).append(div1);

                    let img = document.createElement('img');
                    img.setAttribute("class", "masterDetail-img");
                    img.setAttribute("src", "../img/"+$avance[i].category_image);
                    div1.append(img);

                    let p1 = document.createElement('p');
                    p1.setAttribute("class", "masterDetail-nom");
                    p1.textContent = $avance[i].category_name;
                    div1.append(p1);

                    let p2 = document.createElement('p');
                    p2.setAttribute("class", "masterDetail-avance");
                    p2.textContent = nbRecommandationUser[i];
                    div1.append(p2);
                }
            },
        },
    });
})
