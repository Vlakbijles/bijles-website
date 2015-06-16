// autocomplete.js
// Load local json file containing subjects, enable autocomplete for searchbar

$(function() {

    var subjects = (function() {
        var json = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': "subjects.json",
            'dataType': "json",
            'success': function (data) {
                json = data;
            }
        });
        return json;
    })();

    $( "#subject_name" ).autocomplete({
        source: subjects,
        select: function (event, ui) {
            event.preventDefault()
                $(this).val(ui.item.label);
            $("#subject_id").val(ui.item.value);
        },
        focus: function (event, ui) {
            event.preventDefault()
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
