// loadsubjects.js
//
// Sends ajax request to API server, loads list of all available subjects into
// global variable

var subjects = [];

$(function(){

    subjects = (function() {
        var formatted = [];
        $.ajax({
            url: "ajax/subject.php?action=all",
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
