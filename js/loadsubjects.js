var subjects = [];

$(function(){

    subjects = (function() {
        var formatted = [];
        $.ajax({
            async: true,
            url: "ajaxutils/subject.php?action=all",
            dataType: "json",
            success: function (data) {
                if(data) {
                    $.each(data, function(key, val) {
                        formatted.push({ "value": val.id, "label": val.name });
                    });
                }
            }
        });
        return formatted;
    })();

});
