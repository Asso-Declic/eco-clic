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
        labelMode:"floating",
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
                                url: 'AjaxLoader/checkIdentifiant.php',
                                type: 'get',
                                async: false,
                                dataType: 'html',
                                data: {
                                    'Identifiant': params.value,
                                },
                                success: function(data) {
                                    response = data;
                                },
                                error: function(jqXhr, textStatus, errorThrown) {
                                    alert('Une erreur est survenue');
                                }
                            });
                            test = (response == params.value) ? false : true
                            return test
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
                            var test;
                            var response = null;
                            $.ajax({
                                url: 'AjaxLoader/checkSiret.php',
                                type: 'get',
                                async: false,
                                dataType: 'html',
                                data: {
                                    'Siret': params.value,
                                },
                                success: function(data) {
                                    response = data;
                                },
                                error: function(jqXhr, textStatus, errorThrown) {
                                    alert('Une erreur est survenue');
                                }
                            });
                            test = (response == params.value) ? false : true
                            return test
                        }
                    }, {
                        type: "custom",
                        message: "Le siret est déjà enregistré.",
                        validationCallback: function(params) {
                            return sirene(params.value);
                        }
                    }]
                }, {
                    dataField: "Denomination",
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
                        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[+\-_!@#\$%\^&\*])(?=.{8,})/,
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
            },{
                template: function(data, $itemElement) {
                    $(` 
                <img id="iconAlert" src="./img/alert.svg" alt="alert">
                <span>
                    Votre mot de passe doit comporter au minimum 8 caractères dont : une minuscule, une majuscule, un chiffre et un caractère spécial
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
                colCount: 1,
                itemType: "group",
                items: [
                    {
                        itemType: "button",
                        cssClass: "mt-4",
                        horizontalAlignment: "center",
                        buttonOptions: {
                            accessKey: "SubmitNewUser",
                            text: "S'enregistrer",
                            type: "submit",
                            useSubmitBehavior: true
                        }
                    }
                ]
            }
        ],
        minColWidth: 300,
    }).dxForm("instance");

    $(".dx-checkbox-text").html('J\'accepte les <a href="#" class="sousligne" data-toggle="modal" data-target="#exampleModal">conditions générales</a>')

    setInterval(() => {
        $(".dx-checkbox-text").html('J\'accepte les <a href="#" class="sousligne" data-toggle="modal" data-target="#exampleModal">conditions générales</a>')
    }, 1000);


})


function sirene(siret) {
    var test = true
    if (siret != "" && siret != null && siret != undefined) {
        $.ajax({
                url: "https://entreprise.data.gouv.fr/api/sirene/v3/etablissements/" + siret,
                method: "GET",
                async: false,
                timeout: 0,
            })
            .done(function(response) {
                $("[name=Latitude]").val(response.etablissement.latitude)
                $("[name=Longitude]").val(response.etablissement.longitude)
                var insee = response.etablissement.code_commune;
                denomination = response.etablissement.unite_legale.denomination;
                var typeCol = null;
                switch (response.etablissement.unite_legale.categorie_juridique) {
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
                if (!response.etablissement.unite_legale.categorie_juridique.startsWith('7')) {
                    test = false
                    alert("erreur 1");
                }

                if (response.etablissement.code_commune.substr(0, 2) == 97) {
                    $("[name=Code_postal]").val(response.etablissement.code_commune.substr(0, 3))
                } else {
                    $("[name=Code_postal]").val(response.etablissement.code_commune.substr(0, 2))
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
                            $("[name=Denomination]").val(denomination);
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            test = false
                            alert("erreur 2");
                        });
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                test = false
                alert("le siret est inconnu");
            });
    }
    if (test == true) {
        $("#form").dxForm('instance').itemOption("Population", "editorOptions", { placeholder: "Population" });
        $("#form").dxForm('instance').itemOption("Type_de_collectivité", "editorOptions", { placeholder: "Type de collectivité" });
        $("#form").dxForm('instance').itemOption("Denomination", "editorOptions", { placeholder: "Dénomination" });
    }
    return test;
}