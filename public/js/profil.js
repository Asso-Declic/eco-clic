$(function () {

    if ($('.profil-body').length != 0) {
        var newHeight = $(window).height() - $('.profil-body').position().top - 30;
        $('.profil-body').height(newHeight);
        $(window).on('resize', function () {
            var newHeight = $(window).height() - $('.profil-body').position().top - 30;
            $('.profil-body').height(newHeight);
        })
    }

    $.ajax({
        url: '/api/users/current',
        type: 'GET',
        async: true,
        dataType: 'json',
        success: function (data) {
            $("#form_profil").dxForm({
                formData: { Id: data.id, Nom: data.lastName, Prenom: data.firstName, Identifiant: data.username, Mail: data.email },
                readOnly: false,
                showColonAfterLabel: true,
                labelLocation: "top",
                items: [{
                    dataField: "Id",
                    cssClass: "d-none"
                }, {
                    colCount: 3,
                    itemType: "group",
                    items: [{
                        dataField: "Nom",
                        label: {
                            text: "Nom "
                        },
                        validationRules: [{
                            type: "required",
                            message: "Nom ne peut pas être vide."
                        }]
                    }, {
                        dataField: "Prenom",
                        label: {
                            text: "Prénom "
                        },
                        validationRules: [{
                            type: "required",
                            message: "Prénom ne peut pas être vide."
                        }]
                    }, {
                        dataField: "Identifiant",
                        label: {
                            text: "Identifiant "
                        },
                        validationRules: [{
                            type: "required",
                            message: "Identifiant ne peut pas être vide."
                        }]
                    }, {
                        dataField: "Mail",
                        label: {
                            text: "Mail "
                        },
                        validationRules: [{
                            type: "email",
                            message: "Mail invalide."
                        }, {
                            type: "required",
                            message: "Mail ne peut pas être vide."
                        }]
                    }],
                }],
                minColWidth: 300,

            }).dxForm("instance");
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.error('Une erreur est survenue');
        }
    });

    var form = $("#formMdp").dxForm({
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            colCount: 3,
            itemType: "group",
            items: [{
                dataField: "Ancien_mot_de_passe",
                editorType: "dxTextBox",
                editorOptions: {
                    mode: "password",
                    buttons: [{
                        name: "password",
                        location: "after",
                        options: {
                            icon: "/img/Oeil.svg",
                            type: "default",
                            onClick: function (e) {
                                $("[name=Ancien_mot_de_passe]").attr("type", $("[name=Ancien_mot_de_passe]").attr("type") === "text" ? "password" : "text")
                            }
                        }
                    }]
                }
                // validationRules: [{
                //     type: "async",
                //     validationCallback(params) {
                //         return checkOldPass(params.value);
                //     },
                //     message: "'Ancien mot de passe' incorrect."
                // }, {
                //     type: "required",
                //     message: "Ce champ est obligatoire."
                // }]
            }, {
                dataField: "Mot_de_passe",
                editorType: "dxTextBox",
                editorOptions: {
                    mode: "password",
                    buttons: [{
                        name: "password",
                        location: "after",
                        options: {
                            icon: "/img/Oeil.svg",
                            type: "default",
                            onClick: function (e) {
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
                            icon: "/img/Oeil.svg",
                            type: "default",
                            onClick: function (e) {
                                $("[name=Confirmer_mot_de_passe]").attr("type", $("[name=Confirmer_mot_de_passe]").attr("type") === "text" ? "password" : "text")
                            }
                        }
                    }]
                },
                validationRules: [{
                    type: "compare",
                    comparisonTarget: function (e) {
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
            template: function (data, $itemElement) {
                $(` 
                <span id="r195624624">
                    <img id="iconAlert" src="/img/Icone_alerte.svg" alt="alert">
                    <span class="">
                        Votre mot de passe doit comporter au minimum 12 caractères dont : 
                    </span>
                    <span class="">
                        une minuscule, une majuscule, un chiffre et un caractère spécial.
                    </span>    
                </span>
                `).appendTo($itemElement);
            }
        }],
        minColWidth: 300,
    }).dxForm("instance");

    $('[aria-label=Oeil]').removeClass().addClass('mr-4')

})

$('#enregistrer').on("click", function () {
    $.ajax({
        url: '/api/users/current',
        type: 'PUT',
        async: true,
        contentType: 'application/json',
        data: JSON.stringify({
            lastName: $('[name="Nom"]').val(),
            firstName: $('[name="Prenom"]').val(),
            username: $('[name="Identifiant"]').val(),
            email: $('[name="Mail"]').val(),
            oldPassword: $('[name="Ancien_mot_de_passe"]').val(),
            newPassword : {
                first: $('[name="Mot_de_passe"]').val(),
                second: $('[name="Confirmer_mot_de_passe"]').val(),
            },
        }),
        dataType: 'json',
        success: function (reponse) {
            window.location.reload()
        },
        error: function (resultat, statut, erreur) {
            console.error(resultat + ' --- ' + statut + ' --- ' + erreur);
        }
    });
})
