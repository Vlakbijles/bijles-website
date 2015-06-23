// loadsubjects.js
//
// Sends ajax request to API server, loads list of all available subjects into
// global variable

var subjects = [];

$(function(){

    subjects = (function() {
        var formatted = [];
        $.ajax({
            url: "/ajax/subject.php?action=all",
            type: "GET",
            dataType: "json",
            statusCode: {
                400:
                    // Unable to load subjects
                    function() {
                        $("#notificationContent").load("/ajax/notification.php",
                                {"type": "danger",
                                 "message": "Er is iets misgegaan bij het laden van de beschikbare vakken"});
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
