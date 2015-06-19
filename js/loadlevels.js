// loadlevels.js
//
// Sends ajax request to API server, loads list of all available levels into
// global variable

var levels = [];

$(function(){

    levels = (function() {
        var formatted = [];
        $.ajax({
            url: "ajax/level.php?action=all",
            type: "GET",
            dataType: "json"})
            .done(function(data) {
                if(data) {
                    $.each(data, function(key, val) {
                        formatted.push({ "value": val.id, "label": val.name });
                    });
                }
            });
        return formatted;
    })();

});
