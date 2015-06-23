// loadlevels.js
//
// Sends ajax request to API server, loads list of all available levels into
// global variable

var levels = [];

$(function(){

    levels = (function() {
        var formatted = [];
        $.ajax({
            url: "/ajax/level.php?action=all",
            type: "GET",
            dataType: "json",
            statusCode: {
                400:
                    // Unable to load levels
                    function() {
                        $("#notificationContent").load("/ajax/notification.php",
                                {"type": "danger",
                                 "message": "Er is iets misgegaan bij het laden van de beschikbare niveaus"});
                    }
            }})
            .done(function(data, status, xhr) {
                switch (xhr.status) {
                    case 200:
                        $.each(data, function(key, val) {
                            formatted.push({ "value": val.id, "label": val.name });
                        });
                        break;
                    default: ;
                }
            });
        return formatted;
    })();

});
