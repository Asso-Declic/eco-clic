$(function () {
    $("input").val("")

    var form = $("#form").dxForm({
        formData: { OPSNId: getUrlParam("Id") },
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
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
                    validationCallback: function (params) {
                        var test;
                        var response = null;
                        $.ajax({
                            url: '../AjaxLoader/checkIdentifiantAdmin.php',
                            type: 'get',
                            async: false,
                            dataType: 'html',
                            data: {
                                'Identifiant': params.value,
                            },
                            success: function (data) {
                                response = data;
                            },
                            error: function (jqXhr, textStatus, errorThrown) {
                                console.error('Une erreur est survenue');
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
            }],

        }, {
            template: function (data, $itemElement) {
                $(` 
                <img id="iconAlert" src="../img/icons/alert.svg" alt="alert">
                <span>
                    Votre mot de passe doit comporter au minimum 12 caractères dont : une minuscule, une majuscule, un chiffre et un caractère spécial
                </span>
                `).appendTo($itemElement);
            }
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
                            icon: "../img/icons/iconesBlanc/Oeil.svg",
                            type: "default",
                            onClick: function (e) {
                                $("[name=Mot_de_passe]").attr("type", $("[name=Mot_de_passe]").attr("type") === "text" ? "password" : "text")
                                $("[name=Confirmer_mot_de_passe]").attr("type", $("[name=Confirmer_mot_de_passe]").attr("type") === "text" ? "password" : "text")
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
            dataField: "OPSNId",
            value: "succ",
            cssClass: "d-none",
        }, {
            itemType: "button",
            cssClass: "mt-4 text-center",
            horizontalAlignment: "left",
            buttonOptions: {
                accessKey: "SubmitNewUser",
                text: "Créer un compte",
                type: "default",
                useSubmitBehavior: true
            }
        }],
        minColWidth: 300,
    }).dxForm("instance");
    form.itemOption("Nom", "editorOptions", { placeholder: "Nom" });
    form.itemOption("Prénom", "editorOptions", { placeholder: "Prénom" });
    form.itemOption("Identifiant", "editorOptions", { placeholder: "Identifiant" });
    form.itemOption("E-mail", "editorOptions", { placeholder: "E-mail" });
    form.itemOption("Mot_de_passe", "editorOptions", { placeholder: "Mot de passe" });
    form.itemOption("Confirmer_mot_de_passe", "editorOptions", { placeholder: "Confirmer mot de passe" });

})