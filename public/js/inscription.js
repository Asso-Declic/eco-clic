$(function () {
    var newHeight = $(window).height() - $("#userSpace").position().top - 30;
    $("#userSpace").height(newHeight);
    $(window).on("resize", function () {
      var newHeight = $(window).height() - $("#userSpace").position().top - 30;
      $("#userSpace").height(newHeight);
    });
    $("#userSpace").css("overflow", "auto");  

    $("input").val("");
    $("#CG_input").attr("checked", false);
    // var denomination = null;
    // var population = null;  

    // var form =
    $("#form").dxForm({
        readOnly: false,
        showColonAfterLabel: true,
        
        labelMode: "floating",
        items: [{
                colCount: 2,
                itemType: "group",
                items: [{
                    dataField: "registration[user_profile][firstName]",
                    label: {text: "Prénom"},
                    editorType: "dxTextBox",
                    editorOptions: {
                        valueChangeEvent: "keyup",
                    },
                    validationRules: [{
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }]
                }, {
                    dataField: "registration[user_profile][lastName]",
                    label: {text: "Nom"},
                    editorType: "dxTextBox",
                    editorOptions: {
                        valueChangeEvent: "keyup",
                    },
                    validationRules: [{
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }]
                }, {
                    dataField: "registration[user_profile][username]",
                    label: {text: "Identifiant"},
                    editorType: "dxTextBox",
                    validationRules: [{
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }, {
                        type: "custom",
                        message: "L'identifiant est déjà utilisé",
                        validationCallback: function (params) {
                            var test;
                            var response = null;
                            $.ajax({
                                url: '/api/users/check-username/' + params.value,
                                type: 'get',
                                async: false,
                                dataType: 'json',
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
                    dataField: "registration[user_profile][email]",
                    label: {text: "E-mail"},
                    validationRules: [{
                        type: "email",
                        message: "E-mail invalide."
                    }, {
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }]
                }, {
                    dataField: "registration[collectivite][siret]",
                    label: {text: "Siret"},
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
                            validationCallback: function (params) {
                                var test;
                                var response = null;
                                $.ajax({	
                                    url: '/api/collectivites/check-siret/' + params.value,
                                    type: 'GET',
                                    async: false,
                                    dataType: 'json',
                                    success: function (data) {
                                        response = data;
                                    },
                                    error: function (jqXhr, textStatus, errorThrown) {
                                        console.error('Une erreur est survenue');
                                    }
                                });
                                test = response == params.value ? false : true;
                                return test;
                            }
                        },
                        // ////////////////temporaire////////////////
                        // {
                        //     type: "custom",
                        //     message: "Vous ne faites pas partie de la liste des testeurs de l'Ecoclic",
                        //     validationCallback: function (params) {
                        //         var retour = true
                        //         $.ajax({
                        //             url: '/api/collectivites/check-siret-connu/' + params.value,
                        //             type: 'GET',
                        //             async: false,
                        //             dataType: 'json',
                        //             success: function (reponse) {
                        //                 if (reponse !== params.value) {
                        //                     retour = false
                        //                 }
                        //             },
                        //             error: function (resultat, statut, erreur) {
                        //                 console.error(resultat);
                        //                 console.error(erreur);
                        //             }
                        //         });
                        //         return retour;
                        //     }
                        // },
                        // //////////////////////////////////////////
                        {
                            type: "custom",
                            message: "Le siret est déjà enregistré.",
                            validationCallback: function (params) {
                                return sirene(params.value);
                            }
                        }
                    ]
                }, {
                    dataField: "registration[collectivite][name]",
                    label: {text: "Dénomination"},
                    disabled: true,
                }, {
                    dataField: "registration[collectivite][population]",
                    label: {text: "Population"},
                    disabled: true,
                }, {
                    dataField: "registration[collectivite][type]",
                    label: {text: "Type de collectivité"},
                    disabled: true,
                }],
            }, {
                colCount: 2,
                itemType: "group",
                items: [{
                    dataField: "registration[user_profile][newPassword][first]",
                    label: {text: "Mot de passe"},
                    editorType: "dxTextBox",
                    editorOptions: {
                        mode: "password",
                        buttons: [{
                            name: "password",
                            location: "after",
                            options: {
                                icon: "./img/Oeil.svg",
                                type: "default",
                                onClick: function (e) {
                                    $("[name=registration\\[user_profile\\]\\[newPassword\\]\\[first\\]]").attr("type", $("[name=registration\\[user_profile\\]\\[newPassword\\]\\[first\\]]").attr("type") === "text" ? "password" : "text")
                                }
                            }
                        }]
                    },
                    validationRules: [{
                        type: "required",
                        message: "Ce champ est obligatoire."
                    }, {
                        type: "pattern",
                        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[+\-_!@#\$%\^&\*])(?=.{8,})/,
                        message: "Merci de respecter le format requis"
                    }]
                }, {
                    dataField: "registration[user_profile][newPassword][second]",
                    label: {text: "Confirmer mot de passe"},
                    editorType: "dxTextBox",
                    editorOptions: {
                        mode: "password",
                        buttons: [{
                            name: "password",
                            location: "after",
                            options: {
                                icon: "./img/Oeil.svg",
                                type: "default",
                                onClick: function (e) {
                                    $("[name=registration\\[user_profile\\]\\[newPassword\\]\\[second\\]]").attr("type", $("[name=registration\\[user_profile\\]\\[newPassword\\]\\[second\\]]").attr("type") === "text" ? "password" : "text")
                                }
                            }
                        }]
                    },
                    validationRules: [{
                        type: "compare",
                        comparisonTarget: function (e) {
                            var password = $("[name=registration\\[user_profile\\]\\[newPassword\\]\\[first\\]]").val();
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
            },
            {
                template: function (data, $itemElement) {
                    $(` 
                <span id="r195624624">
                    <img id="iconAlert" src="./img/Icone_alerte.svg" alt="alert">
                    <span class="">
                    <span class="" style="margin-left: 20px;">
                    Votre mot de passe doit comporter au minimum 12 caractères dont : une minuscule, une majuscule, un chiffre et un caractère spécial.
                    </span> 
                </span>
                `).appendTo($itemElement);
                }
            },
            {
                dataField: "registration[cgu]",
                label: {visible: false},
                editorType: "dxCheckBox",
                editorOptions: {
                    name: "registration[cgu]",
                    text: " "
                },
                validationRules: [{
                    type: "required",
                    message: "Ce champ est obligatoire."
                }]
            },
            {
                dataField: "registration[collectivite][postalCode]",
                label: {text: "Code postal"},
                cssClass: "d-none",
                disabled: true,
            },
            {
                dataField: "registration[collectivite][latitude]",
                label: {text: "Latitude"},
                cssClass: "d-none",
            },
            {
                dataField: "registration[collectivite][longitude]",
                label: {text: "Longitude"},
                cssClass: "d-none",
            },
            {
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
                },
                {
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

    $(".dx-checkbox-text").html('J\'accepte les <a href="#" class="sousligne" data-toggle="modal" data-target="#cguModal">conditions générales</a>')
    $("[accesskey=return]").on("click", function () {
        window.location.href = "/"
    })
    $("[accesskey=return]").css('background-color', '#F0F0F0')
    $("[accesskey=return]").css("color", "#08453F")
    setInterval(() => {
        $(".dx-checkbox-text").html('J\'accepte les <a href="#" class="sousligne" data-toggle="modal" data-target="#cguModal">conditions générales</a>')
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
                async: true,
                timeout: 0,
            })
            .done(function (response) {
                $("[name=registration\\[collectivite\\]\\[latitude\\]]").val("")
                $("[name=registration\\[collectivite\\]\\[longitude\\]]").val("")
                var insee = response.adresseEtablissement.codeCommuneEtablissement;
                denomination = response.uniteLegale.denominationUniteLegale;
                var typeCol = null;
                switch (response.uniteLegale.categorieJuridiqueUniteLegale) {
                    case "7210":
                      typeCol = "MAIRIE";
                      break;
                    case "7346":
                      typeCol = "COMCOM";
                      break;
                    case "7348":
                      typeCol = "CA";
                      break;
                    default:
                      typeCol = "AUTRE";
                      break;
                }
                if (!response.uniteLegale.categorieJuridiqueUniteLegale.startsWith('7')) {
                    test = false
                    console.error("erreur 1");
                }
                if (response.adresseEtablissement.codeCommuneEtablissement.substr(0, 2) == 97) {
                    $("[name=registration\\[collectivite\\]\\[postalCode\\]]").val(response.adresseEtablissement.codeCommuneEtablissement.substr(0, 3))
                } else {
                    $("[name=registration\\[collectivite\\]\\[postalCode\\]]").val(response.adresseEtablissement.codeCommuneEtablissement.substr(0, 2))
                }
                if (test == true) {
                    $("[name=registration\\[collectivite\\]\\[type\\]]").val(typeCol);
                    $.ajax({
                            url: "https://geo.api.gouv.fr/communes/" + insee,
                            method: "GET",
                            async: false,
                            timeout: 0,
                        })
                        .done(function (response) {
                            population = response.population;
                            $("[name=registration\\[collectivite\\]\\[population\\]]").val(population);
                            $("[name=registration\\[collectivite\\]\\[name\\]]").val(denomination);
                        })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            test = false
                            console.error("erreur 2");
                        });
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                test = false
                console.error("le siret est inconnu");
            });
    }
    if (test == true) {
        $("#form").dxForm('instance').itemOption("registration[collectivite][population]", "editorOptions", { placeholder: "Population" });
        $("#form").dxForm('instance').itemOption("registration[collectivite][type]", "editorOptions", { placeholder: "Type de collectivité" });
        $("#form").dxForm('instance').itemOption("registration[collectivite][name]", "editorOptions", { placeholder: "Dénomination" });
    }
    return test;
}