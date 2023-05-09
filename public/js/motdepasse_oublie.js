$(function() {

    $("#password_input").after("<input hidden name='code'>")
    $("[name=code]").val(getUrlParam("m"));

    $("#form404").on("submit", function(e) {
        var valid = Validation($("#password_input").val(), $("#nex_password_input").val())
        if (valid == false) {
            e.preventDefault();
        }
    })

    $(".iconPass").on("click", function() {
        $("#password_input").attr("type", ($("#password_input").attr("type") == "password") ? "text" : "password")
        $("#nex_password_input").attr("type", ($("#nex_password_input").attr("type") == "password") ? "text" : "password")
    })
})

function Validation(p, c) {
    var v = true;

    const Regex = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$");
    switch (true) {
        case p != c:
            v = false
            break;
        case p == null:
            v = false
            break;
        case p == "":
            v = false
            break;
        case !Regex.test(p):
            v = false
            break;
        default:
            break;
    }
    return v;
}