$(function() {
    $.ajax({
        url: '../AjaxLoader/GetAdministrateur.php',
        type: 'get',
        async: true,
        dataType: 'json',
        success: function(data) {
            $("#form_profil").dxForm({
                formData: { Id: data.Id, Nom: data.Nom, Prenom: data.Prenom, Identifiant: data.Identifiant, Mail: data.Mail },
                readOnly: false,
                showColonAfterLabel: true,
                labelLocation: "top",
                items: [{
                    dataField: "Id",
                    cssClass: "d-none"
                }, {
                    colCount: 2,
                    itemType: "group",
                    items: [{
                        dataField: "Nom",
                        validationRules: [{
                            type: "required",
                            message: "Nom ne peut pas être vide."
                        }]
                    }, {
                        dataField: "Prenom",
                        validationRules: [{
                            type: "required",
                            message: "Prénom ne peut pas être vide."
                        }]
                    }, {
                        dataField: "Identifiant",
                        validationRules: [{
                            type: "required",
                            message: "Identifiant ne peut pas être vide."
                        }]
                    }, {
                        dataField: "Mail",
                        validationRules: [{
                            type: "email",
                            message: "Mail invalide."
                        }, {
                            type: "required",
                            message: "Mail ne peut pas être vide."
                        }]
                    }],
                }, {
                    itemType: "button",
                    cssClass: "mt-4",
                    horizontalAlignment: "center",
                    buttonOptions: {
                        text: "Valider",
                        type: "default",
                        useSubmitBehavior: true
                    }
                }],
                minColWidth: 300,

            }).dxForm("instance");
        },
        error: function(jqXhr, textStatus, errorThrown) {
            alert('Une erreur est survenue');
        }
    });


})