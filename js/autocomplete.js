// autocomplete.js
//
// Handles autocomplete for the main search bar

$(function() {

    $("#searchSubjectName").autocomplete({
        source: subjects,
        select: function (event, ui) {
            event.preventDefault();
            $(this).val(ui.item.label);
            $("#searchSubjectId").val(ui.item.value);
        },
        focus: function (event, ui) {
            event.preventDefault();
            $(this).val(ui.item.label);
            $("#searchSubjectId").val(ui.item.value);
        },
        change: function (event, ui) {
            if(!ui.item){
                $(this).val("");
                $("#searchSubjectId").val("");
            }
        },
    });

    // TODO force valid subject on form submission

});
