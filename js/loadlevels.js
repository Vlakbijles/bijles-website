var levels = [];

$(function(){

    levels = (function() {
        $.ajax({
            url: "ajax/level.php?action=all",
            type: "GET",
            dataType: "json"})
            .done(function(data) {
                if(data) {
                    $.each(data, function(index, value) {
                        $(".levelSelector").append("<option value=" + value.id + ">" + value.name + "</option>");
                    });
                    return data;
                }
            });
    })();

});
