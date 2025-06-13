$(function() {

    var form = $("#form_mdp").dxForm({
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            template: function(data, $itemElement) {
                $(`
                <div class="d-flex"> 
                <img id="iconAlert" src="./img/alert.svg" alt="alert" class="pr-3">
                <span>
                    Votre mot de passe doit comporter au minimum 12 caractères dont : une minuscule, une majuscule, un chiffre et un caractère spécial
                </span>
                </div>
                `).appendTo($itemElement);
            }
        }, {
            colCount: 1,
            itemType: "group",
            items: [{
                dataField: "Mot_de_passe_actuel",
                editorType: "dxTextBox",
                editorOptions: {
                    mode: "password",
                },
                validationRules: [{
                    type: "required",
                    message: "Ce champ est obligatoire."
                }, {
                    type: "custom",
                    message: "Le mot de passe est incorrect",
                    validationCallback: function(params) {
                        return checkPassActuel(params.value, "user");
                    }
                }]
            }, {
                colCount: 2,
                itemType: "group",
                items: [{
                    dataField: "Nouveau_mot_de_passe",
                    editorType: "dxTextBox",
                    editorOptions: {
                        mode: "password",
                        buttons: [{
                            name: "password",
                            location: "after",
                            options: {
                                icon: "./img/OeilBlanc.svg",
                                type: "default",
                                onClick: function(e) {
                                    $("[name=Nouveau_mot_de_passe]").attr("type", $("[name=Nouveau_mot_de_passe]").attr("type") === "text" ? "password" : "text")
                                    $("[name=Confirmer_mot_de_passe]").attr("type", $("[name=Confirmer_mot_de_passe]").attr("type") === "text" ? "password" : "text")
                                    $("[name=Mot_de_passe_actuel]").attr("type", $("[name=Mot_de_passe_actuel]").attr("type") === "text" ? "password" : "text")
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
                        comparisonTarget: function(e) {
                            var password = $("[name=Nouveau_mot_de_passe]").val();
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
            }]
        }, {
            colCount: 2,
            itemType: "group",
            items: [{
                itemType: "button",
                cssClass: "mt-4",
                horizontalAlignment: "right",
                buttonOptions: {
                    accessKey: "Retour",
                    text: "Retour",
                    type: "normal",
                }
            }, {
                itemType: "button",
                cssClass: "mt-4",
                horizontalAlignment: "left",
                buttonOptions: {
                    accessKey: "confirm",
                    text: "Valider",
                    type: "default",
                    useSubmitBehavior: true
                }
            }]
        }],
        minColWidth: 300,
    }).dxForm("instance");

    $("#modifMDP").on("click", function() {
        $('#modal_mdp').modal('show')
    })

    $("[accesskey=Retour]").on("click", function() {
        $('#modal_mdp').modal('hide')
    })
});

function checkPassActuel(params, type) {
    var retour;
    $.ajax({
        url: './AjaxLoader/checkPassActuel.php',
        async: false,
        type: 'POST',
        data: {
            Password: params,
            Type: type
        },
        dataType: 'html',
        success: function(reponse) {
            (reponse == 1) ? retour = true: retour = false
        },
        error: function(resultat, statut, erreur) {
            console.log(resultat + ' --- ' + statut + ' --- ' + erreur);
        }
    });
    return retour;
}

function VoirNotif() {
    $.ajax({
        url: '/api/collectivites/notif',
        async: false,
        type: 'GET',
        dataType: 'json',
        success: function(reponse) {

            if (reponse.data.length > 0) {
                document.getElementById("notification").src = "/img/Notifications.svg";
            }

            $('#notif').remove();

            let div = document.createElement('div');
            div.id = "notif";
            $('#notifBloc').append(div);

            for (let i = 0; i < reponse.data.length; i++) {
                let a = document.createElement('a');
                a.setAttribute('href', "../categories/"+reponse.data[i].category_id);
                $('#notif').append(a);
                
                let div1 = document.createElement('div');
                div1.className = "notif";
                div1.setAttribute('onClick', 'MarquerCommeVu('+ reponse.data[i].id +')');
                div1.innerText = 'Nouvelle recommandation dans "'+reponse.data[i].name+'"';
                a.append(div1);
            }
            
        },
        error: function(resultat, statut, erreur) {
            console.log(resultat + ' --- ' + statut + ' --- ' + erreur);
        }
    });

}

function MarquerCommeVu(id) {
    $.ajax({
        url: '/api/collectivites/deleteNotif/' + id,
        async: true,
        type: 'DELETE'
    });
}

function TousLu() {
    $.ajax({
        url: '/api/collectivites/deleteAllNotif',
        async: true,
        type: 'DELETE'
    });
}

VoirNotif();