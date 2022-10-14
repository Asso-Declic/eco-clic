$(function () {
    // Vide le form au chargement de la page
    $("#username_input_login").val("");

    // Fonction Afficher mdp
    toggle = 1;
    $(".iconPass").mousedown(function () {
        if (toggle == 1) {
            $("#password_input_eyes").attr("type", "text");
            toggle = 0;
        } else {
            $("#password_input_eyes").attr("type", "password");
            toggle = 1;
        }
    })
})   

$(function () {

    // Fonction Afficher mdp
    toggle = 1;
    $(".iconPass1").mousedown(function () {
        if (toggle == 1) {
            $("#nex_password_input").attr("type", "text");
            toggle = 0;
        } else {
            $("#nex_password_input").attr("type", "password");
            toggle = 1;
        }
    })
})   

$(function () {

    // Fonction Afficher mdp
    toggle = 1;
    $(".iconPass").mousedown(function () {
        if (toggle == 1) {
            $("#password_input").attr("type", "text");
            toggle = 0;
        } else {
            $("#password_input").attr("type", "password");
            toggle = 1;
        }
    })
})  