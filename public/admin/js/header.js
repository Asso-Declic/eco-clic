$(function () {

    /**
     * jQuery.browser.mobile (http://detectmobilebrowser.com/)
     *
     * jQuery.browser.mobile will be true if the browser is a mobile device
     *
     **/
    (function (a) {
        (jQuery.browser = jQuery.browser || {}).mobile =
            /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i
            .test(a) ||
            /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i
            .test(a.substr(0, 4))
        if (jQuery.browser.mobile) {
            $("#sidebar").removeClass("active");
        }
    })(navigator.userAgent || navigator.vendor || window.opera);

    var form = $("#form_mdp").dxForm({
        readOnly: false,
        showColonAfterLabel: true,
        labelLocation: "top",
        items: [{
            template: function (data, $itemElement) {
                $(` 
                <div class="d-flex"> 
                <img id="iconAlert" src="../img/alert.svg" alt="alert" class="pr-3">
                <span>
                    Votre mot de passe doit comporter au minimum 12 caractères dont: une minuscule, une majuscule, un chiffre et un caractère spécial
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
                    validationCallback: function (params) {
                        return checkPassActuel(params.value, "admin");
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
                                icon: "../img/OeilBlanc.svg",
                                type: "default",
                                onClick: function (e) {
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
                        comparisonTarget: function (e) {
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

    $("#modifMDP").on("click", function () {
        $('#modal_mdp').modal('show')
    })

    $("[accesskey=Retour]").on("click", function () {
        $('#modal_mdp').modal('hide')
    })
});



function fn480sec() {
    notifications();
}
// setInterval(fn480sec, 480 * 1000);
var Title = '';

function fn1sec() {

    if ($(".badge2").is(":visible")) {
        if (Title == '') {
            Title = $(document).attr('title');
        }
        if ($(document).attr('title') == Title) {
            if ($('.IsNonVu').length > 1) {
                document.title = $('.IsNonVu').length + ' notifications';
            } else {
                document.title = $('.IsNonVu').length + ' notification';
            }
        } else {
            document.title = Title;
        }
    }
}
//setInterval(fn1sec, 1000);

//Vérifie s'il y a des notifications
// function notifications() {
//     $.ajax({
//         url: './AjaxLoader/GetNotification.php',
//         type: 'GET',
//         // data : 'collectiviteId=' + '<?php // echo $idcol ?>',
//         dataType: 'html',
//         success: function (reponse) {
//             if (reponse == "") {
//                 $("#liste_notification").html(
//                     "<span class='col-12 detailsNotif  text-center'>Aucune notification</span>");
//             } else {
//                 $("#liste_notification").html(reponse);
//             }
//             var NotificationNonVu = '';
//             if ($('.IsNonVu').length == 0) {
//                 $(".badge2").hide();
//             } else {
//                 $(".badge2").show();
//             }
//         },
//         error: function (resultat, statut, erreur) {
//             console.log(resultat + " --- " + statut + " --- " + erreur);
//         }
//     });
// }

//Marque les notifications comme lues
// function MarquerCommeLu() {
//     var jqxhr = $.ajax({
//             type: 'get',
//             url: 'AjaxLoader/MarquerCommeLu.php',
//             dataType: "html", // le fichier php fait un echo de code HTML
//         })
//         .done(function (response, textStatus, jqXHR) {
//             notifications();
//         })
// }

//Marque les notifications comme vues
// function MarquerCommeVu() {
//     var jqxhr = $.ajax({
//             type: 'get',
//             url: 'AjaxLoader/MarquerCommeVu.php',
//             dataType: "html", // le fichier php fait un echo de code HTML
//         })
//         .done(function (response, textStatus, jqXHR) {
//             notifications();
//         })
// }

function SetToSessionCache(key, value) {
    localStorage.setItem(key + 'Time', new Date());
    localStorage.setItem(key, JSON.stringify(value));
}

function GetFromSessionCache(key, cacheDuration) {
    var today = new Date();
    var endDate = new Date(localStorage.getItem(key + 'Time'));

    var diff = today.getTime() - endDate.getTime();

    if (diff >= (cacheDuration * 60000)) {
        return null;
    } else {
        return JSON.parse(localStorage.getItem(key));
    }
}


function GetAjaxCache(cacheDuration, url, params, dataType, async, success, error) {

    var cacheKey = url;

    if (params != null) {
        Object.keys(params).forEach(function (objKey) {

            cacheKey = cacheKey + objKey + params[objKey];
        });
    }

    cacheValue = GetFromSessionCache(cacheKey, cacheDuration);

    if (cacheValue == null) {
        $.ajax({
            url: url,
            type: 'get',
            async: async,
            dataType: dataType,
            data: params,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            cacheKey: cacheKey,
            success: function (response) {

                var cacheKey = this.cacheKey;
                SetToSessionCache(cacheKey, response);
                this.successfunction (response);
            },
            successFunction: success,
            error: error
        });
    } else {
        return success(cacheValue);
    }

    //if ()
}

function GetPreference(code, success) {
    return GetAjaxCache(240, '/api/users/preferences', { 'code': code }, 'json', false, success, null);
}

function SetPreference(code, json) {
    var cacheKey = '/api/users/preferences';
    var params = { 'code': code };
    if (params != null) {
        Object.keys(params).forEach(function (objKey) {

            cacheKey = cacheKey + objKey + params[objKey];
        });
    }


    $.ajax({
        "url": "/api/users/preferences",
        "data": {
            'Json': JSON.stringify(json),
            'code': code
        },
        "dataType": "json",
        "type": "POST"
    });

    SetToSessionCache(cacheKey, json);
}

function checkPassActuel(params, type) {
    var retour;
    $.ajax({
        url: '../AjaxLoader/checkPassActuel.php',
        async: false,
        type: 'POST',
        data: {
            Password: params,
            Type: type
        },
        dataType: 'html',
        success: function (reponse) {
            (reponse == 1) ? retour = true: retour = false
        },
        error: function (resultat, statut, erreur) {
            console.log(resultat + ' --- ' + statut + ' --- ' + erreur);
        }
    });
    return retour;
}

$(document).ready(function () {
    function Timeout() {
        setTimeout(sidebarScroll, 300);
    }

    $(window).on('resize', sidebarScroll);

    function sidebarScroll() {
        if (document.getElementById("sidebar").className == 'active' == true) {
            var newHeight = $(window).height() - 175 + 90;
            $('#scrollNav').height(newHeight);
        } else {
            var newHeight = $(window).height() - 175;
            $('#scrollNav').height(newHeight);
        }
    }

    $("#retrecir").on('click', Timeout);
    $("#categorie").on('click', Timeout);

    sidebarScroll();

    $('.bouton').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#footer0').toggleClass('hidden');
        $('#footer1').toggleClass('hidden');
        $('#footer2').toggleClass('hidden');
        $('#sousMenu').toggleClass('hidden');
    });

    $i = 0;
    $('#categorie').on('click', function () {
        if ($i == 1) {
            $i = 0;
            $('#sousMenu').css("display", "none");
        } else {
            $i = 1;
            $('#sousMenu').css("display", "block");
        }

        if (document.getElementById("sidebar").className == 'active' && window.innerWidth > 970) {
            $('#sidebar').toggleClass('active');
            $('#sousMenu').toggleClass('hidden');
            $('#sousMenu').css("display", "block");
            $i = 1;
            $('#footer0').toggleClass('hidden');
            $('#footer1').toggleClass('hidden');
            $('#footer2').toggleClass('hidden');
        }

        if (window.innerWidth < 970) {
            $('#sousMenu').toggleClass('hidden');
        }
    });

});