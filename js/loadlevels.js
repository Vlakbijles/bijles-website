var levels = [];

$(function(){

    levels = (function () {
        var formatted = [];
        $.ajax({
            async: true,
            url: "ajax/level.php?action=all",
            dataType: "json",
            success: function (data) {
                if(data) {
                    $.each(data, function(index, value) {
                        $(".levelSelector").append("<option value=" + value.id + ">" + value.name + "</option>");
                    });
                    return data;
                }
            }
        });
    })();

});
