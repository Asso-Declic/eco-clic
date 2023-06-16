$(function() {
    var newHeight = $(window).height() - $('#userSpace').position().top - 30;
    $('#userSpace').height(newHeight);
    $(window).on('resize', function() {
        var newHeight = $(window).height() - $('#userSpace').position().top - 30;
        $('#userSpace').height(newHeight);
    });
    $("#userSpace").css("overflow", "auto")

    $("input").val("")
    $("#CG_input").attr("checked", false)
    var denomination = null;
    var population = null;


    var form = $("#form").dxForm({
        readOnly: false,
        showColonAfterLabel: true,
        labelMode: "floating",
        items: [{
                colCount: 2,
                itemType: "group",
                items: [{
                    dataField: "Prénom",
                    editorType: "dxTextBox",
                    editorOptions: {
                        valueChangeEvent: "keyup",
                    },
                    validationRules: [{
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }]
                }, {
                    dataField: "Nom",
                    editorType: "dxTextBox",
                    editorOptions: {
                        valueChangeEvent: "keyup",
                    },
                    validationRules: [{
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }]
                }, {
                    dataField: "Identifiant",
                    editorType: "dxTextBox",
                    validationRules: [{
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }, {
                        type: "custom",
                        message: "L'identifiant est déjà utilisé",
                        validationCallback: function(params) {
                            var test;
                            var response = null;
                            $.ajax({
                                url: '/api/user/check-username/' + params.value,
                                type: 'GET',
                                async: false,
                                dataType: 'json',
                                // data: {
                                //     'identifiant': params.value,
                                // },
                                success: function (data) {
                                    response = data;
                                },
                                error: function (jqXhr, textStatus, errorThrown) {
                                    console.error('Une erreur est survenue');
                                }
                            });
                            return (response == params.value) ? false : true;
                        }
                    }]
                }, {
                    dataField: "E-mail",
                    validationRules: [{
                        type: "email",
                        message: "E-mail invalide."
                    }, {
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }]
                }, {
                    dataField: "Siret",
                    editorType: "dxTextBox",
                    editorOptions: {
                        value: "",
                        mask: "000 000 000 00000",
                    },
                    validationRules: [{
                            type: "required",
                            message: "Ce champ est obligatoire."
                        }, {
                            type: "custom",
                            message: "Le siret est déjà enregistré.",
                            validationCallback: function(params) {
                                var response = null;
                                $.ajax({	
                                    url: '/api/collectivite/check-siret/' + params.value,
                                    type: 'GET',
                                    async: false,
                                    dataType: 'json',
                                    // data: {
                                    //     'Siret': params.value,
                                    // },
                                    success: function(data) {
                                        response = data;
                                    },
                                    error: function(jqXhr, textStatus, errorThrown) {
                                        console.error('Une erreur est survenue');
                                    }
                                });
                                return (response == params.value) ? false : true;
                            }
                        },
                        ////////////////temporaire////////////////
                        {
                            type: "custom",
                            message: "Vous ne faites pas partie de la liste des testeurs de l'Ecoclic",
                            validationCallback: function(params) {
                                var retour = true
                                $.ajax({
                                    url: '/api/collectivite/check-siret-connu/' + params.value,
                                    type: 'GET',
                                    async: false,
                                    dataType: 'json',
                                    success: function(reponse) {
                                        if (reponse !== params.value) {
                                            retour = false
                                        }
                                    },
                                    error: function(resultat, statut, erreur) {
                                        console.error(resultat);
                                        console.error(erreur);
                                    }
                                });
                                return retour;
                            }
                        },
                        //////////////////////////////////////////
                        {
                            type: "custom",
                            message: "Le siret est déjà enregistré.",
                            validationCallback: function(params) {
                                return sirene(params.value);
                            }
                        }
                    ]
                }, {
                    dataField: "Dénomination",
                    disabled: true,
                }, {
                    dataField: "Population",
                    disabled: true,
                }, {
                    dataField: "Type_de_collectivité",
                    disabled: true,
                }],
            }, {
                colCount: 2,
                itemType: "group",
                items: [{
                    dataField: "Mot_de_passe",
                    editorType: "dxTextBox",
                    editorOptions: {
                        mode: "password",
                        buttons: [{
                            name: "password",
                            location: "after",
                            options: {
                                icon: "./img/Oeil.svg",
                                type: "default",
                                onClick: function(e) {
                                    $("[name=Mot_de_passe]").attr("type", $("[name=Mot_de_passe]").attr("type") === "text" ? "password" : "text")
                                }
                            }
                        }]
                    },
                    validationRules: [{
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }, {
                        type: "pattern",
                        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[+\-_!@#\$%\^&\*])(?=.{12,})/,
                        message: "Merci de respecter le format requis"
                    }]
                }, {
                    dataField: "Confirmer_mot_de_passe",
                    editorType: "dxTextBox",
                    editorOptions: {
                        mode: "password",
                        buttons: [{
                            name: "password",
                            location: "after",
                            options: {
                                icon: "./img/Oeil.svg",
                                type: "default",
                                onClick: function(e) {
                                    $("[name=Confirmer_mot_de_passe]").attr("type", $("[name=Confirmer_mot_de_passe]").attr("type") === "text" ? "password" : "text")
                                }
                            }
                        }]
                    },
                    validationRules: [{
                        type: "compare",
                        comparisonTarget: function(e) {
                            var password = $("[name=Mot_de_passe]").val();
                            if (password) {
                                return password;
                            }
                        },
                        message: "'Mot de passe' et 'Confirmer mot de passe' ne correspondent pas."
                    }, {
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }]
                }]
            }, {
                template: function(data, $itemElement) {
                    $(` 
                <span id="r195624624">
                    <img id="iconAlert" src="./img/Icone_alerte.svg" alt="alert">
                    <span class="">
                        Votre mot de passe doit comporter au minimum 12 caractères dont : 
                    </span>
                    <span class="">
                        une minuscule, une majuscule, un chiffre et un caractère spécial.
                    </span>    
                </span>
                `).appendTo($itemElement);
                }
            }, {
                dataField: "",
                editorType: "dxCheckBox",
                editorOptions: {
                    name: "conditionsGenerales",
                    text: " "
                },
                validationRules: [{
                    type: "required",
                    message: "Ce champ est obligatoire."
                }]
            }, {
                dataField: "Code_postal",
                cssClass: "d-none",
                disabled: true,
            }, {
                dataField: "Latitude",
                cssClass: "d-none",
            },
            {
                dataField: "Longitude",
                cssClass: "d-none",
            }, {
                colCount: 2,
                itemType: "group",
                items: [{
                    itemType: "button",
                    cssClass: "mt-4 btn-grey",
                    horizontalAlignment: "right",
                    buttonOptions: {
                        accessKey: "return",
                        text: "Retour",
                    }
                }, {
                    itemType: "button",
                    cssClass: "mt-4",
                    horizontalAlignment: "left",
                    buttonOptions: {
                        accessKey: "SubmitNewUser",
                        text: "S'enregistrer",
                        type: "submit",
                        useSubmitBehavior: true
                    }
                }]
            }
        ],
        minColWidth: 300,
    }).dxForm("instance");

    $(".dx-checkbox-text").html('J\'accepte les <a href="#" class="sousligne" data-toggle="modal" data-target="#exampleModal">conditions générales</a>')
    $("[accesskey=return]").on("click", function() {
        window.location.href = "/"
    })
    $("[accesskey=return]").css('background-color', '#F0F0F0')
    $("[accesskey=return]").css("color", "#08453F")
    setInterval(() => {
        $(".dx-checkbox-text").html('J\'accepte les <a href="#" class="sousligne" data-toggle="modal" data-target="#exampleModal">conditions générales</a>')
    }, 1000);
    $("[aria-label=Oeil]").removeClass("dx-button-mode-contained", "oeil")
    $("[aria-label=Oeil]").addClass("oeil")

})


function sirene(siret) {
    var test = true
    if (siret != "" && siret != null && siret != undefined) {
        $.ajax({
                url: "/api/insee/siret/" + siret,
                method: "GET",
                async: false,
                timeout: 0,
            })
            .done(function(response) {
                $("[name=Latitude]").val("")
                $("[name=Longitude]").val("")
                var insee = response.etablissement.adresseEtablissement.codeCommuneEtablissement;
                denomination = response.etablissement.uniteLegale.denominationUniteLegale;
                var typeCol = null;
                switch (response.etablissement.uniteLegale.categorieJuridiqueUniteLegale) {
                    case "7210":
                        typeCol = "MAIRIE";
                        break;
                    case "7346":
                        typeCol = "COMMUNAUTE DE COMMUNES";
                        break;
                    case "7348":
                        typeCol = "COMMUNAUTE D'AGLOMERATION";
                        break;
                    default:
                        typeCol = "AUTRE";
                        break;
                }
                if (!response.etablissement.uniteLegale.categorieJuridiqueUniteLegale.startsWith('7')) {
                    test = false
                    console.error("erreur 1");
                }
                if (response.etablissement.adresseEtablissement.codeCommuneEtablissement.substr(0, 2) == 97) {
                    $("[name=Code_postal]").val(response.etablissement.adresseEtablissement.codeCommuneEtablissement.substr(0, 3))
                } else {
                    $("[name=Code_postal]").val(response.etablissement.adresseEtablissement.codeCommuneEtablissement.substr(0, 2))
                }
                if (test == true) {
                    $("[name=Type_de_collectivité]").val(typeCol);
                    $.ajax({
                            url: "https://geo.api.gouv.fr/communes/" + insee,
                            method: "GET",
                            async: false,
                            timeout: 0,
                        })
                        .done(function(response) {
                            population = response.population;
                            $("[name=Population]").val(population);
                            $("[name=Dénomination]").val(denomination);
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            test = false
                            console.error("erreur 2");
                        });
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                test = false
                console.error("le siret est inconnu");
            });
    }
    if (test == true) {
        $("#form").dxForm('instance').itemOption("Population", "editorOptions", { placeholder: "Population" });
        $("#form").dxForm('instance').itemOption("Type_de_collectivité", "editorOptions", { placeholder: "Type de collectivité" });
        $("#form").dxForm('instance').itemOption("Dénomination", "editorOptions", { placeholder: "Dénomination" });
    }
    return test;
}