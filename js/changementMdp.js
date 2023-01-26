$(function() {
    $(".iconPass").on("click", function() {
        $("#new_pass").attr("type", ($("#new_pass").attr("type") == "password") ? "text" : "password")
        $("#conf_new_pass").attr("type", ($("#conf_new_pass").attr("type") == "password") ? "text" : "password")
    })
})