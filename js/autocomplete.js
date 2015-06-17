// autocomplete.js
// Obtain subject list from server, enable autocomplete for searchbar

$(function() {

    var subjects = (function () {
        var formatted = [];
        $.ajax({
            'async': false,
            'global': false,
            'url': "http://vlakbijles.nl:5000/subject/all",
            'dataType': "json",
            'success': function (data) {
                $.each(data, function(key, val) {
                    formatted.push({ "value" : val.id, "label" : val.name });
                });
            }
        });
        return formatted;
    })();

    $( "#subject_name" ).autocomplete({
        source: subjects,
        select: function (event, ui) {
            event.preventDefault();
                $(this).val(ui.item.label);
            $("#subject_id").val(ui.item.value);
        },
        focus: function (event, ui) {
            event.preventDefault();
                $(this).val(ui.item.label);
            $("#subject_id").val(ui.item.value);
        },
        change: function (event, ui) {
            if(!ui.item){
                $("#subject_name").val("");
            }
        },

        // focus: function (event, ui) {
        //         return false;
        // }
    });

    // TODO force valid subject on form submission

});
