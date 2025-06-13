// resizeGrid();

// $(window).on('resize', function() {
//     resizeGrid();
// })

// function resizeGrid() {
//     $gridHeight = $(window).height() - document.querySelector("#content > nav").clientHeight - document.querySelector("#content > div.col-md-12 > div").clientHeight - 80;
//     $("#gridContainer").css("max-height", $gridHeight + "px");
// }

$(function () {

    if ($OPSNId == "404" && window.location.pathname == '/admin/collectivite/all' || $OPSNId == "403" && window.location.pathname == '/admin/collectivite/all') {
        $src = "all_col";
    } else {
        $src = "by-opsn";
    }

    $.ajax({
        url: '/api/scores/'+$src,
        type: 'GET',
        async: false,
        dataType: 'json',
        success: function (response) {
            document.getElementById('moyenne').innerHTML = Math.round((parseFloat(response) * 100))/100;
        },
        error: function (jqXhr, textStatus, errorThrown) {
            document.getElementById('moyenne').innerHTML = "N/A";
        }
    });

    $.ajax({
        url: '/api/collectivites/'+$src,
        type: 'GET',
        async: false,
        dataType: 'json',
        success: function (data) {
            response = data;
            document.getElementById('nbCol2').innerHTML = response.length;
            document.getElementById('OPSNName').innerHTML = $OPSNName;
        },
        error: function (jqXhr, textStatus, errorThrown) {
            document.getElementById('nbCol2').innerHTML = 0;
            document.getElementById('OPSNName').innerHTML = "";
        }
    });

    $("#gridContainer").dxDataGrid({
        dataSource: response,
        columnHidingEnabled: false,
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
            width: 100
        },{
            caption: "Avancée",
            dataField: "progression",
            width: 100
        }, {
            caption: "Score",
            dataField: "score",
            width: 100
        },
        {
            caption: "Niveau 2",
            width: 100,
            cellTemplate: function (container, options) {
                $("<div>")
                .append($(`<div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch_${options.data.collectivite.id}" onchange='level2("${options.data.collectivite.id}")'>
                <label class="custom-control-label" for="customSwitch_${options.data.collectivite.id}" style='cursor:pointer;'></label>
                </div>`))
                .appendTo(container);
                if (options.data.collectivite.levelTwo == 1) {
                    $(`#customSwitch_${options.data.collectivite.id}`).attr("checked", true);
                }
            }
        },
        {
            caption: "Questionnaire",
            width: 150,
            cellTemplate: function (container, options) {
                $("<div>").append($(`<div>
                        <a class="dropdown-item param-util text-center" href="/collectivite/impersonate/${options.data.collectivite.id}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>`))
                    .appendTo(container);
            }
        },
        {
            caption: "OPSN",
            width: 150,
            cellTemplate: function (container, options) {

                $("<div>").append($(`<div>
                    <a class="dropdown-item param-util text-center" onclick='supOPSN("${options.data.collectivite.id}")'>
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>`))
                .appendTo(container);
            }
        },
        ],
        masterDetail: {
            enabled: true,
            template(container, options) {
                $avance = options.data.progressionDetails;
                container.append($(`<div id="${options.data.collectivite.id}" class="masterDetail-container"></div>`));
                $collectiviteId = options.data.collectivite.id;
                //On récupère le nombre de recommandation disponibles que le user a au total que l'on vas afficher séparément sur chaque catégories 
                let nbRecommandationUser = [];
                $.ajax({
                    url: '/api/recommendations/by-collectivite/' + $collectiviteId,
                    type: 'GET',
                    async: false,
                    dataType: 'json',
                    success: function (data) {
                        nbRecommandationUser = data.map(elm => elm.nb_recommandation);
                    }
                });

                for (let i = 0; i < $avance.length; i++) {

                    let div1 = document.createElement('div');
                    div1.setAttribute("class", "masterDetail-div");
                    document.getElementById(options.data.collectivite.id).append(div1);

                    let img = document.createElement('img');
                    img.setAttribute("class", "masterDetail-img");
                    img.setAttribute("src", "../../../img/" + $avance[i].category_image);
                    div1.append(img);

                    let p1 = document.createElement('p');
                    p1.setAttribute("class", "masterDetail-nom");
                    p1.textContent = $avance[i].category_name;
                    div1.append(p1);

                    let p2 = document.createElement('p');
                    p2.setAttribute("class", "masterDetail-avance");
                    p2.textContent = nbRecommandationUser[i];
                    div1.append(p2);

                    let p3 = document.createElement('p');
                    if (nbRecommandationUser[i] > 1) {
                        p3.textContent = "recos";
                    } else {
                        p3.textContent = "reco";
                    }
                    div1.append(p3);

                    let div2 = document.createElement('div');
                    div2.setAttribute("class", "masterDetail-divReco");
                    div1.append(div2);

                    $.ajax({
                        url: '/api/questions/count-left/by-category/' + $avance[i].category_id + '/' + options.data.collectivite.id,
                        type: 'get',
                        async: false,
                        dataType: 'json',
                        success: function (questionActive) {
                            $nbQuestionActive = questionActive.data;
                        },
                        error: function (jqXhr, textStatus, errorThrown) {
                            console.error('Une erreur est survenue');
                        }
                    })

                    let p4 = document.createElement('p');
                    p4.setAttribute("class", "masterDetail-avance");
                    if ($nbQuestionActive != 0) {
                        p4.textContent = $nbQuestionActive;
                    } else {
                        p4.textContent = "0";
                    }
                    
                    div2.append(p4);

                    let button = document.createElement('button');
                    button.setAttribute("class", "masterDetail-button");
                    button.setAttribute("onclick", "recoPerso('" + $avance[i].category_id + "','" + options.data.collectivite.id + "','" + $avance[i].category_name + "')");
                    button.textContent = "i";
                    div2.append(button);
                    
                    let p5 = document.createElement('p');
                    p5.setAttribute("class", "masterDetail-text");
                    if ($nbQuestionActive > 1) {
                        p5.textContent = "questions en attente";
                    } else {
                        p5.textContent = "question en attente";
                    }
                    
                    div1.append(p5);
                }
            },
        },
    });
})

function recoPerso(CategId, collectiviteId, Categorie) {

    $.ajax({
        url: '/api/recommendations/perso/by-category/' + CategId,
        type: 'get',
        async: false,
        dataType: 'json',
        success: function (recoPersos) {
            $recoPersos = recoPersos;
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    })

    if ($recoPersos.length > 0) {
        $.ajax({
            url: '/api/recommendation-customs/by-category/' + CategId + '/' + collectiviteId,
            type: 'get',
            async: false,
            dataType: 'json',
            success: function (questionActive) {
                $questionActive = questionActive;
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.error('Une erreur est survenue');
            }
        })
        $('#ModaleRecoPerso').modal('show');
        $('#ModaleRecoPersoLabel')[0].innerHTML = "RECOMMANDATIONS - " + Categorie;
    }

    const selectReponse = $('#select-reponse').dxTagBox({
        visible: false,
        readOnly: true,
        value: [""]
    }).dxTagBox('instance');

    const selectReco = $('#select-reco').dxTagBox({
        visible: false,
        readOnly: false,
        showDropDownButton: true,
        showSelectionControls: true,
        noDataText: "Pas de recommandation",
        selectAllText: "Selectionner tout",
        placeholder: "Selectionner une/des recommandation(s)",
        valueExpr: "id",
        displayExpr: "body",
        onValueChanged(recoId) {
            $recoId = recoId.value;
        },
    }).dxTagBox('instance');

    if ((typeof $selectQuestion) !== 'undefined') {
        $selectQuestion.option('items', "");
    }

    $('#select-reponse-text')[0].hidden = true;
    $('#select-reco-text')[0].hidden = true;

    $(() => {

        $selectQuestion = $('#select-question').dxSelectBox({
            valueExpr: "question.id",
            displayExpr: "question.question",
            noDataText: "Pas de question",
            placeholder: "Selectionner une question",
            items: $recoPersos,
            inputAttr: { 'aria-label': 'Question' },
            labelMode: 'floating',
            wrapItemText: true,
            label: 'Selectionner une question',
            itemTemplate(data) {
                $actif = 0;
                for (let i = 0; i < $questionActive.length; i++) {
                    if (data.question.id == $questionActive[i].question.id) {
                        $actif = 1;
                        break;
                    } else {
                        $actif = 0;
                    }
                }

                if ($actif == 1) {
                    return `<div class='custom-item recoActive'><div class='product-name'>${data.question.sortOrder} | ${data.title}</div><img src="../img/correction.png"/></div>`;
                } else {
                    return `<div class='custom-item recoNonActive'><div class='product-name'>${data.question.sortOrder} | ${data.title}</div><img src="../img/erreur.png"/></div>`;
                }
            },
            onValueChanged(IdQuestion) {

                $questionId = IdQuestion.value;
                $('.divRepInput').remove();

                $.ajax({
                    url: '/api/recommendations/answers/' + IdQuestion.value + '/' + collectiviteId,
                    type: 'get',
                    async: false,
                    dataType: 'json',
                    success: function (reponse) {
                        $reponseBtn = [];
                        $reco = [];
                        $selectedReco = [];

                        for (let i = 0; i < reponse.length; i++) {
                            if (reponse[i].type == "reponse") {
                                if (reponse[i].r != '') {

                                    let div3 = document.createElement('div');
                                    div3.setAttribute("class", "divRepInput");
                                    $('#select-reponse').after(div3);

                                    let p6 = document.createElement('p');
                                    p6.setAttribute("class", "RepInput");
                                    p6.textContent = reponse[i].body;
                                    div3.append(p6);

                                    let p7 = document.createElement('p');
                                    p7.textContent = reponse[i].r;
                                    div3.append(p7);

                                } else {
                                    $reponseBtn.push(reponse[i].body);
                                }

                            } else if (reponse[i].type == "reco") {
                                $reco.push({ "id": reponse[i].id, "body": reponse[i].body });
                            } else if (reponse[i].type == "selectedReco") {
                                $selectedReco.push({ "id": reponse[i].id, "body": reponse[i].body });
                            }
                        }

                        selectReponse.option('value', $reponseBtn);
                        selectReponse.option('visible', true);
                        $('#select-reponse-text')[0].hidden = false;

                        selectReco.option('visible', true);
                        selectReco.option('items', $reco);

                        $selectedRecoId = [];

                        if ($selectedReco != "") {
                            for (let i = 0; i < $selectedReco.length; i++) {
                                $selectedRecoId.push($selectedReco[i].id);
                            }
                            selectReco.option('value', $selectedRecoId);
                        } else {
                            selectReco.option('value', "");
                        }

                        $('#select-reco-text')[0].hidden = false;
                    },
                    error: function (jqXhr, textStatus, errorThrown) {
                        console.error('Une erreur est survenue');
                    }
                })

            },
        }).dxSelectBox('instance');

    });

}
// ERREUR FIREFOX PROVIENS DE CETTE FUNCTION
function updateRecoPerso() {
    $.ajax({
        url: '/api/recommendation-customs',
        type: 'post',
        async: true,
        dataType: 'html',
        data: {
            'recommandations': $recoId,
            'collectivite': $collectiviteId,
            'question': $questionId
        },
        success: function (data) {
            // $('#ModaleRecoPerso').modal('hide');
            // window.location.reload();

            $avance.forEach(avance => {
                if (avance.category_name == document.getElementById("ModaleRecoPersoLabel").innerHTML.replace("RECOMMANDATIONS - ", "")) {
                    $categId = avance.category_id;
                }
            });

            if ($('#select-reco').dxTagBox("instance").option("selectedItems").length > 0) {
                $.ajax({
                    url: '/api/collectivites/addNotif',
                    async: true,
                    type: 'post',
                    data: {
                        'categorie': $categId,
                    }
                });
            }
            
            recoPerso($categId, $collectiviteId, document.getElementById("ModaleRecoPersoLabel").innerHTML.replace("RECOMMANDATIONS - ", ""));
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });
}

function level2($collectiviteId) {
    const popup = $("#confirm").dxPopup({
        title: 'Niveau 2',
        contentTemplate: `<p style="text-align:center;">Veuillez confirmer cette action.</p>`,
        width: 500,
        height: 250,
        showTitle: true,
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
                    if ($(`#customSwitch_`+$collectiviteId)[0].checked == true) {
                        $(`#customSwitch_`+$collectiviteId)[0].checked = false
                    } else {
                        $(`#customSwitch_`+$collectiviteId)[0].checked = true
                    }
                    
                },
            }
        }, {
            widget: "dxButton",
            toolbar: "bottom",
            location: "after",
            options: {
                text: "Oui",
                type: "default",
                onClick: function(e) {
                    $.ajax({
                        url: '/api/collectivites/update-level/' + $collectiviteId,
                        type: 'patch',
                        async: true,
                        dataType: 'json',
                        success: function (data) {
                            // Commenté car sinon ça met à jour selon les données initiales
                            // $("#gridContainer").dxDataGrid("instance").refresh();
                        },
                        error: function (jqXhr, textStatus, errorThrown) {
                            console.error('Une erreur est survenue');
                        }
                    });
                    popup.hide();
                }
            }
        }]
    }).dxPopup("instance");
    popup.show();
}

function supOPSN($collectiviteId) {
    const popup = $("#confirm").dxPopup({
        title: 'Annuler le rattachement de cette collectivité',
        contentTemplate: `<p style="text-align:center;">Vous aller annuler le rattachement de cette collectivite, veuillez confirmer cette action.</p>`,
        width: 500,
        height: 250,
        showTitle: true,
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
                text: "Oui",
                type: "default",
                onClick: function(e) {
                    $.ajax({
                        url: '/api/collectivites/detach/' + $collectiviteId,
                        type: 'delete',
                        async: true,
                        dataType: 'json',
                        success: function(response) {
                            // $("#gridContainer").dxDataGrid("instance").refresh();
                            window.location.reload();
                        },
                        error: function(jqXhr, textStatus, errorThrown) {
                            alert('Une erreur est survenue');
                        }
                    })
                    popup.hide();
                }
            }
        }]
    }).dxPopup("instance");
    popup.show();
}
