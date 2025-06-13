var refreshIntervalId = setInterval(toto, 1000);
clearInterval(refreshIntervalId);

var Interval = setInterval(resize, 1200);
clearInterval(Interval);

$(window).on('resize', function() {
    $('#sidebar').css("transition", "all 0s");
    clearInterval(refreshIntervalId);
    refreshIntervalId = setInterval(toto, 1000);
})

function toto() {
    $('#sidebar').css("transition", "all 0.3s");
    clearInterval(refreshIntervalId);
}

function resize() {
    if ($('#reco').position().top == 0) {
        var newHeight = $("#sidebar").height() - $('#questionnaire').position().top - 108;
    } else {
        var newHeight = $("#sidebar").height() - $('#reco').position().top - 45;
    }
    $('.page-content').height(newHeight);
    clearInterval(Interval);
}

function resize2() {
    if ($('.page-content').length != 0) {
        if (document.title == "L'éco-clic - Catégories") {
            var newHeight = $("#sidebar").height() - $('.page-content').position().top - 108;
            $('.page-content').height(newHeight);
        } else {
            var newHeight = $(window).height() - $('.page-content').position().top - 85;
            $('.page-content').height(newHeight);
        }
    }
}

/* later */
//clearInterval(refreshIntervalId);

$(function() {
    $(".badgeNotification").hide();
    if ($('.page-content').length != 0) {
        if (document.title == "L'éco-clic - Catégories") {
            var newHeight = $("#sidebar").height() - $('.page-content').position().top - 85;
            $('.page-content').height(newHeight);
        } else {
            var newHeight = $(window).height() - $('.page-content').position().top - 85;
            $('.page-content').height(newHeight);
        }

        $(window).on('resize', function() {
            if (document.title == "L'éco-clic - Catégories") {
                Interval = setInterval(resize, 300);
            } else {
                var newHeight = $(window).height() - $('.page-content').position().top - 45;
                $('.page-content').height(newHeight);
            }
        })
    }
    $.fn.enterKey = function(fnc) {
        return this.each(function() {
            $(this).keypress(function(ev) {
                var keycode = (ev.keyCode ? ev.keyCode : ev.which);
                if (keycode == '13') {
                    fnc.call(this, ev);
                }
            })
        })
    }

    $('#rechercheCollectivite').enterKey(function() {

        if ($('#rechercheCollectivite').val().length > 0) {
            window.location.href = "./collectivites.php?search=" + $('#rechercheCollectivite')
                .val();
        }

    })

    $('#notificationMenuDropDown').click(function() {
        event.stopPropagation();
    });

    $('#notificationMenuDropDown').parent().on('hidden.bs.dropdown', function(e) {
        $('#notificationMenuLink div').removeClass("fas").addClass("far");
    });

    $('#notificationMenuDropDown').parent().on('show.bs.dropdown', function(e) {
        $('#notificationMenuLink div').removeClass("far").addClass("fas");
        var jqxhr = $.ajax({
                type: 'get',
                url: 'AjaxLoader/MarquerCommeVu.php',
                dataType: "html", // le fichier php fait un echo de code HTML
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            })
            .done(function(response, textStatus, jqXHR) {
                GetNotifications();
            })
    });

    $('#UserMenuDropDown').parent().on('hidden.bs.dropdown', function(e) {
        $('#userMenuLink i').removeClass("fas").addClass("far");
    });

    $('#UserMenuDropDown').parent().on('show.bs.dropdown', function(e) {
        $('#userMenuLink i').removeClass("far").addClass("fas");
    });


});

function MarquerCommeLu() {
    var jqxhr = $.ajax({
            type: 'get',
            url: 'AjaxLoader/MarquerCommeLu.php',
            dataType: "html", // le fichier php fait un echo de code HTML
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        })
        .done(function(response, textStatus, jqXHR) {
            GetNotifications();
        })
}



function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    return vars;
}

function getUrlParam(parameter, defaultvalue) {
    var urlparameter = defaultvalue;
    if (window.location.href.indexOf(parameter) > -1) {
        urlparameter = decodeURIComponent(getUrlVars()[parameter]);
    }
    return urlparameter;
}

// function fn30sec() {
//     GetNotifications();
// }
// setInterval(fn30sec, 30 * 1000);



function GoBack() {
    var currentUrl = window.location.href;
    var backUrl = document.referrer;
    if (window.location.href.substring(0, 20) == backUrl.substring(0, 20)) {
        window.location.href = backUrl;
    } else {
        window.location.href = '/';
    }
}

function guid() {
    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1)
            .toLowerCase();
    }
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
        s4() + '-' + s4() + s4() + s4();
}

Date.prototype.toMysqlFormat = function() {
    return this.getUTCFullYear() + "-" + twoDigits(1 + this.getUTCMonth()) + "-" + twoDigits(this
            .getUTCDate()) + " " + twoDigits(this.getUTCHours()) + ":" + twoDigits(this.getUTCMinutes()) +
        ":" +
        twoDigits(this.getUTCSeconds());
};

/*
$(window).on('resize', function() {
    $('#sidebar').css("transition", "all 0s");
    setTimeout(
        function() {
            $('#sidebar').css("transition", "all 0.3s");
        }, 5000);
});
*/